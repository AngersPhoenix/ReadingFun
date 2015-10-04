-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dev_database
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recap` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'William Anzkle',NULL),(2,'Wsilliam Anzkle',NULL),(3,'J. K. Rowling','J. K. Rowling is a prominent British author who has received honorary degrees from St Andrews University, the University of Edinburgh, Edinburgh Napier University, the University of Exeter, the University of Aberdeen and Harvard University, for whom she spoke at the 2008 commencement ceremony. In 2009 Rowling was awarded the Légion d\'honneur by French President Nicolas Sarkozy.'),(4,'Mark Twain ','was a prominent American author in multiple genres including fiction and journalism during the 19th century.');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` datetime NOT NULL,
  `imagepath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recap` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'Python','2015-03-25 18:27:01','../../images/Small/python.jpeg','Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all . ',15.73),(2,'WireShark','2015-03-25 18:36:09','../../images/Small/wireshark.jpg','Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all ',9.75),(3,'Qt','2015-03-25 18:36:09','../../images/Small/Qt.jpeg','Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all ',11),(4,'Android Hard Edition','2015-03-25 00:00:00','../../images/Small/Android.jpg','Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification',8.58),(5,'Asp.net','2015-03-25 18:36:09','../../images/Small/asp.jpg','Co-founded by Laura Chappell, inspirational instructor, consultant, and Wireshark expert, provides training, Network Analyst Certification, and resources for all ',3.75),(6,'Hacking: behind scenes','2012-07-15 18:36:09','../../images/Small/hacking.jpg','A hacker is an adherent of the subculture that originally emerged in academia in the 1960s, around the Massachusetts Institute of Technology (MIT)\'s Tech Model \nA hacker is one who',20.23),(7,'History of C++','1991-06-15 18:36:09','../../images/Small/c++.jpg','C++ (pronounced as see plus plus, /ˈsiː plʌs plʌs/) is a general-purpose programming language. It has imperative, object-oriented and generic programming features,\nIt is designed wi',12.21);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_author`
--

DROP TABLE IF EXISTS `book_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_author` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `IDX_9478D34516A2B381` (`book_id`),
  KEY `IDX_9478D345F675F31B` (`author_id`),
  CONSTRAINT `FK_9478D34516A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9478D345F675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_author`
--

LOCK TABLES `book_author` WRITE;
/*!40000 ALTER TABLE `book_author` DISABLE KEYS */;
INSERT INTO `book_author` VALUES (1,1),(2,2),(3,4),(4,2),(5,2),(6,4),(7,3);
/*!40000 ALTER TABLE `book_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_category`
--

DROP TABLE IF EXISTS `book_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_category` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`category_id`),
  KEY `IDX_1FB30F9816A2B381` (`book_id`),
  KEY `IDX_1FB30F9812469DE2` (`category_id`),
  CONSTRAINT `FK_1FB30F9812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1FB30F9816A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_category`
--

LOCK TABLES `book_category` WRITE;
/*!40000 ALTER TABLE `book_category` DISABLE KEYS */;
INSERT INTO `book_category` VALUES (1,1);
/*!40000 ALTER TABLE `book_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Programmation');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_book`
--

DROP TABLE IF EXISTS `category_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_book` (
  `category_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`book_id`),
  KEY `IDX_407ED97612469DE2` (`category_id`),
  KEY `IDX_407ED97616A2B381` (`book_id`),
  CONSTRAINT `FK_407ED97612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_407ED97616A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_book`
--

LOCK TABLES `category_book` WRITE;
/*!40000 ALTER TABLE `category_book` DISABLE KEYS */;
INSERT INTO `category_book` VALUES (1,1);
/*!40000 ALTER TABLE `category_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (3,'Phoenix',25,'rouineb.business@gmail.com','96055f5b06bf9381ac43879351642cf5',0),(4,'Admin',36,'admin@gmail.com','96055f5b06bf9381ac43879351642cf5',1),(6,'SuperNova',12,'SuperNova@gmail.com','96055f5b06bf9381ac43879351642cf5',0),(9,'Pegasus',36,'Pegasus@Pegasus.com','96055f5b06bf9381ac43879351642cf5',0),(10,'Kayzen',30,'Kayzen@Kayzen.fr','25f9e794323b453885f5181f1b624d0b',0),(11,'Katana',55,'Katana@Katana.com','5583413443164b56500def9a533c7c70',0),(12,'Solkan',22,'rouineb.online@gmail.com','96055f5b06bf9381ac43879351642cf5',0);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `ordre_date` datetime NOT NULL,
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F529939819EB6921` (`client_id`),
  CONSTRAINT `FK_F529939819EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,6,'2020-11-13 00:00:00',1),(2,3,'2020-10-28 00:00:00',0),(3,10,'2009-09-16 23:37:53',1),(4,3,'2020-09-28 00:00:00',0),(5,3,'1998-03-02 00:45:46',1),(6,3,'1998-03-02 00:45:46',1),(8,11,'2020-11-12 00:00:00',0),(9,4,'2015-04-05 18:39:24',0),(10,4,'2015-04-05 18:40:57',0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderbook`
--

DROP TABLE IF EXISTS `orderbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C5D5F5AB8D9F6D38` (`order_id`),
  KEY `IDX_C5D5F5AB16A2B381` (`book_id`),
  CONSTRAINT `FK_C5D5F5AB16A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT `FK_C5D5F5AB8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderbook`
--

LOCK TABLES `orderbook` WRITE;
/*!40000 ALTER TABLE `orderbook` DISABLE KEYS */;
INSERT INTO `orderbook` VALUES (1,1,1,4),(2,2,2,5),(3,8,5,2),(4,4,5,200),(5,9,5,2),(6,10,4,4);
/*!40000 ALTER TABLE `orderbook` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-05 19:52:09
