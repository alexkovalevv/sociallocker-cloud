<?php
namespace common\modules\lockers\assets;

use yii\web\AssetBundle;

class SettingsAsset extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/views/settings/assets/';

    public $css = [
        'css/module-page.setting.css'
    ];
    public $js = [
	    'js/module-page.setting.js'
    ];

    public $depends = [
	    'yii\web\JqueryAsset',
	    'yii\bootstrap\BootstrapAsset'
    ];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
