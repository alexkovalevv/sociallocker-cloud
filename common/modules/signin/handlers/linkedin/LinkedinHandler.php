<?php
	namespace common\modules\signin\handlers\linkedin;
	
	use common\modules\signin\Handler;
	use common\modules\signin\HandlerException;
	use common\modules\signin\HandlerInternalException;
	use common\modules\signin\handlers\linkedin\libs\LinkedIn_Client;
	use common\modules\signin\models\SigninOauthClients;
	use common\modules\signin\models\SigninTemp;
	use Yii;
	use yii\helpers\ArrayHelper;
	
	/**
	 * The class to proxy the request to the LinkedIn API.
	 */
	class LinkedinHandler extends Handler {
		
		/**
		 * Handles the proxy request.
		 */
		public function handleRequest()
		{
			
			// the request type is to determine which action we should to run
			$requestType = !empty($_REQUEST['request_type'])
				? $_REQUEST['request_type']
				: null;
			
			// allowed request types, others will trigger an error
			$allowed = ['init', 'callback' /*'user_info'*/];
			
			if( empty($requestType) || !in_array($requestType, $allowed) ) {
				throw new HandlerInternalException('Не известный тип запроса.');
			}
			
			switch( $requestType ) {
				
				case 'init':
					return $this->doInit();
					break;
				
				case 'callback':
					return $this->doCallback();
					break;
				/*case 'user_info':
					$this->getUserData( $accessToken );  */
			}
		}
		
		/**
		 * Build the callback URL for Twitter.
		 */
		public function getCallbackUrl()
		{
			$proxy = $this->options['proxy'];

			$prefix = (strpos($proxy, '?') === false)
				? '?'
				: '&';
			
			$extendUrlParams = '';
			
			if( !empty($this->oauth_client_id) ) {
				$extendUrlParams = '&oauth_client_id=' . $this->oauth_client_id;
			} else if( !empty($this->s_token) ) {
				$extendUrlParams = '&s_token=' . $this->s_token;
			}
			
			return $proxy . $prefix . 'request_type=callback' . $extendUrlParams;
		}
		
		/**
		 * Inits an OAuth request.
		 */
		public function doInit()
		{
			$options = $this->options;
			
			$client = new LinkedIn_Client($options['client_id'], $options['client_secret']);
			$authorizeURL = $client->getAuthorizationUrl($this->getCallbackUrl());
			
			return Yii::$app->response->redirect($authorizeURL);
		}
		
		/**
		 * Handles a callback from Twitter (when the user has been redirected)
		 */
		public function doCallback()
		{
			$options = $this->options;
			
			$denied = isset($_REQUEST['error']);

			if( $denied ) {
				return null;
			}
			
			$code = isset($_REQUEST['code'])
				? $_REQUEST['code']
				: false;
			
			if( empty($code) ) {
				throw new HandlerInternalException('Не передан код запроса.');
			}
			
			$client = new LinkedIn_Client($options['client_id'], $options['client_secret']);
			$response = $client->fetchAccessToken($code, $this->getCallbackUrl());
			
			if( !isset($response['access_token']) ) {
				throw new HandlerInternalException('Невозможно получить токен доступа.');
			}
			
			$accessToken = $response['access_token'];
			
			$user_data = $this->getUserData($accessToken);
			
			$first_name = ArrayHelper::getValue($user_data, 'firstName');
			$last_name = ArrayHelper::getValue($user_data, 'lastName');
			
			$avatar_url = isset($user_data['pictureUrls']['values']) && !empty($user_data['pictureUrls']['values'])
				? $user_data['pictureUrls']['values'][0]
				: null;
			
			$user_info = [
				'access_token' => $accessToken,
				'source' => 'linkedin',
				'email' => ArrayHelper::getValue($user_data, 'emailAddress'),
				'uid' => ArrayHelper::getValue($user_data, 'id'),
				'display_name' => $first_name . ' ' . $last_name,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'avatar_url' => $avatar_url,
				'profile_url' => ArrayHelper::getValue($user_data, 'publicProfileUrl')
			];
			
			return $user_info;
		}
		
		public function getUserData($accessToken)
		{
			
			$options = $this->options;
			
			$client = new LinkedIn_Client($options['client_id'], $options['client_secret']);
			$client->setAccessToken($accessToken);
			
			$fields = ["id", "firstName", "lastName", "emailAddress", "publicProfileUrl", "pictureUrls::(original)"];
			
			$response = $client->fetch('/v1/people/~:(' . implode(',', $fields) . ')');
			
			return $response;
		}
	}


