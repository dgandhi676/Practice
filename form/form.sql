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
-- Database: `test_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_image` varchar(500) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `city` varchar(25) NOT NULL,
  `hobby` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `file_image`, `first_name`, `last_name`, `gender`, `city`, `hobby`) VALUES
(1, 'img/mi2.png', 'mius', 'vsd', 'Female', 'Baroda', ''),
(2, 'img/mi5.png', 'grgrg', 'grgrg', 'Female', 'Rajkot', ''),
(3, 'img/mi3.png', 'bfbf', 'bfbfbfb', 'Female', 'Baroda', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
