<?php

use yii\db\Migration;

class m170813_120324_insert_address_typenp extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name 
            FROM address_typenp
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('address_typenp',
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
                3,
                address_typenpid
            FROM objects
            WHERE address_typenpid IS NOT NULL
            AND address_typenpid <> 0
        ');
    }

    public function down()
    {
        echo "m170813_120324_insert_typenp cannot be reverted.\n";
        $this->truncateTable('address_typenp');
        $this->delete('addresses', ['typeid' => 3]);
        return true;
    }
}
