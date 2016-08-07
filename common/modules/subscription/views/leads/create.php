<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\subscription\models\Leads */

$this->title = 'Create Leads';
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
