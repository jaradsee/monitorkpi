<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Priskhead;

/**
 * Priskheadearch represents the model behind the search form about `app\models\Priskhead`.
 */
class PriskheadSearch extends Priskhead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['risk_id', 'input_complain','department','headmaster','clinictype','risk_level','risk_status','result'], 'integer'],
            [['risk_date', 'event_name', 'ref', 'risk_again', 'date_report', 'risk_ref_no'], 'safe'],
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
        $query = Priskhead::find();

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
            'risk_date' => $this->risk_date,
            'date_report' => $this->date_report,
            'input_complain' => $this->input_complain,
            'department' => $this->department,
            'headmaster' => $this->headmaster,
            'clinictype' => $this->clinictype,
            'risk_level' => $this->risk_level,
            'risk_status' => $this->risk_status,
            'result' => $this->result,
        ]);

        $query->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'risk_again', $this->risk_again])
            ->andFilterWhere(['like', 'risk_ref_no', $this->risk_ref_no])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'headmaster', $this->headmaster])
            ->andFilterWhere(['like', 'clinictype', $this->clinictype])
            ->andFilterWhere(['like', 'risk_level', $this->risk_level])
            ->andFilterWhere(['like', 'risk_status', $this->risk_status])
            ->andFilterWhere(['like', 'result', $this->result]);

        return $dataProvider;
    }
}
