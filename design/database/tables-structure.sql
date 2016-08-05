-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2016 at 03:28 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mm_tailieuweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_overview` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `category_description` text COLLATE utf8_unicode_ci,
  `category_image` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_images` text COLLATE utf8_unicode_ci,
  `category_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_parent_id` int(11) DEFAULT NULL,
  `context_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_description` text COLLATE utf8_unicode_ci,
  `comment_likes` int(11) DEFAULT NULL,
  `comment_created_at` int(11) DEFAULT NULL,
  `comment_updated_at` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `comment_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `faq_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faq_overview` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faq_views` int(11) DEFAULT NULL,
  `faq_likes` int(11) DEFAULT NULL,
  `faq_created_at` int(11) DEFAULT NULL,
  `faq_updated_at` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `faq_status` tinyint(4) DEFAULT NULL,
  `faq_cache_page` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
  `level_id` int(11) NOT NULL,
  `level_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_overview` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_description` text COLLATE utf8_unicode_ci,
  `level_image` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_images` text COLLATE utf8_unicode_ci,
  `level_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mm_users`
--

DROP TABLE IF EXISTS `mm_users`;
CREATE TABLE `mm_users` (
  `mm_user_id` int(11) NOT NULL,
  `level_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mm_user_points` float DEFAULT NULL,
  `mm_user_logs` text COLLATE utf8_unicode_ci,
  `mm_user_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_overview` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_description` text COLLATE utf8_unicode_ci,
  `post_image` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  `post_images` text CHARACTER SET utf8,
  `post_views` int(11) DEFAULT NULL,
  `post_likes` int(11) DEFAULT NULL,
  `post_status` tinyint(4) DEFAULT NULL,
  `post_created_at` int(11) DEFAULT NULL,
  `post_updated_at` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `post_cache_page` text CHARACTER SET utf8
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizs`
--

DROP TABLE IF EXISTS `quizs`;
CREATE TABLE `quizs` (
  `quiz_id` int(11) NOT NULL,
  `level_id` int(11) DEFAULT NULL,
  `quiz_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quiz_overview` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quiz_description` text COLLATE utf8_unicode_ci,
  `quiz_points` float DEFAULT NULL,
  `quiz_created_at` int(11) DEFAULT NULL,
  `quiz_updated_at` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `quiz_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizs_test`
--

DROP TABLE IF EXISTS `quizs_test`;
CREATE TABLE `quizs_test` (
  `quizs_test_id` int(11) NOT NULL,
  `quiz_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quiz_a` text COLLATE utf8_unicode_ci,
  `quiz_b` text COLLATE utf8_unicode_ci,
  `quiz_c` text COLLATE utf8_unicode_ci,
  `quiz_d` text COLLATE utf8_unicode_ci,
  `quiz_true` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `level_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `task_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_overview` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_description` text COLLATE utf8_unicode_ci,
  `task_points` float DEFAULT NULL,
  `task_image` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  `task_images` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `task_status` tinyint(4) DEFAULT NULL,
  `task_created_at` int(11) DEFAULT NULL,
  `task_updated_at` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_quizs`
--

DROP TABLE IF EXISTS `users_quizs`;
CREATE TABLE `users_quizs` (
  `user_quiz_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `user_quiz_attemps` tinyint(4) DEFAULT NULL,
  `user_quiz_points` float DEFAULT NULL,
  `user_quiz_created_at` int(11) DEFAULT NULL,
  `user_quiz_updated_at` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `user_quiz_status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_tasks`
--

DROP TABLE IF EXISTS `users_tasks`;
CREATE TABLE `users_tasks` (
  `user_task_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id_reviewer` int(11) DEFAULT NULL,
  `user_task_points` float DEFAULT NULL,
  `user_task_attachments` text COLLATE utf8_unicode_ci,
  `user_task_logs` text CHARACTER SET utf8,
  `user_task_status` tinyint(4) DEFAULT NULL,
  `user_task_created_at` int(11) DEFAULT NULL,
  `user_task_updated_at` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `mm_users`
--
ALTER TABLE `mm_users`
  ADD PRIMARY KEY (`mm_user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `quizs`
--
ALTER TABLE `quizs`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quizs_test`
--
ALTER TABLE `quizs_test`
  ADD PRIMARY KEY (`quizs_test_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users_quizs`
--
ALTER TABLE `users_quizs`
  ADD PRIMARY KEY (`user_quiz_id`);

--
-- Indexes for table `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD PRIMARY KEY (`user_task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mm_users`
--
ALTER TABLE `mm_users`
  MODIFY `mm_user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizs`
--
ALTER TABLE `quizs`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizs_test`
--
ALTER TABLE `quizs_test`
  MODIFY `quizs_test_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_quizs`
--
ALTER TABLE `users_quizs`
  MODIFY `user_quiz_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_tasks`
--
ALTER TABLE `users_tasks`
  MODIFY `user_task_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
