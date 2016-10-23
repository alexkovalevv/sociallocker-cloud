<?php
	/**
	 * Шаблон локализации текста. Часть шаблона общих настроек замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @package setting
	 */

	/* @var $models common\base\MultiModel */

	$fields->model = $models->getModel('localization');

	$localization = '<legend class="separator">
					<p class="separator-title">Экран "Пожалуйста, подтвердите ваш Email"</p>
					<p class="separator-hint">Появляется, когда замок запрашивает пользователя подтвердить свой адрес электронной почты.</p>
				 </legend>';

	$localization .= $fields->textInput('res_confirm_screen_title');
	$localization .= $fields->textInput('res_confirm_screen_instructiont');
	$localization .= $fields->textInput('res_confirm_screen_note1');
	$localization .= $fields->textInput('res_confirm_screen_note2');
	$localization .= $fields->textInput('res_confirm_screen_cancel');
	$localization .= $fields->textInput('res_confirm_screen_open');

	$localization .= '<legend class="separator">
					<p class="separator-title">Кнопки авторизации</p>
					<p class="separator-hint">Текст который расположен на кнопках авторизации.</p>
				 </legend>';

	$localization .= $fields->textInput('res_signin_long');
	$localization .= $fields->textInput('res_signin_short');
	$localization .= $fields->textInput('res_signin_facebook_name');
	$localization .= $fields->textInput('res_signin_google_name');
	$localization .= $fields->textInput('res_signin_twitter_name');
	$localization .= $fields->textInput('res_signin_linkedin_name');
	$localization .= $fields->textInput('res_signin_vk_name');

	$localization .= '<legend class="separator">
					 <p class="separator-title">Разное</p>
					 <p class="separator-hint">Различный текст обычно используется со всеми замками и экранами.</p>
				</legend>';

	$localization .= $fields->textInput('res_misc_data_processing');
	$localization .= $fields->textInput('res_misc_or_enter_email');
	$localization .= $fields->textInput('res_misc_enter_your_name');
	$localization .= $fields->textInput('res_misc_enter_your_email');
	$localization .= $fields->textInput('res_misc_your_agree_with');
	$localization .= $fields->textInput('res_misc_terms_of_use');
	$localization .= $fields->textInput('res_misc_privacy_policy');
	$localization .= $fields->textInput('res_misc_or_wait');
	$localization .= $fields->textInput('res_misc_close');
	$localization .= $fields->textInput('res_misc_or');

	$localization .= '<legend class="separator">
						    <p class="separator-title">Экран "Первый шаг завершен"</p>
						    <p class="separator-hint">Появляется, когда социальная сеть не возвращает адрес электронной почты и замок просит пользователей ввести его вручную.</p>
						 </legend>';

	$localization .= $fields->textInput('res_onestep_screen_title');
	$localization .= $fields->textInput('res_onestep_screen_instructiont');
	$localization .= $fields->textInput('res_onestep_screen_button');

	$localization .= '<legend class="separator">
						    <p class="separator-title">Ошибки и Уведомления</p>
						    <p class="separator-hint">Текст, который видят пользователи, когда что-то идет не так.</p>
						 </legend>';

	$localization .= $fields->textInput('res_errors_empty_email');
	$localization .= $fields->textInput('res_errors_inorrect_email');
	$localization .= $fields->textInput('res_errors_empty_name');
	$localization .= $fields->textInput('res_errors_subscription_canceled');
	$localization .= $fields->textInput('res_errors_not_signed_in');
	$localization .= $fields->textInput('res_errors_not_granted');

	return $localization;
