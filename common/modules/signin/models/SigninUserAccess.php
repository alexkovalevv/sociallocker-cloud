<?php

namespace common\modules\signin\models;

use Yii;
use yii\base\InvalidParamException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%signin_user_access}}".
 *
 * @property string $id
 * @property string $handler
 * @property string $data
 * @property integer $created_at
 */
class SigninUserAccess extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at'
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%signin_user_access}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'handler', 'data'], 'required'],
            [['data'], 'string'],
            [['created_at'], 'integer'],
            [['id'], 'string', 'max' => 60],
            [['handler'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'handler' => 'Handler',
            'data' => 'Data',
            'created_at' => 'Created At',
        ];
    }

    public static function getAccessData($id) {

        $model = self::getModel($id);
        if( !empty($model) ) {
            return json_decode($model->data, true);
        }

        return [];
    }

    public static function removeAccessData($id) {
        return self::removeModel($id);
    }

    public static function saveAccessData($id, $handler, array $access_data) {
        $model = new self;
        return $model->setModelAndSave($id, $handler, $access_data);
    }

    public static function getModel($id) {

        $model = self::findOne($id);
        return $model;
    }

    public static function removeModel($id) {

        $model = self::getModel($id);
        return $model->delete();
    }

    public function setModelAndSave($id, $handler, array $access_data) {

        if( empty($id) || empty($handler) || empty($access_data) )
            throw new InvalidParamException('Передан пустой аргумент');

        $this->id = $id;
        $this->handler = $handler;
        $this->data = json_encode($access_data);

        return $this->save(true);
    }
}
