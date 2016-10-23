<?php
	namespace common\modules\lockers\advanced\stats\fields\signinlocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsTableInterface;
	use common\modules\lockers\advanced\stats\StatsTable;

	class ProfitsStatsTable extends StatsTable implements StatsTableInterface {

		public function getColumns()
		{

			$columns = [
				'index' => [
					'title' => ''
				],
				'title' => [
					'title' => 'Заголовок страницы'
				],
				'unlock' => [
					'title' => 'Открыто',
					'hint' => 'Число открытий замка сделанных пользователями.',
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				]
			];

			$columns['emails'] = [
				'title' => 'Emails',
				'hint' => 'Количество новых email адресов, добавленных в базу данных. Если email адрес уже существует в базе данных, он не будет учитываться.',
				'cssClass' => 'opanda-col-number'
			];

			$columns['got-via-twitter-follow'] = [
				'title' => 'Подписчиков в Twitter',
				'hint' => 'Количество новых подписчиков, полученных через Замок авторизации. Если пользователь ранее был подписан на вас, эти данные не будут учитываться в статистике.',
				'cssClass' => 'opanda-col-number',
				'prefix' => '+'
			];

			$columns['got-via-twitter-tweet'] = [
				'title' => 'Сообщений в Twitter',
				'hint' => 'Количество твитов, сделанных с помощью Замка авторизации.',
				'cssClass' => 'opanda-col-number',
				'prefix' => '+'
			];

			$columns['got-via-youtube-subscrib'] = [
				'title' => 'Подписчиков в Youtube',
				'hint' => 'Количество новых подписчиков, полученных с помощью Замка авторизации. Если пользователь был ранее подписан, то эти данные не будет учитываться.',
				'cssClass' => 'opanda-col-number',
				'prefix' => '+'
			];

			$columns['got-via-linkedin-follow'] = [
				'title' => 'Подписчиков в LinkedIn',
				'hint' => 'Количество новых подписчиков, полученных через Замок авторизации. Если пользователь ранее был подписан на вас, эти данные не будут учитываться в статистике.',
				'cssClass' => 'opanda-col-number',
				'prefix' => '+'
			];

			return $columns;
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
			/*if( BizPanda::getSubscriptionServiceName() !== 'database' ) {
				echo ' <em>(' . $row['email-confirmed'] . ' confirmed)';
			}*/
		}
	}
