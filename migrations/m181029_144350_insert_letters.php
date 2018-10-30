<?php

use yii\db\Migration;

/**
 * Class m181029_144350_insert_letters
 */
class m181029_144350_insert_letters extends Migration
{

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT
				obj_id,
				Org_rank,
				FIO,
				IO,
				All_text_first,
				All_text_last,
				Sign_id
			FROM spiski
        ');
        $codes = $model->queryAll();
        
        foreach($codes as $code) {
            $this->insert('letters_letters',
                [
					'objid' => $code['obj_id'], 
					'appeal1' => $code['Org_rank'],
					'appeal2' => $code['FIO'],
					'appeal3' => $code['IO'],
					'text1' => $code['All_text_first'],
					'text2' => $code['All_text_last'],
                    'signid' => $code['Sign_id']
                ]
            );
        };
    }

    public function down()
    {
        echo "m181029_144350_insert_letters cannot be reverted.\n";
		$this->truncateTable('letters_letters');
        return true;
    }
    
}
