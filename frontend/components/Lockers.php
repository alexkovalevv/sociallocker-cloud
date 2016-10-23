<?php
	/**
	 * Предоставляет возможность получить настройки замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace frontend\components;

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
		public function getSetting($user_id, $key, $default = null, $cache = true, $cachingDuration = false)
		{
			return Yii::$app->settings->get($user_id, 'lockers', $key, $default, $cache, $cachingDuration);
		}

		/**
		 * @return mixed
		 * @see getAll common\components\SettingsComponent
		 */
		public function getSettings($user_id)
		{
			return Yii::$app->settings->getAll($user_id, 'lockers');
		}

		/**
		 * Получает текст политики конфиденциальности
		 * @return mixed
		 */
		public function getPolice($user_id)
		{
			return Yii::$app->settings->getUserOption($user_id, 'privacy_policy_text');
		}

		/**
		 * Получает условия использования
		 * @return mixed
		 */
		public function getTerms($user_id)
		{
			return Yii::$app->settings->getUserOption($user_id, 'terms_of_use_text');
		}

		/**
		 * Получает имя текущего сервиса подписки
		 * @return mixed
		 */
		public function getCurrentSubscriptionServiceName($user_id)
		{
			return Yii::$app->settings->getUserOption($user_id, 'subscription_to_service', 'none');
		}
	}
