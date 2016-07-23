<?php
/**
 * Шаблон настройки социальных кнопок. Часть шаблона общих настроек замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package setting
 */

/* @var $model common\base\MultiModel */

$fields->model = $model->getModel('social');

$social = $fields->dropdown('default', 'buttons_lang', [
	['value' => 'ca_ES', 'text' => 'Catalan'],
	['value' => 'cs_CZ', 'text' => 'Czech'],
	['value' => 'cy_GB', 'text' => 'Welsh'],
	['value' => 'da_DK', 'text' => 'Danish'],
	['value' => 'de_DE', 'text' => 'German'],
	['value' => 'eu_ES', 'text' => 'Basque'],
	['value' => 'en_US', 'text' => 'English'],
	['value' => 'es_ES', 'text' => 'Spanish'],
	['value' => 'fi_FI', 'text' => 'Finnish'],
	['value' => 'fr_FR', 'text' => 'French'],
	['value' => 'gl_ES', 'text' => 'Galician'],
	['value' => 'hu_HU', 'text' => 'Hungarian'],
	['value' => 'it_IT', 'text' => 'Italian'],
	['value' => 'ja_JP', 'text' => 'Japanese'],
	['value' => 'ko_KR', 'text' => 'Korean'],
	['value' => 'nb_NO', 'text' => 'Norwegian'],
	['value' => 'nl_NL', 'text' => 'Dutch'],
	['value' => 'pl_PL', 'text' => 'Polish'],
	['value' => 'pt_BR', 'text' => 'Portuguese (Brazil)'],
	['value' => 'pt_PT', 'text' => 'Portuguese (Portugal)'],
	['value' => 'ro_RO', 'text' => 'Romanian'],
	['value' => 'ru_RU', 'text' => 'Russian'],
	['value' => 'sk_SK', 'text' => 'Slovak'],
	['value' => 'sl_SI', 'text' => 'Slovenian'],
	['value' => 'sv_SE', 'text' => 'Swedish'],
	['value' => 'th_TH', 'text' => 'Thai'],
	['value' => 'tr_TR', 'text' => 'Turkish'],
	['value' => 'ku_TR', 'text' => 'Kurdish'],
	['value' => 'zh_CN', 'text' => 'Simplified Chinese (China)'],
	['value' => 'zh_HK', 'text' => 'Traditional Chinese (Hong Kong)'],
	['value' => 'zh_TW', 'text' => 'Traditional Chinese (Taiwan)'],
	['value' => 'af_ZA', 'text' => 'Afrikaans'],
	['value' => 'sq_AL', 'text' => 'Albanian'],
	['value' => 'hy_AM', 'text' => 'Armenian'],
	['value' => 'az_AZ', 'text' => 'Azeri'],
	['value' => 'be_BY', 'text' => 'Belarusian'],
	['value' => 'bn_IN', 'text' => 'Bengali'],
	['value' => 'bs_BA', 'text' => 'Bosnian'],
	['value' => 'bg_BG', 'text' => 'Bulgarian'],
	['value' => 'hr_HR', 'text' => 'Croatian'],
	['value' => 'nl_BE', 'text' => 'Dutch (Belgie)'],
	['value' => 'eo_EO', 'text' => 'Esperanto'],
	['value' => 'et_EE', 'text' => 'Estonian'],
	['value' => 'fo_FO', 'text' => 'Faroese'],
	['value' => 'ka_GE', 'text' => 'Georgian'],
	['value' => 'el_GR', 'text' => 'Greek'],
	['value' => 'gu_IN', 'text' => 'Gujarati'],
	['value' => 'hi_IN', 'text' => 'Hindi'],
	['value' => 'is_IS', 'text' => 'Icelandic'],
	['value' => 'id_ID', 'text' => 'Indonesian'],
	['value' => 'ga_IE', 'text' => 'Irish'],
	['value' => 'jv_ID', 'text' => 'Javanese'],
	['value' => 'kn_IN', 'text' => 'Kannada'],
	['value' => 'kk_KZ', 'text' => 'Kazakh'],
	['value' => 'la_VA', 'text' => 'Latin'],
	['value' => 'lv_LV', 'text' => 'Latvian'],
	['value' => 'li_NL', 'text' => 'Limburgish'],
	['value' => 'lt_LT', 'text' => 'Lithuanian'],
	['value' => 'mk_MK', 'text' => 'Macedonian'],
	['value' => 'mg_MG', 'text' => 'Malagasy'],
	['value' => 'ms_MY', 'text' => 'Malay'],
	['value' => 'mt_MT', 'text' => 'Maltese'],
	['value' => 'mr_IN', 'text' => 'Marathi'],
	['value' => 'mn_MN', 'text' => 'Mongolian'],
	['value' => 'ne_NP', 'text' => 'Nepali'],
	['value' => 'pa_IN', 'text' => 'Punjabi'],
	['value' => 'rm_CH', 'text' => 'Romansh'],
	['value' => 'sa_IN', 'text' => 'Sanskrit'],
	['value' => 'sr_RS', 'text' => 'Serbian'],
	['value' => 'so_SO', 'text' => 'Somali'],
	['value' => 'sw_KE', 'text' => 'Swahili'],
	['value' => 'tl_PH', 'text' => 'Filipino'],
	['value' => 'ta_IN', 'text' => 'Tamil'],
	['value' => 'tt_RU', 'text' => 'Tatar'],
	['value' => 'te_IN', 'text' => 'Telugu'],
	['value' => 'ml_IN', 'text' => 'Malayalam'],
	['value' => 'uk_UA', 'text' => 'Ukrainian'],
	['value' => 'uz_UZ', 'text' => 'Uzbek'],
	['value' => 'vi_VN', 'text' => 'Vietnamese'],
	['value' => 'xh_ZA', 'text' => 'Xhosa'],
	['value' => 'zu_ZA', 'text' => 'Zulu'],
	['value' => 'km_KH', 'text' => 'Khmer'],
	['value' => 'tg_TJ', 'text' => 'Tajik'],
	['value' => 'ar_AR', 'text' => 'Arabic'],
	['value' => 'he_IL', 'text' => 'Hebrew'],
	['value' => 'ur_PK', 'text' => 'Urdu'],
	['value' => 'fa_IR', 'text' => 'Persian'],
	['value' => 'sy_SY', 'text' => 'Syriac'],
	['value' => 'yi_DE', 'text' => 'Yiddish'],
	['value' => 'gn_PY', 'text' => 'Guarani'],
	['value' => 'qu_PE', 'text' => 'Quechua'],
	['value' => 'ay_BO', 'text' => 'Aymara'],
	['value' => 'se_NO', 'text' => 'Northern Sami'],
	['value' => 'ps_AF', 'text' => 'Pashto']
]);

$social .= $fields->textInput('vk_app_id');
$social .= $fields->textInput('vk_app_secret');
$social .= $fields->textInput('vk_access_token');

$social .= $fields->textInput('facebook_app_id');
$social .= $fields->radio('facebook_version', [
	['label' => 'v1.0', 'value' => 'v1.0'],
	['label' => 'v2.0', 'value' => 'v2.0'],
	['label' => 'v2.3', 'value' => 'v2.3'],
	['label' => 'v2.4', 'value' => 'v2.4'],
	['label' => 'v2.5', 'value' => 'v2.5']
]);

$social .= $fields->dropdown('default', 'twitter_use_dev_keys', [
	['value' => 'default', 'text' => 'ключи по умолчанию'],
	['value' => 'custom', 'text' => 'ключи моего приложения']
]);

$social .= $fields->textInput('twitter_consumer_key');
$social .= $fields->textInput('twitter_consumer_secret');

$social .= $fields->textInput('google_client_id');

$social .= $fields->textInput('linkedin_client_id');
$social .= $fields->textInput('linkedin_client_secret');

return $social;