<?php
	/**
	 * Класс для работы записи и получения данными лидов
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @package subscription
	 */

	namespace common\modules\subscription\common\models;

	use Yii;
	use yii\base\InvalidConfigException;
	use yii\behaviors\TimestampBehavior;
	use yii\data\ActiveDataProvider;

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

		public $identity_data;

		public function behaviors()
		{
			return [
				TimestampBehavior::className(),
			];
		}

		public static function tableName()
		{
			return '{{%subscription_leads}}';
		}

		public function rules()
		{
			return [
				[['email', 'user_id', 'site_id', 'locker_id', 'page_url',], 'required'],
				[['email'], 'email'],
				[['email'], 'string', 'max' => 90],
				[['email_confirmed', 'subscription_confirmed', 'locker_id', 'user_id', 'site_id'], 'integer'],
				[
					'temp',
					'filter',
					'filter' => function ($array) {
						if( !is_array($array) ) {
							return $array;
						}

						return @json_encode($array);
					}
				],
				[['temp', 'page_url', 'locker_title'], 'string'],
				['page_url', 'url'],
				[['display_name', 'page_title'], 'string', 'max' => 255],
				[['first_name', 'last_name'], 'string', 'max' => 100],
				[['confirmation_code'], 'string', 'max' => 32],
			];
		}

		/**
		 * @return $this
		 */
		public function modelCreate()
		{
			return $this;
		}

		/**
		 * Получает модель лида
		 * @param int $lead_id идентификатор лида
		 * @return array|null|\yii\db\ActiveRecord
		 */

		public function getLead($lead_id)
		{
			if( empty($lead_id) ) {
				return null;
			}

			return self::findOne($lead_id);
		}

		/**
		 * Получает модель лида по атрибуту email
		 * @param $email
		 * @return object yii\db\ActiveRecord
		 */
		public function getLeadByEmail($email)
		{
			if( empty($this->user_id) ) {
				throw new InvalidConfigException("Не передан обязательный атрибут user_id");
			}

			if( empty($email) ) {
				return null;
			}

			$conditions['email'] = $email;
			$conditions['user_id'] = $this->user_id;

			$result = self::findOne($conditions);

			return $result;
		}

		/**
		 * Получает все модели лидов
		 * @param $email
		 * @return object yii\db\ActiveRecord
		 */
		public function getLeads(array $conditions = [])
		{
			if( !empty($this->user_id) ) {
				$conditions['user_id'] = $this->user_id;
			}

			if( !empty($this->site_id) ) {
				$conditions['site_id'] = $this->site_id;
			}

			return self::findAll($conditions);
		}

		/**
		 *
		 * Формирует запрос на получение моделей
		 * @param array $conditions
		 * @return ActiveDataProvider
		 */
		public function searchLeads(array $conditions = [])
		{

			if( !empty($this->user_id) ) {
				$conditions['user_id'] = $this->user_id;
			}

			if( !empty($this->site_id) ) {
				$conditions['site_id'] = $this->site_id;
			}

			$query = self::find()->where($conditions);

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			return $dataProvider;
		}

		/**
		 * Получает общее число лидов
		 * @param $user_id
		 * @param $site_id
		 * @return int|null
		 */
		public function getCountLeads()
		{
			$data_provider = $this->searchLeads();

			return $data_provider->getTotalCount();
		}

		/**
		 * Сохраняет лид в базу данных
		 * @param bool $validate
		 * @param object $model \yii\db\ActiveRecord
		 * @return bool|int|null
		 */
		public function leadSave($validate = false)
		{
			if( $validate && !$this->validate() ) {
				return false;
			}

			if( empty($this->display_name) ) {
				if( !empty($this->first_name) && !empty($this->last_name) ) {
					$this->display_name = $this->first_name . ' ' . $this->last_name;
				} elseif( !empty($this->first_name) ) {
					$this->display_name = $this->first_name;
				} elseif( !empty($this->last_name) ) {
					$this->display_name = $this->last_name;
				} else {
					$this->display_name = "";
				}
			}

			if( !$this->save() ) {
				return false;
			}

			// saving extra fields
			$fields = [];

			foreach($this->identity_data as $item_name => $item_value) {
				if( in_array($item_name, ['email', 'first_name', 'last_name', 'display_name']) ) {
					continue;
				}

				$fields[trim($item_name, '{}')] = [
					'value' => $item_value,
					'custom' => (strpos($item_name, '{') === 0)
						? 1
						: 0
				];
			}

			if( !empty($fields) ) {
				$leads_fields_model = new LeadsFields();
				if( $model = $leads_fields_model->findOne($this->id) ) {
					$model->fields_value = json_encode($fields);
				} else {
					$leads_fields_model->lead_id = $this->id;
					$leads_fields_model->fields_value = json_encode($fields);
				}

				if( !$leads_fields_model->save(true) ) {
					return false;
				}
			}

			return $this->id;
		}

		/**
		 * @param object $model common\models\Leads
		 * @param $code
		 * @return bool
		 */
		/*public function setConfirmationCode($model, $code)
		{
			if( empty($model) ) {
				return false;
			}

			$model->lead_confirmation_code = $code;

			return $model->save(true);
		}*/
	}