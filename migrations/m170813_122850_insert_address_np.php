<?php

use yii\db\Migration;

class m170813_122850_insert_address_np extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name,
				capital
            FROM address_np
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('address_np',
                [
					'id' => $user['id'], 
					'name' => $user['name'],
					'capital' => $user['capital'],
                ]
            );
        };
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                id,
                4,
                address_npid
            FROM objects
            WHERE address_npid IS NOT NULL
            AND address_npid <> 0
        ');
    }

    public function down()
    {
        echo "m170813_122850_insert_address_np cannot be reverted.\n";
        $this->truncateTable('address_np');
        $this->delete('addresses', ['typeid' => 4]);
        return true;
    }
}
