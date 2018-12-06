<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specificclinic".
 *
 * @property integer $SPECIFIC_ID
 * @property string $SPECIFIC_CLINICAL
 * @property integer $DISEASE_ID
 * @property integer $CLINICTYPE_ID
 */
class Specificclinic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specificclinic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SPECIFIC_ID'], 'required'],
            [['SPECIFIC_ID', 'DISEASE_ID', 'CLINICTYPE_ID'], 'integer'],
            [['SPECIFIC_CLINICAL'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SPECIFIC_ID' => 'Specific  ID',
            'SPECIFIC_CLINICAL' => 'Specific  Clinical',
            'DISEASE_ID' => 'Disease  ID',
            'CLINICTYPE_ID' => 'Clinictype  ID',
        ];
    }
}
