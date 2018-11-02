<?php

use yii\db\Migration;

/**
 * Class m181031_061256_insert_lists
 */
class m181031_061256_insert_lists extends Migration
{


    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		$connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT
				spiski_id,
				work_id
			FROM spiski_temp_workers
        ');
        $codes = $model->queryAll();
        
        foreach($codes as $code) {
            $this->insert('letters_lists',
                [
					'letterid' => $code['spiski_id'],
					'manid' => $code['work_id']
                ]
            );
        };
    }

    public function down()
    {
        echo "m181031_061256_insert_lists cannot be reverted.\n";
		$this->truncateTable('letters_lists');
        return true;
    }
    
}
