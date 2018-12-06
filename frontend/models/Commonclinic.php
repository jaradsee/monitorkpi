<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "commonclinic".
 *
 * @property integer $COMMON_ID
 * @property string $COMMON_CLINICAL
 * @property integer $CLINIC_TYPE_ID
 */
class Commonclinic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commonclinic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COMMON_ID'], 'required'],
            [['COMMON_ID', 'CLINIC_TYPE_ID'], 'integer'],
            [['COMMON_CLINICAL'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COMMON_ID' => 'Common  ID',
            'COMMON_CLINICAL' => 'Common  Clinical',
            'CLINIC_TYPE_ID' => 'Clinic  Type  ID',
        ];
    }
}
