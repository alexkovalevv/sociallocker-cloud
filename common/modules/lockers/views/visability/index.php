<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\modules\lockers\assets\ItemsListAsset;
use common\modules\lockers\models\lockers\Lockers;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\lockers\models\search\LockersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Правила и условия отображения замков";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lockers-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Новое условие', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
	        ['class' => 'yii\grid\CheckboxColumn'],
	        [
		        'label' => 'Название условия',
		        'format' => 'raw',
		        'value' => function($data){
			        return Html::a($data->title, Url::toRoute('visability/edit?id=' . $data->id ),[
				        'title'=>'Перейти к редактированию' . $data->title, 'class' => 'locker-list-title'
			        ]) . '<br>[' .
			        Html::a('Удалить', Url::toRoute('visability/delete?id=' . $data->id),[
				        'title'=> 'Удалить условие', 'style' => 'color:#a00; font-size:13px'
			        ]) . ']';
		        },
	        ],
	        [
		        'label' => 'Тип блокировки',
		        'format' => 'raw',
		        'value' => function($data){
			        if( $data->way_lock == 'html' ) {
				        return 'Контент заблокирован через вставку кода:
 						<pre style="padding:15px">&lt;div class="'. str_replace('.', '', $data->lock_selector) . '"&gt;&lt;/div&gt;</pre>
 						<small style="color:#414141"><i>Скопируйте код выше и вставьте его в любое место на вашем сайте, после вставки и обновления страницы, замок появится в этом месте.</i></small>';
			        } else if($data->way_lock == 'css') {
						return 'Контент заблокирован через css селектор: <strong>' . $data->lock_selector . '</strong>';
			        }
			        return '';
		        },
	        ],

	        [
		        'label' => 'Характеристики',
		        'format' => 'raw',
		        'value' => function($data){
			        return '<strong>Сайт:</strong><br> https://sociallocker.ru<br><strong>Замок:</strong><br> <span style="white-space: nowrap;">' . Lockers::findModel($data->locker_id)->title . '</span>';
		        },
	        ]
        ],
    ]); ?>

</div>
