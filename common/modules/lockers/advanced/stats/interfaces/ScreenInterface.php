<?php
	/**
	 * Интерфейс для экранов статистики
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats\interfaces;

	interface ScreenInterface {

		public static function getScreen($screens_name);

		public static function getScreens();
	}