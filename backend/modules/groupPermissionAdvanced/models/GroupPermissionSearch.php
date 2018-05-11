<?php

namespace backend\modules\groupPermissionAdvanced\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\groupPermissionAdvanced\models\GroupPermission;

/**
 * GroupPermissionSearch represents the model behind the search form about `backend\modules\groupPermissionAdvanced\models\GroupPermission`.
 */
class GroupPermissionSearch extends GroupPermission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GROUP_ID', 'MODULE_ID', 'CREATE_DATE', 'CREATE_BY', 'UPDATE_DATE', 'UPDATE_BY', 'STATUS'], 'integer'],
            [['ALL_RIGHT','LIST_RIGHT', 'VIEW_RIGHT', 'ADD_RIGHT', 'EDIT_RIGHT', 'DEL_RIGHT', 'UP_RIGHT', 'DOWN_RIGHT'], 'boolean'],
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
        $query = GroupPermission::find();

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
            'ID'          => $this->ID,
            'GROUP_ID'    => $this->GROUP_ID,
            'MODULE_ID'   => $this->MODULE_ID,
            'ALL_RIGHT'   => $this->ALL_RIGHT,
            'LIST_RIGHT'  => $this->LIST_RIGHT,
            'VIEW_RIGHT'  => $this->VIEW_RIGHT,
            'ADD_RIGHT'   => $this->ADD_RIGHT,
            'EDIT_RIGHT'  => $this->EDIT_RIGHT,
            'DEL_RIGHT'   => $this->DEL_RIGHT,
            'UP_RIGHT'    => $this->UP_RIGHT,
            'DOWN_RIGHT'  => $this->DOWN_RIGHT,
            'CREATE_DATE' => $this->CREATE_DATE,
            'CREATE_BY'   => $this->CREATE_BY,
            'UPDATE_DATE' => $this->UPDATE_DATE,
            'UPDATE_BY'   => $this->UPDATE_BY,
            'STATUS'      => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION]);

        return $dataProvider;
    }
}
