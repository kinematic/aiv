<?php

use yii\db\Migration;

class m170813_123754_insert_address_str extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name 
            FROM address_str
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('address_str',
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
                6,
                address_strid
            FROM objects
            WHERE address_strid IS NOT NULL
            AND address_strid <> 0
        ');
    }

    public function down()
    {
        echo "m170813_123754_insert_address_str cannot be reverted.\n";
        $this->truncateTable('address_str');
        $this->delete('addresses', ['typeid' => 6]);
        return true;
    }
}
