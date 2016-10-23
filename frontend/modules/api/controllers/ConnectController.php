<?php
	/**
	 * Контроллер манипулирует авторизацией в соц. сетях.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace frontend\modules\api\controllers;

	use Yii;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use frontend\classes\ConnectHandler;

	class ConnectController extends Controller {

		protected $s_token;
		protected $oauth_client_id;
		protected $network;


		public function init()
		{
			parent::init();

			$headers = Yii::$app->response->headers;
			$headers->add('Access-Control-Allow-Origin', '*');
			$headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

			$this->s_token = Yii::$app->request->get('s_token');
			$this->oauth_client_id = Yii::$app->request->get('oauth_client_id');
		}

		public function actionIndex($handler)
		{
			if( empty($handler) || $handler == 'index' ) {
				throw new NotFoundHttpException('Страница не найдена.');
			}

			$options['s_token'] = $this->s_token;
			$options['oauth_client_id'] = $this->oauth_client_id;

			$connect_handler = new ConnectHandler($handler, $options);

			return $connect_handler->response();
		}

		public function beforeAction($action)
		{
			$this->enableCsrfValidation = false;

			return parent::beforeAction($action);
		}
	}