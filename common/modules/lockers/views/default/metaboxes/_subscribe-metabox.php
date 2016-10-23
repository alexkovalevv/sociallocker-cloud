<?php
	/**
	 * Шаблон настроек подписки. Часть шаблона редактирования замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @package signlocker-create, emaillocker-create
	 */
	use common\modules\subscription\common\classes\SubscriptionServices;
	use yii\helpers\Url;

	/* @var $model common\base\MultiModel */
	/* @var string $type */
?>

<?php
	$fields->model = $model->getModel('subscribe');
?>

<?php
	echo $fields->checkbox('subscribe_to_service', [
		'value' => 1,
		'events' => [
			'.subscription-available-hidden'
		]
	]);

	$service_name = Yii::$app->subscription->getCurrentServiceName();
?>

<div class="subscription-available-hidden">
	<?php if( $service_name == 'none' || $service_name == 'database' ): ?>
		<div class="current-service-alert">
			Собранные email адреса будут сохранены в <a href="#" target="_blank">локальную базу данных</a>, так как вы
			не выбрали сервисы email рассылки.
			(<a href="<?= Url::to(['settings/index#tab-subscription']); ?>" target="_blank">изменить</a>).
		</div>
	<?php else: ?>
		<div class="current-service-alert">
			Вы выбрали <?= Yii::$app->subscription->getCurrentServiceTitle(); ?>, как ваш почтовый сервис (<a
				href="<?= Url::to(['settings/index#tab-subscription']); ?>" target="_blank">изменить</a>).
		</div>
		<p>
			<?= $fields->dropdown('default', 'subscribe_list', Url::to('@backendUrl/subscribe/get-lists', true), [
				'ajax' => true,
				'callback' => 'fieldsEditor.load'
			]);
			?>
		</p>
	<?php endif; ?>
	<p><?= $fields->dropdown('default', 'subscribe_mode', Yii::$app->subscription->getCurrentOptinModes()); ?></p>
</div>
