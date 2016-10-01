<?php
	namespace common\modules\signin\handlers\twitter;

	use common\modules\signin\HandlerInternalException;
	use common\modules\signin\models\SigninOauthClients;
	use common\modules\signin\models\SigninTemp;
	use common\modules\signin\models\SigninUserAccess;
	use common\modules\subscription\classes\LeadsHelper;
	use yii;
	use common\modules\signin\Handler;
	use common\modules\signin\HandlerException;
	use common\modules\signin\handlers\twitter\libs\TwitterOAuth;
	use yii\helpers\ArrayHelper;

	/**
	 * The class to proxy the request to the Twitter API.
	 */
	class TwitterHandler extends Handler {

		/**
		 * Handles the proxy request.
		 */
		public function handleRequest()
		{

			// the request type is to determine which action we should to run
			$requestType = !empty($_REQUEST['request_type'])
				? $_REQUEST['request_type']
				: null;

			$this->actions = !empty($_REQUEST['actions'])
				? $_REQUEST['actions']
				: null;

			$this->tweetMessage = !empty($_REQUEST['tweet_message'])
				? $_REQUEST['tweet_message']
				: null;

			$this->followTo = isset($_REQUEST['follow_to'])
				? $_REQUEST['follow_to']
				: null;

			// allowed request types, others will trigger an error
			$allowed = ['init', 'callback'];

			if( empty($requestType) || !in_array($requestType, $allowed) ) {
				return ['error' => 'Invalid request type.'];
			}
			//throw new HandlerException('Invalid request type.');

			// the visitor id is used as a key for the storage where all the tokens are saved
			$visitorId = !empty($_REQUEST['visitor_id'])
				? $_REQUEST['visitor_id']
				: null;

			$readOnly = !empty($_REQUEST['read_only'])
				? (bool)$_REQUEST['read_only']
				: null;
			if( $readOnly ) {
				$this->options['consumer_key'] = 'BGzwxomRvrJce8jQr2ajg5LBj';
				$this->options['consumer_secret'] = 'bYCm0HawRTVCYARtJD6tLLkyccq9YRrmtU41QLrcuLEXR7CD9r';
			}

			switch( $requestType ) {

				case 'init':
					$this->doInit($visitorId);
					break;
				case 'callback':
					$this->doCallback($visitorId);
					break;
			}
		}

		/**
		 * Build the callback URL for Twitter.
		 */
		public function getCallbackUrl($visitorId)
		{
			$proxy = $this->options['proxy'];
			$prefix = (strpos($proxy, '?') === false)
				? '?'
				: '&';

			$extendUrlParams = '';

			if( !empty($this->actions) ) {
				$extendUrlParams .= '&actions=' . $this->actions;
			}

			if( !empty($this->tweetMessage) ) {
				$extendUrlParams .= '&tweet_message=' . $this->tweetMessage;
			}

			if( !empty($this->followTo) ) {
				$extendUrlParams .= '&follow_to=' . $this->followTo;
			}

			if( !empty($this->oAuthClientId) ) {
				$extendUrlParams .= '&oauth_client_id=' . $this->oAuthClientId;
			} else if( !empty($this->sToken) ) {
				$extendUrlParams .= '?stoken=' . $this->sToken;
			}

			return $proxy . $prefix . 'request_type=callback' . $extendUrlParams . '&visitor_id=' . $visitorId;
		}

		/**
		 * Inits an OAuth request.
		 */
		public function doInit($visitorId)
		{
			$options = $this->options;

			if( empty($visitorId) ) {
				$visitorId = $this->getGuid();
			}

			$oauth = new TwitterOAuth($options['consumer_key'], $options['consumer_secret']);
			$requestToken = $oauth->getRequestToken($this->getCallbackUrl($visitorId));

			$token = $requestToken['oauth_token'];
			$secret = $requestToken['oauth_token_secret'];

			$this->saveValue($visitorId, 'temp_twitter_token', $token);
			$this->saveValue($visitorId, 'temp_twitter_secret', $secret);

			$authorizeURL = $oauth->getAuthorizeURL($token, false);

			return Yii::$app->response->redirect($authorizeURL);
		}

		/**
		 * Handles a callback from Twitter (when the user has been redirected)
		 */
		public function doCallback($visitorId)
		{
			$options = $this->options;

			if( empty($visitorId) ) {
				throw new HandlerInternalException('Не передан id посетителя.');
			}

			$denied = isset($_REQUEST['denied']);
			if( $denied ) {
				return Yii::$app->response->redirect(['signin/connect/blank']);
			}

			$response_package = [];
			$accessData = SigninUserAccess::getAccessData($visitorId);

			if( empty($accessData) ) {

				$token = !empty($_REQUEST['oauth_token'])
					? $_REQUEST['oauth_token']
					: null;
				$verifier = !empty($_REQUEST['oauth_verifier'])
					? $_REQUEST['oauth_verifier']
					: null;

				if( empty($token) || empty($verifier) ) {
					$redirect_url = str_replace('=callback', '=init', Yii::$app->request->absoluteUrl);

					return Yii::$app->response->redirect($redirect_url);
				}

				$secret = $this->getValue($visitorId, 'temp_twitter_secret');

				if( empty($secret) ) {
					throw new HandlerInternalException("Неверный секретный код для посетителя $visitorId");
				}

				$connection = new TwitterOAuth($options['consumer_key'], $options['consumer_secret'], $token, $secret);

				$accessToken = $connection->getAccessToken($verifier);

				SigninUserAccess::saveAccessData($visitorId, 'twitter', [
					'twitter_token' => $accessToken['oauth_token'],
					'twitter_secret' => $accessToken['oauth_token_secret']
				]);

				$response_package['access_token'] = $accessToken;
			}

			$response_package['user_info'] = $this->getUserData($visitorId);

			// Если токен устарел или не существует, отправляем на повторную авторизацию
			if( isset($response_package['user_info']->errors) ) {
				if( $response_package['user_info']->errors[0]->code == 89 ) {

					SigninUserAccess::removeAccessData($visitorId);
					$redirect_url = str_replace('=callback', '=init', Yii::$app->request->absoluteUrl);

					return Yii::$app->response->redirect($redirect_url);
				}
			}

			if( !empty($this->actions) ) {
				$actions = explode(',', $this->actions);

				foreach($actions as $action) {
					if( in_array($action, ['follow', 'tweet']) ) {
						$response_package[$action] = call_user_func([$this, $action], $visitorId);
					}
				}
			}

			$display_name = ArrayHelper::getValue($response_package['user_info'], 'name');
			$split_name = explode(' ', $display_name);

			$first_name = isset($split_name[0])
				? $split_name[0]
				: '';
			$last_name = isset($split_name[1])
				? $split_name[1]
				: '';

			$user_info = [
				'visitor_id' => $visitorId,
				'screen_name' => ArrayHelper::getValue($response_package['user_info'], 'screen_name'),
				'email' => ArrayHelper::getValue($response_package['user_info'], 'email'),
				'uid' => ArrayHelper::getValue($response_package['user_info'], 'id'),
				'display_name' => $display_name,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'avatar_url' => ArrayHelper::getValue($response_package['user_info'], 'profile_image_url_https')
			];

			SigninOauthClients::saveClientInfo($this->oAuthClientId, $this->sToken, 'twitter', $user_info);

			return Yii::$app->response->redirect(['signin/connect/blank']);
		}

		protected function getTwitterOAuth($visitorId = null, $token = null, $secret = null)
		{
			$options = $this->options;

			if( empty($visitorId) && (empty($token) || empty($secret)) ) {
				throw new HandlerInternalException('Не передан id посетителя.');
			}

			$accessData = SigninUserAccess::getAccessData($visitorId);

			if( empty($accessData) && (empty($token) || empty($secret)) ) {
				throw new HandlerInternalException('Не переданы данные доступа.');
			}

			if( empty($token) ) {
				$token = isset($accessData['twitter_token'])
					? $accessData['twitter_token']
					: null;
				if( empty($token) ) {
					throw new HandlerInternalException("Токен доступа посетителя $visitorId не найден!");
				}
			}
			if( empty($secret) ) {
				$secret = isset($accessData['twitter_secret'])
					? $accessData['twitter_secret']
					: null;
				if( empty($secret) ) {
					throw new HandlerInternalException("Неправильный секретный код посетителя $visitorId");
				}
			}

			return new TwitterOAuth($options['consumer_key'], $options['consumer_secret'], $token, $secret);
		}

		public function getUserData($visitorId)
		{
			$oauth = $this->getTwitterOAuth($visitorId);

			$response = $oauth->get('account/verify_credentials', ['skip_status' => 1, 'include_email' => 'true']);

			return $response;
		}

		public function getTweets($visitorId)
		{
			$oauth = $this->getTwitterOAuth($visitorId);

			$response = $oauth->get('statuses/user_timeline', ['count' => 3]);

			return $response;
		}

		public function getFollowers($visitorId)
		{
			$oauth = $this->getTwitterOAuth($visitorId);
			$sceenName = !empty($_REQUEST['opandaSceenName'])
				? $_REQUEST['opandaSceenName']
				: null;

			$response = $oauth->get('friendships/lookup', ['screen_name' => $sceenName]);

			return $response;
		}

		protected function follow($visitorId)
		{
			$oauth = $this->getTwitterOAuth($visitorId);

			$contextData = isset($_POST['opandaContextData'])
				? $_POST['opandaContextData']
				: [];
			$contextData = $this->normilizeValues($contextData);

			$followTo = $this->followTo;
			if( empty($followTo) ) {
				throw new HandlerInternalException("Не указано имя пользователя");
			}

			$notifications = isset($_REQUEST['opandaNotifications'])
				? $_REQUEST['opandaNotifications']
				: false;
			$notifications = $this->normilizeValue($notifications);

			$response = $oauth->get('friendships/lookup', [
				'screen_name' => $followTo
			]);

			if( isset($response->errors) ) {
				throw new HandlerInternalException($response->errors[0]->message);
			}

			if( isset($response[0]->connections) && in_array('following', $response[0]->connections) ) {
				return ['success' => true];
			}

			$response = $oauth->post('friendships/create', [
				'screen_name' => $followTo,
				'follow' => $notifications
			]);

			if( isset($response->errors) ) {
				return ['error' => $response->errors[0]->message];
			}

			return $response;
		}

		protected function tweet($visitorId)
		{
			$oauth = $this->getTwitterOAuth($visitorId);

			$contextData = isset($_POST['opandaContextData'])
				? $_POST['opandaContextData']
				: [];
			$contextData = $this->normilizeValues($contextData);

			$message = $this->tweetMessage;
			if( empty($message) ) {
				throw new HandlerInternalException("Не указано сообщение для публикации.");
			}

			$response = $oauth->post('statuses/update', [
				'status' => $message
			]);

			if( isset($response->errors) ) {

				// the tweet already is twitted
				if( $response->errors[0]->code == 187 ) {
					return ['success' => true];
				}

				return ['error' => $response->errors[0]->message];
			}

			return $response;
		}

		protected function getGuid()
		{
			if( function_exists('com_create_guid') === true ) {
				return trim(com_create_guid(), '{}');
			}

			return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
		}
	}


