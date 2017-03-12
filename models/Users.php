<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property integer $secondnameid
 * @property integer $patronimicnameid
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $mobilephone
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $lastlogin
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['secondnameid', 'patronimicnameid', 'mobilephone', 'status'], 'integer'],
            [['created_at', 'updated_at', 'lastlogin'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['firstname', 'auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'firstname' => 'Firstname',
            'secondnameid' => 'Secondnameid',
            'patronimicnameid' => 'Patronimicnameid',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'mobilephone' => 'Mobilephone',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'lastlogin' => 'Lastlogin',
        ];
    }

    public function getSecondname() {
         return $this->hasOne(Usersecondname::className(), [ 'id' => 'secondnameid' ]);
    }
}
