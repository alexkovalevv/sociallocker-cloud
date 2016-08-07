<?php
/**
 * Шаблон базовых настроек замка. Часть шаблона редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 * @package sociallocker-create, signlocker-create, emaillocker-create
 */

/* @var $model common\base\MultiModel */
/* @var string $type */
?>

<?php
$fields->model = $model->getModel('basic');

echo $fields->textInput('title');
echo $fields->textInput('header');
echo $fields->editor('message');
?>

<?php if( $type == 'emaillocker' ): ?>
    <?php $fields->model = $model->getModel('email_form_settings'); ?>

    <?=$fields->textInput('form_button_text');?>

    <?=$fields->textInput('form_after_button_text');?>

<?php endif; ?>

<?php
$fields->model = $model->getModel('basic');

$styles = [
	['value' => 'dandyish', 'text' => 'Dandyish'],
	['value' => 'starter', 'text' => 'Starter'],
	['value' => 'flat', 'text' => 'Flat'],
	['value' => 'glass', 'text' => 'Glass'],
	['value' => 'secrets', 'text' => 'Secrets']
];

if( $type === 'signinlocker' || $type === 'emaillocker' ) {
	$styles = [
		['value' => 'great-attractor', 'text' => 'Great attractor'],
	    ['value' => 'friendly-giant', 'text' => 'Friendly giant'],
	    ['value' => 'dark-force', 'text' => 'Dark force']
	];
}

echo $fields->dropdown('default', 'style', $styles);
?>

<?= $fields->radio( 'overlap', [
    ['label' => '<i class="fa fa-lock"></i> Скрыть', 'value' => 'full'],
    ['label' => '<i class="fa fa-adjust"></i> Прозрачный слой', 'value' => 'opacity'],
    ['label' => '<i class="fa fa-bullseye"></i> Размытый слой', 'value' => 'blurring'],
], [
    'events' => [
        '.overlap-position-box' => [
            'opacity'  => 'show',
            'blurring' => 'show',
            'full'     => 'hide'
        ]
    ]
] );
?>

<div class="overlap-position-box" style="display: none;">
    <?= $fields->dropdown('default', 'overlap_position', [
        ['value' => 'top', 'text' => 'Сверху'],
        ['value' => 'middle', 'text' => 'По середине'],
        ['value' => 'scroll', 'text' => 'Прокручивается']
    ]);?>
</div>
