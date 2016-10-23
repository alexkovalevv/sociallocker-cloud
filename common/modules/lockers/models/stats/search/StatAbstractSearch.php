<?php
	/**
	 * Абстрактный класс статистики
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\models\stats\search;

	use Yii;
	use yii\base\Model;

	abstract class StatAbstractSearch extends Model {

		protected $_lockers;

		public $date_start;
		public $date_end;
		public $locker_id;
		public $locker_type;

		public function rules()
		{
			return [
				['locker_type', 'default', 'value' => 'sociallocker'],
				['locker_type', 'string', 'max' => 15],
				['locker_type', 'in', 'range' => Yii::$app->getModule('lockers')->params['lockers_collections']],
				[['date_start', 'date_end'], 'required'],
				[['date_start', 'date_end'], 'integer'],
				[
					['locker_id'],
					'integer',
					'when' => function ($model, $attribute) {
						return !empty($model->$attribute);
					},
				],
				['locker_id', 'isLockerExists'],
			];
		}

		public function isLockerExists($attribute, $params)
		{
			if( empty($this->$attribute) ) {
				return;
			}

			if( Yii::$app->lockers->getLocker($this->$attribute) === null ) {
				$this->addError($attribute, "Замка c id {$this->$attribute} не существует или введен не правильный id!");
			}
		}

		protected function getQueryPartOnLockers($locker_id, $table_prefix = null)
		{
			if( empty($locker_id) ) {
				$lockers = $this->getLockersByType();

				if( empty($lockers) ) {
					return null;
				}

				$lockers_to_string = join(',', $lockers);
				$condition = "locker_id IN (" . $lockers_to_string . ")";
			} else {
				$condition = "locker_id = '$locker_id'";
			}

			if( !empty($table_prefix) ) {
				return $table_prefix . '.' . $condition;
			}

			return $condition;
		}

		protected function getAllLockers(array $conditions = [])
		{
			if( empty($this->_lockers) ) {
				$lockers = Yii::$app->lockers->getLockers($conditions);

				$this->_lockers = [];
				foreach($lockers as $locker) {
					$this->_lockers[] = $locker->id;
				}
			}

			return $this->_lockers;
		}

		protected function getLockersByType($type = null)
		{
			$type = !empty($type)
				? $type
				: $this->locker_type;

			return $this->getAllLockers(['type' => $type]);
		}

		abstract public function chartSearch($params);

		abstract public function tableSearch($params);
	}