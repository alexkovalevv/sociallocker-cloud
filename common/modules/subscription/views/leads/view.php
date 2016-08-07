<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\subscription\models\Leads */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'lead_display_name',
            'lead_name',
            'lead_family',
            'lead_email:email',
            'lead_date',
            'lead_email_confirmed:email',
            'lead_subscription_confirmed',
            'lead_item_id',
            'lead_item_title',
            'lead_referer:ntext',
            'lead_confirmation_code',
            'lead_temp:ntext',
        ],
    ]) ?>

</div>
