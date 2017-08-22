<?php

use yii\db\Migration;

class m170822_080908_inventory_catalog extends Migration
{
    public function up()
    {
        // $connection = \Yii::$app->db_remote_mysql_aiv;
        // $model = $connection->createCommand('
            // SELECT 
                // id,
                // codename,
                // description
            // FROM inventory_catalog
        // ');
        // $users = $model->queryAll();
        
        // foreach($users as $user) {
            // $this->insert('inventory_catalog',
                // [
					// 'id' => $user['id'], 
					// 'codename' => $user['codename'], 
					// 'description' => $user['description'],
                // ]
            // );
        // };
    }

    public function down()
    {
        echo "m170822_080908_inventory_catalog cannot be reverted.\n";
        // $this->truncateTable('inventory_catalog');
        return true;
    }
}
