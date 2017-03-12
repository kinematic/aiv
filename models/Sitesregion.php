<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sitesregion".
 *
 * @property integer $id
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property integer $oblid
 * @property integer $import
 */
class Sitesregion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sitesregion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['oblid', 'import'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['shortname'], 'string', 'max' => 2],
            [['description'], 'string', 'max' => 30],
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
            'shortname' => 'Shortname',
            'description' => 'Description',
            'oblid' => 'Oblid',
            'import' => 'Import',
        ];
    }
}
