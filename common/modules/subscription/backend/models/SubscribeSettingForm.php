<?php
	namespace common\modules\subscription\backend\models;

	use Yii;
	use yii\base\Model;

	class SubscribeSettingForm extends Model {

		public $title = 'Подписка';

		public $subscription_to_service;
		public $service_sender_email;
		public $service_sender_name;
		public $service_confirm_email_subject;
		public $service_confirm_email_body;
		public $unisender_api_key;
		public $smartresponder_availible_md5;
		public $smartresponder_api_id;
		public $smartresponder_api_secret;
		public $smartresponder_api_key;
		public $pechkinmail_username;
		public $pechkinmail_password;
		public $mailchimp_apikey;
		public $mailchimp_welcome;
		public $aweber_auth_code;
		public $getresponse_apikey;
		public $acumbamail_customer_id;
		public $acumbamail_api_token;
		public $freshmail_apikey;
		public $freshmail_apisecret;
		public $sendy_apikey;
		public $sendy_url;
		public $smartemailing_username;
		public $smartemailing_apikey;
		public $sendinblue_apikey;
		public $activecampaign_apiurl;
		public $activecampaign_apikey;
		public $sendgrid_apikey;
		public $sg_apikey;
		public $sg_memberid;

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[
					[
						'subscription_to_service',
						'service_sender_name',
						'service_confirm_email_subject',
						'service_confirm_email_body',
						'unisender_api_key',
						'smartresponder_api_id',
						'smartresponder_api_secret',
						'smartresponder_api_key',
						'pechkinmail_username',
						'pechkinmail_password',
						'mailchimp_apikey',
						'aweber_auth_code',
						'getresponse_apikey',
						'acumbamail_customer_id',
						'acumbamail_api_token',
						'freshmail_apikey',
						'freshmail_apisecret',
						'sendy_apikey',
						'sendy_url',
						'smartemailing_username',
						'smartemailing_apikey',
						'sendinblue_apikey',
						'activecampaign_apiurl',
						'activecampaign_apikey',
						'sendgrid_apikey',
						'sg_apikey',
						'sg_memberid',
					],
					'string'
				],
				[
					[
						'smartresponder_availible_md5',
						'mailchimp_welcome',
					],
					'integer'
				],
				[
					[
						'smartresponder_availible_md5',
						'mailchimp_welcome'
					],
					'filter',
					'filter' => function ($value) {
						return empty($value)
							? false
							: true;
					}
				],
				['service_sender_email', 'email']
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'subscription_to_service' => 'Служба рассылки',
				'service_sender_email' => 'Email отправителя',
				'service_sender_name' => 'Имя отправителя',
				'service_confirm_email_subject' => 'Тема письма',
				'service_confirm_email_body' => 'Текст письма',
				'unisender_api_key' => 'API ключ',
				'smartresponder_availible_md5' => 'Использовать MD5 шифрование',
				'smartresponder_api_id' => 'API ID',
				'smartresponder_api_secret' => 'Секретный код API',
				'smartresponder_api_key' => 'API ключ',
				'pechkinmail_username' => 'Ваш логин',
				'pechkinmail_password' => 'Ваш пароль',
				'mailchimp_apikey' => 'API ключ',
				'mailchimp_welcome' => 'Отправить "Письмо с приветом"',
				'aweber_auth_code' => 'Код авторизации',
				'getresponse_apikey' => 'API ключ',
				'acumbamail_customer_id' => 'ID клиента',
				'acumbamail_api_token' => 'API токен',
				'freshmail_apikey' => 'API ключ',
				'freshmail_apisecret' => 'Секрентный код API',
				'sendy_apikey' => 'API ключ',
				'sendy_url' => 'Установка',
				'smartemailing_username' => 'Ваш логин',
				'smartemailing_apikey' => 'API ключ',
				'sendinblue_apikey' => 'API ключ',
				'activecampaign_apiurl' => 'API url',
				'activecampaign_apikey' => 'API ключ',
				'sendgrid_apikey' => 'API ключ',
				'sg_apikey' => 'API ключ',
				'sg_memberid' => 'ID пользователя',
			];
		}

		public function attributeHints()
		{
			return [
				'subscription_to_service' => '',
				'service_sender_email' => 'Необязательный. Email адрес отправителя для письма подтверждения.',
				'service_sender_name' => 'Необязательный. Имя отправителя для письма подтверждения.',
				'service_confirm_email_subject' => '',
				'service_confirm_email_body' => 'Используйте шорткод [link], чтобы вставить ссылку для подтверждения.',
				'unisender_api_key' => 'Пожалуйста, введите ваш api ключ в Unisender',
				'smartresponder_availible_md5' => 'Если Вкл, все запросы к сервису SmartResponder будут использовать протокол повышенной безопасности.',
				'smartresponder_api_id' => 'Введите ваш api id в Smartresponder.',
				'smartresponder_api_secret' => 'Введите ваш секрытный ключ api в Smartresponder.',
				'smartresponder_api_key' => 'Введите ваш api ключ в Smartresponder.',
				'pechkinmail_username' => 'Введите ваш логин в сервисе PechkinMail.',
				'pechkinmail_password' => 'Введите Ваш пароль в сервисе PechkinMail.',
				'mailchimp_apikey' => 'API ключ вашего аккаунта в MailChimp.',
				'mailchimp_welcome' => 'Посылает письмо "Приветствие" сконфигурированное в вашей учетной записи MailChimp после подписки (работает только если использует замок авторизации).',
				'aweber_auth_code' => 'Код авторизации вы увидите после входа в ваш аккаунт Aweber.',
				'getresponse_apikey' => 'API ключ вашего аккаунта в GetResponse.',
				'acumbamail_customer_id' => 'Идентификатор клиента вашего аккаунта в Acumbamail.',
				'acumbamail_api_token' => 'API токен вашего аккаунта в Acumbamail.',
				'freshmail_apikey' => 'API ключ вашего аккаунта в FreshMail.',
				'freshmail_apisecret' => 'Секретный ключ API вашего аккаунта в FreshMail.',
				'sendy_apikey' => 'Ключ API Sendy приложения, доступный в настройках.',
				'sendy_url' => 'URL-адрес для установки Sendy, <strong>http://your_sendy_installation</strong>',
				'smartemailing_username' => 'Введите ваше имя пользователя на SmartEmailing. Обычно это email.',
				'smartemailing_apikey' => 'API ключ вашего аккаунта в SmartEmailing.',
				'sendinblue_apikey' => 'Ключ API (версия 2.0) вашего счета Sendinblue.',
				'activecampaign_apiurl' => 'URL-адрес API вашего аккаунта в ActiveCampaign.',
				'activecampaign_apikey' => 'API ключ вашего аккаунта в ActiveCampaign.',
				'sendgrid_apikey' => 'Ваш SendGrid ключ API. Разрешение <strong>полный доступ</strong> для <strong>отправки почты</strong> и <strong>маркетинговые кампании</strong> в настройках вашего API ключа.',
				'sg_apikey' => 'Код активации от вашего SG Autorepondeur аккаунта (<i>Mon compte -> Autres Options -> Informations administratives</i>).',
				'sg_memberid' => 'ID пользователя от вашего аккаунта в SG Autorepondeur (<i>можно найти на домашней странице ниже SG логотипа, например, 9059</i>).',
			];
		}

		/**
		 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
		 * @return array
		 */
		public function attributeDefaults()
		{
			return [
				'subscription_to_service' => 'default',
				'service_sender_email' => Yii::$app->user->identity->email,
				'service_sender_name' => 'Социальный замок',
				'service_confirm_email_subject' => 'Подтвердите ваш email адрес',
				'service_confirm_email_body' => '<p>Чтобы подтвердить адрес электронной почты и разблокировать содержимое, пожалуйста, нажмите на ссылку ниже:<br />[link]<br /><br />-<br />Социальный Замок</p>',
			];
		}

		/**
		 * Сслыки на инструкцию для получению нужного значения. Если элемента массива не существует,
		 * то возвращается false или null.
		 * @return array
		 */
		public function attributeInstructions()
		{
			return [
				'unisender_api_key' => '#',
				'smartresponder_api_secret' => '#',
				'smartresponder_api_key' => '#',
				'mailchimp_apikey' => 'http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key',
				'getresponse_apikey' => 'http://support.getresponse.com/faq/where-i-find-api-key',
				'acumbamail_customer_id' => 'https://acumbamail.com/apidoc/',
				'freshmail_apikey' => 'https://app.freshmail.com/en/settings/integration/',
				'smartemailing_apikey' => 'https://app.smartemailing.cz/userinfo/show/api',
				'sendinblue_apikey' => 'https://my.sendinblue.com/advanced/apikey',
				'activecampaign_apikey' => 'http://www.activecampaign.com/help/using-the-api/',
				'sendgrid_apikey' => 'https://app.sendgrid.com/settings/api_keys',
				'sg_apikey' => 'http://sg-autorepondeur.com/membre_v2/compte-options.php',
			];
		}
	}
