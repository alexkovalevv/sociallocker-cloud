<?php
	namespace common\modules\lockers\models\settings\forms;

	use Yii;
	use common\modules\lockers\models\settings\SettingsForm;
	use yii\base\Model;

	/**
	 * Create locker form
	 */
	class Lock extends Model {

		public $debug;
		public $passcode;
		public $permanent_passcode;
		public $dynamic_theme;
		public $alt_overlap_mode;
		public $tumbler;
		public $timeout;

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[
					[
						'passcode',
						'alt_overlap_mode',
					],
					'string'
				],
				[
					[
						'debug',
						'permanent_passcode',
						'dynamic_theme',
						'tumbler',
						'timeout',
					],
					'integer'
				],
				[
					[
						'debug',
						'permanent_passcode',
						'dynamic_theme',
						'tumbler'
					],
					'filter',
					'filter' => function ($value) {
						return empty($value)
							? false
							: true;
					}
				]
			];
		}


		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'debug' => 'Режим отладки',
				'passcode' => 'Кодовое слово',
				'permanent_passcode' => 'Открыть замок по кодовому слову',
				'dynamic_theme' => 'Я использую динамическую тему',
				'alt_overlap_mode' => 'Режим наложения',
				'tumbler' => 'Анти-читинг',
				'timeout' => 'Таймаут ожидания загрузки Замка (в мс)',
			];
		}

		public function attributeHints()
		{
			return [
				'debug' => 'Если Вкл, плагин показывает информацию, почему Социальный замок не виден пользователям.',
				'passcode' => 'Необязательно. Когда кодовое слово содержится в URL вашего сайта, заблокированный контент будет автоматически разблокирован.',
				'permanent_passcode' => 'Если Вкл и пользователь перешел по ссылке, содержащей кодовое слово, то контент разблокируется для пользователя навсегда, независимо от того, будет ли передано кодовое слово в следующий раз или нет',
				'dynamic_theme' => 'Необязательно. Если страницы вашего сайта загружаются динамически через AJAX, установите Вкл (если все работает, то ничего включать не нужно).',
				'alt_overlap_mode' => 'Этот режим наложения будет использоваться, если браузер пользователя не поддерживает эффект размытия.',
				'tumbler' => 'Включите эту настройку, чтобы защитить ваш контент от обмана со стороны пользователей, использующих специальные расширения для браузера, которые позволяют разблокировать скрытый контент без лайка. Если эта опция включена, то Замок обнаруживает подобные расширения и мгновенно пересоздает сам себя после ложной разблокировки.',
				'timeout' => 'Пользователь может использовать расширения браузера, которые блокируют загрузку скриптов социальных сетей. Если социальные кнопки в течение указанного времени не будут загружены, то Замок покажет сообщение об ошибке, что у пользователя что-то блокирует загрузку социальных кнопок.',
			];
		}

		/**
		 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
		 * @return array
		 */
		public function attributeDefaults()
		{
			return [
				'alt_overlap_mode' => 'transparence',
				'tumbler' => true,
				'timeout' => 20000,
			];
		}
	}
