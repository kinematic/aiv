<?php

namespace app\models\letters;

use Yii;
use app\models\people\People;

/**
 * This is the model class for table "letters_lists".
 *
 * @property int $id
 * @property int $letterid
 * @property int $manid
 */
class Lists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'letters_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['letterid', 'manid'], 'required'],
            [['letterid', 'manid'], 'default', 'value' => null],
            [['letterid', 'manid'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'letterid' => 'письмо',
            'manid' => 'человек',
        ];
    }

	public function getMan()
	{
		return $this->hasOne(People::className(), [ 'id' => 'manid' ]);

	}
}
