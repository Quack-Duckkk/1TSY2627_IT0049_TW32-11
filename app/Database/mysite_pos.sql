-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 06:31 PM
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
-- Database: `mysite_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Maria Santos', 'maria.santos@example.com', '0917-111-2222', '2026-10-10 11:28:50'),
(2, 'Juan Dela Cruz', 'juan.delacruz@example.com', '0918-333-4444', '2026-10-10 11:28:50'),
(3, 'Ana Reyes', 'ana.reyes@example.com', '0919-555-6666', '2026-10-10 11:28:50'),
(4, 'Carlos Garcia', 'carlos.garcia@example.com', '0920-777-8888', '2026-10-10 11:28:50'),
(6, 'Glenber Maano', 'glnbr@example.com', '12345678910', '2026-10-10 10:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock_quantity`, `image`, `is_active`, `created_at`) VALUES
(1, 'Ballpen (Blue)', 12.00, 100, NULL, 1, '2026-10-10 22:24:36'),
(2, 'Notebook', 45.50, 50, NULL, 1, '2026-10-10 22:24:36'),
(3, 'Bottled Water 500ml', 20.00, 80, NULL, 1, '2026-10-10 22:24:36'),
(4, 'Instant Noodles', 15.75, 120, NULL, 1, '2026-10-10 22:24:36'),
(5, 'Rice 1kg', 58.00, 39, '1791644100_9608e10c884e172bd5c9.jpg', 1, '2026-10-10 22:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `customer_id`, `sold_by`, `quantity`, `total_price`, `created_at`) VALUES
(1, 5, 6, 1, 1, 58.00, '2026-10-10 14:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `created_at`, `avatar`) VALUES
(1, 'admin', '$2y$10$2A1WTszblgl.MDY6oUZFSOVvnhJBGbhp8hicuDPIm4Ew03uPemUqm', 'Glen', '2026-10-10 11:28:50', '1791631432_057a927e7e87f10c36a0.png'),
(2, 'cashier1', '$2y$10$UXV6mlPUWT4OWzalH8zTguoLyI41NxJq9wZHiyKwBw0vU4MvoF3sW', 'Maria Santos', '2026-10-10 11:28:50', NULL),
(3, 'cashier2', '$2y$10$UXV6mlPUWT4OWzalH8zTguoLyI41NxJq9wZHiyKwBw0vU4MvoF3sW', 'Juan Dela Cruz', '2026-10-10 11:28:50', NULL),
(4, 'manager1', '$2y$10$UXV6mlPUWT4OWzalH8zTguoLyI41NxJq9wZHiyKwBw0vU4MvoF3sW', 'Ana Reyes', '2026-10-10 11:28:50', NULL),
(5, 'staff1', '$2y$10$UXV6mlPUWT4OWzalH8zTguoLyI41NxJq9wZHiyKwBw0vU4MvoF3sW', 'Carlos Garcia', '2026-10-10 11:28:50', NULL),
(8, 'Gln', '$2y$10$v6MYwqc4sRHeAqaQ0gF89.V4DeMRNao6VX.fA/0h001O/dTE9LnLW', 'Glen Maano', '2026-10-10 15:38:12', '1791647072_a5c88627a8ad463f1ceb.jpg'),
(9, 'testmember', '$2y$10$seIslz.S4r1wXFhG/YrK9OIJL6kx7Msh1N.R39r/6CuXHjsOF//Ii', 'jamal schematics', '2026-10-10 15:38:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `sold_by` (`sold_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
