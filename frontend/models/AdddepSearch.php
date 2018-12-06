<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Adddep;

/**
 * AdddepSearch represents the model behind the search form about `frontend\models\Adddep`.
 */
class AdddepSearch extends Adddep
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ADDDEP_ID'], 'integer'],
            [['DEP_NAME'], 'safe'],
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
        $query = Adddep::find();

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
            'ADDDEP_ID' => $this->ADDDEP_ID,
        ]);

        $query->andFilterWhere(['like', 'DEP_NAME', $this->DEP_NAME]);

        return $dataProvider;
    }
}
