<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 15.07.2016
 * Time: 15:22
 */

	use backend\modules\lockers\widgets\vtabs\VerticalTabs;
	use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

	$social_buttons = [];
	/* =========================================
	                Facebook кнопки
	 =========================================== */

	$facebook = SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'facebook_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	$facebook .= SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'facebook_lead_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	/* =========================================
					Twitter кнопки
	 =========================================== */

	$twitter = SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'twitter_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => false,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	$twitter .= SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'twitter_lead_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => false,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	/* =========================================
					Google кнопки
	 =========================================== */

	$google = SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'google_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	$google .= SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'google_lead_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	/* =========================================
					LinkedIn кнопки
	 =========================================== */

	$linkedin = SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'linkedin_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => false,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	$linkedin .= SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'linkedin_lead_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => false,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	/* =========================================
					Кнопки Вконтакте
	 =========================================== */

	$vk = SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'vk_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

	$vk .= SwitchControl::widget([
		'model' => $model->getModel('signin_social'),
		'attribute' => 'vk_lead_available',
		'containerOptions' => [
			'class' => 'onp-activate-social-button-switch'
		],
		'default'   => true,
		'items' => [
			['label' => 'Вкл.', 'value' => 1],
			['label' => 'Выкл.', 'value' => 0]
		]
	]);

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