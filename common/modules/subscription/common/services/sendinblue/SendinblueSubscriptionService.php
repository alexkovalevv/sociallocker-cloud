<?php
	namespace common\modules\subscription\common\services\sendinblue;

	use Yii;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;

	class SendinblueSubscriptionService extends Subscription {

		/**
		 * @param $endPoint
		 * @param string $method
		 * @param array $data
		 *
		 * @return array|mixed
		 * @throws SubscriptionException
		 * @throws SubscriptionException
		 */
		public function request($endPoint, $method = 'GET', $data = [], array $contextData = [])
		{
			$condition = [];

			if( isset($contextData['lockerId']) ) {
				$condition['locker_id'] = $contextData['lockerId'];
			}

			$apiKey = Yii::$app->lockersSettings->getOne('sendinblue_apikey', false, $condition);

			if( empty($apiKey) ) {
				throw new SubscriptionException ('The API Key not set.');
			}

			$url = 'https://api.sendinblue.com/v2.0/' . $endPoint;

			$client = new Client([
				'timeout' => 30
			]);

			$args = [
				'headers' => [
					'api-key' => $apiKey,
					'Content-Type' => 'application/json'
				]
			];

			if( !empty($data) ) {
				$args['query'] = $data;
			}

			try {
				$result = $client->request($method, $url, $args);
				$resultBody = $result->getBody();

				if( empty($resultBody) ) {
					return [];
				}

				$data = json_decode($result['body']);
				if( $data === false ) {
					throw new SubscriptionException('Unexpected error occurred during connection to SendInBlue. ' . $resultBody);
				}

				return $data;
			} catch( RequestException $e ) {
				throw new SubscriptionException('Unexpected error occurred during connection to SendInBlue: ' . $e->getResponse());
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

			$result = $this->request('list', 'GET', [
				'page' => 1,
				'page_limit' => 100
			]);

			if( $result->code !== 'success' ) {
				throw new SubscriptionException($result->message);
			}

			$lists = [];

			if( isset($result->data->lists) ) {

				foreach($result->data->lists as $value) {
					$lists[] = [
						'title' => $value->name,
						'value' => $value->id
					];
				}
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
			$result = $this->request("user/$email", "GET", [], $contextData);

			// user exists already

			if( $result->code == 'success' ) {

				if( !isset($result->listid) || empty($result->listid) ) {
					$lists = [];
				} else $lists = $result->listid;

				if( !in_array($listId, $lists) ) {
					$lists[] = $listId;
				}
				// user doesn't exist yet

			} else {

				$lists[] = $listId;
			}

			unset($identityData['email']);
			$attrs = $identityData;

			$result = $this->request("user/createdituser", "POST", [
				'email' => $email,
				'attributes' => $attrs,
				'listid' => $lists
			], $contextData);

			if( $result->code !== 'success' ) {
				throw new SubscriptionException($result->message);
			}

			return ['status' => 'subscribed'];
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($identityData, $listId, $contextData)
		{

			$email = $identityData['email'];
			$result = $this->request("user/$email", "GET", [], $contextData);

			if( $result->code !== 'success' ) {
				throw new SubscriptionException($result->message);
			}

			return ['status' => 'subscribed'];
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			return [
				'error' => 'Sorry, the plugin doesn\'t support custom fields for SendInBlue. Please <a href="http://support.onepress-media.com/create-ticket/" target="_blank">contact us</a> if you need this feature.'
			];
		}
	}
