-- MySQL dump 10.16  Distrib 10.1.20-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.20-MariaDB

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (4),(5);
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authentication`
--

DROP TABLE IF EXISTS `authentication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authentication` (
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  CONSTRAINT `authentication_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authentication`
--

LOCK TABLES `authentication` WRITE;
/*!40000 ALTER TABLE `authentication` DISABLE KEYS */;
INSERT INTO `authentication` VALUES ('$2y$10$KZFtZCVXlLMt/qE66/dvhO5LESRvITAsjUTkzxdcEuXIK3srQ.xMK','conductor','conductor',2),('$2y$10$oScNTWMJxYKvifDoay2Ks.GIatPDHqUZxmgKBStIT9wdP0v0xMhte','engineer','engineer',3),('$2y$10$lqFe9bVwJEw27FF1UOrgPu.u33TMV0QbXU4hg.R.0uwTg1t.Upmge','administrator','admin',4);
/*!40000 ALTER TABLE `authentication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conductor`
--

DROP TABLE IF EXISTS `conductor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conductor` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `rank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conductor`
--

LOCK TABLES `conductor` WRITE;
/*!40000 ALTER TABLE `conductor` DISABLE KEYS */;
INSERT INTO `conductor` VALUES (2,1,'Senior'),(9,1,'Senior'),(10,1,'Senior');
/*!40000 ALTER TABLE `conductor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conductor_history`
--

DROP TABLE IF EXISTS `conductor_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conductor_history` (
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `trainNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`,`trainNumber`),
  KEY `trainNumber` (`trainNumber`),
  CONSTRAINT `conductor_history_ibfk_1` FOREIGN KEY (`id`) REFERENCES `conductor` (`id`),
  CONSTRAINT `conductor_history_ibfk_2` FOREIGN KEY (`trainNumber`) REFERENCES `trains` (`trainNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conductor_history`
--

LOCK TABLES `conductor_history` WRITE;
/*!40000 ALTER TABLE `conductor_history` DISABLE KEYS */;
INSERT INTO `conductor_history` VALUES ('2017-04-17','0000-00-00',2,1),('2017-04-18','0000-00-00',2,3),('2017-04-19','0000-00-00',9,2),('2017-04-20','0000-00-00',10,2);
/*!40000 ALTER TABLE `conductor_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billingAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'grice@gmail.com','255 St. Louis Street St. Louis, MO'),(11,'grice@gmail.com','255 St. Louis Street St. Louis, MO'),(12,'grice@gmail.com','255 St. Louis Street St. Louis, MO');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (2,'3600 Aspen Heights Pwky, Columbia, MO','conductor','conductor'),(3,'27 Broadway Ave, Springfield, MO','engineer','engineer'),(4,'3500 Grindstone Pwky, Columbia, MO','administrator','admin'),(5,'123 Fake St, St. Louis, MO','administrator',NULL),(6,'370 Brookside Ln, Columbia, MO','engineer',NULL),(7,'105 Locus St, Columbia, MO','engineer',NULL),(8,'3500 Grindstone Pwky, Columbia, MO','engineer',NULL),(9,'3500 Grindstone Pwky, Columbia, MO','conductor',NULL),(10,'3500 Grindstone Pwky, Columbia, MO','conductor',NULL);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engineer`
--

DROP TABLE IF EXISTS `engineer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engineer` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `hoursTraveled` int(11) DEFAULT NULL,
  `rank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `engineer_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineer`
--

