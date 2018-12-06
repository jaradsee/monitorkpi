<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $RESULT_ID
 * @property string $RESULT_NAME
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESULT_ID'], 'required'],
            [['RESULT_ID'], 'integer'],
            [['RESULT_NAME'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RESULT_ID' => 'Result  ID',
            'RESULT_NAME' => 'Result  Name',
        ];
    }
}
