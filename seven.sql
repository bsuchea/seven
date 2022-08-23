-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2022 at 02:13 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seven`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(1, 'MSI'),
(2, 'TUF Gaming');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'Mouse'),
(2, 'VGA'),
(3, 'Headset');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_qty` float NOT NULL,
  `item_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `invoice_total` float NOT NULL,
  `status` bit(2) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `customer_id` (`customer_id`),
  KEY `item_id` (`item_id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `item_qty`, `item_id`, `vendor_id`, `customer_id`, `created_date`, `invoice_total`, `status`) VALUES
(1, 5, 2, 1, 2, '2022-08-15', 1000, b'01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE IF NOT EXISTS `tbl_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_image` text NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `unit_price` float NOT NULL,
  `current_stock` float NOT NULL,
  `stock_in` float NOT NULL,
  `stock_out` float NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `item_description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_image`, `item_name`, `unit_price`, `current_stock`, `stock_in`, `stock_out`, `created_date`, `updated_date`, `category_id`, `brand_id`, `item_description`, `status`) VALUES
(1, '', 'MSI MUnivers', 150, 50, 100, 50, '2022-08-10', '2022-08-10', 1, 1, 'Released date 11/2/2015 High Quality, Low Budget.', 1),
(2, '', 'VGA 3060Ti MSI', 750, 460, 500, 40, '2022-08-01', '2022-08-12', 2, 1, 'Released date 22/5/2020 High Quality, Low Budget.', 1),
(3, '', 'TUF Gaming Headset H3', 170, 60, 80, 20, '2022-08-09', '2022-08-10', 3, 2, 'Released date 05/10/2022 High Quality, Low Budget.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

DROP TABLE IF EXISTS `tbl_purchase`;
CREATE TABLE IF NOT EXISTS `tbl_purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_qty` float NOT NULL,
  `purchase_unit` float NOT NULL,
  `purchase_cost` float NOT NULL,
  `purchase_date` datetime NOT NULL,
  `item_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `tbl_purchase_ibfk_1` (`brand_id`),
  KEY `tbl_purchase_ibfk_2` (`category_id`),
  KEY `tbl_purchase_ibfk_3` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`purchase_id`, `purchase_qty`, `purchase_unit`, `purchase_cost`, `purchase_date`, `item_id`, `brand_id`, `category_id`) VALUES
(1, 5, 100, 500, '2022-08-13 16:11:48', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary`
--

DROP TABLE IF EXISTS `tbl_salary`;
CREATE TABLE IF NOT EXISTS `tbl_salary` (
  `salary_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_gender` varchar(50) NOT NULL,
  `vendor_phone` varchar(100) NOT NULL,
  `vendor_email` varchar(100) NOT NULL,
  `vendor_address` varchar(100) NOT NULL,
  `salary` float NOT NULL,
  `bonus` float NOT NULL,
  `salary_date` date NOT NULL,
  PRIMARY KEY (`salary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_salary`
--

INSERT INTO `tbl_salary` (`salary_id`, `vendor_name`, `vendor_gender`, `vendor_phone`, `vendor_email`, `vendor_address`, `salary`, `bonus`, `salary_date`) VALUES
(1, 'Kimi', 'Female', '098989690', 'riilex00@gmail.com', 'Battambang Province', 800, 50, '2022-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

DROP TABLE IF EXISTS `tbl_sale`;
CREATE TABLE IF NOT EXISTS `tbl_sale` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_phone` varchar(50) NOT NULL,
  `sale_qty` float NOT NULL,
  `sale_cost` int(11) NOT NULL,
  `sale_date` datetime NOT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_detail`
--

DROP TABLE IF EXISTS `tbl_sale_detail`;
CREATE TABLE IF NOT EXISTS `tbl_sale_detail` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

DROP TABLE IF EXISTS `tbl_suppliers`;
CREATE TABLE IF NOT EXISTS `tbl_suppliers` (
  `suppliers_id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliers_name` varchar(100) NOT NULL,
  `suppliers_gender` varchar(20) NOT NULL,
  `suppliers_email` varchar(100) NOT NULL,
  `suppliers_phone` varchar(50) NOT NULL,
  `suppliers_address` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`suppliers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`suppliers_id`, `suppliers_name`, `suppliers_gender`, `suppliers_email`, `suppliers_phone`, `suppliers_address`, `status`) VALUES
(1, 'Chan Dara', 'Male', 'Chandara@gmail.com', '098989690', 'Battambang Province', 1),
(2, 'Pheak Nary', 'Female', 'Nary9999@gmail.com', '09999999', 'Pursat', 1),
(3, 'Liv Pey', 'Male', 'Livpey8888@gmail.com', '088888888', 'Preah Vihear', 1),
(4, 'Khem Sreyroth', 'Female', 'sreyroth8899@gmail.com', '066445566', 'Switzerland', 1),
(5, 'Keo Romchong', 'Male', 'Romchongsloyzin@gmail.com', '033445566', 'Takeo Province', 1),
(6, 'Ses Sovankiri', 'Female', 'riilex00@gmail.com', '098989690', 'Battambang Province', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(50) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fullname`, `user_gender`, `user_email`, `user_name`, `user_password`, `user_address`, `user_phone`, `permission`, `status`) VALUES
(1, 'Ses Sovankiri', 'Male', 'Test@gmail.com', 'kiri', '123', 'Battambang', '098989690', 'Admin', 1),
(2, 'Long Pheak', 'Male', 'Pheak333@gmail.com', 'pheak', '123', 'Phnom Prek, Battambang', '010756476', 'User', 1),
(3, 'Siv Sovathanak', 'Male', 'Nak9988@gmail.com', 'nak', '123', 'Onlongvel, Battambang', '098989898', 'User', 1),
(4, 'Bey Suchea', 'Male', 'ouchi@gmail.com', 'ouchi', '123', 'Battambang Province', '098989690', 'Admin', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_suppliers` (`suppliers_id`),
  ADD CONSTRAINT `tbl_invoice_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`),
  ADD CONSTRAINT `tbl_invoice_ibfk_3` FOREIGN KEY (`vendor_id`) REFERENCES `tbl_vendor` (`vendor_id`);

--
-- Constraints for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `tbl_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`),
  ADD CONSTRAINT `tbl_item_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brand` (`brand_id`);

--
-- Constraints for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD CONSTRAINT `tbl_purchase_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brand` (`brand_id`),
  ADD CONSTRAINT `tbl_purchase_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`),
  ADD CONSTRAINT `tbl_purchase_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`);

--
-- Constraints for table `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  ADD CONSTRAINT `tbl_sale_detail_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
