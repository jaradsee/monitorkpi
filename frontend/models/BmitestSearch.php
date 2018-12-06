<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Bmitest;

/**
 * BmitestSearch represents the model behind the search form of `frontend\models\Bmitest`.
 */
class BmitestSearch extends Bmitest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gradebmi', 'gradewaistline', 'sex', 'bpsys', 'bpdi', 'gradebpsys', 'gradebpdi', 'age', 'pushup', 'gradepushup', 'situp', 'heartrate', 'gripst', 'flexibility', 'legpress', 'run2400'], 'integer'],
            [['weight', 'height', 'bmi', 'waistline', 'cid'], 'number'],
            [['dateserv'], 'safe'],
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
        $query = Bmitest::find();

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
            'weight' => $this->weight,
            'height' => $this->height,
            'bmi' => $this->bmi,
            'gradebmi' => $this->gradebmi,
            'waistline' => $this->waistline,
            'gradewaistline' => $this->gradewaistline,
            'sex' => $this->sex,
            'bpsys' => $this->bpsys,
            'bpdi' => $this->bpdi,
            'gradebpsys' => $this->gradebpsys,
            'gradebpdi' => $this->gradebpdi,
            'cid' => $this->cid,
            'age' => $this->age,
            'dateserv' => $this->dateserv,
            'pushup' => $this->pushup,
            'gradepushup' => $this->gradepushup,
            'situp' => $this->situp,
            'heartrate' => $this->heartrate,
            'gripst' => $this->gripst,
            'flexibility' => $this->flexibility,
            'legpress' => $this->legpress,
            'run2400' => $this->run2400,
        ]);

        return $dataProvider;
    }
}
