<?php
namespace backend\modules\lockers\models\settings\forms;

use Yii;
use backend\modules\lockers\models\settings\SettingsForm;
use yii\base\Model;

/**
 * Create locker form
 */
class Localization extends Model
{
	//Экран "Пожалуйста, подтвердите ваш Email"
	public $res_confirm_screen_title;
	public $res_confirm_screen_instructiont;
	public $res_confirm_screen_note1;
	public $res_confirm_screen_note2;
	public $res_confirm_screen_cancel;
	public $res_confirm_screen_open;

	public $res_signin_long;
	public $res_signin_short;
	public $res_signin_facebook_name;
	public $res_signin_twitter_name;
	public $res_signin_google_name;
	public $res_signin_linkedin_name;
	public $res_signin_vk_name;
	public $res_misc_data_processing;
	public $res_misc_or_enter_email;
	public $res_misc_enter_your_name;
	public $res_misc_enter_your_email;
	public $res_misc_your_agree_with;
	public $res_misc_terms_of_use;
	public $res_misc_privacy_policy;
	public $res_misc_or_wait;
	public $res_misc_close;
	public $res_misc_or;
	public $res_onestep_screen_title;
	public $res_onestep_screen_instructiont;
	public $res_onestep_screen_button;
	public $res_errors_empty_email;
	public $res_errors_inorrect_email;
	public $res_errors_empty_name;
	public $res_errors_subscription_canceled;
	public $res_errors_not_signed_in;
	public $res_errors_not_granted;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[[
				 'res_confirm_screen_title',
				 'res_confirm_screen_instructiont',
				 'res_confirm_screen_note1',
				 'res_confirm_screen_note2',
				 'res_confirm_screen_cancel',
				 'res_confirm_screen_open',
				 'res_signin_long',
				 'res_signin_short',
				 'res_signin_facebook_name',
				 'res_signin_twitter_name',
				 'res_signin_google_name',
				 'res_signin_linkedin_name',
				 'res_signin_vk_name',
				 'res_misc_data_processing',
				 'res_misc_or_enter_email',
				 'res_misc_enter_your_name',
				 'res_misc_enter_your_email',
				 'res_misc_your_agree_with',
				 'res_misc_terms_of_use',
				 'res_misc_privacy_policy',
				 'res_misc_or_wait',
				 'res_misc_close',
				 'res_misc_or',
				 'res_onestep_screen_title',
				 'res_onestep_screen_instructiont',
				 'res_onestep_screen_button',
				 'res_errors_empty_email',
				 'res_errors_inorrect_email',
				 'res_errors_empty_name',
				 'res_errors_subscription_canceled',
				 'res_errors_not_signed_in',
				 'res_errors_not_granted',
			 ], 'string']
		];
	}


	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			//Экран "Пожалуйста, подтвердите ваш Email"
			'res_confirm_screen_title'         => 'Заголовок',
			'res_confirm_screen_instructiont'  => 'Инструкция',
			'res_confirm_screen_note1'         => 'Примечание #1',
			'res_confirm_screen_note2'         => 'Примечание #2',
			'res_confirm_screen_cancel'        => 'Отменить',
			'res_confirm_screen_open'          => 'Кнопка открыть "Мой почтовый ящик"',
			//Кнопки авторизации
			'res_signin_long'                  => 'Длинный текст',
			'res_signin_short'                 => 'Короткий текст',
			'res_signin_facebook_name'         => 'Facebook',
			'res_signin_twitter_name'          => 'Twitter',
			'res_signin_google_name'           => 'Google',
			'res_signin_linkedin_name'         => 'LinkedIn',
			'res_signin_vk_name'               => 'Вконтакте',
			//Разное
			'res_misc_data_processing'         => 'Обработка данных',
			'res_misc_or_enter_email'          => 'Введите ваш email вручную',
			'res_misc_enter_your_name'         => 'Введите ваше имя',
			'res_misc_enter_your_email'        => 'Введите ваш email адрес',
			'res_misc_your_agree_with'         => 'Вы согласны с',
			'res_misc_terms_of_use'            => 'Правила использования',
			'res_misc_privacy_policy'          => 'Политика конфиденциальности',
			'res_misc_or_wait'                 => 'Или подождите',
			'res_misc_close'                   => 'Кнопка закрыть',
			'res_misc_or'                      => 'или',
			//Экран "Первый шаг завершен"
			'res_onestep_screen_title'         => 'Заголовок',
			'res_onestep_screen_instructiont'  => 'Инструкция',
			'res_onestep_screen_button'        => 'Кнопка',
			//Ошибки и Уведомления
			'res_errors_empty_email'           => 'Пустое поле Email',
			'res_errors_inorrect_email'        => 'Неверный Email',
			'res_errors_empty_name'            => 'Пустое поле Имя',
			'res_errors_subscription_canceled' => 'Подписка отменена',
			'res_errors_not_signed_in'         => 'Не прошли авторизацию',
			'res_errors_not_granted'           => 'Недостаточно прав',
		];
	}

	public function attributeHints() {
		return [
			//Экран "Пожалуйста, подтвердите ваш Email"
			'res_confirm_screen_title'         => '',
			'res_confirm_screen_instructiont'  => 'Напишите, что пользователь должен сделать, чтобы подтвердить свой email адрес. Используйте тег {email} для отображения email адреса пользователя.',
			'res_confirm_screen_note1'         => 'Уточните, когда контент будет разблокирован.',
			'res_confirm_screen_note2'         => 'Уточните, что доставка письма с подтверждением может занять некоторое время.',
			'res_confirm_screen_cancel'        => '',
			'res_confirm_screen_open'          => 'Используйте тег {service} для отображения имени почтового сервиса пользователя.',
			//Кнопки авторизации
			'res_signin_long'                  => 'Отображается на длинной кнопке авторизации. {name} - переменная, не удалять!',
			'res_signin_short'                 => 'Отображается на короткой кнопке авторизации. {name} - переменная, не удалять!',
			'res_signin_facebook_name'         => '',
			'res_signin_twitter_name'          => '',
			'res_signin_google_name'           => '',
			'res_signin_linkedin_name'         => '',
			'res_signin_vk_name'               => '',
			//Разное
			'res_misc_data_processing'         => '',
			'res_misc_or_enter_email'          => '',
			'res_misc_enter_your_name'         => '',
			'res_misc_enter_your_email'        => '',
			'res_misc_your_agree_with'         => 'Используйте переменную {links} для отображения ссылки на Условия использования и политику конфиденциальности.',
			'res_misc_terms_of_use'            => '',
			'res_misc_privacy_policy'          => '',
			'res_misc_or_wait'                 => 'Используйте переменную {timer} , чтобы отобразить количество секунд, оставшихся до открытия замка.',
			'res_misc_close'                   => '',
			'res_misc_or'                      => '',
			//Экран "Первый шаг завершен"
			'res_onestep_screen_title'         => '',
			'res_onestep_screen_instructiont'  => '',
			'res_onestep_screen_button'        => '',
			//Ошибки и Уведомления
			'res_errors_empty_email'           => '',
			'res_errors_inorrect_email'        => '',
			'res_errors_empty_name'            => '',
			'res_errors_subscription_canceled' => '',
			'res_errors_not_signed_in'         => '',
			'res_errors_not_granted'           => 'Используйте переменную {permissions} , чтобы показать необходимые права.',
		];
	}
}
