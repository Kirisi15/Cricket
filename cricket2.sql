-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 09:07 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` varchar(10) NOT NULL,
  `adminUsername` varchar(20) NOT NULL,
  `adminPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminUsername`, `adminPassword`) VALUES
('A001', 'adminUser1', 'pass123'),
('A002', 'adminUser2', 'pass456'),
('A003', 'adminUser3', 'pass789'),
('A004', 'adminUser4', 'pass012'),
('A005', 'adminUser5', 'pass345'),
('A006', 'adminUser6', 'pass678'),
('A007', 'adminUser7', 'pass901'),
('A008', 'adminUser8', 'pass234'),
('A009', 'adminUser9', 'pass567'),
('A010', 'adminUser10', 'pass890');

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

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`matchId`, `organizerId`, `teamIdA`, `teamIdB`, `date`, `time`, `venue`, `scoreTeamA`, `scoreTeamB`, `winningTeam`) VALUES
('M001', 'O001', 'T001', 'T002', '2024-10-10', '14:00:00', 'Stadium A', 250, 220, 'Team A'),
('M002', 'O002', 'T003', 'T004', '2024-10-11', '10:00:00', 'Stadium B', 180, 200, 'Team B'),
('M003', 'O003', 'T005', 'T006', '2024-10-12', '11:00:00', 'Stadium C', 230, 210, 'Team A'),
('M004', 'O004', 'T007', 'T008', '2024-10-13', '16:00:00', 'Stadium D', 190, 190, 'Draw'),
('M005', 'O005', 'T009', 'T010', '2024-10-14', '13:00:00', 'Stadium E', 240, 260, 'Team B'),
('M006', 'O001', 'T001', 'T004', '2024-10-15', '12:00:00', 'Stadium F', 200, 180, 'Team A'),
('M007', 'O002', 'T003', 'T006', '2024-10-16', '09:00:00', 'Stadium G', 270, 220, 'Team A'),
('M008', 'O003', 'T005', 'T008', '2024-10-17', '17:00:00', 'Stadium H', 300, 280, 'Team A'),
('M009', 'O004', 'T007', 'T002', '2024-10-18', '15:00:00', 'Stadium I', 190, 200, 'Team B'),
('M010', 'O005', 'T009', 'T001', '2024-10-19', '08:00:00', 'Stadium J', 210, 210, 'Draw');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `organizerId` varchar(10) NOT NULL,
  `organizerUsername` varchar(20) NOT NULL,
  `orgainzerPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`organizerId`, `organizerUsername`, `orgainzerPassword`) VALUES
('O001', 'organizer1', 'orgPass1'),
('O002', 'organizer2', 'orgPass2'),
('O003', 'organizer3', 'orgPass3'),
('O004', 'organizer4', 'orgPass4'),
('O005', 'organizer5', 'orgPass5'),
('O006', 'organizer6', 'orgPass6'),
('O007', 'organizer7', 'orgPass7'),
('O008', 'organizer8', 'orgPass8'),
('O009', 'organizer9', 'orgPass9'),
('O010', 'organizer10', 'orgPass10');

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

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerId`, `playerName`, `contactNumber`, `playerImage`, `teamName`, `role`) VALUES
('P001', 'John Doe', 1234567890, 'john_doe.jpg', 'Team A', 'Batsman'),
('P002', 'Jane Smith', 1234567891, 'jane_smith.jpg', 'Team B', 'Bowler'),
('P003', 'Tom Brown', 1234567892, 'tom_brown.jpg', 'Team C', 'All-rounder'),
('P004', 'Alice Johnson', 1234567893, 'alice_johnson.jpg', 'Team A', 'Wicketkeeper'),
('P005', 'Bob White', 1234567894, 'bob_white.jpg', 'Team B', 'Batsman'),
('P006', 'Lisa Black', 1234567895, 'lisa_black.jpg', 'Team D', 'Bowler'),
('P007', 'Mike Green', 1234567896, 'mike_green.jpg', 'Team A', 'Batsman'),
('P008', 'Nina Blue', 1234567897, 'nina_blue.jpg', 'Team C', 'All-rounder'),
('P009', 'David Gray', 1234567898, 'david_gray.jpg', 'Team B', 'Wicketkeeper'),
('P010', 'Sara Red', 1234567899, 'sara_red.jpg', 'Team D', 'Bowler');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `teamId` int(11) NOT NULL,
  `teamUsername` varchar(20) NOT NULL,
  `paymentStatus` tinyint(1) NOT NULL,
  `managerName` text NOT NULL,
  `teamLogo` varchar(20) NOT NULL,
  `teamName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`teamId`, `teamUsername`, `paymentStatus`, `managerName`, `teamLogo`, `teamName`) VALUES
(1, 'teamA', 1, 'Manager A', 'logoA.png', 'Team A'),
(2, 'teamB', 1, 'Manager B', 'logoB.png', 'Team B'),
(3, 'teamC', 1, 'Manager C', 'logoC.png', 'Team C'),
(4, 'teamD', 1, 'Manager D', 'logoD.png', 'Team D'),
(5, 'teamE', 1, 'Manager E', 'logoE.png', 'Team E'),
(6, 'teamF', 1, 'Manager F', 'logoF.png', 'Team F'),
(7, 'teamG', 1, 'Manager G', 'logoG.png', 'Team G'),
(8, 'teamH', 1, 'Manager H', 'logoH.png', 'Team H'),
(9, 'teamI', 1, 'Manager I', 'logoI.png', 'Team I'),
(10, 'teamJ', 1, 'Manager J', 'logoJ.png', 'Team J'),
(11, 'ff', 1, 'ddd', 'ee', 'eee'),
(12, 'ff', 1, 'ddd', 'ee', 'eee');

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
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_teamId` (`teamId`);

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorizeduser`
--
ALTER TABLE `authorizeduser`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
