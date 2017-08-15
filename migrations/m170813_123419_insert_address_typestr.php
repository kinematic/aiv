<?php

use yii\db\Migration;

class m170813_123419_insert_address_typestr extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name,
				pos
            FROM address_typestr
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('address_typestr',
                [
					'id' => $user['id'], 
					'name' => $user['name'],
					'position' => $user['pos'],
                ]
            );
        };
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                id,
                5,
                address_typestrid
            FROM objects
            WHERE address_typestrid IS NOT NULL
            AND address_typestrid <> 0
        ');
    }

    public function down()
    {
        echo "m170813_123419_insert_address_typestr cannot be reverted.\n";
        $this->truncateTable('address_typestr');
        $this->delete('addresses', ['typeid' => 5]);
        return true;
    }
}
