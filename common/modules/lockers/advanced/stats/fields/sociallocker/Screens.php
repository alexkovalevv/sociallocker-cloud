<?php
	/**
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats\fields\sociallocker;

	use common\modules\lockers\advanced\stats\interfaces\ScreenInterface;

	class Screens implements ScreenInterface {

		const CLASSES_NAMESPACE = 'common\modules\lockers\advanced\stats\fields\sociallocker';

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
					'chartClass' => self::CLASSES_NAMESPACE . '\DetailedStatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\DetailedStatsTable'
				],
				'skips' => [
					'title' => '<i class="fa fa-tint"></i> Утечки',
					'description' => 'На диаграмме показано, сколько пользователей открыло замок с помощью таймера или кнопки "Закрыть", по сравнению с пользователями, которые открыли контент стандартным способом.',
					'chartClass' => self::CLASSES_NAMESPACE . '\SkipsStatsChart',
					'tableClass' => self::CLASSES_NAMESPACE . '\SkipsStatsTable'
				]
			];

			return $screens;
		}
	}