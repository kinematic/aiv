<?php

namespace app\models\visits;

use Yii;

/**
 * This is the model class for table "siteaccess_codes".
 *
 * @property integer $id
 * @property string $cramername
 * @property string $pmsite
 * @property string $atolname
 * @property integer $code
 * @property integer $siteid
 */
class SiteaccessCodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siteaccess_codes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'siteid'], 'integer'],
            [['cramername', 'pmsite', 'atolname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cramername' => 'Cramername',
            'pmsite' => 'Pmsite',
            'atolname' => 'Atolname',
            'code' => 'Code',
            'siteid' => 'Siteid',
        ];
    }
}
