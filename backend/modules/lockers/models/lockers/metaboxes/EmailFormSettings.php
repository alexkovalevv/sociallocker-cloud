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

    public function rules()
    {
        return [
            [
                [
                    'form_button_text',
                    'form_after_button_text',
                    'form_type',
                    'custom_fields'
                ],
                'string'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'form_button_text'       => 'Текст кнопки',
            'form_after_button_text' => 'Текст после кнопки',
            'form_type'              => 'Поля формы'
        ];
    }

    public function attributeHints()
    {
        return [
            'form_button_text'       => 'Текст кнопки, которая вызывает действие.',
            'form_after_button_text' => 'Текст, который находится ниже кнопки подписаться, представляет собой гарантию от спама.',
            'form_type'              => 'Выберите поля, которые пользователь должен заполнить, чтобы разблокировать скрытый контент.'
        ];
    }

    /**
     * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
     * @return array
     */
    public function attributeDefaults()
    {
        return [
            'form_button_text'       => 'подпишитесь, чтобы открыть',
            'form_after_button_text' => 'Ваш email адрес на 100% защищен от спама.',
            'form_type'              => 'email-form'
        ];
    }
}


