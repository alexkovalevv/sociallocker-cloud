<?php
	namespace common\modules\lockers\assets;

	use yii\web\AssetBundle;

	class StatChartsAsset extends AssetBundle {

		public $sourcePath = '@common/modules/lockers/views/stats/charts/assets/';

		public $css = [
			'css/module-lockers.stat-charts.css'
		];
		public $js = [
			'https://www.google.com/jsapi',
			'js/module-lockers.stat-charts.js'
		];

		public $depends = [
			'yii\web\JqueryAsset'
		];

		public $publishOptions = [
			'forceCopy' => true,
		];
	}
