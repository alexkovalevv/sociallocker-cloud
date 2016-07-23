<?php
/**
 * Шаблон сохранения настроек замка. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use yii\helpers\Html;

/* @var $model common\base\MultiModel */
/* @var string $type */

$fields->model = $model->getModel('save');

echo $fields->checkbox('status');
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
