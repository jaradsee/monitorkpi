<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rerisk;

/**
 * ReriskSearh represents the model behind the search form about `app\models\Rerisk`.
 */
class ReriskSearh extends Rerisk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['risk_id', 'input_complain', 'risk_simple', 'sentinel'], 'integer'],
            [['rerisk_date', 'reviwrisk', 'ref', 'date_recive', 'time_recive', 'risk_time', 'safety', 'sum_solve', 'risk_level', 'risk_status', 'program_text', 'login_name', 'risk_sum_dep', 'date_input', 'last_update', 'staff', 'last_staff', 'dep_risk_head', 'covenant', 'docs'], 'safe'],
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
        $query = Rerisk::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'risk_id' => $this->risk_id,
            'rerisk_date' => $this->rerisk_date,
            'date_recive' => $this->date_recive,
            'time_recive' => $this->time_recive,
            'input_complain' => $this->input_complain,
            'risk_simple' => $this->risk_simple,
            'date_input' => $this->date_input,
            'last_update' => $this->last_update,
            'sentinel' => $this->sentinel,
        ]);

        $query->andFilterWhere(['like', 'reviwrisk', $this->reviwrisk])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'risk_time', $this->risk_time])
            ->andFilterWhere(['like', 'safety', $this->safety])
            ->andFilterWhere(['like', 'sum_solve', $this->sum_solve])
            ->andFilterWhere(['like', 'risk_level', $this->risk_level])
            ->andFilterWhere(['like', 'risk_status', $this->risk_status])
            ->andFilterWhere(['like', 'program_text', $this->program_text])
            ->andFilterWhere(['like', 'login_name', $this->login_name])
            ->andFilterWhere(['like', 'risk_sum_dep', $this->risk_sum_dep])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'last_staff', $this->last_staff])
            ->andFilterWhere(['like', 'dep_risk_head', $this->dep_risk_head])
            ->andFilterWhere(['like', 'covenant', $this->covenant])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        return $dataProvider;
    }
}
