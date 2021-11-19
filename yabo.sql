-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2021 at 04:37 AM
-- Server version: 10.3.29-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabithub_demo_trippy_taxi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_type` enum('VEHICLE') NOT NULL DEFAULT 'VEHICLE',
  `extra_field` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `post_type`, `extra_field`, `image`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'suv', 'SUV', 'VEHICLE', '30', 'https://demo.fabithub.com/trippy-taxi/uploads/category/03af4d491ab7d4e1f3139a0a92e33d3d.png', 3, 1, '2021-03-08 08:13:57', 1, '2021-08-24 11:47:21'),
(2, 'sedan', 'Sedan', 'VEHICLE', '1', 'https://demo.fabithub.com/trippy-taxi/uploads/category/5a1f4c36044a8cfee3c4d2ca59c95a82.png', 3, 1, '2021-03-08 08:21:33', 1, '2021-06-02 22:38:24'),
(3, 'mini-1', 'Mini', 'VEHICLE', '12', 'https://demo.fabithub.com/trippy-taxi/uploads/category/61e2b286194d9542f8d5c7f449f52562.png', 3, 1, '2021-03-08 08:22:01', 1, '2021-06-02 22:38:20'),
(4, 'mini-van-1', 'Mini-Van', 'VEHICLE', '50', 'https://demo.fabithub.com/trippy-taxi/uploads/category/dfca87cbdaa84aa38ae667996a039edd.png', 3, 1, '2021-03-08 08:23:23', 1, '2021-06-02 22:38:14'),
(5, 'pickup-1', 'PickUp', 'VEHICLE', '65', 'https://demo.fabithub.com/trippy-taxi/uploads/category/3ba5d25edad196339d20f7f7c85d1a79.png', 3, 1, '2021-03-08 08:24:05', 1, '2021-06-02 22:38:10'),
(6, 'test', 'Test', 'VEHICLE', '', 'https://demo.fabithub.com/trippy-taxi/uploads/category/81de8fe71138e990d20fd0e0778ba293.jpeg', 3, 1, '2021-06-01 06:16:31', 1, '2021-06-02 22:38:06'),
(7, 'chap-chap-1', 'Chap Chap', 'VEHICLE', '100', NULL, 3, 1, '2021-06-06 07:02:33', 1, '2021-07-11 01:16:19'),
(8, 'limo', 'Limo', 'VEHICLE', '250', 'https://demo.fabithub.com/trippy-taxi/uploads/category/aa109a8828adb099a4db5f2003f996ba.png', 3, 1, '2021-06-17 14:54:42', 1, '2021-06-21 05:56:20'),
(9, 'bus-1', 'Bus', 'VEHICLE', '50', 'https://demo.fabithub.com/trippy-taxi/uploads/category/c1937fce2b822c9c2a4f1565667857a6.jpeg', 1, 1, '2021-07-12 19:54:25', 1, '2021-09-17 13:15:29'),
(10, 'truck', 'Truck', 'VEHICLE', '20', 'https://demo.fabithub.com/trippy-taxi/uploads/category/bbf4a5a7c17f11b39671c2f6d14e130a.png', 1, 1, '2021-07-14 08:24:12', 1, '2021-07-14 08:24:12'),
(11, 'micro-bus', 'Micro Bus', 'VEHICLE', '14', 'https://demo.fabithub.com/trippy-taxi/uploads/category/937f9a679f316f9c516b062c6fa150df.jpeg', 1, 1, '2021-07-21 06:27:17', 1, '2021-10-23 15:52:58'),
(12, 'carro', 'Carro ', 'VEHICLE', '12', '', 3, 1, '2021-08-12 07:38:15', 1, '2021-08-14 07:07:46'),
(13, 'packagetemplate', 'packagetemplate', 'VEHICLE', '15', '', 3, 1, '2021-09-18 09:13:56', 1, '2021-09-18 09:15:28'),
(14, 'skills', 'Skills', 'VEHICLE', '20', '', 3, 1, '2021-09-18 09:15:17', 1, '2021-09-18 09:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `start_from` date DEFAULT NULL,
  `end_to` date DEFAULT NULL,
  `use_count` int(11) DEFAULT NULL,
  `max_amount` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `percentage` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `min_order_amount` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` text CHARACTER SET latin1 DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `is_active`, `start_from`, `end_to`, `use_count`, `max_amount`, `percentage`, `min_order_amount`, `description`, `created_date`, `modified_date`) VALUES
