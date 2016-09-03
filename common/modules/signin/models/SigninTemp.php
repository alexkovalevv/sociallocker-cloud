<?php

namespace common\modules\signin\models;

use Yii;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%signin_log}}".
 *
 * @property integer $id
 * @property string $s_token
 * @property string $handler
 * @property string $user_data
 */
class SigninTemp extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%signin_temp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_token', 'handler', 'user_data'], 'required'],
            [['user_data'], 'string'],
            [['s_token'], 'string', 'max' => 32],
            [['handler'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            's_token' => 'S Token',
            'handler' => 'Handler',
            'user_data' => 'User Data'
        ];
    }

    public static function getTempData($s_token) {

        $model = self::getModel($s_token);
        if( !empty($model) ) {
            $data = json_decode( $model->user_data, true );
            return $data;
        }
        return null;
    }

    public static function removeTempData($s_token) {
        return self::removeModel($s_token);
    }

    public static function saveTempData($s_token, $handler, array $user_data) {
        $model = new self;
        return $model->setModelAndSave($s_token, $handler, $user_data);
    }

    public static function removeModel($s_token) {

        $model = self::getModel($s_token);
        if( !empty($model) ) {
           return $model->delete();
        }
        return false;
    }

    public static function getModel($s_token) {
        $model = self::findOne($s_token);
        return $model;
    }

    public function setModelAndSave($s_token, $handler, array $user_data) {

        if( empty($s_token) || empty($handler) || empty($user_data) )
            throw new InvalidParamException('Передан пустой аргумент, проверьте переданные данные в следующих аргументах s_token, handler, user_data');

        if( !in_array($handler, ['facebook', 'linkedin', 'vk', 'twitter', 'google']) )
            throw new InvalidParamException('Переданный аргумент handler не содержится в списке разрешенных');

        $this->s_token = $s_token;
        $this->handler = $handler;
        $this->user_data = json_encode($user_data);

        return $this->save(true);
    }

}
