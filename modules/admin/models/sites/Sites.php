<?php

namespace app\modules\admin\models\sites;

use Yii;

/**
 * This is the model class for table "sites".
 *
 * @property int $id
 * @property int $typeid
 * @property int $regionid
 * @property string $nr
 * @property int $objid
 * @property int $relationid
 * @property string $mustangaddress
 * @property string $description
 * @property int $statusid
 * @property string $opendate
 * @property string $closedate
 * @property int $molid
 * @property string $inventdate
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typeid', 'regionid', 'nr'], 'required'],
            [['typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid'], 'default', 'value' => null],
            [['typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid'], 'integer'],
            [['description'], 'string'],
            [['opendate', 'closedate', 'inventdate'], 'safe'],
            [['nr'], 'string', 'max' => 32],
            [['mustangaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeid' => 'тип',
            'regionid' => 'регион',
            'nr' => 'номер',
            'objid' => 'объект',
            'relationid' => 'Relationid',
            'mustangaddress' => 'Mustangaddress',
            'description' => 'Description',
            'statusid' => 'Statusid',
            'opendate' => 'Opendate',
            'closedate' => 'Closedate',
            'molid' => 'Molid',
            'inventdate' => 'Inventdate',
        ];
    }
}
