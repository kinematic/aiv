<?php

use yii\db\Migration;

class m170812_212121_insert_people_companies extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
			SELECT 
				id,
                name,
                title
            FROM companies
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('people_companies',
                [
	                'id' => $user['id'], 
	                'simplename' => $user['name'],
	                'officialname' => $user['title'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_212121_insert_people_companies cannot be reverted.\n";
        $this->truncateTable('people_companies');
        return true;
    }
}
