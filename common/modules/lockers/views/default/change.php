<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\modules\lockers\assets\ItemSelectAsset;

/* @var $this yii\web\View */
/* @var $roles yii\rbac\Role[] */

$this->title = "Создать новый замок";
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Change Loker'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Подключаем js и css файлы
ItemSelectAsset::register( $this );

//$this->registerCssFile('/common/web/css/lockers/page.change-general.css');
//$this->registerJsFile('path/to/myfile');

?>
<div class="locker-change">
	<div class="row">
			<div class="opanda-item">
				<h3 class="opanda-title">Социальный замок</h3>
				<div class="opanda-description">
					Просит пользователей "заплатить лайком" или поделиться, чтобы разблокировать контент. Идеальный способ привлекать социальный трафик.
				</div>
				<div class="opanda-buttons">
					<?=Html::a('Создать замок', Url::toRoute('default/create?type=sociallocker'),[
						'title'=>'Создать социальный замок',
						'class' => 'btn btn-block btn-primary'
					]); ?>
				</div>
			</div>
			<div class="opanda-item">
				<h3 class="opanda-title">Замок авторизации</h3>
				<div class="opanda-description">
					Просит посетителей подписаться на вашу рассылку, чтобы открыть скрытый контент. Идеальный способ набрать подписчиков в ваш список email рассылки, без особых усилий.
				</div>
				<div class="opanda-buttons">
					<?=Html::a('Создать замок', Url::toRoute('default/create?type=signinlocker'),[
						'title'=>'Создать замок авторизации',
						'class' => 'btn btn-block btn-primary'
					]); ?>
				</div>
			</div>
			<div class="opanda-item">
				<h3 class="opanda-title">Email замок</h3>
				<div class="opanda-description">
					Вы можете настроить различные социальные действия, которые необходимо выполнить после авторизации в соц. сети (например, подписаться, поделиться)..
				</div>
				<div class="opanda-buttons">
					<?=Html::a('Создать замок', Url::toRoute('default/create?type=emaillocker'),[
						'title'=>'Создать email замок',
						'class' => 'btn btn-block btn-primary'
					]); ?>
				</div>
			</div>
	</div>
</div>
