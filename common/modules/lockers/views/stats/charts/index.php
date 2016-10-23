<?php
	/**
	 * Представление общей статистики виджетов
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	/* @var $this yii\web\View */
	/* @var $chart common\modules\lockers\controllers\StatsController */

	use \common\helpers\StatsTools;
	use \common\modules\lockers\assets\StatChartsAsset;
	use common\modules\lockers\widgets\controls\dropdown\DropdownControl;
	use yii\helpers\Url;
	use yii\jui\DatePicker;
	use yii\helpers\HtmlPurifier;

	$this->title = Yii::t('backend', 'Статистика и отчеты');
	$icons = [
		'user' => '<i class="fa fa-user bg-blue"></i>'
	];

	$chart_type = $chart->type;
	$print_chart_data = $chart->getData();

	$js = <<<JS

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(function(){
              window.bizpanda.statistics.drawChart({
                  'type': '$chart_type'
              });
          });

          //window.opanda_default_selectors = [];
          window.opanda_default_selectors = ['unlock-via-facebook-like','unlock-via-twitter-tweet','unlock-via-google-plus','unlock-via-vk-share'];
          window.chartData = [$print_chart_data];
JS;

	$this->registerJs($js, $this::POS_END);
	$this->registerAssetBundle(StatChartsAsset::className())
?>
<div id="opanda-control-panel">
	<form method="get" id="opanda-item-selector" class="opanda-right">
		<input type="hidden" name="screen" value="<?= Yii::$app->request->getQueryParam('screen') ?>">
		<input type="hidden" name="date_start" class="form-control"
		       value="<?= Yii::$app->request->getQueryParam('date_start') ?>">
		<input type="hidden" name="date_end" class="form-control"
		       value="<?= Yii::$app->request->getQueryParam('date_end') ?>">
		<span>Тип замков:</span>
		<?php ?>
		<?= DropdownControl::widget([
			'attribute' => 'locker_type',
			'width' => 300,
			'items' => [
				['value' => 'sociallocker', 'text' => 'Социальные замки'],
				['value' => 'signinlocker', 'text' => 'Замки авторизации'],
				['value' => 'emaillocker', 'text' => 'Email замки'],
			],
			'default' => $locker_type
		]); ?>

		<span>Замки:</span>
		<?php
			$lockers = Yii::$app->lockers->getLockers(['type' => $locker_type]);

			$lockers_list = [
				['value' => 0, 'text' => 'Все замки'],
			];
			foreach($lockers as $locker) {
				$lockers_list[] = ['value' => $locker->id, 'text' => $locker->title];
			}
		?>

		<?= DropdownControl::widget([
			'attribute' => 'locker_id',
			'width' => 300,
			'items' => $lockers_list,
			'default' => Yii::$app->request->getQueryParam('locker_id', 0)
		]); ?>
	</form>
