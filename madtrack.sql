-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2024 at 09:08 PM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u871213015_madtrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `time_in` varchar(255) DEFAULT NULL,
  `time_out` varchar(255) DEFAULT NULL,
  `day` bigint(20) DEFAULT NULL,
  `month` bigint(20) DEFAULT NULL,
  `year` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `captured` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_name`, `time_in`, `time_out`, `day`, `month`, `year`, `status`, `captured`, `created_at`, `updated_at`) VALUES
(26, 'Allen Dale test1', '9:51 PM', '10:04 PM', 7, 1, 2024, 'P', 'backend/face/captured/Allen Dale test1/2.jpg', '2024-01-07 01:51:34', '2024-01-07 14:04:03'),
(29, 'Allen Dale test1', '1:08 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/Allen Dale test1/3.jpg', '2024-01-08 13:08:47', '2024-01-08 13:08:47'),
(30, 'John Paul Quintana', '1:14 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/John Paul Quintana/3.jpg', '2024-01-08 13:14:40', '2024-01-08 13:14:40'),
(31, 'Mark Louie Dominguez', '1:15 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/Mark Louie Dominguez/2.jpg', '2024-01-08 13:15:41', '2024-01-08 13:15:41'),
(32, 'Von Madrid', '1:39 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/Von Madrid/2.jpg', '2024-01-08 13:39:32', '2024-01-08 13:39:32'),
(33, 'julius acosta', '2:58 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/julius acosta/3.jpg', '2024-01-08 14:58:28', '2024-01-08 14:58:28'),
(34, 'Mark Louie', '3:16 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/Mark Louie/2.jpg', '2024-01-08 15:16:25', '2024-01-08 15:16:25'),
(35, 'Sajib Milon', '5:05 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/Sajib Milon/2.jpg', '2024-01-08 17:05:19', '2024-01-08 17:05:19'),
(36, 'carl laurence Dominguez', '7:50 PM', NULL, 8, 1, 2024, 'P', 'backend/face/captured/carl laurence Dominguez/2.jpg', '2024-01-08 19:50:48', '2024-01-08 19:50:48');

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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_brand` varchar(255) DEFAULT NULL,
  `stocks` int(10) UNSIGNED NOT NULL,
  `product_pcs_price` double DEFAULT NULL,
  `product_pack_price` double DEFAULT NULL,
  `product_pcs_per_pack` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_type` enum('per-pack','per-piece','both') NOT NULL DEFAULT 'per-piece',
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_type`, `product_name`, `product_brand`, `stocks`, `product_pcs_price`, `product_pack_price`, `product_pcs_per_pack`, `created_at`, `updated_at`, `unit_type`, `size`) VALUES
(1, 'Sticker (Glossy)', 'Vinyl Sticker', 'I-TECH', 20, 24, 100, 0, '2024-01-01 21:04:38', '2024-01-08 16:42:48', 'per-piece', 'A4'),
(2, 'Sticker', 'DTP', 'Quaff', 5, 50, 0, 0, '2024-01-08 07:42:10', '2024-01-08 14:57:21', 'per-piece', 'A4'),
(3, 'Sticker (Glossy)', 'Photo Top', 'Quaff', 23, 50, 1, 0, '2024-01-08 07:42:10', '2024-01-09 00:27:45', 'per-pack', 'A5'),
(4, 't shirt', 'White shirt', 'Yalex', 65, 92, 0, 0, '2024-01-08 15:11:09', '2024-01-09 00:27:45', 'per-piece', 'Xs'),
(5, 'T shirt', 'White shirt', 'Yalex', 78, 98, 0, 0, '2024-01-08 15:13:44', '2024-01-09 00:27:45', 'per-piece', 'S'),
(6, 'T shirt', 'White shirt', 'Yalex', 55, 104, 0, 0, '2024-01-08 15:14:59', '2024-01-08 15:14:59', 'per-piece', 'M'),
(7, 'T shirt', 'white shirt', 'Yalex', 46, 109, 0, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'L'),
(8, 'T shirt', 'white shirt', 'Yalex', 34, 114, 1, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'XL'),
(9, 'T shirt', 'white shirt', 'Yalex', 37, 119, 2, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', '2XL'),
(10, 'T shirt', 'white shirt', 'Yalex', 45, 125, 3, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', '3XL'),
(11, 'T shirt', 'white shirt', 'Yalex', 32, 135, 4, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', '5XL'),
(12, 'T shirt', 'Colored shirt (BLACK)', 'Yalex', 66, 107, 5, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'XS'),
(13, 'T shirt', 'Colored shirt(BLACK)', 'Yalex', 88, 115, 6, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'S'),
(14, 'T shirt', 'Colored shirt(BLACK)', 'Yalex', 34, 119, 7, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'M'),
(15, 'T shirt', 'Colored shirt(BLACK)', 'Yalex', 44, 125, 8, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'L'),
(16, 'T shirt', 'Colored shirt(BLACK)', 'Yalex', 63, 130, 9, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'XL'),
(17, 'T shirt', 'Colored shirt(BLACK)', 'Yalex', 77, 136, 10, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', '2XL'),
(18, 'T shirt', 'Colored shirt(BLACK)', 'Yalex', 35, 142, 11, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', '3XL'),
(19, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 44, 107, 12, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', 'XS'),
(20, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 75, 115, 13, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'S'),
(21, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 63, 119, 14, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'M'),
(22, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 58, 125, 15, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'L'),
(23, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 44, 130, 16, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'XL'),
(24, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 55, 136, 17, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', '2XL'),
(25, 'T shirt', 'Colored shirt(BLUE)', 'Yalex', 89, 142, 18, 0, '2024-01-08 15:28:21', '2024-01-08 15:28:21', 'per-piece', '3XL'),
(26, 'T shirt', 'Colored shirt(RED)', 'Yalex', 88, 107, 19, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'XS'),
(27, 'T shirt', 'Colored shirt(RED)', 'Yalex', 42, 115, 20, 0, '2024-01-08 15:28:21', '2024-01-08 16:56:05', 'per-piece', 'S'),
(28, 'T shirt', 'Colored shirt(RED)', 'Yalex', 63, 119, 21, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'M'),
(29, 'T shirt', 'Colored shirt(RED)', 'Yalex', 69, 125, 22, 0, '2024-01-08 15:28:21', '2024-01-09 00:27:45', 'per-piece', 'L'),
(30, 'T shirt', 'Colored shirt(RED)', 'Yalex', 61, 130, 23, 0, '2024-01-08 15:28:21', '2024-01-08 16:56:05', 'per-piece', 'XL'),
(31, 'T shirt', 'Colored shirt(RED)', 'Yalex', 94, 136, 24, 0, '2024-01-08 15:28:21', '2024-01-08 16:42:48', 'per-piece', '2XL'),
(32, 'T shirt', 'Colored shirt(RED)', 'Yalex', 78, 142, 25, 0, '2024-01-08 15:28:21', '2024-01-08 16:42:48', 'per-piece', '3XL'),
(33, 'MUGS', 'WHITE MUG', 'YASEN', 324, 37, 0, 36, '2024-01-08 16:00:08', '2024-01-09 00:27:45', 'both', NULL),
(34, 'MUGS', 'WHITE MUG', 'QUAFF', 432, 39, 1, 36, '2024-01-08 16:00:08', '2024-01-09 00:27:45', 'per-piece', NULL),
(35, 'MUGS', 'MAGIC MUG', 'QUAFF', 288, 65, 2, 36, '2024-01-08 16:00:08', '2024-01-08 16:00:08', 'per-piece', NULL),
(36, 'PAPER(MATTE)', 'PHOTO TOP', 'QUAFF', 42, 120, 3, 0, '2024-01-08 16:00:08', '2024-01-09 00:27:45', 'per-piece', 'A4'),
(37, 'PAPER(GLITTER)', 'PHOTO TOP', 'QUAFF', 62, 120, 4, 0, '2024-01-08 16:00:08', '2024-01-08 16:47:51', 'per-piece', 'A4'),
(38, 'PAPER(LEATHER)', 'PHOTO TOP', 'QUAFF', 72, 105, 5, 0, '2024-01-08 16:00:08', '2024-01-08 16:42:48', 'per-piece', 'A4'),
(39, 'PAPER(3D)', 'PHOTO TOP', 'QUAFF', 49, 105, 6, 0, '2024-01-08 16:00:08', '2024-01-08 16:42:48', 'per-piece', 'A4'),
(40, 'PAPER', 'PHOTO TOP', 'QUAFF', 80, 130, 7, 0, '2024-01-08 16:00:08', '2024-01-08 16:42:48', 'per-piece', 'A4'),
(41, 'Ink', 'Pigment (Black)', 'Cuyi', 15, 140, 0, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(42, 'Ink', 'Pigment (Blue)', 'Cuyi', 22, 140, 1, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(43, 'Ink', 'Pigment (Magenta)', 'Cuyi', 16, 140, 2, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(44, 'Ink', 'Pigment (Red)', 'Cuyi', 13, 140, 3, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(45, 'Ink', 'Pigment (Yellow)', 'Cuyi', 10, 140, 4, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(46, 'Ink', 'Pigment (Green)', 'Cuyi', 20, 140, 5, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(47, 'Ink', 'Pigment (Cyan)', 'Cuyi', 14, 140, 6, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(48, 'Ink', 'Pigment (White)', 'Cuyi', 20, 140, 7, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(49, 'Ink', 'subli (Black)', 'Cuyi', 14, 190, 8, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(50, 'Ink', 'subli (Blue)', 'Cuyi', 22, 190, 9, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(51, 'Ink', 'subli (Magenta)', 'Cuyi', 20, 190, 10, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(52, 'Ink', 'subli (Red)', 'Cuyi', 11, 190, 11, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(53, 'Ink', 'subli (Yellow)', 'Cuyi', 13, 190, 12, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(54, 'Ink', 'subli (Green)', 'Cuyi', 16, 190, 13, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(55, 'Ink', 'subli (White)', 'Cuyi', 18, 190, 14, 0, '2024-01-09 00:42:44', '2024-01-09 00:42:44', 'per-piece', '100ml'),
(56, 'Photo Paper', 'Double sided Glossy', 'Quaff', 32, 125, 0, 0, '2024-01-09 00:54:20', '2024-01-09 01:44:36', 'per-piece', 'A4 120gsm'),
(57, 'Photo Paper', 'Double sided Glossy', 'Quaff', 44, 260, 1, 0, '2024-01-09 00:54:20', '2024-01-09 01:44:36', 'per-piece', 'A3 120gsm'),
(58, 'Photo Paper', 'Double sided Glossy', 'Quaff', 65, 160, 2, 0, '2024-01-09 00:54:20', '2024-01-09 01:44:36', 'per-piece', 'A4 220gsm'),
(59, 'Photo Paper', 'Double sided Glossy', 'Quaff', 78, 325, 3, 0, '2024-01-09 00:54:20', '2024-01-09 01:44:36', 'per-piece', 'A3 220gsm');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventories_id` bigint(20) UNSIGNED NOT NULL,
  `sold_to` varchar(255) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `inventories_id`, `sold_to`, `quantity`, `price`, `date`, `created_at`, `updated_at`) VALUES
(1, 37, 'Mark Laurence Quiambao', 1, 120, '2024-01-08', '2024-01-08 16:47:51', '2024-01-08 16:47:51'),
(2, 27, 'Eugene Dominguez', 2, 230, '2024-01-08', '2024-01-08 16:56:05', '2024-01-08 16:56:05'),
(3, 29, 'Eugene Dominguez', 2, 250, '2024-01-08', '2024-01-08 16:56:05', '2024-01-08 16:56:05'),
(4, 30, 'Eugene Dominguez', 1, 130, '2024-01-08', '2024-01-08 16:56:05', '2024-01-08 16:56:05');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_30_125150_create_inventories_table', 1),
(6, '2023_08_30_162732_add_count_column_to_inventories', 1),
(7, '2023_09_03_163115_create_invoices_table', 1),
(8, '2023_09_04_224646_create_transactions_table', 1),
(9, '2023_09_04_235126_create_rejecteds_table', 1),
(10, '2023_11_12_010755_create_reports_table', 1),
(11, '2023_11_12_211036_create_staff_table', 1),
(12, '2023_11_12_225239_create_attendances_table', 1),
(13, '2023_11_24_232850_add_status_to_staff', 1),
(14, '2023_11_24_234755_add_address_to_staff', 1),
(15, '2023_12_26_005810_add_present_to_staff', 1),
(16, '2024_01_08_143004_add_unit_type_to_inventories', 2);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rejecteds`
--

CREATE TABLE `rejecteds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_brand` varchar(255) DEFAULT NULL,
  `stocks` bigint(20) DEFAULT NULL,
  `product_pcs_price` double DEFAULT NULL,
  `product_pack_price` double DEFAULT NULL,
  `product_pcs_per_pack` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rejecteds`
--

INSERT INTO `rejecteds` (`id`, `product_type`, `product_name`, `product_brand`, `stocks`, `product_pcs_price`, `product_pack_price`, `product_pcs_per_pack`, `created_at`, `updated_at`, `description`) VALUES
(1, 'test', 'from 1', 'last', 23, 1, NULL, NULL, '2024-01-08 21:47:07', '2024-01-08 21:47:07', 'dwadwad');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `path`, `created_at`, `updated_at`) VALUES
(14, '339087.pdf', '2024-01-06 19:48:01', '2024-01-06 19:48:01'),
(15, '783529.pdf', '2024-01-07 14:09:52', '2024-01-07 14:09:52'),
(16, '590384.pdf', '2024-01-08 20:24:54', '2024-01-08 20:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `hired` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `address` varchar(255) NOT NULL,
  `present` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `middle_name`, `birthdate`, `gender`, `contact`, `hired`, `created_at`, `updated_at`, `status`, `address`, `present`) VALUES
(10, 'Von', 'Madrid', 'B', '1993-01-20', 'F', '09844694864', '2020-03-20', '2024-01-08 13:39:22', '2024-01-08 13:39:32', 1, 'Balanga', 1),
(11, 'Sajib', 'Milon', 'T', '1999-09-13', 'M', '09394912345', '2019-06-17', '2024-01-08 17:03:56', '2024-01-08 17:05:19', 1, 'Pto Rivas', 1),
(12, 'Aries', 'Madrid', 'C', '1971-02-14', 'M', '09464986690', '2015-09-11', '2024-01-08 17:07:27', '2024-01-08 17:07:27', 1, 'Orion', 0),
(13, 'Lyndon', 'Diaz', 'B', '2000-12-17', 'M', '09561833497', '2019-06-13', '2024-01-08 17:09:28', '2024-01-08 17:09:28', 1, 'Pto Rivas', 0),
(14, 'Gerald', 'Isidro', 'D', '2000-12-18', 'M', '9270316605', '2019-06-13', '2024-01-08 17:10:42', '2024-01-08 17:10:42', 1, 'Balanga', 0),
(15, 'Jason', 'Imperial', 'P', '2001-07-01', 'M', '0919568801', '2022-12-14', '2024-01-08 17:12:40', '2024-01-08 17:12:40', 1, 'upper tuyo', 0),
(16, 'Carl Laurence', 'Dominguez', 'Q', '2003-07-30', 'M', '09415542911', '2021-04-24', '2024-01-08 17:13:49', '2024-01-08 19:50:48', 1, 'upper tuyo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_description` varchar(255) NOT NULL,
  `date` date NOT NULL,
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
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'employee',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@email.com', 'administrator', '2023-12-29 01:34:50', '$2y$10$1/JLg.aIK3.rGTSM4h8e2edRsPYKeqdYnHJLbgsqnjRq/W775nWme', 'admin', 'aoTFbI0pcag4pKwV7Y2NTM6MizePKoYTUZwx051QGRYapiV8lzC7zrd07IR3', '2023-12-29 01:34:51', '2023-12-29 01:34:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_inventories_id_foreign` (`inventories_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rejecteds`
--
ALTER TABLE `rejecteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejecteds`
--
ALTER TABLE `rejecteds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_inventories_id_foreign` FOREIGN KEY (`inventories_id`) REFERENCES `inventories` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
