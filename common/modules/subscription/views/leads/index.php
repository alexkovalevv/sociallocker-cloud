<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\modules\subscription\assets\LeadsAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\subscription\models\LeadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подписчики';
$this->params['breadcrumbs'][] = $this->title;

LeadsAsset::register($this);
?>
<div class="leads-index">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn'],
                [
                    'label' => 'Канал',
                    'headerOptions' => ['class' => 'lead-avatar-column'],
                    'format' => 'raw',
                    'value' => function($data){
                        return '<a href="#" class="lead-avatar"><img src="http://2.gravatar.com/avatar/5e5a5d9d4993c8f1532a976a0df903f6?s=50&d=mm&r=g" width="40" height="40" alt="Аватар пользователя"></a>';
                    }
                ],
                [
                    'label' => 'Заголовок',
                    'format' => 'raw',
                    'value' => function($data){
                        return '<a href="' . Url::to(['#']) . '" class="lead-user-display-name">' . $data->lead_display_name . '</a><br>' . $data->lead_email;
                    }
                ],
                [
                    'label' => 'Канал',
                    'format' => 'raw',
                    'value' => function($data){
                        return 'Добавлен через: <a href="#">' . $data->lead_item_title . '</a>';
                    }
                ],
                'lead_date',
                [
                    'label' => 'Статус',
                    'format' => 'raw',
                    'value' => function($data){
                        return '<span class="opanda-status-help" title="Этот email не был подтвержден. Это означает, что этот адрес электронной почты может принадлежать другому пользователю.">'.
                                   ($data->lead_email_confirmed ? '<i class="fa fa-check-circle-o"></i>' : '<i class="fa fa-circle-o"></i>').
                                   ' <i>email</i>
                                </span>';
                    }
                ],
                //'lead_email_confirmed:email',
                // 'lead_subscription_confirmed',
                // 'lead_item_id',
                // 'lead_item_title',
                // 'lead_referer:ntext',
                // 'lead_confirmation_code',
                // 'lead_temp:ntext',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
