<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "grouptest".
 *
 * @property int $GROUP_ID
 * @property string $GROUP_NAME
 */
class Grouptest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grouptest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_ID'], 'required'],
            [['GROUP_ID'], 'integer'],
            [['GROUP_NAME'], 'string', 'max' => 200],
            [['GROUP_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GROUP_ID' => 'Group  ID',
            'GROUP_NAME' => 'Group  Name',
        ];
    }
}
