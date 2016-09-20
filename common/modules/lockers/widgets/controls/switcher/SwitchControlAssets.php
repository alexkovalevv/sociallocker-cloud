<?php
/**
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.3.1
 */
namespace common\modules\lockers\widgets\controls\switcher;

use yii\web\AssetBundle;

class SwitchControlAssets extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/widgets/controls/switcher/views/assets/';

	public $js = [
        'js/widget.general.js'
	];

	public $css = [

	];

	public $depends = [
		'yii\web\JqueryAsset',
		'yii\bootstrap\BootstrapAsset'
	];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
