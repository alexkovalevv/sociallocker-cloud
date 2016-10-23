<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsTableInterface;
	use common\modules\lockers\advanced\stats\StatsTable;

	class SummaryStatsTable extends StatsTable implements StatsTableInterface {

		public function getColumns()
		{

			return [
				'index' => [
					'title' => ''
				],
				'title' => [
					'title' => 'Заголовок страницы',
				],
				'impress' => [
					'title' => 'Просмотры',
					'cssClass' => 'opanda-col-number'
				],
				'unlock' => [
					'title' => 'Количество открытий',
					'hint' => 'Число открытий замка сделанных пользователями..',
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				],
				'conversion' => [
					'title' => 'Конверсия',
					'hint' => 'Соотношение количества открытий к просмотрам, в процентах.',
					'cssClass' => 'opanda-col-number'
				]
			];
		}
	}