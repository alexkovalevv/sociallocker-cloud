<?php

	namespace common\modules\lockers\models\visability;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%lockers_visability}}".
	 *
	 * @property integer $id
	 * @property integer $locker_id
	 * @property string $lock_type
	 * @property string $when_show
	 * @property string $way_lock
	 * @property string $lock_selector
	 * @property string $target_selector
	 * @property integer $delay
	 * @property string $conditions
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class LockersVisability extends \yii\db\ActiveRecord {

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%lockers_visability}}';
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
				[['locker_id', 'pages', 'lock_type', 'when_show', 'way_lock', 'lock_selector'], 'required'],
				[['locker_id', 'delay', 'created_at', 'updated_at'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['conditions', 'hidden_content', 'pages'], 'string'],
				[['lock_type', 'when_show', 'way_lock'], 'string', 'max' => 15],
				[['lock_selector', 'target_selector'], 'string', 'max' => 255]
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'locker_id' => 'Locker ID',
				'pages' => 'Страницы',
				'lock_type' => 'Тип блокировки',
				'when_show' => 'Когда показывать замок',
				'lock_selector' => 'Селектор',
				'target_selector' => 'Селектор элемента',
				'delay' => 'Задержка',
				'conditions' => 'Правила видимости',
				'created_at' => 'Создан',
				'updated_at' => 'Обновлен',
			];
		}
	}
