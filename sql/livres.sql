-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2019 at 03:31 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livres`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `courriel` varchar(255) NOT NULL,
  `motdepass` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom`, `prenom`, `courriel`, `motdepass`) VALUES
(1, 'Kolomiets', 'Elena', 'ekolomiets@gmail.com', '$2y$10$/KQ0JGpQ0mOigRv7XZ84eurAEb1KmMFhsJFFKtduBLSjzdCmc4c.6'),
(2, 'Paireli', 'Elena', 'epaireli@gmail.com', '$2y$10$FVKPBi06Wzv/shnBb6fX.uqmAbbYb/2jr1wXfJ.VL7QhwcmRxONmy'),
(4, 'Aaa', 'Aaa', 'aaaaaaaa', '$2y$10$g.WD5Eg1LEbG7Ctb4GKNHewEAowPHmXSTBs4UPFhkngeaUkiFquNC'),
(5, 'Ppp', 'Ppp', 'p41admin', '$2y$10$yer5VHSNob9B.R69WtIN7OQufX8lSNCrmVKrhbnVW90/qcmMA3x8y');

-- --------------------------------------------------------

--
-- Table structure for table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id_auteur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `nom`, `prenom`) VALUES
(1, 'Orwell', 'George'),
(2, 'Mitchell', 'Margaret'),
(3, 'Melville', 'Herman'),
(4, 'Dumas', 'Alexandre'),
(5, 'Marquez', 'Gabriel García'),
(6, 'Murakami', 'Haruki'),
(7, 'Camus', 'Albert');

-- --------------------------------------------------------

--
-- Table structure for table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id_livre` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_auteur` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `annee` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_livre`),
  KEY `fk_id_auteur` (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `livre`
--

INSERT INTO `livre` (`id_livre`, `id_auteur`, `titre`, `annee`) VALUES
(1, 1, '1984', 1948),
(2, 2, 'Autant en emporte le vent', 1936),
(3, 3, 'Moby Dick', 1851),
(4, 4, 'Les Trois Mousqetaires', 1844),
(5, 5, '100 ans de solitude', 1967),
(6, 6, 'Kafka sur le rivage', 2002),
(7, 7, 'L\'étranger', 1942),
(8, 7, 'La peste', 1947),
(9, 6, 'Dance Dance Dance', 1988),
(10, 5, 'l\'amour au temps du choléra', 1985);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `fk_id_auteur` FOREIGN KEY (`id_auteur`) REFERENCES `auteur` (`id_auteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
