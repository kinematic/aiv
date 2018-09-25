<?php

use yii\db\Migration;

class m180720_185915_insert_siteaccess extends Migration
{


    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT
				serverserial,	
				mo,
				customer,		
				node,
				nodealias,
				summary,	
				username,		
				RIGHT(phone, 9) as phone,
				UNIX_TIMESTAMP(firstoc) as firstoc,		
				UNIX_TIMESTAMP(cleartime) as cleartime,	
				siteid,	
				objid	
			FROM siteaccess
			WHERE firstoc > DATE_SUB(CURDATE(),Interval 1 YEAR)
        ');
        $codes = $model->queryAll();
        
        foreach($codes as $code) {
            $this->insert('siteaccess',
                [
					'serverserial' => $code['serverserial'], 
					'mo' => $code['mo'],
					'customer' => $code['customer'],
					'node' => $code['node'],
					'nodealias' => $code['nodealias'],
					'summary' => $code['summary'],
					'username' => $code['username'],
					'phone' => $code['phone'],
					'firstoc' => $code['firstoc'],
					'cleartime' => $code['cleartime'],
					'siteid' => $code['siteid'],
					'objid' => $code['objid'],
					// 'userid' => $code['userid'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m180720_185915_insert_siteaccess cannot be reverted.\n";
		$this->truncateTable('siteaccess');
        return true;
    }

}
