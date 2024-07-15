-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 12:35 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `password` varchar(18) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `phone_number`, `password`, `login_date`) VALUES
(1, 'John Doe', 'admin', 'johndoe@example.com', '1234567890', 'admin', '2024-04-06 03:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `admin_event_details`
--

CREATE TABLE `admin_event_details` (
  `id` int(5) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `event_date` date NOT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_event_details`
--

INSERT INTO `admin_event_details` (`id`, `event_type`, `event_date`, `status`, `booking_time`) VALUES
(1, 'Bday Event', '2024-04-18', 'pending', '2024-04-11 15:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_details`
--

CREATE TABLE `admin_user_details` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user_details`
--

INSERT INTO `admin_user_details` (`id`, `name`, `email`, `password`) VALUES
(1, 'mihir', 'dodiya@gmail.com', '123'),
(2, 'pratik', 'joshi@gmail.com', '111');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `number` varchar(12) DEFAULT NULL,
  `subject` varchar(25) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `number`, `subject`, `message`, `created_at`) VALUES
(1, 'mihir', 'dodiya@gmail.com', '5252528558', 'event', 'good work', '2024-04-11 14:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `event_history`
--

CREATE TABLE `event_history` (
  `id` int(5) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `event_date` date NOT NULL,
  `status` varchar(10) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_history`
--

INSERT INTO `event_history` (`id`, `event_type`, `event_date`, `status`) VALUES
(1, 'Bday Event', '2024-04-18', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(5) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `venue` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `middle_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) NOT NULL,
  `num_of_guests` int(10) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_date` date NOT NULL,
  `status` varchar(10) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `event_type`, `venue`, `price`, `first_name`, `middle_name`, `last_name`, `num_of_guests`, `address`, `email`, `phone`, `registration_date`, `event_date`, `status`) VALUES
(1, 'Bday Event', 'Laxmi Vilas Palace, Baroda', '20000.00', 'Mihir', 'Dodiya', 'Shailesbhai', 10, 'gujarat', 'mihir@gmail.com', '123', '2024-04-11 15:03:31', '2024-04-18', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `sign_up`
--

CREATE TABLE `sign_up` (
  `ID` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `password` varchar(16) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sign_up`
--

INSERT INTO `sign_up` (`ID`, `name`, `username`, `email`, `phone_number`, `password`, `login_date`) VALUES
(1, 'mihir', 'mihir', 'dodiya@gmail.com', '9998429565', '123', '2024-04-13 10:28:34'),
(2, 'pratik', 'joshi', 'joshi@gmail.com', '9798989898', '111', '2024-04-13 10:29:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_event_details`
--
ALTER TABLE `admin_event_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_details`
--
ALTER TABLE `admin_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_history`
--
ALTER TABLE `event_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_up`
--
ALTER TABLE `sign_up`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_event_details`
--
ALTER TABLE `admin_event_details`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_user_details`
--
ALTER TABLE `admin_user_details`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_history`
--
ALTER TABLE `event_history`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sign_up`
--
ALTER TABLE `sign_up`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
