<?php
	/**
	 * Предоставляет графики и таблицы статистики
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats;

	use Yii;
	use common\modules\lockers\advanced\stats\Stats;

	class StatsScreen {

		protected $options;

		public function __construct($options)
		{
			$this->options = $options;
		}

		public function getChart($options)
		{
			$chart = new Stats($options);
			$chart_data = $chart->getChartData();

			return Yii::createObject($this->options['chartClass'], [$this, $chart_data]);
		}

		public function getTable($options)
		{
			$table = new Stats($options);
			$table_data = $table->getViewTable();

			return Yii::createObject($this->options['tableClass'], [$this, $table_data]);
		}
	}