<?php
	/**
	 * Модель настройки отображения. Является частью мультимодели редактирования замков.
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\models\lockers\metaboxes;

	use Yii;
	use yii\base\Model;

	class VisabilityMetabox extends Model {

		//Если Вкл, будучи ранее открыт, Замок появится снова через указанный интервал.
		public $relock;

		//Интервал через который появится замок
		public $relock_interval;

		//Тип значения(дни, часы, минуты)
		public $relock_interval_units;

		//Замок будет отображаться, даже если был ранее разблокирован.
		public $always;

		public function rules()
		{
			return [
				[
					[
						'relock',
						'always',
						'relock_interval',
						'relock_interval_units'
					],
					'integer'
				],
				[
					[
						'relock',
						'always',
					],
					'filter',
					'filter' => function ($value) {
						return empty($value)
							? false
							: true;
					}
				]
			];
		}

		public function attributeLabels()
		{
			return [
				'relock' => 'Повторная блк.',
				'always' => 'Не запоминать'

			];
		}

		public function attributeHints()
		{
			return [
				'relock' => 'Если Вкл, будучи ранее открыт, Замок появится снова через указанный интервал.',
				'always' => 'Если Вкл, Замок будет отображаться, даже если был ранее разблокирован.'
			];
		}
	}
