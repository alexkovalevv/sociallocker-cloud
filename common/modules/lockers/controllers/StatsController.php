<?php
	/**
	 * Контроллер управляет статистикой
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\lockers\controllers;

	use Prophecy\Exception\Doubler\ClassNotFoundException;
	use Yii;
	use yii\base\UnknownClassException;
	use yii\helpers\ArrayHelper;
	use yii\helpers\HtmlPurifier;
	use yii\web\Controller;

	use common\modules\lockers\models\stats\search\StatUnlocksSearch;
	use yii\web\NotFoundHttpException;

	class StatsController extends Controller {

		/**
		 * @return mixed
		 */
		public function actionIndex()
		{
			$locker_type = isset($_GET['locker_type']) && !empty($_GET['locker_type'])
				? $_GET['locker_type']
				: 'sociallocker';

			$current_screen_name = isset($_GET['screen']) && !empty($_GET['screen'])
				? $_GET['screen']
				: 'summary';

			$date_start = Yii::$app->request->get('date_start');
			$date_end = Yii::$app->request->get('date_end');

			$hrsOffset = '+1 day';

			// by default shows a 30 days' range
			if( empty($date_end) || ($date_range_end = strtotime($date_end)) === false ) {
				$phpdate = getdate(strtotime($hrsOffset, time()));
				$date_range_end = mktime(0, 0, 0, $phpdate['mon'], $phpdate['mday'], $phpdate['year']);
			}

			if( empty($date_start) || ($date_range_start = strtotime($date_start)) === false ) {
				$date_range_start = strtotime("-1 month", $date_range_end);
			}

			if( !in_array($locker_type, Yii::$app->getModule('lockers')->params['lockers_collections']) ) {
				throw new NotFoundHttpException('Запрошена статистика по неизвестному типу замков!');
			}

			$screens_class_namespace = 'common\modules\lockers\advanced\stats\fields\\' . $locker_type;
			$screens = Yii::createObject($screens_class_namespace . '\Screens');

			if( empty($screens) ) {
				throw new UnknownClassException($screens_class_namespace . '\Screens не найден!');
			}

			$current_screen = $screens::getScreen($current_screen_name);
			$current_screen_class = ArrayHelper::getValue($current_screen, 'screenClsss', 'StatsScreen');

			$current_screen_class_namespace = 'common\modules\lockers\advanced\stats\\';

			$screen = Yii::createObject($current_screen_class_namespace . $current_screen_class, [
				[
					'chartClass' => $current_screen['chartClass'],
					'tableClass' => $current_screen['tableClass']
				]
			]);

			if( empty($screen) ) {
				throw new UnknownClassException($current_screen_class_namespace . $current_screen_class . ' не найден!');
			}

			$params = Yii::$app->request->queryParams;
			$params['date_start'] = $date_range_start;
			$params['date_end'] = $date_range_end;

			$chart = $screen->getChart($params);
			$table = $screen->getTable($params);

			$table_css_class = '';

			if( $table->getColumnsCount() > 8 ) {
				$table_css_class .= ' opanda-concise-table';
			} else {
				$table_css_class .= ' opanda-free-table';
			}

			return $this->render('charts/index', [
				'locker_type' => $locker_type,
				'chart' => $chart,
				'screens' => $screens::getScreens(),
				'currentScreen' => $current_screen,
				'current_screen_name' => $current_screen_name,
				'table' => $table,
				'table_css_class' => $table_css_class,
				'date_start' => $date_range_start,
				'date_end' => $date_range_end
			]);
		}

		public function actionEvents()
		{
			$this->layout = '@backend/views/layouts/common';

			$searchModel = new StatUnlocksSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->sort = [
				'defaultOrder' => ['created_at' => SORT_DESC]
			];

			return $this->render('events/index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
	}
