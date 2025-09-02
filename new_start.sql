-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 02:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_start`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"name\":\"test\",\"email\":\"test@start.com\",\"email_verified_at\":\"2024-09-01T14:38:13.000000Z\",\"password\":\"$2y$12$bjLoJ3u6eRyDe7g63fpmEOfmZz\\/X7DDFGtdKoUp5uv68SUAI6np1S\",\"remember_token\":null,\"created_at\":\"2024-09-01T11:38:53.000000Z\",\"updated_at\":\"2024-09-01T11:43:35.000000Z\",\"profile_photo_path\":\"users\\/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG\",\"deleted_at\":null},\"old\":{\"id\":2,\"name\":\"test\",\"email\":\"test@start.com\",\"email_verified_at\":\"2024-09-01T14:38:13.000000Z\",\"password\":\"$2y$12$vDfnMASP.t\\/R7kgvNrIsSunLcpHdJbOqezzfS6Q8nhv9lTiPtKkE2\",\"remember_token\":null,\"created_at\":\"2024-09-01T11:38:53.000000Z\",\"updated_at\":\"2024-09-01T11:38:53.000000Z\",\"profile_photo_path\":\"users\\/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG\",\"deleted_at\":null}}', NULL, '2024-09-01 08:43:35', '2024-09-01 08:43:35'),
(2, 'Resource', 'User Updated by admin', 'App\\Models\\User', 'Updated', 2, 'App\\Models\\User', 1, '{\"updated_at\":\"2024-09-01 11:43:35\"}', NULL, '2024-09-01 08:43:35', '2024-09-01 08:43:35'),
(3, 'Resource', 'Role Created', 'Spatie\\Permission\\Models\\Role', 'Created', 1, NULL, NULL, '{\"guard_name\":\"web\",\"name\":\"super_admin\",\"updated_at\":\"2024-09-01 12:24:15\",\"created_at\":\"2024-09-01 12:24:15\",\"id\":1}', NULL, '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(4, 'Resource', 'Role Created by admin', 'Spatie\\Permission\\Models\\Role', 'Created', 2, 'App\\Models\\User', 1, '{\"name\":\"\\u0639\\u0636\\u0648\",\"guard_name\":\"web\",\"updated_at\":\"2024-09-01 12:27:40\",\"created_at\":\"2024-09-01 12:27:40\",\"id\":2}', NULL, '2024-09-01 09:27:40', '2024-09-01 09:27:40'),
(5, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"name\":\"test\",\"email\":\"test@start.com\",\"email_verified_at\":\"2024-09-01T14:38:13.000000Z\",\"password\":\"$2y$12$bjLoJ3u6eRyDe7g63fpmEOfmZz\\/X7DDFGtdKoUp5uv68SUAI6np1S\",\"role\":\"1\",\"remember_token\":null,\"created_at\":\"2024-09-01T11:38:53.000000Z\",\"updated_at\":\"2024-09-01T12:36:02.000000Z\",\"profile_photo_path\":\"users\\/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG\",\"deleted_at\":null},\"old\":{\"id\":2,\"name\":\"test\",\"email\":\"test@start.com\",\"email_verified_at\":\"2024-09-01T14:38:13.000000Z\",\"password\":\"$2y$12$bjLoJ3u6eRyDe7g63fpmEOfmZz\\/X7DDFGtdKoUp5uv68SUAI6np1S\",\"role\":null,\"remember_token\":null,\"created_at\":\"2024-09-01T11:38:53.000000Z\",\"updated_at\":\"2024-09-01T11:43:35.000000Z\",\"profile_photo_path\":\"users\\/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG\",\"deleted_at\":null}}', NULL, '2024-09-01 09:36:02', '2024-09-01 09:36:02'),
(6, 'Resource', 'User Updated by admin', 'App\\Models\\User', 'Updated', 2, 'App\\Models\\User', 1, '{\"role\":\"1\",\"updated_at\":\"2024-09-01 12:36:02\"}', NULL, '2024-09-01 09:36:02', '2024-09-01 09:36:02'),
(7, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"name\":\"test\",\"email\":\"test@start.com\",\"email_verified_at\":\"2024-09-01T14:38:13.000000Z\",\"password\":\"$2y$12$bjLoJ3u6eRyDe7g63fpmEOfmZz\\/X7DDFGtdKoUp5uv68SUAI6np1S\",\"role\":\"\\u0639\\u0636\\u0648\",\"remember_token\":null,\"created_at\":\"2024-09-01T11:38:53.000000Z\",\"updated_at\":\"2024-09-01T12:37:12.000000Z\",\"profile_photo_path\":\"users\\/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG\",\"deleted_at\":null},\"old\":{\"id\":2,\"name\":\"test\",\"email\":\"test@start.com\",\"email_verified_at\":\"2024-09-01T14:38:13.000000Z\",\"password\":\"$2y$12$bjLoJ3u6eRyDe7g63fpmEOfmZz\\/X7DDFGtdKoUp5uv68SUAI6np1S\",\"role\":\"1\",\"remember_token\":null,\"created_at\":\"2024-09-01T11:38:53.000000Z\",\"updated_at\":\"2024-09-01T12:36:02.000000Z\",\"profile_photo_path\":\"users\\/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG\",\"deleted_at\":null}}', NULL, '2024-09-01 09:37:12', '2024-09-01 09:37:12'),
(8, 'Resource', 'User Updated by admin', 'App\\Models\\User', 'Updated', 2, 'App\\Models\\User', 1, '{\"role\":\"\\u0639\\u0636\\u0648\",\"updated_at\":\"2024-09-01 12:37:12\"}', NULL, '2024-09-01 09:37:12', '2024-09-01 09:37:12'),
(9, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"admin\",\"email\":\"admin@start.com\",\"email_verified_at\":\"2024-09-01T14:24:02.000000Z\",\"password\":\"$2y$12$3Azsb6uU77HiHj\\/zK8er6exLobSKqdFV25L11rjlLXDPJSkMpqwHm\",\"role\":\"super_admin\",\"remember_token\":null,\"created_at\":\"2024-09-01T07:36:37.000000Z\",\"updated_at\":\"2024-09-01T12:37:33.000000Z\",\"profile_photo_path\":\"users\\/01J6PN814SJXY0GHEQPBRZJ1RV.PNG\",\"deleted_at\":null},\"old\":{\"id\":1,\"name\":\"admin\",\"email\":\"admin@start.com\",\"email_verified_at\":\"2024-09-01T14:24:02.000000Z\",\"password\":\"$2y$12$3Azsb6uU77HiHj\\/zK8er6exLobSKqdFV25L11rjlLXDPJSkMpqwHm\",\"role\":null,\"remember_token\":null,\"created_at\":\"2024-09-01T07:36:37.000000Z\",\"updated_at\":\"2024-09-01T11:24:10.000000Z\",\"profile_photo_path\":\"users\\/01J6PN814SJXY0GHEQPBRZJ1RV.PNG\",\"deleted_at\":null}}', NULL, '2024-09-01 09:37:33', '2024-09-01 09:37:33'),
(10, 'Resource', 'User Updated by admin', 'App\\Models\\User', 'Updated', 1, 'App\\Models\\User', 1, '{\"role\":\"super_admin\",\"updated_at\":\"2024-09-01 12:37:33\"}', NULL, '2024-09-01 09:37:33', '2024-09-01 09:37:33'),
(11, 'Access', 'admin logged in', NULL, 'Login', NULL, 'App\\Models\\User', 1, '{\"ip\":\"::1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/128.0.0.0 Safari\\/537.36\"}', NULL, '2024-09-02 06:00:53', '2024-09-02 06:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:126:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"view_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"view_any_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"create_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"update_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:16:\"restore_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:20:\"restore_any_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:18:\"replicate_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"reorder_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"delete_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:19:\"delete_any_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:21:\"force_delete_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:25:\"force_delete_any_activity\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"view_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:17:\"view_any_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"create_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"update_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:16:\"restore_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:20:\"restore_any_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"replicate_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:16:\"reorder_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:15:\"delete_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:19:\"delete_any_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:21:\"force_delete_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:25:\"force_delete_any_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:12:\"view_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:16:\"view_any_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:14:\"create_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:14:\"update_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"restore_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:19:\"restore_any_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:17:\"replicate_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"reorder_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"delete_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:18:\"delete_any_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:20:\"force_delete_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:24:\"force_delete_any_comment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:15:\"view_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:19:\"view_any_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:17:\"create_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:17:\"update_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:18:\"restore_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:22:\"restore_any_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:20:\"replicate_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:18:\"reorder_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:17:\"delete_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:21:\"delete_any_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:23:\"force_delete_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:27:\"force_delete_any_newsletter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:9:\"view_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:13:\"view_any_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:11:\"create_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:11:\"update_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:12:\"restore_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:16:\"restore_any_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:14:\"replicate_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:12:\"reorder_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:11:\"delete_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:15:\"delete_any_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:17:\"force_delete_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:21:\"force_delete_any_post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:13:\"view_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:15:\"delete_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:16:\"view_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:20:\"view_any_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:18:\"create_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:18:\"update_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:19:\"restore_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:23:\"restore_any_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:21:\"replicate_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:19:\"reorder_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:18:\"delete_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:22:\"delete_any_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:24:\"force_delete_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:28:\"force_delete_any_seo::detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:12:\"view_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:16:\"view_any_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:14:\"create_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:14:\"update_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:15:\"restore_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:19:\"restore_any_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:17:\"replicate_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:15:\"reorder_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:14:\"delete_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:18:\"delete_any_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:20:\"force_delete_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:24:\"force_delete_any_setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:19:\"view_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:23:\"view_any_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:21:\"create_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:21:\"update_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:22:\"restore_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:26:\"restore_any_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:24:\"replicate_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:22:\"reorder_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:21:\"delete_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:25:\"delete_any_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:27:\"force_delete_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:31:\"force_delete_any_share::snippet\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:8:\"view_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:12:\"view_any_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:10:\"create_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:10:\"update_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:11:\"restore_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:15:\"restore_any_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:13:\"replicate_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:11:\"reorder_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:10:\"delete_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:14:\"delete_any_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:16:\"force_delete_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:20:\"force_delete_any_tag\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:13:\"view_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:12:\"restore_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:16:\"restore_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:14:\"replicate_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:121;a:4:{s:1:\"a\";i:122;s:1:\"b\";s:12:\"reorder_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:122;a:4:{s:1:\"a\";i:123;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:123;a:4:{s:1:\"a\";i:124;s:1:\"b\";s:15:\"delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:124;a:4:{s:1:\"a\";i:125;s:1:\"b\";s:17:\"force_delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:125;a:4:{s:1:\"a\";i:126;s:1:\"b\";s:21:\"force_delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:6:\"عضو\";s:1:\"c\";s:3:\"web\";}}}', 1725363073);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fblog_categories`
--

