<?php
	namespace common\modules\subscription\common\services\acumbamail;

	use Yii;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;
	use yii\base\Exception;

	class AcumbamailSubscriptionService extends Subscription {

		/**
		 * Makes a request to Acumbamail.
		 *
		 * @since 1.0.9
		 */
		public function request($method, $args = [], array $contextData = [])
		{
			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$customerId = Yii::$app->lockersSettings->getOne('acumbamail_customer_id', false, $condition);
			$apiToken = Yii::$app->lockersSettings->getOne('acumbamail_api_token', false, $condition);

			if( empty($customerId) ) {
				throw new SubscriptionException('Не установлен ID пользователя в Acumbamail.');
			}

			if( empty($apiToken) ) {
				throw new SubscriptionException('Не установлен API токен Acumbamail.');
			}

			$args['customer_id'] = $customerId;
			$args['auth_token'] = $apiToken;
			$args['response_type'] = 'json';

			$url = 'https://acumbamail.com/api/1/' . $method . '/?';

			foreach($args as $key => $value) {

				if( !is_array($value) ) {
					$url .= $key . '=' . urlencode($value) . '&';
				} else {
					foreach($value as $subkey => $subvalue) {
						$url .= $key . '[' . $subkey . ']' . '=' . urlencode($subvalue) . '&';
					}
				}
			}

			$client = new Client([
				'timeout' => 30
			]);

			try {
				$result = $client->request("POST", $url);

				$code = $result->getStatusCode();
				if( !in_array($code, [200, 201, 400]) ) {
					throw new SubscriptionException('Unexpected error occurred during connection to Acumbamail: ' . $result->getReasonPhrase());
				}

				$resultBody = $result->getBody();

				if( empty($resultBody) ) {
					return [];
				}

				return json_decode($resultBody);
			} catch( RequestException $e ) {
				throw new SubscriptionException('Unexpected error occurred during connection to Acumbamail: ' . $e->getResponse());
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

			$result = $this->request('getLists');

			$lists = [];
			foreach($result as $listId => $listData) {
				$lists[] = [
					'title' => $listData->name,
					'value' => $listId
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

			$fields = $identityData;

			if( !empty($identityData['name']) ) {
				$fields['nombre'] = $identityData['name'];
				$fields['name'] = $identityData['name'];
			}

			if( !empty($identityData['family']) ) {
				$fields['apellidos'] = $identityData['family'];
				$fields['family'] = $identityData['family'];
				$fields['lastname'] = $identityData['family'];
				$fields['family'] = $identityData['family'];
			}

			if( empty($identityData['name']) && !empty($identityData['displayName']) ) {
				$fields['nombre'] = $identityData['displayName'];
				$fields['name'] = $identityData['displayName'];
			}

			$result = $this->request('addSubscriber', [
				'list_id' => $listId,
				'merge_fields' => $fields
			], $contextData);

			if( isset($result->error) ) {

				if( false === strpos($result->error, 'already exists') ) {
					throw new SubscriptionException($result->error);
				}
			}

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

			try {

				$mappingRules = [
					'char' => 'any',
					'text' => 'any',
					'boolean' => 'checkbox',
					'combobox' => 'dropdown',
					'number' => ['integer', 'checkbox'],
					'date' => 'unsupported'
				];

				$result = $this->request('getFields', [
					'list_id' => $listId
				]);

				$customFields = [];
				foreach($result as $fieldName => $fieldType) {

					$pluginFieldType = isset($mappingRules[$fieldType])
						? $mappingRules[$fieldType]
						: strtolower($fieldType);

					$can = [
						'changeType' => true,
						'changeReq' => true,
						'changeDropdown' => true,
						'changeMask' => true
					];

					if( in_array($pluginFieldType, ['email']) ) {
						continue;
					}
					$id = strtoupper($this->slugify($fieldName));

					$customFields[] = [

						'fieldOptions' => [],
						'mapOptions' => [
							'req' => false,
							'id' => $id,
							'name' => $id,
							'title' => sprintf('%s [%s]', $fieldName, $id),
							'labelTitle' => $fieldName,
							'mapTo' => $pluginFieldType == 'any'
								? 'any'
								: is_array($pluginFieldType)
									? $pluginFieldType
									: [$pluginFieldType],
							'service' => ['type' => $fieldType]
						],
						'premissions' => [
							'can' => $can,
							'notices' => []
						]
					];
				}

				return $customFields;
			} catch( Exception $ext ) {
				throw new SubscriptionException ('[custom-fields]: ' . $ext->getMessage());
			}
		}
	}
