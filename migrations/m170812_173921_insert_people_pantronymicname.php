<?php

use yii\db\Migration;

class m170812_173921_insert_people_pantronymicname extends Migration
{
    public function up()
    {
		//добавляем имена в справочник имён	
		$this->execute('
			INSERT INTO people_patronymicname (name)
			SELECT patronymicname FROM people
			WHERE patronymicname IS NOT NULL
			GROUP BY patronymicname ORDER BY patronymicname');
        
        //имена
		//временная таблица для выделения имён в отдельную табилицу
		if ($this->db->driverName == 'mysql') {
            $this->execute('
                CREATE TEMPORARY TABLE `tmp` (
                    `manid` int(11) NOT NULL,
                    `patronymicnameid` int(11) NOT NULL
            )');
		} elseif ($this->db->driverName == 'pgsql') {
            $this->execute('
                CREATE TEMPORARY TABLE tmp (
                    manid integer NOT NULL,
                    patronymicnameid integer NOT NULL
            )');
		};
	
		$this->execute('
            INSERT INTO tmp (manid, patronymicnameid)
			SELECT rbsu.id, us.id 
			FROM people_patronymicname us, people rbsu 
			WHERE us.name LIKE rbsu.patronymicname');
			
        if ($this->db->driverName == 'mysql') {
            $this->execute('
                UPDATE people AS u, tmp AS t SET u.patronymicnameid = t.patronymicnameid 
                WHERE u.id = t.manid');
        } elseif ($this->db->driverName == 'pgsql') {
            $this->execute('
                UPDATE people
                SET patronymicnameid = tmp.patronymicnameid
                FROM tmp
                WHERE people.id = tmp.manid
            ');
        }

		$this->dropTable('tmp');
// 		$this->dropColumn('people', 'patronymicname');
    }

    public function down()
    {
        echo "m170812_173921_insert_pantronymicname cannot be reverted.\n";
        $this->truncateTable('people_patronymicname');
        return true;
    }

}
