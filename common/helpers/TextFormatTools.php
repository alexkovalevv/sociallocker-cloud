<?php
	/**
	 * Инструменты для форматирования текста
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\helpers;

	class TextFormatTools {

		public static function normilizeValues($values = [])
		{
			if( empty($values) ) {
				return $values;
			}
			if( !is_array($values) ) {
				$values = [$values];
			}

			foreach($values as $index => $value) {

				$values[$index] = is_array($value)
					? self::normilizeValues($value)
					: self::normilizeValue($value);
			}

			return $values;
		}

		public static function normilizeValue($value = null)
		{
			if( 'false' === $value ) {
				$value = false;
			} elseif( 'true' === $value ) {
				$value = true;
			} elseif( 'null' === $value ) {
				$value = null;
			} else if( is_numeric($value) && gettype($value) === 'string' ) {
				$value = intval($value);
			}

			return $value;
		}

		public static function normalizeRequestParam($value)
		{
			return self::normilizeValue(trim(rtrim(urldecode($value))));
		}
	}