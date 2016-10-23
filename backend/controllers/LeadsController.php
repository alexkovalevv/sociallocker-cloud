<?php

	namespace backend\controllers;

	use Yii;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	use backend\models\BackendLeads;
	use backend\models\search\BackendLeadsSearch;
	use backend\models\LeadsExport;
	use common\modules\lockers\models\lockers\Lockers;

	class LeadsController extends Controller {

		/**
		 * @inheritdoc
		 */
		public function behaviors()
		{
			return [
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['POST'],
					],
				],
			];
		}

		/*public function getViewPath()
		{
			return realpath(__DIR__ . '/../views/leads');
		}*/

		public function actionIndex()
		{
			$searchModel = new BackendLeadsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		public function actionExport()
		{
			$model = new LeadsExport();

			$lockers_model = new Lockers();
			$lockers = $lockers_model->find()->where(['user_id' => Yii::$app->user->identity->id])->all();

			$channels = [];
			foreach($lockers as $locker) {
				$channels[$locker->id] = $locker->title;
			}

			if( $model->load(Yii::$app->request->post()) && $model->validate() ) {
				if( $model->format === 'csv' ) {
					return $this->exportCsv($model);
				}
			}

			return $this->render('export', [
				'model' => $model,
				'channels' => $channels
			]);
		}

		protected function exportCsv($model)
		{

			$errors = null;
			$warning = null;

			// - delimiter
			$delimiter = $model->delimiter;
			if( !in_array($delimiter, [',', ';']) ) {
				$delimiter = ',';
			}

			// - channels
			$lockers = $model->channels;
			$lockerIds = [];
			if( !empty($lockers) ) {
				foreach($lockers as $lockerId) {
					if( 'all' == $lockerId ) {
						continue;
					}
					$lockerIds[] = intval($lockerId);
				}
			} else {
				$errors .= "Пожалуйста, убедитесь, что вы выбрали хотя бы один канал из списка каналов.\n";
			}

			// - status
			$email_status = $model->email_status;

			if( !in_array($email_status, ['all', 'confirmed', 'not-confirmed']) ) {
				$email_status = 'all';
			}

			// - fields
			$rawFields = $model->fields;

			$fields = [];
			if( !empty($rawFields) ) {
				foreach($rawFields as $field) {

					if( !in_array($field, ['email', 'display_name', 'first_name', 'last_name']) ) {
						continue;
					}

					$fields[] = $field;
				}
			} else {
				$errors .= "Пожалуйста, убедитесь, что вы выбрали хотя бы одно поле для экспорта из списка полей.\n";
			}

			// - custom fields
			/*$rawCustomFields = $model->custom_fields;
				$selectedCustomFields = array();

				foreach ($rawCustomFields as $customField) {
					$selectedCustomFields[] = $customField;
				}*/

			if( empty($errors) ) {

				$leads_search_model = new LeadsSearch();
				$dataprovider = $leads_search_model->search([]);

				$leads = [];
				foreach($dataprovider->getModels() as $model) {
					$attributes = $model->getAttributes($fields);
					foreach($fields as $field)
						$leads[$model->id][$field] = $attributes[$field];
					//foreach( $selectedCustomFields as $field ) $leads[$id][$field] = null;

					/*if ( !empty( $item['field_name'] ) && in_array($item['field_name'], $selectedCustomFields) ) {
						$leads[$id][$item['field_name']] = $item['field_value'];
					}*/
				}

				if( empty($leads) ) {
					$warning = 'В базе данных не найдено ни одного подписчики по запрошенным вами параметрам.';
					$this->redirect(['export']);
					Yii::$app->session->setFlash('alert', [
						'body' => $errors,
						'options' => ['class' => 'alert alert-danger']
					]);
				} else {

					$filename = 'leads-' . date('Y-m-d-H-i-s') . '.csv';

					header("Content-Type: text/csv");
					header("Content-Disposition: attachment; filename=" . $filename);
					header("Cache-Control: no-cache, no-store, must-revalidate");
					header("Pragma: no-cache");
					header("Expires: 0");

					$output = fopen("php://output", "w");
					foreach($leads as $row) {
						fputcsv($output, $row, $delimiter);
					}
					fclose($output);

					exit;
				}
			} else {
				$this->redirect(['export']);
				Yii::$app->session->setFlash('alert', [
					'body' => $errors,
					'options' => ['class' => 'alert alert-danger']
				]);
			}
		}
	}
