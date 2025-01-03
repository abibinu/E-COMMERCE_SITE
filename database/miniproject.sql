-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 07:15 AM
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
-- Database: `miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `mostsearched`
--

CREATE TABLE `mostsearched` (
  `sid` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `word` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mostsearched`
--

INSERT INTO `mostsearched` (`sid`, `user_id`, `word`) VALUES
(6, '66e7c6ba95361', 'jordan'),
(7, '66e7c6ba95361', 'jordan'),
(8, '66e7c6ba95361', 'jordan'),
(9, '66e7c6ba95361', 'jordan'),
(11, '66e7c6ba95361', 'air jordan'),
(12, '66e7c6ba95361', 'air jordan'),
(13, '66e7c6ba95361', 'air jordan'),
(14, '66e7c6ba95361', 'jordan'),
(15, '66e7c6ba95361', 'jordan'),
(16, '66e7c6ba95361', 'jordan'),
(17, '66e7c6ba95361', 'jordan'),
(18, '66e7d5c24c405', 'retro'),
(19, '66e7c6ba95361', 'air'),
(20, '66e7c6ba95361', 'air');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` int(50) DEFAULT NULL,
  `mobile` int(50) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `product_id`, `address`, `city`, `state`, `pincode`, `mobile`, `order_status`, `ip`) VALUES
(1, '67616ffa596f6', '2024-12-17', '4', 'Pramadom', 'Pathanamthitta', 'Kerala', 689646, 2147483647, 'pending', '::1'),
(2, '67616ffa596f6', '2024-12-17', '67504', 'Pramadom', 'Pathanamthitta', 'Kerala', 689646, 2147483647, 'cancelled', '::1'),
(3, '67616ffa596f6', '2024-12-17', '7', 'Pramadom', 'Pathanamthitta', 'Kerala', 689646, 2147483647, 'delivered', '::1'),
(4, '67616ffa596f6', '2024-12-17', '3', 'Pramadom', 'Pathanamthitta', 'Kerala', 689646, 2147483647, 'pending', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `shoe_id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `stock_quantity` int(10) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT 0,
  `offer` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`shoe_id`, `name`, `brand`, `description`, `price`, `image`, `category`, `stock_quantity`, `delete_flag`, `offer`) VALUES
(1, 'Jordan Retro', 'Nike', 'rfrr', 15000, 'WMNS+AIR+JORDAN+4+RETRO.jpg', 'sneaker', 4, 0, 1),
(2, 'AIR Jordan ', 'Nike', 'rtgrt', 12000, 'AIR+JORDAN+4+RM.png', 'sneaker', 4, 0, 1),
(3, 'Luka', 'Nike', 'hnfg', 15000, 'luka.png', 'sports', 3, 0, 0),
(4, 'Air force', 'Nike', 'gtg', 10000, 'airforce.png', 'sports', 2, 0, 0),
(5, 'Blazer', 'Nike', 'gbfg', 10000, 'blazer.png', 'sports', 2, 0, 0),
(6, 'Dunk', 'Nike', 'dfef', 10000, 'dunk.png', 'sports', 7, 0, 0),
(7, 'Dunk Retro', 'Nike', 'grhryhh', 8600, 'DUNK LOW RETRO.png', 'sports', 5, 0, 0),
(8, 'Air Max', 'Nike', 'yhtyht', 13000, 'NIKE+AIR+MAX+1+ESS+PRM.png', 'sports', 6, 0, 0),
(9, 'Air Jordan 1', 'Nike', 'fgf', 12000, 'WMNS+AIR+JORDAN+1+MM+LOW.png', 'sports', 2, 0, 0),
(10, 'Run V2K', 'Nike', 'edfgge', 10000, 'W+NIKE+V2K+RUN.png', 'sports', 9, 0, 0),
(11, 'Cortez', 'Nike', 'edgertge', 14000, 'NIKE+CORTEZ.png', 'sports', 6, 0, 0),
(12, 'Air Rift', 'Nike', 'rgrgyugey', 15000, 'WMNS+NIKE+AIR+RIFT+BR.png', 'sports', 0, 0, 0),
(67504, 'Cygnal', 'Nike', 'egetgrht', 14000, 'NIKE+CYGNAL.png', 'boots', 4, 0, 0),
(676229, 'test', 'Nike', 'effvfd', 300, 'Screenshot 2024-12-16 162320.png', 'boots', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `shoe_id` int(11) DEFAULT NULL,
  `review` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `shoe_id`, `review`, `username`) VALUES
