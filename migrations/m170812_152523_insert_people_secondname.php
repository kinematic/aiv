<?php

use yii\db\Migration;

class m170812_152523_insert_people_secondname extends Migration
{
    public function up()
    {
		//добавляем имена в справочник имён	
		$this->execute('
			INSERT INTO people_secondname (name)
			SELECT secondname FROM people
			WHERE secondname IS NOT NULL
			GROUP BY secondname ORDER BY secondname');
        
        //имена
		//временная таблица для выделения имён в отдельную табилицу
		if ($this->db->driverName == 'mysql') {
            $this->execute('
                CREATE TEMPORARY TABLE `tmp` (
                    `manid` int(11) NOT NULL,
                    `secondnameid` int(11) NOT NULL
            )');
		} elseif ($this->db->driverName == 'pgsql') {
            $this->execute('
                CREATE TEMPORARY TABLE tmp (
                    manid integer NOT NULL,
                    secondnameid integer NOT NULL
            )');
		
		};
	
		$this->execute('
            INSERT INTO tmp (manid, secondnameid)
			SELECT rbsu.id, us.id 
			FROM people_secondname us, people rbsu 
			WHERE us.name LIKE rbsu.secondname');
			
        if ($this->db->driverName == 'mysql') {
            $this->execute('
                UPDATE people AS u, tmp AS t SET u.secondnameid = t.secondnameid 
                WHERE u.id = t.manid');
        } elseif ($this->db->driverName == 'pgsql') {
            $this->execute('
                UPDATE people
                SET secondnameid = tmp.secondnameid
                FROM tmp
                WHERE people.id = tmp.manid
            ');
        }

		$this->dropTable('tmp');
// 		$this->dropColumn('people', 'secondname');
    }
    
    public function down()
    {
        echo "m170812_152523_insert_people_secondname cannot be reverted.\n";
        $this->truncateTable('people_secondname');
        return true;
    }
}
