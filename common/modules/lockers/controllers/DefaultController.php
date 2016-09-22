<?php
	/**
	 * Контроллер манипулирует замками.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\controllers;

	use common\modules\lockers\models\lockers\metaboxes\EmailFormSettings;
	use common\modules\lockers\models\visability\EditConditions;
	use common\modules\lockers\widgets\conditionEditor\ConditionEditor;
	use Yii;
	use yii\helpers\Url;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	use common\modules\lockers\models\lockers\LockersForm;
	use common\modules\lockers\models\lockers\Lockers;
	use common\modules\lockers\models\search\LockersSearch;
	use common\modules\lockers\models\settings\Settings;

	use common\modules\lockers\models\lockers\metaboxes\AdvancedMetabox;
	use common\modules\lockers\models\lockers\metaboxes\BasicMetabox;
	use common\modules\lockers\models\lockers\metaboxes\SaveLockerMetabox;
	use common\modules\lockers\models\lockers\metaboxes\SocialButtonsSettings;
	use common\modules\lockers\models\lockers\metaboxes\SubscribeMetabox;
	use common\modules\lockers\models\lockers\metaboxes\VisabilityMetabox;
	use common\modules\lockers\models\lockers\metaboxes\SigninButtonsSettings;

	class DefaultController extends Controller {

		/**
		 * @return mixed
		 */
		public function actionIndex()
		{
			$searchModel = new LockersSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		public function actionDraft()
		{
			$searchModel = new LockersSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'draft');

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		public function actionTrash()
		{
			$searchModel = new LockersSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'trash');

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		public function actionChangeLocker()
		{
			return $this->render('change');
		}

		public function actionCreate($type)
		{
			if( empty($type) ) {
				return $this->redirect(['index']);
			}

			if( !in_array($type, ['sociallocker', 'signinlocker', 'emaillocker']) ) {
				return $this->redirect(['index']);
			}

			$model = $this->initMultimodel($type);

			// Создаем черновик
			if( $model->saveMultiModel($type, null, true) ) {
				$locker_id = Yii::$app->db->getLastInsertID();

				return $this->redirect(['default/edit?type=' . $type . '&id=' . $locker_id]);
			} else {
				Yii::$app->session->setFlash('alert', [
					'body' => 'Возникла не известная ошибка при создании замка!',
					'options' => ['class' => 'alert alert-danger']
				]);

				return $this->redirect(['index']);
			}
		}

		public function actionEdit($id)
		{
			$lockers_model = $this->findModel($id);

			if( empty($lockers_model) ) {
				return $this->redirect(['index']);
			}

			$type = $lockers_model->type;

			$multi_model = $this->initMultimodel($type);
			$multi_model->setMultiModel($lockers_model);

			if( $multi_model->load(Yii::$app->request->post()) ) {
				if( $multi_model->saveMultiModel($type, $this->findModel($id)) ) {
					/*Yii::$app->session->setFlash( 'alert', [
						'body'    => 'Настройки успешно обновлены!',
						'options' => ['class' => 'alert alert-success']
					] );*/

					//return $this->refresh();

					$visability_model = EditConditions::getModel($id);
					$redirect_url = ['visability/create?locker_id=' . $id];

					if( !empty($visability_model) ) {
						$redirect_url = ['visability/edit?locker_id=' . $id];
					}

					$this->redirect($redirect_url);
				} else {
					Yii::$app->session->setFlash('alert', [
						'body' => 'Возникли ошибки при заполнении формы! Пожалуйста, проверьте внимательно неправильно заполненные поля.',
						'options' => ['class' => 'alert alert-danger']
					]);
				}
			}

			return $this->render($type . '-create', [
				'model' => $multi_model,
				'model_query' => $lockers_model,
				'type' => $type,
				'locker_id' => $id,
				'settings' => Settings::get(null, true)
			]);
		}

		public function actionDelete($id)
		{
			$model = new Lockers();
			$locker = $model->findOne($id);
			$redirect_route = ['index'];

			if( $locker->status == 'draft' ) {
				$redirect_route = ['draft'];
			}

			if( $locker ) {
				$locker->status = 'trash';
				$locker->save(true);

				Yii::$app->session->setFlash('alert', [
					'body' => 'Внимание! Замок перенесен в корзину, если вы хотите удалить его насовсем, очистите корзину.',
					'options' => ['class' => 'alert alert-warning']
				]);
			} else {
				Yii::$app->session->setFlash('alert', [
					'body' => 'Ошибка! Замок не найдет в базе данных.',
					'options' => ['class' => 'alert alert-danger']
				]);
			}

			return $this->redirect($redirect_route);
		}

		public function actionHardDelete($id)
		{
			$model = new Lockers();
			$locker = $model->findOne($id);

			if( empty($locker) ) {
				return;
			}

			if( !empty($locker->lockersVisability) ) {
				$locker->lockersVisability->delete();
			}

			$locker->delete();

			return $this->redirect(['trash']);
		}

		public function actionActivate($id)
		{
			$model = new Lockers();
			$locker = $model->findOne($id);

			if( empty($locker) ) {
				return;
			}

			$locker->status = 'public';
			$locker->save();

			return $this->redirect(['index']);
		}

		public function actionDeactivate($id)
		{
			$model = new Lockers();
			$locker = $model->findOne($id);

			if( empty($locker) ) {
				return;
			}

			$locker->status = 'draft';
			$locker->save();

			return $this->redirect(['index']);
		}

		public function actionTerms()
		{
			echo Yii::$app->lockersSettings->get('terms_of_use_text');
		}

		public function actionPrivacy()
		{
			echo Yii::$app->lockersSettings->get('privacy_policy_text');
		}

		protected function initMultimodel($type)
		{
			$model_list = [
				'models' => [
					'basic' => new BasicMetabox(),
					'advanced' => new AdvancedMetabox(),
					'save' => new SaveLockerMetabox(),
					'visability' => new VisabilityMetabox()
				]
			];

			if( $type == 'signinlocker' || $type == 'emaillocker' ) {
				$model_list['models']['subscribe'] = new SubscribeMetabox();
			}

			if( $type == 'emaillocker' ) {
				$model_list['models']['email_form_settings'] = new EmailFormSettings();
			}

			if( $type == 'signinlocker' ) {
				$model_list['models']['signin_social'] = new SigninButtonsSettings();
			}

			if( $type == 'sociallocker' ) {
				$model_list['models']['social'] = new SocialButtonsSettings();
			}

			return new LockersForm($model_list);
		}

		protected function findModel($id)
		{
			return Lockers::findModel($id);
		}
	}
