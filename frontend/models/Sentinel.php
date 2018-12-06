<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sentinel".
 *
 * @property integer $ID_SEN
 * @property string $SENTI_NAME
 */
class Sentinel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sentinel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_SEN'], 'required'],
            [['ID_SEN'], 'integer'],
            [['SENTI_NAME'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_SEN' => 'Id  Sen',
            'SENTI_NAME' => 'Senti  Name',
        ];
    }
}
