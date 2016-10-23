<?php
	/**
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats\fields\signinlocker;

	use common\modules\lockers\advanced\stats\interfaces\ScreenInterface;

	class Screens implements ScreenInterface {

		const CLASSES_NAMESPACE = 'common\modules\lockers\advanced\stats\fields\signinlocker';

		public static function getScreen($screens_name)
		{
			$screens = self::getScreens();

			return $screens[$screens_name];
		}

		public static function getScreens()
		{
			$screens = [
				// The Summary Screen
				'summary' => [
					'title' => '<i class="fa fa-search"></i> Сводка',
					'description' => 'Страницы показывают общее количество открытий текущего замка.',
					'chartClass' => self::CLASSES_NAMESPACE . '\SummaryStatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\SummaryStatsTable',
				],
				// The Channels Screen
				'channels' => [
					'title' => '<i class="fa fa-search-plus"></i> Детально',
					'description' => 'На странице показаны способы, которые пользователи использовали для открытия контента, а так же количество.',
					'chartClass' => self::CLASSES_NAMESPACE . '\ChannelsStatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\ChannelsStatsTable'
				],
				// The Skips Screen
				'skips' => [
					'title' => '<i class="fa fa-tint"></i> Утечки',
					'description' => 'На диаграмме показано, сколько пользователей открыло замок с помощью таймера или кнопки "Закрыть", по сравнению с пользователями, которые открыли контент стандартным способом.',
					'chartClass' => self::CLASSES_NAMESPACE . '\SkipsStatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\SkipsStatsTable'
				],
				// The Profits Screen
				'profits' => [
					'title' => '<i class="fa fa-usd"></i> Выгода',
					'description' => 'На странице показана выгода, полученная от замка для вашего веб-сайта.',
					'chartClass' => self::CLASSES_NAMESPACE . '\ProfitsStatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\ProfitsStatsTable'
				],
				// The Bounces Screen
				'bounces' => [
					'title' => '<i class="fa fa-sign-out"></i> Отказы',
					'description' => 'На странице показаны основные недостатки замков, которые приводят к отказам. Наведите указатель мыши на [?] в таблице, чтобы узнать больше о конкретной метрике.',
					'chartClass' => self::CLASSES_NAMESPACE . '\Bounces_StatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\Bounces_StatsTable'
				]
			];

			return $screens;
		}
	}