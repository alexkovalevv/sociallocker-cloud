<?php

	use common\helpers\CustomFields;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;


	/* @var $this yii\web\View */
	/* @var $model common\modules\sites\models\Sites */

	$this->title = 'Подключение сайта Шаг. 1';
	$this->params['breadcrumbs'][] = ['label' => 'Мои сайты', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sites-create-step1">
	<?php
		$form = ActiveForm::begin([
			'enableClientValidation' => false,
			'enableAjaxValidation' => false
		]);

		// Настройка полей ActiveForm под требования проекта
		$fields = new CustomFields($form, $model);
	?>
	<div style="width:450px;">
		<?= $fields->textInput('url'); ?>
	</div>
	<div>
		<?= Html::submitButton('Создать', ['class' => 'btn btn-default']); ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>

