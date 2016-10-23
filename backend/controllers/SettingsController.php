<?php
	/**
	 * Общий контроллер для панели управления
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace backend\controllers;

	use common\modules\lockers\models\settings\Localization;
	use common\modules\lockers\models\settings\Lock;
	use common\modules\lockers\models\settings\Social;
	use Yii;
	use yii\web\Controller;
	use backend\models\settings\General;
	use backend\models\settings\Stat;
	use backend\models\settings\Terms;
	use common\models\SettingsForm;
	use common\modules\subscription\backend\models\SubscribeSettingForm;

	class SettingsController extends Controller {

		public $title;

		public function actionGeneral()
		{
			$this->title = 'Общие настройки';

			return $this->defaultAction([
				'general' => new General(),
				'subscribe' => new SubscribeSettingForm(),
				'stat' => new Stat(),
				'terms' => new Terms()
			], 'general', [
				'general' => '@backend/views/settings/tabs',
				'subscribe' => '@subscription/backend/views',
				'stat' => '@backend/views/settings/tabs',
				'terms' => '@backend/views/settings/tabs'
			]);
		}

		public function actionLockers()
		{
			$this->title = 'Замки для контента';

			return $this->defaultAction([
				'social' => new Social(),
				'lock' => new Lock(),
				'localization' => new Localization()
			], 'lockers', '@lockers/views/settings');
		}

		public function defaultAction($models, $section, $view_path)
		{
			$models = new SettingsForm([
				'models' => $models
			]);

			$settings_model = Yii::$app->settings->getModelBySection($section);

			$models->setMultiModel($settings_model);

			if( $models->load(Yii::$app->request->post()) && $models->saveMultiModel($section) ) {
				Yii::$app->session->setFlash('alert', [
					'body' => 'Настройки успешно обновлены!',
					'options' => ['class' => 'alert alert-success']
				]);

				return $this->refresh();
			}

			return $this->render('index', [
				'models' => $models,
				'view_path' => $view_path
			]);
		}
	}