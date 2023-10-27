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
-- Table structure for table `category_master`
--

DROP TABLE IF EXISTS `category_master`;
CREATE TABLE IF NOT EXISTS `category_master` (
  `cat_id` int(255) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `cat_active` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`cat_id`, `cat_name`, `cat_image`, `cat_active`) VALUES
(8, 'Television', 'catimg/tvcat_1698214235.jpg', 'Active'),
(5, 'Mobile', 'catimg/mobilecat_1698209126.png', 'Active'),
(6, 'Laptops', 'catimg/laptopcat_1698209137.png', 'Active'),
(7, 'Shoes', 'catimg/shoescat_1698209163.png', 'Active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
