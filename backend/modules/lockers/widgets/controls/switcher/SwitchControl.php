<?php
/**
 * Кнопка переключатель
 * @author Alex Kovalevv <alex.kovalevv@gmail.com>
 * @copyright Copyright &copy; Alex Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.0.0
 */
namespace backend\modules\lockers\widgets\controls\switcher;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\InputWidget;


class SwitchControl extends InputWidget
{
	/**
	 * @var array элементы массива, где label это текст кнопки, value - значение
	 * пример использования:
	 * 'items' => [['label' => 'Скрыть', 'value' => 'none'],['label' => 'Прозрачный слой', 'value' => 'opacity']]
	 */
	public $items = [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	];

	/**
	 * @var string значение по умолчанию
	 */
	public $default = false;

	/**
	 * @var string название поля
	 */
	public $attributeLabel;

	/**
	 * @var string короткое описание поля
	 */
	public $attributeLabelHint;

	public $itemOptions = [];

	public $labelOptions = [];

	public $containerOptions = ['class' => 'form-group'];

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->value = isset($this->model->attributes[$this->attribute])
			? $this->model->attributes[$this->attribute]
		    : null;
		$this->containerOptions['id'] = $this->options['id'];
	}

	public function run()
	{
		parent::run();
		echo $this->renderInput();
	}

	protected function renderInput()
	{
		list($text_label_output, $text_label_hint_output, $output, $label) = '';

		$model_attribute_labels = $this->model->attributeLabels();
		if( isset($model_attribute_labels[$this->attribute]) )
			$label = $model_attribute_labels[$this->attribute];
		else if( isset($this->attributeLabel) ) {
			$label = $this->attributeLabel;
		}
		if( !empty($label) ) {
			$text_label_output .= Html::tag( 'strong', $label, ['style' => 'display:block; margin:5px 0;'] );
		}

		$model_attribute_hint_labels = $this->model->attributeHints();

		if( isset($model_attribute_hint_labels[$this->attribute]) )
			$text_label_hint_output .= Html::tag('div', $model_attribute_hint_labels[$this->attribute], ['class' => 'help-block']);
		else
			$text_label_hint_output .= !empty($this->attributeLabelHint) ? Html::tag('div', $this->attributeLabelHint, ['class' => 'help-block']) : '';

		Html::addCssClass($this->containerOptions, ['field-' . $this->options['id']]);
		Html::addCssClass($this->labelOptions, 'btn btn-default');

		foreach ($this->items as $item) {
			if (!is_array($item)) continue;

			$options = ArrayHelper::merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
			$label_options = ArrayHelper::merge($this->labelOptions, ArrayHelper::getValue($item, 'labelOptions', []));

			$value = ArrayHelper::getValue($item, 'value', null);
			$options['value'] = $value;

			if( !isset($this->value) || $this->value == '' && isset($this->default) )
				$this->value = $this->default;

			$checked = $value == $this->value;

			$input_name = Html::getInputName($this->model, $this->attribute);
			$input = Html::radio($input_name, $checked, $options);
			$input .= ArrayHelper::getValue($item, 'label', false);

			if( $checked ) Html::addCssClass($label_options, 'active');
			$output .= Html::label($input, $input_name, $label_options);
		}
		return Html::tag('div',
			$text_label_output . Html::tag('div', $output, ['class' => 'btn-group', 'role' => "group", 'data-toggle' => 'buttons']) . $text_label_hint_output,
			$this->containerOptions
		);
	}

}
