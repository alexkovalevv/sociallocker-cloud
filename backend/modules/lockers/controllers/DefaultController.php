<?php
/**
 * Контроллер манипулирует замками.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace backend\modules\lockers\controllers;

use backend\modules\lockers\models\lockers\metaboxes\EmailFormSettings;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use backend\modules\lockers\models\lockers\LockersForm;
use backend\modules\lockers\models\lockers\Lockers;
use backend\modules\lockers\models\search\LockersSearch;
use backend\modules\lockers\models\settings\Settings;

use backend\modules\lockers\models\lockers\metaboxes\AdvancedMetabox;
use backend\modules\lockers\models\lockers\metaboxes\BasicMetabox;
use backend\modules\lockers\models\lockers\metaboxes\SaveLockerMetabox;
use backend\modules\lockers\models\lockers\metaboxes\SocialButtonsSettings;
use backend\modules\lockers\models\lockers\metaboxes\SubscribeMetabox;
use backend\modules\lockers\models\lockers\metaboxes\VisabilityMetabox;
use backend\modules\lockers\models\lockers\metaboxes\SigninButtonsSettings;


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
		if( empty($type) ) return $this->redirect(['index']);

		if( !in_array($type, array('sociallocker', 'signinlocker', 'emaillocker')) )
			return $this->redirect(['index']);

		$settings = new Settings();
        $model = $this->initMultimodel($type);

        // Создаем черновик
        if( $model->saveMultiModel($type, null, true) ) {
            $locker_id = Yii::$app->db->getLastInsertID();
            return $this->redirect(['default/edit?type=' . $type . '&id=' . $locker_id]);
        } else {
            Yii::$app->session->setFlash( 'alert', [
                'body'    => 'Возникла не известная ошибка при создании замка!',
                'options' => ['class' => 'alert alert-danger']
            ] );
            return $this->redirect(['index']);
        }
	}

	public function actionEdit($id, $type)
	{
		$settings = new Settings();

        $model = $this->initMultimodel($type);
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
                    'body'    => 'Возникли ошибки при заполнении формы! Пожалуйста, проверьте внимательно неправильно заполненные поля.',
                    'options' => ['class' => 'alert alert-danger']
                ] );

                var_dump($model->getErrors());
            }
		}

		return $this->render( $type . '-create', [
			'model'=> $model,
			'model_active_query' => $this->findModel($id),
		    'settings' => $settings->getModelValue()
		]);
	}

	public function actionDelete($id) {
		//$this->findModel($id)->delete();

        $model = new Lockers();
        $locker = $model->findOne($id);

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

		return $this->redirect(['index']);
	}

	public function actionTerms() {
		echo Yii::$app->lockersSettings->get('terms_of_use_text');
	}

	public function actionPrivacy() {
		echo Yii::$app->lockersSettings->get('privacy_policy_text');
	}

    protected function initMultimodel($type) {
        $model_list = [
            'models' => [
                'basic'      => new BasicMetabox(),
                'advanced'   => new AdvancedMetabox(),
                'save'       => new SaveLockerMetabox(),
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
		if (($model = Lockers::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
