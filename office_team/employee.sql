-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2023 at 12:43 PM
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
  `ot_phoneno` varchar(255) NOT NULL,
  `ot_dob` date NOT NULL,
  `ot_image` varchar(5000) NOT NULL,
  `ot_email` varchar(150) NOT NULL,
  `ot_gender` varchar(20) NOT NULL,
  `ot_country` varchar(100) NOT NULL,
  `ot_state` varchar(100) NOT NULL,
  `ot_city` varchar(100) NOT NULL,
  `ot_completed_5_years` varchar(20) NOT NULL,
  `ot_profile` varchar(50000) NOT NULL,
  PRIMARY KEY (`ot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ot_id`, `ot_firstname`, `ot_lastname`, `ot_phoneno`, `ot_dob`, `ot_image`, `ot_email`, `ot_gender`, `ot_country`, `ot_state`, `ot_city`, `ot_completed_5_years`, `ot_profile`) VALUES
(17, 'Dev ', 'Gandhi', '9737488800', '2003-01-11', 'emp-image/mi1_1697097629.png', 'devgandhi1113@gmail.com', 'Male', 'IN', 'GJ', 'Surat', 'Yes', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(15, 'ngrngrnen', 'enwernen', '3562362356', '2023-10-11', 'emp-image/mi2_1697094576.png', 'mmm@sss.com', 'Male', 'AT', '4', 'Altlichtenberg', 'Yes', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(19, 'Sagar', 'Prajapati', '9898598985', '2023-09-26', 'emp-image/mi4_1697192204.png', 'sprajapati@plusonex.com', 'Female', 'AO', 'MOX', 'Lumeje', 'No', 'Hello@'),
(20, 'Semil', 'More', '5263894563', '2002-02-02', 'emp-image/mi3_1697434400.png', 'smore@plusonex.com', 'Male', 'AG', '06', 'Falmouth', 'No', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(16, ' bvfd gf grbgrhwb', 'ghwtghweghweghwe', '4353451425', '2023-10-03', 'emp-image/mi2_1697093807.png', 'devgandhi1113@gmail.com', 'Male', 'AM', 'VD', 'Vernashen', 'Yes', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(18, 'Ishita', 'Gandhi', '9737588800', '2023-10-12', 'emp-image/mi6_1697093309.png', 'fdegdgasdg@vgdgsdfgasdgrghefh.vcom', 'Male', 'IN', 'LD', 'Kavaratti', 'Yes', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
