<?php
	namespace common\modules\lockers\advanced\stats\fields\signinlocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsChartInterface;
	use common\modules\lockers\advanced\stats\StatsChart;

	class SkipsStatsChart extends StatsChart implements StatsChartInterface {

		public $type = 'column';

		public function getFields()
		{

			return [
				'aggregate_date' => [
					'title' => 'Дата'
				],
				'unlock' => [
					'title' => 'Количество открытий',
					'color' => '#0074a2'
				],
				'skip-via-timer' => [
					'title' => 'Пропущено по таймеру',
					'color' => '#333333'

				],
				'skip-via-cross' => [
					'title' => 'Пропущено через кнопку закрыть',
					'color' => '#dddddd'
				]
			];
		}
	}