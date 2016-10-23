<?php

	namespace common\modules\subscription\backend\models;

	use Yii;
	use yii\data\ActiveDataProvider;

	class LeadsSearch extends LeadsRecord {

		public function rules()
		{
			return [];
		}

		public function search($params)
		{
			$leads_model = LeadsRecord::create();
			$query = $leads_model->setQuery();

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			return $dataProvider;
		}

		/*public static function getCountByStatus($user_id, $site_id)
		{
			if( empty($user_id) ) {
				return null;
			}

			$conditions = ['user_id' => $user_id];

			if( !empty($site_id) ) {
				$conditions['site_id'] = $site_id;
			}

			$rows = Leads::find()
				->select(['COUNT(*) as status_count, email_confirmed'])
				->where($conditions)
				->groupBy(['email_confirmed'])
				->asArray()
				->all();

			$result = [];

			foreach($rows as $row) {
				$status = $row['email_confirmed'] == 1
					? 'confirmed'
					: 'not-confirmed';
				$result[$status] = intval($row['status_count']);
			}

			if( !isset($result['confirmed']) ) {
				$result['confirmed'] = 0;
			}
			if( !isset($result['not-confirmed']) ) {
				$result['not-confirmed'] = 0;
			}

			return $result;
		}*/

		/**
		 * Получает общее число лидов
		 * @param $user_id
		 * @param $site_id
		 * @return int|null
		 */
		public static function getCount()
		{
			$leads_model = LeadsRecord::create();

			return $leads_model->setQuery()->count();
		}
	}
