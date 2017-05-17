-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2017 at 06:50 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lic`
--
CREATE DATABASE IF NOT EXISTS `lic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lic`;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE IF NOT EXISTS `adminlogin` (
  `AdminLoginId` int(25) NOT NULL AUTO_INCREMENT,
  `AdminEmailId` varchar(50) DEFAULT NULL,
  `AdminPassword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`AdminLoginId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`AdminLoginId`, `AdminEmailId`, `AdminPassword`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `clientId` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(15) NOT NULL,
  `middleName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `emailId` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `aadharCard` varchar(50) NOT NULL,
  `votingCard` varchar(50) NOT NULL,
  `otherDoc` varchar(50) NOT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `firstName`, `middleName`, `lastName`, `phoneNo`, `emailId`, `gender`, `aadharCard`, `votingCard`, `otherDoc`) VALUES
(1, 'Chirag', 'Ashokbhai', 'Kakadiya', '7383860663', 'chiragkakadiya07@gmail.com', 'male', 'buddies.jpg', 'chiku.jpg', 'chirag.jpg'),
(2, 'Pratik ', 'MaheshBhai', 'Solanki', '8460158178', 'pratiksolanki787@gmail.com', 'male', 'Bug.jpg', '1.jpg', '3w.jpg'),
(3, 'mayur', 'prem bhai', 'thakkar', '8866087540', 'morethakkar@live.com', 'male', 'thank u buddies.jpg', 'garvi gujarat.jpg', 'ganpati bapa.jpg'),
(5, 'Parth', 'B.', 'Naik', '9016995436', 'parthnaik07@gmail.com', 'male', 'chirag.jpg', 'chirag.jpg', 'chiku.jpg'),
(6, 'Hardik', 'B', 'Patel', '9714982133', 'haard@live.com', 'male', 'aftab.jpg', 'buddies.jpg', 'chiku.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE IF NOT EXISTS `policy` (
  `policyId` int(10) NOT NULL AUTO_INCREMENT,
  `policyName` varchar(50) NOT NULL,
  `policyType` varchar(50) NOT NULL,
  `fileName` varchar(50) NOT NULL,
  `expireDate` varchar(10) NOT NULL,
  `emailStatus` int(1) NOT NULL,
  `clientId` int(11) NOT NULL,
  PRIMARY KEY (`policyId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policyId`, `policyName`, `policyType`, `fileName`, `expireDate`, `emailStatus`, `clientId`) VALUES
(1, 'LIC', 'Health', 'CK_CV.pdf', '2017-12-16', 0, 1),
(2, 'Kalis', 'Nothing', 'Bio Data.pdf', '2017-03-20', 1, 2),
(3, 'Giofd', 'Koli', 'Bio Data (1).pdf', '2017-03-22', 1, 1),
(4, 'Asdom', 'Gtoyj', '2 Pascal Tasks_sanitized.pdf', '2017-06-16', 0, 2),
(5, 'Hfgrt', 'Yhiyo', 'C Programming.pdf', '2017-03-16', 1, 3),
(7, 'UUU', 'AAA', 'EVIVE.pdf', '2017-03-16', 1, 1),
(10, 'MMM', 'SSS', 'prof-exp-intern-overview.pdf', '2017-06-16', 0, 5),
(13, 'DDD', 'ZZZ', '2 Pascal Tasks_sanitized.pdf', '2017-03-17', 0, 5),
(14, 'III', 'FFF', 'Bio Data.pdf', '2017-03-18', 0, 6),
(15, 'BBB', 'XXX', 'Weekly Task List.pdf', '2017-03-20', 0, 6),
(16, 'OOO', 'PPP', 'prof-exp-intern-overview.pdf', '2017-03-22', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
  `userId` int(25) NOT NULL AUTO_INCREMENT,
  `emailId` varchar(50) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`userId`, `emailId`, `password`) VALUES
(1, 'chiragkakadiya07@gmail.com', '7383860663'),
(2, 'pratiksolanki787@gmail.com', '8460158178'),
(3, 'morethakkar@live.com', '8866087540'),
(5, 'parthnaik07@gmail.com', '9016995436'),
(6, 'haard@live.com', '9714982133');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE IF NOT EXISTS `userregistration` (
  `UId` int(25) NOT NULL AUTO_INCREMENT,
  `VINNumber` int(17) DEFAULT NULL,
  `UserPhonneNo` int(10) DEFAULT NULL,
  `UserEmailId` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`UId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
