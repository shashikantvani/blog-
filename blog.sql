-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 09:42 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `p_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', '/home', 0, 1, '2020-02-26 09:08:59', '2020-02-26 09:08:59'),
(2, 'Posts', '/posts', 0, 1, '2020-02-26 09:08:59', '2020-02-26 09:08:59'),
(3, 'Roles', '/roles', 0, 1, '2020-02-26 09:09:39', '2020-02-26 09:09:39'),
(4, 'Create Post', '/addposts', 0, 1, '2020-02-26 09:09:39', '2020-02-26 09:09:39'),
(5, 'Users', '/users', 0, 1, '2020-02-26 09:10:38', '2020-02-26 09:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `menu_permission`
--

CREATE TABLE `menu_permission` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_permission`
--

INSERT INTO `menu_permission` (`id`, `menu_id`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2020-02-26 10:46:57', '2020-02-26 10:46:57'),
(2, 2, 2, 0, '2020-02-26 10:46:57', '2020-02-26 10:46:57'),
(3, 4, 2, 1, '2020-02-26 10:46:57', '2020-02-26 10:46:57'),
(4, 1, 3, 1, '2020-02-26 10:54:48', '2020-02-26 10:54:48'),
(5, 2, 3, 1, '2020-02-26 10:54:48', '2020-02-26 10:54:48'),
(6, 3, 2, 1, '2020-02-26 13:23:07', '2020-02-26 13:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `delete` tinyint(4) NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `description`, `featured_image`, `status`, `delete`, `thumbnail`, `created_at`, `updated_at`) VALUES
(5, 1, 'Test', 'Test-5', 'hjjgy', '1582701118.jpeg', 1, 1, '1582701118.jpeg', '2020-02-26 12:41:58', '2020-02-26 12:41:58'),
(6, 1, 'Test', 'Test-6', 'hjjgy', '1582701188.jpeg', 1, 0, '1582701188.jpeg', '2020-02-26 12:43:09', '2020-02-26 12:43:09'),
(7, 1, 'Another Test', 'Another-Test-7', 'Lorum uuo dsndsbkherw dddssd sddskhsd', '1582701935.jpeg', 1, 1, '1582701935.jpeg', '2020-02-26 12:55:36', '2020-02-26 12:55:36'),
(8, 1, 'Home', 'Home-8', 'hkg gjfjh khgkh vfjhghk', '1582703410.jpeg', 1, 0, '1582703410.jpeg', '2020-02-26 13:20:10', '2020-02-26 13:20:10'),
(9, 1, 'Home test', 'Home-test-9', 'fgjghjhg,j,gjh', '1582703475.png', 1, 0, '1582703475.png', '2020-02-26 13:21:15', '2020-02-26 13:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1= super admin ,2= editor, 3 = reader',
  `remember_token` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_role`, `remember_token`, `email_verified_at`, `updated_at`, `created_at`) VALUES
(1, 'Super Admin', 'shashivani01@gmail.com', '$2y$10$37dusjGzepmi3lajhQR29e38sTksXxoQ.WMy65nynY22WVHjWrAXm', 1, NULL, '2020-02-25 23:48:20', '2020-02-25 18:18:20', '2020-02-25 18:18:20'),
(2, 'Editor', 'editor@gmail.com', '$2y$10$37dusjGzepmi3lajhQR29e38sTksXxoQ.WMy65nynY22WVHjWrAXm', 2, NULL, '2020-02-26 08:47:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Reader', 'reader@gmail.com', '$2y$10$37dusjGzepmi3lajhQR29e38sTksXxoQ.WMy65nynY22WVHjWrAXm', 3, NULL, '2020-02-26 08:47:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_permission`
--
ALTER TABLE `menu_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu_permission`
--
ALTER TABLE `menu_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
