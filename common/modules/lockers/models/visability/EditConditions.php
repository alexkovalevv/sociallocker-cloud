<?php
/**
 * Модель формы создания настроек видимости замков
 * @author Alex Kovalev <alex.kovalevv@gmail.com> 
 */

namespace common\modules\lockers\models\visability;

use Yii;
use yii\base\Model;

class EditConditions extends Model
{

	// Селектор контейнера в которым должне быть скрыто содержимое (по умолчанию)
	protected $default_lock_selector;

	public $locker_id;

	// Тип блокировки "absolute", "inline"'
	public $lock_type;

	// Когда показывать замок "page_view", "click_element", "hover_element"
	public $when_show;

	// Способ блокировки "CSS селектор", "Html теги"
	public $way_lock;

	// Селектор контейнера в которым должне быть скрыто содержимое
	public $lock_selector;

	// Селектор, при нажатии на элемент которому он принадлежит, будет активироваться замок
	public $target_selector;

	// Время в секундах, через которое замок будет активирован
	public $delay;

	// Код для вставки на страницу пользователя
	public $inject_html;

	// Контент который нужно скрыть
	public $hidden_content;

	// Правила видимости для замка в JSON
	public $conditions;

	public function init() {
		$this->default_lock_selector = "onpwgt-locked-content-" . rand(88,999999);
	}

	public function rules()
	{
		return [

			//['lock_selector', 'default', 'value' => '.' . $this->default_lock_selector],

			['hidden_content', 'required', 'when' => function($model) {
				return $model->way_lock == 'html';
			}],

			['target_selector', 'required', 'when' => function($model) {
				return $model->when_show == 'click_element' || $model->when_show == 'hover_element';
			}],

			[['locker_id', 'lock_type', 'when_show', 'way_lock', 'lock_selector'], 'required'],

			[[
				 'lock_type',
				 'lock_selector',
				 'target_selector',
				 'when_show',
				 'way_lock',
				 'hidden_content',
				 'conditions',
			 ], 'string'],

			[[
				 'locker_id',
				 'delay',
			 ], 'integer'],

			[['lock_type', 'when_show', 'way_lock'], 'in', 'range' => [
				'absolute', 'inline', 'html', 'css', 'page_view', 'click_element', 'hover_element'
			]],
		];
	}

	public function attributeLabels() {
		return [
			'lock_type' => 'Какой контент скрывать?',
			'way_lock' => 'Способ блокировки',
			'when_show' => 'Когда показывать?',
			'lock_selector' => 'CSS селектор контента',
			'target_selector' => 'CSS селектор ссылки (или элемента)',
			'delay' => 'Задержка блокировки',
		    'inject_html' => 'Код для вставки',
		    'hidden_content' => 'Ваш секретный контент',
		];
	}

	public function attributeHints() {
		return [
			'lock_type' => 'Выберите, какой контент вы хотите скрыть на сайте.',
			'way_lock' => 'Выберите способ блокировки контента.',
			'when_show' => 'Выберите способ, когда показать замок. Например, сразу при посещении страницы или при нажатии на ссылку или наведении на картинку.',
			'lock_selector' => "CSS селектор элемента, в котором находится скрытый контент. Например &lt;div class=&quot;myclass&quot;&gt;мой скрытый контент&lt;/div&gt;, css селектор будет .myclass",
			'target_selector' => 'CSS селектор ссылки (или элемента)',
			'delay' => 'Через, какое время в секундах заблокировать контент? Отсчет нанется с момента входа на страницу с замком.',
			'inject_html' => 'Скопируйте этот html код и вставьте в любое место на вашей странице, где вы хотите видеть замок.',
			'hidden_content' => 'Введите тект или html код, который вы хотите показать после открытия замка.',
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {

		if( empty($this->lock_selector) ) $this->lock_selector = "." . $this->default_lock_selector;

		return [
			'lock_type' => 'inline',
			'way_lock' => 'html',
			'delay' => 0,
			'lock_selector' => $this->lock_selector,
			'inject_html' => '<div class="' . str_replace('.', '', $this->lock_selector) . '"></div>',
		    'conditions' => '[]',
		    'when_show' => 'page_view'
		];
	}

	public static function getModel($locker_id) {
		$visability_model = new LockersVisability();
		return $visability_model->findOne($locker_id);
	}

	public function setModel($locker_id) {
		$model = self::getModel($locker_id);

		if( $model === null ) return false;

		$this->attributes = $model->attributes;
		return $model;
	}

	public function save($validate, $model = null, $draft = false) {

		if ( !$draft && $validate && !$this->validate()) {
			return false;
		}

		if( empty($model) ) $model = new LockersVisability();

		if ( $draft && method_exists( $this, 'attributeDefaults' ) ) {
			$this->attributes = array_merge($this->attributes, $this->attributeDefaults());
		}

		$model->attributes = $this->attributes;

		if($model->save(true)) {
			return true;
		}

		return false;
	}

}
