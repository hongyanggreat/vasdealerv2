<?php

namespace backend\modules\groupAccount\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\groupAccount\models\GroupAccount;

/**
 * GroupAccountSearch represents the model behind the search form about `backend\modules\groupAccount\models\GroupAccount`.
 */
class GroupAccountSearch extends GroupAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_ID', 'STATUS'], 'integer'],
            [['NAME','MODULE_ID', 'DESCRIPTION', 'CREATE_DATE', 'CREATE_BY', 'UPDATE_DATE', 'UPDATE_BY'], 'safe'],
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
        $query = GroupAccount::find();

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
            'GROUP_ID' => $this->GROUP_ID,
            'CREATE_DATE' => $this->CREATE_DATE,
            'UPDATE_DATE' => $this->UPDATE_DATE,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION])
            ->andFilterWhere(['like', 'MODULE_ID', $this->MODULE_ID])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
