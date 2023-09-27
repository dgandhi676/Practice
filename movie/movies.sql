-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2023 at 01:05 PM
-- Server version: 5.7.41
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(100) NOT NULL,
  `movie_description` varchar(1000) NOT NULL,
  `poster` varchar(1000) NOT NULL,
  `genre` varchar(200) NOT NULL,
  `adult` varchar(50) NOT NULL,
  `watched` varchar(10) NOT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `movie_description`, `poster`, `genre`, `adult`, `watched`) VALUES
(8, 'Mission: Impossible 3', '   IMF agent Ethan Hunt is called out of retirement to rescue one of his students', 'poster/mi3_1693476718.png', 'Romantic,Action', 'Yes', 'Yes'),
(9, 'Mission: Impossible 4', '  IMF agent Ethan Hunt is called out of retirement to rescue one of his students', 'poster/mi3_1693480027.png', 'Romantic,Romantic', 'Yes', 'Yes'),
(7, 'Mission: Impossible 2', '   Ethan Hunt, a member of the Impossible Missions Force, is dispatched to Sydney to stop a terrorist organisation from laying their hands ', 'poster/mi2_1693476406.png', 'Romantic', 'Yes', 'Yes'),
(6, 'Mission: Impossible ', '   IMF agent Ethan Hunt is called out of retirement to rescue one ', 'poster/mi1_1693475846.png', 'Romantic', 'Yes', 'Yes'),
(11, 'Mission: Impossible 5', ' With the IMF disbanded and the CIA hunting him, Ethan and his team race against time to prove the existence of the Syndicate, a highly-skilled terror organisation, before they plan their next attack.', 'poster/mi5_1693546392.png', 'Romantic,Romantic,Romantic', 'Yes', 'Yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
