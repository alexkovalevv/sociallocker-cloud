<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 6:12
 */
use yii\base\Exception;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;
use \yii\helpers\Html;

/**
 * Печатает поле из списка полей по умолчанию
 * @param $form
 * @param $model
 * @param $options
 *
 * @return string
 * @throws Exception
 */
function get_default_control($form, $model, $options) {
	if( !isset($options['type']) || !isset($options['title']) || !isset($options['name']) ) {
		throw new Exception('Не переданы обязательные опции "name, title, type"');
	}

	$default = isset($options['default']) ? $options['default'] : null;
	$hint = isset($options['hint']) ? $options['hint'] : null;

	switch( $options['type'] ) {
		case 'textInput':
			return $form->field( $model, $options['name'] )
				->textInput()->label($options['title'])->hint($hint);
			break;
		case 'textarea':
			return $form->field( $model, $options['name'] )
				->textarea()->label($options['title'])->hint($hint);
			break;
		case 'checkbox':
			return SwitchControl::widget([
				'model' => $model,
				'attribute' => $options['name'],
				'default'   => $default,
				'attributeLabel'  => $options['title'],
				'attributeLabelHint' => $hint,
				'items' => [
					['label' => 'Вкл.', 'value' => 1],
					['label' => 'Выкл.', 'value' => 0]
				]
			]);
		case 'dropdown':
			if( isset($options['items']) || empty($options['items']) ) {
				throw new Exception("Не передана обязательная опция items");
			}

			return $form->field($model, $options['name'])->dropDownList(
				$options['items'],
				empty($model->$options['name'])
					? ['options' =>
						   isset($default)
							   ? [$default => ['Selected'=> true]]
							   : []
				]
					: []
			)->hint($hint);
			break;
	}
}