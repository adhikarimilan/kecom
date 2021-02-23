-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2021 at 07:00 AM
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
(1, 'Fashion Products', 'check now', 'http://localhost/kiran/public/product/happy-birthday-1', 'banner/1560-2021-0220-20-1613821528.jpg', 1, 100, '2021-02-20 11:45:29', '2021-02-20 11:47:28');

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
(1, NULL, 1, 'Uncategorized', NULL, 'uncategorized', 1, '2019-11-27 18:15:00', '2021-02-20 05:15:43'),
(6, NULL, 2, 'Cup Cakes', 'cats/1350-2021-0220-20-1613795154cat.jpg', 'cup-cakes-1', 1, '2019-11-28 02:39:02', '2021-02-20 04:25:55'),
(7, NULL, 2, 'new Category', NULL, 'new-category', 1, '2019-12-09 18:58:42', '2021-02-20 04:24:47'),
(8, 6, 2, 'Boyd Rutherfords', NULL, 'boyd-rutherfords', 1, '2021-02-17 08:59:16', '2021-02-20 04:24:39'),
(9, NULL, 2, 'milan adhikari', 'cats/4041-2021-0218-18-1613667436cat.jpg', 'milan-adhikari-1', 1, '2021-02-18 11:00:12', '2021-02-20 04:24:41');

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
(13, 13, 1, '2019-12-10 12:43:07', '2019-12-10 12:43:07'),
(14, 14, 1, '2019-12-10 12:44:32', '2019-12-10 12:44:32'),
(15, 15, 1, '2019-12-10 12:45:23', '2019-12-10 12:45:23'),
(16, 16, 1, '2019-12-10 12:47:04', '2019-12-10 12:47:04'),
(17, 17, 1, '2019-12-10 12:48:07', '2019-12-10 12:48:07'),
(18, 17, 7, '2019-12-10 12:48:07', '2019-12-10 12:48:07'),
(19, 18, 1, '2019-12-10 12:50:29', '2019-12-10 12:50:29'),
(20, 18, 6, '2019-12-10 12:50:29', '2019-12-10 12:50:29'),
(21, 19, 1, '2019-12-10 12:53:48', '2019-12-10 12:53:48'),
(22, 20, 1, '2019-12-10 12:55:22', '2019-12-10 12:55:22'),
(23, 21, 1, '2019-12-10 12:59:02', '2019-12-10 12:59:02'),
(24, 22, 1, '2019-12-10 13:01:59', '2019-12-10 13:01:59'),
(26, 24, 1, '2020-01-06 00:19:29', '2020-01-06 00:19:29'),
(29, 23, 1, '2020-01-06 00:47:23', '2020-01-06 00:47:23'),
(63, 25, 1, '2021-02-20 17:55:51', '2021-02-20 17:55:51'),
(64, 25, 6, '2021-02-20 17:55:52', '2021-02-20 17:55:52');

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
(1, 'Mac Machine', 1, '2021-02-16 23:59:00', '2021-02-18 23:59:00', 'cgrs123', 0, 200, NULL, 50, 1000, 5, NULL, '2020-04-20 10:47:13', '2021-02-17 06:30:38');

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
(1, 'Eric Jones', '420 Lexington Ave', 'Zaaydgrqw', 'eric@talkwithcustomer.com', 'Hello kirancakeparlour.com.np,\r\n\r\nPeople ask, “why does TalkWithCustomer work so well?”\r\n\r\nIt’s simple.\r\n\r\nTalkWithCustomer enables you to connect with a prospective customer at EXACTLY the Perfect Time.\r\n\r\n- NOT one week, two weeks, three weeks after they’ve checked out your website kirancakeparlour.com.np.\r\n- NOT with a form letter style email that looks like it was written by a bot.\r\n- NOT with a robocall that could come at any time out of the blue.\r\n\r\nTalkWithCustomer connects you to that person within seconds of THEM asking to hear from YOU.\r\n\r\nThey kick off the conversation.\r\n\r\nThey take that first step.\r\n\r\nThey ask to hear from you regarding what you have to offer and how it can make their life better. \r\n\r\nAnd it happens almost immediately. In real time. While they’re still looking over your website kirancakeparlour.com.np, trying to make up their mind whether you are right for them.\r\n\r\nWhen you connect with them at that very moment it’s the ultimate in Perfect Timing – as one famous marketer put it, “you’re entering the conversation already going on in their mind.”\r\n\r\nYou can’t find a better opportunity than that.\r\n\r\nAnd you can’t find an easier way to seize that chance than TalkWithCustomer. \r\n\r\nCLICK HERE http://www.talkwithcustomer.com now to take a free, 14-day test drive and see what a difference “Perfect Timing” can make to your business.\r\n\r\nSincerely,\r\nEric\r\n\r\nPS:  If you’re wondering whether NOW is the perfect time to try TalkWithCustomer, ask yourself this:\r\nWill doing what I’m already doing now produce up to 100X more leads?\r\nBecause those are the kinds of results we know TalkWithCustomer can deliver.  \r\nIt shouldn’t even be a question, especially since it will cost you ZERO to give it a try. \r\nCLICK HERE http://www.talkwithcustomer.com to start your free 14-day test drive today.\r\n\r\nIf you\'d like to unsubscribe click here http://liveserveronline.com/talkwithcustomer.aspx?d=kirancakeparlour.com.np', 1, '2019-12-17 23:42:37', '2019-12-18 11:14:35'),
(2, 'Dixya', 'Biratnagar4', '9805368383', 'dikshyaadhikari2327@gmail.com', 'I want vanila cake tomorrow at 12 can i get?', 1, '2019-12-25 14:42:35', '2019-12-26 17:03:43'),
(5, 'Sanjit Gupta', 'Tinpaini', '9867816814', 'chefsanjit@hotmail.com', 'Birthday cake query \r\nFrozen theme', 1, '2020-01-10 16:40:21', '2020-01-10 19:57:05'),
(6, 'Jodie Buttenshaw', 'Austurgata 86', 'Vtzcq yh', 'buttenshaw.jodie@gmail.com', 'hi there\r\n\r\nDo you want better ranks for your website?\r\n\r\nConsider a whitehat SEO plan and grab yourself the visibility that will get you more sales/leads\r\n\r\nMore info:\r\nhttps://www.ghostdigital.co/product-category/seo-packages/\r\n\r\nthanks and regards\r\nGhost Digital', 0, '2020-01-13 07:28:40', '2020-01-13 07:28:40'),
(7, 'Paaila tech', 'Biratnagar', '9862025931', 'paaila@gmail.com', 'Test', 0, '2020-01-14 21:15:41', '2020-01-14 21:15:41'),
(8, 'Kandace Dearborn', 'Ul. Kozielska 85', 'Nxpim Idl', 'kandace.dearborn@yahoo.com', 'https://www.ghostdigital.co/product/local-seo-package/', 1, '2020-01-29 12:54:28', '2020-01-30 17:19:30'),
(9, 'Arihant', 'A-17 ground floor Yojana vihar Delhi', '9773768997', 'arihantdudheria23@gmail.com', 'Need a cake delivery in biratnagar', 0, '2020-02-05 15:40:12', '2020-02-05 15:40:12');

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
(1, 1, 'sabinnepal2k17@gmail.com', 'Parbat Raj raj', 'biratnagar', 'biratnagar', '1', '3337', '945000000', NULL, 0, NULL, 950, NULL, 950, 'Cash on Delivery', 0, 0, 0, 'heloo', NULL, '2019-12-23 17:17:02', '2019-12-23 17:17:02'),
(2, 21, 'iamrabba@gmail.com', 'Robinson Shrestha', 'Nobel Medical College', 'Biratnagar', '1', '3337', '9841248157', NULL, 0, NULL, 950, NULL, 950, 'Cash on Delivery', 0, 0, 0, 'should be delivered before 12 noon tomorrow (27th dec 2019)', NULL, '2019-12-26 18:14:12', '2019-12-26 18:14:12'),
(3, 28, 'tigernitu@gmail.com', 'Nitika Dhakal', 'Pokhariya, biratnagar, nepal', 'Biratnagar', '1', '3337', '9842159010', NULL, 0, NULL, 650, NULL, 650, 'Cash on Delivery', 0, 1, 1, 'Happy birthday sheetal', NULL, '2020-01-09 15:58:23', '2020-01-09 22:20:45'),
(4, 28, 'tigernitu@gmail.com', 'Nitika Dhakal', 'Pokhariya, biratnagar, nepal', 'Biratnagar', '1', '3337', '9842159010', NULL, 0, NULL, 650, NULL, 650, 'Cash on Delivery', 0, 1, 1, 'Happy birthday kumudini', NULL, '2020-01-10 16:30:12', '2020-01-10 23:18:15'),
(5, 1, 'milan123ma70@gmail.com', 'JY STHA', 'Brt', 'ktm', 'df 1', '3337', '9876543210', NULL, 200, 'cgrs123', 1900, NULL, 1700, 'Cash on Delivery', 1, 0, 0, NULL, NULL, '2020-04-20 10:50:22', '2020-04-20 10:52:46'),
(6, 1, 'milan123ma70@gmail.com', 'Manish Pal', 'Brt', 'ktm', 'df 1', '3337', '9876543210', NULL, 0, NULL, 1100, NULL, 1100, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2020-04-22 05:26:56', '2020-04-22 05:26:56'),
(7, 1, 'milan123ma70@gmail.com', 'Manish Pal', 'Brt', 'ktm', 'df 1', '3337', '9876543210', NULL, 0, NULL, 1063, NULL, 1063, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2020-05-08 07:26:55', '2020-05-08 07:26:55'),
(8, 1, 'milan123ma70@gmail.com', 'Manish Pal', 'Brt', 'ktm', 'df 1', '3337', '9876543210', NULL, 0, NULL, 1063, NULL, 1063, 'Cash on Delivery', 0, 0, 0, NULL, NULL, '2020-05-08 07:26:55', '2020-05-08 07:26:55'),
(9, 1, 'pdhakal07@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '987654321', NULL, 200, 'cgrs123', 3050, NULL, 2850, 'Cash on Delivery', 1, 0, 0, NULL, NULL, '2021-02-17 06:34:03', '2021-02-17 13:58:15'),
(10, 1, 'shahruby999@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '98', NULL, 200, 'cgrs123', 1900, NULL, 1700, 'Cash on Delivery', 1, 0, 0, NULL, NULL, '2021-02-17 09:35:13', '2021-02-17 13:58:02'),
(11, 1, 'milan123ma70@gmail.com', 'milan adhikari', 'urlabari', 'urlabari', 'province1', '3337', '98', NULL, 200, 'cgrs123', 1500, NULL, 1300, 'Cash on Delivery', 0, 1, 0, NULL, NULL, '2021-02-18 17:37:34', '2021-02-18 17:54:34');

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
(31, NULL, 13, 950, 1, 1, NULL, '2019-12-11 16:33:48', '2019-12-11 16:33:48'),
(32, NULL, 21, 950, 1, 1, NULL, '2019-12-11 16:33:48', '2019-12-11 16:33:48'),
(33, 1, 21, 950, 1, 1, NULL, '2019-12-23 17:17:02', '2019-12-23 17:17:02'),
(34, 2, 14, 950, 1, 1, '\"JA-AyaanDew Welcome Home\"', '2019-12-26 18:14:12', '2019-12-26 18:14:12'),
(35, 3, 16, 950, 1, 1, 'Happy birthday sheetal', '2020-01-09 15:58:23', '2020-01-09 15:58:23'),
(36, 4, 19, 950, 1, 1, 'Happy birthday kumudini', '2020-01-10 16:30:12', '2020-01-10 16:30:12'),
(37, 5, 14, 950, 1, 1, 'right', '2020-04-20 10:50:22', '2020-04-20 10:50:22'),
(38, 5, 14, 950, 1, 1, NULL, '2020-04-20 10:50:22', '2020-04-20 10:50:22'),
(39, 6, 17, 1100, 1, 1, NULL, '2020-04-22 05:26:56', '2020-04-22 05:26:56'),
(40, 7, 25, 850, 1, 1, NULL, '2020-05-08 07:26:55', '2020-05-08 07:26:55'),
(41, 8, 25, 850, 1, 1, NULL, '2020-05-08 07:26:55', '2020-05-08 07:26:55'),
(42, 9, 22, 800, 1, 1, NULL, '2021-02-17 06:34:03', '2021-02-17 06:34:03'),
(43, 9, 22, 800, 2, 1, NULL, '2021-02-17 06:34:03', '2021-02-17 06:34:03'),
(44, 9, 19, 650, 1, 1, NULL, '2021-02-17 06:34:03', '2021-02-17 06:34:03'),
(45, 10, 13, 950, 2, 1, NULL, '2021-02-17 09:35:13', '2021-02-17 09:35:13'),
(46, 11, 18, 650, 1, 1, NULL, '2021-02-18 17:37:34', '2021-02-18 17:37:34'),
(47, 11, 24, 850, 1, 1, NULL, '2021-02-18 17:37:34', '2021-02-18 17:37:34');

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

INSERT INTO `products` (`id`, `name`, `slug`, `details`, `sale_price`, `reg_price`, `description`, `featured`, `image`, `images`, `has_flavours`, `created_at`, `updated_at`) VALUES
(13, 'Red Velvet', 'red-velvet', 'good cake and important cake', NULL, 950, 'red velvet price', 1, 'cov_20191210_064307.jpg', NULL, 0, '2019-12-10 12:43:07', '2019-12-10 12:43:07'),
(14, 'Pineapple Cake', 'pineapple-cake', 'good cake and important cake', NULL, 950, 'pineapple cake', 1, 'cov_20191210_064432.jpg', NULL, 0, '2019-12-10 12:44:32', '2019-12-10 12:44:32'),
(15, 'Fruit Cake', 'fruit-cake', 'good cake and important cake', NULL, 950, 'fruit cake', 1, 'cov_20191210_064522.jpg', NULL, 0, '2019-12-10 12:45:23', '2019-12-10 12:45:23'),
(16, 'Cake Vanilla', 'cake-vanilla', 'good cake and important cake', NULL, 650, 'vanilla cake', 1, 'cov_20191210_064704.jpg', NULL, 0, '2019-12-10 12:47:04', '2021-02-20 11:02:12'),
(17, 'Hazlenut', 'hazlenut', 'good cake and important cake', NULL, 1100, 'hazlenut', 1, 'cov_20191210_064807.jpg', NULL, 0, '2019-12-10 12:48:07', '2019-12-10 12:48:07'),
(18, 'Cup Cakes', 'cup-cakes', 'good cake and important cake', NULL, 650, 'contains 4 pieces', 0, 'cov_20191210_065029.jpg', 'e1_20191210_065029.jpg e2_20191210_065029.jpg e3_20191210_065029.jpg e4_20191210_065029.jpg e5_20191210_065029.jpg', 0, '2019-12-10 12:50:29', '2019-12-10 12:50:29'),
(19, 'Black Forest', 'black-forest', 'good cake and important cake', NULL, 650, 'blackforest cake', 1, 'cov_20191210_065347.jpg', NULL, 0, '2019-12-10 12:53:48', '2019-12-10 12:53:48'),
(20, 'Forest Berry', 'forest-berry', 'good cake and important cake', NULL, 1000, 'forest berry cake', 1, 'cov_20191210_065521.jpg', NULL, 0, '2019-12-10 12:55:22', '2021-02-19 16:29:46'),
(21, 'Butterscotch Cake', 'butterscotch-cake', 'good cake and important cake', NULL, 950, 'butterscotch cake', 1, 'cov_20191210_065902.jpg', NULL, 0, '2019-12-10 12:59:02', '2019-12-10 12:59:02'),
(22, 'Strawberry cake', 'strawberry-cake', 'good cake and important cake', NULL, 800, 'strawberry cake', 1, 'cov_20191210_070159.jpg', NULL, 0, '2019-12-10 13:01:59', '2021-02-19 16:30:18'),
(23, 'Strawberry Vanilla Cocktail Cake', 'strawberry-vanilla-cocktail-cake', 'Strawberry Vanilla Cocktail Cake (minimum 2 pound)', NULL, 700, 'Strawberry Vanilla Cocktail Cake (minimum 2 pound)', 1, 'cov_20200105_181644.jpg', 'e1_20200105_181645.jpg', 0, '2020-01-06 00:16:45', '2020-01-06 00:47:23'),
(24, 'Happy birthday', 'happy-birthday', 'Happy birthday', NULL, 850, 'Happy birthday', 1, 'cov_20200105_181929.jpeg', 'e1_20200105_181929.jpeg', 0, '2020-01-06 00:19:29', '2021-02-19 16:30:19'),
(25, 'Happy birthday', 'happy-birthday-1', 'Happy birthday', 849, 850, '<p>Happy birthday</p>\r\n\r\n<h1>Happy belated Birthday&nbsp;</h1>', 1, 'cov_20210220_110127.jpeg', 'e1_20210220_225248.jpg e2_20210220_225249.png e3_20210220_225249.jpg', 0, '2020-01-06 00:20:46', '2021-02-20 17:55:51');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Milan Adk', 'milan123ma70@gmail.com', '2019-12-11 17:10:11', '$2y$10$nUuSkJO4.Z4JNhdUzINyR./S8i9FDRf23aZXAfAaaAvUD1Ic2YmMS', 'Sn3IIb5hAqCPr1lIaFSc3vqruHr4QBX1LgPSBwLH221kFeMuGsmlbkFLy7PO', '2019-11-13 00:28:09', '2019-12-11 17:10:11'),
(2, 'Sakar Subedi', 'sakar@example.com', NULL, '$2y$10$MunsXjCY9wcQ/SfuvchR1OGYzY9Vpg3C//7pGvLlM9xPSPJjVGbI2', '1WmJnzXzKhHPwXDLEF7Q2dxnKHk6E63wUzXjlFaGWHycm4J2WBOvQrwjEKcD', '2019-11-24 03:27:38', '2019-11-24 03:27:38'),
(3, 'Parbat Raj Jha', 'parbat4all@gmail.com', NULL, '$2y$10$XiRPQPb39ms3GxqNb/JC/O5JfIv5sm8MCR/v/GkiwDam/iRSThLA6', NULL, '2019-12-03 21:32:14', '2019-12-03 21:32:14'),
(4, 'ruby shah', 'shahruby999@gmail.com', NULL, '$2y$10$fyiVhQ21YcEEfnqggLZWs.Ova8LrPRkzgw4ixrADQvqp8IDZ0mgSe', 'DeNnX0INRZ1zYSiPmahe9bPseSDVk3WVfOccVXQYMUZMSfa10vSin1I00oj0', '2019-12-04 12:36:17', '2019-12-04 12:36:17'),
(5, 'niraj raj', 'nunuraj01@gmail.com', NULL, '$2y$10$HnCo1hStvyKJiWLbApDtsOfobvA8l.bqzlVB8phYj1YHfrvFe04w6', 'qXhX48x43VgfAy0eitvyenLLDfXZ3sSlMBBSaWbhqoSto9FPH4prM7aPLv5S', '2019-12-04 13:00:08', '2019-12-04 13:00:08'),
(6, 'pramesh dhakal', 'pdhakal07@gmail.com', NULL, '$2y$10$ZNQLKj0EHJwMTPWmokobG.PqGJNUgbJcfVJN2xVuqlWubuiFtc2fm', 'whjcdaxtX7JaOSgEMUDPMlo82fU5TkhB3Wy4og9FFZ1nCUM2jrjG499OATJB', '2019-12-04 13:02:03', '2019-12-04 13:02:03'),
(7, 'Shyam Adhikari', 'shyamad280@gmail.com', NULL, '$2y$10$eqOKHSzGtKRTzXqMd9tPuO9tyf/Ex67yrKoOxM4HVY/Tfa9mhJsJ2', NULL, '2019-12-09 17:47:53', '2019-12-09 17:47:53'),
(8, 'Sonika Yadav', 'Yadavsomika745@gmail.com', NULL, '$2y$10$/V//.oG1korT0oJH7fGD2.rqe08uQPfGZQelg5RrbUMwdzSK0GF0q', NULL, '2019-12-10 17:29:01', '2019-12-10 17:29:01'),
(9, 'Sandip Bhagat', 'me.sandip02@gmail.com', NULL, '$2y$10$Iv/byCcOlgfkgaHTzw84aevIWSje6pWHlO0pFh4yBq.hbRIzFC0fG', NULL, '2019-12-11 15:58:08', '2019-12-11 15:58:08'),
(10, 'Nabin', 'rnabin20@gmail.com', '2019-12-11 17:12:04', '$2y$10$zkNHZl1wSolrALOEfOUJc.T9aKTzrI0nPI3m6LfWWJ2qFjqT3z/C2', NULL, '2019-12-11 16:51:35', '2019-12-11 17:12:04'),
(11, 'sakar subedi', 'rakasidebus@gmail.com', '2019-12-11 17:17:09', '$2y$10$Cs/OmV2pya42MfgjRqRXYOHRlCQS8xl7q0I8RBG2kwbBmWUO0bX8O', '4k8VjYVfaYcbCrz70YtweXbHFJZjq1zUGDLtinAxxtXPRbj8xU0ouclAA88Q', '2019-12-11 17:15:25', '2019-12-11 17:18:56'),
(12, 'Shivani bharti', 'shivanibharti@gmail.com', NULL, '$2y$10$kFTkDSSDXYivXOstshk88OVVP.S8oOnOYCJdixHsZ2BjV9Mz7zMPu', NULL, '2019-12-12 22:47:44', '2019-12-12 22:47:44'),
(13, 'Avinash Shah', 'shah.avinash1090@gmail.com', NULL, '$2y$10$G9M2pjFxbxUr07WKZsIu1umhd1bRvGC32ZH5IZh0NzqODkBjQL8Si', NULL, '2019-12-13 15:52:43', '2019-12-13 15:52:43'),
(14, 'Ravi Manandhar', 'manandharravi@yahoo.com', NULL, '$2y$10$VnD19HVTBBZHTr6BPo.EWuxsX/yMwVH3QjrUfwXHXing14d0JWjui', NULL, '2019-12-17 19:27:01', '2019-12-17 19:27:01'),
(15, 'Sita poudel', 'sita.poudelregmi@gmail.com', '2019-12-20 15:40:06', '$2y$10$FmH2YPC0TxcBhJgMVfgUe.CLooTwAUk3cXB4scWq.snQ7ElLKMNsO', NULL, '2019-12-20 15:17:52', '2019-12-20 15:40:06'),
(16, 'Rosha Tandukar', 'rusatandukar@gmail.com', NULL, '$2y$10$RpiMTGhu86LPUo7zeG7GQ.L0JSjgub9HlzHqetkAEVKV1skCLLhj.', NULL, '2019-12-21 16:23:53', '2019-12-21 16:23:53'),
(17, 'Binish Shrestha', 'binishshrestha7@gmail.com', '2019-12-23 17:10:28', '$2y$10$OacrmdEio1TJJYEYWOVo9eflziZdFSrwzA3jQRVN9PFvLUpsVQYCq', NULL, '2019-12-23 17:05:17', '2019-12-23 17:10:28'),
(18, 'Abinash kumar mandal', 'friendfind44@gmail.com', NULL, '$2y$10$lxv2YVbpr.r2YKI28RLNmuWrZ2pMnaSXdA.G1nbpMRtUPy4otT/8K', NULL, '2019-12-24 17:26:26', '2019-12-24 17:26:26'),
(19, 'Dixya', 'dikshyaadhikari2327@gmail.com', '2019-12-25 14:22:08', '$2y$10$TQF5Aj7Km5S3L8s5HqIX.OhvSjSpL45LtagSMCmTv6z/KPPWCeJeq', 'YKZw9QKFIShB8kTeZ1osp0CX4SyyMwzkLTQiMRWzQop0btla9q5H0TfdoxQy', '2019-12-25 14:14:49', '2019-12-25 14:22:08'),
(20, 'Narayan Daga', 'narayandagabrt@gmail.com', NULL, '$2y$10$iRLR/oEjeVdhqX8TT4DHWetA9i/Y6Sw9ygSnqND.WsaMtg8SDczam', NULL, '2019-12-25 15:17:54', '2019-12-25 15:17:54'),
(21, 'Robinson Shrestha', 'iamrabba@gmail.com', '2019-12-26 18:08:39', '$2y$10$7kxtpkzAIvvWNL3xupPFyen.rVxxSO6Wn5poasJfg43OB/OGy8q7C', NULL, '2019-12-26 18:07:38', '2019-12-26 18:08:39'),
(22, 'HarshUjin', 'dorjinharsh@gmail.com', '2019-12-30 17:22:00', '$2y$10$xk9SgxFCiPUEng9XJv2kou6B1oTojUk93p4y8HF7VSS7seS13iZP6', NULL, '2019-12-30 17:20:52', '2019-12-30 17:22:00'),
(23, 'Smarika Shrestha', 'smarikashrs@gmail.com', NULL, '$2y$10$MCqAs2BkIsObCPz//UXA7OmtbXTr4NqsQAngUt6FV5CUqeO.h7MwC', NULL, '2019-12-31 11:07:19', '2019-12-31 11:07:19'),
(24, 'Bhupendra Yadav', 'bhupendraya011@gmail.com', NULL, '$2y$10$i9wsZsNVZcAOmtveEacp0uPaI68OjnDK6VxEo6B/4Pw.veMHKdmy.', 'Yv1IttRa2FpXIqdRMvXvSnU1KwHx8SEDpk6u5K6ts0ax1145S5Mi3KUXnzxM', '2019-12-31 13:14:40', '2019-12-31 13:14:40'),
(25, 'Shikha sha', 'nadeema9665@gmail.com', NULL, '$2y$10$UdoL2M7NDBQ8f/UCHFQ.buRFGYf2ioMxkvVBgBCw/vRNlBSBZC3aa', NULL, '2020-01-02 08:09:25', '2020-01-02 08:09:25'),
(26, 'Biplaw Raj Khanal', 'bips2041@gmail.com', '2020-01-02 18:19:14', '$2y$10$QT.KtMmqxigHn19sjJHw8ebdp/U6piyW6OFAR7j4FOHHiYRNU5JOG', NULL, '2020-01-02 18:17:14', '2020-01-02 18:19:14'),
(27, 'Aayush karn', 'aayushkarn2@gmail.com', NULL, '$2y$10$8hp5Vth56E.TZCn4jSdts.pDdbbBMWE5NG4h3PKs5TGcwSU62CboK', NULL, '2020-01-05 11:55:11', '2020-01-05 11:55:11'),
(28, 'Nitika Dhakal', 'tigernitu@gmail.com', '2020-01-05 19:01:46', '$2y$10$nA/n1RyhbobM5Von8nwkZ.iyM3N5j.SKGvvE.Kfr5LhsRN/5S8AyK', NULL, '2020-01-05 18:57:04', '2020-01-05 19:01:46'),
(29, 'ISHAN DHAKAL', 'ishandhakal082@gmail.com', '2020-01-09 21:30:01', '$2y$10$H09Op6mTD1AAkwLXhBMdu.aSxUl195pGjdXkDbpbTRT10nmxB67ym', NULL, '2020-01-09 21:29:25', '2020-01-09 21:30:01'),
(30, 'Pratigya Rijal', 'smilling_pratigya@yahoo.com', '2020-01-14 16:07:09', '$2y$10$70rafdQfg5izCXoDtE5IUuE1.qXXvrMyZ83th4yFje8ukD9DkqyYq', NULL, '2020-01-14 16:05:44', '2020-01-14 16:07:09'),
(31, 'Play', 'playstorecnx13@gmail.com', NULL, '$2y$10$DDeDPNi8nOZJgETeAI3zMu9N8TO4.wYK4SNl1v9me7cjucqd5wxZi', NULL, '2020-01-17 23:10:31', '2020-01-17 23:10:31'),
(32, 'Saurav Khatiwada', 'sauravkhatiwada47@gmail.com', '2020-01-24 17:18:17', '$2y$10$dDdrNxRBs2iHrk8WJE6dNOiuHolauewGbo1vfM/c2cPJHG.WUmcDq', 'LOcpjo2I4sFF0Pm9owqc1xBHVGCiImXWjkOb2RFJVtsILvUQwCSuxQYQCn8z', '2020-01-24 17:12:56', '2020-01-24 17:18:17'),
(33, 'Pranish Bhagat', 'bhagatpranish@gmail.com', '2020-01-26 15:00:23', '$2y$10$DnsxB77JVpO9JJ1cesPFwOLpe5.sOWSnK6qaKebxWeg3IlKJ311Ky', NULL, '2020-01-26 14:53:39', '2020-01-26 15:00:23'),
(34, 'Megha Mohit Karnani', 'meghaatal1@gmail.com', '2020-01-28 03:28:28', '$2y$10$iENvpVGG6e4Fip1rDIVnCuDiZqsLx5/37iCCh4Nvg3htfFK7rg.qe', NULL, '2020-01-28 03:23:30', '2020-01-28 03:28:28'),
(35, 'Arihant', 'arihantdudheria23@gmail.com', NULL, '$2y$10$n95fCd4ptkt7n9uIKCQ3IuoJXjWOZmT3cKRoNKggeTFl.sCpNW4AK', NULL, '2020-02-05 15:41:02', '2020-02-05 15:41:02'),
(36, 'Khusboo shah', 'khusbooshah6767@gmail.com', NULL, '$2y$10$4cfwVkmK6iVJ2F3MNwLMheAE1Rv4A06HX2Ys.RDnngy3UM8gOwXu.', NULL, '2020-02-06 01:04:18', '2020-02-06 01:04:18');

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
