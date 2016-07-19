<?php
/**
 * Шаблон создания и редактирования замков авторизации.
 */

use yii\bootstrap\ActiveForm;
use backend\modules\lockers\widgets\controls\switcher\SwitchControl;
?>

<!-- Общий шаблон создания замков  -->
<?php include_once(dirname(__FILE__) . '/layouts/_create.php'); ?>
<!-- /Общий шаблон создания замков -->

<div class="signinlocker-create">
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
			<div class="subscribe-options">
				<?=SwitchControl::widget([
					'model' => $model->getModel('subscribe'),
					'attribute' => 'subscribe_to_service',
					'containerOptions' => [
						'class' => 'onp-activate-social-button-switch'
					]
				]); ?>

				<div class="subscribe-available">
					<?=$form->field($model->getModel('subscribe'), 'subscribe_mode')->dropDownList(
						[
							'quick' => 'Одинарная проверка',
							'double_optin' => 'Двойная проверка',
							'quick_double_optin' => 'Ленивая проверка'
						],
						empty($model->getModel('subscribe')->subscribe_mode) ? [
							'options'=>	[
								'quick' => [
									'Selected'=> true
								]
							]
						] : []
					); ?>
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
