-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2017 at 01:32 AM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `profile`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `profile_id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) DEFAULT NULL COMMENT 'Foregin key',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `web_address` varchar(155) DEFAULT NULL,
  `cover_letter` text,
  `question` text,
  `resume_file` varchar(255) DEFAULT NULL,
  `ip` varchar(55) DEFAULT NULL,
  `timestamp` int(25) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `name`, `email`, `web_address`, `cover_letter`, `question`, `resume_file`, `ip`, `timestamp`) VALUES
(1, 1, 'Tamilvanan N', 'tamiloct22@gmail.com', 'http://colorelephant.com/', 'Backend PHP Developer', 'Yes', 'upload/tamilvanan_resume_aug_2017.pdf', '127.0.0.1', 1502136128);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(15) NOT NULL AUTO_INCREMENT,
  `profile_id` int(15) DEFAULT NULL,
  `user_id` int(15) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `timestamp` int(25) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encryption_key` varchar(155) DEFAULT NULL,
  `verified_status` varchar(55) DEFAULT NULL,
  `timestamp` int(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `email`, `password`, `encryption_key`, `verified_status`, `timestamp`) VALUES
(1, '2', 'tamiloct22@gmail.com', 'colorweb@2017', '', '1', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
