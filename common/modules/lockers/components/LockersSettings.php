<?php
	/**
	 * Предоставляет возможность получить настройки замка по ключу или все сразу.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\components;

	use common\modules\lockers\models\lockers\Lockers;
	use yii;
	use yii\base\Component;
	use yii\caching\DbDependency;
	use yii\helpers\ArrayHelper;
	use common\modules\lockers\models\settings\Settings;

	class LockersSettings extends Component {

		/**
		 * @var string префикс
		 */
		public $cachePrefix = '_lockersSetting';
		/**
		 * @var int время хранения кеша
		 */
		public $cachingDuration = 60;

		/**
		 * @var array values временное хранилище настроек
		 */
		private $values = [];

		/**
		 * Получает опцию настроек по ключу
		 * @param null $user_id
		 * @param $key
		 * @param null $default
		 * @param bool $cache
		 * @param bool $cachingDuration
		 * @return mixed|null
		 */
		public function get($user_id = null, $key, $default = null, $cache = true, $cachingDuration = false)
		{
			if( empty($user_id) ) {
				$user_id = Yii::$app->user->getId();
				if( empty($user_id) ) {
					return null;
				}
			}
			$setting = Settings::findOne(['user_id' => $user_id]);

			if( $cache ) {
				$cacheKey = $this->getCacheKey($key);
				$value = ArrayHelper::getValue($this->values, $key, false)
					? : Yii::$app->cache->get($cacheKey);
				if( $value === false ) {
					if( $setting ) {
						foreach(json_decode($setting->value) as $name => $val) {
							$this->values[$name] = $val;
							Yii::$app->cache->set($this->getCacheKey($name), $val, $cachingDuration === false
								? $this->cachingDuration
								: $cachingDuration);
						}

						$value = isset($this->values[$key])
							? $this->values[$key]
							: $default;
					} else {
						$value = $default;
					}
				}
			} else {
				if( $setting ) {
					$model_value = json_decode($setting->value);
					$value = isset($model_value[$key])
						? $model_value[$key]
						: $default;
				} else {
					$value = $default;
				}
			}

			return $value;
		}

		/**
		 * Получает одну опцию по ключу и условиям
		 * @param array $condition может быть передано user_id или locker_id
		 * @param string $key
		 * @return string|null
		 */
		public function getOne($key, $default = null, array $condition = [])
		{
			$user_id = null;

			if( sizeof($condition) ) {

				if( isset($condition['user_id']) ) {
					$user_id = $condition['user_id'];
				}

				if( isset($condition['locker_id']) ) {
					$lockers_model = Lockers::getLocker($condition['locker_id']);

					if( empty($lockers_model) ) {
						return null;
					}

					$user_id = $lockers_model->user_id;
				}

				return $this->get($user_id, $key, $default);
			}

			return $this->get(null, $key, $default);
		}

		/**
		 * Получает модель настроек замка
		 * @param array $condition может быть передано user_id или locker_id
		 * @return object|null
		 * @throws \Exception
		 */
		public function getModel(array $condition = [])
		{
			$user_id = null;

			if( sizeof($condition) ) {

				if( isset($condition['user_id']) ) {
					$user_id = $condition['user_id'];
				}

				if( isset($condition['locker_id']) ) {
					$lockers_model = Lockers::getLocker($condition['locker_id']);

					if( empty($lockers_model) ) {
						return null;
					}

					$user_id = $lockers_model->user_id;
				}
			}

			if( empty($user_id) ) {
				$user_id = Yii::$app->user->getId();
				if( empty($user_id) ) {
					return null;
				}
			}

			$db = Yii::$app->db;
			$dep = new DbDependency();
			$dep->sql = "SELECT MAX(updated_at) FROM lockers_settings WHERE user_id = '{$user_id}'";
			$result = $db->cache(function ($db) use ($user_id) {
				return Settings::findOne(['user_id' => $user_id]);
			}, 1800, $dep);

			return $result;
		}

		/**
		 * Устанавливает данные в модель настроек
		 * @param array $data массив настроек
		 * @return bool
		 */
		public function setModel(array $data)
		{
			$model = $this->getModel();

			if( empty($model) ) {
				$model = new Settings();
			}

			$model->user_id = Yii::$app->user->getId();
			$model->value = json_encode($data);

			return $model->save(true);
		}

		public function getAll(array $condition = [])
		{
			$model = $this->getModel($condition);
			if( empty($model) || empty($model->value) ) {
				return null;
			}

			if( !empty($this->values) ) {
				return $this->values;
			}

			$settings = json_decode($model->value, true);
			foreach($settings as $key => $value) {
				$this->values[$key] = $value;
			}

			return $this->values;
		}

		/*public static function getOptions($user_id = null, $encode = false)
		{
			$model = self::getModel($user_id);
			if( empty($model->value) ) {
				return null;
			}

			return $encode
				? Json::htmlEncode($model->value)
				: Json::decode($model->value);
		}*/

		/**
		 * @param array $keys
		 * @return array
		 */
		/*public function getAll(array $keys)
		{
			$values = [];
			foreach($keys as $key) {
				$values[$key] = $this->get($key);
			}

			return $values;
		}*/

		/**
		 * @param $key
		 * @param bool $cache
		 * @return bool
		 */
		public function has($key, $cache = true)
		{
			return $this->get($key, null, $cache) !== null;
		}

		/**
		 * @param array $keys
		 * @return bool
		 */
		public function hasAll(array $keys)
		{
			foreach($keys as $key) {
				if( !$this->has($key) ) {
					return false;
				}
			}

			return true;
		}

		/**
		 * @param $key
		 * @return array
		 */
		protected function getCacheKey($key)
		{
			return [
				__CLASS__,
				$this->cachePrefix,
				$key
			];
		}
	}
