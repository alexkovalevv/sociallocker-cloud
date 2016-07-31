<?php
/**
 * Контроллер манипулирует авторизацией в соц. сетях.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace common\modules\signin\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

use common\modules\signin\Module;

use common\modules\signin\handlers\vk\VkHandler;
use common\modules\signin\handlers\twitter\TwitterHandler;
use common\modules\signin\handlers\subscription\SubscriptionHandler;
use common\modules\signin\handlers\linkedin\LinkedinHandler;
use common\modules\signin\handlers\lead\LeadHandler;
use common\modules\signin\HandlerException;
use common\modules\signin\HandlerInternalException;


class ConnectController extends Controller
{

    public function actionIndex() {
        $handler = Yii::$app->request->getQueryParam('opandaHandler');
        if( $handler == 'index' ) return;
        $this->runAction($handler, Yii::$app->request->getQueryParams());
    }

	public function actionVk()
	{
		$options = Module::getConnectOptions('vk');
		$handler = new VkHandler( $options );
		return $this->response($handler);
	}

	public function actionTwitter()
	{
		$options = Module::getConnectOptions('twitter');
		$handler = new TwitterHandler( $options );
		return $this->response($handler);
	}

	public function actionLinkedin()
	{
		$options = Module::getConnectOptions('linkedin');
		$handler = new LinkedinHandler( $options );
		return $this->response($handler);
	}

	public function actionSubscription()
	{
		$options = Module::getConnectOptions('subscription');
		$handler = new SubscriptionHandler( $options );
		return $this->response($handler);
	}

	public function actionLead()
	{
		$options = Module::getConnectOptions('subscription');
		$handler = new SubscriptionHandler( $options );
		return $this->response($handler);
	}

	/**
	 * Отправляет запрос на авторизацию
	 * @param object $handler класс обрабочика
	 * @return string возвращает json строку
	 */

	public function response($handler)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		try {
			return $handler->handleRequest();
		} catch (HandlerInternalException $ex) {
			return ['error' => $ex->getMessage(), 'detailed' => $ex->getDetailed()];
		} catch (HandlerException $ex) {
			return ['error' => $ex->getMessage()];
		} catch(Exception $ex) {
			return ['error' => $ex->getMessage()];
		}
	}	
}