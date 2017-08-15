<?php

use yii\db\Migration;

class m170813_115507_insert_address_rn extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name 
            FROM address_rn
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('address_rn',
                [
					'id' => $user['id'], 
					'name' => $user['name'], 
                ]
            );
        };
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                id,
                2,
                address_rnid
            FROM objects
            WHERE address_rnid IS NOT NULL
            AND address_rnid <> 0
        ');
    }

    public function down()
    {
        echo "m170813_115507_insert_address_rn cannot be reverted.\n";
        $this->truncateTable('address_rn');
        $this->delete('addresses', ['typeid' => 2]);
        return true;
    }
}
