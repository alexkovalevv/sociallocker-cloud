<?php
/**
 * Модель формы создания настроект видимости замков
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace common\modules\lockers\models\visability;

use Yii;
use yii\base\Model;

class EditConditions extends Model
{
	// Сайт
	public $site_id;

	// Замок
	public $locker_id;

	// Тип блокировки "absolute", "inline"'
	public $lock_type;

	// Когда показывать замок "page_view", "click_element", "hover_element"
	public $when_show;

	// Селектор контейнера в которым должне быть скрыто содержимое
	public $lock_selector;

	// Селектор, при нажатии на элемент которому он принадлежит, будет активироваться замок
	public $target_selector;

	// Время в секундах, через которое замок будет активирован
	public $delay;

	// Правила видимости для замка в JSON
	public $conditions;

	public function rules()
	{
		return [
			[['locker_id', 'site_id', 'lock_type', 'when_show', 'lock_selector'], 'required'],
			[[
			    'lock_type',
			    'lock_selector',
			    'target_selector',
			    'when_show'
			 ], 'string'],
			['conditions', 'safe'],
			[[
				 'site_id',
				 'locker_id',
				 'delay',
			 ], 'integer']

		];
	}

	public function attributeLabels() {
		return [
			'site_id' => 'Выберите сайт',
			'locker_id' => 'Выберите замок',
			'lock_type'     => 'Какой контент скрывать?',
			'when_show' => 'Когда показывать?',
			'lock_selector' => 'CSS селектор контента',
			'target_selector' => 'CSS селектор ссылки (или элемента)',
			'delay' => 'Задержка блокировки'
		];
	}

	public function attributeHints() {
		return [
			'site_id' => 'Выберите сайт, на котором вы будете использовать замок.',
			'locker_id' => 'Выберите замок, который вы будете использовать.',
			'lock_type' => 'Выберите, какой контент вы хотите скрыть на сайте.',
			'when_show' => 'Выберите способ, когда показать замок. Например, сразу при посещении страницы или при нажатии на ссылку или наведении на картинку.',
			'lock_selector' => "CSS селектор элемента, в котором находится скрытый контент. Например &lt;div class=&quot;myclass&quot;&gt;мой скрытый контент&lt;/div&gt;, css селектор будет .myclass",
			'target_selector' => 'CSS селектор ссылки (или элемента)',
			'delay' => 'Через, какое время в секундах заблокировать контент? Отсчет нанется с момента входа на страницу с замком.'
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'lock_type' => 'inline',
			'delay' => 0,
		    'conditions' => '[]',
		    'when_show' => 'page_view'
		];
	}

	public static function getModel($id) {
		$visability_model = new LockersVisability();
		return $visability_model->findOne($id);
	}

	public function save() {
		$visability_model = new LockersVisability();
		$visability_model->attributes = $this->attributes;

		if($this->validate() && $visability_model->save(true)) {
			return true;
		}

		var_dump($visability_model->getErrors());

		return false;
	}

}
