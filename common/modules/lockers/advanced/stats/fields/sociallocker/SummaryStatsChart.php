<?php
	namespace common\modules\lockers\advanced\stats\fields\sociallocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsChartInterface;
	use common\modules\lockers\advanced\stats\StatsChart;

	class SummaryStatsChart extends StatsChart implements StatsChartInterface {

		public function getSelectors()
		{
			return null;
		}

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
				'impress' => [
					'title' => 'Количество просмотров',
					'color' => '#a5599e'
				]
			];
		}
	}