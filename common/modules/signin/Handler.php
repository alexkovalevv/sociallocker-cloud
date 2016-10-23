<?php
	namespace common\modules\signin;

	use common\modules\signin\models\SigninUserAccess;
	use yii;
	use common\modules\signin\handlers\twitter\TwitterHandler;
	use yii\base\Exception;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;
	use yii\helpers\ArrayHelper;

	/**
	 * The base class for all handlers of requests to the proxy.
	 */
	class Handler {

		public $srorage;
		public $sToken;
		public $oauth_client_id;

		public function __construct(array $options = [])
		{
			$this->options = $options;

			$this->s_token = ArrayHelper::getValue($options, 's_token');
			$this->oauth_client_id = ArrayHelper::getValue($options, 'oauth_client_id');
		}

		/**
		 * Saves the value to the storage.
		 */
		public function saveValue($key, $name, $value)
		{
			if( empty($_SESSION[$key]) ) {
				$_SESSION[$key] = [];
			}
			$_SESSION[$key][$name] = $value;
		}

		/**
		 * Get the value from the storage.
		 */
		public function getValue($key, $name, $default = null)
		{
			if( empty($_SESSION[$key]) || empty($_SESSION[$key][$name]) ) {
				return $default;
			}

			return $_SESSION[$key][$name];
		}

		/**
		 * Returns true if the user identity data is verified.
		 */
		public static function verifyUserData($identityData, $serviceData)
		{
			$source = isset($identityData['source'])
				? $identityData['source']
				: false;
			if( !$source || empty($serviceData) ) {
				return false;
			}

			switch( $source ) {
				case 'facebook':

					if( !isset($serviceData['authResponse']['accessToken']) || empty($serviceData['authResponse']['accessToken']) ) {
						return false;
					}

					$url = 'https://graph.facebook.com/me?access_token=' . $serviceData['authResponse']['accessToken'];

					$client = new Client();

					try {
						$result = $client->request('GET', $url);
						$body = $result->getBody();

						if( empty($body) ) {
							return false;
						}

						$data = json_decode($body);
						if( !isset($data->email) ) {
							return false;
						}

						$email = str_replace('\u0040', '@', $data->email);
						if( $identityData['email'] !== $email ) {
							return false;
						}

						return true;
					} catch( RequestException $e ) {
						return false;
					}

				case 'twitter':

					if( !isset($serviceData['visitorId']) || empty($serviceData['visitorId']) ) {
						return false;
					}

					$accessData = SigninUserAccess::getAccessData($serviceData['visitorId']);

					if( empty($accessData) ) {
						return false;
					}

					$token = $accessData['twitter_token'];
					$secret = $accessData['twitter_secret'];

					if( empty($token) || empty($secret) ) {
						return false;
					}

					$options = Yii::$app->getModule('signin')->params['handlers_options']['twitter'];

					$handler = new TwitterHandler($options, true);
					$response = $handler->getUserData($serviceData['visitorId'], true);

					if( !isset($response->email) || empty($response->email) ) {
						return false;
					}
					if( $identityData['email'] !== $response->email ) {
						return false;
					}

					return true;

				case 'linkedin':

					if( !isset($serviceData['accessToken']) || empty($serviceData['accessToken']) ) {
						return false;
					}

					$url = 'https://api.linkedin.com/v1/people/~:(emailAddress)?oauth2_access_token=' . $serviceData['accessToken'];

					$client = new Client();

					try {
						$result = $client->request('GET', $url, [
							'headers' => 'x-li-format: json'
						]);
						$body = $result->getBody();

						if( empty($body) ) {
							return false;
						}

						$data = json_decode($body);
						if( !isset($data->emailAddress) ) {
							return false;
						}

						if( $identityData['email'] !== $data->emailAddress ) {
							return false;
						}

						return true;
					} catch( RequestException $e ) {
						return false;
					}
				case 'google':

					if( !isset($serviceData['access_token']) || empty($serviceData['access_token']) ) {
						return false;
					}

					$url = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=' . $serviceData['access_token'];

					$client = new Client();

					try {
						$result = $client->request('GET', $url);
						$body = $result->getBody();

						if( empty($body) ) {
							return false;
						}

						$data = json_decode($body);
						if( !isset($data->email) ) {
							return false;
						}

						if( $identityData['email'] !== $data->email ) {
							return false;
						}

						return true;
					} catch( RequestException $e ) {
						return false;
					}

				case 'vk':

					if( !isset($serviceData['accessToken']) || empty($serviceData['accessToken']) ) {
						return false;
					}

					$url = 'https://api.vk.com/method/users.get?access_token=' . $serviceData['accessToken'];

					$client = new Client();

					try {
						$result = $client->request('GET', $url);
						$body = $result->getBody();

						if( empty($body) ) {
							return false;
						}

						$data = json_decode($body);
						if( !isset($serviceData['email']) ) {
							return false;
						}
						if( $identityData['email'] !== $serviceData['email'] ) {
							return false;
						}

						return true;
					} catch( RequestException $e ) {
						return false;
					}
			}

			return false;
		}
	}

	/**
	 * An exception which shows the error for public.
	 */
	class HandlerException extends Exception {

		public function __construct($message)
		{
			if( is_string($message) ) {
				parent::__construct($message, 0, null);
			} else {
				echo 'Error: ';
				print_r($message);
				exit;
			}
		}
	}

	/**
	 * An exception which shows hides the error but saves it in the logs.
	 */
	class HandlerInternalException extends HandlerException {

		protected $detailed;

		public function __construct($message)
		{
			parent::__construct($message, 0, null);
			$this->detailed = $message;
			$this->message = 'Unexpected error occurred. Please check the logs for more details.';
		}

		public function getDetailed()
		{
			return $this->detailed;
		}
	}