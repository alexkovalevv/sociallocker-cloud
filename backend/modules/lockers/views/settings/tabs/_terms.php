<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.07.2016
 * Time: 3:31
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

//---------------------------------------
/**  Условия использования и политика  */
//---------------------------------------

$terms = SwitchControl::widget([
	'model' => $model->getModel('terms'),
	'attribute' => 'terms_enabled',
	'default'   => false,
	'items' => [
		['label' => 'Вкл.', 'value' => 1],
		['label' => 'Выкл.', 'value' => 0]
	]
]);

$terms .= $form->field($model->getModel('terms'), 'terms_of_use_text')->widget(
	\yii\imperavi\Widget::className(),
	[
		'plugins' => ['fullscreen', 'fontcolor', 'video'],
		'htmlOptions' => empty($model->getModel('terms')->terms_of_use_text) ? [
			'value' => ''
		] : [],
		'options' => [
			'minHeight' => 150,
			'maxHeight' => 150,
			'buttonSource' => true,
			'convertDivs' => false,
			'removeEmptyTags' => false,
			'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
		]
	]
);

$terms .= $form->field($model->getModel('terms'), 'privacy_policy_text')->widget(
	\yii\imperavi\Widget::className(),
	[
		'plugins' => ['fullscreen', 'fontcolor', 'video'],
		'htmlOptions' => empty($model->getModel('terms')->privacy_policy_text) ? [
			'value' => ''
		] : [],
		'options' => [
			'minHeight' => 150,
			'maxHeight' => 150,
			'buttonSource' => true,
			'convertDivs' => false,
			'removeEmptyTags' => false,
			'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
		]
	]
);

return $terms;