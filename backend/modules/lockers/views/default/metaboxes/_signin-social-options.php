<?php
/**
 * Шаблон настроек кнопок авторизации. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use backend\modules\lockers\widgets\vtabs\VerticalTabs;
use yii\bootstrap\Html;

/* @var $model common\base\MultiModel */
/* @var string $type */

$fields->model = $model->getModel('signin_social');

$social_buttons = [];

// Facebook кнопки
// ========================================================================================
$facebook = $fields->checkbox('facebook_available');

$facebook .= $fields->checkbox('facebook_lead_available', [
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'facebook',
        'data-action' => 'lead'
    ]
]);

$facebook .= $fields->hidden('facebook_actions');
// ========================================================================================

// Twitter кнопки
// ========================================================================================
$twitter = $fields->checkbox('twitter_available');

$twitter .= $fields->checkbox('twitter_lead_available', [
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'twitter',
        'data-action' => 'lead'
    ]
]);

$twitter .= $fields->checkbox('twitter_tweet_available', [
    'events' => ['.twitter-tweet-action-settings-hidden'],
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'twitter',
        'data-action' => 'tweet'
    ]
]);
$twitter_tweet_action = $fields->textarea('twitter_tweet_message');
$twitter .= Html::tag('div', $twitter_tweet_action, [
    'class' => 'twitter-tweet-action-settings-hidden'
]);

$twitter .= $fields->checkbox('twitter_follow_available', [
    'events' => ['.twitter-follow-action-settings-hidden'],
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'twitter',
        'data-action' => 'follow'
    ]
]);
$twitter_follow_action = $fields->textInput('twitter_follow_user');
$twitter_follow_action .= $fields->checkbox('twitter_follow_notifications');
$twitter .= Html::tag('div', $twitter_follow_action, [
    'class' => 'twitter-follow-action-settings-hidden'
]);
$twitter .= $fields->hidden('twitter_actions');

// ========================================================================================

// Google кнопки
// ========================================================================================
$google = $fields->checkbox('google_available');

$google .= $fields->checkbox('google_lead_available',[
        'contanierOptions' => [
            'class' => 'action-activate-button',
            'data-button' => 'google',
            'data-action' => 'lead'
        ]
]);

$google .= $fields->checkbox('google_youtube_subscribe_available', [
    'events' => ['.google-ysubscribe-action-settings-hidden'],
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'google',
        'data-action' => 'youtube-subscribe'
    ]
]);

$google_youtube_subscribe = $fields->textInput('google_youtube_subscribe_channel_id');
$google .= Html::tag('div', $google_youtube_subscribe, [
    'class' => 'google-ysubscribe-action-settings-hidden'
]);
$google .= $fields->hidden('google_actions');
// ========================================================================================

// LinkedIn кнопки
// ========================================================================================
$linkedin = $fields->checkbox('linkedin_available');

$linkedin .= $fields->checkbox('linkedin_lead_available',[
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'linkedin',
        'data-action' => 'lead'
    ]
]);

$linkedin .= $fields->hidden('linkedin_actions');
// ========================================================================================

// Кнопки Вконтакте
// ========================================================================================
$vk = $fields->checkbox('vk_available');

$vk .= $fields->checkbox('vk_lead_available',[
    'contanierOptions' => [
        'class' => 'action-activate-button',
        'data-button' => 'vk',
        'data-action' => 'lead'
    ]
]);

$vk .= $fields->hidden('vk_actions');
// ========================================================================================

// Сортировка кнопок
// ========================================================================================
echo $fields->hidden('buttons_order');
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