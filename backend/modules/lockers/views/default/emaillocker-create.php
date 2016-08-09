<?php
/**
 * Шаблон создания и редактирования email замков.
 */

use common\helpers\CustomFields;
use yii\bootstrap\ActiveForm;
use common\modules\subscription\classes\SubscriptionServices;
use yii\helpers\Url;
?>

<!-- Общий шаблон создания замков  -->
<?php include_once(dirname(__FILE__) . '/layouts/_create.php'); ?>
<!-- /Общий шаблон создания замков -->

<div class="signinlocker-create">
	<div class="row">
		<?php
		$form = ActiveForm::begin(
			[
				'enableClientValidation' => false,
				'enableAjaxValidation' => false
			]
		);

		// Настройка полей ActiveForm под требования проекта
		$fields = new CustomFields($form, $model);
		?>

		<div class="col-sm-9">

			<!-- Базовые опции -->
			<div class="basic-options">
				<?php include_once( dirname( __FILE__ ) . '/metaboxes/_basic-metabox.php' ); ?>
			</div>
			<!-- /Базовые опции -->

			<!-- Первью -->
			<div class="preview-area">
				<?php include_once( dirname( __FILE__ ) . '/metaboxes/_preview-metabox.php' ); ?>
			</div>
			<!-- /Первью -->

			<!-- Опции подписки -->
            <div class="subscription-options">
                <?php include_once( dirname( __FILE__ ) . '/metaboxes/_subscribe-metabox.php' ); ?>
            </div>
			<!-- /Опции подписки -->

            <!-- Настройки email формы -->
            <div class="email-form-settings">
                <?php include_once( dirname( __FILE__ ) . '/metaboxes/_email-form-settings.php' ); ?>
            </div>
            <!-- /Настройки email формы -->

		</div>


		<div class="col-sm-3">

			<!-- Опции создания/сохранения замков -->
			<div class="right-box">
				<?php include_once( dirname( __FILE__ ) . '/metaboxes/_save-locker-metabox.php' ); ?>
			</div>
			<!-- /Опции создания/сохранения замков -->

			<!-- Опции видимости -->
			<div class="right-box">
				<?php include_once( dirname( __FILE__ ) . '/metaboxes/_visability-metabox.php' ); ?>
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
