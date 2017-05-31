<?php

namespace app\models\inventory;

use Yii;

/**
 * This is the model class for table "inventory_catalog".
 *
 * @property integer $id
 * @property string $codename
 * @property string $description
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory_catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codename', 'description'], 'required', 'message' => 'поле не должно быть пустым'],
            [['codename'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codename' => 'код товара',
            'description' => 'описание',
        ];
    }
}
