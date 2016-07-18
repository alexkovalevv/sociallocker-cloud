<?php
/**
 * Шаблон базовых настроек замка. Часть шаблона редактирования замков.
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;
?>
<?= $form->field($model, 'title'); ?>

<?= $form->field($model, 'header')->textInput(
	empty($model->header) ?
		['value' => 'Этот контент заблокирован!']
		: []
);?>

<?= $form->field($model, 'message')->widget(
	\yii\imperavi\Widget::className(),
	[
		'plugins' => ['fullscreen', 'fontcolor', 'video'],
		'htmlOptions' => empty($model->message) ? [
			'value' => 'Пожалуйста, поддержите нас, нажмите на одну из социальных кнопок ниже, чтобы получить доступ к заблокированному контенту.'
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
) ?>

<?php
$styles = [
	'dandyish' => 'Dandyish',
	'starter' =>'Starter',
	'flat' => 'Flat',
	'glass' => 'Glass',
	'secrets' => 'Secrets'
];

$styles_default = 'secrets';

if( $type === 'signinlocker' ) {
	$styles = [
		'great-attractor' => 'Great attractor',
	    'friendly-giant'  => 'Friendly giant',
	    'dark-force'      => 'Dark force'
	];
	$styles_default = 'great-attractor';
}

echo $form->field($model, 'style')->dropDownList(
	$styles,
	empty($model->style) ? [
		'options'=>	[
			$styles_default => [
				'Selected'=> true
			]
		]
	] : []
);
?>
<div class="row">
	<div class="col-sm-6">
		<?= SwitchControl::widget([
			'model' => $model,
			'attribute' => 'overlap',
			'default'   => 'full',
			'items' => [
				['label' => '<i class="fa fa-lock"></i> Скрыть', 'value' => 'full'],
				['label' => '<i class="fa fa-adjust"></i> Прозрачный слой', 'value' => 'opacity'],
				['label' => '<i class="fa fa-bullseye"></i> Размытый слой', 'value' => 'blurring'],
			]
		]);
		?>
	</div>
	<div class="col-sm-3" style="padding:5px 0 0;">
		<div class="onp-overlap-position-box" style="display: none;">
			<?= $form->field($model, 'overlap_position')->dropDownList(
				[
					'top' => 'Сверху',
					'middle' =>'По середине',
					'scroll' => 'Прокручивается',
				],
				empty($model->style) ? [
					'options'=>	[
						'middle'=> [
							'Selected'=> true
						]
					]
				] : []
			); ?>
		</div>
	</div>
</div>