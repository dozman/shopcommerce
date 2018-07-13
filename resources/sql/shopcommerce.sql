-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2018 at 11:59 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopcommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
CREATE TABLE IF NOT EXISTS `audit_log` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `component` int(100) NOT NULL,
  `module` int(100) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `user_agent` varchar(100) DEFAULT NULL,
  `ip_address` varchar(40) DEFAULT NULL COMMENT 'to cover for 39 characters is appropriate to store IPv6 addresses in this format',
  `user_id` int(10) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` smallint(3) NOT NULL,
  `code` char(3) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `long_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `code`, `short_name`, `long_name`) VALUES
(1, 'zar', 'Rand', 'South Africa Rand');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `description` text NOT NULL,
  `sys_name` varchar(50) NOT NULL,
  `real_name` varchar(200) NOT NULL,
  `status_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = deactivated, 3 = deleted, 4 = pending, 5 = rejected',
  `created_by` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `price`, `description`, `sys_name`, `real_name`, `status_id`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'AMDRY3', 'AMD Ryzen 5 2600 Hex-Core 3.4GHz (3.9GHz Turbo) Socket AM4 Desktop CPU', '80.00', '- 3.4GHz Base Clock\r\n- 3.9GHz Boost Clock\r\n- 6 Cores, 12 Threads\r\n- AMD 12nm Zen+ Architecture\r\n- Supports DDR4-2933MHz\r\n- 19MB Smart Prefetch Cache\r\n- Includes AMD Wraith Stealth Cooler\r\n- Precision Boost 2 Technology\r\n- Intelligent SenseMI Technologies\r\n- 3 Year Warranty', '7776ad6762924516291e0308b3faa52e.jpg', '10945-a_ryzen7_3d_lft_facing.jpg', 1, NULL, NULL, NULL, NULL),
(2, 'RE1CC4', 'Reeven RC-1205 Hans 120mm Fan Black and Yellow CPU Cooler', '150.00', '- Compact Tower CPU Cooler\r\n- 1x 120mm Fan\r\n- 4x Nickel-Plated Heatpipes\r\n- Aluminum Fin Heatsink\r\n- Fan Speed: 300 - 1500 RPM\r\n- Noise: Up to 29.8 dBA\r\n- Intel: LGA 1150 / 1151 / 1155 / 1156 / 1366 / 2011 / 2011-V3\r\n- AMD: AM2(+) / AM3(+) / FM1 / FM2(+) / AM4 (AM4 Bracket Included)\r\n- 2 Year Warranty', 'c3ef502a19f3517ac9cd6fe3f00cf7f0.jpg', 'ac03135.jpg', 1, NULL, NULL, NULL, NULL),
(3, 'WD500N', 'Western Digital WDS500G2B0A WD Blue 500GB 3D NAND SATA 6Gb/s 2.5\"', '250.00', '- 500GB Storage Capacity\r\n- 2.5\" Form Factor\r\n- SATA III 6Gb/s Interface\r\n- Up to 560 MB/s Sequential Read Speed\r\n- Up to 530 MB/s Sequential Write Speed\r\n- MTTF: Up to 1.75M Hours\r\n- 5 Year Warranty', 'a9044da9d9a01482f9600bffd4918c98.jpg', '81s5exnkxjl._sl1500__.jpg', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `security_component`
--

DROP TABLE IF EXISTS `security_component`;
CREATE TABLE IF NOT EXISTS `security_component` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `permissions` text NOT NULL,
  `block_direct_linkage` text COMMENT 'list of permissions where user cant directly see link unless rendered otherwise ',
  `status_id` smallint(1) NOT NULL COMMENT '1 = active, 2 = deactivated, 3 = deleted, 4 = pending, 5 = rejected',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_component`
--

