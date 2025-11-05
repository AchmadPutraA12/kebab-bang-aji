-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2025 at 12:38 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Semolowaru', 'Semolowaru, Kec. Kepulauan Tanimbar, Kabupat', '2025-08-16 04:18:43', '2025-08-16 04:18:43', NULL),
(2, 'Nginden', 'Nginden, Kec. Kepulauan Tanimbar, Kabupat', '2025-08-16 04:18:43', '2025-08-16 04:18:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_stocks`
--

CREATE TABLE `branch_stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch_stocks`
--

INSERT INTO `branch_stocks` (`id`, `product_id`, `branch_id`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 9, '2025-08-16 04:24:27', '2025-12-20 18:22:25', NULL),
(2, 2, 1, 5, '2025-08-16 04:24:34', '2025-12-20 18:22:25', NULL),
(3, 3, 1, 10, '2025-08-16 04:24:44', '2025-12-20 18:22:25', NULL),
(4, 4, 1, 8, '2025-08-16 04:24:56', '2025-12-20 18:22:25', NULL),
(5, 5, 1, 7, '2025-08-16 04:25:12', '2025-12-20 18:22:25', NULL),
(6, 6, 1, 4, '2025-08-16 04:25:21', '2025-12-20 18:22:25', NULL),
(7, 7, 1, 6, '2025-08-16 04:26:02', '2025-12-20 18:22:25', NULL),
(8, 8, 1, 3, '2025-08-16 04:26:09', '2025-12-20 18:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_admins`
--

CREATE TABLE `category_admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_admins`
--

INSERT INTO `category_admins` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2025-08-16 04:18:43', '2025-08-16 04:18:43', NULL),
(2, 'kasir', '2025-08-16 04:18:43', '2025-08-16 04:18:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_products`
--

INSERT INTO `category_products` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'makanan', '2025-08-16 04:19:33', '2025-08-16 04:19:33', NULL),
(2, 'minuman', '2025-08-16 04:19:38', '2025-08-16 04:19:38', NULL);

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
-- Table structure for table `history_stock_branches`
--

CREATE TABLE `history_stock_branches` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int NOT NULL,
  `product_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `user_id` int NOT NULL,
  `stock` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_stock_branches`
--

INSERT INTO `history_stock_branches` (`id`, `category_id`, `product_id`, `branch_id`, `user_id`, `stock`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 2, 20, 1, '2025-08-16 04:24:27', '2025-08-16 04:41:16', NULL),
(2, 1, 2, 1, 2, 20, 1, '2025-08-16 04:24:34', '2025-08-16 04:41:13', NULL),
(3, 1, 3, 1, 2, 20, 1, '2025-08-16 04:24:44', '2025-08-16 04:41:10', NULL),
(4, 1, 4, 1, 2, 20, 1, '2025-08-16 04:24:56', '2025-08-16 04:41:07', NULL),
(5, 1, 5, 1, 2, 20, 1, '2025-08-16 04:25:12', '2025-08-16 04:41:04', NULL),
(6, 1, 6, 1, 2, 20, 1, '2025-08-16 04:25:21', '2025-08-16 04:41:02', NULL),
(7, 1, 7, 1, 2, 20, 1, '2025-08-16 04:26:02', '2025-08-16 04:40:58', NULL),
(8, 1, 8, 1, 2, 20, 1, '2025-08-16 04:26:09', '2025-08-16 04:36:11', NULL),
(9, 1, 1, 1, 2, 20, 1, '2025-08-20 17:50:20', '2025-08-20 17:52:25', NULL),
(10, 1, 2, 1, 2, 20, 1, '2025-08-20 17:50:30', '2025-08-20 17:52:23', NULL),
(11, 1, 3, 1, 2, 20, 1, '2025-08-20 17:50:38', '2025-08-20 17:52:21', NULL),
(12, 1, 4, 1, 2, 20, 1, '2025-08-20 17:50:49', '2025-08-20 17:52:19', NULL),
(13, 1, 5, 1, 2, 20, 1, '2025-08-20 17:50:57', '2025-08-20 17:52:17', NULL),
(14, 1, 6, 1, 2, 20, 1, '2025-08-20 17:51:04', '2025-08-20 17:52:15', NULL),
(15, 1, 7, 1, 2, 20, 1, '2025-08-20 17:51:11', '2025-08-20 17:52:13', NULL),
(16, 1, 8, 1, 2, 20, 1, '2025-08-20 17:51:18', '2025-08-20 17:52:10', NULL),
(17, 1, 1, 1, 2, 50, 1, '2025-01-20 17:57:33', '2025-01-20 17:59:04', NULL),
(18, 1, 2, 1, 2, 50, 1, '2025-01-20 17:57:40', '2025-01-20 17:59:21', NULL),
(19, 1, 3, 1, 2, 50, 1, '2025-01-20 17:57:47', '2025-01-20 17:59:24', NULL),
(20, 1, 4, 1, 2, 50, 1, '2025-01-20 17:57:53', '2025-01-20 17:59:26', NULL),
(21, 1, 5, 1, 2, 50, 1, '2025-01-20 17:58:22', '2025-01-20 17:59:16', NULL),
(22, 1, 6, 1, 2, 50, 1, '2025-01-20 17:58:29', '2025-01-20 17:59:18', NULL),
(23, 1, 7, 1, 2, 50, 1, '2025-01-20 17:58:37', '2025-01-20 17:59:14', NULL),
(24, 1, 8, 1, 2, 50, 1, '2025-01-20 17:58:43', '2025-01-20 17:59:10', NULL),
(25, 1, 1, 1, 2, 20, 1, '2025-08-20 18:10:12', '2025-08-20 18:11:23', NULL),
(26, 1, 2, 1, 2, 20, 1, '2025-08-20 18:10:18', '2025-08-20 18:11:21', NULL),
(27, 1, 3, 1, 2, 20, 1, '2025-08-20 18:10:25', '2025-08-20 18:11:20', NULL),
(28, 1, 4, 1, 2, 20, 1, '2025-08-20 18:10:32', '2025-08-20 18:11:18', NULL),
(29, 1, 5, 1, 2, 20, 1, '2025-08-20 18:10:39', '2025-08-20 18:11:16', NULL),
(30, 1, 6, 1, 2, 20, 1, '2025-08-20 18:10:45', '2025-08-20 18:11:15', NULL),
(31, 1, 7, 1, 2, 20, 1, '2025-08-20 18:10:51', '2025-08-20 18:11:12', NULL),
(32, 1, 8, 1, 2, 20, 1, '2025-08-20 18:10:58', '2025-08-20 18:11:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_11_125203_create_category_admins_table', 1),
(5, '2025_05_12_033831_create_branches_table', 1),
(6, '2025_06_01_073314_create_category_products_table', 1),
(7, '2025_06_01_073429_create_products_table', 1),
(8, '2025_06_13_182220_create_branch_stocks_table', 1),
(9, '2025_07_04_200820_create_history_stock_branches_table', 1),
(10, '2025_07_11_225015_create_transactions_table', 1),
(11, '2025_07_11_225035_create_transaction_items_table', 1),
(12, '2025_07_26_054751_create_stock_recommendations_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `description`, `price`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kebab mini', 'kebab-mini', 'products/vDG5rsZusRvYqkfR3nlbCOnAhlKMQOMUkt8bAXgG.webp', 'kebab ukuran mini', 7000, 1, '2025-08-16 04:20:08', '2025-08-16 04:20:08', NULL),
(2, 'kebab XL', 'kebab-xl', 'products/vFUrMiGCIh6z6PNSO8ebnoAzGqyCWhf7YEyxabLi.jpg', 'kebab ukuran xl', 17000, 1, '2025-08-16 04:20:36', '2025-08-16 04:20:36', NULL),
(3, 'burger', 'burger', 'products/Nxtp5njoh8TpoPyhooY9cVAU7dLvV8s2zZWdjiFT.jpg', 'burger biasa', 10000, 1, '2025-08-16 04:21:19', '2025-08-16 04:21:19', NULL),
(4, 'super burger', 'super-burger', 'products/CbU5efInUIhLduzQLrQfnaQTKZ2nPFSGf54SKgm2.jpg', 'burger ukuran super', 12000, 1, '2025-08-16 04:21:47', '2025-08-16 04:21:47', NULL),
(5, 'hot dog', 'hot-dog', 'products/ZC9rVU7BhDij1hIIcmTSScPBSpnPOGX2uHdD7iJe.jpg', 'hotdog biasa', 10000, 1, '2025-08-16 04:22:18', '2025-08-16 04:22:18', NULL),
(6, 'Air Botol Mineral 600ML', 'air-botol-mineral-600ml', 'products/q54lG8zxEg0Wwcv5aNXfiYacxL8up6LsZAMzrXbw.webp', 'Air Botol Mineral 600ML', 4000, 2, '2025-08-16 04:22:51', '2025-08-16 04:22:51', NULL),
(7, 'Es Teh Manis', 'es-teh-manis', 'products/Y5uLkv4e0PBMzs5YIdAmcS4r9BiYGAcclUohpxP7.jpg', 'Es Teh Manis', 5000, 2, '2025-08-16 04:23:20', '2025-08-16 04:23:20', NULL),
(8, 'Teh Hangat Manis', 'teh-hangat-manis', 'products/w7WN8Q0pFzVhmPd2jo6524IPxBceTw8jFRysSvOn.jpg', 'Teh Hangat Manis', 4500, 2, '2025-08-16 04:23:42', '2025-08-16 04:23:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('693YzEOMeaHnxUOeizYHfGRjjQ12BqctgKdIpAtE', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidmVzbXFoU3RsQ0o3aUxQSDRMOVlNN0k2eFNuN1duOURHaHVjOGVqWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXNpciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1760983423),
('FC9QfiMebINjhAG5DcjBR18Wzft9d3a0R281GGvJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTFBNjhCYWFvcUY0MkVhcWFYbXg3WHB3eTk3SWs2eDRkd3UyeEdENSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1763662863),
('fha7JWnY6r8ncrAadvjiOoVm8YcC1itbZDYLALJg', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTVoQWpCbTNrcm43SFFoejJpdnN6dWliTDM0OEZybmRkSTUzaVpVcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXNpciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1766254947),
('nH23dQ7DHYrXagtrJ1Lr3cBNU9Lb0Nutua0XbBc1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVUU5bm1DemRjemNBcmtnS3BQb283RHdNNlZSVmllN3ZlTWJkM2F0MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZWNvbW1lbmRhdGlvbi1wcm9kdWN0LXN0b2NrIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1755716875),
('reZw91gblHNzURjLDcrdpqDo9TfBaRzlQaHWQN9t', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVZtRmFoY2RVWUpkbmNFU01JN3JwNHBJR09RTHNVU0Q3REJKWWpGMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXNpciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1758392392),
('t5KNFVqlaZf3xTNqciWEMQmow46xSxRW3Yc1s9UL', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkRmd0RyTTFLRVA1NEhZOUI2Zk1Ec20yMG45RlNocUVjZUlLZ01YZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXNpciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1766254909);

-- --------------------------------------------------------

--
-- Table structure for table `stock_recommendations`
--

CREATE TABLE `stock_recommendations` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `recommended_stock` int NOT NULL,
  `recommendation_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_recommendations`
--

INSERT INTO `stock_recommendations` (`id`, `product_id`, `branch_id`, `recommended_stock`, `recommendation_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(98, 1, 1, 3, '2025-08-01', '2025-08-20 18:24:51', '2025-08-20 18:24:51', NULL),
(99, 2, 1, 4, '2025-08-01', '2025-08-20 18:24:51', '2025-08-20 18:24:51', NULL),
(100, 3, 1, 4, '2025-08-01', '2025-08-20 18:24:51', '2025-08-20 18:24:51', NULL),
(101, 4, 1, 3, '2025-08-01', '2025-08-20 18:24:51', '2025-08-20 18:24:51', NULL),
(102, 5, 1, 3, '2025-08-01', '2025-08-20 18:24:52', '2025-08-20 18:24:52', NULL),
(103, 6, 1, 4, '2025-08-01', '2025-08-20 18:24:52', '2025-08-20 18:24:52', NULL),
(104, 7, 1, 4, '2025-08-01', '2025-08-20 18:24:52', '2025-08-20 18:24:52', NULL),
(105, 8, 1, 4, '2025-08-01', '2025-08-20 18:24:52', '2025-08-20 18:24:52', NULL),
(106, 1, 1, 3, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(107, 2, 1, 4, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(108, 3, 1, 3, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(109, 4, 1, 3, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(110, 5, 1, 4, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(111, 6, 1, 4, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(112, 7, 1, 3, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(113, 8, 1, 4, '2025-01-01', '2025-01-20 18:25:35', '2025-01-20 18:25:35', NULL),
(114, 1, 1, 4, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(115, 2, 1, 4, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(116, 3, 1, 3, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(117, 4, 1, 3, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(118, 5, 1, 5, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(119, 6, 1, 4, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(120, 7, 1, 4, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(121, 8, 1, 5, '2025-02-01', '2025-02-20 18:25:53', '2025-02-20 18:25:53', NULL),
(122, 1, 1, 3, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(123, 2, 1, 3, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(124, 3, 1, 3, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(125, 4, 1, 3, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(126, 5, 1, 4, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(127, 6, 1, 3, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(128, 7, 1, 4, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(129, 8, 1, 5, '2025-03-01', '2025-03-20 18:26:17', '2025-03-20 18:26:17', NULL),
(130, 1, 1, 3, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(131, 2, 1, 4, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(132, 3, 1, 4, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(133, 4, 1, 3, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(134, 5, 1, 3, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(135, 6, 1, 3, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(136, 7, 1, 4, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(137, 8, 1, 4, '2025-04-01', '2025-04-20 18:26:47', '2025-04-20 18:26:47', NULL),
(138, 1, 1, 3, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(139, 2, 1, 3, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(140, 3, 1, 4, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(141, 4, 1, 3, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(142, 5, 1, 3, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(143, 6, 1, 4, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(144, 7, 1, 4, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(145, 8, 1, 4, '2025-05-01', '2025-05-20 18:26:54', '2025-05-20 18:26:54', NULL),
(146, 1, 1, 3, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(147, 2, 1, 4, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(148, 3, 1, 4, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(149, 4, 1, 3, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(150, 5, 1, 3, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(151, 6, 1, 4, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(152, 7, 1, 4, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(153, 8, 1, 4, '2025-06-01', '2025-06-20 18:27:02', '2025-06-20 18:27:02', NULL),
(154, 1, 1, 4, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(155, 2, 1, 3, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(156, 3, 1, 4, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(157, 4, 1, 3, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(158, 5, 1, 3, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(159, 6, 1, 4, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(160, 7, 1, 5, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(161, 8, 1, 4, '2025-07-01', '2025-07-20 18:27:08', '2025-07-20 18:27:08', NULL),
(162, 1, 1, 4, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(163, 2, 1, 3, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(164, 3, 1, 4, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(165, 4, 1, 3, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(166, 5, 1, 2, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(167, 6, 1, 3, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(168, 7, 1, 4, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(169, 8, 1, 3, '2025-09-01', '2025-09-20 18:27:13', '2025-09-20 18:27:13', NULL),
(170, 1, 1, 4, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(171, 2, 1, 4, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(172, 3, 1, 4, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(173, 4, 1, 3, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(174, 5, 1, 3, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(175, 6, 1, 3, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(176, 7, 1, 3, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(177, 8, 1, 3, '2025-10-01', '2025-10-20 18:27:18', '2025-10-20 18:27:18', NULL),
(178, 1, 1, 4, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(179, 2, 1, 4, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(180, 3, 1, 4, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(181, 4, 1, 4, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(182, 5, 1, 3, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(183, 6, 1, 3, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(184, 7, 1, 3, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(185, 8, 1, 3, '2025-11-01', '2025-11-20 18:27:23', '2025-11-20 18:27:23', NULL),
(186, 1, 1, 4, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(187, 2, 1, 3, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(188, 3, 1, 3, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(189, 4, 1, 4, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(190, 5, 1, 3, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(191, 6, 1, 3, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(192, 7, 1, 3, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL),
(193, 8, 1, 3, '2025-12-01', '2025-12-20 18:27:28', '2025-12-20 18:27:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `subtotal` int NOT NULL,
  `tax` int NOT NULL DEFAULT '0',
  `total` int NOT NULL,
  `payment` int NOT NULL,
  `change` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `invoice_number`, `user_id`, `branch_id`, `subtotal`, `tax`, `total`, `payment`, `change`, `created_at`, `updated_at`, `deleted_at`) VALUES
(37, 'TRX-KASIR1-001-21102024-0111', 2, 1, 213500, 21350, 234850, 300000, 65150, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(38, 'TRX-KASIR1-001-21112024-0112', 2, 1, 227000, 22700, 249700, 300000, 50300, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(39, 'TRX-KASIR1-001-21122024-0113', 2, 1, 225000, 22500, 247500, 300000, 52500, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(40, 'TRX-KASIR1-001-21012025-0114', 2, 1, 259500, 25950, 285450, 300000, 14550, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(41, 'TRX-KASIR1-001-21022025-0116', 2, 1, 167000, 16700, 183700, 300000, 116300, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(42, 'TRX-KASIR1-001-21032025-0116', 2, 1, 225500, 22550, 248050, 300000, 51950, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(43, 'TRX-KASIR1-001-21042025-0117', 2, 1, 222500, 22250, 244750, 300000, 55250, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(44, 'TRX-KASIR1-001-21052025-0118', 2, 1, 253000, 25300, 278300, 300000, 21700, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(45, 'TRX-KASIR1-001-21062025-0118', 2, 1, 182000, 18200, 200200, 300000, 99800, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(46, 'TRX-KASIR1-001-21072025-0119', 2, 1, 196000, 19600, 215600, 300000, 84400, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(47, 'TRX-KASIR1-001-21082025-0119', 2, 1, 228500, 22850, 251350, 300000, 48650, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(48, 'TRX-KASIR1-001-21092025-0120', 2, 1, 198500, 19850, 218350, 300000, 81650, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(49, 'TRX-KASIR1-001-21102025-0120', 2, 1, 236000, 23600, 259600, 300000, 40400, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(50, 'TRX-KASIR1-001-21112025-0121', 2, 1, 187500, 18750, 206250, 300000, 93750, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(51, 'TRX-KASIR1-001-21122025-0122', 2, 1, 281000, 28100, 309100, 400000, 90900, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `product_name`, `price`, `qty`, `subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(201, 37, 1, 'kebab mini', 7000, 2, 14000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(202, 37, 2, 'kebab XL', 17000, 4, 68000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(203, 37, 3, 'burger', 10000, 3, 30000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(204, 37, 4, 'super burger', 12000, 3, 36000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(205, 37, 5, 'hot dog', 10000, 3, 30000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(206, 37, 6, 'Air Botol Mineral 600ML', 4000, 3, 12000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(207, 37, 7, 'Es Teh Manis', 5000, 2, 10000, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(208, 37, 8, 'Teh Hangat Manis', 4500, 3, 13500, '2024-10-20 18:11:55', '2024-10-20 18:11:55', NULL),
(209, 38, 1, 'kebab mini', 7000, 3, 21000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(210, 38, 2, 'kebab XL', 17000, 3, 51000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(211, 38, 3, 'burger', 10000, 2, 20000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(212, 38, 4, 'super burger', 12000, 3, 36000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(213, 38, 5, 'hot dog', 10000, 5, 50000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(214, 38, 6, 'Air Botol Mineral 600ML', 4000, 4, 16000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(215, 38, 7, 'Es Teh Manis', 5000, 3, 15000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(216, 38, 8, 'Teh Hangat Manis', 4500, 4, 18000, '2024-11-20 18:12:41', '2024-11-20 18:12:41', NULL),
(217, 39, 1, 'kebab mini', 7000, 4, 28000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(218, 39, 2, 'kebab XL', 17000, 3, 51000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(219, 39, 3, 'burger', 10000, 3, 30000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(220, 39, 4, 'super burger', 12000, 3, 36000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(221, 39, 5, 'hot dog', 10000, 3, 30000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(222, 39, 6, 'Air Botol Mineral 600ML', 4000, 3, 12000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(223, 39, 7, 'Es Teh Manis', 5000, 4, 20000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(224, 39, 8, 'Teh Hangat Manis', 4500, 4, 18000, '2024-12-20 18:13:37', '2024-12-20 18:13:37', NULL),
(225, 40, 1, 'kebab mini', 7000, 3, 21000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(226, 40, 2, 'kebab XL', 17000, 4, 68000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(227, 40, 3, 'burger', 10000, 3, 30000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(228, 40, 4, 'super burger', 12000, 3, 36000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(229, 40, 5, 'hot dog', 10000, 5, 50000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(230, 40, 6, 'Air Botol Mineral 600ML', 4000, 3, 12000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(231, 40, 7, 'Es Teh Manis', 5000, 4, 20000, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(232, 40, 8, 'Teh Hangat Manis', 4500, 5, 22500, '2025-01-20 18:14:39', '2025-01-20 18:14:39', NULL),
(233, 41, 1, 'kebab mini', 7000, 2, 14000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(234, 41, 2, 'kebab XL', 17000, 2, 34000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(235, 41, 3, 'burger', 10000, 3, 30000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(236, 41, 4, 'super burger', 12000, 2, 24000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(237, 41, 5, 'hot dog', 10000, 2, 20000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(238, 41, 6, 'Air Botol Mineral 600ML', 4000, 3, 12000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(239, 41, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(240, 41, 8, 'Teh Hangat Manis', 4500, 4, 18000, '2025-02-20 18:16:00', '2025-02-20 18:16:00', NULL),
(241, 42, 1, 'kebab mini', 7000, 3, 21000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(242, 42, 2, 'kebab XL', 17000, 4, 68000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(243, 42, 3, 'burger', 10000, 4, 40000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(244, 42, 4, 'super burger', 12000, 3, 36000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(245, 42, 5, 'hot dog', 10000, 2, 20000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(246, 42, 6, 'Air Botol Mineral 600ML', 4000, 3, 12000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(247, 42, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(248, 42, 8, 'Teh Hangat Manis', 4500, 3, 13500, '2025-03-20 18:16:42', '2025-03-20 18:16:42', NULL),
(249, 43, 1, 'kebab mini', 7000, 3, 21000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(250, 43, 2, 'kebab XL', 17000, 3, 51000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(251, 43, 3, 'burger', 10000, 3, 30000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(252, 43, 4, 'super burger', 12000, 3, 36000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(253, 43, 5, 'hot dog', 10000, 3, 30000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(254, 43, 6, 'Air Botol Mineral 600ML', 4000, 4, 16000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(255, 43, 7, 'Es Teh Manis', 5000, 5, 25000, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(256, 43, 8, 'Teh Hangat Manis', 4500, 3, 13500, '2025-04-20 18:17:40', '2025-04-20 18:17:40', NULL),
(257, 44, 1, 'kebab mini', 7000, 3, 21000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(258, 44, 2, 'kebab XL', 17000, 4, 68000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(259, 44, 3, 'burger', 10000, 4, 40000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(260, 44, 4, 'super burger', 12000, 3, 36000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(261, 44, 5, 'hot dog', 10000, 3, 30000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(262, 44, 6, 'Air Botol Mineral 600ML', 4000, 5, 20000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(263, 44, 7, 'Es Teh Manis', 5000, 4, 20000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(264, 44, 8, 'Teh Hangat Manis', 4500, 4, 18000, '2025-05-20 18:18:06', '2025-05-20 18:18:06', NULL),
(265, 45, 1, 'kebab mini', 7000, 4, 28000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(266, 45, 2, 'kebab XL', 17000, 2, 34000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(267, 45, 3, 'burger', 10000, 3, 30000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(268, 45, 4, 'super burger', 12000, 2, 24000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(269, 45, 5, 'hot dog', 10000, 2, 20000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(270, 45, 6, 'Air Botol Mineral 600ML', 4000, 2, 8000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(271, 45, 7, 'Es Teh Manis', 5000, 4, 20000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(272, 45, 8, 'Teh Hangat Manis', 4500, 4, 18000, '2025-06-20 18:18:37', '2025-06-20 18:18:37', NULL),
(273, 46, 1, 'kebab mini', 7000, 2, 14000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(274, 46, 2, 'kebab XL', 17000, 4, 68000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(275, 46, 3, 'burger', 10000, 3, 30000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(276, 46, 4, 'super burger', 12000, 2, 24000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(277, 46, 5, 'hot dog', 10000, 2, 20000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(278, 46, 6, 'Air Botol Mineral 600ML', 4000, 4, 16000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(279, 46, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(280, 46, 8, 'Teh Hangat Manis', 4500, 2, 9000, '2025-07-20 18:19:03', '2025-07-20 18:19:03', NULL),
(281, 47, 1, 'kebab mini', 7000, 5, 35000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(282, 47, 2, 'kebab XL', 17000, 3, 51000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(283, 47, 3, 'burger', 10000, 5, 50000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(284, 47, 4, 'super burger', 12000, 3, 36000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(285, 47, 5, 'hot dog', 10000, 2, 20000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(286, 47, 6, 'Air Botol Mineral 600ML', 4000, 2, 8000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(287, 47, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(288, 47, 8, 'Teh Hangat Manis', 4500, 3, 13500, '2025-08-20 18:19:40', '2025-08-20 18:19:40', NULL),
(289, 48, 1, 'kebab mini', 7000, 3, 21000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(290, 48, 2, 'kebab XL', 17000, 3, 51000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(291, 48, 3, 'burger', 10000, 2, 20000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(292, 48, 4, 'super burger', 12000, 3, 36000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(293, 48, 5, 'hot dog', 10000, 3, 30000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(294, 48, 6, 'Air Botol Mineral 600ML', 4000, 3, 12000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(295, 48, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(296, 48, 8, 'Teh Hangat Manis', 4500, 3, 13500, '2025-09-20 18:20:31', '2025-09-20 18:20:31', NULL),
(297, 49, 1, 'kebab mini', 7000, 4, 28000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(298, 49, 2, 'kebab XL', 17000, 4, 68000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(299, 49, 3, 'burger', 10000, 3, 30000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(300, 49, 4, 'super burger', 12000, 4, 48000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(301, 49, 5, 'hot dog', 10000, 3, 30000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(302, 49, 6, 'Air Botol Mineral 600ML', 4000, 2, 8000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(303, 49, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(304, 49, 8, 'Teh Hangat Manis', 4500, 2, 9000, '2025-10-20 18:20:56', '2025-10-20 18:20:56', NULL),
(305, 50, 1, 'kebab mini', 7000, 3, 21000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(306, 50, 2, 'kebab XL', 17000, 2, 34000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(307, 50, 3, 'burger', 10000, 4, 40000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(308, 50, 4, 'super burger', 12000, 3, 36000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(309, 50, 5, 'hot dog', 10000, 2, 20000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(310, 50, 6, 'Air Botol Mineral 600ML', 4000, 2, 8000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(311, 50, 7, 'Es Teh Manis', 5000, 3, 15000, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(312, 50, 8, 'Teh Hangat Manis', 4500, 3, 13500, '2025-11-20 18:21:36', '2025-11-20 18:21:36', NULL),
(313, 51, 1, 'kebab mini', 7000, 3, 21000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(314, 51, 2, 'kebab XL', 17000, 4, 68000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(315, 51, 3, 'burger', 10000, 4, 40000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(316, 51, 4, 'super burger', 12000, 4, 48000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(317, 51, 5, 'hot dog', 10000, 5, 50000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(318, 51, 6, 'Air Botol Mineral 600ML', 4000, 4, 16000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(319, 51, 7, 'Es Teh Manis', 5000, 4, 20000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL),
(320, 51, 8, 'Teh Hangat Manis', 4500, 4, 18000, '2025-12-20 18:22:25', '2025-12-20 18:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `category_id`, `branch_id`, `email_verified_at`, `password`, `is_active`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 1, NULL, NULL, '$2y$12$KkMihUAq/vt3Qwv2ZchDy.NZuUxv3lYrXO1hP.rTTKS5KjBthq4S.', 1, NULL, NULL, '2025-08-16 04:18:43', '2025-08-16 04:18:43'),
(2, 'Kasir1', 'kasir1@gmail.com', 'kasir1', 2, 1, NULL, '$2y$12$DMHGXHqAMc4sIrYt.F1o3.JbgQJzA99r/UdrrkSQowC5UPHSwMcxi', 1, NULL, NULL, '2025-08-16 04:18:43', '2025-08-16 04:18:43'),
(3, 'Kasir2', 'kasir2@gmail.com', 'kasir2', 2, 2, NULL, '$2y$12$Ni/RznLiZ9pcqpJWLe.DV.TFI8VL4Mcgzv6Wen3uUHF6EM/062NS.', 1, NULL, NULL, '2025-08-16 04:18:43', '2025-08-16 04:19:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_stocks`
--
ALTER TABLE `branch_stocks`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `category_admins`
--
ALTER TABLE `category_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_stock_branches`
--
ALTER TABLE `history_stock_branches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_recommendations`
--
ALTER TABLE `stock_recommendations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_invoice_number_unique` (`invoice_number`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branch_stocks`
--
ALTER TABLE `branch_stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_admins`
--
ALTER TABLE `category_admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_stock_branches`
--
ALTER TABLE `history_stock_branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_recommendations`
--
ALTER TABLE `stock_recommendations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