</div>
<div class="factory-bootstrap-000 factory-fontawesome-000">
	<div class="onp-chart-hints">
		<div class="onp-chart-hint onp-chart-hint-errors">
			This chart shows the count of times when the locker was not available to use due to the visitor installed
			the extensions like Avast or Adblock which may block social networks.<br/>By default, the such visitors see
			the locker without social buttons but with the offer to disable the extensions. You can set another
			behaviour <a href="#"><strong>here</strong></a>.
		</div>
	</div>
	<div id="opanda-chart-description">
		<?php echo $currentScreen['description'] ?>
	</div>
	<div id="onp-sl-chart-area">
		<form method="get">
			<div id="onp-sl-settings-bar">
				<div id="onp-sl-type-select">
					<div class="btn-group" id="chart-type-group">
						<?php foreach($screens as $screenName => $screen) { ?>
							<a href="<?= Url::current(['screen' => $screenName]); ?>"
							   class="btn btn-default <?php if( $screenName == $current_screen_name ) {
								   echo 'active';
							   } ?> type-<?php echo $screenName ?>"
							   data-value="<?php echo $screenName ?>"><?php echo $screen['title'] ?></a>
						<?php } ?>
					</div>
				</div>
				<div id="onp-sl-date-select">
					<input type="hidden" name="locker_type"
					       value="<?= Yii::$app->request->getQueryParam('locker_type') ?>">
					<input type="hidden" name="locker_id" value="<?= Yii::$app->request->getQueryParam('locker_id') ?>">
					<input type="hidden" name="screen" value="<?= Yii::$app->request->getQueryParam('screen') ?>">
					<span class="onp-sl-range-label">Период:</span>

					<?= DatePicker::widget([
						'name' => 'date_start',
						'language' => 'ru',
						'dateFormat' => 'MM/dd/yyyy',
						'value' => date('m/d/Y', $date_start),
						'options' => ['id' => 'onp-sl-date-start']
					]) ?>
					<?= DatePicker::widget([
						'name' => 'date_end',
						'language' => 'ru',
						'dateFormat' => 'MM/dd/yyyy',
						'value' => date('m/d/Y', $date_end),
						'options' => ['id' => 'onp-sl-date-end']
					]) ?>

					<button type="submit" id="onp-sl-apply-dates" class="btn btn-default">
						Применить
					</button>
				</div>
			</div>
		</form>
		<div class="chart-wrap">
			<div id="chart" style="width: 100%; height: 195px;"></div>
		</div>
	</div>
	<div id="onp-sl-chart-selector">
		<?php if( $chart->hasSelectors() ) { ?>
			<?php foreach($chart->getSelectors() as $name => $field) { ?>
				<div class="onp-sl-selector-item onp-sl-selector-<?php echo $name ?>"
				     data-selector="<?php echo $name ?>">
					<span class="chart-color" style="background-color: <?php echo $field['color'] ?>"></span>
					<?php echo $field['title'] ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
	<p>Топ-50 записей и страниц, где вы установили замок, отсортированы по популярности использования:</p>

	<div id="opanda-data-table-wrap">
		<table id="opanda-data-table" class="<?php echo $table_css_class ?>">
			<thead>
			<?php if( $table->hasComplexColumns() ) { ?>

				<tr>
					<?php foreach($table->getHeaderColumns() as $name => $column) { ?>
						<th rowspan="<?php echo $column['rowspan'] ?>" colspan="<?php echo $column['colspan'] ?>"
						    class="opanda-col-<?php echo $name ?> <?php echo isset($column['cssClass'])
							    ? $column['cssClass']
							    : '' ?> <?php if( isset($column['highlight']) ) {
							    echo 'opanda-column-highlight';
						    } ?>">
							<?php echo $column['title'] ?>
							<?php if( isset($column['hint']) ) { ?>
								<i class="opanda-hint" title="<?php echo $column['hint']; ?>"></i>
							<?php } ?>
						</th>
					<?php } ?>
				</tr>
				<tr>
					<?php foreach($table->getHeaderColumns(2) as $name => $column) { ?>
						<th class="opanda-col-<?php echo $name ?> <?php echo isset($column['cssClass'])
							? $column['cssClass']
							: '' ?> <?php if( isset($column['highlight']) ) {
							echo 'opanda-column-highlight';
						} ?>">
							<?php echo $column['title'] ?>
							<?php if( isset($column['hint']) ) { ?>
								<i class="opanda-hint" title="<?php echo $column['hint']; ?>"></i>
							<?php } ?>
						</th>
					<?php } ?>
				</tr>

			<?php } else { ?>

				<?php foreach($table->getColumns() as $name => $column) { ?>
					<th class="opanda-column-<?php echo $name ?> <?php echo isset($column['cssClass'])
						? $column['cssClass']
						: '' ?> <?php if( isset($column['highlight']) ) {
						echo 'opanda-column-highlight';
					} ?>">
						<?php echo $column['title'] ?>
						<?php if( isset($column['hint']) ) { ?>
							<i class="opanda-hint" title="<?php echo $column['hint']; ?>"></i>
						<?php } ?>
					</th>
				<?php } ?>

			<?php } ?>
			</thead>
			<tbody>
			<?php for($i = 0; $i < $table->getRowsCount(); $i++) {
				if( $i >= 50 ) {
					break;
				} ?>
				<tr>
					<?php foreach($table->getDataColumns() as $name => $column) { ?>
						<td class="opanda-col-<?php echo $name ?> <?php echo isset($column['cssClass'])
							? $column['cssClass']
							: '' ?> <?php if( isset($column['highlight']) ) {
							echo 'opanda-column-highlight';
						} ?>">
							<?php $table->printValue($i, $name, $column) ?>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>