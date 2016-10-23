<?php
	/**
	 * Предоставляет возможность получить настройки замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace backend\components;

	use yii;
	use common\components\SettingsComponent;
	use common\modules\lockers\components\LockersComponent;

	class Lockers extends LockersComponent {

		/**
		 * @param $key
		 * @param null $default
		 * @param bool $cache
		 * @param bool $cachingDuration
		 * @return mixed
		 * @see get common\components\SettingsComponent
		 */
		public function getSetting($key, $default = null, $cache = true, $cachingDuration = false)
		{
			// @TODO принудительно добавить опцию $user_id если модуль lockers не будет разделен на бекенд и фронтенд
			return Yii::$app->settings->get(Yii::$app->user->getId(), 'lockers', $key, $default, $cache, $cachingDuration);
		}

		/**
		 * @return mixed
		 * @see getAll common\components\SettingsComponent
		 */
		public function getSettings()
		{
			return Yii::$app->settings->getAll(Yii::$app->user->getId(), 'lockers');
		}

		/**
		 * @param $data
		 * @return mixed
		 * @see update common\components\SettingsComponent
		 */
		public function updateSettings($data)
		{
			return Yii::$app->settings->update(Yii::$app->user->getId(), 'lockers', $data);
		}

		/**
		 * Получает текст политики конфиденциальности
		 * @return mixed
		 */
		public function getPolice()
		{
			return Yii::$app->settings->getUserOption('privacy_policy_text');
		}

		/**
		 * Получает условия использования
		 * @return mixed
		 */
		public function getTerms()
		{
			return Yii::$app->settings->getUserOption('terms_of_use_text');
		}

		/**
		 * Получает имя текущего сервиса подписки
		 * @return mixed
		 */
		public function getCurrentSubscriptionServiceName()
		{
			return Yii::$app->settings->getUserOption('subscription_to_service', 'none');
		}
	}
