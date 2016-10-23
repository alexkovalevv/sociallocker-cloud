<?php
	namespace common\modules\lockers\models\settings;

	use Yii;
	use common\modules\lockers\models\settings\SettingsForm;
	use yii\base\Model;

	/**
	 * Create locker form
	 */
	class Social extends Model {

		public $title = 'Настройки социальных кнопок';

		public $buttons_lang;
		public $facebook_version;

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[
					[
						'buttons_lang',
						'facebook_version',
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
				'buttons_lang' => 'Язык кнопок',
				'facebook_version' => 'Версия Facebook API'
			];
		}

		public function attributeHints()
		{
			return [
				'buttons_lang' => 'Выберите язык, который будет использоваться для социальных кнопок. Для кнопок Вконтакте язык определяется автоматически на основе настроек браузера.',
				'facebook_version' => 'Необязательно. Рекомендуется использовать самую последнюю версию API. Если кнопки Facebook некорректно работают на вашем сайте, попробуйте переключить API на более раннюю версию. Пожалуйста, обратите внимание, в настоящий момент API версии 2.4 не позволяет изменить язык кнопок от Facebook. По всей вероятности это ошибка на стороне Facebook.',
			];
		}

		/**
		 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
		 * @return array
		 */
		public function attributeDefaults()
		{
			return [
				'buttons_lang' => 'ru_RU',
				'facebook_version' => 'v2.5'
			];
		}
	}
