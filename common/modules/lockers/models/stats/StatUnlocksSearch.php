<?php

	namespace common\modules\lockers\models\stats;

	use Yii;
	use yii\base\Model;
	use yii\data\ActiveDataProvider;
	use common\modules\lockers\models\stats\StatUnlocks;

	class StatUnlocksSearch extends StatUnlocks {

		public function rules()
		{
			return [];
		}

		public function scenarios()
		{
			// bypass scenarios() implementation in the parent class
			return Model::scenarios();
		}

		public function search($params)
		{

			$lockers = Yii::$app->locker->getLockers();
			$range = [];

			foreach($lockers as $locker) {
				$range[] = $locker->id;
			}

			$query = $this->find()->where([
				'locker_id' => $range
			]);

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			if( !($this->load($params) && $this->validate()) ) {
				return $dataProvider;
			}

			return $dataProvider;
		}

		public static function getCount()
		{
			$lockers = Yii::$app->locker->getLockers();
			$range = [];

			foreach($lockers as $locker) {
				$range[] = $locker->id;
			}

			return parent::find()->where([
				'locker_id' => $range
			])->count();
		}
	}
