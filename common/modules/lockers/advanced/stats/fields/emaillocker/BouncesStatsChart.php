<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsChartInterface;
	use common\modules\lockers\advanced\stats\StatsChart;

	class BouncesStatsChart extends StatsChart implements StatsChartInterface {

		public $type = 'column';

		public function getFields()
		{

			return [
				'aggregate_date' => [
					'title' => 'Дата'
				],
				/*
				'ignored' => array(
					'title' => __('Who Ignored Locker', 'bizpanda'),
					'cssClass' => 'opanda-col-number',
					'color' => '#cccccc'
				),*/
				'errors' => [
					'title' => 'Столкнулись с ошибками',
					'cssClass' => 'opanda-col-number',
					'color' => '#F97D81'
				],
				'social-fails' => [
					'title' => 'Отклонили авторизацию',
					'cssClass' => 'opanda-col-number',
					'color' => '#29264E'
				]
			];
		}

		public function fieldIgnored($row)
		{
			if( !isset($row['impress']) ) {
				$row['impress'] = 0;
			}
			if( !isset($row['interaction']) ) {
				$row['interaction'] = 0;
			}

			$diff = $row['impress'] - $row['interaction'];
			if( $diff < 0 ) {
				$diff = 0;
			}

			return $diff;
		}

		public function fieldErrors($row)
		{
			if( !isset($row['error']) ) {
				$row['error'] = 0;
			}

			return $row['error'];
		}

		public function fieldNotConfirmed($row)
		{
			if( !isset($row['email-received']) ) {
				$row['email-received'] = 0;
			}
			if( !isset($row['email-confirmed']) ) {
				$row['email-confirmed'] = 0;
			}

			$diff = $row['email-received'] - $row['email-confirmed'];
			if( $diff < 0 ) {
				$diff = 0;
			}

			return $diff;
		}

		public function fieldSocialFails($row)
		{

			if( !isset($row['social-app-declined']) ) {
				$row['social-app-declined'] = 0;
			}

			return $row['social-app-declined'];
		}
	}