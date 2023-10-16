-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2023 at 12:42 PM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `user_email`, `user_password`) VALUES
(1, 'Dev Gandhi', 'devgandhi', 'devgandhi1113@gmail.com', 'admin@123'),
(2, 'Sagar Prajapati', 'sprajapati', 'sprajapati@gmail.com', '1234567890'),
(3, 'Semil More', 'smore123', 'smore@plusonex.com', 'smore1234567890'),
(4, 'Jemis Kava', 'jkava1234', 'jkava@plusonex.com', 'admin1234'),
(9, 'Semil More', 'jkava', 'walan7072@gmail.com', 'Dev@3445'),
(10, 'Tejas Mehta', 'tmehta', 'tmehta@yahoo.com', 'ADmin@123'),
(11, 'Ishita Gandhi', 'igandhi', 'ishitagandhi812@gmail.com', 'Ishu@1409'),
(12, 'Semil More', 'smore123', 'devgandhi1113@gmail.com', '1234@admtn'),
(13, 'Rohit Sharma', 'rsharma', 'rsharma@gmail.com', 'Rshrna@123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
