<?php
	/**
	 * Eugine Terentev <eugine@terentev.net>
	 * @var $this \yii\web\View
	 * @var $model \common\models\TimelineEvent
	 * @var $dataProvider \yii\data\ActiveDataProvider
	 */
	use common\modules\lockers\assets\StatEventsAsset;

	$this->title = Yii::t('backend', 'Уведомления');
	$icons = [
		'user' => '<i class="fa fa-user bg-blue"></i>'
	];

	$this->registerAssetBundle(StatEventsAsset::className())
?>
<?php \yii\widgets\Pjax::begin() ?>
<div class="row">
	<div class="col-md-12">
		<?php if( $dataProvider->count > 0 ): ?>
			<ul class="timeline">
				<?php foreach($dataProvider->getModels() as $model): ?>
					<?php if( !isset($date) || $date != Yii::$app->formatter->asDate($model->created_at) ): ?>
						<!-- timeline time label -->
						<li class="time-label">
                            <span class="bg-blue">
                                <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
                            </span>
						</li>
						<?php $date = Yii::$app->formatter->asDate($model->created_at) ?>
					<?php endif; ?>
					<li>
						<?php
							echo $this->render('_item', ['model' => $model]);
						?>
					</li>
				<?php endforeach; ?>
				<li>
					<i class="fa fa-clock-o">
					</i>
				</li>
			</ul>
		<?php else: ?>
			<?php echo Yii::t('backend', 'No events found') ?>
		<?php endif; ?>
	</div>
	<div class="col-md-12 text-center">
		<?php echo \yii\widgets\LinkPager::widget([
			'pagination' => $dataProvider->pagination,
			'options' => ['class' => 'pagination']
		]) ?>
	</div>
</div>
<?php \yii\widgets\Pjax::end() ?>

