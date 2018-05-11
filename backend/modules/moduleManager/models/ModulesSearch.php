<?php

namespace backend\modules\moduleManager\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\moduleManager\models\Modules;

/**
 * ModulesSearch represents the model behind the search form about `backend\modules\moduleManager\models\Modules`.
 */
class ModulesSearch extends Modules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MODULE_ID', 'CREATE_DATE', 'CREATE_BY', 'UPDATE_DATE', 'UPDATE_BY', 'TYPE', 'STATUS'], 'integer'],
            [['RESOURCE', 'NAME', 'DESCRIPTION'], 'safe'],
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

        $roleList = Yii::$app->acl->roleList();
        $userID = 0;
        $query = Modules::find();
        if(!$roleList){
            if (!Yii::$app->user->isGuest) {
                $userID     =  Yii::$app->user->identity->id;
                $query = $query->where(['CREATE_BY'=>$userID]);
            }
        }


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
            'MODULE_ID' => $this->MODULE_ID,
            'CREATE_DATE' => $this->CREATE_DATE,
            'CREATE_BY' => $this->CREATE_BY,
            'UPDATE_DATE' => $this->UPDATE_DATE,
            'UPDATE_BY' => $this->UPDATE_BY,
            'TYPE' => $this->TYPE,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'RESOURCE', $this->RESOURCE])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION]);

        return $dataProvider;
    }
}
