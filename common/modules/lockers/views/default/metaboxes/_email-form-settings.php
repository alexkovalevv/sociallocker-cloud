<?php
	/**
	 * Шаблон настроек email формы. Часть шаблона редактирования замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @package emaillocker-create
	 */

	use backend\widgets\fieldsEditor\FieldsEditor;
	use yii\helpers\Url;

	/* @var $model common\base\MultiModel */

	$fields->model = $model->getModel('email_form_settings');
?>

<?= $fields->radio('form_type', [
	['label' => '<i class="fa fa-envelope-o"></i> Только Email', 'value' => 'email-form'],
	['label' => '<i class="fa fa-user"></i> Имя &amp; Email', 'value' => 'name-email-form'],
	['label' => '<i class="fa fa-puzzle-piece"></i> Своя форма', 'value' => 'custom-form']
], [
	'events' => [
		'.fields-editor' => [
			'name-email-form' => 'hide',
			'email-form' => 'hide',
			'custom-form' => 'show'
		]
	]
]);
?>

<?= FieldsEditor::widget([
	'model' => $fields->model,
	'ajaxUrl' => Url::to('@backendUrl/subscribe/get-custom-fields', true),
	'listIdFieldName' => 'subscribe_list',
	'resultFieldName' => 'custom_fields'
]);
?>

<?= $fields->hidden('custom_fields'); ?>

<?= $fields->checkbox('subscribe_allow_social', [
	'events' => ['.social-buttons-options']
]); ?>
<div class="social-buttons-options">
	<?= $fields->textInput('subscribe_social_text'); ?>

	<?= $fields->checkboxList('subscribe_social_buttons', [
		'facebook' => 'Facebook',
		'google' => 'Google',
		'twitter' => 'Twitter',
		'linkedin' => 'LinkedIn',
		'vk' => 'Вконтакте'
	]); ?>
</div>
