<?php

namespace app\models\sites;

use Yii;

/**
 * This is the model class for table "sitesforupdate".
 *
 * @property integer $id
 * @property string $name
 * @property string $planedaddress
 * @property string $realaddress
 * @property string $juricaladdress
 * @property string $startdate
 * @property string $closedate
 * @property string $mol
 * @property string $status
 * @property string $isinventory
 * @property string $lastinventorydate
 * @property integer $typeid
 * @property integer $regionid
 * @property string $nr
 * @property integer $siteid
 * @property integer $statusid
 * @property integer $molid
 */
class Sitesforupdate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sitesforupdate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['startdate', 'closedate', 'lastinventorydate'], 'safe'],
            [['typeid', 'regionid', 'siteid', 'statusid', 'molid'], 'integer'],
            [['name', 'mol', 'status', 'nr'], 'string', 'max' => 50],
            [['planedaddress', 'realaddress', 'juricaladdress'], 'string', 'max' => 255],
            [['isinventory'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'planedaddress' => 'Planedaddress',
            'realaddress' => 'Realaddress',
            'juricaladdress' => 'Juricaladdress',
            'startdate' => 'Startdate',
            'closedate' => 'Closedate',
            'mol' => 'Mol',
            'status' => 'Status',
            'isinventory' => 'Isinventory',
            'lastinventorydate' => 'Lastinventorydate',
            'typeid' => 'Typeid',
            'regionid' => 'Regionid',
            'nr' => 'Nr',
            'siteid' => 'Siteid',
            'statusid' => 'Statusid',
            'molid' => 'Molid',
        ];
    }
}
