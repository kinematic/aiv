<?php

namespace app\models\people;

use Yii;

/**
 * This is the model class for table "people_passport".
 *
 * @property integer $id
 * @property integer $manid
 * @property string $number
 * @property string $issued
 * @property string $birthday
 * @property string $placebirth
 * @property string $registration
 * @property string $residence
 */
class Passport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people_passport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manid', 'number'], 'required'],
            [['manid'], 'integer'],
            [['birthday'], 'safe'],
            [['number'], 'string', 'max' => 8],
            [['issued'], 'string', 'max' => 100],
            [['placebirth', 'registration', 'residence'], 'string', 'max' => 80],
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
            'number' => 'Number',
            'issued' => 'Issued',
            'birthday' => 'Birthday',
            'placebirth' => 'Placebirth',
            'registration' => 'Registration',
            'residence' => 'Residence',
        ];
    }
}
