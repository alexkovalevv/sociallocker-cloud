<?php
	namespace common\modules\lockers\advanced\stats\fields\sociallocker;

	use common\modules\lockers\advanced\stats\StatsChart;

	class DetailedStatsChart extends StatsChart {

		public $type = 'line';

		public function getFields()
		{
			$channels = [
				'aggregate_date' => [
					'title' => 'Дата'
				],
				'got-via-facebook-like' => [
					'title' => 'FB мне нравится',
					'color' => '#7089be'
				],
				'got-via-facebook-subscribe' => [
					'title' => 'FB подписаться',
					'color' => '#7089be'
				],
				'got-via-facebook-share' => [
					'title' => 'FB поделиться',
					'color' => '#566a93'
				],
				'got-via-twitter-tweet' => [
					'title' => 'TW твитнуть',
					'color' => '#3ab9e9'
				],
				'got-via-twitter-follow' => [
					'title' => 'TW подписаться',
					'color' => '#1c95c3'
				],
				'got-via-google-plus' => [
					'title' => 'G плюс',
					'color' => '#e26f61'
				],
				'got-via-google-share' => [
					'title' => 'G поделиться',
					'color' => '#ba5145'
				],
				'got-via-youtube-subscribe' => [
					'title' => 'YouTube',
					'color' => '#8f352b'
				],
				'got-via-linkedin-share' => [
					'title' => 'LN поделиться',
					'color' => '#006080'
				],
				'got-via-vk-like' => [
					'title' => 'VK мне нравится',
					'color' => '#5F83AA'
				],
				'got-via-vk-share' => [
					'title' => 'VK поделиться',
					'color' => '#5F83AA'
				],
				'got-via-vk-subscribe' => [
					'title' => 'VK подписаться',
					'color' => '#5F83AA'
				],
				'got-via-ok-share' => [
					'title' => 'OK поделиться',
					'color' => '#FE9D4A'
				],
				'got-via-mail-share' => [
					'title' => 'MR поделиться',
					'color' => '#07447E'
				]
			];

			return $channels;
		}
	}