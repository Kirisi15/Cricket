-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 05:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorizeduser`
--

CREATE TABLE `authorizeduser` (
  `userId` int(11) NOT NULL,
  `gmail` varchar(30) NOT NULL,
  `authorizedUsername` varchar(20) NOT NULL,
  `authorizedPassword` varchar(10) NOT NULL,
  `teamId` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authorizeduser`
--

INSERT INTO `authorizeduser` (`userId`, `gmail`, `authorizedUsername`, `authorizedPassword`, `teamId`) VALUES
(12, 'vx@gmail.com', 'eeee', 'edeqwd', NULL),
(13, 'userA@gmail.com', 'authUserA', 'authPassA', '1'),
(14, 'userB@gmail.com', 'authUserB', 'authPassB', '2'),
(15, 'userC@gmail.com', 'authUserC', 'authPassC', '3'),
(16, 'userD@gmail.com', 'authUserD', 'authPassD', '4'),
(17, 'userE@gmail.com', 'authUserE', 'authPassE', '5'),
(18, 'userF@gmail.com', 'authUserF', 'authPassF', '6'),
(19, 'userG@gmail.com', 'authUserG', 'authPassG', '7'),
(20, 'userH@gmail.com', 'authUserH', 'authPassH', '8'),
(21, 'userI@gmail.com', 'authUserI', 'authPassI', '9'),
(22, 'userJ@gmail.com', 'authUserJ', 'authPassJ', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorizeduser`
--
ALTER TABLE `authorizeduser`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_teamId` (`teamId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorizeduser`
--
ALTER TABLE `authorizeduser`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
