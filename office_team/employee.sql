-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2023 at 12:05 PM
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
-- Database: `office_team`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `ot_id` int(11) NOT NULL AUTO_INCREMENT,
  `ot_firstname` varchar(20) NOT NULL,
  `ot_lastname` varchar(20) NOT NULL,
  `ot_image` varchar(5000) NOT NULL,
  `ot_email` varchar(150) NOT NULL,
  `ot_gender` varchar(20) NOT NULL,
  `ot_completed_5_years` varchar(20) NOT NULL,
  `ot_profile` varchar(500) NOT NULL,
  PRIMARY KEY (`ot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ot_id`, `ot_firstname`, `ot_lastname`, `ot_image`, `ot_email`, `ot_gender`, `ot_completed_5_years`, `ot_profile`) VALUES
(9, 'dev', 'parekh', 'emp-image/20_1695643176.png', 'devgandhi1113@gmail.com', 'Male', 'No', 'hgggg'),
(10, 'manan56456456', 'Gandhi', 'emp-image/2_1695643478.png', 'mananparekh812@gmail.com', 'Female', 'Yes', ' 1234'),
(11, 'vint', 'de', 'emp-image/17_1693825766.png', 'vbndn@gfgfg', 'Male', 'Yes', 'grgrweg'),
(12, 'vint', 'Gandhi', 'emp-image/15_1693825090.png', 'mananparekh812@gmail.com', 'Female', 'No', 'Hi This Profile Descriptor.\r\n'),
(13, 'dev', 'de', 'emp-image/18_1693825779.png', 'vbndn@gfgfg', 'Male', 'No', 'vfver'),
(14, 'Ishita', 'Gandhi', 'emp-image/17_1693829522.png', 'devgansgi@gmail.com', 'Male', 'No', 'this is testing application'),
(19, 'Ishita', 'Gandhi', 'emp-image/3_1695618287.png', 'vbndn@gfgfg', 'Female', 'No', 'vdavsdvsdv'),
(24, 'Subhnam', 'Gill', 'emp-image/3_1695642048.png', 'sgill123@gmail.com', 'Male', 'Yes', 'Player icc'),
(21, 'Hardik', 'Pandya', 'emp-image/6_1695641844.png', 'hpandya@gmail.com', 'Male', 'Yes', 'Gujarat team captain'),
(22, 'Ishan', 'Kishan', 'emp-image/13_1695641897.png', 'ikishan@yahoo.com', 'Male', 'Yes', 'Cricket Player'),
(25, 'Dhoni', 'Mahendra', 'emp-image/16_1695642445.png', 'msdhoni@gmail.com', 'Male', 'Yes', 'Retired Cricketer'),
(26, 'Ishita', 'Gandhi', 'emp-image/3_1695642577.png', 'walan7072@gmail.com', 'Male', 'No', 'dvd'),
(27, 'Ishita', 'Gandhi', 'emp-image/4_1695642734.png', 'rsharma@gmail.com', 'Female', 'No', 'nyujnm7u'),
(28, 'Ishita', 'Gandhi', 'emp-image/14_1695642869.png', 'rsharma@gmail.com', 'Female', 'No', 'cdecvwerv');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
