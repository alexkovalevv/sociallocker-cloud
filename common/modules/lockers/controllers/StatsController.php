<?php
	/**
	 * Контроллер управляет статистикой
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\controllers;

	use Yii;
	use yii\web\Controller;

	use common\modules\lockers\models\stats\StatUnlocksSearch;

	class StatsController extends Controller {

		public function actionEvents()
		{
			$serach_model = new StatUnlocksSearch();
			$data_provider = $serach_model->search([]);

			return $this->render('events', [
				'data_provider' => $data_provider
			]);
		}
	}
