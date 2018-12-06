<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sex".
 *
 * @property int $ID_SEX
 * @property string $SEX
 * @property int $SEX_NO
 */
class Sex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_SEX'], 'required'],
            [['ID_SEX', 'SEX_NO'], 'integer'],
            [['SEX'], 'string', 'max' => 50],
            [['ID_SEX'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_SEX' => 'Id  Sex',
            'SEX' => 'Sex',
            'SEX_NO' => 'Sex  No',
        ];
    }
}
