<?php

use yii\db\Migration;

class m170812_213033_insert_sites extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id,
				typeid,
				regionid,
				nr,
				objid,
				relationid,
				address,
				comment,
				workstatusid,
				date,
				closedate,
				mol,
				last_invent 
            FROM sites
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('sites',
                [
					'id' => $user['id'], 
					'typeid' => $user['typeid'], 
					'regionid' => $user['regionid'], 
					'nr' => $user['nr'], 
					'objid' => $user['objid'], 
					'relationid' => $user['relationid'],
					'mustangaddress' => $user['address'],
					'description' => $user['comment'],
					'statusid' => $user['workstatusid'], 
					'opendate' => $user['date'], 
					'closedate' => $user['closedate'], 
					'molid' => $user['mol'], 
					'inventdate' => $user['last_invent']
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_213033_insert_sites cannot be reverted.\n";
        $this->truncateTable('sites');
        return true;
    }
}
