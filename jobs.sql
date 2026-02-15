-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 02:40 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `apply_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `minimal_rate` int(11) DEFAULT NULL,
  `delivery_time` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opportunity_id` int(11) NOT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `opportunity`
--

CREATE TABLE `opportunity` (
  `id` int(11) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `min_salary` int(11) NOT NULL,
  `max_salary` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `modify` datetime DEFAULT NULL,
  `expire` date NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `province` varchar(120) DEFAULT NULL,
  `skills` varchar(100) DEFAULT NULL,
  `opportunity_type` varchar(45) DEFAULT NULL,
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `vacancy_no` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `num_vacancy` int(11) DEFAULT NULL,
  `languages` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `min_exp` varchar(45) DEFAULT NULL,
  `responsible` longtext,
  `degree` varchar(45) DEFAULT NULL,
  `category_slug` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `featured` char(1) DEFAULT NULL,
  `submit_email` varchar(45) DEFAULT NULL,
  `note` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `opportunity`
--

INSERT INTO `opportunity` (`id`, `job_title`, `min_salary`, `max_salary`, `description`, `modify`, `expire`, `status`, `users_id`, `province`, `skills`, `opportunity_type`, `create`, `category`, `address`, `vacancy_no`, `type`, `num_vacancy`, `languages`, `gender`, `min_exp`, `responsible`, `degree`, `category_slug`, `slug`, `featured`, `submit_email`, `note`) VALUES
(1, 'Web Developer', 10, 120, 'This is job description', '2023-03-29 09:23:58', '2023-05-31', 'A', 2, 'Herat', 'Software Development,Web,Application,Programming', 'job', '2023-03-29 11:47:59', 'IT and Computers', 'Anywhere', '21', 'Freelance', 2, 'English', 'Any', '1', 'there is no responsibility', 'Master\'s Degree', 'web-developer', 'web-developer', NULL, 'info@linkedin.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `rfp`
--

CREATE TABLE `rfp` (
  `id` int(11) NOT NULL,
  `filename` varchar(45) NOT NULL,
  `desc` longtext NOT NULL,
  `title` varchar(45) NOT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rfq`
--

CREATE TABLE `rfq` (
  `id` int(11) NOT NULL,
  `filename` varchar(45) NOT NULL,
  `desc` longtext NOT NULL,
  `title` varchar(45) NOT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `tagline` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `about` longtext,
  `status` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `photo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `min_month_price` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fb` varchar(45) DEFAULT NULL,
  `telegram` varchar(45) DEFAULT NULL,
  `skills` varchar(100) DEFAULT NULL,
  `slug` varchar(45) NOT NULL,
  `uniqid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `company_name`, `tagline`, `province`, `about`, `status`, `type`, `photo`, `password`, `min_month_price`, `email`, `phone`, `username`, `create`, `fb`, `telegram`, `skills`, `slug`, `uniqid`) VALUES
(1, NULL, 'Cyborg Tech', NULL, NULL, NULL, 'A', 'admin', 'logo.png', '8d46be3853dae78f5bae11b21a7226bd', NULL, 'info@cyborgtech.co', '0792978400', 'Cyborgtech', '2023-03-29 11:28:06', NULL, NULL, NULL, 'cyborgtech', '6423e17e31e8f'),
(2, NULL, 'Linkedin', NULL, NULL, NULL, 'A', 'employer', 'default.png', '8d46be3853dae78f5bae11b21a7226bd', NULL, 'info@linkedin.com', '0794358400', 'linkedin', '2023-03-29 11:40:59', NULL, NULL, NULL, 'linkedin', '6423e4837432d');

-- --------------------------------------------------------

--
-- Table structure for table `users_document`
--

CREATE TABLE `users_document` (
  `id` int(11) NOT NULL,
  `filename` varchar(45) NOT NULL,
  `users_id` int(11) NOT NULL,
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_seekers_apply_users1_idx` (`users_id`),
  ADD KEY `fk_apply_opportunity1_idx` (`opportunity_id`);

--
-- Indexes for table `opportunity`
--
ALTER TABLE `opportunity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_job_users1_idx` (`users_id`);

--
-- Indexes for table `rfp`
--
ALTER TABLE `rfp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_RFP_users1_idx` (`users_id`);

--
-- Indexes for table `rfq`
--
ALTER TABLE `rfq`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_RFQ_users1_idx` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `slug_UNIQUE` (`slug`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`);

--
-- Indexes for table `users_document`
--
ALTER TABLE `users_document`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_users_document_users1_idx` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opportunity`
--
ALTER TABLE `opportunity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rfp`
--
ALTER TABLE `rfp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rfq`
--
ALTER TABLE `rfq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_document`
--
ALTER TABLE `users_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `fk_apply_opportunity1` FOREIGN KEY (`opportunity_id`) REFERENCES `opportunity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seekers_apply_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opportunity`
--
ALTER TABLE `opportunity`
  ADD CONSTRAINT `fk_job_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rfp`
--
ALTER TABLE `rfp`
  ADD CONSTRAINT `fk_RFP_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rfq`
--
ALTER TABLE `rfq`
  ADD CONSTRAINT `fk_RFQ_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_document`
--
ALTER TABLE `users_document`
  ADD CONSTRAINT `fk_users_document_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
