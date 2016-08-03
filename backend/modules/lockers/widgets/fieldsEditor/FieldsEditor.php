<?php
/**
 * Редактор полей формы подписки
 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.3.1
 */
namespace backend\modules\lockers\widgets\fieldsEditor;

use Yii;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\modules\lockers\widgets\fieldsEditor\FieldsEditorAssets;


class FieldsEditor extends Widget
{
    public $model;
    public $attribute;

    public $listIdFieldName;
    public $ajaxUrl;
    public $res = [];

	public function init()
	{
		parent::init();

        $resDefault = [
            'service-title' => '',
            'unexpected-error' => '',
            'email-field-hint' => 'The value from this field will be used as an email address. This field is always required.',
            'email-field-placeholder' => '',
            'fullname-field-hint' => 'The value from this field will be splited (if possible) into the two parts: First and Last Namey. Use this field instead of creating a separate field for each name.',
            'fullname-field-placeholder' => '',
            'loading-state' => '[ - loading - ]',
            'error-state'   => '[ - error - ]',
            'phone-field-placeholder' => 'enter your phone number',
            'birthday-field-placeholder' => 'enter your birthday',
            'checkbox-default-description' => 'Write here why the user has to mark it.',
            'label-default-text' => 'Text Label:',
            'unsupported' => '[ - unsupported- ]',
            'unsupported-type' => 'The custom field of this type is not supported currently with the plugin.'
        ];

        $this->res = ArrayHelper::merge($this->res, $resDefault);
	}

	public function run()
	{
		parent::run();

		$this->renderAssets();

        return $this->render('index');
	}

	public function renderAssets() {
		$view = $this->getView();
        FieldsEditorAssets::register($view);

        $js = <<<JS
        if( !window.fieldsEditor) window.fieldsEditor = {};

        window.fieldsEditor.ajaxUrl = '{$this->ajaxUrl}';
        window.fieldsEditor.listIdFieldName = '{$this->listIdFieldName}';

        if ( !window.fieldsEditor.res ) window.fieldsEditor.res = {};

        window.fieldsEditor.res['service-title'] = "{$this->res['service-title']}";
        window.fieldsEditor.res['unexpected-error'] = "{$this->res['unexpected-error']}";
        window.fieldsEditor.res['email-field-hint'] = "{$this->res['email-field-hint']}";
        window.fieldsEditor.res['email-field-placeholder'] = "{$this->res['email-field-placeholder']}";
        window.fieldsEditor.res['fullname-field-hint'] = "{$this->res['fullname-field-hint']}";
        window.fieldsEditor.res['fullname-field-placeholder'] = "{$this->res['fullname-field-placeholder']}";
        window.fieldsEditor.res['loading-state'] = "{$this->res['loading-state']}";
        window.fieldsEditor.res['error-state'] = "{$this->res['error-state']}";
        window.fieldsEditor.res['phone-field-placeholder'] = "{$this->res['phone-field-placeholder']}";
        window.fieldsEditor.res['birthday-field-placeholder'] = "{$this->res['birthday-field-placeholder']}";
        window.fieldsEditor.res['checkbox-default-description'] = "{$this->res['checkbox-default-description']}";
        window.fieldsEditor.res['label-default-text'] = "{$this->res['label-default-text']}";
        window.fieldsEditor.res['unsupported'] = "{$this->res['unsupported']}";
        window.fieldsEditor.res['unsupported-type'] = "{$this->res['unsupported-type']}";
JS;

        $view->registerJs($js, $view::POS_END);
	}


}