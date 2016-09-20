<?php
/**
 * Контроллер управляет отображением замка на фронтенде пользователей.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace common\modules\lockers\controllers;

use common\modules\lockers\models\stats\LockersStatImpress;
use common\modules\lockers\models\stats\LockersStatUnlock;
use Yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ApiController extends Controller
{
    public function actionStat() {
	    $headers = Yii::$app->response->headers;
	    $headers->add('Access-Control-Allow-Origin', '*');
	    $headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

	    Yii::$app->response->format = Response::FORMAT_JSON;

	    $param = Yii::$app->request->getBodyParams();

	    if( empty($param) || (!isset($param['stats']) || !isset($param['context'])) )
		    return ['error' => 'Переданы некорректные параметры запросы'];

	    switch($param['stats']['eventName']) {
		    case 'impress':
			    $impress_model = new LockersStatImpress();
			    $impress_model->locker_id = $param['context']['lockerId'];
			    $impress_model->aggregate_date = date('d.m.Y');
			    $impress_model->site_url = $param['context']['domain'];
			    $impress_model->page_url_hash = md5($param['context']['pageUrl']);
			    $impress_model->page_url = $param['context']['pageUrl'];

				if( !$impress_model->newUpdate() ) {
					return ['error' => 'Произошла неизвестная ошибка. Данные по просмотрам не добавлены!'];
				}

			    return ['success' => 'Данные успешно обновлены'];
			    break;
		    case 'unlock':
				$unlock_model = new LockersStatUnlock();

			    $unlock_model->locker_id = ArrayHelper::getValue($param['context'], 'lockerId');
			    $unlock_model->button_name = ArrayHelper::getValue($param['stats'], 'buttonName');
			    $unlock_model->network_user_id = ArrayHelper::getValue($param['stats'], 'userId', 0);
			    $unlock_model->channel = ArrayHelper::getValue($param['stats'], 'channel', '');
			    $unlock_model->referrer = ArrayHelper::getValue($param['context'], 'referrer', '');
			    $unlock_model->user_agent = Yii::$app->request->userAgent;
			    $unlock_model->ip = Yii::$app->request->userIP;
			    $unlock_model->status = 1;

				if( !$unlock_model->save(true) ) {
					return ['error' => 'Произошла неизвестная ошибка. Данные по просмотрам не добавлены!'];
				}

			    return ['success' => 'Данные успешно обновлены'];
			    break;
	    }

	    return $param;
    }

	public function beforeAction($action) {
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}

}
