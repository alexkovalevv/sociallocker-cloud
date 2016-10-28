<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Tabs;
	use backend\assets\SettingsAsset;
	use common\helpers\CustomFields;

	/* @var $this yii\web\View */
	/* @var $models \common\base\MultiModel */
	/* @var string $view_path */

	$this->title = $this->context->title;
	$this->params['breadcrumbs'][] = $this->title;

	// Скрипты и стили страницы настроек
	SettingsAsset::register($this);

	$form = ActiveForm::begin([
		/*'enableClientValidation' => true,*/
		/*'enableAjaxValidation' => true*/
	]);

	// Настройка полей ActiveForm под требования проекта
	$fields = new CustomFields($form, $models);

	$tabs = [];

	if( empty($active_tab) ) {
		throw new \yii\base\InvalidConfigException('Не передан обязательный параметр active_tab');
	}

	foreach($models->getModels() as $model_name => $model) {

		if( is_array($view_path) && isset($view_path[$model_name]) ) {
			$get_view_path = $view_path[$model_name];
		} else if( !empty($view_path) && is_string($view_path) ) {
			$get_view_path = $view_path;
		}

		$get_view_path = Yii::getAlias($get_view_path) . '/_' . $model_name . '.php';

		if( !file_exists($get_view_path) ) {
			throw new \yii\base\InvalidConfigException('Укан некорректный путь к представлению {' . $get_view_path . '}');
		}

		$tabs['items'][] = [
			'label' => $model->title,
			'encode' => false,
			'content' => require($get_view_path),
			'active' => ($active_tab === $model_name),
			'options' => [
				'id' => 'tab-' . $model_name
			]
		
		];
	}
?>
	<div class="row">
		<div class="col-sm-9">
			<?= Tabs::widget($tabs);
			?>

			<div style="margin-top:30px">
				<?= Html::submitButton('Сохранить настройки', ['class' => 'btn btn-success']) . " "; ?>
				<?= Html::a('Восстановить настройки', ['#'], ['class' => 'btn btn-warning']); ?>
			</div>
		</div>
	</div>
<?php ActiveForm::end(); ?>