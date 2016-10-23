<?php
	/**
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\modules\lockers\advanced\stats;

	class StatsTable {

		public $orderBy = 'unlock';

		public function __construct($screen, $data)
		{
			$this->screen = $screen;
			$this->data = $data;

			usort($data['data'], [$this, '_usort']);
			$this->data['data'] = array_reverse($data['data']);
		}

		public function _usort($a, $b)
		{
			$orderBy = $this->orderBy;

			if( !isset($a[$orderBy]) && !isset($b[$orderBy]) ) {
				return 0;
			}
			if( !isset($a[$orderBy]) ) {
				return -1;
			}
			if( !isset($b[$orderBy]) ) {
				return 1;
			}

			if( $a[$orderBy] == $b[$orderBy] ) {
				return 0;
			}

			return ($a[$orderBy] < $b[$orderBy])
				? -1
				: 1;
		}

		public function getColumns()
		{
			return [];
		}

		public function getHeaderColumns($level = 1)
		{

			$columns = $this->getColumns();

			if( 2 === $level ) {

				$result = [];
				foreach($columns as $column) {
					if( !isset($column['columns']) ) {
						continue;
					}
					$result = array_merge($result, $column['columns']);
				}

				return $result;
			} else {

				foreach($columns as $n => $column) {
					$columns[$n]['rowspan'] = isset($column['columns'])
						? 1
						: 2;
					$columns[$n]['colspan'] = isset($column['columns'])
						? count($column['columns'])
						: 1;
				}

				return $columns;
			}
		}

		public function hasComplexColumns()
		{
			$columns = $this->getHeaderColumns(2);

			return !empty($columns);
		}

		public function getDataColumns()
		{
			$result = [];

			foreach($this->getColumns() as $name => $column) {

				if( isset($column['columns']) ) {
					$result = array_merge($result, $column['columns']);
				} else {
					$result[$name] = $column;
				}
			}

			return $result;
		}

		public function getColumnsCount()
		{
			return count($this->getColumns());
		}

		public function getRowsCount()
		{
			return count($this->data['data']);
		}

		public function printValue($rowIndex, $columnName, $column)
		{

			$camelCase = str_replace('-', ' ', $columnName);
			$camelCase = str_replace('_', ' ', $camelCase);
			$camelCase = str_replace(' ', '', ucwords($camelCase));

			$camelCase[0] = strtoupper($camelCase[0]);

			if( method_exists($this, 'column' . $camelCase) ) {
				call_user_func([$this, 'column' . $camelCase], $this->data['data'][$rowIndex], $rowIndex);
			} else {
				$value = isset($this->data['data'][$rowIndex][$columnName])
					? $this->data['data'][$rowIndex][$columnName]
					: 0;
				if( isset($column['prefix']) && $value !== 0 ) {
					echo $column['prefix'];
				}
				echo $value;
			}
		}

		public function columnIndex($row, $rowIndex)
		{
			echo $rowIndex + 1;
		}

		public function columnTitle($row)
		{
			$title = !empty($row['title'])
				? $row['title']
				: '<i>(untitled post)</i>';

			if( !empty($row['id']) ) {
				echo '<a href="#" target="_blank">' . $title . ' </a>';
			} else {
				echo $title;
			}
		}

		public function columnConversion($row)
		{
			if( !isset($row['impress']) ) {
				$row['impress'] = 0;
			}
			if( !isset($row['unlock']) ) {
				$row['unlock'] = 0;
			}

			if( $row['impress'] == 0 ) {
				echo '0%';

				return;
			}
			if( $row['unlock'] > $row['impress'] ) {
				echo '100%';

				return;
			}

			echo (ceil($row['unlock'] / $row['impress'] * 10000) / 100) . '%';
		}
	}