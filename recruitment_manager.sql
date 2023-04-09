-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 01:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recruitment_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `master_technical_id` int(11) DEFAULT NULL,
  `master_level_id` int(11) DEFAULT NULL,
  `recruitments_news_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `skill` text NOT NULL,
  `result` tinyint(1) DEFAULT NULL COMMENT '0: Fail; 1: Pass',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '0: Male; 1: Female;',
  `phone_number` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_levels`
--

CREATE TABLE `master_levels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_levels`
--

INSERT INTO `master_levels` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Intern', '2023-04-09 15:47:18', '2023-04-09 15:47:18', NULL),
(4, 'Fresher', '2023-04-09 15:47:18', '2023-04-09 15:47:18', NULL),
(5, 'Junior', '2023-04-09 15:47:18', '2023-04-09 15:47:18', NULL),
(6, 'Middle', '2023-04-09 15:47:18', '2023-04-09 15:47:18', NULL),
(7, 'Senior', '2023-04-09 15:47:18', '2023-04-09 15:47:18', NULL),
(8, 'Leader', '2023-04-09 15:47:18', '2023-04-09 15:47:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_technicals`
--

CREATE TABLE `master_technicals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_technicals`
--

INSERT INTO `master_technicals` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PHP', '2023-04-09 15:35:40', '2023-04-09 15:35:40', NULL),
(2, 'NodeJS', '2023-04-09 15:35:40', '2023-04-09 15:35:40', NULL),
(3, 'Golang', '2023-04-09 15:35:40', '2023-04-09 15:35:40', NULL),
(4, 'Java', '2023-04-09 15:35:40', '2023-04-09 15:35:40', NULL),
(5, 'Python', '2023-04-09 15:35:40', '2023-04-09 15:35:40', NULL),
(6, '.NET', '2023-04-09 15:35:40', '2023-04-09 15:35:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_news`
--

CREATE TABLE `recruitment_news` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `master_technical_id` int(11) NOT NULL,
  `master_level_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `salary` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expired_at` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '0:admin; 1:candidate; 2:employer;',
  `status` tinyint(1) NOT NULL COMMENT '0:deactivated; 1:active;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_candidate` (`candidate_id`),
  ADD KEY `application_master_technical` (`master_technical_id`),
  ADD KEY `application_master_level` (`master_level_id`),
  ADD KEY `application_recruitment_news` (`recruitments_news_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_candidate` (`user_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_employer` (`user_id`),
  ADD UNIQUE KEY `company_name_employer` (`company_name`);

--
-- Indexes for table `master_levels`
--
ALTER TABLE `master_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_level` (`name`) USING BTREE;

--
-- Indexes for table `master_technicals`
--
ALTER TABLE `master_technicals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_technical` (`name`) USING BTREE;

--
-- Indexes for table `recruitment_news`
--
ALTER TABLE `recruitment_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruitment_news_employer` (`employer_id`),
  ADD KEY `recruitment_news_master_technical` (`master_technical_id`),
  ADD KEY `recruitment_news_master_level` (`master_level_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_user` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_levels`
--
ALTER TABLE `master_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_technicals`
--
ALTER TABLE `master_technicals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruitment_news`
--
ALTER TABLE `recruitment_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `application_candidate` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `application_master_level` FOREIGN KEY (`master_level_id`) REFERENCES `master_levels` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `application_master_technical` FOREIGN KEY (`master_technical_id`) REFERENCES `master_technicals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `application_recruitment_news` FOREIGN KEY (`recruitments_news_id`) REFERENCES `recruitment_news` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employer_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `recruitment_news`
--
ALTER TABLE `recruitment_news`
  ADD CONSTRAINT `recruitment_news_employer` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `recruitment_news_master_level` FOREIGN KEY (`master_level_id`) REFERENCES `master_levels` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `recruitment_news_master_technical` FOREIGN KEY (`master_technical_id`) REFERENCES `master_technicals` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
