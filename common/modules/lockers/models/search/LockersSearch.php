<?php

	namespace common\modules\lockers\models\search;

	use Yii;
	use yii\base\Model;
	use yii\data\ActiveDataProvider;
	use common\modules\lockers\models\lockers\Lockers;

	class LockersSearch extends Lockers {

		public function rules()
		{
			return [
				[['id', 'status', 'createdAt', 'updatedAt'], 'integer'],
				[['name', 'title', 'description'], 'string']

			];
		}

		public function scenarios()
		{
			// bypass scenarios() implementation in the parent class
			return Model::scenarios();
		}

		public function search($params, $status = 'public')
		{

			$query = Lockers::find()->where([
				'user_id' => Yii::$app->user->getId(),
				'site_id' => Yii::$app->userSites->getSelectedId(),
				'status' => $status
			]);

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			if( !($this->load($params) && $this->validate()) ) {
				return $dataProvider;
			}

			//print_r($query);

			/*$query->andFilterWhere([
				'id' => $this->id,
				'status' => $this->status,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
				'logged_at' => $this->logged_at
			]);

			$query->andFilterWhere(['like', 'username', $this->username])
				->andFilterWhere(['like', 'auth_key', $this->auth_key])
				->andFilterWhere(['like', 'password_hash', $this->password_hash])
				->andFilterWhere(['like', 'email', $this->email]);*/

			return $dataProvider;
		}

		public function getCount($status = 'public')
		{
			return Lockers::find()->where([
				'user_id' => Yii::$app->user->getId(),
				'site_id' => Yii::$app->userSites->getSelectedId(),
				'status' => $status
			])->count();
		}
	}
