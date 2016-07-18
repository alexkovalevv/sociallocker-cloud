<?php

namespace backend\modules\lockers\models\settings;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\base\Exception;
use yii\helpers\Json;
use yii\db\Expression;
use yii\base\InvalidValueException;


/**
 * This is the model class for table "lockers".
 *
 * @property string $id
 * @property string $user_id
 * @property string $value
 * @property integer $created_at
 * @property integer $updated_at
 */
class Settings extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lockers_settings}}';
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
	        [['user_id'], 'integer'],
            [['value'], 'string'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

	/**
	 * @inheritdoc
	 */
	public function getModel() {
		$model = $this->findOne(
			['user_id' => Yii::$app->user->identity->id]
		);
		return $model;
	}

	public function getModelValue() {
		if( !isset($this->getModel()->value) || empty($this->getModel()->value) )
			return null;
		return Json::htmlEncode($this->getModel()->value);
	}

	/**
	 * @inheritdoc
	 */
	public function setModel($data) {
		$this->user_id = Yii::$app->user->identity->id;

		if( is_array($data) ) {
			$this->value = json_encode($data);;
		} else {
			throw new InvalidValueException('Параметр $data не является массивом.');
		}

		return $this->save();
	}
}