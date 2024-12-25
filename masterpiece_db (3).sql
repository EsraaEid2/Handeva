-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 11:24 PM
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
-- Database: `masterpiece_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Necklaces', '', '', '2024-12-21 17:56:22', '2024-12-21 17:56:22', NULL),
(2, 'Earrings', '', '', '2024-12-21 17:56:22', '2024-12-21 17:56:22', NULL),
(3, 'Bracelets', '', '', '2024-12-21 17:56:22', '2024-12-21 17:56:22', NULL),
(4, 'Rings', '', '', '2024-12-21 17:56:22', '2024-12-21 17:56:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `subject`, `message`, `created_at`, `updated_at`, `is_read`) VALUES
(1, 1, 'Issue with order #1', 'I am facing an issue with my order #1, please help.', '2024-12-21 18:04:05', '2024-12-21 18:04:05', 0),
(2, 2, 'Product Inquiry', 'Is this product customizable?', '2024-12-21 18:04:05', '2024-12-21 18:04:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customization_options`
--

CREATE TABLE `customization_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_customization_id` bigint(20) UNSIGNED NOT NULL,
  `option_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customization_options`
--

INSERT INTO `customization_options` (`id`, `product_customization_id`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', NULL, NULL);

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
(112, '2014_10_12_000000_create_users_table', 1),
(113, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(114, '2014_10_12_100000_create_password_resets_table', 1),
(115, '2019_08_19_000000_create_failed_jobs_table', 1),
(116, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(117, '2024_11_19_173149_add_role_to_users_table', 1),
(118, '2024_11_20_124405_create_categories_table', 1),
(119, '2024_11_21_071823_create_contact_us_table', 1),
(120, '2024_11_21_132031_create_roles_table', 1),
(121, '2024_11_21_135011_modify_users_table', 1),
(122, '2024_11_21_163448_create_vendors_table', 1),
(123, '2024_11_21_165754_create_products_table', 1),
(124, '2024_11_21_170032_create_product_images', 1),
(125, '2024_11_21_204804_create_wishlists_table', 1),
(126, '2024_11_21_210244_create_reviews_table', 1),
(127, '2024_11_21_213651_create_orders_table', 1),
(128, '2024_11_21_215156_create_order_items_table', 1),
(129, '2024_11_24_073454_add_is_read_to_contact_us_table', 1),
(130, '2024_11_25_030157_modify_orders_table', 1),
(131, '2024_11_25_030831_modify_order_items_table', 1),
(132, '2024_11_26_071259_add_deleted_at_to_reviews_table', 1),
(133, '2024_11_26_073057_add_rejected_to_reviews_status_enum', 1),
(134, '2024_11_30_191450_create_product_customization_table', 1),
(135, '2024_11_30_191707_create_customization_options_table', 1),
(136, '2024_12_19_113504_add_is_pending_vendor_to_users_table', 1),
(137, '2024_12_21_172128_add_status_to_product_customizations_and_customization_id_to_order_items', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`, `updated_at`, `notes`, `deleted_at`) VALUES
(1, 1, 100.00, 'pending', '2024-12-21 18:03:09', '2024-12-21 18:03:09', NULL, NULL),
(2, 2, 50.00, '', '2024-12-21 18:03:09', '2024-12-21 18:03:09', NULL, NULL),
(3, 16, 24.00, 'pending', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_at_time` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customization_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_time`, `total_price`, `created_at`, `updated_at`, `customization_id`) VALUES
(1, 1, 1, 2, 0.00, 0.00, '2024-12-21 18:03:28', '2024-12-21 18:03:28', NULL),
(2, 1, 2, 1, 0.00, 0.00, '2024-12-21 18:03:28', '2024-12-21 18:03:28', NULL),
(3, 2, 3, 3, 0.00, 0.00, '2024-12-21 18:03:28', '2024-12-21 18:03:28', NULL),
(4, 2, 4, 1, 0.00, 0.00, '2024-12-21 18:03:28', '2024-12-21 18:03:28', NULL),
(6, 3, 5, 5, 24.00, 24.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `is_traditional` tinyint(1) NOT NULL DEFAULT 0,
  `is_customizable` tinyint(1) NOT NULL DEFAULT 0,
  `price_after_discount` decimal(10,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','ready','shipped') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `category_id`, `stock_quantity`, `vendor_id`, `is_visible`, `is_traditional`, `is_customizable`, `price_after_discount`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Gold Necklace', 'A beautiful gold necklace with intricate designs', 50.00, 1, 10, 1, 1, 0, 1, 45.00, NULL, '2024-12-21 18:02:37', '2024-12-21 18:02:37', 'pending'),
(2, 'Silver Earrings', 'Elegant silver earrings suitable for all occasions', 30.00, 2, 15, 2, 1, 0, 0, 30.00, NULL, '2024-12-21 18:02:37', '2024-12-21 18:02:37', 'pending'),
(3, 'Leather Bracelet', 'Stylish leather bracelet for men', 20.00, 3, 20, 1, 1, 1, 1, 8.00, NULL, '2024-12-21 18:02:37', '2024-12-21 18:02:37', 'pending'),
(4, 'Diamond Ring', 'Exquisite diamond ring for special occasions', 200.00, 4, 5, 2, 1, 1, 0, 10.00, NULL, '2024-12-21 18:02:37', '2024-12-21 18:02:37', 'pending'),
(5, 'Golden Pendant Necklace', 'A luxurious handmade golden necklace perfect for any special occasion.', 24.00, 1, 12, 7, 1, 0, 0, NULL, NULL, '2024-12-22 18:10:45', '2024-12-23 04:45:52', 'pending'),
(6, 'Sit soluta sequi is', 'Ex quis aut nulla ma', 918.00, 1, 697, 7, 1, 1, 1, 20.00, NULL, '2024-12-23 04:52:42', '2024-12-23 04:52:42', 'pending'),
(7, 'Ex ipsum et quae con', 'Voluptas quia vero l', 961.00, 1, 505, 7, 1, 1, 1, 509.33, NULL, '2024-12-23 06:43:15', '2024-12-23 06:43:15', 'pending'),
(8, 'Ex ipsum et quae con', 'Voluptas quia vero l', 961.00, 1, 505, 7, 1, 1, 1, 509.33, NULL, '2024-12-23 06:46:35', '2024-12-23 06:46:35', 'pending'),
(9, 'Ex ipsum et quae con', 'Voluptas quia vero l', 961.00, 1, 505, 7, 1, 1, 1, 509.33, NULL, '2024-12-23 06:47:06', '2024-12-23 06:47:06', 'pending'),
(10, 'Ex ipsum et quae con', 'Voluptas quia vero l', 961.00, 1, 505, 7, 1, 1, 1, 509.33, NULL, '2024-12-23 06:48:22', '2024-12-23 06:48:22', 'pending'),
(11, 'Ex ipsum et quae con', 'Voluptas quia vero l', 961.00, 1, 505, 7, 1, 1, 1, 509.33, NULL, '2024-12-23 06:48:37', '2024-12-23 06:48:37', 'pending'),
(12, 'Ex ipsum et quae con', 'Voluptas quia vero l', 961.00, 1, 505, 7, 1, 1, 1, 509.33, NULL, '2024-12-23 06:50:10', '2024-12-23 06:50:10', 'pending'),
(13, 'Dolor lorem corrupti', 'Fugiat et reiciendis', 469.00, 1, 451, 7, 1, 1, 0, 286.09, NULL, '2024-12-23 06:50:22', '2024-12-23 06:50:22', 'pending'),
(14, 'Quis irure non eos m', 'Culpa nemo labore si', 28.00, 1, 87, 7, 1, 1, 1, 26.88, NULL, '2024-12-23 09:36:25', '2024-12-23 09:36:25', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product_customization`
--

CREATE TABLE `product_customization` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `custom_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_customization`
--

INSERT INTO `product_customization` (`id`, `product_id`, `custom_type`, `created_at`, `updated_at`) VALUES
(1, 5, 'Select a letter', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 5, 'https://cdn0.rubylane.com/shops/yifataharoni/SGP-1.1L.jpg?4', 1, '2024-12-22 18:10:45', '2024-12-22 18:10:45'),
(2, 6, 'product_images/cNm9xylMRtorgi8H4qxkr7jZGenzrtcjF1f4BJc3.jpg', 0, '2024-12-23 04:52:42', '2024-12-23 04:52:42'),
(3, 7, 'product_images/qkFcYQ5Wq0Qyh5Vl2rEuRZANSiRKmS1ghNLhCEVL.jpg', 1, '2024-12-23 06:43:16', '2024-12-23 06:43:16'),
(4, 11, 'product_images/eF5TzK7QRBS597vlniOO6OkruRcDcJkWg5BQSxyq.jpg', 1, '2024-12-23 06:48:37', '2024-12-23 06:48:37'),
(5, 12, 'product_images/1A71dTk3FO1AHr68Nd56k5S3EaqD4JiPpen1hMKG.jpg', 1, '2024-12-23 06:50:10', '2024-12-23 06:50:10'),
(6, 13, 'product_images/q3x9y35H2AKw2Cof7lqPlVfymMYZbMCZEU38Vnx5.jpg', 1, '2024-12-23 06:50:22', '2024-12-23 06:50:22'),
(7, 14, 'product_images/eyBOiVmul2Acvmj8jmAUBo67yaBK7CEvs1LzIEhq.jpg', 1, '2024-12-23 09:36:25', '2024-12-23 09:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '5', 'Excellent quality necklace!', 'pending', '2024-12-21 18:03:40', '2024-12-21 18:03:40', NULL),
(2, 2, 2, '4', 'Beautiful earrings, but a bit small.', 'pending', '2024-12-21 18:03:40', '2024-12-21 18:03:40', NULL),
(3, 5, 16, '5', 'Nice!!', 'pending', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_type` enum('customer','vendor','admin') NOT NULL DEFAULT 'customer' COMMENT 'customer, vendor, admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_type`, `created_at`, `updated_at`) VALUES
(1, 'customer', '2024-12-21 14:50:47', '2024-12-21 14:50:47'),
(2, 'vendor', '2024-12-21 14:50:47', '2024-12-21 14:50:47'),
(3, 'admin', '2024-12-21 14:50:47', '2024-12-21 14:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `is_pending_vendor` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `age` int(11) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `first_name`, `last_name`, `role_id`, `is_pending_vendor`, `address`, `phone_number`, `is_deleted`, `age`, `points`) VALUES
(1, 'ahmed@example.com', NULL, 'password123', NULL, '2024-12-21 17:56:08', '2024-12-21 17:56:08', 0, 'Ahmed', 'Ali', 1, 0, NULL, NULL, 0, NULL, 0),
(2, 'sara@example.com', NULL, 'password123', NULL, '2024-12-21 17:56:08', '2024-12-21 17:56:08', 0, 'Sara', 'Khaled', 1, 0, NULL, NULL, 0, NULL, 0),
(3, 'zuguhelali@mailinator.com', NULL, '$2y$12$M8RsyUekWIBxEd7eypbdPO8oyap60vSrQrq0ZV09MfI0IO1ok0NSm', NULL, '2024-12-21 15:05:07', '2024-12-21 15:05:07', 0, 'Calista', 'Norman', 2, 0, NULL, NULL, 0, NULL, 0),
(4, 'lukega@mailinator.com', NULL, '$2y$12$8A08IY4wCVZ/OBs.1ydrT.nGauw.KtZh6sLEDliZYUU3hgfbh5A2m', NULL, '2024-12-21 16:31:54', '2024-12-21 16:31:54', 0, 'Shana', 'Mcclain', 1, 0, NULL, NULL, 0, NULL, 0),
(5, 'fijil@mailinator.com', NULL, '$2y$12$IQQLfv6qsNRwfbZubg.GzuUM9YhWBSxe41sc9buTOkYlzfo.RAVu2', NULL, '2024-12-21 16:41:35', '2024-12-21 16:41:35', 0, 'Deborah', 'Lawrence', 1, 1, NULL, NULL, 0, NULL, 0),
(6, 'tuguzalol@mailinator.com', NULL, '$2y$12$ztxBxdYAX8fLvuivflbISupCiFaMYLS7PQAssVCU6FvGYy2/.UkJe', NULL, '2024-12-21 16:53:23', '2024-12-21 16:53:23', 0, 'Shaeleigh', 'Cote', 1, 0, NULL, NULL, 0, NULL, 0),
(7, 'tester@gmail.com', NULL, '$2y$12$t7XMDAhan8D6icFgTQKCJeW1xEJCtQdNn3DudvFoZ8HoE62Fp4Go6', NULL, '2024-12-21 16:53:59', '2024-12-21 16:53:59', 0, 'Tester', 'tester', 1, 0, NULL, NULL, 0, NULL, 0),
(8, 'lokide@mailinator.com', NULL, '$2y$12$zEPgSMYZdWxBPadiTEvD4.7Fp3XErhrPMBJBLCccLdnewT/qnWyRq', NULL, '2024-12-22 06:59:28', '2024-12-22 06:59:28', 0, 'Gretchen', 'Daniels', 1, 0, NULL, NULL, 0, NULL, 0),
(9, 'qytidura@mailinator.com', NULL, '$2y$12$ogK/Ju8WwcJ/Lg.CCii.eegG503xVj70Kxy3gs9QpwxPhsaQa9AAe', NULL, '2024-12-22 08:01:51', '2024-12-22 08:01:51', 0, 'Sebastian', 'Gay', 1, 1, NULL, NULL, 0, NULL, 0),
(10, 'vikyvysywe@mailinator.com', NULL, '$2y$12$ZDBu.8jLg3YIX90EevWN2OH3Q0/a578sOmLfP.e7PaSKyxODxGcbi', NULL, '2024-12-22 09:12:04', '2024-12-22 09:12:04', 0, 'Wylie', 'Copeland', 1, 1, NULL, NULL, 0, NULL, 0),
(11, 'mugo@mailinator.com', NULL, '$2y$12$f4E5woTDhwbRHXjdhXUHSedLf9aLs6AS1fhi8nMviYjVhZ9qhK0/O', NULL, '2024-12-22 09:12:34', '2024-12-22 09:12:34', 0, 'Dillon', 'Bauer', 1, 1, NULL, NULL, 0, NULL, 0),
(12, 'hewevygo@mailinator.com', NULL, '$2y$12$ceCNApHFUDL.HXdawMgxPeme5VprNC9zCEnBe4TkLXVrFSfHVMMdK', NULL, '2024-12-22 09:31:02', '2024-12-22 09:31:02', 0, 'Alfreda', 'Hudson', 2, 1, NULL, NULL, 0, NULL, 0),
(13, 'tidajilem@mailinator.com', NULL, '$2y$12$/YFp/mXFmnUVtTTvrM5NIebircO/IC4qEvxDA64TV66hiwle1ZNTu', NULL, '2024-12-22 10:16:20', '2024-12-22 10:16:20', 0, 'Whoopi', 'Glover', 1, 0, NULL, NULL, 0, NULL, 0),
(14, 'kixumaf@mailinator.com', NULL, '$2y$12$hrpgnB.3mYxZ0yCwFRJrYeVi9d.u9Cs0OXZwNeINKX0ADxq1AkbGW', NULL, '2024-12-22 15:37:39', '2024-12-22 15:37:39', 0, 'Darryl', 'Sellers', 1, 0, NULL, NULL, 0, NULL, 0),
(15, 'admin@gmail.com', NULL, '$2y$12$BinhfuLOQbgqbM1.K9MgW.hn4gL6Hpo0UPj5T/ff6d/1hthmc.Cym', NULL, '2024-12-22 17:24:40', '2024-12-22 17:24:40', 0, 'admin', 'eid', 3, 0, NULL, NULL, 0, NULL, 0),
(16, 'esraa.eid@gmail.com', NULL, '$2y$12$.OdqgcE8yq/00dh.wp6ZTO2RmudNkaRafMD80HW.TfI4fiFhvZIQm', NULL, '2024-12-22 18:06:22', '2024-12-22 18:06:22', 0, 'Esra\'a', 'Eid', 2, 1, NULL, NULL, 0, NULL, 0),
(17, 'jwana@gmail.com', NULL, '$2y$12$wkEswc7FUH5ruUOPAPAXy.fhc6zzLaKRgN6CEv1qIK4TgDCiUi4hm', NULL, '2024-12-23 04:48:22', '2024-12-23 04:48:22', 0, 'Jwana', 'Eid', 1, 0, NULL, NULL, 0, NULL, 0),
(18, 'qawyk@mailinator.com', NULL, '$2y$12$8WDSazxPBnkVfLc/SrfU6.PQ4X9XfH36nHFGWz7L.keVxzt9w9fYC', NULL, '2024-12-23 05:00:40', '2024-12-23 05:00:40', 0, 'Chandler', 'Holland', 1, 0, NULL, NULL, 0, NULL, 0),
(19, 'vupafo@mailinator.com', NULL, '$2y$12$MX2xAAJ1YY/PJF66TKBkeuRqgPZdll7w2O8yUzlxiJn3y1K1wdFwK', NULL, '2024-12-23 05:00:54', '2024-12-23 05:00:54', 0, 'Nehru', 'Walsh', 1, 0, NULL, NULL, 0, NULL, 0),
(20, 'kygukuby@mailinator.com', NULL, '$2y$12$AHAJsT6RPH/7x5n7qIiqbeCT//z8gXlCZ.cfiwi2JVty5lD5GuRoe', NULL, '2024-12-23 05:01:21', '2024-12-23 05:01:21', 0, 'Carter', 'Murray', 1, 0, NULL, NULL, 0, NULL, 0),
(21, 'esadmin@gmail.com', NULL, '$2y$12$KKR2LBBCdz3fthy3MzE3SesqK45luuH7hMyotSm7D6pDHQNGA708.', NULL, '2024-12-23 17:39:19', '2024-12-23 17:39:19', 0, 'Esra\'a', 'Admin', 3, 0, NULL, NULL, 0, NULL, 0),
(22, 'xeqycij@mailinator.com', NULL, '$2y$12$oz8TjslaxNvD5g3eN.zeJevmavsWL0hB2n7yYVRkJ1s29sNwndtzy', NULL, '2024-12-25 14:49:16', '2024-12-25 14:49:16', 0, 'Cullen', 'Cooley', 1, 0, NULL, NULL, 0, NULL, 0),
(23, 'povofedoru@mailinator.com', NULL, '$2y$12$XKvG/vIO0WPgxLYzE60J1OBWLlkMfFYsakRbqY0qdnnS4lA5cjFL.', NULL, '2024-12-25 15:18:29', '2024-12-25 15:18:29', 0, 'Malik', 'Cantrell', 1, 0, NULL, NULL, 0, NULL, 0),
(24, 'wiseqasydy@mailinator.com', NULL, '$2y$12$O7TnmbjZE8yu26MaO9vWJ.LiaShl3aL67FmQ6vjA96MVFTLNxGHRu', NULL, '2024-12-25 15:18:41', '2024-12-25 15:18:41', 0, 'Harding', 'Downs', 1, 0, NULL, NULL, 0, NULL, 0),
(25, 'sewewehuti@mailinator.com', NULL, '$2y$12$zl6sYP/mVSOBVHNAKEAy5uMHgYlXqbFsZPPii5Cmf0vL0bZ.nMIE.', NULL, '2024-12-25 16:05:56', '2024-12-25 16:05:56', 0, 'Kay', 'Griffin', 1, 0, NULL, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `bio` text DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `role_id`, `social_links`, `bio`, `profile_pic`, `first_name`, `last_name`, `email`, `password`, `phone`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, 'Ahmad', 'Eid', 'ahmad@gmail.com', 'passssss1234', NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, 'Ala\'a', 'Eid', 'aloosh@gmail.com', '12345678', NULL, NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL, 'test', 'test', 'zuguhelali@mailinator.com', '$2y$12$M8RsyUekWIBxEd7eypbdPO8oyap60vSrQrq0ZV09MfI0IO1ok0NSm', NULL, NULL, NULL, NULL),
(4, 2, NULL, NULL, NULL, 'Vendor', ' a', 'test@gmail.com', '', NULL, NULL, '2024-12-21 18:12:52', '2024-12-21 18:12:52'),
(5, 2, NULL, NULL, NULL, 'Tester', 'tester', 'tester@gmail.com', '$2y$12$t7XMDAhan8D6icFgTQKCJeW1xEJCtQdNn3DudvFoZ8HoE62Fp4Go6', NULL, NULL, NULL, NULL),
(6, 2, NULL, NULL, NULL, 'Alfreda', 'Hudson', 'hewevygo@mailinator.com', '$2y$12$ceCNApHFUDL.HXdawMgxPeme5VprNC9zCEnBe4TkLXVrFSfHVMMdK', NULL, NULL, NULL, NULL),
(7, 2, NULL, 'اثممخ', NULL, 'Esra\'a', 'Eid', 'esraa.eid@gmail.com', '$2y$12$.OdqgcE8yq/00dh.wp6ZTO2RmudNkaRafMD80HW.TfI4fiFhvZIQm', NULL, NULL, '2024-12-22 21:07:38', '2024-12-23 09:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2024-12-21 18:03:56', '2024-12-21 18:03:56'),
(2, 2, 3, 0, '2024-12-21 18:03:56', '2024-12-21 18:03:56'),
(3, 4, 1, 0, '2024-12-21 16:33:10', '2024-12-21 16:33:10'),
(4, 13, 1, 0, '2024-12-22 10:16:26', '2024-12-22 10:16:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_us_user_id_foreign` (`user_id`);

--
-- Indexes for table `customization_options`
--
ALTER TABLE `customization_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customization_options_product_customization_id_foreign` (`product_customization_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_customization_id_foreign` (`customization_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `product_customization`
--
ALTER TABLE `product_customization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_customization_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD KEY `vendors_role_id_foreign` (`role_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customization_options`
--
ALTER TABLE `customization_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_customization`
--
ALTER TABLE `product_customization`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customization_options`
--
ALTER TABLE `customization_options`
  ADD CONSTRAINT `customization_options_product_customization_id_foreign` FOREIGN KEY (`product_customization_id`) REFERENCES `product_customization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_customization_id_foreign` FOREIGN KEY (`customization_id`) REFERENCES `product_customization` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_customization`
--
ALTER TABLE `product_customization`
  ADD CONSTRAINT `product_customization_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
