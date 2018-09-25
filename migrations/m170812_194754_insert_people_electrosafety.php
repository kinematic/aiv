<?php

use yii\db\Migration;

class m170812_194754_insert_people_electrosafety extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand("
            SELECT 
                id,
                CASE el_bez 
                    WHEN 'III' THEN 3
                    WHEN 'IV' THEN 4
                    WHEN 'V' THEN 5
					WHEN 3 THEN 3
                    WHEN 4 THEN 4
                    WHEN 5 THEN 5
                END AS groupid
            FROM user
			WHERE el_bez IS NOT NULL
			AND el_bez NOT LIKE ''
        ");
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('people_electrosafety',
                [
                    'manid' => $user['id'],
                    'groupid' => $user['groupid'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_194754_insert_people_electrosafety cannot be reverted.\n";
        $this->truncateTable('people_electrosafety');
        return true;
    }
}
