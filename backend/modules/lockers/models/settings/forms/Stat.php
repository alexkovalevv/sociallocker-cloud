<?php
namespace backend\modules\lockers\models\settings\forms;

use Yii;
use backend\modules\lockers\models\settings\SettingsForm;
use yii\base\Model;

/**
 * Create locker form
 */
class Stat extends Model
{
	public $google_analytics;
	public $tracking;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[[
				 'google_analytics',
				 'tracking'
			 ], 'integer'],
			[[
				'google_analytics',
				'tracking'
			 ], 'filter', 'filter' => function($value) {return empty($value) ? false : true;}],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'google_analytics' => 'Google аналитика',
			'tracking'         => 'Сбор статистики',
		];
	}

	public function attributeHints() {
		return [
			'google_analytics' => 'Если включено, плагин будет генерировать события для Google аналитики, когда контент разблокирован. Внимание: перед активацией этой функции, пожалуйста, убедитесь, что ваш сайт содержит трекер код Google Analytics.',
			'tracking'         => 'Включает сбор статистики для отчетов.',
		];
	}

	/**
	 * Значения полей по умолчанию. Если элемента массива не существует, то возвращается false или null.
	 * @return array
	 */
	public function attributeDefaults() {
		return [
			'google_analytics' => true,
			'tracking'         => true,
		];
	}
}
