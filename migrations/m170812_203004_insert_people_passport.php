<?php

use yii\db\Migration;

class m170812_203004_insert_people_passport extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand("
            UPDATE user SET birthday = NULL WHERE birthday = '0000-00-00'
        ");
        $model = $connection->createCommand("
			SELECT 
                id,
                pass_serial,
                pass,
                -- STR_TO_DATE(birthday, '%d.%m.%Y') AS birthday,
                NULLIF(STR_TO_DATE(birthday, '%Y-%m-%d'), '0000-00-00') AS birthday,
                place_birth,
                place_pass,
                place_live
            FROM user
			WHERE pass_serial IS NOT NULL
            AND pass_serial NOT LIKE ''
        ");
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('people_passport',
                [
	                'manid' => $user['id'], 
	                'number' => $user['pass_serial'],
	                'issued' => $user['pass'],
	                'birthday' => $user['birthday'],
	                'placebirth' => $user['place_birth'],
	                'registration' => $user['place_pass'],
	                'residence' => $user['place_live']
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_203004_insert_people_passport cannot be reverted.\n";
        $this->truncateTable('people_passport');
        return true;
    }
}
