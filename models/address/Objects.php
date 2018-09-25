<?php

namespace app\models\address;

use Yii;

/**
 * This is the model class for table "objects".
 *
 * @property integer $id
 * @property string $name
 * @property string $comment
 * @property integer $address_oblid
 * @property integer $address_rnid
 * @property integer $address_typenpid
 * @property integer $address_npid
 * @property integer $address_typestrid
 * @property integer $address_strid
 * @property string $address_b
 * @property string $address_descr
 * @property integer $gpslat
 * @property integer $gpslong
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['comment'], 'string'],
            [['address_oblid', 'address_rnid', 'address_typenpid', 'address_npid', 'address_typestrid', 'address_strid', 'gpslat', 'gpslong'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['address_b'], 'string', 'max' => 30],
            [['address_descr'], 'string', 'max' => 255],
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
            'comment' => 'Comment',
            'address_oblid' => 'Address Oblid',
            'address_rnid' => 'Address Rnid',
            'address_typenpid' => 'Address Typenpid',
            'address_npid' => 'Address Npid',
            'address_typestrid' => 'Address Typestrid',
            'address_strid' => 'Address Strid',
            'address_b' => 'Address B',
            'address_descr' => 'Address Descr',
            'gpslat' => 'Gpslat',
            'gpslong' => 'Gpslong',
        ];
    }
    
//     public function getAddress() {
//         return $this->hasMany(Addresses::className(), [ 'people_id' => 'model_id' ])
//             ->viaTable('recapitulation_properties', [ 'tag_id' => 'id' ]);
//     }
    

}
