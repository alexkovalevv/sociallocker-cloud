<?php
	namespace common\modules\lockers\models\stats\search;

	use Yii;
	use yii\base\Model;
	use yii\data\ActiveDataProvider;
	use yii\helpers\ArrayHelper;
	use common\modules\lockers\models\stats\StatImpress;
	use yii\web\NotFoundHttpException;

	class StatImpressSearch extends StatAbstractSearch {

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

			$models = StatImpress::find()
				->select('aggregate_date as order_date, SUM(impress) AS metric_value')
				->from('lockers_stat_impress')
				->where($query_first_part . " and (aggregate_date BETWEEN '" . $rangeStartStr . "' AND '" . $rangeEndStr . "')")
				->groupBy(['order_date'])
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

			$models = StatImpress::find()
				->select('page_title, page_url_hash, page_url, SUM(impress) AS metric_value')
				->from('lockers_stat_impress')
				->where($query_first_part . " and (aggregate_date BETWEEN '" . $rangeStartStr . "' AND '" . $rangeEndStr . "')")
				->groupBy(['page_url_hash'])
				->all();

			return $models;
		}
	}
