<?php
	namespace common\modules\subscription\common\services\database;

	use Codeception\Lib\Interfaces\ActiveRecord;
	use common\modules\subscription\common\classes\Subscription;
	use common\modules\subscription\common\classes\SubscriptionException;
	use common\modules\subscription\model\LeadForm;
	use common\modules\subscription\common\models\Leads;
	use League\Flysystem\Exception;
	use Yii;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Url;

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

			//$lead = OPanda_Leads::getByEmail($email);

			$leads_model = Leads::create();
			$lead = $leads_model->getByEmail($email);

			// already exists
			if( !empty($lead) ) {

				if( $lead->lead_subscription_confirmed ) {
					return ['status' => 'subscribed'];
				}

				$lead->temp = $temp;

				$this->sendConfirmation($lead, $context_data);

				return ['status' => 'pending'];
			}

			$lead_form = new LeadForm();

			$lead_form->identity_data = $context_data;
			$lead_form->context_data = $context_data;
			$lead_form->double_optin = $double_optin;

			if( $lead_form->extractData(true) ) {
				throw new SubscriptionException('Ошибка при валидации данных модели');
			}

			//создать лид
			$this->sendConfirmation($lead_form, $context_data);

			return ['status' => 'pending'];
		}

		/**
		 * Checks if the user subscribed.
		 */
		public function check($list_id, $identity_data, $context_data)
		{
			return ['status' => 'subscribed'];
		}

		/**
		 * @param ActiveRecord $lead
		 * @param $context_data
		 * @throws SubscriptionException
		 */
		public function sendConfirmation(ActiveRecord $lead, $context_data)
		{

			if( empty($context_data['locker_id']) ) {
				throw new SubscriptionException('Invalid request. Please contact the OnePress support.');
			}

			$locker_id = (int)$context_data['locker_id'];

			$reply_to_email = $this->service_settings['service_sender_email'];
			$reply_to_name = $this->service_settings['service_sender_name'];
			$email_subject = $this->service_settings['service_confirm_email_subject'];
			$email_body = $this->service_settings['service_confirm_email_body'];

			$link = $this->getConfirmationLink($lead, $context_data);
			$email_body = str_replace('[link]', '<a href="' . $link . '" target="_blank">' . $link . '</a>', $email_body);

			Yii::$app->mailer->compose()
				->setTo($lead->email)
				->setFrom(Yii::$app->params['robotEmail'])
				->setReplyTo([$reply_to_email => $reply_to_name])
				->setSubject($email_subject)
				->setTextBody($email_body)
				->send();

			if( !$lead->save(true) ) {
				throw new SubscriptionException('Не удалось сохранить лид из-за ошибки.');
			}
		}

		public function getConfirmationLink($lead)
		{
			$url = Yii::$app->getModule('subscription')->params['confirmation_url'];
			$code = $lead->confirmation_code;

			if( empty($code) ) {
				$code = Yii::$app->getSecurity()->generateRandomString();
				$lead->confirmation_code = $code;
			}

			return Url::to([
				$url,
				'confirm' => 1,
				'email' => urlencode($lead->lead_email),
				'confirmation_code' => $code
			]);
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