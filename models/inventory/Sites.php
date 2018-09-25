<?php

namespace app\models\inventory;

use Yii;

/**
 * This is the model class for table "sites".
 *
 * @property integer $id
 * @property integer $typeid
 * @property integer $regionid
 * @property string $nr
 * @property integer $objid
 * @property integer $relationid
 * @property string $mustangaddress
 * @property string $description
 * @property integer $statusid
 * @property string $opendate
 * @property string $closedate
 * @property integer $molid
 * @property string $inventdate
 */
class Sites extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeid', 'regionid', 'nr'], 'required'],
            [['typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid'], 'integer'],
            [['description'], 'string'],
            [['opendate', 'closedate', 'inventdate'], 'safe'],
            [['nr'], 'string', 'max' => 32],
            [['mustangaddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeid' => 'Typeid',
            'regionid' => 'Regionid',
            'nr' => 'Nr',
            'objid' => 'Objid',
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
