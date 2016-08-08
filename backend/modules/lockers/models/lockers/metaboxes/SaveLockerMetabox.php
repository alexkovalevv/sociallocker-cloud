<?php
/**
 * Модель настройки сохранения замков. Является частью мультимодели редактирования замком.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class SaveLockerMetabox extends Model
{
	//Статус
	public $status;

	public function rules()
	{
		return [
			[['status'], 'string']
		];
	}

	public function attributeLabels() {
		return [
			'status' => 'Состояние'
		];
	}

	public function attributeHints() {
		return [
			'status' => 'Выберите текущее состояние замка.'
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'status' => 'draft'
		];
	}
}
