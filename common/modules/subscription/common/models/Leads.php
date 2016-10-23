<?php
	/**
	 * Класс для работы с данными лидов
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\subscription\common\models;

	use yii\base\InvalidConfigException;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "leads".
	 *
	 * @property integer $id
	 * @property integer $user_id
	 * @property integer $site_id
	 * @property integer $locker_id
	 * @property string $display_name
	 * @property string $first_name
	 * @property string $last_name
	 * @property string $email
	 * @property integer $email_confirmed
	 * @property integer $subscription_confirmed
	 * @property string $page_title
	 * @property string $page_url
	 * @property string $confirmation_code
	 * @property string $temp
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class Leads extends \yii\db\ActiveRecord {

		const EMAIL_CONFIRMED = 2;
		const EMAIL_NOTCONFIRMED = 1;
		const SUBSCRIPTION_CONFIRMED = 2;
		const SUBSCRIPTION_NOTCONFIRMED = 1;

		// Настройка доступа к модели. Если true модель является безопасной для использования.
		private $create = false;

		//public $user_id;
		//public $site_id;

		public static function tableName()
		{
			return '{{%subscription_leads}}';
		}

		public function behaviors()
		{
			return [
				TimestampBehavior::className(),
			];
		}

		public function rules()
		{
			return [
				[['email', 'user_id', 'site_id'], 'required'],
				[['email'], 'email'],
				[['email'], 'string', 'max' => 90],
				[['email_confirmed', 'subscription_confirmed', 'locker_id', 'user_id', 'site_id'], 'integer'],
				[['temp', 'page_url', 'locker_title'], 'string'],
				[['display_name', 'page_title'], 'string', 'max' => 255],
				[['first_name', 'last_name'], 'string', 'max' => 100],
				[['confirmation_code'], 'string', 'max' => 32],
			];
		}

		/**
		 * Конструктор класса, его основная роль не допустить ошибок при сохранении
		 * и получении данных от установленного пользователя. Конструктор регламентирует, что
		 * при использовании, какого-либо метода этой модели, всегда будет установен атрибут user_id
		 * Пример работы с конструктором.
		 * $leads_model = Leads::create($user_id, $site_id);
		 * $leads_model->getAll();
		 *
		 * @param $user_id
		 * @param null $site_id
		 * @return static
		 * @throws InvalidConfigException
		 */

		public static function create($user_id = null, $site_id = null)
		{
			$model = new static;
			$model = static::beforeCreate($model, $user_id, $site_id);

			if( empty($model->user_id) ) {
				throw new InvalidConfigException('Не передан обязательный атрибут user_id');
			}

			$model->create = true;

			return $model;
		}

		public static function beforeCreate($model, $user_id = null, $site_id = null)
		{
			$model->user_id = $user_id;
			$model->site_id = $site_id;

			return $model;
		}


		/**
		 * Устанавливает существующую модель, делая ее безопасной для работы
		 * @param Leads $model
		 * @return object $this
		 */
		public function setModel(Leads $model)
		{
			$model->create = true;

			return $model;
		}

		public function checkAcess()
		{
			if( !$this->create ) {
				throw new InvalidConfigException('Экземляр класса должен быть создан через конструктор create');
			}
		}

		/**
		 * Получает модель лида
		 * @param $leadId
		 * @return array|null|\yii\db\ActiveRecord
		 */

		public function get($leadId)
		{
			if( empty($leadId) ) {
				return null;
			}

			$this->checkAcess();

			return $this->findOne($leadId);
		}

		/**
		 * Получает моделть лида
		 * @param $email
		 * @return object yii\db\ActiveRecord
		 */
		public function getByEmail($email)
		{
			if( empty($email) ) {
				return null;
			}

			$conditions['email'] = $email;

			$result = $this->setQuery($conditions)->one();

			return $result;
		}

		/**
		 * Получает все модели лидов
		 * @param $email
		 * @return object yii\db\ActiveRecord
		 */
		public function getAll(array $conditions = [])
		{
			return $this->setQuery($conditions)->all();
		}

		/**
		 *
		 * Формирует запрос на получение моделей
		 * @param array $conditions
		 * @return object yii\db\ActiveRecord
		 */
		protected function setQuery(array $conditions = [])
		{
			$this->checkAcess();

			$conditions['user_id'] = $this->user_id;

			if( !empty($this->site_id) ) {
				$conditions['site_id'] = $this->site_id;
			}

			return $this->find()->where($conditions);
		}

		/**
		 * Проверяем доступ к классу перед сохранением
		 * @return bool
		 * @throws InvalidConfigException
		 */
		public function beforeSave()
		{
			$this->checkAcess();

			return true;
		}
	}