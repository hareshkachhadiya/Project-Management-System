-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2019 at 05:04 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmonitoringsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` int(11) NOT NULL,
  `emailid` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `generaterandompassword` int(11) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_type`, `emailid`, `password`, `generaterandompassword`, `mobile`, `status`, `is_deleted`, `login`, `created_at`) VALUES
(1, 0, 'vtank@gmail.com', '123456789', NULL, NULL, NULL, 0, NULL, '2019-09-28 09:54:24'),
(6, 1, 'abc@gmail.com', 'khwklsjkj', 0, 0, '1', 1, 1, '2019-09-28 11:12:44'),
(5, 1, 'varsha1@gmail.com', 'ff2f87e3b76f13788e41d6feae7c5dbb', 0, 1234567867, '0', 0, 1, '2019-09-28 10:43:50'),
(4, 1, 'vaishali1@gmail.com', '4b6eb75e8ed354204af087cda6635171', 1, 3467878567, '1', 0, 1, '2019-09-28 10:25:45'),
(7, 1, 'sejaldvaru@gmail.com', 'b34964b79e83c04e73f905b0d172a61f', 1, 7890567890, '1', 0, 1, '2019-10-21 09:20:19'),
(8, 1, 'aa@gmail.com', 'b662f788a715cac5ffb1c4896b160f86', 1, 97898099000, '1', 1, 1, '2019-10-24 07:13:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
