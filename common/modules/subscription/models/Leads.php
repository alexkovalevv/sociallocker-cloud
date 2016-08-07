<?php

namespace common\modules\subscription\models;

use Yii;

/**
 * This is the model class for table "leads".
 *
 * @property string $id
 * @property string $lead_display_name
 * @property string $lead_name
 * @property string $lead_family
 * @property string $lead_email
 * @property string $lead_date
 * @property integer $lead_email_confirmed
 * @property integer $lead_subscription_confirmed
 * @property integer $lead_item_id
 * @property string $lead_item_title
 * @property string $lead_referer
 * @property string $lead_confirmation_code
 * @property string $lead_temp
 */
class Leads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leads}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lead_email', 'lead_date'], 'required'],
            [['lead_date'], 'safe'],
            [['lead_email_confirmed', 'lead_subscription_confirmed', 'lead_item_id'], 'integer'],
            [['lead_referer', 'lead_temp'], 'string'],
            [['lead_display_name', 'lead_item_title'], 'string', 'max' => 255],
            [['lead_name', 'lead_family'], 'string', 'max' => 100],
            [['lead_email'], 'string', 'max' => 50],
            [['lead_confirmation_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lead_display_name' => 'Lead Display Name',
            'lead_name' => 'Lead Name',
            'lead_family' => 'Lead Family',
            'lead_email' => 'Lead Email',
            'lead_date' => 'Lead Date',
            'lead_email_confirmed' => 'Lead Email Confirmed',
            'lead_subscription_confirmed' => 'Lead Subscription Confirmed',
            'lead_item_id' => 'Lead Item ID',
            'lead_item_title' => 'Lead Item Title',
            'lead_referer' => 'Lead Referer',
            'lead_confirmation_code' => 'Lead Confirmation Code',
            'lead_temp' => 'Lead Temp',
        ];
    }
}
