<?php

namespace app\modules\admin\models\import;

use Yii;

/**
 * This is the model class for table "sites".
 *
 * @property int $id
 * @property string $node
 * @property string $zone
 * @property string $object
 * @property string $planedaddress
 * @property string $realaddress
 * @property string $mol
 * @property string $status
 * @property int $inventory
 * @property string $lastinventorydate
 * @property string $juricaladdress
 * @property string $contacts
 * @property string $startdate
 * @property string $closedate
 * @property string $contractor
 * @property int $typeid
 * @property int $regionid
 * @property string $nr
 * @property int $siteid
 * @property int $statusid
 * @property int $molid
 */
class Sites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sites';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
	// public static function getDb()
    // {
        // return Yii::$app->get('aiv');
    // } 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['object', 'typeid', 'regionid', 'nr', 'statusid'], 'required'],
            [['planedaddress', 'realaddress', 'juricaladdress'], 'string'],
            [['inventory', 'typeid', 'regionid', 'siteid', 'statusid', 'molid'], 'integer'],
            [['startdate', 'closedate'], 'safe'],
            [['object', 'contractor', 'nr'], 'string', 'max' => 20],
            [['status', 'lastinventorydate'], 'string', 'max' => 30],
            [['mol'], 'string', 'max' => 200],
            [['contacts'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object' => 'объект',
            'planedaddress' => 'планируемый адрес',
            'realaddress' => 'реальный адрес',
            'mol' => 'МОЛ',
            'status' => 'статус',
            'inventory' => 'инвентаризируется',
            'lastinventorydate' => 'последняя инвентаризация',
            'juricaladdress' => 'юридический адрес',
            'contacts' => 'контакты',
            'startdate' => 'запущен',
            'closedate' => 'закрыт',
            'contractor' => 'Contractor',
            'typeid' => 'тип',
            'regionid' => 'регион',
            'nr' => 'номер',
            'siteid' => 'Siteid',
            'statusid' => 'статус',
            'molid' => 'МОЛ',
        ];
    }
}
