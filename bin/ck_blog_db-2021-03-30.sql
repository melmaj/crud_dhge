-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: supersonic_heavy_vulture
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) NOT NULL,
  `Firstname` varchar(80) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Kästner','Christian',NULL,'',''),(2,'Uwe','Kai',NULL,'',''),(3,'Haudrauf','Ralf',NULL,'',''),(4,'d','d',NULL,'',''),(5,'s','s',NULL,'',''),(6,'s','s',NULL,'',''),(7,'Kästner','s',NULL,'',''),(8,'Kästner','CJ',0,'cj4@g','cjk'),(9,'Kästner','Jack',0,'jack@12','12'),(10,'Kästner','CJ',0,'cj88@gmail','$2y$10$JiVvo9hlAamBXztGyjz2su2mFf9qsU43KhWTF6Td4V8F4Gcbze11q'),(11,'Kästner','uwe',0,'uwe@alt','$2y$10$7OI1Q4gwHuxCZNcYS9iyueJHAQPBEc7Y9yMQWTS6x69PfTnY24tbS'),(12,'Haudrauf','Son',0,'son@7','$2y$10$dBqe.yLZTuTpprB64i4Ivu0ihjmfHWmNWk7JFQXcvvyZClyA.37Wi'),(13,'Uwe','Sehler',0,'uwe@187','$2y$10$4NS55UWq5DXWpdPD2TB5WObjX1UgrBVC9ORWQWkNFSa9gXYIoiLHK'),(14,'junge','geh',0,'ggggg@ll','$2y$10$QUpRUSqlrTXQw5YY5K6oWu1v6cWJ7P43lK81ZY8C6F9gA8mvylTBC'),(15,'Uwe','Cj',1,'cj4@gmail','$2y$10$KhW5cVr/0jrjy4ymwNA/qebuabntvNCzsAxTISku6C2asJSEGVPAC'),(16,'ff','ff',0,'ff@l','$2y$10$WAzvPgFLPSH1rqYx2fgWr.LiXhGgQuP8N6pt8CZ6eYtDN0JozpArS');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_entry`
--

DROP TABLE IF EXISTS `blog_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `creation_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_entry`
--

LOCK TABLES `blog_entry` WRITE;
/*!40000 ALTER TABLE `blog_entry` DISABLE KEYS */;
INSERT INTO `blog_entry` VALUES (1,'Die tiefen der Ozeane','In den Tiefen der Ozeane schlummern bis heute viele Geheimnisse. Große Teile der Weltmeere sind noch immer völlig unerforscht. Selbst den Mond kennen wir besser als die Tiefsee. Was wir aber wissen: Fast das gesamte Wasser dieser Erde – um genau zu sein 97.','2021-03-16',15);
/*!40000 ALTER TABLE `blog_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `creation_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_blog_entry_id_fk` (`page_id`),
  CONSTRAINT `comment_blog_entry_id_fk` FOREIGN KEY (`page_id`) REFERENCES `blog_entry` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'Super!','gute beschreibung aber bilder währen schön','2021-03-18',11,1),(2,'Sehr Informativ','hat spass gemacht zu lesen','2021-03-22',14,1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-30  9:09:09
