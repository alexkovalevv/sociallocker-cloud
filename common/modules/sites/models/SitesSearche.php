<?php

	namespace common\modules\sites\models;

	use Yii;
	use yii\base\Model;
	use yii\data\ActiveDataProvider;
	use common\modules\sites\models\Sites;

	/**
	 * SitesSearche represents the model behind the search form about `\common\modules\sites\models\Sites`.
	 */
	class SitesSearche extends Sites {

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['id', 'user_id', 'approve', 'selected', 'created_at', 'updated_at'], 'integer'],
				[['url', 'status'], 'safe'],
			];
		}

		/**
		 * @inheritdoc
		 */
		public function scenarios()
		{
			// bypass scenarios() implementation in the parent class
			return Model::scenarios();
		}

		/**
		 * Creates data provider instance with search query applied
		 *
		 * @param array $params
		 *
		 * @return ActiveDataProvider
		 */
		public function search($params)
		{
			$query = Sites::find();

			// add conditions that should always apply here

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			$this->load($params);

			if( !$this->validate() ) {
				// uncomment the following line if you do not want to return any records when validation fails
				// $query->where('0=1');
				return $dataProvider;
			}

			// grid filtering conditions
			$query->andFilterWhere([
				'id' => $this->id,
				'user_id' => $this->user_id,
				'selected' => $this->selected,
				'approve' => $this->approve,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

			$query->andFilterWhere(['like', 'url', $this->url])->andFilterWhere(['like', 'status', $this->status]);

			return $dataProvider;
		}
	}
