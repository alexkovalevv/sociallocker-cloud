<?php
/**
 * Подключение файлов для редактора полей формы подписки
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.0.0
 */
namespace common\modules\lockers\widgets\fieldsEditor;

use yii\web\AssetBundle;

class FieldsEditorAssets extends AssetBundle
{
	public $sourcePath = '@common/modules/lockers/widgets/fieldsEditor/views/assets/';

	public $js = [
        'js/libs/jquery-ui-sortable.min.js',
        'js/widget.widgets-factory.js',
        'js/widget.general.js'
	];

    public $css = [
        'css/widget.general.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];

	public $publishOptions = [
		'forceCopy'=>true,
	];
}
