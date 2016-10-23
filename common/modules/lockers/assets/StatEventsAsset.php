<?php
	namespace common\modules\lockers\assets;

	use yii\web\AssetBundle;

	class StatEventsAsset extends AssetBundle {

		public $sourcePath = '@common/modules/lockers/views/stats/events/assets';

		public $css = [
			'css/module-lockers.stat-events.css'
		];
		public $js = [
			//'js/module-page.events.js'
		];

		public $depends = [
			'yii\web\JqueryAsset',
			'yii\bootstrap\BootstrapAsset'
		];

		public $publishOptions = [
			'forceCopy' => true,
		];
	}
