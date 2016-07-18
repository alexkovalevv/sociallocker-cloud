<?php
/**
 * Шаблон дополнительных настроек замка. Часть шаблона редактирования замков.
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */


use yii\helpers\Html;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

?>

<?= SwitchControl::widget([
	'model' => $model,
	'attribute' => 'counters'
]);
?>

<?= SwitchControl::widget([
	'model' => $model,
	'attribute' => 'close'
]);
?>

<?= $form->field($model, 'timer')->textInput([
	'value' => empty($model->timer)
		? 0	: $model->timer
    ]
);?>

<?= SwitchControl::widget([
	'model' => $model,
	'attribute' => 'ajax',
	'default'   => true
]);
?>

<?= SwitchControl::widget([
	'model' => $model,
	'attribute' => 'highlight',
	'default'   => true
]);
?>


