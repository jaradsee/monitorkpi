<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "headmaster".
 *
 * @property integer $HEADMASTER_ID
 * @property string $HEADMASTER_NAME
 */
class Headmaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'headmaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HEADMASTER_ID'], 'required'],
            [['HEADMASTER_ID'], 'integer'],
            [['HEADMASTER_NAME'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HEADMASTER_ID' => 'Headmaster  ID',
            'HEADMASTER_NAME' => 'Headmaster  Name',
        ];
    }
}
