<?php
	namespace common\modules\lockers\advanced\stats\fields\signinlocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsChartInterface;
	use common\modules\lockers\advanced\stats\StatsChart;

	class ProfitsStatsChart extends StatsChart implements StatsChartInterface {

		public $type = 'line';

		public function getFields()
		{

			$fields = [];

			$fields['aggregate_date'] = [
				'title' => 'Дата'
			];

			$fields['emails'] = [
				'title' => 'Emails',
				'color' => '#FFCC66'
			];

			$fields['got-via-twitter-follow'] = [
				'title' => 'Подписчиков в Twitter',
				'color' => '#3bb4ea'
			];
			$fields['got-via-twitter-tweet'] = [
				'title' => 'Сообщений в Twitter',
				'color' => '#1e92c9'
			];
			$fields['got-via-youtube-subscribe'] = [
				'title' => 'Подписчиков в Youtube',
				'color' => '#ba5145'
			];
			$fields['got-via-linkedin-follow'] = [
				'title' => 'Подписчиков в LinkedIn',
				'color' => '#006080'
			];

			return $fields;
		}
	}