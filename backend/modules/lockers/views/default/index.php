<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\modules\lockers\models\Lockers;
use backend\modules\lockers\assets\ItemsListAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\lockers\models\search\LockersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Социальные замки";
$this->params['breadcrumbs'][] = $this->title;

ItemsListAsset::register($this);
?>
<div class="lockers-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Создать замок', ['change-locker'], ['class' => 'btn btn-success']) ?>
    </p>
    <ul class="locker-status-tabs">
        <li>
            <a href="<?= Url::to(['default/index']); ?>" class="tab-public">
                <i class="fa fa-check-square-o" aria-hidden="true"></i> Опубликованные (<?=$searchModel->getCount();?>)
            </a>
        </li>
        <li>|</li>
        <li>
            <a href="<?= Url::to(['default/draft']); ?>" class="tab-draft">
                <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Черновики (<?=$searchModel->getCount('draft');?>)
            </a>
        </li>
        <li>|</li>
        <li>
            <a href="<?= Url::to(['default/trash']); ?>" class="tab-trash">
                <i class="fa fa-trash" aria-hidden="true"></i> Корзина (<?=$searchModel->getCount('trash');?>)
            </a>
        </li>
    </ul>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
	        ['class' => 'yii\grid\CheckboxColumn'],
	        [
		        'label' => 'Название замка',
		        'format' => 'raw',
		        'value' => function($data){
			        return Html::a($data->title, Url::toRoute('default/edit?id=' . $data->id . '&type=' . $data->type),[
				        'title'=>'Перейти к редактированию' . $data->title, 'class' => 'locker-list-title'
			        ]) . '<br>' .
			        '[' . Html::a('Дублировать', Url::toRoute('default/edit?id=' . $data->id . '&type=' . $data->type),[
				        'title'=> 'Создать дубликат замка', 'style' => 'font-size:13px'
			        ]) . " | " .
			        Html::a('Удалить', Url::toRoute('default/delete?id=' . $data->id),[
				        'title'=> 'Удалить замок', 'style' => 'color:#a00; font-size:13px'
			        ]) . ']';
		        },
	        ],
	        [
		        'label'  => 'Тип замка',
		        'format' => 'raw',
		        'value'  => function ( $data ) {
			        switch( $data->type ) {
				        case 'sociallocker':
					        return 'социальный замок';
				        case 'signinlocker':
					        return 'замок авторизации';
				        case 'emaillocker':
					        return 'email замок';
				        default:
					        return $data->type;
					        break;
			        }
		        }
	        ],
            'created_at:datetime'
        ],
    ]); ?>

</div>
