<?php
/**
 * Шаблон подписки на сервисы почтовых рассылок. Часть шаблона общих настроек замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package setting
 */

use yii\base\Exception;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $model common\base\MultiModel */

// Получаем список сервисов и файла конфигурации
$services = require(Yii::getAlias('@lockers/subscribe/services.php'));

if( empty($services) ) {
	throw new Exception('Не установлены сервисы подписки.');
}

$services_list = [];
foreach( $services as $name => $service ) {
	$services_list[] = [
		'value'         => $name,
		'text'          => ArrayHelper::getValue( $service, 'title' ),
		'description'   => ArrayHelper::getValue( $service, 'description' ),
		'imageSrc'      => ArrayHelper::getValue( $service, 'image' ),
		'imageHoverSrc' => ArrayHelper::getValue( $service, 'hover' ),
	];
}

$fields->model = $model->getModel('subscribe');

$subscribe = $fields->dropdown('ddslick', 'subscription_to_service', $services_list);

// Default
// ========================================================================================
$default_fieldset  = $fields->textInput('service_sender_email');
$default_fieldset .= $fields->textInput('service_sender_name');
$default_fieldset .= $fields->textInput('service_confirm_email_subject');
$default_fieldset .= $fields->editor('service_confirm_email_body');

$subscribe .= Html::tag('div', $default_fieldset, [
	'class' => 'fieldset-hidden default-fieldset'
]);

// Unisender
// ========================================================================================
$unisender_fieldset = $fields->textInput('unisender_api_key');

$subscribe .= Html::tag('div', $unisender_fieldset, [
	'class' => 'fieldset-hidden unisender-fieldset'
]);
// ========================================================================================

// SmartResponder
// ========================================================================================
$smartresponder_fieldset = $fields->checkbox('smartresponder_availible_md5');
$smartresponder_fieldset_group = $fields->textInput( 'smartresponder_api_id');
$smartresponder_fieldset_group .= $smartresponder_fieldset_group = $fields->textInput( 'smartresponder_api_secret');
$smartresponder_fieldset .= Html::tag('div', $smartresponder_fieldset_group, [
	'class' => 'fieldset-hidden sresponder-md5-request-api'
]);
$smartresponder_fieldset .= Html::tag('div',$fields->textInput('smartresponder_api_key'), [
	'class' => 'fieldset-hidden sresponder-default-request-api'
]);
$subscribe .= Html::tag('div', $smartresponder_fieldset, [
	'class' => 'fieldset-hidden smartresponder-fieldset'
]);
// ========================================================================================

// Pechkinmail
// ========================================================================================
$pechkinmail_fieldset  = $fields->textInput('pechkinmail_username');
$pechkinmail_fieldset .= $fields->textInput('pechkinmail_password');

$subscribe .= Html::tag('div', $pechkinmail_fieldset, [
	'class' => 'fieldset-hidden pechkinmail-fieldset'
]);
// ========================================================================================

// Mailchimp
// ========================================================================================
$mailchimp_fieldset  = $fields->textInput('mailchimp_apikey');
$mailchimp_fieldset .= $fields->checkbox('mailchimp_welcome');

$subscribe .= Html::tag('div', $mailchimp_fieldset, [
	'class' => 'fieldset-hidden mailchimp-fieldset'
]);
// ========================================================================================

// Aweber
$aweber_fieldset = $fields->textarea('aweber_auth_code');

$subscribe .= Html::tag('div', $aweber_fieldset, [
	'class' => 'fieldset-hidden aweber-fieldset'
]);
// ========================================================================================

// Getresponse
// ========================================================================================
$getresponse_fieldset = $fields->textInput('getresponse_apikey');

$subscribe .= Html::tag('div', $getresponse_fieldset, [
	'class' => 'fieldset-hidden getresponse-fieldset'
]);
// ========================================================================================

// Acumbamail
// ========================================================================================
$acumbamail_fieldset = $fields->textInput('acumbamail_customer_id');
$acumbamail_fieldset .= $fields->textInput('acumbamail_api_token');

$subscribe .= Html::tag('div', $acumbamail_fieldset, [
	'class' => 'fieldset-hidden acumbamail-fieldset'
]);
// ========================================================================================

// Freshmail
// ========================================================================================
$freshmail_fieldset = $fields->textInput('freshmail_apikey');
$freshmail_fieldset .= $fields->textInput('freshmail_apisecret');

$subscribe .= Html::tag('div', $freshmail_fieldset, [
	'class' => 'fieldset-hidden freshmail-fieldset'
]);
// ========================================================================================

// Sendy
// ========================================================================================
$sendy_fieldset = $fields->textInput('sendy_apikey');
$sendy_fieldset .= $fields->textInput('sendy_url');

$subscribe .= Html::tag('div', $sendy_fieldset, [
	'class' => 'fieldset-hidden sendy-fieldset'
]);
// ========================================================================================

// Smartemailing
// ========================================================================================
$smartemailing_fieldset = $fields->textInput('smartemailing_username');
$smartemailing_fieldset .= $fields->textInput('smartemailing_apikey');

$subscribe .= Html::tag('div', $smartemailing_fieldset, [
	'class' => 'fieldset-hidden smartemailing-fieldset'
]);
// ========================================================================================

// Sendblue
// ========================================================================================
$sendblue_fieldset = $fields->textInput('sendinblue_apikey');

$subscribe .= Html::tag('div', $sendblue_fieldset, [
	'class' => 'fieldset-hidden sendblue-fieldset'
]);
// ========================================================================================

// Activecampaign
// ========================================================================================
$activecampaign_fieldset = $fields->textInput('activecampaign_apiurl');
$activecampaign_fieldset .= $fields->textInput('activecampaign_apikey');

$subscribe .= Html::tag('div', $activecampaign_fieldset, [
	'class' => 'fieldset-hidden activecampaign-fieldset'
]);
// ========================================================================================

// Sendgrid
// ========================================================================================
$sendgrid_fieldset = $fields->textInput('sendgrid_apikey');

$subscribe .= Html::tag('div', $sendgrid_fieldset, [
	'class' => 'fieldset-hidden sendgrid-fieldset'
]);
// ========================================================================================

// sg autorepondeur
// ========================================================================================
$sgautorepondeur_fieldset  = $fields->textInput('sg_apikey');
$sgautorepondeur_fieldset .= $fields->textInput('sg_memberid');

$subscribe .= Html::tag('div', $sgautorepondeur_fieldset, [
	'class' => 'fieldset-hidden sgautorepondeur-fieldset'
]);
// ========================================================================================

return $subscribe;