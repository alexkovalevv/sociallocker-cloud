<?php
// ---
// Subscription Services
//

$items = array(
	'database'        => array(
		'title'       => 'По умолчанию',
		'description' => 'Email адреса подписчиков будут сохранены в базе данных WP.',
		'class'       => 'OPanda_DatabaseSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/database/class.database.php',
		'modes'       => array('quick')
	),
	'mailchimp'       => array(
		'title'       => 'MailChimp',
		'description' => 'Добавить подписчиков на ваш аккаунт в MailChimp.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/mailchimp.png',
		'class'       => 'OPanda_MailChimpSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/mailchimp/class.mailchimp.php',
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
		'class'       => 'OPanda_AweberSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/aweber/class.aweber.php',
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
		'class'       => 'OPanda_GetResponseSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/getresponse/class.getresponse.php',
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
		'class'       => 'OPanda_AcumbamailSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/acumbamail/class.acumbamail.php',
		'modes'       => array('quick')
	),
	'freshmail'       => array(
		'title'       => 'FreshMail',
		'description' => 'Добавить подписчиков на ваш аккаунт в FreshMail.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/freshmail.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/freshmail.png',
		'class'       => 'OPanda_FreshmailSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/freshmail/class.freshmail.php',
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
		'class'       => 'OPanda_SendySubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/sendy/class.sendy.php',
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
		'class'       => 'OPanda_SmartemailingSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/smartemailing/class.smartemailing.php',
		'modes'       => array('quick')
	),
	'sendinblue'      => array(
		'title'       => 'SendInBlue',
		'description' => 'Добавить подписчиков на ваш аккаунт в SendInBlue.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendinblue.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendinblue.png',
		'class'       => 'OPanda_SendinblueSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/sendinblue/class.sendinblue.php',
		'modes'       => array('quick')
	),
	'activecampaign'  => array(
		'title'       => 'ActiveCampaign',
		'description' => 'Добавить подписчиков на ваш аккаунт в ActiveCampaign.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/activecampaign.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/activecampaign.png',
		'class'       => 'OPanda_ActivecampaignSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/activecampaign/class.activecampaign.php',
		'modes'       => array('quick'),
	),
	'sendgrid'        => array(
		'title'         => 'SendGrid',
		'description'   => 'Добавить подписчиков на ваш аккаунт в SendGrid.',
		'image'         => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sendgrid.png',
		'hover'         => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sendgrid.png',
		'class'         => 'OPanda_SendGridSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/sendgrid/class.sendgrid.php',
		'modes'         => array('quick'),
		'transactional' => true
	),
	'sgautorepondeur' => array(
		'title'       => 'SG Autorepondeur',
		'description' => 'Добавить подписчиков на ваш аккаунт в SG Autorepondeur.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/sgautorepondeur.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/sgautorepondeur.png',
		'class'       => 'OPanda_SGAutorepondeurSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/sgautorepondeur/class.sgautorepondeur.php',
		'modes'       => array('quick'),
		'manualList'  => true
	),
	'pechkinmail'     => array(
		'title'       => 'PechkinMail',
		'description' => 'Добавить подписчиков на ваш аккаунт в PechkinMail.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/pechkinmail-logo-grey.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/pechkinmail-logo.png',
		'class'       => 'OPanda_PechkinmailSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/pechkinmail/class.pechkinmail.php',
		'modes'       => array('quick')
	),
	'smartresponder'  => array(
		'title'       => 'SmartResponder',
		'description' => 'Добавить подписчиков на ваш аккаунт в SmartResponder.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/smartresponder-logo-grey.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/smartresponder-logo.png',
		'class'       => 'OPanda_SmartresponderSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/smartresponder/class.smartresponder.php',
		'modes'       => array('double-optin')
	),
	'unisender'       => array(
		'title'       => 'Unisender',
		'description' => 'Добавить подписчиков на ваш аккаунт в Unisender.',
		'image'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/gray/unisender-logo-grey.png',
		'hover'       => 'https://cconp.s3.amazonaws.com/optinpanda/mailing-services/colored/unisender-logo.png',
		'class'       => 'OPanda_UnisenderSubscriptionService',
		//'path' => OPTINPANDA_DIR . '/plugin/includes/subscription/unisender/class.unisender.php',
		'modes'       => array(
			'double-optin',
			'quick'
		)
	)
);

return $items;