<?php

namespace app\models\people;

use Yii;
use app\models\address\Obl;
use app\models\letters\Lists;

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
	public $secondname;
	public $patronymicname;
	
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
			'company.simplename' => 'компания',
            'positionid' => 'должность',
			'position.name' => 'должность',
            'fullname' => 'ФИО',
			'sname.name' => 'имя',
			'pname.name' => 'отчество',
			'electrosafetygroup' => 'группа электробезопасности',
			'passport.number' => 'серия и номер паспорта',
			'passport.issued' => 'паспорт выдан',
			'passport.birthday' => 'дата рождения',
			'passport.placebirth' => 'место рождения',
			'passport.registration' => 'прописка',
			'passport.residence' => 'место проживания',
        ];
    }

    public function getSname() {
         return $this->hasOne(Secondname::className(), [ 'id' => 'secondnameid' ]);
    }

    public function getPname() {
         return $this->hasOne(Patronymicname::className(), [ 'id' => 'patronymicnameid' ]);
    }

	public function getSignature() {
		return mb_substr($this->sname->name, 0, 1) . '.' . mb_substr($this->pname->name, 0, 1) . '. ' . $this->firstname;
	}

	public function getFullname() {
		if(isset($this->sname->name)) $secondname = $this->sname->name;
		else $secondname = null;
		if(isset($this->pname->name)) $patronymicname = $this->pname->name;
		else $patronymicname = null;
		return $this->firstname . ' ' . $secondname . ' ' . $patronymicname;
	}
	
    public function getMolname() {
       return $this->secondname . ' ' . $this->firstname;
    }
	
	public function getCompany() {
         return $this->hasOne(Companies::className(), [ 'id' => 'companyid' ]);
    }
	
	public function getDistrict() {
         return $this->hasOne(Obl::className(), [ 'id' => 'address_oblid' ]);
    }
	
	public function getPosition() {
         return $this->hasOne(Position::className(), [ 'id' => 'positionid' ]);
    }
	
	public function getElectrosafety() {
         return $this->hasOne(Electrosafety::className(), [ 'manid' => 'id' ]);
    }
	
	public function getElectrosafetygroup() {
		if(!isset($this->electrosafety->groupid)) return null;
		if($this->electrosafety->groupid == 3) return 'III';
		if($this->electrosafety->groupid == 4) return 'IV';
		if($this->electrosafety->groupid == 5) return 'V';
	}
	
	public function getPassport() {
         return $this->hasOne(Passport::className(), [ 'manid' => 'id' ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        return $this->hasMany(Lists::className(), ['manid' => 'id']);
    }
}
