<?php

use yii\db\Migration;
use yii\db\Query;

class m170812_123002_insert_people_table extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
                id, 
                trim(fam) as firstname,
                imya as secondname,
                otch as patronymicname,
                rank as position,
				address_oblid,
                comp_id 
            FROM user
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('people',
                [
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'secondname' => $user['secondname'],
                    'patronymicname' => $user['patronymicname'],
                    'position' => $user['position'],
					'districtid' => $user['address_oblid'],
                    'companyid' => $user['comp_id'],
                ]
            );
        };
    }

    public function down()
    {
        echo "m170812_123002_insert_people_tables cannot be reverted.\n";
        $this->truncateTable('people');
        return true;
    }

}
