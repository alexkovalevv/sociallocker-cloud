<?php

	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model common\modules\sites\models\Sites */

	$this->title = 'Устаровка кода на сайт';
	$this->params['breadcrumbs'][] = ['label' => 'Мои сайты', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;

	$js = '<script>!function(a,b,c){b[c]={site_id: ' . $model->id . '};var d=a.getElementsByTagName("script")[0],e=a.createElement("script"),f=function(){d.parentNode.insertBefore(e,d)};e.type="text/javascript",e.async=!1,e.src="//cdn.sociallocker.ru/service/loader.js","[object Opera]"==b.opera?a.addEventListener("DOMContentLoaded",f,!1):f()}(document,window,"_onpwgt");</script>';
?>

<div class="sites-get-code">
	<p>Скопируйте и вставьте код для отслеживания перед тегом &lt;/head&gt;</p>
	<?php echo Html::textarea('client_inject_code', $js, ['rows' => 8, 'cols' => 70]) ?>
</div>



