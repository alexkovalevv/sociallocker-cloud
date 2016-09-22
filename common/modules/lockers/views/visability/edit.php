<?php
	use common\modules\lockers\assets\VisabilityEditAsset;
	use common\modules\lockers\widgets\conditionEditor\ConditionEditor;
	use common\helpers\CustomFields;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;

	/* @var $filters common\modules\lockers\controllers\VisabilityController.php */
	/* @var $templates common\modules\lockers\controllers\VisabilityController.php */
	/* @var $lockers common\modules\lockers\controllers\VisabilityController.php */

	$this->title = "Шаг #2. Условия отображения замка";
	$this->params['breadcrumbs'][] = [
		'label' => 'Шаг #1. Редактирование замка',
		'url' => ['default/edit?id=' . Yii::$app->request->get('locker_id')]
	];
	$this->params['breadcrumbs'][] = $this->title;

	// Подключение js и css файлов
	//VisabilityEditAsset::register($this);

	$form = ActiveForm::begin([
		'enableClientValidation' => false,
		'enableAjaxValidation' => false
	]);

	$custom_fields = new CustomFields($form, $model);
?>

	<div class="visability-basic-options" style="margin:20px 0; overflow:hidden">
		<?= $custom_fields->multipleInput('pages', [
			'columns' => [
				[
					'name' => 'pages',
					'options' => [
						'placeholder' => 'Введите url страницы'
					],
					'enableError' => true
				]
			]
		]); ?>

		<?= $custom_fields->radio('lock_type', [
			['label' => 'Скрыть всю страницу', 'value' => 'absolute'],
			['label' => 'Внутри страницы', 'value' => 'inline']
		], [
			'events' => [
				'.control-way-lock' => [
					'inline' => 'show',
					'absolute' => 'hide'
				]
			]
		]); ?>

		<div class="control-way-lock">
			<?= $custom_fields->radio('way_lock', [
				['label' => 'Через css селектор', 'value' => 'css'],
				['label' => 'Вставка кода', 'value' => 'html']
			], [
				'events' => [
					'.control-lock-selector' => [
						'css' => 'show',
						'html' => 'hide'
					],
					'.control-group-inject-html' => [
						'css' => 'hide',
						'html' => 'show'
					]
				]
			]); ?>

			<div class="control-lock-selector">
				<?= $custom_fields->textInput('lock_selector'); ?>
			</div>
			<div class="control-group-inject-html">
				<?= $custom_fields->textarea('inject_html', ['readonly' => true]); ?>
				<?= $custom_fields->editor('hidden_content'); ?>
			</div>
		</div>


		<?= $custom_fields->radio('when_show', [
			['label' => 'При просмотре', 'value' => 'page_view'],
			['label' => 'При нажатии', 'value' => 'click_element'],
			['label' => 'При наведении', 'value' => 'hover_element'],
		], [
			'events' => [
				'.control-target-selector' => [
					'click_element' => 'show',
					'hover_element' => 'show',
					'page_view' => 'hide'
				]
			]
		]);
		?>

		<div class="control-target-selector">
			<?= $custom_fields->textInput('target_selector'); ?>
		</div>

		<?= $custom_fields->textInput('delay'); ?>
	</div>

<?= ConditionEditor::widget([
	'form' => $form,
	'model' => $model,
	'attribute' => 'conditions',
	'filters' => $filters,
	'templates' => $templates,
	'save_button_id' => 'visability-save-button'
]); ?>
	<div style="margin - top:20px;">
		<?php echo Html::submitButton('Сохранить', ['id' => 'visability-save-button', 'class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>