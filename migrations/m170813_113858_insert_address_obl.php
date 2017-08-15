<?php

use yii\db\Migration;

class m170813_113858_insert_address_obl extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name 
            FROM address_obl
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('address_obl',
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
                1,
                address_oblid
            FROM objects
            WHERE address_oblid IS NOT NULL');
    }

    public function down()
    {
        echo "m170813_113858_insert_address_obl cannot be reverted.\n";
        $this->truncateTable('address_obl');
        $this->delete('addresses', ['typeid' => 1]);
        return true;
    }
}
