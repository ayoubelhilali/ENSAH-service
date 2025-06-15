-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ensah_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `email`, `password`, `user_ID`) VALUES
(1, 'elhilaliayoub2020@gmail.com', '$2y$10$dcRXQu9HR5hm4ohsScRHX.vMAUT17SnMtrobsnyNHxXMTMOdp1rYi', 50);

-- --------------------------------------------------------

--
-- Table structure for table `affect_ue_prof`
--

CREATE TABLE `affect_ue_prof` (
  `affect_id` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affect_ue_prof`
--

INSERT INTO `affect_ue_prof` (`affect_id`, `id_unite`, `id_prof`) VALUES
(13, 22, 79),
(20, 15, 77);

-- --------------------------------------------------------

--
-- Table structure for table `affect_ue_vac`
--

CREATE TABLE `affect_ue_vac` (
  `affect_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `unite_ID` int(11) DEFAULT NULL COMMENT 'Unité ID',
  `vacataire_ID` int(11) DEFAULT NULL COMMENT 'Vacataire ID',
  `date` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affect_ue_vac`
--

INSERT INTO `affect_ue_vac` (`affect_ID`, `unite_ID`, `vacataire_ID`, `date`) VALUES
(1, 16, 6, NULL),
(2, 6, 5, NULL),
(3, 134, 7, NULL),
(4, 133, 7, NULL),
(5, 139, 7, NULL),
(6, 140, 7, NULL),
(7, 153, 7, NULL),
(8, 152, 7, NULL),
(9, 151, 8, '2025-06-15 01:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE `annonces` (
  `annonce_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `annonce_head` varchar(50) NOT NULL COMMENT 'Annonce Head',
  `annonce_body` varchar(150) NOT NULL COMMENT 'Annonce body',
  `annonce_date` datetime NOT NULL COMMENT 'Annonce Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`annonce_ID`, `annonce_head`, `annonce_body`, `annonce_date`) VALUES
(1, 'Test annonce by admin', 'details de l\"anncoce par amin hello wordl...;!!!!', '2025-05-15 00:00:00'),
(2, 'test 2', 'hello from admin', '2025-05-15 17:12:31'),
(3, 'test annonce 3', 'tttttttttttttttttttttttttttttt', '2025-05-15 17:18:53'),
(4, 'test long annonce', 'test long annonce test long annonce test long anno', '2025-05-27 11:37:28'),
(5, 'test long annonce 2', 'test long annonce test long annonce test long annonce test long annonce test long annonce test long announce test long annonce test long annonce', '2025-05-27 11:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `chef_depart`
--

CREATE TABLE `chef_depart` (
  `chef_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `chef_email` varchar(50) NOT NULL COMMENT 'Chef Email',
  `chef_password` varchar(50) NOT NULL COMMENT 'Chef Password',
  `depart_ID` int(11) NOT NULL,
  `prof_ID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coordonnateur`
--

CREATE TABLE `coordonnateur` (
  `cord_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `cord_email` varchar(50) NOT NULL COMMENT 'cord Email',
  `cord_password` varchar(100) NOT NULL COMMENT 'cord Password',
  `filiere_ID` int(11) NOT NULL,
  `prof_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `depart_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `depart_nom` varchar(255) DEFAULT NULL,
  `depart_details` varchar(255) DEFAULT 'details du département'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`depart_ID`, `create_time`, `depart_nom`, `depart_details`) VALUES
(1, NULL, 'Département Mathématiques et Informatique', 'le departements de fillieres info data et tdia'),
(2, NULL, 'Département Génie Civil Energétique et Environnement (GCEE)', 'Département Génie Civil Energétique et Environnement (GCEE)');

-- --------------------------------------------------------

--
-- Table structure for table `emploi`
--

CREATE TABLE `emploi` (
  `emploi_ID` int(11) NOT NULL,
  `semestre` varchar(3) NOT NULL,
  `annee` varchar(10) NOT NULL,
  `filiereID` int(11) NOT NULL,
  `file_path` char(50) NOT NULL,
  `date_publication` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emploi`
--

INSERT INTO `emploi` (`emploi_ID`, `semestre`, `annee`, `filiereID`, `file_path`, `date_publication`) VALUES
(1, 'S3', '2024/2025', 1, '/ENSAH-service/uploads/emploi/cahier_charge_projet', '2025-06-08 23:11:18'),
(2, 'S3', '2024/2025', 3, '/ENSAH-service/uploads/emploi/cahier_charge_projet', '2025-06-08 23:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `filiere_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `filiere_nom` varchar(255) DEFAULT NULL,
  `filiere_details` varchar(255) DEFAULT NULL,
  `depart_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`filiere_ID`, `create_time`, `filiere_nom`, `filiere_details`, `depart_ID`) VALUES
(1, NULL, 'transformation digitale et intelligence artificiel', 'filliere tdia', 1),
(2, NULL, 'génie informatique', NULL, 1),
(3, NULL, 'génie civil', 'genie civil filliere', 2),
(4, NULL, 'génie de l\'eau et l\'environnement', 'genie de l\'eau et de l\'environnement', 2),
(5, NULL, 'Génie énergétique et énergies renouvelables', 'Details de Génie énergétique et énergies renouvelables', 2),
(6, NULL, 'Ingenierie des données', 'Details de l\'ingenierie des données', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id_etudiant` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `session` varchar(20) NOT NULL,
  `note` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id_etudiant`, `id_unite`, `session`, `note`) VALUES
(1, 18, 'normale', 10),
(1, 18, 'rattrapage', 10),
(2, 18, 'normale', 14),
(2, 18, 'rattrapage', 14),
(3, 18, 'normale', 43),
(3, 18, 'rattrapage', 43);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `title` char(30) NOT NULL,
  `status` enum('read','unread') DEFAULT 'unread',
  `content` varchar(400) NOT NULL,
  `type` enum('general','personel','coordonnateur','professeur','chef','vacataire') DEFAULT 'general'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_user`, `date_time`, `title`, `status`, `content`, `type`) VALUES
(1, 96, '2025-06-08 22:18:14', 'Compte cree avec succee', 'unread', 'Felicitations, votre compte en tant que professeur a ete cree, veuilez changer votre password dans profil->changerpassword.', 'personel'),
(2, 97, '2025-06-08 22:19:30', 'Compte cree avec succee', 'unread', 'Felicitations, votre compte en tant que professeur a ete cree, veuilez changer votre password dans profil->changerpassword.', 'personel'),
(3, 98, '2025-06-09 20:19:18', 'Compte cree avec succee', 'unread', 'Felicitations, votre compte en tant que professeur a ete cree, veuilez changer votre password dans profil->changerpassword.', 'personel'),
(4, 99, '2025-06-14 23:11:30', 'Nouvelle notification', 'read', 'Vous avez été ajouté en tant que vacataire.', 'general'),
(7, 104, '2025-06-15 13:25:38', 'Compte cree avec succee', 'unread', 'Felicitations, votre compte en tant que professeur a ete cree, veuilez changer votre password dans profil->changerpassword.', 'personel'),
(8, 105, '2025-06-15 14:05:27', 'Compte cree avec succee', 'unread', 'Felicitations, votre compte en tant que professeur a ete cree, veuilez changer votre password dans profil->changerpassword.', 'personel'),
(9, 106, '2025-06-15 14:36:11', 'Compte cree avec succee', 'unread', 'Felicitations, votre compte en tant que professeur a ete cree, veuilez changer votre password dans profil->changerpassword.', 'personel');

-- --------------------------------------------------------

--
-- Table structure for table `professeur`
--

CREATE TABLE `professeur` (
  `prof_ID` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professeur`
--

INSERT INTO `professeur` (`prof_ID`, `email`, `password`, `specialite`, `user_ID`, `departement`) VALUES
(84, 'xawat26116@ethsms.com', '$2y$10$V1s.NBUeNedhpkLy2E5VTeiSnvYrWVxVSNm8d3RWawD.yj2ew1Rp6', 'cybersecurity', 104, 1),
(85, 'xawat263116@ethsms.com', '$2y$10$h6vhMp0OcFCct5.GfqXAI.TKIBUUPstt1cjU9zrRZgBVyVEvllB/G', 'cybersecurity', 105, 1),
(86, 'haxem45498@ethsms.com', '$2y$10$a.oX1F3yfSJDC1ccxyLFEe.6DAc84TDxoAGcx.I.DzKeqdy/S2MvO', 'Cloud Computing', 106, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unite`
--

CREATE TABLE `unite` (
  `unite_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `unite_name` varchar(50) NOT NULL COMMENT 'Unité Name',
  `unite_specialite` varchar(50) NOT NULL COMMENT 'Unité spécialité',
  `unite_resp` int(11) DEFAULT NULL,
  `volume_cours` int(11) DEFAULT 0 COMMENT 'Volume horaire',
  `volume_td` int(11) DEFAULT 0,
  `volume_tp` int(11) DEFAULT 0 COMMENT 'volume tp',
  `semestre` enum('S1','S2','S3','S4','S5') DEFAULT NULL COMMENT 'semestre du module',
  `filiere_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `CIN` varchar(10) NOT NULL,
  `image` varchar(70) NOT NULL,
  `date_naissance` varchar(11) NOT NULL,
  `genre` enum('masculin','feminin') NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Phone` int(11) NOT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `nom`, `prenom`, `CIN`, `image`, `date_naissance`, `genre`, `address`, `Phone`, `linkedin`, `bio`) VALUES
(50, 'EL HILALI', 'ayoub', 'UD18436', '/ENSAH-service/assets/images/avatar-M.jpg', '1999-10-15', 'masculin', 'hey sidi lghazi belarbi rue 29 N 39  tttttttttttttttt', 771345878, 'https://www.linkedin.com/in/ayoub-elhilali-0340832a4/', 'I am the admin of ENSAH-service admin test2'),
(70, 'EL HILALI', 'ayoub', 'UD1234', '', '2004-9-12', 'masculin', NULL, 0, NULL, NULL),
(71, 'vacataire2', 'prenim', 'A1234', '/ENSAH-service/uploads/1746664484.jpg', '2000-7-6', 'feminin', NULL, 0, NULL, 'hada vacataire ta whd mky3rfo'),
(72, 'LAMAIZI', 'amin', 'A1234', '/ENSAH-service/uploads/1746709564.jpg', '2004-7-14', 'masculin', 'chi blassa f sraghna', 7777777, 'linkedindyalsergh', 'hada sergh mn seraghna wchkon mky3rfoch'),
(73, 'prof', 'prenom', 'A1234', '', '2002-8-13', 'masculin', NULL, 0, NULL, ''),
(76, 'ibrahim', 'EL', 'UD16765', '', '', '', NULL, 0, NULL, NULL),
(77, 'elhilaLi', 'elhilaLi', 'm1234', '', '2025-1-1', 'masculin', NULL, 0, NULL, NULL),
(78, 'elhilalli', 'ayouub', 'H1234', '', '2001-10-13', 'masculin', NULL, 0, NULL, NULL),
(79, 'LAMAIZI', 'AMIN', 'H1234', '/ENSAH-service/uploads/1746810527.jpg', '2003-8-14', 'masculin', NULL, 0, NULL, NULL),
(80, 'LAMAIZI', 'amin', 'A1234', '/ENSAH-service/assets/images/avatar-M.jpg', '2001-5-9', 'masculin', 'test', 0, '', ''),
(81, 'AIT M\'HAMMED', 'Ismayl', 'A13234', '', '2004-9-13', 'masculin', NULL, 0, NULL, NULL),
(91, 'vacataire1', 'prenom', 'V1234', '', '2017-10-10', 'masculin', NULL, 0, NULL, NULL),
(92, 'vacataire1', 'prenom', 'V1234', '/ENSAH-service/assets/images/avatar-M.jpg', '1983-10-14', 'masculin', 'address fjhhfh ffhqkhfkq ffffffffff', 0, '', ''),
(93, 'prof', 'prof2', 'A12345', '', '2017-9-11', 'masculin', NULL, 0, NULL, NULL),
(94, 'prof', 'prof2', 'A12345', '', '2017-9-11', 'masculin', NULL, 0, NULL, NULL),
(95, 'teest', 'tst', 'A567', '', '2015-6-11', 'feminin', NULL, 0, NULL, NULL),
(96, 'temp', 'prof2', 'P12345', '', '2015-7-13', 'masculin', NULL, 0, NULL, NULL),
(97, 'test2', 'prof', 'P12345', '', '2002-8-15', 'masculin', NULL, 0, NULL, NULL),
(98, 'test', 'test', 'T12345', '', '2000-9-12', 'masculin', NULL, 0, NULL, NULL),
(99, 'vaca', 'vZEFH', 'FGHH46', '', '2000-8-12', 'masculin', NULL, 0, NULL, NULL),
(100, 'test', 'test', 'F345', '', '1997-10-7', 'feminin', NULL, 0, NULL, NULL),
(101, 'vacataife', 'preo,of', 'G56352', '', '1998-7-23', 'masculin', NULL, 0, NULL, NULL),
(102, 'prof', 'prfoZ', 'A123454', '', '2004-11-15', 'masculin', NULL, 0, NULL, NULL),
(103, 'prof', 'prfoZ', 'A123454', '', '2004-11-15', 'masculin', NULL, 0, NULL, NULL),
(104, 'prof', 'prf', 'P123455', '', '1990-10-13', 'masculin', NULL, 0, NULL, NULL),
(105, 'prof', 'prf', 'P123455', '', '1990-10-13', 'masculin', NULL, 0, NULL, NULL),
(106, 'testprof', 'test', 'T13456', '', '1999-10-13', 'masculin', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vacataire`
--

CREATE TABLE `vacataire` (
  `vacat_ID` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacataire`
--

INSERT INTO `vacataire` (`vacat_ID`, `email`, `password`, `specialite`, `user_ID`) VALUES
(7, 'vacat@gmail.com', '$2y$10$C9sIlrQURh2gLYMvqdiiVeQ5xh3cPf3iVF2y4QRMXOjfugYmBK9c2', 'cybersecurity', 92),
(8, 'nijenab727@finfave.com', '$2y$10$9GanjUQm4hlCfL6octo/Fu5ne7ReOztXQcKT8Ot2nM4LT9ZrUS.Bq', 'Computer science', 99),
(9, 'nihati1034@ethsms.com', '$2y$10$uMrO.HDduEDWcJwyQweyLuGu6JCHnIi1icBMTHYYcu7gIMcNKSP0G', 'cybersecurity', 100),
(10, 'xawat26116@ethsms.com', '$2y$10$DAMUyBuUWLMoXU.hBO8f5eBi892Dwyk1CZ6W2.tooGohsAYy.rYde', 'Data analyst', 101);

-- --------------------------------------------------------

--
-- Table structure for table `vacataire_note`
--

CREATE TABLE `vacataire_note` (
  `Note_ID` int(11) NOT NULL,
  `unite_ID` int(11) NOT NULL,
  `session` varchar(10) NOT NULL,
  `vacataire_ID` int(11) NOT NULL,
  `annee` char(10) NOT NULL,
  `file_path` char(50) NOT NULL,
  `date_publication` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacataire_note`
--

INSERT INTO `vacataire_note` (`Note_ID`, `unite_ID`, `session`, `vacataire_ID`, `annee`, `file_path`, `date_publication`) VALUES
(1, 133, 'Rattrapage', 7, '2024/2025', '/ENSAH-service/uploads/notes/Cours-Complet-PHP-et-', '2025-06-12 00:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `voeux`
--

CREATE TABLE `voeux` (
  `id_voeux` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1 si assure , 0 sinon',
  `date_soumission` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voeux`
--

INSERT INTO `voeux` (`id_voeux`, `id_unite`, `id_prof`, `status`, `date_soumission`) VALUES
(13, 15, 76, 0, '2025-05-22'),
(15, 18, 76, 0, '2025-05-22'),
(19, 15, 79, 1, '2025-05-28'),
(20, 21, 79, 0, '2025-05-28'),
(21, 22, 79, 1, '2025-05-28'),
(33, 132, 78, 0, '2025-06-11'),
(34, 133, 78, 1, '2025-06-11'),
(35, 134, 78, 0, '2025-06-11'),
(36, 135, 78, 1, '2025-06-11'),
(37, 136, 78, 1, '2025-06-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `affect_ue_prof`
--
ALTER TABLE `affect_ue_prof`
  ADD PRIMARY KEY (`affect_id`);

--
-- Indexes for table `affect_ue_vac`
--
ALTER TABLE `affect_ue_vac`
  ADD PRIMARY KEY (`affect_ID`);

--
-- Indexes for table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`annonce_ID`);

--
-- Indexes for table `chef_depart`
--
ALTER TABLE `chef_depart`
  ADD PRIMARY KEY (`chef_ID`),
  ADD KEY `depart_ID` (`depart_ID`),
  ADD KEY `prof_ID` (`prof_ID`);

--
-- Indexes for table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  ADD PRIMARY KEY (`cord_ID`),
  ADD KEY `filiere_ID` (`filiere_ID`),
  ADD KEY `prof_ID` (`prof_ID`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`depart_ID`);

--
-- Indexes for table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`emploi_ID`),
  ADD KEY `filiere_ID` (`filiereID`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`filiere_ID`),
  ADD KEY `depart_ID` (`depart_ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_etudiant`,`id_unite`,`session`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`prof_ID`),
  ADD KEY `prof_C1` (`user_ID`),
  ADD KEY `departement_ID` (`departement`);

--
-- Indexes for table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`unite_ID`),
  ADD KEY `unite_resp` (`unite_resp`),
  ADD KEY `filiere_ID` (`filiere_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `vacataire`
--
ALTER TABLE `vacataire`
  ADD PRIMARY KEY (`vacat_ID`);

--
-- Indexes for table `vacataire_note`
--
ALTER TABLE `vacataire_note`
  ADD PRIMARY KEY (`Note_ID`);

--
-- Indexes for table `voeux`
--
ALTER TABLE `voeux`
  ADD PRIMARY KEY (`id_voeux`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `affect_ue_prof`
--
ALTER TABLE `affect_ue_prof`
  MODIFY `affect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `affect_ue_vac`
--
ALTER TABLE `affect_ue_vac`
  MODIFY `affect_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `annonce_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chef_depart`
--
ALTER TABLE `chef_depart`
  MODIFY `chef_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  MODIFY `cord_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `depart_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `emploi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `filiere_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `prof_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `unite`
--
ALTER TABLE `unite`
  MODIFY `unite_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `vacataire`
--
ALTER TABLE `vacataire`
  MODIFY `vacat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vacataire_note`
--
ALTER TABLE `vacataire_note`
  MODIFY `Note_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voeux`
--
ALTER TABLE `voeux`
  MODIFY `id_voeux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chef_depart`
--
ALTER TABLE `chef_depart`
  ADD CONSTRAINT `chef_depart_ibfk_1` FOREIGN KEY (`depart_ID`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chef_depart_ibfk_2` FOREIGN KEY (`prof_ID`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  ADD CONSTRAINT `coordonnateur_ibfk_1` FOREIGN KEY (`filiere_ID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coordonnateur_ibfk_2` FOREIGN KEY (`prof_ID`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emploi`
--
ALTER TABLE `emploi`
  ADD CONSTRAINT `emploi_ibfk_1` FOREIGN KEY (`filiereID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`depart_ID`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `prof_C1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professeur_ibfk_1` FOREIGN KEY (`departement`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unite`
--
ALTER TABLE `unite`
  ADD CONSTRAINT `unite_ibfk_1` FOREIGN KEY (`unite_resp`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unite_ibfk_2` FOREIGN KEY (`filiere_ID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
