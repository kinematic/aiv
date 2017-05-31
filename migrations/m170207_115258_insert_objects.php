<?php

use yii\db\Migration;

class m170207_115258_insert_objects extends Migration
{
    public function up()
    {
        // делаем координаты
        $this->execute('
            INSERT INTO address_gps (
                lat,
                `long`)
            SELECT 
                gpslat,
                gpslong
            FROM rbs_sites.objects o
            WHERE o.gpslat  IS NOT NULL AND o.gpslong IS NOT NULL');
            
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                o.id,
                10,
                a.id
            FROM address_gps a, rbs_sites.objects o 
            WHERE a.lat = o.gpslat AND a.long = o.gpslong');
        
        // делаем области
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                id,
                1,
                address_oblid
            FROM rbs_sites.objects
            WHERE address_oblid IS NOT NULL');
            
        $this->execute('
            INSERT INTO address_obl (id, name)
            SELECT id, name FROM rbs_sites.address_obl');
        
        // делаем районы
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT 
                id,
                2,
                address_rnid
            FROM rbs_sites.objects
            WHERE address_rnid IS NOT NULL');
            
        $this->execute('
            INSERT INTO address_rn (id, name)
            SELECT id, name FROM rbs_sites.address_rn');
        
        // делаем типы населённых пунктов
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
                SELECT 
                id,
                3,
                address_typenpid
            FROM rbs_sites.objects
            WHERE address_typenpid IS NOT NULL');
            
        $this->execute('
            INSERT INTO address_typenp (id, name)
            SELECT id, name FROM rbs_sites.address_typenp');
        
        // делаем населённые пункты
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT
                id,
                4,
                address_npid
            FROM rbs_sites.objects
            WHERE address_npid IS NOT NULL');
            
        $this->execute('
            INSERT INTO address_np (id, name, capital)
            SELECT id, name, capital FROM rbs_sites.address_np');
                        
//         $this->execute('
//             INSERT INTO address_np (id, name)
//             SELECT id, name FROM rbs_sites.address_np');
        
        // делаем типы улиц
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT 
                id,
                5,
                address_typestrid
            FROM rbs_sites.objects
            WHERE address_typestrid IS NOT NULL');
            
        $this->execute('
            INSERT INTO address_typestr (id, name, position)
            SELECT id, name, pos FROM rbs_sites.address_typestr');
        
        // делаем улицы
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT 
                id,
                6,
                address_strid
            FROM rbs_sites.objects
            WHERE address_strid IS NOT NULL');
            
        $this->execute('
            INSERT INTO address_str (id, name)
            SELECT id, name FROM rbs_sites.address_str');
        
        // делаем номера домов
        $this->execute('
            INSERT INTO address_b (value)
            SELECT address_b 
            FROM rbs_sites.objects o
            WHERE o.address_b IS NOT NULL 
            GROUP BY o.address_b 
            ORDER BY o.address_b
        ');
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT 
                o.id, 
                7, 
                a.id 
            FROM address_b a, rbs_sites.objects o 
            WHERE a.value LIKE o.address_b AND o.address_b IS NOT NULL');
               
        // делаем название месности
        $this->execute('
            INSERT INTO address_descr (value)
            SELECT address_descr
            FROM rbs_sites.objects 
            WHERE address_descr IS NOT NULL 
            GROUP BY address_descr 
            ORDER BY address_descr
        ');
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT 
                o.id, 
                8, 
                a.id 
            FROM address_descr a, rbs_sites.objects o 
            WHERE a.value LIKE o.address_descr AND o.address_descr IS NOT NULL');
               
        // делаем комментарий
        $this->execute('
            INSERT INTO address_comment (value)
            SELECT comment 
            FROM rbs_sites.objects 
            WHERE comment IS NOT NULL 
            GROUP BY comment 
            ORDER BY comment
        ');
        
        $this->execute('
            INSERT INTO addresses (objid, typeid, valueid)
            SELECT 
                o.id, 
                9, 
                a.id 
            FROM address_comment a, rbs_sites.objects o 
            WHERE a.value LIKE o.comment AND o.comment IS NOT NULL');
       
    }


    
    public function down()
    {
        echo "m170207_115258_insert_objects cannot be reverted.\n";
	
        $this->truncateTable('address_gps');
        $this->truncateTable('addresses');
        $this->truncateTable('address_obl');
        $this->truncateTable('address_rn');
        $this->truncateTable('address_typenp');
        $this->truncateTable('address_np');
        $this->truncateTable('address_typestr');
        $this->truncateTable('address_str');
        $this->truncateTable('address_b');
        $this->truncateTable('address_descr');	
        $this->truncateTable('address_comment');

	
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
