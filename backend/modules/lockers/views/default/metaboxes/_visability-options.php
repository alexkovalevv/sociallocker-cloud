<?php
/**
 * Шаблон настроек отображения замка. Часть шаблона редактирования замков.
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use yii\helpers\Html;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

?>
<?= SwitchControl::widget([
	'model' => $model->getModel('visability'),
	'attribute' => 'relock',
	'default'   => false
]);
?>
<?= SwitchControl::widget([
	'model' => $model->getModel('visability'),
	'attribute' => 'always',
	'default'   => false
]);
?>
<?= SwitchControl::widget([
	'model' => $model->getModel('visability'),
	'attribute' => 'mobile',
	'default'   => true
]);
?>