-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2019 at 01:37 AM
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
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` smallint(5) UNSIGNED NOT NULL,
  `article_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `article_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `article_status` tinyint(1) NOT NULL
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

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_title`, `complaint_type_id`, `complaint_desc`, `complaint_state_id`, `user_id`, `created_date`, `modified_date`) VALUES
('2018-12-04', 'ปัญหายาเสพติดในหมู่บ้าน', 3, 'วัยรุ่นติดยาจำนวนมากอย่างแรง', 1, 'nadear', '2018-12-07 14:15:37', '2018-12-08 14:37:07'),
('2018-12-05', 'ลักลอบจำหน่ายใบกระท่อม', 3, 'ต้มน้ำใบกระท่อม ขายเป็นชุดพร้อมยาแก้ไอ', 1, 'nadear', '2018-12-20 09:55:11', '2018-12-20 09:55:11'),
('2018-12-06', 'test', 3, 'test', 1, 'nadear', '2018-12-20 13:08:35', '2018-12-20 13:08:35'),
('2018-12-07', 'test2', 3, 'test2 test2', 1, 'nadear', '2018-12-21 14:18:07', '2018-12-21 14:18:07'),
('2018-12-08', 'test3', 3, 'test3', 1, 'nadear', '2018-12-21 14:24:23', '2018-12-21 14:24:23'),
('2018-12-09', 'test4', 3, 'test4', 1, 'nadear', '2018-12-21 14:52:23', '2018-12-21 14:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_photos`
--

CREATE TABLE `complaint_photos` (
  `complaint_photo_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_photo_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_id` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complaint_photos`
--

INSERT INTO `complaint_photos` (`complaint_photo_id`, `complaint_photo_name`, `complaint_id`) VALUES
('2018-12-05-img1', '2018-12-05-img1', '2018-12-05'),
('2018-12-06-img1', '2018-12-06-img1', '2018-12-06'),
('2018-12-07-img1', '2018-12-07-img1.png', '2018-12-07'),
('2018-12-08-img1', '2018-12-08-img1.jpg', '2018-12-08'),
('2018-12-09-img1', '2018-12-09-img1', '2018-12-09');

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
-- Table structure for table `complaint_videos`
--

CREATE TABLE `complaint_videos` (
  `complaint_video_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_video_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `complaint_id` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complaint_videos`
--

INSERT INTO `complaint_videos` (`complaint_video_id`, `complaint_video_name`, `complaint_id`) VALUES
('2018-12-05-video1', '2018-12-05-video1.mp4', '2018-12-05'),
('2018-12-05-video2', '2018-12-05-video2.mp4', '2018-12-05'),
('2018-12-06-video1', '2018-12-06-video1', '2018-12-06'),
('2018-12-07-video1', '2018-12-07-video1', '2018-12-07'),
('2018-12-09-video1', '2018-12-09-video1', '2018-12-09');

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
(2, 'ทดสอบ', 'test@mail.com', 'ทดสอบการติดต่อโครงการครั้งที่ 1', 1),
(4, '', '', '', 0);

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
  `project_website` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `project_twitter` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL DEFAULT '#',
  `project_facebook` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `project_youtube` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `complaint_id_last` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`project_name_th`, `project_name_en`, `project_address`, `project_phone`, `project_email`, `project_website`, `project_twitter`, `project_facebook`, `project_youtube`, `complaint_id_last`) VALUES
('ความยุติธรรมจากความหลากหลาย', 'Justice Deep South Project', 'คณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยสงขลานครินทร์', '+ 1235 2355 98', 'info@justicedeepsouth.in.th', 'https://www.justicedeepsouth.in.th', '#', '#', '#', '2018-12-15');

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
('nadear', 'นภัสวรรณ', 'e82c4b19b8151ddc25d4d93baf7b908f', 'nadear@gmail.com', 2, 1, '2018-12-20 01:48:42', '2018-12-22 01:56:05'),
('ruchdee', 'Ruchdee Binmad', '25d55ad283aa400af464c76d713c07ad', 'ruchy.tts@gmail.com', 0, 1, '2018-11-28 23:30:34', '2019-01-14 18:26:19'),
('test', 'test test', 'fcea920f7412b5da7be0cf42b8c93759', 'test@gmail.com', 1, 1, '2018-12-05 09:10:33', '2018-12-05 09:10:33');

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
('25bd990dec14bd1b2f007ffa044acd95', 'ruchdee', '2018-12-04 17:13:38', '2018-12-05 09:51:35'),
('274891561cc9ba3895fb9bc1e309a389', 'nadear', '2018-12-06 07:25:19', '2018-12-06 07:38:05'),
('2ad647eec9d3dd35b509100e996286be', 'nadear', '2018-12-14 08:53:44', '2018-12-20 01:48:14'),
('2f0e847d52ad96b6f551b1ae9a112fdf', 'ruchdee', '2018-12-05 12:03:55', '2018-12-05 12:04:23'),
('38008489aaa7f375f71d420fb6702483', 'nadear', '2018-12-29 09:02:06', '2018-12-29 09:03:10'),
('3f868b941f23b3a71a684706eec5c907', 'ruchdee', '2019-01-14 17:25:22', '2019-01-14 17:30:17'),
('4a8b47017e5c161b02ce25dcc3c89c56', 'nadear', '2019-01-13 11:07:09', '2019-01-14 14:49:17'),
('4b7bd1042966c9d5a0a8f3930870ed53', 'nadear', '2018-12-14 08:48:22', '2018-12-14 08:50:41'),
('4d859967658ed127485dce37c763c99c', 'ruchdee', '2018-11-28 16:01:24', '2018-11-28 16:02:40'),
('4e12ee52df1b7fc7978dc3bca50465a0', 'nadear', '2018-12-21 14:17:12', '2018-12-21 14:30:28'),
('50fe6579b19cb6acd700207aefa8c16d', 'ruchdee', '2018-11-28 15:25:12', '2018-11-28 16:01:07'),
('54e02ff2d925e4be5643d8a1d1fdfe6c', 'test', '2018-12-20 08:15:57', '2018-12-20 08:16:05'),
('5573defe2614071f5c151e47c9a5073e', 'test', '2018-12-13 17:12:42', '2018-12-13 17:18:41'),
('563608124889bfb14e5830e93ea3a96b', 'nadear', '2018-12-20 08:16:28', '2018-12-21 14:17:03'),
('57cd3c0bad92e637f2d0ebd7bb194204', 'ruchdee', '2018-11-28 16:03:06', '2018-12-04 15:30:00'),
('61c84b7e1f75ee1f997bdb04a41ec38b', 'nadear', '2018-12-06 08:11:55', '2018-12-10 02:09:51'),
('651e718b3c2e1ff0bbea58fd11339d22', 'test', '2018-12-06 07:21:55', '2018-12-06 07:24:08'),
('669ddece038129eb8d8e5cd70e8a49c8', 'test', '2018-12-14 08:50:51', '2018-12-14 08:53:29'),
('6c1bacbed4962f0ca8fd1316c9f91763', 'test', '2018-12-29 09:43:24', '2018-12-29 10:30:08'),
('7f5ccd5f8f5849251b5fadb4f0f0de02', 'nadear', '2018-12-12 15:19:54', '2018-12-13 16:54:39'),
('85dc8171471a00a966c8b95f9eb54178', 'ruchdee', '2019-01-14 14:49:28', '2019-01-14 17:25:11'),
('86f20c0a890e289cfcef7e3f34aa349e', 'nadear', '2018-12-21 14:52:09', '2018-12-29 09:01:53'),
('94c9fd0cf5ba796b89198e313e07848a', 'test', '2018-12-06 08:11:09', '2018-12-06 08:11:17'),
('982d703729c2eb6dcb97f728124700f5', 'ruchdee', '2019-01-14 18:10:22', '2019-01-14 18:26:28'),
('98fb69d95f9d3715e44c263d55afa966', 'test', '2018-12-05 12:04:32', '2018-12-05 14:27:32'),
('9d864bfd31a3abe8597a5755c0e72ff1', 'ruchdee', '2018-12-13 16:58:47', '2018-12-13 17:12:30'),
('a02d6ceb6de88a0dcdf23f7c2da3221d', 'test', '2018-12-10 02:10:08', '2018-12-12 15:19:43'),
('a8a2baf0b0096aa2bcf389b03e977b8b', 'ruchdee', '2018-12-06 07:08:54', '2018-12-06 07:21:38'),
('b0304bef831cd03c1ade3e4c6f5c0078', 'ruchdee', '2018-12-20 01:48:34', '2018-12-20 01:49:16'),
('b74f99e95c69434840672eb066d41c4e', 'ruchdee', '2018-11-10 11:32:06', '0000-00-00 00:00:00'),
('bd1d4eb2d1d79111a5b4920c52ab7584', 'ruchdee', '2018-11-28 15:24:40', '0000-00-00 00:00:00'),
('be6c8477fef2fc0a57aae7e083e0427c', 'ruchdee', '2018-12-05 14:27:44', '2018-12-05 14:28:32'),
('bf1b187cead1a97eb25e9f211cde1147', 'nadear', '2018-12-05 14:38:41', '2018-12-06 07:07:23'),
('bf7790de02a969f6955c3a1028ad7a09', 'ruchdee', '2018-12-05 10:57:29', '2018-12-05 12:01:52'),
('c9210fdbc2ba4a91a89eb4c79dca66ea', 'nadear', '2018-12-29 10:30:46', '0000-00-00 00:00:00'),
('cc65e45f8cfb4f3d9d18ca6415a57829', 'ruchdee', '2018-12-21 14:51:32', '2018-12-21 14:51:51'),
('cfeb27a294ba221087c7d6cc5ec88649', 'ruchdee', '2018-12-04 15:42:25', '0000-00-00 00:00:00'),
('d923b1d33e623e73bdd3f84f6528cbeb', 'ruchdee', '2019-01-14 17:42:01', '2019-01-14 17:42:12'),
('dc4a401b00274e58adb1b769a5e772f7', 'nadear', '2018-12-21 14:30:36', '2018-12-21 14:51:20'),
('e212cf9ec899c825569540ff7bb151e1', 'nadear', '2018-12-29 09:03:42', '2018-12-29 09:03:49'),
('ebe8685c7accd9ac48440f9130efd1ed', 'ruchdee', '2019-01-14 17:30:27', '2019-01-14 17:36:11'),
('f757283a0b08b4d50c6b031ffdec83e1', 'nadear', '2018-12-13 17:18:52', '2018-12-13 17:24:40');

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
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

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
-- Indexes for table `complaint_videos`
--
ALTER TABLE `complaint_videos`
  ADD PRIMARY KEY (`complaint_video_id`),
  ADD KEY `complaint_id` (`complaint_id`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `contact_info_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- Constraints for table `complaint_videos`
--
ALTER TABLE `complaint_videos`
  ADD CONSTRAINT `complaint_videos_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`complaint_id`);

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
