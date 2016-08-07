<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\subscription\models\Leads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lead_display_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead_family')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead_date')->textInput() ?>

    <?= $form->field($model, 'lead_email_confirmed')->textInput() ?>

    <?= $form->field($model, 'lead_subscription_confirmed')->textInput() ?>

    <?= $form->field($model, 'lead_item_id')->textInput() ?>

    <?= $form->field($model, 'lead_item_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead_referer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lead_confirmation_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead_temp')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
