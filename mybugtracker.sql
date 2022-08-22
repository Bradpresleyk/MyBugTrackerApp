-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 04:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybugtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_bugs`
--

CREATE TABLE `assigned_bugs` (
  `id` int(11) NOT NULL,
  `submitter` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `date_assigned` timestamp NOT NULL DEFAULT current_timestamp(),
  `developer_assigned` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) NOT NULL,
  `bug_submitter` varchar(255) NOT NULL,
  `bug_title` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `bug_description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `closedbugs`
--

CREATE TABLE `closedbugs` (
  `id` int(11) NOT NULL,
  `bug_submitter` varchar(150) NOT NULL,
  `bug_title` varchar(150) NOT NULL,
  `severity` varchar(150) NOT NULL,
  `bug_description` varchar(150) NOT NULL,
  `date_closed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reopenbugs`
--

CREATE TABLE `reopenbugs` (
  `id` int(11) NOT NULL,
  `bug_submitter` varchar(150) NOT NULL,
  `bug_title` varchar(150) NOT NULL,
  `severity` varchar(150) NOT NULL,
  `bug_description` varchar(150) NOT NULL,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `date_reopened` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resolvedbugs`
--

CREATE TABLE `resolvedbugs` (
  `id` int(11) NOT NULL,
  `bug_submitter` varchar(150) NOT NULL,
  `bug_title` varchar(150) NOT NULL,
  `bug_severity` varchar(150) NOT NULL,
  `bug_description` varchar(150) NOT NULL,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `date_resolved` timestamp NOT NULL DEFAULT current_timestamp(),
  `Resolved_by` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resolvedbugs`
--
ALTER TABLE `resolvedbugs`
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
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
