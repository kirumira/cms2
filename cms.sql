-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2013 at 02:05 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE IF NOT EXISTS `adjustments` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_receipt` varchar(20) NOT NULL,
  `i_vat` float NOT NULL,
  `i_pay_amount` float NOT NULL,
  `f_vat` float NOT NULL,
  `f_pay_amount` float NOT NULL,
  `date_adjusted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adjusted_by` varchar(50) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(140) NOT NULL,
  `number` varchar(20) NOT NULL,
  `commission` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `number`, `commission`) VALUES
(1, 'Cleave Masereka', '0-781-209-121', 0),
(2, 'Ibrah', '0-718-212-111', 0);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `audit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `audit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `audit_username` varchar(132) NOT NULL,
  `audit_userid` int(10) unsigned NOT NULL,
  `audit_usertype` int(11) NOT NULL,
  `audit_action` longtext NOT NULL,
  PRIMARY KEY (`audit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=199 ;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`audit_id`, `audit_date`, `audit_username`, `audit_userid`, `audit_usertype`, `audit_action`) VALUES
(1, '2013-02-04 05:36:17', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(2, '2013-02-04 05:38:28', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa added a new landlord: Crane Services '),
(3, '2013-02-04 05:39:24', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa Added a new building: PLATINUM HOUSE'),
(4, '2013-02-04 05:40:47', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa edited details about a room:  of PLATINUM HOUSE'),
(5, '2013-02-04 05:44:27', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa edited details about a room:  of PLATINUM HOUSE'),
(6, '2013-02-07 23:37:35', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(7, '2013-02-07 23:43:00', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa Added a new building: EAGLE PLAZA'),
(8, '2013-02-07 23:44:25', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa edited details about a room:  of EAGLE PLAZA'),
(9, '2013-02-07 23:44:39', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa edited details about a room:  of EAGLE PLAZA'),
(10, '2013-02-07 23:44:52', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa edited details about a room:  of EAGLE PLAZA'),
(11, '2013-02-10 22:44:37', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(12, '2013-02-20 23:03:59', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(13, '2013-02-21 02:19:49', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(14, '2013-02-21 02:36:23', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa Added a new building: Kan House'),
(15, '2013-02-22 03:18:50', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(16, '2013-02-22 04:02:47', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(17, '2013-02-22 04:03:43', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(18, '2013-02-22 04:19:13', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(19, '2013-02-22 04:28:32', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(20, '2013-02-22 22:27:41', 'silakag@cms.com', 33, 1, 'Silas  Kaggwa logged in from IP Address: 127.0.0.1'),
(21, '2013-02-22 23:07:29', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(22, '2013-02-25 01:03:45', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(23, '2013-02-25 02:00:59', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of PLATINUM HOUSE'),
(24, '2013-02-25 02:16:32', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(25, '2013-02-25 02:31:40', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of PLATINUM HOUSE'),
(26, '2013-02-25 02:31:59', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of PLATINUM HOUSE'),
(27, '2013-02-25 02:32:17', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of PLATINUM HOUSE'),
(28, '2013-02-25 03:16:27', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of PLATINUM HOUSE'),
(29, '2013-02-25 03:17:15', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of PLATINUM HOUSE'),
(30, '2013-02-25 04:34:34', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira added a new user:  '),
(61, '2013-03-06 06:17:31', 'jmasika@cms.com', 4, 1, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(62, '2013-03-06 06:21:18', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(63, '2013-03-06 06:22:01', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(64, '2013-03-06 06:27:21', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(65, '2013-03-06 06:30:08', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(66, '2013-03-06 06:31:31', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(67, '2013-03-06 06:38:09', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(68, '2013-03-06 06:39:10', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(69, '2013-03-06 06:46:34', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(70, '2013-03-06 06:46:48', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(71, '2013-03-06 06:52:33', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(72, '2013-03-06 06:52:56', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(73, '2013-03-06 07:22:51', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(74, '2013-03-06 07:26:31', 'jmasika@cms.com', 4, 1, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(75, '2013-03-06 07:26:55', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(76, '2013-03-06 07:28:27', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(77, '2013-03-06 07:28:53', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(78, '2013-03-06 07:31:56', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(79, '2013-03-06 07:32:22', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(80, '2013-03-06 07:45:07', 'jmasika@cms.com', 4, 1, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(81, '2013-03-06 07:46:08', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(82, '2013-03-06 07:47:40', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(83, '2013-03-07 20:47:26', '0', 0, 0, '  logged in from IP Address: 127.0.0.1'),
(84, '2013-03-07 20:55:13', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(85, '2013-03-07 20:55:42', 'jmasika@cms.com', 4, 1, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(86, '2013-03-07 20:56:54', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(87, '2013-03-07 20:57:49', '0', 0, 1, '  logged in from IP Address: 127.0.0.1'),
(88, '2013-03-07 21:16:52', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(89, '2013-03-07 21:23:53', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(90, '2013-03-07 21:24:15', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(91, '2013-03-07 21:24:39', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(92, '2013-03-07 21:25:59', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(93, '2013-03-07 21:26:36', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(94, '2013-03-07 21:27:11', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(95, '2013-03-07 21:30:05', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(96, '2013-03-07 21:30:28', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(97, '2013-03-07 21:32:50', '0', 0, 0, '  logged in from IP Address: 127.0.0.1'),
(98, '2013-03-07 21:33:15', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(99, '2013-03-07 21:36:40', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(100, '2013-03-07 21:38:23', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(101, '2013-03-07 21:42:06', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(102, '2013-03-07 21:42:25', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(103, '2013-03-07 21:45:38', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(104, '2013-03-07 21:46:03', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(105, '2013-03-07 21:51:27', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(106, '2013-03-07 21:55:34', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(107, '2013-03-07 21:56:05', '0', 0, 0, '  logged in from IP Address: 127.0.0.1'),
(108, '2013-03-07 22:03:24', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(109, '2013-03-07 22:03:51', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(110, '2013-03-07 22:04:30', 'jmasika@cms.com', 4, 0, 'Jane Masika  logged in from IP Address: 127.0.0.1'),
(111, '2013-03-07 22:21:41', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(112, '2013-03-09 20:44:46', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(113, '2013-03-10 19:20:34', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(114, '2013-03-11 13:04:56', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(115, '2013-03-11 22:25:34', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(116, '2013-03-12 03:17:07', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(117, '2013-03-13 22:31:07', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(118, '2013-03-19 14:31:13', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(119, '2013-03-19 15:25:33', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira Edited details of tenant : '),
(120, '2013-03-20 03:19:17', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(121, '2013-03-20 03:21:10', 'azizkrmr@gmail.com', 32, 1, 'Aziz Edited details of currency : USD'),
(122, '2013-03-20 06:17:16', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of EAGLE PLAZA'),
(123, '2013-03-20 06:17:26', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of EAGLE PLAZA'),
(124, '2013-03-20 08:52:43', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(125, '2013-03-21 22:53:20', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(126, '2013-03-21 22:55:38', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira added a new landlord: Kato Sam '),
(127, '2013-03-21 22:57:16', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira added a new landlord: Musa Menk '),
(128, '2013-03-22 19:50:30', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(129, '2013-03-23 22:35:37', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(130, '2013-03-23 23:00:13', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of EAGLE PLAZA'),
(131, '2013-03-23 23:00:26', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of EAGLE PLAZA'),
(132, '2013-03-23 23:00:42', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira edited details about a room:  of EAGLE PLAZA'),
(133, '2013-03-24 05:18:15', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(134, '2013-03-24 22:54:17', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(135, '2013-03-26 02:37:41', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(136, '2013-03-26 06:22:25', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(137, '2013-03-26 16:06:05', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(138, '2013-03-26 21:48:19', 'azizkrmr@gmail.com', 32, 1, 'Aziz Kirumira logged in from IP Address: 127.0.0.1'),
(139, '2013-04-18 02:01:29', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(140, '2013-04-18 04:34:01', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(141, '2013-04-18 09:22:47', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(142, '2013-04-18 09:46:32', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(143, '2013-04-18 17:52:46', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(144, '2013-04-18 18:48:08', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of PLATINUM HOUSE'),
(145, '2013-04-18 18:48:40', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of PLATINUM HOUSE'),
(146, '2013-04-18 18:54:05', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of PLATINUM HOUSE'),
(147, '2013-04-18 19:52:37', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(148, '2013-04-18 21:55:42', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(149, '2013-04-18 23:43:00', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(150, '2013-04-18 23:43:10', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(151, '2013-04-18 23:43:33', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(152, '2013-04-19 00:17:57', 'cmasereka@gmail.com', 31, 1, 'cleave masereka Edited details of tenant : '),
(153, '2013-04-19 00:18:22', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(154, '2013-04-19 00:18:30', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(155, '2013-04-19 00:18:38', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(156, '2013-04-19 00:18:46', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(157, '2013-04-19 00:19:07', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(158, '2013-04-19 00:19:15', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(159, '2013-04-19 01:22:12', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(160, '2013-04-19 01:22:19', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(161, '2013-04-19 01:22:27', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(162, '2013-04-19 01:30:45', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(163, '2013-04-19 01:35:03', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(164, '2013-04-19 02:06:46', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(165, '2013-04-19 02:45:51', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(166, '2013-04-19 02:48:26', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(167, '2013-04-21 20:04:03', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(168, '2013-04-21 20:23:06', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(169, '2013-04-21 21:41:54', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(170, '2013-04-21 21:47:50', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(171, '2013-04-21 22:10:35', 'cmasereka@gmail.com', 31, 1, 'cleave masereka Edited details of tenant : '),
(172, '2013-04-23 04:11:49', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(173, '2013-04-23 04:44:47', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(174, '2013-04-23 04:45:01', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(175, '2013-04-23 04:45:14', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(176, '2013-04-23 04:45:22', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(177, '2013-04-23 04:45:31', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of EAGLE PLAZA'),
(178, '2013-04-23 04:54:15', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(179, '2013-04-23 05:03:03', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(180, '2013-04-23 18:11:49', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(181, '2013-04-23 18:12:28', 'cmasereka@gmail.com', 31, 1, 'cleave masereka logged in from IP Address: 127.0.0.1'),
(182, '2013-04-23 18:23:08', 'cmasereka@gmail.com', 31, 1, 'cleave masereka Added a new building: Dream House'),
(183, '2013-04-23 18:24:03', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of Dream House'),
(184, '2013-04-23 18:24:16', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of Dream House'),
(185, '2013-04-23 18:24:25', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of Dream House'),
(186, '2013-04-23 18:24:35', 'cmasereka@gmail.com', 31, 1, 'cleave masereka edited details about a room:  of Dream House'),
(187, '2013-05-19 08:33:00', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(188, '2013-05-20 14:59:53', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(189, '2013-05-20 16:55:15', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(190, '2013-05-20 17:52:15', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(191, '2013-05-20 17:55:41', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(192, '2013-05-20 17:56:51', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(193, '2013-05-21 13:41:08', 'cmasereka@gmail.com', 44, 1, '  logged in from IP Address: 127.0.0.1'),
(194, '2013-05-21 13:43:06', 'cmasereka@gmail.com', 44, 1, '  added a new user:  '),
(195, '2013-05-21 13:44:20', 'cmasereka@gmail.com', 44, 1, '  Added a new building: Eagle'),
(196, '2013-05-21 13:45:36', 'cmasereka@gmail.com', 44, 1, '  edited details about a room:  of Eagle'),
(197, '2013-05-21 13:45:47', 'cmasereka@gmail.com', 44, 1, '  edited details about a room:  of Eagle'),
(198, '2013-05-21 13:46:01', 'cmasereka@gmail.com', 44, 1, '  edited details about a room:  of Eagle');

-- --------------------------------------------------------

--
-- Table structure for table `balance_adjustments`
--

CREATE TABLE IF NOT EXISTS `balance_adjustments` (
  `bal_id` int(11) NOT NULL AUTO_INCREMENT,
  `bal_rm_id` int(11) NOT NULL,
  `bal_ten_id` int(11) NOT NULL,
  `bal_man_id` int(11) NOT NULL,
  `bal_before` float NOT NULL,
  `bal_after` float NOT NULL,
  PRIMARY KEY (`bal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bounced_cheqs`
--

CREATE TABLE IF NOT EXISTS `bounced_cheqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `room` int(10) NOT NULL,
  `tenant` varchar(10) NOT NULL,
  `cheque` varchar(30) NOT NULL,
  `penalty` bigint(20) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `details` varchar(200) NOT NULL,
  `rec_id` int(50) NOT NULL,
  `amount_clrd` float NOT NULL,
  `date_clrd` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `b_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_name` varchar(150) NOT NULL,
  `p_o_box` int(11) NOT NULL,
  `b_landlord_id` int(11) NOT NULL,
  `b_num_rooms` int(11) NOT NULL,
  `b_num_floors` int(11) NOT NULL,
  `b_town` varchar(160) NOT NULL,
  `b_district` varchar(160) NOT NULL,
  `b_manager_id` int(11) NOT NULL,
  `b_description` text NOT NULL,
  `b_type` enum('COMMERCIAL','RESIDENTIAL','WAREHOUSE') NOT NULL,
  `currency` varchar(10) NOT NULL,
  `property_no` varchar(120) NOT NULL,
  `plot` int(20) NOT NULL,
  `block` varchar(200) NOT NULL,
  `street` varchar(132) NOT NULL,
  `b_grp_id` int(11) NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`b_id`, `b_name`, `p_o_box`, `b_landlord_id`, `b_num_rooms`, `b_num_floors`, `b_town`, `b_district`, `b_manager_id`, `b_description`, `b_type`, `currency`, `property_no`, `plot`, `block`, `street`, `b_grp_id`) VALUES
(1, 'Eagle', 333, 4, 0, 5, '0', 'kaeg', 45, '0', 'COMMERCIAL', 'UGX', '12', 33, '33', 'gngfn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL,
  `old_session_id` varchar(40) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) NOT NULL,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `old_session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d581be9f4239de9c844a8852e365d0d4', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11', 1368952275, 'a:8:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;}'),
('e3b081e85b6365ef7bfaee7987585777', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11', 1368980134, ''),
('f12111f8ded49939583b67522306a5b7', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369061988, 'a:8:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;}'),
('47d1b048e88261050314fdfa3b20ba49', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369068904, 'a:8:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;}'),
('1f55eae0cf626a956d0ca7bfcc50a68c', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369072331, 'a:8:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;}'),
('efce1e7ba17e619e2b1c86f26e5cd152', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369072530, ''),
('cc8958ce3c59140c2fcfc9d49b194429', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369072540, 'a:8:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;}'),
('b45cb329562cfc446e3dc05f857275cf', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369072544, ''),
('ae8b3adbb5d6b6d930e4ff1cd8004009', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369072608, 'a:8:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;}'),
('01af5c68b8c62eb13e70e3d9e5e1bed3', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369094188, ''),
('d41ecfc88ca81770ac597ded54705c0e', '781a991a151cabf3d1200b6e66c8093c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31', 1369144276, 'a:12:{s:9:"user_data";s:0:"";s:10:"name_first";s:0:"";s:9:"name_last";s:0:"";s:7:"name_id";s:2:"44";s:10:"name_group";s:1:"1";s:9:"name_user";s:19:"cmasereka@gmail.com";s:13:"name_pic_path";s:0:"";s:12:"is_logged_in";b:1;s:11:"building_id";s:1:"1";s:13:"building_name";s:5:"Eagle";s:6:"floors";s:1:"5";s:8:"currency";s:3:"UGX";}');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE IF NOT EXISTS `codes` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `dcode` varchar(5) NOT NULL,
  `codes_state` enum('NEW','OLD') NOT NULL DEFAULT 'NEW',
  UNIQUE KEY `c_id` (`c_id`),
  UNIQUE KEY `c_id_2` (`c_id`),
  KEY `c_id_3` (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(120) NOT NULL,
  `rate` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `currency`, `rate`) VALUES
(1, 'USD', 2650);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `documents_id` int(11) NOT NULL AUTO_INCREMENT,
  `documents_title` text NOT NULL,
  `documents_path` text NOT NULL,
  `documents_project_id` int(11) NOT NULL,
  PRIMARY KEY (`documents_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `edit_currency`
--

CREATE TABLE IF NOT EXISTS `edit_currency` (
  `edit_id` int(11) NOT NULL AUTO_INCREMENT,
  `edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_rate` int(11) NOT NULL,
  `edit_by` varchar(30) NOT NULL,
  PRIMARY KEY (`edit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `edit_umeme`
--

CREATE TABLE IF NOT EXISTS `edit_umeme` (
  `u_edit_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `u_edit_rate` float NOT NULL,
  `u_edit_by` varchar(50) NOT NULL,
  `u_edit_b_id` int(11) NOT NULL,
  PRIMARY KEY (`u_edit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `evictions`
--

CREATE TABLE IF NOT EXISTS `evictions` (
  `ev_id` int(11) NOT NULL AUTO_INCREMENT,
  `ev_rm_id` int(11) NOT NULL,
  `ev_ten_id` int(11) NOT NULL,
  `ev_reason` text NOT NULL,
  `ev_date` date NOT NULL,
  `ev_status` enum('PENDING','EVICTED') NOT NULL DEFAULT 'PENDING',
  `ev_by` int(11) NOT NULL,
  PRIMARY KEY (`ev_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `e_code` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `e_details`
--

CREATE TABLE IF NOT EXISTS `e_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `e_code` varchar(20) NOT NULL,
  `e_amount` bigint(20) NOT NULL,
  `e_b_id` int(11) NOT NULL,
  `e_floor` int(11) NOT NULL,
  `e_room` varchar(100) NOT NULL,
  `state` enum('req','exp') NOT NULL DEFAULT 'exp',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE IF NOT EXISTS `floors` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `n_rms` int(11) NOT NULL,
  `flr` int(11) NOT NULL,
  `flr_name` varchar(140) NOT NULL,
  `flr_plan` varchar(150) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`f_id`, `b_id`, `n_rms`, `flr`, `flr_name`, `flr_plan`) VALUES
(1, 1, 13, 1, '1st Floor', ''),
(2, 1, 0, 2, '2nd Floor', ''),
(3, 1, 0, 3, '3rd Floor', ''),
(4, 1, 0, 4, '4th Floor', ''),
(5, 1, 0, 5, '5th Floor', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `grp_id` int(11) NOT NULL AUTO_INCREMENT,
  `grp_name` varchar(140) NOT NULL,
  PRIMARY KEY (`grp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_name` varchar(40) NOT NULL,
  `inv_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`inv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1071 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`inv_id`, `inv_name`, `inv_date`) VALUES
(1, 'INV-70000', '2013-02-07 23:41:24'),
(2, 'INV-70001', '2013-02-07 23:52:04'),
(3, 'INV-70002', '2013-02-25 01:36:51'),
(4, 'INV-70003', '2013-02-25 01:40:30'),
(5, 'INV-70004', '2013-02-25 01:41:14'),
(6, 'INV-70005', '2013-02-25 01:46:34'),
(7, 'INV-70006', '2013-02-25 02:04:36'),
(8, 'INV-70007', '2013-02-25 02:33:29'),
(9, 'INV-70008', '2013-02-25 02:46:15'),
(10, 'INV-70009', '2013-02-25 02:53:20'),
(11, 'INV-700010', '2013-02-25 03:23:18'),
(12, 'INV-700011', '2013-02-25 03:25:10'),
(13, 'INV-700012', '2013-02-25 04:00:51'),
(14, 'INV-700013', '2013-02-25 04:10:43'),
(15, 'INV-700014', '2013-02-25 04:21:34'),
(16, 'INV-700015', '2013-02-25 04:22:02'),
(17, 'INV-700016', '2013-02-25 04:24:09'),
(18, 'INV-700017', '2013-03-19 14:43:07'),
(19, 'INV-700018', '2013-03-19 15:03:29'),
(20, 'INV-700019', '2013-03-19 15:09:37'),
(21, 'INV-700020', '2013-03-20 03:13:12'),
(22, 'INV-700021', '2013-03-20 03:13:12'),
(23, 'INV-700022', '2013-03-20 07:08:35'),
(24, 'INV-700023', '2013-03-20 07:27:33'),
(25, 'INV-700024', '2013-03-20 08:37:34'),
(26, 'INV-700025', '2013-03-22 19:54:06'),
(27, 'INV-700026', '2013-03-22 19:54:46'),
(28, 'INV-700027', '2013-03-26 06:31:53'),
(29, 'INV-700028', '2013-03-26 06:31:54'),
(30, 'INV-700029', '2013-03-26 06:31:54'),
(143, 'INV-7000142', '2013-04-22 12:09:52'),
(144, 'INV-7000143', '2013-04-22 12:09:52'),
(145, 'INV-7000144', '2013-04-22 12:09:52'),
(146, 'INV-7000145', '2013-04-22 12:09:53'),
(147, 'INV-7000146', '2013-04-22 12:09:53'),
(148, 'INV-7000147', '2013-04-22 12:09:53'),
(149, 'INV-7000148', '2013-04-22 12:09:54'),
(150, 'INV-7000149', '2013-04-22 12:09:54'),
(151, 'INV-7000150', '2013-04-22 12:09:54'),
(152, 'INV-7000151', '2013-04-22 18:45:25'),
(153, 'INV-7000152', '2013-04-22 18:52:41'),
(154, 'INV-7000153', '2013-04-22 18:53:14'),
(155, 'INV-7000154', '2013-04-23 04:11:30'),
(156, 'INV-7000155', '2013-04-23 04:11:31'),
(157, 'INV-7000156', '2013-04-23 04:11:31'),
(158, 'INV-7000157', '2013-04-23 04:11:31'),
(159, 'INV-7000158', '2013-04-23 04:11:31'),
(160, 'INV-7000159', '2013-04-23 04:11:32'),
(161, 'INV-7000160', '2013-04-23 04:11:32'),
(162, 'INV-7000161', '2013-04-23 04:11:32'),
(163, 'INV-7000162', '2013-04-23 04:11:33'),
(164, 'INV-7000163', '2013-04-23 04:11:33'),
(165, 'INV-7000164', '2013-04-23 04:11:33'),
(166, 'INV-7000165', '2013-04-23 04:11:33'),
(167, 'INV-7000166', '2013-04-23 04:11:34'),
(168, 'INV-7000167', '2013-04-23 04:11:34'),
(169, 'INV-7000168', '2013-04-23 04:11:34'),
(170, 'INV-7000169', '2013-04-23 04:11:35'),
(171, 'INV-7000170', '2013-04-23 04:11:35'),
(172, 'INV-7000171', '2013-04-23 04:11:35'),
(173, 'INV-7000172', '2013-04-23 04:11:35'),
(174, 'INV-7000173', '2013-04-23 04:11:36'),
(175, 'INV-7000174', '2013-04-23 04:11:36'),
(176, 'INV-7000175', '2013-04-23 04:11:36'),
(177, 'INV-7000176', '2013-04-23 04:11:36'),
(178, 'INV-7000177', '2013-04-23 04:11:37'),
(179, 'INV-7000178', '2013-04-23 04:11:37'),
(180, 'INV-7000179', '2013-04-23 04:11:37'),
(181, 'INV-7000180', '2013-04-23 04:11:37'),
(182, 'INV-7000181', '2013-04-23 04:11:37'),
(183, 'INV-7000182', '2013-04-23 04:11:38'),
(184, 'INV-7000183', '2013-04-23 04:11:38'),
(185, 'INV-7000184', '2013-04-23 04:11:38'),
(186, 'INV-7000185', '2013-04-23 04:11:38'),
(187, 'INV-7000186', '2013-04-23 04:11:39'),
(188, 'INV-7000187', '2013-04-23 04:12:29'),
(189, 'INV-7000188', '2013-04-23 04:12:29'),
(190, 'INV-7000189', '2013-04-23 04:12:29'),
(191, 'INV-7000190', '2013-04-23 04:12:29'),
(192, 'INV-7000191', '2013-04-23 04:12:30'),
(193, 'INV-7000192', '2013-04-23 04:12:30'),
(194, 'INV-7000193', '2013-04-23 04:12:30'),
(195, 'INV-7000194', '2013-04-23 04:12:30'),
(196, 'INV-7000195', '2013-04-23 04:12:31'),
(197, 'INV-7000196', '2013-04-23 04:12:31'),
(198, 'INV-7000197', '2013-04-23 04:12:31'),
(199, 'INV-7000198', '2013-04-23 04:12:32'),
(200, 'INV-7000199', '2013-04-23 04:12:32'),
(201, 'INV-7000200', '2013-04-23 04:12:32'),
(202, 'INV-7000201', '2013-04-23 04:12:32'),
(203, 'INV-7000202', '2013-04-23 04:12:33'),
(204, 'INV-7000203', '2013-04-23 04:12:33'),
(205, 'INV-7000204', '2013-04-23 04:12:33'),
(206, 'INV-7000205', '2013-04-23 04:12:34'),
(207, 'INV-7000206', '2013-04-23 04:12:34'),
(208, 'INV-7000207', '2013-04-23 04:12:34'),
(209, 'INV-7000208', '2013-04-23 04:12:35'),
(210, 'INV-7000209', '2013-04-23 04:12:35'),
(211, 'INV-7000210', '2013-04-23 04:12:35'),
(212, 'INV-7000211', '2013-04-23 04:12:35'),
(213, 'INV-7000212', '2013-04-23 04:12:36'),
(214, 'INV-7000213', '2013-04-23 04:12:36'),
(215, 'INV-7000214', '2013-04-23 04:12:36'),
(216, 'INV-7000215', '2013-04-23 04:12:36'),
(217, 'INV-7000216', '2013-04-23 04:12:37'),
(218, 'INV-7000217', '2013-04-23 04:12:37'),
(219, 'INV-7000218', '2013-04-23 04:12:37'),
(220, 'INV-7000219', '2013-04-23 04:12:37'),
(221, 'INV-7000220', '2013-04-23 04:12:38'),
(222, 'INV-7000221', '2013-04-23 04:12:38'),
(223, 'INV-7000222', '2013-04-23 04:12:38'),
(224, 'INV-7000223', '2013-04-23 04:12:39'),
(225, 'INV-7000224', '2013-04-23 04:12:39'),
(226, 'INV-7000225', '2013-04-23 04:12:39'),
(227, 'INV-7000226', '2013-04-23 04:12:39'),
(228, 'INV-7000227', '2013-04-23 04:12:40'),
(229, 'INV-7000228', '2013-04-23 04:12:40'),
(230, 'INV-7000229', '2013-04-23 04:12:40'),
(231, 'INV-7000230', '2013-04-23 04:12:40'),
(232, 'INV-7000231', '2013-04-23 04:12:41'),
(233, 'INV-7000232', '2013-04-23 04:12:41'),
(234, 'INV-7000233', '2013-04-23 04:12:41'),
(235, 'INV-7000234', '2013-04-23 04:12:41'),
(236, 'INV-7000235', '2013-04-23 04:12:42'),
(237, 'INV-7000236', '2013-04-23 04:12:42'),
(238, 'INV-7000237', '2013-04-23 04:12:42'),
(239, 'INV-7000238', '2013-04-23 04:12:42'),
(240, 'INV-7000239', '2013-04-23 04:12:43'),
(241, 'INV-7000240', '2013-04-23 04:12:43'),
(242, 'INV-7000241', '2013-04-23 04:12:43'),
(243, 'INV-7000242', '2013-04-23 04:12:43'),
(244, 'INV-7000243', '2013-04-23 04:12:44'),
(245, 'INV-7000244', '2013-04-23 04:12:44'),
(246, 'INV-7000245', '2013-04-23 04:12:45'),
(247, 'INV-7000246', '2013-04-23 04:12:45'),
(248, 'INV-7000247', '2013-04-23 04:12:46'),
(249, 'INV-7000248', '2013-04-23 04:12:46'),
(250, 'INV-7000249', '2013-04-23 04:12:46'),
(251, 'INV-7000250', '2013-04-23 04:12:47'),
(252, 'INV-7000251', '2013-04-23 04:12:47'),
(253, 'INV-7000252', '2013-04-23 04:12:47'),
(254, 'INV-7000253', '2013-04-23 05:10:41'),
(255, 'INV-7000254', '2013-04-23 05:11:34'),
(256, 'INV-7000255', '2013-04-23 05:11:35'),
(257, 'INV-7000256', '2013-04-23 05:11:35'),
(258, 'INV-7000257', '2013-04-23 05:11:35'),
(259, 'INV-7000258', '2013-04-23 05:11:35'),
(260, 'INV-7000259', '2013-04-23 05:11:36'),
(261, 'INV-7000260', '2013-04-23 05:11:36'),
(262, 'INV-7000261', '2013-04-23 05:11:36'),
(263, 'INV-7000262', '2013-04-23 05:11:37'),
(264, 'INV-7000263', '2013-04-23 05:11:37'),
(265, 'INV-7000264', '2013-04-23 05:11:37'),
(266, 'INV-7000265', '2013-04-23 05:11:37'),
(267, 'INV-7000266', '2013-04-23 05:11:38'),
(268, 'INV-7000267', '2013-04-23 05:11:38'),
(269, 'INV-7000268', '2013-04-23 05:11:38'),
(270, 'INV-7000269', '2013-04-23 05:11:39'),
(271, 'INV-7000270', '2013-04-23 05:11:39'),
(272, 'INV-7000271', '2013-04-23 05:11:39'),
(273, 'INV-7000272', '2013-04-23 05:11:40'),
(274, 'INV-7000273', '2013-04-23 05:11:40'),
(275, 'INV-7000274', '2013-04-23 05:11:40'),
(276, 'INV-7000275', '2013-04-23 05:11:41'),
(277, 'INV-7000276', '2013-04-23 05:11:41'),
(278, 'INV-7000277', '2013-04-23 05:11:41'),
(279, 'INV-7000278', '2013-04-23 05:11:41'),
(280, 'INV-7000279', '2013-04-23 05:11:42'),
(281, 'INV-7000280', '2013-04-23 05:11:42'),
(282, 'INV-7000281', '2013-04-23 05:11:42'),
(283, 'INV-7000282', '2013-04-23 05:11:42'),
(284, 'INV-7000283', '2013-04-23 05:11:43'),
(285, 'INV-7000284', '2013-04-23 05:11:43'),
(286, 'INV-7000285', '2013-04-23 05:11:43'),
(287, 'INV-7000286', '2013-04-23 05:11:44'),
(288, 'INV-7000287', '2013-04-23 05:11:44'),
(289, 'INV-7000288', '2013-04-23 05:11:44'),
(290, 'INV-7000289', '2013-04-23 05:11:45'),
(291, 'INV-7000290', '2013-04-23 05:11:46'),
(292, 'INV-7000291', '2013-04-23 05:11:46'),
(293, 'INV-7000292', '2013-04-23 05:11:47'),
(294, 'INV-7000293', '2013-04-23 05:11:47'),
(295, 'INV-7000294', '2013-04-23 05:11:47'),
(296, 'INV-7000295', '2013-04-23 05:15:10'),
(297, 'INV-7000296', '2013-04-23 05:15:10'),
(298, 'INV-7000297', '2013-04-23 05:15:11'),
(299, 'INV-7000298', '2013-04-23 05:15:11'),
(300, 'INV-7000299', '2013-04-23 05:15:11'),
(301, 'INV-7000300', '2013-04-23 05:15:11'),
(302, 'INV-7000301', '2013-04-23 05:15:12'),
(303, 'INV-7000302', '2013-04-23 05:15:12'),
(304, 'INV-7000303', '2013-04-23 05:15:12'),
(305, 'INV-7000304', '2013-04-23 05:15:13'),
(306, 'INV-7000305', '2013-04-23 05:15:13'),
(307, 'INV-7000306', '2013-04-23 05:15:13'),
(308, 'INV-7000307', '2013-04-23 05:15:13'),
(309, 'INV-7000308', '2013-04-23 05:15:13'),
(310, 'INV-7000309', '2013-04-23 05:15:14'),
(311, 'INV-7000310', '2013-04-23 05:15:14'),
(312, 'INV-7000311', '2013-04-23 05:15:14'),
(313, 'INV-7000312', '2013-04-23 05:15:15'),
(314, 'INV-7000313', '2013-04-23 05:15:15'),
(315, 'INV-7000314', '2013-04-23 05:15:15'),
(316, 'INV-7000315', '2013-04-23 05:15:15'),
(317, 'INV-7000316', '2013-04-23 05:15:15'),
(318, 'INV-7000317', '2013-04-23 05:15:16'),
(319, 'INV-7000318', '2013-04-23 05:15:16'),
(320, 'INV-7000319', '2013-04-23 05:15:16'),
(321, 'INV-7000320', '2013-04-23 05:15:16'),
(322, 'INV-7000321', '2013-04-23 05:15:17'),
(323, 'INV-7000322', '2013-04-23 05:15:17'),
(324, 'INV-7000323', '2013-04-23 05:15:17'),
(325, 'INV-7000324', '2013-04-23 05:15:17'),
(326, 'INV-7000325', '2013-04-23 05:15:18'),
(327, 'INV-7000326', '2013-04-23 05:15:18'),
(328, 'INV-7000327', '2013-04-23 05:15:18'),
(329, 'INV-7000328', '2013-04-23 05:15:18'),
(330, 'INV-7000329', '2013-04-23 05:18:17'),
(331, 'INV-7000330', '2013-04-23 05:18:17'),
(332, 'INV-7000331', '2013-04-23 05:18:17'),
(333, 'INV-7000332', '2013-04-23 05:18:17'),
(334, 'INV-7000333', '2013-04-23 05:18:18'),
(335, 'INV-7000334', '2013-04-23 05:18:18'),
(336, 'INV-7000335', '2013-04-23 05:18:18'),
(337, 'INV-7000336', '2013-04-23 05:18:18'),
(338, 'INV-7000337', '2013-04-23 05:18:19'),
(339, 'INV-7000338', '2013-04-23 05:18:19'),
(340, 'INV-7000339', '2013-04-23 05:18:20'),
(341, 'INV-7000340', '2013-04-23 05:18:20'),
(342, 'INV-7000341', '2013-04-23 05:18:20'),
(343, 'INV-7000342', '2013-04-23 05:18:20'),
(344, 'INV-7000343', '2013-04-23 05:18:21'),
(345, 'INV-7000344', '2013-04-23 05:18:21'),
(346, 'INV-7000345', '2013-04-23 05:18:21'),
(347, 'INV-7000346', '2013-04-23 05:18:21'),
(348, 'INV-7000347', '2013-04-23 05:18:22'),
(349, 'INV-7000348', '2013-04-23 05:18:22'),
(350, 'INV-7000349', '2013-04-23 05:18:22'),
(351, 'INV-7000350', '2013-04-23 05:18:22'),
(352, 'INV-7000351', '2013-04-23 05:18:23'),
(353, 'INV-7000352', '2013-04-23 05:18:23'),
(354, 'INV-7000353', '2013-04-23 05:18:23'),
(355, 'INV-7000354', '2013-04-23 05:18:24'),
(356, 'INV-7000355', '2013-04-23 05:18:24'),
(357, 'INV-7000356', '2013-04-23 05:18:24'),
(358, 'INV-7000357', '2013-04-23 05:18:25'),
(359, 'INV-7000358', '2013-04-23 05:18:25'),
(360, 'INV-7000359', '2013-04-23 05:18:26'),
(361, 'INV-7000360', '2013-04-23 05:18:26'),
(362, 'INV-7000361', '2013-04-23 05:18:26'),
(363, 'INV-7000362', '2013-04-23 05:18:26'),
(364, 'INV-7000363', '2013-04-23 05:20:13'),
(365, 'INV-7000364', '2013-04-23 05:20:13'),
(366, 'INV-7000365', '2013-04-23 05:20:14'),
(367, 'INV-7000366', '2013-04-23 05:20:14'),
(368, 'INV-7000367', '2013-04-23 05:20:14'),
(369, 'INV-7000368', '2013-04-23 05:20:14'),
(370, 'INV-7000369', '2013-04-23 05:20:15'),
(371, 'INV-7000370', '2013-04-23 05:20:15'),
(372, 'INV-7000371', '2013-04-23 05:20:15'),
(373, 'INV-7000372', '2013-04-23 05:20:15'),
(374, 'INV-7000373', '2013-04-23 05:20:16'),
(375, 'INV-7000374', '2013-04-23 05:20:16'),
(376, 'INV-7000375', '2013-04-23 05:20:17'),
(377, 'INV-7000376', '2013-04-23 05:20:17'),
(378, 'INV-7000377', '2013-04-23 05:20:17'),
(379, 'INV-7000378', '2013-04-23 05:20:17'),
(380, 'INV-7000379', '2013-04-23 05:20:18'),
(381, 'INV-7000380', '2013-04-23 05:20:18'),
(382, 'INV-7000381', '2013-04-23 05:20:18'),
(383, 'INV-7000382', '2013-04-23 05:20:18'),
(384, 'INV-7000383', '2013-04-23 05:20:19'),
(385, 'INV-7000384', '2013-04-23 05:20:19'),
(386, 'INV-7000385', '2013-04-23 05:20:19'),
(387, 'INV-7000386', '2013-04-23 05:20:19'),
(388, 'INV-7000387', '2013-04-23 05:20:20'),
(389, 'INV-7000388', '2013-04-23 05:20:20'),
(390, 'INV-7000389', '2013-04-23 05:20:20'),
(391, 'INV-7000390', '2013-04-23 05:20:20'),
(392, 'INV-7000391', '2013-04-23 05:20:21'),
(393, 'INV-7000392', '2013-04-23 05:20:21'),
(394, 'INV-7000393', '2013-04-23 05:20:21'),
(395, 'INV-7000394', '2013-04-23 05:20:21'),
(396, 'INV-7000395', '2013-04-23 05:20:22'),
(397, 'INV-7000396', '2013-04-23 05:20:22'),
(398, 'INV-7000397', '2013-04-23 05:20:22'),
(399, 'INV-7000398', '2013-04-23 05:20:22'),
(400, 'INV-7000399', '2013-04-23 05:20:23'),
(401, 'INV-7000400', '2013-04-23 05:20:23'),
(402, 'INV-7000401', '2013-04-23 05:20:23'),
(403, 'INV-7000402', '2013-04-23 05:20:23'),
(404, 'INV-7000403', '2013-04-23 05:20:24'),
(405, 'INV-7000404', '2013-04-23 08:07:47'),
(406, 'INV-7000405', '2013-04-23 08:21:05'),
(407, 'INV-7000406', '2013-04-23 08:21:05'),
(408, 'INV-7000407', '2013-04-23 08:21:05'),
(409, 'INV-7000408', '2013-04-23 08:21:06'),
(410, 'INV-7000409', '2013-04-23 08:21:06'),
(411, 'INV-7000410', '2013-04-23 08:21:06'),
(412, 'INV-7000411', '2013-04-23 08:21:06'),
(413, 'INV-7000412', '2013-04-23 08:21:07'),
(414, 'INV-7000413', '2013-04-23 08:21:07'),
(415, 'INV-7000414', '2013-04-23 08:21:07'),
(416, 'INV-7000415', '2013-04-23 08:21:08'),
(417, 'INV-7000416', '2013-04-23 08:21:08'),
(418, 'INV-7000417', '2013-04-23 08:21:08'),
(419, 'INV-7000418', '2013-04-23 08:21:08'),
(420, 'INV-7000419', '2013-04-23 08:21:09'),
(421, 'INV-7000420', '2013-04-23 08:21:10'),
(422, 'INV-7000421', '2013-04-23 08:21:10'),
(423, 'INV-7000422', '2013-04-23 08:21:11'),
(424, 'INV-7000423', '2013-04-23 08:21:11'),
(425, 'INV-7000424', '2013-04-23 08:21:11'),
(426, 'INV-7000425', '2013-04-23 08:21:12'),
(427, 'INV-7000426', '2013-04-23 08:21:12'),
(428, 'INV-7000427', '2013-04-23 08:21:12'),
(429, 'INV-7000428', '2013-04-23 08:21:13'),
(430, 'INV-7000429', '2013-04-23 08:21:13'),
(431, 'INV-7000430', '2013-04-23 08:21:13'),
(432, 'INV-7000431', '2013-04-23 08:21:13'),
(433, 'INV-7000432', '2013-04-23 08:21:14'),
(434, 'INV-7000433', '2013-04-23 08:21:14'),
(435, 'INV-7000434', '2013-04-23 08:21:14'),
(436, 'INV-7000435', '2013-04-23 08:21:15'),
(437, 'INV-7000436', '2013-04-23 08:21:16'),
(438, 'INV-7000437', '2013-04-23 08:21:17'),
(439, 'INV-7000438', '2013-04-23 08:21:17'),
(440, 'INV-7000439', '2013-04-23 08:21:18'),
(441, 'INV-7000440', '2013-04-23 08:21:18'),
(442, 'INV-7000441', '2013-04-23 08:21:19'),
(443, 'INV-7000442', '2013-04-23 08:21:19'),
(444, 'INV-7000443', '2013-04-23 08:21:19'),
(445, 'INV-7000444', '2013-04-23 08:21:20'),
(446, 'INV-7000445', '2013-04-23 08:21:20'),
(447, 'INV-7000446', '2013-04-23 09:06:37'),
(448, 'INV-7000447', '2013-04-23 09:16:07'),
(449, 'INV-7000448', '2013-04-23 09:20:44'),
(450, 'INV-7000449', '2013-04-23 09:21:48'),
(451, 'INV-7000450', '2013-04-23 09:23:20'),
(452, 'INV-7000451', '2013-04-23 09:25:57'),
(453, 'INV-7000452', '2013-04-23 09:28:06'),
(454, 'INV-7000453', '2013-04-23 09:33:08'),
(455, 'INV-7000454', '2013-04-23 09:34:20'),
(456, 'INV-7000455', '2013-04-23 09:44:48'),
(457, 'INV-7000456', '2013-04-23 09:45:36'),
(458, 'INV-7000457', '2013-04-23 09:46:44'),
(459, 'INV-7000458', '2013-04-23 09:52:38'),
(460, 'INV-7000459', '2013-04-23 09:54:11'),
(461, 'INV-7000460', '2013-04-23 09:55:29'),
(462, 'INV-7000461', '2013-04-23 09:56:17'),
(463, 'INV-7000462', '2013-04-23 09:58:49'),
(464, 'INV-7000463', '2013-04-23 10:07:11'),
(465, 'INV-7000464', '2013-04-23 10:07:11'),
(466, 'INV-7000465', '2013-04-23 10:07:11'),
(467, 'INV-7000466', '2013-04-23 10:07:12'),
(468, 'INV-7000467', '2013-04-23 10:07:12'),
(469, 'INV-7000468', '2013-04-23 10:07:12'),
(470, 'INV-7000469', '2013-04-23 10:07:12'),
(471, 'INV-7000470', '2013-04-23 10:07:13'),
(472, 'INV-7000471', '2013-04-23 10:07:13'),
(473, 'INV-7000472', '2013-04-23 10:07:13'),
(474, 'INV-7000473', '2013-04-23 10:07:13'),
(475, 'INV-7000474', '2013-04-23 10:07:14'),
(476, 'INV-7000475', '2013-04-23 10:07:14'),
(477, 'INV-7000476', '2013-04-23 10:07:14'),
(478, 'INV-7000477', '2013-04-23 10:07:15'),
(479, 'INV-7000478', '2013-04-23 10:07:15'),
(480, 'INV-7000479', '2013-04-23 10:07:15'),
(481, 'INV-7000480', '2013-04-23 10:07:15'),
(482, 'INV-7000481', '2013-04-23 10:07:16'),
(483, 'INV-7000482', '2013-04-23 10:07:16'),
(484, 'INV-7000483', '2013-04-23 10:07:16'),
(485, 'INV-7000484', '2013-04-23 10:07:16'),
(486, 'INV-7000485', '2013-04-23 10:07:17'),
(487, 'INV-7000486', '2013-04-23 10:07:17'),
(488, 'INV-7000487', '2013-04-23 10:07:17'),
(489, 'INV-7000488', '2013-04-23 10:07:17'),
(490, 'INV-7000489', '2013-04-23 10:07:18'),
(491, 'INV-7000490', '2013-04-23 10:07:18'),
(492, 'INV-7000491', '2013-04-23 10:07:18'),
(493, 'INV-7000492', '2013-04-23 10:07:18'),
(494, 'INV-7000493', '2013-04-23 10:07:19'),
(495, 'INV-7000494', '2013-04-23 10:07:19'),
(496, 'INV-7000495', '2013-04-23 10:07:19'),
(497, 'INV-7000496', '2013-04-23 10:07:19'),
(498, 'INV-7000497', '2013-04-23 10:07:20'),
(499, 'INV-7000498', '2013-04-23 10:07:20'),
(500, 'INV-7000499', '2013-04-23 10:07:20'),
(501, 'INV-7000500', '2013-04-23 10:07:20'),
(502, 'INV-7000501', '2013-04-23 10:07:21'),
(503, 'INV-7000502', '2013-04-23 10:07:21'),
(504, 'INV-7000503', '2013-04-23 10:07:21'),
(505, 'INV-7000504', '2013-04-23 10:07:22'),
(506, 'INV-7000505', '2013-04-23 10:07:23'),
(507, 'INV-7000506', '2013-04-23 10:07:23'),
(508, 'INV-7000507', '2013-04-23 10:07:23'),
(509, 'INV-7000508', '2013-04-23 10:07:24'),
(510, 'INV-7000509', '2013-04-23 10:07:24'),
(511, 'INV-7000510', '2013-04-23 10:07:24'),
(512, 'INV-7000511', '2013-04-23 10:07:24'),
(513, 'INV-7000512', '2013-04-23 10:07:25'),
(514, 'INV-7000513', '2013-04-23 10:07:25'),
(515, 'INV-7000514', '2013-04-23 10:07:25'),
(516, 'INV-7000515', '2013-04-23 10:07:26'),
(517, 'INV-7000516', '2013-04-23 10:07:26'),
(518, 'INV-7000517', '2013-04-23 10:07:26'),
(519, 'INV-7000518', '2013-04-23 10:07:27'),
(520, 'INV-7000519', '2013-04-23 10:07:27'),
(521, 'INV-7000520', '2013-04-23 10:07:27'),
(522, 'INV-7000521', '2013-04-23 10:07:27'),
(523, 'INV-7000522', '2013-04-23 10:07:28'),
(524, 'INV-7000523', '2013-04-23 10:07:28'),
(525, 'INV-7000524', '2013-04-23 10:07:28'),
(526, 'INV-7000525', '2013-04-23 10:07:28'),
(527, 'INV-7000526', '2013-04-23 10:07:29'),
(528, 'INV-7000527', '2013-04-23 10:07:29'),
(529, 'INV-7000528', '2013-04-23 10:07:29'),
(530, 'INV-7000529', '2013-04-23 10:07:30'),
(531, 'INV-7000530', '2013-04-23 10:07:30'),
(532, 'INV-7000531', '2013-04-23 10:07:30'),
(533, 'INV-7000532', '2013-04-23 10:07:31'),
(534, 'INV-7000533', '2013-04-23 10:07:31'),
(535, 'INV-7000534', '2013-04-23 10:07:31'),
(536, 'INV-7000535', '2013-04-23 10:07:31'),
(537, 'INV-7000536', '2013-04-23 10:07:32'),
(538, 'INV-7000537', '2013-04-23 10:07:32'),
(539, 'INV-7000538', '2013-04-23 10:07:32'),
(540, 'INV-7000539', '2013-04-23 10:07:32'),
(541, 'INV-7000540', '2013-04-23 10:07:33'),
(542, 'INV-7000541', '2013-04-23 10:07:33'),
(543, 'INV-7000542', '2013-04-23 10:07:33'),
(544, 'INV-7000543', '2013-04-23 10:07:34'),
(545, 'INV-7000544', '2013-04-23 10:07:34'),
(546, 'INV-7000545', '2013-04-23 10:24:00'),
(547, 'INV-7000546', '2013-04-23 10:24:00'),
(548, 'INV-7000547', '2013-04-23 10:24:00'),
(549, 'INV-7000548', '2013-04-23 10:24:01'),
(550, 'INV-7000549', '2013-04-23 10:24:01'),
(551, 'INV-7000550', '2013-04-23 10:24:01'),
(552, 'INV-7000551', '2013-04-23 10:24:01'),
(553, 'INV-7000552', '2013-04-23 10:24:02'),
(554, 'INV-7000553', '2013-04-23 10:24:03'),
(555, 'INV-7000554', '2013-04-23 10:24:03'),
(556, 'INV-7000555', '2013-04-23 10:24:04'),
(557, 'INV-7000556', '2013-04-23 10:24:04'),
(558, 'INV-7000557', '2013-04-23 10:24:04'),
(559, 'INV-7000558', '2013-04-23 10:24:04'),
(560, 'INV-7000559', '2013-04-23 10:24:05'),
(561, 'INV-7000560', '2013-04-23 10:24:05'),
(562, 'INV-7000561', '2013-04-23 10:24:05'),
(563, 'INV-7000562', '2013-04-23 10:24:05'),
(564, 'INV-7000563', '2013-04-23 10:24:06'),
(565, 'INV-7000564', '2013-04-23 10:24:06'),
(566, 'INV-7000565', '2013-04-23 10:24:06'),
(567, 'INV-7000566', '2013-04-23 10:24:06'),
(568, 'INV-7000567', '2013-04-23 10:24:07'),
(569, 'INV-7000568', '2013-04-23 10:24:07'),
(570, 'INV-7000569', '2013-04-23 10:24:07'),
(571, 'INV-7000570', '2013-04-23 10:24:07'),
(572, 'INV-7000571', '2013-04-23 10:24:08'),
(573, 'INV-7000572', '2013-04-23 10:24:08'),
(574, 'INV-7000573', '2013-04-23 10:24:08'),
(575, 'INV-7000574', '2013-04-23 10:24:08'),
(576, 'INV-7000575', '2013-04-23 10:24:09'),
(577, 'INV-7000576', '2013-04-23 10:24:09'),
(578, 'INV-7000577', '2013-04-23 10:24:09'),
(579, 'INV-7000578', '2013-04-23 10:24:09'),
(580, 'INV-7000579', '2013-04-23 10:24:10'),
(581, 'INV-7000580', '2013-04-23 10:24:10'),
(582, 'INV-7000581', '2013-04-23 10:24:10'),
(583, 'INV-7000582', '2013-04-23 10:24:10'),
(584, 'INV-7000583', '2013-04-23 10:24:11'),
(585, 'INV-7000584', '2013-04-23 10:24:11'),
(586, 'INV-7000585', '2013-04-23 10:24:11'),
(587, 'INV-7000586', '2013-04-23 10:27:35'),
(588, 'INV-7000587', '2013-04-23 10:27:35'),
(589, 'INV-7000588', '2013-04-23 10:27:36'),
(590, 'INV-7000589', '2013-04-23 10:27:36'),
(591, 'INV-7000590', '2013-04-23 10:27:36'),
(592, 'INV-7000591', '2013-04-23 10:27:37'),
(593, 'INV-7000592', '2013-04-23 10:27:37'),
(594, 'INV-7000593', '2013-04-23 10:27:37'),
(595, 'INV-7000594', '2013-04-23 10:27:38'),
(596, 'INV-7000595', '2013-04-23 10:27:38'),
(597, 'INV-7000596', '2013-04-23 10:27:38'),
(598, 'INV-7000597', '2013-04-23 10:27:38'),
(599, 'INV-7000598', '2013-04-23 10:27:39'),
(600, 'INV-7000599', '2013-04-23 10:27:39'),
(601, 'INV-7000600', '2013-04-23 10:27:39'),
(602, 'INV-7000601', '2013-04-23 10:27:39'),
(603, 'INV-7000602', '2013-04-23 10:27:40'),
(604, 'INV-7000603', '2013-04-23 10:27:40'),
(605, 'INV-7000604', '2013-04-23 10:27:40'),
(606, 'INV-7000605', '2013-04-23 10:27:40'),
(607, 'INV-7000606', '2013-04-23 10:27:41'),
(608, 'INV-7000607', '2013-04-23 10:27:41'),
(609, 'INV-7000608', '2013-04-23 10:27:41'),
(610, 'INV-7000609', '2013-04-23 10:27:41'),
(611, 'INV-7000610', '2013-04-23 10:27:42'),
(612, 'INV-7000611', '2013-04-23 10:27:42'),
(613, 'INV-7000612', '2013-04-23 10:27:42'),
(614, 'INV-7000613', '2013-04-23 10:27:42'),
(615, 'INV-7000614', '2013-04-23 10:27:43'),
(616, 'INV-7000615', '2013-04-23 10:27:43'),
(617, 'INV-7000616', '2013-04-23 10:27:43'),
(618, 'INV-7000617', '2013-04-23 10:27:43'),
(619, 'INV-7000618', '2013-04-23 10:27:44'),
(620, 'INV-7000619', '2013-04-23 10:27:44'),
(621, 'INV-7000620', '2013-04-23 10:27:44'),
(622, 'INV-7000621', '2013-04-23 10:27:44'),
(623, 'INV-7000622', '2013-04-23 10:28:37'),
(624, 'INV-7000623', '2013-04-23 10:28:38'),
(625, 'INV-7000624', '2013-04-23 10:28:38'),
(626, 'INV-7000625', '2013-04-23 10:28:38'),
(627, 'INV-7000626', '2013-04-23 10:28:38'),
(628, 'INV-7000627', '2013-04-23 10:28:39'),
(629, 'INV-7000628', '2013-04-23 10:28:39'),
(630, 'INV-7000629', '2013-04-23 10:28:39'),
(631, 'INV-7000630', '2013-04-23 10:28:39'),
(632, 'INV-7000631', '2013-04-23 10:28:40'),
(633, 'INV-7000632', '2013-04-23 10:28:40'),
(634, 'INV-7000633', '2013-04-23 10:28:40'),
(635, 'INV-7000634', '2013-04-23 10:28:40'),
(636, 'INV-7000635', '2013-04-23 10:28:41'),
(637, 'INV-7000636', '2013-04-23 10:28:41'),
(638, 'INV-7000637', '2013-04-23 10:28:41'),
(639, 'INV-7000638', '2013-04-23 10:28:41'),
(640, 'INV-7000639', '2013-04-23 10:28:42'),
(641, 'INV-7000640', '2013-04-23 10:28:42'),
(642, 'INV-7000641', '2013-04-23 10:28:42'),
(643, 'INV-7000642', '2013-04-23 10:28:42'),
(644, 'INV-7000643', '2013-04-23 10:28:43'),
(645, 'INV-7000644', '2013-04-23 10:28:43'),
(646, 'INV-7000645', '2013-04-23 10:28:43'),
(647, 'INV-7000646', '2013-04-23 10:28:43'),
(648, 'INV-7000647', '2013-04-23 10:28:44'),
(649, 'INV-7000648', '2013-04-23 10:28:44'),
(650, 'INV-7000649', '2013-04-23 10:28:44'),
(651, 'INV-7000650', '2013-04-23 10:28:44'),
(652, 'INV-7000651', '2013-04-23 10:28:45'),
(653, 'INV-7000652', '2013-04-23 10:28:45'),
(654, 'INV-7000653', '2013-04-23 10:28:45'),
(655, 'INV-7000654', '2013-04-23 10:28:45'),
(656, 'INV-7000655', '2013-04-23 10:28:46'),
(657, 'INV-7000656', '2013-04-23 10:28:46'),
(658, 'INV-7000657', '2013-04-23 10:28:46'),
(659, 'INV-7000658', '2013-04-23 10:28:46'),
(660, 'INV-7000659', '2013-04-23 10:28:47'),
(661, 'INV-7000660', '2013-04-23 10:28:47'),
(662, 'INV-7000661', '2013-04-23 10:28:47'),
(663, 'INV-7000662', '2013-04-23 10:28:47'),
(664, 'INV-7000663', '2013-04-23 10:28:48'),
(665, 'INV-7000664', '2013-04-23 10:28:49'),
(666, 'INV-7000665', '2013-04-23 10:28:49'),
(667, 'INV-7000666', '2013-04-23 10:28:49'),
(668, 'INV-7000667', '2013-04-23 10:28:50'),
(669, 'INV-7000668', '2013-04-23 10:28:50'),
(670, 'INV-7000669', '2013-04-23 10:28:50'),
(671, 'INV-7000670', '2013-04-23 10:28:50'),
(672, 'INV-7000671', '2013-04-23 10:28:51'),
(673, 'INV-7000672', '2013-04-23 10:28:51'),
(674, 'INV-7000673', '2013-04-23 10:28:51'),
(675, 'INV-7000674', '2013-04-23 10:28:51'),
(676, 'INV-7000675', '2013-04-23 10:28:52'),
(677, 'INV-7000676', '2013-04-23 10:28:52'),
(678, 'INV-7000677', '2013-04-23 10:28:52'),
(679, 'INV-7000678', '2013-04-23 10:28:52'),
(680, 'INV-7000679', '2013-04-23 10:28:53'),
(681, 'INV-7000680', '2013-04-23 10:28:53'),
(682, 'INV-7000681', '2013-04-23 10:28:53'),
(683, 'INV-7000682', '2013-04-23 10:28:53'),
(684, 'INV-7000683', '2013-04-23 10:28:54'),
(685, 'INV-7000684', '2013-04-23 10:28:54'),
(686, 'INV-7000685', '2013-04-23 10:28:54'),
(687, 'INV-7000686', '2013-04-23 10:28:54'),
(688, 'INV-7000687', '2013-04-23 10:28:55'),
(689, 'INV-7000688', '2013-04-23 10:28:55'),
(690, 'INV-7000689', '2013-04-23 10:28:55'),
(691, 'INV-7000690', '2013-04-23 10:28:55'),
(692, 'INV-7000691', '2013-04-23 10:28:56'),
(693, 'INV-7000692', '2013-04-23 10:28:56'),
(694, 'INV-7000693', '2013-04-23 10:28:56'),
(695, 'INV-7000694', '2013-04-23 10:28:56'),
(696, 'INV-7000695', '2013-04-23 10:28:57'),
(697, 'INV-7000696', '2013-04-23 10:28:57'),
(698, 'INV-7000697', '2013-04-23 10:28:57'),
(699, 'INV-7000698', '2013-04-23 10:28:57'),
(700, 'INV-7000699', '2013-04-23 10:28:57'),
(701, 'INV-7000700', '2013-04-23 10:28:58'),
(702, 'INV-7000701', '2013-04-23 10:28:58'),
(703, 'INV-7000702', '2013-04-23 10:28:58'),
(704, 'INV-7000703', '2013-04-23 10:28:59'),
(705, 'INV-7000704', '2013-04-23 10:37:51'),
(706, 'INV-7000705', '2013-04-23 10:37:52'),
(707, 'INV-7000706', '2013-04-23 10:37:52'),
(708, 'INV-7000707', '2013-04-23 10:37:52'),
(709, 'INV-7000708', '2013-04-23 10:37:52'),
(710, 'INV-7000709', '2013-04-23 10:37:53'),
(711, 'INV-7000710', '2013-04-23 10:37:53'),
(712, 'INV-7000711', '2013-04-23 10:37:53'),
(713, 'INV-7000712', '2013-04-23 10:37:53'),
(714, 'INV-7000713', '2013-04-23 10:37:54'),
(715, 'INV-7000714', '2013-04-23 10:37:54'),
(716, 'INV-7000715', '2013-04-23 10:37:54'),
(717, 'INV-7000716', '2013-04-23 10:37:54'),
(718, 'INV-7000717', '2013-04-23 10:37:55'),
(719, 'INV-7000718', '2013-04-23 10:37:55'),
(720, 'INV-7000719', '2013-04-23 10:37:55'),
(721, 'INV-7000720', '2013-04-23 10:37:55'),
(722, 'INV-7000721', '2013-04-23 10:37:56'),
(723, 'INV-7000722', '2013-04-23 10:37:56'),
(724, 'INV-7000723', '2013-04-23 10:37:56'),
(725, 'INV-7000724', '2013-04-23 10:37:56'),
(726, 'INV-7000725', '2013-04-23 10:37:57'),
(727, 'INV-7000726', '2013-04-23 10:37:57'),
(728, 'INV-7000727', '2013-04-23 10:37:57'),
(729, 'INV-7000728', '2013-04-23 10:37:57'),
(730, 'INV-7000729', '2013-04-23 10:37:58'),
(731, 'INV-7000730', '2013-04-23 10:37:58'),
(732, 'INV-7000731', '2013-04-23 10:37:58'),
(733, 'INV-7000732', '2013-04-23 10:38:09'),
(734, 'INV-7000733', '2013-04-23 10:38:10'),
(735, 'INV-7000734', '2013-04-23 10:38:10'),
(736, 'INV-7000735', '2013-04-23 10:38:10'),
(737, 'INV-7000736', '2013-04-23 10:38:10'),
(738, 'INV-7000737', '2013-04-23 10:38:11'),
(739, 'INV-7000738', '2013-04-23 10:38:11'),
(740, 'INV-7000739', '2013-04-23 10:38:11'),
(741, 'INV-7000740', '2013-04-23 10:38:11'),
(742, 'INV-7000741', '2013-04-23 10:38:12'),
(743, 'INV-7000742', '2013-04-23 10:38:12'),
(744, 'INV-7000743', '2013-04-23 10:38:12'),
(745, 'INV-7000744', '2013-04-23 10:38:12'),
(746, 'INV-7000745', '2013-04-23 10:38:13'),
(747, 'INV-7000746', '2013-04-23 10:38:13'),
(748, 'INV-7000747', '2013-04-23 10:38:13'),
(749, 'INV-7000748', '2013-04-23 10:38:13'),
(750, 'INV-7000749', '2013-04-23 10:38:14'),
(751, 'INV-7000750', '2013-04-23 10:38:14'),
(752, 'INV-7000751', '2013-04-23 10:38:14'),
(753, 'INV-7000752', '2013-04-23 10:38:14'),
(754, 'INV-7000753', '2013-04-23 10:38:15'),
(755, 'INV-7000754', '2013-04-23 10:38:15'),
(756, 'INV-7000755', '2013-04-23 10:38:15'),
(757, 'INV-7000756', '2013-04-23 10:38:15'),
(758, 'INV-7000757', '2013-04-23 10:38:16'),
(759, 'INV-7000758', '2013-04-23 10:38:16'),
(760, 'INV-7000759', '2013-04-23 10:38:16'),
(761, 'INV-7000760', '2013-04-23 10:38:16'),
(762, 'INV-7000761', '2013-04-23 10:38:17'),
(763, 'INV-7000762', '2013-04-23 10:38:17'),
(764, 'INV-7000763', '2013-04-23 10:38:17'),
(765, 'INV-7000764', '2013-04-23 10:38:17'),
(766, 'INV-7000765', '2013-04-23 10:38:18'),
(767, 'INV-7000766', '2013-04-23 10:38:18'),
(768, 'INV-7000767', '2013-04-23 10:38:18'),
(769, 'INV-7000768', '2013-04-23 10:38:18'),
(770, 'INV-7000769', '2013-04-23 10:38:19'),
(771, 'INV-7000770', '2013-04-23 10:38:19'),
(772, 'INV-7000771', '2013-04-23 10:38:19'),
(773, 'INV-7000772', '2013-04-23 10:38:19'),
(774, 'INV-7000773', '2013-04-23 10:38:20'),
(775, 'INV-7000774', '2013-04-23 10:38:20'),
(776, 'INV-7000775', '2013-04-23 10:38:21'),
(777, 'INV-7000776', '2013-04-23 10:38:21'),
(778, 'INV-7000777', '2013-04-23 10:38:21'),
(779, 'INV-7000778', '2013-04-23 10:38:21'),
(780, 'INV-7000779', '2013-04-23 10:38:21'),
(781, 'INV-7000780', '2013-04-23 10:38:22'),
(782, 'INV-7000781', '2013-04-23 10:38:22'),
(783, 'INV-7000782', '2013-04-23 10:38:23'),
(784, 'INV-7000783', '2013-04-23 10:38:23'),
(785, 'INV-7000784', '2013-04-23 10:38:23'),
(786, 'INV-7000785', '2013-04-23 10:38:23'),
(787, 'INV-7000786', '2013-04-23 10:38:24'),
(788, 'INV-7000787', '2013-04-23 10:38:24'),
(789, 'INV-7000788', '2013-04-23 10:38:24'),
(790, 'INV-7000789', '2013-04-23 10:38:24'),
(791, 'INV-7000790', '2013-04-23 10:38:25'),
(792, 'INV-7000791', '2013-04-23 10:38:25'),
(793, 'INV-7000792', '2013-04-23 10:38:25'),
(794, 'INV-7000793', '2013-04-23 10:38:25'),
(795, 'INV-7000794', '2013-04-23 10:38:26'),
(796, 'INV-7000795', '2013-04-23 10:38:26'),
(797, 'INV-7000796', '2013-04-23 10:38:26'),
(798, 'INV-7000797', '2013-04-23 10:38:26'),
(799, 'INV-7000798', '2013-04-23 10:38:27'),
(800, 'INV-7000799', '2013-04-23 10:38:27'),
(801, 'INV-7000800', '2013-04-23 10:38:27'),
(802, 'INV-7000801', '2013-04-23 10:38:27'),
(803, 'INV-7000802', '2013-04-23 10:38:28'),
(804, 'INV-7000803', '2013-04-23 10:38:28'),
(805, 'INV-7000804', '2013-04-23 10:38:28'),
(806, 'INV-7000805', '2013-04-23 10:38:28'),
(807, 'INV-7000806', '2013-04-23 10:38:28'),
(808, 'INV-7000807', '2013-04-23 10:38:29'),
(809, 'INV-7000808', '2013-04-23 10:38:29'),
(810, 'INV-7000809', '2013-04-23 10:38:29'),
(811, 'INV-7000810', '2013-04-23 10:38:29'),
(812, 'INV-7000811', '2013-04-23 10:38:30'),
(813, 'INV-7000812', '2013-04-23 10:38:30'),
(814, 'INV-7000813', '2013-04-23 10:38:30'),
(815, 'INV-7000814', '2013-04-23 10:44:03'),
(816, 'INV-7000815', '2013-04-23 10:44:04'),
(817, 'INV-7000816', '2013-04-23 10:44:04'),
(818, 'INV-7000817', '2013-04-23 10:44:04'),
(819, 'INV-7000818', '2013-04-23 10:44:04'),
(820, 'INV-7000819', '2013-04-23 10:44:05'),
(821, 'INV-7000820', '2013-04-23 10:44:05'),
(822, 'INV-7000821', '2013-04-23 10:44:05'),
(823, 'INV-7000822', '2013-04-23 10:44:05'),
(824, 'INV-7000823', '2013-04-23 10:44:05'),
(825, 'INV-7000824', '2013-04-23 10:44:06'),
(826, 'INV-7000825', '2013-04-23 10:44:06'),
(827, 'INV-7000826', '2013-04-23 10:44:06'),
(828, 'INV-7000827', '2013-04-23 10:44:06'),
(829, 'INV-7000828', '2013-04-23 10:44:07'),
(830, 'INV-7000829', '2013-04-23 10:44:07'),
(831, 'INV-7000830', '2013-04-23 10:44:07'),
(832, 'INV-7000831', '2013-04-23 10:44:07'),
(833, 'INV-7000832', '2013-04-23 10:44:08'),
(834, 'INV-7000833', '2013-04-23 10:44:08'),
(835, 'INV-7000834', '2013-04-23 10:44:08'),
(836, 'INV-7000835', '2013-04-23 10:44:08'),
(837, 'INV-7000836', '2013-04-23 10:44:09'),
(838, 'INV-7000837', '2013-04-23 10:44:09'),
(839, 'INV-7000838', '2013-04-23 10:44:09'),
(840, 'INV-7000839', '2013-04-23 10:44:10'),
(841, 'INV-7000840', '2013-04-23 10:44:10'),
(842, 'INV-7000841', '2013-04-23 10:44:10'),
(843, 'INV-7000842', '2013-04-23 10:44:10'),
(844, 'INV-7000843', '2013-04-23 10:44:10'),
(845, 'INV-7000844', '2013-04-23 10:44:11'),
(846, 'INV-7000845', '2013-04-23 10:44:11'),
(847, 'INV-7000846', '2013-04-23 10:44:11'),
(848, 'INV-7000847', '2013-04-23 10:44:11'),
(849, 'INV-7000848', '2013-04-23 10:44:12'),
(850, 'INV-7000849', '2013-04-23 10:44:12'),
(851, 'INV-7000850', '2013-04-23 10:44:12'),
(852, 'INV-7000851', '2013-04-23 10:44:12'),
(853, 'INV-7000852', '2013-04-23 10:44:13'),
(854, 'INV-7000853', '2013-04-23 10:44:13'),
(855, 'INV-7000854', '2013-04-23 10:44:13'),
(856, 'INV-7000855', '2013-04-23 10:55:07'),
(857, 'INV-7000856', '2013-04-23 10:56:12'),
(858, 'INV-7000857', '2013-04-23 10:59:27'),
(859, 'INV-7000858', '2013-04-23 10:59:27'),
(860, 'INV-7000859', '2013-04-23 10:59:28'),
(861, 'INV-7000860', '2013-04-23 10:59:28'),
(862, 'INV-7000861', '2013-04-23 10:59:28'),
(863, 'INV-7000862', '2013-04-23 10:59:29'),
(864, 'INV-7000863', '2013-04-23 10:59:29'),
(865, 'INV-7000864', '2013-04-23 10:59:29'),
(866, 'INV-7000865', '2013-04-23 10:59:30'),
(867, 'INV-7000866', '2013-04-23 10:59:30'),
(868, 'INV-7000867', '2013-04-23 10:59:30'),
(869, 'INV-7000868', '2013-04-23 10:59:30'),
(870, 'INV-7000869', '2013-04-23 10:59:31'),
(871, 'INV-7000870', '2013-04-23 10:59:31'),
(872, 'INV-7000871', '2013-04-23 10:59:31'),
(873, 'INV-7000872', '2013-04-23 10:59:31'),
(874, 'INV-7000873', '2013-04-23 10:59:32'),
(875, 'INV-7000874', '2013-04-23 10:59:32'),
(876, 'INV-7000875', '2013-04-23 10:59:32'),
(877, 'INV-7000876', '2013-04-23 10:59:32'),
(878, 'INV-7000877', '2013-04-23 10:59:33'),
(879, 'INV-7000878', '2013-04-23 10:59:33'),
(880, 'INV-7000879', '2013-04-23 10:59:33'),
(881, 'INV-7000880', '2013-04-23 10:59:33'),
(882, 'INV-7000881', '2013-04-23 10:59:34'),
(883, 'INV-7000882', '2013-04-23 10:59:34'),
(884, 'INV-7000883', '2013-04-23 11:00:06'),
(885, 'INV-7000884', '2013-04-23 11:00:06'),
(886, 'INV-7000885', '2013-04-23 11:00:06'),
(887, 'INV-7000886', '2013-04-23 11:00:06'),
(888, 'INV-7000887', '2013-04-23 11:00:07'),
(889, 'INV-7000888', '2013-04-23 11:00:07'),
(890, 'INV-7000889', '2013-04-23 11:00:07'),
(891, 'INV-7000890', '2013-04-23 11:00:07'),
(892, 'INV-7000891', '2013-04-23 11:00:08'),
(893, 'INV-7000892', '2013-04-23 11:00:08'),
(894, 'INV-7000893', '2013-04-23 11:00:08'),
(895, 'INV-7000894', '2013-04-23 11:00:08'),
(896, 'INV-7000895', '2013-04-23 11:00:09'),
(897, 'INV-7000896', '2013-04-23 11:00:09'),
(898, 'INV-7000897', '2013-04-23 11:00:09'),
(899, 'INV-7000898', '2013-04-23 11:00:09'),
(900, 'INV-7000899', '2013-04-23 11:00:10'),
(901, 'INV-7000900', '2013-04-23 11:00:10'),
(902, 'INV-7000901', '2013-04-23 11:00:10'),
(903, 'INV-7000902', '2013-04-23 11:00:10'),
(904, 'INV-7000903', '2013-04-23 11:00:11'),
(905, 'INV-7000904', '2013-04-23 11:00:11'),
(906, 'INV-7000905', '2013-04-23 11:00:11'),
(907, 'INV-7000906', '2013-04-23 11:00:11'),
(908, 'INV-7000907', '2013-04-23 11:00:12'),
(909, 'INV-7000908', '2013-04-23 11:00:12'),
(910, 'INV-7000909', '2013-04-23 11:00:12'),
(911, 'INV-7000910', '2013-04-23 11:00:12'),
(912, 'INV-7000911', '2013-04-23 11:00:13'),
(913, 'INV-7000912', '2013-04-23 11:00:13'),
(914, 'INV-7000913', '2013-04-23 11:00:13'),
(915, 'INV-7000914', '2013-04-23 11:00:13'),
(916, 'INV-7000915', '2013-04-23 11:00:14'),
(917, 'INV-7000916', '2013-04-23 11:00:14'),
(918, 'INV-7000917', '2013-04-23 11:00:14'),
(919, 'INV-7000918', '2013-04-23 11:00:15'),
(920, 'INV-7000919', '2013-04-23 11:00:15'),
(921, 'INV-7000920', '2013-04-23 11:00:16'),
(922, 'INV-7000921', '2013-04-23 11:00:16'),
(923, 'INV-7000922', '2013-04-23 11:00:17'),
(924, 'INV-7000923', '2013-04-23 11:00:17'),
(925, 'INV-7000924', '2013-04-23 11:00:17'),
(926, 'INV-7000925', '2013-04-23 11:00:18'),
(927, 'INV-7000926', '2013-04-23 11:00:18'),
(928, 'INV-7000927', '2013-04-23 11:00:18'),
(929, 'INV-7000928', '2013-04-23 11:00:18'),
(930, 'INV-7000929', '2013-04-23 11:00:19'),
(931, 'INV-7000930', '2013-04-23 11:00:19'),
(932, 'INV-7000931', '2013-04-23 11:00:19'),
(933, 'INV-7000932', '2013-04-23 11:00:19'),
(934, 'INV-7000933', '2013-04-23 11:00:20'),
(935, 'INV-7000934', '2013-04-23 11:00:20'),
(936, 'INV-7000935', '2013-04-23 11:00:20'),
(937, 'INV-7000936', '2013-04-23 11:00:20'),
(938, 'INV-7000937', '2013-04-23 11:00:21'),
(939, 'INV-7000938', '2013-04-23 11:00:21'),
(940, 'INV-7000939', '2013-04-23 11:00:21'),
(941, 'INV-7000940', '2013-04-23 11:00:22'),
(942, 'INV-7000941', '2013-04-23 11:00:22'),
(943, 'INV-7000942', '2013-04-23 11:00:22'),
(944, 'INV-7000943', '2013-04-23 11:00:22'),
(945, 'INV-7000944', '2013-04-23 11:00:23'),
(946, 'INV-7000945', '2013-04-23 11:00:23'),
(947, 'INV-7000946', '2013-04-23 11:00:23'),
(948, 'INV-7000947', '2013-04-23 11:00:24'),
(949, 'INV-7000948', '2013-04-23 11:00:24'),
(950, 'INV-7000949', '2013-04-23 11:00:24'),
(951, 'INV-7000950', '2013-04-23 11:00:24'),
(952, 'INV-7000951', '2013-04-23 11:00:25'),
(953, 'INV-7000952', '2013-04-23 11:00:25'),
(954, 'INV-7000953', '2013-04-23 11:00:25'),
(955, 'INV-7000954', '2013-04-23 11:00:25'),
(956, 'INV-7000955', '2013-04-23 11:00:25'),
(957, 'INV-7000956', '2013-04-23 11:00:26'),
(958, 'INV-7000957', '2013-04-23 11:00:26'),
(959, 'INV-7000958', '2013-04-23 11:00:26'),
(960, 'INV-7000959', '2013-04-23 11:00:26'),
(961, 'INV-7000960', '2013-04-23 11:00:37'),
(962, 'INV-7000961', '2013-04-23 11:00:37'),
(963, 'INV-7000962', '2013-04-23 11:00:38'),
(964, 'INV-7000963', '2013-04-23 11:00:38'),
(965, 'INV-7000964', '2013-04-23 11:00:39'),
(966, 'INV-7000965', '2013-04-23 11:00:39'),
(967, 'INV-7000966', '2013-04-23 11:00:39'),
(968, 'INV-7000967', '2013-04-23 11:00:39'),
(969, 'INV-7000968', '2013-04-23 11:00:40'),
(970, 'INV-7000969', '2013-04-23 11:00:40'),
(971, 'INV-7000970', '2013-04-23 11:00:40'),
(972, 'INV-7000971', '2013-04-23 11:00:40'),
(973, 'INV-7000972', '2013-04-23 11:00:41'),
(974, 'INV-7000973', '2013-04-23 11:00:41'),
(975, 'INV-7000974', '2013-04-23 11:00:41'),
(976, 'INV-7000975', '2013-04-23 11:00:41'),
(977, 'INV-7000976', '2013-04-23 11:00:42'),
(978, 'INV-7000977', '2013-04-23 11:00:42'),
(979, 'INV-7000978', '2013-04-23 11:00:42'),
(980, 'INV-7000979', '2013-04-23 11:00:42'),
(981, 'INV-7000980', '2013-04-23 11:00:43'),
(982, 'INV-7000981', '2013-04-23 11:00:43'),
(983, 'INV-7000982', '2013-04-23 11:00:43'),
(984, 'INV-7000983', '2013-04-23 11:00:43'),
(985, 'INV-7000984', '2013-04-23 11:00:44'),
(986, 'INV-7000985', '2013-04-23 11:00:44'),
(987, 'INV-7000986', '2013-04-23 11:00:44'),
(988, 'INV-7000987', '2013-04-23 11:00:45'),
(989, 'INV-7000988', '2013-04-23 11:00:45'),
(990, 'INV-7000989', '2013-04-23 11:00:45'),
(991, 'INV-7000990', '2013-04-23 11:00:45'),
(992, 'INV-7000991', '2013-04-23 11:00:46'),
(993, 'INV-7000992', '2013-04-23 11:00:46'),
(994, 'INV-7000993', '2013-04-23 11:00:46'),
(995, 'INV-7000994', '2013-04-23 11:00:46'),
(996, 'INV-7000995', '2013-04-23 11:00:47'),
(997, 'INV-7000996', '2013-04-23 11:00:47'),
(998, 'INV-7000997', '2013-04-23 11:00:47'),
(999, 'INV-7000998', '2013-04-23 11:00:47'),
(1000, 'INV-7000999', '2013-04-23 11:00:48'),
(1001, 'INV-70001000', '2013-04-23 11:00:48'),
(1002, 'INV-70001001', '2013-04-23 11:00:49'),
(1003, 'INV-70001002', '2013-04-23 11:00:49'),
(1004, 'INV-70001003', '2013-04-23 11:00:50'),
(1005, 'INV-70001004', '2013-04-23 11:00:50'),
(1006, 'INV-70001005', '2013-04-23 11:00:50'),
(1007, 'INV-70001006', '2013-04-23 11:00:51'),
(1008, 'INV-70001007', '2013-04-23 11:00:51'),
(1009, 'INV-70001008', '2013-04-23 11:00:51'),
(1010, 'INV-70001009', '2013-04-23 11:00:51'),
(1011, 'INV-70001010', '2013-04-23 11:00:52'),
(1012, 'INV-70001011', '2013-04-23 11:00:52'),
(1013, 'INV-70001012', '2013-04-23 11:00:52'),
(1014, 'INV-70001013', '2013-04-23 11:00:52'),
(1015, 'INV-70001014', '2013-04-23 11:00:53'),
(1016, 'INV-70001015', '2013-04-23 11:00:53'),
(1017, 'INV-70001016', '2013-04-23 11:00:53'),
(1018, 'INV-70001017', '2013-04-23 11:00:54'),
(1019, 'INV-70001018', '2013-04-23 11:00:54'),
(1020, 'INV-70001019', '2013-04-23 11:00:54'),
(1021, 'INV-70001020', '2013-04-23 11:00:55'),
(1022, 'INV-70001021', '2013-04-23 11:00:55'),
(1023, 'INV-70001022', '2013-04-23 11:00:55'),
(1024, 'INV-70001023', '2013-04-23 11:00:55'),
(1025, 'INV-70001024', '2013-04-23 11:00:56'),
(1026, 'INV-70001025', '2013-04-23 11:00:56'),
(1027, 'INV-70001026', '2013-04-23 11:00:56'),
(1028, 'INV-70001027', '2013-04-23 11:00:56'),
(1029, 'INV-70001028', '2013-04-23 11:00:57'),
(1030, 'INV-70001029', '2013-04-23 11:00:57'),
(1031, 'INV-70001030', '2013-04-23 11:00:58'),
(1032, 'INV-70001031', '2013-04-23 11:00:58'),
(1033, 'INV-70001032', '2013-04-23 11:00:58'),
(1034, 'INV-70001033', '2013-04-23 11:00:59'),
(1035, 'INV-70001034', '2013-04-23 11:00:59'),
(1036, 'INV-70001035', '2013-04-23 11:00:59'),
(1037, 'INV-70001036', '2013-04-23 11:01:00'),
(1038, 'INV-70001037', '2013-04-23 11:01:00'),
(1039, 'INV-70001038', '2013-04-23 11:01:01'),
(1040, 'INV-70001039', '2013-04-23 11:01:01'),
(1041, 'INV-70001040', '2013-04-23 11:01:02'),
(1042, 'INV-70001041', '2013-04-23 11:01:02'),
(1043, 'INV-70001042', '2013-04-23 11:02:22'),
(1044, 'INV-70001043', '2013-04-23 11:02:22'),
(1045, 'INV-70001044', '2013-04-23 11:02:22'),
(1046, 'INV-70001045', '2013-04-23 11:02:22'),
(1047, 'INV-70001046', '2013-04-23 11:02:23'),
(1048, 'INV-70001047', '2013-04-23 11:02:23'),
(1049, 'INV-70001048', '2013-04-23 11:02:24'),
(1050, 'INV-70001049', '2013-04-23 11:02:24'),
(1051, 'INV-70001050', '2013-04-23 11:02:24'),
(1052, 'INV-70001051', '2013-04-23 11:02:24'),
(1053, 'INV-70001052', '2013-04-23 11:02:25'),
(1054, 'INV-70001053', '2013-04-23 11:02:25'),
(1055, 'INV-70001054', '2013-04-23 11:02:25'),
(1056, 'INV-70001055', '2013-04-23 11:02:25'),
(1057, 'INV-70001056', '2013-04-23 11:02:26'),
(1058, 'INV-70001057', '2013-04-23 11:02:26'),
(1059, 'INV-70001058', '2013-04-23 11:02:27'),
(1060, 'INV-70001059', '2013-04-23 11:02:27'),
(1061, 'INV-70001060', '2013-04-23 11:02:28'),
(1062, 'INV-70001061', '2013-04-23 11:02:28'),
(1063, 'INV-70001062', '2013-04-23 11:02:28'),
(1064, 'INV-70001063', '2013-04-23 11:02:28'),
(1065, 'INV-70001064', '2013-04-23 11:02:29'),
(1066, 'INV-70001065', '2013-04-23 11:02:29'),
(1067, 'INV-70001066', '2013-04-23 11:02:29'),
(1068, 'INV-70001067', '2013-04-23 11:02:29'),
(1069, 'INV-70001068', '2013-04-23 18:28:14'),
(1070, 'INV-70001069', '2013-05-21 13:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `landlords`
--

CREATE TABLE IF NOT EXISTS `landlords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_name_first` varchar(60) NOT NULL,
  `l_name_last` varchar(60) NOT NULL,
  `l_email` varchar(150) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `landlords_b_id` int(11) NOT NULL,
  `l_type` varchar(120) NOT NULL,
  `group` int(200) NOT NULL,
  `pic_path` varchar(140) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `landlords`
--

INSERT INTO `landlords` (`id`, `l_name_first`, `l_name_last`, `l_email`, `telephone`, `landlords_b_id`, `l_type`, `group`, `pic_path`, `pass`) VALUES
(4, 'Jane Masika', '', 'jmasika@cms.com', '07788888888', 0, '', 0, 'uploads/landlords/landlord_4.jpg', 'cleave'),
(5, 'Kato Sam', '', 'kato@cms.com', '0782123123', 0, '', 0, '', 'Hey'),
(6, 'Musa Menk', '', 'menk@cms.com', '0723901212', 0, '', 0, '', 'menk');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_bid` int(11) NOT NULL,
  `m_fid` int(11) NOT NULL,
  `m_rmid` int(11) NOT NULL,
  `m_msg` text NOT NULL,
  `m_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_sms` tinyint(1) NOT NULL DEFAULT '1',
  `m_email` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `notes_id` int(10) NOT NULL AUTO_INCREMENT,
  `notes_b_id` int(12) NOT NULL,
  `notes_floor_id` int(20) NOT NULL,
  `note_room_id` int(20) NOT NULL,
  `notes_tenant_id` varchar(10) NOT NULL,
  `notes_description` varchar(300) NOT NULL,
  `notes_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subject` varchar(50) NOT NULL DEFAULT 'none',
  `added_by` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_rm_id` int(11) NOT NULL,
  `pay_particulars` varchar(140) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_ten_id` int(11) NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `pay_type` enum('CHEQUE','CASH','BANK') NOT NULL DEFAULT 'BANK',
  `pay_slip_no` varchar(140) NOT NULL,
  `pay_chq_no` varchar(140) NOT NULL,
  `pay_currency` enum('USD','UGX') NOT NULL DEFAULT 'UGX',
  `pay_from` varchar(140) NOT NULL,
  `pay_month` varchar(10) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rebill`
--

CREATE TABLE IF NOT EXISTS `rebill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` int(30) NOT NULL,
  `reason` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `rc_id` int(11) NOT NULL AUTO_INCREMENT,
  `rc_num` varchar(40) NOT NULL,
  `rc_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`rc_id`, `rc_num`, `rc_date`) VALUES
(1, 'RC-30000', '2013-05-21 13:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `receit_no` int(20) NOT NULL AUTO_INCREMENT,
  `confirmed` tinyint(1) NOT NULL DEFAULT '1',
  `records_rm_id` int(11) NOT NULL,
  `tenant_id` int(20) NOT NULL,
  `d_receipt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `d_payment` date NOT NULL,
  `pay_amount` float NOT NULL,
  `pay_amount_shs` float NOT NULL,
  `bill_amount` float NOT NULL,
  `particulars` varchar(140) NOT NULL,
  `x_rate` float NOT NULL,
  `mode` varchar(20) NOT NULL,
  `payer` varchar(120) NOT NULL,
  `cheque` varchar(30) NOT NULL,
  `slip` varchar(20) NOT NULL,
  `meter_r` bigint(20) NOT NULL,
  `units` bigint(20) NOT NULL,
  `pay_month` varchar(12) NOT NULL,
  `pay_year` int(11) NOT NULL,
  `re_bal` float NOT NULL,
  `vat` float NOT NULL,
  `rec_num` varchar(140) NOT NULL,
  `TT` varchar(40) NOT NULL,
  `old_bal` float NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`receit_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`receit_no`, `confirmed`, `records_rm_id`, `tenant_id`, `d_receipt`, `d_payment`, `pay_amount`, `pay_amount_shs`, `bill_amount`, `particulars`, `x_rate`, `mode`, `payer`, `cheque`, `slip`, `meter_r`, `units`, `pay_month`, `pay_year`, `re_bal`, `vat`, `rec_num`, `TT`, `old_bal`, `isdeleted`) VALUES
(166, 1, 9, 16, '2013-04-23 09:06:37', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 700, 10, 'April', 2013, 413000, 0, 'INV-7000446', '', 407100, 0),
(165, 1, 46, 0, '2013-04-23 08:21:19', '2013-04-23', 0, 0, 433, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(164, 1, 45, 40, '2013-04-23 08:07:48', '2013-04-23', 230, 609500, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, 103, 0, 'RC-300078', '', 333, 0),
(163, 1, 43, 38, '2013-04-23 05:18:27', '2013-04-23', 0, 0, 333, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, -1577, 0, 'INV-7000362', '', -1910, 0),
(162, 1, 43, 38, '2013-04-23 05:15:19', '2013-04-23', 0, 0, 333, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, -1910, 0, 'INV-7000328', '', -2243, 0),
(161, 1, 47, 0, '2013-04-23 05:11:47', '2013-04-23', 0, 0, 344, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(160, 1, 46, 0, '2013-04-23 05:11:46', '2013-04-23', 0, 0, 433, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(148, 1, 36, 36, '2013-04-23 10:56:13', '2013-04-23', 0, 0, 3000, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 3000, 0, 'INV-7000856', '', 0, 0),
(149, 1, 40, 29, '2013-04-22 12:09:33', '2013-04-22', 0, 0, 234, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(150, 1, 41, 30, '2013-04-22 12:09:34', '2013-04-22', 0, 0, 1233, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(151, 1, 42, 31, '2013-04-22 12:09:34', '2013-04-22', 0, 0, 234, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(152, 1, 37, 37, '2013-04-22 18:45:25', '2013-04-22', 0, 0, 499, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 142, 0, 'INV-7000151', '', -17, 0),
(153, 1, 10, 8, '2013-04-22 18:52:42', '2013-04-22', 0, 0, 1500, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, -1844, 0, 'INV-7000152', '', 256, 0),
(154, 1, 37, 37, '2013-04-22 18:53:14', '2013-04-22', 0, 0, 499, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 142, 0, 'INV-7000153', '', 142, 0),
(155, 1, 43, 38, '2013-04-23 05:10:42', '2013-04-23', 0, 0, 333, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 333, 0, 'INV-7000253', '', 0, 0),
(156, 1, 43, 38, '2013-04-23 05:10:42', '2013-04-23', 2344, 6211600, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, -2011, 0, 'RC-300076', '', 333, 0),
(157, 1, 43, 38, '2013-04-23 05:11:07', '2013-04-23', 232, 0, 0, 'Rent', 0, 'Cash', 'tbrthb', '', '', 0, 0, 'April', 2013, -2243, 0, 'RC-300077', '', -2011, 0),
(158, 1, 44, 39, '2013-04-23 05:11:45', '2013-04-23', 0, 0, 233, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(159, 1, 45, 40, '2013-04-23 08:07:48', '2013-04-23', 0, 0, 333, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 333, 0, 'INV-7000404', '', 0, 0),
(147, 1, 35, 35, '2013-04-23 10:55:08', '2013-04-23', 0, 0, 200, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 200, 0, 'INV-7000855', '', 0, 0),
(146, 1, 33, 33, '2013-04-22 12:09:31', '2013-04-22', 0, 0, 234, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(145, 1, 32, 32, '2013-04-22 12:09:30', '2013-04-22', 0, 0, 450, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(144, 1, 31, 28, '2013-04-22 12:09:29', '2013-04-22', 0, 0, 222, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(143, 1, 30, 27, '2013-04-22 12:09:29', '2013-04-22', 0, 0, 222, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(142, 1, 29, 26, '2013-04-22 12:09:28', '2013-04-22', 0, 0, 2323, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(141, 1, 28, 25, '2013-04-22 12:09:28', '2013-04-22', 0, 0, 121, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(140, 1, 27, 24, '2013-04-22 12:09:27', '2013-04-22', 0, 0, 123, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(139, 1, 26, 23, '2013-04-22 12:09:27', '2013-04-22', 0, 0, 220, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(138, 1, 25, 22, '2013-04-22 12:09:26', '2013-04-22', 0, 0, 232, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(125, 1, 10, 8, '2013-04-22 12:04:49', '2013-04-22', 0, 0, 3500, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 156, 0, 'INV-700050', '', 156, 0),
(126, 1, 10, 8, '2013-04-22 12:06:36', '2013-04-22', 0, 0, 3600, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 256, 0, 'INV-700051', '', 156, 0),
(127, 1, 11, 10, '2013-04-22 12:09:20', '2013-04-22', 0, 0, 2500, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 3816, 0, 'INV-700055', '', 1316, 0),
(128, 1, 11, 10, '2013-04-22 12:09:21', '2013-04-22', 0, 0, 2500, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 3816, 0, 'INV-700056', '', 1316, 0),
(129, 1, 12, 11, '2013-04-22 12:09:21', '2013-04-22', 0, 0, 2000, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 2000, 0, 'INV-700057', '', 0, 0),
(130, 1, 12, 11, '2013-04-22 12:09:22', '2013-04-22', 0, 0, 2000, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 2000, 0, 'INV-700058', '', 0, 0),
(131, 1, 13, 12, '2013-04-22 12:09:22', '2013-04-22', 0, 0, 2000, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 2000, 0, 'INV-700059', '', 0, 0),
(132, 1, 14, 9, '2013-04-22 12:09:23', '2013-04-22', 0, 0, 2000, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(133, 1, 15, 13, '2013-04-22 12:09:23', '2013-04-22', 0, 0, 2000, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(134, 1, 16, 15, '2013-04-22 12:09:24', '2013-04-22', 0, 0, 2000, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(135, 1, 22, 19, '2013-04-22 12:09:24', '2013-04-22', 0, 0, 500, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(136, 1, 23, 20, '2013-04-22 12:09:25', '2013-04-22', 0, 0, 600, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(137, 1, 24, 21, '2013-04-22 12:09:25', '2013-04-22', 0, 0, 300, 'RENT_BILL_VACANT', 0, '', '', '', '', 0, 0, 'April', 2013, 0, 0, '', '', 0, 0),
(88, 1, 9, 16, '2013-04-18 18:17:00', '2013-04-18', 7.36, 23000, 0, 'Rent', 2650, 'Cash', 'errg', '', '', 0, 0, 'April', 2013, -491.36, 1.32, 'RC-300057', '', -484, 0),
(89, 1, 10, 8, '2013-04-18 18:31:19', '2013-04-18', 200, 0, 0, 'Balance Adjustment', 0, '', '', '', '', 0, 0, '', 0, -200, 0, '', '', -200, 0),
(90, 1, 9, 16, '2013-04-18 20:16:58', '2013-04-18', 338983, 0, 0, 'Rent', 0, 'Cash', 'uytjyhv', '', '', 0, 0, 'April', 2013, -339474, 61016.9, 'RC-300058', '', -491, 0),
(91, 1, 9, 16, '2013-04-18 19:55:08', '2013-04-18', 73.55, 230000, 0, 'Rent', 2650, 'Cash', 'xgd', '', '', 0, 0, 'April', 2013, -339548, 13.24, 'RC-300059', '', -339474, 0),
(92, 1, 9, 16, '2013-04-18 20:17:28', '2013-04-18', 249.44, 780000, 0, 'Rent', 2650, 'Cash', 'iunoiu', '', '', 0, 0, 'April', 2013, -339796, 44.9, 'RC-300060', '', -339547, 0),
(93, 1, 9, 16, '2013-04-18 20:18:43', '2013-04-18', 508.47, 1590000, 0, 'Rent', 0, 'Cash', 'kjnijl', '', '', 0, 0, 'April', 2013, -340304, 91.53, 'RC-300061', '', -339796, 0),
(94, 1, 9, 16, '2013-04-18 20:23:17', '2013-04-18', 0.13, 344, 0, 'Rent', 2650, 'Cash', 'uio', '', '', 0, 0, 'April', 2013, -340304, 0, 'RC-300062', '', -340304, 0),
(95, 1, 9, 16, '2013-04-18 20:23:52', '2013-04-18', 34000, 0, 0, 'Rent', 0, 'Cash', '8987', '', '', 0, 0, 'April', 2013, -374304, 0, 'RC-300063', '', -340304, 0),
(96, 1, 10, 8, '2013-04-22 11:53:40', '2013-04-19', 0, 0, 3500, 'RENT_BILL_OCCUPIED_X', 0, '', '', '', '', 0, 0, 'April', 2013, 3500, 0, 'INV-700039', '', -200, 0),
(97, 1, 10, 8, '2013-04-19 02:00:51', '2013-04-19', 2000, 5300000, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, 1300, 0, 'RC-300064', '', 3300, 0),
(98, 1, 10, 8, '2013-04-19 02:03:41', '2013-04-19', 455, 0, 0, 'Rent', 0, 'Cash', 'tryty', '', '', 0, 0, 'April', 2013, 845, 0, 'RC-300065', '', 1300, 0),
(99, 1, 10, 8, '2013-04-19 02:15:28', '2013-04-19', 455, 0, 0, 'Rent', 0, 'Cash', 'hhngh', '', '', 0, 0, 'April', 2013, 390, 0, 'RC-300066', '', 845, 0),
(100, 1, 10, 8, '2013-04-19 02:30:18', '2013-04-19', 234, 0, 0, 'Rent', 0, 'Cash', 'fgfgf', '', '', 0, 0, 'April', 2013, 156, 0, 'RC-300067', '', 390, 0),
(101, 1, 34, 34, '2013-04-19 02:52:25', '2013-04-19', 0, 0, 123, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 123, 0, 'INV-700040', '', 0, 0),
(102, 1, 34, 34, '2013-04-19 02:52:26', '2013-04-19', 1200, 3180000, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, -1077, 0, 'RC-300068', '', 123, 0),
(103, 1, 34, 34, '2013-04-19 03:02:33', '2013-04-19', 127.91, 400000, 0, 'Rent', 2650, 'Cash', 'ygyj', '', '', 0, 0, 'April', 2013, -1204.91, 23.03, 'RC-300069', '', -1077, 0),
(104, 1, 28, 25, '2013-04-19 03:04:26', '2013-04-19', 0, 0, 400, 'Balance Adjustment', 0, '', '', '', '', 0, 0, '', 0, 400, 0, '', '', 0, 0),
(105, 1, 34, 34, '2013-04-21 22:12:12', '2013-04-21', 500, 0, 0, 'Rent', 0, 'Cheque', 'yjtdyjd', '1234', '', 0, 0, 'April', 2013, -1704, 0, 'RC-300070', '', -1204, 1),
(106, 1, 34, 34, '2013-04-21 22:12:12', '2013-04-21', 0, 0, 500, 'BOUNCED CHEQUE', 0, '', '', '1234', '', 0, 0, 'April', 2013, -1204, 0, 'INV-700041', '', -1704, 0),
(107, 1, 34, 34, '2013-04-21 22:12:12', '2013-04-21', 0, 0, 340, 'BOUNCED CHEQUE PENALTY', 0, '', '', '1234', '', 0, 0, 'April', 2013, -1204, 0, 'INV-700041', '', -1204, 0),
(108, 1, 34, 34, '2013-04-21 22:14:46', '2013-04-22', 600, 0, 0, 'Rent', 0, 'Cheque', 'jfygyjh', '6757657', '', 0, 0, 'April', 2013, -1464, 0, 'RC-300071', '', -864, 1),
(109, 1, 34, 34, '2013-04-21 22:14:45', '2013-04-21', 0, 0, 600, 'BOUNCED CHEQUE', 0, '', '', '6757657', '', 0, 0, 'April', 2013, -864, 0, 'INV-700042', '', -1464, 0),
(110, 1, 34, 34, '2013-04-21 22:14:46', '2013-04-21', 0, 0, 600, 'BOUNCED CHEQUE PENALTY', 0, '', '', '6757657', '', 0, 0, 'April', 2013, -864, 0, 'INV-700042', '', -864, 0),
(111, 1, 37, 37, '2013-04-22 18:45:25', '2013-04-22', 0, 0, 340, 'RENT_BILL_OCCUPIED_X', 0, '', '', '', '', 0, 0, 'April', 2013, 340, 0, 'INV-700043', '', 0, 0),
(112, 1, 37, 37, '2013-04-22 11:13:29', '2013-04-22', 230, 609500, 0, 'Down Payment', 0, 'Cheque', '', 'gy7779', '', 0, 0, 'April', 2013, 110, 0, 'RC-300072', '', 340, 1),
(113, 1, 37, 37, '2013-04-22 11:13:28', '2013-04-22', 0, 0, 230, 'BOUNCED CHEQUE', 0, '', '', 'gy7779', '', 0, 0, 'April', 2013, 340, 0, 'INV-700044', '', 110, 0),
(114, 1, 37, 37, '2013-04-22 11:13:28', '2013-04-22', 0, 0, 30, 'BOUNCED CHEQUE PENALTY', 0, '', '', 'gy7779', '', 0, 0, 'April', 2013, 340, 0, 'INV-700044', '', 340, 0),
(115, 1, 37, 37, '2013-04-22 11:15:46', '2013-04-22', 233, 0, 0, 'Rent', 0, 'Cheque', 'rtgtg', 'er4545', '', 0, 0, 'April', 2013, 137, 0, 'RC-300073', '', 370, 1),
(116, 1, 37, 37, '2013-04-22 11:15:45', '2013-04-22', 0, 0, 233, 'BOUNCED CHEQUE', 0, '', '', 'er4545', '', 0, 0, 'April', 2013, 370, 0, 'INV-700045', '', 137, 0),
(117, 1, 37, 37, '2013-04-22 11:15:46', '2013-04-22', 0, 0, 23, 'BOUNCED CHEQUE PENALTY', 0, '', '', 'er4545', '', 0, 0, 'April', 2013, 370, 0, 'INV-700045', '', 370, 0),
(118, 1, 37, 37, '2013-04-22 11:19:09', '2013-04-22', 455, 0, 0, 'Rent', 0, 'Cheque', 'rtrt', '33433', '', 0, 0, 'April', 2013, -62, 0, 'RC-300074', '', 393, 1),
(119, 1, 37, 37, '2013-04-22 11:18:18', '2013-04-22', 455, 0, 0, 'Rent', 0, 'Cheque', 'thth', '45454', '', 0, 0, 'April', 2013, -517, 0, 'RC-300075', '', -62, 0),
(120, 1, 37, 37, '2013-04-22 11:19:08', '2013-04-22', 0, 0, 455, 'BOUNCED CHEQUE', 0, '', '', '33433', '', 0, 0, 'April', 2013, -62, 0, 'INV-700046', '', -517, 0),
(121, 1, 37, 37, '2013-04-22 11:19:09', '2013-04-22', 0, 0, 45, 'BOUNCED CHEQUE PENALTY', 0, '', '', '33433', '', 0, 0, 'April', 2013, -62, 0, 'INV-700046', '', -62, 0),
(122, 1, 10, 8, '2013-04-22 11:53:40', '2013-04-22', 0, 0, 3600, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 256, 0, 'INV-700047', '', 156, 0),
(123, 1, 10, 8, '2013-04-22 11:55:38', '2013-04-22', 0, 0, 3700, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 356, 0, 'INV-700048', '', 256, 0),
(124, 1, 10, 8, '2013-04-22 12:02:07', '2013-04-22', 0, 0, 3500, 'RENT_RE-BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 156, 0, 'INV-700049', '', 356, 0),
(167, 1, 9, 16, '2013-04-23 09:16:08', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 710, 10, 'April', 2013, 418900, 0, 'INV-7000447', '', 413000, 0),
(168, 1, 9, 16, '2013-04-23 09:20:44', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 720, 10, 'April', 2013, 424800, 0, 'INV-7000448', '', 418900, 0),
(169, 1, 9, 16, '2013-04-23 09:21:49', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 730, 10, 'April', 2013, 430700, 0, 'INV-7000449', '', 424800, 0),
(170, 1, 9, 16, '2013-04-23 09:23:20', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 740, 10, 'April', 2013, 436600, 0, 'INV-7000450', '', 430700, 0),
(171, 1, 9, 16, '2013-04-23 09:25:58', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 750, 10, 'April', 2013, 442500, 0, 'INV-7000451', '', 436600, 0),
(172, 1, 10, 8, '2013-04-23 09:28:06', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 990, 10, 'April', 2013, 5900, 0, 'INV-7000452', '', 0, 0),
(173, 1, 11, 10, '2013-04-23 09:33:08', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 10, 10, 'April', 2013, 5900, 0, 'INV-7000453', '', 0, 0),
(174, 1, 11, 10, '2013-04-23 09:34:20', '2013-04-23', 0, 0, 1180, 'UMEME_BILL', 0, '', '', '', '', 12, 2, 'April', 2013, 7080, 0, 'INV-7000454', '', 5900, 0),
(175, 1, 10, 8, '2013-04-23 09:44:49', '2013-04-23', 0, 0, 5900, 'UMEME_BILL', 0, '', '', '', '', 1000, 10, 'April', 2013, 11800, 0, 'INV-7000455', '', 5900, 0),
(176, 1, 10, 8, '2013-04-23 09:45:37', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1100, 100, 'April', 2013, 70800, 0, 'INV-7000456', '', 11800, 0),
(177, 1, 10, 8, '2013-04-23 09:46:45', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1200, 100, 'April', 2013, 129800, 0, 'INV-7000457', '', 70800, 0),
(178, 1, 10, 8, '2013-04-23 09:52:39', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1300, 100, 'April', 2013, 188800, 0, 'INV-7000458', '', 129800, 0),
(179, 1, 10, 8, '2013-04-23 09:54:11', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1400, 100, 'April', 2013, 247800, 0, 'INV-7000459', '', 188800, 0),
(180, 1, 10, 8, '2013-04-23 09:55:30', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1500, 100, 'April', 2013, 306800, 0, 'INV-7000460', '', 247800, 0),
(181, 1, 10, 8, '2013-04-23 09:56:17', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1600, 100, 'April', 2013, 365800, 0, 'INV-7000461', '', 306800, 0),
(182, 1, 10, 8, '2013-04-23 09:58:50', '2013-04-23', 0, 0, 59000, 'UMEME_BILL', 0, '', '', '', '', 1700, 100, 'April', 2013, 424800, 0, 'INV-7000462', '', 365800, 0),
(183, 1, 13, 12, '2013-04-23 10:24:03', '2013-04-23', 0, 0, 2000, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 4000, 0, 'INV-7000552', '', 2000, 0),
(184, 1, 45, 40, '2013-04-23 10:27:45', '2013-04-23', 0, 0, 333, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 436, 0, 'INV-7000621', '', 103, 0),
(185, 1, 37, 37, '2013-04-23 10:37:59', '2013-04-23', 0, 0, 499, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 641, 0, 'INV-7000731', '', 142, 0),
(186, 1, 35, 35, '2013-04-23 10:55:08', '2013-04-23', 1200, 3180000, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, -1000, 0, 'RC-300079', '', 200, 0),
(187, 1, 36, 36, '2013-04-23 10:56:13', '2013-04-23', 2000, 5300000, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, 1000, 0, 'RC-300081', '', 3000, 0),
(188, 1, 35, 35, '2013-04-23 10:59:34', '2013-04-23', 0, 0, 200, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, -800, 0, 'INV-7000882', '', -1000, 0),
(189, 1, 45, 40, '2013-04-23 11:00:15', '2013-04-23', 0, 0, 333, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 769, 0, 'INV-7000918', '', 436, 0),
(190, 1, 35, 35, '2013-04-23 11:02:30', '2013-04-23', 0, 0, 200, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, -600, 0, 'INV-70001067', '', -800, 0),
(191, 1, 13, 12, '2013-04-23 11:12:16', '2013-04-23', 1, 0, 0, 'INSTALLMENT', 0, '', '', '', '', 0, 0, '', 0, 0, 0, 'RC-300082', '', 0, 0),
(192, 1, 13, 12, '2013-04-23 11:32:34', '0000-00-00', 999, 0, 0, 'INSTALLMENT', 0, '', '', '', '', 0, 0, '', 0, 0, 0, 'RC-300083', '', 0, 0),
(193, 1, 13, 12, '2013-04-23 11:34:11', '0000-00-00', 1000, 0, 0, 'INSTALLMENT', 0, '', '', '', '', 0, 0, '', 0, 0, 0, 'RC-300084', '', 0, 0),
(194, 1, 13, 12, '2013-04-23 11:36:51', '0000-00-00', 1000, 0, 0, 'INSTALLMENT', 0, '', '', '', '', 0, 0, '', 0, 0, 0, 'RC-300086', '', 0, 0),
(195, 1, 51, 41, '2013-04-23 18:28:14', '2013-04-23', 0, 0, 500, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'April', 2013, 500, 0, 'INV-70001068', '', 0, 0),
(196, 1, 51, 41, '2013-04-23 18:28:14', '2013-04-23', 1500, 3975000, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'April', 2013, -1000, 0, 'RC-300089', '', 500, 0),
(197, 1, 51, 41, '2013-04-23 18:28:51', '2013-04-23', 508.47, 0, 0, 'Rent', 0, 'Cash', 'Fred', '', '', 0, 0, 'May', 2013, -1508.47, 91.53, 'RC-300090', '', -1000, 0),
(198, 1, 51, 41, '2013-04-23 18:29:49', '2013-04-23', 639.59, 2000000, 0, 'Rent', 2650, 'Cash', 'Fred', '', '', 0, 0, 'June', 2013, -2147.59, 115.13, 'RC-300091', '', -1508, 0),
(199, 1, 1, 1, '2013-05-21 13:51:17', '2013-05-21', 0, 0, 120000, 'RENT_BILL_OCCUPIED', 0, '', '', '', '', 0, 0, 'May', 2013, 120000, 0, 'INV-70001069', '', 0, 0),
(200, 1, 1, 1, '2013-05-21 13:51:18', '2013-05-21', 200000, 530000000, 0, 'Down Payment', 0, 'Cash', '', '', '', 0, 0, 'May', 2013, -80000, 0, 'RC-30000', '', 120000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `rm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_num` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `description` text NOT NULL,
  `rooms_b_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `rm_status` enum('VACANT','OCCUPIED','PENDING') NOT NULL DEFAULT 'VACANT',
  `room_name` varchar(150) NOT NULL,
  `rm_cost` bigint(20) NOT NULL,
  `debit` bigint(20) NOT NULL,
  `credit` bigint(20) NOT NULL,
  `debit_umeme` float NOT NULL,
  `credit_umeme` float NOT NULL,
  `d_payment` int(11) NOT NULL,
  `meter_reading` bigint(20) NOT NULL,
  `bill_date` varchar(20) NOT NULL,
  `rm_s_date` date NOT NULL,
  `rm_h_date` date NOT NULL,
  `rm_deposit` int(11) NOT NULL,
  `rm_purpose` varchar(140) NOT NULL,
  `um_bill_date` date NOT NULL,
  `rm_size` varchar(40) NOT NULL DEFAULT '(size) undeclared',
  `rm_dimensions` varchar(40) NOT NULL DEFAULT '(dim) undeclared',
  `rm_state` enum('OPEN','CLOSED') NOT NULL DEFAULT 'OPEN',
  `rm_date` date NOT NULL,
  PRIMARY KEY (`rm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rm_id`, `room_num`, `floor`, `description`, `rooms_b_id`, `landlord_id`, `tenant_id`, `manager_id`, `rm_status`, `room_name`, `rm_cost`, `debit`, `credit`, `debit_umeme`, `credit_umeme`, `d_payment`, `meter_reading`, `bill_date`, `rm_s_date`, `rm_h_date`, `rm_deposit`, `rm_purpose`, `um_bill_date`, `rm_size`, `rm_dimensions`, `rm_state`, `rm_date`) VALUES
(1, 0, 1, '', 1, 0, 1, 0, 'OCCUPIED', 'A1', 120000, 120000, 200000, 0, 0, 200000, 0, '2013-05-21', '2013-05-21', '2013-05-15', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '2013-05-21'),
(2, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A2', 200000, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(3, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A3', 150000, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(4, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A4', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(5, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A5', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(6, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A6', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(7, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A7', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(8, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A8', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(9, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A9', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(10, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A10', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(11, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A11', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(12, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A12', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00'),
(13, 0, 1, '', 1, 0, 0, 0, 'VACANT', 'A13', 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00', '0000-00-00', 0, '', '0000-00-00', '(size) undeclared', '(dim) undeclared', 'OPEN', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_ten_id` int(11) NOT NULL,
  `s_rm_id` int(11) NOT NULL,
  `s_date` date NOT NULL,
  `s_amount` int(11) NOT NULL,
  `s_num` int(11) NOT NULL,
  `s_paid` enum('PAID','DUE') NOT NULL DEFAULT 'DUE',
  `s_color` varchar(10) NOT NULL,
  `s_cleared` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE IF NOT EXISTS `tenants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `tenants_b_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` enum('POTENTIAL','CURRENT','EVICTED','PAST','PENDING_EVICTION') NOT NULL,
  `h_date` date NOT NULL,
  `s_date` date NOT NULL,
  `d_payment` bigint(15) NOT NULL,
  `deposit` bigint(15) NOT NULL,
  `purpose` text NOT NULL,
  `c_person` varchar(20) NOT NULL,
  `phone_2` varchar(20) NOT NULL,
  `phone_3` varchar(20) NOT NULL,
  `c_phone` varchar(20) NOT NULL,
  `pic_path` varchar(100) NOT NULL,
  `agent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `f_name`, `l_name`, `tenants_b_id`, `room_id`, `telephone`, `email`, `status`, `h_date`, `s_date`, `d_payment`, `deposit`, `purpose`, `c_person`, `phone_2`, `phone_3`, `c_phone`, `pic_path`, `agent`) VALUES
(1, 'regesrg', 'wee', 1, 1, '256-779-778-007', '', 'CURRENT', '2013-05-15', '2013-05-21', 200000, 0, 'shop', '', '', '0', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `umeme`
--

CREATE TABLE IF NOT EXISTS `umeme` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `u_b_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_level` int(5) NOT NULL DEFAULT '0',
  `name_first` varchar(128) NOT NULL,
  `name_last` varchar(128) NOT NULL,
  `name_user` varchar(60) NOT NULL,
  `name_password` varchar(128) NOT NULL,
  `name_group` int(11) NOT NULL,
  `name_pic_path` varchar(140) NOT NULL,
  PRIMARY KEY (`name_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name_id`, `access_level`, `name_first`, `name_last`, `name_user`, `name_password`, `name_group`, `name_pic_path`) VALUES
(44, 1, '', '', 'cmasereka@gmail.com', '*0FD9A3F0F816D076CF239580A68A1147C250EB7B', 1, ''),
(45, 0, 'clay', 'casius', 'casius@cms.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`) VALUES
(1, 'ADMIN'),
(2, 'MANAGER'),
(3, 'ACCOUNTANT A'),
(4, 'ACCOUNTANT B');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
