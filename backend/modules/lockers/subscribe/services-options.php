<?php
/**
 * Registers options for the subscription services.
 *
 */
$options = [

	'unisender'      => [
		[
			'type'  => 'textInput',
			'name'  => 'unisender_api_key',
			'title' => 'API key',
			'after' => '<a href="#" class="btn btn-default" target="_blank">Как получить API ключ?</a>',
			'hint'  => 'Пожалуйста, введите ваш api ключ в Unisender'
		]
	],

	'smartresponder' => [
		['type'      => 'checkbox',
		 'name'      => 'smartresponder_availible_md5',
		 'default'   => false,
		 'title'     => 'Использовать MD5 шифрование',
		 'hint'      => 'Если Вкл., все запросы к сервису SmartResponder будут использовать протокол повышенной безопасности.'
		],
		[
			'type'  => 'textInput',
			'name'  => 'smartresponder_api_id',
			'title' => 'API ID',
			'after' => '<a href="#" class="btn btn-default" target="_blank">Как получить API ID?</a>',
			'hint'  => 'Введите ваш api id в Smartresponder.',
		],
		[
			'type'  => 'textInput',
			'name'  => 'smartresponder_api_secret',
			'title' => 'API Secret',
			'after'     => '<a href="#" class="btn btn-default" target="_blank">Как получить секретный ключ?</a>',
			'hint'  => 'Введите ваш секрытный ключ api в Smartresponder.',
		],
	    [

			'type'      => 'textbox',
			'name'      => 'smartresponder_api_key',
			'title'     => 'API KEY',
			'after'     => '<a href="#" class="btn btn-default" target="_blank">Как получить API ключ?</a>',
			'hint'      => 'Введите ваш api ключ в Smartresponder.',

		]
	],

	'pechkinmail' => [
		[
			'type'  => 'textbox',
			'name'  => 'pechkinmail_username',
			'title' => 'Username',
			'hint'  => 'Your username in PechkinMail Account'
		],
		[
			'type'  => 'textbox',
			'name'  => 'pechkinmail_password',
			'title' => 'Password',
			'hint'  => 'Your password PechkinMail Account'
		]

	],


    'mailchimp' => [
	    [
		    'type'      => 'textbox',
		    'name'      => 'mailchimp_apikey',
		    'after'     => '<a href="#" class="btn btn-default" target="_blank">Get API Key</a>',
		    'title'     => 'API Key',
		    'hint'      => 'The API key of your MailChimp account.'
	    ],
	    [
		    'type'      => 'checkbox',
		    'way'       => 'buttons',
		    'name'      => 'mailchimp_welcome',
		    'title'     => 'Send "Welcome" Email',
		    'default'   => true,
		    'hint'      => 'Sends the Welcome Email configured in your MailChimp account after subscription (works only if the Single Opt-In set).',
	    ]
    ]

];
/*
// aweber

if( !get_option('opanda_aweber_consumer_key', false) ) {

    $options[] = array(
        'type'      => 'div',
        'id'        => 'opanda-aweber-options',
        'class'     => 'opanda-mail-service-options opanda-hidden',
        'items'     => array(

            array(
                'type' => 'separator'
            ),
            array(
                'type'      => 'html',
                'html'      => 'opanda_aweber_html'
            ),
            array(
                'type'      => 'textarea',
                'name'      => 'aweber_auth_code',
                'title'     => __( 'Authorization Code', 'bizpanda' ),
                'hint'      => __( 'The authorization code you will see after log in to your Aweber account.', 'bizpanda' )
            )
        )
    );

} else {

    $options[] = array(
        'type'      => 'div',
        'id'        => 'opanda-aweber-options',
        'class'     => 'opanda-mail-service-options opanda-hidden',
        'items'     => array(
            array(
                'type' => 'separator'
            ),
            array(
                'type'      => 'html',
                'html'      => 'opanda_aweber_html'
            )
        )
    );
}

// getresponse

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-getresponse-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'getresponse_apikey',
            'title'     => __( 'API Key', 'bizpanda' ),
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Key</a>', 'bizpanda' ), 'http://support.getresponse.com/faq/where-i-find-api-key' ),
            'hint'      => __( 'The API key of your GetResponse account.', 'bizpanda' ),
        )
    )
);

// mymail

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-mymail-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(


        array(
            'type' => 'html',
            'html' => 'opanda_show_mymail_html'
        ),
        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'checkbox',
            'way'       => 'buttons',
            'name'      => 'mymail_redirect',
            'title'     => __( 'Redirect To Locker', 'bizpanda' ),
            'hint'      => sprintf( __( 'Set On to redirect the user after the email confirmation to the page where the locker located.<br />If Off, the MyMail will redirect the user to the page specified in the option <a href="%s" target="_blank">Newsletter Homepage</a>.', 'bizpanda' ), admin_url('options-general.php?page=newsletter-settings&settings-updated=true#frontend') )
        )
    )
);

// mailpoet

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-mailpoet-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'html',
            'html' => 'opnada_show_mailpoet_html'
        )
    )
);

// acumbamail

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-acumbamail-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'acumbamail_customer_id',
            'title'     => __( 'Customer ID', 'bizpanda' ),
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get ID & Token</a>', 'bizpanda' ), 'https://acumbamail.com/apidoc/' ),
            'hint'      => __( 'The customer ID of your Acumbamail account.', 'bizpanda' )
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'acumbamail_api_token',
            'title'     => __( 'API Token', 'bizpanda' ),
            'hint'      => __( 'The API token of your Acumbamail account.', 'bizpanda' )
        )
    )
);

// knews

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-knews-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'html',
            'html' => 'opanda_show_knews_html'
        ),
        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'checkbox',
            'way'       => 'buttons',
            'name'      => 'knews_redirect',
            'title'     => __( 'Redirect To Locker', 'bizpanda' ),
            'hint'      => __( 'Set On to redirect the user after the email confirmation to the page where the locker located.<br />If Off, the K-news will redirect the user to the home page.', 'bizpanda' )
        )
    )
);

// freshmail

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-freshmail-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'freshmail_apikey',
            'title'     => __( 'API Key', 'bizpanda' ),
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Keys</a>', 'bizpanda' ), 'https://app.freshmail.com/en/settings/integration/' ),
            'hint'      => __( 'The API Key of your FreshMail account.', 'bizpanda' )
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'freshmail_apisecret',
            'title'     => __( 'API Secret', 'bizpanda' ),
            'hint'      => __( 'The API Sercret of your FreshMail account.', 'bizpanda' )
        )
    )
);

// sendy

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-sendy-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'sendy_apikey',
            'title'     => __( 'API Key', 'bizpanda' ),
            'hint'      => __( 'The API key of your Sendy application, available in Settings.', 'bizpanda' ),
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'sendy_url',
            'title'     => __( 'Installation', 'bizpanda' ),
            'hint'      => __( 'An URL for your Sendy installation, <strong>http://your_sendy_installation</strong>', 'bizpanda' ),
        )
    )
);

// smartemailing

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-smartemailing-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'smartemailing_username',
            'title'     => __( 'Username', 'bizpanda' ),
            'hint'      => __( 'Enter your username on SmartEmailing. Usually it is a email.', 'bizpanda' ),
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'smartemailing_apikey',
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Key</a>', 'bizpanda' ), 'https://app.smartemailing.cz/userinfo/show/api' ),
            'title'     => __( 'API Key', 'bizpanda' ),
            'hint'      => __( 'The API key of your SmartEmailing account.', 'bizpanda' ),
        )
    )
);

// sendinblue

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-sendinblue-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'sendinblue_apikey',
            'title'     => __( 'API Key', 'bizpanda' ),
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Key</a>', 'bizpanda' ), 'https://my.sendinblue.com/advanced/apikey' ),
            'hint'      => __( 'The API Key (version 2.0) of your Sendinblue account.', 'bizpanda' )
        )
    )
);

// activecampaign

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-activecampaign-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'activecampaign_apiurl',
            'title'     => __( 'API Url', 'bizpanda' ),
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Url</a>', 'bizpanda' ), 'http://www.activecampaign.com/help/using-the-api/' ),
            'hint'      => __( 'The API Url of your ActiveCampaign account.', 'bizpanda' )
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'activecampaign_apikey',
            'title'     => __( 'API Key', 'bizpanda' ),
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Key</a>', 'bizpanda' ), 'http://www.activecampaign.com/help/using-the-api/' ),
            'hint'      => __( 'The API Key of your ActiveCampaign account.', 'bizpanda' )
        )
    )
);

// sendgrid

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-sendgrid-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'sendgrid_apikey',
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get API Key</a>', 'optinpanda' ), 'https://app.sendgrid.com/settings/api_keys' ),
            'title'     => __( 'API Key', 'optinpanda' ),
            'hint'      => __( 'Your SendGrid API key. Grant <strong>Full Access</strong> for <strong>Mail Send</strong> and <strong>Marketing Campaigns</strong> in settings of your API key.', 'optinpanda' ),
        )
    )
);

// sg autorepondeur

$options[] = array(
    'type'      => 'div',
    'id'        => 'opanda-sgautorepondeur-options',
    'class'     => 'opanda-mail-service-options opanda-hidden',
    'items'     => array(

        array(
            'type' => 'separator'
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'sg_apikey',
            'after'     => sprintf( __( '<a href="%s" class="btn btn-default" target="_blank">Get Code</a>', 'optinpanda' ), 'http://sg-autorepondeur.com/membre_v2/compte-options.php' ),
            'title'     => __( 'Activation Code', 'optinpanda' ),
            'hint'      => __( 'The Activation Code from your SG Autorepondeur account (<i>Mon compte -> Autres Options -> Informations administratives</i>).', 'optinpanda' ),
        ),
        array(
            'type'      => 'textbox',
            'name'      => 'sg_memberid',
            'title'     => __( 'Member ID', 'optinpanda' ),
            'hint'      => __( 'The Memeber ID of your SG Autorepondeur account (<i>available on the home page below the SG logo, for example, 9059</i>).', 'optinpanda' ),
        )
    )
);*/

return $options;