INSERT INTO `security_component` (`id`, `name`, `title`, `permissions`, `block_direct_linkage`, `status_id`) VALUES
(1, 'user', 'User Management', 'login,my-profile,logout,register,list,add,edit,delete,topup-account', 'edit,delete', 1),
(2, 'product', 'Product Manager', 'list,add,edit,delete,view,buy', 'edit,delete,view,buy', 1),
(3, 'system-discount', 'Discount Management', 'list,add,edit,delete,approve,reject,discontinue', 'edit,delete,approve,reject,discontinue', 1),
(4, 'content', 'Content Manager', 'list,add,edit,delete,read', 'edit,delete,read', 1);

-- --------------------------------------------------------

--
-- Table structure for table `security_role`
--

DROP TABLE IF EXISTS `security_role`;
CREATE TABLE IF NOT EXISTS `security_role` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `guest` tinyint(1) NOT NULL,
  `interface_code` char(10) NOT NULL COMMENT 'example: portal, admin. This is an advanced feature',
  `status_id` smallint(1) NOT NULL COMMENT '1 = active, 2 = deactivated, 3 = deleted, 4 = pending, 5 = rejected',
  PRIMARY KEY (`id`),
  UNIQUE KEY `guest` (`guest`,`interface_code`,`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_role`
--

INSERT INTO `security_role` (`id`, `name`, `title`, `guest`, `interface_code`, `status_id`) VALUES
(1, 'Guest', 'Guest User for Client Zone', 1, 'client', 1),
(2, 'guest', 'Guest User for Administrator', 1, 'admin', 1),
(3, 'client', 'Client', 0, 'client', 1),
(4, 'admin', 'Administrator', 0, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `security_role_permission`
--

DROP TABLE IF EXISTS `security_role_permission`;
CREATE TABLE IF NOT EXISTS `security_role_permission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `security_role_id` int(10) NOT NULL,
  `security_component_id` int(10) NOT NULL,
  `permissions` text COMMENT 'list of permission from the component separated by comma',
  `status_id` smallint(1) NOT NULL COMMENT '1 = active, 2 = deactivated, 3 = deleted, 4 = pending, 5 = rejected',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_role_permission`
--

INSERT INTO `security_role_permission` (`id`, `security_role_id`, `security_component_id`, `permissions`, `status_id`) VALUES
(1, 2, 1, 'login,register', 1),
(2, 4, 1, 'logout,topup-account', 1),
(3, 3, 1, 'logout', 1),
(4, 3, 2, 'list,buy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_discount`
--

DROP TABLE IF EXISTS `system_discount`;
CREATE TABLE IF NOT EXISTS `system_discount` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `min_amount` decimal(10,2) NOT NULL,
  `max_amount` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `status_id` smallint(3) NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_discount`
--

INSERT INTO `system_discount` (`id`, `title`, `min_amount`, `max_amount`, `discount`, `status_id`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'Silver', '50.00', '100.00', '0.00', 1, NULL, NULL, NULL, NULL),
(2, 'Gold', '112.00', '115.00', '0.25', 1, NULL, NULL, NULL, NULL),
(3, 'Platinum', '120.00', '0.00', '0.50', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topup_transaction`
--

DROP TABLE IF EXISTS `topup_transaction`;
CREATE TABLE IF NOT EXISTS `topup_transaction` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `status_id` smallint(3) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(10) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `security_role_id` smallint(3) NOT NULL,
  `status_id` tinyint(4) NOT NULL COMMENT '1 = active, 2 = deactivated, 3 = deleted, 4 = pending, 5 = rejected',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `fullname`, `total_amount`, `security_role_id`, `status_id`) VALUES
(1, 'admin', '12345', 'Admin', 'System Admin', '0.00', 4, 1),
(2, 'peter', '12345', 'Test Client', 'Test Client', '300.00', 3, 1),
(3, 'test@test.com', '12345', 'Tester1', NULL, '175.00', 3, 1),
(4, 'dds@dsd', 'dsdsa', 'Tester2', NULL, '0.00', 3, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
