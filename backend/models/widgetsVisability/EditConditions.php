<?php
	/**
	 * Модель формы создания настроек видимости замков
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace backend\models\widgetsVisability;

	use Yii;
	use yii\base\InvalidValueException;
	use yii\base\Model;
	use yii\validators\RequiredValidator;
	use yii\validators\UrlValidator;

	class EditConditions extends Model {

		// Селектор контейнера в котором должено быть скрыто содержимое (по умолчанию)
		//protected $default_lock_selector;

		public $widget_id;

		public $way;

		public $select_pages;

		public $exclude_pages;

		// Правила видимости для замка в JSON
		public $conditions;


		public function rules()
		{
			return [

				[['widget_id'], 'required'],
				[['select_pages', 'exclude_pages'], 'validateRequired'],
				[['select_pages', 'exclude_pages'], 'validateUrls'],
				[['conditions'], 'string'],
				[['widget_id'], 'integer']
			];
		}

		public function validateRequired($attribute)
		{

			$items = $this->$attribute;
			if( !is_array($items) ) {
				$items = [];
			}

			foreach($items as $index => $item) {
				$validator = new RequiredValidator();
				$error = null;
				$validator->validate($item, $error);
				if( !empty($error) ) {
					$key = $attribute . '[' . $index . ']';
					$this->addError($key, $error);
				}
			}
		}

		/**
		 * Urls validation.
		 *
		 * @param $attribute
		 */
		public function validateUrls($attribute)
		{
			$items = $this->$attribute;
			if( !is_array($items) ) {
				$items = [];
			}
			foreach($items as $index => $item) {
				$validator = new UrlValidator();
				$error = null;
				$validator->validate($item, $error);
				if( !empty($error) ) {
					$key = $attribute . '[' . $index . ']';
					$this->addError($key, $error);
				}
			}
		}

		public function attributeLabels()
		{
			return [
				'way' => 'Где показывать?',
				'select_pages' => 'Адрес страницы',
				'exclude_pages' => 'Адрес страницы'
			];
		}

		public function attributeHints()
		{
			return [
				'way' => 'Выберите место на сайте, где показывать виджет.',
				'select_pages' => 'Выберите страницы, на которых показывать замок. Используйте символ <b>*</b>, чтобы показывать замок на тех страницах, на которых есть совпадения url до символа <b>*</b>.',
				'exclude_pages' => 'Выберите страницы, на которых показывать замок. Используйте символ <b>*</b>, чтобы показывать замок на тех страницах, на которых есть совпадения url до символа <b>*</b>.'
			];
		}

		/**
		 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
		 * @return array
		 */
		public function attributeDefaults()
		{

			return [
				'way' => 'all',
				'select_pages' => [],
				'exclude_pages' => [],
				'conditions' => '[]'
			];
		}

		public static function getModel($widget_id)
		{
			$visability_model = new WidgetsVisability();

			return $visability_model->findOne($widget_id);
		}

		public function setModel($widget_id)
		{
			$model = self::getModel($widget_id);

			if( $model === null ) {
				return false;
			}

			$this->attributes = $model->attributes;
			$this->select_pages = !empty($model->select_pages)
				? json_decode($model->select_pages, true)
				: [];

			return $model;
		}

		public function save($validate, $model = null, $draft = false)
		{

			if( !$draft && $validate && !$this->validate() ) {
				return false;
			}

			if( empty($model) ) {
				$model = new WidgetsVisability();
			}

			if( $draft && method_exists($this, 'attributeDefaults') ) {
				$this->attributes = array_merge($this->attributes, $this->attributeDefaults());
			}

			$model->attributes = $this->attributes;

			if( is_array($model->select_pages) ) {
				$model->select_pages = json_encode($model->attributes['select_pages']);
			} else {
				throw new InvalidValueException('Не корректный тип данных!');
			}

			if( $model->save(true) ) {
				return true;
			}

			return false;
		}
	}
