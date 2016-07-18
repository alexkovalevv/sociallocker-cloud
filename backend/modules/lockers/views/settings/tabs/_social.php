<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 3:31
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

//---------------------------------------
/**  Настройки социальных кнопок       */
//---------------------------------------

$social = $form->field($model->getModel('social'), 'buttons_lang')->dropDownList(
	[
		'ca_ES' => 'Catalan',
		'cs_CZ' => 'Czech',
		'cy_GB' => 'Welsh',
		'da_DK' => 'Danish',
		'de_DE' => 'German',
		'eu_ES' => 'Basque',
		'en_US' => 'English',
		'es_ES' => 'Spanish',
		'fi_FI' => 'Finnish',
		'fr_FR' => 'French',
		'gl_ES' => 'Galician',
		'hu_HU' => 'Hungarian',
		'it_IT' => 'Italian',
		'ja_JP' => 'Japanese',
		'ko_KR' => 'Korean',
		'nb_NO' => 'Norwegian',
		'nl_NL' => 'Dutch',
		'pl_PL' => 'Polish',
		'pt_BR' => 'Portuguese (Brazil)',
		'pt_PT' => 'Portuguese (Portugal)',
		'ro_RO' => 'Romanian',
		'ru_RU' => 'Russian',
		'sk_SK' => 'Slovak',
		'sl_SI' => 'Slovenian',
		'sv_SE' => 'Swedish',
		'th_TH' => 'Thai',
		'tr_TR' => 'Turkish',
		'ku_TR' => 'Kurdish',
		'zh_CN' => 'Simplified Chinese (China)',
		'zh_HK' => 'Traditional Chinese (Hong Kong)',
		'zh_TW' => 'Traditional Chinese (Taiwan)',
		'af_ZA' => 'Afrikaans',
		'sq_AL' => 'Albanian',
		'hy_AM' => 'Armenian',
		'az_AZ' => 'Azeri',
		'be_BY' => 'Belarusian',
		'bn_IN' => 'Bengali',
		'bs_BA' => 'Bosnian',
		'bg_BG' => 'Bulgarian',
		'hr_HR' => 'Croatian',
		'nl_BE' => 'Dutch (Belgie)',
		'eo_EO' => 'Esperanto',
		'et_EE' => 'Estonian',
		'fo_FO' => 'Faroese',
		'ka_GE' => 'Georgian',
		'el_GR' => 'Greek',
		'gu_IN' => 'Gujarati',
		'hi_IN' => 'Hindi',
		'is_IS' => 'Icelandic',
		'id_ID' => 'Indonesian',
		'ga_IE' => 'Irish',
		'jv_ID' => 'Javanese',
		'kn_IN' => 'Kannada',
		'kk_KZ' => 'Kazakh',
		'la_VA' => 'Latin',
		'lv_LV' => 'Latvian',
		'li_NL' => 'Limburgish',
		'lt_LT' => 'Lithuanian',
		'mk_MK' => 'Macedonian',
		'mg_MG' => 'Malagasy',
		'ms_MY' => 'Malay',
		'mt_MT' => 'Maltese',
		'mr_IN' => 'Marathi',
		'mn_MN' => 'Mongolian',
		'ne_NP' => 'Nepali',
		'pa_IN' => 'Punjabi',
		'rm_CH' => 'Romansh',
		'sa_IN' => 'Sanskrit',
		'sr_RS' => 'Serbian',
		'so_SO' => 'Somali',
		'sw_KE' => 'Swahili',
		'tl_PH' => 'Filipino',
		'ta_IN' => 'Tamil',
		'tt_RU' => 'Tatar',
		'te_IN' => 'Telugu',
		'ml_IN' => 'Malayalam',
		'uk_UA' => 'Ukrainian',
		'uz_UZ' => 'Uzbek',
		'vi_VN' => 'Vietnamese',
		'xh_ZA' => 'Xhosa',
		'zu_ZA' => 'Zulu',
		'km_KH' => 'Khmer',
		'tg_TJ' => 'Tajik',
		'ar_AR' => 'Arabic',
		'he_IL' => 'Hebrew',
		'ur_PK' => 'Urdu',
		'fa_IR' => 'Persian',
		'sy_SY' => 'Syriac',
		'yi_DE' => 'Yiddish',
		'gn_PY' => 'Guarani',
		'qu_PE' => 'Quechua',
		'ay_BO' => 'Aymara',
		'se_NO' => 'Northern Sami',
		'ps_AF' => 'Pashto'
	],
	empty($model->getModel('social')->buttons_lang) ? [
		'options'=>	[
			'ru_RU'=> [
				'Selected'=> true
			]
		]
	] : []
);

$social .= $form->field($model->getModel('social'), 'vk_app_id')->textInput();
$social .= $form->field($model->getModel('social'), 'vk_app_secret')->textInput();
$social .= $form->field($model->getModel('social'), 'vk_access_token')->textInput();

$social .= $form->field($model->getModel('social'), 'facebook_app_id')->textInput();
$social .= SwitchControl::widget([
	'model' => $model->getModel('social'),
	'attribute' => 'facebook_version',
	'default'   => 'v2.5',
	'items' => [
		['label' => 'v1.0', 'value' => 'v1.0'],
		['label' => 'v2.0', 'value' => 'v2.0'],
		['label' => 'v2.3', 'value' => 'v2.3'],
		['label' => 'v2.4', 'value' => 'v2.4'],
		['label' => 'v2.5', 'value' => 'v2.5']
	]
]);

$social .= $form->field($model->getModel('social'), 'twitter_use_dev_keys')->dropDownList(
	[
		'default' => 'ключи по умолчанию',
		'custom' => 'ключи моего приложения'
	],
	empty($model->getModel('social')->twitter_use_dev_keys) ? [
		'options'=>	[
			'ru_RU'=> [
				'Selected'=> true
			]
		]
	] : []
);

$social .= $form->field($model->getModel('social'), 'twitter_consumer_key')->textInput();
$social .= $form->field($model->getModel('social'), 'twitter_consumer_secret')->textInput();

$social .= $form->field($model->getModel('social'), 'google_client_id')->textInput();

$social .= $form->field($model->getModel('social'), 'linkedin_client_id')->textInput();
$social .= $form->field($model->getModel('social'), 'linkedin_client_secret')->textInput();

return $social;