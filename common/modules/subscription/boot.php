<?php
	// ---
	// Subscription Services
	//
	$services_dir = 'common\modules\subscription\common\services\\';

	$items = [
		'database' => [
			'title' => 'По умолчанию',
			'description' => 'Email адреса подписчиков будут сохранены в базе данных WP.',
			'class' => $services_dir . 'database\DatabaseSubscriptionService',
			'modes' => [
				'double-optin',
				'quick-double-optin',
				'quick'
			],
			'require_settings' => [
				'service_sender_email',
				'service_sender_name',
				'service_confirm_email_subject',
				'service_confirm_email_body'
			]
		],
		'mailchimp' => [
			'title' => 'MailChimp',
			'description' => 'Добавить подписчиков на ваш аккаунт в MailChimp.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
			'class' => $services_dir . 'mailchimp\MailchimpSubscriptionService',
			'modes' => [
				'double-optin',
				'quick-double-optin',
				'quick'
			],
			'require_settings' => [
				'mailchimp_apikey',
				'mailchimp_welcome'
			]
			/*'notes' => array(
				'customFields' => sprintf( __('Select one of merge tags in your MailChimp account to save the value from this field. <a href="%s" target="_blank">Learn more about Merge Tags</a>.'), 'http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags' )
			)*/
		],
		/*'aweber' => [
			'title' => 'Aweber',
			'description' => 'Добавить подписчиков на ваш аккаунт в Aweber.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/aweber.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/aweber.png',
			'class' => $services_dir . 'aweber\AweberSubscriptionService',
			'modes' => [
				'double-optin',
				'quick-double-optin'
			],
			'require_settings' => [
				'mailchimp_apikey',
				'mailchimp_welcome'
			]
		],*/
		/*'getresponse' => [
			'title' => 'GetResponse',
			'description' => 'Добавить подписчиков на ваш аккаунт в  GetResponse.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/getresponse.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/getresponse.png',
			'class' => $services_dir . 'getresponse\GetresponseSubscriptionService',
			'modes' => [
				'double-optin',
				'quick-double-optin'
			],
			'require_settings' => [
				'getresponse_apikey'
			]
		],
		'acumbamail' => [
			'title' => 'Acumbamail',
			'description' => 'Добавить подписчиков на ваш аккаунт в Acumbamail.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/acumbamail.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/acumbamail.png',
			'class' => $services_dir . 'acumbamail\AcumbamailSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'acumbamail_customer_id',
				'acumbamail_api_token'
			]

		],*/
		/*'freshmail' => [
			'title' => 'FreshMail',
			'description' => 'Добавить подписчиков на ваш аккаунт в FreshMail.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/freshmail.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/freshmail.png',
			'class' => $services_dir . 'freshmail\FreshmailSubscriptionService',
			'modes' => [
				'double-optin',
				'quick-double-optin',
				'quick'
			],
			'require_settings' => [
				'freshmail_apikey',
				'freshmail_apisecret'
			]
		],
		'sendy' => [
			'title' => 'Sendy',
			'description' => 'Добавить подписчиков на ваш аккаунт в Sendy.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendy.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendy.png',
			'class' => $services_dir . 'sendy\SendySubscriptionService',
			'modes' => [
				'double-optin',
				'quick'
			],
			'require_settings' => [
				'sendy_apikey',
				'sendy_url'
			],
			'manualList' => true
		],
		'smartemailing' => [
			'title' => 'SmartEmailing',
			'description' => 'Добавить подписчиков на ваш аккаунт в SmartEmailing.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/smartemailing.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/smartemailing.png',
			'class' => $services_dir . 'smartemailing\SmartemailingSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'smartemailing_username',
				'smartemailing_apikey'
			],
		],
		'sendinblue' => [
			'title' => 'SendInBlue',
			'description' => 'Добавить подписчиков на ваш аккаунт в SendInBlue.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendinblue.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendinblue.png',
			'class' => $services_dir . 'sendinblue\SendinblueSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'smartemailing_username',
				'smartemailing_apikey'
			],
		],
		'activecampaign' => [
			'title' => 'ActiveCampaign',
			'description' => 'Добавить подписчиков на ваш аккаунт в ActiveCampaign.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/activecampaign.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/activecampaign.png',
			'class' => $services_dir . 'activecampaign\ActivecampaignSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'smartemailing_username',
				'smartemailing_apikey'
			],
		],
		'sendgrid' => [
			'title' => 'SendGrid',
			'description' => 'Добавить подписчиков на ваш аккаунт в SendGrid.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendgrid.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendgrid.png',
			'class' => $services_dir . 'sendgrid\SendGridSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'sendgrid_apikey'
			],
			'transactional' => true
		],
		'sgautorepondeur' => [
			'title' => 'SG Autorepondeur',
			'description' => 'Добавить подписчиков на ваш аккаунт в SG Autorepondeur.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sgautorepondeur.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sgautorepondeur.png',
			'class' => $services_dir . 'sgautorepondeur\SGAutorepondeurSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'sg_apikey',
				'sg_memberid'
			],
			'manualList' => true
		],*/
		'pechkinmail' => [
			'title' => 'PechkinMail',
			'description' => 'Добавить подписчиков на ваш аккаунт в PechkinMail.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/pechkinmail-logo-grey.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/pechkinmail-logo.png',
			'class' => $services_dir . 'pechkinmail\PechkinmailSubscriptionService',
			'modes' => ['quick'],
			'require_settings' => [
				'pechkinmail_username',
				'pechkinmail_password'
			],
		],
		'unisender' => [
			'title' => 'Unisender',
			'description' => 'Добавить подписчиков на ваш аккаунт в Unisender.',
			'image' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/unisender-logo-grey.png',
			'hover' => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/unisender-logo.png',
			'class' => $services_dir . 'unisender\UnisenderSubscriptionService',
			'modes' => [
				'double-optin',
				'quick'
			],
			'require_settings' => [
				'unisender_api_key'
			],
		]
	];
	return $items;