<?php

use yii\db\Migration;

class m170813_132917_insert_address_comment extends Migration
{
    public function up()
    {
        $this->execute("
            INSERT INTO address_comment (value)
            SELECT 
				comment
            FROM objects
			WHERE comment IS NOT NULL 
			AND comment NOT LIKE ''
            GROUP BY comment 
            ORDER BY comment
        ");
        
        $this->execute("
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                o.id,
                9,
                a.id
            FROM address_comment a, objects o 
            WHERE a.value LIKE o.comment
            AND (o.comment IS NOT NULL
            AND o.comment NOT LIKE '')
        ");
    }

    public function down()
    {
        echo "m170813_132917_insert_address_comment cannot be reverted.\n";
        $this->truncateTable('address_comment');
        $this->delete('addresses', ['typeid' => 9]);
        return true;
    }
}
