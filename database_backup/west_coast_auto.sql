-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2015 at 08:24 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `west_coast_auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_brand`
--

CREATE TABLE IF NOT EXISTS `car_brand` (
  `manufacturer` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_brand`
--

INSERT INTO `car_brand` (`manufacturer`) VALUES
('Ford'),
('Holden'),
('Mazda'),
('Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `car_fuel`
--

CREATE TABLE IF NOT EXISTS `car_fuel` (
  `fuel` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_fuel`
--

INSERT INTO `car_fuel` (`fuel`) VALUES
('AutoGas'),
('Diesel'),
('Hybrid'),
('Premium Unleaded'),
('Unleaded');

-- --------------------------------------------------------

--
-- Table structure for table `car_trans`
--

CREATE TABLE IF NOT EXISTS `car_trans` (
  `transmission` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_trans`
--

INSERT INTO `car_trans` (`transmission`) VALUES
('Automatic'),
('Manual');

-- --------------------------------------------------------

--
-- Table structure for table `car_types`
--

CREATE TABLE IF NOT EXISTS `car_types` (
  `category` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_types`
--

INSERT INTO `car_types` (`category`) VALUES
('4WD'),
('Hatch'),
('Sedan'),
('Wagon');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
`client_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`name`, `address`, `phone`, `email`, `client_id`) VALUES
('John Smith', '123 North Street Brisbane QLD 4000', '0405816652', 'johnsmith@hotmail.com', 1),
('Amy Smith', '123 North Street Brisbane QLD 4000', '0451232874', 'amysmith@live.com.au', 2),
('Jake Brown', '123 North Street Brisbane QLD 4000', '04875646', 'jbrown@hotmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
`staff_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(17) NOT NULL,
  `password` varchar(32) NOT NULL,
  `security` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `phone`, `email`, `username`, `password`, `security`) VALUES
(1, 'Joe Blogs', '0436889212', 'jblogs@wca.com.au', 'jblogs', '5f4dcc3b5aa765d61d8327deb882cf99', 'secure_1'),
(2, 'Bob Jones', '54685877', 'bjones@wca.com.au', 'bjones', '5f4dcc3b5aa765d61d8327deb882cf99', 'secure_2'),
(3, 'Michael Smith', '0456887959', 'msmith@wca.com.au', 'msmith', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(4, 'Gary Wehl', '46985546', 'gwehl@wca.com.au', 'gwehl', '5f4dcc3b5aa765d61d8327deb882cf99', 'secure_1'),
(5, 'Chris Moore', '46247542', 'cmoore@wca.com.au', 'cmoore', '5f4dcc3b5aa765d61d8327deb882cf99', 'secure_1');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `category` varchar(256) NOT NULL,
  `manufacturer` varchar(256) NOT NULL,
  `model` text NOT NULL,
  `price` varchar(12) NOT NULL,
  `colour` text NOT NULL,
  `photo` text NOT NULL,
  `special` bit(1) NOT NULL,
  `kilometres` varchar(14) NOT NULL,
  `cylinders` int(11) NOT NULL,
  `transmission` varchar(256) NOT NULL,
  `vin` varchar(12) NOT NULL,
  `fuel` varchar(256) NOT NULL,
  `registration` text NOT NULL,
  `year` int(4) NOT NULL,
`vehicle_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`category`, `manufacturer`, `model`, `price`, `colour`, `photo`, `special`, `kilometres`, `cylinders`, `transmission`, `vin`, `fuel`, `registration`, `year`, `vehicle_id`, `client_id`, `staff_id`) VALUES
('4WD', 'Toyota', 'Landcruiser', '25000', 'Black', 'images/black_4wd_22_05_2015.jpg', b'0', '40000', 6, 'Manual', '214748364755', 'Diesel', '100SER', 2013, 1, NULL, NULL),
('Hatch', 'Mazda', 'Mazda 2 Maxx', '14999', 'Black Mica', 'images/blackmica_hatch_22_05_2015.jpg', b'1', '100', 4, 'Automatic', '554812111367', 'Premium Unleaded', '', 2015, 2, NULL, NULL),
('Sedan', 'Ford', 'Focus', '32000', 'Red', 'images/red_sedan_24_06_2015.jpg', b'1', '75000', 6, 'Automatic', '214644364755', 'Premium Unleaded', '611REG', 2014, 3, NULL, NULL),
('4WD', 'Holden', 'Adventra CX6', '7990', 'Silver', 'images/silver_4wd_25_6_2015.jpg', b'1', '160000', 6, 'Automatic', '454875213654', 'Unleaded', '876SFG', 2006, 4, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_brand`
--
ALTER TABLE `car_brand`
 ADD PRIMARY KEY (`manufacturer`);

--
-- Indexes for table `car_fuel`
--
ALTER TABLE `car_fuel`
 ADD PRIMARY KEY (`fuel`);

--
-- Indexes for table `car_trans`
--
ALTER TABLE `car_trans`
 ADD PRIMARY KEY (`transmission`);

--
-- Indexes for table `car_types`
--
ALTER TABLE `car_types`
 ADD PRIMARY KEY (`category`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
 ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
