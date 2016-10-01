<?php

	namespace common\modules\signin\models;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "{{%signin_oauth_client_info}}".
	 *
	 * @property integer $id
	 * @property integer $oauth_client_id
	 * @property string $network
	 * @property integer $network_user_id
	 * @property string $email
	 * @property string $profile_info
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class SigninOauthClientInfo extends \yii\db\ActiveRecord {

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%signin_oauth_client_info}}';
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
				[
					['oauth_client_id', 'network', 'profile_info'],
					'required'
				],
				[['network_user_id', 'created_at', 'updated_at'], 'safe'],
				[['oauth_client_id'], 'integer'],
				[['profile_info'], 'string'],
				[['network'], 'string', 'max' => 30],
				[['email'], 'string', 'max' => 255],
			];
		}

		public function getSigninOauthClients()
		{
			return $this->hasOne(SigninOauthClients::className(), ['id' => 'oauth_client_id']);
		}
	}
