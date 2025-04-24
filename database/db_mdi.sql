-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2025 at 02:04 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mdi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

DROP TABLE IF EXISTS `auth_activation_attempts`;
CREATE TABLE IF NOT EXISTS `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
CREATE TABLE IF NOT EXISTS `auth_groups` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'user', 'Regular User');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

DROP TABLE IF EXISTS `auth_groups_permissions`;
CREATE TABLE IF NOT EXISTS `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0',
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'ricoroenaldo', NULL, '2024-09-19 08:51:52', 0),
(2, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-19 08:59:14', 1),
(3, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-19 09:18:35', 1),
(4, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-19 09:18:59', 1),
(5, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-22 12:34:37', 1),
(6, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-23 07:16:07', 1),
(7, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-24 03:58:33', 1),
(8, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-24 06:57:17', 1),
(9, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-26 03:13:42', 1),
(10, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-26 06:34:43', 1),
(11, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-26 08:14:19', 1),
(12, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-28 10:17:14', 1),
(13, '::1', 'asdf', NULL, '2024-09-28 10:17:44', 0),
(14, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-28 12:19:15', 1),
(15, '::1', 'ricoroenaldo@outlook.com', 1, '2024-09-29 14:04:43', 1),
(16, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-01 03:40:53', 1),
(17, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-01 07:33:33', 1),
(18, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-01 07:34:39', 1),
(19, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-02 06:42:13', 1),
(20, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-02 15:28:46', 1),
(21, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-03 06:16:03', 1),
(22, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-03 09:37:51', 1),
(23, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-04 07:38:34', 1),
(24, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-28 06:37:12', 1),
(25, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-30 07:07:59', 1),
(26, '::1', 'ricoroenaldo@outlook.com', 1, '2024-10-31 04:24:40', 1),
(27, '::1', 'ricoroenaldo@outlook.com', 1, '2024-12-29 13:30:13', 1),
(28, '::1', 'ricoroenaldo@outlook.com', 1, '2024-12-29 13:34:26', 1),
(29, '::1', 'ricoroenaldo@outlook.com', 1, '2024-12-29 13:36:36', 1),
(30, '::1', 'ricoroenaldo@outlook.com', 1, '2025-01-01 14:43:14', 1),
(31, '::1', 'ricoroenaldo@outlook.com', 1, '2025-01-03 07:22:48', 1),
(32, '::1', 'ricoroenaldo@outlook.com', 1, '2025-01-03 13:38:35', 1),
(33, '::1', 'ricoroenaldo@outlook.com', 1, '2025-01-05 14:33:35', 1),
(34, '::1', 'ricoroenaldo@outlook.com', 1, '2025-01-09 03:41:58', 1),
(35, '2404:c0:5229:8f6:7ce6:ea4e:68f9:697f', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 08:47:31', 1),
(36, '2404:c0:5229:8f6:e8bb:c4ff:fe2a:13b', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 09:06:17', 1),
(37, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 11:00:33', 1),
(38, '103.144.38.190', 'ronstan', NULL, '2025-01-12 11:19:29', 0),
(39, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 11:19:42', 1),
(40, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 14:34:26', 1),
(41, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 14:55:49', 1),
(42, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 14:57:41', 1),
(43, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 14:58:26', 1),
(44, '103.144.38.190', 'ronstan', NULL, '2025-01-12 17:08:49', 0),
(45, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-12 17:09:00', 1),
(46, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 00:12:27', 1),
(47, '2404:c0:5010::2be6:202b', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 03:25:03', 1),
(48, '2404:c0:5010::2be7:ae79', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 04:13:18', 1),
(49, '2404:c0:5010::2be4:72e1', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 07:47:36', 1),
(50, '114.125.4.164', 'ronstan', NULL, '2025-01-13 11:59:11', 0),
(51, '114.125.4.164', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 11:59:24', 1),
(52, '2404:c0:5229:13e7:1413:1ba:4a2:985e', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 13:15:36', 1),
(53, '2404:c0:5229:13e7:bd86:4c9c:22b0:8813', 'rickoreonaldo94@gmail.com', 2, '2025-01-13 16:03:37', 1),
(54, '2404:c0:5010::2bf9:216b', 'rickoreonaldo94@gmail.com', 2, '2025-01-14 02:46:24', 1),
(55, '2404:c0:5010::2bf3:fbf8', 'rickoreonaldo94@gmail.com', 2, '2025-01-14 03:47:03', 1),
(56, '2404:c0:5229:13e7:b463:1c11:8aab:721b', 'rickoreonaldo94@gmail.com', 2, '2025-01-14 07:29:36', 1),
(57, '103.144.38.190', 'ronstan', NULL, '2025-01-14 12:46:51', 0),
(58, '103.144.38.190', 'ronstan', NULL, '2025-01-14 12:46:53', 0),
(59, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-14 12:47:04', 1),
(60, '114.125.57.68', 'ronstan', NULL, '2025-01-15 02:04:09', 0),
(61, '114.125.57.68', 'rickoreonaldo94@gmail.com', 2, '2025-01-15 02:04:19', 1),
(62, '2404:c0:5010::2bfd:da88', 'rickoreonaldo94@gmail.com', 2, '2025-01-15 04:04:18', 1),
(63, '2404:c0:5110::2a58:5969', 'rickoreonaldo94@gmail.com', 2, '2025-01-15 07:18:50', 1),
(64, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-15 14:00:53', 1),
(65, '2404:c0:5010::2c10:6079', 'ronstan', NULL, '2025-01-15 14:59:58', 0),
(66, '2404:c0:5010::2c10:6079', 'rickoreonaldo94@gmail.com', 2, '2025-01-15 15:00:15', 1),
(67, '2404:c0:5010::2c10:6079', 'rickoreonaldo94@gmail.com', 2, '2025-01-15 19:16:51', 1),
(68, '2404:c0:5010::2c10:6079', 'ronstan', NULL, '2025-01-16 00:48:21', 0),
(69, '2404:c0:5010::2c10:6079', 'ronsta', NULL, '2025-01-16 00:48:58', 0),
(70, '2404:c0:5010::2c10:6079', 'rickoreonaldo94@gmail.com', 2, '2025-01-16 00:49:13', 1),
(71, '2404:c0:5010::2c09:ec2e', 'rickoreonaldo94@gmail.com', 2, '2025-01-16 03:44:07', 1),
(72, '2404:c0:5010::2c10:6079', 'rickoreonaldo94@gmail.com', 2, '2025-01-16 03:49:11', 1),
(73, '2404:c0:5010::2c0e:ee95', 'rickoreonaldo94@gmail.com', 2, '2025-01-16 07:11:43', 1),
(74, '114.125.22.239', 'rickoreonaldo94@gmail.com', 2, '2025-01-16 15:23:25', 1),
(75, '202.67.47.9', 'rickoreonaldo94@gmail.com', 2, '2025-01-17 01:59:21', 1),
(76, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-17 04:38:13', 1),
(77, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-17 08:05:11', 1),
(78, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-17 10:46:57', 1),
(79, '223.255.224.126', 'rickoreonaldo94@gmail.com', 2, '2025-01-17 23:27:08', 1),
(80, '202.67.47.14', 'rickoreonaldo94@gmail.com', 2, '2025-01-18 06:37:27', 1),
(81, '223.255.224.114', 'rickoreonaldo94@gmail.com', 2, '2025-01-18 09:31:18', 1),
(82, '223.255.224.125', 'rickoreonaldo94@gmail.com', 2, '2025-01-18 17:29:14', 1),
(83, '223.255.224.123', 'rickoreonaldo94@gmail.com', 2, '2025-01-19 10:09:36', 1),
(84, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-19 12:21:58', 1),
(85, '114.125.5.60', 'rickoreonaldo94@gmail.com', 2, '2025-01-19 17:52:16', 1),
(86, '223.255.224.116', 'rickoreonaldo94@gmail.com', 2, '2025-01-20 00:31:37', 1),
(87, '223.255.224.119', 'rickoreonaldo94@gmail.com', 2, '2025-01-20 02:42:47', 1),
(88, '114.125.41.204', 'rickoreonaldo94@gmail.com', 2, '2025-01-20 10:30:07', 1),
(89, '202.67.47.7', 'rickoreonaldo94@gmail.com', 2, '2025-01-21 02:05:03', 1),
(90, '202.67.47.5', 'rickoreonaldo94@gmail.com', 2, '2025-01-21 08:11:46', 1),
(91, '2404:c0:5010::2c62:ff87', 'rickoreonaldo94@gmail.com', 2, '2025-01-21 11:39:12', 1),
(92, '223.255.224.125', 'rickoreonaldo94@gmail.com', 2, '2025-01-21 12:56:13', 1),
(93, '223.255.224.119', 'rickoreonaldo94@gmail.com', 2, '2025-01-22 01:00:15', 1),
(94, '2404:c0:5222:4d81:cc3d:2597:eabd:4396', 'rickoreonaldo94@gmail.com', 2, '2025-01-22 01:53:20', 1),
(95, '2404:c0:5222:4d81:2d98:2006:8807:b6bb', 'rickoreonaldo94@gmail.com', 2, '2025-01-22 09:04:19', 1),
(96, '223.255.224.114', 'rickoreonaldo94@gmail.com', 2, '2025-01-22 13:41:36', 1),
(97, '223.255.224.114', 'rickoreonaldo94@gmail.com', 2, '2025-01-22 19:36:26', 1),
(98, '223.255.224.114', 'rickoreonaldo94@gmail.com', 2, '2025-01-22 19:36:26', 1),
(99, '114.125.41.147', 'rickoreonaldo94@gmail.com', 2, '2025-01-23 00:31:02', 1),
(100, '2404:c0:5010::2c70:dd18', 'rickoreonaldo94@gmail.com', 2, '2025-01-23 04:11:36', 1),
(101, '2404:c0:5010::2c75:4c18', 'rickoreonaldo94@gmail.com', 2, '2025-01-23 08:45:26', 1),
(102, '202.67.47.3', 'rickoreonaldo94@gmail.com', 2, '2025-01-23 14:12:47', 1),
(103, '223.255.224.113', 'rickoreonaldo94@gmail.com', 2, '2025-01-24 01:14:40', 1),
(104, '2404:c0:5110::2ae3:4153', 'rickoreonaldo94@gmail.com', 2, '2025-01-24 02:21:37', 1),
(105, '223.255.224.115', 'rickoreonaldo94@gmail.com', 2, '2025-01-24 14:34:31', 1),
(106, '223.255.224.126', 'rickoreonaldo94@gmail.com', 2, '2025-01-25 00:43:34', 1),
(107, '223.255.224.124', 'rickoreonaldo94@gmail.com', 2, '2025-01-25 06:39:27', 1),
(108, '223.255.224.116', 'rickoreonaldo94@gmail.com', 2, '2025-01-25 11:22:06', 1),
(109, '223.255.224.119', 'rickoreonaldo94@gmail.com', 2, '2025-01-25 12:54:31', 1),
(110, '114.125.41.51', 'rickoreonaldo94@gmail.com', 2, '2025-01-25 16:44:15', 1),
(111, '223.255.224.113', 'rickoreonaldo94@gmail.com', 2, '2025-01-25 20:50:35', 1),
(112, '114.125.6.228', 'rickoreonaldo94@gmail.com', 2, '2025-01-26 00:09:00', 1),
(113, '114.125.6.227', 'rickoreonaldo94@gmail.com', 2, '2025-01-26 04:55:41', 1),
(114, '223.255.224.126', 'rickoreonaldo94@gmail.com', 2, '2025-01-26 09:43:57', 1),
(115, '223.255.224.119', 'rickoreonaldo94@gmail.com', 2, '2025-01-26 15:38:22', 1),
(116, '223.255.224.123', 'rickoreonaldo94@gmail.com', 2, '2025-01-27 01:52:24', 1),
(117, '223.255.224.115', 'rickoreonaldo94@gmail.com', 2, '2025-01-27 06:14:29', 1),
(118, '223.255.224.115', 'rickoreonaldo94@gmail.com', 2, '2025-01-27 11:06:19', 1),
(119, '180.252.54.196', 'rickoreonaldo94@gmail.com', 2, '2025-01-27 12:02:43', 1),
(120, '223.255.224.122', 'rickoreonaldo94@gmail.com', 2, '2025-01-28 01:59:35', 1),
(121, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-28 03:31:02', 1),
(122, '223.255.224.117', 'rickoreonaldo94@gmail.com', 2, '2025-01-28 11:18:44', 1),
(123, '223.255.224.117', 'rickoreonaldo94@gmail.com', 2, '2025-01-28 11:55:12', 1),
(124, '223.255.224.117', 'rickoreonaldo94@gmail.com', 2, '2025-01-28 23:54:18', 1),
(125, '2001:448a:1002:1858:4db:172d:2818:c276', 'rickoreonaldo94@gmail.com', 2, '2025-01-29 12:50:11', 1),
(126, '223.255.224.115', 'rickoreonaldo94@gmail.com', 2, '2025-01-29 15:11:48', 1),
(127, '223.255.224.115', 'ADMIN\' OR 1=1 #', NULL, '2025-01-29 16:17:01', 0),
(128, '223.255.224.115', 'rickoreonaldo94@gmail.com', 2, '2025-01-29 16:17:06', 1),
(129, '223.255.224.126', 'rickoreonaldo94@gmail.com', 2, '2025-01-29 19:30:49', 1),
(130, '180.242.199.209', 'rickoreonaldo94@gmail.com', 2, '2025-01-29 23:21:47', 1),
(131, '2404:c0:5110::2b30:51f3', 'rickoreonaldo94@gmail.com', 2, '2025-01-30 01:41:06', 1),
(132, '2404:c0:5224:39df:edad:14b5:aa12:4b76', 'rickoreonaldo94@gmail.com', 2, '2025-01-30 05:17:04', 1),
(133, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-30 12:22:25', 1),
(134, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-01-30 15:16:52', 1),
(135, '223.255.224.119', 'rickoreonaldo94@gmail.com', 2, '2025-01-31 00:02:06', 1),
(136, '2404:c0:5320:4982:2d68:2c49:2db7:afba', 'rickoreonaldo94@gmail.com', 2, '2025-01-31 00:59:39', 1),
(137, '2404:c0:5110::2b40:366b', 'rickoreonaldo94@gmail.com', 2, '2025-01-31 05:31:57', 1),
(138, '2001:448a:1002:1858:fc6e:5efc:8b79:7696', 'rickoreonaldo94@gmail.com', 2, '2025-01-31 14:45:45', 1),
(139, '180.242.195.79', 'rickoreonaldo94@gmail.com', 2, '2025-01-31 16:27:22', 1),
(140, '202.67.47.2', 'rickoreonaldo94@gmail.com', 2, '2025-01-31 23:13:36', 1),
(141, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-02-01 06:10:32', 1),
(142, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-02-01 08:53:50', 1),
(143, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-02-01 11:22:25', 1),
(144, '223.255.224.118', 'rickoreonaldo94@gmail.com', 2, '2025-02-02 03:07:12', 1),
(145, '202.67.47.4', 'rickoreonaldo94@gmail.com', 2, '2025-02-02 05:34:32', 1),
(146, '223.255.224.115', 'rickoreonaldo94@gmail.com', 2, '2025-02-02 10:59:30', 1),
(147, '223.255.224.120', 'rickoreonaldo94@gmail.com', 2, '2025-02-02 14:54:20', 1),
(148, '180.242.195.79', 'rickoreonaldo94@gmail.com', 2, '2025-02-02 15:41:49', 1),
(149, '180.242.195.79', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 00:37:04', 1),
(150, '2404:c0:5110::2b69:159a', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 01:55:03', 1),
(151, '202.154.190.150', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 02:31:06', 1),
(152, '182.2.5.198', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 04:05:44', 1),
(153, '2404:c0:5110::2b68:b9d7', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 08:44:41', 1),
(154, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 13:21:38', 1),
(155, '180.242.194.41', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 17:37:41', 1),
(156, '180.242.194.41', 'rickoreonaldo94@gmail.com', 2, '2025-02-03 21:57:08', 1),
(157, '202.154.190.150', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 01:18:59', 1),
(158, '180.242.194.41', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 01:30:16', 1),
(159, '202.154.190.150', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 04:08:03', 1),
(160, '2404:c0:5110::2b7b:7cc5', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 04:31:50', 1),
(161, '182.2.5.65', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 05:41:42', 1),
(162, '182.2.5.65', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 07:12:20', 1),
(163, '182.2.5.65', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 07:13:14', 1),
(164, '103.144.38.190', 'rickoreonaldo94@gmail.com', 2, '2025-02-04 12:29:49', 1),
(165, '202.67.47.2', 'rickoreonaldo94@gmail.com', 2, '2025-02-05 00:27:50', 1),
(166, '2404:c0:5228:2ffb:785c:7abd:299e:ae68', 'rickoreonaldo94@gmail.com', 2, '2025-02-05 04:05:54', 1),
(167, '2404:c0:5228:2ffb:785c:7abd:299e:ae68', 'rickoreonaldo94@gmail.com', 2, '2025-02-05 06:32:44', 1),
(168, '212.140.138.218', 'rickoreonaldo94@gmail.com', 2, '2025-02-05 07:41:30', 1),
(169, '180.242.195.125', 'rickoreonaldo94@gmail.com', 2, '2025-02-05 11:40:00', 1),
(170, '180.242.195.125', 'ricoroenaldo@outlook.com', 1, '2025-02-05 12:14:21', 1),
(171, '180.242.195.125', 'ricoroenaldo@outlook.com', 1, '2025-02-05 12:15:46', 1),
(172, '180.242.195.125', 'ricoroenaldo@outlook.com', 1, '2025-02-05 16:09:25', 1),
(173, '180.242.195.125', 'rickoreonaldo94@gmail.com', 2, '2025-02-05 22:44:43', 1),
(174, '2404:c0:532b:202e:e529:fbff:d791:4bd', 'ricoroenaldo@outlook.com', 1, '2025-02-06 03:41:17', 1),
(175, '2001:861:8c80:a1f0:821:61fb:8ddc:593', 'rickoreonaldo94@gmail.com', 2, '2025-02-06 07:47:17', 1),
(176, '2404:c0:532b:202e:e529:fbff:d791:4bd', 'ricoroenaldo@outlook.com', 1, '2025-02-06 08:09:00', 1),
(177, '2404:c0:532b:202e:bcfe:a324:8c8a:22ae', 'ricoroenaldo@outlook.com', 1, '2025-02-06 08:11:48', 1),
(178, '2404:c0:532b:202e:e529:fbff:d791:4bd', 'ricoroenaldo@outlook.com', 1, '2025-02-06 09:25:51', 1),
(179, '2404:c0:532b:202e:e529:fbff:d791:4bd', 'ricoroenaldo@outlook.com', 1, '2025-02-06 09:41:59', 1),
(180, '2404:c0:532b:202e:e529:fbff:d791:4bd', 'ricoroenaldo@outlook.com', 1, '2025-02-06 09:54:55', 1),
(181, '2404:c0:532b:202e:bcfe:a324:8c8a:22ae', 'ricoroenaldo@outlook.com', 1, '2025-02-06 09:57:37', 1),
(182, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-06 12:54:37', 1),
(184, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-06 13:18:44', 1),
(186, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-06 13:58:02', 1),
(187, '223.255.224.115', 'ricoroenaldo@outlook.com', 1, '2025-02-07 01:02:45', 1),
(188, '2404:c0:5010::2d44:69b8', 'ricoroenaldo@outlook.com', 1, '2025-02-07 04:32:43', 1),
(189, '2404:c0:5010::2d44:69b8', 'ricoroenaldo@outlook.com', 1, '2025-02-07 06:53:07', 1),
(190, '182.2.4.238', 'ricoroenaldo@outlook.com', 1, '2025-02-07 08:15:21', 1),
(191, '2404:c0:5010::2d48:4483', 'ricoroenaldo@outlook.com', 1, '2025-02-07 11:13:13', 1),
(192, '223.255.224.120', 'ricoroenaldo@outlook.com', 1, '2025-02-07 20:10:03', 1),
(193, '223.255.224.126', 'ricoroenaldo@outlook.com', 1, '2025-02-07 23:24:49', 1),
(194, '202.67.47.5', 'ricoroenaldo@outlook.com', 1, '2025-02-08 01:29:58', 1),
(195, '202.67.47.10', 'ricoroenaldo@outlook.com', 1, '2025-02-08 03:41:49', 1),
(196, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-08 16:17:11', 1),
(197, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-09 06:21:22', 1),
(198, '223.255.224.113', 'ricoroenaldo@outlook.com', 1, '2025-02-09 10:05:38', 1),
(199, '223.255.224.114', 'ricoroenaldo@outlook.com', 1, '2025-02-09 11:49:16', 1),
(200, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-09 13:11:57', 1),
(201, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-09 17:48:30', 1),
(202, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-10 00:24:23', 1),
(203, '2404:c0:5110::2bca:abe1', 'ricoroenaldo@outlook.com', 1, '2025-02-10 03:54:20', 1),
(204, '202.154.190.150', 'ronstan_head@ronstan.com', 2, '2025-02-10 04:48:26', 1),
(205, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-10 15:05:23', 1),
(206, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-11 02:53:25', 1),
(207, '182.2.4.20', 'ricoroenaldo@outlook.com', 1, '2025-02-11 08:24:08', 1),
(208, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-11 19:48:40', 1),
(209, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-12 02:49:17', 1),
(210, '2404:c0:5010::2d8e:f3ca', 'ricoroenaldo@outlook.com', 1, '2025-02-12 04:16:20', 1),
(211, '223.255.224.117', 'maintenance@metronarc.com', 5, '2025-02-12 10:38:45', 1),
(212, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-12 12:11:29', 1),
(213, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-12 14:15:30', 1),
(214, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-12 17:30:42', 1),
(215, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-13 00:51:59', 1),
(216, '103.144.38.190', 'maintenance@metronarc.com', 5, '2025-02-13 01:41:12', 1),
(217, '2404:c0:5110::2c00:3cec', 'ricoroenaldo@outlook.com', 1, '2025-02-13 04:00:22', 1),
(218, '202.154.190.150', 'ronstan_head@ronstan.com', 2, '2025-02-13 06:38:33', 1),
(219, '2404:c0:5110::2bf9:5078', 'ricoroenaldo@outlook.com', 1, '2025-02-13 09:15:42', 1),
(220, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-13 14:10:22', 1),
(221, '180.242.192.68', 'ricoroenaldo@outlook.com', 1, '2025-02-13 18:25:01', 1),
(222, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-14 01:13:48', 1),
(223, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-14 05:25:19', 1),
(224, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-14 06:20:18', 1),
(225, '2001:448a:1002:28a0:495e:f005:eb37:2134', 'ricoroenaldo@outlook.com', 1, '2025-02-14 11:29:44', 1),
(226, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-15 06:02:56', 1),
(227, '223.255.224.119', 'ricoroenaldo@outlook.com', 1, '2025-02-15 11:49:58', 1),
(228, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-16 01:31:03', 1),
(229, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-16 04:24:00', 1),
(230, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-16 10:39:31', 1),
(231, '223.255.224.126', 'ricoroenaldo@outlook.com', 1, '2025-02-16 23:46:36', 1),
(232, '223.255.224.114', 'ricoroenaldo@outlook.com', 1, '2025-02-17 03:44:14', 1),
(233, '2404:c0:5010::2df6:f687', 'ricoroenaldo@outlook.com', 1, '2025-02-17 06:06:59', 1),
(234, '223.255.224.117', 'ricoroenaldo@outlook.com', 1, '2025-02-17 07:57:58', 1),
(235, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-17 14:38:39', 1),
(236, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-18 02:45:51', 1),
(237, '2404:c0:5225:9723:94c9:a3b:915d:957', 'ricoroenaldo@outlook.com', 1, '2025-02-18 04:01:26', 1),
(238, '182.2.5.25', 'ricoroenaldo@outlook.com', 1, '2025-02-18 04:50:34', 1),
(239, '182.2.4.173', 'ricoroenaldo@outlook.com', 1, '2025-02-18 09:02:29', 1),
(240, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-19 01:18:16', 1),
(241, '202.154.190.150', 'ronstan_head@ronstan.com', 2, '2025-02-19 01:33:38', 1),
(242, '2404:c0:522e:f0bf:34e3:942e:eb5c:70a', 'ricoroenaldo@outlook.com', 1, '2025-02-19 04:24:30', 1),
(243, '223.255.224.116', 'ricoroenaldo@outlook.com', 1, '2025-02-19 06:26:33', 1),
(244, '2404:c0:5010::2e29:1fee', 'ricoroenaldo@outlook.com', 1, '2025-02-19 08:15:27', 1),
(245, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-19 20:35:53', 1),
(246, '202.154.190.150', 'ronstan_head@ronstan.com', 2, '2025-02-20 00:31:10', 1),
(247, '180.242.193.5', 'ricoroenaldo@outlook.com', 1, '2025-02-20 02:09:46', 1),
(248, '202.154.190.150', 'ronstan_head@ronstan.com', 2, '2025-02-20 03:09:27', 1),
(249, '2404:c0:5324:da03:c492:35f1:e80f:d421', 'maintenance@metronarc.com', 5, '2025-02-20 03:22:38', 1),
(250, '2404:c0:5324:da03:9027:3bf6:15bf:bcc7', 'ricoroenaldo@outlook.com', 1, '2025-02-20 04:43:44', 1),
(251, '2404:c0:5324:da03:c553:552c:24e6:5b31', 'ricoroenaldo@outlook.com', 1, '2025-02-20 07:36:47', 1),
(252, '202.154.190.150', 'ronstan_head@ronstan.com', 2, '2025-02-20 08:22:39', 1),
(253, '223.255.224.123', 'ricoroenaldo@outlook.com', 1, '2025-02-21 02:03:13', 1),
(254, '223.255.224.113', 'ricoroenaldo@outlook.com', 1, '2025-02-21 05:34:02', 1),
(255, '223.255.224.119', 'ricoroenaldo@outlook.com', 1, '2025-02-21 10:12:52', 1),
(256, '180.242.199.143', 'ricoroenaldo@outlook.com', 1, '2025-02-22 02:25:38', 1),
(257, '223.255.224.117', 'ricoroenaldo@outlook.com', 1, '2025-02-22 05:03:46', 1),
(258, '36.77.7.47', 'ricoroenaldo@outlook.com', 1, '2025-02-22 12:33:24', 1),
(259, '223.255.224.123', 'ricoroenaldo@outlook.com', 1, '2025-02-22 15:57:16', 1),
(260, '180.242.199.143', 'ricoroenaldo@outlook.com', 1, '2025-02-23 00:15:03', 1),
(261, '180.242.199.143', 'ricoroenaldo@outlook.com', 1, '2025-02-23 03:25:05', 1),
(262, '223.255.224.122', 'ricoroenaldo@outlook.com', 1, '2025-02-23 07:11:27', 1),
(263, '180.242.199.143', 'ricoroenaldo@outlook.com', 1, '2025-02-23 17:16:57', 1),
(264, '180.242.199.143', 'ricoroenaldo@outlook.com', 1, '2025-02-24 02:50:32', 1),
(265, '2404:c0:5110::2cf1:530d', 'ricoroenaldo@outlook.com', 1, '2025-02-24 08:55:47', 1),
(266, '223.255.224.116', 'ricoroenaldo@outlook.com', 1, '2025-02-24 11:35:44', 1),
(267, '223.255.224.113', 'ricoroenaldo@outlook.com', 1, '2025-02-25 01:31:07', 1),
(268, '202.67.47.8', 'ricoroenaldo@outlook.com', 1, '2025-02-25 05:49:06', 1),
(269, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-25 13:18:25', 1),
(270, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-25 15:28:01', 1),
(271, '103.144.38.190', 'maintenance@metronarc.com', 5, '2025-02-26 01:46:00', 1),
(272, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-26 02:29:20', 1),
(273, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-26 15:41:20', 1),
(274, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-27 02:41:35', 1),
(275, '223.255.224.124', 'ricoroenaldo@outlook.com', 1, '2025-02-27 05:22:20', 1),
(276, '223.255.224.123', 'ricoroenaldo@outlook.com', 1, '2025-02-27 07:53:56', 1),
(277, '202.67.47.13', 'ricoroenaldo@outlook.com', 1, '2025-02-27 10:20:25', 1),
(278, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-27 15:44:46', 1),
(279, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-28 00:44:17', 1),
(280, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-28 02:56:14', 1),
(281, '180.242.194.77', 'ricoroenaldo@outlook.com', 1, '2025-02-28 03:17:43', 1),
(282, '223.255.224.125', 'ricoroenaldo@outlook.com', 1, '2025-02-28 09:12:21', 1),
(283, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-28 11:48:33', 1),
(284, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-02-28 14:44:21', 1),
(285, '180.242.199.174', 'ricoroenaldo@outlook.com', 1, '2025-03-01 02:42:02', 1),
(286, '180.242.199.174', 'ricoroenaldo@outlook.com', 1, '2025-03-01 05:56:44', 1),
(287, '202.67.47.10', 'ricoroenaldo@outlook.com', 1, '2025-03-01 14:45:57', 1),
(288, '180.252.59.73', 'ricoroenaldo@outlook.com', 1, '2025-03-02 06:11:03', 1),
(289, '180.252.59.73', 'ricoroenaldo@outlook.com', 1, '2025-03-02 08:22:55', 1),
(290, '180.252.56.144', 'ricoroenaldo@outlook.com', 1, '2025-03-02 11:23:18', 1),
(291, '223.255.224.124', 'ricoroenaldo@outlook.com', 1, '2025-03-02 15:16:43', 1),
(292, '180.242.199.111', 'ricoroenaldo@outlook.com', 1, '2025-03-03 01:01:27', 1),
(293, '2404:c0:5110::92:a5b', 'ricoroenaldo@outlook.com', 1, '2025-03-03 04:06:06', 1),
(294, '223.255.224.123', 'ricoroenaldo@outlook.com', 1, '2025-03-03 08:48:46', 1),
(295, '223.255.224.120', 'ricoroenaldo@outlook.com', 1, '2025-03-03 09:11:36', 1),
(296, '202.67.47.2', 'ricoroenaldo@outlook.com', 1, '2025-03-03 12:17:35', 1),
(297, '180.242.195.132', 'ricoroenaldo@outlook.com', 1, '2025-03-04 02:46:06', 1),
(298, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-04 04:33:53', 1),
(299, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-04 06:18:12', 1),
(300, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-04 09:57:57', 1),
(301, '223.255.224.116', 'ricoroenaldo@outlook.com', 1, '2025-03-04 19:52:46', 1),
(302, '223.255.224.123', 'ricoroenaldo@outlook.com', 1, '2025-03-04 22:03:49', 1),
(303, '223.255.224.126', 'ricoroenaldo@outlook.com', 1, '2025-03-05 00:48:09', 1),
(304, '223.255.224.122', 'ricoroenaldo@outlook.com', 1, '2025-03-05 03:34:30', 1),
(305, '2404:c0:5325:631b:2908:ea7:4a79:f2db', 'ricoroenaldo@outlook.com', 1, '2025-03-05 04:32:44', 1),
(306, '223.255.224.117', 'ricoroenaldo@outlook.com', 1, '2025-03-05 08:23:18', 1),
(307, '223.255.224.126', 'ricoroenaldo@outlook.com', 1, '2025-03-05 10:58:50', 1),
(308, '103.144.38.190', 'maintenance@metronarc.com', 5, '2025-03-05 15:12:50', 1),
(309, '202.67.47.5', 'ricoroenaldo@outlook.com', 1, '2025-03-05 16:57:54', 1),
(310, '223.255.224.126', 'ricoroenaldo@outlook.com', 1, '2025-03-06 00:24:53', 1),
(311, '2404:c0:5321:bd91:8526:f04b:6bb9:488c', 'ricoroenaldo@outlook.com', 1, '2025-03-06 01:28:06', 1),
(312, '223.255.224.114', 'ricoroenaldo@outlook.com', 1, '2025-03-06 10:34:39', 1),
(313, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-06 13:23:16', 1),
(314, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-06 15:03:46', 1),
(315, '223.255.224.113', 'ricoroenaldo@outlook.com', 1, '2025-03-07 01:42:30', 1),
(316, '223.255.224.119', 'ricoroenaldo@outlook.com', 1, '2025-03-07 03:53:44', 1),
(317, '202.67.47.1', 'ricoroenaldo@outlook.com', 1, '2025-03-07 10:47:32', 1),
(318, '223.255.224.118', 'ricoroenaldo@outlook.com', 1, '2025-03-07 17:41:37', 1),
(319, '223.255.224.117', 'ricoroenaldo@outlook.com', 1, '2025-03-08 01:48:25', 1),
(320, '202.67.47.14', 'ricoroenaldo@outlook.com', 1, '2025-03-08 11:17:48', 1),
(321, '223.255.224.116', 'ricoroenaldo@outlook.com', 1, '2025-03-08 14:37:56', 1),
(322, '223.255.224.120', 'ricoroenaldo@outlook.com', 1, '2025-03-08 22:19:26', 1),
(323, '202.67.47.11', 'ricoroenaldo@outlook.com', 1, '2025-03-09 04:45:17', 1),
(324, '223.255.224.126', 'ricoroenaldo@outlook.com', 1, '2025-03-09 12:11:06', 1),
(325, '223.255.224.121', 'ricoroenaldo@outlook.com', 1, '2025-03-09 18:20:18', 1),
(326, '223.255.224.119', 'ricoroenaldo@outlook.com', 1, '2025-03-10 01:41:35', 1),
(327, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-10 04:22:55', 1),
(328, '103.144.38.190', 'ricoroenaldo@outlook.com', 1, '2025-03-10 07:08:49', 1),
(329, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-07 13:28:54', 1),
(330, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-09 12:58:59', 1),
(331, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-11 09:43:27', 1),
(332, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-11 09:58:28', 1),
(333, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-14 04:44:19', 1),
(334, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-15 08:28:28', 1),
(335, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-15 18:06:44', 1),
(336, '::1', 'admin@user.com', 6, '2025-04-18 10:27:17', 1),
(337, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-18 13:33:42', 1),
(338, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-19 09:51:47', 1),
(339, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-19 09:53:34', 1),
(340, '::1', 'ricoroealdo', NULL, '2025-04-23 06:33:47', 0),
(341, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-23 06:33:54', 1),
(342, '::1', 'marinternet.id@gmail.com', 7, '2025-04-23 10:16:37', 1),
(343, '::1', 'ricoroenaldo@outlook.com', 1, '2025-04-24 13:29:32', 1),
(344, '::1', 'marinternet.id@gmail.com', 7, '2025-04-24 13:59:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

DROP TABLE IF EXISTS `auth_permissions`;
CREATE TABLE IF NOT EXISTS `auth_permissions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All Users'),
(2, 'manage-profile', 'Manage User\'s Profile');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

DROP TABLE IF EXISTS `auth_reset_attempts`;
CREATE TABLE IF NOT EXISTS `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

DROP TABLE IF EXISTS `auth_users_permissions`;
CREATE TABLE IF NOT EXISTS `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0',
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1726735475, 1);

-- --------------------------------------------------------

--
-- Table structure for table `operational_procedures`
--

DROP TABLE IF EXISTS `operational_procedures`;
CREATE TABLE IF NOT EXISTS `operational_procedures` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `document-number` varchar(50) NOT NULL,
  `document-name` varchar(255) NOT NULL,
  `effective-date` date NOT NULL,
  `revision-status` varchar(50) NOT NULL,
  `document-route` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `operational_procedures`
--

INSERT INTO `operational_procedures` (`ID`, `document-number`, `document-name`, `effective-date`, `revision-status`, `document-route`) VALUES
(5, '02.07.05', 'Create New Apache Virtual Host', '2025-04-18', 'Rev-1', '02.07.05 MDI - Create New Apache Virtual Host.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_image` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `user_image`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ricoroenaldo@outlook.com', 'ricoroenaldo', NULL, 'default.svg', '$2y$10$gQ2PwbMRsv.qi.r8KxgewOW81vv.GzY4Za4zjsQrCcj8SP2aol9ny', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-09-19 08:59:08', '2024-09-19 08:59:08', NULL),
(7, 'marinternet.id@gmail.com', 'mdi', NULL, 'default.svg', '$2y$10$idBHtuMJgyiaUsqrXKtIbOfxFMolj3ZOaOAC87LF5CYsRiqpGyseG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-04-23 10:15:31', '2025-04-23 10:15:31', NULL),
(8, 'rendy.hvacr@gmail.com', 'rendy', NULL, 'default.svg', '$2y$10$Ks/N50yMNettRhsKKKRsG.7DHcG8d9JBxpIudTw6d3nDIVbmXZsau', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-04-24 14:03:50', '2025-04-24 14:03:50', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
