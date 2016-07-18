<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 3:31
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

//---------------------------------------
/**  Опции блокировки                  */
//---------------------------------------

$lock = SwitchControl::widget([
	'model' => $model->getModel('lock'),
	'attribute' => 'debug',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

$lock .= $form->field($model->getModel('lock'), 'passcode')->textInput();
$lock .= SwitchControl::widget([
	'model' => $model->getModel('lock'),
	'attribute' => 'permanent_passcode',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

$lock .= $form->field($model->getModel('lock'), 'session_duration')->textInput();
$lock .= SwitchControl::widget([
	'model' => $model->getModel('lock'),
	'attribute' => 'session_freezing',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

$lock .= SwitchControl::widget([
	'model' => $model->getModel('lock'),
	'attribute' => 'interrelation',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

$lock .= SwitchControl::widget([
	'model' => $model->getModel('lock'),
	'attribute' => 'dynamic_theme',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);
$lock .= $form->field($model->getModel('lock'), 'managed_hook')->textInput();

$lock .= $form->field($model->getModel('lock'), 'alt_overlap_mode')->dropDownList(
	[
		'full'         => 'Скрыть полностью',
		'transparence' => 'Прозрачность',
	],
	empty($model->getModel('lock')->alt_overlap_mode) ? [
		'options'=>	[
			'transparence'=> [
				'Selected'=> true
			]
		]
	] : []
);

$lock .= SwitchControl::widget([
	'model' => $model->getModel('lock'),
	'attribute' => 'timeout',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);
$lock .= $form->field($model->getModel('lock'), 'managed_hook')->textInput();

return $lock;
