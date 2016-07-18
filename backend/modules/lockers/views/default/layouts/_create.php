<?php
/**
 * Общая часть шаблона редактирования замков.
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use yii\helpers\Html;
use backend\modules\lockers\assets\ItemEditAsset;

/* @var $this yii\web\View */

$controller = Yii::$app->controller->action->id;

if( $controller == 'edit' ) {
	$this->title = "Редактирование замка";
	$type = $model_active_query->type;
	$form_action = 'default/edit?id=' . $model_active_query->id .
		'&type=' . $type;
} else {
	$this->title = "Создание замка";
	$form_action = 'default/create?type='. $type;
}
$this->params['breadcrumbs'][] = ['label' => 'Все замки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$buttons_group = '["social-buttons"]';

if( $type === 'signinlocker' )
	$buttons_group = '["connect-buttons"]';
else if( $type === 'emaillocker') {
	$buttons_group = '["subscription"]';
}

// Печать настроек замка для превью
$output = <<<JS
	if(!window.bizpanda) window.bizpanda = {};
	window.bizpanda.lockersSettings = {$settings};
	window.bizpanda.buttonsGroup = {$buttons_group};
JS;

$this->registerJs( $output, $this::POS_END );

// Подключение js и css файлов
ItemEditAsset::register( $this );

?>
<?php if( Yii::$app->request->get('save') === 'success' ): ?>
	<div class="alert alert-success alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Настройки успешно обновлены!</h4>
		Вы можете перейти к <?=Html::a( 'списку всех ваших замков', ['/lockers/default/index'] )?>.
	</div>
<?php endif; ?>