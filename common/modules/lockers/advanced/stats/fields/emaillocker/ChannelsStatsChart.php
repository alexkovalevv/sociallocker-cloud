<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsChartInterface;
	use common\modules\lockers\advanced\stats\StatsChart;

	class ChannelsStatsChart extends StatsChart implements StatsChartInterface {

		public $type = 'line';

		public function getFields()
		{

			$prepare = [
				'aggregate_date' => [
					'title' => 'Дата',
				],
				'unlock-via-form' => [
					'title' => 'Через форму',
					'color' => '#31ccab'
				],
				'unlock-via-facebook' => [
					'title' => 'Через Facebook',
					'color' => '#7089be'
				],
				'unlock-via-twitter' => [
					'title' => 'Через Twitter',
					'color' => '#3ab9e9'
				],
				'unlock-via-google' => [
					'title' => 'Через Google',
					'color' => '#e26f61'
				],
				'unlock-via-linkedin' => [
					'title' => 'Через LinkedIn',
					'color' => '#006080'
				],
				'unlock-via-vk' => [
					'title' => 'Через Вконтакте',
					'color' => '#567CA4'
				]
			];
			
			return $prepare;
		}
	}