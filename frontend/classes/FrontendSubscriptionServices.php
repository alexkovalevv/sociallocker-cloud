<?php
	namespace frontend\classes;

	use yii;
	use common\modules\subscription\common\classes\SubscriptionServices;
	use common\modules\subscription\common\classes\SubscriptionTools;
	use yii\base\InvalidConfigException;

	/**
	 * Класс для работы с сервисами подписки
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	class FrontendSubscriptionServices extends SubscriptionServices {

		public function __construct($user_id)
		{
			$service_settings = Yii::$app->settings->getUserOptions($user_id, 'general');
			parent::__construct($user_id, $service_settings);
		}
	}