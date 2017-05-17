-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 04:38 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `newdoctors_helper`
-- 
CREATE DATABASE `newdoctors_helper` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `newdoctors_helper`;

-- --------------------------------------------------------

-- 
-- Table structure for table `access_history`
-- 

CREATE TABLE `access_history` (
  `id` int(12) NOT NULL auto_increment,
  `clinic_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `client_ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `login_date` date NOT NULL,
  `login_time` time NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `access_history`
-- 

INSERT INTO `access_history` (`id`, `clinic_id`, `user_id`, `client_ip`, `browser`, `login_date`, `login_time`) VALUES 
(1, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '10:04:49'),
(2, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '10:04:28'),
(3, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '10:04:44'),
(4, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '10:04:24'),
(5, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '10:04:16'),
(6, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '12:04:55'),
(7, 17, 37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '01:04:47'),
(8, 17, 37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '01:04:30'),
(9, 13, 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36', '2014-04-30', '09:04:35');

-- --------------------------------------------------------

-- 
-- Table structure for table `activation`
-- 

CREATE TABLE `activation` (
  `id` int(12) NOT NULL auto_increment,
  `clinic_id` int(12) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `clinic_id` (`clinic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `activation`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `address`
-- 

CREATE TABLE `address` (
  `id` int(12) NOT NULL auto_increment,
  `street_name` varchar(255) NOT NULL,
  `area_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- 
-- Dumping data for table `address`
-- 

INSERT INTO `address` (`id`, `street_name`, `area_id`) VALUES 
(18, 'Parvat Patia', 41),
(19, '101,Praukh Park Society.', 34),
(20, '30,Mahalaxmi Society.', 33),
(21, '2nd floor,Om Residency.', 35),
(22, 'madhuban circle', 35),
(23, '10,santiniketan society.', 38),
(24, '13,Ramkrushn society.', 40),
(25, 'cityligth', 37),
(26, 'sadhana socity', 37),
(27, '301,Swaminarayan Society.', 41),
(28, '3,harihar Society.', 39),
(29, '101,narayan nagar.', 33),
(30, 'F-1,sana Complex.', 36),
(31, '101,Rajlaxmi Society.', 37),
(32, 'f-4,Sardar Complex.', 33),
(33, 'athwa', 38),
(34, 'Bombay Market Road', 34),
(35, 'Baroda', 37),
(36, 'dumas Road.', 34),
(37, '							Katargam						', 33);

-- --------------------------------------------------------

-- 
-- Table structure for table `admin_login`
-- 

CREATE TABLE `admin_login` (
  `id` int(12) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `admin_login`
-- 

INSERT INTO `admin_login` (`id`, `user_name`, `password`) VALUES 
(0, 'admin', 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `appointment`
-- 

CREATE TABLE `appointment` (
  `id` int(12) NOT NULL auto_increment,
  `appointment_no` int(12) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `time_duration` int(10) NOT NULL,
  `notes` varchar(1024) NOT NULL,
  `patient_clinic_id` int(11) NOT NULL,
  `today_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_clinic_id` (`patient_clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

-- 
-- Dumping data for table `appointment`
-- 

INSERT INTO `appointment` (`id`, `appointment_no`, `date`, `time`, `time_duration`, `notes`, `patient_clinic_id`, `today_date`) VALUES 
(75, 1, '2014-04-17', '01:00:00', 1, 'Teeth Problem', 64, '0000-00-00'),
(76, 3, '2014-04-18', '04:00:00', 1, 'general Problem', 68, '0000-00-00'),
(77, 3, '2014-04-18', '12:30:00', 2, 'teeth problem', 66, '0000-00-00'),
(78, 4, '2014-04-18', '11:30:00', 2, 'mouth sores', 67, '0000-00-00'),
(80, 5, '2014-04-17', '04:00:00', 2, 'eyes problem', 69, '0000-00-00'),
(81, 6, '2014-04-19', '05:00:00', 1, 'diabites problem', 70, '0000-00-00'),
(82, 7, '2014-04-18', '04:00:00', 2, 'skin problem', 71, '0000-00-00'),
(83, 8, '2014-04-20', '07:00:00', 1, 'blood pressure problem', 72, '0000-00-00'),
(84, 1, '2014-04-30', '03:10:00', 15, 'nothing', 73, '2014-04-30'),
(85, 2, '2014-04-30', '10:01:00', 15, 'nothing', 74, '2014-04-30'),
(87, 1, '2014-04-30', '12:12:00', 15, 'nothing', 75, '2014-04-30'),
(88, 2, '2014-04-30', '03:00:00', 15, 'nothing', 76, '2014-04-30');

-- --------------------------------------------------------

-- 
-- Table structure for table `area`
-- 

CREATE TABLE `area` (
  `id` int(12) NOT NULL auto_increment,
  `city_id` int(12) NOT NULL,
  `pincode` int(6) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- 
-- Dumping data for table `area`
-- 

INSERT INTO `area` (`id`, `city_id`, `pincode`, `area_name`) VALUES 
(33, 21, 395002, 'Rander'),
(34, 21, 395003, 'Varacha'),
(35, 21, 395004, 'katargam'),
(36, 21, 395005, 'gopipura'),
(37, 21, 395006, 'salabatpura'),
(38, 21, 395007, 'vasu'),
(39, 21, 395008, 'A.K.Road'),
(40, 21, 395009, 'Adajan'),
(41, 21, 395010, 'nanpura');

-- --------------------------------------------------------

-- 
-- Table structure for table `city`
-- 

CREATE TABLE `city` (
  `id` int(12) NOT NULL auto_increment,
  `state_id` int(12) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `city`
-- 

INSERT INTO `city` (`id`, `state_id`, `city_name`) VALUES 
(21, 15, 'Surat'),
(22, 15, 'Mehsana'),
(23, 15, 'Gandhinagar'),
(24, 15, 'Anand'),
(25, 15, 'Vadodra'),
(26, 15, 'Rajkot'),
(27, 15, 'Kutch'),
(28, 15, 'Junagarh'),
(29, 15, 'Jamanager'),
(30, 15, 'Amreli'),
(31, 15, 'Ahmedabad');

-- --------------------------------------------------------

-- 
-- Table structure for table `clinic`
-- 

CREATE TABLE `clinic` (
  `id` int(12) NOT NULL auto_increment,
  `clinic_name` varchar(255) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `plan_id` int(12) NOT NULL,
  `date` date NOT NULL,
  `phoneno` varchar(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `clinic`
-- 

INSERT INTO `clinic` (`id`, `clinic_name`, `address`, `plan_id`, `date`, `phoneno`) VALUES 
(12, 'Dr.Mayur Dental Implant Center', '402,Pramukh Dr House,Parvat Patia,Puna kumbharia Road. 21 15 41', 2, '2013-03-22', '9328328585'),
(13, 'Tanushree Dental Care', '209,Trinnity Business Part,opp Madhuban Circle,surat 21 15 35', 1, '2014-04-17', '8487820869'),
(14, 'Braces N Gum Care , Multispeciality  Clinic', 'M 8-10,Corner Point,opp sejal Appt. 21 15 37', 4, '2014-04-17', '2612210082'),
(15, 'Raj Clinic', '3,Harihar Society. 21 15 39', 3, '2014-04-17', '2812450045'),
(16, 'Muskan Multispeciality Clinic', 'F-1,sana complex,hodi Banglow Cross Road,Ved darvaja Road. 21 15 36', 4, '2014-04-17', '9904583565'),
(17, 'Dental clinic', '							parvatinagar street surat gujarat 395008					', 6, '2014-04-30', '1234567890');

-- --------------------------------------------------------

-- 
-- Table structure for table `company`
-- 

CREATE TABLE `company` (
  `id` int(12) NOT NULL auto_increment,
  `company_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `company`
-- 

INSERT INTO `company` (`id`, `company_name`, `email_address`, `phone_no`, `address`) VALUES 
(1, 'Biophar Lifescience Pvt .Ltd', 'biophars@gmail.com', '9878941967', '1st-2nd floor,motor market,manimajra,chandigh-160101,punjab'),
(2, 'Ankur Drugs', 'srane@ankurdrugs.com', '91-22-4068', 'c-306,crystal plaza,andheri link road,andheri[west],mumbai-400053'),
(3, 'Brassia Pharma pvt .Ltd', 'info@gbrassiapharma.com', '9122257045', '7th floor,vastubh off Road to carter Road no.1,near dattapada subway,borivali,mumbai-400066'),
(4, 'Halewood Lab pvt.Ltd', 'info@halewoodlabs.com', '7925831513', '319,G.I.O.C phase,vatva,ahemdabad,gujrat'),
(5, 'CRMO Pharmatech pvt.Ltd', 'info@CRMOpharmatech.com', '7940031547', '608 B,pinncle ,corporate road,Nr.Prathladnagar,ahemdabad-380015');

-- --------------------------------------------------------

-- 
-- Table structure for table `content`
-- 

CREATE TABLE `content` (
  `id` int(12) NOT NULL auto_increment,
  `content_name` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `content`
-- 

INSERT INTO `content` (`id`, `content_name`, `description`) VALUES 
(1, 'clonidine', 'heart'),
(2, 'methyldopa', 'heart attack'),
(3, 'pilocarpine', 'eye'),
(4, 'betaxolol', 'eye problem'),
(5, 'salbutamol', 'asthma'),
(6, 'cimetidine', 'digestion'),
(7, 'nandrolone', 'high blood pressure'),
(8, 'dienoestrol', 'low blood pressure'),
(9, 'clomiphene', 'diabities'),
(10, 'terfenadine', 'normal allergy'),
(11, 'edastine', 'skin allergy'),
(12, 'astemizole', 'eye allergy'),
(13, 'ketoprofen', 'tb'),
(14, 'flurbiprofen', 'tb'),
(15, 'aminoacids', 'diabities'),
(16, 'cefdinir', 'digestion'),
(17, 'divalproex', 'asthama'),
(18, 'bisoprolol', 'indigestion'),
(19, 'sibutramine', 'indigestion'),
(20, 'fenfluramine', 'eyes'),
(21, 'tubefeeds', 'fever'),
(22, 'alfacalaidol', 'high fever'),
(23, 'epoetin', 'boold pressure'),
(24, 'cyproheptadine', 'fever'),
(25, 'ginseng', 'sleep tonint powers'),
(26, 'diazepam', 'spams'),
(27, 'oxazepam', 'agitation and irritability in order patients ');

-- --------------------------------------------------------

-- 
-- Table structure for table `dieses`
-- 

CREATE TABLE `dieses` (
  `id` int(12) NOT NULL auto_increment,
  `dieses_name` varchar(5000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `dieses`
-- 

INSERT INTO `dieses` (`id`, `dieses_name`) VALUES 
(1, 'diabetes'),
(2, 'tb'),
(3, 'blood pressure'),
(4, 'fever'),
(5, 'Digestion'),
(6, 'migraine'),
(7, 'Heart Problem'),
(8, 'indigestion'),
(9, 'Allergy'),
(10, 'Asthma'),
(11, 'cencer');

-- --------------------------------------------------------

-- 
-- Table structure for table `doctor`
-- 

CREATE TABLE `doctor` (
  `id` int(12) NOT NULL auto_increment,
  `user_id` int(12) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `doctor`
-- 

INSERT INTO `doctor` (`id`, `user_id`, `speciality`) VALUES 
(10, 18, 'Dentist'),
(11, 22, 'Endodontists'),
(12, 25, 'Homeopath'),
(13, 27, 'Aroma Therapist'),
(14, 28, 'cardiologits'),
(15, 30, 'Eyes '),
(16, 37, 'All the dental speciality');

-- --------------------------------------------------------

-- 
-- Table structure for table `doctor_clinic`
-- 

CREATE TABLE `doctor_clinic` (
  `id` int(12) NOT NULL auto_increment,
  `doctor_id` int(12) NOT NULL,
  `clinic_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `docter_id` (`doctor_id`),
  KEY `clinic_id` (`clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `doctor_clinic`
-- 

INSERT INTO `doctor_clinic` (`id`, `doctor_id`, `clinic_id`) VALUES 
(13, 10, 12),
(14, 11, 13),
(15, 12, 14),
(16, 14, 15),
(17, 15, 16),
(18, 16, 17);

-- --------------------------------------------------------

-- 
-- Table structure for table `email`
-- 

CREATE TABLE `email` (
  `id` int(12) NOT NULL auto_increment,
  `email_address` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- 
-- Dumping data for table `email`
-- 

INSERT INTO `email` (`id`, `email_address`) VALUES 
(33, 'drBhavi@ymail.com'),
(27, 'drBhavinPatel@gmail.com'),
(32, 'drBhavyMavani@gmail.com'),
(40, 'drFeni@yahoo.com'),
(25, 'drMayur@gmail.com'),
(26, 'drMayuri@gmail.com'),
(43, 'drMinakshiSingh@gmail.com'),
(37, 'drMuskan@gmail.com'),
(42, 'drNiralRamani@gmail.com'),
(39, 'drNita@gmail.com'),
(35, 'drPrakash@gmail.com'),
(38, 'drRaju@gmail.com'),
(41, 'drRakeshSavani@gmail.com'),
(36, 'drRaniMehta@gmail.com'),
(34, 'drRaviPatel@gmail.com'),
(28, 'drRiyaVasoya@ymail.com'),
(31, 'drSipraPatel@gmail.com'),
(29, 'drTanushree@gmail.com'),
(30, 'manoj sutariya'),
(44, 'mikinj.mistry@gmail.com');

-- --------------------------------------------------------

-- 
-- Table structure for table `login`
-- 

CREATE TABLE `login` (
  `id` int(12) NOT NULL auto_increment,
  `login_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `user_email_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_email_id` (`user_email_id`),
  KEY `que_id` (`question`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `login`
-- 

INSERT INTO `login` (`id`, `login_name`, `password`, `question`, `answer`, `user_email_id`) VALUES 
(12, 'Dr.Mayur Dudhat', 'drMayur', 'what is your nick name?', 'Mayur', 26),
(13, 'Tanushree', '123', 'what is your nick name?', 'Tanushree', 30),
(14, 'Bhavy Mavani', 'drBhavy', 'what is your nick name?', 'bhavy', 33),
(15, 'Ravi Patel', 'drRavi', 'what is your nick name?', 'ravi', 35),
(16, 'Prakakash M.Joshi', 'drPrakash', 'what is your nick name?', 'prakash', 36),
(17, 'Muskan', 'drMuskan', 'what is your nick name?', 'muskan', 38),
(18, 'Dr_Mikinj_Mistry', '123', 'what is your nick name?', 'mika', 45);

-- --------------------------------------------------------

-- 
-- Table structure for table `login_status`
-- 

CREATE TABLE `login_status` (
  `id` int(12) NOT NULL auto_increment,
  `status` varchar(255) NOT NULL,
  `reasion` varchar(1024) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `login_status`
-- 

INSERT INTO `login_status` (`id`, `status`, `reasion`) VALUES 
(12, '1', 'nothing'),
(13, '1', 'nothing'),
(14, '1', 'nothing'),
(15, '1', 'nothing'),
(16, '1', 'nothing'),
(17, '1', 'nothing'),
(18, '1', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `medical_history`
-- 

CREATE TABLE `medical_history` (
  `id` int(12) NOT NULL auto_increment,
  `patient_id` int(12) NOT NULL,
  `dieses_id` int(12) NOT NULL,
  `description` varchar(5000) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `dieses_id` (`dieses_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `medical_history`
-- 

INSERT INTO `medical_history` (`id`, `patient_id`, `dieses_id`, `description`) VALUES 
(2, 75, 1, 'diabites'),
(3, 77, 3, 'high blood pressure'),
(4, 78, 5, 'cancer'),
(5, 79, 4, 'pimples'),
(6, 80, 9, 'mouth sores');

-- --------------------------------------------------------

-- 
-- Table structure for table `medicine`
-- 

CREATE TABLE `medicine` (
  `id` int(12) NOT NULL auto_increment,
  `medicine_name` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- 
-- Dumping data for table `medicine`
-- 

INSERT INTO `medicine` (`id`, `medicine_name`, `description`) VALUES 
(1, 'metformin', 'use for sugar diabetes'),
(2, 'sulfonylureas', 'use for diabetes'),
(3, 'meglitinides', 'use in diabetes'),
(4, 'corticosteroid', 'use in tuberculosis'),
(5, 'ethambutol', 'use in tuberculosis'),
(6, 'amikacim', 'use for tuberculosis'),
(7, 'indapamide', 'use for high blood pressure'),
(8, 'bumetanida(G)', 'use for normal blood pressure'),
(9, 'spironolactone ', 'use for low blood pressure'),
(10, 'bacampicillin', 'use for high fever'),
(11, 'halofantrine', 'use for normal fever'),
(12, 'ketorolac', 'use for fever'),
(13, 'nadolol', 'use in fever'),
(14, 'abreva', 'use for digestion'),
(15, 'abacavir', 'use in digestion'),
(16, 'dio', 'use for allergy'),
(17, 'amitriptyline', 'use in migraine'),
(18, 'buprenorphine', 'use for migraine'),
(19, 'eletriptan', 'use in migraine'),
(20, 'aspirin', 'use for heart attack'),
(21, 'bisoprolol', 'use for heart prolem'),
(22, 'famotidine', 'use in indigestion'),
(23, 'itopride', 'use in indigestion'),
(24, 'calcium-carbonate ', 'use for indigestion'),
(25, 'jantoven', 'use for screen allergy'),
(26, 'revex', 'use in  dhul allergy'),
(27, 'flunisolide', 'use for asthma'),
(28, 'ketotifen', 'use in asthma'),
(29, 'peracitemal', 'null');

-- --------------------------------------------------------

-- 
-- Table structure for table `medicine_clinic`
-- 

CREATE TABLE `medicine_clinic` (
  `id` int(11) NOT NULL auto_increment,
  `medicine_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `medicine_id` (`medicine_id`,`clinic_id`),
  KEY `medicine_id_2` (`medicine_id`,`clinic_id`),
  KEY `clinic_id` (`clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `medicine_clinic`
-- 

INSERT INTO `medicine_clinic` (`id`, `medicine_id`, `clinic_id`) VALUES 
(1, 1, 12),
(2, 2, 12),
(3, 3, 12),
(4, 4, 13),
(5, 5, 13),
(6, 6, 13),
(7, 7, 14),
(8, 8, 14),
(9, 9, 14),
(10, 10, 15),
(11, 11, 15),
(12, 12, 15),
(13, 13, 16),
(14, 14, 16),
(15, 15, 16),
(16, 16, 12),
(17, 17, 13),
(18, 18, 14),
(19, 19, 15),
(20, 20, 16),
(21, 21, 12),
(22, 22, 13),
(23, 23, 14),
(24, 24, 15),
(25, 25, 16),
(26, 26, 12),
(27, 27, 13),
(28, 28, 14);

-- --------------------------------------------------------

-- 
-- Table structure for table `medicine_company`
-- 

CREATE TABLE `medicine_company` (
  `id` int(11) NOT NULL auto_increment,
  `medicine_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `medicine_id` (`medicine_id`,`company_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `medicine_company`
-- 

INSERT INTO `medicine_company` (`id`, `medicine_id`, `company_id`) VALUES 
(3, 1, 1),
(4, 2, 1),
(5, 3, 1),
(7, 4, 1),
(8, 5, 1),
(9, 6, 2),
(10, 7, 2),
(11, 8, 2),
(12, 9, 3),
(13, 10, 3),
(2, 11, 1),
(15, 12, 4),
(16, 13, 5),
(29, 14, 3),
(30, 15, 4),
(18, 16, 2),
(17, 17, 1),
(19, 18, 3),
(20, 19, 4),
(21, 20, 5),
(22, 21, 5),
(23, 22, 4),
(24, 23, 2),
(25, 24, 1),
(31, 25, 5),
(26, 26, 3),
(27, 27, 2),
(28, 28, 4);

-- --------------------------------------------------------

-- 
-- Table structure for table `medicine_content`
-- 

CREATE TABLE `medicine_content` (
  `id` int(12) NOT NULL auto_increment,
  `medicine_id` int(12) NOT NULL,
  `content_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `medicine_id` (`medicine_id`),
  KEY `contect_id` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `medicine_content`
-- 

INSERT INTO `medicine_content` (`id`, `medicine_id`, `content_id`) VALUES 
(4, 1, 9),
(5, 2, 15),
(6, 3, 16),
(7, 4, 27),
(10, 7, 7),
(11, 8, 8),
(12, 9, 23),
(13, 10, 24),
(14, 11, 25),
(15, 12, 22),
(16, 14, 6),
(17, 15, 15),
(18, 16, 10),
(19, 20, 1),
(20, 21, 2),
(21, 25, 11),
(22, 26, 12),
(23, 27, 5),
(24, 28, 17);

-- --------------------------------------------------------

-- 
-- Table structure for table `mr`
-- 

CREATE TABLE `mr` (
  `id` int(12) NOT NULL auto_increment,
  `mr_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `mr`
-- 

INSERT INTO `mr` (`id`, `mr_name`, `gender`) VALUES 
(1, 'rohit patel', 'male'),
(2, 'maya hirani', 'female'),
(3, 'ronit roy', 'male'),
(4, 'krunal mavani', 'male'),
(5, 'vishal savani', 'male');

-- --------------------------------------------------------

-- 
-- Table structure for table `mr_address`
-- 

CREATE TABLE `mr_address` (
  `id` int(12) NOT NULL auto_increment,
  `mr_id` int(12) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `area_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `mr_id` (`mr_id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `mr_address`
-- 

INSERT INTO `mr_address` (`id`, `mr_id`, `street_name`, `area_id`) VALUES 
(1, 1, 'boombay market ', 34),
(2, 2, 'baroda', 37),
(3, 3, 'rander road', 36),
(4, 4, 'adajan ', 40),
(5, 5, 'sadhna society', 37);

-- --------------------------------------------------------

-- 
-- Table structure for table `mr_clinic`
-- 

CREATE TABLE `mr_clinic` (
  `id` int(12) NOT NULL auto_increment,
  `mr_id` int(12) NOT NULL,
  `clinic_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `mr_id` (`mr_id`),
  KEY `clinic_id` (`clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `mr_clinic`
-- 

INSERT INTO `mr_clinic` (`id`, `mr_id`, `clinic_id`) VALUES 
(1, 1, 12),
(2, 2, 14),
(3, 3, 15),
(4, 4, 16),
(5, 5, 13);

-- --------------------------------------------------------

-- 
-- Table structure for table `mr_company`
-- 

CREATE TABLE `mr_company` (
  `id` int(11) NOT NULL auto_increment,
  `mr_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `mr_id` (`mr_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `mr_company`
-- 

INSERT INTO `mr_company` (`id`, `mr_id`, `company_id`) VALUES 
(1, 1, 2),
(2, 2, 4),
(3, 3, 5),
(4, 4, 1),
(5, 5, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `mr_email`
-- 

CREATE TABLE `mr_email` (
  `id` int(12) NOT NULL auto_increment,
  `mr_id` int(12) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `mr_id` (`mr_id`),
  KEY `email_id` (`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `mr_email`
-- 

INSERT INTO `mr_email` (`id`, `mr_id`, `email_id`) VALUES 
(1, 1, 'rohitpatel@ymail.com'),
(2, 2, 'mayahirani@gmail.com'),
(3, 3, 'ronitroy@yahoo.com'),
(4, 4, 'krunalmavani@ymail.c'),
(5, 5, 'vishalsavani@gmail.c');

-- --------------------------------------------------------

-- 
-- Table structure for table `mr_medicine`
-- 

CREATE TABLE `mr_medicine` (
  `id` int(11) NOT NULL auto_increment,
  `mr_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `mr_id` (`mr_id`,`medicine_id`),
  KEY `medicine_id` (`medicine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `mr_medicine`
-- 

INSERT INTO `mr_medicine` (`id`, `mr_id`, `medicine_id`, `time`, `date`) VALUES 
(1, 1, 1, '', ''),
(2, 1, 2, '', ''),
(3, 1, 3, '', ''),
(4, 1, 4, '', ''),
(5, 2, 5, '', ''),
(6, 2, 6, '', ''),
(7, 2, 7, '', ''),
(8, 2, 8, '', ''),
(9, 3, 9, '', ''),
(10, 3, 10, '', ''),
(11, 3, 11, '', ''),
(12, 3, 12, '', ''),
(13, 4, 13, '', ''),
(14, 4, 14, '', ''),
(15, 4, 15, '', ''),
(16, 4, 16, '', ''),
(17, 5, 17, '', ''),
(18, 5, 18, '', ''),
(19, 5, 19, '', ''),
(20, 5, 20, '', ''),
(21, 1, 21, '', ''),
(22, 2, 22, '', ''),
(23, 3, 23, '', ''),
(24, 4, 24, '', ''),
(25, 5, 25, '', ''),
(26, 1, 26, '', ''),
(27, 2, 27, '', ''),
(28, 5, 28, '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `mr_phone_no`
-- 

CREATE TABLE `mr_phone_no` (
  `id` int(12) NOT NULL auto_increment,
  `mr_id` int(12) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `mr_id` (`mr_id`),
  KEY `phone_no` (`phone_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `mr_phone_no`
-- 

INSERT INTO `mr_phone_no` (`id`, `mr_id`, `phone_no`) VALUES 
(1, 1, '9785624680'),
(2, 2, '8845726913'),
(3, 3, '7854692314'),
(4, 4, '8585787896'),
(5, 5, '9980740231');

-- --------------------------------------------------------

-- 
-- Table structure for table `next_appointment`
-- 

CREATE TABLE `next_appointment` (
  `id` int(11) NOT NULL auto_increment,
  `a_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `next_appointment`
-- 

INSERT INTO `next_appointment` (`id`, `a_id`, `date`, `flag`) VALUES 
(1, 87, '2014-05-01', 0),
(2, 88, '2014-05-01', 1),
(3, 88, '2014-05-02', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `patient`
-- 

CREATE TABLE `patient` (
  `id` int(12) NOT NULL auto_increment,
  `patient_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

-- 
-- Dumping data for table `patient`
-- 

INSERT INTO `patient` (`id`, `patient_name`, `date_of_birth`, `gender`) VALUES 
(75, 'Mukeshbhai', '1989-02-14', 'male'),
(77, 'Ramilaben', '1990-07-25', 'female'),
(78, 'meenaben', '1991-09-18', 'female'),
(79, 'tanveer', '1992-01-07', 'female'),
(80, 'rajubhai', '1989-06-05', 'male'),
(81, 'raj', '1996-10-02', 'male'),
(82, 'rishita', '1996-03-06', 'female'),
(83, 'pinal', '1993-12-01', 'female'),
(84, 'mahesh', '1978-02-16', 'male'),
(85, 'rakesh', '0000-00-00', 'male'),
(86, 'mahesh', '1940-01-01', 'male'),
(87, 'Ravina', '0000-00-00', 'male');

-- --------------------------------------------------------

-- 
-- Table structure for table `patient_address`
-- 

CREATE TABLE `patient_address` (
  `id` int(12) NOT NULL auto_increment,
  `street_name` varchar(255) NOT NULL,
  `area_id` int(12) NOT NULL,
  `patient_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `area_id` (`area_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `patient_address`
-- 

INSERT INTO `patient_address` (`id`, `street_name`, `area_id`, `patient_id`) VALUES 
(1, 'bombay market', 34, 75),
(2, 'baroda', 37, 77),
(10, 'sader market', 35, 78),
(11, 'athwa gate', 33, 79),
(12, 'yogi chowk', 36, 80),
(13, 'puna gam', 38, 81),
(14, 'lal darwaja', 39, 81),
(15, 'adajan', 40, 82),
(16, 'majura gate', 41, 83),
(17, 'katargam															', 33, 84),
(18, '', 35, 86);

-- --------------------------------------------------------

-- 
-- Table structure for table `patient_clinic`
-- 

CREATE TABLE `patient_clinic` (
  `id` int(12) NOT NULL auto_increment,
  `patient_id` int(12) NOT NULL,
  `clinic_id` int(12) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `clinic_id` (`clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

-- 
-- Dumping data for table `patient_clinic`
-- 

INSERT INTO `patient_clinic` (`id`, `patient_id`, `clinic_id`, `time`, `date`) VALUES 
(64, 75, 12, '01:00:00', '2014-04-17'),
(66, 77, 12, '12:30:00', '2014-04-18'),
(67, 78, 12, '11:30:00', '2014-04-18'),
(68, 79, 13, '04:00:00', '2014-04-18'),
(69, 80, 14, '04:00:00', '2014-04-17'),
(70, 81, 15, '05:00:00', '2014-04-19'),
(71, 82, 16, '04:00:00', '2014-04-18'),
(72, 83, 16, '07:00:00', '2014-04-20'),
(73, 84, 13, '03:10:00', '2014-04-30'),
(74, 85, 13, '10:01:00', '2014-04-30'),
(75, 86, 17, '12:12:00', '2014-04-30'),
(76, 87, 17, '03:00:00', '2014-04-30');

-- --------------------------------------------------------

-- 
-- Table structure for table `patient_email`
-- 

CREATE TABLE `patient_email` (
  `id` int(12) NOT NULL auto_increment,
  `patient_id` int(12) NOT NULL,
  `email_address` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `patient_email`
-- 

INSERT INTO `patient_email` (`id`, `patient_id`, `email_address`) VALUES 
(1, 75, 'mukeshbhai@yahoo.com'),
(2, 77, 'rameela@yahoo.in'),
(3, 78, 'meenaben@gmail.com'),
(4, 79, 'tanveer@yahoo.com'),
(5, 80, 'raju123@yahoo.com'),
(6, 81, 'raj@yahoo.com'),
(7, 82, 'rishita@yahoo.com'),
(8, 83, 'pinal@yahoo.com'),
(9, 84, 'mahesh_@gmail.com'),
(10, 86, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `patient_phone_no`
-- 

CREATE TABLE `patient_phone_no` (
  `id` int(12) NOT NULL auto_increment,
  `patient_id` int(12) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

-- 
-- Dumping data for table `patient_phone_no`
-- 

INSERT INTO `patient_phone_no` (`id`, `patient_id`, `phone_no`) VALUES 
(146, 75, '8889995211'),
(148, 77, '7788995469'),
(149, 78, '8569458936'),
(150, 79, '8899785686'),
(151, 75, '9978563247'),
(152, 77, '8897654231'),
(153, 78, '856586985'),
(154, 79, '5656454525'),
(155, 80, '963833569'),
(156, 81, '8465231790'),
(157, 82, '9999966666'),
(158, 83, '8569321470'),
(159, 84, '7886784545'),
(160, 85, '7885854545'),
(161, 86, '9687341324'),
(162, 87, '9687341324');

-- --------------------------------------------------------

-- 
-- Table structure for table `phone_no`
-- 

CREATE TABLE `phone_no` (
  `id` int(12) NOT NULL auto_increment,
  `phone_no` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

-- 
-- Dumping data for table `phone_no`
-- 

INSERT INTO `phone_no` (`id`, `phone_no`) VALUES 
(91, '9328328585'),
(92, '8338429696'),
(93, '9982694578'),
(94, '7896587423'),
(95, '8487820810'),
(96, '7878797486'),
(97, '9989856970'),
(98, '8965745698'),
(99, '8965475631'),
(100, '7896532145'),
(101, '9825145476'),
(102, '8787875896'),
(103, '8975641368'),
(104, '9758463249'),
(105, '8788965479'),
(106, '8569857412'),
(107, '8574693254'),
(108, '7896548496'),
(109, '9875463210'),
(110, '395004');

-- --------------------------------------------------------

-- 
-- Table structure for table `plan`
-- 

CREATE TABLE `plan` (
  `id` int(12) NOT NULL auto_increment,
  `description` varchar(50) NOT NULL,
  `cost` float NOT NULL,
  `time_duration` varchar(20) NOT NULL,
  `no_of_appointment` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `plan`
-- 

INSERT INTO `plan` (`id`, `description`, `cost`, `time_duration`, `no_of_appointment`) VALUES 
(1, 'desc1', 1000, '1Monh', 500),
(2, 'desc2', 500, '15days', 300),
(3, 'desc3', 700, '20days', 400),
(4, 'desc4', 1500, '2Months', 700),
(5, 'desc5', 1200, '40days', 550),
(6, 'desc6', 2000, '60days', 650);

-- --------------------------------------------------------

-- 
-- Table structure for table `post_treatment`
-- 

CREATE TABLE `post_treatment` (
  `id` int(12) NOT NULL auto_increment,
  `treatment_id` int(12) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(2048) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `treatment_id` (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `post_treatment`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pre_treatment`
-- 

CREATE TABLE `pre_treatment` (
  `id` int(12) NOT NULL auto_increment,
  `treatment_id` int(12) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(2048) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `treatment_id` (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `pre_treatment`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prescription`
-- 

CREATE TABLE `prescription` (
  `id` int(12) NOT NULL auto_increment,
  `medicine_id` int(12) NOT NULL,
  `treatment_id` int(12) NOT NULL,
  `quantity` int(10) NOT NULL,
  `no_of_time` varchar(10) NOT NULL,
  `description` varchar(5000) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `medicine_id` (`medicine_id`),
  KEY `treatment_id` (`treatment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `prescription`
-- 

INSERT INTO `prescription` (`id`, `medicine_id`, `treatment_id`, `quantity`, `no_of_time`, `description`) VALUES 
(1, 2, 5, 12, '3', 'daily 3 time'),
(2, 13, 6, 6, '1', 'daily morning after breakfast'),
(3, 16, 7, 8, '2', 'next to next day '),
(4, 21, 8, 15, '3', 'daily'),
(5, 28, 9, 6, '2', 'daily'),
(6, 18, 10, 15, '3', 'next to next day'),
(7, 7, 11, 8, '2', 'next to next day'),
(8, 25, 12, 9, '1', 'daily night after lunch'),
(9, 20, 13, 10, '1-0-0', ''),
(10, 2, 14, 10, '1-0-0', 'no'),
(11, 22, 15, 10, '1-0-0', 'no'),
(12, 27, 16, 10, '1-0-0', ''),
(13, 13, 17, 12, '1-0-1', ''),
(14, 25, 18, 10, '1-0-0', ''),
(15, 17, 19, 12, '1-1-1', ''),
(16, 29, 20, 15, '1-0-0', 'nothing');

-- --------------------------------------------------------

-- 
-- Table structure for table `renual`
-- 

CREATE TABLE `renual` (
  `id` int(12) NOT NULL auto_increment,
  `plan_id` int(12) NOT NULL,
  `clinic_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `plan_id` (`plan_id`),
  KEY `clinic_id` (`clinic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `renual`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `state`
-- 

CREATE TABLE `state` (
  `id` int(12) NOT NULL auto_increment,
  `state_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `state`
-- 

INSERT INTO `state` (`id`, `state_name`) VALUES 
(15, 'Gujrat'),
(16, 'Goa'),
(17, 'Maharashtra'),
(18, 'Jammu and  Kashmir'),
(19, 'Haryana'),
(20, 'Punjab'),
(21, 'Keral'),
(22, 'Karnataka'),
(23, 'Rajasthan'),
(24, 'Bihar');

-- --------------------------------------------------------

-- 
-- Table structure for table `treatment`
-- 

CREATE TABLE `treatment` (
  `id` int(12) NOT NULL auto_increment,
  `appointment_id` int(12) NOT NULL,
  `dieses_id` int(12) NOT NULL,
  `description` varchar(5000) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `appointment_id` (`appointment_id`),
  KEY `dieses_id` (`dieses_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Dumping data for table `treatment`
-- 

INSERT INTO `treatment` (`id`, `appointment_id`, `dieses_id`, `description`) VALUES 
(5, 75, 1, 'high diabites'),
(6, 76, 2, 'tb in 1 month'),
(7, 77, 3, 'low blood pressure'),
(8, 78, 4, 'high fever'),
(9, 80, 9, 'skin problem'),
(10, 81, 7, 'heart attack'),
(11, 82, 8, 'indigestion'),
(12, 83, 10, 'asthma'),
(13, 87, 2, ''),
(14, 88, 4, 'no'),
(15, 87, 1, 'no'),
(16, 87, 9, ''),
(17, 87, 5, ''),
(18, 87, 8, ''),
(19, 88, 11, ''),
(20, 88, 10, 'nothing');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(12) NOT NULL auto_increment,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` (`id`, `user_name`) VALUES 
(18, 'Dr.Mayur Dudhat'),
(19, 'Mayuri'),
(20, 'Bhavin Patel'),
(21, 'Riya Vasoya'),
(22, 'Tanushree'),
(23, 'Manoj sutariya'),
(24, 'sipra patel'),
(25, 'Bhavy Mavani'),
(26, 'bhavi'),
(27, 'Ravi Patel'),
(28, 'Prakakash M.Joshi'),
(29, 'rani mehta'),
(30, 'Muskan'),
(31, 'Raju desai'),
(32, 'nita mehta'),
(33, 'Feni Gandhi'),
(34, 'rakesh savani'),
(35, 'Nirav Ramani'),
(36, 'minakshi singh'),
(37, 'Dr_Mikinj_Mistry');

-- --------------------------------------------------------

-- 
-- Table structure for table `user_address`
-- 

CREATE TABLE `user_address` (
  `id` int(12) NOT NULL auto_increment,
  `user_id` int(12) NOT NULL,
  `address_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- 
-- Dumping data for table `user_address`
-- 

INSERT INTO `user_address` (`id`, `user_id`, `address_id`) VALUES 
(13, 18, 18),
(14, 19, 19),
(15, 20, 20),
(16, 21, 21),
(17, 22, 22),
(18, 23, 23),
(19, 24, 24),
(20, 25, 25),
(21, 26, 26),
(22, 27, 27),
(23, 28, 28),
(24, 29, 29),
(25, 30, 30),
(26, 31, 31),
(27, 32, 32),
(28, 33, 33),
(29, 34, 34),
(30, 35, 35),
(31, 36, 36),
(32, 37, 37);

-- --------------------------------------------------------

-- 
-- Table structure for table `user_email`
-- 

CREATE TABLE `user_email` (
  `id` int(12) NOT NULL auto_increment,
  `user_id` int(12) NOT NULL,
  `email_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `email_id` (`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- 
-- Dumping data for table `user_email`
-- 

INSERT INTO `user_email` (`id`, `user_id`, `email_id`) VALUES 
(26, 18, 25),
(27, 19, 26),
(28, 20, 27),
(29, 21, 28),
(30, 22, 29),
(31, 23, 30),
(32, 24, 31),
(33, 25, 32),
(34, 26, 33),
(35, 27, 34),
(36, 28, 35),
(37, 29, 36),
(38, 30, 37),
(39, 31, 38),
(40, 32, 39),
(41, 33, 40),
(42, 34, 41),
(43, 35, 42),
(44, 36, 43),
(45, 37, 44);

-- --------------------------------------------------------

-- 
-- Table structure for table `user_phone_no`
-- 

CREATE TABLE `user_phone_no` (
  `id` int(12) NOT NULL auto_increment,
  `user_id` int(12) NOT NULL,
  `phone_no_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `clinic_id` (`phone_no_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- 
-- Dumping data for table `user_phone_no`
-- 

INSERT INTO `user_phone_no` (`id`, `user_id`, `phone_no_id`) VALUES 
(32, 18, 91),
(33, 19, 92),
(34, 20, 93),
(35, 21, 94),
(36, 22, 95),
(37, 23, 96),
(38, 24, 97),
(39, 25, 98),
(40, 26, 99),
(41, 27, 100),
(42, 28, 101),
(43, 29, 102),
(44, 30, 103),
(45, 31, 104),
(46, 32, 105),
(47, 33, 106),
(48, 34, 107),
(49, 35, 108),
(50, 36, 109),
(51, 37, 110);

-- --------------------------------------------------------

-- 
-- Table structure for table `visit_doc_time`
-- 

CREATE TABLE `visit_doc_time` (
  `id` int(11) NOT NULL auto_increment,
  `visit_doc_clinic_id` int(11) NOT NULL,
  `start` varchar(100) NOT NULL,
  `till` varchar(100) NOT NULL,
  `day` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `visiting_doctor_id` (`visit_doc_clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `visit_doc_time`
-- 

INSERT INTO `visit_doc_time` (`id`, `visit_doc_clinic_id`, `start`, `till`, `day`) VALUES 
(1, 5, '9:00:00 AM', '8:00:00 PM', 'monday'),
(2, 5, '9:00:00 AM', '8:00:00 PM', 'thursday'),
(3, 5, '10:00:00 AM', '9:00:00 PM', 'saturday'),
(4, 6, '10:00:00 AM', '10:00:00 PM', 'tuesday'),
(5, 6, '10:00:00 AM', '10:00:00 PM', 'wednesday'),
(6, 7, '11:00:00 AM', '4:00:00 PM', 'friday'),
(7, 8, '2:00:00 AM', '2:00:00 AM', 'Tuesday'),
(8, 8, '2:00:00 AM', '2:00:00 AM', 'Tuesday'),
(9, 9, '10:00:00 AM', '3:00:00 PM', 'monday'),
(10, 9, '10:00:00 AM', '3:00:00 PM', 'friday'),
(11, 9, '10:00:00 AM', '1:00:00 PM', 'sunday'),
(12, 10, '9:00:00 AM', '9:00:00 PM', 'thursday'),
(13, 10, '9:00:00 AM', '9:00:00 PM', 'friday'),
(14, 11, '9:00:00 AM', '6:00:00 PM', 'wednesday'),
(15, 11, '8:00:00 AM', '8:00:00 PM', 'thursday'),
(16, 12, '2:00:00 PM', '9:00:00 PM', 'tuesday'),
(17, 12, '2:00:00 PM', '9:00:00 PM', 'thursday'),
(18, 12, '10:00:00 AM', '2:00:00 PM', 'sunday'),
(19, 13, '9:00:00 AM', '10:00:00 PM', 'thursday'),
(20, 13, '9:00:00 AM', '8:00:00 PM', 'saturday'),
(21, 14, '7:00:00 PM', '9:00:00 PM', 'thursday'),
(22, 16, '9:00:00 AM', '6:00:00 PM', 'friday'),
(23, 16, '9:00:00 AM', '6:00:00 PM', 'saturday');

-- --------------------------------------------------------

-- 
-- Table structure for table `visiting_doctor`
-- 

CREATE TABLE `visiting_doctor` (
  `id` int(12) NOT NULL auto_increment,
  `user_id` int(12) NOT NULL,
  `speciality` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `visiting_doctor`
-- 

INSERT INTO `visiting_doctor` (`id`, `user_id`, `speciality`) VALUES 
(5, 19, 'teeth'),
(6, 20, 'General Dentist'),
(7, 21, 'Pediatric Dentist'),
(8, 23, 'orthodontists'),
(9, 24, 'General Dentist'),
(10, 26, 'homeopath'),
(11, 29, 'Aesthetic'),
(12, 31, 'eyes'),
(13, 32, 'eyes'),
(14, 33, 'diabities'),
(15, 34, 'dentist'),
(16, 35, 'general'),
(17, 36, 'homeopath');

-- --------------------------------------------------------

-- 
-- Table structure for table `visiting_doctor_clinic`
-- 

CREATE TABLE `visiting_doctor_clinic` (
  `id` int(12) NOT NULL auto_increment,
  `clinic_id` int(12) NOT NULL,
  `visiting_doctor_id` int(12) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `clinic_id` (`clinic_id`),
  KEY `visiting_doctor_id` (`visiting_doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `visiting_doctor_clinic`
-- 

INSERT INTO `visiting_doctor_clinic` (`id`, `clinic_id`, `visiting_doctor_id`) VALUES 
(5, 12, 5),
(6, 12, 6),
(7, 12, 7),
(8, 13, 8),
(9, 13, 9),
(10, 14, 10),
(11, 15, 11),
(12, 16, 12),
(13, 16, 13),
(14, 15, 14),
(15, 15, 15),
(16, 16, 16),
(17, 13, 17);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `activation`
-- 
ALTER TABLE `activation`
  ADD CONSTRAINT `activation_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `address`
-- 
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `appointment`
-- 
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patient_clinic_id`) REFERENCES `patient_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `area`
-- 
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `city`
-- 
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `doctor`
-- 
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `doctor_clinic`
-- 
ALTER TABLE `doctor_clinic`
  ADD CONSTRAINT `doctor_clinic_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_clinic_ibfk_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `login`
-- 
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_email_id`) REFERENCES `user_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `medical_history`
-- 
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_10` FOREIGN KEY (`dieses_id`) REFERENCES `dieses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_history_ibfk_9` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Constraints for table `medicine_clinic`
-- 
ALTER TABLE `medicine_clinic`
  ADD CONSTRAINT `medicine_clinic_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_clinic_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `medicine_company`
-- 
ALTER TABLE `medicine_company`
  ADD CONSTRAINT `medicine_company_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_company_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `medicine_content`
-- 
ALTER TABLE `medicine_content`
  ADD CONSTRAINT `medicine_content_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_content_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `mr_address`
-- 
ALTER TABLE `mr_address`
  ADD CONSTRAINT `mr_address_ibfk_1` FOREIGN KEY (`mr_id`) REFERENCES `mr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mr_address_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `mr_clinic`
-- 
ALTER TABLE `mr_clinic`
  ADD CONSTRAINT `mr_clinic_ibfk_1` FOREIGN KEY (`mr_id`) REFERENCES `mr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mr_clinic_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `mr_company`
-- 
ALTER TABLE `mr_company`
  ADD CONSTRAINT `mr_company_ibfk_1` FOREIGN KEY (`mr_id`) REFERENCES `mr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mr_company_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `mr_email`
-- 
ALTER TABLE `mr_email`
  ADD CONSTRAINT `mr_email_ibfk_1` FOREIGN KEY (`mr_id`) REFERENCES `mr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `mr_medicine`
-- 
ALTER TABLE `mr_medicine`
  ADD CONSTRAINT `mr_medicine_ibfk_1` FOREIGN KEY (`mr_id`) REFERENCES `mr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mr_medicine_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `mr_phone_no`
-- 
ALTER TABLE `mr_phone_no`
  ADD CONSTRAINT `mr_phone_no_ibfk_1` FOREIGN KEY (`mr_id`) REFERENCES `mr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `patient_address`
-- 
ALTER TABLE `patient_address`
  ADD CONSTRAINT `patient_address_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_address_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `patient_clinic`
-- 
ALTER TABLE `patient_clinic`
  ADD CONSTRAINT `patient_clinic_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_clinic_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `patient_email`
-- 
ALTER TABLE `patient_email`
  ADD CONSTRAINT `patient_email_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `patient_phone_no`
-- 
ALTER TABLE `patient_phone_no`
  ADD CONSTRAINT `patient_phone_no_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `post_treatment`
-- 
ALTER TABLE `post_treatment`
  ADD CONSTRAINT `post_treatment_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `pre_treatment`
-- 
ALTER TABLE `pre_treatment`
  ADD CONSTRAINT `pre_treatment_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `prescription`
-- 
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `renual`
-- 
ALTER TABLE `renual`
  ADD CONSTRAINT `renual_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `renual_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `treatment`
-- 
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `treatment_ibfk_2` FOREIGN KEY (`dieses_id`) REFERENCES `dieses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `user_address`
-- 
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `user_email`
-- 
ALTER TABLE `user_email`
  ADD CONSTRAINT `user_email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_email_ibfk_2` FOREIGN KEY (`email_id`) REFERENCES `email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `user_phone_no`
-- 
ALTER TABLE `user_phone_no`
  ADD CONSTRAINT `user_phone_no_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_phone_no_ibfk_2` FOREIGN KEY (`phone_no_id`) REFERENCES `phone_no` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `visit_doc_time`
-- 
ALTER TABLE `visit_doc_time`
  ADD CONSTRAINT `visit_doc_time_ibfk_1` FOREIGN KEY (`visit_doc_clinic_id`) REFERENCES `visiting_doctor_clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `visiting_doctor`
-- 
ALTER TABLE `visiting_doctor`
  ADD CONSTRAINT `visiting_doctor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `visiting_doctor_clinic`
-- 
ALTER TABLE `visiting_doctor_clinic`
  ADD CONSTRAINT `visiting_doctor_clinic_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visiting_doctor_clinic_ibfk_2` FOREIGN KEY (`visiting_doctor_id`) REFERENCES `visiting_doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
