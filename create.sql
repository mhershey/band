create DATABASE 'band';
CREATE USER 'band'@'localhost' IDENTIFIED BY 'bandpass';
GRANT ALL PRIVILEGES ON *.* TO 'band'@'localhost' WITH GRANT OPTION;
use band;

-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2010 at 05:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `band`
--

-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE IF NOT EXISTS `band` (
  `bandId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` char(2) NOT NULL,
  `bandMembers` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `recordLabel` varchar(100) NOT NULL,
  `musicType` varchar(100) NOT NULL,
  PRIMARY KEY (`bandId`),
  UNIQUE KEY `name` (`name`),
  KEY `city` (`city`,`state`,`bandMembers`,`recordLabel`),
  KEY `musicType` (`musicType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `band`
--

INSERT INTO `band` (`bandId`, `name`, `city`, `state`, `bandMembers`, `description`, `recordLabel`, `musicType`) VALUES
(1, 'Electric Lights', 'Manassas', 'VA', 'David, Nick, Tom', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas magna est, dignissim a luctus rhoncus, consequat nec libero. Cras quis urna ac ligula dignissim feugiat. Curabitur neque eros, tincidunt sed varius non, porta nec justo. Nulla eu elit tortor. Etiam sapien dolor, commodo et ullamcorper ac, vehicula ac lorem. Aenean ut orci neque, sed placerat leo.', 'Cooperative Records', 'rock, indie, acustic');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `bandId` int(11) NOT NULL,
  `description` text NOT NULL,
  `datePosted` datetime NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `bandId` (`bandId`,`datePosted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `bandId`, `description`, `datePosted`) VALUES
(1, 1, 'This band is AWESOME', '2010-02-10 00:36:22'),
(2, 1, 'WOW', '2010-02-11 00:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `venueId` int(11) NOT NULL,
  `bandId` int(11) NOT NULL,
  `performanceDate` datetime NOT NULL,
  PRIMARY KEY (`eventId`),
  UNIQUE KEY `venueId` (`venueId`,`bandId`,`performanceDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventId`, `venueId`, `bandId`, `performanceDate`) VALUES
(1, 1, 1, '2010-02-07 09:00:00'),
(2, 1, 1, '2010-06-19 09:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `popularalbum`
--

CREATE TABLE IF NOT EXISTS `popularalbum` (
  `popularAlbumId` int(11) NOT NULL AUTO_INCREMENT,
  `bandId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`popularAlbumId`),
  KEY `bandId` (`bandId`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `popularalbum`
--


-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `venueId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `description` text NOT NULL,
  `musicType` varchar(100) NOT NULL,
  PRIMARY KEY (`venueId`),
  UNIQUE KEY `name` (`name`),
  KEY `city` (`city`,`zipcode`),
  KEY `musicType` (`musicType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venueId`, `name`, `city`, `zipcode`, `description`, `musicType`) VALUES
(1, 'Antones', 'Fredericksburg', 22401, 'Vivamus vitae massa odio, a laoreet odio. Etiam a nulla tellus. Proin in dolor eros. Suspendisse eu justo luctus massa congue placerat sit amet eu lectus. Morbi eu scelerisque nibhad', 'blues');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
