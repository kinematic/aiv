<?php

use yii\db\Migration;

/**
 * Class m190419_173045_mustang
 */
class m190419_173045_mustang extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		
		if ($this->db->driverName == 'mysql') $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		else $options = null;
		
		$this->createTable('mustang', [
            'id' => $this->primaryKey(),
            'object' => $this->string(200),
			'planedaddress' => $this->text()->defaultValue(null),
			'realaddress' => $this->text()->defaultValue(null),
			'juricaladdress' => $this->text()->defaultValue(null),
			'contacts' => $this->string(200)->defaultValue(null),
			'startdate' => $this->date()->defaultValue(null),
			'closedate' => $this->date()->defaultValue(null),
			'mol' => $this->string(200)->defaultValue(null),
			'status' => $this->string(200)->defaultValue(null),
			'inventory' => $this->string(200)->defaultValue(null),
			'lastinventorydate' => $this->date()->defaultValue(null),
        ], $options);
    }

    public function down()
    {
        echo "m190419_173045_mustang cannot be reverted.\n";
		$this->dropTable('mustang');
        return true;
    }

}
