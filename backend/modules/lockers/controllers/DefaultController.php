<?php

namespace backend\modules\lockers\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;

use backend\modules\lockers\models\LockersForm;
use backend\modules\lockers\models\Lockers;
use backend\modules\lockers\models\search\LockersSearch;
use backend\modules\lockers\models\settings\Settings;


class DefaultController extends Controller
{
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
		$model = new LockersForm();

		if ($model->load(Yii::$app->request->post()) && $model->save($type)) {
			return $this->redirect(['index']);
		}

		return $this->render( $type . '-create', [
			'model' => $model,
		    'type'  => $type,
			'settings' => $settings->getModelValue()
		]);
	}

	public function actionPreview()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$model = new LockersForm();

		if( $model->load(Yii::$app->request->post()) ) {
			return $model->getLockerOptions();
		}
		return null;
	}

	public function actionEdit($id, $type)
	{
		$settings = new Settings();
		$model = new LockersForm();
		$model->setModel($this->findModel($id));

		if( (!isset($type) && empty($type)) || (!isset($id) && empty($id)) )
			return $this->redirect(['index']);

		if ($model->load(Yii::$app->request->post()) && $model->save($type, $this->findModel($id))) {
			return $this->redirect(['edit?type=' . $type . '&id=' . $id . '&save=success']);
		}

		return $this->render( $type . '-create', [
			'model'=> $model,
			'model_active_query' => $this->findModel($id),
		    'settings' => $settings->getModelValue()
		]);
	}

	public function actionDelete($id) {
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Lockers::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
