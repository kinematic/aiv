<?php

use yii\db\Migration;

class m170812_214229_insert_sitesregion extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				name, 
				shortname, 
				description, 
				address_oblid, 
				depvis, 
				mustangimport 
            FROM sitesregion
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('sitesregion',
                [
					'id' => $user['id'], 
					'name' => $user['name'], 
					'shortname' => $user['shortname'],
					'description' => $user['description'], 
					'oblid' => $user['address_oblid'], 
					'visible' => $user['depvis'], 
					'import' => $user['mustangimport'] 
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_214229_insert_sitesregion cannot be reverted.\n";
        $this->truncateTable('sitesregion');
        return true;
    }
}