CREATE TABLE `fblog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(155) NOT NULL,
  `slug` varchar(155) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fblog_categories`
--

INSERT INTO `fblog_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '2024-09-01 06:52:42', '2024-09-01 06:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `fblog_posts`
--

CREATE TABLE `fblog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `body` longtext NOT NULL,
  `status` enum('published','scheduled','pending') NOT NULL DEFAULT 'pending',
  `published_at` datetime DEFAULT NULL,
  `scheduled_for` datetime DEFAULT NULL,
  `cover_photo_path` varchar(255) NOT NULL,
  `photo_alt_text` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fblog_posts`
--

INSERT INTO `fblog_posts` (`id`, `title`, `slug`, `sub_title`, `body`, `status`, `published_at`, `scheduled_for`, `cover_photo_path`, `photo_alt_text`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'rtyrt', 'rtyrt', 'ghjghjghh', '<p>ghjghrtyr rtry eryt</p>', 'published', '2024-09-01 09:55:38', NULL, 'blog-feature-images/Capture.PNG', 'ghjghj', 1, '2024-09-01 06:55:38', '2024-09-01 06:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'header',
  `title` varchar(255) NOT NULL,
  `items` longtext DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `icon` varchar(255) DEFAULT 'primary',
  `badge_color` varchar(255) DEFAULT NULL,
  `has_badge` tinyint(1) DEFAULT 1,
  `has_badge_query` tinyint(1) DEFAULT 1,
  `badge_table` varchar(255) DEFAULT NULL,
  `badge_condation` varchar(255) DEFAULT NULL,
  `badge` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`badge`)),
  `is_route` tinyint(1) DEFAULT 1,
  `route` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_01_091113_create_blog_tables', 2),
(5, '2024_09_01_091846_add_deleted_at_to_users_table', 3),
(6, '2024_09_01_112755_create_activity_log_table', 4),
(7, '2024_09_01_112756_add_event_column_to_activity_log_table', 4),
(8, '2024_09_01_112757_add_batch_uuid_column_to_activity_log_table', 4),
(9, '2024_09_01_122350_create_permission_tables', 5),
(10, '2024_09_01_122937_add_role_to_users_table', 6),
(11, '2024_09_02_100001_create_posts_table', 7),
(12, '2024_09_02_100001_create_tag_tables', 7),
(13, '2024_09_02_100002_create_faqs_table', 7),
(14, '2024_09_02_100003_modify_posts_columns', 7),
(15, '2024_09_02_100004_create_library_table', 7),
(16, '2024_09_02_100005_create_navigations_table', 7),
(17, '2022_04_02_192724_create_menus_table', 8),
(18, '2024_05_13_192724_create_menu_items_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 1),
(19, 'App\\Models\\User', 1),
(20, 'App\\Models\\User', 1),
(21, 'App\\Models\\User', 1),
(22, 'App\\Models\\User', 1),
(23, 'App\\Models\\User', 1),
(24, 'App\\Models\\User', 1),
(25, 'App\\Models\\User', 1),
(26, 'App\\Models\\User', 1),
(27, 'App\\Models\\User', 1),
(28, 'App\\Models\\User', 1),
(29, 'App\\Models\\User', 1),
(30, 'App\\Models\\User', 1),
(31, 'App\\Models\\User', 1),
(32, 'App\\Models\\User', 1),
(33, 'App\\Models\\User', 1),
(34, 'App\\Models\\User', 1),
(35, 'App\\Models\\User', 1),
(36, 'App\\Models\\User', 1),
(37, 'App\\Models\\User', 1),
(38, 'App\\Models\\User', 1),
(39, 'App\\Models\\User', 1),
(40, 'App\\Models\\User', 1),
(41, 'App\\Models\\User', 1),
(42, 'App\\Models\\User', 1),
(43, 'App\\Models\\User', 1),
(44, 'App\\Models\\User', 1),
(45, 'App\\Models\\User', 1),
(46, 'App\\Models\\User', 1),
(47, 'App\\Models\\User', 1),
(48, 'App\\Models\\User', 1),
(49, 'App\\Models\\User', 1),
(50, 'App\\Models\\User', 1),
(51, 'App\\Models\\User', 1),
(52, 'App\\Models\\User', 1),
(53, 'App\\Models\\User', 1),
(54, 'App\\Models\\User', 1),
(55, 'App\\Models\\User', 1),
(56, 'App\\Models\\User', 1),
(57, 'App\\Models\\User', 1),
(58, 'App\\Models\\User', 1),
(59, 'App\\Models\\User', 1),
(60, 'App\\Models\\User', 1),
(61, 'App\\Models\\User', 1),
(62, 'App\\Models\\User', 1),
(63, 'App\\Models\\User', 1),
(64, 'App\\Models\\User', 1),
(65, 'App\\Models\\User', 1),
(66, 'App\\Models\\User', 1),
(67, 'App\\Models\\User', 1),
(68, 'App\\Models\\User', 1),
(69, 'App\\Models\\User', 1),
(70, 'App\\Models\\User', 1),
(71, 'App\\Models\\User', 1),
(72, 'App\\Models\\User', 1),
(73, 'App\\Models\\User', 1),
(74, 'App\\Models\\User', 1),
(75, 'App\\Models\\User', 1),
(76, 'App\\Models\\User', 1),
(77, 'App\\Models\\User', 1),
(78, 'App\\Models\\User', 1),
(79, 'App\\Models\\User', 1),
(80, 'App\\Models\\User', 1),
(81, 'App\\Models\\User', 1),
(82, 'App\\Models\\User', 1),
(83, 'App\\Models\\User', 1),
(84, 'App\\Models\\User', 1),
(85, 'App\\Models\\User', 1),
(86, 'App\\Models\\User', 1),
(87, 'App\\Models\\User', 1),
(88, 'App\\Models\\User', 1),
(89, 'App\\Models\\User', 1),
(90, 'App\\Models\\User', 1),
(91, 'App\\Models\\User', 1),
(92, 'App\\Models\\User', 1),
(93, 'App\\Models\\User', 1),
(94, 'App\\Models\\User', 1),
(95, 'App\\Models\\User', 1),
(96, 'App\\Models\\User', 1),
(97, 'App\\Models\\User', 1),
(98, 'App\\Models\\User', 1),
(99, 'App\\Models\\User', 1),
(100, 'App\\Models\\User', 1),
(101, 'App\\Models\\User', 1),
(102, 'App\\Models\\User', 1),
(103, 'App\\Models\\User', 1),
(103, 'App\\Models\\User', 2),
(104, 'App\\Models\\User', 1),
(104, 'App\\Models\\User', 2),
(105, 'App\\Models\\User', 1),
(106, 'App\\Models\\User', 1),
(106, 'App\\Models\\User', 2),
(107, 'App\\Models\\User', 1),
(108, 'App\\Models\\User', 1),
(109, 'App\\Models\\User', 1),
(110, 'App\\Models\\User', 1),
(111, 'App\\Models\\User', 1),
(112, 'App\\Models\\User', 1),
(113, 'App\\Models\\User', 1),
(114, 'App\\Models\\User', 1),
(115, 'App\\Models\\User', 1),
(116, 'App\\Models\\User', 1),
(117, 'App\\Models\\User', 1),
(118, 'App\\Models\\User', 1),
(119, 'App\\Models\\User', 1),
(120, 'App\\Models\\User', 1),
(121, 'App\\Models\\User', 1),
(122, 'App\\Models\\User', 1),
(123, 'App\\Models\\User', 1),
(124, 'App\\Models\\User', 1),
(125, 'App\\Models\\User', 1),
(126, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `handle` varchar(255) NOT NULL,
  `items` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(2, 'view_any_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(3, 'create_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(4, 'update_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(5, 'restore_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(6, 'restore_any_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(7, 'replicate_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(8, 'reorder_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(9, 'delete_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(10, 'delete_any_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(11, 'force_delete_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(12, 'force_delete_any_activity', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(13, 'view_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(14, 'view_any_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(15, 'create_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(16, 'update_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(17, 'restore_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(18, 'restore_any_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(19, 'replicate_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(20, 'reorder_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(21, 'delete_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(22, 'delete_any_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(23, 'force_delete_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(24, 'force_delete_any_category', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(25, 'view_comment', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(26, 'view_any_comment', 'web', '2024-09-01 09:24:16', '2024-09-01 09:24:16'),
(27, 'create_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(28, 'update_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(29, 'restore_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(30, 'restore_any_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(31, 'replicate_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(32, 'reorder_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(33, 'delete_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(34, 'delete_any_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(35, 'force_delete_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(36, 'force_delete_any_comment', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(37, 'view_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(38, 'view_any_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(39, 'create_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(40, 'update_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(41, 'restore_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(42, 'restore_any_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(43, 'replicate_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(44, 'reorder_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(45, 'delete_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(46, 'delete_any_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(47, 'force_delete_newsletter', 'web', '2024-09-01 09:24:17', '2024-09-01 09:24:17'),
(48, 'force_delete_any_newsletter', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(49, 'view_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(50, 'view_any_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(51, 'create_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(52, 'update_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(53, 'restore_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(54, 'restore_any_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(55, 'replicate_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(56, 'reorder_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(57, 'delete_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(58, 'delete_any_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(59, 'force_delete_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(60, 'force_delete_any_post', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(61, 'view_role', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(62, 'view_any_role', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(63, 'create_role', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(64, 'update_role', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(65, 'delete_role', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(66, 'delete_any_role', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(67, 'view_seo::detail', 'web', '2024-09-01 09:24:18', '2024-09-01 09:24:18'),
(68, 'view_any_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(69, 'create_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(70, 'update_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(71, 'restore_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(72, 'restore_any_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(73, 'replicate_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(74, 'reorder_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(75, 'delete_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(76, 'delete_any_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(77, 'force_delete_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(78, 'force_delete_any_seo::detail', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(79, 'view_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(80, 'view_any_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(81, 'create_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(82, 'update_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(83, 'restore_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(84, 'restore_any_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(85, 'replicate_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(86, 'reorder_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(87, 'delete_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(88, 'delete_any_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(89, 'force_delete_setting', 'web', '2024-09-01 09:24:19', '2024-09-01 09:24:19'),
(90, 'force_delete_any_setting', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(91, 'view_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(92, 'view_any_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(93, 'create_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(94, 'update_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(95, 'restore_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(96, 'restore_any_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(97, 'replicate_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(98, 'reorder_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(99, 'delete_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(100, 'delete_any_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(101, 'force_delete_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(102, 'force_delete_any_share::snippet', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(103, 'view_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(104, 'view_any_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(105, 'create_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(106, 'update_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(107, 'restore_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(108, 'restore_any_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(109, 'replicate_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(110, 'reorder_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(111, 'delete_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(112, 'delete_any_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(113, 'force_delete_tag', 'web', '2024-09-01 09:24:20', '2024-09-01 09:24:20'),
(114, 'force_delete_any_tag', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(115, 'view_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(116, 'view_any_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(117, 'create_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(118, 'update_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(119, 'restore_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(120, 'restore_any_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(121, 'replicate_user', 'web', '2024-09-01 09:24:21', '2024-09-01 09:24:21'),
(122, 'reorder_user', 'web', '2024-09-01 09:24:22', '2024-09-01 09:24:22'),
(123, 'delete_user', 'web', '2024-09-01 09:24:22', '2024-09-01 09:24:22'),
(124, 'delete_any_user', 'web', '2024-09-01 09:24:22', '2024-09-01 09:24:22'),
(125, 'force_delete_user', 'web', '2024-09-01 09:24:22', '2024-09-01 09:24:22'),
(126, 'force_delete_any_user', 'web', '2024-09-01 09:24:22', '2024-09-01 09:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `post_type` varchar(255) NOT NULL DEFAULT 'post',
  `parent_id` int(11) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 1,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'publish',
  `sticky_until` datetime DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2024-09-01 09:24:15', '2024-09-01 09:24:15'),
(2, 'عضو', 'web', '2024-09-01 09:27:40', '2024-09-01 09:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(103, 2),
(104, 1),
(104, 2),
(105, 1),
(106, 1),
(106, 2),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('i7zgICtLxPuGxLDZgNg6KeTFakmP0vxrIbAHcdKY', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSURUMUd3MHlhSThvRDNPOUhmZ2owdnZXN3dwY2YwT2F1YjZ1ZHVIbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9sb2NhbGhvc3QvbmV3LXN0YXJ0L2FkbWluL215LWN1c3RvbS1kYXNoYm9hcmQtcGFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkM0F6c2I2dVU3N0hpSGoveks4ZXI2ZXhMb2JTS3FkRlYyNUwxMXJqbExYRFBKU2tNcHF3SG0iO30=', 1725278388);

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `type` varchar(255) DEFAULT NULL,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `profile_photo_path`, `deleted_at`) VALUES
(1, 'admin', 'admin@start.com', '2024-09-01 11:24:02', '$2y$12$3Azsb6uU77HiHj/zK8er6exLobSKqdFV25L11rjlLXDPJSkMpqwHm', 'super_admin', NULL, '2024-09-01 04:36:37', '2024-09-01 09:37:33', 'users/01J6PN814SJXY0GHEQPBRZJ1RV.PNG', NULL),
(2, 'test', 'test@start.com', '2024-09-01 11:38:13', '$2y$12$bjLoJ3u6eRyDe7g63fpmEOfmZz/X7DDFGtdKoUp5uv68SUAI6np1S', 'عضو', NULL, '2024-09-01 08:38:53', '2024-09-01 09:37:12', 'users/01J6PP2XWYEWVP1N3Z3QGY8GQ3.PNG', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fblog_categories`
--
ALTER TABLE `fblog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fblog_categories_name_unique` (`name`),
  ADD UNIQUE KEY `fblog_categories_slug_unique` (`slug`);

--
-- Indexes for table `fblog_posts`
--
ALTER TABLE `fblog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fblog_posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_key_unique` (`key`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `navigations_handle_unique` (`handle`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_index` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  ADD KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fblog_categories`
--
ALTER TABLE `fblog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fblog_posts`
--
ALTER TABLE `fblog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fblog_posts`
--
ALTER TABLE `fblog_posts`
  ADD CONSTRAINT `fblog_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
