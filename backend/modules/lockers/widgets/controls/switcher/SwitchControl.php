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
	public $model;

	public $attribute;
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
	 * @var $value значение поля
	 */
	public $value;

	/**
	 * @var string значение по умолчанию
	 */
	public $default = false;

	public $options = [];

	public $itemsOptions = ['class' => 'btn btn-default'];

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->value = Html::getAttributeValue($this->model, $this->attribute);

		if( ($this->value === '' || is_null($this->value)) && !is_null($this->default) )
			$this->value = $this->default;

	}

	public function run()
	{
		parent::run();
		echo $this->renderInput();
	}

	protected function renderInput()
	{
		$output = '';
		foreach ($this->items as $item) {

			if (!is_array($item)) continue;

			$value = ArrayHelper::getValue($item, 'value', null);

			$this->options['value'] = $value;

			$checked = $value == $this->value;

			$input_name = Html::getInputName($this->model, $this->attribute);
			$input = Html::radio($input_name, $checked, $this->options);


			$label = ArrayHelper::getValue($item, 'label');
			$itemsOptions = ArrayHelper::merge($this->itemsOptions, []);

			if( $checked ) {
				Html::addCssClass($itemsOptions, 'active');
			}

			$output .= Html::tag('div', $input . $label, $itemsOptions);

		}
		return Html::tag('div', $output, ['class' => 'btn-group', 'role' => "group", 'data-toggle' => 'buttons']);
	}

}
