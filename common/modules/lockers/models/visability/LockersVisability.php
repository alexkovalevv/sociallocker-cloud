<?php

namespace common\modules\lockers\models\visability;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%lockers_visability}}".
 *
 * @property integer $id
 * @property integer $locker_id
 * @property integer $site_id
 * @property string $lock_type
 * @property string $when_show
 * @property string $lock_selector
 * @property string $target_selector
 * @property integer $delay
 * @property string $conditions
 * @property integer $created_at
 * @property integer $updated_at
 */
class LockersVisability extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lockers_visability}}';
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
            [['locker_id', 'site_id', 'lock_type', 'when_show', 'lock_selector'], 'required'],
            [['locker_id', 'site_id', 'delay', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at', 'conditions'], 'safe'],
            [['lock_type', 'when_show'], 'string', 'max' => 10],
            [['lock_selector', 'target_selector'], 'string', 'max' => 255],
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
            'site_id' => 'Site ID',
            'lock_type' => 'Тип блокировки \"скрыть сайт полностью\", \"внутри контента\"',
            'when_show' => 'Когда показывать замок',
            'lock_selector' => 'Селектор контейнера в которым должне быть скрыто содержимое',
            'target_selector' => 'Селектор, при нажатии на элемент которому он принадлежит, будет активироваться замок',
            'delay' => 'Время в секундах, через которое замок будет активирован',
            'conditions' => 'Правила видимости замка в JSON',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
