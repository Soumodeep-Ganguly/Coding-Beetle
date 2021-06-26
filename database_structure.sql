-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql108.epizy.com
-- Generation Time: Jun 26, 2021 at 01:11 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_25183660_coding_beetle`
--

-- --------------------------------------------------------

--
-- Table structure for table `cb_admin`
--

CREATE TABLE `cb_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL COMMENT '0 => User 1 => Admin',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 => Inactive 1=>Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cb_answers`
--

CREATE TABLE `cb_answers` (
  `answer_id` int(10) NOT NULL,
  `answer` longtext NOT NULL,
  `question_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cb_questions`
--

CREATE TABLE `cb_questions` (
  `question_id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `tags` text NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cb_subjects`
--

CREATE TABLE `cb_subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cb_topics`
--

CREATE TABLE `cb_topics` (
  `topic_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `topic` text NOT NULL,
  `description` longtext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cb_admin`
--
ALTER TABLE `cb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cb_answers`
--
ALTER TABLE `cb_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `cb_questions`
--
ALTER TABLE `cb_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `cb_subjects`
--
ALTER TABLE `cb_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `cb_topics`
--
ALTER TABLE `cb_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cb_admin`
--
ALTER TABLE `cb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cb_answers`
--
ALTER TABLE `cb_answers`
  MODIFY `answer_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cb_questions`
--
ALTER TABLE `cb_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cb_subjects`
--
ALTER TABLE `cb_subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cb_topics`
--
ALTER TABLE `cb_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
