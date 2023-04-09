-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2013 at 01:04 AM
-- Server version: 5.5.13
-- PHP Version: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oblivion_udp`
--

-- --------------------------------------------------------

--
-- Table structure for table `sounds`
--

CREATE TABLE IF NOT EXISTS `sounds` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`index`),
  UNIQUE KEY `index_2` (`index`),
  KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Used to store reference and string lookups for sounds.' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sounds`
--

INSERT INTO `sounds` (`index`, `name`, `value`) VALUES
(1, 'Pay the Fine', 'paidthefine'),
(2, 'Vampire Feed', 'ref:000CB875'),
(3, 'Stop Scum', 'stoptherescum'),
(4, 'Guards Assault Assault', 'guardsguardsassault');

-- --------------------------------------------------------

--
-- Table structure for table `spawns`
--

CREATE TABLE IF NOT EXISTS `spawns` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Used to store spawn references.' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `spawns`
--

INSERT INTO `spawns` (`index`, `name`, `value`) VALUES
(1, 'Imperial Soldier', 'ref:0018B118'),
(2, 'Imperial Watch', 'ref:0004A938'),
(3, 'Imperial Archer', 'ref:00053FE8'),
(4, 'Knight of Order', 'ref:00095243'),
(5, 'Worm Anchorite', 'ref:000336F6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
