<?php
/**
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.3.1
 */
namespace backend\modules\lockers\widgets\controls\switcher;

use yii\web\AssetBundle;

class SwitchControlAssets extends AssetBundle
{
	public $sourcePath = '@backend/modules/lockers/widgets/switch/assets/';

	public $js = [
	];

	public $css = [

	];

	public $depends = [
		'yii\bootstrap\BootstrapAsset'
	];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
