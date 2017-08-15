<?php

use yii\db\Migration;

class m170812_234229_insert_objects extends Migration
{
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT 
				id, 
				address_b, 
				comment, 
				address_descr, 
				address_oblid, 
				address_rnid, 
				address_typenpid,
				address_npid,
				address_typestrid,
				address_strid,
				gpslat,
				gpslong
            FROM objects
        ');
        $users = $model->queryAll();
        
        foreach($users as $user) {
            $this->insert('objects',
                [
					'id' => $user['id'], 
					'address_b' => $user['address_b'], 
					'comment' => $user['comment'],
					'address_descr' => $user['address_descr'], 
					'address_oblid' => $user['address_oblid'], 
					'address_rnid' => $user['address_rnid'], 
					'address_typenpid' => $user['address_typenpid'],
					'address_npid' => $user['address_npid'],
					'address_typestrid' => $user['address_typestrid'],
					'address_strid' => $user['address_strid'],
					'gpslat' => $user['gpslat'],
					'gpslong' => $user['gpslong'],
                ]
            );
        };
        
        $this->execute('
            UPDATE objects
            SET
                address_b = trim(address_b),
                address_descr = trim(address_descr),
                comment = trim(comment)
        ');
    }

    public function down()
    {
        echo "m170813_103548_insert_objects cannot be reverted.\n";
        $this->truncateTable('objects');
        return true;
    }
}
