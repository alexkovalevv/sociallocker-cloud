<?php
	namespace common\modules\subscription\common\services\getresponse;

	use Yii;
	use yii\base\Exception;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\services\getresponse\libs\JsonRPCClient;
	use common\modules\subscription\common\classes\SubscriptionException;

	class GetresponseSubscriptionService extends Subscription {

		protected $apiKey;
		protected $apiUrl = 'http://api2.getresponse.com';

		/**
		 * @since 1.0.0
		 * @return object JsonRPCClient
		 */
		public function initGetResponseLibs(array $contextData = [])
		{
			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$this->apiKey = Yii::$app->lockersSettings->getOne('getresponse_apikey', false, $condition);

			return new JsonRPCClient($this->apiUrl);
		}

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{

			$getResponse = $this->initGetResponseLibs();

			try {
				$campaigns = $getResponse->get_campaigns($this->apiKey, [
					'name' => ['CONTAINS' => '%']
				]);
			} catch( Exception $ex ) {

				$message = $ex->getMessage();

				// The API Key may be passed incorrectly
				// "Request have return error: Invalid params"
				if( strpos($message, 'Invalid params') ) {
					throw new SubscriptionException('The API Key is incorrect.');
				}

				throw $ex;
			}

			$lists = [];
			foreach($campaigns as $key => $value) {
				$lists[] = [
					'title' => $value['name'],
					'value' => $key
				];
			}

			return [
				'items' => $lists
			];
		}

		/**
		 * Subscribes the person.
		 */
		public function subscribe($identityData, $listId, $doubleOptin, $contextData, $verified)
		{

			if( !$doubleOptin ) {
				throw new SubscriptionException ('GetResponse requires the double opt-in. But the option "doubleOptin" set to false.');
			}

			$getResponse = null;

			$customs = [];
			foreach($identityData as $customName => $customValue) {
				if( in_array($customName, ['email', 'name', 'family', 'fullname', 'displayName']) ) {
					continue;
				}

				$customs[] = [
					'name' => $customName,
					'content' => $customValue
				];
			}

			try {
				$getResponse = $this->initGetResponseLibs($contextData);

				$dataToPass = [
					'campaign' => $listId,
					'email' => $identityData['email'],
					'cycle_day' => 0
				];

				if( isset($identityData['name']) && isset($identityData['family']) ) {
					$dataToPass['name'] = $identityData['name'] . ' ' . $identityData['family'];
				} elseif( isset($identityData['name']) ) {
					$dataToPass['name'] = $identityData['name'];
				}

				$dataToPass['customs'] = $customs;
				$getResponse->add_contact($this->apiKey, $dataToPass);

				return ['status' => 'pending'];
			} catch( Exception $ext ) {

				$status = null;

				// already waiting confirmation:
				// "Request have return error: Contact already queued for target campaign"
				if( strpos($ext->getMessage(), 'queued for target campaign') ) {
					$status = 'pending';
				}

				// already waiting confirmation:
				// "Request have return error: Contact already added to target campaign"
				if( strpos($ext->getMessage(), 'already added') ) {
					$status = 'subscribed';
				}

				if( $status !== null ) {

					try {

						$response = $getResponse->get_contacts($this->apiKey, [
							'campaigns' => [$listId],
							'email' => ['EQUALS' => $identityData['email']]
						]);

						foreach($response as $contactId => $contactData) {

							$dataToPass = [];
							$dataToPass['contact'] = $contactId;
							$dataToPass['customs'] = $customs;

							$getResponse->set_contact_customs($this->apiKey, $dataToPass);
						}
					} catch( Exception $ext ) {
						throw new SubscriptionException ('[update]: ' . $ext->getMessage());
					}

					return ['status' => $status];
				}

				/**
				 * if( !in_array(md5($ext->getMessage()), array('ad9f84f2ed3f3352d179ee2d5a17a1a4','92a2ebe1277e1bff0d8ee02b523c28b5')) )
				 * throw new SubscriptionException ('addContact: ' . $ext->getMessage());  */

				throw new SubscriptionException ('[subscribe]: ' . $ext->getMessage());
			}
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($identityData, $listId, $contextData)
		{

			$getResponse = $this->initGetResponseLibs($contextData);

			try {

				$response = $getResponse->get_contacts($this->apiKey, [
					'campaigns' => [$listId],
					'email' => ['EQUALS' => $identityData['email']]
				]);
			} catch( Exception $ext ) {
				throw new SubscriptionException ('[check]: ' . $ext->getMessage());
			}

			if( isset($response['error']) ) {
				return ['status' => 'false'];
			}

			return [
				'status' => sizeof($response)
					? 'subscribed'
					: 'pending'
			];
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			try {

				$getResponse = $this->initGetResponseLibs();
				$response = $getResponse->get_account_customs($this->apiKey);

				$customFields = [];
				$mappingRules = [
					'textarea' => 'text',
					'single_select' => 'dropdown',
					'radio' => 'dropdown',
				];

				foreach($response as $id => $field) {

					$pluginFieldType = isset($mappingRules[$field['input_type']])
						? $mappingRules[$field['input_type']]
						: strtolower($field['input_type']);

					$fieldOptions = [];

					if( 'date' === $field['content_type'] ) {
						$pluginFieldType = 'date';
					} elseif( 'number' === $field['content_type'] ) {
						$pluginFieldType = 'integer';
					} elseif( 'phone' === $field['content_type'] ) {
						$pluginFieldType = 'phone';
						$fieldOptions['validation'] = '/\+\d+/';
						$fieldOptions['validationError'] = __('Incorrect value. Please enter a valid phone number preceded by "+" and a country code.', 'bizpanda');
					}

					if( in_array($pluginFieldType, ['multi_select']) ) {
						continue;
					}

					$can = [
						'changeType' => true,
						'changeReq' => true,
						'changeDropdown' => false,
						'changeMask' => true
					];

					if( 'dropdown' === $pluginFieldType ) {

						foreach($field['contents'] as $choice) {
							$fieldOptions['choices'][] = $choice;
						}
					} elseif( 'checkbox' === $pluginFieldType ) {

						if( isset($field['contents']) && count($field['contents']) > 0 ) {
							$fieldOptions['onValue'] = $field['contents'][0];
							$fieldOptions['offValue'] = '';
						}
					}

					$customFields[] = [

						'fieldOptions' => $fieldOptions,
						'mapOptions' => [
							'id' => $field['name'],
							'name' => $field['name'],
							'title' => $field['name'],
							'labelTitle' => $field['name'],
							'mapTo' => is_array($pluginFieldType)
								? $pluginFieldType
								: [$pluginFieldType],
							'service' => $field
						],
						'premissions' => [

							'can' => $can,
							'notices' => [
								'changeDropdown' => __('Please visit your GetResponse account to modify the choices.')
							]
						]
					];
				}
			} catch( Exception $ext ) {
				throw new SubscriptionException ('[custom-fields]: ' . $ext->getMessage());
			}

			return $customFields;
		}
	}