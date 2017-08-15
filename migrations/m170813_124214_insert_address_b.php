<?php

use yii\db\Migration;

class m170813_124214_insert_address_b extends Migration
{
    public function up()
    {
        $this->execute("
            INSERT INTO address_b (value)
            SELECT 
				address_b
            FROM objects
			WHERE address_b IS NOT NULL 
			AND address_b NOT LIKE ''
            GROUP BY address_b 
            ORDER BY address_b
        ");
        
        $this->execute("
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                o.id,
                7,
                a.id
            FROM address_b a, objects o 
            WHERE a.value LIKE o.address_b
            AND o.address_b IS NOT NULL
            AND o.address_b NOT LIKE ''
        ");
    }

    public function down()
    {
        echo "m170813_124214_insert_address_b cannot be reverted.\n";
        $this->truncateTable('address_b');
        $this->delete('addresses', ['typeid' => 7]);
        return true;
    }
}
