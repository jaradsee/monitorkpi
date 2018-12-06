<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Reviwerisk;

/**
 * ReviweriskSearch represents the model behind the search form about `frontend\models\Reviwerisk`.
 */
class ReviweriskSearch extends Reviwerisk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reviwerisk_id', 'input_complain', 'risk_simple', 'sentinel'], 'integer'],
            [['reviwerisk_date', 'reviwe_detial', 'ref', 'date_recive', 'time_recive', 'risk_ref_no', 'risk_time', 'safety', 'sum_solve', 'risk_status', 'program_text', 'login_name', 'risk_sum_dep', 'date_input', 'last_update', 'staff', 'last_staff', 'print_url', 'dep_risk_head', 'covenant', 'docs'], 'safe'],
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
        $query = Reviwerisk::find();

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
            'reviwerisk_id' => $this->reviwerisk_id,
            'reviwerisk_date' => $this->reviwerisk_date,
            'date_recive' => $this->date_recive,
            'time_recive' => $this->time_recive,
            'input_complain' => $this->input_complain,
            'risk_simple' => $this->risk_simple,
            'date_input' => $this->date_input,
            'last_update' => $this->last_update,
            'sentinel' => $this->sentinel,
        ]);

        $query->andFilterWhere(['like', 'reviwe_detial', $this->reviwe_detial])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'risk_ref_no', $this->risk_ref_no])
            ->andFilterWhere(['like', 'risk_time', $this->risk_time])
            ->andFilterWhere(['like', 'safety', $this->safety])
            ->andFilterWhere(['like', 'sum_solve', $this->sum_solve])
            ->andFilterWhere(['like', 'risk_status', $this->risk_status])
            ->andFilterWhere(['like', 'program_text', $this->program_text])
            ->andFilterWhere(['like', 'login_name', $this->login_name])
            ->andFilterWhere(['like', 'risk_sum_dep', $this->risk_sum_dep])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'last_staff', $this->last_staff])
            ->andFilterWhere(['like', 'print_url', $this->print_url])
            ->andFilterWhere(['like', 'dep_risk_head', $this->dep_risk_head])
            ->andFilterWhere(['like', 'covenant', $this->covenant])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        return $dataProvider;
    }
}
