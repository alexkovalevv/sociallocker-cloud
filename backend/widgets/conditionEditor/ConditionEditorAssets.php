<?php
	/**
	 * Подключение файлов для редактора
	 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
	 * @package yii2-widgets
	 * @version 1.0.0
	 */
	namespace backend\widgets\conditionEditor;

	use yii\web\AssetBundle;

	class ConditionEditorAssets extends AssetBundle {

		public $sourcePath = '@backend/widgets/conditionEditor/views/assets/';

		public $js = [
			'js/widget.widgets-factory.js',
			'js/widget.general.js'
		];

		public $css = [
			'css/widget.general.css'
		];

		public $depends = [
			'yii\web\JqueryAsset',
			'yii\bootstrap\BootstrapAsset'
		];

		public $publishOptions = [
			'forceCopy' => true,
		];
	}
