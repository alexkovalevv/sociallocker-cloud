<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model common\modules\subscription\models\LeadsSearch */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="leads-search">
	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'lead_display_name') ?>

	<?= $form->field($model, 'lead_name') ?>

	<?= $form->field($model, 'lead_family') ?>

	<?= $form->field($model, 'lead_email') ?>

	<?php // echo $form->field($model, 'lead_date') ?>

	<?php // echo $form->field($model, 'lead_email_confirmed') ?>

	<?php // echo $form->field($model, 'lead_subscription_confirmed') ?>

	<?php // echo $form->field($model, 'locker_id') ?>

	<?php // echo $form->field($model, 'lead_item_title') ?>

	<?php // echo $form->field($model, 'lead_referer') ?>

	<?php // echo $form->field($model, 'lead_confirmation_code') ?>

	<?php // echo $form->field($model, 'lead_temp') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>
