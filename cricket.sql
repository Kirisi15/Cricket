-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 02:13 PM
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
  `adminId` int(11) NOT NULL,
  `adminUsername` varchar(20) NOT NULL,
  `adminPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminUsername`, `adminPassword`) VALUES
(1, 'adminUser1', 'password1'),
(2, 'adminUser2', 'password2'),
(3, 'adminUser3', 'password3'),
(4, 'adminUser4', 'password4'),
(5, 'adminUser5', 'password5'),
(6, 'adminUser6', 'password6'),
(7, 'adminUser7', 'password7'),
(8, 'adminUser8', 'password8'),
(9, 'adminUser9', 'password9'),
(10, 'adminUser10', 'password10');

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
(24, 'userA@gmail.com', 'authUserA', 'authPassA', '1'),
(25, 'userB@gmail.com', 'authUserB', 'authPassB', '2'),
(26, 'userC@gmail.com', 'authUserC', 'authPassC', '3'),
(27, 'userD@gmail.com', 'authUserD', 'authPassD', '4'),
(28, 'userE@gmail.com', 'authUserE', 'authPassE', '5'),
(29, 'userF@gmail.com', 'authUserF', 'authPassF', '6'),
(30, 'userG@gmail.com', 'authUserG', 'authPassG', '7'),
(31, 'userH@gmail.com', 'authUserH', 'authPassH', '8'),
(32, 'userI@gmail.com', 'authUserI', 'authPassI', '9');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `matchId` int(11) NOT NULL,
  `organizerId` varchar(10) NOT NULL,
  `teamIdA` varchar(10) NOT NULL,
  `teamIdB` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` text NOT NULL,
  `scoreTeamA` int(10) DEFAULT NULL,
  `scoreTeamB` int(10) DEFAULT NULL,
  `winningTeam` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`matchId`, `organizerId`, `teamIdA`, `teamIdB`, `date`, `time`, `venue`, `scoreTeamA`, `scoreTeamB`, `winningTeam`) VALUES
(11, '1', 'Team A', 'Team B', '2024-10-01', '10:00:00', 'Stadium A', 250, 245, 'Team A'),
(12, '2', 'Team A', 'Team C', '2024-10-02', '12:00:00', 'Stadium B', 200, 180, 'Team A'),
(13, '3', 'Team B', 'Team C', '2024-10-03', '14:00:00', 'Stadium C', 300, 310, 'Team B'),
(14, '4', 'Team A', 'Team D', '2024-10-04', '16:00:00', 'Stadium D', 220, 220, 'Draw'),
(15, '5', 'Team B', 'Team D', '2024-10-05', '18:00:00', 'Stadium E', 180, 190, 'Team B'),
(16, '6', 'Team C', 'Team D', '2024-10-06', '10:00:00', 'Stadium F', 150, 160, 'Team D'),
(17, '7', 'Team A', 'Team E', '2024-10-07', '12:00:00', 'Stadium G', 270, 260, 'Team A'),
(18, '8', 'Team B', 'Team E', '2024-10-08', '14:00:00', 'Stadium H', 220, 230, 'Team B'),
(19, '9', 'Team C', 'Team E', '2024-10-09', '16:00:00', 'Stadium I', 290, 295, 'Team E'),
(20, '10', 'Team D', 'Team E', '2024-10-30', '18:00:00', 'Stadium J', 210, 205, 'a'),
(21, '1', '2', '5', '2024-10-10', '17:31:00', 'sss', 224, 111, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `organizerId` int(11) NOT NULL,
  `organizerUsername` varchar(20) NOT NULL,
  `organizerPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`organizerId`, `organizerUsername`, `organizerPassword`) VALUES
(1, 'organizerA', 'passA123'),
(2, 'organizerB', 'passB123'),
(3, 'organizerC', 'passC123'),
(4, 'organizerD', 'passD123'),
(5, 'organizerE', 'passE123'),
(6, 'organizerF', 'passF123'),
(7, 'organizerG', 'passG123'),
(8, 'organizerH', 'passH123'),
(9, 'organizerI', 'passI123'),
(10, 'organizerJ', 'passJ123');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `playerId` int(11) NOT NULL,
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
(1, 'Player 1A', 1234567890, 'images/player1a.jpg', 'Team A', 'Batsman'),
(2, 'Player 2A', 1234567891, 'images/player2a.jpg', 'Team A', 'Bowler'),
(3, 'Player 3A', 1234567892, 'images/player3a.jpg', 'Team A', 'All-rounder'),
(4, 'Player 4A', 1234567893, 'images/player4a.jpg', 'Team A', 'Wicketkeeper'),
(5, 'Player 5A', 1234567894, 'images/player5a.jpg', 'Team A', 'Batsman'),
(6, 'Player 6B', 1234567895, 'images/player6b.jpg', 'Team B', 'Bowler'),
(7, 'Player 7B', 1234567896, 'images/player7b.jpg', 'Team B', 'All-rounder'),
(8, 'Player 8B', 1234567897, 'images/player8b.jpg', 'Team B', 'Batsman'),
(9, 'Player 9B', 1234567898, 'images/player9b.jpg', 'Team B', 'Wicketkeeper'),
(10, 'Player 10B', 1234567899, 'images/player10b.jpg', 'Team B', 'Bowler'),
(11, 'Player 11C', 1234567800, 'images/player11c.jpg', 'Team C', 'All-rounder'),
(12, 'Player 12C', 1234567801, 'images/player12c.jpg', 'Team C', 'Batsman'),
(13, 'Player 13C', 1234567802, 'images/player13c.jpg', 'Team C', 'Bowler'),
(14, 'Player 14C', 1234567803, 'images/player14c.jpg', 'Team C', 'Wicketkeeper'),
(15, 'Player 15C', 1234567804, 'images/player15c.jpg', 'Team C', 'Batsman'),
(16, 'Player 16D', 1234567805, 'images/player16d.jpg', 'Team D', 'Bowler'),
(17, 'Player 17D', 1234567806, 'images/player17d.jpg', 'Team D', 'All-rounder'),
(18, 'Player 18D', 1234567807, 'images/player18d.jpg', 'Team D', 'Batsman'),
(19, 'Player 19D', 1234567808, 'images/player19d.jpg', 'Team D', 'Wicketkeeper'),
(20, 'Player 20D', 1234567809, 'images/player20d.jpg', 'Team D', 'Bowler');

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `authorizeduser`
--
ALTER TABLE `authorizeduser`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `matchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `organizerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
