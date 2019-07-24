<?php
	use common\modules\lockers\assets\VisabilityEditAsset;
	use backend\widgets\conditionEditor\ConditionEditor;
	use common\helpers\CustomFields;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;

	/* @var $filters backend\controllers\WidgetsVisabilityController.php */
	/* @var $templates backend\controllers\WidgetsVisabilityController.php */
	/* @var $lockers backend\controllers\WidgetsVisabilityController.php */

	$this->title = "Шаг #2. Настройки видимости виджета";

	/*$this->params['breadcrumbs'][] = [
		'label' => 'Шаг #1. Редактирование замка',
		'url' => ['default/edit?id=' . Yii::$app->request->get('locker_id')]
	];
	$this->params['breadcrumbs'][] = $this->title;*/

	// Подключение js и css файлов
	//VisabilityEditAsset::register($this);

	$form = ActiveForm::begin([
		'enableClientValidation' => false,
		'enableAjaxValidation' => false
	]);

	$custom_fields = new CustomFields($form, $model);
?>
	<div class="row">
		<div class="col-md-8">
			<div class="visability-basic-options" style="margin:20px 0; overflow:hidden">
				<?= $custom_fields->radio('way', [
					['label' => 'Все страницы', 'value' => 'all'],
					['label' => 'На страницах', 'value' => 'selected'],
					['label' => 'Кроме страниц', 'value' => 'excluded']
				], [
					'events' => [
						'.selected-control' => [
							'all' => 'hide',
							'selected' => 'show',
							'excluded' => 'hide'
						],
						'.excluded-control' => [
							'all' => 'hide',
							'selected' => 'hide',
							'excluded' => 'show'
						]
					]
				]); ?>

				<div class="selected-control">
					<?= $custom_fields->multipleInput('select_pages', [
						'columns' => [
							[
								'name' => 'pages',
								'options' => [
									'placeholder' => 'Введите url страницы, на которой нужно показать виджет.'
								],
								'enableError' => true
							]
						]
					]); ?>
				</div>
				<div class="excluded-control">
					<?= $custom_fields->multipleInput('exclude_pages', [
						'columns' => [
							[
								'name' => 'pages',
								'options' => [
									'placeholder' => 'Введите url страницы, которую нужно исключить.'
								],
								'enableError' => true
							]
						]
					]); ?>
				</div>
			</div>
			<?= ConditionEditor::widget([
				'form' => $form,
				'model' => $model,
				'attribute' => 'conditions',
				'filters' => $filters,
				'templates' => $templates,
				'save_button_id' => 'visability-save-button'
			]); ?>
		</div>
		<div class="col-md-4">
			<ul style="list-style: none">
				<li style="margin-top:20px;">
					<span style="display: inline-block;padding: 15px;font-size: 16px;font-weight: bold;background: #f1f1f1;;"
						>Шаг #1.
					</span>
					<a href="#">Настройка видежта</a>
				</li>
				<li style="margin-top:20px;"><span style="display: inline-block;padding: 15px;font-size: 16px;font-weight: bold;background: #d0cfcf;">
						Шаг #2.
					</span>
					<a href="#">Настройка видимости виджета</a>
				</li>
				<li style="margin-top:20px;"><span style="display: inline-block;padding: 15px;font-size: 16px;font-weight: bold;background: #f1f1f1;">
						Шаг #3.
					</span>
					Размещение виджета на странице
				</li>
			</ul>
		</div>
	</div>


	<div style="margin-top:20px;">
		<?php echo Html::submitButton('Сохранить', ['id' => 'visability-save-button', 'class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>