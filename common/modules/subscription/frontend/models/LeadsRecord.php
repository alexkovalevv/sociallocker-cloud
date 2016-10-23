<?php

	namespace common\modules\subscription\common\models;

	use Yii;
	use yii\base\Exception;

	class LeadsRecord extends Leads {

		public $identity_data;
		public $context_data;

		/**
		 * Сохраняет лид в базу данных
		 * @param bool $validate
		 * @param object $model \yii\db\ActiveRecord
		 * @return bool|int|null
		 */
		public function leadSave($validate = false)
		{
			if( $validate && !$this->validate() ) {
				return false;
			}

			if( empty($this->display_name) ) {
				if( !empty($this->first_name) && !empty($this->last_name) ) {
					$this->display_name = $this->first_name . ' ' . $this->last_name;
				} elseif( !empty($this->first_name) ) {
					$this->display_name = $this->first_name;
				} elseif( !empty($this->last_name) ) {
					$this->display_name = $this->last_name;
				} else {
					$this->display_name = "";
				}
			}

			if( !$this->save() ) {
				return false;
			}

			// saving extra fields
			$fields = [];

			foreach($this->identity_data as $item_name => $item_value) {
				if( in_array($item_name, ['email', 'first_name', 'last_name', 'display_name']) ) {
					continue;
				}

				$fields[trim($item_name, '{}')] = [
					'value' => $item_value,
					'custom' => (strpos($item_name, '{') === 0)
						? 1
						: 0
				];
			}

			if( !empty($fields) ) {
				$leads_fields_model = new LeadsFields();
				if( $model = $leads_fields_model->findOne($this->id) ) {
					$model->fields_value = json_encode($fields);
				} else {
					$leads_fields_model->lead_id = $this->id;
					$leads_fields_model->fields_value = json_encode($fields);
				}

				if( $leads_fields_model->save(true) ) {

					return false;
				}
			}

			return $this->id;
		}


		/**
		 * @param object $model common\models\Leads
		 * @param $code
		 * @return bool
		 */
		public function setConfirmationCode($model, $code)
		{
			if( empty($model) ) {
				return false;
			}

			$model->lead_confirmation_code = $code;

			return $model->save(true);
		}

		/***
		 * @param $email
		 * @param $user_id
		 * @param $code
		 * @param bool $push
		 * @return bool
		 * @throws Exception
		 */
		public function confirm($email, $user_id, $code, $push = false)
		{
			if( empty($email) || $user_id ) {
				return false;
			}

			$model = self::getByEmail($email, $user_id);

			if( !$model || $model->lead_subscription_confirmed ) {
				return false;
			}

			if( $code !== $model->lead_confirmation_code ) {
				return false;
			}

			$temp = !empty($model->lead_temp)
				? json_decode($model->lead_temp, true)
				: null;

			if( $push ) {
				$serviceReady = isset($temp['serviceReady'])
					? $temp['serviceReady']
					: null;
				$context = isset($temp['context'])
					? $temp['context']
					: null;
				$listId = isset($temp['listId'])
					? $temp['listId']
					: null;
				$verified = isset($temp['verified'])
					? $temp['verified']
					: null;

				$service = Yii::$app->subscription->getCurrentService();

				if( empty($service) ) {
					throw new Exception('The subscription service is not set.');
				}

				$service->subscribe($serviceReady, $listId, false, $context, $verified);
			}

			$model->lead_email_confirmed = 1;
			$model->lead_subscription_confirmed = 1;

			return $model->save(true);
		}
	}
