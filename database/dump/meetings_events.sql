CREATE DATABASE IF NOT EXISTS meetings;
USE meetings;

-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: meetings
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `author` int NOT NULL,
  `paricipant` int DEFAULT NULL,
  `room_id` int NOT NULL,
  `start` varchar(150) NOT NULL,
  `end` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT '""',
  `uniqueid` varchar(50) DEFAULT '""',
  `freq_rule` varchar(50) DEFAULT '',
  `freq_interval` int DEFAULT '1',
  `table_def_id` int DEFAULT NULL,
  `people_amount` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `events_fk0` (`author`),
  KEY `events_fk2` (`room_id`),
  KEY `events_fk1` (`paricipant`),
  CONSTRAINT `events_fk0` FOREIGN KEY (`author`) REFERENCES `employees` (`id`),
  CONSTRAINT `events_fk1` FOREIGN KEY (`paricipant`) REFERENCES `employees` (`id`),
  CONSTRAINT `events_fk2` FOREIGN KEY (`room_id`) REFERENCES `meeting_rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (106,'Собеседование',6,8,6,'2023.11.13 08:00:00','2023.11.13 17:00:00','Собеседование с одним из кандидатов','6kqjide65508f3d0819byandex.ru','',1,1,0),(107,'Собеседование',6,9,6,'2023.11.13 08:00:00','2023.11.13 17:00:00','Собеседование с одним из кандидатов','6kqjide65508f3d0819byandex.ru','',1,1,0),(108,'Собеседование',6,8,8,'2023.11.13 08:00:00','2023.11.13 17:00:00','Собеседование с одним из кандидатов','6kqjide65508f3dad8e1yandex.ru','',1,1,0),(109,'Собеседование',6,9,8,'2023.11.13 08:00:00','2023.11.13 17:00:00','Собеседование с одним из кандидатов','6kqjide65508f3dad8e1yandex.ru','',1,1,0),(134,'ТЕСТ3',8,6,6,'2023.11.12 00:30:00','2023.11.12 00:31:00','','6kqjide6550ab15e63eayandex.ru','DAILY',2,273298237,0),(135,'ТЕСТ3',8,9,6,'2023.11.12 00:30:00','2023.11.12 00:31:00','','6kqjide6550ab15e63eayandex.ru','DAILY',2,273298237,0),(136,'ТЕСТ3',8,6,8,'2023.11.12 00:30:00','2023.11.12 00:31:00','','6kqjide6550ab16c874fyandex.ru','DAILY',2,273298237,0),(137,'ТЕСТ3',8,9,8,'2023.11.12 00:30:00','2023.11.12 00:31:00','','6kqjide6550ab16c874fyandex.ru','DAILY',2,273298237,0),(138,'ТЕСТ3',6,8,6,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab22d067cyandex.ru','DAILY',2,286797605,0),(139,'ТЕСТ3',6,9,6,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab22d067cyandex.ru','DAILY',2,286797605,0),(140,'ТЕСТ3',6,8,8,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab23dad4cyandex.ru','DAILY',2,286797605,0),(141,'ТЕСТ3',6,9,8,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab23dad4cyandex.ru','DAILY',2,286797605,0),(142,'ТЕСТ3',6,8,6,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab27563bcyandex.ru','DAILY',2,291700986,0),(143,'ТЕСТ3',6,9,6,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab27563bcyandex.ru','DAILY',2,291700986,0),(144,'ТЕСТ3',6,8,8,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab28028aayandex.ru','DAILY',2,291700986,0),(145,'ТЕСТ3',6,9,8,'2023.11.12 00:31:00','2023.11.12 00:32:00','','6kqjide6550ab28028aayandex.ru','DAILY',2,291700986,0),(146,'ТЕСТ3',6,8,6,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6a95009yandex.ru','DAILY',2,362273171,0),(147,'ТЕСТ3',6,9,6,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6a95009yandex.ru','DAILY',2,362273171,0),(148,'ТЕСТ3',6,8,8,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6b2036cyandex.ru','DAILY',2,362273171,0),(149,'ТЕСТ3',6,9,8,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6b2036cyandex.ru','DAILY',2,362273171,0),(150,'ТЕСТ3',6,8,6,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6e1fd61yandex.ru','DAILY',2,365986071,0),(151,'ТЕСТ3',6,9,6,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6e1fd61yandex.ru','DAILY',2,365986071,0),(152,'ТЕСТ3',6,8,8,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6f0948ayandex.ru','DAILY',2,365986071,0),(153,'ТЕСТ3',6,9,8,'2023.11.12 00:31:00','2023.11.12 00:35:00','','6kqjide6550ab6f0948ayandex.ru','DAILY',2,365986071,0),(154,'ТЕСТ3',6,8,6,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab72c790dyandex.ru','DAILY',2,370732830,0),(155,'ТЕСТ3',6,9,6,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab72c790dyandex.ru','DAILY',2,370732830,0),(156,'ТЕСТ3',6,8,8,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab7340a27yandex.ru','DAILY',2,370732830,0),(157,'ТЕСТ3',6,9,8,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab7340a27yandex.ru','DAILY',2,370732830,0),(158,'ТЕСТ3',6,8,6,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab88a6478yandex.ru','DAILY',2,392926577,0),(159,'ТЕСТ3',6,9,6,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab88a6478yandex.ru','DAILY',2,392926577,0),(160,'ТЕСТ3',6,8,8,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab89a0bd4yandex.ru','DAILY',2,392926577,0),(161,'ТЕСТ3',6,9,8,'2023.11.12 00:30:00','2023.11.12 00:35:00','','6kqjide6550ab89a0bd4yandex.ru','DAILY',2,392926577,0),(162,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb3e0f3ayandex.ru','DAILY',2,439050086,0),(163,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb3e0f3ayandex.ru','DAILY',2,439050086,0),(164,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb46b442yandex.ru','DAILY',2,439050086,0),(165,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb46b442yandex.ru','DAILY',2,439050086,0),(166,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb787a40yandex.ru','DAILY',2,442710966,0),(167,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb787a40yandex.ru','DAILY',2,442710966,0),(168,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb82e2beyandex.ru','DAILY',2,442710966,0),(169,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abb82e2beyandex.ru','DAILY',2,442710966,0),(170,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abd7c0b68yandex.ru','DAILY',2,476548289,0),(171,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abd7c0b68yandex.ru','DAILY',2,476548289,0),(172,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abd8b0aa2yandex.ru','DAILY',2,476548289,0),(173,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abd8b0aa2yandex.ru','DAILY',2,476548289,0),(174,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abfc5b46byandex.ru','DAILY',2,515009111,0),(175,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abfc5b46byandex.ru','DAILY',2,515009111,0),(176,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abfd06f9dyandex.ru','DAILY',2,515009111,0),(177,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:35:00','','6kqjide6550abfd06f9dyandex.ru','DAILY',2,515009111,0),(178,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac1eb8e50yandex.ru','DAILY',2,550919041,0),(179,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac1eb8e50yandex.ru','DAILY',2,550919041,0),(180,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac1fa4f8byandex.ru','DAILY',2,550919041,0),(181,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac1fa4f8byandex.ru','DAILY',2,550919041,0),(182,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac22e736fyandex.ru','DAILY',2,555657018,0),(183,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac22e736fyandex.ru','DAILY',2,555657018,0),(184,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac2398fadyandex.ru','DAILY',2,555657018,0),(185,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550ac2398fadyandex.ru','DAILY',2,555657018,0),(186,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3dfc26ccyandex.ru','DAILY',2,632554176,0),(187,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3dfc26ccyandex.ru','DAILY',2,632554176,0),(188,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3e0888c6yandex.ru','DAILY',2,632554176,0),(189,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3e0888c6yandex.ru','DAILY',2,632554176,0),(190,'ТЕСТ3',6,8,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3e598405yandex.ru','DAILY',2,638487016,0),(191,'ТЕСТ3',6,9,6,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3e598405yandex.ru','DAILY',2,638487016,0),(192,'ТЕСТ3',6,8,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3e688ffayandex.ru','DAILY',2,638487016,0),(193,'ТЕСТ3',6,9,8,'2023.11.12 02:30:00','2023.11.12 02:40:00','','6kqjide6550b3e688ffayandex.ru','DAILY',2,638487016,0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-12 17:58:52
