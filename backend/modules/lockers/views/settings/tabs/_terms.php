<?php
/**
 * Шаблон политики и условий использования плагина. Часть шаблона общих настроек замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package setting
 */

/* @var $model common\base\MultiModel */

$fields->model = $model->getModel('terms');

$terms = $fields->checkbox('terms_enabled');

$terms .= $fields->editor('terms_of_use_text');

$terms .= $fields->editor('privacy_policy_text');

return $terms;