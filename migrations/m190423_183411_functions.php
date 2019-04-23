<?php

use yii\db\Migration;

/**
 * Class m190423_183411_functions
 */
class m190423_183411_functions extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		Yii::$app->db->createCommand(
			"
				CREATE OR REPLACE FUNCTION status(word TEXT) RETURNS INT AS $$
				DECLARE
				BEGIN
					IF word = 'Эксплуатация' THEN 
						RETURN 4;
					ELSIF word = 'Планируемый' THEN
						RETURN 3;
					ELSIF word = 'Строящийся' THEN
						RETURN 6;
					ELSIF word = 'Закрыт' THEN
						RETURN 7;
					ELSE RETURN NULL;
					END IF;
				END;
				$$ LANGUAGE 'plpgsql'
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				CREATE OR REPLACE FUNCTION inventory(word TEXT) RETURNS INT AS $$
				DECLARE
				BEGIN
					IF word = 'True' THEN 
						RETURN 1;
					ELSIF word = 'False' THEN
						RETURN NULL;
					ELSE RETURN NULL;
					END IF;
				END;
				$$ LANGUAGE 'plpgsql'
			"
		)->execute();
	}

    public function down()
    {
        echo "m190423_183411_functions cannot be reverted.\n";

        return false;
    }
 
}

CREATE DATABASE  IF NOT EXISTS `rbs_mustang` /*!40100 DEFAULT CHARACTER SET cp1251 */;
USE `rbs_mustang`;
-- MySQL dump 10.13  Distrib 5.7.2-m12, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: rbs_mustang
-- ------------------------------------------------------
-- Server version	5.7.2-m12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping routines for database 'rbs_mustang'
--
/*!50003 DROP FUNCTION IF EXISTS `concat_addresses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`%` FUNCTION `concat_addresses`(address1 TEXT, address2 TEXT, address3 TEXT) RETURNS text CHARSET cp1251
BEGIN
	DECLARE address TEXT DEFAULT NULL;
	DECLARE len1, len2, len3 INT DEFAULT 0;
	SET address1:=TRIM(address1);
	SET address2:=TRIM(address2);
	SET address3:=TRIM(address3);
	SET len1:=IFNULL(char_length(address1), 0);
	SET len2:=IFNULL(char_length(address2), 0);
	SET len3:=IFNULL(char_length(address3), 0);
	IF len1 >= len2 AND len1 >= len3 THEN
		SET address:=address1;
	ELSE IF len2 > len1 AND len2 > len3 THEN
		SET address:=address2;
	ELSE IF len3 > len1 AND len3 > len2 THEN
		SET address:=address3;
	ELSE 
		SET address:=CONCAT_WS('\n\r', address1, address2, address3);
	END IF; END IF; END IF;
	SET address:=REPLACE(address, '.', '. ');
	SET address:=REPLACE(address, ',', ', ');
	SET address:=REPLACE(address, '  ', ' ');
	-- SET address:=TRIM(address);
RETURN NULLIF(address, '');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `correct_sitename` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp1251 */ ;
/*!50003 SET character_set_results = cp1251 */ ;
/*!50003 SET collation_connection  = cp1251_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`%` FUNCTION `correct_sitename`(sitename CHAR(30)) RETURNS char(30) CHARSET cp1251
BEGIN
	SET sitename := REPLACE(sitename, ' ', '');
	SELECT REPLACE(sitename, mustangname, name) INTO sitename FROM correct_name WHERE sitename LIKE mustangname LIMIT 0,1;
RETURN sitename;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `define_molid` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`localhost` FUNCTION `define_molid`(man CHAR(255) CHARSET cp1251) RETURNS int(11)
BEGIN
		DECLARE p INT DEFAULT null;
		SET man=TRIM(man);
		SELECT rbs_sites.user.userid INTO p
		FROM rbs_sites.user 
		WHERE INSTR(man, CONCAT(rbs_sites.user.fam, ' ', LEFT(rbs_sites.user.imya, 1), '.', LEFT(rbs_sites.user.otch, 1), '.'))=1 LIMIT 0,1;
		
	RETURN p;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `define_nr` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp1251 */ ;
