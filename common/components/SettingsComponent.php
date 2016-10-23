<?php
	/**
	 * Предоставляет возможность получить настройки виджетов.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\components;

	use yii;
	use yii\base\Component;
	use yii\helpers\ArrayHelper;
	use yii\base\InvalidConfigException;
	use common\modules\lockers\models\lockers\Lockers;
	use common\models\SettingsRecord;

	class SettingsComponent extends Component {


		/**
		 * @var string префикс для ключа кеша
		 */
		public $cachePrefix = '_setting_component';

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
		 * @param int $user_id идентификатор пользователя
		 * @param string $key ключ настройки
		 * @param mixed $default значение, если опция не найдена
		 * @param bool $cache использовать кеш если true
		 * @param bool|int $cachingDuration время хранения кеша         *
		 * @return mixed|null
		 * @throws InvalidConfigException
		 */
		public function get($user_id, $section = 'general', $key, $default = null, $cache = true, $cachingDuration = false)
		{
			if( empty($user_id) || empty($section) || empty($key) ) {
				throw new InvalidConfigException('Не передан один из обязательных атрибутов (user_id, section, key)');
			}

			$setting = SettingsRecord::findOne(['user_id' => $user_id, 'section' => $section]);

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
		 * Получает все опции
		 * @param int $user_id идентификатор пользователя
		 * @param string $section секция настроек
		 * @return array|null
		 * @throws InvalidConfigException
		 */
		public function getAll($user_id, $section)
		{
			$model = $this->getSection($user_id, $section);

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

		/**
		 * Получает модель настроек замка
		 * @param int $model_id идентификатор модели
		 * @return null|static
		 */
		public function getModel($model_id)
		{
			if( empty($model_id) ) {
				throw new InvalidConfigException('Не передан атрибут model_id');
			}

			return SettingsRecord::findOne($model_id);
		}

		public function getSection($user_id, $section)
		{
			if( empty($user_id) || empty($section) ) {
				throw new InvalidConfigException('Не передан один из обязательных атрибутов (user_id, section)');
			}

			return SettingsRecord::findOne(['user_id' => $user_id, 'section' => $section]);
		}

		/**
		 * Устанавливает данные в модель настроек
		 * @param int $user_id
		 * @param string $section секция настроек
		 * @param array $data данные для заполнения модели
		 * @return bool
		 * @throws InvalidConfigException
		 */
		public function update($user_id, $section, array $data)
		{
			$model = $this->getSection($user_id, $section);

			if( empty($model) ) {
				$model = new SettingsRecord();

				$model->user_id = $user_id;
				$model->section = $section;
			}

			$model->value = json_encode($data);

			return $model->save(true);
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
