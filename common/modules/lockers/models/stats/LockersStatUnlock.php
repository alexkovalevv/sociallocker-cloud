<?php

namespace common\modules\lockers\models\stats;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%lockers_stat_unlock}}".
 *
 * @property integer $id
 * @property integer $locker_id
 * @property string $button_name
 * @property integer $network_user_id
 * @property string $channel
 * @property string $referrer
 * @property string $user_agent
 * @property string $ip
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class LockersStatUnlock extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lockers_stat_unlock}}';
    }

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
				],
				'value' => new Expression('NOW()'),
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locker_id', 'button_name', 'network_user_id', 'user_agent', 'ip'], 'required'],
            [['locker_id', 'network_user_id', 'status'], 'integer'],
            [['channel', 'referrer'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['button_name'], 'string', 'max' => 15],
            [['user_agent'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locker_id' => 'Locker ID',
            'button_name' => 'имя кнопки',
            'network_user_id' => 'id пользователя в социальной сети',
            'channel' => 'какой страницей поделился пользователь или на какой канал подписался',
            'referrer' => 'с какой страницы было открытие замка',
            'user_agent' => 'для ведения статистика по сегментам',
            'ip' => 'Ip',
            'status' => 'если 0 пользователь удалил запись или отписался.',
            'created_at' => 'Created At',
        ];
    }
}
