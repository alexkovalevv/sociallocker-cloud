<?php

	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;
	use yii\helpers\Url;
	use backend\assets\LeadsAsset;
	use common\helpers\LeadsTools;

	/* @var $this yii\web\View */
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
		'columns' => [
			['class' => 'yii\grid\CheckboxColumn'],
			[
				'label' => '',
				'headerOptions' => ['class' => 'lead-avatar-column'],
				'format' => 'raw',
				'value' => function ($data) {
					return '<a href="#" class="lead-avatar">' . LeadsTools::getAvatar($data->id) . '</a>';
				}
			],
			[
				'label' => 'Заголовок',
				'format' => 'raw',
				'value' => function ($data) {
					$lead_full_name = '<strong style="color:#5d5d5d">Безымянный</strong>';

					if( !empty($data->display_name) ) {
						$lead_full_name = '<a href="' . Url::to(['#']) . '" class="lead-user-display-name">' . $data->display_name . '</a>';
					}

					return $lead_full_name . LeadsTools::getServiceIcon($data->id) . '<br>' . $data->email;
				}
			],
			[
				'label' => 'Канал',
				'format' => 'raw',
				'value' => function ($data) {
					return 'Добавлен через: <a href="' . Url::to(['/lockers/default/edit?id=' . $data->locker_id]) . '">' . $data->locker_title . '</a>';
				}
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'label' => 'Статус',
				'format' => 'raw',
				'value' => function ($data) {
					return '<span class="opanda-status-help" title="Этот email не был подтвержден. Это означает, что этот адрес электронной почты может принадлежать другому пользователю.">' . ($data->email_confirmed
						? '<i class="fa fa-check-circle-o"></i>'
						: '<i class="fa fa-circle-o"></i>') . ' <i>email</i>
                                </span>';
				}
			],
			//'lead_email_confirmed:email',
			// 'lead_subscription_confirmed',
			// 'locker_id',
			// 'lead_item_title',
			// 'lead_referer:ntext',
			// 'lead_confirmation_code',
			// 'lead_temp:ntext',

			//['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php Pjax::end(); ?>
</div>
