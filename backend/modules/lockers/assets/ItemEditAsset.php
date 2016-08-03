<?php
namespace backend\modules\lockers\assets;

use yii\web\AssetBundle;

class ItemEditAsset extends AssetBundle
{
	public $sourcePath = '@backend/modules/lockers/views/default/assets/';

    public $css = [
        'css/module-page.edit-item.css',
        'css/module.lockers-ru_RU.010008.min.css'
    ];
    public $js = [
        'js/module-page.edit-item.js',
        'js/libs/jquery.sortable.min.js',
        'js/module.lockers-ru_RU.010008.min.js'
    ];

    public $depends = [
	    'yii\web\JqueryAsset',
	    'yii\bootstrap\BootstrapAsset'
    ];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
