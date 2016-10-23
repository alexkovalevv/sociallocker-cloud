<?php

	namespace common\models;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%settings}}".
	 *
	 * @property string $id
	 * @property integer $user_id
	 * @property integer $section
	 * @property string $value
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class SettingsRecord extends \yii\db\ActiveRecord {

		public function behaviors()
		{
			return [
				TimestampBehavior::className(),
			];
		}

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%settings}}';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['user_id', 'section'], 'required'],
				[['user_id'], 'integer'],
				[['value', 'section'], 'string'],
			];
		}
	}
