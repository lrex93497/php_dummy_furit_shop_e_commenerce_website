-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 08:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruity_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `passcode` varchar(255) DEFAULT NULL,
  `login_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `passcode`, `login_name`) VALUES
(1, '$2y$10$eIRyhLf5HEBks60gqoZlROA/vIw5bjHMmOzsMlFwPokUF6seCuZYO', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cus_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `no_on_cart` int(11) DEFAULT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passcode` varchar(255) DEFAULT NULL,
  `login_name` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `address`, `phone_no`, `email`, `passcode`, `login_name`, `create_time`) VALUES
(1, 'test1name', 'testadress', '12123434', 'test1@test.com', '$2y$10$vPRUgiU1HG.q0Tr0f17uSuF6joQ.7ujdhDTOAXLcdQVhKDVB9UXv2', 'test1', '2022-12-19 08:50:43'),
(2, 'test2name', 'test2address', '32323232', 'test2@gg', '$2y$10$XaNdrUZXOWxHOhsJkHSlBOkQmFNzEjFMB1XWKnK09SMMl3erx5erm', 'test2', '2022-12-19 09:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `fruit_product`
--

CREATE TABLE `fruit_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `stock_no` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `product_image_dir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fruit_product`
--

INSERT INTO `fruit_product` (`product_id`, `product_name`, `stock_no`, `price`, `product_image_dir`) VALUES
(1, 'apple', 7, 5, 'img/apple.png'),
(2, 'banana', 8, 3, 'img/banana.png'),
(3, 'kiwi', 5, 6, 'img/kiwi.png'),
(4, 'lemon', 7, 3, 'img/lemon.png'),
(5, 'mango', 13, 7.5, 'img/mango.png'),
(6, 'melon', 2, 23.3, 'img/melon.png'),
(7, 'orange', 6, 4.5, 'img/orange.png'),
(8, 'peach', 5, 7, 'img/peach.png'),
(9, 'pear', 42, 5, 'img/pear.png'),
(11, 'passion', 7, 5.6, 'img/passion.png'),
(14, 'a empty stock', 0, 4, 'img/apple.png'),
(15, 'a empty stock2', 0, 4, 'img/orange.png');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `no_product` varchar(255) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `order_lot_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `no_product`, `cus_id`, `order_lot_id`) VALUES
(1, '3', '5', 1, 1),
(2, '2', '3', 1, 1),
(3, '7', '8', 1, 1),
(4, '1', '5', 1, 1),
(5, '3', '5', 1, 2),
(6, '8', '5', 1, 2),
(7, '7', '2', 1, 13),
(8, '5', '2', 1, 13),
(10, '7', '1', 1, 14),
(11, '5', '2', 1, 14),
(12, '9', '2', 1, 14),
(13, '4', '2', 2, 15),
(14, '5', '3', 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `order_lot`
--

CREATE TABLE `order_lot` (
  `order_lot_id` int(11) NOT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `pay_proof` varchar(255) DEFAULT NULL,
  `accept_state` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `shipment_state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_lot`
--

INSERT INTO `order_lot` (`order_lot_id`, `cus_id`, `pay_proof`, `accept_state`, `create_time`, `shipment_state`) VALUES
(1, '1', 'ADI3H53BEUUDSFS', '1', '2022-12-19 10:42:42', '1'),
(2, '1', '321321421', '1', '2022-12-19 10:42:56', '1'),
(13, '1', '', '1', '2022-12-20 01:07:01', '1'),
(14, '1', '', '0', '2022-12-20 01:12:21', '0'),
(15, '2', '12345', '1', '2022-12-20 03:01:30', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD UNIQUE KEY `login_name` (`login_name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD UNIQUE KEY `cart_id` (`cart_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_id` (`cus_id`),
  ADD UNIQUE KEY `login_name` (`login_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `fruit_product`
--
ALTER TABLE `fruit_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `order_lot`
--
ALTER TABLE `order_lot`
  ADD UNIQUE KEY `order_lot_id` (`order_lot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fruit_product`
--
ALTER TABLE `fruit_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_lot`
--
ALTER TABLE `order_lot`
  MODIFY `order_lot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
