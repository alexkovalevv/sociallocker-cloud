<?php

use common\modules\subscription\services\activecampaign\ActivecampaignSubscriptionService;
use common\modules\subscription\services\acumbamail\AcumbamailSubscriptionService;
use common\modules\subscription\services\database\DatabaseSubscriptionService;
use common\modules\subscription\services\freshmail\FreshmailSubscriptionService;
use common\modules\subscription\services\getresponse\GetresponseSubscriptionService;
use common\modules\subscription\services\mailchimp\MailchimpSubscriptionService;
use common\modules\subscription\services\pechkinmail\PechkinmailSubscriptionService;
use common\modules\subscription\services\sendgrid\SendGridSubscriptionService;
use common\modules\subscription\services\sendinblue\SendinblueSubscriptionService;
use common\modules\subscription\services\sendy\SendySubscriptionService;
use common\modules\subscription\services\sgautorepondeur\SGAutorepondeurSubscriptionService;
use common\modules\subscription\services\smartemailing\SmartemailingSubscriptionService;
use common\modules\subscription\services\smartresponder\SmartresponderSubscriptionService;
use common\modules\subscription\services\unisender\UnisenderSubscriptionService;

// ---
// Subscription Services
//
$items = array(
	'default'         => array(
		'title'       => 'По умолчанию',
		'description' => 'Email адреса подписчиков будут сохранены в базе данных WP.',
		'class'       => new DatabaseSubscriptionService(),
		'modes'       => array(
            'double-optin',
            'quick-double-optin',
            'quick'
        ),
	),
	'mailchimp'       => array(
		'title'       => 'MailChimp',
		'description' => 'Добавить подписчиков на ваш аккаунт в MailChimp.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
		'class'       => new MailChimpSubscriptionService(),
		'modes'       => array(
			'double-optin',
			'quick-double-optin',
			'quick'
		),
		/*'notes' => array(
			'customFields' => sprintf( __('Select one of merge tags in your MailChimp account to save the value from this field. <a href="%s" target="_blank">Learn more about Merge Tags</a>.'), 'http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags' )
		)*/
	),
	'aweber'          => array(
		'title'       => 'Aweber',
		'description' => 'Добавить подписчиков на ваш аккаунт в Aweber.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/aweber.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/aweber.png',
		'class'       => 'AweberSubscriptionService',
		'modes'       => array(
			'double-optin',
			'quick-double-optin'
		)
	),
	'getresponse'     => array(
		'title'       => 'GetResponse',
		'description' => 'Добавить подписчиков на ваш аккаунт в  GetResponse.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/getresponse.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/getresponse.png',
		'class'       => new GetResponseSubscriptionService(),
		'modes'       => array(
			'double-optin',
			'quick-double-optin'
		)
	),
	'acumbamail'      => array(
		'title'       => 'Acumbamail',
		'description' => 'Добавить подписчиков на ваш аккаунт в Acumbamail.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/acumbamail.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/acumbamail.png',
		'class'       => new AcumbamailSubscriptionService(),
		'modes'       => array('quick')
	),
	'freshmail'       => array(
		'title'       => 'FreshMail',
		'description' => 'Добавить подписчиков на ваш аккаунт в FreshMail.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/freshmail.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/freshmail.png',
		'class'       => new FreshmailSubscriptionService(),
		'modes'       => array(
			'double-optin',
			'quick-double-optin',
			'quick'
		)
	),
	'sendy'           => array(
		'title'       => 'Sendy',
		'description' => 'Добавить подписчиков на ваш аккаунт в Sendy.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendy.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendy.png',
		'class'       => new SendySubscriptionService(),
		'modes'       => array(
			'double-optin',
			'quick'
		),
		'manualList'  => true
	),
	'smartemailing'   => array(
		'title'       => 'SmartEmailing',
		'description' => 'Добавить подписчиков на ваш аккаунт в SmartEmailing.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/smartemailing.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/smartemailing.png',
		'class'       => new SmartemailingSubscriptionService(),
		'modes'       => array('quick')
	),
	'sendinblue'      => array(
		'title'       => 'SendInBlue',
		'description' => 'Добавить подписчиков на ваш аккаунт в SendInBlue.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendinblue.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendinblue.png',
		'class'       => new SendinblueSubscriptionService(),
		'modes'       => array('quick')
	),
	'activecampaign'  => array(
		'title'       => 'ActiveCampaign',
		'description' => 'Добавить подписчиков на ваш аккаунт в ActiveCampaign.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/activecampaign.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/activecampaign.png',
		'class'       => new ActivecampaignSubscriptionService(),
		'modes'       => array('quick'),
	),
	'sendgrid'        => array(
		'title'         => 'SendGrid',
		'description'   => 'Добавить подписчиков на ваш аккаунт в SendGrid.',
		'image'         => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendgrid.png',
		'hover'         => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendgrid.png',
		'class'         => new SendGridSubscriptionService(),
		'modes'         => array('quick'),
		'transactional' => true
	),
	'sgautorepondeur' => array(
		'title'       => 'SG Autorepondeur',
		'description' => 'Добавить подписчиков на ваш аккаунт в SG Autorepondeur.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sgautorepondeur.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sgautorepondeur.png',
		'class'       => new SGAutorepondeurSubscriptionService(),
		'modes'       => array('quick'),
		'manualList'  => true
	),
	'pechkinmail'     => array(
		'title'       => 'PechkinMail',
		'description' => 'Добавить подписчиков на ваш аккаунт в PechkinMail.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/pechkinmail-logo-grey.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/pechkinmail-logo.png',
		'class'       => new PechkinmailSubscriptionService(),
		'modes'       => array('quick')
	),
	'smartresponder'  => array(
		'title'       => 'SmartResponder',
		'description' => 'Добавить подписчиков на ваш аккаунт в SmartResponder.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/smartresponder-logo-grey.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/smartresponder-logo.png',
		'class'       => new SmartresponderSubscriptionService(),
		'modes'       => array('double-optin')
	),
	'unisender'       => array(
		'title'       => 'Unisender',
		'description' => 'Добавить подписчиков на ваш аккаунт в Unisender.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/unisender-logo-grey.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/unisender-logo.png',
		'class'       => new UnisenderSubscriptionService(),
		'modes'       => array(
			'double-optin',
			'quick'
		)
	)
);
return $items;