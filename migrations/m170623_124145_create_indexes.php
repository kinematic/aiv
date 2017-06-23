<?php

use yii\db\Migration;

class m170623_124145_create_indexes extends Migration
{
    public function up()
    {

        $this->createIndex('typeid', 'sites', 'typeid', false);
        $this->createIndex('regionid', 'sites', 'regionid', false);
        $this->createIndex('nr', 'sites', 'nr', false);
        $this->createIndex('objid', 'sites', 'objid', false);
        
        $this->createIndex('name', 'sitestype', 'name', false);
        
        $this->createIndex('oblid', 'sitesregion', 'oblid', false);
        
        $this->createIndex('objid', 'addresses', 'objid', false);
        $this->createIndex('typeid', 'addresses', 'typeid', false);
        $this->createIndex('valueid', 'addresses', 'valueid', false);

        
    }

    public function down()
    {
        echo "m170623_124145_create_indexes cannot be reverted.\n";

        return false;
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
