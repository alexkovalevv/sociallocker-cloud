<?php

namespace common\modules\lockers\models\search;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\lockers\models\visability\LockersVisability;


class VisabilitySearch extends LockersVisability
{
    public function rules()
    {
        return [];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $status = 'public')
    {
        $query = LockersVisability::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
