<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $fullname
 * @property string $created_at
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fullname'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['fullname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ชื่อผู้ใช้งาน',
            'fullname' => 'ชื่อเต็ม',
            'created_at' => 'สร้างเมื่อ',
        ];
    }
}
