<?php
namespace backend\modules\lockers\models\settings\forms;

use Yii;
use backend\modules\lockers\models\settings\SettingsForm;
use yii\base\Exception;
use yii\base\Model;

/**
 * Create locker form
 */
class Subscribe extends Model
{
	public $data = [];
	public $subscription_to_service;

	public function init() {
		$service_options = require(Yii::getAlias('@lockers/subscribe/services-options.php'));

		if( empty($service_options) ) {
			throw new Exception('Не установлены опции сервисов.');
		}

		foreach( $service_options as $group ) {
			foreach( $group as $option ) {
				$data[$option['name']] = null;
			}
		}
	}

	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	public function __get($name)
	{
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'subscription_to_service' => 'Служба рассылки'
		];
	}

	public function attributeHints() {
		return [
			'subscription_to_service' => ''
		];
	}
}
