-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 mai 2025 à 21:20
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

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_ID` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_ID`, `email`, `password`, `user_ID`) VALUES
(1, 'elhilaliayoub2020@gmail.com', 'admin1234', 50);

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `annonce_ID` int(11) NOT NULL COMMENT 'Primary Key',
  `annonce_head` varchar(50) NOT NULL COMMENT 'Annonce Head',
  `annonce_body` varchar(50) NOT NULL COMMENT 'Annonce body',
  `annonce_date` datetime NOT NULL COMMENT 'Annonce Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`annonce_ID`, `annonce_head`, `annonce_body`, `annonce_date`) VALUES
(1, 'Test annonce by admin', 'details de l\"anncoce par amin hello wordl...;!!!!', '2025-05-15 00:00:00'),
(2, 'test 2', 'hello from admin', '2025-05-15 17:12:31'),
(3, 'test annonce 3', 'tttttttttttttttttttttttttttttt', '2025-05-15 17:18:53');

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
(19, 'chefemail@gmail.com', '937e91fb78eb3713385f630d3f5998a0fa7423c62ed847b883', 1, 71),
(20, 'aitmhammedchef@gmail.com', '2ca8ef68b3d0df6976020f0395b7a884245ab5fbdefd0f6067', 2, 75);

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
(19, 'cordcivil@gmail.com', '$2y$10$lF92Id3dNHFb8tEIhVdhDu5.DNibiu07dFtMtXiSGXI.d3EZu2aSG', 3, 75),
(21, 'cordtdia@gmail.com', '$2y$10$MH9xjZUe4Og2NIvOtwmijecM.W8ziD5Mu567j514M.wcuIiJp/QjK', 1, 73);

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
  `password` varchar(25) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `md5_pass` varchar(25) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`prof_ID`, `email`, `password`, `specialite`, `md5_pass`, `user_ID`) VALUES
(67, 'prof@gmail.com', '0:pZaMhuJ', 'cybersecurity', 'b6214057a3ed8bb66b3200cdf', 73),
(71, 'elelhilali2020@gmai.com', 'n@S&gt;xf49u', 'Computer science', '70d780f8652b5bb17df1604d8', 77),
(72, 'ayayoubelhilali@gmail.com', 'Neof990@', 'cybersecurity', '4583b96e1e5b19ef312bac06e', 78),
(73, 'brahim20041220@gmail.com', 'YY@w^9-gk', 'Computer science', '491c71525f4ec91ef3ef761c8', 79),
(74, 'lamaiziamin222@gmail.com', 'Wceh=36oN', 'Computer science', 'a2aec7bcc6fb46ea39e610ab0', 80),
(75, 'ismayl.aitmhamed@etu.uae.ac.ma', 'iPW|x{5Ye', 'Mathematics', '5c7b3e30ae06a8d8e20a7fa89', 81),
(76, 'brahim@etu.com', 'Aa12345', 'Mathematics', '', 73);

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
(1, 'Réseaux informatiques', 'spécialité 3', 74, 26, 18, 14, 'S1', 2),
(5, 'Architecture des ordinateurs', 'spécialité 1', 67, 26, 16, 16, 'S1', 2),
(6, ' Langage C avancé et structures de données', 'spécialité 2', 71, 26, 16, 18, 'S1', 1),
(7, 'Web1 : Technologies de Web et PHP5', 'spécialité 2', 72, 26, 10, 16, 'S2', 2),
(15, 'test sans resp', 'spécialité 1', NULL, 30, 20, 20, 'S2', 4),
(16, 'test module', 'spécialité 3', 75, 20, 20, 22, 'S4', 1),
(18, 'python', 'spécialité 2', 75, 20, 20, 20, 'S3', 2),
(19, 'test', 'spécialité 2', 73, 20, 20, 20, 'S3', NULL);

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
(50, 'EL HILALI', 'ayoub', 'UD18436', '/ENSAH-service/assets/images/avatar-M.jpg', '2004-4-8', 'masculin', 'hey sidi lghazi belarbi rue 29 N 39 ', 771345878, 'https://www.linkedin.com/in/ayoub-elhilali-0340832a4/', 'I am the admin of ENSAH-service admin test2'),
(70, 'EL HILALI', 'ayoub', 'UD1234', '', '2004-9-12', 'masculin', NULL, 0, NULL, NULL),
(71, 'vacataire2', 'prenim', 'A1234', '/ENSAH-service/uploads/1746664484.jpg', '2000-7-6', 'feminin', NULL, 0, NULL, 'hada vacataire ta whd mky3rfo'),
(72, 'LAMAIZI', 'amin', 'A1234', '/ENSAH-service/uploads/1746709564.jpg', '2004-7-14', 'masculin', 'chi blassa f sraghna', 7777777, 'linkedindyalsergh', 'hada sergh mn seraghna wchkon mky3rfoch'),
(73, 'prof', 'prenom', 'A1234', '', '2002-8-13', 'masculin', NULL, 0, NULL, ''),
(77, 'elhilaLi', 'elhilaLi', 'm1234', '', '2025-1-1', 'masculin', NULL, 0, NULL, NULL),
(78, 'elhilalli', 'ayouub', 'H1234', '', '2001-10-13', 'masculin', NULL, 0, NULL, NULL),
(79, 'LAMAIZI', 'AMIN', 'H1234', '/ENSAH-service/uploads/1746810527.jpg', '2003-8-14', 'masculin', NULL, 0, NULL, NULL),
(80, 'LAMAIZI', 'amin', 'A1234', '/ENSAH-service/assets/images/avatar-M.jpg', '2001-5-9', 'masculin', 'test', 0, '', ''),
(81, 'AIT M\'HAMMED', 'Ismayl', 'A13234', '', '2004-9-13', 'masculin', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vacataire`
--

CREATE TABLE IF NOT EXISTS `vacataire` (
  `vacat_ID` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `md5_pass` varchar(70) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vacataire`
--

INSERT INTO `vacataire` (`vacat_ID`, `email`, `password`, `specialite`, `md5_pass`, `user_ID`) VALUES
(4, 'elhilaliayoub2020@gmail.com', 'A12345@f', 'cybersecurity', '5385e1e6fa440178e394dbc77e67514a', 70),
(5, 'ahhh@gmail.Com', 'M&lt;,;bxw38', 'Mathematics', '72ab271efd7606fae22c120fdc55dd8b', 71),
(6, 'lamaiziamin@gmail.com', '2Zv*]#a:!', 'Data analyst', '133c2a6bd35c2f8b8ce97b4dbeaff655', 72);

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
(13, 15, 76, 1, '2025-05-22'),
(14, 16, 76, 0, '2025-05-22'),
(15, 18, 76, 1, '2025-05-22');

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
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `annonce_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chef_depart`
--
ALTER TABLE `chef_depart`
  MODIFY `chef_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `coordonnateur`
--
ALTER TABLE `coordonnateur`
  MODIFY `cord_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=22;

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
  MODIFY `prof_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `unite`
--
ALTER TABLE `unite`
  MODIFY `unite_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `vacataire`
--
ALTER TABLE `vacataire`
  MODIFY `vacat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `voeux`
--
ALTER TABLE `voeux`
  MODIFY `id_voeux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
