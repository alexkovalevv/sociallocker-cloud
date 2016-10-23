<?php
	/**
	 * Модель подписки пользователя
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	
	namespace common\modules\subscription\frontend\models;
	
	use Yii;
	use yii\base\InvalidConfigException;
	use yii\base\Model;
	use yii\db\Exception;
	use common\modules\signin\Handler;
	use common\modules\subscription\common\classes\SubscriptionTools;
	
	class SubscriptionForm extends Model {

		const DOUBLE_OPTIN = 1;
		const NOT_DOUBLE_OPTIN = 0;
		const CONFRIM = 1;
		const NOT_CONFIRM = 0;
		
		public $request_type;
		public $service;
		public $service_data = [];
		public $context_data = [];
		public $identity_data = [];
		public $email;
		public $list_id;
		public $locker_id;
		public $user_id;
		public $site_id;
		public $page_url;
		public $page_title;
		public $double_optin;
		public $confirm;
		public $error;
		
		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				
				[
					[
						'request_type',
						'service',
						'context_data',
						'identity_data',
						'list_id',
						'double_optin',
						'locker_id',
						'email'
					],
					'required'
				],
				['email', 'email'],
				['page_url', 'url'],
				['double_optin', 'default', 'value' => self::NOT_DOUBLE_OPTIN],
				['confirm', 'default', 'value' => self::NOT_CONFIRM],
				[
					['double_optin', 'confirm'],
					'filter',
					'filter' => function ($string) {
						if( !is_string($string) ) {
							return $string;
						}

						return ($string == 'true')
							? self::DOUBLE_OPTIN
							: self::NOT_DOUBLE_OPTIN;
					}
				],
				[['list_id', 'locker_id', 'user_id', 'site_id', 'double_optin', 'confirm'], 'integer'],
				[['service', 'page_title'], 'string'],
				['request_type', 'in', 'range' => ['check', 'subscribe']]
			];
		}
		
		private function newLead($status)
		{
			if( 'subscribed' == $status ) {
				
				// if the current service is 'database',
				// then all emails should be added as unconfirmed
				//$services = new FrontendSubscriptionServices($this->user_id);
				//$service_name = $services->getCurrentServiceName();

				LeadForm::setModel($this->identity_data, $this->context_data, true, true);
			} elseif( 'pending' == $status ) {
				LeadForm::setModel($this->identity_data, $this->context_data, false, false);
			}
		}

		private function extractData()
		{
			$subscription_tools = new SubscriptionTools();

			$identity_data = $subscription_tools->normilizeValues($this->identity_data);
			$service_data = $subscription_tools->normilizeValues($this->service_data);
			$context_data = $subscription_tools->normilizeValues($this->context_data);

			$this->setAttributes($identity_data);
			$this->setAttributes($service_data);
			$this->setAttributes($context_data);
		}
		
		/*public static function check($status, $identity, $context)
		{
			if( 'subscribed' == $status ) {
				self::add($identity, $context, true, true);
			}
		}*/
		
		public function save($validate)
		{
			$this->extractData();

			if( $validate && !$this->validate() ) {
				$this->error = [
					'error' => 'Ошибка при валидации данных модели',
					'detalied' => $this->getErrors()
				];

				return false;
			}

			$service_name = Yii::$app->subscription->getCurrentServiceName($this->user_id);
			
			if( empty($service_name) || $this->service !== $service_name ) {
				throw new InvalidConfigException(sprintf('Не установлен сервис подписки "%s".', $service_name));
			}

			// verifying user data if needed while subscribing
			// works for social subscription
			$verified = false;
			$mail_service_info = Yii::$app->subscription->getServiceInfo($this->user_id, $service_name);
			$modes = $mail_service_info['modes'];

			// - request type
			$request_type = strtolower($this->request_type);

			if( 'subscribe' === $request_type ) {
				
				if( $this->double_optin && in_array('quick', $modes) ) {
					$verified = Handler::verifyUserData($this->identity_data, $this->service_data);
				}
			}

			$subscription_tools = new SubscriptionTools();
			$identity_data = $subscription_tools->prepareDataToSave($this->service, $this->locker_id, $this->identity_data);
			$service_ready_data = $subscription_tools->mapToServiceIds($this->service, $this->locker_id, $identity_data);
			$identity_data = $subscription_tools->mapToCustomLabels($this->service, $this->locker_id, $identity_data);

			$service = Yii::$app->subscription->getService($this->user_id, $service_name);

			// creating subscription service
			try {
				if( 'subscribe' === $request_type ) {
					
					$result = $service->subscribe($this->list_id, $service_ready_data, $this->context_data, $this->double_optin, $verified);

					$status = ($result && isset($result['status']))
						? $result['status']
						: 'error';

					$this->newLead($status);
				} elseif( 'check' === $request_type ) {
					
					$result = $service->check($this->list_id, $service_ready_data, $this->context_data);

					$status = ($result && isset($result['status']))
						? $result['status']
						: 'error';

					$this->newLead($status);
				}
				
				return true;
			} catch( Exception $ex ) {
				$this->error = ['error' => $ex->getMessage()];
				
				return false;
			}
		}
	}