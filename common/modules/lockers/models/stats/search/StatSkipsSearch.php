<?php
	namespace common\modules\lockers\models\stats\search;

	use Yii;
	use yii\web\NotFoundHttpException;
	use common\modules\lockers\models\stats\StatSkips;
	use common\modules\lockers\models\stats\search\StatAbstractSearch;

	class StatSkipsSearch extends StatAbstractSearch {

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

			$rangeStartStr = gmdate("Y-m-d", $this->date_start);
			$rangeEndStr = gmdate("Y-m-d", $this->date_end);

			$models = StatSkips::find()
				->select('channel_name as metric_name, aggregate_date as order_date, SUM(skips) AS metric_value')
				->from('lockers_stat_skips')
				->where($query_first_part . " and (aggregate_date BETWEEN '" . $rangeStartStr . "' AND '" . $rangeEndStr . "')")
				->groupBy(['order_date', 'channel_name'])
				->all();

			return $models;
		}

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

			$rangeStartStr = gmdate("Y-m-d", $this->date_start);
			$rangeEndStr = gmdate("Y-m-d", $this->date_end);

			$models = StatSkips::find()
				->select('channel_name as metric_name, page_title, page_url_hash, page_url, SUM(skips) AS metric_value')
				->from('lockers_stat_skips')
				->where($query_first_part . " and (aggregate_date BETWEEN '" . $rangeStartStr . "' AND '" . $rangeEndStr . "')")
				->groupBy(['page_url_hash', 'channel_name'])
				->all();

			return $models;
		}
	}
