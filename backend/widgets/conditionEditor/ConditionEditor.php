<?php
	/**
	 * Редактор правил отображения виджетов
	 * @copyright Copyright &copy; Alexander Kovalev, sociallocker.ru, 2016
	 * @package yii2-widgets
	 * @version 1.3.1
	 */
	namespace backend\widgets\conditionEditor;

	use common\helpers\CustomFields;
	use Yii;
	use yii\base\Widget;
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
	use yii\base\InvalidValueException;
	use backend\widgets\conditionEditor\ConditionEditorAssets;

	class ConditionEditor extends Widget {

		public $form;
		public $model;
		public $attribute;

		public $filters = [];
		public $templates = [];

		public $save_button_id;


		public function init()
		{
			parent::init();

			if( !is_array($this->filters) || !is_array($this->templates) ) {
				throw new InvalidValueException('Атрибут filters и templates должны быть массивом.');
			}

			if( empty($this->form) || empty($this->model) || empty($this->attribute) || empty($this->save_button_id) ) {
				throw new InvalidValueException('Не переданы обязательные параметры!');
			}
		}

		public function run()
		{
			parent::run();

			$this->renderAssets();

			$custom_fields = new CustomFields($this->form, $this->model);

			return $this->render('index', [
				'filters' => $this->filters,
				'templates' => $this->templates,
				'custom_fields' => $custom_fields,
				'attribute' => $this->attribute
			]);
		}

		public function getVisibilityFiltersJson()
		{
			$filterParams = [];
			foreach($this->filters as $filterGroup) {
				$filterParams = array_merge($filterParams, $filterGroup['items']);
			}

			return json_encode($filterParams);
		}

		public function getVisibilityTemplatesJson()
		{
			return json_encode($this->templates);
		}

		public function renderAssets()
		{
			$view = $this->getView();

			// Подключение js и css файлов
			ConditionEditorAssets::register($view);

			$filters_json = $this->getVisibilityFiltersJson();
			$templates_json = $this->getVisibilityTemplatesJson();

			$js = <<<JS
		window.bp = window.bp || {};
		window.bp.filtersParams = $filters_json;
		window.bp.templates = $templates_json;
JS;

			$view->registerJs($js, $view::POS_END);

			$save_cfield_id = Html::getInputId($this->model, $this->attribute);
			$save_button_id = $this->save_button_id;

			$jQuery = <<<JS

		var hidden = $("#$save_cfield_id");
		var editor = $("#bp-advanced-visability-options");
		var btnSave = $("#$save_button_id");

		// creating an editor
		editor.bpConditionEditor({
			filters: $.parseJSON( hidden.val() )
		});

		// saves conditions on clicking the button Save
		btnSave.click(function(){

			var data = editor.bpConditionEditor("getData");
			console.log(data);

			var json = JSON.stringify(data);
			hidden.val(json);
		});
JS;

			$view->registerJs($jQuery, $view::POS_READY);
		}
	}