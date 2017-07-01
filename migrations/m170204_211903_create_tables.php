<?php

use yii\db\Migration;

class m170204_211903_create_tables extends Migration
{
    public function up()
    {
        $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    
        $this->execute('
            CREATE TABLE `addresses` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `objid` int(11) NOT NULL,
                `typeid` int(11) NOT NULL,
                `valueid` int(11) NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_b` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `value` varchar(30) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_comment` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `value` text COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_descr` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_np` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
                `capital` smallint(6) DEFAULT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_obl` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_rn` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_str` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);

        $this->createTable('address_typenp', [
            'id' => $this->primaryKey(),
            'name' => $this->string(18)->notNull(),
        ], $options);
            
        $this->execute('
            CREATE TABLE `address_typestr` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
                `position` smallint(6) DEFAULT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `address_gps` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `lat` int(11) DEFAULT NULL,
                `long` int(11) DEFAULT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `sites` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `typeid` int(11) NOT NULL,
                `regionid` int(11) NOT NULL,
                `nr` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
                `objid` int(11) DEFAULT NULL,
                `relationid` smallint(6) DEFAULT NULL,
                `mustangaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                `description` text COLLATE utf8_unicode_ci,
                `statusid` int(11) DEFAULT NULL,
                `opendate` date DEFAULT NULL,
                `closedate` date DEFAULT NULL,
                `molid` int(11) DEFAULT NULL,
                `inventdate` date DEFAULT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `sitesregion` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
                `shortname` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
                `description` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
                `oblid` smallint(6) DEFAULT NULL,
				`visible` smallint(1) DEFAULT NULL,
                `import` smallint(1) DEFAULT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `sitestype` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
				`visible` smallint(1) DEFAULT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `people_secondname` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
        $this->execute('
            CREATE TABLE `people_patronymicname` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
            )' . $options);
            
//         $this->execute('
//             CREATE TABLE `users` (
//                 `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//                 `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//                 `firstname` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
//                 `secondnameid` int(11) DEFAULT NULL,
//                 `patronymicnameid` int(11) DEFAULT NULL,
//                 `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
//                 `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//                 `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
//                 `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//                 `mobilephone` int(11) DEFAULT NULL,
//                 `status` int(11) DEFAULT NULL,
//                 `created_at` date DEFAULT NULL,
//                 `updated_at` date DEFAULT NULL,
//                 `lastlogin` date DEFAULT NULL
//             )');
		
		$this->createTable('users', [
            'id' => $this->primaryKey(),
			'manid' => $this->integer()->notNull(),
            'email' => $this->string(50)->notNull(),
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
			'secondnameid' => $this->integer()->notNull(),
			'patronymicnameid' => $this->integer()->defaultValue(null),
			'companyid' => $this->integer()->defaultValue(null),
			'positionid' => $this->integer()->defaultValue(null),
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
