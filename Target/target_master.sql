-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 30, 2023 at 09:40 AM
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
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `ad_id` int(255) NOT NULL AUTO_INCREMENT,
  `ad_username` varchar(255) NOT NULL,
  `ad_password` varchar(255) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`ad_id`, `ad_username`, `ad_password`) VALUES
(1, 'devgandhi', 'admin@123');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`cat_id`, `cat_name`, `cat_image`, `cat_active`) VALUES
(8, 'Television', '../catimg/tvcat_1701239700.jpg', 'Active'),
(5, 'Mobile', '../catimg/mobilecat_1701239673.png', 'Active'),
(6, 'Laptops', '../catimg/laptopcat_1701239680.png', 'Active'),
(7, 'Shoes', '../catimg/shoescat_1701239692.png', 'Active'),
(9, 'Camera', '../catimg/png-clipart-canon-camera-classic-canon-cat_1701239718.png', 'Active'),
(10, 'True Wireless Stereo', '../catimg/airpods-headphones-twscat_1701239727.jpg', 'Active');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`cus_id`, `cus_name`, `cus_address`, `cus_email`, `cus_password`) VALUES
(1, 'Dev Gandhi', 'Chandni Chowk, Piplod,', 'devgandhi1113@gmail.com', '$2y$10$7o7bU9ndl.irgNvUlN.VLePuuVOTWx8/gn.m0e/GAXFylE2Xyr6CS'),
(2, 'Ishita Gandhi', 'pal', 'ishitagandhi@hhk.co.in', '$2y$10$ynWcJjD3QdXxhwcvql4RaeXcuhTa0xdkgIy3/YMHoMmbFDJtxVuXi');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 'Air Jordan 1 Mid SE', 5, '11677.00'),
(2, 1, 'Sony a6700', 5, '58000.00'),
(3, 2, 'OnePlus Open', 3, '14500.00'),
(4, 3, 'OnePlus Open', 3, '14500.00'),
(5, 4, 'OnePlus Open', 3, '14500.00'),
(6, 5, 'OnePlus Open', 3, '14500.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_product_master`
--

DROP TABLE IF EXISTS `order_product_master`;
CREATE TABLE IF NOT EXISTS `order_product_master` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(500) NOT NULL,
  `amount_order` varchar(255) NOT NULL,
  `date_order` date NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product_master`
--

INSERT INTO `order_product_master` (`sr_no`, `customer_name`, `amount_order`, `date_order`) VALUES
(1, 'Dev Gandhi', '348385', '2023-11-30'),
(2, 'Ishita Gandhi', '43500', '2023-11-30'),
(3, 'Ishita Gandhi', '43500', '2023-11-30'),
(4, 'Ishita Gandhi', '43500', '2023-11-30'),
(5, 'Ishita Gandhi', '43500', '2023-11-30');

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
  `pro_des` longtext NOT NULL,
  `pro_inactive` varchar(255) NOT NULL,
  `pro_sellprice` int(255) NOT NULL,
  `pro_discprice` int(255) NOT NULL,
  `pro_disco` varchar(255) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`pro_id`, `pro_name`, `pro_image`, `pro_category`, `pro_des`, `pro_inactive`, `pro_sellprice`, `pro_discprice`, `pro_disco`) VALUES
(1, 'IPhone 15 Pro Max', '../proimg/AppleIphone15Pro_1701239867.jpg', 'Mobile', 'Titanium design\r\nCeramic Shield front\r\nTextured matt glass back', 'Yes', 199000, 10000, 'Yes'),
(18, 'Xiaomi 13 Pro 5G', '../proimg/mi13pro_1701240039.png', 'Mobile', 'Xiaomi has been on a continuous mission of building incredible products and Leica comes from a long history of bringing excellent quality and innovation to camera imaging. And now Xiaomi & Leica have come together to usher in a new era of smartphone photography.', 'Yes', 89999, 74999, 'Yes'),
(3, 'Sony XR-75X90L', '../proimg/TVFY23_X90Lpro_1701239893.png', 'Television', 'Our amazing 4K Full Array LED TV powered by Cognitive Processor XRâ„¢ delivers realistic depth and intense contrast. A newly designed local dimming structure brings scenes vividly to life. What you hear matches what you see.', 'Yes', 379900, 350000, 'No'),
(4, 'OnePlus Open', '../proimg/oneplusopenpro_1701239901.png', 'Mobile', 'Titanium alloy, carbon fiber, and more. Built to the hilt with aerospace-grade materials up to 4 times stronger than surgical-grade stainless steel.', 'Yes', 139999, 14500, 'Yes'),
(5, 'Air Jordan 1 Mid SE', '../proimg/air-jordan-1-mid-se-shoes-pro_1701239912.jpeg', 'Shoes', 'Get into some summery fun in your new fave AJ1s. Made with a combination of suede and canvas, this pair gives you the comfort you know and love with a seasonal update.', 'Yes', 12295, 11677, 'Yes'),
(9, 'Inspiron 16 Laptop', '../proimg/dell-inspiron-16-laptoppro_1701239922.png', 'Laptops', '12th Gen IntelÂ® Coreâ„¢ i7-1255U (12 MB cache, 10 cores, 12 threads, up to 4.70 GHz Turbo)', 'Yes', 91000, 8000, 'Yes'),
(10, 'Sony a6700', '../proimg/a6700pro_1701239942.jpg', 'Camera', 'Sony a6700 Premium E-mount APS-C Camera\r\nThe a6700 captures 4K (QFHD: 3840 x 2160) at up to 60p (50p) using Sony\'s proprietary 6K oversampling technology. By compressing this expanded detail into the output, it achieves 4K video quality with outstanding definition, even at higher frame rates. The camera also supports high-quality XAVC S-I (All-Intra) and XAVC HS formats with 10-bit 4:2:2 colour sampling.', 'Yes', 67000, 58000, 'Yes'),
(11, 'OnePlus Nord Buds 2r', '../proimg/nord2rpro_1701239962.jpg', 'True Wireless Stereo', 'OnePlus Nord Buds 2r True Wireless in Ear Earbuds with Mic\r\n[Enhanced Sound Experience]: The buds comes with 12.4mm driver unit, which delivers crisp clear and enhanced bass quality sound experience\r\n[Sound Master Equalizers]: For the OnePlus Nord Buds 2r, you get to choose how heavy or light you want your sound with the help of sound master equalizerâ€™s 3 unique audio profiles -Bold, Bass & Balanced', 'Yes', 2299, 1899, 'Yes'),
(12, 'boAt Airdopes 121 PRO', '../proimg/boat121pro_1701239971.jpg', 'True Wireless Stereo', 'boAt Airdopes 121 PRO TWS Earbuds Signature Sound, Quad Mic ENxâ„¢\r\nDrivers- Delve into the boAt Signature Sound on Airdopes 121 Pro TWS earbuds courtesy its 10mm audio drivers..Note : If the size of the earbud tips does not match the size of your ear canals or the headset is not worn properly in your ears, you may not obtain the correct sound qualities or call performance. Change the earbud tips to ones that fit more snugly in your ears', 'Yes', 2990, 999, 'Yes'),
(13, 'pTron Zenbuds 1 ANC', '../proimg/ptronzenbuds1pro_1701239979.jpg', 'True Wireless Stereo', 'pTron Newly Launched Zenbuds 1 ANC Earbuds\r\nHybrid ANC Earbuds: Active Noise Cancellation cancels background noise up to 28dB for an immersive listening experience | 60 Hours Combined Playtime with the Vibrant & Compact Charging Case\r\n4 HD Microphones & ENC for Clearer Calls: Built-in HD mics & TruTalk Environmental Noise Cancellation technology ensures smooth delivery of your voice via calls - be heard loud & clear.', 'Yes', 3999, 999, 'Yes'),
(14, 'IdeaPad Gaming 3i 12th Gen', '../proimg/ideapad16pro_1701239994.png', 'Laptops', 'IdeaPad Gaming 3i 12th Gen, 40.64cms - Intel i7 (Onyx Grey)\r\nBuilt for the next generation of gaming\r\n12th Gen IntelÂ® Coreâ„¢ processors give you superior gaming performance while delivering the flexibility to seamlessly multitask. Innovative new architecture matches the right core to the right workload, so background tasks wonâ€™t interrupt your game. Giving you the freedom to chat, browse, stream, edit, record, and play without skipping a beat.', 'Yes', 159490, 98790, 'No'),
(15, 'LG OLED Z3 88 (223cm) 8K Smart TV', '../proimg/lgoledpro_1701240007.png', 'Television', 'LG OLED Z3 88 (223cm) 8K Smart TV | TV Wall Design | WebOS | Dolby Vision\r\nWhat makes LG OLED evo the pinnacle of the world\'s No.1 OLED brand? Iconic firsts with alluring form factors that challenge your imagination. A brighter, bolder pictureÂ², so realistic, you feel like part of the scene. Advanced technologyÂ¹ that\'s constantly evolving and refining how you experience TV.', 'Yes', 2349990, 200000, 'Yes'),
(16, 'Adidas ULTRABOOST 1.0 SHOES', '../proimg/Ultraboost_1.0_Shoes_Blue_pro_1701240017.png', 'Shoes', 'WORK, PLAY AND EXPLORE ENDLESSLY IN THESE SHOES MADE IN PART WITH PARLEY OCEAN PLASTIC.\r\nAn icon gets a futuristic refresh in these adidas Ultraboost 1.0 shoes. Designed for uncompromising comfort, they\'ll keep up with whatever your day brings. The adidas PRIMEKNIT upper hugs your feet for all-day support. A BOOST midsole make every step feel effortless. From work to weekends, these shoes fit whatever mode you\'re in.\r\n\r\nThis shoe\'s upper is made with a high-performance yarn which contains at least 50% Parley Ocean Plastic â€” reimagined plastic waste, intercepted on remote islands, beaches, coastal communities and shorelines, preventing it from polluting our ocean. The other 50% of the yarn is recycled polyester.', 'Yes', 17999, 15999, 'Yes'),
(17, 'Dell XPS 17 Laptop', '../proimg/notebook-xps-17-pro_1701240029.png', 'Laptops', 'Processor\r\n13th Gen IntelÂ® Coreâ„¢ i9-13900H (24 MB cache, 14 cores, up to 5.40 GHz Turbo)\r\n\r\nOperating System\r\nWindows 11 Home Single Language, English\r\n\r\nVideo Card\r\nNVIDIAÂ® GeForce RTXâ„¢ 4070, 8 GB GDDR6\r\n\r\nDisplay\r\n17\", UHD+ 3840x2400, 60Hz, Touch, Anti-Reflect, 500 nit, InfinityEdge\r\n\r\nMemory \r\n32 GB: 2 x 16 GB, DDR5, 4800 MT/s\r\n\r\nStorage\r\n1 TB, M.2, PCIe NVMe, SSD\r\n\r\nColor\r\nPlatinum Silver exterior, Black interior', 'Yes', 364290, 125000, 'Yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
