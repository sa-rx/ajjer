-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 يونيو 2020 الساعة 15:58
-- إصدار الخادم: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14231470_ajeer`
--

-- --------------------------------------------------------

--
-- بنية الجدول `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `contact_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `document` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- إرجاع أو استيراد بيانات الجدول `messages`
--

INSERT INTO `messages` (`id`, `service_id`, `contact_name`, `email`, `document`, `message`) VALUES
(65, 1, 'فارس', 's-ra1@outlook.com', '', 'zzz'),
(66, 1, 'zsxsx', 's-ra1@outlook.com', '', 'zzz'),
(68, 1, 'salman abdulrahman nazer', 's-ra1@outlook.com', '', 'zz'),
(93, 1, 'فارس', 's-ra1@outlook.com', '', 'aa'),
(94, 1, 'فارس', 's-ra1@outlook.com', '', 'lkjhgfdsdfghjkl;&#39;/'),
(95, 1, 'فارس', 's-ra1@outlook.com', '', 'lkjhgfdsdfghjkl;&#39;/'),
(96, 1, 'فارس', 'mahawy1420@gmail.com', '', '952148965486248624896214862[poiujhygfghjkl;lkjhgbvbhjkl;&#39;[poiu56789plkn'),
(97, 1, 'فارس', 'mahawy1420@gmail.com', '15914220022019-03-11 (3).png', 'dfggf'),
(98, 1, 'فارس', 's-ra1@outlook.com', '', 'منت'),
(99, 9, 'فارس', 's-ra1@outlook.com', '', 'كمنى'),
(100, 9, 'فارس', 's-ra1@outlook.com', '', 'نتالار');

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- إرجاع أو استيراد بيانات الجدول `password_reset`
--

INSERT INTO `password_reset` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(16, 44, '143e0e0b11179bbb034aadfcaaa8c2be', '2020-06-20 17:30:13', '2020-06-19 18:30:13');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `nameusr` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `number` int(10) NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `city`, `nameusr`, `number`, `image`) VALUES
(66, 'كامري2002', 'وكااااااااااله', '2002.00', 'مكه', 'اصيل', 2147483647, 'uploads/products/202006/1592863751der.jpg'),
(67, 'الوان', 'الوان اصليه', '180.00', 'الرياض', 'ريناد', 25984562, 'uploads/products/202006/1592863807خلفيات-1.png'),
(68, 'اشرطه سوني', 'نيد فور سبيد ,فورت نايت , ببجي', '15.00', 'جده', 'سعد', 5575665, 'uploads/products/202006/1592863901ret.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- إرجاع أو استيراد بيانات الجدول `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
(1, 'طلب اضافه ميزه للموقع', 'ت', '50.00'),
(9, 'مشكله تقنيه ', '00', '50.00'),
(10, 'اخرى', 'ءسئ', '50.00');

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `app_name` varchar(64) COLLATE utf8mb4_bin NOT NULL DEFAULT 'service app',
  `app_note` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `app_name`, `app_note`) VALUES
(2, 'sa@as.com', 'أجّر', 'لتاجير الاغراص اللي ما تحتاجها');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`, `created_at`) VALUES
(38, 'admin@admin.com', 'rawan', '$2y$10$VWI6QQNUYH9Gu7nXlJ7Qj.aSS/ClbB2N7McIBnHMsKz3YA9BNlq8q', 'user', '2020-05-12 03:02:15'),
(44, 's-ra1@outlook.com', 'salman nazer', '$2y$10$9XYdtXlEyVackLXmJDKA1uZ0jXAi/oP5NStcPE6s.VXXRmAv90RSO', 'admin', '2020-05-14 09:11:16'),
(50, 'mahawy1420@gmail.com', 'maha', '$2y$10$fIqstBD27lRRSg3dk2fmYuOPEWMDT473jrOrkdSXDAICnrgJ17Y2i', 'user', '2020-06-05 23:23:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_service_id` (`service_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_services_id` (`nameusr`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- القيود للجدول `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
