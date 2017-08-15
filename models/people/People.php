<?php

namespace app\models\people;

use Yii;

/**
 * This is the model class for table "people".
 *
 * @property integer $id
 * @property string $firstname
 * @property integer $secondnameid
 * @property integer $patronymicnameid
 * @property integer $companyid
 * @property integer $positionid
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'secondnameid'], 'required'],
            [['secondnameid', 'patronymicnameid', 'companyid', 'positionid'], 'integer'],
            [['firstname'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'фамилия',
            'secondnameid' => 'имя',
            'patronymicnameid' => 'отчество',
            'companyid' => 'компания',
            'positionid' => 'должность',
            'fullname' => 'ФИО',
        ];
    }

    public function getSecondname() {
         return $this->hasOne(Secondname::className(), [ 'id' => 'secondnameid' ]);
    }

    public function getPatronymicname() {
         return $this->hasOne(Patronymicname::className(), [ 'id' => 'patronymicnameid' ]);
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
       return $this->secondname . ' ' . $this->firstname;
//         Yii::warning(print_r($this->secondname, true));
//        return $this->firstname;
    }
}
