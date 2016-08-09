<?php

namespace common\modules\subscription\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\subscription\models\Leads;

/**
 * LeadsSearch represents the model behind the search form about `\common\modules\subscription\models\Leads`.
 */
class LeadsSearch extends Leads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'lead_email_confirmed', 'lead_subscription_confirmed', 'lead_item_id'], 'integer'],
            [['user_id', 'lead_display_name', 'lead_name', 'lead_family', 'lead_email', 'lead_item_title', 'lead_referer', 'lead_confirmation_code', 'lead_temp'], 'safe'],
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
        $query = Leads::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'lead_email_confirmed' => $this->lead_email_confirmed,
            'lead_subscription_confirmed' => $this->lead_subscription_confirmed,
            'lead_item_id' => $this->lead_item_id,
        ]);

        $query->andFilterWhere(['like', 'lead_display_name', $this->lead_display_name])
            ->andFilterWhere(['like', 'lead_name', $this->lead_name])
            ->andFilterWhere(['like', 'lead_family', $this->lead_family])
            ->andFilterWhere(['like', 'lead_email', $this->lead_email])
            ->andFilterWhere(['like', 'lead_item_title', $this->lead_item_title])
            ->andFilterWhere(['like', 'lead_referer', $this->lead_referer])
            ->andFilterWhere(['like', 'lead_confirmation_code', $this->lead_confirmation_code])
            ->andFilterWhere(['like', 'lead_temp', $this->lead_temp]);

        return $dataProvider;
    }
}
