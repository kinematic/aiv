<?php

use yii\db\Migration;

/**
 * Class m181029_153813_insert_signatures
 */
class m181029_153813_insert_signatures extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $connection = \Yii::$app->db2;
        $model = $connection->createCommand('
            SELECT
				userid,
				rank
			FROM signature
        ');
        $codes = $model->queryAll();
        
        foreach($codes as $code) {
            $this->insert('letters_signature',
                [
					'userid' => $code['userid'],
					'position' => $code['rank']
                ]
            );
        };
    }

    public function down()
    {
        echo "m181029_153813_insert_signatures cannot be reverted.\n";
		$this->truncateTable('letters_signature');
        return true;
    }
    
}
