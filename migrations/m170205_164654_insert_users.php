<?php

use yii\db\Migration;

class m170205_164654_insert_users extends Migration
{
    public function up()
    {
        //добавляем фамилии людей и компании
		$this->execute('
			INSERT INTO people (
                id, 
                firstname,
                companyid)
			SELECT 
                id, 
                trim(fam), 
                comp_id
			FROM rbs_sites.user 
        ');
        //добавляем пользователей сайта
        $this->execute('
			INSERT INTO users (
                manid, 
                email, 
                mobilephone, 
                status, 
                visit)
			SELECT 
                id, 
                trim(email), 
                trim(REPLACE(mob, "+380", "")), 
                NULLIF(login, 0), 
                last_visit 
			FROM rbs_sites.user 
			');
		
		//добавляем имена в справочник имён	
		$this->execute('
			INSERT INTO people_secondname (name)
			SELECT trim(rbsu.imya) i FROM people u
			INNER JOIN rbs_sites.user rbsu ON rbsu.id = u.id
			GROUP BY i ORDER BY i');
		
		//добавляем отчества в справочник отчеств
		$this->execute('
			INSERT INTO people_patronymicname (name)
			SELECT trim(rbsu.otch) i FROM people u
			INNER JOIN rbs_sites.user rbsu ON rbsu.id = u.id
			GROUP BY i ORDER BY i');
		
		//добавляем должности в спавочник должностей
		$this->execute('
			INSERT INTO people_position (name)
			SELECT trim(rbsu.rank) i FROM people u
			INNER JOIN rbs_sites.user rbsu ON rbsu.id = u.id
			WHERE rbsu.rank IS NOT NULL
			GROUP BY i ORDER BY i');
		
		//добавляем данные по электробезопасности
        $this->execute('
			INSERT INTO people_electrosafety (manid, groupid)
			SELECT 
                rbsu.id, 
                CASE rbsu.el_bez 
                    WHEN "III" THEN 3
                    WHEN "IV" THEN 4
                    WHEN "V" THEN 5
                END AS i
            FROM rbs_sites.user rbsu
			WHERE rbsu.el_bez IS NOT NULL');
		
		//добавляем пасспортные данные
        $this->execute('
			INSERT INTO people_passport (
                manid, 
                number,
                issued,
                birthday,
                placebirth,
                registration,
                residence
            )
			SELECT 
                id,
                pass_serial,
                pass,
                STR_TO_DATE(birthday, "%d.%m.%Y"),
                place_birth,
                place_pass,
                place_live
            FROM rbs_sites.user
			WHERE 
                pass_serial IS NOT NULL
                OR pass IS NOT NULL
                OR birthday IS NOT NULL
                OR place_birth IS NOT NULL
                OR place_pass IS NOT NULL
                OR place_live IS NOT NULL
        ');
			
		//имена
		//временная таблица для выделения имён в отдельную табилицу
		$this->execute('
            CREATE TEMPORARY TABLE `tmp` (
                `userid` int(11) NOT NULL,
                `secondnameid` int(11) NOT NULL
            )');
			
		$this->execute('
            INSERT INTO tmp (userid, secondnameid)
			SELECT rbsu.id, us.id 
			FROM people_secondname us, rbs_sites.user rbsu 
			WHERE us.name like rbsu.imya');
		
		$this->execute('
			UPDATE people u, tmp t SET u.secondnameid = t.secondnameid 
			WHERE u.id = t.userid');		
		
		$this->dropTable('tmp');
        
        //отчества
		//временная таблица для выделения отчеств в отдельную табилицу
		$this->execute('
            CREATE TEMPORARY TABLE `tmp` (
                `userid` int(11) NOT NULL,
                `pnameid` int(11) NOT NULL
            )');
			
		$this->execute('
            INSERT INTO tmp (userid, pnameid)
			SELECT rbsu.id, us.id 
			FROM people_patronymicname us, rbs_sites.user rbsu 
			WHERE us.name like rbsu.otch');
		
		$this->execute('
			UPDATE people u, tmp t SET u.patronymicnameid = t.pnameid 
			WHERE u.id = t.userid');		
		
		$this->dropTable('tmp');
		
        //должности
		//временная таблица для выделения должностей в отдельную табилицу
        $this->execute('
            CREATE TEMPORARY TABLE `tmp` (
                `userid` int(11) NOT NULL,
                `rankid` int(11) NOT NULL
            )');
        
        //делаем таблцу иденификаторов: пользователь -> должность
		$this->execute('
            INSERT INTO tmp (userid, rankid)
			SELECT rbsu.id, us.id 
			FROM people_position us, rbs_sites.user rbsu 
			WHERE us.name like rbsu.rank');
		
		$this->execute('
			UPDATE people u, tmp t SET u.positionid = t.rankid 
			WHERE u.id = t.userid');		
		
		$this->dropTable('tmp');
		
		$this->execute('
			UPDATE users SET status = 5
			WHERE id = 159');
        		
		 $this->execute('
            INSERT INTO people_companies (
				id,
				simplename,
				officialname
			)
            SELECT
				id,
                name,
                title
            FROM rbs_sites.companies
		');
    }

    public function down()
    {
        echo "m170205_164654_insert_users cannot be reverted.\n";
        $this->truncateTable('people');
        $this->truncateTable('people_position');
        $this->truncateTable('people_electrosafety');
        $this->truncateTable('people_passport');
		$this->truncateTable('users');
		$this->truncateTable('people_secondname');
		$this->truncateTable('people_patronymicname');
		$this->truncateTable('people_companies');
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
