<?php
	$config = [
		'homeUrl' => Yii::getAlias('@backendUrl'),
		'controllerNamespace' => 'backend\controllers',
		'defaultRoute' => 'timeline-event/index',
		'controllerMap' => [
			'file-manager-elfinder' => [
				'class' => 'mihaildev\elfinder\Controller',
				'access' => ['manager'],
				'disabledCommands' => ['netmount'],
				'roots' => [
					[
						'baseUrl' => '@storageUrl',
						'basePath' => '@storage',
						'path' => '/',
						'access' => ['read' => 'manager', 'write' => 'manager']
					]
				]
			]
		],
		'components' => [
			'errorHandler' => [
				'errorAction' => 'site/error',
			],
			'request' => [
				'baseUrl' => '/admin',
				'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY')
			],
			'user' => [
				'class' => 'yii\web\User',
				'identityClass' => 'common\models\User',
				'loginUrl' => ['sign-in/login'],
				'enableAutoLogin' => true,
				'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
			],
			'settings' => [
				'class' => 'backend\components\Settings'
			],
			'lockers' => [
				'class' => 'backend\components\Lockers'
			],
			'subscription' => [
				'class' => 'backend\components\Subscription'
			],
			'userSites' => [
				'class' => 'common\modules\sites\components\UserSites'
			]
			/*'settings' => [
				'class' => 'common\components\Settings'
			]*/
		],
		'modules' => [
			'i18n' => [
				'class' => 'backend\modules\i18n\Module',
				'defaultRoute' => 'i18n-message/index'
			],
			'subscription' => [
				'class' => 'common\modules\subscription\Module'
			],
			'lockers' => [
				'class' => 'common\modules\lockers\Module'
			],
			'signin' => [
				'class' => 'common\modules\signin\Module'
			],
			'sites' => [
				'class' => 'common\modules\sites\Module'
			]
		],
		'as globalAccess' => [
			'class' => '\common\behaviors\GlobalAccessBehavior',
			'rules' => [
				[
					'controllers' => ['sign-in'],
					'allow' => true,
					'roles' => ['?'],
					'actions' => ['login']
				],
				[
					'controllers' => ['sign-in'],
					'allow' => true,
					'roles' => ['@'],
					'actions' => ['logout']
				],
				[
					'controllers' => ['site'],
					'allow' => true,
					'roles' => ['?', '@'],
					'actions' => ['error']
				],
				[
					'controllers' => ['debug/default'],
					'allow' => true,
					'roles' => ['?'],
				],
				[
					'controllers' => ['user'],
					'allow' => true,
					'roles' => ['administrator'],
				],
				[
					'controllers' => ['user'],
					'allow' => false,
				],
				[
					'allow' => true,
					'roles' => ['manager'],
				]
			]
		]
	];

	if( YII_ENV_DEV ) {
		$config['modules']['gii'] = [
			'class' => 'yii\gii\Module',
			'generators' => [
				'crud' => [
					'class' => 'yii\gii\generators\crud\Generator',
					'templates' => [
						'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates')
					],
					'template' => 'yii2-starter-kit',
					'messageCategory' => 'backend'
				]
			]
		];
	}

	return $config;
