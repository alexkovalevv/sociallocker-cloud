<?php
	return [
		'class' => 'yii\web\UrlManager',
		'enablePrettyUrl' => true,
		'showScriptName' => false,
		'rules' => [

			// Pages
			['pattern' => 'page/<slug>', 'route' => 'page/view'],
			// Articles
			['pattern' => 'article/index', 'route' => 'article/index'],
			['pattern' => 'article/attachment-download', 'route' => 'article/attachment-download'],
			['pattern' => 'article/<slug>', 'route' => 'article/view'],
			['pattern' => 'api/<site_id:\d+>/get-options.js', 'route' => 'api/lockers/get-options'],
			['pattern' => 'api/connect/<handler>', 'route' => 'api/connect/index'],
			// Api
			['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
			['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],

			//['pattern' => '<module:signin>/<controller:connect>/<id:\d+>', 'route' => '<module>/<controller>/vk'],

		]
	];
