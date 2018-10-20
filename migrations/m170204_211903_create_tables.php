<?php

use yii\db\Migration;

class m170204_211903_create_tables extends Migration
{
    public function up()
    {
		if ($this->db->driverName == 'mysql') $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		else $options = null;

		// удалить эту таблицу после импорта
        $this->createTable('objects', [
            'id' => $this->primaryKey(),
			'address_b' => $this->string(30)->defaultValue(null),
			'comment' => $this->text()->defaultValue(null),
			'address_descr' => $this->string(255)->defaultValue(null),
			'address_oblid' => $this->integer()->defaultValue(null),
			'address_rnid' => $this->integer()->defaultValue(null),
			'address_typenpid' => $this->integer()->defaultValue(null),
			'address_npid' => $this->integer()->defaultValue(null),
			'address_typestrid' => $this->integer()->defaultValue(null),
			'address_strid' => $this->integer()->defaultValue(null),
			'gpslat' => $this->integer()->defaultValue(null),
			'gpslong' => $this->integer()->defaultValue(null),
        ], $options);
		
        $this->createTable('addresses', [
            'id' => $this->primaryKey(),
			'objid' => $this->integer()->notNull(),
			'typeid' => $this->integer()->notNull(),
			'valueid' => $this->integer()->notNull(),
        ], $options);
			        
        $this->createTable('address_b', [
            'id' => $this->primaryKey(),
            'value' => $this->string(30)->notNull(),
        ], $options);
					        
        $this->createTable('address_comment', [
            'id' => $this->primaryKey(),
            'value' => $this->text()->notNull(),
        ], $options);
						        
        $this->createTable('address_descr', [
            'id' => $this->primaryKey(),
            'value' => $this->string(255)->notNull(),
        ], $options);
									        
        $this->createTable('address_np', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
			'capital' => $this->integer()->defaultValue(null),
        ], $options);
									        
        $this->createTable('address_obl', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
        ], $options);
												        
        $this->createTable('address_rn', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
        ], $options);
															        
        $this->createTable('address_str', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
        ], $options);
																	        
        $this->createTable('address_typenp', [
            'id' => $this->primaryKey(),
            'name' => $this->string(18)->notNull(),
        ], $options);
												        
        $this->createTable('address_typestr', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
			'position' => $this->smallInteger()->defaultValue(null),
        ], $options);
															        
        $this->createTable('address_gps', [
            'id' => $this->primaryKey(),
			'lat' => $this->integer()->defaultValue(null),
			'long' => $this->integer()->defaultValue(null),
        ], $options);
											        
        $this->createTable('sites', [
            'id' => $this->primaryKey(),
			'typeid' => $this->integer()->notNull(),
			'regionid' => $this->integer()->notNull(),
            'nr' => $this->string(32)->notNull(),
			'objid' => $this->integer()->defaultValue(null),
			'relationid' => $this->smallInteger()->defaultValue(null),
			'mustangaddress' => $this->string(255)->defaultValue(null),
			'description' => $this->text()->defaultValue(null),
			'statusid' => $this->integer()->defaultValue(null),
			'opendate' => $this->date()->defaultValue(null),
			'closedate' => $this->date()->defaultValue(null),
			'molid' => $this->integer()->defaultValue(null),
			'inventdate' => $this->date()->defaultValue(null),
        ], $options);
														        
        $this->createTable('sitesregion', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
			'shortname' => $this->string(2)->defaultValue(null),
			'description' => $this->string(30)->defaultValue(null),
			'oblid' => $this->smallInteger()->defaultValue(null),
			'visible' => $this->smallInteger()->defaultValue(null),
			'import' => $this->smallInteger()->defaultValue(null),
        ], $options);
														        
        $this->createTable('sitestype', [
            'id' => $this->primaryKey(),
            'name' => $this->string(11)->notNull(),
			'visible' => $this->smallInteger()->defaultValue(null),
        ], $options);
																			        
        $this->createTable('people_secondname', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
        ], $options);
																					        
        $this->createTable('people_patronymicname', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
        ], $options);
		
		$this->createTable('users', [
            'id' => $this->primaryKey(),
			'manid' => $this->integer()->notNull(),
            'email' => $this->string(50)->defaultValue(null),
            'mobilephone' => $this->integer()->notNull(),
            'status' => $this->integer(1)->defaultValue(null),
            'created' => $this->date()->defaultValue(null),
            'updated' => $this->date()->defaultValue(null),
            'visit' => $this->date()->defaultValue(null),
            'auth_key' => $this->string(32)->defaultValue(null),
            'password_hash' => $this->string(255)->defaultValue(null),
            'password_reset_token' => $this->string(255)->defaultValue(null),
        ], $options);
            
		$this->createTable('people', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(32)->notNull(),
			'secondnameid' => $this->integer()->defaultValue(null),
			'patronymicnameid' => $this->integer()->defaultValue(null),
			'districtid' => $this->integer()->defaultValue(null),
			'companyid' => $this->integer()->defaultValue(null),
			'positionid' => $this->integer()->defaultValue(null),
		//удалить эти столбцы после импорта
			'secondname' => $this->string(32)->notNull(),
			'patronymicname' => $this->string(32)->notNull(),
			'position' => $this->string(50)->defaultValue(null),
        ], $options);
        
        $this->createTable('people_position', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ], $options);
        
        $this->createTable('people_electrosafety', [
            'id' => $this->primaryKey(),
            'manid' => $this->integer()->notNull(),
            'groupid' => $this->integer()->notNull(),
        ], $options);
                
        $this->createTable('people_passport', [
            'id' => $this->primaryKey(),
            'manid' => $this->integer()->notNull(),
            'number' => $this->string(8)->notNull(),
            'issued' => $this->string(100)->defaultValue(null),
            'birthday' => $this->date()->defaultValue(null),
            'placebirth' => $this->string(80)->defaultValue(null),
            'registration' => $this->string(80)->defaultValue(null),
            'residence' => $this->string(80)->defaultValue(null),
        ], $options);
            
		$this->createTable('contacts', [
            'id' => $this->primaryKey(),
			'objid' => $this->integer()->notNull(),
            'contact' => $this->string(100)->notNull(),
            'description' => $this->string(250)->defaultValue(null),
        ], $options);
		
		//таблица писем
		$this->createTable('letters_letters', [
            'id' => $this->primaryKey(),
			'objid' => $this->integer()->notNull(),
            'appeal1' => $this->string(150)->defaultValue(null),
			'appeal2' => $this->string(50)->defaultValue(null),
			'appeal3' => $this->string(50)->defaultValue(null),
			'firstname' => $this->string(50)->defaultValue(null),
			'secondnameid' => $this->integer()->defaultValue(null),
			'patronymicnameid' => $this->integer()->defaultValue(null),
			'signid' => $this->integer()->defaultValue(null),
            'text1' => $this->text()->defaultValue(null),
			'text2' => $this->text()->defaultValue(null),
// 			'delivery' => $this->text()->defaultValue(null),
// 			'removal' => $this->text()->defaultValue(null),
        ], $options);
		
