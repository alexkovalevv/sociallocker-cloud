<?php
/**
 * Модель дополнительные настройки. Является частью мультимодели редактирования замков.
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace backend\modules\lockers\models\lockers\metaboxes;

use Yii;
use yii\base\Model;

class Advanced extends Model
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
			     'ajax'
			 ], 'integer']
		];
	}

	public function attributeLabels() {
		return [
			'close'     => 'Кнопка закрыть',
			'timer'     => 'Таймер (в сек.)',
			'ajax'      => 'AJAX',
			'highlight' => 'Подсветка'
		];
	}

	public function attributeHints() {
		return [
			'close'     => 'Показывает кнопку "Закрыть" в углу.',
			'timer'     => 'Устанавливает таймер обратного отсчета для Замка.',
			'ajax'      => 'Если Вкл, скрытый контент будет подгружаться только после разблокировки, то есть будет вырезан из исходного кода страницы.',
			'highlight' => 'Если Вкл, Замок подсвечивает заблокированное содержимое после разблокировки.',
		];
	}
}
