<?php
/**
 * Шаблон базовых настроек замка. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

use backend\modules\lockers\widgets\controls\switcher\SwitchControl;

/* @var $model common\base\MultiModel */
/* @var string $type */

$fields->model = $model->getModel('basic');

echo $fields->textInput('title');
echo $fields->textInput('header');
echo $fields->editor('message');

$styles = [
	['value' => 'dandyish', 'text' => 'Dandyish'],
	['value' => 'starter', 'text' => 'Starter'],
	['value' => 'flat', 'text' => 'Flat'],
	['value' => 'glass', 'text' => 'Glass'],
	['value' => 'secrets', 'text' => 'Secrets']
];

if( $type === 'signinlocker' ) {
	$styles = [
		['value' => 'great-attractor', 'text' => 'Great attractor'],
	    ['value' => 'friendly-giant', 'text' => 'Friendly giant'],
	    ['value' => 'dark-force', 'text' => 'Dark force']
	];
}

echo $fields->dropdown('default', 'style', $styles);
?>
<div class="row">
	<div class="col-sm-6">
		<?= $fields->radio('overlap', [
			['label' => '<i class="fa fa-lock"></i> Скрыть', 'value' => 'full'],
			['label' => '<i class="fa fa-adjust"></i> Прозрачный слой', 'value' => 'opacity'],
			['label' => '<i class="fa fa-bullseye"></i> Размытый слой', 'value' => 'blurring'],
		]);?>
	</div>
	<div class="col-sm-3" style="padding:5px 0 0;">
		<div class="onp-overlap-position-box" style="display: none;">
			<?= $fields->dropdown('default', 'overlap_position', [
				['value' => 'top', 'text' => 'Сверху'],
				['value' => 'middle', 'text' => 'По середине'],
				['value' => 'scroll', 'text' => 'Прокручивается']
			]);?>
		</div>
	</div>
</div>