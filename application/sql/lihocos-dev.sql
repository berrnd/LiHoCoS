/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blinds` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `position` tinyint(4) DEFAULT '0',
  `last_change` datetime NOT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `blinds` VALUES (1,'test1233',2,10,'0000-00-00 00:00:00','10004');
INSERT INTO `blinds` VALUES (5,'test2',1,NULL,'0000-00-00 00:00:00','xx1');
INSERT INTO `blinds` VALUES (6,'1',1,0,'2014-03-24 12:40:40',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blinds_history` (
  `id` int(11) NOT NULL,
  `blind_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `position` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_blinds_history` (`blind_id`,`timestamp`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `blinds_history` VALUES (1,1,'0000-00-00 00:00:00',100);
INSERT INTO `blinds_history` VALUES (2,1,'0000-00-00 00:00:00',10);
INSERT INTO `blinds_history` VALUES (3,6,'2014-03-24 12:40:40',0);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cameras` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `snapshot_url` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  `username` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `password` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `cameras` VALUES (1,'test1',0,'','','',NULL);
INSERT INTO `cameras` VALUES (2,'Cam1',1,'http://192.168.91.102/video/mjpg.cgi','admin','5tWZlqqW',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `fqdn` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `mac` varchar(17) COLLATE latin1_german1_ci DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `computers` VALUES (1,'computer1',0,'fqdn1','',NULL);
INSERT INTO `computers` VALUES (2,'1',0,'Computer.domain.local','00:00:00:00:00:00',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `doors` VALUES (1,'0',2,0,'2014-02-16 11:21:50','KEQ0017274:1');
INSERT INTO `doors` VALUES (2,'0',1,NULL,NULL,NULL);
INSERT INTO `doors` VALUES (3,'0',1,NULL,NULL,NULL);
INSERT INTO `doors` VALUES (4,'1',1,0,'0000-00-00 00:00:00',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doors_history` (
  `id` int(11) NOT NULL,
  `door_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_doors_history` (`door_id`,`timestamp`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `doors_history` VALUES (1,1,'2014-02-16 11:21:29',1);
INSERT INTO `doors_history` VALUES (2,1,'2014-02-16 11:21:50',0);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lights` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `lights` VALUES (1,'llight1',1,NULL,NULL,NULL);
INSERT INTO `lights` VALUES (2,'1',1,0,'0000-00-00 00:00:00',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lights_history` (
  `id` int(11) NOT NULL,
  `light_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_lights_history` (`light_id`,`timestamp`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `rooms` VALUES (1,'raum1');
INSERT INTO `rooms` VALUES (2,'raum22');
INSERT INTO `rooms` VALUES (3,'Room1');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `type` varchar(20) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `temperature` decimal(3,1) DEFAULT NULL,
  `relative_humidity` decimal(3,1) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `sensors` VALUES (1,'','HYGROONLY',2,NULL,NULL,NULL,NULL);
INSERT INTO `sensors` VALUES (2,'1','THERMOHYGR',1,-1.0,-1.0,'0000-00-00 00:00:00',NULL);
INSERT INTO `sensors` VALUES (3,'1','THERMOHYGR',1,-1.0,-1.0,'0000-00-00 00:00:00',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensors_history` (
  `id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `temperature` decimal(3,1) NOT NULL,
  `relative_humidity` decimal(3,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_sensors_history` (`sensor_id`,`timestamp`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `sessions` VALUES ('a6069ceb7940434f712cf2425d3f12b0','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36',1401268506,'a:1:{s:4:\"user\";O:8:\"stdClass\":6:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:5:\"admin\";s:9:\"firstname\";s:5:\"Admin\";s:8:\"lastname\";N;s:5:\"email\";N;s:8:\"password\";s:40:\"d033e22ae348aeb5660fc2140aec35850c4da997\";}}');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE latin1_german1_ci NOT NULL,
  `value` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IX_settings` (`name`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `settings` VALUES (2,'language','en');
INSERT INTO `settings` VALUES (3,'plugin_doors','DemoDoorsPlugin');
INSERT INTO `settings` VALUES (4,'plugin_lights','DemoLightsPlugin');
INSERT INTO `settings` VALUES (5,'plugin_sensors','TellStickForSensors');
INSERT INTO `settings` VALUES (6,'plugin_windows','DemoWindowsPlugin');
INSERT INTO `settings` VALUES (7,'plugin_blinds','DemoBlindsPlugin');
INSERT INTO `settings` VALUES (8,'plugin_RademacherHomePilot_homepilot_base_url','http://192.168.91.101/');
INSERT INTO `settings` VALUES (9,'modelclass','blinds_model');
INSERT INTO `settings` VALUES (10,'id','1');
INSERT INTO `settings` VALUES (11,'value','xx2');
INSERT INTO `settings` VALUES (12,'temp123','1');
INSERT INTO `settings` VALUES (13,'default_data_inserted','1');
INSERT INTO `settings` VALUES (14,'timezone','Europe/Berlin');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `firstname` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `lastname` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `password` varchar(1000) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `users` VALUES (1,'bernd','Bernd','Bestel','bernd@berrnd.de','537fbe67df61ff679eb89705ad76a7f1c4e05f51');
INSERT INTO `users` VALUES (2,'admin','Admin',NULL,NULL,'d033e22ae348aeb5660fc2140aec35850c4da997');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `windows` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `state` varchar(10) COLLATE latin1_german1_ci DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `plugin_reference` varchar(1000) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `windows` VALUES (1,'window1',1,'TILTED','2014-02-16 11:14:56','KEQ0017274:1');
INSERT INTO `windows` VALUES (2,'x2',1,'CLOSED','2014-02-16 11:12:31',NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `windows_history` (
  `id` int(11) NOT NULL,
  `window_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `state` varchar(10) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_windows_history` (`window_id`,`timestamp`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `windows_history` VALUES (1,1,'2014-02-16 11:14:56','TILTED');
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

