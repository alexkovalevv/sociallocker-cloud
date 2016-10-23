<?php
	/**
	 * Класс отвечает за обработку полученных данных при авторизации через социальные сервисы
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace frontend\classes;

	use Yii;
	use yii\db\Exception;
	use yii\helpers\Url;
	use yii\web\HttpException;
	use common\modules\signin\HandlerException;
	use common\modules\signin\HandlerInternalException;
	use common\modules\signin\models\SigninOauthClients;
	use yii\web\Response;

	class ConnectHandler {

		public $handler_name;

		public function __construct($handler_name, array $options = [])
		{
			$this->handler_name = $handler_name;
			$this->options = $options;
		}

		private function getHandler()
		{

			$handlers_path = Yii::$app->getModule('signin')->params['handlers_path'];

			$handlers_options = Yii::$app->getModule('signin')->params['handlers_options'];
			$handlers_options = isset($handlers_options[$this->handler_name])
				? $handlers_options[$this->handler_name]
				: [];

			$this->options = array_merge($this->options, $handlers_options);

			$handler_namespace = $handlers_path . "\\" . strtolower($this->handler_name) . "\\" . ucfirst($this->handler_name) . 'Handler';
			$handler = Yii::createObject($handler_namespace, [$this->options]);

			return $handler;
		}

		/**
		 * Отправляет запрос на авторизацию
		 * @param object $handler класс обрабочика
		 * @return string возвращает json строку
		 */

		public function response()
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			try {
				$handler = $this->getHandler();
				$user_info = $handler->handleRequest();

				if( empty($user_info) ) {
					return Yii::$app->response->redirect($this->getBlankUrl());
				}

				$source = isset($user_info['source'])
					? $user_info['source']
					: $this->handler_name;

				SigninOauthClients::saveClientInfo($handler->oauth_client_id, $handler->s_token, $source, $user_info);

				return Yii::$app->response->redirect($this->getBlankUrl());
			} catch( HandlerInternalException $ex ) {
				Yii::$app->response->format = Response::FORMAT_HTML;
				throw new HttpException('400', $ex->getDetailed());
			} catch( HandlerException $ex ) {
				return ['error' => $ex->getMessage()];
			} catch( Exception $ex ) {
				return ['error' => $ex->getMessage()];
			}
		}

		public function getBlankUrl()
		{
			return Url::to(['/redirect/blank']);
		}
	}