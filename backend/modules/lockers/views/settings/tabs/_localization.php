<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 3:32
 */

//---------------------------------------
/**  Локализация                       */
//---------------------------------------

$localization = '<legend class="separator">
						    <p class="separator-title">Экран "Пожалуйста, подтвердите ваш Email"</p>
						    <p class="separator-hint">Появляется, когда замок запрашивает пользователя подтвердить свой адрес электронной почты.</p>
						 </legend>';

$localization .= $form->field($model->getModel('localization'), 'res_confirm_screen_title')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_confirm_screen_instructiont')->textarea();
$localization .= $form->field($model->getModel('localization'), 'res_confirm_screen_note1')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_confirm_screen_note2')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_confirm_screen_cancel')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_confirm_screen_open')->textInput();

$localization .= '<legend class="separator">
						    <p class="separator-title">Кнопки авторизации</p>
						    <p class="separator-hint">Текст который расположен на кнопках авторизации.</p>
						 </legend>';

$localization .= $form->field($model->getModel('localization'), 'res_signin_long')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_signin_short')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_signin_facebook_name')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_signin_google_name')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_signin_twitter_name')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_signin_linkedin_name')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_signin_vk_name')->textInput();

$localization .= '<legend class="separator">
						    <p class="separator-title">Разное</p>
						    <p class="separator-hint">Различный текст обычно используется со всеми замками и экранами.</p>
						 </legend>';

$localization .= $form->field($model->getModel('localization'), 'res_misc_data_processing')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_or_enter_email')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_enter_your_name')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_enter_your_email')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_your_agree_with')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_terms_of_use')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_privacy_policy')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_or_wait')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_close')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_misc_or')->textInput();

$localization .= '<legend class="separator">
						    <p class="separator-title">Экран "Первый шаг завершен"</p>
						    <p class="separator-hint">Появляется, когда социальная сеть не возвращает адрес электронной почты и замок просит пользователей ввести его вручную.</p>
						 </legend>';

$localization .= $form->field($model->getModel('localization'), 'res_onestep_screen_title')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_onestep_screen_instructiont')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_onestep_screen_button')->textInput();

$localization .= '<legend class="separator">
						    <p class="separator-title">Ошибки и Уведомления</p>
						    <p class="separator-hint">Текст, который видят пользователи, когда что-то идет не так.</p>
						 </legend>';

$localization .= $form->field($model->getModel('localization'), 'res_errors_empty_email')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_errors_inorrect_email')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_errors_empty_name')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_errors_subscription_canceled')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_errors_not_signed_in')->textInput();
$localization .= $form->field($model->getModel('localization'), 'res_errors_not_granted')->textInput();

return $localization;
