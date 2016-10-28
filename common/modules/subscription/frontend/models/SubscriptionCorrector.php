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
	use common\helpers\TextFormatTools;
	use common\modules\subscription\backend\models\LeadsRecord;
	use common\modules\subscription\common\models\Leads;
	
	class SubscriptionCorrector extends Model {

		const DOUBLE_OPTIN = true;
		const NOT_DOUBLE_OPTIN = false;
		const CONFRIM = true;
		const NOT_CONFIRM = false;

		private $_temp = [];
		private $_locker;

		public $status = 'pending';

		public $request_type;
		public $service;
		public $email;
		public $list_id;
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
				['double_optin', 'default', 'value' => self::NOT_DOUBLE_OPTIN],
				['confirm', 'default', 'value' => self::NOT_CONFIRM],
				[
					[
						'list_id',
						'double_optin',
						'confirm',
						'context_data',
						'identity_data',
						'service_data'
					],
					'filter',
					'filter' => function ($value) {
						if( is_array($value) ) {
							return TextFormatTools::normilizeValues($value);
						}

						return TextFormatTools::normilizeValue($value);
					}
				],
				['email', 'email'],
				['page_url', 'url'],
				[['double_optin', 'confirm'], 'boolean'],
				[['list_id'], 'integer'],
				[['page_title', 'service'], 'string'],
				['request_type', 'in', 'range' => ['check', 'subscribe']],
				[['locker_id', 'user_id', 'site_id', 'locker_title'], 'safe']
			];
		}

		public function __set($name, $value)
		{
			if( in_array($name, ['identity_data', 'service_data', 'context_data']) ) {
				$this->_temp[$name] = $value;
				$this->setAttributes($value);

				return;
			};

			if( $name == 'user_id' || $name == 'site_id' ) {
				return;
			}
			parent::__set($name, $value);
		}

		public function __get($name)
		{
			if( in_array($name, ['identity_data', 'service_data', 'context_data']) ) {
				if( !isset($this->_temp[$name]) ) {
					return null;
				}

				return $this->_temp[$name];
			};

			return parent::__get($name);
		}


		public function setLocker_id($value)
		{
			if( !is_numeric($value) ) {
				return null;
			}

			$value = TextFormatTools::normilizeValue($value);

			if( !empty($value) ) {
				$locker = Yii::$app->locker->getLocker($value);

				if( empty($locker) ) {
					throw new \yii\base\Exception('Замка с locker_id {' . $this->locker_id . '} не существует!');
				}

				$this->_locker = $locker;
			}
		}

		public function setService($value)
		{
			if( empty($value) || !is_string($value) ) {
				return;
			}

			$service_name = Yii::$app->subscription->getCurrentServiceName($this->user_id);

			if( empty($service_name) || $value !== $service_name ) {
				throw new InvalidConfigException('Не установлен сервис подписки {' . $service_name . '}');
			}

			$this->_temp['service'] = $value;
		}

		public function getService()
		{
			return isset($this->_temp['service'])
				? $this->_temp['service']
				: null;
		}

		public function getLocker_id()
		{
			return !empty($this->_locker)
				? $this->_locker->id
				: null;
		}

		public function getLocker_title()
		{
			return !empty($this->_locker)
				? $this->_locker->title
				: null;
		}

		public function getUser_id()
		{
			return !empty($this->_locker)
				? $this->_locker->user_id
				: null;
		}

		public function getSite_id()
		{
			return !empty($this->_locker)
				? $this->_locker->site_id
				: null;
		}

		private function newLead($status)
		{
			if( $this->service === 'database' ) {
				return false;
			}

			$lead_form = new LeadCorrector();

			$lead_form->attributes = $this->attributes;

			if( 'subscribed' == $status ) {
				$lead_form->email_confirmed = Leads::EMAIL_CONFIRMED;
				$lead_form->subscription_confirmed = Leads::SUBSCRIPTION_CONFIRMED;
			} elseif( 'pending' == $status ) {
				$lead_form->email_confirmed = Leads::EMAIL_NOTCONFIRMED;
				$lead_form->subscription_confirmed = Leads::SUBSCRIPTION_NOTCONFIRMED;
			}

			if( 'error' !== $status ) {
				return $lead_form->save(true);
			}

			return false;
		}

		public function save($validate)
		{
			if( $validate && !$this->validate() ) {
				return false;
			}
			try {

				// verifying user data if needed while subscribing
				// works for social subscription
				$verified = false;
				$mail_service_info = Yii::$app->subscription->getServiceInfo($this->user_id, $this->service);
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
				//$identity_data = $subscription_tools->mapToCustomLabels($this->service, $this->locker_id, $identity_data);

				$context_data = $this->context_data;

				$context_data['user_id'] = $this->user_id;
				$context_data['site_id'] = $this->site_id;
				$context_data['locker_title'] = $this->locker_title;

				$service = Yii::$app->subscription->getService($this->user_id, $this->service);

				// creating subscription service

				if( 'subscribe' === $request_type ) {
					
					$result = $service->subscribe($this->list_id, $service_ready_data, $context_data, $this->double_optin, $verified);

					$status = ($result && isset($result['status']))
						? $result['status']
						: 'error';

					$this->status = $status;

					$this->newLead($status);
				} elseif( 'check' === $request_type ) {
					
					$result = $service->check($this->list_id, $service_ready_data, $context_data);

					$status = ($result && isset($result['status']))
						? $result['status']
						: 'error';

					$this->status = $status;

					$this->newLead($status);
				}
				
				return true;
			} catch( Exception $ex ) {
				$this->error = ['error' => $ex->getMessage()];
				
				return false;
			}
		}
	}