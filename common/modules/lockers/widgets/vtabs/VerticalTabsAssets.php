<?php
/**
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.3.1
 */
namespace common\modules\lockers\widgets\vtabs;

use yii\web\AssetBundle;

class VerticalTabsAssets extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/widgets/vtabs/assets/';

	public $js = [
	];

	public $css = [
		'css/widget.vertical-tabs.css'
	];

	public $depends = [
		'yii\bootstrap\BootstrapAsset'
	];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
