<?php
	namespace common\modules\signin;

	use yii;
	use common\modules\signin\handlers\twitter\TwitterHandler;
	use yii\base\Exception;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;

	/**
	 * The base class for all handlers of requests to the proxy.
	 */
	class Handler {

		public $srorage;

		public function __construct($options)
		{
			$this->options = $options;
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

		protected function normilizeValues($values = [])
		{
			if( empty($values) ) {
				return $values;
			}
			if( !is_array($values) ) {
				$values = [$values];
			}

			foreach($values as $index => $value) {

				$values[$index] = is_array($value)
					? $this->normilizeValues($value)
					: $this->normilizeValue($value);
			}

			return $values;
		}

		protected function normilizeValue($value = null)
		{
			if( 'false' === $value ) {
				$value = false;
			} elseif( 'true' === $value ) {
				$value = true;
			} elseif( 'null' === $value ) {
				$value = null;
			}

			return $value;
		}

		/**
		 * Process names of the identity data.
		 */
		public function prepareDataToSave($service, $itemId, $identityData)
		{

			// move the values from the custom fields like FNAME, LNAME

			if( !empty($service) ) {
				$formType = Yii::$app->locker->getOption($itemId, 'form_type', 'email-form');
				$strFieldsJson = Yii::$app->locker->getOption($itemId, 'custom_fields', null);

				if( 'custom-form' == $formType && !empty($strFieldsJson) ) {

					$fieldsData = json_decode($strFieldsJson, true);
					$ids = $service->getNameFieldIds();

					$newIdentityData = $identityData;

					foreach($identityData as $itemId => $itemValue) {

						foreach($fieldsData as $fieldData) {

							if( !isset($fieldData['mapOptions']['id']) ) {
								continue;
							}
							if( $fieldData['fieldOptions']['id'] !== $itemId ) {
								continue;
							}

							$mapId = $fieldData['mapOptions']['id'];

							if( in_array($fieldData['mapOptions']['mapTo'], ['separator', 'html', 'label']) ) {
								unset($newIdentityData[$itemId]);
								continue;
							}

							foreach($ids as $nameFieldId => $nameFieldType) {
								if( $mapId !== $nameFieldId ) {
									continue;
								}
								$newIdentityData[$nameFieldType] = $itemValue;
								unset($newIdentityData[$itemId]);
							}
						}
					}

					$identityData = $newIdentityData;
				}
			}

			// splits the full name into 2 parts

			if( isset($identityData['fullname']) ) {

				$fullname = trim($identityData['fullname']);
				unset($identityData['fullname']);

				$parts = explode(' ', $fullname);
				$nameParts = [];

				foreach($parts as $part) {
					if( trim($part) == '' ) {
						continue;
					}
					$nameParts[] = $part;
				}

				if( count($nameParts) == 1 ) {
					$identityData['name'] = $nameParts[0];
				} else if( count($nameParts) > 1 ) {
					$identityData['name'] = $nameParts[0];
					$identityData['displayName'] = implode(' ', $nameParts);
					unset($nameParts[0]);
					$identityData['family'] = implode(' ', $nameParts);
				}
			}

			return $identityData;
		}

		/**
		 * Replaces keys of identity data of the view 'cf3' with the ids of custom fields in the mailing services.
		 */
		public function mapToServiceIds($service, $itemId, $identityData)
		{

			$formType = Yii::$app->locker->getOption($itemId, 'form_type', 'email-form');
			$strFieldsJson = Yii::$app->locker->getOption($itemId, 'custom_fields', null);

			if( 'custom-form' !== $formType || empty($strFieldsJson) ) {

				$data = [];
				if( isset($identityData['email']) ) {
					$data['email'] = $identityData['email'];
				}
				if( isset($identityData['name']) ) {
					$data['name'] = $identityData['name'];
				}
				if( isset($identityData['family']) ) {
					$data['family'] = $identityData['family'];
				}

				return $data;
			}

			$fieldsData = json_decode($strFieldsJson, true);

			$data = [];
			foreach($identityData as $itemId => $itemValue) {

				if( in_array($itemId, ['email', 'fullname', 'name', 'family', 'displayName']) ) {
					$data[$itemId] = $itemValue;
					continue;
				}

				foreach($fieldsData as $fieldData) {

					if( $fieldData['fieldOptions']['id'] === $itemId ) {
						$mapId = $fieldData['mapOptions']['id'];
						$data[$mapId] = $service->prepareFieldValueToSave($fieldData['mapOptions'], $itemValue);
					}
				}
			}

			return $data;
		}

		/**
		 * Replaces keys of identity data of the view 'cf3' with the labels the user enteres in the locker settings.
		 */
		public function mapToCustomLabels($service, $itemId, $identityData)
		{

			$formType = Yii::$app->locker->getOption($itemId, 'form_type', true);
			$strFieldsJson = Yii::$app->locker->getOption($itemId, 'custom_fields', null);

			if( 'custom-form' !== $formType || empty($strFieldsJson) ) {
				return $identityData;
			}

			$fieldsData = json_decode($strFieldsJson, true);

			$data = [];
			foreach($identityData as $itemId => $itemValue) {

				if( in_array($itemId, ['email', 'fullname', 'name', 'family', 'displayName']) ) {
					$data[$itemId] = $itemValue;
					continue;
				}

				foreach($fieldsData as $fieldData) {

					if( $fieldData['fieldOptions']['id'] !== $itemId ) {
						continue;
					}
					$label = $fieldData['serviceOptions']['label'];

					if( empty($label) ) {
						continue 2;
					}
					$data['{' . $label . '}'] = $itemValue;
					continue 2;
				}

				$data[$itemId] = $itemValue;
			}

			return $data;
		}

		/**
		 * Returns true if the user identity data is verified.
		 */
		public function verifyUserData($identityData, $serviceData)
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

					$token = $this->getValue($serviceData['visitorId'], 'twitter_token');
					$secret = $this->getValue($serviceData['visitorId'], 'twitter_secret');

					if( empty($token) || empty($secret) ) {
						return false;
					}

					$options = Module::getConnectOptions('twitter');

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