<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gradewaistline".
 *
 * @property integer $WAISTLINE_ID
 * @property integer $WAISTLINE_GRADE
 * @property string $WAISTLINE_NAME
 * @property string $WAISTLINE_DETIAL
 */
class Gradewaistline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gradewaistline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WAISTLINE_GRADE'], 'integer'],
            [['WAISTLINE_DETIAL'], 'string'],
            [['WAISTLINE_NAME'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WAISTLINE_ID' => 'Waistline  ID',
            'WAISTLINE_GRADE' => 'Waistline  Grade',
            'WAISTLINE_NAME' => 'Waistline  Name',
            'WAISTLINE_DETIAL' => 'Waistline  Detial',
        ];
    }
}
