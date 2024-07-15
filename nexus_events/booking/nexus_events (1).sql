-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 05:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexus_events`
--
CREATE DATABASE IF NOT EXISTS `nexus_events` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nexus_events`;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `venue` varchar(20) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_type`, `venue`, `price`) VALUES
(1, 'virtual', 'venue1', NULL),
(2, '', '', NULL),
(3, '', '', NULL),
(4, '', '', NULL),
(5, '', '', NULL),
(6, '', '', NULL),
(7, '', '', NULL),
(8, '', '', NULL),
(9, '', '', NULL),
(10, '', '', NULL),
(11, '', '', NULL),
(12, 'social', 'venue3', NULL),
(13, '', '', NULL),
(14, '', '', NULL),
(15, 'Virtual Event', 'Venue 2', NULL),
(16, 'Wedding', 'Venue 2', NULL),
(17, 'Wedding', 'Venue 2', NULL),
(18, '', 'Venue 2', NULL),
(19, '', 'Venue 1', NULL),
(20, 'Wedding', 'Venue 1', NULL),
(21, 'Wedding', 'Venue 1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `num_of_guests` int(11) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_type`, `venue`, `price`, `first_name`, `middle_name`, `last_name`, `num_of_guests`, `address`, `email`, `phone`, `registration_date`, `event_date`) VALUES
(133, 'Wedding Event', 'Effice Sarovar Portico, Bhavnagar', '15000.00', 'mihir', 'dodiya', 'shaileshbhai', 200, 'gujarat', 'dodiyamihir11@gmail.com', '4878724', '2024-03-31 02:02:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
