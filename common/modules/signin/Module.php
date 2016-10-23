<?php

	namespace common\modules\signin;

	use Yii;

	class Module extends \yii\base\Module {

		//public $controllerNamespace = 'common\modules\signin\controllers';

		public $params = [
			'allow_services' => ['vk', 'twitter', 'linkedin', 'lead', 'subscription']
		];

		public function init()
		{
			$this->params['handlers_path'] = 'common\modules\signin\handlers';

			$this->params['handlers_options'] = [
				'vk' => [
					'app_id' => '5337425',
					'app_secret' => 'Mb69K5lzeDBBuss0W9je',
					'proxy' => Yii::getAlias('@frontendUrl') . '/api/connect/vk'
				],
				'twitter' => [
					'consumer_key' => 'Fr5DrCse2hsNp5odQdJOexOOA',
					'consumer_secret' => 'jzNmDGYPZOGV10x2HmN8tYMDqnMTowycXFu4xTTLbw3VBVeFKm',
					'proxy' => Yii::getAlias('@frontendUrl') . '/api/connect/twitter'
				],
				'linkedin' => [
					'client_id' => "7774jogqfi9na8",
					'client_secret' => "jWq5ZjG7g3gYqwbn",
					'proxy' => Yii::getAlias('@frontendUrl') . '/api/connect/linkedin'
				]

			];

			parent::init();
		}
	}
