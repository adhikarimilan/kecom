-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 08:54 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom-laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `btn_title` varchar(191) DEFAULT NULL,
  `btn_link` varchar(191) DEFAULT NULL,
  `photo` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `border` int(2) NOT NULL DEFAULT 50,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `btn_title`, `btn_link`, `photo`, `status`, `border`, `created_at`, `updated_at`) VALUES
(1, 'Fashion Products', 'check now', 'http://localhost/kiran/public/product?cat=womens-fashion', 'banner/2222-2021-0221-21-1613895996.jpg', 1, 100, '2021-02-20 11:45:29', '2021-02-23 17:21:34'),
(2, 'Unlimited Items', 'check now', NULL, 'banner/2139-2021-0221-21-1613896206.jpg', 1, 100, '2021-02-21 08:30:07', '2021-02-21 08:30:07'),
(3, 'ladies wear', 'view', NULL, 'banner/7856-2021-0225-25-1614220756.jpg', 1, 10, '2021-02-25 02:39:17', '2021-02-25 02:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `cookie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `photo`, `slug`, `featured`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Uncategorized', NULL, 'uncategorized', 0, '2019-11-27 18:15:00', '2021-02-24 13:54:32'),
(10, NULL, 2, 'Men\'s Fashion', 'cats/9862-2021-02-21-1613898986cat.jpg', 'mens-fashion', 1, '2021-02-21 09:16:26', '2021-02-21 09:16:35'),
(11, 10, 2, 'Shoes', 'cats/9484-2021-02-23-1614095220cat.jpg', 'shoes-1', 1, '2021-02-21 09:33:32', '2021-02-23 15:47:01'),
(12, NULL, 2, 'Women\'s Fashion', 'cats/5398-2021-02-23-1614095365cat.jpg', 'womens-fashion', 1, '2021-02-23 15:49:26', '2021-02-23 15:49:26'),
(13, 12, 2, 'High Heels', 'cats/8061-2021-02-23-1614095416cat.jpg', 'high-heels', 1, '2021-02-23 15:50:17', '2021-02-23 15:50:17'),
(14, 10, 2, 'Man Bags', 'cats/6989-2021-02-23-1614095758cat.jpg', 'man-bags', 1, '2021-02-23 15:55:59', '2021-02-23 15:55:59'),
(15, 12, 2, 'Woman bags', 'cats/4954-2021-02-23-1614095892cat.jpg', 'woman-bags', 1, '2021-02-23 15:58:12', '2021-02-23 15:58:12'),
(16, 12, 2, 'Sidebag for girl', 'cats/8791-2021-02-23-1614096033cat.jpg', 'sidebag-for-girl-1', 1, '2021-02-23 16:00:34', '2021-02-25 02:32:23'),
(17, 10, 2, 'Pants for men', 'cats/4118-2021-02-24-1614142057cat.jpg', 'pants-for-men', 1, '2021-02-24 04:47:38', '2021-02-24 04:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(66, 26, 1, '2021-02-23 16:25:22', '2021-02-23 16:25:22'),
(67, 27, 12, '2021-02-23 16:30:41', '2021-02-23 16:30:41'),
(68, 27, 15, '2021-02-23 16:30:41', '2021-02-23 16:30:41'),
(69, 28, 12, '2021-02-23 16:34:27', '2021-02-23 16:34:27'),
(70, 28, 16, '2021-02-23 16:34:27', '2021-02-23 16:34:27'),
(74, 30, 12, '2021-02-23 17:19:15', '2021-02-23 17:19:15'),
(75, 30, 15, '2021-02-23 17:19:15', '2021-02-23 17:19:15'),
(76, 31, 12, '2021-02-24 04:19:53', '2021-02-24 04:19:53'),
(77, 32, 10, '2021-02-24 04:29:18', '2021-02-24 04:29:18'),
(78, 32, 14, '2021-02-24 04:29:18', '2021-02-24 04:29:18'),
(79, 33, 10, '2021-02-24 04:36:41', '2021-02-24 04:36:41'),
(80, 33, 14, '2021-02-24 04:36:42', '2021-02-24 04:36:42'),
(81, 34, 10, '2021-02-24 04:43:40', '2021-02-24 04:43:40'),
(82, 34, 14, '2021-02-24 04:43:40', '2021-02-24 04:43:40'),
(83, 35, 10, '2021-02-24 08:49:15', '2021-02-24 08:49:15'),
(84, 35, 17, '2021-02-24 08:49:16', '2021-02-24 08:49:16'),
(85, 36, 12, '2021-02-24 08:58:49', '2021-02-24 08:58:49'),
(86, 36, 13, '2021-02-24 08:58:50', '2021-02-24 08:58:50'),
(90, 39, 10, '2021-02-24 11:03:40', '2021-02-24 11:03:40'),
(91, 39, 11, '2021-02-24 11:03:40', '2021-02-24 11:03:40'),
(96, 37, 12, '2021-02-24 11:58:43', '2021-02-24 11:58:43'),
(97, 37, 13, '2021-02-24 11:58:43', '2021-02-24 11:58:43'),
(100, 29, 10, '2021-02-24 15:06:17', '2021-02-24 15:06:17'),
(101, 29, 14, '2021-02-24 15:06:17', '2021-02-24 15:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_based` tinyint(1) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` tinyint(1) NOT NULL,
  `discount_value` int(11) DEFAULT NULL,
  `discount_percent` decimal(5,2) DEFAULT NULL,
  `max_number_orders` int(11) DEFAULT NULL,
  `minimum_order_value` int(11) DEFAULT NULL,
  `limit_per_customer` int(11) DEFAULT NULL,
  `maximum_discount_value` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `time_based`, `start_time`, `end_time`, `coupon_code`, `discount_type`, `discount_value`, `discount_percent`, `max_number_orders`, `minimum_order_value`, `limit_per_customer`, `maximum_discount_value`, `created_at`, `updated_at`) VALUES
(1, 'shivaratri special', 0, NULL, NULL, 'cgrs123', 0, 200, NULL, 50, 1000, 5, NULL, '2020-04-20 10:47:13', '2021-02-25 02:09:17'),
(2, 'deewali', NULL, NULL, NULL, 'deewali2021', 0, 200, NULL, 20, 1000, 2, NULL, '2021-02-25 02:35:44', '2021-02-25 02:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `address`, `contact`, `email`, `description`, `seen`, `created_at`, `updated_at`) VALUES
(10, 'Manisha', 'rajbiraj', '9812334567', 'manisha123@gmail.com', 'i liked the service provided by this website...thank you..', 1, '2021-02-25 02:46:58', '2021-02-25 02:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_11_10_055408_create_products_table', 2),
(7, '2019_11_15_054930_create_flavour_table', 5),
(9, '2019_11_10_055004_create_carts_table', 6),
(10, '2019_11_17_061412_create_categories_table', 7),
(11, '2019_11_17_061517_create_category_products_table', 8),
(12, '2019_11_11_072715_create_orders_table', 9),
(14, '2019_11_13_102113_create_order_products_table', 10),
(15, '2019_11_18_101003_create_roles_table', 11),
(17, '2019_11_27_080211_create_messages_table', 12),
(18, '2020_04_07_121949_create_coupons_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `billing_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_postalcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_name_on_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_discount` int(11) NOT NULL DEFAULT 0,
  `billing_discount_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_subtotal` int(11) NOT NULL,
  `billing_tax` int(11) DEFAULT NULL,
  `billing_total` int(11) NOT NULL,
  `payment_gateway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash on delivery',
  `canceled` tinyint(4) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `shipped` tinyint(1) NOT NULL DEFAULT 0,
  `order_notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `billing_email`, `billing_name`, `billing_address`, `billing_city`, `billing_province`, `billing_postalcode`, `billing_phone`, `billing_name_on_card`, `billing_discount`, `billing_discount_code`, `billing_subtotal`, `billing_tax`, `billing_total`, `payment_gateway`, `canceled`, `verified`, `shipped`, `order_notes`, `error`, `created_at`, `updated_at`) VALUES
(13, 1, 'rakasidebus@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '98', NULL, 0, NULL, 4000, NULL, 4000, 'Cash on Delivery', 0, 1, 1, NULL, NULL, '2021-02-24 15:07:32', '2021-02-24 15:26:15'),
(14, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '23', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:00:51', '2021-02-24 16:00:51'),
(15, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '23', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:03:47', '2021-02-24 16:03:47'),
(16, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '23', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:04:20', '2021-02-24 16:04:20'),
(17, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '23', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:04:54', '2021-02-24 16:04:54'),
(18, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '23', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:06:04', '2021-02-24 16:06:04'),
(19, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '978', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:13:40', '2021-02-24 16:13:40'),
(20, 1, 'rakasidebus@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '54', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:19:30', '2021-02-24 16:19:30'),
(21, 1, 'pdhakal07@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '45', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:21:38', '2021-02-24 16:21:38'),
(22, 1, 'pdhakal07@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '45', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:22:19', '2021-02-24 16:22:19'),
(23, 1, 'rakasidebus@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '21', NULL, 0, NULL, 4936, NULL, 4936, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:30:21', '2021-02-24 16:30:21'),
(24, 1, 'sabinnepal2k70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '21', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:33:36', '2021-02-24 16:33:36'),
(25, 1, 'rakasidebus@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '12', NULL, 0, NULL, 4936, NULL, 4936, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:42:24', '2021-02-24 16:42:24'),
(26, 1, 'pdhakal07@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '13', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:45:23', '2021-02-24 16:45:23'),
(27, 1, 'sabinnepal2k70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '35', NULL, 0, NULL, 3702, NULL, 3702, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-24 16:49:00', '2021-02-24 16:49:00'),
(28, 1, 'pdhakal07@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '23', NULL, 0, NULL, 7404, NULL, 7404, 'Cash on Delivery', 0, 1, 1, NULL, NULL, '2021-02-24 16:54:07', '2021-02-25 02:04:33'),
(29, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '98', NULL, 200, 'cgrs123', 1489, NULL, 1289, 'Cash on Delivery', 1, 0, 0, NULL, NULL, '2021-02-25 02:10:46', '2021-02-25 02:12:18'),
(30, 1, 'milan123ma70@gmail.com', 'alka sah', 'brrt', 'brt', 'province1', '3337', '9807', NULL, 200, 'cgrs123', 1499, NULL, 1299, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2021-02-25 02:27:27', '2021-02-25 02:27:27'),
(31, 1, 'milan123ma70@gmail.com', 'Milan Adhikari', 'ullughuttu', 'urlabadi', 'province 1', NULL, '98765', NULL, 0, NULL, 2740, NULL, 2740, 'cash on delivery', 0, 0, 0, NULL, NULL, '2021-03-20 04:52:01', '2021-03-20 04:52:01'),
(32, 1, 'milan123ma70@gmail.com', 'Milan Adhikari', 'ullughuttu', 'urlabadi', 'province 1', NULL, '98765', NULL, 0, NULL, 2740, NULL, 2740, 'cash on delivery', 0, 0, 0, NULL, NULL, '2021-03-20 04:56:40', '2021-03-20 04:56:40'),
(33, 1, 'milan123ma70@gmail.com', 'Milan Adhikari', 'ullughuttu', 'urlabadi', 'province 1', NULL, '98765', NULL, 0, NULL, 2740, NULL, 2740, 'cash on delivery', 0, 0, 0, NULL, NULL, '2021-03-20 04:57:39', '2021-03-20 04:57:39'),
(34, 1, 'milan123ma70@gmail.com', 'Milan Adhikari', 'ullughuttu', 'urlabadi', 'province 1', NULL, '98765', NULL, 0, NULL, 2740, NULL, 2740, 'cash on delivery', 0, 0, 0, NULL, NULL, '2021-03-20 05:00:52', '2021-03-20 05:00:52'),
(35, 1, 'milan123ma70@gmail.com', 'Milan Adhikari', 'ullughuttu', 'urlabadi', 'province 1', NULL, '98765', NULL, 0, NULL, 2740, NULL, 2740, 'cash on delivery', 0, 0, 0, NULL, NULL, '2021-03-20 06:26:31', '2021-03-20 06:26:31'),
(36, 1, 'milan123ma70@gmail.com', 'Milan Adhikari', 'ullughuttu', 'urlabadi', 'province 1', NULL, '98765', NULL, 0, NULL, 2740, NULL, 2740, 'cash on delivery', 0, 0, 0, NULL, NULL, '2021-03-20 06:54:25', '2021-03-20 06:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_price` int(10) UNSIGNED DEFAULT NULL,
  `weight` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `product_price`, `weight`, `quantity`, `message`, `created_at`, `updated_at`) VALUES
(49, 13, 26, 500, 1, 3, NULL, '2021-02-24 15:07:32', '2021-02-24 15:07:32'),
(50, 13, 26, 500, 1, 5, NULL, '2021-02-24 15:07:33', '2021-02-24 15:07:33'),
(51, 18, 39, 1234, 1, 3, NULL, '2021-02-24 16:06:04', '2021-02-24 16:06:04'),
(52, 18, 39, 1234, 1, 3, NULL, '2021-02-24 16:06:04', '2021-02-24 16:06:04'),
(53, 19, 39, 1234, 1, 3, NULL, '2021-02-24 16:13:40', '2021-02-24 16:13:40'),
(54, 19, 39, 1234, 1, 3, NULL, '2021-02-24 16:13:41', '2021-02-24 16:13:41'),
(55, 20, 39, 1234, 1, 3, NULL, '2021-02-24 16:19:30', '2021-02-24 16:19:30'),
(56, 20, 39, 1234, 1, 3, NULL, '2021-02-24 16:19:30', '2021-02-24 16:19:30'),
(57, 22, 39, 1234, 1, 3, NULL, '2021-02-24 16:22:19', '2021-02-24 16:22:19'),
(58, 22, 39, 1234, 1, 3, NULL, '2021-02-24 16:22:20', '2021-02-24 16:22:20'),
(59, 23, 39, 1234, 1, 2, NULL, '2021-02-24 16:30:22', '2021-02-24 16:30:22'),
(60, 23, 39, 1234, 1, 2, NULL, '2021-02-24 16:30:22', '2021-02-24 16:30:22'),
(61, 24, 39, 1234, 1, 3, NULL, '2021-02-24 16:33:36', '2021-02-24 16:33:36'),
(62, 24, 39, 1234, 1, 3, NULL, '2021-02-24 16:33:36', '2021-02-24 16:33:36'),
(63, 25, 39, 1234, 1, 2, NULL, '2021-02-24 16:42:24', '2021-02-24 16:42:24'),
(64, 25, 39, 1234, 1, 2, NULL, '2021-02-24 16:42:24', '2021-02-24 16:42:24'),
(65, 26, 39, 1234, 1, 3, NULL, '2021-02-24 16:45:24', '2021-02-24 16:45:24'),
(66, 26, 39, 1234, 1, 3, NULL, '2021-02-24 16:45:24', '2021-02-24 16:45:24'),
(67, 27, 39, 1234, 1, 1, NULL, '2021-02-24 16:49:01', '2021-02-24 16:49:01'),
(68, 27, 39, 1234, 1, 2, NULL, '2021-02-24 16:49:01', '2021-02-24 16:49:01'),
(69, 28, 39, 1234, 1, 3, NULL, '2021-02-24 16:54:07', '2021-02-24 16:54:07'),
(70, 28, 39, 1234, 1, 3, NULL, '2021-02-24 16:54:08', '2021-02-24 16:54:08'),
(71, 29, 34, 1489, 1, 1, NULL, '2021-02-25 02:10:46', '2021-02-25 02:10:46'),
(72, 30, 29, 1499, 1, 1, NULL, '2021-02-25 02:27:27', '2021-02-25 02:27:27'),
(73, 34, 26, 500, 1, 1, 'nice one', '2021-03-20 05:00:52', '2021-03-20 05:00:52'),
(74, 34, 27, 1120, 2, 1, 'good one', '2021-03-20 05:00:52', '2021-03-20 05:00:52'),
(75, 35, 26, 500, 1, 1, 'nice one', '2021-03-20 06:26:31', '2021-03-20 06:26:31'),
(76, 35, 27, 1120, 2, 1, 'good one', '2021-03-20 06:26:31', '2021-03-20 06:26:31'),
(77, 36, 26, 500, 1, 1, 'nice one', '2021-03-20 06:54:26', '2021-03-20 06:54:26'),
(78, 36, 27, 1120, 2, 1, 'good one', '2021-03-20 06:54:26', '2021-03-20 06:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('pdhakal07@gmail.com', '$2y$10$iFerOhGPH7G2uQVoJT6Y8.OPASiw7KSyHCAi1GgQXEO8DgapBJSLO', '2019-12-04 13:19:02'),
('nunuraj01@gmail.com', '$2y$10$p1EXOXVqDlcbEvbGXuvPCu3vE6VVbE5S3OpzwE0aWK./t39TuTiYC', '2019-12-04 14:37:49'),
('milan@example.com', '$2y$10$MpA1tvmIN0NFVVvwepfA1etl9tXZSSWCDAOVmvNWcaQzoXVtfZ4p2', '2019-12-05 07:12:44'),
('parbat4all@gmail.com', '$2y$10$VtvFG4SjtXbrfP0mXDKLXucHxI1mlfWec90rzrfj9kARB/2VYJVMq', '2019-12-11 17:07:59'),
('rakasidebus@gmail.com', '$2y$10$Y6KNkR3bEiTVRNt49xLf0e8SEtdL67RpW/AaD5EU1Q6q1GGuo.Ps2', '2019-12-11 17:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_stock` tinyint(1) NOT NULL DEFAULT 0,
  `stock_quantity` int(3) DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `reg_price` int(10) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_flavours` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `details`, `m_stock`, `stock_quantity`, `sale_price`, `reg_price`, `description`, `featured`, `image`, `images`, `has_flavours`, `created_at`, `updated_at`) VALUES
(26, 'Beautiful  Sidebag for girl', 'beautiful-sidebag-for-girl', 'a cute little sidebag', 0, NULL, 500, 600, '<ul>\r\n	<li>Exterior:Solid Bag</li>\r\n	<li>Style:Casual</li>\r\n	<li>Lining Material:Polyester</li>\r\n	<li>Gender:Women</li>\r\n	<li>Pattern Type:Solid</li>\r\n	<li>Number of Handles/Straps:Single</li>\r\n</ul>', 1, 'cov_20210223_101021.jpg', NULL, 0, '2021-02-23 16:25:21', '2021-02-23 16:25:21'),
(27, 'Beautiful  bag with pics for girl', 'beautiful-bag-with-pics-for-girl', 'easy to carry\r\nand convenient with beautiful pictures behind', 0, NULL, 1120, 1200, '<ul>\r\n	<li>Exterior:Solid Bag</li>\r\n	<li>Style:Casual</li>\r\n	<li>Lining Material:Polyester</li>\r\n	<li>Gender:Women</li>\r\n	<li>Pattern Type:Solid</li>\r\n	<li>Number of Handles/Straps:Single</li>\r\n</ul>', 1, 'cov_20210223_101540.jpeg', 'e1_20210223_221541.jpeg e2_20210223_221541.jpeg', 0, '2021-02-23 16:30:41', '2021-02-23 16:30:41'),
(28, 'girl friend sidebag with picture', 'girl-friend-sidebag-with-picture', 'beautiful sidebag of girl with picture', 0, NULL, 890, 1000, '<ul>\r\n	<li>Exterior:Solid Bag</li>\r\n	<li>Style:Casual</li>\r\n	<li>Lining Material:Polyester</li>\r\n	<li>Gender:Women</li>\r\n	<li>Pattern Type:Solid</li>\r\n	<li>Number of Handles/Straps:Single</li>\r\n</ul>', 0, 'cov_20210223_101926.jpeg', 'e1_20210223_221927.jpeg', 0, '2021-02-23 16:34:27', '2021-02-23 16:34:27'),
(29, 'Backpack for boys', 'backpack-for-boys', '100% waterproof, cozy and convenient', 0, NULL, 1499, 1800, '<p>price:&nbsp;<del>1800&nbsp;</del><span class=\"marker\"><code>1499&nbsp;</code></span></p>\r\n\r\n<h2 style=\"font-style:italic\">very cheap price</h2>', 1, 'cov_20210223_105656.jpg', NULL, 0, '2021-02-23 17:11:57', '2021-02-24 15:06:17'),
(30, 'Backpack for girls', 'backpack-for-boys-1', 'easy to carry and convenient with enough pockets', 0, NULL, 890, 1200, '<ul>\r\n	<li>Exterior:Solid Bag</li>\r\n	<li>Style:Casual</li>\r\n	<li>Lining Material:Polyester</li>\r\n	<li>Gender:Women</li>\r\n	<li>Pattern Type:Solid</li>\r\n	<li>Number of Handles/Straps:Single</li>\r\n</ul>', 1, 'cov_20210223_110340.jpg', NULL, 0, '2021-02-23 17:18:41', '2021-02-23 17:19:15'),
(31, 'Pack Of 3 Velvet Leggings', 'pack-of-3-velvet-leggings', 'Color Family : Black Navy Blue Maroon', 0, NULL, 850, 1550, '<ul>\r\n	<li>Fabric: Velvet</li>\r\n	<li>Highly Stretchable</li>\r\n	<li>Free size - It will be fit 27 to 34 inch waist size</li>\r\n</ul>', 0, 'cov_20210224_100452.jpg', NULL, 0, '2021-02-24 04:19:53', '2021-02-24 04:19:53'),
(32, 'Fastrack Multicolored  Backpack For Men', 'fastrack-multicolored-backpack-for-men', NULL, 0, NULL, 2500, 3000, '<ul>\r\n	<li>Material : Polyester</li>\r\n	<li>Dimensions (L x H) : 12&quot; x 18&quot;</li>\r\n	<li>Closure : Zip</li>\r\n	<li>Compartment : 2</li>\r\n	<li>1 side bottle holder</li>\r\n	<li>Durable and light weighted</li>\r\n</ul>', 0, 'cov_20210224_101417.jpg', 'e1_20210224_101417.jpg e2_20210224_101417.jpg e3_20210224_101418.jpg', 0, '2021-02-24 04:29:18', '2021-02-25 02:01:33'),
(33, 'Pu Madal Side Crossbody Bag', 'pu-madal-side-crossbody-bag', 'This bag can be also used for hiking purpose where you need to take a pair of shoes extra for an emergency or you can carry for your long tours where you can use it', 0, NULL, 500, 1000, '<p>Lining Material: pu leather</p>\r\n\r\n<ul>\r\n	<li>Exterior: Silt Pocket</li>\r\n	<li>Style: Casual</li>\r\n	<li>Closure Type: Zipper</li>\r\n	<li>Gender: Men</li>\r\n	<li>Types of bags: Handbags &amp; Crossbody bags</li>\r\n	<li>Interior: Computer Interlayer</li>\r\n	<li>Pattern Type: Solid</li>\r\n	<li>Hardness: Soft</li>\r\n	<li>Number of Handles/Straps: Single</li>\r\n	<li>Shape: Casual Tote</li>\r\n	<li>Main Material: PU</li>\r\n	<li>Decoration: None</li>\r\n	<li>Handbags Occasion: Versatile</li>\r\n	<li>Style: Fashion</li>\r\n	<li>Color: Black</li>\r\n</ul>', 0, 'cov_20210224_102141.jpg', 'e1_20210224_102141.jpg e2_20210224_102141.jpg', 0, '2021-02-24 04:36:41', '2021-02-24 04:36:41'),
(34, 'PU Leather Tough Classic College and Casual Backpack', 'pu-leather-tough-classic-college-and-casual-backpack', NULL, 0, NULL, 1489, 2500, '<ul>\r\n	<li>Material : Polyester/nylon</li>\r\n	<li>Dimension : 45cm x 30cm x 15cm</li>\r\n	<li>Closure : Zipper</li>\r\n	<li>Laptop Space : 18&quot; and above</li>\r\n	<li>Compartments : 1</li>\r\n	<li>Multiple pockets</li>\r\n	<li>High quality product</li>\r\n	<li>Durable and easy to carry out</li>\r\n	<li>The PU Material which is used is very durable.</li>\r\n</ul>', 0, 'cov_20210224_102838.jpg', 'e1_20210224_102838.jpg e2_20210224_102839.jpg', 0, '2021-02-24 04:43:39', '2021-02-24 04:43:39'),
(35, 'Casual Cotton petrol green Pants For Men', 'casual-cotton-petrol-green-pants-for-men', 'color: petrol green', 0, NULL, 1500, 1300, '<ul>\r\n	<li>Stretchable cotton pant</li>\r\n	<li>Quality twirl made</li>\r\n	<li>Suitable for casual and official use</li>\r\n	<li>Sizes available 29 to 36</li>\r\n	<li>2 back pocket</li>\r\n	<li>2 front pocket</li>\r\n	<li>cotton material used in pocket</li>\r\n</ul>', 0, 'cov_20210224_023415.jpg', NULL, 0, '2021-02-24 08:49:15', '2021-02-24 08:49:15'),
(36, 'Open Toe Ankle Strap Low Block Chunky Heels Pumps Sandals', 'open-toe-ankle-strap-low-block-chunky-heels-pumps-sandals', NULL, 0, NULL, 1000, 800, '<ul>\r\n	<li>Soft and smooth Open ToeHeel height: 2.5&quot; (approx) comfortAdjustable buckled ankle strap</li>\r\n</ul>\r\n\r\n<p>These Heeled sandals feature an open toe silhouette and classic one band low block heel design.Ankle Strap with adjustable buckle closure, make people focus on the slimmest part of your foot.An ideal choice for party, wedding, business, office and other daily use.</p>', 0, 'cov_20210224_024348.jpg', 'e1_20210224_144349.jpg e2_20210224_144349.jpg', 0, '2021-02-24 08:58:49', '2021-02-24 08:58:49'),
(37, 'Square High Heeled Open Toe Sandals With Back Zipper Ankle Straps For Women', 'square-high-heeled-open-toe-sandals-with-back-zipper-ankle-straps-for-women', NULL, 1, 1, 1250, 2000, '<p>Comfortable block chunky heel sandals ,perfect for party,daily,work ,wedding,bridal,dating,dress,clubbing,evenings.Made of safe Man Made material composed of PU upper, latex insoles and non-skid rubber soles, no hurt pain of feet, following environmental principles.Adjustable ankle strap with buckle closures ,Take it on/off easily,left convenience and comfortable,please adjust the perfect size you prefer.Classic color and open toe chunky design ,will be easygoing with different kinds of dresses ,skirts,pants,will be applied to a variety of occasion,to make a stylish and statement</p>', 0, 'cov_20210224_024934.jpg', 'e1_20210224_144935.jpg e2_20210224_144935.jpg', 0, '2021-02-24 09:04:35', '2021-02-24 11:58:43'),
(39, 'Vans Black/Tweed Vn0004Mljoc Authentic Two Tone Shoes For Men', 'vans-blacktweed-vn0004mljoc-authentic-two-tone-shoes-for-men', NULL, 1, 0, 1234, 4567, '<ul>\r\n	<li>100% Genuine Product</li>\r\n	<li>Gender :Men</li>\r\n	<li>Lace type : Half Lace Up</li>\r\n	<li>Padded Ankle Collar</li>\r\n	<li>Main Material:Wool/Suede</li>\r\n	<li>Sole :Rubber Sole</li>\r\n	<li>Cushioned Insole</li>\r\n	<li>Type: Casual</li>\r\n	<li>Wash care:Surface dirt can be cleaned with a good quality brush or a damp cloth.</li>\r\n	<li>All Sizes mentioned are in European Size Format</li>\r\n</ul>', 0, 'cov_20210224_044836.jpg', 'e1_20210224_164838.jpg', 0, '2021-02-24 11:03:40', '2021-02-24 16:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Milan Adk', 'milan123ma70@gmail.com', '2019-12-11 17:10:11', '$2y$10$nUuSkJO4.Z4JNhdUzINyR./S8i9FDRf23aZXAfAaaAvUD1Ic2YmMS', 'hGie2JAsYjM6r3use0ydgOIVabOAmwshwHzgAYcX95twJWWZtLOz4E0kAFyF', 'dxLbczmZIF6Fi5y6l2mHv6mxC0yevsvZAdQTOI22znYgI364EsCnOLQH8TrW1hXetK4lFjHozHX61xVkDOyK94z11GUkndUW1tHfLfAShcw6uTtgNs31isObTkIwLhCngs71NncatVvu0tkdOjmIoXvqsBpRyp4EKj4p8KtJ09juQaOzLFQJY6hj5SSutRjpxrB7DkIV_2021-03-20_10:13:51_99185', '2019-11-13 00:28:09', '2021-03-20 04:28:51'),
(2, 'Sakar Subedi', 'sakar@example.com', NULL, '$2y$10$nUuSkJO4.Z4JNhdUzINyR./S8i9FDRf23aZXAfAaaAvUD1Ic2YmMS', 'WlheqfHShFUqWn7pUwwEmIdP5W6PRBMk0qOz5ZBtg7DLCguLqUoY2EunR1nY', '3pFKUggK3Wn8k7iRNXn8mrJDVwd1A3UOAysmra2jhQaYa5cpMBAHhNwyuSuVCrDJfxE3TAnhcWplTTKNq9sfsmcfFMEIUMexsiyRhxLN0dmil9jdTavTtwY3mMRUOeJRyIkpWzoVJAqwr0I271sas2s60ESzA7pC771rMFK5PNHrg0My4Kafl4qs90nbe2m0KqnVbJCJ_2021-03-17_07:14:02_88556', '2019-11-24 03:27:38', '2021-03-17 01:29:02'),
(3, 'Parbat Raj Jha', 'parbat4all@gmail.com', NULL, '$2y$10$XiRPQPb39ms3GxqNb/JC/O5JfIv5sm8MCR/v/GkiwDam/iRSThLA6', NULL, NULL, '2019-12-03 21:32:14', '2019-12-03 21:32:14'),
(4, 'ruby shah', 'shahruby999@gmail.com', NULL, '$2y$10$fyiVhQ21YcEEfnqggLZWs.Ova8LrPRkzgw4ixrADQvqp8IDZ0mgSe', 'DeNnX0INRZ1zYSiPmahe9bPseSDVk3WVfOccVXQYMUZMSfa10vSin1I00oj0', NULL, '2019-12-04 12:36:17', '2019-12-04 12:36:17'),
(5, 'niraj raj', 'nunuraj01@gmail.com', NULL, '$2y$10$HnCo1hStvyKJiWLbApDtsOfobvA8l.bqzlVB8phYj1YHfrvFe04w6', 'qXhX48x43VgfAy0eitvyenLLDfXZ3sSlMBBSaWbhqoSto9FPH4prM7aPLv5S', NULL, '2019-12-04 13:00:08', '2019-12-04 13:00:08'),
(6, 'pramesh dhakal', 'pdhakal07@gmail.com', NULL, '$2y$10$ZNQLKj0EHJwMTPWmokobG.PqGJNUgbJcfVJN2xVuqlWubuiFtc2fm', 'whjcdaxtX7JaOSgEMUDPMlo82fU5TkhB3Wy4og9FFZ1nCUM2jrjG499OATJB', NULL, '2019-12-04 13:02:03', '2019-12-04 13:02:03'),
(7, 'Shyam Adhikari', 'shyamad280@gmail.com', NULL, '$2y$10$eqOKHSzGtKRTzXqMd9tPuO9tyf/Ex67yrKoOxM4HVY/Tfa9mhJsJ2', NULL, NULL, '2019-12-09 17:47:53', '2019-12-09 17:47:53'),
(8, 'Sonika Yadav', 'Yadavsomika745@gmail.com', NULL, '$2y$10$/V//.oG1korT0oJH7fGD2.rqe08uQPfGZQelg5RrbUMwdzSK0GF0q', NULL, NULL, '2019-12-10 17:29:01', '2019-12-10 17:29:01'),
(9, 'Sandip Bhagat', 'me.sandip02@gmail.com', NULL, '$2y$10$Iv/byCcOlgfkgaHTzw84aevIWSje6pWHlO0pFh4yBq.hbRIzFC0fG', NULL, NULL, '2019-12-11 15:58:08', '2019-12-11 15:58:08'),
(10, 'Nabin', 'rnabin20@gmail.com', '2019-12-11 17:12:04', '$2y$10$zkNHZl1wSolrALOEfOUJc.T9aKTzrI0nPI3m6LfWWJ2qFjqT3z/C2', NULL, NULL, '2019-12-11 16:51:35', '2019-12-11 17:12:04'),
(11, 'sakar subedi', 'rakasidebus@gmail.com', '2019-12-11 17:17:09', '$2y$10$Cs/OmV2pya42MfgjRqRXYOHRlCQS8xl7q0I8RBG2kwbBmWUO0bX8O', '4k8VjYVfaYcbCrz70YtweXbHFJZjq1zUGDLtinAxxtXPRbj8xU0ouclAA88Q', NULL, '2019-12-11 17:15:25', '2019-12-11 17:18:56'),
(12, 'Shivani bharti', 'shivanibharti@gmail.com', NULL, '$2y$10$kFTkDSSDXYivXOstshk88OVVP.S8oOnOYCJdixHsZ2BjV9Mz7zMPu', NULL, NULL, '2019-12-12 22:47:44', '2019-12-12 22:47:44'),
(13, 'Avinash Shah', 'shah.avinash1090@gmail.com', NULL, '$2y$10$G9M2pjFxbxUr07WKZsIu1umhd1bRvGC32ZH5IZh0NzqODkBjQL8Si', NULL, NULL, '2019-12-13 15:52:43', '2019-12-13 15:52:43'),
(14, 'Ravi Manandhar', 'manandharravi@yahoo.com', NULL, '$2y$10$VnD19HVTBBZHTr6BPo.EWuxsX/yMwVH3QjrUfwXHXing14d0JWjui', NULL, NULL, '2019-12-17 19:27:01', '2019-12-17 19:27:01'),
(15, 'Sita poudel', 'sita.poudelregmi@gmail.com', '2019-12-20 15:40:06', '$2y$10$FmH2YPC0TxcBhJgMVfgUe.CLooTwAUk3cXB4scWq.snQ7ElLKMNsO', NULL, NULL, '2019-12-20 15:17:52', '2019-12-20 15:40:06'),
(16, 'Rosha Tandukar', 'rusatandukar@gmail.com', NULL, '$2y$10$RpiMTGhu86LPUo7zeG7GQ.L0JSjgub9HlzHqetkAEVKV1skCLLhj.', NULL, NULL, '2019-12-21 16:23:53', '2019-12-21 16:23:53'),
(17, 'Binish Shrestha', 'binishshrestha7@gmail.com', '2019-12-23 17:10:28', '$2y$10$OacrmdEio1TJJYEYWOVo9eflziZdFSrwzA3jQRVN9PFvLUpsVQYCq', NULL, NULL, '2019-12-23 17:05:17', '2019-12-23 17:10:28'),
(18, 'Abinash kumar mandal', 'friendfind44@gmail.com', NULL, '$2y$10$lxv2YVbpr.r2YKI28RLNmuWrZ2pMnaSXdA.G1nbpMRtUPy4otT/8K', NULL, NULL, '2019-12-24 17:26:26', '2019-12-24 17:26:26'),
(19, 'Dixya', 'dikshyaadhikari2327@gmail.com', '2019-12-25 14:22:08', '$2y$10$TQF5Aj7Km5S3L8s5HqIX.OhvSjSpL45LtagSMCmTv6z/KPPWCeJeq', 'YKZw9QKFIShB8kTeZ1osp0CX4SyyMwzkLTQiMRWzQop0btla9q5H0TfdoxQy', NULL, '2019-12-25 14:14:49', '2019-12-25 14:22:08'),
(20, 'Narayan Daga', 'narayandagabrt@gmail.com', NULL, '$2y$10$iRLR/oEjeVdhqX8TT4DHWetA9i/Y6Sw9ygSnqND.WsaMtg8SDczam', NULL, NULL, '2019-12-25 15:17:54', '2019-12-25 15:17:54'),
(21, 'Robinson Shrestha', 'iamrabba@gmail.com', '2019-12-26 18:08:39', '$2y$10$7kxtpkzAIvvWNL3xupPFyen.rVxxSO6Wn5poasJfg43OB/OGy8q7C', NULL, NULL, '2019-12-26 18:07:38', '2019-12-26 18:08:39'),
(22, 'HarshUjin', 'dorjinharsh@gmail.com', '2019-12-30 17:22:00', '$2y$10$xk9SgxFCiPUEng9XJv2kou6B1oTojUk93p4y8HF7VSS7seS13iZP6', NULL, NULL, '2019-12-30 17:20:52', '2019-12-30 17:22:00'),
(23, 'Smarika Shrestha', 'smarikashrs@gmail.com', NULL, '$2y$10$MCqAs2BkIsObCPz//UXA7OmtbXTr4NqsQAngUt6FV5CUqeO.h7MwC', NULL, NULL, '2019-12-31 11:07:19', '2019-12-31 11:07:19'),
(24, 'Bhupendra Yadav', 'bhupendraya011@gmail.com', NULL, '$2y$10$i9wsZsNVZcAOmtveEacp0uPaI68OjnDK6VxEo6B/4Pw.veMHKdmy.', 'Yv1IttRa2FpXIqdRMvXvSnU1KwHx8SEDpk6u5K6ts0ax1145S5Mi3KUXnzxM', NULL, '2019-12-31 13:14:40', '2019-12-31 13:14:40'),
(25, 'Shikha sha', 'nadeema9665@gmail.com', NULL, '$2y$10$UdoL2M7NDBQ8f/UCHFQ.buRFGYf2ioMxkvVBgBCw/vRNlBSBZC3aa', NULL, NULL, '2020-01-02 08:09:25', '2020-01-02 08:09:25'),
(26, 'Biplaw Raj Khanal', 'bips2041@gmail.com', '2020-01-02 18:19:14', '$2y$10$QT.KtMmqxigHn19sjJHw8ebdp/U6piyW6OFAR7j4FOHHiYRNU5JOG', NULL, NULL, '2020-01-02 18:17:14', '2020-01-02 18:19:14'),
(27, 'Aayush karn', 'aayushkarn2@gmail.com', NULL, '$2y$10$8hp5Vth56E.TZCn4jSdts.pDdbbBMWE5NG4h3PKs5TGcwSU62CboK', NULL, NULL, '2020-01-05 11:55:11', '2020-01-05 11:55:11'),
(28, 'Nitika Dhakal', 'tigernitu@gmail.com', '2020-01-05 19:01:46', '$2y$10$nA/n1RyhbobM5Von8nwkZ.iyM3N5j.SKGvvE.Kfr5LhsRN/5S8AyK', NULL, NULL, '2020-01-05 18:57:04', '2020-01-05 19:01:46'),
(29, 'ISHAN DHAKAL', 'ishandhakal082@gmail.com', '2020-01-09 21:30:01', '$2y$10$H09Op6mTD1AAkwLXhBMdu.aSxUl195pGjdXkDbpbTRT10nmxB67ym', NULL, NULL, '2020-01-09 21:29:25', '2020-01-09 21:30:01'),
(30, 'Pratigya Rijal', 'smilling_pratigya@yahoo.com', '2020-01-14 16:07:09', '$2y$10$70rafdQfg5izCXoDtE5IUuE1.qXXvrMyZ83th4yFje8ukD9DkqyYq', NULL, NULL, '2020-01-14 16:05:44', '2020-01-14 16:07:09'),
(31, 'Play', 'playstorecnx13@gmail.com', NULL, '$2y$10$DDeDPNi8nOZJgETeAI3zMu9N8TO4.wYK4SNl1v9me7cjucqd5wxZi', NULL, NULL, '2020-01-17 23:10:31', '2020-01-17 23:10:31'),
(32, 'Saurav Khatiwada', 'sauravkhatiwada47@gmail.com', '2020-01-24 17:18:17', '$2y$10$dDdrNxRBs2iHrk8WJE6dNOiuHolauewGbo1vfM/c2cPJHG.WUmcDq', 'LOcpjo2I4sFF0Pm9owqc1xBHVGCiImXWjkOb2RFJVtsILvUQwCSuxQYQCn8z', NULL, '2020-01-24 17:12:56', '2020-01-24 17:18:17'),
(33, 'Pranish Bhagat', 'bhagatpranish@gmail.com', '2020-01-26 15:00:23', '$2y$10$DnsxB77JVpO9JJ1cesPFwOLpe5.sOWSnK6qaKebxWeg3IlKJ311Ky', NULL, NULL, '2020-01-26 14:53:39', '2020-01-26 15:00:23'),
(34, 'Megha Mohit Karnani', 'meghaatal1@gmail.com', '2020-01-28 03:28:28', '$2y$10$iENvpVGG6e4Fip1rDIVnCuDiZqsLx5/37iCCh4Nvg3htfFK7rg.qe', NULL, NULL, '2020-01-28 03:23:30', '2020-01-28 03:28:28'),
(35, 'Arihant', 'arihantdudheria23@gmail.com', NULL, '$2y$10$n95fCd4ptkt7n9uIKCQ3IuoJXjWOZmT3cKRoNKggeTFl.sCpNW4AK', NULL, NULL, '2020-02-05 15:41:02', '2020-02-05 15:41:02'),
(36, 'Khusboo shah', 'khusbooshah6767@gmail.com', NULL, '$2y$10$4cfwVkmK6iVJ2F3MNwLMheAE1Rv4A06HX2Ys.RDnngy3UM8gOwXu.', NULL, NULL, '2020-02-06 01:04:18', '2020-02-06 01:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_products_product_id_foreign` (`product_id`),
  ADD KEY `category_products_category_id_foreign` (`category_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `api_token` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
