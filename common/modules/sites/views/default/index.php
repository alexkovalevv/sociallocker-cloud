<?php
	use yii\helpers\Html;
	use yii\grid\GridView;
	use common\modules\sites\models\SitesForm;

	/* @var $this yii\web\View */
	/* @var $searchModel common\modules\sites\models\SitesSearche */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Мои сайты';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sites-index">
	<p>
		<?= Html::a('Добавить сайт', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'label' => 'Название сайта',
				'format' => 'raw',
				'value' => function ($data) {
					return $data->title;
				}
			],
			[
				'label' => 'Адрес сайта',
				'format' => 'raw',
				'value' => function ($data) {
					return $data->url;
				}
			],
			[
				'label' => 'Статус',
				'format' => 'raw',
				'value' => function ($data) {
					$status = $data->status === SitesForm::STATUS_ACTIVE
						? '<small class="label pull-center bg-green">Активен</small>'
						: '<small class="label pull-center bg-red">Не активен</small>';

					return $status;
				}
			],
			[
				'label' => 'Модерация',
				'format' => 'raw',
				'value' => function ($data) {
					$status = $data->approve === SitesForm::APPROVE
						? '<small class="label bg-green">Прошел модерацию</small>'
						: '<small class="label bg-yellow">Ожидает проверки</small>';

					return $status;
				}
			],
			// 'created_at',
			// 'updated_at',

			//['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
