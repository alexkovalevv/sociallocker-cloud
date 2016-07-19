<?php
/**
 * Шаблон дополнительных настроек замка. Часть шаблона редактирования замков.
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */


use yii\helpers\Html;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

?>

<?php
if( $type == 'sociallocker' ) {
	echo SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'counters'
	]);
}
?>

<?= SwitchControl::widget([
	'model' => $model->getModel('advanced'),
	'attribute' => 'close'
]);
?>

<?= $form->field($model->getModel('advanced'), 'timer')->textInput([
	'value' => empty($model->getModel('advanced')->timer)
		? 0	: $model->getModel('advanced')->timer
    ]
);?>

<?= SwitchControl::widget([
	'model' => $model->getModel('advanced'),
	'attribute' => 'ajax',
	'default'   => true
]);
?>

<?= SwitchControl::widget([
	'model' => $model->getModel('advanced'),
	'attribute' => 'highlight',
	'default'   => true
]);
?>


