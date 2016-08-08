<?php
namespace common\modules\subscription\assets;

use yii\web\AssetBundle;

class LeadsAsset extends AssetBundle
{
	public $sourcePath = '@common/modules/subscription/views/leads/assets/';

    public $css = [
        'css/module-page.leads.css'
    ];
    public $js = [
    ];

    public $depends = [
	    'yii\web\JqueryAsset',
	    'yii\bootstrap\BootstrapAsset'
    ];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
