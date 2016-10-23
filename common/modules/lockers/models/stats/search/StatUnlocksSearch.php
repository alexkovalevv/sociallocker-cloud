<?php
	namespace common\modules\lockers\models\stats\search;

	use Yii;
	use yii\data\ActiveDataProvider;
	use common\modules\lockers\models\stats\StatUnlocks;
	use yii\web\NotFoundHttpException;

	class StatUnlocksSearch extends StatAbstractSearch {

		public function tableSearch($params)
		{
			$this->setAttributes($params);

			if( !$this->validate() ) {
				throw new NotFoundHttpException('Переданы некорректные параметры запроса!');
			}
			$query_first_part = $this->getQueryPartOnLockers($this->locker_id);

			if( empty($query_first_part) ) {
				return null;
			}

			$models = StatUnlocks::find()
				->select('service as metric_name, page_title, page_url_hash, page_url, COUNT(*) AS metric_value')
				->from('lockers_stat_unlocks')
				->where($query_first_part . ' and created_at >= ' . $this->date_start . ' and created_at <= ' . $this->date_end)
				->groupBy(['page_url_hash', 'metric_name'])
				->orderBy(['created_at' => SORT_ASC])
				->all();

			return $models;
		}

		public function chartSearch($params)
		{
			$this->setAttributes($params);

			if( !$this->validate() ) {
				throw new NotFoundHttpException('Переданы некорректные параметры запроса!');
			}

			$query_first_part = $this->getQueryPartOnLockers($this->locker_id);

			if( empty($query_first_part) ) {
				return null;
			}

			$models = StatUnlocks::find()
				->select('service as metric_name, count(*) as metric_value, date(from_unixtime(created_at)) as order_date')
				->from('lockers_stat_unlocks')
				->where($query_first_part . ' and created_at >= ' . $this->date_start . ' and created_at <= ' . $this->date_end)
				->groupBy(['order_date', 'metric_name'])
				->all();

			return $models;
		}

		public function search($params)
		{
			$this->setAttributes($params);

			$lockers_range = $this->getAllLockers();

			$query = StatUnlocks::find()->where(['locker_id' => $lockers_range]);

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			return $dataProvider;
		}

		public static function getCount()
		{
			$search_model = new StatUnlocksSearch();
			$lockers_range = $search_model->getAllLockers();

			return StatUnlocks::find()->where([
				'locker_id' => $lockers_range
			])->count();
		}
	}
