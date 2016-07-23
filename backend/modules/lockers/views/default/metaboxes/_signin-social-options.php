<?php
/**
 * Шаблон настроек кнопок авторизации. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use backend\modules\lockers\widgets\vtabs\VerticalTabs;

/* @var $model common\base\MultiModel */
/* @var string $type */

$fields->model = $model->getModel('signin_social');

$social_buttons = [];

// Facebook кнопки
// ========================================================================================
$facebook = $fields->checkbox('facebook_available', [
	'containerOptions' => [],
]);

$facebook .= $fields->checkbox('facebook_lead_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);
// ========================================================================================

// Twitter кнопки
// ========================================================================================
$twitter = $fields->checkbox('twitter_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);

$twitter .= $fields->checkbox('twitter_lead_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);
// ========================================================================================

// Google кнопки
// ========================================================================================
$google = $fields->checkbox('google_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);

$google .= $fields->checkbox('google_lead_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);
// ========================================================================================


// LinkedIn кнопки
// ========================================================================================
$linkedin = $fields->checkbox('linkedin_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);

$linkedin .= $fields->checkbox('linkedin_lead_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);
// ========================================================================================

// Кнопки Вконтакте
// ========================================================================================
$vk = $fields->checkbox('vk_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);

$vk .= $fields->checkbox('vk_lead_available', [
	'containerOptions' => ['class' =>'onp-activate-social-button-switch'],
]);
// ========================================================================================

?>
<?=	VerticalTabs::widget([
'items' => [
	[
		'label' => '<span class="onp-tab-list-icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></span>facebook',
		'encode' => false,
		'content' => $facebook,
		'headerOptions' => [
			'id'    => 'tab-facebook',
			'class' => 'disabled-button'
		]
	],
	[
		'label' => '<span class="onp-tab-list-icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i></span>twitter',
		'content' => $twitter,
		'encode' => false,
		'headerOptions' => [
			'id'    => 'tab-twitter',
			'class' => 'disabled-button'
		]
	],
	[
		'label' => '<span class="onp-tab-list-icon google"><i class="fa fa-google" aria-hidden="true"></i></span>google',
		'content' => $google,
		'encode' => false,
		'headerOptions' => [
			'id'    => 'tab-google',
			'class' => 'disabled-button'
		]
	],
	[
		'label' => '<span class="onp-tab-list-icon linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></span>linkedin',
		'content' => $linkedin,
		'encode' => false,
		'headerOptions' => [
			'id' => 'tab-linkedin',
			'class' => 'disabled-button'
		]
	],
	[
		'label' => '<span class="onp-tab-list-icon vk"><i class="fa fa-vk" aria-hidden="true"></i></span>вконтакте',
		'content' => $vk,
		'encode' => false,
		'headerOptions' => [
			'id' => 'tab-vk',
			'class' => 'disabled-button'
		]
	],
]
]);
?>