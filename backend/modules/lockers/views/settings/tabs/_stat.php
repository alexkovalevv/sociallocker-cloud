<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 3:32
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

//---------------------------------------
/**  Статистика                       */
//---------------------------------------

$stat = SwitchControl::widget([
	'model' => $model->getModel('stat'),
	'attribute' => 'google_analytics',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

$stat .= SwitchControl::widget([
	'model' => $model->getModel('stat'),
	'attribute' => 'tracking',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

return $stat;
