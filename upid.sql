-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2014 at 06:43 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upid`
--

-- --------------------------------------------------------

use UPID;

--
-- Table structure for table `alert_category`
--

CREATE TABLE IF NOT EXISTS `alert_category` (
  `alertCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`alertCategoryID`),
  UNIQUE KEY `categoryName_UNIQUE` (`categoryName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `alert_category`
--

INSERT INTO `alert_category` (`alertCategoryID`, `categoryName`) VALUES
(2, 'Crime'),
(3, 'Incidents'),
(1, 'Poverty');

-- --------------------------------------------------------

--
-- Table structure for table `alert_location`
--

CREATE TABLE IF NOT EXISTS `alert_location` (
  `locationID` int(11) NOT NULL AUTO_INCREMENT,
  `countryID` int(11) NOT NULL,
  `regionName` varchar(255) NOT NULL COMMENT 'save new regions here, e.g in Kenya..a region could be a county or a province',
  `localityName` varchar(255) NOT NULL COMMENT 'save new locality here, e.g a locality in Kenya is Madaraka',
  PRIMARY KEY (`locationID`),
  KEY `fk_alert_location_upid_country1` (`countryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `alert_location`
--

INSERT INTO `alert_location` (`locationID`, `countryID`, `regionName`, `localityName`) VALUES
(1, 1, 'Langata', 'Kibera'),
(2, 1, 'Westlands', 'Kawangware');

-- --------------------------------------------------------

--
-- Table structure for table `alert_type`
--

CREATE TABLE IF NOT EXISTS `alert_type` (
  `alertTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `alertTypeName` varchar(150) NOT NULL,
  `alertCategoryID` int(11) NOT NULL,
  PRIMARY KEY (`alertTypeID`),
  UNIQUE KEY `categoryName_UNIQUE` (`alertTypeName`),
  KEY `fk_alert_type_alert_category1` (`alertCategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `alert_type`
--

INSERT INTO `alert_type` (`alertTypeID`, `alertTypeName`, `alertCategoryID`) VALUES
(1, 'POV1', 1),
(2, 'POV2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filed_reports`
--

CREATE TABLE IF NOT EXISTS `filed_reports` (
  `reportID` int(11) NOT NULL AUTO_INCREMENT,
  `reportTitle` varchar(255) NOT NULL,
  `reportUrl` varchar(255) NOT NULL,
  `dateModified` date NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`reportID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `filed_reports`
--

INSERT INTO `filed_reports` (`reportID`, `reportTitle`, `reportUrl`, `dateModified`, `category`) VALUES
(1, 'Water Quality Index-Municipal Report', 'water_index.pdf', '2014-03-19', 1),
(2, 'Sanitation Conditions-Regional', 'conditions.pdf', '2014-03-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `resourceId` int(11) NOT NULL AUTO_INCREMENT,
  `resourceName` varchar(255) NOT NULL,
  `resourceType` varchar(255) NOT NULL,
  `ownership` varchar(255) NOT NULL COMMENT 'e.g public or private',
  `additionalInformation` text COMMENT 'e.g for a school, additional info can be no. of students per teacher. For a police station, it can  be; no. of officers at the station. ',
  PRIMARY KEY (`resourceId`),
  UNIQUE KEY `resourceName` (`resourceName`),
  KEY `fk_resources_resource_type1` (`resourceType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resourceId`, `resourceName`, `resourceType`, `ownership`, `additionalInformation`) VALUES
(1, 'Olympic Primary School', '3', '', NULL),
(2, 'Old Fire Station', '2', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resource_map`
--

CREATE TABLE IF NOT EXISTS `resource_map` (
  `resourceMapId` int(11) NOT NULL AUTO_INCREMENT,
  `resourceId` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  `resourceCount` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`resourceMapId`),
  KEY `resourceId` (`resourceId`,`locationId`),
  KEY `locationId` (`locationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `resource_map`
--

INSERT INTO `resource_map` (`resourceMapId`, `resourceId`, `locationId`, `resourceCount`, `dateCreated`) VALUES
(1, 1, 2, 20, '2014-03-20 07:00:00'),
(2, 2, 2, 50, '2014-03-27 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `resource_type`
--

CREATE TABLE IF NOT EXISTS `resource_type` (
  `resourceTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `resourceTypeName` varchar(255) DEFAULT NULL COMMENT 'e.g School, Police Station, Fire Station, Hospital,University',
  `category` int(11) NOT NULL,
  PRIMARY KEY (`resourceTypeID`),
  UNIQUE KEY `resourceTypeName_UNIQUE` (`resourceTypeName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `resource_type`
--

INSERT INTO `resource_type` (`resourceTypeID`, `resourceTypeName`, `category`) VALUES
(1, 'Police Station', 1),
(2, 'Fire Station', 1),
(3, 'School', 1),
(4, 'Clinic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `upid_alert`
--

CREATE TABLE IF NOT EXISTS `upid_alert` (
  `alertID` int(11) NOT NULL AUTO_INCREMENT,
  `alertTypeID` int(11) NOT NULL,
  `alertContent` text NOT NULL,
  `alertLocation` varchar(45) DEFAULT NULL,
  `alertGeoCoordinates` varchar(45) DEFAULT 'not provided' COMMENT 'retrieve if it''s possible else leave default',
  `alertDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alertSource` varchar(45) DEFAULT NULL COMMENT 'e.g sms, web(internal), web (public), web (other data sets)',
  PRIMARY KEY (`alertID`),
  KEY `fk_alert_alert_type` (`alertTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `upid_alert`
--

INSERT INTO `upid_alert` (`alertID`, `alertTypeID`, `alertContent`, `alertLocation`, `alertGeoCoordinates`, `alertDateTime`, `alertSource`) VALUES
(1, 2, 'Medicine for Children', '1', 'not provided', '2014-03-20 06:11:00', NULL),
(2, 1, 'Provide Clean Water', '2', 'not provided', '2014-03-05 01:24:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upid_country`
--

CREATE TABLE IF NOT EXISTS `upid_country` (
  `upidCountryID` int(11) NOT NULL AUTO_INCREMENT,
  `countryName` varchar(255) NOT NULL,
  PRIMARY KEY (`upidCountryID`),
  UNIQUE KEY `countryName_UNIQUE` (`countryName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `upid_country`
--

INSERT INTO `upid_country` (`upidCountryID`, `countryName`) VALUES
(32, 'Baringo'),
(22, 'Bomet'),
(42, 'Bungoma'),
(17, 'Busia'),
(38, 'Elgeyo Marakwet'),
(39, 'Embu'),
(26, 'Garissa'),
(15, 'Homa Bay'),
(13, 'Isiolo'),
(6, 'Kajiado'),
(20, 'Kakamega'),
(24, 'Kericho'),
(5, 'Kiambu'),
(9, 'Kilifi'),
(4, 'Kirinyaga'),
(35, 'Kisii'),
(19, 'Kisumu'),
(40, 'Kitui'),
(43, 'Kwale'),
(11, 'Laikipia'),
(41, 'Lamu'),
(7, 'Machakos'),
(21, 'Makueni'),
(25, 'Mandera'),
(27, 'Marsabit'),
(30, 'Meru'),
(16, 'Migori'),
(28, 'Mombasa'),
(47, 'Muranga'),
(1, 'Nairobi'),
(12, 'Nakuru'),
(2, 'Nandi'),
(44, 'Narok'),
(8, 'Nyamira'),
(31, 'Nyandarua'),
(14, 'Nyeri'),
(36, 'Samburu'),
(10, 'Siaya'),
(3, 'Taita Taveta'),
(37, 'Tana River'),
(46, 'Tharaka Nithi'),
(33, 'Trans Nzoia'),
(34, 'Turkana'),
(23, 'Uasin Gishu'),
(18, 'Vihiga'),
(29, 'Wajir'),
(45, 'West Pokot');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert_location`
--
ALTER TABLE `alert_location`
  ADD CONSTRAINT `alert_location_ibfk_1` FOREIGN KEY (`countryID`) REFERENCES `upid_country` (`upidCountryID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alert_location_upid_country2` FOREIGN KEY (`countryID`) REFERENCES `upid_country` (`upidCountryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `alert_type`
--
ALTER TABLE `alert_type`
  ADD CONSTRAINT `fk_alert_type_alert_category1` FOREIGN KEY (`alertCategoryID`) REFERENCES `alert_category` (`alertCategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resource_map`
--
ALTER TABLE `resource_map`
  ADD CONSTRAINT `fk_resource_map_alert_location2` FOREIGN KEY (`locationId`) REFERENCES `alert_location` (`locationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resource_map_ibfk_1` FOREIGN KEY (`resourceId`) REFERENCES `resources` (`resourceId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resource_map_ibfk_2` FOREIGN KEY (`locationId`) REFERENCES `alert_location` (`locationID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upid_alert`
--
ALTER TABLE `upid_alert`
  ADD CONSTRAINT `fk_upid_alert_alert_type1` FOREIGN KEY (`alertTypeID`) REFERENCES `alert_type` (`alertTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
