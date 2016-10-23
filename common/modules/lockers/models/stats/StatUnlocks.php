<?php

	namespace common\modules\lockers\models\stats;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%lockers_stat_unlock}}".
	 *
	 * @property integer $id
	 * @property integer $locker_id
	 * @property string $channel_name
	 * @property string $channel_value
	 * @property string $group_actions
	 * @property string $service
	 * @property integer $oauth_client_id
	 * @property string $page_title
	 * @property string $page_url
	 * @property string $referrer
	 * @property string $user_agent
	 * @property string $ip
	 * @property integer $status
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class StatUnlocks extends \yii\db\ActiveRecord {

		public $metric_name;
		public $metric_value;
		public $order_date;

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
			return '{{%lockers_stat_unlocks}}';
		}


		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['locker_id', 'service'], 'required'],
				[['locker_id', 'oauth_client_id'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['referrer', 'page_url'], 'string'],
				[['page_url_hash'], 'string', 'max' => 32],
				[['service'], 'string', 'max' => 15],
				[['page_title', 'user_agent'], 'string', 'max' => 255],
				[['ip'], 'string', 'max' => 100],
			];
		}
	}
