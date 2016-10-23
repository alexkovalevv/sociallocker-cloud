<?php

	namespace common\modules\lockers\models\stats;

	use Yii;

	/**
	 * This is the model class for table "{{%lockers_stat_skips}}".
	 *
	 * @property integer $id
	 * @property integer $locker_id
	 * @property integer $skips
	 * @property string $aggregate_date
	 * @property string $page_title
	 * @property string $page_url_hash
	 * @property string $page_url
	 */
	class StatSkips extends \yii\db\ActiveRecord {

		public $metric_value;
		public $metric_name;
		public $channel_name;
		public $order_date;

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%lockers_stat_skips}}';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['locker_id'], 'required'],
				[['locker_id'], 'integer'],
				[['aggregate_date', 'skips'], 'safe'],
				[['page_url'], 'string'],
				[['page_title'], 'string', 'max' => 255],
				[['page_url_hash', 'channel_name'], 'string', 'max' => 32],
			];
		}

		public function newUpdate()
		{

			if( $this->validate() ) {
				Yii::$app->db->createCommand("INSERT INTO {{%lockers_stat_skips}}(
					locker_id,
					channel_name,
					skips,
					aggregate_date,
					page_title,
					page_url_hash,
					page_url
				) VALUES ('$this->locker_id', '$this->channel_name', '1', CURDATE(), '$this->page_title', '$this->page_url_hash', '$this->page_url')
				ON DUPLICATE KEY UPDATE skips=skips+1")->execute();

				return true;
			}

			return false;
		}
	}
