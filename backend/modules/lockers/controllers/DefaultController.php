<?php
/**
 * Контроллер манипулирует замками.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace backend\modules\lockers\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use backend\modules\lockers\models\lockers\LockersForm;
use backend\modules\lockers\models\lockers\Lockers;
use backend\modules\lockers\models\search\LockersSearch;
use backend\modules\lockers\models\settings\Settings;

use backend\modules\lockers\models\lockers\metaboxes\Advanced;
use backend\modules\lockers\models\lockers\metaboxes\Basic;
use backend\modules\lockers\models\lockers\metaboxes\Save;
use backend\modules\lockers\models\lockers\metaboxes\Social;
use backend\modules\lockers\models\lockers\metaboxes\Subscribe;
use backend\modules\lockers\models\lockers\metaboxes\Visability;
use backend\modules\lockers\models\lockers\metaboxes\SigninSocial;


class DefaultController extends Controller
{
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

	public function actionChangeLocker()
	{
		return $this->render('change');
	}

	public function actionCreate($type)
	{
		if( !isset($type) || empty($type) )
			return $this->redirect(['index']);

		if( !in_array($type, array('sociallocker', 'signinlocker', 'emaillocker')) )
			return $this->redirect(['index']);

		$settings = new Settings();

		$model_list = [
			'models' => [
				'basic'      => new Basic(),
				'advanced'   => new Advanced(),
				'save'       => new Save(),
				'subscribe'  => new Subscribe(),
				'visability' => new Visability()
			]
		];

		if( $type == 'signinlocker' ) {
			$model_list['models']['signin_social'] = new SigninSocial();
		}

		if( $type == 'sociallocker' ) {
			$model_list['models']['social'] = new Social();
		}

		$model = new LockersForm($model_list);

		if ( $model->load(Yii::$app->request->post()) ) {
            if( $model->saveMultiModel($type) ) {
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash( 'alert', [
                    'body'    => 'Возникли ошибки при заполнении формы! Пожалуйста, проверьте внимательно неправильно заполненные поля.',
                    'options' => ['class' => 'alert alert-danger']
                ] );
            }
		}

		return $this->render( $type . '-create', [
			'model' => $model,
		    'type'  => $type,
			'settings' => $settings->getModelValue()
		]);
	}

	public function actionEdit($id, $type)
	{
		$settings = new Settings();

		$model_list = [
			'models' => [
				'basic'      => new Basic(),
				'advanced'   => new Advanced(),
				'save'       => new Save(),
				'subscribe'  => new Subscribe(),
				'visability' => new Visability()
			]
		];

		if( $type == 'signinlocker' ) {
			$model_list['models']['signin_social'] = new SigninSocial();
		}

		if( $type == 'sociallocker' ) {
			$model_list['models']['social'] = new Social();
		}

		$model = new LockersForm($model_list);
		$model->setMultiModel($this->findModel($id));

		if( (!isset($type) && empty($type)) || (!isset($id) && empty($id)) )
			return $this->redirect(['index']);

		if ( $model->load(Yii::$app->request->post()) ) {
            if( $model->saveMultiModel( $type, $this->findModel($id) )) {
                Yii::$app->session->setFlash( 'alert', [
                    'body'    => 'Настройки успешно обновлены!',
                    'options' => ['class' => 'alert alert-success']
                ] );

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash( 'alert', [
                    'body'    => 'Возникли ошибки при заполнении формы! Пожалуйста, проверьте внимательно неправильно заполненные поля.' ,
                    'options' => ['class' => 'alert alert-danger']
                ] );
            }
		}

		return $this->render( $type . '-create', [
			'model'=> $model,
			'model_active_query' => $this->findModel($id),
		    'settings' => $settings->getModelValue()
		]);
	}

	public function actionDelete($id) {
		$this->findModel($id)->delete();

		Yii::$app->session->setFlash('alert', [
			'body' => 'Замок успешно удален!',
			'options' => ['class' => 'alert alert-danger']
		]);

		return $this->redirect(['index']);
	}

	public function actionTerms() {
		echo Yii::$app->lockersSettings->get('terms_of_use_text');
	}

	public function actionPrivacy() {
		echo Yii::$app->lockersSettings->get('privacy_policy_text');
	}

	protected function findModel($id)
	{
		if (($model = Lockers::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
