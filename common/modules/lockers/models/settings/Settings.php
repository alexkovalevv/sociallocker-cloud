<?php

	namespace common\modules\lockers\models\settings;

	use common\modules\lockers\models\lockers\Lockers;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "lockers".
	 *
	 * @property string $id
	 * @property string $user_id
	 * @property string $value
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class Settings extends ActiveRecord {

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
				TimestampBehavior::className(),
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
	}