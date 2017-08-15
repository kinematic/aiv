<?php

use yii\db\Migration;

class m170813_145433_insert_contacts extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
                obj_id,
                phone,
                rank
            FROM phones
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('contacts',
                [
					'objid' => $user['obj_id'], 
					'contact' => $user['phone'], 
					'description' => $user['rank'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m170813_145433_insert_contacts cannot be reverted.\n";
        $this->truncateTable('contacts');
        return true;
    }
}
