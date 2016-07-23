<?php
/**
 * Шаблон создания и редактирования замков авторизации.
 */

use common\helpers\CustomFields;
use yii\bootstrap\ActiveForm;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;
?>

<!-- Общий шаблон создания замков  -->
<?php include_once(dirname(__FILE__) . '/layouts/_create.php'); ?>
<!-- /Общий шаблон создания замков -->

<div class="signinlocker-create">
	<div class="row">
		<?php
		$form = ActiveForm::begin(
			[
				'action' => [$form_action]
				/*'enableClientValidation' => false,
				'enableAjaxValidation' => false*/
			]
		);

		// Настройка полей ActiveForm под требования проекта
		$fields = new CustomFields($form, $model);
		?>

		<div class="col-sm-9">
			<!-- Базовые опции -->
			<div class="basic-options">
				<?php include_once(dirname(__FILE__) . '/metaboxes/_basic-options.php'); ?>
			</div>
			<!-- /Базовые опции -->

			<!-- Первью -->
			<div class="preview-area">
				<?php include_once(dirname(__FILE__) . '/metaboxes/_preview.php'); ?>
			</div>
			<!-- /Первью -->

			<!-- Опции подписки -->
			<?php $fields->model = $model->getModel('subscribe'); ?>
			<div class="subscribe-options">
				<?=$fields->checkbox('subscribe_to_service');?>

				<div class="subscribe-available">
					<?=$fields->dropdown('default', 'subscribe_mode', [
						['value' => 'quick', 'text' => 'Одинарная проверка'],
						['value' => 'double_optin', 'text' => 'Двойная проверка'],
						['value' => 'quick_double_optin', 'text' => 'Ленивая проверка']
					]);?>
				</div>
			</div>
			<!-- /Опции подписки -->

			<!-- Опции социальных кнопок -->
			<div class="social-options">

				<?php include_once(dirname(__FILE__) . '/metaboxes/_signin-social-options.php'); ?>
			</div>
			<!-- /Опции социальных кнопок -->
		</div>


		<div class="col-sm-3">
			<!-- Опции создания/сохранения замков -->
			<div class="right-box">
				<?php include_once(dirname(__FILE__) . '/metaboxes/_save-options.php'); ?>
			</div>
			<!-- /Опции создания/сохранения замков -->
			<!-- Опции видимости -->
			<div class="right-box">
				<?php include_once(dirname(__FILE__) . '/metaboxes/_visability-options.php'); ?>
			</div>
			<!-- /Опции видимости -->
			<!-- Дополнительные опции -->
			<div class="right-box">
				<?php include_once(dirname(__FILE__) . '/metaboxes/_advanced-options.php'); ?>
			</div>
			<!-- /Дополнительные опции -->
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
