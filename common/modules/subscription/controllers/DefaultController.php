<?php
/**
 * Контроллер манипулирует подпиской.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace common\modules\subscription\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

use common\modules\subscription\classes\SubscriptionServices;


class DefaultController extends Controller
{
	/**
	 * @return string
	 */
	public function actionSubscrtiptionLists()
    {
	    Yii::$app->response->format = Response::FORMAT_JSON;

	    try {

		    $service = SubscriptionServices::getCurrentService();

		    $lists = $service->getLists();

		    return $lists;

	    } catch (Exception $ex) {
		    return array('error' => 'Unable to get the lists: ' . $ex->getMessage() );
	    }
    }

}