LOCK TABLES `engineer` WRITE;
/*!40000 ALTER TABLE `engineer` DISABLE KEYS */;
INSERT INTO `engineer` VALUES (3,1,19127,'Senior'),(6,1,19127,'Senior'),(7,1,19127,'Senior'),(8,1,19127,'Senior');
/*!40000 ALTER TABLE `engineer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engineer_history`
--

DROP TABLE IF EXISTS `engineer_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engineer_history` (
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `travelTime` time DEFAULT NULL,
  `id` int(11) NOT NULL,
  `trainNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`,`trainNumber`),
  KEY `trainNumber` (`trainNumber`),
  CONSTRAINT `engineer_history_ibfk_1` FOREIGN KEY (`id`) REFERENCES `engineer` (`id`),
  CONSTRAINT `engineer_history_ibfk_2` FOREIGN KEY (`trainNumber`) REFERENCES `trains` (`trainNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineer_history`
--

LOCK TABLES `engineer_history` WRITE;
/*!40000 ALTER TABLE `engineer_history` DISABLE KEYS */;
INSERT INTO `engineer_history` VALUES ('2017-04-15','0000-00-00','00:00:00',3,1),('2017-04-16','0000-00-00','00:00:00',3,2),('2017-04-17','0000-00-00','00:00:00',3,3),('2017-04-17','0000-00-00','00:00:00',7,1),('2017-04-17','0000-00-00','00:00:00',7,2),('2017-04-18','0000-00-00','00:00:00',8,1);
/*!40000 ALTER TABLE `engineer_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment` (
  `serialNumber` int(11) NOT NULL,
  `loadCapacity` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `trainNumber` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  PRIMARY KEY (`serialNumber`),
  KEY `id` (`id`),
  KEY `trainNumber` (`trainNumber`),
  CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `customer` (`id`),
  CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`trainNumber`) REFERENCES `trains` (`trainNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` VALUES (1000,4000,'grain car','St. Louis','Train Cars Inc.',500,2,NULL),(1001,4000,'coal car','St. Louis','Train Cars Inc.',700,3,NULL),(1002,2000,'flat bed','Chicago','Train Cars Inc.',400,NULL,NULL),(1003,4000,'grain car','Chicago','Train Cars Inc.',500,NULL,NULL),(1004,3000,'hopper','St. Louis','Train Cars Inc.',800,NULL,NULL),(1005,NULL,'locomotive','St. Louis','Train Cars Inc.',NULL,NULL,NULL),(1006,NULL,'locomotive','Chicago','Train Cars Inc.',NULL,NULL,NULL),(1007,3000,'hopper','St. Louis','Train Cars Inc.',800,NULL,NULL);
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `logNumber` int(11) NOT NULL AUTO_INCREMENT,
  `ipAddress` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ocassionTime` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `actionType` int(11) NOT NULL,
  PRIMARY KEY (`logNumber`),
  KEY `id` (`id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'173.26.247.16','2017-04-20 16:15:55','Employee #4 registered.',4,3),(2,'10.7.29.44','2017-04-21 16:03:39','Employee #4 logged in',4,1),(3,'74.84.93.130','2017-04-22 14:37:29','Employee #4 logged in',4,1),(4,'74.84.93.130','2017-04-22 14:39:19','Employee #4 logged in',4,1),(5,'74.84.93.130','2017-04-22 14:41:10','Employee #4 logged in',4,1),(6,'74.84.93.130','2017-04-22 14:42:25','Employee #4 logged in',4,1),(7,'74.84.93.130','2017-04-22 14:42:49','Employee #2 registered.',2,3),(8,'74.84.93.130','2017-04-22 14:43:05','Employee #3 registered.',3,3),(9,'74.84.93.130','2017-04-22 14:46:33','Employee #4 logged in',4,1),(10,'173.26.247.16','2017-04-22 15:56:32','Employee #4 logged in',4,1),(11,'173.26.247.16','2017-04-22 15:57:29','Employee #4 added a train',4,6),(12,'173.26.247.16','2017-04-22 16:03:52','Employee #4 updated Train Number 5',4,7),(13,'173.26.247.16','2017-04-22 16:05:57','Employee #4 updated Train Number 3',4,7),(14,'173.26.247.16','2017-04-22 16:15:28','Employee #4 updated Train Number 5',4,7),(15,'173.26.247.16','2017-04-22 16:23:46','Employee #4 updated Train Number 5',4,7),(16,'173.26.247.16','2017-04-22 16:28:37','Employee #4 deleted train number 5',4,8),(17,'173.26.247.16','2017-04-22 16:32:55','Employee #4 updated equipment #1000',4,9),(18,'173.26.247.16','2017-04-22 16:47:21','Employee #4 logged in',4,1),(19,'173.26.247.16','2017-04-22 16:48:59','Employee #4 logged in',4,1),(20,'173.26.247.16','2017-04-22 16:53:22','Employee #4 updated conductor  history',4,10),(21,'173.26.247.16','2017-04-22 17:01:00','Employee #4 updated engineer history',4,11),(22,'173.26.247.16','2017-04-22 17:01:53','Employee #4 logged in',4,1),(23,'173.26.247.16','2017-04-22 17:02:05','Employee #4 updated conductor  history',4,10),(24,'173.26.247.16','2017-04-22 17:02:30','Employee #4 logged in',4,1),(25,'173.26.247.16','2017-04-22 17:03:00','Employee #4 logged in',4,1),(26,'173.26.247.16','2017-04-22 17:03:04','Employee #4 logged in',4,1),(27,'173.26.247.16','2017-04-22 17:03:15','Employee #4 updated engineer history',4,11),(28,'173.26.247.16','2017-04-22 17:12:59','Employee #4 updated equipment #1001',4,9);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trains`
--

DROP TABLE IF EXISTS `trains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trains` (
  `trainNumber` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startLocation` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `days` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureTime` time DEFAULT NULL,
  `arrivalTime` time DEFAULT NULL,
  PRIMARY KEY (`trainNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trains`
--

LOCK TABLES `trains` WRITE;
/*!40000 ALTER TABLE `trains` DISABLE KEYS */;
INSERT INTO `trains` VALUES (1,'Chicago','St. Louis','Monday','08:00:00','12:00:00'),(2,'Chicago','New York','Wednesday','10:00:00','12:00:00'),(3,'Memphis','New Orleans','Friday','08:00:00','15:00:00');
/*!40000 ALTER TABLE `trains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phoneNumber` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'1234567890','Greg','Rice'),(2,'0987654321','Paul','Matt'),(3,'1597534826','Mist','Mox'),(4,'9513574862','Protein','Flag'),(5,'9513574862','Greg','Flag'),(6,'9513574862','Joe','Blow'),(7,'9513574862','Ben','Jerry'),(8,'9513574862','Garry','Jerry'),(9,'9513574862','Edgar','Poe'),(10,'9513574862','Matt','Flag'),(11,'9513574862','Customer','Cust'),(12,'9513574862','Another','One');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-23 17:29:23
