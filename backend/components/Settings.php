<?php
	/**
	 * Предоставляет возможность получить настройки виджетов.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace backend\components;

	use yii;
	use common\components\SettingsComponent;

	class Settings extends SettingsComponent {

		/**
		 * @param string $key название опции
		 * @param string|null $default
		 * @param bool $cache
		 * @return mixed|null
		 * @see get common\components\SettingsComponent
		 */
		public function getUserOption($key, $default = null, $cache = true, $cachingDuration = false)
		{
			// @TODO Найти более красивое решение с наследованием
			return parent::get(Yii::$app->user->getId(), 'general', $key, $default, $cache, $cachingDuration);
		}

		/**
		 * Получает все настройки пользователя
		 * @param $section
		 * @return array|null
		 * @see getAll common\components\SettingsComponent
		 */
		public function getUserOptions($section)
		{
			return parent::getAll(Yii::$app->user->getId(), $section);
		}

		/**
		 * Получает все настройки пользователя
		 * @param $section
		 * @return array|null
		 * @see getSection common\components\SettingsComponent
		 */
		public function getModelBySection($section)
		{
			return parent::getSection(Yii::$app->user->getId(), $section);
		}

		/**
		 * @param $section
		 * @param array $data
		 * @return bool
		 * @see update common\components\SettingsComponent
		 */
		public function updateModel($section, array $data)
		{
			return parent::update(Yii::$app->user->getId(), $section, $data);
		}
	}
