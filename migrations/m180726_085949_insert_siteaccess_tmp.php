<?php

use yii\db\Migration;

class m180726_085949_insert_siteaccess_tmp extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db_remote_oracle;
        $model = $connection->createCommand('
			SELECT
				SERVERSERIAL,
				LOWER (SITEACCESSCODE) AS MO,
				TTWOSGROUP,
				NODE,
				NODEALIAS,
				SUMMARY,
				TO_CHAR(FIRSTOCCURRENCE, "YYYY-MM-DD HH24:MI:SS") AS FIRSTOC,
				TO_CHAR(CLEARTIME, "YYYY-MM-DD HH24:MI:SS") AS CLEAROC
			FROM REPORTER.SITEACCESS4AIV
        ');
        $codes = $model->queryAll();
        
        foreach($codes as $code) {
            $this->insert('siteaccess_tmp',
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
					'cleartime' => $code['clearoc'],
					// 'siteid' => $code['siteid'],
					// 'objid' => $code['objid'],
					// 'userid' => $code['userid'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m180720_185915_insert_siteaccess cannot be reverted.\n";
		$this->truncateTable('siteaccess_tmp');
        return true;
    }
}
