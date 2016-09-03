<?php
namespace common\modules\signin\handlers\vk;

use common\modules\signin\models\SigninTemp;
use Yii;
use common\modules\signin\handlers\vk\libs\VK;
use common\modules\signin\Handler;
use common\modules\signin\HandlerException;
use yii\helpers\ArrayHelper;


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
	public function handleRequest() {

		// the request type is to determine which action we should to run
		$this->requestCode = isset($_REQUEST['code']) ? $_REQUEST['code'] : false;
		$this->isDenied =  isset($_REQUEST['error']) ? $_REQUEST['error'] : false;
		$this->errorMessage = isset($_REQUEST['error_description']) ? $_REQUEST['error_description'] : false;

		if ( $this->isDenied || !$this->requestCode ) {
			throw new HandlerException( 'Не известный тип запроса.' );
		}

		$this->doCallback();
	}

	public function doCallback() {

		if ( $this->isDenied ) {
            return Yii::$app->response->redirect(array('signin/connect/blank'));
		}

		if ( empty( $this->requestCode ) ) {
            throw new HandlerException( 'Необнаружен код авторизации.' );
        }

		$appId = ArrayHelper::getValue($this->options,'app_id', false);
		$appSercret = ArrayHelper::getValue($this->options,'app_secret', false);

		if ( !$appId || !$appSercret ) {
			throw new HandlerException( 'Не переданы параметры appid и secret id или один из параметров пуст.' );
		}

		$vk = new VK($appId, $appSercret);
		$access_token = $vk->getAccessToken($this->requestCode, ArrayHelper::getValue($this->options,'proxy') . '-' . $this->sToken);

		if ( empty( $access_token ) ) {
			throw new HandlerException('Возникла ошибка при получении токена доступа.');
		}

        if( !empty($this->sToken) ) {
            $user_info = $vk->api('users.get', [
                'fields' => 'photo_400_orig'
            ]);

            if( isset($user_info['error']) ) {
                throw new HandlerException('Возникла ошибка при получении данных пользователя ' . $user_info['error']);
            }

            $user_info = isset($user_info['response']) ? $user_info['response'][0] : [];

            unset($user_info['uid']);

            SigninTemp::saveTempData($this->sToken, 'vk', array_merge($user_info, $access_token));
        }

        return Yii::$app->response->redirect(array('signin/connect/blank'));
	}
}


