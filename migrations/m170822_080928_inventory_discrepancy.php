<?php

use yii\db\Migration;

class m170822_080928_inventory_discrepancy extends Migration
{
    public function up()
    {
        // $connection = \Yii::$app->db_remote_mysql_aiv;
        // $model = $connection->createCommand('
            // SELECT 
                // id,
                // siteid,
				// catalogid,
				// partcount,
				// discrepancyid,
                // description,
				// serialnumbers
            // FROM inventory_discrepancy
        // ');
        // $users = $model->queryAll();
        
        // foreach($users as $user) {
            // $this->insert('inventory_discrepancy',
                // [
					// 'id' => $user['id'], 
					// 'siteid' => $user['siteid'],
					// 'catalogid' => $user['catalogid'],
					// 'partcount' => $user['partcount'],
					// 'discrepancyid' => $user['discrepancyid'],
					// 'description' => $user['description'],
					// 'serialnumbers' => $user['serialnumbers'],
                // ]
            // );
        // };
    }

    public function down()
    {
        echo "m170822_080928_inventory_discrepancy cannot be reverted.\n";
        // $this->truncateTable('inventory_discrepancy');
        return true;
    }
}
