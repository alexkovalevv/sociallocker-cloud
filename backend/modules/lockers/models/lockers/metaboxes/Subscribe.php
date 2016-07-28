<?php
/**
 * Модель настройки подписки. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class Subscribe extends Model
{

	public $subscribe_to_service;
	public $subscribe_mode;
	public $subscribe_list;

	public function rules()
	{
		return [
			[[
				 'subscribe_mode',
			     'subscribe_list'
			 ], 'string'],
			[[
				 'subscribe_to_service',
			 ], 'integer'],
			[['subscribe_to_service'], 'filter', 'filter' => function($value) {return empty($value) ? false : true;}]
		];
	}

	public function attributeLabels() {
		return [
			'subscribe_to_service' => 'Синхронизация с сервисами рассылки',
			'subscribe_list'       => 'Список',
			'subscribe_mode'       => 'Режим проверки'
		];
	}

	public function attributeHints() {
		return [
			'subscribe_to_service' => 'Это действие позволяет автоматически добавить пользователя в выбранный сервис email рассылок. Действие срабатывает после нажатия на кнопку авторизации.',
		    'subscribe_list'       => 'Выберите список для добавления подписчиков.',
		    'subscribe_mode'       => ''
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'subscribe_to_service' => false,
			'subscribe_mode'       => 'quick'
		];
	}
}


