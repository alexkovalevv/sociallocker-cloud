<?php

namespace common\modules\subscription\models;

use Yii;
use yii\base\Model;

class LeadsExport extends Model
{

    public $format;
    public $delimiter;
    public $channels;
    public $email_status;
    public $fields;


    public function rules()
    {
        return [
            [['format', 'delimiter', 'email_status'], 'string'],
            [['channels', 'fields'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'format'       => 'Формат',
            'delimiter'    => 'Разделитель',
            'channels'     => 'Каналы',
            'email_status' => 'Email статус',
            'fields'       => 'Поля для экспорта'
        ];
    }

    public function attributeHints()
    {
        return [
            'format'       => 'В настоящее время доступен только формат CSV.',
            'delimiter'    => 'Выберите разделитель CSV документа.',
            'channels'     => 'Отметьте замки, чтобы экспортировать подписчиков, полученных с помощью этих замков.',
            'email_status' => 'Выберите email статус подписчика для экспорта.',
            'fields'       => ''
        ];
    }

    /**
     * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
     * @return array
     */
    public function attributeDefaults()
    {
        return [
            'format'       => 'csv',
            'delimiter'    => ',',
            'email_status' => 'all',
            'fields'       => ['lead_email', 'lead_name', 'lead_family']
        ];
    }
}