<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "line_bot".
 *
 * @property integer $id
 * @property string $type
 * @property integer $last_id
 */
class LineBot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'line_bot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_id'], 'integer'],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'last_id' => 'Last ID',
        ];
    }
}
