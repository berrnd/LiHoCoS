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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

