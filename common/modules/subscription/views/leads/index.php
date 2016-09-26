<?php

	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;
	use yii\helpers\Url;
	use common\modules\subscription\assets\LeadsAsset;
	use common\modules\subscription\classes\LeadsHelper;

	/* @var $this yii\web\View */
	/* @var $searchModel common\modules\subscription\models\LeadsSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Подписчики';
	$this->params['breadcrumbs'][] = $this->title;

	LeadsAsset::register($this);
?>
<div class="leads-index">
	<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<a href="<?= Url::to(['export']); ?>" class="btn btn-success">Экспорт</a>
		<a href="#" class="btn btn-danger">Удалить всех</a>
	</p>

	<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\CheckboxColumn'],
			[
				'label' => '',
				'headerOptions' => ['class' => 'lead-avatar-column'],
				'format' => 'raw',
				'value' => function ($data) {
					return '<a href="#" class="lead-avatar">' . LeadsHelper::getAvatar($data->id) . '</a>';
				}
			],
			[
				'label' => 'Заголовок',
				'format' => 'raw',
				'value' => function ($data) {
					$lead_full_name = '<strong style="color:#5d5d5d">Безымянный</strong>';

					if( !empty($data->lead_display_name) ) {
						$lead_full_name = '<a href="' . Url::to(['#']) . '" class="lead-user-display-name">' . $data->lead_display_name . '</a>';
					}

					return $lead_full_name . LeadsHelper::getSourceIcons($data->id) . '<br>' . $data->lead_email;
				}
			],
			[
				'label' => 'Канал',
				'format' => 'raw',
				'value' => function ($data) {
					return 'Добавлен через: <a href="' . Url::to(['/lockers/default/edit?id=' . $data->lead_item_id]) . '">' . $data->lead_item_title . '</a>';
				}
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'label' => 'Статус',
				'format' => 'raw',
				'value' => function ($data) {
					return '<span class="opanda-status-help" title="Этот email не был подтвержден. Это означает, что этот адрес электронной почты может принадлежать другому пользователю.">' . ($data->lead_email_confirmed
						? '<i class="fa fa-check-circle-o"></i>'
						: '<i class="fa fa-circle-o"></i>') . ' <i>email</i>
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
