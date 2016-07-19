<?php
/**
 * Модель настройки отображения. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class Visability extends Model
{
	//Если Вкл, будучи ранее открыт, Замок появится снова через указанный интервал.
	public $relock;

	//Интервал через который появится замок
	public $relock_interval;

	//Тип значения(дни, часы, минуты)
	public $relock_interval_units;

	//Замок будет отображаться, даже если был ранее разблокирован.
	public $always;

	//Замок будет отображаться и на мобильных устройствах.
	public $mobile;

	public function rules()
	{
		return [
			[[
				 'relock',
				 'always',
				 'mobile',
			     'relock_interval',
			     'relock_interval_units'
			 ], 'integer']
		];
	}

	public function attributeLabels() {
		return [
			'relock' => 'Повторная блк.',
			'always' => 'Не запоминать',
			'mobile' => 'Мобильный'
		];
	}

	public function attributeHints() {
		return [
			'relock' => 'Если Вкл, будучи ранее открыт, Замок появится снова через указанный интервал.',
			'always' => 'Если Вкл, Замок будет отображаться, даже если был ранее разблокирован.',
			'mobile' => 'Если Вкл, Замок будет отображаться и на мобильных устройствах.',
		];
	}

}
