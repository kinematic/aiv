<?php
namespace app\models\visits;

use Yii;

/**
 * This is the model class for table "siteaccess".
 *
 * @property integer $id
 * @property string $serverserial
 * @property string $mo
 * @property string $customer
 * @property string $node
 * @property string $nodealias
 * @property string $summary
 * @property string $username
 * @property integer $phone
 * @property string $firstoc
 * @property string $cleartime
 * @property integer $siteid
 * @property integer $objid
 * @property integer $userid
 */
class Siteaccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siteaccess';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serverserial'], 'required'],
            [['serverserial', 'phone', 'siteid', 'objid', 'userid'], 'integer'],
            [['firstoc', 'cleartime'], 'safe'],
            [['mo'], 'string', 'max' => 5],
            [['customer', 'node', 'nodealias'], 'string', 'max' => 70],
            [['summary'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serverserial' => 'Serverserial',
            'mo' => 'код',
            'customer' => 'Customer',
            'node' => 'Node',
            'nodealias' => 'Nodealias',
            'summary' => 'Summary',
            'username' => 'заходил',
            'phone' => '№ телефона',
            'firstoc' => 'Firstoc',
            'cleartime' => 'Cleartime',
            'siteid' => 'Siteid',
            'objid' => 'Objid',
            'userid' => 'Userid',
        ];
    }
}