// 		таблица подписей к письмам
		$this->createTable('letters_signature', [
            'id' => $this->primaryKey(),
            'userid' => $this->integer()->notNull(),
        ], $options);

        $this->createTable('people_companies', [
            'id' => $this->primaryKey(),
            'simplename' => $this->string(50)->defaultValue(null),
            'officialname' => $this->string(150)->defaultValue(null),
        ], $options);
        
        // $this->createTable('inventory_catalog', [
            // 'id' => $this->primaryKey(),
            // 'codename' => $this->string(50)->notNull(),
            // 'description' => $this->string(100)->defaultValue(null),
        // ]);
                
        // $this->createTable('inventory_discrepancy', [
            // 'id' => $this->primaryKey(),
            // 'siteid' => $this->integer()->notNull(),
            // 'catalogid' => $this->integer()->notNull(),
            // 'partcount' => $this->integer()->notNull(),
            // 'discrepancyid' => $this->integer()->notNull(),
            // 'description' => $this->text()->defaultValue(null),
            // 'serialnumbers' => $this->string(255)->defaultValue(null),
        // ]);
        
		//наверно это нужно удалить
//         $this->createIndex('simplename', 'letters_companies', 'simplename', true);
//         $this->createIndex('officialname', 'letters_companies', 'officialname', true);
           
//         $this->execute('
//             ALTER TABLE `users`
//                 ADD PRIMARY KEY (`id`),
//                 ADD UNIQUE KEY `username` (`username`),
//                 ADD UNIQUE KEY `email` (`email`),
//                 ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
//                 ADD KEY `secondname_id` (`secondnameid`),
//                 ADD KEY `patronymicname_id` (`patronymicnameid`)');
//             
//         $this->execute('
//             ALTER TABLE `usersecondname`
//                 ADD PRIMARY KEY (`id`)');
            
        
    }

    public function down()
    {
        echo "m170204_211903_create_tables cannot be reverted.\n";
        $this->dropTable('objects');
        $this->dropTable('addresses');
        $this->dropTable('address_b');
        $this->dropTable('address_comment');
        $this->dropTable('address_descr');
        $this->dropTable('address_np');
        $this->dropTable('address_obl');
        $this->dropTable('address_rn');
        $this->dropTable('address_str');
        $this->dropTable('address_typenp');
        $this->dropTable('address_typestr');
        $this->dropTable('address_gps');
        $this->dropTable('sites');
        $this->dropTable('sitesregion');
        $this->dropTable('sitestype');
        $this->dropTable('people_patronymicname');
        $this->dropTable('users');
        $this->dropTable('people_secondname');
        $this->dropTable('people');
        $this->dropTable('people_position');
        $this->dropTable('people_electrosafety');
        $this->dropTable('people_passport');
        $this->dropTable('contacts');
        $this->dropTable('letters_letters');
        $this->dropTable('people_companies');
        $this->dropTable('letters_signature');
        
        return true;
    }
}
