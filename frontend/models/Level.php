<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property integer $LEVEL_ID
 * @property integer $CLINICTYPE_ID
 * @property string $LEVEL_NAME
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVEL_ID'], 'required'],
            [['LEVEL_ID', 'CLINICTYPE_ID'], 'integer'],
            [['LEVEL_NAME'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LEVEL_ID' => 'Level  ID',
            'CLINICTYPE_ID' => 'Clinictype  ID',
            'LEVEL_NAME' => 'Level  Name',
        ];
    }
}
