<?php
	namespace backend\assets;

	use yii\web\AssetBundle;

	class SettingsAsset extends AssetBundle {

		public $basePath = '@webroot';
		public $baseUrl = '@web';

		public $css = [
			'css/page.setting.css'
		];
		public $js = [
			'js/page.setting.js'
		];

		public $depends = [
			'yii\web\JqueryAsset',
			'yii\bootstrap\BootstrapAsset'
		];

		public $publishOptions = [
			'forceCopy' => true,
		];
	}
