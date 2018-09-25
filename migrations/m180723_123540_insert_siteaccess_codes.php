<?php

use yii\db\Migration;

class m180723_123540_insert_siteaccess_codes extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT
				cramername,	
				pmsite,	
				atolname,	
				code,	
				siteid
			FROM siteaccess_codes
        ');
        $codes = $model->queryAll();
        
        foreach($codes as $code) {
            $this->insert('siteaccess_codes',
                [
					'cramername' => $code['cramername'], 
					'pmsite' => $code['pmsite'],
					'atolname' => $code['atolname'],
					'code' => $code['code'],
					'siteid' => $code['siteid'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m180723_123540_insert_siteaccess_codes cannot be reverted.\n";
		$this->truncateTable('siteaccess_codes');
        return true;
    }
}
