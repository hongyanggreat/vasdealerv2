<?php

namespace backend\modules\groupAccountDetail\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\groupAccountDetail\models\GroupAccDetail;

/**
 * GroupAccDetailSearch represents the model behind the search form about `backend\modules\groupAccountDetail\models\GroupAccDetail`.
 */
class GroupAccDetailSearch extends GroupAccDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ACC_ID', 'GROUP_ID', 'CREATE_BY', 'CREATE_DATE', 'UPDATE_BY', 'UPDATE_DATE', 'STATUS'], 'integer'],
            [['DESCRIPTION'], 'safe'],
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
        $query = GroupAccDetail::find();

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
            'ID' => $this->ID,
            'ACC_ID' => $this->ACC_ID,
            'GROUP_ID' => $this->GROUP_ID,
            'CREATE_BY' => $this->CREATE_BY,
            'CREATE_DATE' => $this->CREATE_DATE,
            'UPDATE_BY' => $this->UPDATE_BY,
            'UPDATE_DATE' => $this->UPDATE_DATE,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION]);

        return $dataProvider;
    }
}
