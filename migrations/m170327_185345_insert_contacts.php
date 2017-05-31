<?php

use yii\db\Migration;

class m170327_185345_insert_contacts extends Migration
{
    public function up()
    {
		 $this->execute('
            INSERT INTO contacts (objid, contact, description)
            SELECT
                obj_id,
                phone,
                rank
            FROM rbs_sites.phones
            WHERE obj_id');
    }

    public function down()
    {
        echo "m170327_185345_insert_contacts cannot be reverted.\n";
		$this->truncatetable('contacts');
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
