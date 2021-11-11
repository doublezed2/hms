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
-- Table structure for table `xrays`
--

DROP TABLE IF EXISTS `xrays`;
CREATE TABLE IF NOT EXISTS `xrays` (
  `xray_id` int NOT NULL AUTO_INCREMENT,
  `xray_name` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `xray_fee` int NOT NULL,
  PRIMARY KEY (`xray_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xrays`
--

INSERT INTO `xrays` (`xray_id`, `xray_name`, `xray_fee`) VALUES
(1, 'Chest Pav 8x10', 600),
(2, 'T/F AP Lat Double 10x14', 1000),
(3, 'Knee Joint AP Lat Double 8x10', 1000),
(4, 'Hand AP Lat Double 8x10', 1000),
(5, 'Elbow AP Lat Double 8x10', 1000),
(6, 'Humer AP Lat Double 8x10', 1000),
(7, 'Both Hip AP Single 8x10', 600),
(8, 'Shoulder AP Lat Double 8x10', 1000),
(9, 'RT Hip AP Single 8x10', 1000),
(10, 'Chest Lat Single 8x10', 600),
(11, 'Nosal Bone Both Lat Double 8x10', 1000),
(12, 'Ankle AP Lat Double 8x10', 1000),
(13, 'Foot AP Lat Double 8x10', 1000),
(14, 'Left Hip AP Single 8x10', 1000),
(15, 'L/S Spine AP Lat Double 10x14', 1000),
(16, 'Heel Xsal lat Double 8x10', 1000),
(17, 'Throsic Spine AP Lat Double 10x14', 1000),
(18, 'Femer AP Lat Double 10x14', 1000),
(19, 'Abdomen Erect/Supine Double 10x14', 1000),
(20, 'PNS Single 8x10', 600),
(21, 'Mendibule Single 8x10', 600),
(22, 'KUB Single 10x14', 600),
(23, 'IVU Child', 2400),
(24, 'Wrist AP Lat Double 8x10', 1000),
(25, 'IVU Adult', 2800),
(26, 'Skull AP Lat Double 10x14', 1200),
(27, 'C/S Spine Lat single 8x10', 600),
(28, 'C/S Spine AP Lat  Double 10x14', 1000),
(29, 'Abdoment Erect Single 10x14', 800),
(30, 'L/S Spine Lat Single 8x10', 600);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
