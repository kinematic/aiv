<?php

namespace app\models\letters;

use Yii;
use app\models\sites\Sites;

/**
 * This is the model class for table "letters_letters".
 *
 * @property integer $id
 * @property integer $objid
 * @property string $appeal1
 * @property string $appeal2
 * @property string $appeal3
 * @property string $firstname
 * @property integer $secondnameid
 * @property integer $patronymicnameid
 * @property integer $signid
 * @property string $text1
 * @property string $text2
 */
class Letters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'letters_letters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objid'], 'required'],
            [['objid', 'secondnameid', 'patronymicnameid', 'signid'], 'integer'],
            [['text1', 'text2'], 'string'],
            [['appeal1'], 'string', 'max' => 150],
            [['appeal2', 'appeal3', 'firstname'], 'string', 'max' => 50],
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
            'appeal1' => 'обращение по должности к предприятию',
            'appeal2' => 'обращение по фамилии и и.о.',
            'appeal3' => 'обращение по имени и отчеству',
            'firstname' => 'Firstname',
            'secondnameid' => 'Secondnameid',
            'patronymicnameid' => 'Patronymicnameid',
            'signid' => 'подпись',
            'text1' => 'начало текста',
            'text2' => 'окончание текста',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
		return Sites::find()->where(['objid' => $this->objid])->orderBy('LENGTH(nr) ASC')->limit(1)->one();
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Sites::className(), ['objid' => 'objid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        return $this->hasMany(Lists::className(), ['letterid' => 'id']);
    }

    public function getSignature() {
         return $this->hasOne(Signature::className(), [ 'id' => 'signid' ]);
    }
}
