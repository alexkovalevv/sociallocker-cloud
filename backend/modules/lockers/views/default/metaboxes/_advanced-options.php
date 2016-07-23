<?php
/**
 * Шаблон дополнительных настроек замка. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

/* @var $model common\base\MultiModel */
/* @var string $type */

$fields->model = $model->getModel('social');

if( $type == 'sociallocker' ) {
	echo $fields->checkbox('counters');
}

$fields->model = $model->getModel('advanced');

echo $fields->checkbox('close');

echo $fields->textInput('timer');

echo $fields->checkbox('highlight');

