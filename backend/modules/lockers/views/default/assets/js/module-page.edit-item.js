/**
 * Created by Александр on 21.06.2016.
 */
if ( !window.lockerEditor ) window.lockerEditor = {};

(function($){

	window.lockerEditor = {

        presetModels: [
            'BasicMetabox',
            'VisabilityMetabox',
            'SaveLockerMetabox',
            'AdvancedMetabox',
            'SubscribeMetabox',
            'EmailFormSettings',
            'SocialButtonsSettings',
            'SigninButtonsSettings'
        ],
		modelFields: [],
        lockerType: 'sociallocker',
        lockerOptions: null,
        buttonOrder: [],

		init: function() {
            if( window.lockerType ) {
                this.lockerType = window.lockerType;
            }

			this.toLockContent = $('#opanda-preview' ).clone();

			$.pandalocker.hooks.add( 'opanda-lock', function(e, locker, sender){
                console.log(locker);
				$('.onp-preview-loader').fadeOut();
			});

            $('.locker-public-button').click(function(){
                var statusButtons = $('input[name="SaveLockerMetabox[status]"]'),
                    statusPublicButton = $('input[name="SaveLockerMetabox[status]"][value="public"]');

                statusButtons.prop('checked', false);
                statusButtons.parent('.btn').removeClass('active');

                statusPublicButton.prop('checked', true);
                statusPublicButton.parent().addClass('active');

                $(this).submit();
            });

            $.pandalocker.filters.add( window.lockerId + '.ajax-data', function( dataToPass ){
                dataToPass.opandaContextData = {
                    itemTitle: window.lockerTitle,
                    pageUrl: window.location.href,
                    itemId: window.lockerId
                };

                console.log(dataToPass);
                return dataToPass;
            });

			this.initSocialTabs();
            this.setButtonsOrder();
			this.recreatePreview();
			this.trackInputChanges();
		},

		initSocialTabs: function() {
			var self = this;

			this.updateSocialTabs();

			$(".onp-vertical-tabs ul").sortable().bind('sortupdate', function (e) {
				self.recreatePreview();
			});
		},

		updateSocialTabs: function() {
			var socialTabWrap = $(".onp-vertical-tabs");
			var socialTabItem = $(".onp-vertical-tabs ul li");

			socialTabItem.each(function(){
				var tab = $(this),
					tabId = $(this).attr('id'),
					buttonId = tabId.replace('tab-', '' ).replace('-', '_'),
					activateButton = $('input[name*="[' + buttonId + '_available]"]:checked');

				if( activateButton.val() == 1 ) {
					tab.hasClass('disabled-button') && tab.removeClass('disabled-button');
				} else {
					tab.addClass('disabled-button');
				}
			});
		},

		/**
		 * Starts to track user input to refresh the preview.
		 */
		getAllFields: function() {
			var self = this,
				fields = [];

			for( m in this.presetModels ) {
				$('[name^="' + this.presetModels[m] + '"]').each(function () {
					fields.push($(this ).attr('name'));
				});
			}

			return fields;
		},

		trackInputChanges: function() {
			var self = this,
				fields = this.getAllFields();

			for( f in fields ) {
				$( '[name^="' + fields[f] + '"]').bind('change keyup',
					function(){
                        self.updateSocialTabs();
						self.refreshPreview();
					}
				);
			}
		},

        setButtonsOrder: function() {
            var buttonsOrder =  $('input[name*="buttons_order"]', '.social-options').val()
                    ? $('input[name*="buttons_order"]', '.social-options').val().split(',')
                    : null;

            if( !buttonsOrder || buttonsOrder[0] === "" )
                return;

            var newOrder = [];

            for (var b in buttonsOrder) {
                if( !buttonsOrder.hasOwnProperty(b) )
                    continue;
                newOrder.push($("#tab-" + buttonsOrder[b]).detach());
            }

            for (var n in newOrder) {
                if( !buttonsOrder.hasOwnProperty(b) )
                    continue;
                $(".onp-vertical-tabs ul").prepend(newOrder[n]);
            }
        },

		updateButtonsOrder: function() {
			var self = this;
			self.buttonOrder = [];
			$(".onp-vertical-tabs ul li").not('.disabled-button').each(function(){
				self.buttonOrder.push( $(this).attr('id' ).replace('tab-', '') );
			});

            $('input[name*="buttons_order"]', '.social-options').val(self.buttonOrder.join(','));
		},

        updateButtonActions: function() {
            var actions = {};

            $('.action-activate-button').each(function() {

                var isAvailableAction = $(this).find('input[type="radio"]:checked').val() !== "0",
                    button = $(this).data('button'),
                    action = $(this).data('action');

                if( !action || !button ) return;

                $('input[name*="' + button + '_actions"]', $(this).closest('.tab-pane')).val('');

                if( isAvailableAction ) {
                    if( !$.isArray(actions[button]) ) actions[button] = [];
                    actions[button].push(action);
                }
            });

            for (var a in actions) {
                if( !actions.hasOwnProperty(a) )
                    continue;

                $('input[name*="' + a + '_actions"]', '.tab-pane').val(actions[a].join(','));
            }
        },

		/**
		 * Refreshes the preview after short delay.
		 */
		refreshPreview: function( force ) {
			var self = this;

			if ( this.timerOn && !force ) {
				this.timerAgain = true;
				return;
			}

			this.timerOn = true;
			setTimeout(function(){

				if (self.timerAgain) {
					self.timerAgain = false;
					self.refreshPreview( true );
				} else {
					self.timerAgain = false;
					self.timerOn = false;
					self.recreatePreview();
				}

			}, 500);
		},

		updatePreviewOptions: function(callback) {
			var self = this,
				data = {},
				setting = JSON.parse(window.lockersSettings ),
				fields = this.getAllFields();

			for( f in fields ) {

				var el = $('[name^="' + fields[f] + '"]'),
					elName = fields[f].replace(/\w+\[(.*)\]/, '$1');

				if( el.attr('type') === 'radio' || el.attr('type') === 'checkbox' ) {
					el.each( function () {
						if ( $(this).prop("checked") ) {
							if ( $(this).val () === "0" ) {
								data[elName] = false;
							} else if ( $(this).val () === "1" ) {
								data[elName] = true;
							} else {
								data[elName] = $(this).val ();
							}
						}
					});
				} else {
					data[elName] = el.val();
				}
			}

			$.extend(true, data, setting);

			self.lockerOptions = self.mapLockerOptions(data);

            self.prepareOptions();
		},

        prepareOptions: function () {
            var self = this;

            this.lockerOptions.id = window.lockerId;
            this.lockerOptions.lockerId = window.lockerId;
            this.lockerOptions.demo = true;

            if( this.lockerType == 'signinlocker' || this.lockerType == 'emaillocker' ) {
                if( window.proxyUrl ) {
                    this.lockerOptions.proxy = window.proxyUrl;
                }

                if( window.subscriptionService ) {
                    if (!this.lockerOptions.subscribeActionOptions)
                        this.lockerOptions.subscribeActionOptions = {};

                    this.lockerOptions.subscribeActionOptions['service'] = window.subscriptionService;
                }

                if( window.terms && window.privacy ) {
                    this.lockerOptions.terms = window.terms;
                    this.lockerOptions.termsPopup = {
                        width:  570,
                        height: 400
                    };
                    this.lockerOptions.privacyPolicy = window.privacy;
                }
            }

            this.lockerOptions.groups = ["social-buttons"];

            if( window.buttonsGroup ) {
                this.lockerOptions.groups = window.buttonsGroup;
            }

            this.updateButtonsOrder();                      
            
            // Сортировка по умолчанию
            if( this.lockerType == 'sociallocker' ) {
                this.lockerOptions.socialButtons.order = [
                    'facebook-like',
                    'twitter-tweet',
                    'google-plus'
                ];
                if( this.buttonOrder.length ) {
                    this.lockerOptions.socialButtons.order = this.buttonOrder;
                }
            }

            // Сортировка по умолчанию
            if( this.lockerType == 'signinlocker' ) {
                this.lockerOptions.connectButtons.order = [
                    'vk',
                    'twitter',
                    'google'
                ];
                
                if( this.buttonOrder.length ) {
                    this.lockerOptions.connectButtons.order = this.buttonOrder;
                }
                
            }

            /** =================== Email замок =================== */

            if( this.lockerType == 'emaillocker' ) {
                var cfField = $('input[name*="custom_fields"]'),
                    subscribeSbAvailable = $('input[name*="subscribe_allow_social"]:checked'),
                    subscribeSbuttons = $('input[name*="subscribe_social_buttons"]:checked');

                if( subscribeSbAvailable.val() == "1" ) {

                    console.log(subscribeSbuttons.length);

                    if( subscribeSbuttons.length ) {
                        this.lockerOptions.connectButtons.order = [];
                        this.lockerOptions.groups = [
                            "subscription",
                            "connect-buttons"
                        ];

                        subscribeSbuttons.each(function() {
                            var socialNetwork = $(this).val();
                            self.lockerOptions.connectButtons[socialNetwork].action = 'subscribe';
                            self.lockerOptions.connectButtons.order.push(socialNetwork);
                        });
                    }
                }

                this.lockerOptions.subscription.order = ['form'];

                if( cfField.data('fields') ) {
                    this.lockerOptions.subscription.form.fields = cfField.data('fields');
                } else if( cfField.val() ) {
                    var customFieldsData = JSON.parse(cfField.val()),
                        customFields = [];

                    for( cf in customFieldsData ) {
                        if( !customFieldsData.hasOwnProperty(cf) )
                            continue;
                        customFields[cf] = customFieldsData[cf].fieldOptions;
                    }

                    this.lockerOptions.subscription.form.fields = customFields;
                }
            }

            console.log(this.lockerOptions);
        },

		recreatePreview: function() {
            if( this.lockerType == 'signinlocker' ) {
                this.updateButtonActions();
            }

			this.updatePreviewOptions();

			var newContent = this.toLockContent.clone(),
				oldContent = $("#opanda-preview");

			oldContent.after(newContent);
			oldContent.remove();

			newContent.find(".content-to-lock").pandalocker(this.lockerOptions);

		},

        mapLockerOptions: function(data) {
            var map = {
                demo:  'always',
                theme: 'style',
                lang:  'buttons_lang',
                text:  {
                    'header':  null,
                    'message': null
                },
                overlap:       {
                    mode:     'overlap',
                    position: 'overlap_position'
                },
                effects:       {
                    highlight: null
                },
                locker:        {
                    timer:  null,
                    close:  null,
                    mobile: null
                },

                subscribeActionOptions:{
                    listId: 'subscribe_list',
                    //service:"database",
                    doubleOptin: 'subscribe_mode'
                    //confirm:false
                },

                subscription: {
                    form:{
                        buttonText: 'form_button_text',
                        noSpamText: 'form_after_button_text',
                        type: 'form_type'
                    }
                },

                connectButtons: {
                    facebook: {
                        actions: 'facebook_actions:array',
                        appId: 'facebook_app_id',
                        version: 'facebook_version'
                    },
                    twitter: {
                        actions: 'twitter_actions:array',
                        follow: {
                            user: 'twitter_follow_user',
                            notifications: 'twitter_follow_notifications'
                        },
                        tweet: {
                            message: 'twitter_tweet_message'
                        }
                    },
                    google: {
                        actions: 'google_actions:array',
                        clientId: 'google_client_id',
                        channelId: 'google_youtube_subscribe_channel_id'
                    },
                    linkedin: {
                        actions: 'linkedin_actions:array',
                        clientId: 'linkedin_client_id',
                        apiKey: 'linkedin_client_secret'
                    },
                    vk: {
                        actions: 'vk_actions:array',
                        appId: 'vk_app_id'
                    }
                },

                socialButtons: {
                    counters: null,
                    facebook: {
                        appId:   'facebook_app_id',
                        version: 'facebook_version',
                        like:    {
                            url:   'facebook_like_url',
                            title: 'facebook_like_title'
                        },
                        share:   {
                            shareDialog: 'facebook_share_dialog',
                            url:         'facebook_share_url',
                            title:       'facebook_share_title',
                            name:        'facebook_share_message_name',
                            caption:     'facebook_share_message_caption',
                            description: 'facebook_share_message_description',
                            image:       'facebook_share_message_image'
                        }
                    },
                    twitter:  {
                        tweet:  {
                            url:         'twitter_tweet_url',
                            text:        'twitter_tweet_text',
                            title:       'twitter_tweet_title',
                            doubleCheck: 'twitter_tweet_auth',
                            via:         'twitter_tweet_via'
                        },
                        follow: {
                            url:            'twitter_follow_url',
                            title:          'twitter_follow_title',
                            doubleCheck:    'twitter_follow_auth',
                            hideScreenName: 'twitter_follow_hide_name'
                        }
                    },
                    google:   {
                        plus:  {
                            url:   'google_plus_url',
                            title: 'google_plus_title'
                        },
                        share: {
                            url:   'google_share_url',
                            title: 'google_share_title'
                        }
                    },
                    youtube:  {
                        subscribe: {
                            channelId: 'google_youtube_channel_id',
                            title:     'google_youtube_title'
                        }
                    },
                    linkedin: {
                        share: {
                            url:   'linkedin_share_url',
                            title: 'linkedin_share_title'
                        }
                    },
                    vk:       {
                        appId:       'vk_app_id',
                        accessToken: 'vk_access_token',
                        lang:        'buttons_lang',
                        like:        {
                            pageTitle:       'vk_like_message_title',
                            pageDescription: 'vk_like_message_description',
                            pageUrl:         'vk_like_url',
                            pageImage:       'vk_like_message_image',
                            text:            'vk_like_message_caption',
                            title:           'vk_like_title',
                            requireSharing:  'vk_like_require_sharing'
                        },
                        share:       {
                            pageUrl:         'vk_share_url',
                            pageTitle:       'vk_share_message_title',
                            pageDescription: 'vk_share_description',
                            pageImage:       'vk_share_message_image',
                            title:           'vk_share_title'
                        },
                        subscribe:   {
                            groupId: 'vk_subscribe_group_id',
                            title:   'vk_subscribe_title'

                        }
                    },
                    ok:       {
                        share: {
                            url:   'ok_share_url',
                            title: 'ok_share_title'
                        }
                    },
                    mail:     {
                        share: {
                            pageUrl:         'mail_share_url',
                            pageDescription: 'mail_share_message_description',
                            pageImage:       'mail_share_message_image',
                            pageTitle:       'mail_share_message_title',
                            title:           'mail_share_title'
                        }
                    }
                }
            };

            return this.pushOptionsToMap(map, data);
        },

        pushOptionsToMap: function(map, data) {
            for( key in map ) {
                if( $.type(map[key]) !== 'object' ) {
                    if(map[key] !== null) {
                        if( map[key].indexOf(':array') != -1 ) {
                            map[key] = data[map[key].replace(':array', '')] ? data[map[key].replace(':array', '')].split(',') : null;
                        } else {
                            map[key] = data[map[key]] || null;
                        }
                    } else {
                       map[key] = data[key] || null;
                    }
                } else {
                    map[key] = this.pushOptionsToMap(map[key], data);
                }
            }
            return map;
        }

	};

	$(function(){
		window.lockerEditor.init();
	});
})(jQuery);
