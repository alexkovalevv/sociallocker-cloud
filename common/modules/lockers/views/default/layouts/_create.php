<?php
	/**
	 * Общая часть шаблона редактирования замков.
	 * @package sociallocker-create, signlocker-create, emaillocker-create
	 */

	use common\modules\lockers\assets\ItemEditAsset;

	/* @var $this yii\web\View */
	/* @var integer $id */
	/* @var string $type */

	$controller = Yii::$app->controller->action->id;

	$this->title = "Редактирование замка";

	$this->params['breadcrumbs'][] = ['label' => 'Все замки', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;

	$buttons_group = '["social-buttons"]';

	if( $type === 'signinlocker' ) {
		$buttons_group = '["connect-buttons"]';
	} else if( $type === 'emaillocker' ) {
		$buttons_group = '["subscription"]';
	}

	$terms_url = \yii\helpers\Url::to(['default/terms']);
	$privacy_url = \yii\helpers\Url::to(['default/privacy']);

	// Печать настроек замка для превью
	$output_header = <<<JS
		window._onpwgt = {};
		window._onpwgt.client_id = 1;
		window._onpwgt.site_id = 2;
		window._onpwgt.loadForce = true;
		window._onpwgt.options = {};
JS;

	$this->registerJs($output_header, $this::POS_HEAD);

	// Печать настроек замка для превью
	$output = <<<JS
		window.onpwgt___options = {};
		if(!window.bizpanda) window.bizpanda = {};
		window.lockerId = {$locker_id};
		window.lockerTitle = '{$models->getModel('basic')->title}';
		window.lockersSettings = {$settings};
		window.lockerType = '{$type}';
		window.buttonsGroup = {$buttons_group};
JS;

	$proxyUrl = Yii::getAlias('@proxyUrl');

	if( in_array($type, ['signinlocker', 'emaillocker']) && !empty($proxyUrl) ) {
		$output .= <<<JS
			window.proxyUrl = '{$proxyUrl}';
JS;
	}

	$subscription_service_name = Yii::$app->lockers->getCurrentSubscriptionServiceName();

	if( !in_array($subscription_service_name, ['none', 'default']) && in_array($type, [
			'signinlocker',
			'emaillocker'
		])
	) {
		$output .= <<<JS

			window.subscriptionService = '{$subscription_service_name}';
JS;
	}

	if( Yii::$app->lockers->getTerms() && in_array($type, ['signinlocker', 'emaillocker']) ) {
		$output .= <<<JS
			window.terms = '{$terms_url}';
			window.privacy = '{$privacy_url}';
JS;
	}
	$this->registerJs($output, $this::POS_END);

	// Подключение js и css файлов
	ItemEditAsset::register($this);
?>
