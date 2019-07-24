<?php

	namespace common\modules\lockers\models\lockers;

	use common\modules\lockers\models\visability\LockersVisability;
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
	class Lockers extends ActiveRecord {

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%widgets}}';
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
				[['title', 'options'], 'required'],
				[['title', 'options', 'status'], 'string'],
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'title' => 'Название замка',
				'type' => 'Тип',
				'status' => 'Статус',
				'created_at' => 'Создан',
				'updated_at' => 'Обновлен',
			];
		}

		public function getLockersVisability()
		{
			return $this->hasOne(LockersVisability::className(), ['locker_id' => 'id']);
		}
	}