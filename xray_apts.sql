-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2021 at 08:24 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `xray_apts`
--

DROP TABLE IF EXISTS `xray_apts`;
CREATE TABLE IF NOT EXISTS `xray_apts` (
  `xapt_id` int NOT NULL AUTO_INCREMENT,
  `xapt_token` int NOT NULL,
  `xapt_xname` varchar(90) NOT NULL,
  `xapt_pname` varchar(52) NOT NULL,
  `xapt_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `xapt_doc` int NOT NULL,
  `xapt_fee` int NOT NULL,
  `xapt_created_on` datetime NOT NULL,
  `xapt_shift` int NOT NULL,
  `xapt_status` tinyint NOT NULL DEFAULT '1',
  `xapt_updated_on` datetime NOT NULL,
  PRIMARY KEY (`xapt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
