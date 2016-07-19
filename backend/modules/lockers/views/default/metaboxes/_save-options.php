<?php
/**
 * Шаблон сохранения настроек замка. Часть шаблона редактирования замков.
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;
use yii\helpers\Html;
?>
<?= SwitchControl::widget([
	'model' => $model->getModel('save'),
	'attribute' => 'status',
	'containerOptions' => [
		'class' => 'onp-activate-social-button-switch'
	],
	'default'   => true
]);
?>
<p>
	<?php
		if( $controller == 'edit' ) {
			echo Html::submitButton( 'Обновить', ['class' => 'btn btn-success'] ) . " ";
			echo Html::a( 'Удалить', ['/lockers/default/delete?id=' . $model_active_query->id], ['class' => 'btn btn-danger'] );
		} else {
			echo Html::submitButton( 'Создать замок', ['class' => 'btn btn-primary'] ) . " ";
			echo Html::a( 'Отменить', ['/lockers/default/index'], ['class' => 'btn btn-warning'] );
		}
	?>
</p>
