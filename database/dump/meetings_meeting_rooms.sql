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
-- Table structure for table `meeting_rooms`
--

DROP TABLE IF EXISTS `meeting_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meeting_rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `office_id` int NOT NULL,
  `photo` varchar(400) NOT NULL DEFAULT '""',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(400) NOT NULL DEFAULT '""',
  `ya_calendar__embed_link` varchar(400) NOT NULL DEFAULT '""',
  `accessibility` varchar(50) NOT NULL DEFAULT '"public"',
  `capacity` int NOT NULL DEFAULT '25',
  PRIMARY KEY (`id`),
  KEY `meeting_rooms_fk0` (`office_id`),
  CONSTRAINT `meeting_rooms_fk0` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting_rooms`
--

LOCK TABLES `meeting_rooms` WRITE;
/*!40000 ALTER TABLE `meeting_rooms` DISABLE KEYS */;
INSERT INTO `meeting_rooms` VALUES (3,'Переговорная №1.1',1,'https://mykaleidoscope.ru/uploads/posts/2021-10/1633379894_36-mykaleidoscope-ru-p-peregovornaya-komnata-interer-krasivo-foto-37.jpg',1,'Стильная переговорная комната с кондиционером и системой видеоконференцсвязи.','https://calendar.yandex.ru/embed/week?private_token=72e2275a00cf65fcab5f4bb9a552ace17c41fb6f&tz_id=Europe/Moscow','\"public\"',25),(4,'Переговорная №1.2',1,'https://idei.club/uploads/posts/2021-11/1637353161_7-idei-club-p-interer-konferents-zala-interer-krasivo-fo-7.jpg',1,'Оформленная в современном стиле переговорная комната с кофе-зоной и отдельным входом.','https://calendar.yandex.ru/embed/week?private_token=8aba76e8288a43553b4948d1b1f16cfe106c062f&tz_id=Europe/Moscow','\"public\"',25),(5,'Переговорная №1.3',1,'https://na-dache.pro/uploads/posts/2021-05/1620669220_2-p-interer-peregovornoi-v-ofise-foto-2.jpg',1,'Удобная переговорная комната с мягкой мебелью и книжной полкой для пользования гостей.','https://calendar.yandex.ru/embed/week?private_token=5df7c0138d5bf7575f074f239bd27619d2ec1090&tz_id=Europe/Moscow','\"public\"',25),(6,'Экспресс №1',2,'https://na-dache.pro/uploads/posts/2021-05/1620669190_62-p-interer-peregovornoi-v-ofise-foto-72.jpg',1,'Просторная и светлая переговорная комната с конференц-столом и комфортными креслами.','https://calendar.yandex.ru/embed/week?private_token=d8f692d73f6d6dcdfb9f43e7bea2d72fc25aa852&tz_id=Europe/Moscow','\"public\"',25),(7,'Экспресс №1',3,'https://na-dache.pro/uploads/posts/2021-05/1620669190_62-p-interer-peregovornoi-v-ofise-foto-72.jpg',1,'Просторная и светлая переговорная комната с конференц-столом и комфортными креслами.','https://calendar.yandex.ru/embed/week?private_token=d8f692d73f6d6dcdfb9f43e7bea2d72fc25aa852&tz_id=Europe/Moscow','\"public\"',25),(8,'Экспресс №2',2,'https://pro-dachnikov.com/uploads/posts/2021-11/1638071285_148-pro-dachnikov-com-p-interer-peregovornikh-komnat-foto-152.jpg',1,'Роскошная переговорная комната с камином и панорамным видом.','https://calendar.yandex.ru/embed/week?private_token=160b83073a616cc018454d048e6ab10fb7a514d1&tz_id=Europe/Moscow','\"public\"',25),(9,'Экспресс №2',3,'https://pro-dachnikov.com/uploads/posts/2021-11/1638071285_148-pro-dachnikov-com-p-interer-peregovornikh-komnat-foto-152.jpg',1,'Роскошная переговорная комната с камином и панорамным видом.','https://calendar.yandex.ru/embed/week?private_token=160b83073a616cc018454d048e6ab10fb7a514d1&tz_id=Europe/Moscow','\"public\"',25),(10,'Экспресс №2',4,'https://pro-dachnikov.com/uploads/posts/2021-11/1638071285_148-pro-dachnikov-com-p-interer-peregovornikh-komnat-foto-152.jpg',1,'Роскошная переговорная комната с камином и панорамным видом.','https://calendar.yandex.ru/embed/week?private_token=160b83073a616cc018454d048e6ab10fb7a514d1&tz_id=Europe/Moscow','\"public\"',25),(11,'Экспресс №3',4,'https://i.pinimg.com/originals/6b/b1/97/6bb19777ba239c48accc8c7c9355b57d.jpg',0,'Уютная переговорная комната в классическом стиле с камином и зеркальными стенами.','https://calendar.yandex.ru/embed/week?private_token=d68e54d1c3269069ceb8483f96bb83ef6e1d03fd&tz_id=Europe/Moscow','\"public\"',25),(12,'Экспресс №3',3,'https://i.pinimg.com/originals/6b/b1/97/6bb19777ba239c48accc8c7c9355b57d.jpg',0,'Уютная переговорная комната в классическом стиле с камином и зеркальными стенами.','https://calendar.yandex.ru/embed/week?private_token=d68e54d1c3269069ceb8483f96bb83ef6e1d03fd&tz_id=Europe/Moscow','\"public\"',25),(15,'Переговорная №5.1',5,'https://na-dache.pro/uploads/posts/2021-05/1620669190_62-p-interer-peregovornoi-v-ofise-foto-72.jpg',0,'Современная переговорная комната с прямым выходом на крышу и расслабленной обстановкой.','https://calendar.yandex.ru/embed/week?private_token=f5cf77a144444edf2f4047f6b43dc53f08950f93&tz_id=Europe/Moscow','\"public\"',25),(16,'Переговорная №5.2',5,'https://amiel.club/uploads/posts/2022-10/1665124052_16-amiel-club-p-serii-tsvet-sten-v-ofise-pinterest-16.jpg',1,'Стильная переговорная комната с лаунж-зоной и креативным оформлением.','https://calendar.yandex.ru/embed/week?private_token=1785d5dd16971355cd71426985be7743de51d2ce&tz_id=Europe/Moscow','\"public\"',25),(17,'Переговорная №5.3',5,'https://pro-dachnikov.com/uploads/posts/2021-11/1638071285_148-pro-dachnikov-com-p-interer-peregovornikh-komnat-foto-152.jpg',1,'Просторная переговорная комната в бизнес-центре с высокими технологиями и охраной.','https://calendar.yandex.ru/embed/week?private_token=c3f8f338b92e74123376421b80afa40f282f3bf2&tz_id=Europe/Moscow','\"public\"',25),(18,'Переговорная №6.1',6,'https://pro-dachnikov.com/uploads/posts/2021-11/1638071263_46-pro-dachnikov-com-p-interer-peregovornikh-komnat-foto-46.jpg',1,'Комфортная переговорная комната с гостевым диваном и отдельной зоной для кофе-перерывов.','https://calendar.yandex.ru/embed/week?private_token=f32f7e9eff71de0acf284205887f02eda6cc2c28&tz_id=Europe/Moscow','\"public\"',25),(19,'Переговорная №6.2',6,'https://na-dache.pro/uploads/posts/2021-05/1620669199_17-p-interer-peregovornoi-v-ofise-foto-18.jpg',0,'Современная переговорная комната с 3D-проектором и качественным звуком.','https://calendar.yandex.ru/embed/week?private_token=fa40e3a1f79e752c78b1440a83bd0941b2d9e25b&tz_id=Europe/Moscow','\"public\"',25),(20,'Переговорная №6.3',6,'https://i.pinimg.com/originals/6b/b1/97/6bb19777ba239c48accc8c7c9355b57d.jpg',0,'Роскошная переговорная комната с мраморными столами и декоративными элементами.','https://calendar.yandex.ru/embed/week?private_token=519d68564dae2fa1f7f446ab8a88f2f44d2ac0b8&tz_id=Europe/Moscow','\"public\"',25),(21,'Переговорная №7.1',7,'https://mykaleidoscope.ru/uploads/posts/2021-10/1633379894_36-mykaleidoscope-ru-p-peregovornaya-komnata-interer-krasivo-foto-37.jpg',1,'Уютная переговорная комната с видом на парковую зону и оборудованием для видеоконференций.','https://calendar.yandex.ru/embed/week?private_token=22b33edcf44d9fd7b5864c1598187afb568e9b86&tz_id=Europe/Moscow','\"public\"',25),(22,'Переговорная №7.2',7,'https://idei.club/uploads/posts/2021-11/1637353161_7-idei-club-p-interer-konferents-zala-interer-krasivo-fo-7.jpg',0,'Просторная переговорная комната с зоной отдыха и высокими потолками.','https://calendar.yandex.ru/embed/week?private_token=e89c1b04934cc3b331604e219a311dd439738de8&tz_id=Europe/Moscow','\"public\"',25),(23,'Переговорная №7.3',7,'https://na-dache.pro/uploads/posts/2021-05/1620669220_2-p-interer-peregovornoi-v-ofise-foto-2.jpg',1,'Минималистичная переговорная комната с большими окнами и функциональным оборудованием.','https://calendar.yandex.ru/embed/week?private_token=d6d7f4fa21c548a34c444ba38d4e2abcb1d77c0c&tz_id=Europe/Moscow','\"public\"',25),(24,'Переговорная №8.1',8,'https://na-dache.pro/uploads/posts/2021-05/1620669190_62-p-interer-peregovornoi-v-ofise-foto-72.jpg',1,'Удобная переговорная комната с интерактивным столом и мультимедийным оборудованием.','https://calendar.yandex.ru/embed/week?private_token=2f3881be7ed46aa9d97f441f8baadcfaafd9e14c&tz_id=Europe/Moscow','\"public\"',25),(25,'Переговорная №8.2',8,'https://amiel.club/uploads/posts/2022-10/1665124052_16-amiel-club-p-serii-tsvet-sten-v-ofise-pinterest-16.jpg',0,'Светлая переговорная комната с просторными шкафами для хранения документов и предметов.','https://calendar.yandex.ru/embed/week?private_token=5fe01b5c5627e86043f34c1fad1c3e78363efd88&tz_id=Europe/Moscow','\"public\"',25),(26,'Переговорная №8.3',8,'https://pro-dachnikov.com/uploads/posts/2021-11/1638071285_148-pro-dachnikov-com-p-interer-peregovornikh-komnat-foto-152.jpg',1,'Просторная переговорная комната с современным дизайном и комфортными мебелью.','https://calendar.yandex.ru/embed/week?private_token=be1e32345f56215fcf4f4bee9514280da18016ae&tz_id=Europe/Moscow','\"public\"',25);
/*!40000 ALTER TABLE `meeting_rooms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-12 17:58:51
