<?php

use yii\db\Migration;

class m170813_072727_insert_address_gps extends Migration
{
    public function up()
    {
        $this->execute('
            INSERT INTO address_gps (lat, long)
            SELECT 
				gpslat,
                gpslong 
            FROM objects
			WHERE gpslat IS NOT NULL AND gpslong IS NOT NULL
			AND gpslat <> 0 AND gpslong <> 0
        
        ');
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                o.id,
                10,
                a.id
            FROM address_gps a, objects o 
            WHERE a.lat = o.gpslat AND a.long = o.gpslong');
    }

    public function down()
    {
        echo "m170813_072727_insert_address_gps cannot be reverted.\n";
        $this->truncateTable('address_gps');
        $this->delete('addresses', ['typeid' => 10]);
        return true;
    }
}
