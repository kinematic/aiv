<?php

use yii\db\Migration;

class m180720_183849_create_siteaccess extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		if ($this->db->driverName == 'mysql') $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		else $options = null;
		// таблица журнала входов на сайт
        $this->createTable('siteaccess', [
            'id' => $this->primaryKey(),
			'serverserial' => $this->biginteger()->notNull(),
			'mo' => $this->string(5)->defaultValue(null),
			'customer' => $this->string(70)->defaultValue(null),
			'node' => $this->string(70)->defaultValue(null),
			'nodealias' => $this->string(70)->defaultValue(null),
			'summary' => $this->string(255)->defaultValue(null),
			'username' => $this->string(45)->defaultValue(null),
			'phone' => $this->integer()->defaultValue(null),
			'firstoc' => $this->integer()->defaultValue(null),
			'cleartime' => $this->integer()->defaultValue(null),
			'siteid' => $this->integer()->defaultValue(null),
			'objid' => $this->integer()->defaultValue(null),
			'userid' => $this->integer()->defaultValue(null),
        ], $options);
    }

    public function down()
    {
        echo "m180720_183849_create_table_siteaccess cannot be reverted.\n";
		$this->dropTable('siteaccess');
        return true;
    }
}
