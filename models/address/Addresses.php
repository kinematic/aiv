<?php

namespace app\models\address;

use Yii;

/**
 * This is the model class for table "addresses".
 *
 * @property integer $id
 * @property integer $objid
 * @property integer $typeid
 * @property integer $valueid 
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objid', 'typeid', 'valueid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objid' => 'Objid',
            'typeid' => 'Typeid',
            'valueid' => 'Valueid',
        ];
    }
    
    public function getObl() {
         return $this->hasOne(Obl::className(), [ 'id' => 'valueid' ])->where(['typeid' => 1]);
    }
        
    public function getRn() {
         return $this->hasOne(Rn::className(), [ 'id' => 'valueid' ])->where(['typeid' => 2]);
    }
    
    public function getTypenp() {
         return $this->hasOne(Typenp::className(), [ 'id' => 'valueid' ])->where(['typeid' => 3]);
    }
    
    public function getNp() {
         return $this->hasOne(Np::className(), [ 'id' => 'valueid' ])->where(['typeid' => 4]);
    }
    
    public function getTypestr() {
         return $this->hasOne(Typestr::className(), [ 'id' => 'valueid' ])->where(['typeid' => 5]);
    }
    
    public function getStr() {
         return $this->hasOne(Str::className(), [ 'id' => 'valueid' ])->where(['typeid' => 6]);
    }
    
    public function getBud() {
         return $this->hasOne(Bud::className(), [ 'id' => 'valueid' ])->where(['typeid' => 7]);
    }
        
    public function getDescr() {
         return $this->hasOne(Descr::className(), [ 'id' => 'valueid' ])->where(['typeid' => 8]);
    }
        
    public function getComment() {
         return $this->hasOne(Comment::className(), [ 'id' => 'valueid' ])->where(['typeid' => 9]);
    }
        
    public function getGps() {
         return $this->hasOne(Gps::className(), [ 'id' => 'valueid' ])->where(['typeid' => 10]);
    }
}
