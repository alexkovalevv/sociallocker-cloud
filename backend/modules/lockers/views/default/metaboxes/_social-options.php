<?php
/**
 * Шаблон социальных кнопок. Часть шаблона редактирования социальных замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create
 */

use backend\modules\lockers\widgets\vtabs\VerticalTabs;

/* @var $model common\base\MultiModel */
/* @var string $type */

$fields->model = $model->getModel('social');

$social_buttons = [];

// Facebook мне нравится
// ========================================================================================
$facebook_like = $fields->checkbox('facebook_like_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$facebook_like .= $fields->textInput( 'facebook_like_url');

$facebook_like .= $fields->textInput( 'facebook_like_title');
// ========================================================================================

// Facebook поделиться
// ========================================================================================
$facebook_share = $fields->checkbox('facebook_share_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$facebook_share .= $fields->textInput( 'facebook_share_url');

$facebook_share .= $fields->textInput( 'facebook_share_title');

$facebook_share .= $fields->checkbox('facebook_share_dialog');

$facebook_share .= $fields->textInput( 'facebook_share_message_name');

$facebook_share .= $fields->textInput( 'facebook_share_message_caption');

$facebook_share .= $fields->textInput( 'facebook_share_message_description');

$facebook_share .= $fields->textInput( 'facebook_share_message_image');
// ========================================================================================

// Twitter твитнуть
// ========================================================================================
$twitter_tweet = $fields->checkbox('twitter_tweet_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$twitter_tweet .= $fields->textInput( 'twitter_tweet_url');
$twitter_tweet .= $fields->textInput( 'twitter_tweet_text');

$twitter_tweet .= $fields->checkbox('twitter_tweet_auth');

$twitter_tweet .= $fields->textInput( 'twitter_tweet_via');
$twitter_tweet .= $fields->textInput( 'twitter_tweet_title');

//Twitter подписаться
// ========================================================================================
$twitter_follow = $fields->checkbox('twitter_follow_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$twitter_follow .= $fields->textInput( 'twitter_follow_url');

$twitter_follow .= $fields->checkbox('twitter_follow_auth');

$twitter_follow .= $fields->textInput( 'twitter_follow_hide_name');

$twitter_follow .= $fields->textInput( 'twitter_follow_title');
// ========================================================================================

// Google плюс
// ========================================================================================
$google_plus = $fields->checkbox('google_plus_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$google_plus .= $fields->textInput( 'google_plus_url');

$google_plus .= $fields->textInput( 'google_plus_title');
// ========================================================================================

// Google поделиться
// ========================================================================================
$google_share = $fields->checkbox('google_share_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$google_share .= $fields->textInput( 'google_share_url');

$google_share .= $fields->textInput( 'google_share_title');
// ========================================================================================

// Google youtube
// ========================================================================================
$google_youtube = $fields->checkbox('google_youtube_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$google_youtube .= $fields->textInput( 'google_youtube_channel_id');

$google_youtube .= $fields->textInput( 'google_youtube_title');
// ========================================================================================

// Linkedin поделиться
// ========================================================================================
$linkedin_share = $fields->checkbox('linkedin_share_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$linkedin_share .= $fields->textInput( 'linkedin_share_url');

$linkedin_share .= $fields->textInput( 'linkedin_share_title');
// ========================================================================================

// Vkontakte мне нравится
// ========================================================================================
$vk_like = $fields->checkbox('vk_like_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$vk_like .= $fields->checkbox('vk_like_require_sharing');

$vk_like .= $fields->textInput( 'vk_like_url');

$vk_like .= $fields->textInput( 'vk_like_title');

$vk_like .= $fields->textInput( 'vk_like_message_title');

$vk_like .= $fields->textInput( 'vk_like_message_description');

$vk_like .= $fields->textInput( 'vk_like_message_image');
// ========================================================================================

// Vkontakete поделиться
// ========================================================================================
$vk_share = $fields->checkbox('vk_share_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$vk_share .= $fields->textInput( 'vk_share_url');

$vk_share .= $fields->textInput( 'vk_share_title');

$vk_share .= $fields->textInput( 'vk_like_message_title');

$vk_share .= $fields->textInput( 'vk_like_message_description');

$vk_share .= $fields->textInput( 'vk_like_message_image');
// ========================================================================================

// Vkontakete подписаться
// ========================================================================================
$vk_subscribe = $fields->checkbox('vk_subscribe_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$vk_subscribe .= $fields->textInput( 'vk_subscribe_group_id');

$vk_subscribe .= $fields->textInput( 'vk_subscribe_title');
// ========================================================================================

// Odnoklassniki поделиться
// ========================================================================================
$ok_share = $fields->checkbox('ok_share_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$ok_share .= $fields->textInput( 'ok_share_url');

$ok_share .= $fields->textInput( 'ok_share_title');
// ========================================================================================

// Mail поделиться
// ========================================================================================
$mail_share = $fields->checkbox('mail_share_available', [
	'containerOptions' => ['class' => 'onp-activate-social-button-switch']
]);

$mail_share .= $fields->textInput( 'mail_share_url');

$mail_share .= $fields->textInput( 'mail_share_title');

$mail_share .= $fields->textInput( 'mail_share_message_title');

$mail_share .= $fields->textInput( 'mail_share_message_description');

$mail_share .= $fields->textInput( 'mail_share_message_image');
// ========================================================================================

?>
<?=	VerticalTabs::widget([
	'items' => [
		[
			'label'  => '<span class="onp-tab-list-icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></span>мне нравится',
			'encode' => false,
			'content' => $facebook_like,
			'active' => true,
			'headerOptions' => [
				'id'    => 'tab-facebook-like',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></span>поделиться',
			'encode' => false,
			'content' => $facebook_share,
			'headerOptions' => [
				'id'    => 'tab-facebook-share',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i></span>твитнуть',
			'content' => $twitter_tweet,
			'encode' => false,
			'headerOptions' => [
				'id'    => 'tab-twitter-tweet',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i></span>подписаться',
			'content' => $twitter_follow,
			'encode' => false,
			'headerOptions' => [
				'id'    => 'tab-twitter-follow',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon google"><i class="fa fa-google" aria-hidden="true"></i></span>плюс',
			'content' => $google_plus,
			'encode' => false,
			'headerOptions' => [
				'id'    => 'tab-google-plus',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon google"><i class="fa fa-google" aria-hidden="true"></i></span>поделиться',
			'content' => $google_share,
			'encode' => false,
			'headerOptions' => [
				'id'    => 'tab-google-share',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon google"><i class="fa fa-youtube" aria-hidden="true"></i></span>youtube',
			'content' => $google_youtube,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-google-youtube',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></span>поделиться',
			'content' => $linkedin_share,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-linkedin-share',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon vk"><i class="fa fa-vk" aria-hidden="true"></i></span>мне нравится',
			'content' => $vk_like,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-vk-like',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon vk"><i class="fa fa-vk" aria-hidden="true"></i></span>подписаться',
			'content' => $vk_subscribe,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-vk-subscribe',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon vk"><i class="fa fa-vk" aria-hidden="true"></i></span>поделиться',
			'content' => $vk_share,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-vk-share',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon mail"><i class="fa fa-at" aria-hidden="true"></i></span>поделиться',
			'content' => $mail_share,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-mail-share',
				'class' => 'disabled-button'
			]
		],
		[
			'label' => '<span class="onp-tab-list-icon odnoklassniki"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></span>класс',
			'content' => $ok_share,
			'encode' => false,
			'headerOptions' => [
				'id' => 'tab-ok-share',
				'class' => 'disabled-button'
			]
		],
	]
]);
?>