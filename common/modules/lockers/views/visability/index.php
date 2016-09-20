<?php
use common\modules\lockers\widgets\conditionEditor\ConditionEditor;
use common\helpers\CustomFields;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $filters common\modules\lockers\controllers\VisabilityController.php */
/* @var $templates common\modules\lockers\controllers\VisabilityController.php */
/* @var $lockers common\modules\lockers\controllers\VisabilityController.php */

$this->title = "Создание условий отображения замка";
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(
	[
		'enableClientValidation' => false,
		'enableAjaxValidation' => false
	]
);

$custom_fields = new CustomFields($form, $model);
?>

<div class="visability-basic-options" style="margin:20px 0; overflow:hidden">
<?=$custom_fields->dropdown('default', 'site_id', [
	['value' => '21', 'text' => 'https://sociallocker.ru'],
	['value' => '54', 'text' => 'http://test.sociallocker.ru'],
]); ?>

<?=$custom_fields->dropdown('default', 'locker_id', $lockers); ?>

<?= $custom_fields->radio( 'lock_type', [
	['label' => 'Скрыть всю страницу', 'value' => 'absolute'],
	['label' => 'Внутри страницы', 'value' => 'inline']
], [
	'events' => [
		'.control-lock-selector' => [
			'inline'   => 'show',
			'absolute' => 'hide'
		]
	]
]);
?>
<div class="control-lock-selector">
	<?= $custom_fields->textInput('lock_selector'); ?>
</div>


<?= $custom_fields->radio( 'when_show', [
	['label' => 'При просмотре', 'value' => 'page_view'],
	['label' => 'При нажатии', 'value' => 'click_element'],
	['label' => 'При наведении', 'value' => 'hover_element'],
], [
	'events' => [
		'.control-target-selector' => [
			'click_element'  => 'show',
			'hover_element' => 'show',
			'page_view'     => 'hide'
		]
	]
] );
?>

<div class="control-target-selector">
	<?= $custom_fields->textInput('target_selector'); ?>
</div>

</div>
<?=ConditionEditor::widget([
	'form' => $form,
	'model' => $model,
	'attribute' => 'conditions',
	'filters' => $filters,
	'templates' => $templates,
    'save_button_id' => 'visability-save-button'
]);
?>
<div style="margin-top:20px;">
	<?php echo Html::submitButton( 'Сохранить', ['id' => 'visability-save-button', 'class' => 'btn btn-primary'] ) ?>
	<?php echo Html::a( 'Отменить', ['/lockers/visability/index'], ['class' => 'btn btn-warning'] ); ?>
</div>

<?php ActiveForm::end(); ?>