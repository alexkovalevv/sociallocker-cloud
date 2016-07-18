<?php
namespace backend\modules\lockers\assets;

use yii\web\AssetBundle;

class ItemSelectAsset extends AssetBundle
{
	public $sourcePath = '@backend/modules/lockers/views/default/assets/';

	public $css = [
		'css/module-page.select-item.css'
	];
	public $js = [
	];

	public $depends = [

	];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
