<?php

namespace backend\modules\lockers;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\lockers\controllers';

    public function init()
    {
        parent::init();

	    Yii::setAlias('@lockers', dirname(__FILE__));

	    include_once(Yii::getAlias('@lockers/includes/helper-functions.php'));
    }
}
