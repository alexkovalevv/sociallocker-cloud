<?php
	namespace common\modules\subscription\common\services\mailchimp;

	use Yii;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\services\mailchimp\libs\MailChimp;
	use common\modules\subscription\common\classes\SubscriptionException;

	class MailchimpSubscriptionService extends Subscription {

		protected $apiKey;

		/**
		 * @since 1.0.0
		 * @return object MailChimp
		 */
		public function initMailChimpLibs(array $contextData = [])
		{

			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$this->apiKey = Yii::$app->lockersSettings->getOne('mailchimp_apikey', false, $condition);

			require_once 'libs/MailChimp.php';

			return new MailChimp($this->apiKey);
		}

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{

			$MailChimp = $this->initMailChimpLibs();
			$response = $MailChimp->call('lists/list');

			if( !$response ) {
				throw new SubscriptionException('The API Key is incorrect.');
			}

			if( !empty($response['error']) ) {
				throw new SubscriptionException($response['error']);
			}

			$lists = [];
			foreach($response['data'] as $value) {
				$lists[] = [
					'title' => $value['name'],
					'value' => $value['id']
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

			$vars = $this->refine($identityData);
			$email = $identityData['email'];

			if( empty($vars['FNAME']) && !empty($identityData['name']) ) {
				$vars['FNAME'] = $identityData['name'];
			}
			if( empty($vars['LNAME']) && !empty($identityData['family']) ) {
				$vars['LNAME'] = $identityData['family'];
			}
			if( empty($vars['FNAME']) && !empty($identityData['displayName']) ) {
				$vars['FNAME'] = $identityData['displayName'];
			}

			$sendWelcomeMessage = (bool)Yii::$app->lockersSettings->get('mailchimp_welcome', true);

			$MailChimp = $this->initMailChimpLibs($contextData);
			$response = $MailChimp->call('lists/subscribe', [
				'id' => $listId,
				'email' => ['email' => $email],
				'merge_vars' => $vars,
				'double_optin' => $verified
					? false
					: $doubleOptin,
				'update_existing' => false,
				'replace_interests' => false,
				'send_welcome' => $verified
					? $sendWelcomeMessage
					: (!$doubleOptin
						? $sendWelcomeMessage
						: false)
			]);

			if( isset($response['error']) && $response['code'] != 214 ) {
				throw new SubscriptionException ('[subscribe]: ' . $response['error']);
				// already exits

			} else if( isset($response['error']) && $response['code'] == 214 ) {

				$response = $MailChimp->call('lists/update-member', [
					'id' => $listId,
					'email' => ['email' => $email],
					'merge_vars' => $vars
				]);

				if( isset($response['error']) ) {
					throw new SubscriptionException ('[subscribe]: ' . $response['error']);
				}
			}

			return [
				'status' => (!$verified && $doubleOptin)
					? 'pending'
					: 'subscribed'
			];
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($identityData, $listId, $contextData)
		{

			$MailChimp = $this->initMailChimpLibs($contextData);
			$response = $MailChimp->call('/lists/member-info', [
				'id' => $listId,
				'emails' => [
					['email' => $identityData['email']]
				]
			]);

			if( !sizeof($response) || !isset($response['data'][0]['status']) ) {
				throw new SubscriptionException('[check]: Unexpected error occurred.');
			}

			return ['status' => $response['data'][0]['status']];
		}

		/**
		 * Prepares values enters by the user to save.
		 */
		public function prepareFieldValueToSave($mapOptions, $value)
		{
			if( empty($value) ) {
				return $value;
			}

			$fieldType = $mapOptions['service']['field_type'];

			if( $fieldType == 'birthday' ) {

				$dateformat = strtolower($mapOptions['service']['dateformat']);
				$parts = explode('/', $value);

				if( $dateformat === 'dd/mm' ) {
					return $parts[1] . '/' . $parts[0];
				} else {
					return $parts[0] . '/' . $parts[1];
				}
			} elseif( $fieldType == 'phone' ) {

				$phoneformat = strtolower($mapOptions['service']['phoneformat']);
				if( $phoneformat === 'us' ) {

					if( preg_match('/\((\d\d\d)\)\s(\d\d\d)\-(\d\d\d\d)/', $value, $matches) ) {
						return $matches[1] . '-' . $matches[2] . '-' . $matches[3];
					} else {
						return $value;
					}
				} else {
					return $value;
				}
			}

			return $value;
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			$MailChimp = $this->initMailChimpLibs();
			$response = $MailChimp->call('lists/merge-vars', [
				"id" => [$listId]
			]);

			if( isset($response['error_count']) && $response['error_count'] > 0 ) {
				throw new SubscriptionException ('Error: ' . $response['errors'][0]['error'] . '. Please try to refresh this page or update your <a href="#" target="_blank">subscription settings</a>.');
			}

			if( !isset($response['data'][0]['merge_vars']) ) {
				return [];
			}

			$customFields = [];
			$mappingRules = [
				'radio' => 'dropdown',
				'text' => ['text', 'checkbox', 'hidden'],
				'number' => ['integer', 'checkbox']
			];

			foreach($response['data'][0]['merge_vars'] as $mergeVars) {
				$fieldType = $mergeVars['field_type'];

				$pluginFieldType = isset($mappingRules[$fieldType])
					? $mappingRules[$fieldType]
					: strtolower($fieldType);

				if( in_array($pluginFieldType, ['email']) ) {
					continue;
				}

				$can = [
					'changeType' => true,
					'changeReq' => false,
					'changeDropdown' => false,
					'changeMask' => true
				];

				$fieldOptions = [];
				if( 'dropdown' === $pluginFieldType ) {

					foreach($mergeVars['choices'] as $choice) {
						$fieldOptions['choices'][] = $choice;
					}
				} else if( 'birthday' === $pluginFieldType ) {

					$fieldOptions['mask'] = '99/99';
					$fieldOptions['maskPlaceholder'] = strtolower($mergeVars['dateformat']);
					$can['changeMask'] = false;
				} else if( 'phone' === $pluginFieldType ) {

					if( 'US' === $mergeVars['phoneformat'] ) {

						$fieldOptions['mask'] = '(999) 999-9999';
						$fieldOptions['maskPlaceholder'] = '(___) ___-____';
						$can['changeMask'] = false;
					}
				}

				$fieldOptions['req'] = $mergeVars['req'];

				$customFields[] = [

					'fieldOptions' => $fieldOptions,
					'mapOptions' => [
						'req' => $mergeVars['req'],
						'id' => $mergeVars['tag'],
						'name' => $mergeVars['tag'],
						'title' => sprintf('%s [%s]', $mergeVars['name'], $mergeVars['tag']),
						'labelTitle' => $mergeVars['name'],
						'mapTo' => is_array($pluginFieldType)
							? $pluginFieldType
							: [$pluginFieldType],
						'service' => $mergeVars
					],
					'premissions' => [

						'can' => $can,
						'notices' => [
							'changeReq' => 'You can change this checkbox in your MailChimp account.',
							'changeDropdown' => 'Please visit your MailChimp account to modify the choices. <a href="http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags#List-merge-tags" target="_blank">Learn more</a>.'
						],
					]
				];
			}

			return $customFields;
		}

		public function getNameFieldIds()
		{
			return ['FNAME' => 'name', 'LNAME' => 'family'];
		}
	}
