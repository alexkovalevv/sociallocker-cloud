/**
 * Created by Александр on 21.06.2016.
 */
if ( !window.bizpanda ) window.bizpanda = {};
if ( !window.bizpanda.lockerEditor ) window.bizpanda.lockerEditor = {};

(function($){

	window.bizpanda.lockerEditor = {

		proccess: false,
		modelFields: [],
		lockerOptions: null,
		buttonOrder: [],

		init: function() {
			this.toLockContent = $('#opanda-preview' ).clone();

			$.pandalocker.hooks.add( 'opanda-lock', function(e, locker, sender){
				console.log('unlock');
				$('.onp-preview-loader').fadeOut();
			});

			this.initOverlapModeButtons();
			this.initSocialTabs();
			this.recreatePreview();
			this.trackInputChanges();
		},

		/**
		 * Starts to track user input to refresh the preview.
		 */
		getAllFields: function() {
			var self = this,
				models = [
					'Basic',
					'Social',
					'Visability',
					'Save',
					'Advanced',
					'Subscribe',
					'Social',
					'SigninSocial'
				],
				fields = [];

			for( m in models ) {
				$('[name^="' + models[m] + '"]').each(function () {
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
						self.refreshPreview();
					}
				);
			}
		},

		updateButtonOrder: function() {
			var self = this;
			self.buttonOrder = [];
			$(".onp-vertical-tabs ul li").not('.disabled-button').each(function(){
				self.buttonOrder.push( $(this).attr('id' ).replace('tab-', '') );
			});
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
				setting = JSON.parse(window.bizpanda.lockersSettings ),
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

				connectButtons: {
					facebook: {
						appId: 'facebook_app_id',
						version: 'facebook_version'
					},
					twitter: {

					},
					google: {
						clientId: 'google_client_id'
						//channelId: ''
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
			this.updatePreviewOptions();

			var newContent = self.toLockContent.clone(),
				oldContent = $("#opanda-preview");

			oldContent.after(newContent);
			oldContent.remove();

			self.lockerOptions.demo = true;

			self.lockerOptions.groups = ["social-buttons"];

			if( window.bizpanda.buttonsGroup ) {
				self.lockerOptions.groups = window.bizpanda.buttonsGroup;
			}

			self.updateButtonOrder();

			self.lockerOptions.socialButtons.order = [
				'facebook-like',
				'twitter-tweet',
				'google-plus'
			];

			self.lockerOptions.proxy = 'http://opanda-develope.js/plugin/php/proxy.php';
			self.lockerOptions.connectButtons.order = [
				'vk',
				'twitter',
				'google'
			];

			if( self.buttonOrder.length ) {
				if( $.inArray('connect-buttons', self.lockerOptions.groups) === -1 ) {
					self.lockerOptions.socialButtons.order = self.buttonOrder;
				} else {
					self.lockerOptions.connectButtons.order = self.buttonOrder;
				}
			}

			//console.log(self.lockerOptions);

			newContent.find(".content-to-lock").pandalocker(self.lockerOptions);

		},

		initOverlapModeButtons: function() {
			var $overlapControl = $("#lockersform-overlap");
			var $positionControl = $(".onp-overlap-position-box" );

			var checkPositionControlVisability = function( ){
				var value = $overlapControl.find('input[type="radio"]:checked').val();

				if ( value === 'full' ) {
					$positionControl.fadeOut();
					return;
				}

				$positionControl.fadeIn();
			};

			/*var toggleAjaxOption = function() {
			 var value = $("#opanda_overlap").val();

			 if ( value === 'full' ) {
			 $("#opanda-ajax-disabled").hide();
			 } else {
			 $("#opanda-ajax-disabled").fadeIn();
			 }
			 };*/

			checkPositionControlVisability();
			//toggleAjaxOption();

			$overlapControl.find('input[type="radio"]').change(function(){
				checkPositionControlVisability()
				//toggleAjaxOption();
			});
		},

		updateSocialTabs: function() {
			var socialTabWrap = $(".onp-vertical-tabs");
			var socialTabItem = $(".onp-vertical-tabs ul li");

			socialTabItem.each(function(){
				var tab = $(this),
					tabId = $(this).attr('id'),
					buttonId = tabId.replace('tab-', '' ).replace('-', '_'),
					activateButton = $('input[name="Social[' + buttonId + '_available]"]:checked, ' +
					'input[name="SigninSocial[' + buttonId + '_available]"]:checked');

				if( activateButton.val() == 1 ) {
					tab.hasClass('disabled-button') && tab.removeClass('disabled-button');
				} else {
					tab.addClass('disabled-button');
				}
			});

			//this.updateButtonOrder();
		},

		/**
		 * Inits social tabs.
		 */
		initSocialTabs: function() {
			var self = this;

			this.updateSocialTabs();

			$(".onp-activate-social-button-switch").change(function(){
				self.updateSocialTabs();
			});

			$(".onp-vertical-tabs ul").sortable().bind('sortupdate', function (e) {
				self.recreatePreview();
			});


			/*$(".onp-vertical-tabs ul").sortable({
				placeholder: "sortable-placeholder",
				//appendTo: ".onp-vertical-tabs ul",
				opacity: 0.7,
				//items: "> li",
				update: function(event, ui) {
					//self.updateButtonOrder();
				}
			});*/

			/*$(".factory-align-vertical .nav-tabs li").click(function(){
				$(".opanda-overlay-tumbler-hint").hide().remove();
			});*/

			// current order

			/*var currentString = $("#opanda_buttons_order").val();
			if (currentString) {

				var currentSet = currentString.split(',');
				var originalSet = {};

				socialTabItem.each(function(){
					var tabId = $(this).data('tab-id');
					originalSet[tabId] = $(this).detach();
				});

				for(var index in currentSet) {
					var currentId = currentSet[index];
					socialTabWrap.append(originalSet[currentId]);
					delete originalSet[currentId];
				}

				for(var index in originalSet) {
					socialTabWrap.append(originalSet[index]);
				}

				$(function(){
					$(socialTabWrap.find("li a").get(0)).tab('show');
				});
			}

			// make shortable
			$(".factory-align-vertical .nav-tabs").addClass("ui-sortable");
			$(".factory-align-vertical .nav-tabs").sortable({
				placeholder: "sortable-placeholder",
				opacity: 0.7,
				items: "> li",
				update: function(event, ui) {
					self.updateButtonOrder();
				}
			});

			socialTabWrap.find('li').each(function(){
				var tabId = $(this).data('tab-id');
				var item = $(this);
				var checkbox = $("#opanda_" + tabId + "_available");

				checkbox.change(function(){
					var isAvailable = checkbox.is(':checked');

					if (!isAvailable) {
						item.addClass('factory-disabled');
					} else {
						item.removeClass('factory-disabled');
					}

					self.updateButtonOrder();
				}).change();
			});

			// hides/shows the option "Message To Share" of the Facebook Share button

			$("#opanda_facebook_share_dialog").change(function(){
				var checked = $(this).is(":checked");
				if ( checked ) {
					$("#factory-form-group-message-to-share").hide();
				} else {
					$("#factory-form-group-message-to-share").fadeIn();
				}
			}).change();*/
		}
	};

	$(function(){
		window.bizpanda.lockerEditor.init();
	});
})(jQuery);
