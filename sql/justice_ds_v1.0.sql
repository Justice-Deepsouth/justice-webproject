-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2018 at 01:38 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justice_ds`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` char(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000-00-00',
  `complaint_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_type_id` tinyint(4) NOT NULL,
  `complaint_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `complaint_state_id` tinyint(4) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_photos`
--

CREATE TABLE `complaint_photos` (
  `complaint_photo_id` int(10) UNSIGNED NOT NULL,
  `complaint_photo_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_id` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_progresses`
--

CREATE TABLE `complaint_progresses` (
  `complaint_progress_id` int(11) NOT NULL,
  `complaint_id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_progress_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `complaint_state_id` tinyint(4) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_states`
--

CREATE TABLE `complaint_states` (
  `complaint_state_id` tinyint(4) UNSIGNED NOT NULL,
  `complaint_state_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_state_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_types`
--

CREATE TABLE `complaint_types` (
  `complaint_type_id` tinyint(4) UNSIGNED NOT NULL,
  `complaint_type_desc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_type_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_passwd` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `session_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `complaint_photos`
--
ALTER TABLE `complaint_photos`
  ADD PRIMARY KEY (`complaint_photo_id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `complaint_progresses`
--
ALTER TABLE `complaint_progresses`
  ADD PRIMARY KEY (`complaint_progress_id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `complaint_states`
--
ALTER TABLE `complaint_states`
  ADD PRIMARY KEY (`complaint_state_id`);

--
-- Indexes for table `complaint_types`
--
ALTER TABLE `complaint_types`
  ADD PRIMARY KEY (`complaint_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_progresses`
--
ALTER TABLE `complaint_progresses`
  MODIFY `complaint_progress_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complaint_states`
--
ALTER TABLE `complaint_states`
  MODIFY `complaint_state_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complaint_types`
--
ALTER TABLE `complaint_types`
  MODIFY `complaint_type_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint_photos`
--
ALTER TABLE `complaint_photos`
  ADD CONSTRAINT `complaint_photos_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`);

--
-- Constraints for table `complaint_progresses`
--
ALTER TABLE `complaint_progresses`
  ADD CONSTRAINT `complaint_progresses_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
