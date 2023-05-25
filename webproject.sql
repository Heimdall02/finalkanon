-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 05:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, '', 'admin@email.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `image`, `quantity`, `size`) VALUES
(73, 0, 'Nike Hangin 100', 3999, 'prdM-4.jpg', 3, '11'),
(81, 2, 'Product 2', 999, 'prdK-2.jpg', 3, '5'),
(82, 2, 'Nike Air Max 1', 5999, 'PrdM-5.jpg', 1, '6');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`) VALUES
(1, 'try', 'user2@gmail.com', 'this is a test');

-- --------------------------------------------------------

--
-- Table structure for table `kids_products`
--

CREATE TABLE `kids_products` (
  `Id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kids_products`
--

INSERT INTO `kids_products` (`Id`, `name`, `price`, `image`) VALUES
(1, 'Product 1', 1599, 'prdK-1.jpg'),
(2, 'Product 2', 999, 'prdK-2.jpg'),
(3, 'Product 3', 999, 'prdK-3.jpg'),
(4, 'Product 4', 999, 'prdK-4.jpg'),
(5, 'Product 5', 1499, 'prdK-5.jpg'),
(6, 'Product 6', 999, 'prdK-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mens_products`
--

CREATE TABLE `mens_products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mens_products`
--

INSERT INTO `mens_products` (`id`, `name`, `price`, `image`) VALUES
(4, 'Nike Air Max 1', 5999, 'PrdM-5.jpg'),
(5, 'Nike Zoom 2', 2999, 'prdM-6.jpg'),
(14, 'Nike Hangin 100', 3999, 'prdM-4.jpg'),
(16, 'Nike LeBron', 9999, 'prdM-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `amount_payable` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `name`, `contact`, `amount_payable`, `payment_method`, `shipping_address`, `status`) VALUES
(22, 2, '2023-05-19 22:33:47', 'uno', '333333333', '4999', 'Cash on Delivery', 'dos', 'Pending'),
(23, 2, '2023-05-19 22:43:03', 'Unigo Rafael', '92489579247', '4797', 'Credit Card', 'Marcos', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`) VALUES
(1, 'sidney', 'sidney02ligot@gmail.com', '76d80224611fc919a5d54f0ff9fba446'),
(2, 'user2', 'user2@gmail.com', '7815696ecbf1c96e6894b779456d330e'),
(3, 'Alex', 'alex@gmail.com', '62cd43b670f7e4ec902b5c7acb4d33d5'),
(4, 'Elon', 'elon@email.com', '9e887375eaba77dc7568e4048268520e');

-- --------------------------------------------------------

--
-- Table structure for table `women_products`
--

CREATE TABLE `women_products` (
  `Id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `women_products`
--

INSERT INTO `women_products` (`Id`, `name`, `price`, `image`) VALUES
(1, 'Adidas', 2999, 'adidas1.png'),
(2, 'Air Force 1', 2999, 'airforce1.png'),
(3, 'Pegasus 40', 4999, 'Pegasus40.png'),
(4, 'Vaporfly 3', 6599, 'Vaporfly3.png'),
(5, 'Nike Zoom Out', 5999, 'product2.jpg'),
(6, 'trya', 987, 'simultaneous-contrasts-sun-and-moon.jpg!Large.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kids_products`
--
ALTER TABLE `kids_products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mens_products`
--
ALTER TABLE `mens_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `women_products`
--
ALTER TABLE `women_products`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kids_products`
--
ALTER TABLE `kids_products`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mens_products`
--
ALTER TABLE `mens_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `women_products`
--
ALTER TABLE `women_products`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
