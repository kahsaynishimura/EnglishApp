-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: karinanishimura.com.br.mysql:3306
-- Generation Time: Jan 19, 2016 at 12:01 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `is_free`, `user_id`) VALUES
(11, 'Finding Your Lifeâ€™s Mission', 0, 42),
(10, 'Take Action In Your Life', 1, 39);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `lesson_id`, `transition_image`) VALUES
(22, 'part 2', 14, 'practice'),
(21, 'part 1', 14, 'practice'),
(20, 'part 5', 12, 'practice'),
(19, 'part 4', 12, 'practice'),
(18, 'part 3', 12, 'practice'),
(17, 'part 2', 12, 'practice'),
(16, 'part 1', 12, 'practice');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `book_id`, `created`, `modified`) VALUES
(14, 'Summary', 11, '2016-01-17 19:31:21', '2016-01-17 19:31:21'),
(12, 'Summary', 10, '2016-01-17 18:44:09', '2016-01-17 18:44:09'),
(13, 'TRANSCRIPT', 10, '2016-01-17 18:44:41', '2016-01-17 18:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `practices`
--

CREATE TABLE IF NOT EXISTS `practices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `practices`
--

INSERT INTO `practices` (`id`, `user_id`, `start_time`, `finish_time`, `points`) VALUES
(99, 39, '2016-01-17 17:12:56', '2016-01-17 17:55:30', 37),
(98, 39, '2016-01-17 17:12:56', '2016-01-17 17:55:30', 37),
(97, 39, '2016-01-17 17:12:56', '2016-01-17 17:23:26', 37),
(96, 39, '2016-01-17 17:12:56', '2016-01-17 17:23:25', 37),
(95, 39, '2016-01-17 17:12:56', '2016-01-17 17:22:52', 37),
(94, 20, '2016-01-17 17:00:48', '2016-01-17 17:11:15', 37),
(93, 20, '2016-01-17 16:51:09', '2016-01-17 16:58:38', 37);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity_available` int(11) NOT NULL,
  `points_value` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `thumb` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Dumping data for table `speech_scripts`
--

INSERT INTO `speech_scripts` (`id`, `text_to_read`, `text_to_check`, `text_to_show`, `speech_function_id`, `exercise_id`, `script_index`) VALUES
(105, 'Are you stuck in analysis paralysis', 'Are you stuck in analysis paralysis', 'Are you stuck in analysis paralysis', 2, 16, 1),
(106, 'Is there something you should be doing', 'Is there something you should be doing', 'Is there something you should be doing', 2, 16, 2),
(107, 'but but you consistently find that you are not taking action', 'but but you consistently find that you are not taking action', 'but but you consistently find that you are not taking action', 2, 16, 3),
(108, 'Hereâ€™s what to do', 'Hereâ€™s what to do', 'Hereâ€™s what to do', 2, 16, 4),
(109, 'Look Beyond Yourself and Serve', 'Look Beyond Yourself and Serve', 'Look Beyond Yourself and Serve', 2, 17, 1),
(110, 'Stop worrying if youâ€™re good enough', 'Stop worrying if youâ€™re good enough', 'Stop worrying if youâ€™re good enough', 2, 17, 2),
(111, 'ready enough', 'ready enough', 'ready enough', 2, 17, 3),
(112, 'or getting everything perfect in order to start', 'or getting everything perfect in order to start', 'or getting everything perfect in order to start', 2, 17, 4),
(113, 'Look beyond yourself and realize your taking action can help others', 'Look beyond yourself and realize your taking action can help others', 'Look beyond yourself and realize your taking action can help others', 2, 17, 5),
(114, 'your family', 'your family', 'your family', 2, 17, 6),
(115, 'your team', 'your team', 'your team', 2, 17, 7),
(116, 'your business and community', 'your business and community', 'your business and community', 2, 17, 8),
(117, 'Serve', 'Serve', 'Serve', 2, 17, 9),
(118, 'The way to get out of your head is to get in motion serving other people', 'The way to get out of your head is to get in motion serving other people', 'The way to get out of your head is to get in motion serving other people', 2, 17, 10),
(119, 'Clarify your vision and work backward', 'Clarify your vision and work backward', 'Clarify your vision and work backward', 2, 18, 1),
(120, 'What does your ultimate outcome look like', 'What does your ultimate outcome look like', 'What does your ultimate outcome look like', 2, 18, 2),
(121, 'What would you define as success', 'What would you define as success', 'What would you define as success', 2, 18, 3),
(122, 'How will you know when youâ€™ve reached your goal', 'How will you know when youâ€™ve reached your goal', 'How will you know when youâ€™ve reached your goal', 2, 18, 4),
(123, 'Once you have that vision clear in your head', 'Once you have that vision clear in your head', 'Once you have that vision clear in your head', 2, 18, 5),
(124, 'work backwards from that to define the process to accomplish it', 'work backwards from that to define the process to accomplish it', 'work backwards from that to define the process to accomplish it', 2, 18, 6),
(125, 'You donâ€™t have to know every step', 'You donâ€™t have to know every step', 'You donâ€™t have to know every step', 2, 18, 7),
(126, 'just a step', 'just a step', 'just a step', 2, 18, 8),
(127, 'Accomplish 3 things every day', 'Accomplish 3 things every day', 'Accomplish 3 things every day', 2, 19, 1),
(128, 'Just take three steps every day', 'Just take three steps every day', 'Just take three steps every day', 2, 19, 2),
(129, 'If you donâ€™t know where to start', 'If you donâ€™t know where to start', 'If you donâ€™t know where to start', 2, 19, 3),
(130, 'try modeling others', 'try modeling others', 'try modeling others', 2, 19, 4),
(131, 'What path did they follow', 'What path did they follow', 'What path did they follow', 2, 19, 5),
(132, 'What are their habits', 'What are their habits', 'What are their habits', 2, 19, 6),
(133, 'What do they seem to do every day or weekly', 'What do they seem to do every day or weekly', 'What do they seem to do every day or weekly', 2, 19, 7),
(134, 'Daily Practice', 'Daily Practice', 'Daily Practice', 2, 20, 1),
(135, 'If something is important to you', 'If something is important to you', 'If something is important to you', 2, 20, 2),
(136, 'it needs to become a constant in your life', 'it needs to become a constant in your life', 'it needs to become a constant in your life', 2, 20, 3),
(137, 'You need discipline and the willingness to show up every day and work towards it', 'You need discipline and the willingness to show up every day and work towards it', 'You need discipline and the willingness to show up every day and work towards it', 2, 20, 4),
(138, 'Put it in your calendar and do something every day', 'Put it in your calendar and do something every day', 'Put it in your calendar and do something every day', 2, 20, 5),
(139, 'The momentum of that will teach you to stop stalling', 'The momentum of that will teach you to stop stalling', 'The momentum of that will teach you to stop stalling', 2, 20, 6),
(140, 'Do that', 'Do that', 'Do that', 2, 20, 7),
(141, 'and youâ€™ll start to experience what we call The Charged Life', 'and youâ€™ll start to experience what we call The Charged Life', 'and youâ€™ll start to experience what we call The Charged Life', 2, 20, 8),
(142, 'Few people report having one', 'Few people report having one', 'Few people report having one', 2, 21, 1),
(143, 'singular life purpose', 'singular life purpose', 'singular life purpose', 2, 21, 2),
(144, 'Thatâ€™s a myth that grew out of the time in which we were trapped in the jobs of the tribe or village; you had to choose to be a baker or a blacksmith', 'Thatâ€™s a myth that grew out of the time in which we were trapped in the jobs of the tribe or village; you had to choose to be a baker or a blacksmith', 'Thatâ€™s a myth that grew out of the time in which we were trapped in the jobs of the tribe or village; you had to choose to be a baker or a blacksmith', 2, 21, 3),
(145, 'and because you died young', 'and because you died young', 'and because you died young', 2, 21, 4),
(146, 'in your 20s or 30s', 'in your 20s or 30s', 'in your 20s or 30s', 2, 21, 5),
(147, 'you had to choose quickly', 'you had to choose quickly', 'you had to choose quickly', 2, 21, 6),
(148, 'Today', 'Today', 'Today', 2, 21, 7),
(149, 'thereâ€™s more opportunity', 'thereâ€™s more opportunity', 'thereâ€™s more opportunity', 2, 21, 8),
(150, 'no borders', 'no borders', 'no borders', 2, 21, 9),
(151, 'and longer life', 'and longer life', 'and longer life', 2, 21, 10),
(152, 'spans', 'spans', 'spans', 2, 21, 11),
(153, 'So youâ€™ll have multiple purposes and missions throughout life', 'So youâ€™ll have multiple purposes and missions throughout life', 'So youâ€™ll have multiple purposes and missions throughout life', 2, 21, 12),
(154, 'Hereâ€™s how to narrow them down to what matters', 'Hereâ€™s how to narrow them down to what matters', 'Hereâ€™s how to narrow them down to what matters', 2, 21, 13),
(155, 'Live the best quality of life that you can', 'Live the best quality of life that you can', 'Live the best quality of life that you can', 2, 22, 1),
(156, 'This should be one of the main missions for us all', 'This should be one of the main missions for us all', 'This should be one of the main missions for us all', 2, 22, 2),
(157, 'donâ€™t you think', 'donâ€™t you think', 'donâ€™t you think', 2, 22, 3),
(158, 'Make it a priority to grow and excel in your health', 'Make it a priority to grow and excel in your health', 'Make it a priority to grow and excel in your health', 2, 22, 4),
(159, 'relationships', 'relationships', 'relationships', 2, 22, 5),
(160, 'career', 'career', 'career', 2, 22, 6),
(161, 'finances', 'finances', 'finances', 2, 22, 7),
(162, 'spirituality', 'spirituality', 'spirituality', 2, 22, 8),
(163, 'hobbies', 'hobbies', 'hobbies', 2, 22, 9),
(164, 'Improve each of these areas and youâ€™ll start to feel on purpose', 'Improve each of these areas and youâ€™ll start to feel on purpose', 'Improve each of these areas and youâ€™ll start to feel on purpose', 2, 22, 10);

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE IF NOT EXISTS `trades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `validated` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  `last_completed_lesson` int(11) DEFAULT NULL,
  `total_points` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`, `username`, `is_confirmed`, `last_completed_lesson`, `total_points`, `created`, `modified`) VALUES
(39, 'karina nishimura', '$2a$10$NWKpFHZ7qkacO3tnhuHsqeZIPeTO15eaEKvMVwxuYbCrH.liBx8zS', 'author', 'kahsaynishimura@gmail.com', 1, 0, 185, '2016-01-17 18:31:54', '2016-01-18 23:49:01'),
(42, 'thiago comar', '$2a$10$gGGMvu.qW0NBdDOHsVRRtOe1UfqR7TSahd88bnpJfFN7O77yKwi8e', 'author', 'thiagocomar@gmail.com', 1, 0, 0, '2016-01-17 19:25:00', '2016-01-17 19:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `users_books`
--

CREATE TABLE IF NOT EXISTS `users_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users_books`
--

INSERT INTO `users_books` (`id`, `book_id`, `user_id`) VALUES
(12, 11, 42),
(13, 11, 39),
(14, 10, 39);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
