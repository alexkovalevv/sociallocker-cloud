<?php
/**
 * Шаблон создания и редактирования социальных замков.
 */

use yii\bootstrap\ActiveForm;
?>

<!-- Общий шаблон создания замков  -->
<?php include_once(dirname(__FILE__) . '/layouts/_create.php'); ?>
<!-- /Общий шаблон создания замков -->

<div class="sociallocker-create">
	<div class="row">

		<?php $form = ActiveForm::begin(
			[
				'action' => [$form_action]
				/*'enableClientValidation' => false,
		        'enableAjaxValidation' => false*/
			]
		); ?>

		<div class="col-sm-9">
			<!-- Базовые опции -->
			<?php include_once(dirname(__FILE__) . '/metaboxes/_basic-options.php'); ?>
			<!-- /Базовые опции -->

			<!-- Первью -->
			<?php include_once(dirname(__FILE__) . '/metaboxes/_preview.php'); ?>
			<!-- /Первью -->

			<!-- Опции социальных кнопок -->
			<?php include_once(dirname(__FILE__) . '/metaboxes/_social-options.php'); ?>
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
