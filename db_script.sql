-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: karinanishimura.com.br.mysql:3306
-- Generation Time: Jan 08, 2016 at 04:18 PM
-- Server version: 5.5.47-MariaDB-1~wheezy
-- PHP Version: 5.4.45-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `karinanishimura_com_br`
--
CREATE DATABASE `karinanishimura_com_br` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `karinanishimura_com_br`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`) VALUES
(1, 'alice''s adventures'),
(2, 'motivation manifesto');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE IF NOT EXISTS `exercises` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `transition_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `scripts_users`
--

CREATE TABLE IF NOT EXISTS `scripts_users` (
  `start_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `speech_script_id` int(11) NOT NULL,
  `number_attempts` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`speech_script_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `speech_functions`
--

CREATE TABLE IF NOT EXISTS `speech_functions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `speech_scripts`
--

CREATE TABLE IF NOT EXISTS `speech_scripts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_to_read` varchar(255) DEFAULT NULL,
  `text_to_check` varchar(255) DEFAULT NULL,
  `text_to_show` varchar(255) DEFAULT NULL,
  `speech_function_id` int(11) DEFAULT NULL,
  `exercise_id` int(11) DEFAULT NULL,
  `script_index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `last_completed_lesson` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`, `username`, `last_completed_lesson`, `created`, `modified`) VALUES
(1, 'thiago', '$2a$10$h5bC/SjqmtVs4fFvoUFCx.B4nNS7Bloxh42tVbjpGyOC3Gcu5IcaO', 'admin', 't', 1, '2016-01-07 17:17:10', '2016-01-07 17:17:10'),
(2, 'karina', '$2a$10$BQqwg3mnCBL0bi.UBBn//ua8u7gotXXyFt6M9i8KJ40agaVC31diC', 'student', 'karina', 0, '2016-01-08 15:40:31', '2016-01-08 15:40:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
