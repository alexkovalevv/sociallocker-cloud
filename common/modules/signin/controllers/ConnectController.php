<?php
	/**
	 * Контроллер манипулирует авторизацией в соц. сетях.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\signin\controllers;

	use common\modules\signin\models\SigninOauthClients;
	use common\modules\signin\models\SigninTemp;
	use Yii;
	use yii\base\Exception;
	use yii\helpers\ArrayHelper;
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

	class ConnectController extends Controller {

		protected $sToken;
		protected $oAuthClientId;
		protected $network;

		public function init()
		{
			parent::init();

			$headers = Yii::$app->response->headers;
			$headers->add('Access-Control-Allow-Origin', '*');
			$headers->add('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

			$this->sToken = Yii::$app->request->get('stoken');
			$this->oAuthClientId = Yii::$app->request->get('oauth_client_id');
		}

		public function actionVk()
		{
			$options = Module::getConnectOptions('vk');
			$handler = new VkHandler($options);

			return $this->response($handler);
		}

		public function actionTwitter()
		{
			$options = Module::getConnectOptions('twitter');
			$handler = new TwitterHandler($options);

			return $this->response($handler);
		}

		public function actionLinkedin()
		{
			$options = Module::getConnectOptions('linkedin');
			$handler = new LinkedinHandler($options);

			return $this->response($handler);
		}

		public function actionSubscription()
		{
			$options = Module::getConnectOptions('subscription');
			$handler = new SubscriptionHandler($options);

			return $this->response($handler);
		}

		public function actionLead()
		{
			$options = Module::getConnectOptions('subscription');
			$handler = new LeadHandler($options);

			return $this->response($handler);
		}

		public function actionBlank()
		{
			return $this->render('blank');
		}

		public function actionOauthClientInfo()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			if( !empty($this->oAuthClientId) ) {
				$network = Yii::$app->request->get('network');

				return SigninOauthClients::getClientInfo(['oauth_client_id' => $this->oAuthClientId], $network)
					? : ['error' => 'Клиента или данных о клиенте не существует.'];
			}

			if( !empty($this->sToken) ) {
				return SigninOauthClients::getClientInfoByToken($this->sToken)
					? : ['error' => 'Клиента или данных о клиенте не существует.'];
			}

			return ['error' => 'Переданы некорректные параметры запроса'];
		}

		public function actionSaveClientInfo()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			$oauth_client_id = Yii::$app->request->post('oauth_client_id');
			$stoken = Yii::$app->request->post('stoken');
			$network = Yii::$app->request->post('network');

			if( empty($oauth_client_id) && empty($stoken) ) {
				return ['error' => 'Переданы некорректные параметры запроса'];
			}

			$user_info = [
				'email' => ArrayHelper::getValue($_POST, 'email'),
				'uid' => ArrayHelper::getValue($_POST, 'uid'),
				'display_name' => ArrayHelper::getValue($_POST, 'display_name'),
				'first_name' => ArrayHelper::getValue($_POST, 'first_name'),
				'last_name' => ArrayHelper::getValue($_POST, 'last_name'),
				'profile_url' => ArrayHelper::getValue($_POST, 'profile_url'),
				'avatar_url' => ArrayHelper::getValue($_POST, 'avatar_url')
			];

			$result = SigninOauthClients::saveClientInfo($oauth_client_id, $stoken, $network, $user_info);

			if( !empty($result) ) {
				return SigninOauthClients::getClientInfo(['oauth_client_id' => $result], $network)
					? : ['error' => 'Клиента или данных о клиенте не существует.'];
			}

			return ['error' => 'Данные о клиенте не были сохранены из-за неизвестной ошибки.'];
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
				$handler->oAuthClientId = $this->oAuthClientId;

				return $handler->handleRequest();
			} catch( HandlerInternalException $ex ) {
				Yii::$app->response->format = Response::FORMAT_HTML;
				throw new HttpException('400', $ex->getDetailed());
			} catch( HandlerException $ex ) {
				return ['error' => $ex->getMessage()];
			} catch( Exception $ex ) {
				return ['error' => $ex->getMessage()];
			}
		}

		public function beforeAction($action)
		{
			$this->enableCsrfValidation = false;

			return parent::beforeAction($action);
		}
	}