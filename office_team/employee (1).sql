-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2023 at 09:54 AM
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
  `ot_profile` varchar(500) NOT NULL,
  PRIMARY KEY (`ot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ot_id`, `ot_firstname`, `ot_lastname`, `ot_phoneno`, `ot_dob`, `ot_image`, `ot_email`, `ot_gender`, `ot_country`, `ot_state`, `ot_city`, `ot_completed_5_years`, `ot_profile`) VALUES
(13, 'dwehybgfwyfiqw', 'befhivbryibv', '3423452345', '1993-03-12', 'emp-image/3_1696595199.png', 'cververvre@cwdvwevfefvcvefverv.com', 'Female', 'AT', '6', 'Altenmarkt bei Sankt Gallen', 'No', '5yngtrngrnegtrtrh2553rge  '),
(11, ' sbbvfbafbfbafb', 'afbsdfbafba', '3423514146', '2020-05-12', 'emp-image/2_1696590824.png', 'ghkthk@hfhdh.com', 'Male', 'AT', '6', 'Attendorf', 'No', 'vdvdwga'),
(12, 'dvwgbga', 'aqrgrgqwergqg', '3452451245', '2023-10-03', 'emp-image/3_1696590854.png', 'walan7072@gmail.com', 'Male', 'AR', 'M', 'Departamento de San Carlos', 'No', 'rgrgherhq'),
(10, 'Manan', 'Parekh', '7777970733', '2003-12-15', 'emp-image/1_1696588622.png', 'mananparekh812@gmail.com', 'Male', 'IN', 'GJ', 'Surat', 'Yes', 'fbgefhfwhwthj'),
(5, 'adbdfbsdb', 'dbdbdbdb', '9737588800', '2023-10-05', 'emp-image/IMG_0179_1696583134.jpg', 'walan7072@gmail.com', 'Female', 'IN', 'GJ', 'Amod', 'Yes', '4twthwthwhwh'),
(6, 'jwtrjwjrtj', 'wtjtrjwjuwrtu', '5346341776', '2023-06-21', 'emp-image/mi2_1696583375.png', 'gqwrgqwrgqrgtq@ngfnwgtrwrn.com', 'Female', 'AU', 'WA', 'Aubin Grove', 'Yes', 'hwhjwthjwtjwtj'),
(7, 'huthruth', 'teyethethqet', '1312412343', '2013-12-31', 'emp-image/mi5_1696921757.png', 'bvfbqrweqwer@gebgerbefbg.co.in', 'Female', 'AR', 'Y', 'Palma Sola', 'No', 'tjwtjwtjtjwrjwrj2jwj'),
(8, 'fgefhqqyhuqete', 'tjtjwjwtjwtujtu', '2524542362', '2019-02-28', 'emp-image/mi2_1696584076.png', 'wtwtwrtq234@gehth2et.com', 'Female', 'AM', 'AV', 'Artimet', 'No', 'thkkhkeketyketykety'),
(9, 'nmmgfmsf', 'hjehjdhjaetjqtj', '2452454523', '2014-02-12', 'emp-image/mi3_1696584510.png', '6356565656@grgegeth.com', 'Female', 'AU', 'QLD', 'Andergrove', 'Yes', 'jgjwtywtyjwtjuwyq3yb 57537457 7 4572457'),
(14, 'avfsdvdasbgd', 'dfhdfhdfhgd', '4543534786', '2020-03-18', 'emp-image/2_1696596965.png', 'ugcftut@dgcdtukdit.com', 'Female', 'GM', 'W', 'Kombo Central District', 'Yes', 'jhdgyudhxuc hf cguked u4y56v68 '),
(15, 'sdfvsdafbvasdfvasd', 'bvasdasdbvg', '7659479057', '2023-09-28', 'emp-image/2_1696597008.png', 'vsdbscbZCbfcb@dgsdfgdsfg.com', 'Female', 'AR', 'Y', 'Libertador General San MartÃ­n', 'No', 'b xbvbfbSCFbv');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
