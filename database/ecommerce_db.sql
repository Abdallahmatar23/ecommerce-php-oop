-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2026 at 08:36 AM
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
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-05-13 16:48:24', '2026-05-13 16:48:24'),
(2, 3, '2026-05-13 16:48:24', '2026-05-13 16:48:24'),
(3, 4, '2026-05-30 09:35:20', '2026-05-30 09:35:20'),
(4, 5, '2026-05-30 23:37:21', '2026-05-30 23:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int UNSIGNED NOT NULL,
  `cart_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`) VALUES
(1, 1, 1, 1, '2026-05-15 22:49:52'),
(2, 1, 3, 2, '2026-05-15 22:49:52'),
(3, 2, 2, 1, '2026-05-15 22:49:52'),
(4, 2, 5, 1, '2026-05-15 22:49:52'),
(5, 3, 5, 4, '2026-05-30 09:35:20'),
(6, 4, 2, 4, '2026-05-30 23:37:21'),
(7, 4, 3, 3, '2026-05-31 01:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `email`, `message`, `is_read`, `created_at`) VALUES
(1, 2, 'Ahmed Mohamed', 'ahmed@gmail.com', 'Hello, I placed an order three days ago and it has not been shipped yet. Could you please check its status?', 0, '2026-06-03 08:36:04'),
(2, 3, 'Sara Ali', 'sara@gmail.com', 'I completed my payment successfully, but my order still appears as pending. Please help.', 0, '2026-06-03 08:36:04'),
(3, NULL, 'Mohamed Tarek', 'mohamed@gmail.com', 'I would like to know when the Smart Watch will be back in stock.', 1, '2026-06-03 08:36:04'),
(4, NULL, 'Fatma Hassan', 'fatma@gmail.com', 'The website looks great. I suggest adding a wishlist feature in a future update.', 0, '2026-06-03 08:36:04'),
(5, 2, 'Ahmed Mohamed', 'ahmed@gmail.com', 'Thank you for your support. My previous issue has been resolved successfully.', 1, '2026-06-03 08:36:04'),
(6, 3, 'Sara Ali', 'sara@gmail.com', 'Can I change the shipping address after placing an order?', 0, '2026-06-03 08:36:04'),
(7, NULL, 'Omar Hassan', 'omar@gmail.com', 'Do you offer discounts for bulk purchases?', 0, '2026-06-03 08:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` enum('cash','card') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status` enum('pending','paid','processing','shipping','delivered','canceled','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `shipping_address`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '5400.00', 'Cairo, Nasr City', 'cash', 'processing', '2026-05-13 16:48:53', '2026-05-13 16:48:53'),
(2, 3, '10400.00', 'Alexandria, Smouha', 'card', 'delivered', '2026-05-13 16:48:53', '2026-05-13 16:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(1, 1, 1, 1, '3500.00', '2026-05-13 16:49:08'),
(2, 1, 3, 2, '950.00', '2026-05-13 16:49:08'),
(3, 2, 2, 1, '6200.00', '2026-05-13 16:49:08'),
(4, 2, 5, 1, '4200.00', '2026-05-13 16:49:08'),
(5, 1, 1, 1, '3500.00', '2026-05-13 16:54:49'),
(6, 1, 3, 2, '950.00', '2026-05-13 16:54:49'),
(7, 2, 2, 1, '6200.00', '2026-05-13 16:54:49'),
(8, 2, 5, 1, '4200.00', '2026-05-13 16:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `discount` decimal(2,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image_url`, `stock`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'Nike Air Max', '3500.00', 'Comfortable Nike sneakers for everyday use', 'product_6a1b78e9574190.79003923.jpg', 15, '0.25', '2026-05-21 10:42:41', '2026-05-30 23:55:21'),
(2, 'Apple AirPods Pro', '6200.00', 'Wireless noise cancellation earbuds', 'assets/store/assets/img/product/details-2.jpg', 10, '0.20', '2026-05-21 10:42:41', '2026-05-27 23:14:53'),
(3, 'Black Hoodie', '950.00', 'Premium cotton oversized hoodie', 'assets/store/assets/img/product/details-3.jpg', 25, '0.20', '2026-05-21 10:42:41', '2026-05-27 23:15:33'),
(4, 'Gaming Mouse RGB', '1200.00', 'High precision RGB gaming mouse', 'assets/store/assets/img/product/tranding-2.jpg', 18, '0.20', '2026-05-21 10:42:41', '2026-05-27 23:15:52'),
(5, 'Smart Watch', '4200.00', 'Water resistant smart watch with fitness tracking', 'assets/store/assets/img/product/tranding-3.jpg', 12, '0.30', '2026-05-21 10:42:41', '2026-05-27 23:15:57'),
(6, 'Caldwell Dixon', '274.00', 'Et et aut laboriosam', '1779989424_product-3.jpg', 52, '0.30', '2026-05-28 17:30:24', '2026-05-28 17:30:24'),
(8, 'Vera Wilson', '977.00', 'Qui quasi in est vo', 'product_6a1b898707ea11.53867830.jpg', 74, '0.15', '2026-05-31 01:06:15', '2026-05-31 01:06:15'),
(9, 'Jaden Slater', '438.00', 'Ut et velit quibusd', 'product_6a1c201a937401.79433154.jpg', 55, '0.03', '2026-05-31 11:48:42', '2026-05-31 11:48:42'),
(10, 'Cadman Morse', '524.00', 'Sint sunt sit odit', 'product_6a1c2225206c73.04785692.jpg', 82, '0.20', '2026-05-31 11:57:25', '2026-05-31 11:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin','superadmin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@drophut.com', '$2y$10$adminhash', 'admin', '', '2026-05-13 16:47:56', '2026-05-13 16:47:56'),
(2, 'Ahmed Mohamed', 'ahmed@gmail.com', '$2y$10$userhash1', 'user', '', '2026-05-13 16:47:56', '2026-05-13 16:47:56'),
(3, 'Sara Ali', 'sara@gmail.com', '$2y$10$userhash2', 'user', '', '2026-05-13 16:47:56', '2026-05-13 16:47:56'),
(4, 'Justin Santana', 'xuvo@mailinator.com', '$2y$10$cCOqKnMqPZC0mUdKJ/i1O.oyurS1ql5gzVu86In2Dtd0YO8v4G.jm', 'user', '', '2026-05-30 09:14:39', '2026-05-30 09:14:39'),
(5, 'user', 'user@user.com', '$2y$10$b/Txy9ewOeUvd1antWefK.ocLcUUhsStFSyxRX/c88oiw1N3/djU6', 'admin', '', '2026-05-30 23:37:04', '2026-05-31 09:03:05'),
(6, 'Dustin Hess', 'jowysi@mailinator.com', '$2y$10$C0t3gZIXTq8H87GaCKfyX.teFq0ib4YRMamN9mT67fzUfr6ljg.cS', 'user', '', '2026-05-31 01:08:28', '2026-05-31 01:08:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cartitems_cart` (`cart_id`),
  ADD KEY `fk_cartitems_product` (`product_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderitems_order` (`order_id`),
  ADD KEY `fk_orderitems_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cartitems_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cartitems_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contact_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orderitems_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orderitems_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
