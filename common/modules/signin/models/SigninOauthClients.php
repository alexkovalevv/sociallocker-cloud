<?php

	namespace common\modules\signin\models;

	use common\modules\signin\HandlerInternalException;
	use Yii;
	use yii\base\InvalidParamException;
	use yii\behaviors\TimestampBehavior;
	use yii\helpers\ArrayHelper;

	/**
	 * This is the model class for table "{{%signin_oauth_clients}}".
	 *
	 * @property integer $id
	 * @property string s_token
	 * @property string last_entry
	 * @property string $ip
	 * @property string $user_agent
	 * @property integer $created_at
	 * @property integer $updated_at
	 */
	class SigninOauthClients extends \yii\db\ActiveRecord {

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%signin_oauth_clients}}';
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
				[['created_at', 'updated_at'], 'safe'],
				[
					's_token',
					'match',
					'pattern' => '/[A-z0-9\s]+/i',
					'when' => function ($model) {
						return !empty($model->s_token);
					}
				],
				[
					's_token',
					'safe',
					'when' => function ($model) {
						return empty($model->s_token);
					}
				],
				[['user_agent'], 'string', 'max' => 255],
				[['ip'], 'string', 'max' => 80],
				[['last_entry'], 'string', 'max' => 15],
			];
		}

		public function getSigninOauthClientInfoOne()
		{
			return $this->hasOne(SigninOauthClientInfo::className(), [
				'oauth_client_id' => 'id',
				'network' => 'last_entry'
			]);
		}

		public function getSigninOauthClientInfo()
		{
			return $this->hasMany(SigninOauthClientInfo::className(), ['oauth_client_id' => 'id']);
		}

		/**
		 * Возвращает информацию об авторизованном пользователе по токену
		 * @param string $s_token токен запроса авторизации
		 * @return array|null
		 */
		public static function getClientInfoByToken($s_token)
		{
			return self::getClientInfo(['s_token' => $s_token]);
		}

		/**
		 * Возвращает информацию об авторизованном пользователе по id клиента
		 * @param array $conditions правила выборки
		 * @param string $network социальная сеть
		 * @return array|null
		 */
		public static function getClientInfo(array $conditions = [], $network = null)
		{
			$result_data = [];

			if( isset($conditions['oauth_client_id']) ) {
				$conditions['id'] = $conditions['oauth_client_id'];
				unset($conditions['oauth_client_id']);
			}

			$clients_model = SigninOauthClients::find()->where($conditions)->one();

			if( empty($clients_model) || empty($clients_model->signinOauthClientInfo) ) {
				return null;
			}

			foreach($clients_model->signinOauthClientInfo as $variation) {
				$is_verify_nw = $variation->network == $clients_model->last_entry;

				if( !empty($network) ) {
					$is_verify_nw = $variation->network == $network;
				}
				if( $is_verify_nw ) {
					$client_info_profile = @json_decode($variation->profile_info, true);

					$result_data['current_conntection'] = array_merge([
						'oauth_client_id' => $clients_model->id,
						'network_user_id' => $variation->network_user_id,
						'email' => $variation->email
					], $client_info_profile);
				}

				$result_data['has_connections'][] = [
					'network' => $variation->network,
					'network_user_id' => $variation->network_user_id
				];
			}

			return $result_data;
		}

		/**
		 * Сохраняет или обновляет клиента, привязывает к нему аккаунты из соц. сетей.
		 * Если аккаунт уже привязан, просто обновляет старые данные на свежие.
		 * @param integer $oauth_client_id идентификатор клиента в базе сервиса
		 * @param string $s_token токен запроса авторизации
		 * @param string $network социальная сеть
		 * @param array $user_info информация о пользователе
		 * @return integer
		 */
		public static function saveClientInfo($oauth_client_id, $s_token, $network, array $user_info)
		{
			if( empty($network) || empty($user_info) ) {
				throw new InvalidParamException('Аргументы network и user_info не должны быть пустыми.');
			}

			$client_info = SigninOauthClientInfo::find()->where([
				'network_user_id' => ArrayHelper::getValue($user_info, 'uid')
			])->one();

			if( !empty($client_info) ) {

				if( !empty($oauth_client_id) && $oauth_client_id != $client_info->oauth_client_id ) {

					if( !empty($client_info->getSigninOauthClients) ) {
						$client_info->getSigninOauthClients->delete();
					}

					SigninOauthClientInfo::updateAll([
						'oauth_client_id' => $oauth_client_id
					], ['oauth_client_id' => $client_info->oauth_client_id]);

					$client_info->oauth_client_id = $oauth_client_id;
				}

				$oauth_client_id = empty($oauth_client_id)
					? $client_info->oauth_client_id
					: $oauth_client_id;

				$client_info_model = $client_info;
			} else {
				$client_info_model = new SigninOauthClientInfo();
			}

			$clients_model = new SigninOauthClients();

			if( !empty($oauth_client_id) ) {
				$client = $clients_model->findOne($oauth_client_id);

				if( !empty($client) ) {
					$clients_model = $client;
				}
			}

			$clients_model->s_token = $s_token;
			$clients_model->last_entry = $network;
			$clients_model->ip = Yii::$app->request->getUserIP();
			$clients_model->user_agent = Yii::$app->request->getUserAgent();

			if( $clients_model->save(true) ) {

				$client_info_model->oauth_client_id = empty($clients_model->id)
					? Yii::$app->db->getLastInsertID()
					: $clients_model->id;

				$client_info_model->network = $network;
				$client_info_model->network_user_id = ArrayHelper::getValue($user_info, 'uid');
				$client_info_model->email = ArrayHelper::getValue($user_info, 'email');

				unset($user_info['uid']);
				unset($user_info['email']);

				$client_info_model->profile_info = @json_encode($user_info);

				if( $client_info_model->save(true) ) {
					return $client_info_model->oauth_client_id;
				}
			}

			return null;
		}
	}
