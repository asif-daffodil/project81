-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4308
-- Generation Time: Apr 02, 2024 at 07:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce81`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `receiver_phone` varchar(150) NOT NULL,
  `receiver_address` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total`, `receiver_name`, `receiver_phone`, `receiver_address`, `status`, `reg_date`) VALUES
(1, 1, 4, 1, 600, 'Asif Mohammad Abir', '01955517560', '9 Sher-E-Bangla Road\nHazaribagh', 'Ordered', '2024-04-02 05:34:17'),
(2, 1, 6, 2, 1800, 'Asif Mohammad Abir', '01955517560', '9 Sher-E-Bangla Road\nHazaribagh', 'Ordered', '2024-04-02 05:34:17'),
(3, 1, 5, 1, 2100, 'Asif Mohammad Abir', '01955517560', '9 Sher-E-Bangla Road\nHazaribagh', 'Ordered', '2024-04-02 05:34:17'),
(4, 1, 7, 1, 2300, 'Asif Mohammad Abir', '01955517560', '9 Sher-E-Bangla Road\nHazaribagh', 'Ordered', '2024-04-02 05:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `regular_price`, `sale_price`, `image`, `description`, `created_at`) VALUES
(1, 'Jay Namaz', 400, 300, '1712035701_1710568536_634f260bb81ee5008f2d0c84-safa-off-whiteblack-beautiful-turkish.jpg', 'Indonesian Jaynamaz', '2024-04-02 05:28:21'),
(2, 'Tazbi', 300, 200, '1712035825_1710222786_tajbi.jpg', 'Pakistani Tazbi', '2024-04-02 05:30:25'),
(3, 'Quran Sharif', 600, 500, '1712035853_1710222946_unnamed.png', 'Arabian Quran', '2024-04-02 05:30:53'),
(4, 'Zamzam Water', 800, 600, '1712035897_1710822864_zamzam-water-5l-1024x1024.jpg', 'Zamzam Water', '2024-04-02 05:31:37'),
(5, 'Indian Atar', 400, 300, '1712035921_1710822793_Ator-.png.jpg', 'Indian', '2024-04-02 05:32:01'),
(6, 'Khejur', 700, 600, '1712035995_1710823007_product_1583564008.jpg', 'Arabian Khejur', '2024-04-02 05:33:15'),
(7, 'Shurma', 300, 200, '1712036020_1710823669_arabic-eyeliner.jpg', 'Afgani Shurma', '2024-04-02 05:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(150) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `password` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `image`, `role`, `password`, `created_at`) VALUES
(1, 'Asif Abir', 'abir@dipti.com.bd', '', '', '', 'admin', '$2y$10$LKQNtKbDpEdnwHpQxkgu2uVf5wLc9roZqSxSKigz.W.12RH2LBeBC', '2024-04-02 05:19:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
