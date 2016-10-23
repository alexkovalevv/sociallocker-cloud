<?php
	/**
	 * Интерфейс для экранов статистики
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats\interfaces;

	interface StatsChartInterface {

		public function getFields();
	}