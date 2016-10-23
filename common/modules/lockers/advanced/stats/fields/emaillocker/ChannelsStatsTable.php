<?php
	namespace common\modules\lockers\advanced\stats\fields\emaillocker;

	use common\modules\lockers\advanced\stats\interfaces\StatsTableInterface;
	use common\modules\lockers\advanced\stats\StatsTable;

	class ChannelsStatsTable extends StatsTable implements StatsTableInterface {

		public function getColumns()
		{

			$prepare = [
				'index' => [
					'title' => ''
				],
				'title' => [
					'title' => 'Заголовок страницы'
				],
				'unlock' => [
					'title' => 'Количество открытий',
					'hint' => 'Число откртытий замков сделанных пользователями.',
					'highlight' => true,
					'cssClass' => 'opanda-col-number'
				],
				'unlock-via-form' => [
					'title' => 'Через форму',
					'cssClass' => 'opanda-col-number'
				],
				'unlock-via-facebook' => [
					'title' => 'Через Facebook',
					'cssClass' => 'opanda-col-number'
				],
				'unlock-via-twitter' => [
					'title' => 'Через Twitter',
					'cssClass' => 'opanda-col-number'
				],
				'unlock-via-google' => [
					'title' => 'Через Google',
					'cssClass' => 'opanda-col-number'
				],
				'unlock-via-linkedin' => [
					'title' => 'Через LinkedIn',
					'cssClass' => 'opanda-col-number'
				],
				'unlock-via-vk' => [
					'title' => 'Через Вконтакте',
					'cssClass' => 'opanda-col-number'
				]
			];

			return $prepare;
		}
	}