<?php
	namespace common\modules\lockers\models\stats\search;

	use Yii;
	use common\modules\lockers\models\stats\StatUnlocks;
	use common\modules\lockers\models\stats\StatActions;
	use yii\web\NotFoundHttpException;

	class StatActionsSearch extends StatAbstractSearch {
		
		public function tableSearch($params)
		{
			$this->setAttributes($params);

			if( !$this->validate() ) {
				throw new NotFoundHttpException('Переданы некорректные параметры запроса!');
			}

			$query_first_part = $this->getQueryPartOnLockers($this->locker_id, 'lsu');

			if( empty($query_first_part) ) {
				return null;
			}

			$models = StatActions::find()
				->select('lsu.page_url_hash, lsa.channel_name AS metric_name, COUNT(lsa.id) AS metric_value, lsu.page_title, lsu.page_url, date(from_unixtime(lsu.created_at)) as order_date')
				->from('lockers_stat_unlocks lsu')
				->leftJoin('lockers_stat_actions lsa', 'lsu.id = lsa.unlock_id')
				->where($query_first_part . ' and lsu.created_at >= ' . $this->date_start . ' and lsu.created_at <= ' . $this->date_end)
				->groupBy(['lsu.page_url_hash', 'metric_name'])
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

			$models = StatActions::find()
				->select('channel_name as metric_name, count(*) as metric_value, date(from_unixtime(created_at)) as order_date')
				->from('lockers_stat_actions')
				->where($query_first_part . ' and created_at >= ' . $this->date_start . ' and created_at <= ' . $this->date_end)
				->groupBy(['order_date', 'metric_name'])
				->all();

			return $models;
		}
	}
