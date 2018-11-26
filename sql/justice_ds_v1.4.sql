-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2018 at 12:47 AM
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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` smallint(5) UNSIGNED NOT NULL,
  `activity_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activity_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `activity_place` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activity_sdate` date NOT NULL,
  `activity_edate` date NOT NULL,
  `activity_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` char(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000-00-00',
  `complaint_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_type_id` tinyint(4) NOT NULL,
  `complaint_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `complaint_state_id` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_photos`
--

CREATE TABLE `complaint_photos` (
  `complaint_photo_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
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
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
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

--
-- Dumping data for table `complaint_states`
--

INSERT INTO `complaint_states` (`complaint_state_id`, `complaint_state_desc`, `complaint_state_status`) VALUES
(1, 'ข้อร้องเรียนใหม่ ยังไม่ดำเนินการ', 1),
(3, 'กำลังดำเนินการ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_types`
--

CREATE TABLE `complaint_types` (
  `complaint_type_id` tinyint(4) UNSIGNED NOT NULL,
  `complaint_type_desc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_type_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complaint_types`
--

INSERT INTO `complaint_types` (`complaint_type_id`, `complaint_type_desc`, `complaint_type_status`) VALUES
(3, 'ปัญหายาเสพติด', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `contact_info_id` smallint(5) UNSIGNED NOT NULL,
  `contact_info_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_info_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_info_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `check_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`contact_info_id`, `contact_info_name`, `contact_info_email`, `contact_info_desc`, `check_read`) VALUES
(1, 'Ruchdee', 'ruchy.tts@gmail.com', 'Test Contact', 1),
(2, 'ทดสอบ', 'test@mail.com', 'ทดสอบการติดต่อโครงการครั้งที่ 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `project_name_th` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `project_name_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `project_address` text COLLATE utf8_unicode_ci NOT NULL,
  `project_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `project_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `project_website` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `project_twitter` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `project_facebook` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `project_youtube` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_id_last` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`project_name_th`, `project_name_en`, `project_address`, `project_phone`, `project_email`, `project_website`, `project_twitter`, `project_facebook`, `project_youtube`, `complaint_id_last`) VALUES
('Justice Deep South Project', '', 'คณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยสงขลานครินทร์', '+ 1235 2355 98', 'info@justicedeepsouth.in.th', 'https://www.justicedeepsouth.in.th', '#', '#', '#', '2018-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_passwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_passwd`, `user_email`, `user_type`, `user_status`, `created_date`, `modified_date`) VALUES
('ruchdee', 'Ruchdee Binmad', '25d55ad283aa400af464c76d713c07ad', 'ruchy.tts@gmail.com', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `session_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`session_id`, `user_id`, `login_date`, `logout_date`) VALUES
('b74f99e95c69434840672eb066d41c4e', 'ruchdee', '2018-11-10 11:32:06', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`contact_info_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complaint_progresses`
--
ALTER TABLE `complaint_progresses`
  MODIFY `complaint_progress_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complaint_states`
--
ALTER TABLE `complaint_states`
  MODIFY `complaint_state_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `complaint_types`
--
ALTER TABLE `complaint_types`
  MODIFY `complaint_type_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `contact_info_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `complaint_photos`
--
ALTER TABLE `complaint_photos`
  ADD CONSTRAINT `complaint_photos_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`);

--
-- Constraints for table `complaint_progresses`
--
ALTER TABLE `complaint_progresses`
  ADD CONSTRAINT `complaint_progresses_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_progresses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
