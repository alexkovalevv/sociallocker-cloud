<?php
/**
 * Контроллер манипулирует авторизацией в соц. сетях.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace common\modules\signin\controllers;

use common\modules\signin\models\SigninTemp;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
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
use yii\web\NotFoundHttpException;


class ConnectController extends Controller
{
    protected $sToken;

    public function actionIndex() {

        $handler_data = isset($_REQUEST['opandaHandler']) ? $_REQUEST['opandaHandler'] : null;
        if( is_null($handler_data) || $handler_data == 'index' ) return;

        $handler = $handler_data;

        if( strpos($handler_data, '-') !== false ) {
            $handler_parts = explode('-', $handler_data);

            $handler = $handler_parts[0];
            $this->sToken = $handler_parts[1];
        }

        return $this->runAction($handler, $_REQUEST);
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
		$handler = new LeadHandler( $options );
        return $this->response($handler);
	}

    public function actionBlank() {
        return $this->render('blank');
    }

    /**
     * Проверяет, авторизовался ли пользователь через хандлер или нет.
     * @return string
     */
    public function actionCheckUserData() {

        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');
        $headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

        /*if( !Yii::$app->request->isAjax ) {
            throw new NotFoundHttpException('Страница не найдена');
        }*/

        Yii::$app->response->format = Response::FORMAT_JSON;

        $s_token = isset($_POST['s_token']) ? $_POST['s_token'] : null;

        if( empty($s_token) ) {
            return ['error' => 'Переданы некорректные параметры'];
        }

        $data = SigninTemp::getTempData($s_token);

        if( !empty($data) ) {
            SigninTemp::removeTempData( $s_token );
            return $data;
        }

        return ['error' => 'Пользователь отклонил авторизацию или в ходе выполнения авторизации возникла неизвестная ошибка.'];
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
           $handler->sToken = $this->sToken;
           return $handler->handleRequest();
		} catch (HandlerInternalException $ex) {
           return ['error' => $ex->getMessage(), 'detailed' => $ex->getDetailed()];
		} catch (HandlerException $ex) {
           return ['error' => $ex->getMessage()];
		} catch(Exception $ex) {
           return ['error' => $ex->getMessage()];
		}
	}

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}