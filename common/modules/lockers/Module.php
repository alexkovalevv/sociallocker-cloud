<?php

namespace common\modules\lockers;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\lockers\controllers';

	public $params = [
		'lockers_collections' => [
			'sociallocker',
		    'signinlocker',
		    'emaillocker'
		]
	];

    public function init()
    {
        parent::init();
    }
}
