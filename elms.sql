-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 08:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `active`) VALUES
(1, 'admin', 'admin@gmail.com', 'Admin123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `active`) VALUES
(1, 'Hr', 1),
(2, 'Admin', 1),
(3, 'Developer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `department` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `number` varchar(11) NOT NULL,
  `status` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `active` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `birth_date`, `department`, `address`, `city`, `number`, `status`, `image`, `active`) VALUES
(1, 'Ajay', 'chauhan', 'ajay@gmail.com', '$2y$10$jTQ2x.xZOsS/UqgxdJRFBuXPzr5p.MuO1bDOcym6A.JeW1b9PgMzq', 'Male', '2001-01-10', 3, 'Ahmedabad', 'Ahmedabad', '721081299', 1, '2.png', 1),
(2, 'Darshil', 'chauhan', 'darshil@gmail.com', '$2y$10$dEpnLMwBTZhdrxFkSyZSuuVJr8CemfN4DntecXGhM93X8p399Js7y', 'male', '2001-05-10', 2, 'Ahmedabad', 'Ahmedabad', '9685742571', 1, 'admin.jpg', 1),
(3, 'rahul', 'sharma', 'rahul@gmail.com', '$2y$10$rnJjXLlQrcnH13xzWsDic.PN.sfINemkn8P/l.FtKrCrWmhDiQW5m', 'male', '1993-09-10', 1, 'Ahmedabad', 'Ahmedabad', '9685742570', 1, '2.png', 1),
(4, 'ankur', 'desai', 'ankur@gmail.com', '$2y$10$/lERvTcdnHuO0MRTClQ9iuA0dOGU7.MNc4lSqNICtLAO6no99OFvS', 'male', '2001-02-20', 3, 'Ahmedabad', 'Ahmedabad', '9685742572', 1, 'admin.jpg', 1),
(5, 'Abhay', 'bhopala', 'abhay@gmail.com', '$2y$10$OUw.CLvCNoveVkuQohElh.dLsy3zwyLleiNw1SIshewrkgXruChka', 'male', '2005-02-10', 3, 'Ahmedabad', 'Ahmedabad', '9685742579', 1, 'download.jpg', 1),
(6, 'henil', 'shah', 'henil@gmail.com', '$2y$10$V/giVpBDH3RAZSb96qXZAOyxd7uH7Y6w4EIO7CAXgfCNUerX3CtL6', 'male', '2000-05-20', 3, 'amd', 'Ahmedabad', '9685742573', 1, 'admin.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `leaveid` int(11) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text NOT NULL,
  `status` int(5) NOT NULL,
  `active` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `empid`, `leaveid`, `dept_id`, `startdate`, `enddate`, `postdate`, `description`, `status`, `active`) VALUES
(1, 1, 2, 3, '2024-05-14', '2024-05-14', '2024-05-17 10:49:49', 'helth not good', 0, 1),
(2, 1, 4, 0, '2024-05-16', '2024-05-16', '2024-05-16 05:51:55', 'gffffffnv', 1, 1),
(3, 4, 5, 0, '2024-05-10', '2024-05-10', '2024-05-16 08:52:51', 'ghvgfvhfnth', 1, 1),
(4, 2, 1, 0, '2024-05-17', '2024-07-14', '2024-05-16 09:16:29', 'ffgcfcvgfcvfgcgbcf', 1, 1),
(5, 2, 1, 0, '2024-05-17', '2024-07-14', '2024-05-16 09:17:05', 'ffgcfcvgfcvfgcgbcf', 1, 1),
(6, 3, 6, 0, '2024-05-15', '2024-05-15', '2024-05-16 09:30:33', 'vghfvgvghvn gcn', 1, 1),
(7, 4, 4, 0, '2024-05-16', '2024-05-16', '2024-05-16 09:40:39', 'bnmvbmhvhnvjh', 1, 1),
(8, 3, 1, 0, '2024-05-10', '2024-05-16', '2024-05-16 09:44:06', 'bbjmnhjhmy', 1, 1),
(9, 2, 3, 0, '2024-05-16', '2024-05-17', '2024-05-16 10:00:23', '4474748', 1, 1),
(10, 2, 5, 0, '2024-05-16', '2024-05-16', '2024-05-16 10:14:43', '959595', 0, 1),
(11, 3, 3, 0, '2024-05-05', '2024-05-16', '2024-05-16 10:26:07', '5879546845874', 1, 1),
(12, 4, 6, 0, '2024-05-17', '2024-05-17', '2024-05-16 10:27:52', 'jnbbnj,bn', 1, 1),
(13, 3, 1, 0, '2024-05-16', '2024-05-16', '2024-05-16 10:51:16', '7487', 1, 1),
(14, 1, 3, 0, '2024-05-16', '2024-05-16', '2024-05-16 11:03:31', '5989', 1, 1),
(15, 3, 3, 0, '2024-05-16', '2024-05-16', '2024-05-16 11:08:07', '6546565', 1, 1),
(16, 4, 2, 0, '2024-05-16', '2024-05-16', '2024-05-16 11:20:49', '65265464', 1, 1),
(17, 3, 3, 0, '2024-05-31', '2024-05-31', '2024-05-16 11:32:59', '4545456', 1, 1),
(18, 3, 3, 0, '2024-05-31', '2024-05-31', '2024-05-16 11:33:03', '4545456', 1, 1),
(19, 3, 3, 0, '2024-05-31', '2024-05-31', '2024-05-16 11:33:06', '4545456', 1, 1),
(20, 3, 3, 0, '2024-05-31', '2024-05-31', '2024-05-16 11:34:24', '4545456', 1, 1),
(21, 3, 3, 0, '2024-05-31', '2024-05-31', '2024-05-16 11:38:44', '4545456', 1, 1),
(22, 3, 3, 0, '2024-05-16', '2024-05-18', '2024-05-16 11:39:13', '5555', 1, 1),
(23, 3, 3, 0, '2024-05-16', '2024-05-18', '2024-05-16 11:57:27', '5555', 1, 1),
(24, 4, 2, 0, '2024-05-16', '2024-05-24', '2024-05-16 11:57:50', '555654', 1, 1),
(25, 4, 2, 0, '2024-05-16', '2024-05-24', '2024-05-16 11:57:53', '555654', 1, 1),
(26, 2, 2, 0, '2024-05-16', '2024-05-17', '2024-05-16 13:11:51', 'n,njn,jkl', 1, 1),
(27, 3, 3, 0, '2024-05-16', '2024-05-17', '2024-05-16 13:16:17', 'nkjnmlknmkl', 1, 1),
(28, 2, 3, 0, '2024-05-30', '2024-05-31', '2024-05-16 13:20:35', 'lkmkmlkm56468', 1, 1),
(29, 4, 3, 0, '2024-05-09', '2024-05-24', '2024-05-16 13:33:42', '43', 1, 1),
(30, 1, 2, 0, '2024-05-17', '2024-05-18', '2024-05-17 04:48:29', 'jkhkjhbkj', 1, 1),
(31, 1, 2, 0, '2024-05-17', '2024-05-18', '2024-05-17 04:48:33', 'jkhkjhbkj', 1, 1),
(32, 2, 3, 0, '2024-05-22', '2024-05-29', '2024-05-17 05:02:39', 'vb nvnvnbvnbmnbmnb jn', 1, 1),
(33, 4, 4, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:11:51', 'bgvnvjh', 1, 1),
(34, 3, 3, 0, '2024-05-17', '2024-05-24', '2024-05-17 05:17:55', '5644165', 1, 1),
(35, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:23:09', 'vhvbmhjjv j', 1, 1),
(36, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:23:37', 'vhvbmhjjv j', 1, 1),
(37, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:23:56', 'vhvbmhjjv j', 1, 1),
(38, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:26:29', 'vhvbmhjjv j', 1, 1),
(39, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:26:32', 'vhvbmhjjv j', 1, 1),
(40, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:28:13', 'vhvbmhjjv j', 1, 1),
(41, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:29:23', 'vhvbmhjjv j', 1, 1),
(42, 4, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 05:29:50', 'vhvbmhjjv j', 1, 1),
(43, 2, 5, 0, '2024-05-17', '2024-05-17', '2024-05-17 05:34:21', 'kjl', 1, 1),
(44, 4, 4, 0, '2024-05-15', '2024-05-22', '2024-05-17 05:40:33', 'nm,nmnm,nm, ,m', 1, 1),
(45, 2, 5, 0, '2024-05-18', '2024-05-18', '2024-05-17 05:41:42', 'mnbnb mmn  mn bmn', 1, 1),
(46, 2, 5, 0, '2024-05-17', '2024-05-17', '2024-05-17 06:06:57', 'vbanvv bv', 1, 1),
(47, 2, 5, 0, '2024-05-17', '2024-05-17', '2024-05-17 06:07:50', 'vbanvv bv', 1, 1),
(48, 2, 5, 0, '2024-05-17', '2024-05-17', '2024-05-17 06:08:23', 'vbanvv bv', 1, 1),
(49, 2, 5, 0, '2024-05-17', '2024-05-17', '2024-05-17 06:08:56', 'vbanvv bv', 1, 1),
(50, 2, 5, 0, '2024-05-17', '2024-05-17', '2024-05-17 06:09:31', 'vbanvv bv', 1, 1),
(51, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:10:18', '6545464556', 1, 1),
(52, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:10:57', '6545464556', 1, 1),
(53, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:11:30', '6545464556', 1, 1),
(54, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:12:11', '6545464556', 1, 1),
(55, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:12:14', '6545464556', 1, 1),
(56, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:12:31', '6545464556', 1, 1),
(57, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:15:08', '6545464556', 1, 1),
(58, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:15:15', '6545464556', 1, 1),
(59, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:15:51', '6545464556', 1, 1),
(60, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:16:15', '6545464556', 1, 1),
(61, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:17:03', '6545464556', 1, 1),
(62, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:19:22', '6545464556', 1, 1),
(63, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:21:33', '6545464556', 1, 1),
(64, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:22:32', '6545464556', 1, 1),
(65, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:22:58', '6545464556', 1, 1),
(66, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:23:31', '6545464556', 1, 1),
(67, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:24:35', '6545464556', 1, 1),
(68, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:24:56', '6545464556', 1, 1),
(69, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:27:00', '6545464556', 1, 1),
(70, 4, 3, 0, '2024-05-18', '2024-05-29', '2024-05-17 06:47:03', '6545464556', 1, 1),
(71, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:48:30', 'health not goood', 1, 1),
(72, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:49:31', 'health not goood', 1, 1),
(73, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:50:22', 'health not goood', 1, 1),
(74, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:50:54', 'health not goood', 1, 1),
(75, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:51:12', 'health not goood', 1, 1),
(76, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:51:44', 'health not goood', 1, 1),
(77, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:56:36', 'health not goood', 1, 1),
(78, 2, 2, 0, '2024-05-17', '2024-05-26', '2024-05-17 06:57:05', 'health not goood', 1, 1),
(79, 4, 2, 0, '2024-05-25', '2024-06-01', '2024-05-17 07:00:44', 'kjhjhj', 1, 1),
(80, 2, 3, 0, '2024-05-22', '2024-05-23', '2024-05-17 07:28:41', 'bmjnbmvbhm', 1, 1),
(81, 2, 3, 0, '2024-05-17', '2024-05-24', '2024-05-17 07:30:08', '5445456456', 1, 1),
(82, 3, 3, 0, '2024-05-18', '2024-05-24', '2024-05-17 07:45:50', '5656', 1, 1),
(83, 4, 2, 0, '2024-05-17', '2024-05-25', '2024-05-17 07:47:27', '564458', 1, 1),
(84, 1, 2, 0, '2024-06-01', '2024-06-07', '2024-05-17 08:55:28', 'hecgccfcfgbcgfcdgf', 1, 1),
(85, 3, 2, 0, '2024-05-17', '2024-05-18', '2024-05-17 09:14:12', 'bBMNB MNBNBBBNV BBVVBHGGH', 1, 1),
(86, 4, 4, 0, '2024-05-17', '2024-05-17', '2024-05-17 09:18:55', '546544369', 1, 1),
(87, 2, 3, 0, '2024-05-17', '2024-05-18', '2024-05-17 09:23:15', 'marraiage function', 1, 1),
(88, 2, 3, 0, '2024-05-17', '2024-07-17', '2024-05-17 10:37:37', 'marrageio fuHV', 1, 1),
(89, 5, 6, 0, '0000-00-00', '0000-00-00', '2024-05-17 10:43:12', '', 1, 1),
(90, 5, 6, 0, '0000-00-00', '0000-00-00', '2024-05-17 10:43:17', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leavetypes`
--

CREATE TABLE `leavetypes` (
  `id` int(11) NOT NULL,
  `typename` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavetypes`
--

INSERT INTO `leavetypes` (`id`, `typename`, `description`) VALUES
(1, 'Casual Leaves', 'Casual Leaves'),
(2, 'Sick Leaves', 'Sick Leaves'),
(3, 'Marriage Leave', 'Marriage Leave\r\n'),
(4, 'Medical  Leave', 'Medical Leave'),
(5, 'Half-day leave', 'Half-day leave\r\n'),
(6, 'Personal Leave', 'Personal Leave\r\n                                                                   ');

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` enum('admin','developer','tester') NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `gender`, `email`, `password`, `number`, `birth_date`, `image`, `role`, `active`) VALUES
(1, 'Admin', 23, 'male', 'admin@gmail.com', '$2y$10$jTQ2x.xZOsS/UqgxdJRFBuXPzr5p.MuO1bDOcym6A.JeW1b9PgMzq', '9723567456', '2001-01-10', 'admin.jpg', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dpt_id` (`department`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`empid`),
  ADD KEY `leaveid` (`leaveid`),
  ADD KEY `dptid` (`dept_id`);

--
-- Indexes for table `leavetypes`
--
ALTER TABLE `leavetypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `typeName` (`typename`);

--
-- Indexes for table `resets`
--
ALTER TABLE `resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `leavetypes`
--
ALTER TABLE `leavetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resets`
--
ALTER TABLE `resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `dpt_id` FOREIGN KEY (`department`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
