-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2023 at 10:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aungmyin`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `package_id` int NOT NULL,
  `package_purchased_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `package_purchased_times` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`id`, `code`, `name`, `avatar`, `phoneNumber`, `address`, `status`, `package_id`, `package_purchased_date`, `package_purchased_times`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'demo-ghcbPcS', 'demo', NULL, '09400372581', 'demonstration', 1, 1, '2023-01-29 05:54:56', 0, '2023-01-29 05:54:56', '2023-01-29 05:54:56', NULL),
(11, 'kyaw clinic-rcGiEPs', 'Kyaw Kyaw', NULL, '09400372581', 'Demonstration', 1, 1, '2023-03-13 06:55:02', 0, '2023-05-13 06:55:02', '2023-08-11 05:14:13', NULL),
(12, 'demo aung-KfQL4Az', 'demo aung', NULL, '232423423423', 'demo', 1, 1, '2023-07-04 14:18:44', 0, '2023-07-04 14:18:44', '2023-07-04 14:18:44', NULL),
(13, 'demo-4SjJRJq', 'Aung Thamadi', '202308082315-Screenshot 2023-08-04 152904.png', '09484848484', 'Mandalay', 1, 3, '2023-07-20 15:25:42', 0, '2023-07-20 15:25:42', '2023-08-08 16:45:04', NULL),
(14, 'demo-8H7Z6mm', 'demo', NULL, '4444444', 'yangon', 1, 3, '2023-07-20 15:32:35', 0, '2023-07-20 15:32:35', '2023-07-20 15:32:35', NULL),
(15, 'demo-VGYBT6M', 'demo', NULL, '4444444', 'yangon', 1, 3, '2023-07-20 15:33:25', 0, '2023-07-20 15:33:25', '2023-07-20 15:33:25', NULL),
(16, 'demo-GiaQIz6', 'demo', NULL, '4444444', 'yangon', 1, 3, '2023-07-20 15:33:43', 0, '2023-07-20 15:33:43', '2023-07-20 15:33:43', NULL),
(17, 'demo-frATxdP', 'demo', NULL, '4444444', 'yangon', 1, 1, '2023-07-20 15:33:52', 0, '2023-07-20 15:33:52', '2023-07-20 15:33:52', NULL),
(18, 'Ziwaka-HMyUFTk', 'Ziwaka', NULL, '09485885848', 'No.180, Demonstration', 1, 4, '2023-07-20 16:23:44', 0, '2023-07-20 16:23:44', '2023-07-20 16:23:44', NULL),
(19, 'Ziwaka-dHojYhE', 'Ziwaka', NULL, '0494949494', 'Yangon', 1, 3, '2023-07-23 14:43:48', 0, '2023-07-23 14:43:48', '2023-07-23 14:43:48', NULL),
(20, 'Aung Aung-IC08waC', 'Aung Aung', NULL, '094949494949', 'Yangon', 1, 4, '2023-08-08 16:58:51', 0, '2023-08-08 16:58:51', '2023-08-08 16:58:51', NULL),
(21, 'Treasa-6SJXPjY', 'Treasa', NULL, '09484949494', 'Insein, Yangon', 1, 4, '2023-08-15 17:06:28', 0, '2023-08-15 17:06:28', '2023-08-15 17:06:28', NULL),
(22, 'Treasa-Fs7FG8e', 'Treasa', NULL, '09484949494', 'Insein, Yangon', 1, 4, '2023-08-15 17:06:41', 0, '2023-08-15 17:06:41', '2023-08-15 17:06:41', NULL),
(23, 'Daw Kyi-h4ulSyT', 'Daw Kyi', NULL, '095004949', 'Mogok', 1, 4, '2023-08-19 17:21:53', 0, '2023-08-19 17:21:53', '2023-08-19 17:21:53', NULL),
(24, 'Demo-53ImZfP', 'Aung Gyi', NULL, '09400372581', 'Mogok', 1, 4, '2023-08-20 05:31:54', 0, '2023-08-20 05:31:54', '2023-08-20 05:53:53', NULL),
(25, 'Thamadi-ly7KTC5', 'Thamadi', '202308271929-WIN_20230113_19_29_00_Pro.jpg', '0948484884', 'Mogok', 1, 4, '2023-08-22 09:13:48', 0, '2023-08-22 09:13:48', '2023-08-27 12:59:41', NULL),
(26, 'Aung Mingalar-BAZchMY', 'Aung Mingalar', '202309081306-matrix.jpeg', '0948484848', 'Yangon', 1, 4, '2023-08-30 15:10:46', 0, '2023-08-30 15:10:46', '2023-09-08 06:36:47', NULL),
(27, 'Mingle-pvvNBX8', 'Mingle', '202310041248-Screenshot_20230208_081553.png', '95858588', 'demo', 1, 1, '2023-10-04 06:18:50', 0, '2023-10-04 05:48:50', '2023-10-04 05:48:50', NULL),
(28, 'Demonstration-0c36uBJ', 'Demonstration', NULL, '0948484848', 'Mandalay', 1, 1, '2023-10-11 10:55:37', 0, '2023-10-11 10:25:37', '2023-10-11 10:25:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'dd', 'dd@gmail.com', 'password', '2023-04-05 13:52:45', '2023-04-05 13:52:45'),
(2, 'name', 'name@gmail.com', 'demonstration', '2023-04-05 13:54:42', '2023-04-05 13:54:42'),
(3, 'name', 'name@gmail.com', 'demonstration', '2023-04-05 13:54:55', '2023-04-05 13:54:55'),
(4, 'done', 'done@gmail.com', 'demonstration', '2023-04-05 16:23:55', '2023-04-05 16:23:55'),
(5, 'done', 'done@gmail.com', 'demonstration', '2023-04-05 16:27:52', '2023-04-05 16:27:52'),
(6, 'done', 'done@gmail.com', 'demonstration', '2023-04-05 16:29:24', '2023-04-05 16:29:24'),
(7, 'name', 'name@gmail.com', 'ldkjsf', '2023-04-22 03:06:54', '2023-04-22 03:06:54'),
(8, 'name', 'name@gmail.com', 'ldkjsf', '2023-04-22 03:34:14', '2023-04-22 03:34:14'),
(9, 'name', 'name@gmail.com', 'ldkjsf', '2023-04-22 03:36:29', '2023-04-22 03:36:29'),
(10, 'demo', 'demo@gmail.com', 'online message for demonstration', '2023-04-22 03:37:09', '2023-04-22 03:37:09'),
(11, 'demo', 'demo@gmail.com', 'online message for demonstration', '2023-04-22 03:37:34', '2023-04-22 03:37:34'),
(12, 'demo', 'demo@gmail.com', 'online message for demonstration', '2023-04-22 03:37:54', '2023-04-22 03:37:54'),
(13, 'demonstration', 'demon@gmail.com', 'password', '2023-04-22 03:41:19', '2023-04-22 03:41:19'),
(14, 'demo', 'demo@gmail.com', 'password', '2023-04-24 03:00:10', '2023-04-24 03:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE `dictionary` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meaning` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `price` int DEFAULT NULL,
  `isCommon` tinyint NOT NULL DEFAULT '0',
  `isMed` tinyint DEFAULT '0',
  `isProcedure` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dictionary`
--

INSERT INTO `dictionary` (`id`, `code`, `meaning`, `user_id`, `price`, `isCommon`, `isMed`, `isProcedure`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'fever', '1^paracetemol^1-1-1^5<br>', 8, NULL, 0, 1, 0, '2023-03-01 14:18:37', '2023-03-01 14:18:37', NULL),
(2, 'fever', '1^paracetemol^1-1-1^5<br>', 1, NULL, 0, 1, 0, '2023-03-01 14:35:30', '2023-03-01 14:35:30', NULL),
(3, 'fever', 'short glucose', 8, NULL, 0, 0, 0, '2023-03-04 14:36:35', '2023-03-04 14:36:35', NULL),
(8, 'hi', 'hello', 15, NULL, 0, NULL, 0, '2023-05-12 14:58:14', '2023-06-08 09:22:07', NULL),
(10, 'fever', 'Varius praesent dolore sem quasi fames. Erat aliquam amet nostrud.', 14, NULL, 0, 0, 0, '2023-05-13 14:30:38', '2023-07-09 14:44:46', NULL),
(12, 'online', 'sdfsdfs', 15, NULL, 0, NULL, 0, '2023-05-13 14:31:08', '2023-07-25 16:36:16', NULL),
(16, 'saykhann', '4^biogessic^1-1-1^3<br>4^biogessic^1-1-1^3<br>', 15, NULL, 0, 1, 0, '2023-06-06 04:11:34', '2023-07-25 16:37:08', NULL),
(17, 'say', '4^biogessic^1-1-1^2<br>', 14, NULL, 0, 1, 0, '2023-07-09 14:48:16', '2023-07-09 14:48:16', NULL),
(18, 'cough', '7^Paracetemol^0-0-1^2<br>4^biogessic^1-1-1^2<br>', 14, NULL, 0, 1, 0, '2023-07-10 15:11:58', '2023-07-11 15:19:50', NULL),
(19, 'demo', '4^biogessic^1-0-1^2<br>', 14, NULL, 0, 1, 0, '2023-07-12 02:39:42', '2023-07-12 02:39:42', NULL),
(25, 'fever', '10^Biogessic^1-1-1^2<br>', 50, NULL, 0, 1, 0, '2023-08-08 17:15:27', '2023-08-08 17:15:27', NULL),
(26, 'cough', 'Need to drink lots of hot drink', 50, NULL, 0, 0, 0, '2023-08-08 17:17:08', '2023-08-08 17:17:08', NULL),
(28, 'Fever', '12^Paracetemol^1-1-1^3<br>', 52, NULL, 0, 1, 0, '2023-08-15 17:11:25', '2023-08-15 17:11:25', NULL),
(29, 'Demo', 'TreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasaTreasa', 52, NULL, 0, 0, 0, '2023-08-15 17:12:09', '2023-08-15 17:12:09', NULL),
(30, 'code', 'Gravida totam maecenas mattis voluptates laudantium rem dolores? Provident, deserunt? Sapiente nisi posuere at qui ultricies? Enim fermentum excepteur venenatis dui, ad sed fermentum voluptate erat unde conubia hac orci! Facilisis repellat posuere.\r\n\r\nFacilisis morbi maiores ea? Class! Fugiat debitis tellus, cras itaque class velit at vehicula eget, habitasse delectus sociosqu, nulla interdum pharetra sociosqu? Ultrices iure egestas delectus! Facilis urna ultrices debitis per mauris lacinia.', 55, NULL, 0, 0, 0, '2023-08-24 13:28:49', '2023-08-24 13:28:49', NULL),
(31, 'fever', '13^Biogessic 500 mg^1-1-1^2<br>', 55, NULL, 0, 1, 0, '2023-08-24 13:30:01', '2023-08-30 08:46:55', NULL),
(32, 'bio', '13^Biogessic 500 mg^1-1-1^2<br>', 55, NULL, 0, 1, 0, '2023-08-30 08:51:19', '2023-08-30 08:51:19', NULL),
(34, 'fever', '14^600^1-1-1^3<br>', 56, NULL, 0, 1, 0, '2023-09-05 05:09:06', '2023-09-05 06:59:52', NULL),
(37, 'say-fever', 'xx^biogessic^1-1-1^2<br>', 56, NULL, 0, 1, 0, '2023-09-05 07:02:51', '2023-09-05 07:02:51', NULL),
(38, 'cough', 'xx^paracetemol^1-1-1^2<br>xx^daflon^1-1-1^5<br>xx^decolgne^1-1-1^3<br>', 56, NULL, 0, 1, 0, '2023-09-05 07:05:37', '2023-09-05 07:05:37', NULL),
(39, 'say-say', 'demonstrationdemonstrationdemonstrationdemonstrationdemonstrationdem', 56, NULL, 0, NULL, 0, '2023-09-05 07:15:27', '2023-09-05 07:24:56', NULL),
(40, 'heart treatment', '14^dalfon^1-1-1^2<br>xx^paracap^1-1-1^2<br>', 56, NULL, 0, 1, 0, '2023-09-08 07:33:11', '2023-09-08 07:33:11', NULL),
(41, 'say', 'demonstration', 59, NULL, 0, 0, 0, '2023-10-04 04:59:29', '2023-10-04 04:59:29', NULL),
(42, 'ffever', 'Dolorum posuere nobis diam egestas dolorum ornare excepturi cupidatat eu dolores mollis, molestie ratione aenean, aliquet, aliqua faucibus similique vero sodales, feugiat pede suscipit voluptatem conubia impedit nulla incidunt vero! Dolore rhoncus magnam.\r\n\r\nIn luctus velit proident totam ornare? Voluptatem taciti urna mi ex nullam tristique volutpat, praesentium, tristique, possimus incididunt, quasi diam aptent pulvinar anim nascetur. Assumenda elit aptent quod! Cillum, magnam, wisi consequat, quisque.', 56, NULL, 0, 0, 0, '2023-10-14 05:54:17', '2023-10-14 05:54:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `rating`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'aryalkrishna642@gmail.com', 5, 26, 'demo\r\ndemo\r\ndemo\r\ndemo', '2023-07-06 07:24:51', '2023-07-06 07:24:51'),
(2, 'aryalkrishna642@gmail.com', 4, 26, 'Hello', '2023-08-08 16:44:48', '2023-08-08 16:44:48'),
(3, 'aryalkrishna642@gmail.com', 5, 26, NULL, '2023-08-12 15:42:21', '2023-08-12 15:42:21'),
(4, 'treasako215@gmail.com', 4, 52, 'Buggy', '2023-08-15 17:18:37', '2023-08-15 17:18:37'),
(5, 'admin@gmail.com', 4, 53, NULL, '2023-08-27 05:25:44', '2023-08-27 05:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `investigation`
--

CREATE TABLE `investigation` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investigation`
--

INSERT INTO `investigation` (`id`, `name`, `price`, `clinic_id`, `created_at`, `updated_at`, `code`) VALUES
(1, 'demo^', '5000^', 11, '2023-05-14 04:06:50', '2023-07-04 13:56:27', 'diabetes'),
(2, 'online^', '5000^', 11, '2023-06-06 04:16:07', '2023-06-06 04:16:07', 'demo'),
(4, 'stectch^', '4000^', 17, '2023-07-20 15:50:04', '2023-07-20 15:50:04', 'demo aung'),
(5, 'procedure-one^procedure-two^', '4000^4000^', 17, '2023-07-20 15:50:58', '2023-07-28 05:14:20', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_02_15_135132_create_master_table', 1),
(4, '2022_02_15_140647_create_package_table', 1),
(5, '2022_02_15_140708_create_clinic_table', 1),
(6, '2022_02_15_140719_create_role_table', 1),
(7, '2022_02_15_140720_create_user_table', 1),
(8, '2022_02_15_140729_create_dictionary_table', 1),
(9, '2022_03_07_210354_create_patients_table', 1),
(10, '2022_03_23_221933_create_visits_table', 1),
(11, '2022_04_27_221224_create_pharmacies_table', 1),
(12, '2022_05_04_133021_create_pos_table', 1),
(13, '2022_05_07_232712_create_pos_items_table', 1),
(14, '2022_05_14_144946_create_feedback_table', 1),
(16, '2022_06_20_225504_create_user_clinics_table', 2),
(17, '2022_06_20_234240_create_package_purchases_table', 2),
(18, '2022_07_30_213151_create_notifications_table', 3),
(19, '2022_10_03_194953_create_patient_doctors_table', 4),
(20, '2023_03_13_113422_add_prefix_values_to_name', 5),
(21, '2023_04_05_110202_create_contacts_table', 6),
(22, '2023_05_06_204331_update_visit_tables_with_new_datasets', 7),
(23, '2023_05_13_132947_create_procedure_list', 8),
(24, '2023_05_13_133135_create_investigation_list', 8),
(25, '2023_05_13_213157_update_code_field_to_procedure', 9),
(26, '2023_05_13_213207_update_code_field_to_investigation', 9),
(27, '2023_06_13_121200_add_is_superadmin_to_user_table', 10),
(28, '2023_06_15_195700_add_otp_verification_to_user', 11),
(29, '2023_06_18_143945_add_first_and_last_name_to_user', 12),
(30, '2023_06_24_115033_add_disease_to_patient_table', 13),
(31, '2023_06_24_142417_add_disease_to_visits_table', 13),
(32, '2023_08_15_095453_create_password_reset_tokens_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `is_sent` int DEFAULT NULL,
  `is_read` int DEFAULT '0',
  `action_on_sent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `sender_id`, `receiver_id`, `clinic_id`, `patient_id`, `is_sent`, `is_read`, `action_on_sent`, `created_at`, `updated_at`) VALUES
(19, 9, 8, 9, 2, 1, 1, 'treatment', '2023-03-04 04:25:56', '2023-03-14 04:09:29'),
(20, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-04 04:26:15', '2023-03-14 04:07:11'),
(21, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-04 14:22:44', '2023-03-14 04:07:11'),
(22, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-04 14:40:51', '2023-03-14 04:07:11'),
(23, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-04 14:52:06', '2023-03-14 04:07:11'),
(24, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-04 15:16:32', '2023-03-14 04:07:11'),
(25, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-05 13:24:38', '2023-03-14 04:07:11'),
(26, 8, 10, 9, 2, 1, 1, 'pos', '2023-03-08 08:21:45', '2023-03-14 04:09:29'),
(27, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-09 00:25:06', '2023-03-14 04:07:11'),
(28, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-09 00:30:31', '2023-03-14 04:07:11'),
(29, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-09 00:32:15', '2023-03-14 04:07:11'),
(30, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-09 00:57:40', '2023-03-14 04:07:11'),
(31, 9, 8, 9, 1, 1, 1, 'treatment', '2023-03-09 00:59:59', '2023-03-14 04:07:11'),
(32, 9, 8, 9, 2, 1, 1, 'treatment', '2023-03-09 01:00:39', '2023-03-14 04:09:29'),
(33, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-11 15:28:47', '2023-03-14 04:07:11'),
(34, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-13 02:57:24', '2023-03-14 04:07:11'),
(35, 16, 15, 11, 3, 1, 1, 'treatment', '2023-03-13 07:19:04', '2023-08-10 14:44:12'),
(36, 15, 17, 11, 3, 1, 1, 'pos', '2023-03-13 07:34:06', '2023-08-10 14:44:12'),
(37, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-14 03:51:36', '2023-03-14 04:07:11'),
(38, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-14 03:54:51', '2023-03-14 04:07:11'),
(39, 8, 10, 9, 1, 1, 1, 'pos', '2023-03-14 03:58:09', '2023-03-14 04:07:11'),
(40, 8, 10, 9, 2, 1, 1, 'pos', '2023-03-14 04:01:06', '2023-03-14 04:09:29'),
(41, 16, 15, 11, 4, 1, 1, 'treatment', '2023-03-27 15:10:17', '2023-08-20 05:09:10'),
(42, 16, 15, 11, 3, 1, 1, 'treatment', '2023-03-27 15:11:22', '2023-08-10 14:44:12'),
(43, 16, 15, 11, 4, 1, 1, 'treatment', '2023-03-30 08:50:00', '2023-08-20 05:09:10'),
(44, 16, 15, 11, 3, 1, 1, 'treatment', '2023-04-22 04:01:43', '2023-08-10 14:44:12'),
(45, 16, 15, 11, 4, 1, 1, 'treatment', '2023-04-22 04:02:12', '2023-08-20 05:09:10'),
(46, 15, 17, 11, 4, 1, 1, 'pos', '2023-04-22 04:05:17', '2023-08-20 05:09:10'),
(47, 15, 17, 11, 3, 1, 1, 'pos', '2023-04-23 13:46:25', '2023-08-10 14:44:12'),
(48, 16, 15, 11, 3, 1, 1, 'treatment', '2023-04-29 09:59:04', '2023-08-10 14:44:12'),
(49, 16, 15, 11, 4, 1, 1, 'treatment', '2023-04-29 09:59:50', '2023-08-20 05:09:10'),
(50, 16, 15, 11, 5, 1, 1, 'treatment', '2023-05-01 04:06:18', '2023-07-25 15:50:34'),
(51, 16, 15, 11, 4, 1, 1, 'treatment', '2023-05-01 04:07:29', '2023-08-20 05:09:10'),
(52, 15, 17, 11, 4, 1, 1, 'pos', '2023-05-06 14:11:47', '2023-08-20 05:09:10'),
(53, 15, 17, 11, 4, 1, 1, 'pos', '2023-05-06 14:12:20', '2023-08-20 05:09:10'),
(54, 15, 17, 11, 4, 1, 1, 'pos', '2023-05-07 06:41:32', '2023-08-20 05:09:10'),
(55, 15, 17, 11, 4, 1, 1, 'pos', '2023-05-07 06:50:45', '2023-08-20 05:09:10'),
(56, 15, 17, 11, 4, 1, 1, 'pos', '2023-05-07 06:53:46', '2023-08-20 05:09:10'),
(57, 15, 17, 11, 5, 1, 1, 'pos', '2023-05-12 16:19:57', '2023-07-25 15:50:34'),
(58, 15, 17, 11, 4, 1, 1, 'pos', '2023-06-06 04:12:16', '2023-08-20 05:09:10'),
(59, 14, 17, 11, 4, 1, 1, 'pos', '2023-06-06 14:36:58', '2023-08-20 05:09:10'),
(60, 14, 17, 11, 6, 1, 1, 'pos', '2023-06-06 14:38:46', '2023-06-06 14:51:06'),
(61, 14, 17, 11, 5, 1, 1, 'pos', '2023-06-09 12:23:00', '2023-07-25 15:50:34'),
(62, 15, 17, 11, 4, 1, 1, 'pos', '2023-06-10 07:24:55', '2023-08-20 05:09:10'),
(63, 15, 17, 11, 5, 1, 1, 'pos', '2023-06-10 07:25:28', '2023-07-25 15:50:34'),
(64, 14, 17, 11, 4, 1, 1, 'pos', '2023-06-10 07:56:46', '2023-08-20 05:09:10'),
(65, 14, 17, 11, 5, 1, 1, 'pos', '2023-06-10 07:56:58', '2023-07-25 15:50:34'),
(66, 14, 17, 11, 3, 1, 1, 'pos', '2023-06-10 07:57:18', '2023-08-10 14:44:12'),
(67, 14, 17, 11, 7, 1, 1, 'pos', '2023-06-10 07:59:28', '2023-08-20 05:08:02'),
(68, 14, 17, 11, 7, 1, 1, 'pos', '2023-06-10 08:03:53', '2023-08-20 05:08:02'),
(69, 14, 17, 11, 7, 1, 1, 'pos', '2023-06-10 08:26:21', '2023-08-20 05:08:02'),
(70, 14, 17, 11, 7, 1, 1, 'pos', '2023-06-10 08:31:43', '2023-08-20 05:08:02'),
(71, 14, 17, 11, 5, 1, 1, 'pos', '2023-07-08 07:23:04', '2023-07-25 15:50:34'),
(72, 14, 17, 11, 3, 1, 1, 'pos', '2023-07-08 11:52:28', '2023-08-10 14:44:12'),
(73, 14, 17, 11, 4, 1, 1, 'pos', '2023-07-08 12:37:36', '2023-08-20 05:09:10'),
(74, 14, 17, 11, 4, 1, 1, 'pos', '2023-07-10 01:54:44', '2023-08-20 05:09:10'),
(75, 14, 17, 11, 5, 1, 1, 'pos', '2023-07-13 14:06:57', '2023-07-25 15:50:34'),
(76, 16, 15, 11, 3, 1, 1, 'treatment', '2023-07-25 07:33:21', '2023-08-10 14:44:12'),
(77, 16, 15, 11, 4, 1, 1, 'treatment', '2023-07-25 16:04:57', '2023-08-20 05:09:10'),
(78, 14, 17, 11, 3, 1, 1, 'pos', '2023-08-10 14:04:41', '2023-08-10 14:44:12'),
(79, 14, 17, 11, 4, 1, 1, 'pos', '2023-08-11 05:44:32', '2023-08-20 05:09:10'),
(80, 26, 51, 17, 9, 1, 1, 'pos', '2023-08-15 04:11:14', '2023-08-19 13:06:04'),
(81, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-15 04:16:57', '2023-08-20 03:44:20'),
(82, 26, 51, 17, 10, 1, 1, 'pos', '2023-08-15 07:50:30', '2023-08-19 17:16:36'),
(83, 26, 51, 17, 10, 1, 1, 'pos', '2023-08-15 07:53:00', '2023-08-19 17:16:36'),
(84, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-15 14:22:02', '2023-08-20 03:44:20'),
(85, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-15 17:21:47', '2023-08-20 03:44:20'),
(86, 26, 51, 17, 10, 1, 1, 'pos', '2023-08-16 07:37:43', '2023-08-19 17:16:36'),
(87, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-17 13:50:56', '2023-08-20 03:44:20'),
(88, 26, 51, 17, 10, 1, 1, 'pos', '2023-08-17 13:52:03', '2023-08-19 17:16:36'),
(89, 26, 51, 17, 9, 1, 1, 'pos', '2023-08-19 06:00:05', '2023-08-19 13:06:04'),
(90, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-19 08:35:44', '2023-08-20 03:44:20'),
(91, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-19 08:37:00', '2023-08-20 03:44:20'),
(92, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-19 08:38:23', '2023-08-20 03:44:20'),
(93, 26, 51, 17, 10, 1, 1, 'pos', '2023-08-19 13:20:38', '2023-08-19 17:16:36'),
(94, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-19 13:23:16', '2023-08-20 03:44:20'),
(95, 26, 51, 17, 8, 1, 1, 'pos', '2023-08-19 14:14:23', '2023-08-20 03:44:20'),
(96, 26, 51, 17, 10, 1, 1, 'pos', '2023-08-19 17:04:48', '2023-08-19 17:16:36'),
(97, 58, 59, 26, 20, 1, 1, 'treatment', '2023-10-04 05:17:50', '2023-10-04 05:18:08'),
(98, 59, 60, 26, 20, 1, 1, 'pos', '2023-10-04 05:23:08', '2023-10-04 05:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `trialPeriod` int DEFAULT NULL,
  `isDiscount` tinyint NOT NULL DEFAULT '0',
  `discountPercentage` int DEFAULT NULL,
  `discountStartDate` datetime DEFAULT NULL,
  `discountEndDate` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `type`, `name`, `price`, `trialPeriod`, `isDiscount`, `discountPercentage`, `discountStartDate`, `discountEndDate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'single', 'Single Practice', '500', 14, 0, NULL, NULL, NULL, 1, NULL, '2023-09-05 15:43:57'),
(3, 'group', 'Group Practice', '600', 14, 0, NULL, NULL, NULL, 1, '2023-07-06 03:58:07', '2023-09-05 15:44:09'),
(4, 'ultimate', 'Ultimate Practice', '700', 21, 0, NULL, NULL, NULL, 1, '2023-07-19 05:07:28', '2023-09-05 15:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `package_purchase`
--

CREATE TABLE `package_purchase` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `price` int NOT NULL,
  `payment_method` int NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `purchase_value` enum('month','year') COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_purchase`
--

INSERT INTO `package_purchase` (`id`, `user_id`, `clinic_id`, `price`, `payment_method`, `status`, `purchase_value`, `expire_at`, `created_at`, `updated_at`) VALUES
(8, 1, 9, 24500, 1, 1, 'month', '2023-02-04', '2023-01-29 05:54:56', '2023-01-29 05:54:56'),
(9, 8, 10, 24500, 1, 1, 'month', '2023-04-09', '2023-03-09 13:48:40', '2023-03-09 13:48:40'),
(10, 14, 11, 24500, 1, 1, 'month', '2023-07-31', '2023-03-13 06:55:02', '2023-03-13 06:55:02'),
(11, 42, 12, 500, 1, 1, 'month', '2023-08-04', '2023-07-04 14:18:44', '2023-07-04 14:18:44'),
(12, 26, 13, 100000, 1, 1, 'month', '2023-08-20', '2023-07-20 15:25:42', '2023-07-20 15:25:42'),
(13, 26, 14, 100000, 1, 1, 'month', '2023-08-20', '2023-07-20 15:32:35', '2023-07-20 15:32:35'),
(14, 26, 15, 100000, 1, 1, 'month', '2023-08-20', '2023-07-20 15:33:25', '2023-07-20 15:33:25'),
(15, 26, 16, 100000, 1, 1, 'month', '2023-08-20', '2023-07-20 15:33:43', '2023-07-20 15:33:43'),
(16, 26, 17, 100000, 1, 1, 'month', '2023-08-20', '2023-07-20 15:33:52', '2023-07-20 15:33:52'),
(17, 47, 18, 100000, 1, 1, 'month', '2023-08-03', '2023-07-20 16:23:44', '2023-07-20 16:23:44'),
(18, 49, 19, 100000, 1, 1, 'month', '2023-08-06', '2023-07-23 14:43:48', '2023-07-23 14:43:48'),
(19, 50, 20, 100000, 1, 1, 'month', '2023-08-22', '2023-08-08 16:58:51', '2023-08-08 16:58:51'),
(20, 52, 21, 100000, 1, 1, 'month', '2023-08-29', '2023-08-15 17:06:28', '2023-08-15 17:06:28'),
(21, 52, 22, 100000, 1, 1, 'month', '2023-08-29', '2023-08-15 17:06:41', '2023-08-15 17:06:41'),
(22, 53, 23, 100000, 1, 1, 'month', '2023-09-02', '2023-08-19 17:21:53', '2023-08-19 17:21:53'),
(23, 54, 24, 300000, 1, 1, 'month', '2023-09-10', '2023-08-20 05:31:54', '2023-08-20 05:31:54'),
(24, 55, 25, 700, 1, 1, 'month', '2023-09-22', '2023-08-22 09:13:48', '2023-08-22 09:41:31'),
(25, 56, 26, 700, 1, 1, 'month', '2023-09-20', '2023-08-30 15:10:46', '2023-08-30 15:10:46'),
(26, 62, 27, 500, 1, 1, 'month', '2023-10-18', '2023-10-04 05:48:50', '2023-10-04 05:48:50'),
(27, 56, 28, 500, 1, 1, 'month', '2023-10-25', '2023-10-11 10:25:37', '2023-10-11 10:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('aryalkrishna642@gmail.com', 'I3XTMeufmCQApGHneHpNQ1mKLj4AqJUPkzD8bZEtpgoouNCXPUNmztf8ALokTE75', '2023-08-15 17:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint NOT NULL,
  `summary` longtext COLLATE utf8mb4_unicode_ci,
  `drug_allergy` longtext COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `p_status` int NOT NULL,
  `Ref` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `code`, `user_id`, `clinic_code`, `name`, `father_name`, `age`, `phoneNumber`, `address`, `gender`, `summary`, `drug_allergy`, `status`, `p_status`, `Ref`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'demo:p:681180', 9, '9', 'patient-one', 'patient-father', 50, '09400372581', 'demonstration', 1, 'demonstration', 'demonstration', 1, 4, 'patient-one_50_patient-father', '2023-02-22 13:16:29', '2023-03-14 04:07:23', NULL),
(2, 'demo:p:430418', 9, '9', 'Patient-2', 'Patient-2 father name', 40, '0958585858', 'Yangon', 0, 'Nothing but something', 'Nothing', 1, 3, 'Patient-2_40_Patient-2_father_name', '2023-03-01 08:42:55', '2023-03-14 04:01:06', NULL),
(3, 'kyawclinic:p:337495', 16, '11', 'Kyaw Aung', 'Kyaw Hla', 40, '09400372581', 'Demonstration', 1, 'Demo', 'Demo', 1, 3, 'Kyaw_Aung_40_Kyaw_Hla', '2023-03-13 07:18:05', '2023-08-10 14:46:15', NULL),
(4, 'kyawclinic:p:951338', 16, '11', 'Demo patient edit', 'father\'s name', 50, '09400393939', 'Mogok', 1, 'Demo', 'demonstration', 1, 3, 'Demo_patient_edit_50_father\'s_name', '2023-03-27 14:51:08', '2023-08-11 05:44:32', NULL),
(5, 'kyawclinic:p:816980', 16, '11', 'Zaw Zaw', 'U hla', 20, '938488474', 'mogok', 1, 'online', 'Online', 1, 3, 'Zaw_Zaw_20_U_hla', '2023-05-01 04:05:21', '2023-07-13 14:06:57', NULL),
(6, 'kyawclinic:p:334758', 14, '11', 'sdfdfs', 'U hla', 40, NULL, 'Taungyii', 1, 'sdfsdf', 'none', 0, 3, 'sdfdfs_40_U_hla', '2023-05-14 06:36:19', '2023-06-06 15:16:20', '2023-06-06 15:16:20'),
(7, 'kyawclinic:p:784106', 15, '11', 'kyaw aung', 'kyaw kyaw father', 49, '09400372581', 'mogok', 1, 'demo', 'demo', 1, 4, 'kyaw_aung_49_kyaw_kyaw_father', '2023-06-06 02:22:32', '2023-08-10 14:51:04', NULL),
(12, 'AungAung:p:665207', 50, '20', 'kyaw', 'Aung gyi', 49, NULL, 'Mogok', 1, NULL, NULL, 1, 3, 'kyaw_49_Aung_gyiAungAung:p:665207', '2023-08-08 17:00:38', '2023-08-08 17:19:53', NULL),
(13, 'Treasa:p:894720', 52, '21', 'Kyaw Kyaw', 'U hla', 40, '0948484884', 'Yangon', 1, NULL, NULL, 1, 4, 'Kyaw_Kyaw_40_U_hlaTreasa:p:894720', '2023-08-15 17:08:06', '2023-08-15 17:16:24', NULL),
(14, 'DawKyi:p:994057', 53, '23', 'aung aung', 'demo', 50, '095050', 'mogok', 1, NULL, NULL, 1, 3, 'aung_aung_50_demoDawKyi:p:994057', '2023-08-19 17:24:17', '2023-08-19 17:25:11', NULL),
(15, 'Thamadi:p:767525', 55, '25', 'online', 'demo', 40, '09400', 'demo', 1, NULL, NULL, 1, 3, 'online_40_demoThamadi:p:767525', '2023-08-22 09:47:28', '2023-08-22 09:48:06', NULL),
(16, 'Thamadi:p:887707', 55, '25', 'aung gyi', 'Demo name', 50, '09500473838', 'Yangon', 1, 'demonstration', 'demo', 1, 3, 'aung_gyi_50_Demo_nameThamadi:p:887707', '2023-08-24 13:28:00', '2023-08-30 09:00:20', NULL),
(17, 'AungMingalar:p:468792', 56, '26', 'Kyaw Kyaw', 'U ba', 40, NULL, 'Yangon', 1, 'The following MSRs are grouped to highlight specific conditions or circumstances. ', 'demonstration', 0, 1, 'Kyaw_Kyaw_40_U_baAungMingalar:p:468792', '2023-09-04 04:13:36', '2023-09-05 07:03:32', '2023-09-05 07:03:32'),
(18, 'AungMingalar:p:901977', 56, '26', 'Kyaw Kyaw', 'U ba', 40, NULL, 'Yangon', 1, 'The following MSRs are grouped to highlight specific conditions or circumstances.', 'demonstration', 1, 4, 'Kyaw_Kyaw_40_U_ba', '2023-09-04 05:40:50', '2023-09-20 05:56:33', NULL),
(19, 'AungMingalar:p:575853', 56, '26', 'aung naing thu', 'U toemu', 24, '09400372581', 'Mogok', 1, NULL, NULL, 1, 1, 'aung_naing_thu_24_U_toemu', '2023-09-08 07:08:29', '2023-09-21 06:02:58', NULL),
(20, 'AungMingalar:p:882628', 58, '26', 'zAW NAING', NULL, 44, NULL, 'Mogok', 1, NULL, NULL, 1, 3, 'zAW_NAING_44_', '2023-09-21 05:55:15', '2023-10-04 05:23:08', NULL),
(21, 'Demonstration:p:591559', 56, '28', 'Kyaw kyaw', 'U hla', 49, NULL, 'Mogok', 1, NULL, NULL, 1, 1, 'Kyaw_kyaw_49_U_hlaDemonstration:p:591559', '2023-10-14 05:55:12', '2023-10-14 05:55:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis`
--

CREATE TABLE `patient_diagnosis` (
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic` int NOT NULL,
  `user` int NOT NULL,
  `patient` int NOT NULL,
  `visit` int NOT NULL,
  `diagnosis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_diagnosis`
--

INSERT INTO `patient_diagnosis` (`uuid`, `clinic`, `user`, `patient`, `visit`, `diagnosis`, `created_at`, `updated_at`) VALUES
('9e5bf301-c2a4-41e6-a77d-b1f84a778272', 17, 26, 10, 80, 'diagnosis', '2023-08-06 08:43:12', '2023-08-06 08:43:12'),
('1dcaa468-dffb-4cb1-b46a-d5a655bdfac0', 17, 26, 10, 82, 'diagnosis-one', '2023-08-06 12:57:09', '2023-08-06 12:57:09'),
('303ca8c8-4a59-4e12-9570-d5164449df32', 17, 26, 10, 83, 'operation', '2023-08-07 07:47:40', '2023-08-07 07:47:40'),
('24ab2a3f-ed01-4656-834d-3ff7f3b5e20a', 17, 26, 10, 84, 'diagnosis-one', '2023-08-07 07:57:56', '2023-08-07 07:57:56'),
('26b8c970-920b-43bf-9e61-c07eb012137c', 20, 50, 12, 86, 'penacanil', '2023-08-08 17:05:06', '2023-08-08 17:05:06'),
('a6a57039-f2ed-4843-991e-03e38f0656a4', 20, 50, 12, 89, 'penacanil', '2023-08-08 17:19:53', '2023-08-08 17:19:53'),
('64113582-3002-4543-a899-b20e0975fdf2', 17, 26, 8, 90, 'Demo', '2023-08-10 13:52:44', '2023-08-10 13:52:44'),
('fc717d9d-9b9a-4d2c-aff3-7181c238cf4b', 11, 14, 3, 93, 'demonstration', '2023-08-10 14:04:41', '2023-08-10 14:04:41'),
('aa86a761-7ccc-4293-a565-b21727e7afc5', 11, 14, 4, 95, 'demonstration', '2023-08-11 05:44:32', '2023-08-11 05:44:32'),
('5475c51d-6297-43a6-a77b-20ce47cbbe48', 17, 26, 8, 96, 'Demo', '2023-08-11 06:24:22', '2023-08-11 06:24:22'),
('2da21299-77e3-48aa-b10c-2470e501eaaa', 17, 26, 8, 97, 'Demo', '2023-08-11 06:45:25', '2023-08-11 06:45:25'),
('0cde2ed0-f5c1-4a69-bb07-3bec8a791723', 17, 26, 8, 98, 'Demo', '2023-08-12 07:25:24', '2023-08-12 07:25:24'),
('9b9789b1-87d8-43ed-9114-c01c7783ba0f', 17, 26, 8, 99, 'Demo', '2023-08-12 07:58:40', '2023-08-12 07:58:40'),
('59222eb8-cbae-4476-a0b8-c584dbd73a19', 17, 26, 8, 100, 'diagnosis-one', '2023-08-12 14:38:44', '2023-08-12 14:38:44'),
('dd6afdda-27e7-40ee-9a74-e17e174a0f48', 17, 26, 8, 101, 'Demo', '2023-08-12 16:41:43', '2023-08-12 16:41:43'),
('cb148705-0cb8-482a-92e2-a8c87d41d1e7', 17, 26, 8, 102, 'Demo', '2023-08-12 16:42:12', '2023-08-12 16:42:12'),
('fa13a75a-e377-4f1f-80f6-6d1172d7fd3d', 17, 26, 8, 103, 'Surgery', '2023-08-12 16:48:54', '2023-08-12 16:48:54'),
('3024bcbd-91e6-4b1a-b513-3fc4fe31713e', 17, 26, 9, 104, 'diagnosis-one', '2023-08-13 14:18:32', '2023-08-13 14:18:32'),
('ba6c9b30-8270-435a-9321-40b11e6f81fa', 17, 26, 9, 105, 'diagnosis-one', '2023-08-14 06:09:34', '2023-08-14 06:09:34'),
('5b24dc14-8951-4e47-88c9-219cd7112486', 17, 26, 9, 106, 'diagnosis-one', '2023-08-15 04:01:02', '2023-08-15 04:01:02'),
('701319e4-4f8a-42e4-8667-9438b91d4cdb', 17, 26, 9, 107, 'diagnosis-one', '2023-08-15 04:11:14', '2023-08-15 04:11:14'),
('98978a91-ecf9-4b23-9d5d-782c7011304d', 17, 26, 8, 108, 'Surgery', '2023-08-15 04:16:57', '2023-08-15 04:16:57'),
('cdfd50b7-1582-40fc-914a-3cd6ff811f7e', 17, 26, 10, 109, 'diagnosis-one', '2023-08-15 07:50:30', '2023-08-15 07:50:30'),
('c5f7f4c0-793c-401a-8d20-124009ba32e4', 17, 26, 10, 110, 'diagnosis-one', '2023-08-15 07:53:00', '2023-08-15 07:53:00'),
('b7fd5d05-04a9-4e45-a64e-9bc3941da049', 17, 26, 8, 111, 'Surgery', '2023-08-15 14:22:02', '2023-08-15 14:22:02'),
('cb8a1d63-4575-4321-8ad9-2fa2d7e548d0', 21, 52, 13, 112, 'Demonstration', '2023-08-15 17:14:57', '2023-08-15 17:14:57'),
('5eb70138-0f67-4477-ad26-8ddc520760b2', 17, 26, 8, 114, 'Surgery', '2023-08-15 17:21:47', '2023-08-15 17:21:47'),
('b8318dd9-4bc4-40e1-8bbf-c0af68742f84', 17, 26, 10, 115, 'diagnosis-one', '2023-08-16 07:37:43', '2023-08-16 07:37:43'),
('c6537f8c-e5ea-4d5c-ab4e-59f6a385c41b', 17, 26, 8, 116, 'Surgery', '2023-08-17 13:50:56', '2023-08-17 13:50:56'),
('1995f97b-9995-4b5f-96bf-ab56151ab172', 17, 26, 10, 117, 'diagnosis-one', '2023-08-17 13:52:03', '2023-08-17 13:52:03'),
('6e610e6e-d463-4b08-a143-a7009efd90dd', 17, 26, 9, 118, 'diagnosis-one', '2023-08-19 06:00:05', '2023-08-19 06:00:05'),
('8b65b49c-db58-4c96-82ea-98684faa5460', 17, 26, 8, 119, 'Surgery', '2023-08-19 08:35:44', '2023-08-19 08:35:44'),
('0a68a685-8a42-4780-b11c-c9d66b338684', 17, 26, 8, 120, 'Surgery', '2023-08-19 08:37:00', '2023-08-19 08:37:00'),
('fae319eb-c36f-4ce4-99c1-79b1fc920c38', 17, 26, 8, 121, 'Surgery', '2023-08-19 08:38:23', '2023-08-19 08:38:23'),
('b4c25e9e-0add-4c34-9106-690bb9f01634', 17, 26, 10, 122, 'diagnosis-one', '2023-08-19 13:20:38', '2023-08-19 13:20:38'),
('7c76ce03-8cf4-4080-8c09-593f16be4e94', 17, 26, 8, 123, 'Surgery', '2023-08-19 13:23:16', '2023-08-19 13:23:16'),
('0696578a-e124-4e8b-9cc1-c8b5c002ea2c', 17, 26, 8, 124, 'Surgery', '2023-08-19 14:14:23', '2023-08-19 14:14:23'),
('169245e1-77e2-474f-871d-520b86f6c02c', 17, 26, 10, 127, 'diagnosis-one', '2023-08-19 17:04:48', '2023-08-19 17:04:48'),
('a551743a-98da-46e1-96c5-f7b04cd7703f', 23, 53, 14, 128, 'diagnositic-one', '2023-08-19 17:25:11', '2023-08-19 17:25:11'),
('a01a80c3-34b6-439d-83cf-1d5cec53592a', 25, 55, 15, 129, 'demonstration', '2023-08-22 09:48:07', '2023-08-22 09:48:07'),
('add05620-c394-4392-a94b-35618029e0a1', 26, 56, 18, 133, 'demonstration', '2023-09-05 07:04:18', '2023-09-05 07:04:18'),
('98a8542a-9cbb-4b7c-a717-5b32095d099b', 26, 56, 18, 135, 'demonstration', '2023-09-08 07:35:11', '2023-09-08 07:35:11'),
('2159493b-58b8-45e1-869e-ed759c940637', 26, 59, 20, 137, 'demonstration', '2023-10-04 05:23:08', '2023-10-04 05:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `patient_disease`
--

CREATE TABLE `patient_disease` (
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic` int NOT NULL,
  `user` int NOT NULL,
  `patient` int NOT NULL,
  `visit_id` int NOT NULL,
  `disease` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_disease`
--

INSERT INTO `patient_disease` (`uuid`, `clinic`, `user`, `patient`, `visit_id`, `disease`, `created_at`, `updated_at`) VALUES
('f1e47b51-3c5b-4942-80ca-c8aebf5fcbef', 17, 26, 10, 80, 'disease', '2023-08-06 08:43:12', '2023-08-06 08:43:12'),
('6df884f5-0fea-444f-b70b-4eacbe55b65e', 17, 26, 10, 84, 'disease sample', '2023-08-07 07:57:56', '2023-08-07 07:57:56'),
('91d2c5fb-a132-4d56-a175-9390da14dc0a', 20, 50, 12, 86, 'diabetes', '2023-08-08 17:05:06', '2023-08-08 17:05:06'),
('a1353738-2d71-4fa9-99e7-e5d9d5ac999d', 20, 50, 12, 89, 'diabetes', '2023-08-08 17:19:53', '2023-08-08 17:19:53'),
('b1c21a66-e631-4f58-9858-8da773d14b87', 11, 14, 3, 93, 'demonstration', '2023-08-10 14:04:41', '2023-08-10 14:04:41'),
('be9c69df-b546-43be-9a14-bb021ef7ee3b', 11, 14, 4, 95, 'demonstration', '2023-08-11 05:44:32', '2023-08-11 05:44:32'),
('68785e51-b28e-47a8-84d7-6750baa2562f', 17, 26, 8, 96, 'disease', '2023-08-11 06:24:22', '2023-08-11 06:24:22'),
('4b1de9e1-e5a4-4ede-994d-3d533690421e', 17, 26, 8, 97, 'disease', '2023-08-11 06:45:25', '2023-08-11 06:45:25'),
('32b1f6eb-a799-4817-8786-f0b3d39a5b15', 17, 26, 8, 98, 'disease', '2023-08-12 07:25:24', '2023-08-12 07:25:24'),
('5cc598af-6ade-473e-bf1f-86562bf5c979', 17, 26, 8, 99, 'disease', '2023-08-12 07:58:40', '2023-08-12 07:58:40'),
('efab2f39-8de3-4700-bbab-ae27bdc355a5', 17, 26, 8, 102, 'disease', '2023-08-12 16:42:12', '2023-08-12 16:42:12'),
('806c0ed1-6e1a-4d6b-a7d2-e60bdd49cb4d', 17, 26, 8, 103, 'Somethhing call ed disease', '2023-08-12 16:48:54', '2023-08-12 16:48:54'),
('99cbfb73-098f-4519-86b8-09577082bcbc', 17, 26, 9, 104, 'Somethhing', '2023-08-13 14:18:32', '2023-08-13 14:18:32'),
('632549d1-57d2-43d8-b384-8d8985f7af1c', 17, 26, 9, 105, 'Somethhing', '2023-08-14 06:09:34', '2023-08-14 06:09:34'),
('b6743a8b-3909-4331-8a60-b76322ae569e', 17, 26, 9, 106, 'Somethhing', '2023-08-15 04:01:02', '2023-08-15 04:01:02'),
('07e1c6c1-f7ee-4f37-a86c-65601212d22f', 17, 26, 9, 107, 'Somethhing', '2023-08-15 04:11:14', '2023-08-15 04:11:14'),
('783ff590-4871-4d42-8625-810753c20352', 17, 26, 8, 108, 'Somethhing call ed disease', '2023-08-15 04:16:57', '2023-08-15 04:16:57'),
('59e8e78c-6207-448f-886d-6825ab10143e', 17, 26, 10, 109, 'disease sample', '2023-08-15 07:50:30', '2023-08-15 07:50:30'),
('066ec74a-ee59-455d-a293-d7cfff503a22', 17, 26, 10, 110, 'disease sample', '2023-08-15 07:53:00', '2023-08-15 07:53:00'),
('edcabe19-3f99-4ccc-862c-77ba061d62ed', 17, 26, 8, 111, 'Somethhing call ed disease', '2023-08-15 14:22:02', '2023-08-15 14:22:02'),
('0497f300-fc98-4dcb-a4ec-48b3e8c2c394', 21, 52, 13, 112, 'Diabetes', '2023-08-15 17:14:57', '2023-08-15 17:14:57'),
('3389c6c1-5dad-4a28-bf5d-f2feae26bd83', 17, 26, 8, 114, 'Somethhing call ed disease', '2023-08-15 17:21:47', '2023-08-15 17:21:47'),
('6c20dd17-c19c-4075-a12f-65e958b83476', 17, 26, 10, 115, 'disease sample', '2023-08-16 07:37:43', '2023-08-16 07:37:43'),
('f4c11075-be51-487c-b38e-ccdbfd21b5de', 17, 26, 8, 116, 'Somethhing call ed disease', '2023-08-17 13:50:56', '2023-08-17 13:50:56'),
('9e08d769-fd29-4608-9e6e-439574a5180c', 17, 26, 10, 117, 'disease sample', '2023-08-17 13:52:03', '2023-08-17 13:52:03'),
('1c5cdbd0-7057-4c22-bbed-1292d1f3a842', 17, 26, 9, 118, 'Somethhing', '2023-08-19 06:00:05', '2023-08-19 06:00:05'),
('30cc17ea-b994-4da5-acd4-5a2733f048dc', 17, 26, 8, 119, 'Somethhing call ed disease', '2023-08-19 08:35:44', '2023-08-19 08:35:44'),
('936453b7-84f3-4d31-ab78-e6f53c39d9cb', 17, 26, 8, 120, 'Somethhing call ed disease', '2023-08-19 08:37:00', '2023-08-19 08:37:00'),
('ceb9f657-f899-4298-a9fc-359fcd901508', 17, 26, 8, 121, 'Somethhing call ed disease', '2023-08-19 08:38:23', '2023-08-19 08:38:23'),
('7355cd7a-3213-4aba-b28c-dc7a85fe3f71', 17, 26, 10, 122, 'disease sample', '2023-08-19 13:20:38', '2023-08-19 13:20:38'),
('5df3d3d3-4dfe-4952-b340-4a07f5c478b0', 17, 26, 8, 123, 'Somethhing call ed disease', '2023-08-19 13:23:16', '2023-08-19 13:23:16'),
('445ea1e8-9b75-43d5-a8de-a01e73d50457', 17, 26, 8, 124, 'Somethhing call ed disease', '2023-08-19 14:14:23', '2023-08-19 14:14:23'),
('41ddd819-0249-409b-bad2-94cb5788fb54', 17, 26, 10, 127, 'disease sample', '2023-08-19 17:04:48', '2023-08-19 17:04:48'),
('010e8901-cd05-4b51-b2ca-79753dd0328e', 23, 53, 14, 128, 'diabetes', '2023-08-19 17:25:11', '2023-08-19 17:25:11'),
('cdee56c9-321b-42b8-885f-6558b1d38ad8', 25, 55, 15, 129, 'disease', '2023-08-22 09:48:07', '2023-08-22 09:48:07'),
('039da32c-0a4e-400f-9cc0-1980520a4dfa', 26, 56, 18, 133, 'diabetes', '2023-09-05 07:04:18', '2023-09-05 07:04:18'),
('a6c03fd5-8932-4c7e-aabf-10d1e70dfdfa', 26, 56, 18, 135, 'diabetes', '2023-09-08 07:35:11', '2023-09-08 07:35:11'),
('adfedb6c-b17b-452e-a2dd-0dd964aaaffe', 26, 59, 20, 137, 'diabetes', '2023-10-04 05:23:08', '2023-10-04 05:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `patient_doctor`
--

CREATE TABLE `patient_doctor` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_id` int DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_doctor`
--

INSERT INTO `patient_doctor` (`id`, `patient_id`, `user_id`, `clinic_id`, `status`, `created_at`, `updated_at`, `end_time`) VALUES
(1, 1, 8, NULL, 0, '2023-02-23 03:05:28', '2023-02-23 03:05:28', NULL),
(2, 2, 8, NULL, 0, '2023-03-01 08:43:52', '2023-03-01 08:43:52', NULL),
(3, 3, 15, NULL, 0, '2023-03-13 07:19:01', '2023-03-13 07:19:01', NULL),
(4, 4, 15, NULL, 0, '2023-03-27 15:10:13', '2023-03-27 15:10:13', NULL),
(5, 5, 15, NULL, 0, '2023-05-01 04:06:14', '2023-05-01 04:06:14', NULL),
(6, 20, 59, NULL, 0, '2023-10-04 05:17:43', '2023-10-04 05:17:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_procedure`
--

CREATE TABLE `patient_procedure` (
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_id` int DEFAULT NULL,
  `patient_id` int NOT NULL,
  `assigned_tasks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_pos` tinyint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_procedure`
--

INSERT INTO `patient_procedure` (`uuid`, `visit_id`, `patient_id`, `assigned_tasks`, `price`, `is_pos`, `created_at`, `updated_at`) VALUES
('9252964e-9c51-4ad5-baa7-a47934c69b38', 110, 10, 'procedure-one^1^4000<br>procedure-two^1^4000<br>', NULL, 1, '2023-08-15 07:52:31', '2023-08-15 07:53:00'),
('9799764b-f05b-407d-8947-7a57d1f1b9d8', 111, 8, 'demo^2^8000<br>procedure-one^1^4000<br>procedure-two^1^4000<br>stectch^1^4000<br>', NULL, 1, '2023-08-15 14:20:13', '2023-08-15 14:22:02'),
('cb05d811-85c4-447f-b217-db95b68ce139', 112, 13, 'demo^3^15000<br>', NULL, 1, '2023-08-15 17:14:22', '2023-08-15 17:14:57'),
('522d9032-82e6-40ba-9de5-cad527925f57', 114, 8, 'demo^3^12000<br>', NULL, 1, '2023-08-15 17:21:39', '2023-08-15 17:21:47'),
('46b90789-524a-4160-8b15-7985ddb1d232', 115, 10, 'procedure-one^1^4000<br>procedure-two^1^4000<br>', NULL, 1, '2023-08-16 07:37:31', '2023-08-16 07:37:43'),
('08535dab-0c7b-435c-ba65-9e3392a6a0b9', NULL, 10, 'stectch^1^4000<br>demo^3^12000<br>', NULL, 0, '2023-08-16 08:03:28', '2023-08-16 08:03:28'),
('f4615a84-c15b-4aa3-ba5c-5953422d8842', 116, 8, 'stectch^1^4000<br>', NULL, 1, '2023-08-17 13:50:47', '2023-08-17 13:50:56'),
('1452cf6a-80f5-4465-921f-e2619ad44d12', 118, 9, 'stectch^1^4000<br>', NULL, 1, '2023-08-19 05:59:55', '2023-08-19 06:00:05'),
('21d5b34c-e343-4817-838b-891bfeed6b43', 120, 8, 'demo^1^4000<br>', NULL, 1, '2023-08-19 08:36:57', '2023-08-19 08:37:00'),
('536de611-1135-48f6-8eb6-7549304aa52b', 121, 8, 'stectch^1^4000<br>', NULL, 1, '2023-08-19 08:38:09', '2023-08-19 08:38:23'),
('135e9f81-c170-49bf-ae33-a277089a5b8d', 122, 10, 'stectch^1^4000<br>procedure-one^1^4000<br>procedure-two^1^4000<br>demo^1^4000<br>', NULL, 1, '2023-08-19 13:20:19', '2023-08-19 13:20:38'),
('86e89cbf-1ae9-4934-a37c-5ca3d3da204f', 123, 8, 'stectch^1^4000<br>procedure-one^1^4000<br>procedure-two^1^4000<br>', NULL, 1, '2023-08-19 13:23:00', '2023-08-19 13:23:16'),
('a656f0e8-3d10-466e-8b07-b4a7a410ec35', 127, 10, 'procedure-one^1^4000<br>procedure-two^1^4000<br>', NULL, 1, '2023-08-19 17:04:20', '2023-08-19 17:04:48'),
('5504fd35-f841-42dd-9793-8a960d591689', NULL, 7, 'online^3^15000<br>', NULL, 0, '2023-08-20 05:08:24', '2023-08-20 05:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` date DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `act_price` double(8,2) NOT NULL,
  `margin` double(8,2) NOT NULL DEFAULT '0.00',
  `sell_price` double(8,2) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `storage_place` text COLLATE utf8mb4_unicode_ci,
  `Ref` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `code`, `user_id`, `clinic_id`, `name`, `expire_date`, `quantity`, `act_price`, `margin`, `sell_price`, `unit`, `description`, `vendor`, `vendor_phoneNumber`, `status`, `storage_place`, `Ref`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'para', 8, 9, 'paracetemol', '2023-03-23', 14, 4500.00, 500.00, 5000.00, 'tablet', 'demonstration', 'aung aung', '09484848484', 1, 'demo', 'paracetemol_para_18', '2023-03-01 14:00:00', '2023-03-14 04:07:23', '2023-03-01 14:00:00'),
(2, 'bio', 9, 9, 'biogessic', '2023-03-31', 8, 500.00, 50.00, 550.00, 'tablet', 'demo', 'aung aung', '09848484848', 1, 'godaung', 'bio', '2023-03-01 14:19:48', '2023-03-14 04:07:23', '2023-03-01 14:19:48'),
(3, 'bio', 17, 11, 'Biogessic', '2023-05-31', 7, 5000.00, 20.00, 6000.00, '5', 'Demonstration', 'Vendor-one', NULL, 0, 'Go daung', 'Biogessic_bio_7', '2023-03-13 07:33:36', '2023-04-23 14:12:29', '2023-04-23 14:12:29'),
(4, 'pharmacy-code', 14, 11, 'biogessic', '2024-11-20', 3, 500.00, 20.00, 600.00, 'bottle', 'demonstration', 'kyaw aung', NULL, 1, 'go daung', 'biogessic_pharmacy-code_15', '2023-04-26 03:51:40', '2023-08-10 15:04:44', NULL),
(5, 'med1', 14, 11, 'medicine', '2024-03-29', 40, 500.00, 20.00, 600.00, 'demo', 'demo', 'aung aung', NULL, 1, 'go daung', 'medicine_med1_40', '2023-06-10 04:34:11', '2023-07-08 11:57:50', NULL),
(6, NULL, 14, 11, 'medicine2', '2023-07-26', 150, 500.00, 50.00, 750.00, 'tube', 'demo', 'aung kyaw', NULL, 1, 'go daung', 'medicine2__150', '2023-06-10 04:36:18', '2023-08-10 14:52:22', NULL),
(7, 'para', 14, 11, 'Paracetemol', '2023-08-04', 20, 5000.00, 20.00, 6000.00, 'tube', 'Demonstration', 'kyaw kyaw', NULL, 1, 'Godaung', 'Paracetemol_para_20', '2023-07-10 15:11:03', '2023-07-10 15:11:03', NULL),
(9, NULL, 14, 11, 'Medicine Liquid', '2023-09-16', 40, 500.00, 20.00, 600.00, 'Syrup', NULL, 'Kyaw aung', NULL, 1, NULL, 'Medicine_Liquid__40', '2023-08-02 03:46:47', '2023-08-02 06:13:42', NULL),
(10, NULL, 50, 20, 'Biogessic', '2023-10-13', 46, 500.00, 20.00, 600.00, 'Cream', NULL, 'aung kyaw sine', NULL, 1, NULL, 'Biogessic__50', '2023-08-08 17:08:34', '2023-08-08 17:09:23', NULL),
(12, NULL, 52, 21, 'Paracetemol', '2023-08-31', 3995, 600.00, 16.00, 700.00, 'Tablet', NULL, NULL, NULL, 1, NULL, 'Paracetemol__4000', '2023-08-15 17:10:02', '2023-08-15 17:16:24', NULL),
(13, NULL, 55, 25, 'Biogessic 500 mg', '2023-09-25', 40, 500.00, 20.00, 600.00, 'Tablet', 'demo', 'AUng Aung', NULL, 1, 'Go daung', 'Biogessic_500_mg__40', '2023-08-24 13:29:49', '2023-08-29 10:51:34', NULL),
(14, NULL, 56, 26, '600', '2023-09-27', 46, 500.00, 80.00, 900.00, 'Tablet', 'demo', 'demo', NULL, 1, NULL, '600__46', '2023-09-04 06:28:51', '2023-09-24 08:39:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_id` bigint NOT NULL,
  `patient_id` bigint DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double(8,2) NOT NULL,
  `total_discount` double(8,2) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `payment_status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `invoice_code`, `user_id`, `clinic_id`, `patient_id`, `customer_name`, `total_price`, `total_discount`, `description`, `status`, `payment_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'invo:932549', 10, 9, 1, 'patient-one', 150000.00, NULL, NULL, 1, 1, '2023-03-01 15:11:02', '2023-03-01 15:11:02', NULL),
(2, 'invo:640968', 10, 9, 1, 'patient-one', 78300.00, NULL, NULL, 1, 1, '2023-03-08 07:48:17', '2023-03-08 07:48:17', NULL),
(3, 'invo:268978', 10, 9, NULL, NULL, 4400.00, NULL, NULL, 1, 1, '2023-03-08 13:40:03', '2023-03-08 13:40:03', NULL),
(4, 'invo:916335', 10, 9, 2, 'Patient-2', 25000.00, NULL, NULL, 1, 1, '2023-03-08 13:44:21', '2023-03-08 13:44:21', NULL),
(5, 'invo:316455', 10, 9, 1, 'patient-one', 15000.00, NULL, NULL, 1, 3, '2023-03-12 14:34:55', '2023-03-12 14:34:55', NULL),
(6, 'invo:132724', 10, 9, 1, 'patient-one', 24950.00, NULL, NULL, 1, 1, '2023-03-14 04:07:23', '2023-03-14 04:07:23', NULL),
(7, 'invo:813591', 17, 11, 4, 'Demo', 5700.00, NULL, NULL, 1, 1, '2023-04-02 03:32:59', '2023-04-02 03:32:59', NULL),
(8, 'invo:874791', 17, 11, 4, 'Demo', 6000.00, NULL, NULL, 1, 1, '2023-04-22 04:05:39', '2023-04-22 04:05:39', NULL),
(9, 'invo:978145', 17, 11, 4, 'Demo', 6000.00, NULL, NULL, 1, 1, '2023-04-23 13:46:57', '2023-04-23 13:46:57', NULL),
(10, 'invo:680011', 17, 11, 4, 'Demo patient', 12000.00, NULL, NULL, 1, 1, '2023-04-23 13:50:37', '2023-04-23 13:50:37', NULL),
(11, 'invo:553756', 17, 11, 3, 'Kyaw', 12000.00, NULL, NULL, 1, 1, '2023-04-23 13:51:26', '2023-04-23 13:51:26', NULL),
(12, 'invo:339562', 17, 11, 4, 'Demo patient', 2400.00, NULL, NULL, 1, 1, '2023-04-26 03:53:29', '2023-04-26 03:53:29', NULL),
(13, 'invo:298221', 17, 11, NULL, NULL, 0.00, NULL, NULL, 0, 1, '2023-04-26 03:54:10', '2023-04-26 04:56:15', '2023-04-26 04:56:15'),
(16, 'invo:047523', 17, 11, 4, 'Demo patient', 3600.00, NULL, NULL, 1, 1, '2023-04-26 04:55:32', '2023-04-26 04:55:32', NULL),
(17, 'invo:653250', 17, 11, 4, 'Demo patient', 3000.00, NULL, NULL, 1, 1, '2023-04-26 05:08:44', '2023-04-26 05:08:44', NULL),
(18, 'invo:025134', 17, 11, 4, 'Demo patient', 0.00, NULL, NULL, 0, 1, '2023-04-26 05:11:22', '2023-04-26 07:28:49', '2023-04-26 07:28:49'),
(19, 'invo:804571', 17, 11, 4, 'Demo patient', 1800.00, NULL, NULL, 1, 1, '2023-04-26 05:12:07', '2023-04-26 05:12:07', NULL),
(20, 'invo:321392', 17, 11, 4, 'Demo patient', 1800.00, NULL, NULL, 1, 1, '2023-04-26 05:13:40', '2023-04-26 05:13:40', NULL),
(21, 'invo:779906', 17, 11, 4, 'Demo patient', 600.00, NULL, NULL, 1, 1, '2023-04-26 05:14:35', '2023-04-26 05:14:35', NULL),
(23, 'invo:374572', 17, 11, 4, 'Demo patient', 1200.00, NULL, NULL, 1, 1, '2023-04-26 05:18:53', '2023-04-26 05:18:53', NULL),
(24, 'invo:820641', 17, 11, NULL, NULL, 3600.00, NULL, NULL, 0, 1, '2023-04-26 07:22:50', '2023-04-26 07:28:35', '2023-04-26 07:28:35'),
(26, 'invo:124008', 17, 11, 4, 'Demo patient', 3000.00, NULL, NULL, 1, 1, '2023-04-26 07:29:20', '2023-04-26 07:29:20', NULL),
(28, 'invo:560425', 17, 11, 3, 'Kyaw Aung', 1800.00, NULL, NULL, 1, 1, '2023-08-02 03:36:48', '2023-08-02 03:36:48', NULL),
(29, 'invo:726561', 50, 20, 12, 'kyaw', 2400.00, NULL, NULL, 1, 1, '2023-08-08 17:09:23', '2023-08-08 17:09:23', NULL),
(32, 'invo:288419', 14, 11, 7, 'kyaw aung', 3600.00, NULL, NULL, 1, 1, '2023-08-10 14:51:04', '2023-08-10 14:51:04', NULL),
(33, 'invo:805221', 17, 11, NULL, NULL, 1800.00, NULL, NULL, 1, 1, '2023-08-10 15:04:44', '2023-08-10 15:04:44', NULL),
(34, 'invo:903972', 52, 21, 13, 'Kyaw Kyaw', 3500.00, NULL, NULL, 1, 1, '2023-08-15 17:16:24', '2023-08-15 17:16:24', NULL),
(61, 'invo:240105', 55, 25, NULL, NULL, 250.00, NULL, NULL, 1, 1, '2023-08-22 09:46:15', '2023-08-22 09:46:15', NULL),
(62, 'invo:452540', 56, 26, 18, 'Kyaw Kyaw', 1800.00, NULL, NULL, 1, 1, '2023-09-05 14:58:44', '2023-09-05 14:58:44', NULL),
(63, 'invo:210612', 56, 26, NULL, NULL, 900.00, NULL, NULL, 1, 1, '2023-09-11 03:50:21', '2023-09-11 03:50:21', NULL),
(64, 'invo:633351', 56, 26, 18, 'Kyaw Kyaw', 1600.00, NULL, NULL, 1, 1, '2023-09-20 05:56:33', '2023-09-20 05:56:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_item`
--

CREATE TABLE `pos_item` (
  `id` bigint UNSIGNED NOT NULL,
  `pos_id` bigint UNSIGNED NOT NULL,
  `med_id` bigint UNSIGNED DEFAULT NULL,
  `med_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `act_price` double(8,2) DEFAULT '0.00',
  `margin` double(8,2) DEFAULT '0.00',
  `sell_price` double(8,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `total_price` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_item`
--

INSERT INTO `pos_item` (`id`, `pos_id`, `med_id`, `med_name`, `expire_date`, `quantity`, `act_price`, `margin`, `sell_price`, `unit`, `total_price`, `discount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'paracetemol', '2023-03-23', 15, 4500.00, 500.00, 5000.00, 'tablet', 75000.00, NULL, '2023-03-01 15:11:02', '2023-03-01 15:11:02', NULL),
(2, 1, 2, 'biogessic', '2023-03-31', 9, 500.00, 50.00, 550.00, 'tablet', 4950.00, NULL, '2023-03-01 15:11:02', '2023-03-01 15:11:02', NULL),
(3, 2, 1, 'paracetemol', '2023-03-23', 15, 4500.00, 500.00, 5000.00, 'tablet', 75000.00, NULL, '2023-03-08 07:48:17', '2023-03-08 07:48:17', NULL),
(4, 2, 2, 'biogessic', '2023-03-31', 6, 500.00, 50.00, 550.00, 'tablet', 3300.00, NULL, '2023-03-08 07:48:17', '2023-03-08 07:48:17', NULL),
(5, 3, 2, 'biogessic', '2023-03-31', 8, 500.00, 50.00, 550.00, 'tablet', 4400.00, NULL, '2023-03-08 13:40:03', '2023-03-08 13:40:03', NULL),
(6, 4, 1, 'paracetemol', '2023-03-23', 5, 4500.00, 500.00, 5000.00, 'tablet', 25000.00, NULL, '2023-03-08 13:44:21', '2023-03-08 13:44:21', NULL),
(7, 5, 1, 'paracetemol', '2023-03-23', 3, 4500.00, 500.00, 5000.00, 'tablet', 15000.00, NULL, '2023-03-12 14:34:55', '2023-03-12 14:34:55', NULL),
(8, 6, 1, 'paracetemol', '2023-03-23', 4, 4500.00, 500.00, 5000.00, 'tablet', 20000.00, NULL, '2023-03-14 04:07:23', '2023-03-14 04:07:23', NULL),
(9, 6, 2, 'biogessic', '2023-03-31', 9, 500.00, 50.00, 550.00, 'tablet', 4950.00, NULL, '2023-03-14 04:07:23', '2023-03-14 04:07:23', NULL),
(10, 7, 3, 'Biogessic', '2023-05-31', 1, 5000.00, 20.00, 6000.00, '5', 5700.00, 5.00, '2023-04-02 03:32:59', '2023-04-02 03:32:59', NULL),
(11, 8, 3, 'Biogessic', '2023-05-31', 1, 5000.00, 20.00, 6000.00, '5', 6000.00, NULL, '2023-04-22 04:05:39', '2023-04-22 04:05:39', NULL),
(12, 9, 3, 'Biogessic', '2023-05-31', 1, 5000.00, 20.00, 6000.00, '5', 6000.00, NULL, '2023-04-23 13:46:57', '2023-04-23 13:46:57', NULL),
(13, 10, 3, 'Biogessic', '2023-05-31', 2, 5000.00, 20.00, 6000.00, '5', 12000.00, NULL, '2023-04-23 13:50:37', '2023-04-23 13:50:37', NULL),
(14, 11, 3, 'Biogessic', '2023-05-31', 2, 5000.00, 20.00, 6000.00, '5', 12000.00, NULL, '2023-04-23 13:51:26', '2023-04-23 13:51:26', NULL),
(15, 12, 4, 'biogessic', '2024-11-20', 4, 500.00, 20.00, 600.00, 'bottle', 2400.00, NULL, '2023-04-26 03:53:30', '2023-04-26 03:53:30', NULL),
(16, 16, 4, 'biogessic', '2024-11-20', 6, 500.00, 20.00, 600.00, 'bottle', 3600.00, NULL, '2023-04-26 04:55:32', '2023-04-26 04:55:32', NULL),
(17, 17, 4, 'biogessic', '2024-11-20', 5, 500.00, 20.00, 600.00, 'bottle', 3000.00, NULL, '2023-04-26 05:08:44', '2023-04-26 05:08:44', NULL),
(18, 19, 4, 'biogessic', '2024-11-20', 3, 500.00, 20.00, 600.00, 'bottle', 1800.00, NULL, '2023-04-26 05:12:07', '2023-04-26 05:12:07', NULL),
(19, 20, 4, 'biogessic', '2024-11-20', 3, 500.00, 20.00, 600.00, 'bottle', 1800.00, NULL, '2023-04-26 05:13:40', '2023-04-26 05:13:40', NULL),
(20, 21, 4, 'biogessic', '2024-11-20', 1, 500.00, 20.00, 600.00, 'bottle', 600.00, NULL, '2023-04-26 05:14:35', '2023-04-26 05:14:35', NULL),
(21, 23, 4, 'biogessic', '2024-11-20', 2, 500.00, 20.00, 600.00, 'bottle', 1200.00, NULL, '2023-04-26 05:18:53', '2023-04-26 05:18:53', NULL),
(22, 24, 4, 'biogessic', '2024-11-20', 6, 500.00, 20.00, 600.00, 'bottle', 3600.00, NULL, '2023-04-26 07:22:50', '2023-04-26 07:22:50', NULL),
(23, 26, 4, 'biogessic', '2024-11-20', 5, 500.00, 20.00, 600.00, 'bottle', 3000.00, NULL, '2023-04-26 07:29:20', '2023-04-26 07:29:20', NULL),
(27, 28, 4, 'biogessic', '2024-11-20', 3, 500.00, 20.00, 600.00, 'bottle', 1800.00, NULL, '2023-08-02 03:36:48', '2023-08-02 03:36:48', NULL),
(28, 29, 10, 'Biogessic', '2023-10-13', 4, 500.00, 20.00, 600.00, 'Cream', 2400.00, NULL, '2023-08-08 17:09:23', '2023-08-08 17:09:23', NULL),
(31, 32, 4, 'biogessic', '2024-11-20', 6, 500.00, 20.00, 600.00, 'bottle', 3600.00, NULL, '2023-08-10 14:51:04', '2023-08-10 14:51:04', NULL),
(32, 33, 4, 'biogessic', '2024-11-20', 3, 500.00, 20.00, 600.00, 'bottle', 1800.00, NULL, '2023-08-10 15:04:44', '2023-08-10 15:04:44', NULL),
(33, 34, 12, 'Paracetemol', '2023-08-31', 5, 600.00, 16.00, 700.00, 'Tablet', 3500.00, NULL, '2023-08-15 17:16:24', '2023-08-15 17:16:24', NULL),
(54, 61, NULL, '4', NULL, 5, NULL, NULL, 50.00, NULL, 250.00, NULL, '2023-08-22 09:46:15', '2023-08-22 09:46:15', NULL),
(55, 62, 14, '600', '2023-09-13', 3, 500.00, 20.00, 600.00, 'Tablet', 1800.00, NULL, '2023-09-05 14:58:44', '2023-09-05 14:58:44', NULL),
(56, 63, 14, '600', '2023-09-13', 1, 500.00, 80.00, 900.00, 'Tablet', 900.00, NULL, '2023-09-11 03:50:21', '2023-09-11 03:50:21', NULL),
(57, 64, NULL, 'biogessic', NULL, 4, NULL, NULL, 400.00, NULL, 1600.00, NULL, '2023-09-20 05:56:33', '2023-09-20 05:56:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `procedure`
--

CREATE TABLE `procedure` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procedure`
--

INSERT INTO `procedure` (`id`, `name`, `price`, `clinic_id`, `created_at`, `updated_at`, `code`) VALUES
(5, 'demo-one^', '6000^', 11, '2023-05-14 04:03:27', '2023-07-04 14:05:42', 'diabetes-edit'),
(9, 'demo^', '4000^', 17, '2023-07-23 14:28:57', '2023-07-30 04:46:22', 'usage-demo'),
(10, 'demo^', '5000^', 21, '2023-08-15 17:13:55', '2023-08-15 17:13:55', 'surgery');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_type`, `permissions`, `created_at`, `updated_at`) VALUES
(1, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:27:58', '2023-01-29 05:27:58'),
(2, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:29:00', '2023-01-29 05:29:00'),
(3, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:31:03', '2023-01-29 05:31:03'),
(4, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:31:24', '2023-01-29 05:31:24'),
(5, '2', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-01-29 05:49:20', '2023-03-04 04:22:22'),
(6, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:51:35', '2023-01-29 05:51:35'),
(7, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:52:40', '2023-01-29 05:52:40'),
(8, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:53:19', '2023-01-29 05:53:19'),
(9, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-01-29 05:54:56', '2023-01-29 05:54:56'),
(10, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-05 14:07:48', '2023-02-05 14:07:48'),
(11, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-05 14:11:39', '2023-02-05 14:11:39'),
(12, '2', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\"]', '2023-02-07 13:28:52', '2023-02-07 13:28:52'),
(13, '2', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-07 13:52:06', '2023-02-07 13:52:06'),
(14, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-22 12:49:34', '2023-02-22 12:49:34'),
(15, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-22 12:53:16', '2023-02-22 12:53:16'),
(16, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-22 12:58:18', '2023-02-22 12:58:18'),
(17, '2', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-02-22 12:59:41', '2023-02-22 12:59:41'),
(18, '3', '[\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-03-01 14:28:57', '2023-03-01 14:28:57'),
(19, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-03-09 13:48:40', '2023-03-11 13:25:51'),
(20, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-03-13 06:55:02', '2023-03-13 06:55:02'),
(21, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-03-13 07:15:04', '2023-07-25 07:31:18'),
(22, '2', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\"]', '2023-03-13 07:17:10', '2023-07-25 07:22:35'),
(23, '3', '[\"p_view\",\"p_create\",\"p_update\",\"ph_view\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-03-13 07:31:35', '2023-08-02 03:38:36'),
(24, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-07-04 14:15:10', '2023-07-04 14:15:10'),
(25, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-07-04 14:15:39', '2023-07-04 14:15:39'),
(26, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-07-04 14:18:44', '2023-07-04 14:18:44'),
(27, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-07-20 15:25:42', '2023-07-20 15:25:42'),
(28, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-07-20 15:32:35', '2023-07-20 15:32:35'),
(29, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-07-20 15:33:24', '2023-07-20 15:33:24'),
(30, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-07-20 15:33:43', '2023-07-20 15:33:43'),
(31, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-07-20 15:33:52', '2023-08-15 17:31:34'),
(32, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-07-20 16:23:44', '2023-07-20 16:23:44'),
(33, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-07-23 14:43:48', '2023-07-23 14:43:48'),
(34, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-08-08 16:58:50', '2023-08-08 16:58:50'),
(35, '3', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-08-09 10:59:31', '2023-08-09 10:59:31'),
(36, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-08-15 17:06:28', '2023-08-15 17:06:28'),
(37, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-08-15 17:06:41', '2023-08-15 17:06:41'),
(38, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_update\",\"user_delete\"]', '2023-08-19 17:21:53', '2023-08-19 17:21:53'),
(39, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-08-20 05:31:54', '2023-08-20 05:31:54'),
(40, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-08-22 09:13:48', '2023-08-22 09:13:48'),
(41, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\",\"user_view\",\"user_create\",\"user_update\",\"user_delete\"]', '2023-08-30 15:10:46', '2023-09-05 15:26:41'),
(42, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\"]', '2023-10-04 04:11:02', '2023-10-04 04:48:36'),
(43, '2', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\"]', '2023-10-04 04:52:25', '2023-10-04 05:11:31'),
(44, '1', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\"]', '2023-10-04 04:55:52', '2023-10-04 04:55:52'),
(45, '3', '[\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-10-04 05:19:11', '2023-10-04 05:21:24'),
(46, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-10-04 05:48:50', '2023-10-04 05:48:50'),
(47, '5', '[\"p_view\",\"p_create\",\"p_update\",\"p_delete\",\"p_treatment\",\"d_view\",\"d_create\",\"d_update\",\"d_delete\",\"ph_view\",\"ph_create\",\"ph_update\",\"ph_delete\",\"pos_view\",\"pos_create\",\"pos_update\",\"pos_delete\"]', '2023-10-11 10:25:37', '2023-10-11 10:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `cost_amount` int NOT NULL,
  `paid_amount` int DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_trial` tinyint NOT NULL,
  `purchase_value` enum('year','month') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`guid`, `user_id`, `package_id`, `cost_amount`, `paid_amount`, `agent`, `discount`, `on_trial`, `purchase_value`, `created_at`, `updated_at`) VALUES
('69ed3aea-581b-4005-b4cd-4988900e2294', 26, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-07-20 15:33:52', '2023-07-20 15:33:52'),
('a176c81f-1144-429c-9c88-b1315267f296', 47, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-07-20 16:23:44', '2023-07-20 16:23:44'),
('8059258c-932b-4959-81a6-3b70b9370735', 49, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-07-23 14:43:51', '2023-07-23 14:43:51'),
('d93acea4-1d71-482b-9f3a-3cb7aefd1279', 50, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-08-08 16:58:51', '2023-08-08 16:58:51'),
('fa235f5a-b255-49a1-9c77-6f321bfc40e4', 52, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-08-15 17:06:34', '2023-08-15 17:06:34'),
('03e86eb9-4dad-4589-b680-37a34e5781d9', 52, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-08-15 17:06:41', '2023-08-15 17:06:41'),
('927ac5f8-6ec8-4318-ac83-df3837252243', 53, 1, 100000, NULL, NULL, NULL, 1, 'year', '2023-08-19 17:21:53', '2023-08-19 17:21:53'),
('0737b220-955a-4f33-9996-06c0497c0718', 54, 4, 300000, NULL, NULL, NULL, 1, 'year', '2023-08-20 05:31:54', '2023-08-20 05:31:54'),
('9f8081c4-36f6-4a88-9ccb-a392c8740351', 55, 4, 700, NULL, NULL, NULL, 0, 'year', '2023-08-22 09:13:54', '2023-08-22 09:41:31'),
('4d8e1cc1-4b8a-4242-b979-09154b9fd7fc', 56, 4, 700, NULL, NULL, NULL, 1, 'year', '2023-08-30 15:10:49', '2023-08-30 15:10:49'),
('acc32577-c32f-4840-8cec-57d2ab6a45bd', 62, 1, 500, NULL, NULL, NULL, 1, 'year', '2023-10-04 05:48:50', '2023-10-04 05:48:50'),
('457086d6-efd7-4bee-a1da-bea652358df0', 56, 1, 500, NULL, NULL, NULL, 1, 'year', '2023-10-11 10:25:38', '2023-10-11 10:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `speciality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credentials` text COLLATE utf8mb4_unicode_ci,
  `phoneNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `gender` tinyint DEFAULT NULL,
  `short_bio` text COLLATE utf8mb4_unicode_ci,
  `fees` double(8,2) DEFAULT NULL,
  `email_verified` int NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `lastest_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` tinyint DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `code`, `name`, `avatar`, `email`, `password`, `role_id`, `speciality`, `credentials`, `phoneNumber`, `city`, `country`, `address`, `gender`, `short_bio`, `fees`, `email_verified`, `email_verified_at`, `status`, `lastest_ip`, `user_type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `title`, `is_superadmin`, `otp`, `first_name`, `last_name`) VALUES
(1, 'aung_naing_thu', 'aung_naing', '202301291131-WIN_20230113_19_29_00_Pro.jpg', 'aryal@gmail.com', '$2y$10$OaVleU5fD3Mvo8ytrSGA0OMXthV5g9AFeI53HtG6DOCvwr91j73fO', 9, NULL, NULL, '09400372581', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-29 05:03:21', 1, NULL, 3, NULL, '2023-01-29 05:01:53', '2023-01-29 05:54:56', NULL, NULL, 0, NULL, NULL, NULL),
(2, 'doctor-code', 'doctor', NULL, 'demo-doctor@gmail.com', '$2y$10$.MH5MqtSU2mvuHV1Y1G3Y.R5OW7XA4U1dYiX6Nk4yIyOXN/cVo5gK', 10, 'demo', 'demo', '09400372581', 'Yangon', 'Myanmar', 'No.180,demo street', 1, 'demonstration', 5000.00, 1, NULL, 1, NULL, 1, NULL, '2023-02-05 14:07:48', '2023-02-05 14:07:48', NULL, NULL, 0, NULL, NULL, NULL),
(3, 'doctor-code-code', 'doctor', NULL, 'demo-doctor-1@gmail.com', '$2y$10$i5QxNVgpBO9ODBzhJUjMAeyixw9Qn3xtLcRcJkbX856YEWv0zxanS', 11, 'demo', 'demo', '09400372581', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-02-05 14:11:39', '2023-02-05 14:11:39', NULL, NULL, 0, NULL, NULL, NULL),
(4, 'recep', 'receptionist', NULL, 'recep@gmail.com', '$2y$10$o6HONTJUQBAAXSgSIwcqF.TG5KylQ/Y1nHLENyFLE6GpAbpzvW4dy', 12, NULL, NULL, '094003983939', NULL, NULL, NULL, 0, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-02-07 13:28:52', '2023-02-07 13:28:52', NULL, NULL, 0, NULL, NULL, NULL),
(5, 'reception', 'aung_naing', NULL, 'recepand@gmail.com', '$2y$10$JdxA3ntMJS0r1nS5VExHIOrzeYttMpXm.126vkMMb3oYqGUhpGn1O', 13, NULL, NULL, '09400372581', 'yangon', 'demonstration', 'yangon', 0, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-02-07 13:52:06', '2023-02-07 13:52:06', NULL, NULL, 0, NULL, NULL, NULL),
(8, 'aryal', 'aryal', NULL, 'aryal@gmail.com', '$2y$10$Xxj92V4uNv0O.jVvZ46rDuyUEGHQ.uCyK2Jjnd7fOpH8ix1wSaBVC', 19, 'demonstration', 'demonstration', '09400372581', 'Yangon', 'Myanmar', 'Demonstration', 1, 'Demonstration', 60002.00, 1, NULL, 1, NULL, 3, NULL, '2023-02-22 12:58:18', '2023-03-11 13:25:51', NULL, NULL, 0, NULL, NULL, NULL),
(9, 'recep-code', 'recep', NULL, 'receptionist@gmail.com', '$2y$10$IoVci67xHkQ8T3uQlqXOFOv748LOqR9KqegKszlIxN.e.GEMtoDz.', 5, NULL, NULL, '09838383883', 'Yangon', 'Myanmar', 'Demonstration', 1, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-02-22 12:59:41', '2023-03-04 04:22:22', NULL, NULL, 0, NULL, NULL, NULL),
(10, 'pharma', 'pharmacist', NULL, 'pharma@gmail.com', '$2y$10$i4Ef1zNSzU.xz5QOxdgkUuGSzn/kSpAfjomn7XbBOFBV4CGxKdewq', 18, NULL, NULL, '0999999999', 'Yangon', 'Myanmar', 'No.8484,blah blah', 1, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-03-01 14:28:57', '2023-03-01 14:28:57', NULL, NULL, 0, NULL, NULL, NULL),
(14, 'kyawkyaw', 'Kyaw Aung', '202307042040-apa-2017_bald_eagle_a1_4853_1_kimberly-cerimele_kk.jpg', 'aryalkrihna642@gmail.com', '$2y$10$lJNBbv6YjdzZiLH7sxdSSuH/Woq6HviHNxMJZc.B9HLcG7SQamxdK', 20, NULL, NULL, '09400372581', NULL, NULL, NULL, 1, NULL, NULL, 1, '2023-03-13 06:02:01', 1, NULL, 3, NULL, '2023-03-13 06:01:31', '2023-07-19 05:06:43', NULL, NULL, 1, NULL, NULL, NULL),
(15, 'doctor', 'Doctor Aung', '202304252225-WIN_20230113_19_29_00_Pro.jpg', 'doctor@gmail.com', '$2y$10$rxWRKYA9PtaJwtOQux4pUO0xNC3coi3FXqkCwdPhwvaM9cne5qwr.', 21, 'General', NULL, '43453453453', NULL, NULL, 'Yangon', 1, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-03-13 07:15:04', '2023-07-25 07:31:18', NULL, NULL, 0, NULL, NULL, NULL),
(16, 'recep--code', 'recep', NULL, 'recep--@gmail.com', '$2y$10$dEpC/sJJO7HPQpcf8e7kPugH594LZAOYj3ThoNoeGaGgvldvuLqEm', 22, NULL, NULL, '0959595959', 'Yangon', 'Myanmar', 'Demonstration', 0, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-03-13 07:17:10', '2023-07-25 07:22:35', NULL, NULL, 0, NULL, NULL, NULL),
(17, 'pharma-code', 'pharma', NULL, 'pharma-code@gmail.com', '$2y$10$3XUScM.cLAO7kf2ed4K3dek0a/zqoJpmVecCyTvzsum0Gex6jDb/W', 23, NULL, NULL, '09400372581', 'Yangon', 'Myanmar', 'Demonstration', 0, NULL, NULL, 1, NULL, 1, NULL, 1, NULL, '2023-03-13 07:31:35', '2023-08-02 03:38:36', NULL, NULL, 0, NULL, NULL, NULL),
(31, NULL, NULL, NULL, 'aungmyin.cm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-06-23 03:59:36', '2023-07-03 08:01:50', NULL, NULL, 0, '3553', NULL, NULL),
(32, NULL, NULL, NULL, 'care.gamehubmyanmar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-23 04:27:25', 1, NULL, NULL, NULL, '2023-06-23 04:04:36', '2023-06-23 04:27:25', NULL, NULL, 0, '7460', NULL, NULL),
(35, NULL, NULL, NULL, 'bit2bti2020@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-03 07:59:29', '2023-07-03 07:59:29', NULL, NULL, 0, '7048', NULL, NULL),
(37, NULL, NULL, NULL, 'sdf@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-03 08:05:30', '2023-07-05 03:51:05', NULL, NULL, 0, '2631', NULL, NULL),
(39, NULL, NULL, NULL, 'aryalkrishna642@gmail.comdd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-03 08:16:18', '2023-07-03 08:16:18', NULL, NULL, 0, '2211', NULL, NULL),
(40, NULL, NULL, NULL, 'sdfsdfsdf@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-04 13:24:22', '2023-07-04 13:24:22', NULL, NULL, 0, '5927', NULL, NULL),
(41, NULL, NULL, NULL, 'arya343434lkrishna642@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-04 13:24:41', '2023-07-04 13:24:41', NULL, NULL, 0, '1946', NULL, NULL),
(43, NULL, NULL, NULL, 'wer@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-04 14:21:50', '2023-07-04 14:21:50', NULL, NULL, 0, '6697', NULL, NULL),
(44, NULL, NULL, NULL, 'sdfsdf@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-05 04:01:07', '2023-07-05 04:01:07', NULL, NULL, 0, '4953', NULL, NULL),
(45, NULL, NULL, NULL, 'krishna_aryal@chanbrothers.com.sg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-12 10:14:05', '2023-07-12 10:14:05', NULL, NULL, 0, '4063', NULL, NULL),
(46, NULL, NULL, NULL, 'dsdfsdf@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-20 16:02:24', '2023-07-20 16:02:24', NULL, NULL, 0, '3227', NULL, NULL),
(48, NULL, NULL, NULL, 'aung@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-07-23 14:14:15', '2023-07-23 14:14:15', NULL, NULL, 0, '8571', NULL, NULL),
(50, NULL, 'Aung Naing', NULL, 'bit2bit2020@gmail.com', '$2y$10$hkk7vNqnhS2omXEjRS/sD.gDSeAPm4CRCJFRbQO2mQOY5A3eGzUlK', 34, NULL, NULL, '09400372581', NULL, NULL, NULL, 0, NULL, NULL, 1, '2023-08-08 16:57:05', 1, NULL, 3, NULL, '2023-08-08 16:55:30', '2023-08-08 17:06:34', NULL, NULL, 0, '9687', 'Aung', 'Naing'),
(52, NULL, 'Sayarma Treasa', NULL, 'treasako215@gmail.com', '$2y$10$529Udrcds4jFoJrLaH0DM.aRLtoN3f2XVaopAq4dOmdf7KRTYWpJ2', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-15 17:03:34', 1, NULL, 3, NULL, '2023-08-15 17:03:03', '2023-08-15 17:06:41', NULL, NULL, 0, '9968', 'Sayarma', 'Treasa'),
(53, NULL, 'Daw Hla', NULL, 'admin@gmail.com', '$2y$10$nRdcz73KB.LVCdNxsWjbc.cQFyu2XvKeRuA1HWDr1DhCuyMi0zk6W', 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-19 17:21:02', 1, NULL, 3, NULL, '2023-08-19 17:20:17', '2023-08-19 17:21:53', NULL, NULL, 0, '4961', 'Daw', 'Hla'),
(55, NULL, 'Aung Naing', '202308271930-WIN_20230501_19_37_09_Pro.jpg', 'aryalkrishna641@gmail.com', '$2y$10$Ht5rQ7uHQFtDEtInf4rPO.U6QYuI6hGthDnt/oAV5cvG3Tn0LzdEa', 40, NULL, NULL, '09400372581', NULL, NULL, NULL, 0, NULL, NULL, 1, '2023-08-22 09:12:40', 1, NULL, 3, NULL, '2023-08-22 09:12:03', '2023-08-30 15:04:01', NULL, NULL, 0, '2046', 'Aung', 'Naing'),
(56, NULL, NULL, NULL, 'aryalkrishna642@gmail.com', '$2y$10$XWHY6pdYFVuc7QVAXpAktO8wH87sTYP6jATDyNgw2TmDOvdl85Uwa', 47, NULL, NULL, NULL, NULL, NULL, 'Mogok', 1, NULL, NULL, 1, '2023-08-30 15:06:48', 1, NULL, 3, NULL, '2023-08-30 15:06:07', '2023-10-11 10:25:38', NULL, NULL, 0, '8468', 'aung', 'naing'),
(58, NULL, 'Mya Mya', NULL, 'mm@gmail.com', '$2y$10$dIMdEw8NKaxR3XZVWxSY9enTK52SD.wFyW1eXb/Ld10.b2KRAp/lK', 43, NULL, NULL, '0940038388', NULL, NULL, 'Mandalay', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, '2023-10-04 04:52:25', '2023-10-04 05:11:31', NULL, NULL, 0, NULL, 'Mya', 'Mya'),
(59, NULL, 'kyaw aung', NULL, 'kyaw@gmail.com', '$2y$10$2nLINMU71FMhogZuDL/6iOrl4JZXiqGFRlxi9atsixdf9r0kaFy5K', 44, 'demonstration', 'demonstration', '04944949494', NULL, NULL, 'Mogok', 1, NULL, 10000.00, 1, NULL, 1, NULL, NULL, NULL, '2023-10-04 04:55:52', '2023-10-04 04:55:52', NULL, NULL, 0, NULL, 'kyaw', 'aung'),
(60, NULL, 'su su', NULL, 'susu@gmail.com', '$2y$10$JTdRKYRijxwSdCQGiA67OOb/BIZcFJG6Z/RQP3p34jXk6SIJHogQK', 45, NULL, NULL, '0948484848', NULL, NULL, 'Yangon', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, '2023-10-04 05:19:11', '2023-10-04 05:21:24', NULL, NULL, 0, NULL, 'su', 'su'),
(61, NULL, NULL, NULL, 'rik34035@zslsz.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, '2023-10-04 05:42:35', '2023-10-04 05:42:35', NULL, NULL, 0, '5412', NULL, NULL),
(62, NULL, 'Zaw Aung', NULL, 'dbv63972@omeie.com', '$2y$10$wxbXq6CKWVJUu1JXuW5zGOlLo6KVysBStdq.AG/M51UyoTSXxeCCG', 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-04 05:46:52', 1, NULL, 3, NULL, '2023-10-04 05:46:14', '2023-10-04 05:48:50', NULL, NULL, 0, '4538', 'Zaw', 'Aung');

-- --------------------------------------------------------

--
-- Table structure for table `user_clinic`
--

CREATE TABLE `user_clinic` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_clinic`
--

INSERT INTO `user_clinic` (`id`, `user_id`, `clinic_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 1, 9, 1, '2023-01-29 05:54:56', '2023-01-29 05:54:56', NULL),
(9, 8, 9, 1, '2023-02-22 12:58:18', '2023-02-22 12:58:18', NULL),
(10, 9, 9, 1, '2023-02-22 12:59:41', '2023-02-22 12:59:41', NULL),
(11, 10, 9, 1, '2023-03-01 14:28:57', '2023-03-01 14:28:57', NULL),
(13, 14, 11, 1, '2023-03-13 06:55:02', '2023-03-13 06:55:02', NULL),
(14, 15, 11, 1, '2023-03-13 07:15:04', '2023-03-13 07:15:04', NULL),
(15, 16, 11, 1, '2023-03-13 07:17:10', '2023-03-13 07:17:10', NULL),
(16, 17, 11, 1, '2023-03-13 07:31:35', '2023-03-13 07:31:35', NULL),
(17, 42, 12, 1, '2023-07-04 14:18:44', '2023-07-04 14:18:44', NULL),
(18, 26, 17, 1, '2023-07-20 15:33:52', '2023-07-20 15:33:52', NULL),
(19, 47, 18, 1, '2023-07-20 16:23:44', '2023-07-20 16:23:44', NULL),
(20, 49, 19, 1, '2023-07-23 14:43:51', '2023-07-23 14:43:51', NULL),
(21, 50, 20, 1, '2023-08-08 16:58:51', '2023-08-08 16:58:51', NULL),
(22, 51, 17, 1, '2023-08-09 10:59:31', '2023-08-09 10:59:31', NULL),
(23, 52, 21, 1, '2023-08-15 17:06:34', '2023-08-15 17:06:34', NULL),
(24, 52, 22, 1, '2023-08-15 17:06:41', '2023-08-15 17:06:41', NULL),
(25, 53, 23, 1, '2023-08-19 17:21:53', '2023-08-19 17:21:53', NULL),
(26, 54, 24, 1, '2023-08-20 05:31:54', '2023-08-20 05:31:54', NULL),
(27, 55, 25, 1, '2023-08-22 09:13:54', '2023-08-22 09:13:54', NULL),
(28, 56, 26, 1, '2023-08-30 15:10:49', '2023-08-30 15:10:49', NULL),
(29, 57, 26, 1, '2023-10-04 04:11:03', '2023-10-04 04:11:03', NULL),
(30, 58, 26, 1, '2023-10-04 04:52:25', '2023-10-04 04:52:25', NULL),
(31, 59, 26, 1, '2023-10-04 04:55:52', '2023-10-04 04:55:52', NULL),
(32, 60, 26, 1, '2023-10-04 05:19:11', '2023-10-04 05:19:11', NULL),
(33, 62, 27, 1, '2023-10-04 05:48:50', '2023-10-04 05:48:50', NULL),
(34, 56, 28, 1, '2023-10-11 10:25:38', '2023-10-11 10:25:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `pos_id` int DEFAULT NULL,
  `prescription` longtext COLLATE utf8mb4_unicode_ci,
  `diag` longtext COLLATE utf8mb4_unicode_ci,
  `assigned_medicines` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `fees` double(8,2) DEFAULT '0.00',
  `is_foc` int DEFAULT '0',
  `user_id` int NOT NULL,
  `investigation` longtext COLLATE utf8mb4_unicode_ci,
  `procedure` longtext COLLATE utf8mb4_unicode_ci,
  `is_followup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followup_date` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `sys_bp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia_bp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spo2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rbs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disease` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `patient_id`, `pos_id`, `prescription`, `diag`, `assigned_medicines`, `images`, `fees`, `is_foc`, `user_id`, `investigation`, `procedure`, `is_followup`, `followup_date`, `status`, `created_at`, `updated_at`, `deleted_at`, `sys_bp`, `dia_bp`, `pr`, `temp`, `spo2`, `rbs`, `disease`) VALUES
(1, 1, NULL, 'demo', 'demo', '^^<br>', '[]', NULL, 1, 8, 'helloworld', 'hello world', NULL, NULL, 0, '2023-02-23 04:43:46', '2023-03-09 00:57:24', '2023-03-09 00:57:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, NULL, 'demo', 'demo', '1^1-1-1^5<br>2^1-1-1^3<br>', '[]', NULL, NULL, 8, 'helloworld', 'hello world', '1', '2023-03-02 17:30:00', 0, '2023-03-01 14:21:57', '2023-03-05 13:25:45', '2023-03-05 13:25:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 1, 'demo', 'demo', '1^1-1-1^5<br>2^1-1-1^3<br>', '[]', NULL, NULL, 1, 'helloworld', 'hello world', '1', '2023-03-07 17:30:00', 0, '2023-03-01 14:36:21', '2023-03-04 15:21:36', '2023-03-04 15:21:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 8, NULL, NULL, NULL, NULL, 0, '2023-03-04 09:08:25', '2023-03-04 15:21:15', '2023-03-04 15:21:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, NULL, 'jklm', 'ieieei', '^^<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-04 15:23:24', '2023-03-09 00:57:26', '2023-03-09 00:57:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, NULL, 'jklm', 'ieieei', '1^1-1-1^5<br>2^1-1-1^2<br>', '[]', NULL, NULL, 8, 'jello', 'upload', '1', '2023-03-15 17:30:00', 0, '2023-03-05 13:28:48', '2023-03-09 00:57:27', '2023-03-09 00:57:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 2, 'jklm', 'ieieei', '1^1-1-1^5<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-08 02:16:40', '2023-03-14 03:53:03', '2023-03-14 03:53:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, NULL, 'jklm', 'ieieei', '2^1-1-1^3<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-08 08:07:04', '2023-03-14 03:53:02', '2023-03-14 03:53:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, NULL, 'jklm', 'ieieei', '^^<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-08 08:07:49', '2023-03-14 03:53:01', '2023-03-14 03:53:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 5, 'jklm', 'ieieei', '^^<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-08 08:13:45', '2023-03-12 14:34:55', '2023-03-12 14:12:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, 4, 'short glucose', 'short glucose', '1^1-1-1^5<br>', '[\"p-2-230308025145438843.jpg\",\"p-2-230308025145553763.jpg\",\"p-2-230308025145557515.jpg\"]', NULL, NULL, 8, 'demo', 'online demonstration', NULL, NULL, 1, '2023-03-08 08:21:45', '2023-03-08 13:44:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, NULL, 'jklm', 'ieieei', '1^1-1-1^2<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-09 00:25:06', '2023-03-12 14:12:44', '2023-03-12 14:12:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, NULL, 'jklm', 'ieieei', '^^<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-09 00:57:40', '2023-03-12 14:12:42', '2023-03-12 14:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, NULL, 'jklm', 'ieieei', '1^1-1-1^5<br>', '[]', NULL, NULL, 8, 'jello', 'upload', '1', '2023-03-10 17:30:00', 0, '2023-03-11 13:28:42', '2023-03-12 14:12:41', '2023-03-12 14:12:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, NULL, 'jklm', 'ieieei', '1^1-1-1^2<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-11 15:18:03', '2023-03-12 14:12:40', '2023-03-12 14:12:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, NULL, 'jklm', 'ieieei', '2^1-1-1^1<br>', '[]', NULL, NULL, 8, 'jello', 'upload', NULL, NULL, 0, '2023-03-11 15:19:28', '2023-03-12 14:12:38', '2023-03-12 14:12:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, NULL, NULL, 'ieieei', '1^1-1-1^1<br>2^1-1-1^2<br>', '[]', NULL, NULL, 8, 'jello', 'upload', '1', '2023-03-14 17:30:00', 0, '2023-03-11 15:28:47', '2023-03-12 14:12:37', '2023-03-12 14:12:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, NULL, 'jklm', 'ieieei', '1^1-1-1^1<br>2^1-1-1^2<br>', '[]', NULL, 1, 8, 'jello', 'upload', '1', '2023-03-30 17:30:00', 0, '2023-03-13 02:57:24', '2023-03-14 03:52:58', '2023-03-14 03:52:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 3, NULL, 'fever', 'fever', '3^1-1-1^2<br>', '[\"p-3-230313020406354012.jpg\",\"p-3-230313020406433784.jpg\",\"p-3-230313020406436124.jpg\"]', NULL, NULL, 15, 'Demo', 'Demo', '1', '2023-03-15 17:30:00', 1, '2023-03-13 07:34:06', '2023-03-13 07:34:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, NULL, 'jklm', 'ieieei', '1^1-1-1^5<br>2^1-1-1^3<br>', '[]', 60002.00, NULL, 8, 'jello', 'upload', '1', '2023-03-22 17:30:00', 0, '2023-03-14 03:51:36', '2023-03-14 03:52:57', '2023-03-14 03:52:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, NULL, 'short glucose', NULL, '1^1-1-1^5<br>2^1-1-1^2<br>', '[]', 60002.00, NULL, 8, 'demo', 'demo', '1', '2023-03-27 17:30:00', 1, '2023-03-14 03:54:51', '2023-03-14 03:54:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 6, 'short glucose', NULL, '1^1-1-1^5<br>2^1-1-1^3<br>', '[]', 60002.00, NULL, 8, 'demo', 'demo', '1', '2023-03-29 17:30:00', 1, '2023-03-14 03:58:09', '2023-03-14 04:07:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, NULL, 'short glucose', 'short glucose', '1^1-1-1^5<br>2^1-1-1^3<br>', '[]', 60002.00, NULL, 8, 'demo', 'online demonstration', NULL, NULL, 1, '2023-03-14 04:01:06', '2023-03-14 04:01:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 4, NULL, NULL, NULL, 'Biogessic-1<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-02 03:32:59', '2023-06-03 13:05:12', '2023-06-03 13:05:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 4, 9, 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '3^1-0-1^5<br>', '[]', 60000.00, NULL, 15, NULL, NULL, '1', '2023-04-28 17:30:00', 0, '2023-04-22 04:05:17', '2023-06-03 13:05:13', '2023-06-03 13:05:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 3, 11, 'fever', 'fever', '3^1-1-1^3<br>', '[]', NULL, NULL, 15, 'Demo', 'Demo', NULL, NULL, 0, '2023-04-23 13:46:25', '2023-05-14 13:05:04', '2023-05-14 13:05:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 4, NULL, NULL, NULL, 'Biogessic-2<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-23 13:50:37', '2023-04-29 13:34:30', '2023-04-29 13:34:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 4, NULL, NULL, NULL, 'biogessic-4<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 03:53:30', '2023-04-29 13:34:29', '2023-04-29 13:34:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 4, NULL, NULL, NULL, 'biogessic-6<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 04:55:32', '2023-04-29 13:34:29', '2023-04-29 13:34:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 4, NULL, NULL, NULL, 'biogessic-5<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 05:08:44', '2023-04-29 13:34:28', '2023-04-29 13:34:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 4, NULL, NULL, NULL, 'biogessic-3<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 05:12:07', '2023-04-29 13:34:27', '2023-04-29 13:34:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 4, NULL, NULL, NULL, 'biogessic-3<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 05:13:40', '2023-04-29 13:34:26', '2023-04-29 13:34:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 4, NULL, NULL, NULL, 'biogessic-1<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 05:14:35', '2023-04-29 13:34:25', '2023-04-29 13:34:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 4, NULL, NULL, NULL, 'biogessic-2<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 05:18:53', '2023-04-29 13:34:24', '2023-04-29 13:34:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 4, NULL, NULL, NULL, 'biogessic-5<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 0, '2023-04-26 07:29:20', '2023-04-29 13:34:23', '2023-04-29 13:34:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 4, NULL, 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '^^<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-05-06 14:11:47', '2023-06-03 13:05:15', '2023-06-03 13:05:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 4, NULL, 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '^^<br>', '[]', NULL, NULL, 15, NULL, NULL, '1', '2023-05-24 17:30:00', 0, '2023-05-06 14:12:20', '2023-06-03 13:05:16', '2023-06-03 13:05:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 4, NULL, 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '^^<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-05-07 06:41:32', '2023-06-06 15:18:06', '2023-06-06 15:18:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 4, NULL, 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '^^<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-05-07 06:50:45', '2023-06-06 04:01:48', '2023-06-06 04:01:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 4, NULL, 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '^^<br>', '[]', NULL, 1, 15, NULL, NULL, NULL, NULL, 0, '2023-05-07 06:53:46', '2023-06-06 04:01:46', '2023-06-06 04:01:46', '44', '431', '122', '345', '44', '34', NULL),
(41, 5, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-05-12 16:19:57', '2023-05-12 16:20:15', '2023-05-12 16:20:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 7, NULL, NULL, NULL, NULL, '[]', 0.00, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-06-06 02:22:32', '2023-06-10 07:57:59', '2023-06-10 07:57:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 4, NULL, 'hello', 'Dictum mollitia etiam, arcu dolorem per exercitation auctor curabitur nullam laboriosam officiis quo saepe! Consectetur? Dis, lobortis per lacinia primis laboris at odio error, purus scelerisque ullamco aenean voluptatibus primis. Laborum? Minim iusto eu soluta eleifend! Diam dolor a aliquam, anim elit, quis adipisicing? Voluptate ultrices dapibus felis, laoreet mauris sapiente necessitatibus augue elementum quod? Minim placeat itaque tristique, excepteur! Magnis ipsam pellentesque eos, aliqua, itaque porta maiores, condimentum fringilla dignissim ullamcorper pulvinar neque cupiditate integer, inventore nisi tempore tellus dolor explicabo accusantium aliquet, eu quibusdam habitant? Bibendum! Optio deserunt, felis numquam quisquam quaerat sagittis eiusmod voluptatem, turpis! Morbi sed.', '4^1-1-1^3<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-06-06 04:12:16', '2023-06-06 15:18:08', '2023-06-06 15:18:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 4, NULL, 'ldk', 'ldk', '4^1-1-1^3<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-06-06 14:36:58', '2023-06-06 15:18:11', '2023-06-06 15:18:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 6, NULL, NULL, NULL, '4^1-1-1^5<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 1, '2023-06-06 14:38:46', '2023-06-06 14:38:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 5, NULL, NULL, NULL, '', '[\"p-5-230609065300082033.png\",\"p-5-230609065300184961.png\",\"p-5-230609065300186544.png\"]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-06-09 12:23:00', '2023-06-19 13:16:23', '2023-06-19 13:16:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 4, NULL, NULL, NULL, '6^^<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-06-10 07:24:55', '2023-06-10 07:25:36', '2023-06-10 07:25:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 5, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 15, NULL, NULL, NULL, NULL, 0, '2023-06-10 07:25:28', '2023-06-19 13:16:30', '2023-06-19 13:16:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 4, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-06-10 07:56:46', '2023-08-10 14:49:42', '2023-08-10 14:49:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 5, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-06-10 07:56:58', '2023-06-19 13:16:29', '2023-06-19 13:16:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 3, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-06-10 07:57:18', '2023-07-05 03:49:35', '2023-07-05 03:49:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 7, NULL, '<p>Dignissim libero sociosqu alias natus suscipit ea in iure sem voluptatem expedita vestibulum porttitor necessitatibus, culpa, eligendi nunc dolores magnis, eleifend turpis in error dictumst iusto voluptate donec, aute facere, repudiandae provident, ridiculus accusantium semper, dolores? Posuere mauris necessitatibus pulvinar justo ducimus atque dictumst officiis, leo. Ut beatae, adipisicing aliqua odio animi! Blandit laboriosam, lectus eum ipsa consequatur auctor ducimus, euismod, assumenda. Felis eligendi illum lacus, mollitia faucibus, perspiciatis? Fugit quod culpa, illum sunt lobortis deserunt eu. Velit recusandae harum occaecati mi nostrum id? Sapien optio aliquip venenatis sapiente sapien est, iusto, nostrum, facere consequat! Etiam, dolorem rhoncus non mauris.</p>', '<p>Dignissim libero sociosqu alias natus suscipit ea in iure sem voluptatem expedita vestibulum porttitor necessitatibus, culpa, eligendi nunc dolores magnis, eleifend turpis in error dictumst iusto voluptate donec, aute facere, repudiandae provident, ridiculus accusantium semper, dolores? Posuere mauris necessitatibus pulvinar justo ducimus atque dictumst officiis, leo. Ut beatae, adipisicing aliqua odio animi! Blandit laboriosam, lectus eum ipsa consequatur auctor ducimus, euismod, assumenda. Felis eligendi illum lacus, mollitia faucibus, perspiciatis? Fugit quod culpa, illum sunt lobortis deserunt eu. Velit recusandae harum occaecati mi nostrum id? Sapien optio aliquip venenatis sapiente sapien est, iusto, nostrum, facere consequat! Etiam, dolorem rhoncus non mauris.</p>', '4^1-1-1^3<br>', '[]', NULL, 1, 14, 'demo', 'demo', NULL, NULL, 0, '2023-06-10 07:59:28', '2023-06-10 08:26:50', '2023-06-10 08:26:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 7, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-06-10 08:03:53', '2023-06-10 08:04:10', '2023-06-10 08:04:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 7, NULL, '<p>Dignissim libero sociosqu alias natus suscipit ea in iure sem voluptatem expedita vestibulum porttitor necessitatibus, culpa, eligendi nunc dolores magnis, eleifend turpis in error dictumst iusto voluptate donec, aute facere, repudiandae provident, ridiculus accusantium semper, dolores? Posuere mauris necessitatibus pulvinar justo ducimus atque dictumst officiis, leo. Ut beatae, adipisicing aliqua odio animi! Blandit laboriosam, lectus eum ipsa consequatur auctor ducimus, euismod, assumenda. Felis eligendi illum lacus, mollitia faucibus, perspiciatis? Fugit quod culpa, illum sunt lobortis deserunt eu. Velit recusandae harum occaecati mi nostrum id? Sapien optio aliquip venenatis sapiente sapien est, iusto, nostrum, facere consequat! Etiam, dolorem rhoncus non mauris.</p>', '<p>Dignissim libero sociosqu alias natus suscipit ea in iure sem voluptatem expedita vestibulum porttitor necessitatibus, culpa, eligendi nunc dolores magnis, eleifend turpis in error dictumst iusto voluptate donec, aute facere, repudiandae provident, ridiculus accusantium semper, dolores? Posuere mauris necessitatibus pulvinar justo ducimus atque dictumst officiis, leo. Ut beatae, adipisicing aliqua odio animi! Blandit laboriosam, lectus eum ipsa consequatur auctor ducimus, euismod, assumenda. Felis eligendi illum lacus, mollitia faucibus, perspiciatis? Fugit quod culpa, illum sunt lobortis deserunt eu. Velit recusandae harum occaecati mi nostrum id? Sapien optio aliquip venenatis sapiente sapien est, iusto, nostrum, facere consequat! Etiam, dolorem rhoncus non mauris.</p>', '^^<br>', '[]', NULL, NULL, 14, 'demo', 'demo', NULL, NULL, 0, '2023-06-10 08:26:21', '2023-07-08 11:57:27', '2023-07-08 11:57:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 7, NULL, 'Mauris voluptatibus risus, integer eu! Diamlorem maiores ratione repellat sagittis.', 'Mauris voluptatibus risus, integer eu! Diamlorem maiores ratione repellat sagittis.', '^^<br>', '[]', NULL, NULL, 14, 'demo', 'demo', NULL, NULL, 1, '2023-06-10 08:31:43', '2023-06-10 08:31:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 5, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 1, '2023-07-08 07:23:04', '2023-07-08 07:23:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 3, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-07-08 11:52:28', '2023-07-25 14:54:45', '2023-07-25 14:54:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 4, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-07-08 12:37:36', '2023-07-08 13:36:07', '2023-07-08 13:36:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 4, NULL, NULL, NULL, '^^<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, NULL, 0, '2023-07-10 01:54:44', '2023-07-10 15:37:59', '2023-07-10 15:37:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 5, NULL, 'Varius praesent dolore sem quasi fames. Erat aliquam amet nostrud. Varius praesent dolore sem quasi fames. Erat aliquam amet nostrud.', NULL, 'biogessic^1-1-1^2<br>Paracetemol^0-0-1^2<br>4^1-1-1^2<br>', '[\"p-5-230713083657131826.png\"]', NULL, NULL, 14, NULL, NULL, '1', '2023-07-27 17:30:00', 1, '2023-07-13 14:06:57', '2023-07-13 14:06:57', NULL, '40', '45', NULL, NULL, '40', NULL, NULL),
(68, 3, NULL, NULL, NULL, 'biogessic-3<br>', NULL, 0.00, 0, 17, NULL, NULL, NULL, NULL, 1, '2023-08-02 03:36:48', '2023-08-02 03:36:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 12, NULL, 'Demonstration', NULL, 'biogessic^^<br>', '[]', NULL, NULL, 50, NULL, NULL, NULL, NULL, 1, '2023-08-08 17:05:06', '2023-08-08 17:05:06', NULL, '50', '50', '50', '50', '50', '50', NULL),
(87, 12, NULL, 'Demonstration', NULL, '^^<br>', '[]', NULL, NULL, 50, NULL, NULL, NULL, NULL, 1, '2023-08-08 17:05:24', '2023-08-08 17:05:24', NULL, '50', '50', '50', '50', '50', '50', NULL),
(88, 12, NULL, NULL, NULL, 'Biogessic-4<br>', NULL, 0.00, 0, 50, NULL, NULL, NULL, NULL, 1, '2023-08-08 17:09:24', '2023-08-08 17:09:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 12, NULL, 'Need to drink lots of hot drink. Need to drink lots of hot drink', NULL, 'Biogessic^1-1-1^2<br>', '[]', NULL, NULL, 50, NULL, NULL, NULL, '2023-08-21 17:30:00', 1, '2023-08-08 17:19:53', '2023-08-08 17:19:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 3, NULL, 'cough', NULL, 'biogessic^1-1-1^2<br>', '[]', NULL, NULL, 14, NULL, NULL, NULL, '2023-08-17 17:30:00', 1, '2023-08-10 14:04:41', '2023-08-10 14:04:41', NULL, '40', '40', '40', '40', '40', '40', NULL),
(94, 7, NULL, NULL, NULL, 'biogessic-6<br>', NULL, 0.00, 0, 14, NULL, NULL, NULL, NULL, 1, '2023-08-10 14:51:04', '2023-08-10 14:51:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 4, NULL, 'Varius praesent dolore sem quasi fames. Erat aliquam amet nostrud.', NULL, 'Paracetemol^0-0-1^2<br>4^1-1-1^2<br>', '[\"p-4-230811121431528689.jpg\",\"p-4-230811121432218336.jpg\",\"p-4-230811121432234546.jpg\"]', NULL, NULL, 14, NULL, NULL, '1', '2023-08-18 17:30:00', 1, '2023-08-11 05:44:32', '2023-08-11 05:44:32', NULL, '80', '120', '60', '98', '80', '50', NULL),
(112, 13, NULL, NULL, NULL, 'Paracetemol^1-1-1^3<br>', '[\"p-13-230815114456762649.png\",\"p-13-230815114457192048.png\",\"p-13-230815114457205329.png\"]', NULL, NULL, 52, NULL, NULL, '1', '2023-08-23 17:30:00', 1, '2023-08-15 17:14:57', '2023-08-15 17:14:57', NULL, '40', '50', '50', '50', '40', '50', NULL),
(113, 13, NULL, NULL, NULL, 'Paracetemol-5<br>', NULL, 0.00, 0, 52, NULL, NULL, NULL, NULL, 1, '2023-08-15 17:16:24', '2023-08-15 17:16:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 14, NULL, 'demonstration', NULL, 'biogessic^3-3-3^5<br>', '[]', NULL, NULL, 53, NULL, NULL, '1', '2023-08-28 17:30:00', 1, '2023-08-19 17:25:11', '2023-08-19 17:25:11', NULL, '50', '60', '90', '40', '50', '40', NULL),
(129, 15, NULL, 'demonstration', NULL, 'Biogessic^^<br>', '[]', NULL, NULL, 55, NULL, NULL, NULL, NULL, 0, '2023-08-22 09:48:07', '2023-08-22 09:48:44', '2023-08-22 09:48:44', '50', '60', '60', '60', '50', '06', NULL),
(130, 16, NULL, NULL, NULL, 'bio^^<br>', '[]', NULL, NULL, 55, NULL, NULL, NULL, NULL, 0, '2023-08-30 08:56:53', '2023-08-30 08:57:17', '2023-08-30 08:57:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 16, NULL, NULL, NULL, 'bio^^<br>', '[]', NULL, NULL, 55, NULL, NULL, NULL, NULL, 0, '2023-08-30 08:57:28', '2023-08-30 08:58:10', '2023-08-30 08:58:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 16, NULL, NULL, NULL, 'bio^^<br>', '[]', NULL, NULL, 55, NULL, NULL, NULL, NULL, 0, '2023-08-30 09:00:20', '2023-08-30 09:06:58', '2023-08-30 09:06:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 18, NULL, 'fever', NULL, 'biogessic^1-1-1^2<br>', '[\"p-18-230905013416787933.jpg\"]', NULL, 1, 56, NULL, NULL, '1', '2023-09-12 17:30:00', 1, '2023-09-05 07:04:16', '2023-09-05 07:04:16', NULL, '60', '70', '50', '60', '60', '44', NULL),
(134, 18, NULL, NULL, NULL, '600-3<br>', NULL, 0.00, 0, 56, NULL, NULL, NULL, NULL, 0, '2023-09-05 14:58:44', '2023-09-05 15:06:49', '2023-09-05 15:06:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 18, NULL, 'fever', NULL, '14^21-11^<br>', '[]', NULL, NULL, 56, NULL, NULL, NULL, NULL, 1, '2023-09-08 07:35:10', '2023-09-08 07:35:10', NULL, '60', '70', '50', '60', '60', '44', NULL),
(136, 18, NULL, NULL, NULL, 'biogessic-4<br>', NULL, 0.00, 0, 56, NULL, NULL, NULL, NULL, 1, '2023-09-20 05:56:33', '2023-09-20 05:56:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 20, NULL, 'say', NULL, 'biogessic^1-1-1^2<br>', '[]', 10000.00, NULL, 59, NULL, NULL, '1', '2023-11-03 17:00:00', 1, '2023-10-04 05:23:08', '2023-10-04 05:23:08', NULL, '60', '70', '70', '70', '60', '60', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clinic_code_unique` (`code`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dictionary_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigation`
--
ALTER TABLE `investigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_purchase`
--
ALTER TABLE `package_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_code_unique` (`code`),
  ADD KEY `patient_user_id_foreign` (`user_id`);

--
-- Indexes for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_doctor_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_doctor_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_user_id_foreign` (`user_id`),
  ADD KEY `pharmacy_clinic_id_foreign` (`clinic_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pos_invoice_code_unique` (`invoice_code`),
  ADD KEY `pos_user_id_foreign` (`user_id`);

--
-- Indexes for table `pos_item`
--
ALTER TABLE `pos_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_item_pos_id_foreign` (`pos_id`),
  ADD KEY `pos_item_med_id_foreign` (`med_id`);

--
-- Indexes for table `procedure`
--
ALTER TABLE `procedure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_code_unique` (`code`);

--
-- Indexes for table `user_clinic`
--
ALTER TABLE `user_clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_patient_id_foreign` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dictionary`
--
ALTER TABLE `dictionary`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `investigation`
--
ALTER TABLE `investigation`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_purchase`
--
ALTER TABLE `package_purchase`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pos_item`
--
ALTER TABLE `pos_item`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `procedure`
--
ALTER TABLE `procedure`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user_clinic`
--
ALTER TABLE `user_clinic`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD CONSTRAINT `dictionary_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  ADD CONSTRAINT `patient_doctor_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_doctor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `pharmacy_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pharmacy_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pos`
--
ALTER TABLE `pos`
  ADD CONSTRAINT `pos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pos_item`
--
ALTER TABLE `pos_item`
  ADD CONSTRAINT `pos_item_med_id_foreign` FOREIGN KEY (`med_id`) REFERENCES `pharmacy` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pos_item_pos_id_foreign` FOREIGN KEY (`pos_id`) REFERENCES `pos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
