<?php
	/**
	 * Предоставляет возможность получить настройки замка по ключу и id или все сразу.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\components;

	use common\components\SettingsComponent;
	use yii;
	use yii\base\Component;
	use yii\caching\DbDependency;
	use yii\helpers\ArrayHelper;
	use common\modules\lockers\models\lockers\Lockers;

	class LockersComponent extends Component {

		/**
		 * @var string префикс
		 */
		public $cachePrefix = '_locker';

		/**
		 * @var int время хранения кеша
		 */
		public $cachingDuration = 300;

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
						foreach(json_decode($model->options, true) as $name => $val) {
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
					$model_value = json_decode($model->options, true);
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
		 * Получает все модели замков
		 * @param array $filters условия получения
		 * @param bool $all если, true получает замки независимо от сайта
		 * @param bool $counter если, true возвращает не модель, а счетчик
		 * @return mixed|null common\modules\lockers\models\lockers
		 * @throws \Exception
		 */
		public function getModels(array $filters, $all = false, $counter = false)
		{
			$db = Yii::$app->db;
			$dep = new DbDependency();

			if( !(isset($filters['id']) || isset($filters['site_id'])) && (!isset($filters['user_id']) || empty($filters['user_id'])) ) {
				$filters['user_id'] = Yii::$app->user->getId();

				if( empty($filters['user_id']) ) {
					return null;
				}

				$dep->sql = "SELECT MAX(updated_at) FROM widgets WHERE user_id = '{$filters['user_id']}'";
			} else if( isset($filters['id']) && !empty($filters['id']) ) {
				$all = false;
				$counter = false;
				$dep->sql = "SELECT MAX(updated_at) FROM widgets WHERE id = '{$filters['id']}'";
			} else if( isset($filters['site_id']) && !empty($filters['site_id']) ) {
				$dep->sql = "SELECT MAX(updated_at) FROM widgets WHERE site_id = '{$filters['site_id']}'";
			} else {
				return null;
			}

			$result = $db->cache(function ($db) use ($filters, $all, $counter) {

				if( !isset($filters['id']) && !$all && !isset($filters['site_id']) || empty($filters['site_id']) ) {
					$filters['site_id'] = Yii::$app->userSites->getSelectedId();
				}

				if( isset($filters['id']) || empty($filters['site_id']) || $all ) {
					unset($filters['site_id']);
				}

				if( $counter ) {
					return Lockers::find()->where($filters)->count();
				}

				if( isset($filters['id']) ) {
					return Lockers::find()->where($filters)->one();
				}

				return Lockers::find()->where($filters)->all();
			}, $this->cachingDuration, $dep);

			return $result;
		}

		/**
		 * Получает счетчик всех замков по текущему выбранному сайту
		 * @param array $status статус замка: public, draft, trash
		 * @return mixed|null common\modules\lockers\models\lockers
		 */
		public function getCount($status)
		{
			return $this->getModels(['status' => $status], false, true);
		}

		/**
		 * Получает счетчик всех замков со всех сайтов
		 * @param string $status статус замка: public, draft, trash
		 * @return mixed|null common\modules\lockers\models\lockers
		 */
		public function getAllCounts($status)
		{
			return $this->getModels(['status' => $status], true, true);
		}

		/**
		 * Получает все модели замки независимо от сайта
		 * @param array $filters условия, по которым нужно получить модели
		 * @return mixed|null common\modules\lockers\models\lockers
		 */
		public function getAllLockers(array $filters = [])
		{
			return $this->getModels($filters, true);
		}

		/**
		 * Получает все модели замки текущего выбранного сайта
		 * @param array $filters условия, по которым нужно получить модели
		 * @return mixed|null common\modules\lockers\models\lockers
		 */
		public function getLockers(array $filters = [])
		{
			return $this->getModels($filters);
		}

		/**
		 * Получает модель замка
		 * @param integer $id
		 * @param integer $site_id
		 * @return mixed|null common\modules\lockers\models\lockers
		 */
		public function getLocker($id, $site_id = null)
		{
			$filters['id'] = $id;

			if( !empty($site_id) ) {
				$filters['site_id'] = $site_id;
			}

			return $this->getModels($filters);
		}

		/**
		 * Генерирует ключ кеш ключ
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
