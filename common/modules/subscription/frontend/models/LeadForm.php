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
	use common\modules\subscription\common\classes\SubscriptionTools;
	use common\modules\subscription\common\models\LeadsRecord;

	class LeadForm extends Model {

		private $_extract_data = false;

		public $context_data;
		public $identity_data;
		public $email_confirmed;
		public $subscription_confirmed;
		public $temp;
		public $error;

		// извлеченный данные для валидации
		public $locker_id;
		public $locker_title;
		public $user_id;
		public $site_id;
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
						'locker_id',
						'source',
						'email',
						'display_name',
						'first_name',
						'last_name',
						'profile_url'
					],
					'required'
				],
				[['source', 'display_name', 'first_name', 'last_name'], 'string', 'max' => 60],
				[['page_title'], 'string'],
				['locker_id', 'filter', 'filter' => "intval"],
				[['profile_url', 'page_url'], 'url'],
				[['email'], 'email'],
				[['email_confirmed'], 'default', 'value' => LeadsRecord::EMAIL_NOTCONFIRMED],
				[['subscription_confirmed'], 'default', 'value' => LeadsRecord::SUBSCRIPTION_NOTCONFIRMED],
				[
					['social', 'email_confirmed', 'subscription_confirmed'],
					'filter',
					'filter' => "intval"
				],
				[['email_confirmed', 'subscription_confirmed', 'locker_id', 'user_id', 'site_id'], 'integer'],
				[['temp'], 'default', 'value' => null]
			];
		}

		public function extractData($validate = false)
		{
			$subscription_tools = new SubscriptionTools();

			$context_data = $subscription_tools->normilizeValues($this->context_data);
			$identity_data = $subscription_tools->normilizeValues($this->identity_data);

			// prepares data received from custom fields to be transferred to the mailing service
			$identity_data = $subscription_tools->prepareDataToSave(null, null, $identity_data);

			$this->setAttributes($identity_data);
			$this->setAttributes($context_data);

			if( $validate && !$this->validate() ) {
				return false;
			}

			$this->_extract_data = true;

			return $this->_extract_data;
		}

		/**
		 * @param array $identity_data
		 * @param array $context_data
		 * @param bool $email_confirmed
		 * @param bool $subscription_confirmed
		 * @param null $temp
		 * @return bool
		 * @throws Exception
		 * @throws InvalidConfigException
		 */
		public static function setModel(array $identity_data = [], array $context_data = [], $email_confirmed = false, $subscription_confirmed = false, $temp = null)
		{
			$model = new self;

			$model->context_data = $context_data;
			$model->identity_data = $identity_data;
			$model->email_confirmed = $email_confirmed;
			$model->subscription_confirmed = $subscription_confirmed;
			$model->temp = $temp;

			return $model->save(true);
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
			if( !$this->_extract_data ) {
				$this->extractData();
			}

			if( $validate && !$this->validate() ) {
				$this->error = [
					'error' => 'Ошибка при валидации данных модели',
					'detalied' => $this->getErrors()
				];

				return false;
			}

			try {

				$leads_model = LeadsRecord::create($this->user_id, $this->site_id);

				$lead = $leads_model->getByEmail($this->email);

				if( !empty($lead) ) {
					$leads_model = $leads_model->setModel($lead);
				}

				$leads_model->identity_data = $this->identity_data;
				$leads_model->context_data = $this->context_data;

				$leads_model->attributes = $this->attributes;

				$leads_model->email_confirmed = $this->social
					? LeadsRecord::EMAIL_CONFIRMED
					: LeadsRecord::EMAIL_NOTCONFIRMED;

				// creating subscription service
				$result = $leads_model->leadSave(true, $leads_model);

				if( $result ) {
					return $result;
				} else {
					$this->error = [
						'error' => 'Не удалось создать лид из-за ошибки',
						'detalied' => $leads_model->getErrors()
					];

					return false;
				}
			} catch( Exception $ex ) {
				$this->error = ['error' => $ex->getMessage()];

				return false;
			}
		}
	}