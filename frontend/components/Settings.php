<?php
	/**
	 * Предоставляет возможность получить настройки виджетов.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace frontend\components;

	use yii;
	use common\components\SettingsComponent;

	class Settings extends SettingsComponent {

		/**
		 * @param string $key название опции
		 * @param int $user_id
		 * @param string|null $default
		 * @param bool $cache
		 * @return mixed|null
		 * @see get common\components\SettingsComponent
		 */
		public function getUserOption($user_id, $key, $default = null, $cache = true, $cachingDuration = false)
		{
			return parent::get($user_id, 'general', $key, $default, $cache, $cachingDuration);
		}

		/**
		 * Получает все настройки пользователя
		 * @param int $user_id
		 * @param $section
		 * @return array|null
		 * @see getAll common\components\SettingsComponent
		 */
		public function getUserOptions($user_id, $section)
		{
			return parent::getAll($user_id, $section);
		}

		/**
		 * Получает все настройки пользователя
		 * @param int $user_id
		 * @param $section
		 * @return array|null
		 * @see getSection common\components\SettingsComponent
		 */
		public function getModelBySection($user_id, $section)
		{
			return parent::getSection($user_id, $section);
		}
	}

