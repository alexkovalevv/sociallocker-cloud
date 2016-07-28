<?php

namespace backend\modules\lockers\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\lockers\models\settings\Settings;
use backend\modules\lockers\models\settings\SettingsForm;

use backend\modules\lockers\models\settings\forms\Social;
use backend\modules\lockers\models\settings\forms\Lock;
use backend\modules\lockers\models\settings\forms\Stat;
use backend\modules\lockers\models\settings\forms\Localization;
use backend\modules\lockers\models\settings\forms\Terms;
use common\modules\subscription\models\SubscribeSetting;


class SettingsController extends Controller
{
    public function actionIndex()
    {
	    $model = new SettingsForm( [
		    'models' => [
			    'social'       => new Social(),
			    'lock'         => new Lock(),
			    'subscribe'    => new SubscribeSetting(),
			    'stat'         => new Stat(),
			    'localization' => new Localization(),
			    'terms'        => new Terms()
		    ]
	    ] );

	    $model_query = new Settings();
	    $model_query_value = $model_query->getModel();

	    if( !empty( $model_query_value ) ) {
		    $model->setMultiModel( $model_query->getModel() );
	    }

	    if ($model->load(Yii::$app->request->post()) && $model->saveMultiModel($model_query->getModel()) ) {
		    Yii::$app->session->setFlash('alert', [
			    'body' => 'Настройки успешно обновлены!',
			    'options' => ['class' => 'alert alert-success']
		    ]);
		    return $this->refresh();
	    }

	    return $this->render('index', [
		    'model'=> $model
	    ]);
    }
}
