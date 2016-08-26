<?php
/**
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.3.1
 */
namespace common\modules\lockers\widgets\controls\dropdown;

use yii\web\AssetBundle;

class DropdownControlAssets extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/widgets/controls/dropdown/views/assets/';

	public $js = [
		'js/widget.dropdown.min.js',
	    'js/widget.ddslick.js',
	    'js/widget.general.js'
	];

	public $css = [
		'css/widget.dropdown.min.css',
		'css/widget.general.css',
		//'css/widget.ddslick'
	];

	public $depends = [
		'yii\bootstrap\BootstrapAsset'
	];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
