<?php

namespace app\models\people;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $manid
 * @property string $email
 * @property integer $mobilephone
 * @property integer $status
 * @property string $created
 * @property string $updated
 * @property string $visit
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
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
            [['manid', 'mobilephone'], 'required'],
            [['manid', 'mobilephone', 'status'], 'integer'],
            [['created', 'updated', 'visit'], 'safe'],
            [['email'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manid' => 'Manid',
            'email' => 'Email',
            'mobilephone' => 'Mobilephone',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'visit' => 'Visit',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
        ];
    }
}
