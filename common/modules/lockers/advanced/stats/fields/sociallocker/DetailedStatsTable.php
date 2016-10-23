<?php
	namespace common\modules\lockers\advanced\stats\fields\sociallocker;

	use common\modules\lockers\advanced\stats\StatsTable;

	class DetailedStatsTable extends StatsTable {

		public function getColumns()
		{

			$table = [
				'index' => [
					'title' => ''
				],
				'title' => [
					'title' => 'Заголовок страницы'
				],
				'unlock' => [
					'title' => 'Всего открыто',
					'hint' => 'Общее число открытий замка, сделанных пользователями.',
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				],
				'channels' => [
					'title' => 'Открыто через',
					'cssClass' => 'opanda-col-common',
					'columns' => [
						'got-via-facebook-like' => [
							'title' => '<i class="fa fa-facebook" aria-hidden="true" title="Нравится"></i><i class="fa fa-heart" aria-hidden="true" title="Нравится"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-facebook-subscribe' => [
							'title' => '<i class="fa fa-facebook" aria-hidden="true" title="Подписаться"></i><i class="fa fa-user-plus" aria-hidden="true" title="Подписаться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-facebook-share' => [
							'title' => '<i class="fa fa-facebook" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-twitter-follow' => [
							'title' => '<i class="fa fa-twitter" aria-hidden="true" title="Подписаться"></i> <i class="fa fa-user-plus" aria-hidden="true" title="Подписаться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-twitter-tweet' => [
							'title' => '<i class="fa fa-twitter" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-google-plus' => [
							'title' => '<i class="fa fa-google-plus" aria-hidden="true" title="Плюс"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-google-share' => [
							'title' => '<i class="fa fa-google" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-youtube-subscribe' => [
							'title' => '<i class="fa fa-youtube" aria-hidden="true" title="Подписаться"></i> <i class="fa fa-user-plus" aria-hidden="true" title="Подписаться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-linkedin-share' => [
							'title' => '<i class="fa fa-linkedin" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-vk-like' => [
							'title' => '<i class="fa fa-vk" aria-hidden="true" title="Нравится"></i> <i class="fa fa-heart" aria-hidden="true" title="Нравится"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-vk-share' => [
							'title' => '<i class="fa fa-vk" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-vk-subscribe' => [
							'title' => '<i class="fa fa-vk" aria-hidden="true" title="Подписаться"></i> <i class="fa fa-user-plus" aria-hidden="true" title="Подписаться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-ok-share' => [
							'title' => '<i class="fa fa-odnoklassniki" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						],
						'got-via-mail-share' => [
							'title' => '<i class="fa fa-at" aria-hidden="true" title="Поделиться"></i> <i class="fa fa-retweet" aria-hidden="true" title="Поделиться"></i>',
							'cssClass' => 'opanda-col-number'
						]
					]
				]
			];

			return $table;
		}
	}