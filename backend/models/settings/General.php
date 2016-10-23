<?php
	namespace backend\models\settings;

	use Yii;
	use yii\base\Model;

	class General extends Model {

		public $title = 'Основные';

		public $widgets_lang;
		public $facebook_version;

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[
					[
						'widgets_lang',
					],
					'string'
				]
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'widgets_lang' => 'Язык кнопок'
			];
		}

		public function attributeHints()
		{
			return [
				'widgets_lang' => 'Выберите язык, который будет использоваться для социальных кнопок. Для кнопок Вконтакте язык определяется автоматически на основе настроек браузера.',
			];
		}

		/**
		 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
		 * @return array
		 */
		public function attributeDefaults()
		{
			return [
				'widgets_lang' => 'ru_RU'
			];
		}
	}
