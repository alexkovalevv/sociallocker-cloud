<?php
	namespace common\modules\subscription\common\services\unisender;

	use Yii;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;

	class UnisenderSubscriptionService extends Subscription {

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{
			$response = $this->callApi('getLists');

			if( empty($response) ) {
				throw new SubscriptionException('Request to the api was failed.');
			}

			$lists = [];
			foreach($response['result'] as $value) {
				$lists[] = [
					'title' => $value['title'],
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

			if( empty($vars['Name']) && !empty($identityData['first_name']) ) {
				$vars['Name'] = $identityData['first_name'] . (!empty($identityData['last_name'])
						? ' ' . $identityData['last_name']
						: '');
			}

			$response = $this->callApi('subscribe', [
				'list_ids' => $listId,
				'fields' => $vars,
				'request_ip' => $this->getClientIp(),
				'double_optin' => $verified
					? 1
					: ($doubleOptin
						? 0
						: 1),
				'overwrite' => 0
			], $contextData);

			if( isset($response['error']) ) {
				throw new SubscriptionException('[subscribe]: ' . $response['error']);
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

			$response = $this->callApi('exportContacts', [
				'list_ids' => $listId,
				'email' => $identityData['email']
			], $contextData);

			if( isset($response['error']) ) {
				throw new SubscriptionException('[check]: ' . $response['error']);
			}

			$fieldIndexEmailStatus = null;
			foreach($response['result']['field_names'] as $key => $val) {
				if( $val === "email_status" ) {
					$fieldIndexEmailStatus = $key;
				}
			}

			if( $fieldIndexEmailStatus === null ) {
				return ['status' => 'false'];
			}

			$status = 'false';
			switch( $response['result']['data'][0][$fieldIndexEmailStatus] ) {
				case 'active':
					$status = 'subscribed';
					break;
				case 'invited':
					$status = 'pending';
					break;
			}

			return ['status' => $status];
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			$response = $this->callApi('getFields');

			if( isset($response['error']) ) {
				throw new SubscriptionException('[subscribe]: ' . $response['error']);
			}

			$customFields = [];
			$mappingRules = [
				'text' => [
					'text',
					'checkbox',
					'hidden'
				],
				'number' => [
					'integer',
					'checkbox'
				],
				'bool' => 'checkbox',
				'string' => [
					'text',
					'checkbox',
					'hidden'
				]
			];

			$response['result'][] = [
				'id' => -1,
				'name' => 'phone',
				'type' => 'string',
				'public_name' => 'Телефон',
				'is_visible' => 1,
				'view_pos' => 1
			];

			foreach($response['result'] as $mergeVars) {
				$fieldType = $mergeVars['type'];

				$pluginFieldType = isset($mappingRules[$fieldType])
					? $mappingRules[$fieldType]
					: strtolower($fieldType);

				if( in_array($pluginFieldType, ['email']) ) {
					continue;
				}
				$can = [
					'changeType' => true,
					'changeReq' => true,
					'changeDropdown' => false,
					'changeMask' => true
				];

				$fieldOptions = [];

				$customFields[] = [

					'fieldOptions' => $fieldOptions,
					'mapOptions' => [
						'req' => false,
						'id' => $mergeVars['name'],
						'name' => $mergeVars['name'],
						'title' => $mergeVars['public_name'],
						'labelTitle' => $mergeVars['public_name'],
						'mapTo' => is_array($pluginFieldType)
							? $pluginFieldType
							: [$pluginFieldType],
						'service' => $mergeVars
					],
					'premissions' => [

						'can' => $can,
						'notices' => [
							'changeReq' => 'You can change this checkbox in your Unisender account.',
							'changeDropdown' => 'Please visit your Unisender account to modify the choices.'
						],
					]
				];
			}

			return $customFields;
		}

		/**
		 * @return string
		 */
		protected function getClientIp()
		{
			$result = '';

			if( !empty($_SERVER['REMOTE_ADDR']) ) {
				$result = $_SERVER['REMOTE_ADDR'];
			} elseif( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
				$result = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
				$result = $_SERVER['HTTP_CLIENT_IP'];
			}

			if( preg_match('/([0-9]|[0-9][0-9]|[01][0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[0-9][0-9]|[01][0-9][0-9]|2[0-4][0-9]|25[0-5])){3}/', $result, $match) ) {
				return $match[0];
			}

			return $result;
		}

		//get data by method
		public function callApi($method = null, array $params = [], array $contextData = [])
		{

			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$apikey = Yii::$app->lockersSettings->getOne('unisender_api_key', false, $condition);

			if( empty($apikey) ) {
				throw new SubscriptionException('[callApi]: Api ключ не существует или передан пустой параметр.');
			}

			if( empty($method) ) {
				throw new SubscriptionException('[callApi]: Не был передан метод.');
			}

			$params = array_merge([
				'api_key' => $apikey
			], $params);

			$params = http_build_query($params);
			$url = "http://api.unisender.com/ru/api/" . trim($method) . "?format=json&" . $params;

			$options = [
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => 0,
			];

			$ch = curl_init();
			curl_setopt_array($ch, $options);
			$result = curl_exec($ch);

			if( $result == false ) {
				throw new SubscriptionException(curl_error($ch));
			}
			curl_close($ch);

			$final = json_decode($result, true);

			if( empty($final) ) {
				throw new SubscriptionException('[callApi]: Запрос завершился не удачей, произошла неизвестная ошибка.');
			}

			return $final;
		}
	}