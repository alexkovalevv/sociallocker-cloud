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

		private function defaultAction($models, $section, $view_path)
		{
			$active_tab = key($models);

			$models = new SettingsForm([
				'models' => $models
			]);

			$settings_model = Yii::$app->settings->getModelBySection($section);

			$models->setMultiModel($settings_model);

			if( $models->load(Yii::$app->request->post()) ) {

				if( $models->saveMultiModel($section) ) {
					Yii::$app->session->setFlash('alert', [
						'body' => 'Настройки успешно обновлены.',
						'options' => ['class' => 'alert alert-success']
					]);

					return $this->refresh();
				}

				$errors = $models->getErrors();
				$count_errors = sizeof($errors);
				$models_with_errors = [];

				foreach($errors as $model => $val) {
					$models_with_errors[] = $model;
				}

				if( $count_errors > 1 ) {
					$active_tab = isset($models_with_errors[$count_errors - 1])
						? $models_with_errors[$count_errors - 1]
						: null;
				} else {
					$active_tab = isset($models_with_errors[0])
						? $models_with_errors[0]
						: null;
				}

				Yii::$app->session->setFlash('alert', [
					'body' => 'Настройки заполненны некорректно.',
					'options' => ['class' => 'alert alert-error']
				]);

				return $this->render('index', [
					'models' => $models,
					'view_path' => $view_path,
					'active_tab' => $active_tab
				]);
			}

			return $this->render('index', [
				'models' => $models,
				'view_path' => $view_path,
				'active_tab' => $active_tab
			]);
		}
	}