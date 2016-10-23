<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsTableInterface;
	use common\modules\lockers\advanced\stats\StatsTable;

	class SkipsStatsTable extends StatsTable implements StatsTableInterface {

		public function getColumns()
		{

			return [
				'index' => [
					'title' => ''
				],
				'title' => [
					'title' => 'Заголовок страницы'
				],
				'unlock' => [
					'title' => 'Количество открытий',
					'hint' => 'Число открытий замка сделанных пользователями.',
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				],
				'skip-via-timer' => [
					'title' => 'Открыто по таймеру',
					'cssClass' => 'opanda-col-number'

				],
				'skip-via-cross' => [
					'title' => 'Открыто через кнопку "Закрыть"',
					'cssClass' => 'opanda-col-number'
				]
			];
		}
	}
