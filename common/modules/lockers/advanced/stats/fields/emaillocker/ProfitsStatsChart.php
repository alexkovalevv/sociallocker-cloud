<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsChartInterface;
	use common\modules\lockers\advanced\stats\StatsChart;

	class ProfitsStatsChart extends StatsChart implements StatsChartInterface {

		public $type = 'line';

		public function getFields()
		{

			return [
				'aggregate_date' => [
					'title' => 'Дата'
				],
				'email-received' => [
					'title' => 'Email адресов',
					'color' => '#FFCC66'
				],
				'email-confirmed' => [
					'title' => 'Подписки подтверждены',
					'color' => '#336699'
				],
			];
		}
	}