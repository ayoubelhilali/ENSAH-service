-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 08 juin 2025 à 22:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ensah_service`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_ID`, `email`, `password`, `user_ID`) VALUES
(1, 'elhilaliayoub2020@gmail.com', '$2y$10$dcRXQu9HR5hm4ohsScRHX.vMAUT17SnMtrobsnyNHxXMTMOdp1rYi', 50);

-- --------------------------------------------------------

--
-- Structure de la table `affect_ue_prof`
--

CREATE TABLE `affect_ue_prof` (
  `affect_id` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `affect_ue_prof`
--

INSERT INTO `affect_ue_prof` (`affect_id`, `id_unite`, `id_prof`) VALUES
(13, 22, 79),
(20, 15, 77);

-- --------------------------------------------------------

--
-- Structure de la table `affect_ue_vac`
--

CREATE TABLE `affect_ue_vac` (
  `affect_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `unite_ID` int(11) DEFAULT NULL COMMENT 'Unité ID',
  `vacataire_ID` int(11) DEFAULT NULL COMMENT 'Vacataire ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `affect_ue_vac`
--

INSERT INTO `affect_ue_vac` (`affect_ID`, `unite_ID`, `vacataire_ID`) VALUES
(1, 16, 6),
(2, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `annonce_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `annonce_head` varchar(50) NOT NULL COMMENT 'Annonce Head',
  `annonce_body` varchar(150) NOT NULL COMMENT 'Annonce body',
  `annonce_date` datetime NOT NULL COMMENT 'Annonce Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`annonce_ID`, `annonce_head`, `annonce_body`, `annonce_date`) VALUES
(1, 'Test annonce by admin', 'details de l\"anncoce par amin hello wordl...;!!!!', '2025-05-15 00:00:00'),
(2, 'test 2', 'hello from admin', '2025-05-15 17:12:31'),
(3, 'test annonce 3', 'tttttttttttttttttttttttttttttt', '2025-05-15 17:18:53'),
(4, 'test long annonce', 'test long annonce test long annonce test long anno', '2025-05-27 11:37:28'),
(5, 'test long annonce 2', 'test long annonce test long annonce test long annonce test long annonce test long annonce test long announce test long annonce test long annonce', '2025-05-27 11:38:20');

-- --------------------------------------------------------

--
-- Structure de la table `chef_depart`
--

CREATE TABLE `chef_depart` (
  `chef_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `chef_email` varchar(50) NOT NULL COMMENT 'Chef Email',
  `chef_password` varchar(50) NOT NULL COMMENT 'Chef Password',
  `depart_ID` int(11) NOT NULL,
  `prof_ID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chef_depart`
--

INSERT INTO `chef_depart` (`chef_ID`, `chef_email`, `chef_password`, `depart_ID`, `prof_ID`) VALUES
(1, 'brahim@gmail.com', 'Aa12345', 1, 77),
(2, 'moi@gmail.com', 'Aa12345', 2, 79),
(5, 'test@a.b', 'Aa12345', 1, 76);

-- --------------------------------------------------------

--
-- Structure de la table `coordonnateur`
--

CREATE TABLE `coordonnateur` (
  `cord_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `cord_email` varchar(50) NOT NULL COMMENT 'cord Email',
  `cord_password` varchar(100) NOT NULL COMMENT 'cord Password',
  `filiere_ID` int(11) NOT NULL,
  `prof_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coordonnateur`
--

INSERT INTO `coordonnateur` (`cord_ID`, `cord_email`, `cord_password`, `filiere_ID`, `prof_ID`) VALUES
(22, 'cordtdia@gmail.com', '$2y$10$4JqmAUaX.dXufCQbfIHEY.jLrOPBDGO2A/8mVE9BSCduud/cg8/6u', 1, 78),
(23, 'cordcivil@gmail.com', '$2y$10$R9rNVanGC.YGRgFrSdKEIuevFmfgXLPxNy4JtjOE99ZWwjpRuCHRm', 3, 79);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `depart_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `depart_nom` varchar(255) DEFAULT NULL,
  `depart_details` varchar(255) DEFAULT 'details du département'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`depart_ID`, `create_time`, `depart_nom`, `depart_details`) VALUES
(1, NULL, 'Département Mathématiques et Informatique', 'le departements de fillieres info data et tdia'),
(2, NULL, 'Département Génie Civil Energétique et Environnement (GCEE)', 'Département Génie Civil Energétique et Environnement (GCEE)');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `filiere_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `filiere_nom` varchar(255) DEFAULT NULL,
  `filiere_details` varchar(255) DEFAULT NULL,
  `depart_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
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
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_etudiant` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `session` varchar(20) NOT NULL,
  `note` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
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
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `prof_ID` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `filiere_id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`prof_ID`, `email`, `password`, `specialite`, `filiere_id`, `user_ID`) VALUES
(76, 'brahim@etu.com', 'Aa12345', 'Mathematics', 3, 76),
(77, 'prof@gmail.com', '$2y$10$C9sIlrQURh2gLYMvqdiiVeQ5xh3cPf3iVF2y4QRMXOjfugYmBK9c2', 'Computer science', 4, 70),
(78, 'prof2@gmail.com', 'Prof@1234', 'Data analyst', 0, 94),
(79, 'test@gmail.com', '$2y$10$klzmWOLV3eEGsqam65yfJ.RTA8/L3Y4KXnxhBxlAy2TPobyFh2hCe', 'Data analyst', 4, 95);

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

CREATE TABLE `unite` (
  `unite_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `unite_name` varchar(50) NOT NULL COMMENT 'Unité Name',
  `unite_specialite` varchar(50) NOT NULL COMMENT 'Unité spécialité',
  `unite_resp` int(11) DEFAULT NULL,
  `volume_cours` int(11) DEFAULT NULL COMMENT 'Volume horaire',
  `volume_td` int(11) DEFAULT NULL,
  `volume_tp` int(11) DEFAULT NULL COMMENT 'volume tp',
  `semestre` enum('S1','S2','S3','S4','S5') DEFAULT NULL COMMENT 'semestre du module',
  `filiere_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`unite_ID`, `unite_name`, `unite_specialite`, `unite_resp`, `volume_cours`, `volume_td`, `volume_tp`, `semestre`, `filiere_ID`) VALUES
(15, 'test sans resp', 'spécialité 1', NULL, 30, 20, 20, 'S2', 4),
(21, 'UML', 'spécialité 2', 78, 30, 30, 24, 'S3', 1),
(22, 'LINUX', 'spécialité 2', 79, 27, 24, 12, 'S1', 1),
(23, 'Web developement', 'spécialité 3', 78, 30, 24, 16, 'S2', 1),
(24, 'cpp', 'specialite 2', 76, 30, 30, 30, 'S2', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
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
-- Déchargement des données de la table `user`
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
(95, 'teest', 'tst', 'A567', '', '2015-6-11', 'feminin', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vacataire`
--

CREATE TABLE `vacataire` (
  `vacat_ID` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vacataire`
--

INSERT INTO `vacataire` (`vacat_ID`, `email`, `password`, `specialite`, `user_ID`) VALUES
(7, 'vacat@gmail.com', '$2y$10$C9sIlrQURh2gLYMvqdiiVeQ5xh3cPf3iVF2y4QRMXOjfugYmBK9c2', 'cybersecurity', 92);

-- --------------------------------------------------------

--
-- Structure de la table `voeux`
--

CREATE TABLE `voeux` (
  `id_voeux` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1 si assure , 0 sinon',
  `date_soumission` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voeux`
--

INSERT INTO `voeux` (`id_voeux`, `id_unite`, `id_prof`, `status`, `date_soumission`) VALUES
(13, 15, 76, 0, '2025-05-22'),
(15, 18, 76, 0, '2025-05-22'),
(19, 15, 79, 1, '2025-05-28'),
(20, 21, 79, 0, '2025-05-28'),
(21, 22, 79, 1, '2025-05-28');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Index pour la table `affect_ue_prof`
--
ALTER TABLE `affect_ue_prof`
  ADD PRIMARY KEY (`affect_id`);

--
-- Index pour la table `affect_ue_vac`
--
ALTER TABLE `affect_ue_vac`
  ADD PRIMARY KEY (`affect_ID`);

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`annonce_ID`);

--
-- Index pour la table `chef_depart`
--
ALTER TABLE `chef_depart`
  ADD PRIMARY KEY (`chef_ID`),
  ADD KEY `depart_ID` (`depart_ID`),
  ADD KEY `prof_ID` (`prof_ID`);

--
-- Index pour la table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  ADD PRIMARY KEY (`cord_ID`),
  ADD KEY `filiere_ID` (`filiere_ID`),
  ADD KEY `prof_ID` (`prof_ID`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`depart_ID`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`filiere_ID`),
  ADD KEY `depart_ID` (`depart_ID`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_etudiant`,`id_unite`,`session`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`prof_ID`),
  ADD KEY `prof_C1` (`user_ID`);

--
-- Index pour la table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`unite_ID`),
  ADD KEY `unite_resp` (`unite_resp`),
  ADD KEY `filiere_ID` (`filiere_ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Index pour la table `vacataire`
--
ALTER TABLE `vacataire`
  ADD PRIMARY KEY (`vacat_ID`);

--
-- Index pour la table `voeux`
--
ALTER TABLE `voeux`
  ADD PRIMARY KEY (`id_voeux`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `affect_ue_prof`
--
ALTER TABLE `affect_ue_prof`
  MODIFY `affect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `affect_ue_vac`
--
ALTER TABLE `affect_ue_vac`
  MODIFY `affect_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `annonce_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `chef_depart`
--
ALTER TABLE `chef_depart`
  MODIFY `chef_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  MODIFY `cord_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `depart_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `filiere_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `prof_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `unite`
--
ALTER TABLE `unite`
  MODIFY `unite_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `vacataire`
--
ALTER TABLE `vacataire`
  MODIFY `vacat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `voeux`
--
ALTER TABLE `voeux`
  MODIFY `id_voeux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chef_depart`
--
ALTER TABLE `chef_depart`
  ADD CONSTRAINT `chef_depart_ibfk_1` FOREIGN KEY (`depart_ID`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chef_depart_ibfk_2` FOREIGN KEY (`prof_ID`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  ADD CONSTRAINT `coordonnateur_ibfk_1` FOREIGN KEY (`filiere_ID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coordonnateur_ibfk_2` FOREIGN KEY (`prof_ID`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`depart_ID`) REFERENCES `departement` (`depart_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `prof_C1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `unite`
--
ALTER TABLE `unite`
  ADD CONSTRAINT `unite_ibfk_1` FOREIGN KEY (`unite_resp`) REFERENCES `professeur` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unite_ibfk_2` FOREIGN KEY (`filiere_ID`) REFERENCES `filiere` (`filiere_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
