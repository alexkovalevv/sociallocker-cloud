<?php

namespace backend\modules\lockers\models\lockers;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "lockers".
 *
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $header
 * @property string $message
 * @property string $options
 * @property string $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Lockers extends ActiveRecord
{
	const STATUS_NOT_ACTIVE = 1;
	const STATUS_ACTIVE = 2;
	const STATUS_DELETED = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lockers}}';
    }

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'header', 'message', 'options'], 'required'],
            [['title', 'header', 'message', 'options'], 'string'],
            ['status', 'integer'],
            ['status', 'default', 'value' => '1'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
	        'title' => 'Название замка',
            'header' => 'Заголовок',
            'message' => 'Описание',
            'type' => 'Тип',
            'status' => 'Статус',
	        'created_at' => 'Создан',
	        'updated_at' => 'Обновлен',
        ];
    }

    public static function getSigninLockerActions($lockerId, $json = false) {

        $locker = self::findOne($lockerId);
        $options = json_decode($locker->options);

        if( empty($options) ) return [];

        $predefined_actions = [
            [
                'facebook' => [
                    'facebook_lead_available' => 'lead',
                    'facebook_subscribe_available' => 'subscribe'
                ],
                'twitter'  => [
                    'twitter_lead_available' => 'lead',
                    'twitter_follow_available' => 'follow',
                    'twitter_teet_available' => 'tweet',
                    'twitter_subscribe_available' => 'subscribe'
                ],
                'google'   => [
                    'google_lead_available' => 'lead',
                    'google_youtube_subscribe_available' => 'youtube-subscribe',
                    'google_subscribe_available' => 'subscribe'
                ],
                'linkedin' => [
                    'linkedin_lead_available' => 'lead',
                    'linkedin_subscribe_available' => 'subscribe'
                ],
                'vk'       => [
                    'vk_lead_available' => 'lead',
                    'vk_subscribe_available' => 'subscribe'
                ],
            ]
        ];

        $actions = [];
        foreach( $predefined_actions as $button_name => $group ) {
            if( isset($options[$button_name . '_available']) && $options[$button_name . '_available'] ) {
                foreach ($group as $key => $action) {
                    if( isset($options[$key]) && $options[$key] ) {
                        $actions[$button_name]['actions'][] = $action;
                    }
                }
            }
        }

        if( $json ) return json_encode($actions);
        return $actions;
    }

	/*public function addLocker($attributes, $type) {
		$this->attributes = $attributes;
		$this->type = $type;
		$this->user_id = Yii::$app->user->identity->id;

		if( $this->save() ) return $this->primaryKey;
		return false;
	}*/
}