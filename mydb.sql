CREATE DATABASE  IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mydb`;
-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Table structure for table `bruker`
--

DROP TABLE IF EXISTS `bruker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bruker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epost` varchar(100) NOT NULL,
  `passord` varchar(45) NOT NULL,
  `enavn` varchar(45) DEFAULT NULL,
  `fnavn` varchar(45) DEFAULT NULL,
  `brukertype` varchar(20) NOT NULL,
  `brukertype_id` int(11) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bruker`
--

LOCK TABLES `bruker` WRITE;
/*!40000 ALTER TABLE `bruker` DISABLE KEYS */;
INSERT INTO `bruker` VALUES (4,'sample@gmail.com','b87444bfd09ecfa23c76208f13748191ba6ecc4f','Smith','J','Voters',3,'1612348595-ed.jpg','',NULL,NULL),(5,'test1@gmail.com','27f637aefc3545a91b5b7e1d3760b70742ca8732','Doe','Joe','Voters',3,'avatar.jpeg','Male','4734567890','2021-02-04'),(6,'asdasdasd2@gmail.com','8c341fca51b7ae13f092a61cf18910ec02b29a55','Doe','Joe','Voters',3,'avatar.jpeg','Male','4734567890','2021-02-17'),(7,'sample123@gmail.com','b4111d1598996ee0bf3725abd56646ad6a6d5d42','Smith','Joe','Voters',3,'avatar.jpeg','Male','4734567890','2021-02-12'),(8,'sample21321@gmail.com','4dacfb4925961ebdde387ff5796c7959c3a6b7d2','Smith','asdas','Voters',3,'avatar.jpeg','Male','4734567890','2021-02-10');
/*!40000 ALTER TABLE `bruker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brukertype`
--

DROP TABLE IF EXISTS `brukertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brukertype` (
  `idbrukertype` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idbrukertype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brukertype`
--

LOCK TABLES `brukertype` WRITE;
/*!40000 ALTER TABLE `brukertype` DISABLE KEYS */;
INSERT INTO `brukertype` VALUES (1,'Administrator'),(2,'Candidates'),(3,'Voters'),(4,'Controllers');
/*!40000 ALTER TABLE `brukertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kandidat`
--

DROP TABLE IF EXISTS `kandidat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kandidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fakultet` varchar(45) DEFAULT NULL,
  `institutt` varchar(45) DEFAULT NULL,
  `informasjon` longtext,
  `kandidatcol` varchar(45) DEFAULT NULL,
  `stemmer` varchar(45) DEFAULT NULL,
  `bruker_epost` varchar(100) DEFAULT NULL,
  `bruker` varchar(100) DEFAULT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kandidat`
--

LOCK TABLES `kandidat` WRITE;
/*!40000 ALTER TABLE `kandidat` DISABLE KEYS */;
INSERT INTO `kandidat` VALUES (1,'asdasdsad','asdas','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','8949067109','0','asdad@gmail.com','asdasd','1612356897-download.jpeg'),(2,'asdasd','asdsadasd','asdasdasd','4444738049','0','asdasdasda@gmail.com','sadasdasd','1612356960-ed.jpg'),(3,'asdasdas','fasdasdas','asdasdas','9447324325','0','asdasd@gmail.com','asdasdas','1612357263-ed.jpg'),(4,'asdasd','asdasd','afasdadasdasd','2112017029','0','sample1@gmail.com','J Smith','1612348595-ed.jpg'),(5,'asdasd','asdasd','afasdadasdasd','3913260945','0','sample222@gmail.com','J Smith','1612348595-ed.jpg'),(6,'asda','sdasd','asdas','7530174770','0','asd111asd@gmail.com','asdasf','1612360926-ed.jpg');
/*!40000 ALTER TABLE `kandidat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valg`
--

DROP TABLE IF EXISTS `valg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `valg` (
  `idvalg` int(11) NOT NULL,
  `startforslag` datetime DEFAULT NULL,
  `sluttforslag` datetime DEFAULT NULL,
  `startvalg` datetime DEFAULT NULL,
  `kontrollert` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idvalg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valg`
--

LOCK TABLES `valg` WRITE;
/*!40000 ALTER TABLE `valg` DISABLE KEYS */;
/*!40000 ALTER TABLE `valg` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-03 22:44:22