(3, '3434', 'percentage', 1, '0000-00-00', '0000-00-00', 99999, '1000', '10', '100', '010% off, Maximum discount of 0 ', '2021-07-12 19:55:37', '2021-07-12 19:55:37'),
(4, 'SONI50', 'percentage', 1, '0000-00-00', '0000-00-00', 1, '80', '50', '200', '50% off, Maximum discount of 80 ', '2021-08-24 11:50:30', '2021-08-24 11:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) NOT NULL,
  `registration_certificate` text DEFAULT NULL,
  `driving_licence` text DEFAULT NULL,
  `pollution_certificate` text DEFAULT NULL,
  `aadhar` text DEFAULT NULL,
  `pan` text DEFAULT NULL,
  `bank_account_no` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `micr` varchar(255) DEFAULT NULL,
  `ifsc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver_orders`
--

CREATE TABLE `driver_orders` (
  `id` bigint(20) NOT NULL,
  `user_order_id` bigint(20) DEFAULT NULL,
  `driver_id` bigint(20) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL COMMENT 'Price for Outdoor Trip',
  `type` enum('normal','outdoor') NOT NULL DEFAULT 'normal',
  `status` tinyint(4) DEFAULT 0 COMMENT '0: new | 1: complete | 2: accept | 3: reject | 4: pickUp user | 5: onGoing Ride',
  `is_paid` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver_payout`
--

CREATE TABLE `driver_payout` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PENDING','PROCESSING','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING' COMMENT 'PENDING = NEW REQUEST | PROCESSING = PROCESS BY ADMIN | COMPLETED = REQUEST COMPLETED',
  `transaction_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'New Request created',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `reviewer_id` bigint(20) DEFAULT NULL,
  `review` text CHARACTER SET utf8 DEFAULT NULL,
  `rate` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `option_key` varchar(255) DEFAULT NULL,
  `option_value` longtext DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_key`, `option_value`, `created_date`, `modified_date`) VALUES
(1, 'site_name', 'DC Go', '2021-05-07 19:21:31', '2021-10-29 19:18:55'),
(2, 'site_logo', 'https://demo.fabithub.com/trippy-taxi/uploads/setting/8d0f4cc0ebbf54d408a357dd842e6c0a.jpg', '2021-05-07 19:21:31', '2021-08-17 20:35:23'),
(3, 'site_currency', 'KES', '2021-05-07 19:27:17', '2021-10-29 10:47:27'),
(4, 'new_user_balance', '20', '2021-05-07 19:27:17', '2021-08-14 07:23:31'),
(5, 'admin_commission', '5', '2021-05-07 19:27:17', '2021-06-15 04:12:50'),
(6, 'tax', '0', '2021-05-07 19:27:17', '2021-08-14 07:24:13'),
(7, 'payment_squareup_mode', 'Cash', '2021-05-12 13:16:51', '2021-08-17 20:36:11'),
(8, 'payment_squareup_application_id', '', '2021-05-12 13:15:32', '2021-05-26 20:13:39'),
(9, 'payment_squareup_access_token', '', '2021-05-12 13:16:20', '2021-05-26 20:13:39'),
(10, 'payment_razorpay_mode', '', '2021-05-18 20:37:29', '2021-06-01 08:31:33'),
(11, 'payment_razorpay_key', '', '2021-05-18 20:52:42', '2021-05-26 20:13:39'),
(12, 'payment_razorpay_secret_key', '', '2021-05-18 21:00:10', '2021-05-26 20:13:39'),
(13, 'payment_paypal_mode', 'sandbox', '2021-05-18 21:02:07', '2021-05-26 20:13:39'),
(14, 'payment_paypal_business_email', '', '2021-05-18 21:00:50', '2021-05-26 20:13:39'),
(15, 'payment_paypal_client_id', '', '2021-05-18 21:02:26', '2021-05-26 20:13:39'),
(16, 'payment_paypal_secret_key', '', '2021-05-18 21:02:47', '2021-05-26 20:13:39'),
(17, 'payment_first_atlantic_commerce_mode', 'test', '2021-05-18 21:02:47', '2021-05-26 20:13:39'),
(18, 'payment_first_atlantic_commerce_merchant_id', '', '2021-05-18 21:02:47', '2021-05-26 20:13:39'),
(19, 'payment_first_atlantic_commerce_merchant_password', '', '2021-05-18 21:02:47', '2021-05-26 20:13:39'),
(22, 'payment_cielo_mode', 'test', '2021-10-13 14:42:24', '2021-10-13 17:23:57'),
(23, 'payment_cielo_merchant_id', '9a07c84d-ee45-4b68-90c9-aa527fbcf9ab', '2021-10-13 14:42:24', '2021-10-13 17:24:01'),
(24, 'payment_cielo_merchant_key', 'CTPMGtx8bh6Pec1uCbx0tenurCp0OMmfyeCodrypvhdzPabEJp', '2021-10-13 14:42:24', '2021-10-13 17:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `category_id` int(11) DEFAULT 1,
  `uuid` text DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(24) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT '0',
  `dob` date DEFAULT NULL,
  `about` text DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - New | 1 - Approve | 2 -  Pending | 3 - Delete | 4 - Block',
  `parent_id` bigint(20) DEFAULT NULL,
  `driver_id` bigint(20) DEFAULT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `location` text NOT NULL,
  `location_lat` varchar(255) NOT NULL,
  `location_long` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0 COMMENT '0: offline | 1: online | 2: busy',
  `email_verified` varchar(255) DEFAULT NULL COMMENT 'Store Verification Code or True',
  `mobile_verified` varchar(255) DEFAULT NULL COMMENT 'Store Verification Code or True',
  `google_id` varchar(255) DEFAULT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) DEFAULT NULL,
  `ref_id` bigint(20) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `user_type` enum('ADMIN','DRIVER','USER') NOT NULL DEFAULT 'USER',
  `role_id` bigint(20) DEFAULT 0 COMMENT '0 for Subscriber',
  `web_token_id` varchar(255) DEFAULT NULL,
  `app_token_id` longtext DEFAULT NULL,
  `last_login_device` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `browser_version` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `mobile_device` varchar(255) DEFAULT NULL,
  `last_login_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `category_id`, `uuid`, `user_ip`, `username`, `slug`, `email`, `mobile`, `password`, `first_name`, `last_name`, `profile_pic`, `amount`, `dob`, `about`, `gender`, `status`, `parent_id`, `driver_id`, `vehicle_id`, `location`, `location_lat`, `location_long`, `is_active`, `email_verified`, `mobile_verified`, `google_id`, `fb_id`, `address_id`, `ref_id`, `pincode`, `user_type`, `role_id`, `web_token_id`, `app_token_id`, `last_login_device`, `device_type`, `browser`, `browser_version`, `os`, `mobile_device`, `last_login_date`, `comment`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, NULL, NULL, '157.47.219.180', 'admin', 'admin', 'admin@gmail.com', '0000000000', '7f3782a95e2e7ffc2acf204d2d0e6bf4e2314c74', 'Krishna', 'Cairo', 'https://picsum.photos/200', '505757', NULL, NULL, NULL, 1, 0, NULL, NULL, '', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', 1, NULL, NULL, '', 'api', '', '', 'Unknown Platform', '', '2021-04-07 17:21:17', NULL, 0, '2020-02-17 07:20:45', 0, '2021-09-01 14:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `pickup_text` text DEFAULT NULL,
  `drop_text` text DEFAULT NULL,
  `pickup_long` varchar(255) DEFAULT NULL,
  `pickup_lat` varchar(255) DEFAULT NULL,
  `drop_long` varchar(255) DEFAULT NULL,
  `drop_lat` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `kms` varchar(255) DEFAULT NULL,
  `otp` varchar(20) DEFAULT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` enum('normal','outdoor') NOT NULL DEFAULT 'normal',
  `status` smallint(6) DEFAULT 0 COMMENT '0: new | 1: complete | 2: ongoing | 3: cancel | 4 : Booked',
  `payment_mode` varchar(30) DEFAULT 'COD',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `vehicle_no` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `toll_charges` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `manufacture_year` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `category_id`, `image`, `vehicle_no`, `brand`, `model`, `color`, `seats`, `toll_charges`, `price`, `manufacture_year`, `status`, `created_date`) VALUES
(1, 5, '', 'dsadsa', 'dasdas', 'dsadsadsa', 'asddas', '5', 'saddsa', 44, '2021-06', 3, NULL),
(2, 1, NULL, 'KCN 098K', 'Vits', 'Toyota Vits', 'White', '4', '1500', 100, '2021-06', 1, NULL),
(3, 9, NULL, '34ttt34', 'egea', 'egea', 'yellov', '4', '3,44', 100, '2021-07', 1, NULL),
(4, 11, 'https://demo.fabithub.com/trippy-taxi/uploads/vehicle/bad37d20ac3cf91c0de7d1e592117f5e.png', '1235', 'Nissan', 'Sunny', 'Red', '7', '5', 5, '2019-01', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'credit',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `transaction_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_orders`
--
ALTER TABLE `driver_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_payout`
--
ALTER TABLE `driver_payout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
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
  ADD KEY `username` (`username`,`slug`,`email`,`mobile`,`status`,`user_type`,`role_id`,`created_by`);
ALTER TABLE `users` ADD FULLTEXT KEY `first_name` (`first_name`,`last_name`,`pincode`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_orders`
--
ALTER TABLE `driver_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_payout`
--
ALTER TABLE `driver_payout`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
