<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use backend\modules\lockers\assets\SettingsAsset;
use common\helpers\CustomFields;

/* @var $this yii\web\View */
/* @var $model \common\base\MultiModel */

$this->title = "Общие настройки";
$this->params['breadcrumbs'][] = ['label' => 'Замки', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

// Скрипты и стили страницы настроек
SettingsAsset::register($this);

$form = ActiveForm::begin(
	[
		/*'enableClientValidation' => false,
		'enableAjaxValidation' => false*/
	]
);

// Настройка полей ActiveForm под требования проекта
$fields = new CustomFields($form, $model);
?>
	<div class="row">
	<div class="col-sm-9">

		<div style="margin-bottom:30px">
			<?=Html::submitButton( 'Сохранить настройки', ['class' => 'btn btn-success'] ) . " "; ?>
			<?=Html::a( 'Восстановить настройки', ['#'], ['class' => 'btn btn-warning'] ); ?>
		</div>

		<?=	Tabs::widget([
			'items' => [
				[
					'label'  => 'Настройки кнопок',
					'encode' => false,
					'content' => require(__DIR__ . '/tabs/_social.php'),
					'active' => true,
					'options' => [
						'id'    => 'tab-social-button'
					]
				],
				[
					'label'  => 'Подписка',
					'encode' => false,
					'content' => require(Yii::getAlias('@subscription/views/setting.php')),
					'options' => [
						'id'    => 'tab-subscription'
					]
				],
				[
					'label'  => 'Блокировка',
					'encode' => false,
					'content' => require(__DIR__ . '/tabs/_lock.php'),
					'options' => [
						'id'    => 'tab-lock'
					]
				],
				[
					'label'  => 'Статистика',
					'encode' => false,
					'content' => require(__DIR__ . '/tabs/_stat.php'),
					'options' => [
						'id'    => 'tab-statistic'
					]
				],
				[
					'label'  => 'Локализация',
					'encode' => false,
					'content' => require(__DIR__ . '/tabs/_localization.php'),
					'options' => [
						'id'    => 'tab-localization'
					]
				],
				[
					'label'  => 'Условия и Политика',
					'encode' => false,
					'content' => require(__DIR__ . '/tabs/_terms.php'),
					'options' => [
						'id'    => 'tab-terms'
					]
				]
			]
		]);
		?>

		<div style="margin-top:30px">
			<?=Html::submitButton( 'Сохранить настройки', ['class' => 'btn btn-success'] ) . " "; ?>
			<?=Html::a( 'Восстановить настройки', ['#'], ['class' => 'btn btn-warning'] ); ?>
		</div>

	</div>
</div>
<?php ActiveForm::end(); ?>