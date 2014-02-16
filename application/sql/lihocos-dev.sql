
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
DROP TABLE IF EXISTS `blinds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blinds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `position` tinyint(4) DEFAULT '0',
  `last_change` datetime NOT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `blinds` WRITE;
/*!40000 ALTER TABLE `blinds` DISABLE KEYS */;
INSERT INTO `blinds` VALUES (1,'test1233',2,10,'0000-00-00 00:00:00','10004'),(5,'test2',1,NULL,'0000-00-00 00:00:00','xx1'),(6,'1',1,-1,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `blinds` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `blinds_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blinds_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blind_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `position` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_blinds_history` (`blind_id`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `blinds_history` WRITE;
/*!40000 ALTER TABLE `blinds_history` DISABLE KEYS */;
INSERT INTO `blinds_history` VALUES (1,1,'0000-00-00 00:00:00',100),(2,1,'0000-00-00 00:00:00',10);
/*!40000 ALTER TABLE `blinds_history` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cameras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cameras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `mjpeg_stream_url` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  `username` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `password` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cameras` WRITE;
/*!40000 ALTER TABLE `cameras` DISABLE KEYS */;
INSERT INTO `cameras` VALUES (1,'test1',0,'','','',NULL),(2,'1',1,'http://camera/stream','x','x',NULL);
/*!40000 ALTER TABLE `cameras` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `computers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `fqdn` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `mac` varchar(17) COLLATE latin1_german1_ci DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `computers` WRITE;
/*!40000 ALTER TABLE `computers` DISABLE KEYS */;
INSERT INTO `computers` VALUES (1,'computer1',0,'fqdn1','',NULL),(2,'1',0,'Computer.domain.local','00:00:00:00:00:00',NULL);
/*!40000 ALTER TABLE `computers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `doors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `doors` WRITE;
/*!40000 ALTER TABLE `doors` DISABLE KEYS */;
INSERT INTO `doors` VALUES (1,'0',2,0,'2014-02-16 11:21:50','KEQ0017274:1'),(2,'0',1,NULL,NULL,NULL),(3,'0',1,NULL,NULL,NULL),(4,'1',1,0,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `doors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `doors_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doors_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `door_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_doors_history` (`door_id`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `doors_history` WRITE;
/*!40000 ALTER TABLE `doors_history` DISABLE KEYS */;
INSERT INTO `doors_history` VALUES (1,1,'2014-02-16 11:21:29',1),(2,1,'2014-02-16 11:21:50',0);
/*!40000 ALTER TABLE `doors_history` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `lights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `lights` WRITE;
/*!40000 ALTER TABLE `lights` DISABLE KEYS */;
INSERT INTO `lights` VALUES (1,'llight1',1,NULL,NULL,NULL),(2,'1',1,0,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `lights` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `lights_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lights_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `light_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_lights_history` (`light_id`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `lights_history` WRITE;
/*!40000 ALTER TABLE `lights_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `lights_history` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'raum1'),(2,'raum22'),(3,'Room1');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sensors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `type` varchar(20) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `temperature` decimal(3,1) DEFAULT NULL,
  `relative_humidity` decimal(3,1) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sensors` WRITE;
/*!40000 ALTER TABLE `sensors` DISABLE KEYS */;
INSERT INTO `sensors` VALUES (1,'','HYGROONLY',2,NULL,NULL,NULL,NULL),(2,'1','THERMOHYGR',1,-1.0,-1.0,'0000-00-00 00:00:00',NULL),(3,'1','THERMOHYGR',1,-1.0,-1.0,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `sensors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sensors_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensors_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `temperature` decimal(3,1) NOT NULL,
  `relative_humidity` decimal(3,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_sensors_history` (`sensor_id`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sensors_history` WRITE;
/*!40000 ALTER TABLE `sensors_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensors_history` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE latin1_german1_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE latin1_german1_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE latin1_german1_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1c1f174a6ddf643acb9a027edf71d5aa','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392553634,'a:2:{s:9:\"user_data\";s:0:\"\";s:4:\"user\";O:8:\"stdClass\":6:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"bernd\";s:9:\"firstname\";s:5:\"Bernd\";s:8:\"lastname\";s:6:\"Bestel\";s:5:\"email\";s:15:\"bernd@berrnd.de\";s:8:\"password\";s:40:\"537fbe67df61ff679eb89705ad76a7f1c4e05f51\";}}'),('037b558551459cc4c72507fb5be411f7','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393545,''),('0dab09b0a3400f862260b5b381d7242e','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393546,''),('1fba422161e0684486ba44232a33fee7','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393545,''),('2027838fa4eeb0d7c24bb1292f91e5c1','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393546,''),('271462de123dc4e660c13e4fbe50d1d0','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393546,''),('3a3d31c5f01b5f613cd5ae92b83ede24','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393546,''),('539d8257ec11967894858a4d38db6319','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393545,'a:1:{s:4:\"user\";O:8:\"stdClass\":6:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"bernd\";s:9:\"firstname\";s:5:\"Bernd\";s:8:\"lastname\";s:6:\"Bestel\";s:5:\"email\";s:15:\"bernd@berrnd.de\";s:8:\"password\";s:40:\"537fbe67df61ff679eb89705ad76a7f1c4e05f51\";}}'),('53a6815ba55072c8e9e687d510e88c28','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393545,''),('9de659d9aaeda6b9bbebd06bbb4677f3','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393545,''),('b3216a15eac0aa5d53bad5e95fb88132','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392393545,''),('fae2e2d96fe54a59ea4e8ade9d0644ce','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36',1392562280,'');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE latin1_german1_ci NOT NULL,
  `value` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IX_settings` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (2,'language','en'),(3,'plugin_doors','DemoDoorsPlugin'),(4,'plugin_lights','DemoLightsPlugin'),(5,'plugin_sensors','TellStickForSensors'),(6,'plugin_windows','DemoWindowsPlugin'),(7,'plugin_blinds','DemoBlindsPlugin'),(8,'plugin_RademacherHomePilot_homepilot_base_url','http://192.168.91.101/'),(9,'modelclass','blinds_model'),(10,'id','1'),(11,'value','xx2'),(12,'temp123','1'),(13,'default_data_inserted','1'),(14,'timezone','Europe/Berlin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `firstname` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `lastname` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `password` varchar(1000) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bernd','Bernd','Bestel','bernd@berrnd.de','537fbe67df61ff679eb89705ad76a7f1c4e05f51'),(2,'admin','Admin',NULL,NULL,'d033e22ae348aeb5660fc2140aec35850c4da997');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `windows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `windows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` varchar(10) COLLATE latin1_german1_ci DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `windows` WRITE;
/*!40000 ALTER TABLE `windows` DISABLE KEYS */;
INSERT INTO `windows` VALUES (1,'window1',1,'TILTED','2014-02-16 11:14:56','KEQ0017274:1'),(2,'x2',1,'CLOSED','2014-02-16 11:12:31',NULL);
/*!40000 ALTER TABLE `windows` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `windows_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `windows_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `window_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `state` varchar(10) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_windows_history` (`window_id`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `windows_history` WRITE;
/*!40000 ALTER TABLE `windows_history` DISABLE KEYS */;
INSERT INTO `windows_history` VALUES (1,1,'2014-02-16 11:14:56','TILTED');
/*!40000 ALTER TABLE `windows_history` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

