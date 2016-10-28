<?php
	/**
	 * Модель подписки пользователя
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\subscription\frontend\models;

	use Yii;
	use yii\base\InvalidConfigException;
	use yii\base\Model;
	use yii\db\Exception;
	use common\modules\subscription\common\models\Leads;
	use common\modules\subscription\common\classes\SubscriptionTools;
	use common\helpers\TextFormatTools;

	class LeadCorrector extends Model {

		const SCENARIO_SOCIAL = 'social';
		const SCENARIO_FORM = 'form';

		private $_temp;
		private $_locker;

		public $error;

		public $email_confirmed;
		public $subscription_confirmed;
		public $confirmation_code;

		// извлеченный данные для валидации
		public $page_url;
		public $page_title;
		public $source;
		public $email;
		public $display_name;
		public $first_name;
		public $last_name;
		public $profile_url;
		public $social;

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[
					[
						'context_data',
						'identity_data',
						'email',
						'page_url',
						'page_title'
					],
					'required'
				],
				[
					[
						'source',
						'display_name',
						'first_name',
						'last_name',
						'profile_url',
					],
					'required',
					'on' => self::SCENARIO_SOCIAL
				],
				['source', 'in', 'range' => Yii::$app->getModule('signin')->params['allow_services']],
				[['display_name', 'first_name', 'last_name'], 'string', 'max' => 60],
				[['page_title', 'confirmation_code'], 'string'],
				[['profile_url', 'page_url'], 'url'],
				[['email'], 'email'],
				// если подписка была через социальную сеть, то мы по умолчнию ставим метку, что email подтвержден
				[
					['email_confirmed'],
					'default',
					'value' => Leads::EMAIL_CONFIRMED,
					'on' => self::SCENARIO_SOCIAL
				],
				[
					['subscription_confirmed'],
					'default',
					'value' => Leads::SUBSCRIPTION_CONFIRMED,
					'on' => self::SCENARIO_SOCIAL
				],
				// если подписка была через форму, то мы по умолчнию ставим метку, что email не подтвержден
				[
					['email_confirmed'],
					'default',
					'value' => Leads::EMAIL_NOTCONFIRMED,
					'on' => self::SCENARIO_FORM
				],
				[
					['subscription_confirmed'],
					'default',
					'value' => Leads::SUBSCRIPTION_NOTCONFIRMED,
					'on' => self::SCENARIO_FORM
				],
				[['email_confirmed', 'subscription_confirmed'], 'integer'],
				[
					['social', 'context_data', 'identity_data'],
					'filter',
					'filter' => function ($value) {
						if( is_array($value) ) {
							return TextFormatTools::normilizeValues($value);
						}

						return TextFormatTools::normilizeValue($value);
					}
				],
				[
					'identity_data',
					'filter',
					'filter' => function ($value) {
						$subscription_tools = new SubscriptionTools();

						// prepares data received from custom fields to be transferred to the mailing service
						return $subscription_tools->prepareDataToSave(null, null, $value);
					}
				],
				['social', 'default', 'value' => false],
				[['locker_id', 'user_id', 'site_id', 'locker_title'], 'safe'],
				['temp', 'default', 'value' => $this->_temp]
			];
		}


		public function __set($name, $value)
		{
			if( in_array($name, ['identity_data', 'service_data', 'context_data']) ) {
				$this->_temp[$name] = $value;
				$this->setAttributes($value);

				return;
			};

			if( $name == 'user_id' || $name == 'site_id' || $name == 'locker_title' ) {
				return;
			}

			parent::__set($name, $value);
		}

		public function __get($name)
		{
			if( in_array($name, ['identity_data', 'service_data', 'context_data']) ) {
				if( !isset($this->_temp[$name]) ) {
					return null;
				}

				return $this->_temp[$name];
			};

			return parent::__get($name);
		}

		public function getTemp()
		{
			return !empty($this->_temp)
				? json_encode($this->_temp)
				: null;
		}

		public function beforeValidate()
		{

			if( $this->social === true ) {
				$this->scenario = self::SCENARIO_SOCIAL;
			} else {
				$this->scenario = self::SCENARIO_FORM;
			}

			return parent::beforeValidate();
		}

		public function setLocker_id($value)
		{
			if( empty($value) || !is_numeric($value) ) {
				return null;
			}

			$value = TextFormatTools::normilizeValue($value);

			if( !empty($value) ) {
				$locker = Yii::$app->locker->getLocker($value);

				if( empty($locker) ) {
					throw new \yii\base\Exception('Замка с locker_id {' . $this->locker_id . '} не существует!');
				}

				$this->_locker = $locker;
			}

			return $value;
		}

		public function getLocker_id()
		{
			return !empty($this->_locker)
				? $this->_locker->id
				: null;
		}

		public function getLocker_title()
		{
			return !empty($this->_locker)
				? $this->_locker->title
				: null;
		}

		public function getUser_id()
		{
			return !empty($this->_locker)
				? $this->_locker->user_id
				: null;
		}

		public function getSite_id()
		{
			return !empty($this->_locker)
				? $this->_locker->site_id
				: null;
		}


		public function getModel()
		{
			$leads_model = LeadsRecord::user($this->user_id, $this->site_id)->modelCreate();

			$lead = $leads_model->getLeadByEmail($this->email);

			if( !empty($lead) ) {
				return $lead;
			}

			return $leads_model;
		}

		/**
		 * Сохраняет лид
		 * @param bool $validate если true, метод будет использовать валидацию перед сохранением модели
		 * @return bool
		 * @throws Exception
		 * @throws InvalidConfigException
		 */
		public function save($validate = false)
		{

			if( $validate && !$this->validate() ) {
				return false;
			}

			$leads_model = $this->getModel();

			$leads_model->identity_data = $this->identity_data;
			$attr = $this->attributes;
			$leads_model->attributes = $attr;

			$leads_model->locker_id = $this->locker_id;
			$leads_model->locker_title = $this->locker_title;
			$leads_model->user_id = $this->user_id;
			$leads_model->site_id = $this->site_id;

			// creating subscription service
			$result = $leads_model->leadSave(true);

			if( !$result ) {
				return false;
			}

			return $result;
		}
	}