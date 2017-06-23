<?php

namespace app\models\people;

use Yii;

/**
 * This is the model class for table "people_companies".
 *
 * @property integer $id
 * @property string $simplename
 * @property string $officialname
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people_companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['simplename'], 'string', 'max' => 50],
            [['officialname'], 'string', 'max' => 150],
            [['simplename'], 'unique'],
            [['officialname'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'simplename' => 'название',
            'officialname' => 'официальное имя',
        ];
    }
}
