<?php
namespace common\modules\lockers\assets;

use yii\web\AssetBundle;

class ItemsListAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/lockers/views/default/assets/';

    public $css = [
        'css/module-page.list-items.css'
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
