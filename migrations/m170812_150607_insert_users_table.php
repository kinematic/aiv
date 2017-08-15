<?php

use yii\db\Migration;

class m170812_150607_insert_users_table extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
                id, 
                trim(email) as email, 
                trim(REPLACE(mob, "+380", "")) as mobilephone,
                NULLIF(login, 0) as status,
                last_visit
            FROM user');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('users',
                [
                    'manid' => $user['id'],
                    'email' => $user['email'],
                    'mobilephone' => $user['mobilephone'],
                    'status' => $user['status'],
                    'visit' => $user['last_visit'],
                ]
            );
        };
		$this->update('users', ['status' => 5], ['id' => 159]);
    }

    public function down()
    {
        echo "m170812_150607_insert_users_table cannot be reverted.\n";
        $this->truncateTable('users');
        return true;
    }
}
