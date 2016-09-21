<?php
namespace common\modules\lockers\assets;

use yii\web\AssetBundle;

class VisabilityEditAsset extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/views/visability/assets/';

    public $css = [];
    public $js = [
	    'js/module-page.visability-edit.js'
    ];

    public $depends = [
	    'yii\web\JqueryAsset',
	    'yii\bootstrap\BootstrapAsset'
    ];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
