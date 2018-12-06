<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dispecific".
 *
 * @property integer $DISEASE_ID
 * @property string $DISEASE_NAME
 * @property integer $CLINICTYPE_ID
 */
class Dispecific extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispecific';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISEASE_ID'], 'required'],
            [['DISEASE_ID', 'CLINICTYPE_ID'], 'integer'],
            [['DISEASE_NAME'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DISEASE_ID' => 'Disease  ID',
            'DISEASE_NAME' => 'Disease  Name',
            'CLINICTYPE_ID' => 'Clinictype  ID',
        ];
    }
}
