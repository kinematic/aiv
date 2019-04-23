<?php

namespace app\modules\admin\models\import;

use Yii;

/**
 * This is the model class for table "mustang".
 *
 * @property int $id
 * @property string $object
 * @property string $planedaddress
 * @property string $realaddress
 * @property string $juricaladdress
 * @property string $contacts
 * @property string $startdate
 * @property string $closedate
 * @property string $mol
 * @property string $status
 * @property string $inventory
 * @property string $lastinventorydate
 */
class Mustang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mustang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['planedaddress', 'realaddress', 'juricaladdress'], 'string'],
            [['startdate', 'closedate', 'lastinventorydate'], 'safe'],
            [['object', 'contacts', 'mol', 'status', 'inventory'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object' => 'Object',
            'planedaddress' => 'Planedaddress',
            'realaddress' => 'Realaddress',
            'juricaladdress' => 'Juricaladdress',
            'contacts' => 'Contacts',
            'startdate' => 'Startdate',
            'closedate' => 'Closedate',
            'mol' => 'Mol',
            'status' => 'Status',
            'inventory' => 'Inventory',
            'lastinventorydate' => 'Lastinventorydate',
        ];
    }
}
