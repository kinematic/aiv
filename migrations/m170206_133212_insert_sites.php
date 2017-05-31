<?php

use yii\db\Migration;

class m170206_133212_insert_sites extends Migration
{
    public function up()
    {
		$this->execute('
			INSERT INTO sites (
				id, 
				typeid, 
				regionid, 
				nr, 
				objid, 
				relationid,
				mustangaddress,
				description,
				statusid, 
				opendate, 
				closedate, 
				molid, 
				inventdate)
			SELECT 
				id,
				typeid,
				regionid,
				nr,
				objid,
				relationid,
				address,
				comment,
				workstatusid,
				date,
				closedate,
				mol,
				last_invent
			FROM rbs_sites.sites
        ');
        
        $this->execute('
            INSERT INTO sitestype (id, name, visible)
            SELECT id, name, depvis FROM rbs_sites.sitestype');
            
        $this->execute('
            INSERT INTO sitesregion (id, name, shortname, description, oblid, visible, import)
            SELECT id, name, shortname, description, address_oblid, depvis, mustangimport  FROM rbs_sites.sitesregion');
            
        $this->execute('
            ALTER TABLE `sites` ADD INDEX(`typeid`)');
            
        $this->execute('
            ALTER TABLE `sites` ADD INDEX(`regionid`)');
    }
    
    public function down()
    {
        echo "m170206_133212_insert_sites cannot be reverted.\n";
		
		$this->truncateTable('sites');
		$this->truncateTable('sitestype');
		$this->truncateTable('sitesregion');
		
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
