<?php

	namespace backend\models\widgetsVisability;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%lockers_visability}}".
	 *
	 * @property integer $id
	 * @property integer $widget_id
	 * @property string $conditions
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class WidgetsVisability extends \yii\db\ActiveRecord {

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%widgets_visability}}';
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
				[['widget_id', 'pages'], 'required'],
				[['widget_id', 'created_at', 'updated_at'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['conditions', 'pages'], 'string']
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'widget_id' => 'Locker ID',
				'pages' => 'Страницы',
				'conditions' => 'Правила видимости',
				'created_at' => 'Создан',
				'updated_at' => 'Обновлен',
			];
		}
	}
