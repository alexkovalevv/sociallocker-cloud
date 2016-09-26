<?php
	namespace common\modules\subscription\services\activecampaign;

	use Yii;
	use common\modules\subscription\classes\Subscription;
	use common\modules\subscription\classes\SubscriptionException;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;

	class ActivecampaignSubscriptionService extends Subscription {

		public function request($action, $method = 'GET', $data = [], array $contextData = [])
		{
			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$apiKey = Yii::$app->lockersSettings->getOne('activecampaign_apikey', false, $condition);

			if( empty($apiKey) ) {
				throw new SubscriptionException ('Не установлен API ключ.');
			}

			$apiUrl = Yii::$app->lockersSettings->getOne('activecampaign_apiurl', false, $condition);

			if( empty($apiUrl) ) {
				throw new SubscriptionException ('Не установлен API url.');
			}

			$getData = [
				'api_key' => $apiKey,
				'api_action' => $action,
				'api_output' => 'json'
			];

			$getData = array_merge($getData, $data);

			$apiUrl = rtrim($apiUrl, '/ ');
			$url = $apiUrl . '/admin/api.php';

			$client = new Client();
			try {
				$result = $client->request($method, $url, ['query' => $getData]);
				$body = $result->getBody();

				if( empty($body) ) {
					return [];
				}

				$data = json_decode($body, true);

				if( $data === false ) {
					throw new SubscriptionException('Unexpected error occurred during connection to ActiveCampaign. ' . $body);
				}

				if( $data['result_code'] === 0 && strpos($data['result_message'], 'Nothing is returned') === false && strpos($data['result_message'], 'ritornato niente') === false ) {
					throw new SubscriptionException($data['result_message']);
				}

				return $data;
			} catch( RequestException $e ) {
				throw new SubscriptionException('Unexpected error occurred during connection to ActiveCampaign. ' . $e->getRequest());
			}
		}

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{

			$response = $this->request('list_list', 'GET', ['ids' => 'all']);

			$lists = [];

			foreach($response as $key => $item) {
				if( !is_numeric($key) ) {
					continue;
				}

				$lists[] = [
					'title' => $item['name'],
					'value' => $item['id']
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
			$fields = $identityData;

			$firstName = '';
			$lastName = '';

			if( !empty($identityData['name']) ) {
				$lastName = $identityData['name'];
			}
			if( !empty($identityData['family']) ) {
				$lastName = $identityData['family'];
			}
			if( empty($firstName) && !empty($identityData['displayName']) ) {
				$firstName = $identityData['displayName'];
			}

			$fields = $this->refine($fields);
			unset($fields['email']);

			$response = $this->request('contact_view_email', 'GET', ['email' => $email], $contextData);
			$exists = isset($response['id']);

			$data = [];

			$data['email'] = $email;
			$data['ip4'] = $_SERVER['REMOTE_ADDR'];

			if( !empty($firstName) ) {
				$data['first_name'] = $firstName;
			}
			if( !empty($lastName) ) {
				$data['last_name'] = $lastName;
			}

			$data['status[' . $listId . ']'] = 1;
			$data['instantresponders[' . $listId . ']'] = 1;

			foreach($fields as $fieldKey => $fieldValue) {
				$data['field[%' . $fieldKey . '%,0]'] = $fieldValue;
			}

			// already exits

			if( $exists ) {

				$lists = explode('-', $response['listslist']);

				if( !in_array('' . $listId, $lists) ) {

					$data['id'] = $response['id'];

					$lists[] = $listId;
					foreach($lists as $listId) {
						$data['p[' . $listId . ']'] = $listId;
					}

					$response = $this->request('contact_edit', 'POST', $data);
				}

				return ['status' => 'subscribed'];
			}

			$data['p[' . $listId . ']'] = $listId;

			foreach($fields as $fieldKey => $fieldValue) {
				$response['field[%' . $fieldKey . '%,0]'] = $fieldValue;
			}

			$this->request('contact_add', 'POST', $data);

			return ['status' => 'subscribed'];
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($identityData, $listId, $contextData)
		{

			return ['status' => 'subscribed'];
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			$response = $this->request('list_view', 'GET', ['id' => $listId]);

			if( empty($response['fields']) ) {
				return [];
			}

			$customFields = [];

			$mappingRules = [
				'radio' => 'dropdown',
				'listbox' => 'dropdown',
				'textarea' => ['text', 'checkbox', 'hidden'],
				'text' => ['text', 'checkbox', 'hidden']
			];

			foreach($response['fields'] as $item) {
				$fieldType = $item['type'];

				$pluginFieldType = isset($mappingRules[$fieldType])
					? $mappingRules[$fieldType]
					: strtolower($fieldType);

				$can = [
					'changeType' => true,
					'changeReq' => true,
					'changeDropdown' => false,
					'changeMask' => true
				];

				$fieldOptions = [];

				if( 'dropdown' === $pluginFieldType ) {

					foreach($item['options'] as $choice) {
						$fieldOptions['choices'][] = $choice['value'];
					}
				}

				$fieldOptions['req'] = intval($item['isrequired']) == 1;

				$customFields[] = [

					'fieldOptions' => $fieldOptions,
					'mapOptions' => [
						'req' => intval($item['isrequired']) == 1,
						'id' => $item['perstag'],
						'name' => $item['perstag'],
						'title' => sprintf('%s [%s]', $item['title'], $item['perstag']),
						'labelTitle' => $item['title'],
						'mapTo' => is_array($pluginFieldType)
							? $pluginFieldType
							: [$pluginFieldType],
						'service' => $item
					],
					'premissions' => [

						'can' => $can,
						'notices' => [
							'changeReq' => 'You can change this checkbox in your ActiveCampaign account.',
							'changeDropdown' => 'Please visit your ActiveCampaign account to modify the choices.',
						],
					]
				];
			}

			return $customFields;
		}

		public function getNameFieldIds()
		{
			return ['FIRSTNAME' => 'name', 'LASTNAME' => 'family'];
		}
	}
