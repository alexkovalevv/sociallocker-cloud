<?php
/**
 * Выпадающий список с возможностью добавления иконки и краткого описания
 * к внутреннему элементу списка.
 * @author Alex Kovalevv <alex.kovalevv@gmail.com>
 * @copyright Copyright &copy; Alex Kovalev, sociallocker.ru, 2016
 * @package yii2-widgets
 * @version 1.0.0
 */
namespace backend\modules\lockers\widgets\controls\dropdown;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/*
 * Пример использования:
==================================================================
$form->field($model, 'subscription_to_service')->widget(
	DropdownControl::classname(), [
		'type'      => 'ddslick',
		'default'   => 'aweber',
		'items'     => [
			[
				'value'  => 'aweber',
				'text' => 'Aweber',
				'imageSrc'  => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/aweber.png',
				'imageHoverSrc' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/aweber.png',
				'description'  => 'Синхронизировать формы подписки с сервисом Aweber'
			],
			[
				'value'  => 'mailchimp',
				'text' => 'Mailchimp',
				'imageSrc'  => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
				'imageHoverSrc' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/mailchimp.png',
				'description'  => 'Синхронизировать формы подписки с сервисом Aweber',
			]
		]
	]
);
==================================================================
$form->field($model, 'subscription_to_service')->widget(
	DropdownControl::classname(), [
		'type'      => 'default',
		'default'   => 'aweber',
		'items'     => [
			[
				'value'  => 'aweber',
				'text' => 'Aweber'
			],
			[
				'value'  => 'mailchimp',
				'text' => 'Mailchimp'
			]
		]
	]
);
==================================================================
*/

class DropdownControl extends Widget
{
	/**
	 * @var $name имя поля
	 */
	protected $name;

	/**
	 * @var $value значение поля
	 */
	protected $value;

	/**
	 * @var int $id идентификатор поля
	 */
	protected $id;

	/**
	 * @var string $type тип выпадающего списка, это может быть default, ddslick
	 * default обычное выпадающее меню
	 * ddslic  выпадающий список может содержать иконки и короткое описание
	 * button  кнопка при нажатии на которую, открывается выдающий список
	 */
	public $type = "default";

	public $model;

	public $attribute;

	/**
	 * @var boolean если true, использует ajax для получания $items.
	 */
	public $ajax = false;

	/**
	 * @var array|string элементы массива. Если используется ajax, сюда передается url
	 */
	public $items;

	/**
	 * @var string название поля
	 */
	public $label;

	/**
	 * @var string короткое описание поля
	 */
	public $hint;

	/**
	 * @var string значение по умолчанию
	 */
	public $default = null;

	/**
	 * @var boolean $liveSearch поиск по списку
	 */
	public $liveSearch = false;

	/**
	 * @var string $style стиль кнопки, класс бутстрап кнопок.
	 */
	public $style = 'btn-default';

	/**
	 * @var int $width ширина поля
	 */
	public $width = 450;

	/**
	 * @var array $labelOptions опции текстовой метки.
	 * ['class' => 'one-label', 'id' => 'two-label']
	 */
	public $itemOptions = [];

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if( $this->type === "ddslick" && $this->ajax ) {
			throw new Exception('Параметр ajax не доступен для выпадающего списка с типом ddslick(' . $this->attribute . ').');
		}

		if( empty($this->items) && $this->ajax ) {
			throw new Exception('Не передан атрибут items(' . $this->attribute . ').');
		}

		if( empty($this->items) && !is_array($this->items) && !$this->ajax ) {
			throw new Exception('Не передан атрибут items или атрибут не является массивом(' . $this->attribute . ').');
		}

		$this->view = $this->getView();
		$this->liveSearch = $this->liveSearch ? 1 : 0;
		$this->name = Html::getInputName($this->model, $this->attribute);
		$this->id   = Html::getInputId($this->model, $this->attribute);
		$this->value = Html::getAttributeValue($this->model, $this->attribute);

		if( ($this->value === '' || is_null($this->value)) && !is_null($this->default) )
			$this->value = $this->default;

		DropdownControlAssets::register($this->view);
	}

	public function run()
	{
		parent::run();

		if( $this->type === 'ddslick' ) {
			echo $this->renderDdslick();
		} else {
			echo $this->renderDefault();
		}
	}

	protected function renderDdslick()
	{
		foreach( $this->items as $key => $item ) {
			if( $item['value'] === $this->value ) {
				$this->items[$key]['selected'] = true;
			}
		}
		$ddData = json_encode($this->items);

		$js = <<<JS
		(function($){
			$(function(){
	           $('.wt-dropdown-ddslick').ddslick({
    				data: {$ddData},
    				selectText: "{$this->label}",
    				imagePosition:"right",
    				width: {$this->width},
    				height: 300,
				    onSelected: function(data){
				        if ( data.selectedData.imageHoverSrc ) {
				           data.selectedItem.closest('.dd-container').find('.dd-select')
						 	.find("img").attr('src', data.selectedData.imageHoverSrc);
		                }

		                var result = data.selectedItem.closest('.dd-container')
		                	.next(".wt-dropdown-ddslick-result")
		                	.val( data.selectedData.value );

						result.change();
				    }
			   });
	        })
    	})(jQuery);
JS;

		$this->view->registerJs($js);

		Html::addCssClass($this->itemOptions, 'wt-dropdown-ddslick');
		$this->itemOptions = ArrayHelper::merge($this->itemOptions, ['id' => $this->id]);

		$output = Html::tag('div', '', $this->itemOptions);
		$output .= Html::hiddenInput($this->name, $this->value, [
			'class' => 'wt-dropdown-ddslick-result'
		]);

		return $output;
	}

	protected function renderDefault()
	{
		$items = [];

		if( !$this->ajax ) {
			$item_hints = [];
			foreach( $this->items as $item ) {
				$items[$item['value']] = $item['text'];
				$item_hints[$item['value']] = ArrayHelper::getValue( $item, 'hint' );
			}
			$this->itemOptions['data-item-hints'] = $item_hints;
		} else {
			$items['none'] = '--- идет поиск ---';
			Html::addCssClass($this->itemOptions, 'wt-dropdown-ajax');
			$this->itemOptions['data-ajax-url'] = $this->items;
			$this->itemOptions['data-value'] = $this->value;
		}

		$js = <<<JS
		(function($){
			$(function(){
			   $('.wt-dropdown-select').selectpicker({
				  style: '{$this->style}',
				  width: {$this->width},
				  liveSearch: {$this->liveSearch}
			   });
	        })
    	})(jQuery);
JS;

		$this->view->registerJs($js);


		Html::addCssClass($this->itemOptions, 'wt-dropdown-select');

		return Html::dropDownList($this->name, $this->value, $items, $this->itemOptions);
	}

}
