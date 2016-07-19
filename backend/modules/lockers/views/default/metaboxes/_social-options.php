<?php
/**
 * Шаблон социальных кнопок. Часть шаблона редактирования социальных замков.
 * @package sociallocker-create
 */

	use backend\modules\lockers\widgets\vtabs\VerticalTabs;
	use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

	$social_buttons = [];
	/* =========================================
	                Facebook кнопки
	 =========================================== */

	// Facebook мне нравится
	$facebook_like = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'facebook_like_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true
	]);

	$facebook_like .= $form->field($model->getModel('social'), 'facebook_like_url')->textInput();

	$facebook_like .= $form->field($model->getModel('social'), 'facebook_like_title')->textInput(
		['value' => 'мне нравится']
	);

	// Facebook поделиться
	$facebook_share = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'facebook_share_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$facebook_share .= $form->field($model->getModel('social'), 'facebook_share_url')->textInput();

	$facebook_share .= $form->field($model->getModel('social'), 'facebook_share_title')->textInput(
		['value' => 'поделиться']
	);

	$facebook_share .= SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'facebook_share_dialog'
	]);

	$facebook_share .= $form->field($model->getModel('social'), 'facebook_share_message_name')->textInput();
	$facebook_share .= $form->field($model->getModel('social'), 'facebook_share_message_caption')->textInput();
	$facebook_share .= $form->field($model->getModel('social'), 'facebook_share_message_description')->textInput();
	$facebook_share .= $form->field($model->getModel('social'), 'facebook_share_message_image')->textInput();

	/* =========================================
					Twitter кнопки
	 =========================================== */

	// Twitter твитнуть
	$twitter_tweet = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'twitter_tweet_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true
	]);

	$twitter_tweet .= $form->field($model->getModel('social'), 'twitter_tweet_url')->textInput();
	$twitter_tweet .= $form->field($model->getModel('social'), 'twitter_tweet_text')->textarea();

	$twitter_tweet .= SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'twitter_tweet_auth',
		'default'   => true
	]);

	$twitter_tweet .= $form->field($model->getModel('social'), 'twitter_tweet_via')->textInput();
	$twitter_tweet .= $form->field($model->getModel('social'), 'twitter_tweet_title')->textInput(
		['value' => 'твитнуть']
	);

	//Twitter подписаться
	$twitter_follow = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'twitter_follow_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$twitter_follow .= $form->field($model->getModel('social'), 'twitter_follow_url')->textInput();

	$twitter_follow .= SwitchControl::widget([
			'model' => $model->getModel('social'),
			'attribute' => 'twitter_follow_auth',
			'default'   => true
		]);

	$twitter_follow .= $form->field($model->getModel('social'), 'twitter_follow_hide_name')->textInput();
	$twitter_follow .= $form->field($model->getModel('social'), 'twitter_follow_title')->textInput(
		['value' => 'подписаться']
	);

	/* =========================================
					Google кнопки
	 =========================================== */

	// Google плюс
	$google_plus = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'google_plus_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true
	]);

	$google_plus .= $form->field($model->getModel('social'), 'google_plus_url')->textInput();

	$google_plus .= $form->field($model->getModel('social'), 'google_plus_title')->textInput(
		['value' => 'плюсануть']
	);

	// Google поделиться
	$google_share = SwitchControl::widget([
			'model' => $model->getModel('social'),
			'attribute' => 'google_share_available',
			'containerOptions' => [
				'class' => 'onp-activate-social-button-switch'
			]
		]);

	$google_share .= $form->field($model->getModel('social'), 'google_share_url')->textInput();

	$google_share .= $form->field($model->getModel('social'), 'google_share_title')->textInput(
		['value' => 'поделиться']
	);

	// Google youtube
	$google_youtube = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'google_youtube_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$google_youtube .= $form->field($model->getModel('social'), 'google_youtube_channel_id')->textInput();

	$google_youtube .= $form->field($model->getModel('social'), 'google_youtube_title')->textInput(
		['value' => 'подписаться']
	);

	/* =========================================
					LinkedIn кнопки
	 =========================================== */

	// Linkedin поделиться
	$linkedin_share = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'linkedin_share_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$linkedin_share .= $form->field($model->getModel('social'), 'linkedin_share_url')->textInput();

	$linkedin_share .= $form->field($model->getModel('social'), 'linkedin_share_title')->textInput(
		['value' => 'подписаться']
	);

	/* =========================================
					Кнопки Вконтакте
	 =========================================== */

	// Vkontakte мне нравится
	$vk_like = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'vk_like_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true
	]);

	$vk_like .= SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'vk_like_require_sharing',
		'default'   => true
	]);

	$vk_like .= $form->field($model->getModel('social'), 'vk_like_url')->textInput();

	$vk_like .= $form->field($model->getModel('social'), 'vk_like_title')->textInput(
			['value' => 'мне нравится']
	);

	$vk_like .= $form->field($model->getModel('social'), 'vk_like_message_title')->textInput();
	$vk_like .= $form->field($model->getModel('social'), 'vk_like_message_description')->textarea();
	$vk_like .= $form->field($model->getModel('social'), 'vk_like_message_image')->textInput();

	// Vkontakete поделиться
	$vk_share = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'vk_share_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$vk_share .= $form->field($model->getModel('social'), 'vk_share_url')->textInput();

	$vk_share .= $form->field($model->getModel('social'), 'vk_share_title')->textInput(
			['value' => 'поделиться']
	);

	$vk_share .= $form->field($model->getModel('social'), 'vk_like_message_title')->textInput();
	$vk_share .= $form->field($model->getModel('social'), 'vk_like_message_description')->textarea();
	$vk_share .= $form->field($model->getModel('social'), 'vk_like_message_image')->textInput();

	// Vkontakete подписаться
	$vk_subscribe = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'vk_subscribe_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$vk_subscribe .= $form->field($model->getModel('social'), 'vk_subscribe_group_id')->textInput();

	$vk_subscribe .= $form->field($model->getModel('social'), 'vk_subscribe_title')->textInput(
		['value' => 'поделиться']
	);

	/* =========================================
					Кнопки Майл
	 =========================================== */

	// Odnoklassniki поделиться
	$ok_share = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'ok_share_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$ok_share .= $form->field($model->getModel('social'), 'ok_share_url')->textInput();

	$ok_share .= $form->field($model->getModel('social'), 'ok_share_title')->textInput(
		['value' => 'поделиться']
	);

	// Mail поделиться
	$mail_share = SwitchControl::widget([
		'model' => $model->getModel('social'),
		'attribute' => 'mail_share_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		]
	]);

	$mail_share .= $form->field($model->getModel('social'), 'mail_share_url')->textInput();

	$mail_share .= $form->field($model->getModel('social'), 'mail_share_title')->textInput(
			['value' => 'поделиться']
	);

	$mail_share .= $form->field($model->getModel('social'), 'mail_share_message_title')->textInput();
	$mail_share .= $form->field($model->getModel('social'), 'mail_share_message_description')->textarea();
	$mail_share .= $form->field($model->getModel('social'), 'mail_share_message_image')->textInput();


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