<?php
	use common\modules\lockers\models\Lockers;
	use yii\grid\GridView;
	use yii\helpers\Html;
	use yii\helpers\Url;

	/* @var $this yii\web\View */
	/* @var $searchModel common\modules\lockers\models\stats\StatUnlocksSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Уведомления';
	$this->params['breadcrumbs'][] = $this->title;

?>
<div class="events">
	<?php echo GridView::widget([
		'dataProvider' => $data_provider,
		//'filterModel' => $searchModel,
		'columns' => [
			//['class' => 'yii\grid\CheckboxColumn'],
			[
				'label' => 'Пользователь',
				'format' => 'raw',
				'value' => function ($data) {
					return $data->network_user_id;
				},
			],
			[
				'label' => 'Событие',
				'format' => 'raw',
				'value' => function ($data) {
					return 'Поделился записью страницей ' . $data->page_title . '';
				},
			],
		],
	]); ?>
</div>
