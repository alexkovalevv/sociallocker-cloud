<?php
	/**
	 * Шаблон настройки блокировки. Часть шаблона общих настроек замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @package setting
	 */

	/* @var $models common\base\MultiModel */

	$fields->model = $models->getModel('lock');

	$lock = $fields->checkbox('debug');

	$lock .= $fields->checkbox('permanent_passcode');

	$lock .= $fields->textInput('passcode');

	$lock .= $fields->checkbox('dynamic_theme');

	$lock .= $fields->dropdown('default', 'alt_overlap_mode', [
		['value' => 'full', 'text' => 'Скрыть полностью'],
		['value' => 'transparence', 'text' => 'Прозрачность'],
	]);

	$lock .= $fields->checkbox('tumbler');

	$lock .= $fields->textInput('timeout');

	return $lock;
