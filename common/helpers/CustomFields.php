<?php
/**
 * В классе содержатся методы облегчающие работу с полями Active Form
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace common\helpers;

use yii;
use yii\base\Exception;
use yii\base\Model;
use yii\bootstrap\ActiveForm;
use yii\imperavi\Widget;
use backend\modules\lockers\widgets\controls\dropdown\DropdownControl;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

/* @var $form \yii\bootstrap\ActiveForm */
/* @var $model \common\base\MultiModel */

class CustomFields {

	public $form;
	public $model;

	public function __construct(ActiveForm $form, Model $model)
	{
		$this->form = $form;
		$this->model = $model;
	}

	public function textInput($attribute, array $options = [])
	{

		if( empty($this->model->$attribute) ) {
			$options['value'] = $this->getFieldValueDefault($attribute);
		}

		return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
			->textInput($options);
	}

	public function textarea($attribute, array $options = [])
	{
		if( empty($this->model->$attribute) ) {
			$options['value'] = $this->getFieldValueDefault($attribute);
		}

		return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
			->textarea($options);
	}

	public function dropdown($type, $attribute, $items, $ajax = false)
	{
		return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))->widget(
			DropdownControl::classname(), [
				'type'      => $type,
				'default'   => $this->getFieldValueDefault($attribute),
				'ajax'      => $ajax,
				'items'     => $items
			]
		);
	}

	public function editor($attribute) {
		return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))->widget(
			Widget::className(),
			[
				'plugins' => ['fullscreen', 'fontcolor', 'video'],
				'htmlOptions' => empty($this->model->$attribute) ? [
					'value' => $this->getFieldValueDefault($attribute)
				] : [],
				'options' => [
					'minHeight' => 150,
					'maxHeight' => 150,
					'buttonSource' => true,
					'convertDivs' => false,
					'removeEmptyTags' => false,
					'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
				]
			]
		);
	}

	public function radio($attribute, array $items = [])
	{
		if( empty($items) ) {
			$items = [
			   ['label' => 'Вкл.', 'value' => 1],
			   ['label' => 'Выкл.', 'value' => 0]
			];
		}
		return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))->widget(
			SwitchControl::classname(), [
			'default'   => $this->getFieldValueDefault($attribute),
		    'items'     => $items
			]
		);
	}

	public function checkbox($attribute) {
		return $this->radio($attribute);
	}

	public function getFieldValueDefault($attribute)
	{
		if( method_exists($this->model, 'attributeDefaults') ) {
			$data = $this->model->attributeDefaults();
			if( array_key_exists($attribute, $data) ) {
				return $data[$attribute];
			}
		}
		return null;
	}

	public function getTemplateActiveField($attribute)
	{
		if( method_exists($this->model, 'attributeInstructions') ) {
			$data = $this->model->attributeInstructions();
			if( array_key_exists($attribute, $data) ) {
				return [
					'inputTemplate' => '{input}
					 <a href="'. $data[$attribute] .'" class="btn btn-default how-get-this"
					 title="Перейти к инструкции" target="_blank">Как получить?</a>'
				];
			}
		}

		return [];
	}
}