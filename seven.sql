/*
 Navicat Premium Data Transfer

 Source Server         : mysql local
 Source Server Type    : MySQL
 Source Server Version : 100604
 Source Host           : localhost:3306
 Source Schema         : seven

 Target Server Type    : MySQL
 Target Server Version : 100604
 File Encoding         : 65001

 Date: 06/09/2022 10:33:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_brand
-- ----------------------------
DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`brand_id`),
  UNIQUE KEY `brand_name` (`brand_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_brand
-- ----------------------------
BEGIN;
INSERT INTO `tbl_brand` VALUES (1, 'MSI', '');
INSERT INTO `tbl_brand` VALUES (2, 'TUF Gaming', '');
INSERT INTO `tbl_brand` VALUES (3, 'Apple', '');
INSERT INTO `tbl_brand` VALUES (4, 'Asus', 'Asus is product from America');
COMMIT;

-- ----------------------------
-- Table structure for tbl_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------
BEGIN;
INSERT INTO `tbl_category` VALUES (1, 'Mouse', '');
INSERT INTO `tbl_category` VALUES (2, 'VGA', '');
INSERT INTO `tbl_category` VALUES (3, 'Headset', '');
INSERT INTO `tbl_category` VALUES (4, 'Smart Phone', '');
INSERT INTO `tbl_category` VALUES (6, 'Accessories', 'Nothing here');
COMMIT;

-- ----------------------------
-- Table structure for tbl_invoice
-- ----------------------------
DROP TABLE IF EXISTS `tbl_invoice`;
CREATE TABLE `tbl_invoice` (
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

-- ----------------------------
-- Records of tbl_invoice
-- ----------------------------
BEGIN;
INSERT INTO `tbl_invoice` VALUES (1, 5, 2, 1, 2, '2022-08-15', 1000, b'01');
COMMIT;

-- ----------------------------
-- Table structure for tbl_item
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `unit_price` float NOT NULL,
  `current_stock` float NOT NULL,
  `created_date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `item_description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_item
-- ----------------------------
BEGIN;
INSERT INTO `tbl_item` VALUES (1, 'MSI MUnivers', 150, 50, '2022-08-10', 1, 1, 'Released date 11/2/2015 High Quality, Low Budget.', 1);
INSERT INTO `tbl_item` VALUES (2, 'VGA 3060Ti MSI', 750, 460, '2022-08-01', 2, 1, 'Released date 22/5/2020 High Quality, Low Budget.', 1);
INSERT INTO `tbl_item` VALUES (3, 'TUF Gaming Headset H3', 170, 70, '2022-08-09', 3, 2, 'Released date 05/10/2022 High Quality, Low Budget.', 1);
INSERT INTO `tbl_item` VALUES (5, 'iPhone 13 pro max', 1200, 45, '2022-08-25', 2, 1, 'This is an apple product. Released date: 10/10/2021\r\n                                    ', 1);
COMMIT;

-- ----------------------------
-- Table structure for tbl_purchase
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase`;
CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_total` double(18,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `suppliers_id` (`suppliers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase
-- ----------------------------
BEGIN;
INSERT INTO `tbl_purchase` VALUES (1, 520.00, '2022-09-05', 2);
INSERT INTO `tbl_purchase` VALUES (2, 360.00, '2022-09-05', 2);
INSERT INTO `tbl_purchase` VALUES (3, 50.00, '2022-09-05', 3);
INSERT INTO `tbl_purchase` VALUES (7, 6500.00, '2022-09-06', 4);
INSERT INTO `tbl_purchase` VALUES (8, 6500.00, '2022-09-06', 4);
INSERT INTO `tbl_purchase` VALUES (9, 6500.00, '2022-09-06', 4);
COMMIT;

-- ----------------------------
-- Table structure for tbl_purchase_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_detail`;
CREATE TABLE `tbl_purchase_detail` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `purchase_qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`,`item_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_detail
-- ----------------------------
BEGIN;
INSERT INTO `tbl_purchase_detail` VALUES (1, 2, 1, 200);
INSERT INTO `tbl_purchase_detail` VALUES (1, 3, 2, 160);
INSERT INTO `tbl_purchase_detail` VALUES (2, 5, 2, 180);
INSERT INTO `tbl_purchase_detail` VALUES (3, 3, 1, 50);
INSERT INTO `tbl_purchase_detail` VALUES (7, 5, 5, 1000);
INSERT INTO `tbl_purchase_detail` VALUES (8, 5, 5, 1000);
INSERT INTO `tbl_purchase_detail` VALUES (9, 3, 10, 150);
INSERT INTO `tbl_purchase_detail` VALUES (9, 5, 5, 1000);
COMMIT;

-- ----------------------------
-- Table structure for tbl_salary
-- ----------------------------
DROP TABLE IF EXISTS `tbl_salary`;
CREATE TABLE `tbl_salary` (
  `salary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `salary` float NOT NULL,
  `bonus` float NOT NULL,
  `salary_date` date NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`salary_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_salary
-- ----------------------------
BEGIN;
INSERT INTO `tbl_salary` VALUES (1, 2, 800, 50, '2022-08-25', 'I give u an bonus 50$. Please hard work.\r\n                                    ');
COMMIT;

-- ----------------------------
-- Table structure for tbl_sale
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sale`;
CREATE TABLE `tbl_sale` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_phone` varchar(50) NOT NULL,
  `sale_total` double(18,2) NOT NULL,
  `sale_date` date NOT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sale
-- ----------------------------
BEGIN;
INSERT INTO `tbl_sale` VALUES (1, 'Chim Sophea', '098989898', 600.00, '2022-08-26');
COMMIT;

-- ----------------------------
-- Table structure for tbl_sale_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sale_detail`;
CREATE TABLE `tbl_sale_detail` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sale_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_suppliers
-- ----------------------------
DROP TABLE IF EXISTS `tbl_suppliers`;
CREATE TABLE `tbl_suppliers` (
  `suppliers_id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliers_name` varchar(100) NOT NULL,
  `suppliers_gender` varchar(20) NOT NULL,
  `suppliers_email` varchar(100) NOT NULL,
  `suppliers_phone` varchar(50) NOT NULL,
  `suppliers_address` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`suppliers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_suppliers
-- ----------------------------
BEGIN;
INSERT INTO `tbl_suppliers` VALUES (1, 'Chan Dara', 'Male', 'Chandara@gmail.com', '098989690', 'Battambang Province', 1);
INSERT INTO `tbl_suppliers` VALUES (2, 'Pheak Nary', 'Female', 'Nary9999@gmail.com', '09999999', 'Pursat', 1);
INSERT INTO `tbl_suppliers` VALUES (3, 'Liv Pey', 'Male', 'Livpey8888@gmail.com', '088888888', 'Preah Vihear', 1);
INSERT INTO `tbl_suppliers` VALUES (4, 'Khem Sreyroth', 'Female', 'sreyroth8899@gmail.com', '066445566', 'Switzerland', 1);
INSERT INTO `tbl_suppliers` VALUES (5, 'Keo Romchong', 'Male', 'Romchongsloyzin@gmail.com', '033445566', 'Takeo Province', 1);
INSERT INTO `tbl_suppliers` VALUES (7, 'Ses Sovankiri', 'Male', 'riilex00@gmail.com', '098989690', 'Battambang Province', 1);
COMMIT;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
BEGIN;
INSERT INTO `tbl_user` VALUES (1, 'Ses Sovankiri', 'Male', 'Test@gmail.com', 'kiri', '123', 'Battambang', '098989690', 'Admin', 1);
INSERT INTO `tbl_user` VALUES (2, 'Long Pheak', 'Male', 'Pheak333@gmail.com', 'pheak', '123', 'Phnom Prek, Battambang', '010756476', 'User', 1);
INSERT INTO `tbl_user` VALUES (3, 'Siv Sovathanak', 'Male', 'Nak9988@gmail.com', 'nak', '123', 'Onlongvel, Battambang', '098989898', 'User', 1);
INSERT INTO `tbl_user` VALUES (5, 'Bey Suchea', 'Male', 'ouchi@gmail.com', 'ouchi', '123', 'Battambang Province', '098989690', 'Admin', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
