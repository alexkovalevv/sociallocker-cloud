<?php
	/**
	 * В классе содержатся методы облегчающие работу с полями Active Form
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\helpers;

	use dosamigos\tinymce\TinyMce;

	use yii;
	use yii\base\Exception;
	use yii\base\Model;
	use yii\bootstrap\ActiveForm;
	use yii\imperavi\Widget;
	use yii\helpers\ArrayHelper;
	use common\modules\lockers\widgets\controls\dropdown\DropdownControl;
	use common\modules\lockers\widgets\controls\switcher\SwitchControl;
	use unclead\widgets\MultipleInput;
	use yii\helpers\Html;

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

		/**
		 * @param $field_type
		 * @param $attribute
		 * @param $options
		 * @return mixed
		 */
		public function createFieldObject($field_type, $attribute, $options = [])
		{
			if( empty($this->model->$attribute) ) {
				$options['value'] = $this->getFieldValueDefault($attribute);

				if( is_array($options['value']) ) {
					$options['value'] = @json_encode($options['value']);
				}
			} elseif( is_array($this->model->$attribute) ) {
				$this->model->$attribute = @json_encode($this->model->$attribute);
			}

			return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
				->$field_type($options);
		}

		/**
		 * Создает тектовое поле
		 * @param $attribute
		 * @param array $options
		 * @return mixed
		 */
		public function textInput($attribute, array $options = [])
		{
			return $this->createFieldObject('textInput', $attribute, $options);
		}

		/**
		 * Создает текстовую область
		 * @param $attribute
		 * @param array $options
		 * @return mixed
		 */
		public function textarea($attribute, array $options = [])
		{
			return $this->createFieldObject('textarea', $attribute, $options);
		}

		/**
		 * Создает скрытое текстовое поля
		 * @param $attribute
		 * @param array $options
		 * @return mixed
		 */
		public function hidden($attribute, array $options = [])
		{
			return $this->createFieldObject('hiddenInput', $attribute, $options)->label(false);
		}

		public function multipleInput($attribute, array $options = [])
		{
			//
			$options = array_merge([
				'attributeOptions' => [
					'enableClientValidation' => false,
					'enableAjaxValidation' => false
				],
				'allowEmptyList' => false,
				'enableGuessTitle' => true,
				'min' => 1, // should be at least 1 rows
				'addButtonPosition' => MultipleInput::POS_ROW, // show add button in the header
			], $options);

			return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
				->widget(MultipleInput::className(), $options)
				->label(true);
		}

		public function dropdown($type, $attribute, $items, array $options = [])
		{
			$options['type'] = $type;
			$options['default'] = $this->getFieldValueDefault($attribute);
			$options['items'] = $items;

			$this->model->$attribute = Html::encode($this->model->$attribute);

			return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
				->widget(DropdownControl::classname(), $options);
		}

		public function editor($attribute)
		{
			$options = ['rows' => 6];
			if( empty($this->model->$attribute) ) {
				$options['value'] = $this->getFieldValueDefault($attribute);

				if( is_array($options['value']) ) {
					$options['value'] = @json_encode($options['value']);
				}
			}

			// TinyMce
			return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
				->widget(TinyMce::className(), [
					'options' => $options,
					'language' => 'ru',
					'clientOptions' => [
						'content_style' => 'body {color:#555 !important;font-size:14px !important;}',
						'menubar' => false,
						'plugins' => [
							"textcolor lists link anchor fullscreen emoticons template textpattern"
						],
						'toolbar' => "bold italic underline strikethrough | blockquoute | textcolor textpattern emoticons | bullist numlist outdent indent | undo redo | alignleft aligncenter alignright alignjustify | link image fullscreen"
					]
				]);
		}

		public function radio($attribute, array $items = [], array $options = [])
		{
			if( empty($items) ) {
				$items = [
					['label' => 'Вкл.', 'value' => 1],
					['label' => 'Выкл.', 'value' => 0]
				];
			}

			if( isset($options['events']) ) {
				foreach($options['events'] as $key => $val) {
					if( is_integer($key) ) {
						$options['events'][$val] = [
							'1' => 'show',
							'0' => 'hide'
						];
						unset($options['events'][$key]);
					}
				}
			}

			return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
				->widget(SwitchControl::classname(), ArrayHelper::merge([
					'default' => $this->getFieldValueDefault($attribute),
					'items' => $items
				], $options));
		}

		public function checkbox($attribute, array $options = [])
		{
			return $this->radio($attribute, [], $options);
		}

		/**
		 * @param $attribute
		 * @param array $items
		 * @param array $options
		 * @see yii\helpers\Html::activeCheckboxList()
		 * @return $this
		 */
		public function checkboxList($attribute, array $items, array $options = [])
		{

			if( empty($this->model->$attribute) ) {
				$this->model->$attribute = $this->getFieldValueDefault($attribute);
			}

			return $this->form->field($this->model, $attribute, $this->getTemplateActiveField($attribute))
				->checkboxlist($items, $options);
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
			$template_data = [];
			if( method_exists($this->model, 'attributeInstructions') ) {
				$data = $this->model->attributeInstructions();

				if( array_key_exists($attribute, $data) ) {
					$template_data['inputTemplate'] = '{input}<a href="' . $data[$attribute] . '" class="btn btn-default how-get-this"
					 title="Перейти к инструкции" target="_blank">Как получить?</a>';
				}
			}

			$template_data['template'] = '{beginLabel}{labelTitle}{endLabel} <div class="control-group controls col-sm-10">{input}{hint}{error}</div>';
			$template_data['labelOptions'] = ['class' => 'col-sm-2 control-label'];

			return $template_data;
		}
	}