(1, 4, 'it is a good quality shoe', 'abi'),
(2, 4, 'good', 'abi'),
(3, 4, 'so good', 'abi'),
(4, 4, 'wow amazing', 'newuser'),
(11, 4, 'good collection\r\n', 'newuser'),
(12, 4, 'good collection\r\n', 'newuser'),
(13, 4, 'amazing shoes', 'newuser'),
(14, 4, 'wooooooow', 'newuser'),
(15, 2, 'good quality', 'newuser'),
(16, 2, 'amazing shoes', 'newuser'),
(17, 12, 'wow\r\n', 'abi'),
(18, 2, 'amazing quality', 'hello'),
(19, 7, 'good shoe', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `sizetable`
--

CREATE TABLE `sizetable` (
  `shoe_id` int(11) DEFAULT NULL,
  `sizes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizetable`
--

INSERT INTO `sizetable` (`shoe_id`, `sizes`) VALUES
(1, 7),
(1, 9),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(1, 8),
(9, 6),
(9, 7),
(9, 7),
(4, 9),
(4, 9),
(2, 7),
(2, 7),
(8, 7),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `account_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `account_type`) VALUES
('66e7c6ba95361', 'abibinu', 'abikochu007@gmail.com', 'abibinu', 'admin'),
('66e7d5c24c405', 'abi', 'abikochu@gmail.com', 'password', 'user'),
('66fbfb1c99aa9', 'newuser', 'neew@gmail.com', 'newuser', 'user'),
('6705484819e8e', 'haha', 'a@gmail.com', 'haha', 'user'),
('67616ffa596f6', 'hello', 'abikochu007@gmail.com', 'hello', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `shoe_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `shoe_id`, `product_name`, `added_date`) VALUES
(4, '66e7d5c24c405', 9, 'Air Jordan 1', '2024-09-19 08:16:13'),
(5, '66e7d5c24c405', 1, 'Jordan Retro', '2024-09-19 08:24:39'),
(6, '66e7d5c24c405', 8, 'Air Max', '2024-09-29 10:02:11'),
(7, '66fbfb1c99aa9', 9, 'Air Jordan 1', '2024-10-01 10:07:43'),
(8, '66fbfb1c99aa9', 8, 'Air Max', '2024-10-04 10:45:02'),
(9, '66e7d5c24c405', 12, 'Air Rift', '2024-10-08 11:26:34'),
(10, '6705484819e8e', 2, 'AIR Jordan ', '2024-10-08 11:27:24'),
(11, '67616ffa596f6', 2, 'AIR Jordan ', '2024-12-17 08:31:26'),
(12, '67616ffa596f6', 4, 'Air force', '2024-12-17 11:47:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mostsearched`
--
ALTER TABLE `mostsearched`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`shoe_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoe_id` (`shoe_id`);

--
-- Indexes for table `sizetable`
--
ALTER TABLE `sizetable`
  ADD KEY `shoe_id` (`shoe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `shoe_id` (`shoe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mostsearched`
--
ALTER TABLE `mostsearched`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mostsearched`
--
ALTER TABLE `mostsearched`
  ADD CONSTRAINT `mostsearched_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`shoe_id`) REFERENCES `product_details` (`shoe_id`);

--
-- Constraints for table `sizetable`
--
ALTER TABLE `sizetable`
  ADD CONSTRAINT `sizetable_ibfk_1` FOREIGN KEY (`shoe_id`) REFERENCES `product_details` (`shoe_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`shoe_id`) REFERENCES `product_details` (`shoe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
