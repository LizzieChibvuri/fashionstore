-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2018 at 12:07 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

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
(3, '2018_03_23_143802_create_products_table', 1),
(4, '2018_03_23_195641_create_orders_table', 2),
(5, '2018_03_23_203735_create_user_accounts_table', 3),
(6, '2018_03_23_205628_create_topups_table', 4),
(7, '2018_03_23_211428_correct_topup_balance_to_amount', 5),
(8, '2018_03_25_160934_add_user_level', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_price` decimal(5,2) NOT NULL,
  `discount_amount` double(5,2) NOT NULL,
  `amount_paid` double(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `product_price`, `discount_amount`, `amount_paid`, `created_at`, `updated_at`) VALUES
(1, 2, 6, '117.00', 0.00, 117.00, '2018-03-24 08:04:35', '2018-03-24 08:04:35'),
(2, 2, 6, '117.00', 0.00, 117.00, '2018-03-24 08:09:36', '2018-03-24 08:09:36'),
(3, 2, 5, '900.00', 450.00, 450.00, '2018-03-24 11:18:23', '2018-03-24 11:18:23'),
(4, 2, 6, '117.00', 0.00, 117.00, '2018-03-24 13:12:05', '2018-03-24 13:12:05'),
(5, 4, 8, '300.00', 150.00, 150.00, '2018-03-25 19:10:20', '2018-03-25 19:10:20'),
(6, 4, 5, '900.00', 450.00, 450.00, '2018-03-25 19:13:34', '2018-03-25 19:13:34'),
(7, 4, 6, '117.00', 0.00, 117.00, '2018-03-25 19:32:00', '2018-03-25 19:32:00');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `deduct_balance` BEFORE INSERT ON `orders` FOR EACH ROW Update user_accounts set balance=balance-NEW.amount_paid where user_id=NEW.user_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deduct_stock` AFTER INSERT ON `orders` FOR EACH ROW Update products set stocklevel=stocklevel-1 where id=New.product_id
$$
DELIMITER ;

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
('customer@shop.com', '$2y$10$oCyLMaevDcwakGOScFTvUO8A6sZpVssecjIb0zzQF0JluRGOXv5Py', '2018-03-25 17:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `stocklevel` int(11) NOT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stocklevel`, `product_image`, `created_at`, `updated_at`, `discount`) VALUES
(1, 'Brown Handbag', 'Accessories', '50.00', 45, 'pocaflat_1521825222_jpg', '2018-03-23 15:13:42', '2018-03-23 15:13:42', '0.00'),
(3, 'Pretty top', 'Tops', '113.00', 0, 'pinktop_1521835296_jpg', '2018-03-23 18:01:36', '2018-03-23 18:01:36', '0.00'),
(4, 'tutu skirt', 'Skirts', '350.00', 43, 'tutu_1521874997_jpg', '2018-03-24 05:03:17', '2018-03-24 05:03:17', '0.00'),
(5, 'boots', 'Shoes', '900.00', 44, 'boot_1521875668_jpg', '2018-03-24 05:14:28', '2018-03-24 05:14:28', '0.50'),
(6, 'top', 'Tops', '117.00', 2, 'yellotop_1522010781_jpg', '2018-03-24 05:16:49', '2018-03-25 18:46:21', '0.00'),
(8, 'new', 'Shoes', '300.00', 66, 'whitetop_1522011828_jpg', '2018-03-25 19:03:48', '2018-03-25 19:03:48', '0.50');

-- --------------------------------------------------------

--
-- Table structure for table `topups`
--

CREATE TABLE `topups` (
  `id` int(10) UNSIGNED NOT NULL,
  `useraccount_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topups`
--

INSERT INTO `topups` (`id`, `useraccount_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 5, '200.00', '2018-03-25 19:31:36', '2018-03-25 19:31:36'),
(2, 5, '40000.00', '2018-03-25 20:00:51', '2018-03-25 20:00:51');

--
-- Triggers `topups`
--
DELIMITER $$
CREATE TRIGGER `update_account_balance` AFTER INSERT ON `topups` FOR EACH ROW Update  user_accounts set balance=balance+NEW.amount where id=NEW.useraccount_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userlevel` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `userlevel`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$xmfTIz4/N9wVtnbsK/WwqOmWkv7VSOewOWG.Z5ni4F8OPdTfSteCW', 'yIublWGCGIBFq5I6k54iCx5Y9InHiiFqN2RKICAfVXLdkepdFuCYFdl9URwY', '2018-03-23 13:32:30', '2018-03-23 13:32:30', 1),
(2, 'customer', 'customer@shop.com', '$2y$10$yHj7tFgK/UC0SEF2hxMmb.W7aoVM.YdG0oYqsoFoXr3LXbNoY3oYC', 'oGT36FA7TiYgJWuFUwhweidf07Fm4h7h6upaFGoVetNgglSAoWoYLIKCobRT', '2018-03-23 21:38:58', '2018-03-23 21:38:58', 0),
(4, 'test', 'customer@test.com', '$2y$10$tfVWrCcEu3Ik4u5Hj65sQu41H12vH/VFmJbdlXzFtg7kS8iFx/MvS', 'TwIiCSo63z1tDNMrtxGCzoi8viaSAw3cGfBzZoDtuYsBXKpoFQB37HkDrhDT', '2018-03-25 17:50:08', '2018-03-25 17:50:08', 0);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `adduseraccount` AFTER INSERT ON `users` FOR EACH ROW insert into user_accounts(user_id,balance) VALUES(NEW.id,0)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(2, 2, '30.00', NULL, NULL),
(4, 1, '0.00', NULL, NULL),
(5, 4, '40083.00', NULL, NULL);

--
-- Indexes for dumped tables
--

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
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

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
-- Indexes for table `topups`
--
ALTER TABLE `topups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topups_useraccount_id_foreign` (`useraccount_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_accounts_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `topups`
--
ALTER TABLE `topups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `topups`
--
ALTER TABLE `topups`
  ADD CONSTRAINT `topups_useraccount_id_foreign` FOREIGN KEY (`useraccount_id`) REFERENCES `user_accounts` (`id`);

--
-- Constraints for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD CONSTRAINT `user_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
