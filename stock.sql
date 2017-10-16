-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2017 at 09:51 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tk_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(200) NOT NULL,
  `date_recode` varchar(200) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `branch_phone` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `branch_type_id` int(200) NOT NULL,
  `emp_id` int(200) NOT NULL,
  `branch_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch_type`
--

CREATE TABLE `branch_type` (
  `branch_type_id` int(200) NOT NULL,
  `branch_type_name` varchar(200) NOT NULL,
  `branch_type_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(100) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `note_cate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(100) NOT NULL,
  `name_khmer` varchar(200) NOT NULL,
  `name_english` varchar(200) NOT NULL,
  `start_on` varchar(20) NOT NULL,
  `position_id` int(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `emp_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE `exchange` (
  `exchange_id` int(100) NOT NULL,
  `exchange` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`exchange_id`, `exchange`, `note`) VALUES
(1, '4100', 'áŸ¡â€‹ ážŠáž»áž›áŸ’áž›áž¶ážšâ€‹â€‹ ážŸáŸ’áž˜áž¾ážš 4100 áŸ›');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(20) NOT NULL,
  `position` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position`, `note`) VALUES
(1, 'manager', 'manager'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `name_en` varchar(200) NOT NULL,
  `name_kh` varchar(200) NOT NULL,
  `price_dolla` decimal(10,2) NOT NULL,
  `price_riel` decimal(10,2) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `note_pro` varchar(200) NOT NULL,
  `cate_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `in_id` int(100) NOT NULL,
  `date_in` varchar(30) NOT NULL,
  `code_in` varchar(200) NOT NULL,
  `pro_id` int(50) NOT NULL,
  `qty_in` int(50) NOT NULL,
  `qty_left` int(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payamount` decimal(10,2) NOT NULL,
  `rest_amount` decimal(10,2) NOT NULL,
  `expire_date` varchar(50) NOT NULL,
  `note_in` varchar(200) NOT NULL,
  `vender_id` int(50) NOT NULL,
  `emp_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockin_report`
--

CREATE TABLE `stockin_report` (
  `stockin_id` int(100) NOT NULL,
  `date_in` varchar(80) NOT NULL,
  `code_in` varchar(200) NOT NULL,
  `pro_id` int(50) NOT NULL,
  `qty_in` int(50) NOT NULL,
  `qty_left` int(100) NOT NULL,
  `qty_addmore` int(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payamount` decimal(10,2) NOT NULL,
  `rest_amount` decimal(10,2) NOT NULL,
  `expire_date` varchar(50) NOT NULL,
  `note_reportin` varchar(200) NOT NULL,
  `vender_id` int(50) NOT NULL,
  `emp_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `transaction_id` int(11) NOT NULL,
  `out_date` varchar(100) NOT NULL,
  `code_out` varchar(200) NOT NULL,
  `pro_nameen` varchar(200) NOT NULL,
  `pro_namekh` varchar(200) NOT NULL,
  `cate_id` int(100) NOT NULL,
  `qty_out` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `branch_id` int(100) NOT NULL,
  `emp_id` int(200) NOT NULL,
  `approve` int(1) NOT NULL,
  `out_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockout_report`
--

CREATE TABLE `stockout_report` (
  `stockin_id` int(11) NOT NULL,
  `date_in` varchar(80) NOT NULL,
  `code_in` varchar(200) NOT NULL,
  `pro_id` int(50) NOT NULL,
  `qty_in` int(50) NOT NULL,
  `qty_left` int(100) NOT NULL,
  `qty_minus` int(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payamount` decimal(10,2) NOT NULL,
  `rest_amount` decimal(10,2) NOT NULL,
  `expire_date` varchar(50) NOT NULL,
  `note_reportin` varchar(200) NOT NULL,
  `vender_id` int(50) NOT NULL,
  `emp_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sup_type`
--

CREATE TABLE `sup_type` (
  `sup_type_id` int(100) NOT NULL,
  `sup_type_name` varchar(200) NOT NULL,
  `sup_type_note` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `u_id` int(200) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `u_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `position_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `position_id`) VALUES
(1, 'Manager', '1d0258c2440a8d19e716292b231e3190', 1),
(2, 'admin', '24b64937502a460daa1e010da028cb5a', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vat`
--

CREATE TABLE `vat` (
  `vat_id` int(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vat`
--

INSERT INTO `vat` (`vat_id`, `vat`, `note`) VALUES
(1, '0.1', '1â€‹ áž—áž¶áž‚ážšáž™â€‹â€‹ ážŸáŸ†ážšáž¶áž”áŸ‹ 1 áž˜áž»ážáž‘áŸ†áž“áž·áž‰');

-- --------------------------------------------------------

--
-- Table structure for table `vender`
--

CREATE TABLE `vender` (
  `vender_id` int(20) NOT NULL,
  `vendername_kh` varchar(200) NOT NULL,
  `vendername_en` varchar(200) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `sup_type_id` int(100) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `branch_type_id` (`branch_type_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `branch_type`
--
ALTER TABLE `branch_type`
  ADD PRIMARY KEY (`branch_type_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`exchange_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`in_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `vender_id` (`vender_id`);

--
-- Indexes for table `stockin_report`
--
ALTER TABLE `stockin_report`
  ADD PRIMARY KEY (`stockin_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `vender_id` (`vender_id`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `stockout_report`
--
ALTER TABLE `stockout_report`
  ADD PRIMARY KEY (`stockin_id`);

--
-- Indexes for table `sup_type`
--
ALTER TABLE `sup_type`
  ADD PRIMARY KEY (`sup_type_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `vat`
--
ALTER TABLE `vat`
  ADD PRIMARY KEY (`vat_id`);

--
-- Indexes for table `vender`
--
ALTER TABLE `vender`
  ADD PRIMARY KEY (`vender_id`),
  ADD KEY `sup_type_id` (`sup_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branch_type`
--
ALTER TABLE `branch_type`
  MODIFY `branch_type_id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `in_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stockin_report`
--
ALTER TABLE `stockin_report`
  MODIFY `stockin_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stockout_report`
--
ALTER TABLE `stockout_report`
  MODIFY `stockin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sup_type`
--
ALTER TABLE `sup_type`
  MODIFY `sup_type_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `u_id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vender`
--
ALTER TABLE `vender`
  MODIFY `vender_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`branch_type_id`) REFERENCES `branch_type` (`branch_type_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `category` (`cate_id`);

--
-- Constraints for table `stockin`
--
ALTER TABLE `stockin`
  ADD CONSTRAINT `stockin_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `stockin_ibfk_2` FOREIGN KEY (`vender_id`) REFERENCES `vender` (`vender_id`),
  ADD CONSTRAINT `stockin_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`);

--
-- Constraints for table `vender`
--
ALTER TABLE `vender`
  ADD CONSTRAINT `vender_ibfk_1` FOREIGN KEY (`sup_type_id`) REFERENCES `sup_type` (`sup_type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
