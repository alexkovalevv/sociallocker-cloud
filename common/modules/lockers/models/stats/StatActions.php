<?php

	namespace common\modules\lockers\models\stats;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%lockers_stat_actions}}".
	 *
	 * @property integer $id
	 * @property integer $locker_id
	 * @property integer $unlock_id
	 * @property string $channel_value
	 * @property string $channel_name
	 * @property string $status
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class StatActions extends \yii\db\ActiveRecord {

		const STATUS_ACTIVE = 2;
		const STATUS_NOTACTIVE = 1;

		public $metric_value;
		public $metric_name;
		public $order_date;
		public $page_url;
		public $page_url_hash;
		public $page_title;

		/**
		 *
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%lockers_stat_actions}}';
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
				[['locker_id', 'unlock_id', 'channel_value', 'channel_name', 'status'], 'required'],
				[['locker_id', 'unlock_id', 'status'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['channel_value'], 'string', 'max' => 255],
				[['channel_name'], 'string', 'max' => 15],
			];
		}
	}
