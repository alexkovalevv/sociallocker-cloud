<?php
namespace common\modules\lockers\models\settings\forms;

use Yii;
use common\modules\lockers\models\settings\SettingsForm;
use yii\base\Model;

/**
 * Create locker form
 */
class Social extends Model
{
	public $buttons_lang;
	public $vk_app_id;
	public $vk_app_secret;
	public $vk_access_token;
	public $facebook_app_id;
	public $facebook_version;
	public $twitter_use_dev_keys;
	public $google_client_id;
	public $twitter_consumer_key;
	public $twitter_consumer_secret;
	public $linkedin_client_id;
	public $linkedin_client_secret;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[[
				 'buttons_lang',
				 'vk_app_secret',
				 'vk_access_token',
				 'facebook_version',
				 'twitter_use_dev_keys',
				 'twitter_consumer_key',
				 'twitter_consumer_secret',
				 'google_client_id',
				 'linkedin_client_id',
				 'linkedin_client_secret',
			 ], 'string'],
			[[
				 'vk_app_id',
				 'facebook_app_id',
			 ], 'integer']
		];
	}


	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'buttons_lang'            => 'Язык кнопок',
			'vk_app_id'               => 'Идентификатор приложения в Вконтакте',
			'vk_app_secret'           => 'Защищенный ключ',
			'vk_access_token'         => 'Токен доступа Вконтакте',
			'facebook_app_id'         => 'Идентификатор приложения в Facebook',
			'facebook_version'        => 'Версия Facebook API',
			'twitter_use_dev_keys'    => 'Twitter API ключи',
			'twitter_consumer_key'    => 'Twitter Consumer Key',
			'twitter_consumer_secret' => 'Twitter Consumer Secret',
			'google_client_id'        => 'Идентификатор клиента Google',
			'linkedin_client_id'      => 'Идентификатор клиента LinkedIn',
			'linkedin_client_secret'  => 'Секретный код клиента LinkedIn',
		];
	}

	public function attributeHints() {
		return [
			'buttons_lang'            => 'Выберите язык, который будет использоваться для социальных кнопок. Для кнопок Вконтакте язык определяется автоматически на основе настроек браузера.',
			'vk_app_id'               => 'Если вы хотите использовать кнопки Вконтакте, вам необходимо зарегистрировать приложение и получить идентификатор приложения для вашего сайта.',
			'vk_app_secret'           => 'Если вы хотите использовать кнопки авторизации Вконтакте вам необходимо зарегистрировать приложение и получить защищенный ключ.',
			'vk_access_token'         => 'Токен доступа Вконтакте необходим для корректной работы кнопок Вконтакте на мобильных устройствах и кириллических доменах. Чтобы получить токен доступа, перейдите по ссылке.',
			'facebook_app_id'         => 'По умолчанию установлен app id разработчиков Onepress. Если вы хотите использовать Facebook поделиться или Facebook кнопки авторизации, вам нужно зарегистрировать приложение и установить его id в поле выше.',
			'facebook_version'        => 'Необязательно. Рекомендуется использовать самую последнюю версию API. Если кнопки Facebook некорректно работают на вашем сайте, попробуйте переключить API на более раннюю версию. Пожалуйста, обратите внимание, в настоящий момент API версии 2.4 не позволяет изменить язык кнопок от Facebook. По всей вероятности это ошибка на стороне Facebook.',
			'twitter_use_dev_keys'    => 'Кнопка Твиттер "авторизации" требует приложение в Twitter. По умолчанию мы предоставляем вам ключи к нашему приложению. Но если вы беспокоитесь о безопасности, вы можете создать собственные приложения. Также, создавая свое собственное твиттер приложение, вы сможете изменить название, описание и значок во всплывающем окне.',
			'twitter_consumer_key'    => 'Введите Consumer Key вашего приложения.',
			'twitter_consumer_secret' => 'Введите Consumer Secret вашего приложения.',
			'google_client_id'        => 'Если вы хотите использовать кнопку youtube или google аторизации, вам нужно зарегистрировать приложение в google и получить client ID, чтобы вставить в форму выше.',
			'linkedin_client_id'      => 'Если вы хотите использовать кнопку авторизации Linkedin, вам необходимо зарегистрировать приложение, а полученные Client ID и Secret вписать в соответствующие поля.',
			'linkedin_client_secret'  => 'Client Secret вашего приложения в Linkedin',
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'buttons_lang'         => 'ru_RU',
			'facebook_version'     => 'v2.5',
			'twitter_use_dev_keys' => 'default',
		];
	}

	/**
	 * Сслыки на инструкцию для получению нужного значения. Если элемента массива не существует,
	 * то возвращается false или null.
	 * @return array
	 */
	public function attributeInstructions() {
		return [
			'vk_app_id'               => '#',
			'vk_app_secret'           => '#',
			'vk_access_token'         => '#',
			'facebook_app_id'         => '#',
			'twitter_consumer_key'    => '#',
			'twitter_consumer_secret' => '#',
			'google_client_id'        => '#',
			'linkedin_client_id'      => '#',
			'linkedin_client_secret'  => '#',
		];
	}
}
