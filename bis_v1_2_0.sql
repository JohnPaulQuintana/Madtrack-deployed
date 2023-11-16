-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 07:23 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bis_v1.2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `day` int(10) UNSIGNED NOT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `time_in`, `day`, `month`, `year`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, '2023-09-01 19:30:56', 1, 9, 2023, 'present', '2023-09-01 19:30:56', '2023-09-01 19:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stocks` int(10) UNSIGNED NOT NULL,
  `product_pcs_price` double DEFAULT NULL,
  `product_pack_price` double DEFAULT NULL,
  `product_pcs_per_pack` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_type`, `product_name`, `product_brand`, `stocks`, `product_pcs_price`, `product_pack_price`, `product_pcs_per_pack`, `created_at`, `updated_at`) VALUES
(1, 'Sticker', 'Vinyl Sticker Glossy A3', 'I-TECH', 1, 33, 300, 5, '2023-09-02 01:41:58', '2023-09-05 19:15:37'),
(2, 'Stickers', 'Vinyl Sticker Glossy A4', 'QUAFF', 0, 12, 74, 12, '2023-09-03 19:53:46', '2023-09-05 16:48:35'),
(3, 'Stickers', 'Vinyl Sticker Glossy A5', 'QUAFF', 5, 5, 10, 10, '2023-09-04 15:22:42', '2023-09-05 02:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventories_id` bigint(20) UNSIGNED NOT NULL,
  `sold_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, 2, 'John Paul Quintana', 5, 60, '2023-09-04', '2023-09-05 02:01:52', '2023-09-05 02:01:52'),
(10, 2, 'John Paul Quintana', 5, 60, '2023-09-04', '2023-09-05 02:02:16', '2023-09-05 02:02:16'),
(11, 2, 'John Paul Quintana', 5, 60, '2023-09-04', '2023-09-05 02:03:07', '2023-09-05 02:03:07'),
(12, 3, 'John Paul Quintana', 5, 25, '2023-09-03', '2023-09-05 02:05:59', '2023-09-05 02:05:59'),
(13, 1, 'John Paul Quintana', 1, 33, '2023-09-04', '2023-09-05 02:11:32', '2023-09-05 02:11:32'),
(14, 2, 'John Paul Quintana', 10, 500, '2023-08-02', '2023-09-05 02:24:38', '2023-09-05 02:24:38'),
(15, 3, 'John Paul Quintana', 10, 50, '2023-09-04', '2023-09-05 02:24:39', '2023-09-05 02:24:39'),
(16, 1, 'John Paul Quintana', 3, 99, '2023-09-05', '2023-09-05 15:11:44', '2023-09-05 15:11:44'),
(17, 2, 'John Paul Quintana', 1, 12, '2023-09-05', '2023-09-05 16:48:35', '2023-09-05 16:48:35'),
(18, 1, 'John Paul Quintana', 5, 165, '2023-09-05', '2023-09-05 19:15:37', '2023-09-05 19:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2023_08_29_072344_create_employees_table', 1),
(6, '2023_08_30_125150_create_inventories_table', 1),
(7, '2023_08_30_162732_add_count_column_to_inventories', 1),
(8, '2023_09_01_153425_add_column_to_employees_table', 1),
(9, '2023_09_03_163115_create_invoices_table', 2),
(10, '2023_09_04_224646_create_transactions_table', 3),
(11, '2023_09_04_235126_create_rejecteds_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stocks` bigint(20) NOT NULL,
  `product_pcs_price` double DEFAULT NULL,
  `product_pack_price` double DEFAULT NULL,
  `product_pcs_per_pack` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rejecteds`
--

INSERT INTO `rejecteds` (`id`, `product_type`, `product_name`, `product_brand`, `stocks`, `product_pcs_price`, `product_pack_price`, `product_pcs_per_pack`, `created_at`, `updated_at`) VALUES
(1, 'Sticker', 'Vinyl Sticker Glossy A4', 'I-TECH', 1, 6, 9, 7, '2023-09-05 03:05:26', '2023-09-05 03:05:26'),
(2, 'Stickers', 'Vinyl Sticker Transparent A4', 'QUAFF', 13, 10, 59, 3, '2023-09-05 03:05:26', '2023-09-05 03:05:26'),
(3, 'Sticker', 'Vinyl Sticker Glossy A3', 'QUAFF', 7, 6, 10, 10, '2023-09-05 16:49:39', '2023-09-05 16:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `transaction_type`, `transaction_description`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'invoice', 'John Paul Quintana bought 1 units of Vinyl Sticker Glossy A3 at 33 each.', '2023-09-04', '2023-09-05 02:11:32', '2023-09-05 02:11:32'),
(2, 2, 'invoice', 'John Paul Quintana bought 10 units of Vinyl Sticker Glossy A4 at 12 each.', '2023-09-04', '2023-09-05 02:24:39', '2023-09-05 02:24:39'),
(3, 3, 'invoice', 'John Paul Quintana bought 10 units of Vinyl Sticker Glossy A5 at 5 each.', '2023-09-04', '2023-09-05 02:24:39', '2023-09-05 02:24:39'),
(4, 1, 'invoice', 'John Paul Quintana bought 3 units of Vinyl Sticker Glossy A3 at 33 each.', '2023-09-05', '2023-09-05 15:11:44', '2023-09-05 15:11:44'),
(5, 2, 'invoice', 'John Paul Quintana bought 1 units of Vinyl Sticker Glossy A4 at 12 each.', '2023-09-05', '2023-09-05 16:48:35', '2023-09-05 16:48:35'),
(6, 1, 'invoice', 'John Paul Quintana bought 5 units of Vinyl Sticker Glossy A3 at 33 each.', '2023-09-05', '2023-09-05 19:15:37', '2023-09-05 19:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@email.com', 'administrator', '2023-09-01 18:45:04', '$2y$10$PMU3vAiEjBIqJq8MSDOLmuHD.OpeLYMwre/n5VIeTDkvDWxOCiMlO', 'admin', '5vj4z7JGPqiWyAlfslWx5mduFA0QVUjvw1pMiTyIvpW8oCCbTtWqJlq5MXpZ', '2023-09-01 18:45:04', '2023-09-01 18:45:04'),
(2, 'jaypee', 'ad.east2021@gmail.com', 'eastwoods', '2023-09-01 19:29:11', '$2y$10$kGwC95MsmmWhdbcMBZQ.de1Os2iDl.KkjHmUy/fpJIXCemSHNjTwe', 'employee', NULL, '2023-09-01 19:28:47', '2023-09-01 19:29:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_employee_id_foreign` (`employee_id`);

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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejecteds`
--
ALTER TABLE `rejecteds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

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
