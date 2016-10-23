<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsTableInterface;
	use common\modules\lockers\advanced\stats\StatsTable;

	class BouncesStatsTable extends StatsTable implements StatsTableInterface {

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
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				],
				'users' => [
					'title' => 'Посетители',
					'cssClass' => 'opanda-col-common',
					'columns' => [
						/*
						'ignored' => array(
							'title' => __('Ignored Locker', 'bizpanda'),
							'hint' => __('The number of visitors who viewed the locker but didn\'t try to interact with the one (no clicks on any buttons).', 'bizpanda'),
							'cssClass' => 'opanda-col-number'
						),*/
						'errors' => [
							'title' => 'Столкнулись с ошибками',
							'hint' => 'Посетители, которые столкнулись с ошибками и не смогли разблокировать контент. Обычно это значение должно быть равно 0. Если нет, пожалуйста, проверьте настройки вашего замка или обратитесь в службу поддержки OnePress.',
							'cssClass' => 'opanda-col-number'
						],
						'social-fails' => [
							'title' => 'Отклонили авторизацию',
							'hint' => 'Посетители, которые отказались авторизоваться в вашем приложении. Если вы считаете, что это отказов слишком много, попробуйте установить меньше действий для одной кнопки (оставить, например, только подписку).',
							'cssClass' => 'opanda-col-number'
						]
					]
				]
			];
		}

		public function columnIgnored($row)
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
			echo $diff;
		}

		public function columnErrors($row)
		{
			if( !isset($row['error']) ) {
				$row['error'] = 0;
			}
			echo $row['error'];
		}

		public function columnNotConfirmed($row)
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

			echo $diff;
		}

		public function columnSocialFails($row)
		{

			if( !isset($row['social-app-declined']) ) {
				$row['social-app-declined'] = 0;
			}
			echo $row['social-app-declined'];
		}
	}
