<?php

use yii\db\Migration;

class m180723_123517_create_siteaccess_codes extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		if ($this->db->driverName == 'mysql') $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		else $options = null;
		$this->createTable('siteaccess_codes', [
			'id' => $this->primaryKey(),
			'cramername' => $this->string(50)->defaultValue(null),	
			'pmsite' => $this->string(50)->defaultValue(null),	
			'atolname' => $this->string(50)->defaultValue(null),	
			'code' => $this->integer()->defaultValue(null),	
			'siteid' => $this->integer()->defaultValue(null),
		], $options);
    }

    public function down()
    {
        echo "m180723_123517_craate_siteaccess_codes cannot be reverted.\n";
		$this->dropTable('siteaccess_codes');
        return true;
    }

}
