<?php

namespace app\models\address;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property integer $objid
 * @property string $contact
 * @property string $description
 */
class Contacts extends \yii\db\ActiveRecord
{
	public $objID;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objid', 'contact'], 'required'],
            [['objid'], 'integer'],
            [['contact'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 250],
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
            'contact' => 'контакт',
            'description' => 'описание',
        ];
    }


}
