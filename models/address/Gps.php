<?php

namespace app\models\address;

use Yii;

/**
 * This is the model class for table "address_gps".
 *
 * @property integer $id
 * @property integer $lat
 * @property integer $long
 */
class Gps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_gps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat', 'long'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lat' => 'Lat',
            'long' => 'Long',
        ];
    }
}
