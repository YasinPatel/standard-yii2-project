-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2017 at 05:42 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `standard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_type` enum('A','U') DEFAULT 'U',
  `email_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `device_type` enum('A','I') DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `forgot_password_token` varchar(255) DEFAULT NULL,
  `forgot_password_token_timeout` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `is_deleted` enum('Y','N') DEFAULT 'N',
  `i_by` int(11) DEFAULT NULL,
  `i_date` int(11) DEFAULT NULL,
  `u_by` int(11) DEFAULT NULL,
  `u_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `user_name`, `user_type`, `email_id`, `password`, `image_path`, `access_token`, `device_type`, `device_id`, `forgot_password_token`, `forgot_password_token_timeout`, `is_active`, `is_deleted`, `i_by`, `i_date`, `u_by`, `u_date`) VALUES
(1, 'admin', 'A', 'yasin@peerbits.com', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'N', NULL, NULL, 1, 1504011647);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
