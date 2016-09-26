<?php

	namespace common\modules\signin;

	use Yii;

	class Module extends \yii\base\Module {

		public $controllerNamespace = 'common\modules\signin\controllers';

		public function init()
		{
			parent::init();
		}

		/**
		 * Returns the connect handler options.
		 *
		 * @since 1.0.0
		 */
		public static function getConnectOptions($handlerName)
		{

			switch( $handlerName ) {
				case 'vk':
					return [
						'app_id' => '5337425',
						'app_secret' => 'Mb69K5lzeDBBuss0W9je',
						'proxy' => Yii::getAlias('@proxyUrl') . '?opandaHandler=vk'
					];
				case 'twitter':
					$consumerKey = 'Fr5DrCse2hsNp5odQdJOexOOA';
					$consumerSecret = 'jzNmDGYPZOGV10x2HmN8tYMDqnMTowycXFu4xTTLbw3VBVeFKm';

					return [
						'consumer_key' => $consumerKey,
						'consumer_secret' => $consumerSecret,
						'proxy' => Yii::getAlias('@proxyUrl') . '?opandaHandler=twitter'
					];

				case 'linkedin':
					$clientId = "7774jogqfi9na8";
					$clientSecret = "jWq5ZjG7g3gYqwbn";

					return [
						'client_id' => $clientId,
						'client_secret' => $clientSecret,
						'proxy' => Yii::getAlias('@proxyUrl')
					];

				case 'subscription':
					return [
						'service' => Yii::$app->lockersSettings->getOne('subscription_to_service', 'database')
					];
			}
		}
	}
