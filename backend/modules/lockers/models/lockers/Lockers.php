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

	/*public function addLocker($attributes, $type) {
		$this->attributes = $attributes;
		$this->type = $type;
		$this->user_id = Yii::$app->user->identity->id;

		if( $this->save() ) return $this->primaryKey;
		return false;
	}*/
}