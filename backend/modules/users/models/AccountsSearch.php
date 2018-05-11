<?php

namespace backend\modules\users\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\users\models\Accounts;

/**
 * AccountsSearch represents the model behind the search form about `backend\modules\Users\models\Accounts`.
 */
class AccountsSearch extends Accounts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACC_ID', 'PARENT_ID', 'CREATE_DATE', 'UPDATE_DATE', 'USER_TYPE', 'STATUS'], 'integer'],
            [['USERNAME', 'PASSWORD', 'PASSWORD_RESET_TOKEN', 'AUTH_KEY', 'CP_CODE', 'FULL_NAME', 'DESCRIPTION', 'ADDRESS', 'PHONE', 'EMAIL', 'CREATE_BY', 'UPDATE_BY', 'OPTION_DATA'], 'safe'],
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
       //echo $userID     =  Yii::$app->user->identity->USER_TYPE;
        $query = Accounts::find()->where(['<>','STATUS', 2]);

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
            'ACC_ID'      => $this->ACC_ID,
            'PARENT_ID'   => $this->PARENT_ID,
            'CREATE_DATE' => $this->CREATE_DATE,
            'UPDATE_DATE' => $this->UPDATE_DATE,
            'USER_TYPE'   => $this->USER_TYPE,
            'STATUS'      => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'USERNAME', $this->USERNAME])
            ->andFilterWhere(['like', 'PASSWORD', $this->PASSWORD])
            ->andFilterWhere(['like', 'PASSWORD_RESET_TOKEN', $this->PASSWORD_RESET_TOKEN])
            ->andFilterWhere(['like', 'AUTH_KEY', $this->AUTH_KEY])
            ->andFilterWhere(['like', 'CP_CODE', $this->CP_CODE])
            ->andFilterWhere(['like', 'FULL_NAME', $this->FULL_NAME])
            ->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'OPTION_DATA', $this->OPTION_DATA]);

        return $dataProvider;
    }
}
