<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsTableInterface;
	use common\modules\lockers\advanced\stats\StatsTable;

	class ProfitsStatsTable extends StatsTable implements StatsTableInterface {

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
					'hint' => 'Число открытий замка сделанных пользователями..',
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				],
				'emails' => [
					'title' => 'Email адресов',
					'hint' => 'Количество новых email адресов, добавленных в базу данных. Если email адрес уже существует в базе данных, он не будет учитываться.',
					'cssClass' => 'opanda-col-number'
				]
			];
		}

		public function columnEmails($row)
		{
			if( !isset($row['email-received']) ) {
				$row['email-received'] = 0;
			}
			if( !isset($row['email-confirmed']) ) {
				$row['email-confirmed'] = 0;
			}

			if( $row['email-received'] > 0 ) {
				echo '+';
			}
			echo $row['email-received'];
			/*if ( BizPanda::getSubscriptionServiceName() !== 'database' ) {
				echo ' <em>(' . $row['email-confirmed'] . ' ' .  __('confirmed','bizpanda').')';
			}*/
		}
	}