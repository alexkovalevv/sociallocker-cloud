<?php
/**
 * Модель настройки сохранения замков. Является частью мультимодели редактирования замком.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class Save extends Model
{
	//Статус
	public $status = 1;

	public function rules()
	{
		return [
			[['status'], 'required'],
			['status', 'integer']
		];
	}

	public function attributeLabels() {
		return [
			'status' => 'Состояние'
		];
	}

	public function attributeHints() {
		return [
			'status' => 'В состоянии отключен, замок не будет отображаться на вашем сайте.'
		];
	}
}
