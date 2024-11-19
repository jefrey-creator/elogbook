-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2024 at 03:02 AM
-- Server version: 8.0.39-0ubuntu0.22.04.1
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logbook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acct`
--

CREATE TABLE `tbl_acct` (
  `acct_id` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 = admin\r\n0 = faculty',
  `reset_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `login_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `uuid` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reg_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `isBlocked` int DEFAULT '0' COMMENT '1 = blocked\r\n0 = not blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_acct`
--

INSERT INTO `tbl_acct` (`acct_id`, `email`, `password`, `isAdmin`, `reset_token`, `login_token`, `uuid`, `reg_token`, `isBlocked`) VALUES
(3, 'admin@csu.edu.ph', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', '1', NULL, NULL, '18a4a3d385bdf33f351a2bdeaa48c6c8', NULL, 0),
(6, 'jefrey.mis@csu.edu.ph', '$2y$10$VmMWQINjSCjIlQZVOs0Bzei3Gq/PHkr66vFpz9XyiI3sAeAwjmmny', '0', NULL, NULL, '8b86a57e7ffdd534a0e5b6be6fdaacbc', NULL, 0),
(7, 'saplajeff16@gmail.com', '$2y$10$QUpQKOFMIvGliLl7Q6XrceMevdsKTqmtpBemYClhxA9obkohjbc0u', '0', NULL, NULL, '784a38c21a41e011c6a5e6767b935a00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `faculty_id` int NOT NULL,
  `f_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `uuid` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `availability` int NOT NULL DEFAULT '1' COMMENT '1 = available\r\n2 = busy\r\n3 = away'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`faculty_id`, `f_name`, `m_name`, `l_name`, `sex`, `uuid`, `availability`) VALUES
(1, 'JOHN', '', 'DOE', 0, '18a4a3d385bdf33f351a2bdeaa48c6c8', 1),
(4, 'RICHARD', '', 'AYUYANG', 1, '8b86a57e7ffdd534a0e5b6be6fdaacbc', 3),
(5, 'DOROTHY', '', 'AYUYANG', 0, '784a38c21a41e011c6a5e6767b935a00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logs_id` int NOT NULL,
  `full_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_visited` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_out` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_to_visit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_taken` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_accepted` int NOT NULL DEFAULT '2' COMMENT '1 = accept\r\n0 = declined\r\n2 = default',
  `is_completed` int NOT NULL DEFAULT '0' COMMENT '1 = completed\r\n0 = not completed',
  `remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `req_category` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = consultation\r\n0 = visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`logs_id`, `full_name`, `date_visited`, `time_in`, `time_out`, `person_to_visit`, `purpose`, `action_taken`, `is_accepted`, `is_completed`, `remarks`, `req_category`) VALUES
(4, 'AGBUBULUD NAK', 'Nov 18, 2024', '08:06:43 PM', '10:48:59 PM', '8b86a57e7ffdd534a0e5b6be6fdaacbc', 'sir bumulud nakman kwartam hehehe', NULL, 1, 1, NULL, '0'),
(5, 'SDFDSFSDF', 'Nov 18, 2024', '08:27:18 PM', NULL, '784a38c21a41e011c6a5e6767b935a00', 'dsffdfsdf dfgdg gdf gdg', NULL, 2, 0, NULL, '0'),
(6, 'PHILHEALTH KONSULTA', 'Nov 18, 2024', '08:48:45 PM', '08:20:05 AM', '8b86a57e7ffdd534a0e5b6be6fdaacbc', 'madi ti bagbagik kasla kayat ko aginum', 'agtumar ka agas, kurang la uttug ayta', 1, 1, NULL, '1'),
(7, 'WET SI KEBIN', 'Nov 19, 2024', '10:50:02 AM', NULL, '8b86a57e7ffdd534a0e5b6be6fdaacbc', 'ako wet na wet na', NULL, 1, 0, NULL, '1'),
(8, 'BATIL PATONG', 'Nov 19, 2024', '10:52:44 AM', NULL, '8b86a57e7ffdd534a0e5b6be6fdaacbc', 'batil o patong?', NULL, 2, 0, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mailer`
--

CREATE TABLE `tbl_mailer` (
  `mail_id` int NOT NULL,
  `mail_body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mail_subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mailer`
--

INSERT INTO `tbl_mailer` (`mail_id`, `mail_body`, `mail_subject`, `mail_tag`) VALUES
(1, '<p>Hello [name],</p><p><span class=\"hljs-string\">\n\nCongratulations!</span></p><p><span class=\"hljs-string\"> Your account has been successfully created on e-Logbook system</span><span class=\"hljs-string\" style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">. You can now log in and start using all of our amazing features.\n\nHere are your account details:</span><span class=\"hljs-string\" style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p><span class=\"hljs-string\" style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Email: [email]</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Password: [password]</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;If you did not request for this account, please contact the system administrator immediately.\n</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">\nWe are excited to have you on board!\n</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">\nBest regards,\n</span></p><p>- eLogbook Management</p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">To Visit Our Website:&nbsp;</span><a href=\"http://localhost/elogbook/admin.elogbook\" target=\"_blank\">http://localhost/elogbook/admin.elogbook</a></p>', 'Account Created Successfully', 'acct_reg'),
(4, '<p style=\"\">Hello [name],</p><p style=\"\"><span class=\"hljs-string\">Congratulations!</span></p><p style=\"\"><span class=\"hljs-string\">Your account password has been successfully reset</span><span class=\"hljs-string\" style=\"text-align: var(--bs-body-text-align);\">. You can now log in and start using all of our amazing features. Here are your account details:</span><span class=\"hljs-string\" style=\"text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"\"><span class=\"hljs-string\" style=\"text-align: var(--bs-body-text-align);\">Email: [email]</span></p><p style=\"\"><span style=\"text-align: var(--bs-body-text-align);\">Password: [password]</span></p><p style=\"\"><span style=\"text-align: var(--bs-body-text-align);\"><br></span></p><p style=\"\"><span style=\"text-align: var(--bs-body-text-align);\">&nbsp;If you did not request for this, please contact the system administrator immediately.</span></p><p style=\"\"><span style=\"text-align: var(--bs-body-text-align);\">We are excited to have you on board!</span></p><p style=\"\"><span style=\"text-align: var(--bs-body-text-align);\">Best regards,</span></p><p style=\"\">- eLogbook Management</p><p style=\"\"><span style=\"text-align: var(--bs-body-text-align);\">To Visit Our Website:&nbsp;</span><a href=\"http://localhost/elogbook/admin.elogbook\" target=\"_blank\" style=\"\">http://localhost/elogbook/admin.elogbook</a></p>', 'Password Sent', 'reset_password'),
(5, '<p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Sir/Ma\'am [faculty_name],</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Greetings!<br></span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">I am [visitor_name] requesting for a visit for the purpose of [purpose]</span></p><p>I hope this message finds you well.</p><p><br></p>', 'Visitor\'s Request', 'visit'),
(6, '<p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Sir/Ma\'am [faculty_name],</span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Good day!<br></span></p><br><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">I am [visitor_name] requesting for a consultation for the purpose of [purpose]</span></p><p>I hope this message finds you well.</p>', 'Consultation Request', 'consultation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acct`
--
ALTER TABLE `tbl_acct`
  ADD PRIMARY KEY (`acct_id`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `tbl_mailer`
--
ALTER TABLE `tbl_mailer`
  ADD PRIMARY KEY (`mail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acct`
--
ALTER TABLE `tbl_acct`
  MODIFY `acct_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  MODIFY `faculty_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logs_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_mailer`
--
ALTER TABLE `tbl_mailer`
  MODIFY `mail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
