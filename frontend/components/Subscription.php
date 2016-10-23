<?php
	/**
	 * Предоставляет возможность получить настройки виджетов.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace frontend\components;

	use yii;
	use common\modules\subscription\common\components\SubscriptionComponent;
	use yii\base\InvalidConfigException;

	class Subscription extends SubscriptionComponent {

		/**
		 * Возвращает заголовок текущего сервиса подписки.
		 * @param int $user_id идентификатор пользователя
		 * @return null|string
		 */
		public function getCurrentServiceTitle($user_id)
		{
			$info = $this->getCurrentServiceInfo($user_id);

			return !empty($info)
				? $info['title']
				: null;
		}

		/**
		 * Возвращает информацию о текущем сервисе рассылок
		 * @param int $user_id идентификатор пользователя
		 * @return array|null
		 */
		public function getCurrentServiceInfo($user_id)
		{
			return parent::getServiceInfo($user_id);
		}

		/**
		 * /**
		 * Возвращает экземляр класса текущего выбраного сервиса
		 * @param int $user_id идентификатор пользователя
		 * @return null|object
		 */
		public function getCurrentService($user_id)
		{
			return parent::getService($user_id);
		}


		/**
		 * Получает экземпляр класса сервиса рассылки по егому имени
		 * @param int $user_id идентификатор пользователя
		 * @param $service_name
		 * @return null|object
		 */
		public function getServiceByName($user_id, $service_name)
		{
			return parent::getService($user_id, $service_name);
		}

		/**
		 * Возвращает доступные режимы проверки для сервисов подписки
		 * @param int $user_id идентификатор пользователя
		 * @param bool $to_list
		 * @return array
		 */
		public function getCurrentOptinModes($user_id, $to_list = false)
		{
			return parent::getCurrentModes($user_id, $to_list);
		}

		/**
		 * Получает настройки для сервиса рассылок
		 * @param $user_id
		 * @return array
		 */
		public function getServiceSettings($user_id)
		{
			return Yii::$app->settings->getUserOptions($user_id, 'general');
		}

		/**
		 * Получает имя текущего сервиса рассылок
		 * @param null $user_id
		 * @return string
		 */
		public function getCurrentServiceName($user_id)
		{
			return Yii::$app->settings->getUserOption($user_id, 'subscription_to_service', 'database');
		}
	}

