<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\GridView;
	use common\modules\lockers\models\Lockers;
	use common\modules\lockers\assets\ItemsListAsset;

	/* @var $this yii\web\View */
	/* @var $searchModel common\modules\lockers\models\search\LockersSearch */
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
				<i class="fa fa-check-square-o" aria-hidden="true"></i> Активные (<?= $searchModel->getCount(); ?>)
			</a>
		</li>
		<li>|</li>
		<li>
			<a href="<?= Url::to(['default/draft']); ?>" class="tab-draft">
				<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
				Не активные (<?= $searchModel->getCount('draft'); ?>)
			</a>
		</li>
		<li>|</li>
		<li>
			<a href="<?= Url::to(['default/trash']); ?>" class="tab-trash">
				<i class="fa fa-trash" aria-hidden="true"></i> Корзина (<?= $searchModel->getCount('trash'); ?>)
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
				'value' => function ($data) {
					$delete_route = Url::toRoute(['default/delete', 'id' => $data->id]);

					if( $data->status == 'trash' ) {
						$delete_route = Url::toRoute(['default/hard-delete', 'id' => $data->id]);
					}

					return Html::a($data->title, Url::toRoute(['default/edit', 'id' => $data->id]), [
						'title' => 'Перейти к редактированию' . $data->title,
						'class' => 'locker-list-title'
					]) . '<br>' . '[' . Html::a('Дублировать', Url::toRoute(['default/edit', 'id' => $data->id]), [
						'title' => 'Создать дубликат замка',
						'style' => 'font-size:13px'
					]) . " | " . Html::a('Удалить', $delete_route, [
						'title' => 'Удалить замок',
						'style' => 'color:#a00; font-size:13px'
					]) . ']';
				},
			],
			[
				'label' => 'Тип замка',
				'format' => 'raw',
				'value' => function ($data) {
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
			[
				'label' => 'Настройки',
				'format' => 'raw',
				'value' => function ($data) {
					$activate_button = '';

					if( $data->status == 'public' ) {
						$activate_button = '<a href="' . Url::toRoute([
								'default/deactivate',
								'id' => $data->id
							]) . '" class="btn btn-warning">Отключить</a>';
					} elseif( $data->status == 'draft' ) {
						$activate_button = '<a href="' . Url::toRoute([
								'default/activate',
								'id' => $data->id
							]) . '" class="btn btn-primary">Включить</a>';
					}

					return '<a href="' . Url::toRoute([
						'visability/edit',
						'locker_id' => $data->id
					]) . '" class="btn btn-default">Настройки отображения</a> ' . $activate_button;
				}
			],
		],
	]); ?>
</div>
