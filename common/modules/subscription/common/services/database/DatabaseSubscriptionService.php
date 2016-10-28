<?php
	namespace common\modules\subscription\common\services\database;

	use Yii;
	use yii\base\Model;
	use yii\db\ActiveRecord;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Url;

	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;
	use common\modules\subscription\common\models\Leads;
	use common\modules\subscription\frontend\models\LeadCorrector;
	use common\modules\subscription\frontend\models\LeadsRecord;

	class DatabaseSubscriptionService extends Subscription {

		/**
		 * Returns lists available to subscribe.
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getLists()
		{
			return [];
		}

		/**
		 * Subscribes the person.
		 */
		public function subscribe($list_id, $identity_data, $context_data, $double_optin, $verified)
		{
			if( $verified ) {
				return ['status' => 'subscribed'];
			}

			$email = ArrayHelper::getValue($identity_data, 'email');

			if( empty($email) ) {
				throw new SubscriptionException('Email адрес не существует.');
			}

			$temp = [
				'identity_data' => $identity_data,
				'context_data' => $context_data,
				'list_id' => $list_id,
				'verified' => $verified
			];

			$user_id = ArrayHelper::getValue($context_data, 'user_id');

			$leads_model = LeadsRecord::user($user_id)->modelCreate();
			$lead = $leads_model->getLeadByEmail($email);

			// если лид уже существует
			if( !empty($lead) ) {
				if( $lead->subscription_confirmed === Leads::SUBSCRIPTION_CONFIRMED ) {
					return ['status' => 'subscribed'];
				}

				$lead->temp = $temp;
				$this->sendConfirmation($lead);

				return ['status' => 'pending'];
			}

			// создаем форматируем данные лида перед сохранением
			$lead_form = new LeadCorrector();

			$lead_form->identity_data = $context_data;
			$lead_form->context_data = $identity_data;

			//создать лид и выслать подтверждение
			$this->sendConfirmation($lead_form);

			return ['status' => 'pending'];
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($list_id, $identity_data, $context_data)
		{
			$email = ArrayHelper::getValue($identity_data, 'email');

			if( empty($email) ) {
				throw new SubscriptionException('Email адрес не существует.');
			}

			$user_id = ArrayHelper::getValue($context_data, 'user_id');

			$lead = LeadsRecord::user($user_id)->getLeadByEmail($email);

			if( !empty($lead) ) {
				if( $lead->subscription_confirmed === Leads::SUBSCRIPTION_CONFIRMED ) {
					return ['status' => 'subscribed'];
				}
			}

			return ['status' => 'pending'];
		}

		/**
		 * @param ActiveRecord $lead
		 * @param $context_data
		 * @throws SubscriptionException
		 */
		public function sendConfirmation(Model $lead)
		{

			$code = $lead->confirmation_code;

			if( empty($code) ) {
				$code = Yii::$app->getSecurity()->generateRandomString(32);
				$lead->confirmation_code = $code;
			}

			$email_body = $this->settings['service_confirm_email_body'];

			$link = $this->getConfirmationLink($lead, $code);
			$email_body = str_replace('[link]', '<a href="' . $link . '" target="_blank">Подтвердить подписку</a>', $email_body);

			$mailer = Yii::$app->mailer;
			$message = $mailer->compose()
				->setTo($lead->email)
				->setFrom(Yii::$app->params['robotEmail'])
				->setReplyTo([$this->settings['service_sender_email'] => $this->settings['service_sender_name']])
				->setSubject($this->settings['service_confirm_email_subject'])
				->setHtmlBody($email_body);

			if( !$message->send() ) {
				throw new SubscriptionException('Не удалось отправить письмо подтверждения из-за неизвестной ошибки.');
			}

			if( !$lead->save(true) ) {
				$errors = $lead->getErrors();
				throw new SubscriptionException('Не удалось сохранить лид из-за ошибки.');
			}
		}

		public function getConfirmationLink(Model $lead, $code)
		{
			$url = Yii::$app->getModule('subscription')->params['confirmation_url'];

			return Url::to([
				$url,
				'confirm' => 1,
				'locker_id' => $lead->locker_id,
				'email' => urlencode($lead->email),
				'confirmation_code' => $code
			], true);
		}

		/**
		 * Returns custom fields.
		 */
		public function getCustomFields($listId)
		{

			$can = [
				'changeType' => true,
				'changeReq' => true,
				'changeDropdown' => true,
				'changeMask' => true
			];

			$customFields = [];

			$customFields[] = [

				'fieldOptions' => [],
				'mapOptions' => [
					'req' => false,
					'id' => 'void',
					'name' => 'void',
					'title' => 'Custom Field',
					'labelTitle' => 'Custom Field',
					'mapTo' => 'any',
					'service' => []
				],
				'premissions' => [
					'can' => $can,
					'notices' => []
				]
			];

			return $customFields;
		}
	}