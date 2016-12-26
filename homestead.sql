-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2016 at 05:07 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE `acl` (
  `ai` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acl_actions`
--

CREATE TABLE `acl_actions` (
  `action_id` int(10) UNSIGNED NOT NULL,
  `action_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `action_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acl_categories`
--

CREATE TABLE `acl_categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `category_desc` varchar(100) NOT NULL COMMENT 'Human readable description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_sessions`
--

CREATE TABLE `auth_sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_sessions`
--

INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
('ntrm4b2pub31gqt9q1e0d7tdhuavahsc', 1932286658, '2016-12-25 19:37:08', '2016-12-25 18:48:05', '::1', 'Chrome 55.0.2883.87 on Windows 10');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `denied_access`
--

CREATE TABLE `denied_access` (
  `ai` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ips_on_hold`
--

CREATE TABLE `ips_on_hold` (
  `ai` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_errors`
--

CREATE TABLE `login_errors` (
  `ai` int(10) UNSIGNED NOT NULL,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_errors`
--

INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES
(31, 'archsidiningrat@gmail.com', '::1', '2016-12-26 16:30:55'),
(30, 'archsidiningrat@gmail.com', '::1', '2016-12-26 16:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `created_at`) VALUES
(1, 'Learning Codeigniter', 'learning-codeigniter', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin gravida faucibus feugiat. Vivamus sem lectus, luctus quis nulla vestibulum, malesuada aliquam mi. Donec aliquam bibendum purus at facilisis. Cras fringilla ut arcu eu bibendum. Maecenas pulvinar felis interdum risus pretium luctus. Vestibulum eu augue tempus, fermentum est sed, accumsan libero. Nunc sodales rhoncus libero, ut euismod urna laoreet non.\n\nInteger lacinia sapien a quam cursus tristique. Aliquam pharetra est in massa luctus, sed convallis magna volutpat. Nam et nulla porttitor, aliquam velit id, condimentum nisl. Duis quam enim, dignissim nec lorem sed, commodo volutpat dolor. Nam ut ullamcorper justo. Nulla fermentum pulvinar mauris, at gravida eros sodales sed. Integer gravida odio non mollis pretium. Ut vitae lacinia odio, id cursus elit. Vivamus ac auctor felis, at placerat neque. Nam lacinia ligula massa, non finibus lectus faucibus ac. In est nunc, elementum ut aliquet sed, volutpat vel lacus. Mauris quis lectus elementum, vestibulum odio at, sollicitudin velit.\n\nIn convallis turpis at consequat convallis. Quisque rutrum, risus id congue sodales, tortor leo aliquam turpis, eget tempus leo urna et purus. Duis vel purus finibus, dictum leo id, faucibus nisi. In vulputate finibus odio ac fringilla. Phasellus nec turpis tincidunt sem sollicitudin ornare vitae nec magna. Nullam in cursus nibh, a egestas erat. In ut mauris est. Nunc pulvinar, enim vel rhoncus scelerisque, nunc eros tristique diam, a euismod eros tortor ac massa. Vivamus urna justo, volutpat id lorem eu, varius varius diam. Phasellus sagittis dui eu vestibulum mattis.\n\nQuisque dignissim, arcu eget faucibus fermentum, sapien erat faucibus quam, quis blandit ex purus sit amet arcu. Ut volutpat lacus risus. Aenean eu mattis mi. Duis aliquet congue velit nec rhoncus. Praesent eu hendrerit massa. Mauris aliquam auctor lorem in mattis. Maecenas luctus ex at aliquet sagittis.\n\nMaecenas suscipit, lorem quis lacinia aliquet, mauris lorem bibendum orci, a feugiat quam mi non nibh. Proin vel odio velit. Sed at lobortis massa. Integer sollicitudin tempus neque, non euismod lorem commodo at. Nunc eu dapibus dolor. Aliquam et scelerisque lectus. Fusce pulvinar vulputate neque, quis porta erat sodales a. Praesent sit amet pretium ante, non varius lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque vitae libero ac metus condimentum pharetra. Proin ullamcorper lacus a mi imperdiet varius. Maecenas convallis volutpat placerat.', '2016-12-25 06:52:39'),
(2, 'Codeigniter Advanced Tutorial', 'codeigniter-advanced-tutorial', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisl libero, placerat vel est sed, maximus commodo massa. Suspendisse aliquam ante et finibus faucibus. Donec congue ut magna sed cursus. Fusce sit amet sodales lectus, vel molestie massa. Curabitur iaculis, nunc sed pellentesque lobortis, felis leo accumsan dolor, vitae facilisis mauris est id justo. Integer pretium mi id turpis lobortis pellentesque. Donec commodo bibendum dolor, et blandit ante tincidunt quis. Proin varius diam quis velit vulputate, a blandit massa dignissim. Vivamus sodales quis est vitae finibus. Suspendisse sit amet odio a velit ornare rhoncus non quis sapien. Proin placerat neque lorem, a mattis ipsum ornare non.\r\n\r\nNulla dignissim cursus justo, at tincidunt odio porta quis. Ut iaculis elementum massa, vel molestie ex feugiat in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id ipsum id magna scelerisque dapibus. Fusce sollicitudin libero at nisi mollis elementum. Integer vel dapibus mauris, id lacinia risus. Vivamus pharetra turpis sit amet eros tristique facilisis. Sed id libero at libero pretium viverra.', '2016-12-25 07:09:15'),
(3, 'Laravel Tutorial', 'laravel-tutorial', 'Sed tristique erat sed felis placerat, a iaculis lectus pretium. Sed semper interdum sollicitudin. Fusce nec molestie leo. Nulla suscipit nisi erat, at posuere nisi venenatis quis. Curabitur pharetra orci eu pharetra bibendum. Duis ex libero, tincidunt ac tellus id, vulputate lobortis risus. Ut at nisi pellentesque, maximus nibh a, malesuada orci. Aenean finibus, justo ut blandit finibus, velit tellus auctor risus, non tristique enim augue tincidunt nibh. Nunc nisl eros, molestie id sodales in, sagittis eget augue. Praesent sagittis, odio vel posuere faucibus, mauris est venenatis nunc, in consectetur ex nibh a nisl. Aliquam sollicitudin, nibh nec luctus vulputate, est nulla pulvinar nulla, non convallis sem sem sed augue. Pellentesque sodales odio nec dolor volutpat semper. Suspendisse auctor consequat neque non sagittis. Maecenas eu mi non nunc suscipit commodo quis eget risus. Curabitur ultrices auctor ipsum nec luctus. Integer at purus pretium, lobortis magna in, molestie nisi.\r\n\r\nNam metus risus, interdum in lectus at, cursus iaculis ligula. Aenean aliquet faucibus lorem. Suspendisse at luctus ante, quis mollis sem. Etiam consequat urna ipsum, id pharetra dui tristique at. Vestibulum tempus velit eget metus bibendum, ac laoreet dolor maximus. Vestibulum eros velit, gravida et est et, ullamcorper pretium tortor. Nunc pharetra ex ac turpis dignissim, vel lobortis ex molestie. Nulla eget ex nibh. Nunc semper nunc metus, quis pretium magna placerat non. Mauris feugiat, justo nec porttitor dapibus, sapien erat malesuada quam, vel elementum enim arcu eu augue. Integer et felis sit amet ipsum euismod cursus vulputate a neque. Morbi in orci dapibus, consequat urna sit amet, lobortis lacus. Nullam tempus sem posuere, consectetur orci a, euismod dui. Nam faucibus consectetur arcu id iaculis.', '2016-12-25 07:39:33'),
(4, 'Laravel IntermediateTutorial', 'Laravel-IntermediateTutorial', '<p>Edited Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla risus et sem accumsan mattis. Praesent non tortor ac sem sollicitudin egestas. Mauris nec nibh in est sagittis sollicitudin ut quis magna. Aenean id nibh massa. Nulla pretium velit vel rhoncus consectetur. Sed quis est orci. Nulla quis iaculis odio, vel pretium odio. Suspendisse finibus nec erat in aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vulputate risus vitae eleifend congue.</p><p>Donec volutpat quam vitae est hendrerit, non pulvinar turpis tincidunt. Cras maximus et ligula a interdum. Quisque convallis, magna in sollicitudin convallis, erat ex sodales neque, eu pretium magna urna quis arcu. Aenean venenatis enim sit amet dolor condimentum hendrerit. Aliquam nec magna tellus. Praesent fermentum elit non mauris rhoncus faucibus. Sed a ligula turpis. Curabitur vitae lobortis nibh. Nam blandit feugiat laoreet.</p><p>Vestibulum eleifend sollicitudin felis sit amet hendrerit. Morbi ut sapien malesuada, pharetra risus sed, rhoncus libero. Vivamus eu neque lectus. Morbi mauris lorem, vestibulum at nisi eu, semper consequat diam.</p>', '2016-12-25 07:39:33'),
(6, 'Biline Dev', 'Biline-Dev', '<p><strong>This is a new post using ckeditor.</strong></p><p>Quisque rhoncus consequat felis, in porttitor risus tincidunt a. Cras semper nisi vel posuere dapibus. Duis aliquet erat a erat varius semper id non tortor. Etiam porta magna in velit tristique, vel sodales eros interdum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed consequat nisi in est varius fringilla. Vivamus auctor nisl vel risus eleifend egestas. Nam sed enim faucibus sapien interdum euismod et ultricies mi. Donec suscipit condimentum risus, convallis tempus est commodo ac. Donec at ipsum ultrices, vulputate metus in, tempus purus. Aenean dictum mollis luctus. Fusce vitae tellus semper, commodo eros in, consectetur felis. Aenean vitae orci dignissim, ullamcorper metus eget, consequat purus. In nec tortor porta nulla luctus congue venenatis et ex. Nullam mattis magna tincidunt rutrum euismod.</p>', '2016-12-25 08:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `address` varchar(255) NOT NULL,
  `pricetag` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `type`, `latitude`, `longitude`, `address`, `pricetag`, `created_at`) VALUES
(1, '45', -6.97619, 107.633, 'Jln.Sukabirus Gg.Rd.Shaleh No.19 Kamar.4 Bandung Kec.Dayeuhkolot Bandung ', 500000000, '2016-12-25 20:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `username_or_email_on_hold`
--

CREATE TABLE `username_or_email_on_hold` (
  `ai` int(10) UNSIGNED NOT NULL,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `auth_level` tinyint(3) UNSIGNED NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
(1170140167, 'archisdi', 'archisdiningrat@gmail.com', 6, '0', '$2y$11$z4/I3uQdYyAtUmG.w7GRK.Y8Z528Jp6BuHxC5geX64WUf6h5ZqCTS', '$2y$11$3FjzZdpUlHP/KAGONsKt0e.rymC7BxmgQvgY5jSO0E7CTvreLJmNy', '2016-12-26 16:38:48', NULL, NULL, '2016-12-26 15:42:55', '2016-12-26 15:38:48');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `ca_passwd_trigger` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    IF ((NEW.passwd <=> OLD.passwd) = 0) THEN
        SET NEW.passwd_modified_at = NOW();
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`ai`),
  ADD KEY `action_id` (`action_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `acl_actions`
--
ALTER TABLE `acl_actions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `acl_categories`
--
ALTER TABLE `acl_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_code` (`category_code`),
  ADD UNIQUE KEY `category_desc` (`category_desc`);

--
-- Indexes for table `auth_sessions`
--
ALTER TABLE `auth_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `denied_access`
--
ALTER TABLE `denied_access`
  ADD PRIMARY KEY (`ai`);

--
-- Indexes for table `ips_on_hold`
--
ALTER TABLE `ips_on_hold`
  ADD PRIMARY KEY (`ai`);

--
-- Indexes for table `login_errors`
--
ALTER TABLE `login_errors`
  ADD PRIMARY KEY (`ai`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `username_or_email_on_hold`
--
ALTER TABLE `username_or_email_on_hold`
  ADD PRIMARY KEY (`ai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl`
--
ALTER TABLE `acl`
  MODIFY `ai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_actions`
--
ALTER TABLE `acl_actions`
  MODIFY `action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_categories`
--
ALTER TABLE `acl_categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `denied_access`
--
ALTER TABLE `denied_access`
  MODIFY `ai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ips_on_hold`
--
ALTER TABLE `ips_on_hold`
  MODIFY `ai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_errors`
--
ALTER TABLE `login_errors`
  MODIFY `ai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `username_or_email_on_hold`
--
ALTER TABLE `username_or_email_on_hold`
  MODIFY `ai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl`
--
ALTER TABLE `acl`
  ADD CONSTRAINT `acl_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `acl_actions` (`action_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `acl_actions`
--
ALTER TABLE `acl_actions`
  ADD CONSTRAINT `acl_actions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `acl_categories` (`category_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
