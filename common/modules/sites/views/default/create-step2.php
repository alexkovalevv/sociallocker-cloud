<?php

	use common\helpers\CustomFields;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
	use yii\widgets\Pjax;

	/* @var $this yii\web\View */
	/* @var $model common\modules\sites\models\Sites */

	$this->title = 'Подключение сайта Шаг. 2';
	$this->params['breadcrumbs'][] = ['label' => 'Мои сайты', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;

	$js = '<script>!function(a,b,c){b[c]={client_id:' . $model->user_id . ',site_id: ' . $model->id . '};var d=a.getElementsByTagName("script")[0],e=a.createElement("script"),f=function(){d.parentNode.insertBefore(e,d)};e.type="text/javascript",e.async=!1,e.src="//cdn.sociallocker.ru/service/loader.js","[object Opera]"==b.opera?a.addEventListener("DOMContentLoaded",f,!1):f()}(document,window,"_onpwgt");</script>';
	//$js_output = htmlentities($js);
?>
<div class="sites-create-step2">
	<p>Скопируйте и вставьте код для отслеживания перед тегом &lt;/head&gt;</p>
	<?php echo Html::textarea('client_inject_code', $js, ['rows' => 8, 'cols' => 70]) ?>
	<p>Когда вы подключите код, нажмите кнопку ниже, чтобы мы проверли правильность подключения:</p>

	<?= Html::a("Подтвердить", [
		'default/site-verify',
		'site_id' => $model->id
	], ['class' => 'btn btn-lg btn-primary']) ?>
</div>



