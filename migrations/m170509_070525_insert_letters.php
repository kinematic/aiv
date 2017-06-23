<?php

use yii\db\Migration;

class m170509_070525_insert_letters extends Migration
{
    public function up()
    {
		 $this->execute('
            INSERT INTO letters_letters (
				objid, 
				appeal1, 
				appeal2, 
				appeal3,
				text1,
				text2,
				-- delivery,
				-- removal
				signid
			)
            SELECT
                obj_id,
                org_rank,
                fio,
				io,
				all_text_first,
				all_text_last,
				-- zavoz,
				-- vyvoz
				sign_id
            FROM rbs_sites.spiski
            WHERE obj_id');

		 $this->execute('
            INSERT INTO letters_signature (
				id,
				userid
			)
            SELECT
				id,
                userid
            FROM rbs_sites.signature
            WHERE userid IS NOT NULL
		');

    }

    public function down()
    {
        echo "m170509_070525_insert_letters cannot be reverted.\n";
		$this->truncatetable('letters_letters');
		$this->truncatetable('letters_signature');
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
