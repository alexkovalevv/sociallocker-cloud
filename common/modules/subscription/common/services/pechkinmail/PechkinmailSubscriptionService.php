<?php
	namespace common\modules\subscription\common\services\pechkinmail;

	use Yii;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;
	use common\modules\subscription\common\services\pechkinmail\libs\PHPechkin;
	use yii\helpers\ArrayHelper;

	class PechkinmailSubscriptionService extends Subscription {

		private $username;
		private $password;

		public function initPechkinMailLibs(array $contextData = [])
		{
			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$this->username = Yii::$app->lockersSettings->getOne('pechkinmail_username', false, $condition);
			$this->password = Yii::$app->lockersSettings->getOne('pechkinmail_password', false, $condition);

			return new PHPechkin($this->username, $this->password);
		}

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{

			$PechkinMail = $this->initPechkinMailLibs();
			$response = $PechkinMail->lists_get();

			if( empty($response) ) {
				throw new SubscriptionException('Request to the api was failed.');
			}

			$lists = [];
			foreach($response['row'] as $value) {
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

			$email = $identityData['email'];

			$PechkinMail = $this->initPechkinMailLibs($contextData);

			$mapData = [
				'merge_1' => isset($identityData['merge_1'])
					? $identityData['merge_1']
					: ArrayHelper::getValue($identityData, 'name'),
				'merge_2' => isset($identityData['merge_2'])
					? $identityData['merge_2']
					: ArrayHelper::getValue($identityData, 'family'),
				'merge_3' => isset($identityData['merge_3'])
					? $identityData['merge_3']
					: null,
				'merge_4' => isset($identityData['merge_4'])
					? $identityData['merge_4']
					: null,
				'merge_5' => isset($identityData['merge_5'])
					? $identityData['merge_5']
					: null,
				'update' => true,
				'no_check' => false
			];

			$response = $PechkinMail->lists_add_member($listId, $email, $mapData);

			if( !is_array($response) || !sizeof($response) ) {
				throw new SubscriptionException('[subscribe]: ' . (!empty($response)
						? $response
						: 'Неожиданная ошибка.'));
			}

			if( !isset($response['member_id']) || empty($response['member_id']) ) {
				throw new SubscriptionException('[subscribe]: Неожиданная ошибка.');
			}

			print_r($response);

			return ['status' => 'subscribed'];
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($identityData, $listId, $contextData)
		{

			$PechkinMail = $this->initPechkinMailLibs($contextData);

			$response = $PechkinMail->lists_get_members($listId, [
				'email' => $identityData['email']
			]);

			if( !is_array($response) || !sizeof($response) ) {
				throw new SubscriptionException('[check]: ' . (!empty($response)
						? $response
						: 'Unexpected error occurred.'));
			}

			if( !isset($response['row']['state']) || empty($response['row']['state']) ) {
				return ['status' => 'false'];
			}

			return [
				'status' => ($response['row']['state'] === 'active'
					? 'subscribed'
					: 'pending')
			];
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{
			$PechkinMail = $this->initPechkinMailLibs();
			$response = $PechkinMail->lists_get($listId);

			if( empty($response) ) {
				throw new SubscriptionException('Request to the api was failed.');
			}

			$customFields = [];
			$mappingRules = [
				'choice' => 'dropdown',
				'text' => ['text', 'checkbox', 'hidden'],
				'number' => ['integer', 'checkbox']
			];

			for($i = 0; $i <= 5; $i++) {
				if( !isset($response['row']['merge_' . $i]) || (isset($response['row']['merge_' . $i]) && !sizeof($response['row']['merge_' . $i])) ) {
					continue;
				}

				$field = unserialize($response['row']['merge_' . $i]);

				$fieldType = $field['type'];

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
					foreach($field['title']['choices'] as $choice) {
						$fieldOptions['choices'][] = $choice;
					}
					$field['title'] = $field['title']['name'];
				}

				$fieldOptions['req'] = $field['req'] === "on"
					? true
					: false;

				$customFields[] = [

					'fieldOptions' => $fieldOptions,
					'mapOptions' => [
						'req' => $field['req'] === "on"
							? true
							: false,
						'id' => 'merge_' . $i,
						'name' => 'merge_' . $i,
						'title' => $field['title'],
						'labelTitle' => $field['title'],
						'mapTo' => is_array($pluginFieldType)
							? $pluginFieldType
							: [$pluginFieldType],
						'service' => $field
					],
					'premissions' => [

						'can' => $can,
						'notices' => [
							'changeReq' => 'You can change this checkbox in your Pechkinmail account.',
							'changeDropdown' => 'Please visit your Pechkinmail account to modify the choices.',
						],
					]
				];
			}

			return $customFields;
		}
	}