<?php
/**
 * Модель дополнительные настройки. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class AdvancedMetabox extends Model
{
	//Показывает кнопку "Закрыть" в углу.
	public $close;

	//Устанавливает таймер обратного отсчета для Замка.
	public $timer;

	//Скрытый контент будет подгружаться только после разблокировки,
	//то есть будет вырезан из исходного кода страницы.
	public $ajax;

	//Замок подсвечивает заблокированное содержимое после разблокировки.
	public $highlight;

	public function rules()
	{
		return [
			[[
				 'timer',
				 'highlight',
				 'close',
			 ], 'integer'],
			[[
				 'highlight',
				 'close'
			 ], 'filter', 'filter' => function($value) {return empty($value) ? false : true;}]

		];
	}

	public function attributeLabels() {
		return [
			'close'     => 'Кнопка закрыть',
			'timer'     => 'Таймер (в сек.)',
			'highlight' => 'Подсветка'
		];
	}

	public function attributeHints() {
		return [
			'close'     => 'Показывает кнопку "Закрыть" в углу.',
			'timer'     => 'Устанавливает таймер обратного отсчета для Замка.',
			'highlight' => 'Если Вкл, Замок подсвечивает заблокированное содержимое после разблокировки.',
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'close'     => true,
			'timer'     => 0,
			'highlight' => true
		];
	}

}
