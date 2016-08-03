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
				$('.onp-preview-loader').fadeOut();
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
                $('input[name*="' + a + '_actions"]', $(this).closest('.tab-pane')).val(actions[a].join(','));
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
						appId: 'facebook_app_id',
						version: 'facebook_version'
					},
					twitter: {
                        follow: {
                            user: 'twitter_follow_user',
                            notifications: 'twitter_follow_notifications'
                        },
                        tweet: {
                            message: 'twitter_tweet_message'
                        }
					},
					google: {
						clientId: 'google_client_id',
						channelId: 'google_youtube_subscribe_channel_id'
					},
					linkedin: {
						clientId: 'linkedin_client_id',
						apiKey: 'linkedin_client_secret'
					},
					vk: {
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
						map[key] = data[map[key]] || null;
					} else {
						map[key] = data[key] || null;
					}
				} else {
					map[key] = this.pushOptionsToMap(map[key], data);
				}
			}
			return map;
		},

		/**
		 * Recreates the preview, submmits forms to the preview frame.
		 */
		recreatePreview: function() {
			var self = this;

            if( this.lockerType == 'signinlocker' ) {
                this.updateButtonActions();
            }
			this.updatePreviewOptions();

			var newContent = self.toLockContent.clone(),
				oldContent = $("#opanda-preview");

			oldContent.after(newContent);
			oldContent.remove();

			self.lockerOptions.demo = true;

            if( this.lockerType == 'signinlocker' || this.lockerType == 'emaillocker' ) {
                if( window.proxyUrl ) {
                    self.lockerOptions.proxy = window.proxyUrl;
                }

                if( window.subscriptionService ) {
                    if (!self.lockerOptions.subscribeActionOptions)
                        self.lockerOptions.subscribeActionOptions = {};

                    self.lockerOptions.subscribeActionOptions['service'] = window.subscriptionService;
                }

                if( window.terms && window.privacy ) {
                    self.lockerOptions.terms = window.terms;
                    self.lockerOptions.termsPopup = {
                        width:  570,
                        height: 400
                    };
                    self.lockerOptions.privacyPolicy = window.privacy;
                }
            }

			self.lockerOptions.groups = ["social-buttons"];

			if( window.buttonsGroup ) {
				self.lockerOptions.groups = window.buttonsGroup;
			}

			self.updateButtonsOrder();

            if( this.lockerType == 'sociallocker' ) {
                self.lockerOptions.socialButtons.order = [
                    'facebook-like',
                    'twitter-tweet',
                    'google-plus'
                ];
            }

            if( this.lockerType == 'signinlocker' ) {
                self.lockerOptions.connectButtons.order = [
                    'vk',
                    'twitter',
                    'google'
                ];
            }

            if( this.lockerType == 'emaillocker' ) {
                self.lockerOptions.subscription.order = ['form'];
            }

			if( self.buttonOrder.length ) {
				if( this.lockerType == 'sociallocker' ) {
					self.lockerOptions.socialButtons.order = self.buttonOrder;
				} else if( this.lockerType == 'signinlocker' ) {
					self.lockerOptions.connectButtons.order = self.buttonOrder;
				}
			}

            console.log(self.lockerOptions);

			newContent.find(".content-to-lock").pandalocker(self.lockerOptions);

		}

	};

	$(function(){
		window.lockerEditor.init();
	});
})(jQuery);
