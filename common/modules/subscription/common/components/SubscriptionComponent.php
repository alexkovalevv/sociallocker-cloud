<?php
	/**
	 * Предоставляет возможность работы с сервисами подписки.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */
	namespace common\modules\subscription\common\components;
	
	use yii;
	use yii\base\Component;
	use yii\base\Exception;
	
	class SubscriptionComponent extends Component {

		/**
		 * Возвращает все доступные сервисы подписки
		 */
		public function getSerivcesList()
		{
			$services = require(Yii::getAlias('@subscription/boot.php'));

			if( empty($services) ) {
				throw new Exception('Не установлены сервисы подписки.');
			}

			return $services;
		}

		/**
		 * Возвращает экземляр класса сервиса
		 * @param null $user_id
		 * @param null $name
		 * @return null|object
		 * @throws yii\base\InvalidConfigException
		 */
		public function getService($user_id, $name = null)
		{
			$info = $this->getServiceInfo($user_id, $name);

			if( empty($info) ) {
				return null;
			}

			$service_settings = static::getServiceSettings($user_id);

			$class = Yii::createObject($info['class'], [$service_settings, $info]);

			return $class;
		}

		/**
		 * Возвращает информацию о сервисе рассылок
		 * @param null $user_id
		 * @param null $name
		 * @return null
		 * @throws Exception
		 */
		public function getServiceInfo($user_id, $name = null)
		{

			if( empty($user_id) ) {
				throw new yii\base\InvalidConfigException('Не передан обязательный атрибут user_id');
			}

			$services = $this->getSerivcesList();
			$name = empty($name)
				? static::getCurrentServiceName($user_id)
				: $name;

			if( !isset($services[$name]) ) {
				$name = 'default';
			}

			if( isset($services[$name]) ) {
				$services[$name]['name'] = $name;
				
				return $services[$name];
			}

			return null;
		}

		public function getCurrentServiceName()
		{
			return 'default';
		}
		
		public function getServiceSettings()
		{
			return [];
		}
		
		/**
		 * Возвращает доступные режимы проверки для сервисов подписки
		 */
		public function getCurrentModes($user_id = null, $toList = false)
		{
			$result = [];
			
			$info = $this->getServiceInfo($user_id);
			
			if( empty($info) ) {
				return [];
			}
			
			$all = $this->getAllOptinModes();
			
			foreach($info['modes'] as $name) {
				$result[$name] = [
					'value' => $name,
					'text' => $all[$name]['title'],
					'hint' => $all[$name]['description']
				];
			}
			
			if( !$toList ) {
				return $result;
			}
			
			if( isset($result['quick']) ) {
				
				if( !isset($result['double-optin']) ) {
					$result['double-optin'] = [
						'value' => 'double-optin',
						'text' => $all['double-optin']['title'],
						'hint' => $all['double-optin']['description']
					
					];
				}
				
				if( !isset($result['quick-double-optin']) ) {
					$result['quick-double-optin'] = [
						'value' => 'quick-double-optin',
						'text' => $all['quick-double-optin']['title'],
						'hint' => $all['quick-double-optin']['description']
					
					];
				}
			}
			
			return $result;
		}
		
		/**
		 * Возвращает доступные режимы проверки.
		 */
		public function getAllOptinModes()
		{
			
			$modes = [
				'double-optin' => [
					'title' => "Двойная проверка",
					'description' => "После того, как пользователь вводит свой адрес электронной почты, плагин отправляет ему подтверждение и ждет, пока пользователь не подтвердит подписку. И только после этого разблокирует содержимое."
				],
				'quick-double-optin' => [
					'title' => "Ленивая проверка",
					'description' => "Разблокирует содержимое сразу после того, как пользователь вводит свой адрес электронной почты, но также посылает сообщение о подтверждении подписки по электронной почте."
				],
				'quick' => [
					'title' => "Одинарная проверка",
					'description' => "Разблокирует содержимое сразу после того, как пользователь вводит свой адрес электронной почты. Не отправляет подтверждение по электронной почте."
				],
			];
			
			return $modes;
		}
	}
