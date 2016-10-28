<?php
	/**
	 * Рабочие пространства пользователей
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @copyright Alex Kovalev 25.10.2016
	 * @version 1.0
	 */

	namespace backend\traits;

	use Yii;
	use yii\base\Exception;
	use yii\base\InvalidConfigException;
	use yii\base\UnknownMethodException;

	trait BackendUsersSpace {

		/**
		 * Вызывает метод указанного класса по его названию.
		 * @param $class
		 * @param $method_name
		 * @param $attributes
		 * @return mixed
		 */
		public static function methodCall($class, $method_name, $attributes)
		{
			if( method_exists($class, $method_name) ) {
				return call_user_func_array([$class, $method_name], $attributes);
			}

			throw new UnknownMethodException('Meтод {' . $method_name . '} на найден в базовом классе.');
		}

		/**
		 * Вызов методов Leads в пространстве пользователя.
		 * Ограниченное пространство, все данные в котором, привязаны к определенному пользователю.
		 * @param int $user_id
		 * @param int $site_id
		 * @return mixed
		 * @throws InvalidConfigException
		 */
		public static function userSpace($user_id = null, $site_id = null)
		{
			$user_id = !empty($user_id)
				? $user_id
				: Yii::$app->user->getId();

			$site_id = !empty($site_id)
				? $site_id
				: Yii::$app->userSites->getSelectedId($user_id);

			if( empty($user_id) ) {
				throw new InvalidConfigException("Не передан обязательный атрибут user_id");
			}

			return new self($user_id, $site_id);
		}

		/**
		 * Вызов методов Leads в глобальном пространстве. Необходимо для манипуляции пользователями.
		 * @return mixed
		 * @throws Exception
		 */
		public static function globalSpace()
		{
			// Разрешаем доступ только администраторам
			if( !Yii::$app->user->can('administrator') ) {
				throw new Exception('Вы патаетесь вызвать метод с правами администратора, но не имеете этих прав.');
			}

			return new self();
		}
	}