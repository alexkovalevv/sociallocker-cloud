<?php
namespace common\modules\lockers\assets;

use yii\web\AssetBundle;

class ItemSelectAsset extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/views/default/assets/';

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
