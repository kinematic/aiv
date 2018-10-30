<?php

namespace app\models\letters;

use Yii;
use app\models\people\People;

/**
 * This is the model class for table "letters_signature".
 *
 * @property integer $id
 * @property string $position
 * @property integer $userid
 */
class Signature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'letters_signature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'userid'], 'required'],
            [['userid'], 'integer'],
            [['position'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'должность',
            'userid' => 'ФИО',
        ];
    }

    public function getChief() {
         return $this->hasOne(People::className(), [ 'id' => 'userid' ]);
    }

// 	public function getSignature() {
// 		print_r ($this);
// 		die();
// 		return $this->user->fullname;
// 		
// 	}

}
