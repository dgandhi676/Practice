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
-- Table structure for table `product_master`
--

DROP TABLE IF EXISTS `product_master`;
CREATE TABLE IF NOT EXISTS `product_master` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(255) NOT NULL,
  `pro_image` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `pro_des` varchar(255) NOT NULL,
  `pro_inactive` varchar(255) NOT NULL,
  `pro_sellprice` int(255) NOT NULL,
  `pro_discprice` int(255) NOT NULL,
  `pro_disco` varchar(255) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`pro_id`, `pro_name`, `pro_image`, `pro_category`, `pro_des`, `pro_inactive`, `pro_sellprice`, `pro_discprice`, `pro_disco`) VALUES
(1, 'IPhone 15 Pro Max', 'proimg/AppleIphone15Pro_1698224483.jpg', 'Mobile', 'Titanium design\r\nCeramic Shield front\r\nTextured matt glass back', 'Yes', 199000, 10000, 'Yes'),
(2, 'Xiaomi 13 Pro 5G', 'proimg/mi13pro_1698226908.png', 'Mobile', 'The primary camera on the Xiaomi 13 Pro features a big (1) Sony IMX989 sensor co-engineered with Leica to provide a great lens system.', 'Yes', 749999, 64999, 'Yes'),
(3, 'Sony XR-75X90L', 'proimg/TVFY23_X90Lpro_1698236688.png', 'Television', 'Our amazing 4K Full Array LED TV powered by Cognitive Processor XRâ„¢ delivers realistic depth and intense contrast. A newly designed local dimming structure brings scenes vividly to life. What you hear matches what you see.', 'Yes', 379900, 350000, 'Yes'),
(4, 'OnePlus Open', 'proimg/oneplusopenpro_1698298131.png', 'Mobile', 'Titanium alloy, carbon fiber, and more. Built to the hilt with aerospace-grade materials up to 4 times stronger than surgical-grade stainless steel.', 'Yes', 139999, 14500, 'Yes'),
(5, 'Air Jordan 1 Mid SE', 'proimg/air-jordan-1-mid-se-shoes-pro_1698407152.jpeg', 'Shoes', 'Get into some summery fun in your new fave AJ1s. Made with a combination of suede and canvas, this pair gives you the comfort you know and love with a seasonal update.', 'Yes', 12295, 11677, 'Yes'),
(9, 'Inspiron 16 Laptop', 'proimg/dell-inspiron-16-laptoppro_1698403592.png', 'Laptops', '12th Gen IntelÂ® Coreâ„¢ i7-1255U (12 MB cache, 10 cores, 12 threads, up to 4.70 GHz Turbo)', 'Yes', 91000, 80000, 'Yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
