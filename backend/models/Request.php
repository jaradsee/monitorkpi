<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property integer $phone
 * @property string $email
 * @property string $request
 * @property integer $cid
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'phone', 'email', 'request', 'cid'], 'required'],
            [['phone', 'cid'], 'integer'],
            [['fname', 'lname', 'email'], 'string', 'max' => 200],
            [['request'], 'string', 'max' => 1500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'phone' => 'เอบร์โทรศัพท์',
            'email' => 'e-mail address',
            'request' => 'Request',
            'cid' => 'เลขบัตรประชาชน',
        ];
    }
}
