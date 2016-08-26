<?php
/**
 * Шаблон настройки статистики замков. Часть шаблона общих настроек замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package setting
 */

use common\modules\lockers\widgets\controls\switcher\SwitchControl;

/* @var $model common\base\MultiModel */

$fields->model = $model->getModel('stat');

$stat = $fields->checkbox('google_analytics');
$stat .= $fields->checkbox('tracking');

return $stat;
