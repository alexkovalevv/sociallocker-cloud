<?php
/**
 * Шаблон настроек отображения замка. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use common\modules\lockers\widgets\controls\switcher\SwitchControl;

/* @var $model common\base\MultiModel */
/* @var string $type */


$fields->model = $model->getModel('visability');

echo $fields->checkbox('relock');
echo $fields->checkbox('always');
echo $fields->checkbox('mobile');
