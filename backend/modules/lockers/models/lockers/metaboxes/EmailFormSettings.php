<?php
/**
 * Модель настройки подписки. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com>
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class EmailFormSettings extends Model
{

    public $form_button_text;
    public $form_after_button_text;
    public $form_type;
    public $custom_fields;
    public $subscribe_allow_social;
    public $subscribe_social_text;
    public $subscribe_social_buttons;

    public function rules()
    {
        return [
            [
                [
                    'form_button_text',
                    'form_after_button_text',
                    'form_type',
                    'custom_fields',
                    'subscribe_social_text'
                ],
                'string'
            ],
            [[
                 'subscribe_social_buttons'
             ], 'safe'],
            [
                [
                    'subscribe_allow_social'
                ],
                'integer'
            ],
            [
                [
                    'subscribe_allow_social'
                ],
                'filter',
                'filter' => function ( $value ) {
                    return empty( $value ) ? false : true;
                }
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'form_button_text'         => 'Текст кнопки',
            'form_after_button_text'   => 'Текст после кнопки',
            'form_type'                => 'Поля формы',
            'subscribe_allow_social'   => 'Подписка через социальные сети',
            'subscribe_social_text'    => 'Над текстом',
            'subscribe_social_buttons' => 'Социальные сети'
        ];
    }

    public function attributeHints()
    {
        return [
            'form_button_text'         => 'Текст кнопки, которая вызывает действие.',
            'form_after_button_text'   => 'Текст, который находится ниже кнопки подписаться, представляет собой гарантию от спама.',
            'form_type'                => 'Выберите поля, которые пользователь должен заполнить, чтобы разблокировать скрытый контент.',
            'subscribe_allow_social'   => 'Включите, чтобы разрешить подписку через социальные сети.',
            'subscribe_social_text'    => 'Текст над кнопками.',
            'subscribe_social_buttons' => 'Выберите доступные социальные сети.'
        ];
    }

    /**
     * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
     * @return array
     */
    public function attributeDefaults()
    {
        return [
            'form_button_text'         => 'подпишитесь, чтобы открыть',
            'form_after_button_text'   => 'Ваш email адрес на 100% защищен от спама.',
            'form_type'                => 'email-form',
            'subscribe_social_text'    => 'подписаться через ваш социальный профиль одним нажатием',
            'subscribe_social_buttons' => ['facebook', 'vk', 'twitter']
        ];
    }
}


