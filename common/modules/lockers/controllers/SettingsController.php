<?php

	namespace common\modules\lockers\controllers;

	use Yii;
	use yii\web\Controller;
	use common\modules\lockers\models\settings\Settings;
	use common\modules\lockers\models\settings\SettingsForm;

	use common\modules\lockers\models\settings\forms\Social;
	use common\modules\lockers\models\settings\forms\Lock;
	use common\modules\lockers\models\settings\forms\Stat;
	use common\modules\lockers\models\settings\forms\Localization;
	use common\modules\lockers\models\settings\forms\Terms;
	use common\modules\subscription\models\SubscribeSetting;

	class SettingsController extends Controller {

		public function actionIndex()
		{
			$model = new SettingsForm([
				'models' => [
					'social' => new Social(),
					'lock' => new Lock(),
					'subscribe' => new SubscribeSetting(),
					'stat' => new Stat(),
					'localization' => new Localization(),
					'terms' => new Terms()
				]
			]);

			$setting_model = Yii::$app->lockersSettings->getModel();

			if( !empty($setting_model) ) {
				$model->setMultiModel($setting_model);
			}

			if( $model->load(Yii::$app->request->post()) && $model->saveMultiModel() ) {
				Yii::$app->session->setFlash('alert', [
					'body' => 'Настройки успешно обновлены!',
					'options' => ['class' => 'alert alert-success']
				]);

				return $this->refresh();
			}

			return $this->render('index', [
				'model' => $model
			]);
		}
	}
