<?php
	/**
	 * Предоставляет возможность работать с севисами рассылок.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace backend\components;

	use yii;
	use common\modules\subscription\common\components\SubscriptionComponent;

	class Subscription extends SubscriptionComponent {

		/**
		 * Возвращает заголовок текущего сервиса подписки.
		 * @return null|string
		 */
		public function getCurrentServiceTitle()
		{
			$info = $this->getCurrentServiceInfo(Yii::$app->user->getId());

			return !empty($info)
				? $info['title']
				: null;
		}

		/**
		 * Возвращает информацию о текущем сервисе рассылок
		 * @return array|null
		 */
		public function getCurrentServiceInfo()
		{
			return parent::getServiceInfo(Yii::$app->user->getId());
		}

		/**
		 * /**
		 * Возвращает экземляр класса текущего выбраного сервиса
		 * @return null|object
		 */
		public function getCurrentService()
		{
			return parent::getService(Yii::$app->user->getId());
		}

		/**
		 * Получает экземпляр класса сервиса рассылки по егому имени
		 * @param $service_name
		 * @return null|object
		 */
		public function getServiceByName($service_name)
		{
			return parent::getService(Yii::$app->user->getId(), $service_name);
		}

		/**
		 * Возвращает доступные режимы проверки для сервисов подписки
		 */
		public function getCurrentOptinModes($toList = false)
		{
			return parent::getCurrentModes(Yii::$app->user->getId(), $toList);
		}

		/**
		 * Получает имя текущего выбраного сервиса
		 * @return string
		 */
		public function getCurrentServiceName()
		{
			return Yii::$app->settings->getUserOption('subscription_to_service', 'database');
		}

		/**
		 * Получает имя текущего сервиса рассылок
		 * @return string
		 */
		public function getServiceSettings()
		{
			return Yii::$app->settings->getUserOptions('general');
		}
	}

