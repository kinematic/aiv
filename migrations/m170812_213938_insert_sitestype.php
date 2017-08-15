<?php

use yii\db\Migration;

class m170812_213938_insert_sitestype extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name, 
				depvis 
            FROM sitestype
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('sitestype',
                [
					'id' => $user['id'], 
					'name' => $user['name'], 
					'visible' => $user['depvis'], 
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_213938_insert_sitestype cannot be reverted.\n";
        $this->truncateTable('sitestype');
        return true;
    }
}
