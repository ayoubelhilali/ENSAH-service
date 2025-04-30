-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 29, 2025 at 04:27 AM
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
-- Table structure for table `professeur`
--

CREATE TABLE `professeur` (
  `prof_ID` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `specialite` enum('Computer science','Data analyst','cybersecurity','Mathematics') NOT NULL,
  `md5_pass` varchar(25) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professeur`
--

INSERT INTO `professeur` (`prof_ID`, `email`, `password`, `specialite`, `md5_pass`, `user_ID`) VALUES
(17, 'prof1@test.com', 'prof11234', 'cybersecurity', '6e56f25ae8f691de1a694c89f', 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `date_naissance` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL ,
  `password` varchar(8) NOT NULL ,
  `genre` enum('masculin','feminin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `nom`, `prenom`, `date_naissance`, `genre`) VALUES
(17, 'prof1', 'prof1', '2017-7-8', 'masculin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`prof_ID`),
  ADD KEY `prof_C1` (`user_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `prof_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `prof_C1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
