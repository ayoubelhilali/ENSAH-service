-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ensah_service
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `md5_pass` varchar(30) NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`admin_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'elhilaliayoub2020@gmail.com','admin1234','',50);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

--
-- Table structure for table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professeur` (
  `prof_ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `md5_pass` varchar(25) NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`prof_ID`),
  KEY `prof_C1` (`user_ID`),
  CONSTRAINT `prof_C1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professeur`
--

/*!40000 ALTER TABLE `professeur` DISABLE KEYS */;
INSERT INTO `professeur` VALUES (66,'nomprenom@gmail.com','E?d1@W2,Z','Data analyst','517d471a79eb70140f5643f5a',67),(67,'prof@gmail.com','0:pZaMhuJ','cybersecurity','b6214057a3ed8bb66b3200cdf',73);
/*!40000 ALTER TABLE `professeur` ENABLE KEYS */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `CIN` varchar(10) NOT NULL,
  `image` varchar(70) NOT NULL,
  `date_naissance` varchar(11) NOT NULL,
  `genre` enum('masculin','feminin') NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Phone` int(11) NOT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (50,'EL HILALI','ayoub','UD18436','/ENSAH-service/assets/images/avatar-M.jpg','2004-4-8','masculin','hey sidi lghazi belarbi rue 29 N 39 ',771345878,'https://www.linkedin.com/in/ayoub-elhilali-0340832a4/','I am the admin of ENSAH-service'),(67,'Nom','Prenom','UD1234','','2010-7-13','masculin',NULL,0,NULL,NULL),(70,'EL HILALI','ayoub','UD1234','','2004-9-12','masculin',NULL,0,NULL,NULL),(71,'vacataire2','prenim','A1234','/ENSAH-service/uploads/1746664484.jpg','2000-7-6','feminin',NULL,0,NULL,'hada vacataire ta whd mky3rfo'),(72,'LAMAIZI','amin','A1234','/ENSAH-service/uploads/1746709564.jpg','2004-7-14','masculin','chi blassa f sraghna',7777777,'linkedindyalsergh','hada sergh mn seraghna wchkon mky3rfoch'),(73,'prof','prenom','A1234','','2002-8-13','masculin',NULL,0,NULL,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

--
-- Table structure for table `vacataire`
--

DROP TABLE IF EXISTS `vacataire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacataire` (
  `vacat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `md5_pass` varchar(70) NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`vacat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacataire`
--

/*!40000 ALTER TABLE `vacataire` DISABLE KEYS */;
INSERT INTO `vacataire` VALUES (4,'elhilaliayoub2020@gmail.com','A12345@f','cybersecurity','5385e1e6fa440178e394dbc77e67514a',70),(5,'ahhh@gmail.Com','M&lt;,;bxw38','Mathematics','72ab271efd7606fae22c120fdc55dd8b',71),(6,'lamaiziamin@gmail.com','2Zv*]#a:!','Data analyst','133c2a6bd35c2f8b8ce97b4dbeaff655',72);
/*!40000 ALTER TABLE `vacataire` ENABLE KEYS */;

--
-- Dumping routines for database 'ensah_service'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-08 18:24:23
