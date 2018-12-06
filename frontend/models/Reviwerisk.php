<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reviwerisk".
 *
 * @property string $reviwerisk_id
 * @property string $reviwerisk_date
 * @property string $reviwe_detial
 * @property string $ref
 * @property string $date_recive
 * @property string $time_recive
 * @property string $risk_ref_no
 * @property integer $input_complain
 * @property string $risk_time
 * @property string $safety
 * @property string $sum_solve
 * @property string $risk_status
 * @property string $program_text
 * @property string $login_name
 * @property string $risk_sum_dep
 * @property integer $risk_simple
 * @property string $date_input
 * @property string $last_update
 * @property string $staff
 * @property string $last_staff
 * @property string $print_url
 * @property string $dep_risk_head
 * @property integer $sentinel
 * @property string $covenant
 * @property string $docs
 */
class Reviwerisk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviwerisk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reviwerisk_date', 'reviwe_detial'], 'required'],
            [['reviwerisk_date', 'date_recive', 'time_recive', 'date_input', 'last_update'], 'safe'],
            [['input_complain', 'risk_simple', 'sentinel'], 'integer'],
            [['reviwe_detial', 'safety', 'sum_solve', 'program_text', 'risk_sum_dep'], 'string', 'max' => 200],
            [['ref', 'covenant', 'docs'], 'string', 'max' => 50],
            [['risk_ref_no', 'login_name', 'staff', 'last_staff', 'print_url'], 'string', 'max' => 100],
            [['risk_time'], 'string', 'max' => 6],
            [['risk_status'], 'string', 'max' => 1],
            [['dep_risk_head'], 'string', 'max' => 255],
            [['ref'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reviwerisk_id' => 'Reviwerisk ID',
            'reviwerisk_date' => 'Reviwerisk Date',
            'reviwe_detial' => 'Reviwe Detial',
            'ref' => 'Ref',
            'date_recive' => 'Date Recive',
            'time_recive' => 'Time Recive',
            'risk_ref_no' => 'Risk Ref No',
            'input_complain' => 'Input Complain',
            'risk_time' => 'Risk Time',
            'safety' => 'Safety',
            'sum_solve' => 'Sum Solve',
            'risk_status' => 'Risk Status',
            'program_text' => 'Program Text',
            'login_name' => 'Login Name',
            'risk_sum_dep' => 'Risk Sum Dep',
            'risk_simple' => 'Risk Simple',
            'date_input' => 'Date Input',
            'last_update' => 'Last Update',
            'staff' => 'Staff',
            'last_staff' => 'Last Staff',
            'print_url' => 'Print Url',
            'dep_risk_head' => 'Dep Risk Head',
            'sentinel' => 'Sentinel',
            'covenant' => 'Covenant',
            'docs' => 'Docs',
        ];
    }
}
