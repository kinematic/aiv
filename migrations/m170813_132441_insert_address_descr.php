<?php

use yii\db\Migration;

class m170813_132441_insert_address_descr extends Migration
{
    public function up()
    {
        $this->execute("
            INSERT INTO address_descr (value)
            SELECT 
				address_descr
            FROM objects
			WHERE address_descr IS NOT NULL 
			AND address_descr NOT LIKE ''
            GROUP BY address_descr 
            ORDER BY address_descr
        ");
        
        $this->execute("
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                o.id,
                8,
                a.id
            FROM address_descr a, objects o 
            WHERE a.value LIKE o.address_descr
            AND o.address_descr IS NOT NULL
            AND o.address_descr NOT LIKE ''
        ");
    }

    public function down()
    {
        echo "m170813_132441_insert_address_descr cannot be reverted.\n";
        $this->truncateTable('address_descr');
        $this->delete('addresses', ['typeid' => 8]);
        return true;
    }
}