/*!50003 SET character_set_results = cp1251 */ ;
/*!50003 SET collation_connection  = cp1251_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`%` FUNCTION `define_nr`(sitename CHAR(30), typeid INT(11), regionid INT(11)) RETURNS char(30) CHARSET cp1251
BEGIN
    SELECT REPLACE(sitename, searched_name, '') INTO sitename FROM rbs_sites.sitestype WHERE rbs_sites.sitestype.id = typeid;
    SELECT REPLACE(sitename, rbs_sites.sitesregion.name, '') INTO sitename FROM rbs_sites.sitesregion WHERE rbs_sites.sitesregion.id = regionid;
    SELECT REPLACE(sitename, IFNULL(rbs_sites.sitesregion.shortname, ''), '') INTO sitename FROM rbs_sites.sitesregion WHERE rbs_sites.sitesregion.id = regionid;
RETURN sitename;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `define_regionid` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp1251 */ ;
/*!50003 SET character_set_results = cp1251 */ ;
/*!50003 SET collation_connection  = cp1251_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`%` FUNCTION `define_regionid`(sitename CHAR(30), typeid INT(11)) RETURNS int(11)
BEGIN
	DECLARE regionid INT DEFAULT NULL;
   IF typeid THEN 
        SELECT REPLACE(sitename, REPLACE(rbs_sites.sitestype.name, ' ', ''), '') INTO sitename FROM rbs_sites.sitestype WHERE rbs_sites.sitestype.id = typeid;
	END IF;
   SELECT rbs_sites.sitesregion.id INTO regionid 
   FROM rbs_sites.sitesregion 
   WHERE INSTR(sitename, rbs_sites.sitesregion.name)=1 AND rbs_sites.sitesregion.id<>13 
   ORDER BY LENGTH(rbs_sites.sitesregion.name) DESC LIMIT 0,1;
   IF regionid IS NULL THEN
        SELECT rbs_sites.sitesregion.id INTO regionid 
        FROM rbs_sites.sitesregion 
        WHERE INSTR(sitename, rbs_sites.sitesregion.shortname)=1 
        AND rbs_sites.sitesregion.id<>13 AND rbs_sites.sitesregion.shortname IS NOT NULL
        ORDER BY LENGTH(rbs_sites.sitesregion.name) DESC LIMIT 0,1;
   END IF;
	IF regionid IS NULL THEN  
		SELECT rbs_sites.sitestype.regionid INTO regionid FROM rbs_sites.sitestype WHERE rbs_sites.sitestype.id = typeid;
			IF regionid=0 THEN SET regionid := 13;
			ELSE SET regionid := NULL;
			END IF;
		END IF;
RETURN regionid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `define_statusid` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`localhost` FUNCTION `define_statusid`(statusname CHAR(30)) RETURNS int(11)
BEGIN
		DECLARE p INT DEFAULT 2;
		SET statusname=TRIM(statusname);
		SELECT id INTO p FROM rbs_sites.work_status WHERE rbs_sites.work_status.name LIKE statusname LIMIT 0,1;
		IF NOT p THEN SET p=2;
		END IF;
		RETURN p;
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `define_typeid` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp1251 */ ;
/*!50003 SET character_set_results = cp1251 */ ;
/*!50003 SET collation_connection  = cp1251_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`%` FUNCTION `define_typeid`(sitename CHAR(30)) RETURNS int(11)
BEGIN
	DECLARE typeid INT(11);
	SELECT rbs_sites.sitestype.id INTO typeid FROM rbs_sites.sitestype WHERE INSTR(sitename, searched_name)=1 ORDER BY LENGTH(rbs_sites.sitestype.name) DESC LIMIT 0,1;
RETURN typeid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `replace_symbol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kinematic`@`%` FUNCTION `replace_symbol`(val TEXT) RETURNS text CHARSET cp1251
BEGIN

RETURN NULLIF(REPLACE(val, '?', 'і'), '');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-13 15:26:56

