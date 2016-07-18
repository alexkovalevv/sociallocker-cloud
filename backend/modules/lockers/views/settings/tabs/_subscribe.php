<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 3:31
 */
use yii\base\Exception;
use \yii\helpers\Html;

$services = require(Yii::getAlias('@lockers/subscribe/services.php'));

if( empty($services) ) {
	throw new Exception('Не установлены сервисы подписки.');
}

$services_list = [];
foreach( $services as $name => $service ) {
	$services_list[$name] = $service['title'];
}

$subscribe = $form->field($model->getModel('subscribe'), 'subscription_to_service')->dropDownList(
	$services_list,
	empty($model->getModel('subscribe')->subscription_to_service) ? [
		'options'=>	[
			'database' => [
				'Selected'=> true
			]
		]
	] : []
);

$services_options = require(Yii::getAlias('@lockers/subscribe/services-options.php'));

if( empty($services_options) ) {
	throw new Exception('Не установлены опции сервисов.');
}

foreach( $services_options as $group_name => $group ) {
	$group_content = '';
	foreach( $group as $options ) {
		$group_content .= get_default_control($form, $model->getModel('subscribe'), $options);
	}

	$subscribe .= Html::tag('div', $group_content, [
		'id' => $group_name . '-options',
	    //'class'=>'hidden'
	]);
}
return $subscribe;