<?php

use common\helpers\CustomFields;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Экспортирование подписчиков';
$this->params['breadcrumbs'][] = $this->title;

/* @var $form yii\widgets\ActiveForm */
/* @var array $channels */

?>

<div class="leads-search">

    <?php
    $form = ActiveForm::begin();
    $fields = new CustomFields( $form, $model );
    ?>

    <?=$fields->radio('format', [
        ['value'=>'csv',  'label' => 'CSV'],
        ['value'=>'xls',  'label' => 'XLS'],
        ['value'=>'txt',  'label' => 'TXT']
    ]); ?>

    <?=$fields->radio('delimiter', [
        ['value'=>',',  'label' => 'Запятая'],
        ['value'=>';',  'label' => 'Точка с запятой']
    ]) ?>

    <?php
        echo $fields->checkboxList('channels', $channels);
    ?>

    <?=$fields->radio('email_status', [
        ['value'=>'all',  'label' => 'Все'],
        ['value'=>'confirmed',  'label' => ' Только с подтвержденными email адресами'],
        ['value'=>'not-confirmed',  'label' => 'Только с не подтвержденными']
    ]) ?>

    <?=$fields->checkboxList('fields', [
        'lead_email' => 'Email',
        'lead_display_name' => 'Отображаемое имя',
        'lead_name' => 'Имя',
        'lead_family' => 'Фамилия',
        'lead_ip' => 'IP'
    ]);?>

    <div style="margin-left:15px;">
        <?= Html::submitButton( 'Экспорт подписчиков', ['class' => 'btn btn-primary'] ) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
