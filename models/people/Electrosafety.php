<?php

namespace app\models\people;

use Yii;

/**
 * This is the model class for table "people_electrosafety".
 *
 * @property integer $id
 * @property integer $manid
 * @property integer $groupid
 */
class Electrosafety extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people_electrosafety';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manid', 'groupid'], 'required'],
            [['manid', 'groupid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manid' => 'Manid',
            'groupid' => 'Groupid',
        ];
    }
}
