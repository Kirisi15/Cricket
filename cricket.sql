-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 05:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
git init
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` varchar(10) NOT NULL,
  `adminUsername` varchar(20) NOT NULL,
  `adminPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authorizeduser`
--

CREATE TABLE `authorizeduser` (
  `userId` varchar(10) NOT NULL,
  `gmail` varchar(30) NOT NULL,
  `authorizedUsername` varchar(20) NOT NULL,
  `authorizedPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `matchId` varchar(10) NOT NULL,
  `organizerId` varchar(10) NOT NULL,
  `teamIdA` varchar(10) NOT NULL,
  `teamIdB` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` text NOT NULL,
  `scoreTeamA` int(10) NOT NULL,
  `scoreTeamB` int(10) NOT NULL,
  `winningTeam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `organizerId` varchar(10) NOT NULL,
  `organizerUsername` varchar(20) NOT NULL,
  `orgainzerPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `playerId` varchar(10) NOT NULL,
  `playerName` text NOT NULL,
  `contactNumber` int(10) NOT NULL,
  `playerImage` varchar(20) NOT NULL,
  `teamName` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `teamId` varchar(10) NOT NULL,
  `teamUsername` varchar(20) NOT NULL,
  `teamPassword` varchar(10) NOT NULL,
  `paymentStatus` tinyint(1) NOT NULL,
  `managerName` text NOT NULL,
  `teamLogo` varchar(20) NOT NULL,
  `teamName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `authorizeduser`
--
ALTER TABLE `authorizeduser`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matchId`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`organizerId`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`playerId`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
