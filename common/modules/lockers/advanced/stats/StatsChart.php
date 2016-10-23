<?php
	/**
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats;

	class StatsChart {

		public $type = 'area';

		public function __construct($screen, $data)
		{
			$this->screen = $screen;
			$this->data = $data;
		}

		public function getFields()
		{
			return [];
		}

		public function getSelectors()
		{
			$fields = $this->getFields();
			unset($fields['aggregate_date']);

			return $fields;
		}

		public function hasSelectors()
		{
			$selectors = $this->getSelectors();

			return !empty($selectors);
		}

		public function getSelectorsNames()
		{
			$selectors = $this->getSelectors();
			if( empty($selectors) ) {
				return [];
			}

			$result = [];
			foreach($selectors as $key => $selector) {
				$result[] = "'" . $key . "'";
			}

			return $result;
		}

		public function printData()
		{
			echo $this->getData();
		}


		public function getData()
		{
			$fields = $this->getFields();
			$output = '';

			foreach($this->data as $rowIndex => $dataRow) {

				$dataToPrint = [];
				foreach($fields as $field => $fieldData) {

					if( 'aggregate_date' == $field ) {

						$dataToPrint['date'] = [
							'value' => 'new Date(' . $dataRow['year'] . ',' . $dataRow['mon'] . ',' . $dataRow['day'] . ')'
						];
					} else {

						$dataToPrint[$field] = [
							'value' => $this->getValue($rowIndex, $field),
							'title' => isset($fieldData['title'])
								? $fieldData['title']
								: '',
							'color' => isset($fieldData['color'])
								? $fieldData['color']
								: null
						];
					}
				}

				$rowDataToPrint = '';
				foreach($dataToPrint as $key => $data) {
					if( !isset($data['title']) ) {
						$data['title'] = '';
					}
					if( !isset($data['color']) ) {
						$data['color'] = '';
					}

					$rowDataToPrint .= "'$key': {'value': {$data['value']}, 'title': '{$data['title']}', 'color': '{$data['color']}'},";
				}

				$rowDataToPrint = rtrim($rowDataToPrint, ',');
				$output .= '{' . $rowDataToPrint . '},';
			}

			return rtrim($output, ',');
		}

		public function getValue($rowIndex, $fieldName)
		{

			$camelCase = str_replace('-', ' ', $fieldName);
			$camelCase = str_replace('_', ' ', $camelCase);
			$camelCase = str_replace(' ', '', ucwords($camelCase));

			$camelCase[0] = strtoupper($camelCase[0]);

			if( method_exists($this, 'field' . $camelCase) ) {
				return call_user_func([$this, 'field' . $camelCase], $this->data[$rowIndex], $rowIndex);
			} else {
				if( isset($this->data[$rowIndex][$fieldName]) ) {
					return $this->data[$rowIndex][$fieldName];
				} else {
					return 0;
				}
			}
		}
	}