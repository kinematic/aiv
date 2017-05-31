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
 * @property integer $patronymicnameid
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
            [['secondnameid', 'patronymicnameid', 'mobilephone', 'status'], 'integer'],
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
            'username' => 'логин',
            'firstname' => 'фамилия',
            'secondname.name' => 'имя',
            'secondnameid' => 'имя',
            'patronymicname.name' => 'отчество',
			'patronymicnameid' => 'отчество',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'mobilephone' => 'мобильный номер',
            'status' => 'состояние',
            'created_at' => 'создан',
            'updated_at' => 'обновлён',
            'lastlogin' => 'последнее посещение',
        ];
    }

    public function getSecondname() {
         return $this->hasOne(Usersecondname::className(), [ 'id' => 'secondnameid' ]);
    }

    public function getPatronymicname() {
         return $this->hasOne(Userpatronymicname::className(), [ 'id' => 'patronymicnameid' ]);
    }

	public function getSignature() {
		return mb_substr($this->secondname->name, 0, 1) . '.' . mb_substr($this->patronymicname->name, 0, 1) . '. ' . $this->firstname;
	}

	public function getFullname() {
		if(isset($this->secondname->name)) $secondname = $this->secondname->name;
		else $secondname = null;
		if(isset($this->patronymicname->name)) $patronymicname = $this->patronymicname->name;
		else $patronymicname = null;
		return $this->firstname . ' ' . $secondname . ' ' . $patronymicname;

	}
	
    public function getMolname() {
       return $this->secondname->name . ' ' . $this->firstname;
    }
}
