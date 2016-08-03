<?php
/**
 * Контроллер манипулирует подпиской.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace common\modules\subscription\controllers;


use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

use common\modules\subscription\classes\SubscriptionServices;


class DefaultController extends Controller
{
    /**
     * Возвращает все доступные списки подписок.
     *
     * @since 1.0.0
     * @return array
     */
	public function actionSubscrtiptionLists()
    {
        if(!Yii::$app->request->isAjax) {
            throw new HttpException('403');
        }

	    Yii::$app->response->format = Response::FORMAT_JSON;

	    try {

		    $service = SubscriptionServices::getCurrentService();

		    $lists = $service->getLists();

		    return $lists;

	    } catch (Exception $ex) {
		    return array('error' => 'Unable to get the lists: ' . $ex->getMessage() );
	    }
    }

    /**
     * Возвращает все настраиваемые поля в выбранном сервисе подписки.
     *
     * @since 1.0.0
     * @return array
     */
    public function actionGetCustomFields($list_id) {

        if(!Yii::$app->request->isAjax) {
            throw new HttpException('403');
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $service = SubscriptionServices::getCurrentService();

            $fields = $service->getCustomFields($list_id);

            return $fields;

        } catch (Exception $ex) {
            return array('error' => $ex->getMessage() );
        }
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}
