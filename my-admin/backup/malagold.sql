-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 11:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malagold`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `converted_scrab`
--

CREATE TABLE `converted_scrab` (
  `id` int(11) NOT NULL,
  `pathorId` varchar(255) NOT NULL,
  `scrabId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customerId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `custom_orders`
--

CREATE TABLE `custom_orders` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `customerId` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `subTotal` double NOT NULL,
  `totalDiscount` double NOT NULL,
  `grandTotal` double NOT NULL,
  `totalAdvance` double NOT NULL,
  `totalBalance` double NOT NULL,
  `deliveryDate` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `custom_order_advance`
--

CREATE TABLE `custom_order_advance` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `scrabId` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `advanceRupee` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `custom_order_items`
--

CREATE TABLE `custom_order_items` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` double NOT NULL,
  `karat` double NOT NULL,
  `weight` double NOT NULL,
  `polish` double NOT NULL,
  `labor` double NOT NULL,
  `beats` double NOT NULL,
  `etc` double NOT NULL,
  `total` double NOT NULL,
  `sendTo` varchar(255) NOT NULL,
  `workerKarat` double NOT NULL,
  `workerETC` double NOT NULL,
  `pureWeight` double NOT NULL,
  `purePrice` double NOT NULL,
  `todayRate` double NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gold_pathor_stock`
--

CREATE TABLE `gold_pathor_stock` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `weight` double NOT NULL,
  `previousTotalWeight` double NOT NULL,
  `previousTotalPrice` double NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gold_piece_stock`
--

CREATE TABLE `gold_piece_stock` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `weight` double NOT NULL,
  `initial_price` double NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gold_stock`
--

CREATE TABLE `gold_stock` (
  `id` int(11) NOT NULL,
  `p_key` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `productType` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `karat` double NOT NULL,
  `quantity` double NOT NULL,
  `weight` double NOT NULL,
  `initial_price` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `stockGroup` varchar(255) NOT NULL,
  `investorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int(11) NOT NULL,
  `investorsId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `invoiceId` varchar(255) NOT NULL,
  `payment` double NOT NULL,
  `extraNote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rate_list`
--

CREATE TABLE `rate_list` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `buying` double NOT NULL,
  `selling` double NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `saleId` varchar(255) NOT NULL,
  `customerId` varchar(255) NOT NULL,
  `subTotal` double NOT NULL,
  `beats` double NOT NULL,
  `etc` double NOT NULL,
  `discount` double NOT NULL,
  `grandTotal` double NOT NULL,
  `category` varchar(255) NOT NULL,
  `paid` double NOT NULL,
  `expDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `saleId` varchar(255) NOT NULL,
  `pId` varchar(255) NOT NULL,
  `karat` double NOT NULL,
  `weight` double NOT NULL,
  `polish` double NOT NULL,
  `labor` double NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale_stones`
--

CREATE TABLE `sale_stones` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `saleId` varchar(255) NOT NULL,
  `stoneId` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `total_weight` double NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scrab_stock`
--

CREATE TABLE `scrab_stock` (
  `id` int(11) NOT NULL,
  `scrabId` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `karat` varchar(255) NOT NULL,
  `initial_weight` double NOT NULL,
  `pure_weight` double NOT NULL,
  `dust` double NOT NULL,
  `ratiMashy` double NOT NULL,
  `nag` double NOT NULL,
  `labFee` double NOT NULL,
  `etc` double NOT NULL,
  `discount` double NOT NULL,
  `purePrice` double NOT NULL,
  `category` varchar(255) NOT NULL,
  `rate` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stones_stock`
--

CREATE TABLE `stones_stock` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_weight` double NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `workerId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `worker_payments`
--

CREATE TABLE `worker_payments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `itemId` varchar(255) NOT NULL,
  `workerId` varchar(255) NOT NULL,
  `rupee` double NOT NULL,
  `weight` double NOT NULL,
  `payIn` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `converted_scrab`
--
ALTER TABLE `converted_scrab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_order_advance`
--
ALTER TABLE `custom_order_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_order_items`
--
ALTER TABLE `custom_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_pathor_stock`
--
ALTER TABLE `gold_pathor_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_piece_stock`
--
ALTER TABLE `gold_piece_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_stock`
--
ALTER TABLE `gold_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_list`
--
ALTER TABLE `rate_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_stones`
--
ALTER TABLE `sale_stones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scrab_stock`
--
ALTER TABLE `scrab_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stones_stock`
--
ALTER TABLE `stones_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_payments`
--
ALTER TABLE `worker_payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `converted_scrab`
--
ALTER TABLE `converted_scrab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_orders`
--
ALTER TABLE `custom_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_order_advance`
--
ALTER TABLE `custom_order_advance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_order_items`
--
ALTER TABLE `custom_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gold_pathor_stock`
--
ALTER TABLE `gold_pathor_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gold_piece_stock`
--
ALTER TABLE `gold_piece_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gold_stock`
--
ALTER TABLE `gold_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_list`
--
ALTER TABLE `rate_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_stones`
--
ALTER TABLE `sale_stones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scrab_stock`
--
ALTER TABLE `scrab_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stones_stock`
--
ALTER TABLE `stones_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker_payments`
--
ALTER TABLE `worker_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
