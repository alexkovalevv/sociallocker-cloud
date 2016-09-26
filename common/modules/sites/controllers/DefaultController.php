<?php
	/**
	 * Контролер управляет созданием, изменением сайтов пользователей
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\sites\controllers;

	use League\Flysystem\Exception;
	use Yii;
	use common\modules\sites\models\Sites;
	use common\modules\sites\models\SitesSearche;
	use common\modules\sites\models\SitesForm;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\RequestException;

	/**
	 * DefaultController implements the CRUD actions for Sites model.
	 */
	class DefaultController extends Controller {

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

		/**
		 * Lists all Sites models.
		 * @return mixed
		 */
		public function actionIndex()
		{
			$searchModel = new SitesSearche();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		/**
		 * Displays a single Sites model.
		 * @param integer $id
		 * @return mixed
		 */
		public function actionView($id)
		{
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}

		/**
		 * Creates a new Sites model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate()
		{
			$model = new SitesForm();

			if( $model->load(Yii::$app->request->post()) ) {
				$result = $model->save(true);

				if( !empty($result) && $result->status === SitesForm::STATUS_DEACTIVE ) {
					return $this->render('create-step2', [
						'model' => $result,
					]);
				}
			}

			return $this->render('create-step1', [
				'model' => $model,
			]);
		}

		public function actionSiteVerify($site_id)
		{
			$model = $this->findModel($site_id);

			if( !empty($model) ) {
				// запрос на проверку данных
				if( !empty($model->url) && filter_var($model->url, FILTER_VALIDATE_URL) ) {
					$client = new Client();
					$result = $client->request('GET', $model->url);
					$body = $result->getBody();

					$get_title_regex = '/<title[^>]*>(.*?)<\/title>/si';
					$check_inject_regex = '/<head[^>]*>.*?(\/\/cdn\.sociallocker\.ru\/service\/loader.js).*<\/head>/si';

					// Вытягиваем заголов из проверяемой страницы
					if( preg_match_all($get_title_regex, $body, $finds) ) {
						if( isset($finds[1]) && isset($finds[1][0]) ) {
							$model->title = $finds[1][0];
						}
					}

					// Проверяем наличие кода отслеживание на указанной странице
					if( preg_match_all($check_inject_regex, $body) ) {

						Sites::updateAll(['selected' => SitesForm::NOT_SELECTED], ['user_id' => Yii::$app->user->getId()]);

						$model->status = SitesForm::STATUS_ACTIVE;
						$model->selected = SitesForm::SELECTED;

						if( !$model->save() ) {
							throw new Exception('Неизветная ошибка при подтвреждении сайта');
						}

						return $this->render('create-step3', [
							'verify' => true,
							'model' => $model
						]);
					} else {

						if( !$model->save() ) {
							throw new Exception('Неизветная ошибка при подтвреждении сайта');
						}

						Yii::$app->session->setFlash('alert', [
							'body' => 'Мы не смогли найти код отслеживание на указанном вами сайте <b>' . $model->url . '</b> в пределах тегов head!
						    		   Пожалуйста, проверьте корректно ли вы установли код или обратитесь за помощью в службу поддержки.',
							'options' => ['class' => 'alert alert-danger']
						]);

						return $this->render('create-step2', [
							'model' => $model
						]);
					}
				} else {
					throw new Exception('Добавлен некорректный Url');
				}
			}
		}

		/**
		 * Updates an existing Sites model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id
		 * @return mixed
		 */
		public function actionUpdate($id)
		{
			$model = $this->findModel($id);

			if( $model->load(Yii::$app->request->post()) && $model->save() ) {
				$id = Yii::$app->db->getLastInsertID();

				return $this->redirect(['view', 'id' => $id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}

		/**
		 * Deletes an existing Sites model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 * @param integer $id
		 * @return mixed
		 */
		public function actionDelete($id)
		{
			$this->findModel($id)->delete();

			return $this->redirect(['index']);
		}

		/**
		 * Finds the Sites model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param integer $id
		 * @return Sites the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			if( ($model = Sites::findOne($id)) !== null ) {
				return $model;
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
		}
	}
