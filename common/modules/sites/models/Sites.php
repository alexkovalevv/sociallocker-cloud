<?php

	namespace common\modules\sites\models;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%sites}}".
	 *
	 * @property integer $user_id
	 * @property string $url
	 * @property string $domain
	 * @property string $title
	 * @property string $status
	 * @property string $approve
	 * @property integer $selected
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class Sites extends \yii\db\ActiveRecord {

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{

			return '{{%sites}}';
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
				[['url', 'domain', 'status', 'approve'], 'required'],
				[['user_id', 'selected', 'status', 'approve'], 'integer'],
				[['user_id', 'created_at', 'updated_at'], 'safe'],
				[['url', 'domain', 'title'], 'string', 'max' => 255]
			];
		}
	}
