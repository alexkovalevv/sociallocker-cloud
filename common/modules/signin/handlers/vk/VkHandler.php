<?php
namespace common\modules\signin\handlers\vk;

use Yii;
use common\modules\signin\handlers\vk\libs\VK;
use common\modules\signin\Handler;
use common\modules\signin\HandlerException;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * The class to proxy the request to the Twitter API.
 */
class VkHandler extends Handler {

	/**
	 * Handles the proxy request.
	 */
	public function handleRequest() {

		// the request type is to determine which action we should to run
		$this->requestCode = Yii::$app->request->getQueryParam('code', false);
		$this->isDenied = Yii::$app->request->getQueryParam('error');
		$this->errorMessage = Yii::$app->request->getQueryParam('error_description');

		if ( $this->isDenied || !$this->requestCode ) {
			throw new HandlerException( 'Не известный тип запроса.' );
		}

		$this->doCallback();
	}

	public function doCallback() {

		if ( $this->isDenied ) {
			?>
			<script>
				if( window.opener ) window.opener.OPanda_VkOAuthDenied( '<?php echo $this->errorMessage; ?>' );
				window.close();
			</script>
			<?php
			exit;
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
		$access_token = $vk->getAccessToken($this->requestCode, ArrayHelper::getValue($this->options,'proxy'));

		if ( empty( $access_token ) ) {
			throw new HandlerException('Возникла ошибка при получении токена доступа.');
		}

		?>
		<script>
			if( window.opener ) window.opener.OPanda_VkOAuthCompleted( '<?php echo json_encode($access_token); ?>' );
			window.close();
		</script>
		<?php
		exit;
	}
}


