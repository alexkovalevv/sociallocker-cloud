<?php
	/**
	 * Создание и редактирование аватаров
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	use common\helpers\Avatars;
	use common\modules\signin\models\SigninOauthClients;
	use yii\helpers\ArrayHelper;

?>
<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
	    <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

	<?php
		$allow_services = Yii::$app->getModule('signin')->params['services'];

		$phrase = 'Подписался на лист рассылки "Яблочные пироги"';
		$display_name = 'Неизвестный';
		$profile_url = $display_name;
		$image_source = '';
		$segment_icon_class = ' icon-subscribe';

		if( $model->oauth_client_id && in_array($model->service, $allow_services) ) {
			$client_info = SigninOauthClients::getClientInfo([
				'oauth_client_id' => $model->oauth_client_id
			], $model->service);

			if( !empty($client_info) && isset($client_info['current_conntection']) ) {
				$share_buttons = Yii::$app->getModule('signin')->params['share_buttons'];
				$subscribe_buttons = Yii::$app->getModule('signin')->params['subscribe_buttons'];
				$like_buttons = Yii::$app->getModule('signin')->params['like_buttons'];

				/*if( in_array($model->channel_name, $share_buttons) ) {
					$phrase = 'Рассказал друзьям о странице ' . $model->channel_value;
					$segment_icon_class = ' icon-share';
				} else if( in_array($model->channel_name, $subscribe_buttons) ) {
					$phrase = 'Подписался на группу (канал, публичную страницу) #' . $model->channel_value;
					$segment_icon_class = ' icon-subscribe';
				} else if( in_array($model->channel_name, $like_buttons) ) {
					$phrase = 'Сказал мне нравится страница ' . $model->channel_value;
					$segment_icon_class = ' icon-like';
				}*/

				$display_name = ArrayHelper::getValue($client_info['current_conntection'], 'display_name');
				$image_source = ArrayHelper::getValue($client_info['current_conntection'], 'avatar_url');
				$profile_url = ArrayHelper::getValue($client_info['current_conntection'], 'profile_url');
				$profile_url = '<a href="' . $profile_url . '" target="_blank">' . $display_name . '</a>';
			}
		}

		$avatar_url = Avatars::get(md5($image_source), $image_source);
	?>

	<h3 class="timeline-header">
		<figure class="timeline-avatar<?= $segment_icon_class; ?>">
			<img src="<?= $avatar_url; ?>" width="40" height="40" alt="">
		</figure>
		<?php echo $profile_url; ?> в <b><?= ucfirst($model->service); ?></b>
	</h3>
	<div class="timeline-body">
		<?= $phrase; ?>
	</div>
</div>