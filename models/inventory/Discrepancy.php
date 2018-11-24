<?php

namespace app\models\inventory;

use Yii;
use app\models\sites\Sites;

/**
 * This is the model class for table "inventory_discrepancy".
 *
 * @property integer $id
 * @property integer $siteid
 * @property integer $catalogid
 * @property integer $partcount
 * @property integer $discrepancyid
 * @property integer $description
 * @property integer $swnumbers
 * @property integer $hwnumbers
 */
class Discrepancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory_discrepancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siteid', 'catalogid', 'discrepancyid', 'partcount'], 'required', 'message' => 'поле не должно быть пустым'],
            [['siteid', 'catalogid', 'discrepancyid', 'partcount'], 'integer'],
            [['description', 'swnumbers', 'hwnumbers'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siteid' => 'сайт',
            'catalogid' => 'код товара',
            'codename' => 'код товара',
            'partcount' => 'количество',
            'discrepancyid' => 'расхождение',
            'discrepancy' => 'расхождение',
            'description' => 'описание',
            'swnumbers' => 'серийные номера ИС',
			'hwnumbers' => 'серийные номера оборудования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalogid']);
    }
    public function getCodename()
    {
        return $this->catalog->codename;
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscrepancy()
    {
        if($this->discrepancyid == 1) return 'недостача';
        if($this->discrepancyid == 2) return 'излишек';
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasOne(Sites::className(), ['id' => 'siteid']);
    }
}
