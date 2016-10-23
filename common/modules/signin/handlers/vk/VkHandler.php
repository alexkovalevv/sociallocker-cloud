<?php
	namespace common\modules\signin\handlers\vk;

	use common\modules\signin\HandlerException;
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

			return $this->doCallback();
		}

		public function doCallback()
		{

			if( $this->isDenied ) {
				return null;
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

			if( !empty($this->oauth_client_id) ) {
				$redirect_url .= '?oauth_client_id=' . $this->oauth_client_id;
			} else if( !empty($this->s_token) ) {
				$redirect_url .= '?s_token=' . $this->s_token;
			}

			$access_token = $vk->getAccessToken($this->requestCode, $redirect_url);

			if( empty($access_token) ) {
				throw new HandlerInternalException('Возникла ошибка при получении токена доступа.');
			}

			$request = $vk->api('users.get', [
				'fields' => 'photo_50'
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
				'access_token' => ArrayHelper::getValue($access_token, 'access_token'),
				'source' => 'vk',
				'email' => ArrayHelper::getValue($access_token, 'email'),
				'uid' => ArrayHelper::getValue($result, 'uid'),
				'display_name' => $first_name . ' ' . $last_name,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'avatar_url' => ArrayHelper::getValue($result, 'photo_50')
			];

			return $user_info;
		}
	}


