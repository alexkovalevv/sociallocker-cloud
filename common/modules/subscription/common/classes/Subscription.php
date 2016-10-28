<?php
	namespace common\modules\subscription\common\classes;

	use yii\base\Exception;
	use yii\base\InvalidConfigException;

	abstract class Subscription {

		protected $settings = [];

		public $name;
		public $title;
		public $data;

		public $deliveryError;

		public function __construct($service_settings, $data = [])
		{
			if( empty($service_settings) ) {
				throw new InvalidConfigException('Не передан обязательный атрибут {service_settings}');
			}

			$this->data = $data;

			if( isset($data['name']) ) {
				$this->name = $data['name'];
			}
			if( isset($data['title']) ) {
				$this->title = $data['title'];
			}

			$require_settings = isset($data['require_settings'])
				? $data['require_settings']
				: [];

			foreach($require_settings as $attr) {
				if( !array_key_exists($attr, $service_settings) || empty($service_settings[$attr]) ) {
					throw new
					InvalidConfigException('Не установлен обязательный атрибут {' . $attr . '} настроек сервиса.');
				}

				$this->settings[$attr] = $service_settings[$attr];
			}
		}

		public function isEmail($email)
		{
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		public function hasSingleOptIn()
		{
			return in_array('quick', $this->data['modes']);
		}

		public abstract function getLists();

		public abstract function subscribe($list_id, $identity_data, $context_data, $double_optin, $verified);

		public abstract function check($list_id, $identity_data, $context_data);

		public abstract function getCustomFields($listId);

		public function prepareFieldValueToSave($mapOptions, $value)
		{
			return $value;
		}

		public function getNameFieldIds()
		{
			return [];
		}

		public function slugify($text, $separator = ' ')
		{
			// replace non letter or digits by -
			$text = preg_replace('~[^\\pL\d]+~u', $separator, $text);

			// trim
			$text = trim($text, '-');

			// transliterate
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

			// lowercase
			$text = strtolower($text);

			// remove unwanted characters
			$text = preg_replace('~[^-\w]+~', '', $text);

			if( empty($text) ) {
				return 'n-a';
			}

			return $text;
		}

		public function refine($identityData, $clearEmpty = false)
		{
			if( empty($identityData) ) {
				return $identityData;
			}

			unset($identityData['html']);
			unset($identityData['label']);
			unset($identityData['separator']);
			unset($identityData['firt_name']);
			unset($identityData['last_name']);
			unset($identityData['display_name']);
			unset($identityData['fullname']);

			if( $clearEmpty ) {
				foreach($identityData as $key => $value) {
					if( empty($value) ) {
						unset($identityData[$key]);
					}
				}
			}

			return $identityData;
		}
	}

	/**
	 * A subscription service exception.
	 */
	class SubscriptionException extends Exception {

		public function __construct($message)
		{
			parent::__construct($message, 0, null);
		}
	}