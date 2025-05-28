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
  `password` varchar(80) NOT NULL,
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
INSERT INTO `admin` VALUES (1,'elhilaliayoub2020@gmail.com','$2y$10$dcRXQu9HR5hm4ohsScRHX.vMAUT17SnMtrobsnyNHxXMTMOdp1rYi',50);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

--
-- Table structure for table `affect_ue_vac`
--

DROP TABLE IF EXISTS `affect_ue_vac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `affect_ue_vac` (
  `affect_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `unite_ID` int(11) DEFAULT NULL COMMENT 'Unité ID',
  `vacataire_ID` int(11) DEFAULT NULL COMMENT 'Vacataire ID',
  PRIMARY KEY (`affect_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affect_ue_vac`
--

/*!40000 ALTER TABLE `affect_ue_vac` DISABLE KEYS */;
INSERT INTO `affect_ue_vac` VALUES (1,16,6),(2,6,5);
/*!40000 ALTER TABLE `affect_ue_vac` ENABLE KEYS */;

--
-- Table structure for table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `annonces` (
  `annonce_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `annonce_head` varchar(50) NOT NULL COMMENT 'Annonce Head',
  `annonce_body` varchar(150) NOT NULL COMMENT 'Annonce body',
  `annonce_date` datetime NOT NULL COMMENT 'Annonce Date',
  PRIMARY KEY (`annonce_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annonces`
--

/*!40000 ALTER TABLE `annonces` DISABLE KEYS */;
INSERT INTO `annonces` VALUES (1,'Test annonce by admin','details de l\"anncoce par amin hello wordl...;!!!!','2025-05-15 00:00:00'),(2,'test 2','hello from admin','2025-05-15 17:12:31'),(3,'test annonce 3','tttttttttttttttttttttttttttttt','2025-05-15 17:18:53'),(4,'test long annonce','test long annonce test long annonce test long anno','2025-05-27 11:37:28'),(5,'test long annonce 2','test long annonce test long annonce test long annonce test long annonce test long annonce test long announce test long annonce test long annonce','2025-05-27 11:38:20');
/*!40000 ALTER TABLE `annonces` ENABLE KEYS */;

--
-- Table structure for table `chef_depart`
--

DROP TABLE IF EXISTS `chef_depart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chef_depart` (
  `chef_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `chef_email` varchar(50) NOT NULL COMMENT 'Chef Email',
  `chef_password` varchar(50) NOT NULL COMMENT 'Chef Password',
  `depart_ID` int(11) NOT NULL,
  `prof_ID` int(11) DEFAULT 0,
  PRIMARY KEY (`chef_ID`),
  KEY `depart_ID` (`depart_ID`),
  KEY `prof_ID` (`prof_ID`),
  CONSTRAINT `chef_depart_ibfk_1` FOREIGN KEY (`depart_ID`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chef_depart_ibfk_2` FOREIGN KEY (`prof_ID`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chef_depart`
--

/*!40000 ALTER TABLE `chef_depart` DISABLE KEYS */;
/*!40000 ALTER TABLE `chef_depart` ENABLE KEYS */;

--
-- Table structure for table `coordonnateur`
--

DROP TABLE IF EXISTS `coordonnateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordonnateur` (
  `cord_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `cord_email` varchar(50) NOT NULL COMMENT 'cord Email',
  `cord_password` varchar(100) NOT NULL COMMENT 'cord Password',
  `filiere_ID` int(11) NOT NULL,
  `prof_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`cord_ID`),
  KEY `filiere_ID` (`filiere_ID`),
  KEY `prof_ID` (`prof_ID`),
  CONSTRAINT `coordonnateur_ibfk_1` FOREIGN KEY (`filiere_ID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `coordonnateur_ibfk_2` FOREIGN KEY (`prof_ID`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordonnateur`
--

/*!40000 ALTER TABLE `coordonnateur` DISABLE KEYS */;
INSERT INTO `coordonnateur` VALUES (22,'cordtdia@gmail.com','$2y$10$4JqmAUaX.dXufCQbfIHEY.jLrOPBDGO2A/8mVE9BSCduud/cg8/6u',1,78),(23,'cordcivil@gmail.com','$2y$10$R9rNVanGC.YGRgFrSdKEIuevFmfgXLPxNy4JtjOE99ZWwjpRuCHRm',3,79);
/*!40000 ALTER TABLE `coordonnateur` ENABLE KEYS */;

--
-- Table structure for table `departement`
--

DROP TABLE IF EXISTS `departement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departement` (
  `depart_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `depart_nom` varchar(255) DEFAULT NULL,
  `depart_details` varchar(255) DEFAULT 'details du département',
  PRIMARY KEY (`depart_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departement`
--

/*!40000 ALTER TABLE `departement` DISABLE KEYS */;
INSERT INTO `departement` VALUES (1,NULL,'Département Mathématiques et Informatique','le departements de fillieres info data et tdia'),(2,NULL,'Département Génie Civil Energétique et Environnement (GCEE)','Département Génie Civil Energétique et Environnement (GCEE)');
/*!40000 ALTER TABLE `departement` ENABLE KEYS */;

--
-- Table structure for table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filiere` (
  `filiere_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `filiere_nom` varchar(255) DEFAULT NULL,
  `filiere_details` varchar(255) DEFAULT NULL,
  `depart_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`filiere_ID`),
  KEY `depart_ID` (`depart_ID`),
  CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`depart_ID`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filiere`
--

/*!40000 ALTER TABLE `filiere` DISABLE KEYS */;
INSERT INTO `filiere` VALUES (1,NULL,'transformation digitale et intelligence artificiel','filliere tdia',1),(2,NULL,'génie informatique',NULL,1),(3,NULL,'génie civil','genie civil filliere',2),(4,NULL,'génie de l\'eau et l\'environnement','genie de l\'eau et de l\'environnement',2),(5,NULL,'Génie énergétique et énergies renouvelables','Details de Génie énergétique et énergies renouvelables',2),(6,NULL,'Ingenierie des données','Details de l\'ingenierie des données',1);
/*!40000 ALTER TABLE `filiere` ENABLE KEYS */;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id_etudiant` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `session` varchar(20) NOT NULL,
  `note` float NOT NULL,
  PRIMARY KEY (`id_etudiant`,`id_unite`,`session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,18,'normale',10),(1,18,'rattrapage',10),(2,18,'normale',14),(2,18,'rattrapage',14),(3,18,'normale',43),(3,18,'rattrapage',43);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;

--
-- Table structure for table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professeur` (
  `prof_ID` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`prof_ID`),
  KEY `prof_C1` (`user_ID`),
  CONSTRAINT `prof_C1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professeur`
--

/*!40000 ALTER TABLE `professeur` DISABLE KEYS */;
INSERT INTO `professeur` VALUES (77,'prof@gmail.com','$2y$10$C9sIlrQURh2gLYMvqdiiVeQ5xh3cPf3iVF2y4QRMXOjfugYmBK9c2','Computer science',70),(78,'prof2@gmail.com','Prof@1234','Data analyst',94),(79,'test@gmail.com','$2y$10$klzmWOLV3eEGsqam65yfJ.RTA8/L3Y4KXnxhBxlAy2TPobyFh2hCe','Data analyst',95);
/*!40000 ALTER TABLE `professeur` ENABLE KEYS */;

--
-- Table structure for table `unite`
--

DROP TABLE IF EXISTS `unite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unite` (
  `unite_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `unite_name` varchar(50) NOT NULL COMMENT 'Unité Name',
  `unite_specialite` varchar(50) NOT NULL COMMENT 'Unité spécialité',
  `unite_resp` int(11) DEFAULT NULL,
  `volume_cours` int(11) DEFAULT NULL COMMENT 'Volume horaire',
  `volume_td` int(11) DEFAULT NULL,
  `volume_tp` int(11) DEFAULT NULL COMMENT 'volume tp',
  `semestre` enum('S1','S2','S3','S4','S5') DEFAULT NULL COMMENT 'semestre du module',
  `filiere_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`unite_ID`),
  KEY `unite_resp` (`unite_resp`),
  KEY `filiere_ID` (`filiere_ID`),
  CONSTRAINT `unite_ibfk_1` FOREIGN KEY (`unite_resp`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unite_ibfk_2` FOREIGN KEY (`filiere_ID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unite`
--

/*!40000 ALTER TABLE `unite` DISABLE KEYS */;
INSERT INTO `unite` VALUES (15,'test sans resp','spécialité 1',NULL,30,20,20,'S2',4),(21,'UML','spécialité 2',78,30,30,24,'S3',1),(22,'LINUX','spécialité 2',79,27,24,12,'S1',1),(23,'Web developement','spécialité 3',78,30,24,16,'S2',1);
/*!40000 ALTER TABLE `unite` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (50,'EL HILALI','ayoub','UD18436','/ENSAH-service/assets/images/avatar-M.jpg','1999-10-15','masculin','hey sidi lghazi belarbi rue 29 N 39  tttttttttttttttt',771345878,'https://www.linkedin.com/in/ayoub-elhilali-0340832a4/','I am the admin of ENSAH-service admin test2'),(70,'EL HILALI','ayoub','UD1234','','2004-9-12','masculin',NULL,0,NULL,NULL),(71,'vacataire2','prenim','A1234','/ENSAH-service/uploads/1746664484.jpg','2000-7-6','feminin',NULL,0,NULL,'hada vacataire ta whd mky3rfo'),(72,'LAMAIZI','amin','A1234','/ENSAH-service/uploads/1746709564.jpg','2004-7-14','masculin','chi blassa f sraghna',7777777,'linkedindyalsergh','hada sergh mn seraghna wchkon mky3rfoch'),(73,'prof','prenom','A1234','','2002-8-13','masculin',NULL,0,NULL,''),(77,'elhilaLi','elhilaLi','m1234','','2025-1-1','masculin',NULL,0,NULL,NULL),(78,'elhilalli','ayouub','H1234','','2001-10-13','masculin',NULL,0,NULL,NULL),(79,'LAMAIZI','AMIN','H1234','/ENSAH-service/uploads/1746810527.jpg','2003-8-14','masculin',NULL,0,NULL,NULL),(80,'LAMAIZI','amin','A1234','/ENSAH-service/assets/images/avatar-M.jpg','2001-5-9','masculin','test',0,'',''),(81,'AIT M\'HAMMED','Ismayl','A13234','','2004-9-13','masculin',NULL,0,NULL,NULL),(91,'vacataire1','prenom','V1234','','2017-10-10','masculin',NULL,0,NULL,NULL),(92,'vacataire1','prenom','V1234','/ENSAH-service/assets/images/avatar-M.jpg','1983-10-14','masculin','address fjhhfh ffhqkhfkq ffffffffff',0,'',''),(93,'prof','prof2','A12345','','2017-9-11','masculin',NULL,0,NULL,NULL),(94,'prof','prof2','A12345','','2017-9-11','masculin',NULL,0,NULL,NULL),(95,'teest','tst','A567','','2015-6-11','feminin',NULL,0,NULL,NULL);
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
  `password` varchar(80) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`vacat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacataire`
--

/*!40000 ALTER TABLE `vacataire` DISABLE KEYS */;
INSERT INTO `vacataire` VALUES (7,'vacat@gmail.com','$2y$10$C9sIlrQURh2gLYMvqdiiVeQ5xh3cPf3iVF2y4QRMXOjfugYmBK9c2','cybersecurity',92);
/*!40000 ALTER TABLE `vacataire` ENABLE KEYS */;

--
-- Table structure for table `voeux`
--

DROP TABLE IF EXISTS `voeux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voeux` (
  `id_voeux` int(11) NOT NULL AUTO_INCREMENT,
  `id_unite` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1 si assure , 0 sinon',
  `date_soumission` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_voeux`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voeux`
--

/*!40000 ALTER TABLE `voeux` DISABLE KEYS */;
INSERT INTO `voeux` VALUES (13,15,76,1,'2025-05-22'),(14,16,76,0,'2025-05-22'),(15,18,76,1,'2025-05-22'),(19,15,79,0,'2025-05-28'),(20,21,79,0,'2025-05-28'),(21,22,79,0,'2025-05-28');
/*!40000 ALTER TABLE `voeux` ENABLE KEYS */;

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

-- Dump completed on 2025-05-28 18:44:24
