<?php
	/**
	 * Инструменты для работы замками
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\classes;

	class LockersTools {

		/**
		 * Собирает опции в массив по заранее установленной карте.
		 * Карта опций основана на модели принимаемых данных в
		 * jQuery версии социального замка.
		 * @param $data
		 * @param $locker_type
		 * @return array
		 */
		public function mapLockerOptions($data, $locker_type)
		{
			$mapData = [
				'demo' => 'always',
				'theme' => 'style',
			];
			$mapData['text'] = [
				'header' => null,
				'message' => null
			];
			$mapData['overlap'] = [
				'mode' => 'overlap',
				'position' => 'overlap_position'
			];
			$mapData['effects'] = ['highlight' => null];
			$mapData['locker'] = [
				'timer' => null,
				'close' => null,
				'mobile' => null
			];

			if( $locker_type == 'emaillocker' ) {
				$mapData['subscribeActionOptions'] = [
					'listId' => 'subscribe_list',
					//'service' => 'database',
					//'doubleOptin' => 'subscribe_mode'
				];
			}

			$mapData['subscription'] = [
				'form' => [
					'buttonText' => 'form_button_text',
					'noSpamText' => 'form_after_button_text',
					'type' => 'form_type',
					'fields' => ['value' => 'custom_fields', 'map_filter' => [$this, 'getCustomFields']]
				]
			];

			if( $locker_type == 'signinlocker' ) {
				$mapData['connectButtons'] = [
					'order' => 'buttons_order',
					'facebook' => [
						'actions' => 'facebook_actions',
						'version' => 'facebook_version',
					],
					'twitter' => [
						'actions' => 'twitter_actions',
						'follow' => [
							'url' => 'twitter_follow_user',
							'notifications' => 'twitter_follow_notifications',
						],
						'tweet' => [
							'text' => 'twitter_tweet_message'
						],
					],
					'google' => [
						'actions' => 'google_actions',
						'channelId' => 'google_youtube_subscribe_channel_id',
					],
					'linkedin' => [
						'actions' => 'linkedin_actions'
					],
					'vk' => [
						'actions' => 'vk_actions'
					]
				];
			}

			if( $locker_type == 'sociallocker' ) {
				$mapData['socialButtons'] = [
					'counters' => null,
					'order' => 'buttons_order',
					'facebook' => [
						'lang' => null,
						'version' => null,
						'like' => [
							'url' => 'facebook_like_url',
							'title' => 'facebook_like_title',
						],
						'share' => [
							'shareDialog' => 'facebook_share_dialog',
							'url' => 'facebook_share_url',
							'title' => 'facebook_share_title',
							'name' => 'facebook_share_message_name',
							'caption' => 'facebook_share_message_caption',
							'description' => 'facebook_share_message_description',
							'image' => 'facebook_share_message_image',
						]
					],
					'twitter' => [
						'lang' => null,
						'tweet' => [
							'url' => 'twitter_tweet_url',
							'text' => 'twitter_tweet_text',
							'title' => 'twitter_tweet_title',
							'doubleCheck' => 'twitter_tweet_auth',
							'via' => 'twitter_tweet_via'
						],
						'follow' => [
							'url' => 'twitter_follow_url',
							'title' => 'twitter_follow_title',
							'doubleCheck' => 'twitter_follow_auth',
							'hideScreenName' => 'twitter_follow_hide_name',
						]
					],
					'google' => [
						'plus' => [
							'url' => 'google_plus_url',
							'title' => 'google_plus_title',
						],
						'share' => [
							'url' => 'google_share_url',
							'title' => 'google_share_title',
						]
					],
					'youtube' => [
						'subscribe' => [
							'channelId' => 'google_youtube_channel_id',
							'title' => 'google_youtube_title',
						],
					],
					'linkedin' => [
						'share' => [
							'url' => 'linkedin_share_url',
							'title' => 'linkedin_share_title',
						],
					],
					'vk' => [
						'lang' => null,
						'like' => [
							'pageTitle' => 'vk_like_message_title',
							'pageDescription' => 'vk_like_message_description',
							'pageUrl' => 'vk_like_url',
							'pageImage' => 'vk_like_message_image',
							'text' => 'vk_like_message_caption',
							'title' => 'vk_like_title',
							'requireSharing' => 'vk_like_require_sharing',
						],
						'share' => [
							'pageUrl' => 'vk_share_url',
							'pageTitle' => 'vk_share_message_title',
							'pageDescription' => 'vk_share_description',
							'pageImage' => 'vk_share_message_image',
							'title' => 'vk_share_title'
						],
						'subscribe' => [
							'groupId' => 'vk_subscribe_group_id',
							'title' => 'vk_subscribe_title',
						]
					],
					'ok' => [
						'share' => [
							'url' => 'ok_share_url',
							'title' => 'ok_share_title',
						]
					],
					'mail' => [
						'share' => [
							'pageUrl' => 'mail_share_url',
							'pageDescription' => 'mail_share_message_description',
							'pageImage' => 'mail_share_message_image',
							'pageTitle' => 'mail_share_message_title',
							'title' => 'mail_share_title'
						],
					]
				];
			}

			return $this->recursivePushOptions($mapData, $data);
		}

		/**
		 * Рекурсивно заполняет массив опций по карте
		 * @param $map - карта опций
		 * @return array - массив опций наложенных на карту
		 */
		protected function recursivePushOptions($map, $data)
		{
			foreach($map as $consumer_option_name => $provider_option) {
				$available_filter = false;
				$filter_name = null;

				if( is_array($provider_option) && array_key_exists('map_filter', $provider_option) ) {
					$filter_name = $provider_option['map_filter'];
					$provider_option = $provider_option['value'];
					$available_filter = true;
				}

				if( !is_array($provider_option) ) {

					if( !empty($provider_option) ) {
						$map[$consumer_option_name] = isset($data[$provider_option])
							? $data[$provider_option]
							: null;
					} else {
						$map[$consumer_option_name] = isset($data[$consumer_option_name])
							? $data[$consumer_option_name]
							: null;
					}

					if( $available_filter ) {
						$map[$consumer_option_name] = call_user_func_array($filter_name, [$map[$consumer_option_name]]);
					}
				} else {
					$map[$consumer_option_name] = $this->recursivePushOptions($map[$consumer_option_name], $data);
				}
			}

			return $map;
		}

		public function getCustomFields($fields)
		{
			$format_items = [];
			foreach($fields as $field) {
				$format_items[] = $field['fieldOptions'];
			}

			return $format_items;
		}
	}