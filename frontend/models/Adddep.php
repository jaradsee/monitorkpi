<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "adddep".
 *
 * @property integer $ADDDEP_ID
 * @property string $DEP_NAME
 */
class Adddep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adddep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEP_NAME'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ADDDEP_ID' => 'Adddep  ID',
            'DEP_NAME' => 'Dep  Name',
        ];
    }
}
