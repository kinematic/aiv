<?php

use yii\db\Migration;

class m170812_175257_insert_people_position extends Migration
{
    public function up()
    {
		//добавляем должности в справочник
		$this->execute('
			INSERT INTO people_position (name)
			SELECT position FROM people
			WHERE position IS NOT NULL
			GROUP BY position ORDER BY position');
        
        //имена
		//временная таблица для выделения имён в отдельную табилицу
		if ($this->db->driverName == 'mysql') {
            $this->execute('
                CREATE TEMPORARY TABLE `tmp` (
                    `manid` int(11) NOT NULL,
                    `positionid` int(11) NOT NULL
            )');
		} elseif ($this->db->driverName == 'pgsql') {
            $this->execute('
                CREATE TEMPORARY TABLE tmp (
                    manid integer NOT NULL,
                    positionid integer NOT NULL
            )');
		};
	
		$this->execute('
            INSERT INTO tmp (manid, positionid)
			SELECT rbsu.id, us.id 
			FROM people_position us, people rbsu 
			WHERE us.name LIKE rbsu.position');
			
        if ($this->db->driverName == 'mysql') {
            $this->execute('
                UPDATE people AS u, tmp AS t SET u.positionid = t.positionid 
                WHERE u.id = t.manid');
        } elseif ($this->db->driverName == 'pgsql') {
            $this->execute('
                UPDATE people
                SET positionid = tmp.positionid
                FROM tmp
                WHERE people.id = tmp.manid
            ');
        }

		$this->dropTable('tmp');
// 		$this->dropColumn('people', 'secondname');
    }

    public function down()
    {
        echo "m170812_175257_insert_position cannot be reverted.\n";
        $this->truncateTable('people_position');
        return true;
    }
}
