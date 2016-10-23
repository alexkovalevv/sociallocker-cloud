<?php
	/**
	 * Агрегация статистики
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats;

	use common\modules\lockers\models\stats\search\StatAbstractSearch;
	use common\modules\lockers\models\stats\search\StatActionsSearch;
	use common\modules\lockers\models\stats\search\StatSkipsSearch;
	use common\modules\lockers\models\stats\StatActions;
	use common\modules\lockers\models\stats\StatSkips;
	use Yii;
	use common\modules\lockers\models\stats\search\StatUnlocksSearch;
	use common\modules\lockers\models\stats\search\StatImpressSearch;
	use yii\base\InvalidConfigException;

	class Stats {

		private $_metrics_data = [];
		private $_metrics_name = ['unlock', 'impress', 'skip'];

		private $_date_start;
		private $_date_end;
		
		protected $params;

		public function __construct($options)
		{
			$this->params = $options;

			$this->_date_start = isset($options['date_start'])
				? $options['date_start']
				: null;
			$this->_date_end = isset($options['date_end'])
				? $options['date_end']
				: null;
		}

		public function getChartData()
		{
			$this->_metrics_data = [];

			// Unlocks
			$this->setChartMetrics(new StatUnlocksSearch(), 'unlock');
			// Impress
			$this->setChartMetrics(new StatImpressSearch(), 'impress');
			// Skip
			$this->setChartMetrics(new StatSkipsSearch(), 'skip');
			// Got
			$this->setChartMetrics(new StatActionsSearch(), 'got');

			// normalizing data by adding zero value for skipped dates
			$resultData = [];

			while( $this->_date_start <= $this->_date_end ) {

				$phpdate = getdate($this->_date_start);
				$resultData[$this->_date_start] = [];

				$resultData[$this->_date_start]['day'] = $phpdate['mday'];
				$resultData[$this->_date_start]['mon'] = $phpdate['mon'];
				$resultData[$this->_date_start]['year'] = $phpdate['year'];
				$resultData[$this->_date_start]['timestamp'] = $this->_date_start;

				foreach($this->_metrics_name as $metric_name) {

					if( !isset($this->_metrics_data[$this->_date_start][$metric_name]) ) {
						$resultData[$this->_date_start][$metric_name] = 0;
					} else {
						$resultData[$this->_date_start][$metric_name] = $this->_metrics_data[$this->_date_start][$metric_name];
					}
				}

				$this->_date_start = strtotime("+1 days", $this->_date_start);
			}

			/*@mix:place*/

			return $resultData;
		}

		public function setChartMetrics(StatAbstractSearch $class, $event_name = null)
		{
			$models = $class->chartSearch($this->params);

			if( empty($models) ) {
				return $this->_metrics_data;
			}

			foreach($models as $model) {
				$metric_value = $model->metric_value;
				$timestamp = strtotime($model->order_date);

				if( property_exists($model, 'metric_name') && !empty($model->metric_name) ) {
					$metric_name = $event_name . '-via-' . $model->metric_name;

					if( !in_array($metric_name, $this->_metrics_name) ) {
						$this->_metrics_name[] = $metric_name;
					}

					$this->_metrics_data[$timestamp][$metric_name] = $metric_value;

					$this->_metrics_data[$timestamp][$event_name] = isset($this->_metrics_data[$timestamp][$event_name])
						? $this->_metrics_data[$timestamp][$event_name] + $metric_value
						: $metric_value;
				} else {
					$this->_metrics_data[$timestamp][$event_name] = $metric_value;
				}
			}
		}

		public function getViewTable()
		{
			$this->_metrics_data = [];

			// Unlocks
			$this->setTableMetrics(new StatUnlocksSearch(), 'unlock');
			// Impress
			$this->setTableMetrics(new StatImpressSearch(), 'impress');
			// Skip
			$this->setTableMetrics(new StatSkipsSearch(), 'skip');
			// Got
			$this->setTableMetrics(new StatActionsSearch(), 'got');

			$returnData = [];

			foreach($this->_metrics_data as $row) {
				$returnData[] = $row;
			}

			return [
				'data' => $returnData,
				'count' => sizeof($returnData)
			];
		}

		public function setTableMetrics(StatAbstractSearch $class, $event_name = null)
		{

			$models = $class->tableSearch($this->params);

			if( empty($models) ) {
				return $this->_metrics_data;
			}

			foreach($models as $model) {
				$metric_value = $model->metric_value;

				if( property_exists($model, 'metric_name') && !empty($model->metric_name) ) {
					$metric_name = $event_name . '-via-' . $model->metric_name;

					if( !in_array($metric_name, $this->_metrics_name) ) {
						$this->_metrics_name[] = $metric_name;
					}

					$title = $model->page_title;
					if( empty($title) ) {
						$title = 'Страница не найдена или не имеет заголовка';
					}

					$this->_metrics_data[$model->page_url_hash]['id'] = $model->page_url_hash;
					$this->_metrics_data[$model->page_url_hash]['title'] = $title;

					$this->_metrics_data[$model->page_url_hash][$metric_name] = $metric_value;

					$this->_metrics_data[$model->page_url_hash][$event_name] = isset($this->_metrics_data[$model->page_url_hash][$event_name])
						? $this->_metrics_data[$model->page_url_hash][$event_name] + $metric_value
						: $metric_value;
				} else {
					$this->_metrics_data[$model->page_url_hash][$event_name] = $metric_value;
				}
			}
		}
	}