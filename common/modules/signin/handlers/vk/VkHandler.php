<?php
	namespace common\modules\signin\handlers\vk;

	use common\modules\signin\HandlerInternalException;
	use Yii;
	use yii\helpers\ArrayHelper;
	use common\modules\signin\models\SigninOauthClients;
	use common\modules\signin\models\SigninTemp;
	use common\modules\signin\handlers\vk\libs\VK;
	use common\modules\signin\Handler;

	/**
	 * The class to proxy the request to the Twitter API.
	 */
	class VkHandler extends Handler {

		public $requestCode;
		public $errorMessage;
		public $isDanied;

		/**
		 * Handles the proxy request.
		 */
		public function handleRequest()
		{

			// the request type is to determine which action we should to run
			$this->requestCode = isset($_REQUEST['code'])
				? $_REQUEST['code']
				: false;
			$this->isDenied = isset($_REQUEST['error'])
				? $_REQUEST['error']
				: false;
			$this->errorMessage = isset($_REQUEST['error_description'])
				? $_REQUEST['error_description']
				: false;

			if( $this->isDenied || !$this->requestCode ) {
				throw new HandlerInternalException('Не известный тип запроса.');
			}

			$this->doCallback();
		}

		public function doCallback()
		{

			if( $this->isDenied ) {
				return Yii::$app->response->redirect(['signin/connect/blank']);
			}

			if( empty($this->requestCode) ) {
				throw new HandlerInternalException('Не передан код авторизации.');
			}

			$appId = ArrayHelper::getValue($this->options, 'app_id', false);
			$appSercret = ArrayHelper::getValue($this->options, 'app_secret', false);

			if( !$appId || !$appSercret ) {
				throw new HandlerInternalException('Не переданы параметры appid и secret id или один из параметров пуст.');
			}

			$vk = new VK($appId, $appSercret);
			$redirect_url = ArrayHelper::getValue($this->options, 'proxy');

			if( !empty($this->oAuthClientId) ) {
				$redirect_url .= '?oauth_client_id=' . $this->oAuthClientId;
			} else if( !empty($this->sToken) ) {
				$redirect_url .= '?stoken=' . $this->sToken;
			}

			$access_token = $vk->getAccessToken($this->requestCode, $redirect_url);

			if( empty($access_token) ) {
				throw new HandlerInternalException('Возникла ошибка при получении токена доступа.');
			}

			$request = $vk->api('users.get', [
				'fields' => 'photo_400_orig'
			]);

			if( isset($user_info['error']) ) {
				throw new HandlerInternalException('Возникла ошибка при получении данных пользователя ' . $request['error']);
			}

			$result = isset($request['response'])
				? $request['response'][0]
				: [];

			if( empty($result) ) {
				throw new HandlerInternalException('Не удалось получить данные пользователя!');
			}

			$first_name = ArrayHelper::getValue($result, 'first_name');
			$last_name = ArrayHelper::getValue($result, 'last_name');

			$user_info = [
				'email' => ArrayHelper::getValue($access_token, 'email'),
				'uid' => ArrayHelper::getValue($result, 'uid'),
				'display_name' => $first_name . ' ' . $last_name,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'avatar_url' => ArrayHelper::getValue($result, 'photo_400_orig')
			];

			SigninOauthClients::saveClientInfo($this->oAuthClientId, $this->sToken, 'vk', $user_info);

			return Yii::$app->response->redirect(['signin/connect/blank']);
		}
	}


