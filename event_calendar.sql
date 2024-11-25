-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_calendar`
--
CREATE DATABASE IF NOT EXISTS `event_calendar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `event_calendar`;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_description` varchar(255) DEFAULT NULL,
  `sport_fk` int(11) NOT NULL,
  `location_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_date`, `event_time`, `event_description`, `sport_fk`, `location_fk`) VALUES
(1, '2024-11-18', '18:30:00', 'Football match between Real Madrid and Manchester United', 1, 1),
(2, '2024-12-05', '20:00:00', 'Football match between Bayern Munich and Paris Saint-Germain', 1, 2),
(3, '2024-11-20', '19:00:00', 'Basketball match between Los Angeles Lakers and Boston Celtics', 2, 3),
(4, '2024-11-25', '09:45:00', 'Ice Hockey match between KAC and Vienna Capitals', 3, 4),
(8, '2024-11-18', '15:00:00', 'Football match between Liverpool FC and Barcelona FC', 1, 5),
(9, '2024-11-18', '18:30:00', 'Basketball match between Los Angeles Lakers and Chicago Bulls', 2, 3),
(10, '2024-11-18', '20:00:00', 'Ice Hockey match between Toronto Maple Leafs and Boston Bruins', 3, 6),
(21, '2024-11-20', '21:30:00', 'Basketball match between Chicago Bull and Boston Celtics', 2, 6),
(22, '2024-11-24', '18:15:00', 'Football match between Real Madrid and Barcelona FC', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `event_teams`
--

CREATE TABLE `event_teams` (
  `event_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_teams`
--

INSERT INTO `event_teams` (`event_id`, `team_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 7),
(3, 8),
(4, 5),
(4, 6),
(8, 9),
(8, 10),
(9, 7),
(9, 12),
(10, 13),
(10, 14),
(21, 8),
(21, 12),
(22, 1),
(22, 10);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `address`) VALUES
(1, 'Santiago Bernabéu Stadium', 'Madrid, Spain'),
(2, 'Old Trafford Stadium', 'Manchester, England'),
(3, 'Staples Center', 'Los Angeles, USA'),
(4, 'Wiener Stadthalle', 'Vienna, Austria'),
(5, 'Wembley Stadium', 'London, United Kingdom'),
(6, 'Scotiabank Arena', 'Toronto, Canada');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `sport_id` int(11) NOT NULL,
  `sport_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sport_id`, `sport_name`) VALUES
(1, 'Football'),
(2, 'Basketball'),
(3, 'Ice Hockey');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `team_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_info`) VALUES
(1, 'Real Madrid', 'Spanish Football Team'),
(2, 'Manchester United', 'English Football Team'),
(3, 'Bayern Munich', 'German Football Team'),
(4, 'Paris Saint-Germain', 'French Football Team'),
(5, 'KAC', 'Austrian Ice Hockey Team'),
(6, 'Vienna Capitals', 'Austrian Ice Hockey Team'),
(7, 'Los Angeles Lakers', 'American Basketball Team'),
(8, 'Boston Celtics', 'American Basketball Team'),
(9, 'Liverpool FC', 'Football team from England'),
(10, 'Barcelona FC', 'Football team from Spain'),
(11, 'Los Angeles Lakers', 'Basketball team from USA'),
(12, 'Chicago Bulls', 'Basketball team from USA'),
(13, 'Toronto Maple Leafs', 'Ice Hockey team from Canada'),
(14, 'Boston Bruins', 'Ice Hockey team from USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fk_sport` (`sport_fk`),
  ADD KEY `fk_location` (`location_fk`);

--
-- Indexes for table `event_teams`
--
ALTER TABLE `event_teams`
  ADD PRIMARY KEY (`event_id`,`team_id`),
  ADD KEY `fk_team` (`team_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_location` FOREIGN KEY (`location_fk`) REFERENCES `location` (`location_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_sport` FOREIGN KEY (`sport_fk`) REFERENCES `sports` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_teams`
--
ALTER TABLE `event_teams`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_team` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
