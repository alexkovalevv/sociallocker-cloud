<?php
	/**
	 * Предоставляет возможность получить настройки замка по ключу и id или все сразу.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\components;

	use yii;
	use yii\base\Component;
	use yii\caching\DbDependency;
	use yii\helpers\ArrayHelper;
	use common\modules\lockers\models\lockers\Lockers;

	class Locker extends Component {

		/**
		 * @var string префикс
		 */
		public $cachePrefix = '_locker';
		/**
		 * @var int время хранения кеша
		 */
		public $cachingDuration = 60;

		/**
		 * @var array values временное хранилище настроек
		 */
		private $values = [];

		/**
		 * Получает опцию замка по ключу
		 *
		 * @param int $id
		 * @param string $key
		 * @param null $default
		 * @param bool $cache
		 * @param int|bool $cachingDuration
		 * @return mixed|null
		 */
		public function getOption($id, $key, $default = null, $cache = true, $cachingDuration = false)
		{
			if( $cache ) {
				$cacheKey = $this->getCacheKey($id . $key);
				$value = ArrayHelper::getValue($this->values, $id . $key, false)
					? : Yii::$app->cache->get($cacheKey);
				if( $value === false ) {
					if( $model = Lockers::findOne($id) ) {
						foreach(json_decode($model->options) as $name => $val) {
							$this->values[$id . $name] = $val;
							Yii::$app->cache->set($this->getCacheKey($id . $name), $val, $cachingDuration === false
								? $this->cachingDuration
								: $cachingDuration);
						}

						$value = isset($this->values[$id . $key])
							? $this->values[$id . $key]
							: $default;
					} else {
						$value = $default;
					}
				}
			} else {
				if( $model = Lockers::findOne($id) ) {
					$model_value = json_decode($model->options);
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
		 * Получает модель настроек замка
		 * @param array $condition может быть передано user_id или locker_id
		 * @return object|null
		 * @throws \Exception
		 */
		public function getModel($locker_id, $site_id = null)
		{
			$db = Yii::$app->db;
			$dep = new DbDependency();

			$dep->sql = "SELECT MAX(updated_at) FROM lockers WHERE id = '{$locker_id}'";

			$result = $db->cache(function ($db) use ($locker_id, $site_id) {
				$conditions = ['id' => $locker_id];

				if( !empty($site_id) ) {
					$conditions['site_id'] = $site_id;
				}

				return Lockers::find()->where($conditions)->one();
			}, 1800, $dep);

			return $result;
		}

		public function getLocker($id, $site_id = null)
		{
			return $this->getModel($id, $site_id);
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
