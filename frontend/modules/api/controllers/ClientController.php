<?php
	/**
	 * Контроллер отвечает за информацию о клиенте и его подписку
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace frontend\modules\api\controllers;

	use common\modules\subscription\frontend\models\LeadCorrector;
	use common\modules\subscription\frontend\models\SubscriptionCorrector;
	use Yii;
	use yii\helpers\ArrayHelper;
	use yii\web\Controller;
	use yii\web\Response;
	use common\modules\signin\models\SigninOauthClients;

	class ClientController extends Controller {

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

		/**
		 * Получает информацию об авторизованном клиенте
		 * @return array
		 */
		public function actionGetInfo()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			if( !empty($this->oauth_client_id) ) {
				$network = Yii::$app->request->get('network');

				return SigninOauthClients::getClientInfo(['oauth_client_id' => $this->oauth_client_id], $network)
					? : ['error' => 'Клиента или данных о клиенте не существует.'];
			}

			if( !empty($this->s_token) ) {
				return SigninOauthClients::getClientInfoByToken($this->s_token)
					? : ['error' => 'Клиента или данных о клиенте не существует.'];
			}

			return ['error' => 'Переданы некорректные параметры запроса'];
		}

		/**
		 * Сохраняет информацию об авторизованном клиенте
		 * @return array
		 */
		public function actionSaveInfo()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			$oauth_client_id = Yii::$app->request->post('oauth_client_id');
			$s_token = Yii::$app->request->post('s_token');
			$network = Yii::$app->request->post('network');

			if( empty($oauth_client_id) && empty($s_token) ) {
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

			$result = SigninOauthClients::saveClientInfo($oauth_client_id, $s_token, $network, $user_info);

			if( !empty($result) ) {
				return SigninOauthClients::getClientInfo(['oauth_client_id' => $result], $network)
					? : ['error' => 'Клиента или данных о клиенте не существует.'];
			}

			return ['error' => 'Данные о клиенте не были сохранены из-за неизвестной ошибки.'];
		}

		/**
		 * Подписывает пользователя
		 * @return bool|mixed
		 */
		public function actionSubscription()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			$model = new SubscriptionCorrector();

			$model->setAttributes(Yii::$app->request->post());

			if( $model->save(true) ) {
				return ['status' => $model->status];
			}

			return $model->error;
		}

		/**
		 * Добавляет пользователя в лиды
		 * @return bool|mixed
		 */
		public function actionLead()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			$locker_id = Yii::$app->request->post('locker_id');

			if( !empty($locker_id) ) {

				$social = Yii::$app->request->post('social', false);
				$source = Yii::$app->request->post('source');

				if( $social && !empty($source) ) {
					$lead_available = Yii::$app->lockers->getOption($locker_id, $source . '_lead_available', true);

					if( !$lead_available ) {
						return false;
					}
				}

				$model = new LeadCorrector();

				$model->setAttributes(Yii::$app->request->post());

				if( !$model->save(true) ) {
					return ['error' => 'Не удалось сохранить лид из-за ошибки.'];
				}

				return $model->error;
			}

			return null;
		}

		/**
		 * Отключает проверку csrf, чтобы не выпадала ошибка 400 для ajax
		 * @param \yii\base\Action $action
		 * @return bool
		 * @throws \yii\web\BadRequestHttpException
		 */
		public function beforeAction($action)
		{
			$this->enableCsrfValidation = false;

			return parent::beforeAction($action);
		}
	}