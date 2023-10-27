-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2023 at 12:16 PM
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
-- Database: `target_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

DROP TABLE IF EXISTS `customer_master`;
CREATE TABLE IF NOT EXISTS `customer_master` (
  `cus_id` int(255) NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_password` varchar(255) NOT NULL,
  PRIMARY KEY (`cus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`cus_id`, `cus_name`, `cus_address`, `cus_email`, `cus_password`) VALUES
(1, 'Dev Gandhi', 'Chandni Chowk, Piplod.', 'devgandhi1113@gmail.com', 'admin@123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
