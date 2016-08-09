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

echo $fields->radio( 'status', [
    ['value' => 'draft',  'label' => 'Черновик'],
    ['value' => 'public', 'label' => 'Публичный'],
    ['value' => 'trash',  'label' => 'В корзине']
]);
?>
<div class="save-locker-buttons">
	<?php
		if( $fields->model->status == 'public' ) {
			echo Html::submitButton( 'Обновить', ['class' => 'btn btn-default'] ) . " ";
			echo Html::a( 'Удалить', ['/lockers/default/delete?id=' . $locker_id], ['class' => 'btn btn-danger'] );
		} else if( $fields->model->status == 'draft' )  {
			echo Html::submitButton( 'Опубликовать', ['class' => 'btn btn-primary locker-public-button'] ) . " ";
		} else if( $fields->model->status == 'trash' ) {
            echo Html::a( 'Восстановить', ['/lockers/default/recover?id=' . $locker_id], ['class' => 'btn btn-success'] );
        }
	?>
</div>
