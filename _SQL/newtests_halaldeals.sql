-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2021 at 02:40 AM
-- Server version: 5.7.33
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtests_halaldeals`
--

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE `adverts` (
  `advert_ID` varchar(20) NOT NULL,
  `prod_ID` varchar(20) DEFAULT NULL,
  `bus_ID` varchar(20) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  `deal_start` date DEFAULT NULL,
  `deal_end` date DEFAULT NULL,
  `voucher_expiry` int(5) DEFAULT NULL,
  `smallprint` text,
  `other_options_available` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `postage` enum('1','2') DEFAULT NULL COMMENT '''1''=>''Yes'', ''2''=>''No''',
  `hotoffer` enum('1','2') DEFAULT NULL COMMENT '''1''=>''Yes'', ''2''=>''No''',
  `spec_times` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `spec_times_details` varchar(20) DEFAULT NULL,
  `new_cust_only` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `reservation_request_immediate` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `commission_rate` double(10,2) DEFAULT NULL,
  `additional_rate` double(10,2) DEFAULT NULL,
  `cost_price` double(15,2) DEFAULT NULL,
  `hd_price` double(15,2) DEFAULT NULL,
  `voucher_amount` int(10) DEFAULT NULL,
  `total_voucher` int(10) DEFAULT NULL,
  `status` enum('0','1','3') NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `advert_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`advert_ID`, `prod_ID`, `bus_ID`, `title`, `youtube_url`, `date_start`, `date_finish`, `deal_start`, `deal_end`, `voucher_expiry`, `smallprint`, `other_options_available`, `postage`, `hotoffer`, `spec_times`, `spec_times_details`, `new_cust_only`, `reservation_request_immediate`, `commission_rate`, `additional_rate`, `cost_price`, `hd_price`, `voucher_amount`, `total_voucher`, `status`, `created_at`, `updated_at`, `advert_type`) VALUES
('6275', 'B3F9', '348bshkp', 'Product 2', NULL, NULL, NULL, '2020-05-09', '2020-05-31', NULL, 'Advert small print', '2', NULL, NULL, '2', NULL, '2', '2', NULL, NULL, 0.80, 0.88, NULL, NULL, '1', '2020-05-09 05:27:38', '2020-05-09 05:27:38', 'deal'),
('94ED', '2467', '348bshkp', 'Test Advert Title', NULL, NULL, NULL, '2020-05-09', '2020-05-31', NULL, 'Advert small print', '2', NULL, NULL, '2', NULL, '2', '2', NULL, NULL, 0.01, 0.01, NULL, NULL, '1', '2020-05-09 04:42:19', '2020-05-09 04:42:19', 'deal'),
('A66F', '58F4', '20MsZ2rI', 'test', NULL, NULL, NULL, '2020-04-13', '2020-04-14', NULL, 'test', '2', NULL, NULL, '2', NULL, '2', '2', NULL, NULL, 9.10, 9.90, NULL, NULL, '1', '2020-04-13 13:57:12', '2020-04-13 13:57:12', 'deal'),
('B306', '2467', '348bshkp', 'Test Product', 'https://www.youtube.com/embed/zzQY7hjiKtU', NULL, NULL, '2020-08-21', '2020-08-31', NULL, 'Test Product Test Product Test Product Test Product Test Product Test Product Test Product', '2', '2', '2', '2', NULL, '2', '2', NULL, NULL, 0.01, 0.01, NULL, NULL, '1', '2020-08-21 10:33:28', '2020-08-21 10:33:28', 'deal'),
('EB44', '58F4', '20MsZ2rI', 'Test', NULL, NULL, NULL, '2020-04-25', '2021-01-28', NULL, 'Testing', '2', NULL, NULL, '2', NULL, '2', '2', NULL, NULL, 9.10, 9.90, NULL, NULL, '1', '2020-04-25 11:17:04', '2020-04-25 11:17:04', 'deal');

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `bus_ID` varchar(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address1` text,
  `address2` text,
  `town` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `prod_types` text,
  `prod_sub_types` text,
  `telphone_no` varchar(50) DEFAULT NULL,
  `website` text,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `introduction` text,
  `details` text,
  `smallprint` text,
  `halal_cert` tinyint(4) DEFAULT NULL,
  `alchohol_served` tinyint(4) DEFAULT NULL,
  `male_service` tinyint(4) DEFAULT NULL,
  `female_service` tinyint(4) DEFAULT NULL,
  `gender_segregated` tinyint(4) DEFAULT NULL,
  `family_area` tinyint(4) DEFAULT NULL,
  `commission_type` enum('1','2') DEFAULT NULL COMMENT '1=>Commission, 2=>Commission Rate',
  `commission_rate` double(10,2) NOT NULL DEFAULT '0.00',
  `additional_rate` double(10,2) NOT NULL DEFAULT '0.00',
  `yt_link` text,
  `hd_staff_link` text,
  `terms_and_cond_agreed` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>No, 1=>Yes',
  `terms_and_cond_date` varchar(255) DEFAULT NULL,
  `wallet_amount` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`bus_ID`, `user_id`, `name`, `address1`, `address2`, `town`, `city`, `post_code`, `prod_types`, `prod_sub_types`, `telphone_no`, `website`, `contact_name`, `contact_no`, `introduction`, `details`, `smallprint`, `halal_cert`, `alchohol_served`, `male_service`, `female_service`, `gender_segregated`, `family_area`, `commission_type`, `commission_rate`, `additional_rate`, `yt_link`, `hd_staff_link`, `terms_and_cond_agreed`, `terms_and_cond_date`, `wallet_amount`, `created_at`, `updated_at`) VALUES
('10d9UVs1', 42, 'Chole Business', 'ch street', 'ch street', 'new ch street', 'ch', '458966', '2,3', '1,3', '123565656', 'www.bala.com', 'chol55', '458965874555', 'Hey this is chole', 'Hey this is chole details', '`Hey this is chole details  small print', NULL, 1, 1, 1, 1, 1, NULL, 0.00, 0.00, 'https://www.youtube.com/watch?v=ZwKhufmMxko', NULL, '1', '2020-01-28', 460.00, '2020-01-28 06:42:59', '2020-02-21 05:25:33'),
('1i1MRk8C', 14, 'hhhhh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2019-10-16', 0.00, '2019-10-16 09:43:11', '2019-10-16 09:43:11'),
('20MsZ2rI', 29, 'test', 'town abc', NULL, 'abc', 'test', '123456', '2,4', NULL, '1234567890', 'www.abc.com', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, 2, 3, 1, NULL, 0.00, 0.00, NULL, NULL, '1', '2019-11-14', 1357.30, '2019-11-14 10:49:51', '2020-08-18 15:36:54'),
('348bshkp', 51, 'hdbt', 'Address 1', 'Address 2', 'Town', 'City', '12345678', '2,3', '1,18,20,22', '12345678', 'www.website.com', 'Contact Name', '98765432', 'Business Introduction', 'Business Details', 'Business Small Print', 1, 2, 3, 3, 3, 1, NULL, 0.00, 0.00, NULL, NULL, '1', '2020-05-02', 0.01, '2020-05-02 18:31:56', '2020-08-22 15:42:36'),
('A8Y4', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-07-12 06:11:09', '2019-07-12 06:11:09'),
('BH73', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-07-12 06:13:12', '2019-07-12 06:13:12'),
('EM6T73f5', 26, 'Test Business', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 0.00, 0.00, 'https://www.youtube.com/watch?v=ZwKhufmMxko', NULL, '1', '2019-10-28', 0.00, '2019-10-28 23:27:27', '2019-11-11 13:30:21'),
('Ew2fZNHB', 48, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2020-04-25', 0.00, '2020-04-25 09:57:28', '2020-04-25 09:57:28'),
('FRT6', 11, 'Test', 'Estonia', 'Talinn', NULL, NULL, NULL, '2,3,4', '1,3,2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 5, 5, 4, 4, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-07-12 12:37:06', '2019-07-12 13:17:00'),
('G7Rt8ep9', 50, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2020-04-25', 0.00, '2020-04-25 10:02:55', '2020-04-25 10:02:55'),
('HG6H', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-07-12 06:15:37', '2019-07-12 06:15:37'),
('M54E', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-07-12 06:14:17', '2019-07-12 06:14:17'),
('N66A', 10, 'gdfjghdfjgj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '54', '0', NULL, 0.00, '2019-07-12 07:45:08', '2020-08-19 11:53:09'),
('qySbD1Em', 40, 'Peter24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2019-12-24', 9.00, '2019-12-24 07:44:46', '2020-01-28 07:08:50'),
('R6Y7', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-07-12 06:23:59', '2019-07-12 06:23:59'),
('RY97FD8T', 49, 'test65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2020-04-25', 0.00, '2020-04-25 09:59:11', '2020-04-25 09:59:11'),
('SVeEiCKX', 30, 'Peter', 'rodiursodusdiofusiufisdufsdui', 'uewiudisufsiufsdi', 'idusiudisu', 'iufuisdfudsf', '123565', '2,3,4', NULL, '121212352', 'fpoidsofidsofsdiof', 'oursfisudfidsuif', NULL, NULL, NULL, NULL, 1, NULL, 3, 1, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2019-11-19', 0.00, '2019-11-19 10:33:10', '2019-11-19 11:25:42'),
('ts4JTd19', 15, 'www', NULL, NULL, '1211151', '44444', '-111111', '3', '3', 'fuyfgyjhbkmjbnb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '1', '2019-10-16', 0.00, '2019-10-16 09:46:52', '2019-10-17 12:49:26'),
('XR5U', 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '0', NULL, 0.00, '2019-08-01 04:51:27', '2019-08-01 04:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `advert_ID` varchar(30) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `item_price` double(10,2) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `advert_ID`, `quantity`, `type`, `item_price`, `status`, `created_at`, `updated_at`) VALUES
(1, '36', 'A66F', 2, 'deal', 9.90, '3', '2020-04-13 13:58:08', '2020-04-13 14:00:48'),
(2, 'KWUOWj6s9Z', '94ED', 1, 'deal', 0.01, '1', '2020-05-16 19:46:31', '2020-05-16 19:46:31'),
(3, '52', '94ED', 1, 'deal', 0.01, '3', '2020-05-16 19:49:00', '2020-07-05 23:56:40'),
(4, '52', 'EB44', 1, 'deal', 9.90, '3', '2020-07-05 23:50:21', '2020-07-05 23:53:36'),
(5, '36', 'EB44', 2, 'deal', 9.90, '1', '2020-08-13 07:59:25', '2020-09-19 05:09:00'),
(6, '52', 'EB44', 2, 'deal', 9.90, '3', '2020-08-18 15:33:04', '2020-08-18 15:35:02'),
(7, '52', 'EB44', 1, 'deal', 9.90, '3', '2020-08-18 15:35:13', '2020-08-18 15:36:54'),
(8, '52', 'EB44', 1, 'deal', 9.90, '1', '2020-08-18 15:37:07', '2020-08-18 15:37:07'),
(9, 'JJo9Lr00yf', 'EB44', 1, 'deal', 9.90, '3', '2020-08-19 06:54:20', '2020-08-19 06:54:34'),
(10, 'T3H1s4z8QC', 'B306', 1, 'deal', 0.01, '3', '2020-08-28 05:59:35', '2020-08-28 06:01:54'),
(11, 'ghVQl42lmD', 'EB44', 1, 'deal', 9.90, '3', '2020-09-26 13:57:02', '2020-09-26 13:57:14'),
(12, 'T3H1s4z8QC', 'EB44', 1, 'deal', 9.90, '1', '2021-01-07 05:38:40', '2021-01-07 05:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('1','2','3') DEFAULT NULL COMMENT '1=>Text, 2=>Image, 3=>Video',
  `slug` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `content_name` varchar(100) DEFAULT NULL,
  `content_body` text,
  `instruction` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `type`, `slug`, `page_name`, `content_name`, `content_body`, `instruction`, `created_at`, `updated_at`) VALUES
(1, '1', 'footer_text', 'footer page', 'footer_text', '<h3>Welcome to Halal-Deals.co.uk!</h3>\r\n\r\n<p style=\"text-align:justify\">Grab some great deals whilst still ensuring you are buying halal deals! Ensure what you are buying as permissible with your religious beliefs, whilst supporting some of the great businesses that are helping to provide us with halal goods and services.&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">Please also remember that all of your purchases are also contributing towards charitable projects around the world. Our goal is to set up and run an orphanage, which your purchases are assisting towards.</p>', NULL, NULL, '2020-04-24 21:04:08'),
(2, '1', 'banner_text', 'Home Page', 'banner_text', '<p><span style=\"font-size:28px\">Search Halal Deals for halal deals!</span></p>', NULL, NULL, '2020-04-24 21:09:09'),
(3, '2', 'banner_image1', 'Home Page', 'banner_image1', NULL, NULL, NULL, NULL),
(4, '2', 'banner_image2', 'Home Page', 'banner_image2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `message` text,
  `subject` varchar(250) DEFAULT NULL,
  `reply_message` text,
  `reply_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>No, 1=>Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1','3') NOT NULL COMMENT '"0"=>inactive,"1"=>active,"3"=>deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='country database';

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Andorra', '2018-02-12 07:10:18', '2018-02-12 07:10:18', '1'),
(2, 'United Arab Emirates', '2018-02-12 07:10:21', '2018-02-12 07:10:21', '1'),
(3, 'Afghanistan', '2018-02-12 07:10:27', '2018-03-30 06:26:23', '1'),
(4, 'Antigua and Barbuda', '2018-02-12 07:10:47', '2018-02-12 07:10:47', '1'),
(5, 'Anguilla', '2018-02-12 07:10:51', '2018-02-12 07:10:51', '1'),
(6, 'Albania', '2018-02-12 07:10:52', '2018-02-12 07:10:52', '1'),
(7, 'Armenia', '2018-02-12 07:10:57', '2018-02-12 07:10:57', '1'),
(8, 'Netherlands Antilles', '2018-02-12 07:11:03', '2018-02-12 07:11:03', '1'),
(9, 'Angola', '2018-02-12 07:11:04', '2018-02-12 07:11:04', '1'),
(10, 'Antarctica', '2018-02-12 07:11:12', '2018-02-12 07:11:12', '1'),
(11, 'Argentina', '2018-02-12 07:11:13', '2018-02-12 07:11:13', '1'),
(12, 'American Samoa', '2018-02-12 07:11:38', '2018-02-12 07:11:38', '1'),
(13, 'Austria', '2018-02-12 07:11:38', '2018-02-12 07:11:38', '1'),
(14, 'Australia', '2018-02-12 07:14:11', '2018-02-12 07:14:11', '1'),
(15, 'Aruba', '2018-02-12 07:16:13', '2018-02-12 07:16:13', '1'),
(16, 'Aland IslandsÅland Islands', '2018-02-12 07:16:14', '2018-02-12 07:16:14', '1'),
(17, 'Azerbaijan', '2018-02-12 07:16:14', '2018-02-12 07:16:14', '1'),
(18, 'Bosnia and Herzegovina', '2018-02-12 07:16:38', '2018-02-12 07:16:38', '1'),
(19, 'Barbados', '2018-02-12 07:16:43', '2018-02-12 07:16:43', '1'),
(20, 'Bangladesh', '2018-02-12 07:16:50', '2018-02-12 07:16:50', '1'),
(21, 'Belgium', '2018-02-12 07:17:09', '2018-02-12 07:17:09', '1'),
(22, 'Burkina Faso', '2018-02-12 07:17:45', '2018-02-12 07:17:45', '1'),
(23, 'Bulgaria', '2018-02-12 07:18:00', '2018-02-12 07:18:00', '1'),
(24, 'Bahrain', '2018-02-12 07:18:19', '2018-02-12 07:18:19', '1'),
(25, 'Burundi', '2018-02-12 07:18:23', '2018-02-12 07:18:23', '1'),
(26, 'Benin', '2018-02-12 07:18:28', '2018-02-12 07:18:28', '1'),
(27, 'Saint Barthlemy', '2018-02-12 07:18:30', '2018-02-12 07:18:30', '1'),
(28, 'Bermuda', '2018-02-12 07:18:30', '2018-02-12 07:18:30', '1'),
(29, 'Brunei Darussalam', '2018-02-12 07:18:34', '2018-02-12 07:18:34', '1'),
(30, 'BoliviaBolivia, Plurinational state of', '2018-02-12 07:18:39', '2018-02-12 07:18:39', '1'),
(31, 'Brazil', '2018-02-12 07:18:42', '2018-02-12 07:18:42', '1'),
(32, 'Bahamas', '2018-02-12 07:19:36', '2018-02-12 07:19:36', '1'),
(33, 'Bhutan', '2018-02-12 07:19:53', '2018-02-12 07:19:53', '1'),
(34, 'Bouvet Island', '2018-02-12 07:20:14', '2018-02-12 07:20:14', '1'),
(35, 'Botswana', '2018-02-12 07:20:14', '2018-02-12 07:20:14', '1'),
(36, 'Belarus', '2018-02-12 07:20:34', '2018-02-12 07:20:34', '1'),
(37, 'Belize', '2018-02-12 07:20:46', '2018-02-12 07:20:46', '1'),
(38, 'Canada', '2018-02-12 07:20:57', '2018-02-12 07:20:57', '1'),
(39, 'Cocos (Keeling) Islands', '2018-02-12 07:22:36', '2018-02-12 07:22:36', '1'),
(40, 'Congo, The Democratic Republic of the', '2018-02-12 07:22:36', '2018-02-12 07:22:36', '1'),
(41, 'Central African Republic', '2018-02-12 07:22:51', '2018-02-12 07:22:51', '1'),
(42, 'Congo', '2018-02-12 07:22:58', '2018-02-12 07:22:58', '1'),
(43, 'Switzerland', '2018-02-12 07:23:02', '2018-02-12 07:23:02', '1'),
(44, 'Côte dIvoire', '2018-02-12 07:23:48', '2018-02-12 07:23:48', '1'),
(45, 'Cook Islands', '2018-02-12 07:24:10', '2018-02-12 07:24:10', '1'),
(46, 'Chile', '2018-02-12 07:24:10', '2018-02-12 07:24:10', '1'),
(47, 'Cameroon', '2018-02-12 07:24:19', '2018-02-12 07:24:19', '1'),
(48, 'China', '2018-02-12 07:24:23', '2018-02-12 07:24:23', '1'),
(49, 'Colombia', '2018-02-12 07:26:38', '2018-02-12 07:26:38', '1'),
(50, 'Costa Rica', '2018-02-12 07:26:57', '2018-02-12 07:26:57', '1'),
(51, 'Cuba', '2018-02-12 07:39:56', '2018-02-12 07:39:56', '1'),
(52, 'Cape Verde', '2018-02-12 07:40:04', '2018-02-12 07:40:04', '1'),
(53, 'Christmas Island', '2018-02-12 07:40:14', '2018-02-12 07:40:14', '1'),
(54, 'Cyprus', '2018-02-12 07:40:14', '2018-02-12 07:40:14', '1'),
(55, 'Czech Republic', '2018-02-12 07:40:20', '2018-02-12 07:40:20', '1'),
(56, 'Germany', '2018-02-12 07:41:23', '2018-02-12 07:41:23', '1'),
(57, 'Djibouti', '2018-02-12 07:46:16', '2018-02-12 07:46:16', '1'),
(58, 'Denmark', '2018-02-12 07:46:26', '2018-02-12 07:46:26', '1'),
(59, 'Dominica', '2018-02-12 07:47:03', '2018-02-12 07:47:03', '1'),
(60, 'Dominican Republic', '2018-02-12 07:47:38', '2018-02-12 07:47:38', '1'),
(61, 'Algeria', '2018-02-12 07:48:00', '2018-02-12 07:48:00', '1'),
(62, 'Ecuador', '2018-02-12 07:48:30', '2018-02-12 07:48:30', '1'),
(63, 'Estonia', '2018-02-12 07:48:39', '2018-02-12 07:48:39', '1'),
(64, 'Egypt', '2018-02-12 07:49:02', '2018-02-12 07:49:02', '1'),
(65, 'Western Sahara', '2018-02-12 07:49:18', '2018-02-12 07:49:18', '1'),
(66, 'Eritrea', '2018-02-12 07:49:18', '2018-02-12 07:49:18', '1'),
(67, 'Spain', '2018-02-12 07:49:19', '2018-02-12 07:49:19', '1'),
(68, 'Ethiopia', '2018-02-12 07:50:26', '2018-02-12 07:50:26', '1'),
(69, 'Finland', '2018-02-12 07:50:44', '2018-02-12 07:50:44', '1'),
(70, 'Fiji', '2018-02-12 07:51:19', '2018-02-12 07:51:19', '1'),
(71, 'Falkland Islands (Malvinas)', '2018-02-12 07:51:22', '2018-02-12 07:51:22', '1'),
(72, 'Micronesia, Federated States of', '2018-02-12 07:51:23', '2018-02-12 07:51:23', '1'),
(73, 'Faroe Islands', '2018-02-12 07:51:24', '2018-02-12 07:51:24', '1'),
(74, 'France', '2018-02-12 07:51:25', '2018-02-12 07:51:25', '1'),
(75, 'Gabon', '2018-02-12 07:56:33', '2018-02-12 07:56:33', '1'),
(76, 'United Kingdom', '2018-02-12 07:56:37', '2018-02-12 07:56:37', '1'),
(77, 'Grenada', '2018-02-12 08:02:06', '2018-02-12 08:02:06', '1'),
(78, 'Georgia', '2018-02-12 08:02:08', '2018-02-12 08:02:08', '1'),
(79, 'French Guiana', '2018-02-12 08:02:26', '2018-02-12 08:02:26', '1'),
(80, 'Guernsey', '2018-02-12 08:02:27', '2018-02-12 08:02:27', '1'),
(81, 'Ghana', '2018-02-12 08:02:27', '2018-02-12 08:02:27', '1'),
(82, 'Gibraltar', '2018-02-12 08:02:32', '2018-02-12 08:02:32', '1'),
(83, 'Greenland', '2018-02-12 08:02:33', '2018-02-12 08:02:33', '1'),
(84, 'Gambia', '2018-02-12 08:02:35', '2018-02-12 08:02:35', '1'),
(85, 'Guinea', '2018-02-12 08:02:38', '2018-02-12 08:02:38', '1'),
(86, 'Guadeloupe', '2018-02-12 08:02:50', '2018-02-12 08:02:50', '1'),
(87, 'Equatorial Guinea', '2018-02-12 08:02:50', '2018-02-12 08:02:50', '1'),
(88, 'Greece', '2018-02-12 08:02:53', '2018-02-12 08:02:53', '1'),
(89, 'South Georgia and the South Sandwich Islands', '2018-02-12 08:03:10', '2018-02-12 08:03:10', '1'),
(90, 'Guatemala', '2018-02-12 08:03:10', '2018-02-12 08:03:10', '1'),
(91, 'Guam', '2018-02-12 08:03:18', '2018-02-12 08:03:18', '1'),
(92, 'Guinea-Bissau', '2018-02-12 08:03:18', '2018-02-12 08:03:18', '1'),
(93, 'Guyana', '2018-02-12 08:03:21', '2018-02-12 08:03:21', '1'),
(94, 'Hong Kong', '2018-02-12 08:03:25', '2018-02-12 08:03:25', '1'),
(95, 'Heard Island and McDonald Islands', '2018-02-12 08:03:25', '2018-02-12 08:03:25', '1'),
(96, 'Honduras', '2018-02-12 08:03:25', '2018-02-12 08:03:25', '1'),
(97, 'Croatia', '2018-02-12 08:03:31', '2018-02-12 08:03:31', '1'),
(98, 'Haiti', '2018-02-12 08:03:45', '2018-02-12 08:03:45', '1'),
(99, 'Hungary', '2018-02-12 08:03:48', '2018-02-12 08:03:48', '1'),
(100, 'Indonesia', '2018-02-12 08:04:16', '2018-02-12 08:04:16', '1'),
(101, 'Ireland', '2018-02-12 08:11:17', '2018-02-12 08:11:17', '1'),
(102, 'Israel', '2018-02-12 08:11:42', '2018-02-12 08:11:42', '1'),
(103, 'Isle of Man', '2018-02-12 08:12:04', '2018-02-12 08:12:04', '1'),
(104, 'India', '2018-02-12 08:12:05', '2018-02-12 08:12:05', '1'),
(105, 'British Indian Ocean Territory', '2018-02-12 08:12:59', '2018-02-12 08:12:59', '1'),
(106, 'Iraq', '2018-02-12 08:13:00', '2018-02-12 08:13:00', '1'),
(107, 'Iran, Islamic Republic of', '2018-02-12 08:13:08', '2018-02-12 08:13:08', '1'),
(108, 'Iceland', '2018-02-12 08:14:16', '2018-02-12 08:14:16', '1'),
(109, 'Italy', '2018-02-12 08:14:32', '2018-02-12 08:14:32', '1'),
(110, 'Jersey', '2018-02-12 08:18:05', '2018-02-12 08:18:05', '1'),
(111, 'Jamaica', '2018-02-12 08:18:05', '2018-02-12 08:18:05', '1'),
(112, 'Jordan', '2018-02-12 08:18:12', '2018-02-12 08:18:12', '1'),
(113, 'Japan', '2018-02-12 08:18:15', '2018-02-12 08:18:15', '1'),
(114, 'Kenya', '2018-02-12 08:20:01', '2018-02-12 08:20:01', '1'),
(115, 'Kyrgyzstan', '2018-02-12 08:20:06', '2018-02-12 08:20:06', '1'),
(116, 'Cambodia', '2018-02-12 08:20:10', '2018-02-12 08:20:10', '1'),
(117, 'Kiribati', '2018-02-12 08:20:22', '2018-02-12 08:20:22', '1'),
(118, 'Comoros', '2018-02-12 08:20:24', '2018-02-12 08:20:24', '1'),
(119, 'Saint Kitts and Nevis', '2018-02-12 08:20:26', '2018-02-12 08:20:26', '1'),
(120, 'Korea, Democratic People&#39;s Republic of', '2018-02-12 08:20:35', '2018-02-12 08:20:35', '1'),
(121, 'Korea, Republic of', '2018-02-12 08:20:40', '2018-02-12 08:20:40', '1'),
(122, 'Kuwait', '2018-02-12 08:21:12', '2018-02-12 08:21:12', '1'),
(123, 'Cayman Islands', '2018-02-12 08:21:15', '2018-02-12 08:21:15', '1'),
(124, 'Kazakhstan', '2018-02-12 08:21:18', '2018-02-12 08:21:18', '1'),
(125, 'Lao People&#39;s Democratic Republic', '2018-02-12 08:21:33', '2018-02-12 08:21:33', '1'),
(126, 'Lebanon', '2018-02-12 08:21:52', '2018-02-12 08:21:52', '1'),
(127, 'Saint Lucia', '2018-02-12 08:21:55', '2018-02-12 08:21:55', '1'),
(128, 'Liechtenstein', '2018-02-12 08:21:59', '2018-02-12 08:21:59', '1'),
(129, 'Sri Lanka', '2018-02-12 08:22:03', '2018-02-12 08:22:03', '1'),
(130, 'Liberia', '2018-02-12 08:22:16', '2018-02-12 08:22:16', '1'),
(131, 'Lesotho', '2018-02-12 08:22:20', '2018-02-12 08:22:20', '1'),
(132, 'Lithuania', '2018-02-12 08:22:24', '2018-02-12 08:22:24', '1'),
(133, 'Luxembourg', '2018-02-12 08:22:41', '2018-02-12 08:22:41', '1'),
(134, 'Latvia', '2018-02-12 08:23:22', '2018-02-12 08:23:22', '1'),
(135, 'Libyan Arab Jamahiriya', '2018-02-12 08:23:58', '2018-02-12 08:23:58', '1'),
(136, 'Morocco', '2018-02-12 08:24:36', '2018-02-12 08:24:36', '1'),
(137, 'Monaco', '2018-02-12 08:25:04', '2018-02-12 08:25:04', '1'),
(138, 'Moldova, Republic of', '2018-02-12 08:25:06', '2018-02-12 08:25:06', '1'),
(139, 'Montenegro', '2018-02-12 08:25:14', '2018-02-12 08:25:14', '1'),
(140, 'Saint Martin', '2018-02-12 08:25:15', '2018-02-12 08:25:15', '1'),
(141, 'Madagascar', '2018-02-12 08:25:16', '2018-02-12 08:25:16', '1'),
(142, 'Marshall Islands', '2018-02-12 08:25:20', '2018-02-12 08:25:20', '1'),
(143, 'Macedonia', '2018-02-12 08:25:20', '2018-02-12 08:25:20', '1'),
(144, 'Mali', '2018-02-12 08:26:13', '2018-02-12 08:26:13', '1'),
(145, 'Myanmar', '2018-02-12 08:26:16', '2018-02-12 08:26:16', '1'),
(146, 'Mongolia', '2018-02-12 08:26:21', '2018-02-12 08:26:21', '1'),
(147, 'Macao', '2018-02-12 08:26:27', '2018-02-12 08:26:27', '1'),
(148, 'Northern Mariana Islands', '2018-02-12 08:26:28', '2018-02-12 08:26:28', '1'),
(149, 'Martinique', '2018-02-12 08:26:29', '2018-02-12 08:26:29', '1'),
(150, 'Mauritania', '2018-02-12 08:26:29', '2018-02-12 08:26:29', '1'),
(151, 'Montserrat', '2018-02-12 08:28:12', '2018-02-12 08:28:12', '1'),
(152, 'Malta', '2018-02-12 08:28:14', '2018-02-12 08:28:14', '1'),
(153, 'Mauritius', '2018-02-12 08:28:14', '2018-02-12 08:28:14', '1'),
(154, 'Maldives', '2018-02-12 08:28:23', '2018-02-12 08:28:23', '1'),
(155, 'Malawi', '2018-02-12 08:28:30', '2018-02-12 08:28:30', '1'),
(156, 'Mexico', '2018-02-12 08:29:02', '2018-02-12 08:29:02', '1'),
(157, 'Malaysia', '2018-02-12 08:29:48', '2018-02-12 08:29:48', '1'),
(158, 'Mozambique', '2018-02-12 08:30:06', '2018-02-12 08:30:06', '1'),
(159, 'Namibia', '2018-02-12 08:30:09', '2018-02-12 08:30:09', '1'),
(160, 'New Caledonia', '2018-02-12 08:30:19', '2018-02-12 08:30:19', '1'),
(161, 'Niger', '2018-02-12 08:30:20', '2018-02-12 08:30:20', '1'),
(162, 'Norfolk Island', '2018-02-12 08:30:22', '2018-02-12 08:30:22', '1'),
(163, 'Nigeria', '2018-02-12 08:30:23', '2018-02-12 08:30:23', '1'),
(164, 'Nicaragua', '2018-02-12 08:30:58', '2018-02-12 08:30:58', '1'),
(165, 'Netherlands', '2018-02-12 08:31:15', '2018-02-12 08:31:15', '1'),
(166, 'Norway', '2018-02-12 08:32:38', '2018-02-12 08:32:38', '1'),
(167, 'Nepal', '2018-02-12 08:33:34', '2018-02-12 08:33:34', '1'),
(168, 'Nauru', '2018-02-12 08:33:40', '2018-02-12 08:33:40', '1'),
(169, 'Niue', '2018-02-12 08:33:46', '2018-02-12 08:33:46', '1'),
(170, 'New Zealand', '2018-02-12 08:33:46', '2018-02-12 08:33:46', '1'),
(171, 'Oman', '2018-02-12 08:34:32', '2018-02-12 08:34:32', '1'),
(172, 'Panama', '2018-02-12 08:34:35', '2018-02-12 08:34:35', '1'),
(173, 'Peru', '2018-02-12 08:34:40', '2018-02-12 08:34:40', '1'),
(174, 'French Polynesia', '2018-02-12 08:34:54', '2018-02-12 08:34:54', '1'),
(175, 'Papua New Guinea', '2018-02-12 08:34:54', '2018-02-12 08:34:54', '1'),
(176, 'Philippines', '2018-02-12 08:35:01', '2018-02-12 08:35:01', '1'),
(177, 'Pakistan', '2018-02-12 08:36:41', '2018-02-12 08:36:41', '1'),
(178, 'Poland', '2018-02-12 08:36:50', '2018-02-12 08:36:50', '1'),
(179, 'Saint Pierre and Miquelon', '2018-02-12 08:42:25', '2018-02-12 08:42:25', '1'),
(180, 'Pitcairn', '2018-02-12 08:42:26', '2018-02-12 08:42:26', '1'),
(181, 'Puerto Rico', '2018-02-12 08:42:27', '2018-02-12 08:42:27', '1'),
(182, 'Palestinian Territory, Occupied', '2018-02-12 08:42:28', '2018-02-12 08:42:28', '1'),
(183, 'Portugal', '2018-02-12 08:42:29', '2018-02-12 08:42:29', '1'),
(184, 'Palau', '2018-02-12 08:43:32', '2018-02-12 08:43:32', '1'),
(185, 'Paraguay', '2018-02-12 08:43:33', '2018-02-12 08:43:33', '1'),
(186, 'Qatar', '2018-02-12 08:43:49', '2018-02-12 08:43:49', '1'),
(187, 'Réunion', '2018-02-12 08:44:02', '2018-02-12 08:44:02', '1'),
(188, 'Romania', '2018-02-12 08:44:03', '2018-02-12 08:44:03', '1'),
(189, 'Serbia', '2018-02-12 08:45:31', '2018-02-12 08:45:31', '1'),
(190, 'Russian Federation', '2018-02-12 08:45:31', '2018-02-12 08:45:31', '1'),
(191, 'Rwanda', '2018-02-12 08:48:24', '2018-02-12 08:48:24', '1'),
(192, 'Saudi Arabia', '2018-02-12 08:48:40', '2018-02-12 08:48:40', '1'),
(193, 'Solomon Islands', '2018-02-12 08:49:37', '2018-02-12 08:49:37', '1'),
(194, 'Seychelles', '2018-02-12 08:49:42', '2018-02-12 08:49:42', '1'),
(195, 'Sudan', '2018-02-12 08:49:53', '2018-02-12 08:49:53', '1'),
(196, 'Sweden', '2018-02-12 08:49:58', '2018-02-12 08:49:58', '1'),
(197, 'Singapore', '2018-02-12 08:51:08', '2018-02-12 08:51:08', '1'),
(198, 'Saint Helena', '2018-02-12 08:51:09', '2018-02-12 08:51:09', '1'),
(199, 'Slovenia', '2018-02-12 08:51:10', '2018-02-12 08:51:10', '1'),
(200, 'Svalbard and Jan Mayen', '2018-02-12 08:52:30', '2018-02-12 08:52:30', '1'),
(201, 'Slovakia', '2018-02-12 08:54:31', '2018-02-12 08:54:31', '1'),
(202, 'Sierra Leone', '2018-02-12 08:54:52', '2018-02-12 08:54:52', '1'),
(203, 'San Marino', '2018-02-12 08:54:53', '2018-02-12 08:54:53', '1'),
(204, 'Senegal', '2018-02-12 08:54:57', '2018-02-12 08:54:57', '1'),
(205, 'Somalia', '2018-02-12 08:55:00', '2018-02-12 08:55:00', '1'),
(206, 'Suriname', '2018-02-12 08:55:07', '2018-02-12 08:55:07', '1'),
(207, 'Sao Tome and Principe', '2018-02-12 08:55:10', '2018-02-12 08:55:10', '1'),
(208, 'El Salvador', '2018-02-12 08:55:11', '2018-02-12 08:55:11', '1'),
(209, 'Syrian Arab Republic', '2018-02-12 08:55:17', '2018-02-12 08:55:17', '1'),
(210, 'Swaziland', '2018-02-12 08:55:21', '2018-02-12 08:55:21', '1'),
(211, 'Turks and Caicos Islands', '2018-02-12 08:55:34', '2018-02-12 08:55:34', '1'),
(212, 'Chad', '2018-02-12 08:55:35', '2018-02-12 08:55:35', '1'),
(213, 'French Southern Territories', '2018-02-12 08:55:40', '2018-02-12 08:55:40', '1'),
(214, 'Togo', '2018-02-12 08:55:40', '2018-02-12 08:55:40', '1'),
(215, 'Thailand', '2018-02-12 08:55:47', '2018-02-12 08:55:47', '1'),
(216, 'Tajikistan', '2018-02-12 08:56:17', '2018-02-12 08:56:17', '1'),
(217, 'Tokelau', '2018-02-12 08:56:18', '2018-02-12 08:56:18', '1'),
(218, 'Timor-Leste', '2018-02-12 08:56:19', '2018-02-12 08:56:19', '1'),
(219, 'Turkmenistan', '2018-02-12 08:56:19', '2018-02-12 08:56:19', '1'),
(220, 'Tunisia', '2018-02-12 08:56:22', '2018-02-12 08:56:22', '1'),
(221, 'Tonga', '2018-02-12 08:56:32', '2018-02-12 08:56:32', '1'),
(222, 'Turkey', '2018-02-12 08:56:34', '2018-02-12 08:56:34', '1'),
(223, 'Trinidad and Tobago', '2018-02-12 08:57:34', '2018-02-12 08:57:34', '1'),
(224, 'Tuvalu', '2018-02-12 08:57:40', '2018-02-12 08:57:40', '1'),
(225, 'Taiwan', '2018-02-12 08:57:40', '2018-02-12 08:57:40', '1'),
(226, 'Tanzania, United Republic of', '2018-02-12 08:57:46', '2018-02-12 08:57:46', '1'),
(227, 'Ukraine', '2018-02-12 08:57:54', '2018-02-12 08:57:54', '1'),
(228, 'Uganda', '2018-02-12 08:58:16', '2018-02-12 08:58:16', '1'),
(229, 'United States Minor Outlying Islands', '2018-02-12 08:58:26', '2018-02-12 08:58:26', '1'),
(230, 'United States', '2018-02-12 08:58:26', '2018-02-12 08:58:26', '1'),
(231, 'Uruguay', '2018-02-12 09:09:36', '2018-02-12 09:09:36', '1'),
(232, 'Uzbekistan', '2018-02-12 09:09:45', '2018-02-12 09:09:45', '1'),
(233, 'Holy See (Vatican City State)', '2018-02-12 09:09:49', '2018-02-12 09:09:49', '1'),
(234, 'Saint Vincent and the Grenadines', '2018-02-12 09:09:50', '2018-02-12 09:09:50', '1'),
(235, 'Venezuela, Bolivarian Republic of', '2018-02-12 09:09:52', '2018-02-12 09:09:52', '1'),
(236, 'Virgin Islands, British', '2018-02-12 09:10:05', '2018-02-12 09:10:05', '1'),
(237, 'Virgin Islands, U.S.', '2018-02-12 09:10:06', '2018-02-12 09:10:06', '1'),
(238, 'Viet Nam', '2018-02-12 09:10:06', '2018-02-12 09:10:06', '1'),
(239, 'Vanuatu', '2018-02-12 09:10:24', '2018-02-12 09:10:24', '1'),
(240, 'Wallis and Futuna', '2018-02-12 09:10:28', '2018-02-12 09:10:28', '1'),
(241, 'Samoa', '2018-02-12 09:10:29', '2018-02-12 09:10:29', '1'),
(242, 'Yemen', '2018-02-12 09:10:32', '2018-02-12 09:10:32', '1'),
(243, 'Mayotte', '2018-02-12 09:10:37', '2018-02-12 09:10:37', '1'),
(244, 'South Africa', '2018-02-12 09:10:37', '2018-02-12 09:10:37', '1'),
(245, 'Zambia', '2018-02-12 09:10:52', '2018-02-12 09:10:52', '1'),
(246, 'Zimbabwe', '2018-02-12 09:10:56', '2018-02-12 09:10:56', '1');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `discount_rate` double(15,2) NOT NULL,
  `status` enum('0','1','3','') DEFAULT NULL COMMENT '0=>Inactive,1=>Active,3=>Deleted',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `discount_rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A', 5.00, '0', '2020-07-07 20:41:18', '2020-08-20 12:04:20'),
(2, 'B', 10.00, '1', '2020-07-07 20:41:18', '2020-07-07 20:41:18'),
(3, 'C', 15.00, '1', '2020-07-07 20:41:18', '2020-07-08 20:41:18'),
(4, 'D', 20.00, '1', '2020-07-07 20:41:18', '2020-07-07 20:41:18'),
(5, 'E', 25.00, '1', '2020-07-07 20:41:18', '2020-07-08 20:41:18'),
(6, 'F', 30.00, '1', '2020-07-07 20:41:18', '2020-07-07 20:41:18'),
(7, 'G', 35.00, '1', '2020-07-07 20:41:18', '2020-07-08 20:41:18'),
(8, 'H', 40.00, '1', '2020-07-07 20:41:18', '2020-07-07 20:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `variable` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `slug`, `about`, `subject`, `body`, `variable`, `created_at`, `updated_at`) VALUES
(1, 'customer_registration', 'Customer Verification', 'Halal-Deals.co.uk Verification', '<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">Asalaamualaikum&nbsp;{{NAME}}!!,</span></span></p>\r\n\r\n<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">You have just signed up to Halal-Deals.co.uk as a customer - Welcome!! </span></span></p>\r\n\r\n<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">We would like to thank you for <strong>helping us help you</strong>, <strong>and many other customers as well as businesses to excel</strong>. Not only do we reward you by finding businesses to suit your needs, but we will reward to for it too. <strong>Your purchases will also be donating towards charity projects too</strong> - so your shopping helps yourself in many ways - Alhamdulillah! And if you purchase with the intention to purchase halal, support the ummah with their businesses, and donate towards these causes, not only will we reward you, but so would the Lord. Ameen.&nbsp;</span></span></p>\r\n\r\n<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">We appreciate your feedback constantly and again, thank you for joining us on this journey.&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align: center;\"><span style=\"font-family:sans serif\"><u><span style=\"color:#008000\">Please </span><strong><a href=\"{{LINK}}\" style=\"text-decoration: none;\"><span style=\"color:#0000FF\">Click here</span></a></strong><span style=\"color:#008000\">&nbsp;to activate your account.</span></u></span></p>\r\n\r\n<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">Yours Sincerely,</span></span></p>\r\n\r\n<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">The <em>Halal-Deals.co.uk</em> Team</span></span></p>', 'Name:  {{NAME}}<br>\r\nLink:  {{LINK}}<br>', '2019-02-07 00:00:00', '2020-03-05 13:55:26'),
(2, 'forgot_password', 'Forgot Password', 'You Forgot Your Password!', '<p><span style=\"color:#008000\"><span style=\"font-family:sans serif\"><span style=\"font-size:18px\">Asalaamualaikum&nbsp;{{NAME}}!!,</span></span></span></p>\r\n\r\n<p><span style=\"color:#008000\"><span style=\"font-family:sans serif\">It seems you have forgotten your password!</span></span></p>\r\n\r\n<p><span style=\"font-family:sans serif\"><span style=\"color:#008000\">Please&nbsp;</span><strong><a href=\"{{LINK}}\" style=\"text-decoration: none;\"><span style=\"color:#0000FF\">Click here</span></a></strong><span style=\"color:#008000\">&nbsp;to&nbsp;reset your password.</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#008000\"><span style=\"font-family:sans serif\">Yours sincerely,</span></span></p>\r\n\r\n<p><span style=\"color:#008000\"><span style=\"font-family:sans serif\">The <em>Halal-Deals.co.uk</em> Team</span></span></p>', 'Name: &nbsp;{{NAME}}<br>\r\nLink: &nbsp;{{LINK}}<br>', '2019-02-07 00:00:00', '2020-03-05 14:01:15'),
(3, 'contact_us', 'Contact Us', 'Contact Us Form Submitted', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span> {{ADMIN}},</span></span></strong></p>\r\n\r\n<p>Someone has contacted you. Please see the below details&nbsp;and reply on it.</p>\r\n\r\n<p>Name: {{NAME}}</p>\r\n\r\n<p>Email: {{EMAIL}}</p>\r\n\r\n<p>Phone: {{PHONE}}</p>\r\n\r\n<p>Message: {{MESSAGE}}</p>', 'Admin: {{ADMIN}} <br>\r\nName: {{NAME}} <br>\r\nEmail: {{EMAIL}} <br>\r\nPhone: {{PHONE}} <br>\r\nMessage: {{MESSAGE}} <br>', '2019-05-28 00:00:00', '2020-03-05 14:06:49'),
(4, 'admin_reply', 'Contact Us Reply', 'Contact Us Reply', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span> {{NAME}},</span></span></strong></p>\r\n\r\n<p><strong>{{MESSAGE}}</strong></p>', 'Name: {{NAME}}<br>\r\nMessage: {{MESSAGE}}\r\n<br>', '2019-05-28 00:00:00', NULL),
(6, 'new_account_create_for_customer', 'A new customer account create by Admin', 'New Account Create', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! Your new account successfully created by admin as a Customer.</p>\r\n\r\n<p>Your login credentials are given:<br />\r\nLogin Email: {{EMAIL}}<br />\r\nLogin Password: {{PASSWORD}}</p>', 'Name: {{NAME}}<br> Email: {{EMAIL}}<br> Password: {{PASSWORD}}<br>', '2019-05-29 00:00:00', '2019-11-20 09:22:40'),
(7, 'new_account_create_for_vendor', 'A new Business Manager account create by Admin', 'New Account Create', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! Your new account successfully created by admin as a Business Manager.</p>\r\n\r\n<p>Your login credentials are given:<br />\r\nLogin Email: {{EMAIL}}<br />\r\nLogin Password: {{PASSWORD}}</p>', 'Name: {{NAME}}<br> Email: {{EMAIL}}<br> Password: {{PASSWORD}}<br>', NULL, '2019-11-20 09:21:52'),
(8, 'new_account_create_for_hdstaff', 'A new HD Staff account create by Admin', 'New Account Create', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! Your new account successfully created by admin as a HD Staff.</p>\r\n\r\n<p>Your login credentials are given:<br />\r\nLogin Email: {{EMAIL}}<br />\r\nLogin Password: {{PASSWORD}}<br />\r\nLogin Link: <a href=\"{{URL}}\">{{URL}}</a></p>', 'Name: {{NAME}}<br> Email: {{EMAIL}}<br> Password: {{PASSWORD}}<br>Login Link:{{url}}<br>', NULL, '2019-11-20 09:44:56'),
(9, 'vendor_registration', 'Vendor Registration', 'Vendor Registration', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! You have successfully registered for The <strong>Halal-Deals</strong>&nbsp; as a Business Manager.</p>\r\n\r\n<p>Please click on the link below to activate your account.</p>\r\n\r\n<p><strong><a href=\"{{LINK}}\" style=\"text-decoration: none;\">Click here</a></strong></p>', 'Name:  {{NAME}}<br>\r\nLink:  {{LINK}}<br>', '2019-02-07 00:00:00', '2019-11-20 06:22:37'),
(10, 'payment', 'payment', 'payment', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! Your withdrawl amount ${{AMOUNT}} credited shortly in you given bank account.</p>\r\n\r\n', 'Name: {{NAME}}<br> \r\nAmount: {{AMOUNT}}<br> ', '2019-05-29 00:00:00', '2019-11-20 09:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text,
  `status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Question 1', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p style=\"text-align:justify\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '1', '2019-08-01 21:39:40', NULL),
(2, 'Questions 2', '<h3>Lorem Ipsum<span style=\"background-color:rgb(255, 255, 255); font-family:open sans,arial,sans-serif; font-size:14px\">&nbsp;</span></h3>\r\n\r\n<p><span style=\"background-color:rgb(255, 255, 255); font-family:open sans,arial,sans-serif; font-size:14px\">is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span></p>', '1', '2019-08-20 06:39:42', '2019-10-11 04:31:00'),
(3, 'Questions 3', '<p><span style=\"background-color:rgb(255, 255, 255); font-family:open sans,arial,sans-serif; font-size:14px\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.&nbsp;</span></p>', '1', '2019-11-19 12:22:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_05_30_101250_create_cms_table', 1),
(3, '2019_05_30_101332_create_contacts_table', 1),
(4, '2019_05_30_101343_create_seos_table', 1),
(5, '2019_05_30_101356_create_static_pages_table', 1),
(6, '2019_05_30_101410_create_user_types_table', 1),
(7, '2019_06_04_131738_create_settings_table', 1),
(8, '2019_07_10_063354_create_product_types_table', 1),
(9, '2019_07_10_063430_create_product_sub_types_table', 1),
(10, '2019_07_11_075040_create_businesses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `from_id` bigint(20) DEFAULT NULL,
  `notify_view_users` varchar(250) DEFAULT NULL COMMENT 'who are view the notification(use when notify multiple member)',
  `notifiers_id` varchar(250) DEFAULT NULL COMMENT 'id of multiple users',
  `notify_msg` varchar(250) NOT NULL,
  `type` tinyint(2) DEFAULT NULL COMMENT '1=>Profile,2=>Cart,3=>Order,4=>Payment,5=>Rating,6=>Product,7=>Deal,8=>Voucher,9=>others,',
  `status` enum('0','1','3') NOT NULL DEFAULT '0' COMMENT '0=>not_read, 1=>read, 3=>delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Notification Table';

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from_id`, `notify_view_users`, `notifiers_id`, `notify_msg`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'business', '29', 'New product added successfully ', 6, '0', '2020-04-13 13:54:47', '2020-04-13 13:54:47'),
(2, NULL, 'admin', '', 'New product added successfully ', 6, '0', '2020-04-13 13:54:47', '2020-04-13 13:54:47'),
(3, NULL, 'staff', NULL, 'New product added successfully ', 6, '0', '2020-04-13 13:54:47', '2020-04-13 13:54:47'),
(4, NULL, 'business', '29', 'Admin update a product to your business', 6, '0', '2020-04-13 13:55:54', '2020-04-13 13:55:54'),
(5, NULL, 'staff', NULL, 'Admin update a product ', 6, '0', '2020-04-13 13:55:54', '2020-04-13 13:55:54'),
(6, NULL, 'admin', '', 'Admin update a product ', 6, '0', '2020-04-13 13:55:54', '2020-04-13 13:55:54'),
(7, NULL, 'business', '29', 'Deal added successfully ', 7, '0', '2020-04-13 13:57:12', '2020-04-13 13:57:12'),
(8, NULL, 'admin', '', 'Deal added successfully ', 7, '0', '2020-04-13 13:57:13', '2020-04-13 13:57:13'),
(9, NULL, 'staff', NULL, 'Deal added successfully ', 7, '0', '2020-04-13 13:57:13', '2020-04-13 13:57:13'),
(10, 29, NULL, '29', 'Profile and Business information updated successfully.', 1, '0', '2020-04-13 13:59:24', '2020-04-13 13:59:24'),
(11, NULL, 'business', '29', 'Order Successfully Purchase By Alberto Niece', 3, '0', '2020-04-13 14:00:49', '2020-04-13 14:00:49'),
(12, NULL, 'admin', '', 'Order Successfully Purchase By Alberto Niece', 3, '0', '2020-04-13 14:00:49', '2020-04-13 14:00:49'),
(13, NULL, 'user', '36', 'Order successfully Purchase', 3, '0', '2020-04-13 14:00:49', '2020-04-13 14:00:49'),
(14, NULL, 'business', '29', 'Deal added successfully ', 7, '0', '2020-04-25 11:17:04', '2020-04-25 11:17:04'),
(15, NULL, 'admin', '', 'Deal added successfully ', 7, '0', '2020-04-25 11:17:05', '2020-04-25 11:17:05'),
(16, NULL, 'staff', NULL, 'Deal added successfully ', 7, '0', '2020-04-25 11:17:07', '2020-04-25 11:17:07'),
(17, NULL, 'business', '29', 'Product updated successfully ', 6, '0', '2020-04-25 11:18:26', '2020-04-25 11:18:26'),
(18, NULL, 'admin', '', 'Product updated successfully ', 6, '0', '2020-04-25 11:18:27', '2020-04-25 11:18:27'),
(19, NULL, 'staff', NULL, 'Product updated successfully ', 6, '0', '2020-04-25 11:18:27', '2020-04-25 11:18:27'),
(20, 29, NULL, '29', 'Profile and Business information updated successfully.', 1, '0', '2020-04-25 11:59:46', '2020-04-25 11:59:46'),
(21, 29, NULL, '29', 'Profile and Business information updated successfully.', 1, '0', '2020-04-25 12:08:23', '2020-04-25 12:08:23'),
(22, NULL, 'business', '29', 'Product updated successfully ', 6, '0', '2020-04-26 08:56:47', '2020-04-26 08:56:47'),
(23, NULL, 'admin', '', 'Product updated successfully ', 6, '0', '2020-04-26 08:56:47', '2020-04-26 08:56:47'),
(24, NULL, 'staff', NULL, 'Product updated successfully ', 6, '0', '2020-04-26 08:56:47', '2020-04-26 08:56:47'),
(25, NULL, 'business', '29', 'Product updated successfully ', 6, '0', '2020-04-26 10:00:44', '2020-04-26 10:00:44'),
(26, NULL, 'admin', '', 'Product updated successfully ', 6, '0', '2020-04-26 10:00:44', '2020-04-26 10:00:44'),
(27, NULL, 'staff', NULL, 'Product updated successfully ', 6, '0', '2020-04-26 10:00:44', '2020-04-26 10:00:44'),
(28, NULL, 'business', '29', 'Admin update a product to your business', 6, '0', '2020-04-26 10:08:54', '2020-04-26 10:08:54'),
(29, NULL, 'staff', NULL, 'Admin update a product ', 6, '0', '2020-04-26 10:08:54', '2020-04-26 10:08:54'),
(30, NULL, 'admin', '', 'Admin update a product ', 6, '0', '2020-04-26 10:08:54', '2020-04-26 10:08:54'),
(31, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-02 18:33:23', '2020-05-02 18:33:23'),
(32, NULL, 'business', '51', 'New product added successfully ', 6, '0', '2020-05-08 16:42:58', '2020-05-08 16:42:58'),
(33, NULL, 'admin', '', 'New product added successfully ', 6, '0', '2020-05-08 16:42:58', '2020-05-08 16:42:58'),
(34, NULL, 'staff', NULL, 'New product added successfully ', 6, '0', '2020-05-08 16:42:58', '2020-05-08 16:42:58'),
(35, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 16:43:40', '2020-05-08 16:43:40'),
(36, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 16:43:48', '2020-05-08 16:43:48'),
(37, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 16:58:59', '2020-05-08 16:58:59'),
(38, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 16:59:54', '2020-05-08 16:59:54'),
(39, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 17:00:18', '2020-05-08 17:00:18'),
(40, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 17:00:26', '2020-05-08 17:00:26'),
(41, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 17:00:39', '2020-05-08 17:00:39'),
(42, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 17:00:52', '2020-05-08 17:00:52'),
(43, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-05-08 17:03:05', '2020-05-08 17:03:05'),
(44, NULL, 'business', '51', 'Admin update a product to your business', 6, '0', '2020-05-08 17:10:18', '2020-05-08 17:10:18'),
(45, NULL, 'staff', NULL, 'Admin update a product ', 6, '0', '2020-05-08 17:10:18', '2020-05-08 17:10:18'),
(46, NULL, 'admin', '', 'Admin update a product ', 6, '0', '2020-05-08 17:10:18', '2020-05-08 17:10:18'),
(47, NULL, 'business', '51', 'Admin update a product to your business', 6, '0', '2020-05-08 17:25:35', '2020-05-08 17:25:35'),
(48, NULL, 'staff', NULL, 'Admin update a product ', 6, '0', '2020-05-08 17:25:35', '2020-05-08 17:25:35'),
(49, NULL, 'admin', '', 'Admin update a product ', 6, '0', '2020-05-08 17:25:35', '2020-05-08 17:25:35'),
(50, NULL, 'business', '51', 'Deal added successfully ', 7, '0', '2020-05-09 04:42:19', '2020-05-09 04:42:19'),
(51, NULL, 'admin', '', 'Deal added successfully ', 7, '0', '2020-05-09 04:42:19', '2020-05-09 04:42:19'),
(52, NULL, 'staff', NULL, 'Deal added successfully ', 7, '0', '2020-05-09 04:42:19', '2020-05-09 04:42:19'),
(53, NULL, 'business', '51', 'New product added successfully ', 6, '0', '2020-05-09 04:46:16', '2020-05-09 04:46:16'),
(54, NULL, 'admin', '', 'New product added successfully ', 6, '0', '2020-05-09 04:46:16', '2020-05-09 04:46:16'),
(55, NULL, 'staff', NULL, 'New product added successfully ', 6, '0', '2020-05-09 04:46:16', '2020-05-09 04:46:16'),
(56, NULL, 'business', '51', 'Admin update a product to your business', 6, '0', '2020-05-09 04:47:36', '2020-05-09 04:47:36'),
(57, NULL, 'staff', NULL, 'Admin update a product ', 6, '0', '2020-05-09 04:47:36', '2020-05-09 04:47:36'),
(58, NULL, 'admin', '', 'Admin update a product ', 6, '0', '2020-05-09 04:47:36', '2020-05-09 04:47:36'),
(59, NULL, 'business', '51', 'Admin update a product to your business', 6, '0', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(60, NULL, 'staff', NULL, 'Admin update a product ', 6, '0', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(61, NULL, 'admin', '', 'Admin update a product ', 6, '0', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(62, NULL, 'business', '51', 'Deal added successfully ', 7, '0', '2020-05-09 05:27:39', '2020-05-09 05:27:39'),
(63, NULL, 'admin', '', 'Deal added successfully ', 7, '0', '2020-05-09 05:27:39', '2020-05-09 05:27:39'),
(64, NULL, 'staff', NULL, 'Deal added successfully ', 7, '0', '2020-05-09 05:27:39', '2020-05-09 05:27:39'),
(65, NULL, 'business', '51', 'Order Successfully Purchase By FName Test LName Test', 3, '0', '2020-07-05 23:56:40', '2020-07-05 23:56:40'),
(66, NULL, 'admin', '', 'Order Successfully Purchase By FName Test LName Test', 3, '0', '2020-07-05 23:56:40', '2020-07-05 23:56:40'),
(67, NULL, 'user', '52', 'Order successfully Purchase', 3, '0', '2020-07-05 23:56:40', '2020-07-05 23:56:40'),
(68, NULL, 'business', '29', 'Order Successfully Purchase By FName Test LName Test', 3, '0', '2020-08-18 15:36:54', '2020-08-18 15:36:54'),
(69, NULL, 'admin', '', 'Order Successfully Purchase By FName Test LName Test', 3, '0', '2020-08-18 15:36:54', '2020-08-18 15:36:54'),
(70, NULL, 'user', '52', 'Order successfully Purchase', 3, '0', '2020-08-18 15:36:54', '2020-08-18 15:36:54'),
(71, NULL, 'business', '51', 'Deal added successfully ', 7, '0', '2020-08-21 10:33:28', '2020-08-21 10:33:28'),
(72, NULL, 'admin', '', 'Deal added successfully ', 7, '0', '2020-08-21 10:33:28', '2020-08-21 10:33:28'),
(73, NULL, 'staff', NULL, 'Deal added successfully ', 7, '0', '2020-08-21 10:33:28', '2020-08-21 10:33:28'),
(74, 51, NULL, '51', 'Profile and Business information updated successfully.', 1, '0', '2020-08-22 15:42:36', '2020-08-22 15:42:36'),
(75, NULL, 'business', '51', 'New product added successfully ', 6, '0', '2020-08-26 12:45:51', '2020-08-26 12:45:51'),
(76, NULL, 'admin', '', 'New product added successfully ', 6, '1', '2020-08-26 12:45:51', '2020-08-26 12:46:11'),
(77, NULL, 'staff', NULL, 'New product added successfully ', 6, '0', '2020-08-26 12:45:51', '2020-08-26 12:45:51'),
(78, NULL, 'business', '51', 'Admin updated a product to your business', 6, '0', '2020-08-26 12:46:35', '2020-08-26 12:46:35'),
(79, NULL, 'staff', NULL, 'Admin updated a product ', 6, '0', '2020-08-26 12:46:35', '2020-08-26 12:46:35'),
(80, NULL, 'admin', '', 'Admin updated a product ', 6, '0', '2020-08-26 12:46:35', '2020-08-26 12:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `advert_id` varchar(100) DEFAULT NULL,
  `bus_ID` varchar(20) DEFAULT NULL,
  `voucher_id` varchar(100) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `item_price` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2','3','4') DEFAULT NULL COMMENT '''0''=>''Processing'',''1''=>''Order Placed'',''2''=>''Shipped'',''3''=>''Delivered'',''4''=>''Canceled''',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `user_id`, `order_id`, `advert_id`, `bus_ID`, `voucher_id`, `quantity`, `type`, `item_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 36, 1, 'A66F', '20MsZ2rI', NULL, 2, 'deal', '9.9', '0', '2020-04-13 14:00:48', '2020-04-13 14:00:48'),
(2, 52, 2, '94ED', '348bshkp', NULL, 1, 'deal', '0.01', '0', '2020-07-05 23:56:40', '2020-07-05 23:56:40'),
(3, 52, 3, 'EB44', '20MsZ2rI', NULL, 1, 'deal', '9.9', '0', '2020-08-18 15:36:54', '2020-08-18 15:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` bigint(20) NOT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `payment_gateway` enum('paypal') DEFAULT NULL,
  `total_amount` double(10,2) DEFAULT NULL,
  `discount_amount` double(10,2) DEFAULT NULL,
  `pay_amount` double(10,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `txn_id` varchar(250) DEFAULT NULL,
  `chrage_id` varchar(250) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `status` enum('pending','processing','completed','decline') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `order_number`, `user_id`, `name`, `phone`, `address`, `city`, `country`, `zipcode`, `payment_gateway`, `total_amount`, `discount_amount`, `pay_amount`, `currency`, `txn_id`, `chrage_id`, `ip_address`, `status`, `created_at`, `updated_at`) VALUES
(1, '74xew8t40', 36, 'Test', '1234567897', 'test', 'test', 21, '123456', 'paypal', 19.80, NULL, 19.80, 'GBP', '82L541971V6015617', 'PAY-0W3995117M9178243L2KHBCA', '103.18.170.3', 'completed', '2020-04-13 14:00:48', '2020-04-13 14:00:48'),
(2, 'WLxRxhpX1', 52, 'FName Test LName Test', NULL, NULL, NULL, NULL, NULL, 'paypal', 0.01, NULL, 0.01, 'GBP', '7PU98322121726318', 'PAY-1D517867LM1599254L4BGRLQ', '2.220.224.193', 'completed', '2020-07-05 23:56:40', '2020-07-05 23:56:40'),
(3, '1d5uKsXK2', 52, 'FName Test LName Test', NULL, NULL, NULL, NULL, NULL, 'paypal', 9.90, NULL, 9.90, 'GBP', '9NF71930XF528935U', 'PAYID-L457KQQ0SM04015CD170440Y', '202.142.107.85', 'completed', '2020-08-18 15:36:54', '2020-08-18 15:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_ID` varchar(20) NOT NULL,
  `bus_ID` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `brief_description` text,
  `detailed_description` text,
  `smallprint` text,
  `normal_price` double(15,2) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount_price` double(15,2) DEFAULT NULL,
  `actual_deal` text,
  `type` int(10) DEFAULT NULL,
  `sub_type` int(10) DEFAULT NULL,
  `price_verified` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `price_verified_date` date DEFAULT NULL,
  `address_required` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `postage_cost` double(15,2) DEFAULT NULL COMMENT 'The additional cost of postage of the product. This will be added to the advert and the customer’s payment. This will not be charged commission.',
  `status` enum('0','1','3') NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `commission_type` enum('1','2') DEFAULT NULL COMMENT '1=>Commission, 2=>Commercial Rate',
  `commission_rate` double(10,2) DEFAULT '0.00',
  `additional_rate` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_ID`, `bus_ID`, `name`, `brief_description`, `detailed_description`, `smallprint`, `normal_price`, `discount_id`, `discount_price`, `actual_deal`, `type`, `sub_type`, `price_verified`, `price_verified_date`, `address_required`, `postage_cost`, `status`, `commission_type`, `commission_rate`, `additional_rate`, `created_at`, `updated_at`) VALUES
('16E3', '348bshkp', 'Aug Test', 'Brief Description of product', 'Detailed Description of product', 'Small Print of product', 10.00, 2, 9.00, 'actual deal they are getting from product', 3, 19, '1', '2020-08-26', '1', 0.60, '0', NULL, 0.00, 0.00, '2020-08-26 12:45:51', '2020-08-26 12:46:35'),
('2467', '348bshkp', 'Test Product', 'Brief Description', 'Detailed Description', 'Small print', 0.02, NULL, NULL, 'Actual Deal', 3, 22, '1', '2020-05-08', '2', NULL, '1', '1', 50.00, 0.00, '2020-05-08 16:42:58', '2020-05-08 17:25:35'),
('58F4', '20MsZ2rI', 'test', 'test', 'tste', 'abcds', 10.00, NULL, NULL, 'deal', 2, 1, '1', '2020-04-26', '2', NULL, '1', '1', 9.00, 0.00, '2020-04-13 13:54:47', '2020-04-26 10:08:54'),
('B3F9', '348bshkp', 'Test Product 2', 'Brief description about the product', 'A more detailed description about the product', 'Small print about the product', 1.00, NULL, NULL, 'This is what the user will actually get', 3, 20, '1', '2020-05-09', '1', 0.60, '1', '1', 20.00, 0.00, '2020-05-09 04:46:07', '2020-05-09 04:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `prod_ID` varchar(20) DEFAULT NULL,
  `is_default` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active',
  `status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image_name`, `prod_ID`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(6, 'IvUeD1587895730.jpg', '58F4', '1', '1', '2020-04-26 10:08:54', '2020-04-26 10:08:54'),
(9, '1A1061588956170.png', '2467', '1', '1', '2020-05-08 17:25:35', '2020-05-08 17:25:35'),
(20, '6fuP41588999490.png', 'B3F9', '1', '1', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(21, 'bsuhN1588999490.png', 'B3F9', '0', '1', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(22, '8UXsc1588999491.png', 'B3F9', '0', '1', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(23, '1199Y1588999491.png', 'B3F9', '0', '1', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(24, 'Jq6yP1588999492.png', 'B3F9', '0', '1', '2020-05-09 04:47:52', '2020-05-09 04:47:52'),
(27, '5o5181598445750.png', '16E3', '1', '1', '2020-08-26 12:46:35', '2020-08-26 12:46:35'),
(28, 'd5zY21598445760.png', '16E3', '0', '1', '2020-08-26 12:46:35', '2020-08-26 12:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_types`
--

CREATE TABLE `product_sub_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sub_types`
--

INSERT INTO `product_sub_types` (`id`, `parent_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Room', '1', '2019-07-12 06:40:41', '2020-04-25 04:52:20'),
(2, 4, 'British', '1', '2019-07-12 06:41:02', '2020-04-25 04:47:07'),
(3, 3, 'Other Products', '1', '2019-07-12 06:41:33', '2019-07-12 06:41:33'),
(4, 1, 'Beauty', '1', '2020-04-25 04:45:55', '2020-04-25 04:45:55'),
(5, 1, 'Health and Fitness', '1', '2020-04-25 04:46:06', '2020-04-25 04:46:06'),
(6, 1, 'Massage', '1', '2020-04-25 04:46:18', '2020-04-25 04:46:18'),
(7, 1, 'Spa', '1', '2020-04-25 04:46:30', '2020-04-25 04:46:30'),
(8, 5, 'Activities', '1', '2020-04-25 04:46:49', '2020-04-25 04:46:49'),
(9, 4, 'East African', '1', '2020-04-25 04:47:26', '2020-04-25 04:47:26'),
(10, 4, 'Desserts', '1', '2020-04-25 04:47:41', '2020-04-25 04:47:41'),
(11, 4, 'Middle Eastern', '1', '2020-04-25 04:47:50', '2020-04-25 04:47:50'),
(12, 4, 'North African', '1', '2020-04-25 04:48:01', '2020-04-25 04:48:01'),
(13, 4, 'Oriental', '1', '2020-04-25 04:48:13', '2020-04-25 04:48:13'),
(14, 4, 'South American', '1', '2020-04-25 04:48:22', '2020-04-25 04:48:22'),
(15, 4, 'South Asian', '1', '2020-04-25 04:48:30', '2020-04-25 04:48:30'),
(16, 4, 'West African', '1', '2020-04-25 04:48:39', '2020-04-25 04:48:39'),
(17, 4, 'European', '1', '2020-04-25 04:49:04', '2020-04-25 04:49:04'),
(18, 3, 'Food and Drink', '1', '2020-04-25 04:50:29', '2020-04-25 04:50:29'),
(19, 3, 'Fashion', '1', '2020-04-25 04:50:38', '2020-04-25 04:50:38'),
(20, 3, 'Educational', '1', '2020-04-25 04:50:47', '2020-04-25 04:50:47'),
(21, 3, 'Children', '1', '2020-04-25 04:50:56', '2020-04-25 04:50:56'),
(22, 3, 'Clothing and Accessories', '1', '2020-04-25 04:52:54', '2020-04-25 04:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Wellbeing', '1', '2019-07-12 05:49:18', '2020-04-25 04:45:19'),
(2, 'Hotels', '1', '2019-07-12 06:39:59', '2019-07-12 06:39:59'),
(3, 'Products', '1', '2019-07-12 06:40:07', '2019-07-12 06:40:07'),
(4, 'Restaurants', '1', '2019-07-12 06:40:17', '2020-04-25 04:44:56'),
(5, 'Other Services', '1', '2020-04-25 04:45:34', '2020-04-25 04:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `keyword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `route`, `title`, `description`, `keyword`) VALUES
(1, '/', NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL),
(3, 'dashboard', NULL, NULL, NULL),
(4, 'logout', NULL, NULL, NULL),
(5, 'forgot-password', NULL, NULL, NULL),
(6, 'login', NULL, NULL, NULL),
(7, 'reset-password', NULL, NULL, NULL),
(8, 'active-account', NULL, NULL, NULL),
(9, 'about-us', NULL, NULL, NULL),
(10, 'how-it-works', NULL, NULL, NULL),
(11, 'privacy-policy', NULL, NULL, NULL),
(12, 'terms-condition', NULL, NULL, NULL),
(13, 'customer-profile', NULL, NULL, NULL),
(14, 'my-profile', NULL, NULL, NULL),
(15, 'get-product-list', NULL, NULL, NULL),
(16, 'get-advert-list', NULL, NULL, NULL),
(17, 'search-coupon', NULL, NULL, NULL),
(18, 'add-advert', NULL, NULL, NULL),
(19, 'add-product', NULL, NULL, NULL),
(20, 'edit-product', NULL, NULL, NULL),
(21, 'get-faq', NULL, NULL, NULL),
(22, 'product-details', NULL, NULL, NULL),
(23, 'edit-advert', NULL, NULL, NULL),
(24, 'advert-details', NULL, NULL, NULL),
(25, 'discountcoupen', NULL, NULL, NULL),
(26, 'cart', NULL, NULL, NULL),
(27, 'notification', NULL, NULL, NULL),
(28, 'read-notification', NULL, NULL, NULL),
(29, 'get-advert-deal-list', NULL, NULL, NULL),
(30, 'get-advert-voucher-list', NULL, NULL, NULL),
(31, 'add-advert-voucher', NULL, NULL, NULL),
(32, 'add-advert-deal', NULL, NULL, NULL),
(33, 'advert-voucher-details', NULL, NULL, NULL),
(34, 'show-voucher', NULL, NULL, NULL),
(35, 'voucher-details', NULL, NULL, NULL),
(36, 'checkout', NULL, NULL, NULL),
(37, 'advert-voucheredit-details', NULL, NULL, NULL),
(38, 'customer-order-details', NULL, NULL, NULL),
(39, 'view-order-details', NULL, NULL, NULL),
(40, 'order', NULL, NULL, NULL),
(41, 'edit-order-details', NULL, NULL, NULL),
(42, 'withdrawal-wallet', NULL, NULL, NULL),
(43, 'contact-us', NULL, NULL, NULL),
(44, 'help', NULL, NULL, NULL),
(45, 'view-withdrawl-history', NULL, NULL, NULL),
(46, 'hot-offers', NULL, NULL, NULL),
(47, 'business-signup', NULL, NULL, NULL),
(48, 'express-checkout-success', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `type` set('text','textarea','password','select','select-multiple','radio','checkbox','file') DEFAULT NULL,
  `default` text,
  `value` text,
  `options` text,
  `is_required` tinyint(4) DEFAULT NULL,
  `is_gui` tinyint(4) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `row_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `title`, `description`, `type`, `default`, `value`, `options`, `is_required`, `is_gui`, `module`, `row_order`) VALUES
(1, 'contact_number', 'Contact Number', 'Site contact number', 'text', '+123456789', NULL, NULL, 1, 1, 'General', 1),
(2, 'date_format', 'Date Format', 'How should dates be displayed across the website and control panel? Using the <a target=\"_blank\" href=\"http://php.net/manual/en/function.date.php\">date format</a> from PHP - OR - Using the format of <a target=\"_blank\" href=\"http://php.net/manual/en/function.strftime.php\">strings formatted as date</a> from PHP.', 'text', 'd-m-Y', '01-07-2019', NULL, 1, 1, 'General', 2),
(3, 'contact_email', 'Contact Email', 'Contact email', 'text', 'admin@infoway.us', 'admin@karl.com', NULL, 1, 1, 'General', 3),
(4, 'facebook_url', 'Facebook', 'Facebook url', 'text', 'https://www.facebook.com', 'https://www.facebook.com/Halaldealsuk', NULL, 1, 1, 'Social Link', 4),
(8, 'instagram_url', 'Instagram', 'Instagram url', 'text', 'https://www.instagram.com', 'https://www.instagram.com/halal_deals', NULL, 1, 1, 'Social Link', 9),
(9, 'youtube_url', 'Youtube', 'Youtube url', 'text', 'https://www.youtube.com', 'https://www.youtube.com/laravel', NULL, 1, 1, 'Social Link', 10),
(10, 'enable_or_disable_search_box_and_text_in_banner', 'Enable Or Disable Search Box And Text In Banner', 'This will enable or diable the search box and text that is shown in the home page banner.', 'radio', NULL, '1', 'Disable,Enable', 1, 1, 'Home Page Banner', 11);

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

CREATE TABLE `static_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`id`, `slug`, `page_name`, `content`, `created_at`, `updated_at`) VALUES
(1, 'about_us', 'About Us', '<div style=\"color: rgb(51, 51, 51); font-size: 12px; text-align: center; font-family: &quot;Helvetica Neue Light&quot;, HelveticaNeue-Light, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 19px;\"><span style=\"font-size:18px\"><strong>أعوذ بالله من الشيطان الرجيم</strong></span></div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>\r\n<div style=\"color: rgb(51, 51, 51); font-size: 12px; text-align: center; font-family: &quot;Helvetica Neue Light&quot;, HelveticaNeue-Light, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 19px;\"><span style=\"font-size:18px\"><span dir=\"rtl\"><strong>بسم الله الرحمن الرحيم</strong></span></span></div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div style=\"font-size: 12px; text-align: center; font-family: &quot;Helvetica Neue Light&quot;, HelveticaNeue-Light, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 19px;\">&nbsp;</div>\r\n</div>\r\n\r\n<p><strong>Who Are We?</strong></p>\r\n\r\n<p>A team based in South London, who are working to make life easier for the Muslims around the world.</p>\r\n\r\n<p><strong>Our Aim</strong></p>\r\n\r\n<p>Our aim is to help many Muslims around the world shop. As&nbsp;Muslims, we know it can be difficult at times to find goods and services which are aligned with our beliefs. It may be finding a halal restaurant who do not serve alcohol,&nbsp;a female only spa, or finding a hotel which is close to halal restaurants or a mosque. We would like to provide you with businesses and the information that you need in order to help make living your life as a Muslim easier. We also aim to create agreements with these companies in order to bring savings to you as you shop through us.</p>\r\n\r\n<p>We also feel that the many businesses that have made sacrifices to keep their income halal as well as offering a service to the consumer should be rewarded, so we are here to promote those companies and help them find customers. May Allah reward them in this world and the next.</p>\r\n\r\n<p><strong>Our Long Term Goal</strong></p>\r\n\r\n<p>Our long term goal is to work with companies and Muslims all over the world. A Muslim in London travelling to Glasgow for work, will be able to shop with us, Muslims from the Middle East travelling for a holiday to Manchester will be able to shop with us. We aim to be able to provide you with all you need, and plan to sell everything for a trip so that you have all your arrangements made for a trip before even leaving your house.&nbsp;</p>\r\n\r\n<p>We aim to be licensed to sell airline tickets as well, so we can arrange full packages for our customers, and aim to find and locate businesses who are willing to work with us, in lesser known towns, cities and countries.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Away from Halal-Deals, the goal of the owner of the company has been to set up an orphans home, so please be aware that a portion of our profits will go towards helping this cause.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Anything we have done, or will do, can only be done by the help of the customer, the team, and with the permission and help of our Lord&nbsp;<span style=\"background-color:rgb(255, 255, 255); color:rgb(34, 34, 34); font-family:sans-serif; font-size:14px\">&nbsp;</span><span dir=\"rtl\" lang=\"ar\" style=\"background-color:rgb(255, 255, 255); color:rgb(34, 34, 34); font-family:sans-serif; font-size:14px\">ٱلْـحَـمْـدُ للهِ,</span>. May Allah give us and you more, and continue to help us be successful. Ameen</p>\r\n\r\n<p>&nbsp;</p>', NULL, '2019-11-10 14:03:29'),
(2, 'how_it_works', 'How It Works', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"text-align:justify\">&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p style=\"text-align:justify\">&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3>1914 translation by H. Rackham</h3><p style=\"text-align:justify\">&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, NULL);
INSERT INTO `static_pages` (`id`, `slug`, `page_name`, `content`, `created_at`, `updated_at`) VALUES
(3, 'privacy_policy', 'Privacy Statement and Cookie Policy', '<div class=\"page-title sub-section-title\" style=\"box-sizing: border-box; color: rgb(51, 51, 51); font-size: 3.6rem; line-height: 1.2; margin: 10px 0px 5px; font-family: &quot;Open Sans&quot;, OpenSans, system, -apple-system, BlinkMacSystemFont, Roboto, Arial, FreeSans, sans-serif;\">\r\n<div style=\"color: rgb(51, 51, 51); font-size: 12px; text-align: center; font-family: &quot;Helvetica Neue Light&quot;, HelveticaNeue-Light, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 19px;\"><span style=\"font-size:18px\"><strong>أعوذ بالله من الشيطان الرجيم</strong></span></div>\r\n\r\n<div style=\"color: rgb(51, 51, 51); font-size: 12px; text-align: center; font-family: &quot;Helvetica Neue Light&quot;, HelveticaNeue-Light, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 19px;\">&nbsp;</div>\r\n\r\n<div style=\"color: rgb(51, 51, 51); font-size: 12px; text-align: center; font-family: &quot;Helvetica Neue Light&quot;, HelveticaNeue-Light, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 19px;\"><span style=\"font-size:18px\"><span dir=\"rtl\"><strong>بسم الله الرحمن الرحيم</strong></span></span></div>\r\n\r\n<p><strong><span style=\"font-size:18px\">Halal-Deals.co.uk&nbsp;Privacy Policy</span></strong></p>\r\n</div>\r\n\r\n<p>At Halal-Deals.co.uk we are deeply committed to maintaining the trust and confidence of our customers. As part of that commitment, we believe that it is important to explain to you, as clearly as possible, how and when we use cookies and similar technologies on our websites and mobile applications (together, we call these the &quot;Site&quot;) to collect and use your information.</p>\r\n\r\n<p><strong><span style=\"color:rgb(51, 51, 51); font-family:open sans,opensans,system,-apple-system,blinkmacsystemfont,roboto,arial,freesans,sans-serif; font-size:14px\">WHAT ARE COOKIES?</span></strong></p>\r\n\r\n<p>Cookies are unique identifiers, usually made up of small bits of text or code that are placed on your device. Cookies are widely used by website owners and their partners to help websites operate, work more efficiently, and personalise the experience for you.</p>\r\n\r\n<p>Cookies may be placed on your device by Halal-Deals, which are &quot;first party&quot; cookies. Cookies may also be placed on your device by a party other than Halal-Deals, such as our Business Partners. These are &quot;third party&quot; cookies.</p>\r\n\r\n<p>When we say &quot;Business Partners&quot;, we mean third parties with whom we conduct business, such as merchants, co-marketers, distributors, resellers, and other companies or organisations with whom we enter into agreements to support our business and operations, including advertising partners.</p>\r\n\r\n<p><strong><span style=\"color:rgb(51, 51, 51); font-family:open sans,opensans,system,-apple-system,blinkmacsystemfont,roboto,arial,freesans,sans-serif; font-size:14px\">WHAT ARE COOKIES USED FOR?</span></strong></p>\r\n\r\n<p>The first and third party cookies on our Site provide various functions:</p>\r\n\r\n<p><u>Essential Cookies</u>: These cookies are essential for our Site to work properly. They include, for example, cookies that make it possible for you to browse and use our Site, such as cookies that remember you have logged in to your Halal-Deals account.</p>\r\n\r\n<p><u>Functional Cookies</u>: These cookies gather information about how visitors use the Site, monitor the Site&#39;s performance, and are used to recognise and remember your preferences. If you agree to receive emails from us, we also use them to track responses to emails we send you, and to track whether you opened or deleted an email. Functional cookies can also be used to identify and remedy operational problems with the Site.</p>\r\n\r\n<p><u>Advertising Cookies</u>: These cookies record your online activities, including your activities on our Site, such as the pages visited, and the links and advertisements clicked. These cookies are used to provide an engaging and easy online experience that is tailored to your interests by delivering personalised advertising content. For example, if you view a particular offer on our Site, we may work with our Business Partners to show you that offer, or a similar offer, on other sites.</p>\r\n\r\n<p>The advertising cookies we use on our Site are placed by either Halal-Deals or our Business Partners. Any information collected by our Business Partners will be used in accordance with their own privacy policies. To learn more about advertising cookies, please visit&nbsp;<a href=\"http://www.youronlinechoices.com/uk/\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">http://www.youronlinechoices.com/uk/</a>.</p>\r\n\r\n<p>We also use cookies that allow you to make posts to social media sites. For example, you can post deals you have viewed or purchased directly to social media sites to share with your friends.</p>\r\n\r\n<p><strong><span style=\"color:rgb(51, 51, 51); font-family:open sans,opensans,system,-apple-system,blinkmacsystemfont,roboto,arial,freesans,sans-serif; font-size:14px\">HOW LONG DO COOKIES STAY ON MY DEVICE?</span></strong></p>\r\n\r\n<p>Cookies are either classified as &quot;Session Cookies&quot; or &quot;Persistent Cookies.&quot;</p>\r\n\r\n<p>Session Cookies are stored temporarily and deleted once you close the browser window.</p>\r\n\r\n<p>Persistent Cookies are stored on your device between browser sessions, and are beneficial because they allow us to remember your preferences and activities while on the Site. The length of time these cookies remain on your device will vary, as it depends on the specific cookie used.</p>\r\n\r\n<p><strong><span style=\"color:rgb(51, 51, 51); font-family:open sans,opensans,system,-apple-system,blinkmacsystemfont,roboto,arial,freesans,sans-serif; font-size:14px\">HOW DO I MANAGE COOKIES?</span></strong></p>\r\n\r\n<div id=\"cc-manage-section\" style=\"box-sizing: border-box; display: none; color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, OpenSans, system, -apple-system, BlinkMacSystemFont, Roboto, Arial, FreeSans, sans-serif; font-size: 14px;\">\r\n<p><strong>You can opt-out of using certain cookies, but choosing to do so could hinder your experience on our Site. For instance, if you opt-out of functional cookies the Site may no longer be able to remember your preferences, such as language and country. Similarly, if you opt-out of advertising cookies, you will still see online advertisements, but they will no longer be tailored to your personal interests and tastes.</strong></p>\r\n\r\n<p><strong>You can opt-out of certain cookies by clicking the boxes below:</strong></p>\r\n\r\n<form id=\"cc-form\">\r\n<div class=\"flex-row\" style=\"box-sizing: border-box; margin-top: 20px; display: flex;\">\r\n<div class=\"flex-column gig-selectable\" style=\"box-sizing: border-box;\"><strong><input checked=\"checked\" name=\"essential\" style=\"border-width:0px; height:1.4rem; margin:0px; width:1.4rem\" type=\"checkbox\" />Essential Cookies</strong></div>\r\n\r\n<div class=\"flex-column cc-checkbox-label-column\" style=\"box-sizing: border-box; margin-left: 4px;\">\r\n<div class=\"sub-section-title\" style=\"box-sizing: border-box; font-size: 1.4rem; font-weight: 600; line-height: 1.2; margin: 1px 0px 6px;\">\r\n<div class=\"cc-label-txt\" style=\"box-sizing: border-box; color: rgb(112, 113, 116); font-size: 14px; line-height: 1.2;\"><strong>Essential Cookies</strong></div>\r\n</div>\r\n<strong><span style=\"color:rgb(112, 113, 116)\">These cookies are required to enable core functionality of the site, e.g. to keep you logged in as you navigate the site and to process purchases.</span></strong></div>\r\n</div>\r\n\r\n<div class=\"flex-row\" style=\"box-sizing: border-box; margin-top: 20px; display: flex;\">\r\n<div class=\"flex-column gig-selectable\" style=\"box-sizing: border-box;\"><strong><input name=\"functional\" style=\"border-width:0px; height:1.4rem; margin:0px; width:1.4rem\" type=\"checkbox\" />Functional Cookies</strong></div>\r\n\r\n<div class=\"flex-column cc-checkbox-label-column\" style=\"box-sizing: border-box; margin-left: 4px;\">\r\n<div class=\"sub-section-title\" style=\"box-sizing: border-box; font-size: 1.4rem; font-weight: 600; line-height: 1.2; margin: 1px 0px 6px;\">\r\n<div class=\"cc-label-txt\" style=\"box-sizing: border-box; color: rgb(112, 113, 116); font-size: 14px; line-height: 1.2;\"><strong>Functional Cookies</strong></div>\r\n</div>\r\n<strong><span style=\"color:rgb(112, 113, 116)\">These cookies are used to remember your preferences and analyse the usage of our Site. With these cookies enabled, we can provide you with the best experience and show you the most relevant deals based on your interests. Without these cookies, we may not show you the most personalised selection of deals and you may experience slower performance on the website.</span></strong></div>\r\n</div>\r\n\r\n<div class=\"flex-row\" style=\"box-sizing: border-box; margin-top: 20px; display: flex;\">\r\n<div class=\"flex-column gig-selectable\" style=\"box-sizing: border-box;\"><strong><input name=\"marketing\" style=\"border-width:0px; height:1.4rem; margin:0px; width:1.4rem\" type=\"checkbox\" />Advertising Cookies</strong></div>\r\n\r\n<div class=\"flex-column cc-checkbox-label-column\" style=\"box-sizing: border-box; margin-left: 4px;\">\r\n<div class=\"sub-section-title\" style=\"box-sizing: border-box; font-size: 1.4rem; font-weight: 600; line-height: 1.2; margin: 1px 0px 6px;\">\r\n<div class=\"cc-label-txt\" style=\"box-sizing: border-box; color: rgb(112, 113, 116); font-size: 14px; line-height: 1.2;\"><strong>Advertising Cookies</strong></div>\r\n</div>\r\n<strong><span style=\"color:rgb(112, 113, 116)\">These cookies allow our authorised third-party partners to understand how you use the Site and the types of offers you are interested in most. Without these cookies, you cannot share any deals on social media and our advertising partners will not be able to show you the most relevant ads on third-party websites.</span></strong></div>\r\n</div>\r\n\r\n<div class=\"btn\" id=\"cc-submit-btn\" style=\"box-sizing: border-box; border: 1px solid var(--color-prim-400); color: rgb(255, 255, 255); display: inline-block; font-size: 1.6rem; margin: 25px 0px 0px; min-width: 150px; outline: 0px; overflow: visible; line-height: 2.2rem; padding: 8px 20px 10px; border-radius: 2px; position: relative; text-align: center; transition: background-color 0.2s ease-out 0s, border-color 0.2s ease-out 0s, color 0.2s ease-out 0s; cursor: pointer; font-weight: 600; pointer-events: auto; opacity: 1;\"><strong>Submit</strong></div>\r\n</form>\r\n</div>\r\n\r\n<p>You may also disable certain cookies through your browser settings. In particular, you can disable these cookies on Apple Safari (as described&nbsp;<a href=\"https://support.apple.com/en-gb/guide/safari/manage-cookies-and-website-data-sfri11471/mac\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">here</a>), Google Chrome (as described&nbsp;<a href=\"https://support.google.com/chrome/answer/95647?hl=en-GB&amp;%3Bp=cpn_cookies\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">here</a>), Internet Explorer (as described&nbsp;<a href=\"https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">here</a>) and Mozilla Firefox (as described&nbsp;<a href=\"https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">here</a>). Please check your browser settings for more information. Within each browser, you can select the option to clear all cookies and other browsing data.</p>\r\n\r\n<p>If you use the Site after you have cleared all cookies from your browser settings, cookies may be placed on your device again. To avoid having these cookies placed on your device again, you can opt-out as described above or by installing an application on your browser, such as Ghostery or PrivacyBadger, to ensure certain cookies are not placed on your device.</p>\r\n\r\n<p>For advertising cookies, in addition to the tool provided above, you can also visit&nbsp;<a href=\"http://www.youronlinechoices.com/uk/\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">http://www.youronlinechoices.com/uk/</a>&nbsp;and turn off certain cookies through the &#39;Your Ad Choices&#39; page.</p>\r\n\r\n<p>On mobile devices, you can also limit personalised advertising by reviewing and adjusting the setting provided by your device manufacturer, such as&nbsp;<a href=\"https://support.apple.com/en-gb/HT202074\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">&quot;Limit Ad Tracking&quot;</a>&nbsp;for Apple&#39;s iOS devices or&nbsp;<a href=\"https://policies.google.com/technologies/ads?hl=en-GB\" style=\"box-sizing: border-box; color: rgb(0, 118, 214); text-decoration-line: none;\" target=\"_blank\">&quot;Opt-out of interest-based ads&quot;</a>&nbsp;for Android. You can opt out of all personalised advertising or reset your advertising ID, so you only see personalised advertising related to what you look at from the point you reset it.</p>\r\n\r\n<p><strong><span style=\"color:rgb(51, 51, 51); font-family:open sans,opensans,system,-apple-system,blinkmacsystemfont,roboto,arial,freesans,sans-serif; font-size:14px\">PRIVACY</span></strong></p>\r\n\r\n<p>For more information on our approach to privacy, please see our Privacy Statement below.</p>\r\n\r\n<p><strong><span style=\"color:rgb(51, 51, 51); font-family:open sans,opensans,system,-apple-system,blinkmacsystemfont,roboto,arial,freesans,sans-serif; font-size:14px\">WHAT IF I HAVE QUESTIONS?</span></strong></p>\r\n\r\n<p>If after reading this Cookies Policy you have any questions please contact us via our Contact Us page.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style=\"font-size:16px\">Halal Deals Privacy Statement</span></strong></p>\r\n\r\n<p><strong>Effective Date:&nbsp;</strong><strong>11 November 2019</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">This Privacy Statement explains how Halal-Deals.co.uk&nbsp;collect, control, process, and use information about you (which we call &ldquo;personal data&rdquo;).</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">When we say &ldquo;Halal Deals&rdquo;, &ldquo;us&rdquo;, &ldquo;our&rdquo;, or &ldquo;we&rdquo;, we mean Halal-Deals.co.uk. &nbsp;Halal-Deals.co.uk&nbsp;provides a platform&nbsp;where we and other unaffiliated third-party sellers (collectively &ldquo;Sellers&rdquo;) can list offers for goods, and services.&nbsp;</span><span style=\"font-family:helvetica neue\">We</span><span style=\"font-family:helvetica neue; font-size:11pt\"> collect, process, and use your personal data as necessary to facilitate the sale of goods, and services.&nbsp;&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">When we talk about the &ldquo;Site&rdquo;, we mean our platforms, which include our websites, mobile applications, communications we send or services we provide, social networking sites, or any other websites we offer that link to or reference this Privacy Statement.</span></p>\r\n\r\n<p><strong>Change</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We routinely update this Privacy Statement to clarify our practices and to reflect new or different privacy practices, such as when we add new services, functionality, or features to the Site. If we make any material changes we will notify you, either by email (sent to the email address specified in your account), by means of notice on the Site or by using other methods. You can determine when this version of the Privacy Statement was adopted by referring to the &ldquo;Effective Date&rdquo; above.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue\">You understand that your continued use of the Site after we send a notice about our changes to the Privacy Statement means that the collection, control, processing, and use of your personal data is subject to the updated Privacy Statement. &nbsp;If you object to any changes, you may modify your account settings accordingly or close your account as described below.</span></p>\r\n\r\n<p><strong>1. Personal Data We Collect</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We will collect the following personal data when you interact with the Site:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Authentication and identification information (e.g. your name, email address, and password). This information is necessary to set up and log you into your account. If you don&rsquo;t provide this, we may not be able to provide our full range of account services to you;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Basic personal details (e.g. your name, date of birth, and nationality);</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Contact details (e.g. your postal address, telephone number, and email address). We may need some of this information to deliver products to you, such as your postal address to deliver physical products and your email address to send you vouchers, and won&rsquo;t be able to carry out these services if you don&rsquo;t provide it;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Payment details (e.g. your credit card details or payment tokens from third party payment providers like PayPal). We use these to process your order, and won&rsquo;t be able to take payment from you or give refunds if you don&rsquo;t provide it; and</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Information about your contacts with Halal Deals (e.g. call recordings, instant messages on our site, and user generated content).</span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">Some information we collect is necessary for us to provide our services or meet our legal obligations. We will make this clear when we collect that information from you.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We will also automatically collect personal data when you interact with the Site through your computer, mobile device, or other device. This personal data includes the following:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Analytics data (e.g. information about app downloads, app and web page histories), which may include data collected from cookies and other types of device identifiers;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Profile inputs (e.g. page and deal views on the site, purchase details, click information and information about the website you clicked to our Site from). This may include data about your location. With respect to geolocation information collected from your mobile device, we will only collect this where you have provided consent; and</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Device details (e.g. MAC address, IP address, bluetooth data and advertising identifiers).</span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-family:helvetica neue\">We also receive personal data and other online and offline information from&nbsp;</span><span style=\"font-family:helvetica neue\">third parties with whom we conduct business, such as merchants, co-marketers, distributors, resellers, and other companies or organizations with whom we enter into agreements to support our business and operations</span><span style=\"font-family:helvetica neue; font-size:11pt\">, including advertising partners and third party data providers that provide us with supplemental or additional information about our customers (collectively &ldquo;Business Partners&rdquo;).</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">The personal data we receive from Business Partners includes basic personal details, contact details, device details, profile inputs, as well as:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Demographic information, (e.g. details about age brackets and educational background);</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Location data (e.g. information about postal or ZIP code); and</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Purchase information from third party sites (e.g. information about purchases on other sites).</span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We will only receive data from our Business Partners where they are legally permitted to share such data, and we will only process that data for the purposes described below. We use the data provided to better understand your preferences, deals that are relevant to you, and how our merchants are performing. By combining the data we collect directly from you with that received from third parties, we are able to &nbsp;provide you with a better, and more personalised experience.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We will collect the personal data described above at various stages in your relationship with us when you:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Register, subscribe, authorise the transfer of, or create an account with us. If you choose not to create a password for your account, we create an account and link your purchase details to your email address, which you can set a password for during each purchase;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Open or respond to emails or messages from us;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Provide information to enroll or participate in programs provided on behalf of, or together with Sellers and Business Partners, with your consent or as necessary to provide services you have requested;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Visit any page online that displays our ads or content;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Purchase products or services on or through the Site from Sellers;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Connect, log-in, or link to the Site using social networking tools; and</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Post comments to the online communities sections of the Site.</span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We also create profiles about you based on the personal data you provide to us or that is collected about you, as described above and including personal data that we receive from Business Partners. We do this to market offers to you we think you would be interested in buying. The contents of that profile include:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><strong>Account details.&nbsp;</strong><span style=\"font-family:helvetica neue\">For example, we create a permanent URL to your account page which may include your name. We also generate tokens to remember your subscription and purchase histories, and any loyalty numbers you may have obtained;</span></li>\r\n	<li style=\"text-align:left\"><strong>Marketing segment information.&nbsp;</strong><span style=\"font-family:helvetica neue\">For example, if you purchase products or services related to wellness and beauty, we may infer that you are interested in these types of products;</span></li>\r\n	<li style=\"text-align:left\"><strong>Audience information.&nbsp;</strong><span style=\"font-family:helvetica neue\">We create audiences based on parameters such as gender, age, and location (e.g. males aged 25-35 in your city), and if your personal data matches those audiences, you&rsquo;ll be assigned to it. This is to help you receive relevant offers; and</span></li>\r\n	<li style=\"text-align:left\"><strong>Activity information.</strong><span style=\"font-family:helvetica neue\">&nbsp;Based on your interactions with communications, we&rsquo;ll generate personal data about how many communications you like to receive, so that we don&rsquo;t send you more than are useful to you.</span></li>\r\n</ul>\r\n\r\n<p><strong>2. Your Choices</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">You can manage the types of personal data you provide to us and can limit how we communicate with you. At the same time, we think that the more you tell us about yourself and what you like, the more relevant and valuable your experience with our Site and services will be.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">You can manage your email, push notification, location information and subscription notification preferences by logging into your account through the Site or by adjusting the settings in our mobile application:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><strong>Push notifications and location information. &nbsp;</strong><span style=\"font-family:helvetica neue\">Your device and the&nbsp;mobile app provide you with options to control push notifications and how and when we collect your geolocation. You can disallow our use of certain location data through your device or browser settings, for example, by disabling &ldquo;Location&rdquo; services for the application in Apple&rsquo;s iOS and Android privacy settings, or by disabling &ldquo;Location&rdquo; services for your device;</span></li>\r\n	<li style=\"text-align:left\"><strong>Subscriptions. &nbsp;</strong><span style=\"font-family:helvetica neue\">You can also manage your subscriptions by following subscription management instructions contained in any commercial emails that we send you. You may choose to subscribe to some types of messages, and may choose not to subscribe to, or to unsubscribe from, others. You may update your subscription preferences at any time. Even if you decide not to subscribe to, or to unsubscribe, from promotional email messages, we may still need to contact you with important transactional information related to your account and your purchases from Sellers. For example, even if you have unsubscribed from our promotional email messages or push notifications, we will still send you confirmations when you make purchases on the Site;</span></li>\r\n	<li style=\"text-align:left\"><strong>Cookies. &nbsp;</strong><span style=\"font-family:helvetica neue\">You can manage how your browser handles cookies. You may also manage how your mobile device and mobile browser share information on and about your devices with us, as well as how your mobile browser handles cookies. Please refer to our&nbsp;</span><span style=\"font-family:helvetica neue\">Cookies Policy above</span><span style=\"font-family:helvetica neue\">&nbsp;for more information;</span></li>\r\n	<li style=\"text-align:left\"><strong>Objecting to uses of data.&nbsp;</strong><span style=\"font-family:helvetica neue\">In certain circumstances, you have the right to object to the use of your personal data. In particular, you can object to our use of personal data where we use such data to meet our own interests in running our business (as described under &lsquo;How We Use Information&rsquo; below and including use of your data for marketing purposes and management of our business needs). If you object to our use of your data, we will assess the objection and cease processing that data upon confirmation of a valid request. For more information, see &lsquo;Your Rights&rsquo; below</span><span style=\"font-family:helvetica neue\">;</span></li>\r\n	<li style=\"text-align:left\"><strong>Social networking</strong><span style=\"font-family:helvetica neue\">. &nbsp;You may also manage sharing certain personal data with us when you connect with us through social networking platforms or applications. Please refer to Section 8 below and also the privacy policy and settings of the social networking website or application to determine how you may adjust our permissions and manage the interactivity between us and your social networking account or your mobile device.</span></li>\r\n</ul>\r\n\r\n<p><strong>3. Your Rights</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">You can access, update, rectify, and delete your personal data which makes up some of your profile by logging into your account or contacting us here. Keeping your personal data current helps ensure that we can respect your preferences and offer you the goods and services that are most relevant to you.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">In accordance with applicable law, you may (i) request access to any personal data we hold about you; (ii) request that it be updated, rectified, deleted or blocked; (iii) request that we delete personal data we hold about you; (iv) request that we restrict our processing of your personal data; and (v) request that we provide you or a third party with a copy of certain personal data about you (that is referred to as the right of &nbsp;&ldquo;data portability&rdquo;). You can also object to any of our uses of your personal data described in this policy, including our marketing activities. You may also revoke your consent to the processing of your personal data, to the extent consent was required and provided by you.</span></p>\r\n\r\n<p><strong>4. How We Use Information</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We control and process the personal data you provide to us, which we collect from other sources, and which we generate to:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue\">Create your account when you sign up and log you in, which is necessary for us to provide our services to you in accordance with the&nbsp;</span><span style=\"font-family:helvetica neue\">Terms of Use</span><span style=\"font-family:helvetica neue; font-size:11pt\">.&nbsp; If you make purchases without creating a password, we link these purchases to your email address and create a secure account in our systems. If you create a password at a later date, you will be able to see the past purchases made with a particular email address;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Operate, maintain, and improve the Site by analysing how you and our other customers use and interact with it. This is to meet our legitimate business interests in providing the Site and ensuring that it provides the best experience for our customers;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue\">Validate, facilitate, and prevent fraudulent purchases. This may include processing orders for vouchers and other goods and services, payment verification, and verifying that vouchers redeemed by customers are valid. This is necessary to meet our contractual commitments to you set out in the&nbsp;</span><span style=\"font-family:helvetica neue\">Terms of Use</span><span style=\"font-family:helvetica neue; font-size:11pt\">;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Carry-out marketing, which may involve:</span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Establishing and analysing individual and group profiles and customer behaviour, in order to determine your or others interest in certain types of offers, products, and services. We do this by analysing your interactions with the Site and your other personal data (including personal data received from Business Partners) to determine what your interests are, and what sorts of products and services people with similar interests also buy, which helps us understand what products and services you may be interested in viewing. This is to meet our legitimate interests in understanding the types of products and services our customers are interested in, and to provide the most relevant products to you and our other customers;</span></li>\r\n	<li style=\"text-align: left;\"><span style=\"font-family:helvetica neue\">Showing relevant offers and advertising. We will use the profiles described above to create advertising for our products that will be displayed on relevant third-party sites. We do this to meet our legitimate interests in showing you products which may be relevant to you, and you can opt out of seeing these types of ads as described in our&nbsp;</span><span style=\"font-family:helvetica neue\">Cookies Policy</span><span style=\"font-family:helvetica neue; font-size:11pt\">;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Sending you relevant direct marketing messages and other communications via email or push notifications on mobile devices, including, with your consent, using your location data to notify you of tailored location-based deals. We will either send these messages on the basis that you have consented to receiving them or, where permitted by applicable law, to meet our legitimate interests in showing you which of our products and services are relevant to you; and</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">Analysing advertising effectiveness, which may involve analysing the advertising campaigns our customers choose to interact with most often. This is to meet our legitimate interests in understanding which types of advertising campaigns are more or less effective than others.</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue\">Answer your questions and respond to your requests, for example in the context of customer service. This is to meet our contractual commitments to you in the&nbsp;</span><span style=\"font-family:helvetica neue\">Terms of Use</span><span style=\"font-family:helvetica neue; font-size:11pt\">&nbsp;where these questions or requests are part of the purchase process or to comply with legal obligations (such as allowing you to exercise your rights as described above), and in other cases to meet our legitimate interests in providing a good service to our customers;</span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\">Send you reminders, technical notices, updates, security alerts, support and administrative messages, service bulletins, and requested information, including on behalf of Business Partners or other Sellers. This is to meet our legitimate interests in managing our relationship with you effectively;</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\">Administer rewards, surveys, contests, or other promotional activities or events, in order to meet our contractual commitments to you set out in the terms and conditions of those promotional events</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue\">Manage our everyday business needs, such as administration of the Site, forum management, fulfillment, analytics, fraud prevention, and enforcement of our corporate reporting obligations and&nbsp;</span><span style=\"font-family:helvetica neue\">Terms of Use</span><span style=\"font-family:helvetica neue; font-size:11pt\">&nbsp;or to comply with the law; and</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\"><span style=\"font-family:helvetica neue; font-size:11pt\">Comply with our legal obligations, resolve disputes, and enforce our agreements. We do this where necessary to comply with legal obligations to which we are subject, or to meet our legitimate interests in enforcing our legal rights and resolving disputes or verifying payments and preventing fraud.</span></span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p><strong>5. When and Why We Disclose Personal Data</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We share your personal data as follows:</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">with your consent;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">with unaffiliated third-party Sellers and Business Partners , so they can sell, deliver, and provide the products or services purchased to you (e.g. to deliver products to you, or to provide a Getaways provider with your details so they can confirm reservations). We share personal data with unaffiliated third-party Sellers and Business Partners in order to meet our contractual obligations to you, and they are not permitted to use your personal data in any way other than for selling, delivering, and/or providing the products or services purchased by you;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue\">with third parties that provide tools and services to help us better understand your deal preferences, so that we can show you advertisements for our vouchers, goods, or services on third party websites which are more suited to your interests and tastes. Those third parties may also use your personal data to match you with their existing customer base. You can stop our use of these tools in the ways described in our&nbsp;</span><span style=\"font-family:helvetica neue\">Cookies Policy</span><span style=\"font-family:helvetica neue; font-size:11pt\">;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">to report or collect on debts owed to Sellers or other Business Partners;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">as necessary to perform contractual obligations towards you with Sellers or Business Partners to the extent you have purchased or redeemed a voucher, goods, or services offered by them or participated in an offer, rewards, contest or other activity or program sponsored or offered through us or the Sellers on behalf of a Business Partner;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">to a subsequent owner, co-owner, or operator of one or more of the Sites or any portion or operation related to part of one or more of the Sites;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">in connection with a corporate merger, consolidation, or restructuring, the sale of substantially all of our stock and/or assets, or other corporate change, including, without limitation, during the course of any due diligence process;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">to comply with legal orders and government requests, or as needed to support auditing, compliance, and corporate governance functions, where this is necessary to comply with these legal obligations;</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">to combat fraud or criminal activity, and to protect our rights or those of our&nbsp;Sellers, or Business Partners, and users, or as part of legal proceedings affecting us&nbsp;as it is in our legitimate interests to prevent fraud and protect these rights; or</span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-family:helvetica neue; font-size:11pt\">in response to a subpoena, or similar legal process, including to law enforcement agencies, regulators, and courts, to the extent this is necessary to comply with such legal obligations.</span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We encourage our unaffiliated third-party Sellers and Business Partners to adopt and post privacy policies. However, while we share personal data with Sellers and Business Partners only for the above-mentioned purposes, their subsequent processing and use of personal data obtained through us is governed by their own privacy policies and practices and is not under our control (except for the use and processing by Sellers and Business Partners providing services to us, as described above). Where possible, we contractually restrict how our Sellers and Business Partners, including merchants, use your personal data and aim to ensure they do not use it for any purposes which are incompatible with those set out in this privacy statement.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">In a number of the cases set out above, we will transfer your personal data to a country located outside the European Economic Area that may not be considered as providing the same level of protection for personal data under European law. In such cases, we put in place appropriate safeguards, including contractual commitments approved by the European Commission, on recipients of the data, to ensure that there is adequate protection for your personal data. For more information about the safeguards in place and to view a copy of such safeguards, please contact us using the details below.</span></p>\r\n\r\n<p><strong>6. Security of Personal Data</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue\">We have implemented an information security program that contains administrative, technical and physical controls that are designed to safeguard your personal data, including industry-standard encryption technology. However,&nbsp;</span><span style=\"font-family:helvetica neue; font-size:11pt\">no method of transmission over the Internet, or method of electronic storage, is 100% secure. Therefore, we cannot guarantee its absolute security.</span></p>\r\n\r\n<p><strong>7. Retention of Personal Data</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We will retain your personal data for as long as your account is active or as needed to provide you services. If you close your account, we will retain your personal data for a period where it is necessary to continue operating our business effectively, to maintain a record of your transactions for financial reporting purposes or fraud prevention purposes until these purposes no longer exist, and to retain as necessary to comply with our legal obligations, resolve disputes, and enforce our agreements.</span></p>\r\n\r\n<p><strong>8. Social Networks</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">Social Community Areas</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue\">You may access the Site through, or the Site may contain connections to, areas where you may be able to publicly post information, communicate with others such as discussion boards or blogs, review products and merchants, and submit media content. Prior to posting in these areas, please read our&nbsp;</span><span style=\"font-family:helvetica neue\">Terms of Use</span><span style=\"font-family:helvetica neue; font-size:11pt\">&nbsp;carefully. All of the information you post may be accessible to anyone with Internet access, and any information you include in your posting may be read, collected, and used by others. For example, if you post your email address along with a public restaurant review, you may receive unsolicited messages from other parties. You should avoid publicly posting sensitive information about you or others.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">Connecting through Social Networks</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">We offer social networking users the opportunity to interact with friends and to share on social networks. If you are logged into both the Site and a social network, when you use the Site&rsquo;s social networking connection functions, you will connect your social network account with your account (this happens automatically, if the email addresses match). If the email addresses do not match, we ask you if you want to link them and you must validate that you control the accounts by logging in to your social network account. If you are already logged into the Site but not into your social network site, when you use the Site&rsquo;s social network connection functions, you will be prompted to enter your social network website credentials or to sign up for the social network.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">If you are not currently registered as a Halal Deals user and you use the Site&rsquo;s social network connection functions, you will first be asked to enter your social network credentials and then be given the option to register and join Groupon. Once you register with us and connect with the social network, you will be able to automatically post recent Groupon activity back to your social network. Please refer to the privacy settings in your social network account to manage the data that is shared through your account.</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">When you use the Site&rsquo;s social network connection function, you will have the opportunity to consent to our accessing all of the elements of your social network profile information that you have made available to be shared (as per the settings chosen by you in your social network profile) and to use it in accordance with the social network&rsquo;s terms of use and this Privacy Statement. You can withdraw this consent at any time.</span></p>\r\n\r\n<p><strong>9. Privacy Practices of Third Parties</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">This Privacy Statement only addresses the collection, processing and use (including disclosure) of personal data by us through your interaction with the Site. Other websites that may be accessible through links from the Site may have their own privacy statements and personal data collection, processing, use, and disclosure practices. Our Business Partners may also have their own privacy statements. We encourage you to familiarise yourself with the privacy statements provided by these other parties prior to providing them with information or taking advantage of a sponsored offer or promotion.</span></p>\r\n\r\n<p><strong>10. Contact Us</strong></p>\r\n\r\n<p><span style=\"font-size:14.6667px\">If you would like to make use of any of the above rights or any other rights in relation to your personal data please go to: https://gr.pn/privacy.&nbsp;</span></p>\r\n\r\n<p><span style=\"font-size:14.6667px\">If you have any questions or comments about our privacy practices or this Privacy Statement please contact our Data Protection officer at dpo@groupon.com or privacy@groupon.co.uk.&nbsp; &nbsp;You can also reach us via postal mail at the following address:</span></p>\r\n\r\n<p><span style=\"font-family:helvetica neue; font-size:11pt\">Groupon International Limited, ATTN: Data Protection Officer, Lower Ground Floor, Connaught House, 1 Burlington Road, Dublin 4, 216410 Ireland.</span></p>\r\n\r\n<p><strong>11. Other Contacts</strong></p>\r\n\r\n<p><span style=\"font-family:helvetica neue\">We are committed to working with you to obtain a fair resolution of any request, complaint, or concern about our use of your personal data. If, however, you believe that we have not been able to assist you, you have the right to make a complaint to the data protection authority in your country of residence&nbsp;</span><span style=\"color:rgb(17, 85, 204); font-family:helvetica neue\"><a href=\"https://ico.org.uk/\" style=\"box-sizing: border-box; text-decoration: inherit;\">https://ico.org.uk</a></span><span style=\"font-family:helvetica neue; font-size:11pt\">&nbsp;or to our Lead Supervisory Authority:</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>By Post:</strong></p>\r\n\r\n<p><strong>Data Protection Commission</strong></p>\r\n\r\n<p><strong>Canal House, Station Road</strong></p>\r\n\r\n<p><strong>Portarlington, Co. Laois</strong></p>\r\n\r\n<p><strong>R32 AP23</strong></p>\r\n\r\n<p><strong>Ireland</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>By Email:</strong></p>\r\n\r\n<p><strong>info@dataprotection.ie</strong></p>', NULL, '2019-11-10 21:27:36');
INSERT INTO `static_pages` (`id`, `slug`, `page_name`, `content`, `created_at`, `updated_at`) VALUES
(4, 'terms_conditions', 'Terms & Conditions', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"text-align:justify\">&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p style=\"text-align:justify\">&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3>1914 translation by H. Rackham</h3><p style=\"text-align:justify\">&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, NULL),
(5, 'help', 'HELP', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3><p style=\"text-align:justify\">&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p style=\"text-align:justify\">&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3>1914 translation by H. Rackham</h3><p style=\"text-align:justify\">&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` enum('1','2','3','4') DEFAULT NULL COMMENT '1=>Admin, 2=>Business Admin, 3=>Business Manager, 4=>Customer',
  `social_id` varchar(255) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `account_type` enum('1','2','3','4') NOT NULL DEFAULT '4' COMMENT '1=>Facebook, 2=>Google, 3=>Hotmail, 4=>Normal',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address1` text,
  `address2` text,
  `country` int(11) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `cust_email_notification` enum('0','1','','') DEFAULT NULL COMMENT '0=>Not Allowed,1=>Allowed',
  `cust_phone_notification` enum('0','1','','') DEFAULT NULL COMMENT '0=>Not Allowed,1=>Allowed',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `active_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `terms_and_cond_agreed` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>No, 1=>Yes',
  `terms_and_cond_date` datetime DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 2=>Block',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type_id`, `social_id`, `cust_id`, `account_type`, `first_name`, `last_name`, `email`, `password`, `image`, `title`, `dob`, `phone`, `address1`, `address2`, `country`, `town`, `city`, `post_code`, `cust_email_notification`, `cust_phone_notification`, `email_verified_at`, `active_token`, `reset_token`, `remember_token`, `terms_and_cond_agreed`, `terms_and_cond_date`, `status`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', NULL, NULL, '4', 'Halal', 'Deals', 'admin@halaldeals.com', '$2y$10$5.QgXZBiJZYUvRVVHtSeJ.14rn0WuaWMByHmpSR4rOJYQrW.eyNc.', 'Jd83htWCw07g.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2020-12-23 12:36:42', '2019-07-09 02:15:08', '2020-12-23 12:36:42', NULL),
(2, '4', NULL, NULL, '4', 'Hhhh', 'Ggggg', 'iontexproject@gmail.com', '$2y$10$POgZ1O3IrC1b4r/CAuiua.w5druzl37kJique5KWVhl7ee6x8IZIi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '2', NULL, '2019-07-12 05:36:19', '2019-07-12 05:37:38', '2019-07-12 05:37:38'),
(3, '3', NULL, NULL, '4', 'Ffff', 'Bbbbbbb', 'fegth@bgfb', '$2y$10$nuYji./nUwPuzuxbR1kZ.ezjGTYn9R54FGF62i1myRgs2miiH2yc.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-07-12 06:11:08', '2019-07-12 06:16:01', '2019-07-12 06:16:01'),
(4, '3', NULL, NULL, '4', 'Ghkwefug', 'Uygefiur', 'ggf@gjhort', '$2y$10$9SRdMAr.Ke9KFyz83eP3YOA/7MaGZ44FBSzFK9zQCBisN718Y4vqu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-07-12 06:13:12', '2019-07-12 06:13:57', '2019-07-12 06:13:57'),
(5, '3', NULL, NULL, '4', 'Htyku', 'Trtkmn', 'frehy@kjkl', '$2y$10$JOSW9AW5i8AKQS8zz9XVoupx3oU9Z6YlF9H4JLhUx1dF7cTl3EzNG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-07-12 06:14:17', '2019-07-12 06:16:07', '2019-07-12 06:16:07'),
(6, '3', NULL, NULL, '4', 'Joiiujokml', 'Fghbhb', 'rjiou@jiouj', '$2y$10$n7v9FDyLQebYulI5YoH/DOteO4cng5Si86HCiqXGZpnCNl2Ub2t.q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-07-12 06:15:37', '2019-07-12 06:16:13', '2019-07-12 06:16:13'),
(7, '4', NULL, NULL, '4', 'Vguhi', 'Jhioiuo', 'vguhoikj@kjhkvfj', '$2y$10$kQdWFBQ0YagI48tH1AKhp.G0RKvDOHGqLb3IYy0aV2qeWeIxt7f76', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a2YP28Rw2MwYteUd6hE2', NULL, NULL, '0', NULL, '0', NULL, '2019-07-12 06:18:02', '2019-07-12 06:19:52', '2019-07-12 06:19:52'),
(8, '3', NULL, NULL, '4', 'Hhhh', 'Ggggg', 'iontexproject@gmail.com', '$2y$10$ymnWAI7pcmPPIZp.ZK22KexNBe9T9.hWTWqkujkILwU7dTbMFbgqS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 06:24:15', NULL, NULL, NULL, '0', NULL, '1', '2019-07-12 06:36:13', '2019-07-12 06:23:59', '2019-07-12 06:58:26', '2019-07-12 06:58:26'),
(9, '4', NULL, NULL, '4', 'Hhhh', 'Ggggg', 'iontexproject@gmail.com', '$2y$10$mF0OjT4MJywBX0VcDjUJAeyymRODXBcZnwubS.gOReMpnJ0pVKvKi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 07:00:35', NULL, 'lLOA12X0EGEnu3BwR672', NULL, '0', NULL, '1', '2019-07-12 07:08:32', '2019-07-12 06:59:51', '2019-07-12 13:21:14', NULL),
(10, '3', NULL, NULL, '4', 'Hhhh', 'Bbbbbbb', 'karll@mailinator.com', '$2y$10$9OPBR5Ip4dmbwf/D/cbDm.EaEgQ.AB9TNk2gN13zwjqno6G7ymNN2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 07:45:31', NULL, NULL, NULL, '0', NULL, '1', '2019-07-12 13:10:25', '2019-07-12 07:45:08', '2019-07-12 13:10:25', NULL),
(11, '3', NULL, NULL, '4', 'Karl', 'Lumi', 'karl@mailinator.com', '$2y$10$QyR8VEBzFIEHJEXtNmh7IeNEIkFSyEic3ysTYDGFuSa1GjgWZtIt2', NULL, NULL, NULL, 'cvchcghgjgfjg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 12:37:40', NULL, 'nI5CdII6EJ11ZA8C3af5', NULL, '0', NULL, '1', '2019-10-16 13:12:44', '2019-07-12 12:37:05', '2019-10-16 13:12:44', NULL),
(12, '4', NULL, NULL, '4', 'Mike', 'Andderson', 'mike@mailinator.com', '$2y$10$JYB/6c06peP1FlZZGw0sReBXv3cYezD996BrYYdCTN2ExslK7KhYG', NULL, NULL, NULL, '4546867897', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 13:01:08', NULL, NULL, NULL, '0', NULL, '1', '2019-07-25 12:34:49', '2019-07-12 13:00:37', '2019-07-25 12:34:49', NULL),
(13, '3', '10150068636498451', NULL, '1', 'RK Muthusamy', '', 'zdlbozwlcr_1543819434@tfbnw.net', NULL, 'https://graph.facebook.com/v3.0/10150068636498451/picture?type=normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2019-08-01 04:51:27', '2019-08-01 04:51:27', '2019-08-01 04:51:27', NULL),
(14, '3', NULL, NULL, '4', 'Ffffff', 'Gggggg', 'demo@gmail.com', '$2y$10$e.YRnrT6yKFBS/bRsGfBkeTBwCQDmfeOOOXO5n3cpGgoW0kvWjkau', NULL, NULL, NULL, '45656451', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xNLlyzjP16gR1H91528k', NULL, NULL, '0', NULL, '0', NULL, '2019-10-16 09:43:11', '2019-10-16 09:43:11', NULL),
(15, '3', NULL, NULL, '4', 'Aa', 'Bb', 'david@mailinator.com', '$2y$10$hTn4rrp05DuMF.iDw6itNuPI3B4u3ijgXm.XeGAkNEcqkHUqIel4W', NULL, NULL, NULL, '45656451', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-16 09:47:48', NULL, NULL, NULL, '0', NULL, '1', '2019-10-17 12:43:59', '2019-10-16 09:46:52', '2019-10-17 12:43:59', NULL),
(16, '4', NULL, NULL, '4', 'Aaaa', 'Bbbb', 'davidd@mailinator.com', '$2y$10$kMeO1TfFSFj/mU/GZwUtEOluh1CCZ8CaYDENWfGj3VYg4VACoXjcK', NULL, NULL, NULL, '45656451', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-17 11:09:21', NULL, NULL, NULL, '0', NULL, '1', '2019-10-17 11:09:21', '2019-10-17 11:09:01', '2019-10-17 11:09:21', NULL),
(17, '2', NULL, NULL, '4', 'Aaaa', 'Bbbbb', 'dem@mailinator.com', '$2y$10$2DA0lZBFDx07VaL8QbyIqe2V2/2WWSxn/tf.NXG/hhoQCdCxaO1ZO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2019-10-17 13:10:35', '2019-10-17 13:09:49', '2019-10-17 13:10:35', NULL),
(18, '3', NULL, NULL, '4', 'Test', 'Test', 'test@test.com', '$2y$10$obF72lNQLbARYfLeA1atEOrX5ox8iJHIjc1W2ot/v0GHQe3s5HRmu', NULL, NULL, NULL, '11111118', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'i5hU1bwqFkGh5f7TeqQj', NULL, NULL, '0', NULL, '0', NULL, '2019-10-21 20:27:50', '2019-10-21 20:27:50', NULL),
(19, '3', NULL, NULL, '4', 'Raihaan', 'Chaudary', 'raihaan1@hotmail.com', '$2y$10$pUvZwOlMd2af.xknWVX1..BavDjlLToy73zTnLILRfUEPkD48/Fwa', NULL, NULL, NULL, '07787120758', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50z9Lt206ZXKkY7bHa2K', NULL, NULL, '0', NULL, '0', NULL, '2019-10-21 20:43:25', '2019-10-24 22:52:52', '2019-10-24 22:52:52'),
(20, '2', NULL, NULL, '4', 'Test', 'Test', 'test@gmial.com', '$2y$10$Bu6pX6A4Do03EJT2B8FBSet7appvohMMLNzV2h7tqsqS9M0zOYhKe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-10-21 20:59:30', '2019-10-21 20:59:30', NULL),
(21, '3', NULL, NULL, '4', 'M', 'Bb', 'davi@mailinator.com', '$2y$10$BM/VK41basBF8S0ZTYjYBuxZMHtTBeczLH6cMeDdAU0qLQMWXUzGC', NULL, NULL, NULL, '45656451', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tj3y4L7n1xdx5xlfV4II', NULL, NULL, '0', NULL, '0', NULL, '2019-10-22 11:38:21', '2019-10-22 11:38:21', NULL),
(22, '3', NULL, NULL, '4', 'M', 'Bb', 'dav@mailinator.com', '$2y$10$H70K27dzuKP0JVuqk1.nZe8cwHGV4WrBhk.0LLBWLZTcryc3.t0l6', NULL, NULL, NULL, '45656451', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'f27odf1H9MZ7RP7V2Mkr', NULL, NULL, '0', NULL, '0', NULL, '2019-10-22 11:38:40', '2019-10-22 11:38:40', NULL),
(23, '3', NULL, NULL, '4', 'M', 'Bb', 'dav3@mailinator.com', '$2y$10$MTr0WLlz6TtoT0tm0A235ehre1JMlf74/lITiA7GaUzaBnHKCPWRO', NULL, NULL, NULL, '45656451', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '772U4380z9uZV1Q5Vf1w', NULL, NULL, '0', NULL, '0', NULL, '2019-10-22 11:39:21', '2019-10-22 11:39:21', NULL),
(24, '4', NULL, NULL, '4', 'M', 'Bb', 'da123@mailinator.com', '$2y$10$0XJX58Yla6QMeTux2M1uruuF2PK1unYiNisNh1Fwf9P/cRDHvt2PO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2f2MfP7Gqvi4W4WHSKGR', NULL, NULL, '0', NULL, '0', NULL, '2019-10-22 11:40:39', '2019-10-22 11:40:39', NULL),
(25, '4', NULL, NULL, '4', 'Raihaan', 'Chaudary', 'raihaan1@hotmail.com', '$2y$10$9CYlAwF.1dnVCWOpt9q9iOQoYai5.ks/3xSG6t1Vtnt05MSqZcSTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 22:53:35', NULL, NULL, NULL, '0', NULL, '1', '2020-02-07 09:45:56', '2019-10-24 22:53:15', '2020-02-07 09:45:56', NULL),
(26, '3', NULL, NULL, '4', 'Raihaan', 'Chaudary', 'r.a.chaudary@gmail.com', '$2y$10$M9IwVpX1vpazvAIuSNWrNODY14DSOPl896UwLM8hoYsO2lUgG0YTm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-28 23:27:45', NULL, NULL, NULL, '0', NULL, '1', '2020-07-05 23:50:49', '2019-10-28 23:27:27', '2020-07-05 23:50:49', NULL),
(27, '4', NULL, NULL, '4', 'Lumi', 'Karl', 'iontexproject@mailinator.com', '$2y$10$XU0AdPGCBWiseT/sZX13MekIifnEhWrg2XVjY74/KGbgu7evtCP9.', NULL, NULL, NULL, '1122334455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3OZcyKnnhvlYe50CUQNe', NULL, NULL, '0', NULL, '0', NULL, '2019-11-14 10:17:36', '2019-11-14 10:17:36', NULL),
(28, '4', NULL, NULL, '4', 'Niro', 'D', 'nirodevops@gmail.com', '$2y$10$jCJAFY7NNruy5yv5rJrrA.viRbZp0YZenzMUJdKG8MPP03cDpuU4S', NULL, NULL, NULL, '11223344556', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-14 10:42:10', NULL, NULL, NULL, '0', NULL, '1', '2019-11-14 10:42:10', '2019-11-14 10:41:54', '2019-11-14 10:42:10', NULL),
(29, '3', NULL, NULL, '4', 'Test', 'Test', 'albert@yopmail.com', '$2y$10$.iqDjz/nu5rGEi/RruoKBukn/DORHQH2IRFm.lkK6r/OZMr8yAZJK', 'sbHpll7OPN6Ky591576923665.jpg', NULL, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-14 10:54:14', NULL, NULL, NULL, '0', NULL, '1', '2021-01-07 05:38:53', '2019-11-14 10:49:51', '2021-01-07 05:38:53', NULL),
(30, '3', NULL, NULL, '4', 'Peter', 'Parker', '45gh@mailinator.com', '$2y$10$ZH08sUf6kSurt8t5PVh2J.dbg/JpTIftCoPfLLPGwYRiRFCsUtlKK', 'Ct85FUGj222Ewc11574225988.jpg', NULL, NULL, '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 10:33:59', NULL, NULL, NULL, '0', NULL, '1', '2019-12-09 05:53:14', '2019-11-19 10:33:10', '2019-12-09 05:53:14', NULL),
(31, '4', NULL, NULL, '4', 'Andrew', 'Desuza', '42gh@mailinator.com', '$2y$10$lZMwSvLYxkhd0UV7sj/OyuQ5oLolO3OzzjB2JMf3P68QscVfsTGWK', '4zH5jaOYfrB0hVM1574164055.jpg', NULL, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 11:40:02', NULL, NULL, NULL, '0', NULL, '1', '2019-11-20 05:00:38', '2019-11-19 11:39:08', '2019-11-20 05:00:38', NULL),
(32, '2', NULL, NULL, '4', 'Peter', 'Parker', 'rrocet123@gmail.com', '$2y$10$cbKqOKTRwgK02KIuS6m9DOqlfy.RAJnoZW5sV8IEhL.AcIu0lgdh.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-11-19 13:01:35', '2019-11-19 13:03:01', '2019-11-19 13:03:01'),
(33, '2', NULL, NULL, '4', 'Peter', 'Parker', 'bala@mailinator.com', '$2y$10$KeRwa6/TY8NCyK0nJ.kkVOOTHoPigJvwXfsZ9hbW4vFHfhKn1cUom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-11-19 13:03:16', '2019-11-19 13:09:20', '2019-11-19 13:09:20'),
(34, '2', NULL, NULL, '4', 'Peter', 'Parker', 'chloe.hughes19092019@gmail.com', '$2y$10$FVqBDs849s9nr.LCPpAPlef1EQlgURdLn0ckh/YYDdowJZC1YzyS2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2019-11-19 13:03:47', '2019-11-19 13:09:12', '2019-11-19 13:09:12'),
(35, '2', NULL, NULL, '4', 'Testabc', 'Test', 'albert1@yopmail.com', '$2y$10$XM1h0xQksEZoNHwmG0uszuvwFm57R5Dx/k9GyZlT0aB/bUDxTmMGS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N5I5no1JaAP0x6rajX4O', NULL, '0', NULL, '1', NULL, '2019-11-21 04:49:58', '2020-03-16 12:03:18', NULL),
(36, '4', NULL, NULL, '4', 'Alberto', 'Niece', 'albert10@yopmail.com', '$2y$10$yJfD3L4fKQmqWLwfpTCJ7O8CcVvJvVoY2ajQAUpvwJ1QiBtFG.uKi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2021-01-07 05:39:57', '2019-12-21 10:53:09', '2021-01-07 05:39:57', NULL),
(37, '4', NULL, NULL, '4', 'Harry', 'Jones', 'harry@mailinator.com', '$2y$10$eu2oGUA6b/F9i2vziMYpb.qgQe.SriwHsfzzse9TUaXbGjRpP4lxW', NULL, NULL, NULL, '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gRfP6g293M7rGlJ34B6W', NULL, NULL, '0', NULL, '0', NULL, '2019-12-21 15:17:19', '2019-12-21 15:17:19', NULL),
(38, '4', NULL, NULL, '4', 'Test', 'Test', 'albert102@yopmail.com', '$2y$10$VDOHyHOvic5rgLUzVBy9UOcF5gQwjU28z4iV/l.nsVZPuBGe8u0Tu', NULL, NULL, NULL, '09874563210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'toJzuLyaqK056Z9Gg434', NULL, NULL, '0', NULL, '0', NULL, '2019-12-21 15:24:14', '2019-12-21 15:24:14', NULL),
(39, '4', NULL, NULL, '4', 'Harry', 'Jones', 'harry1@mailinator.com', '$2y$10$RUId/9pAFuPQmxea2AEwN.wc0THMRpBMfM6bbaEbUxtatEe3JIiWq', NULL, NULL, NULL, '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TR7En57W69e85Mnrq17f', NULL, NULL, '0', NULL, '0', NULL, '2019-12-23 13:49:22', '2019-12-23 13:49:22', NULL),
(40, '3', NULL, NULL, '4', 'Peter', 'Doe', 'rrocet123@gmail.com', '$2y$10$T0R/G8DO6NMPtJn.ZIHqDu1VAIputfh7qvXQvyWMy8x1WJcnPyVPK', NULL, NULL, NULL, '(123)456-789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-24 07:45:41', NULL, NULL, NULL, '0', NULL, '1', '2019-12-26 05:26:12', '2019-12-24 07:44:46', '2019-12-26 05:26:12', NULL),
(41, '4', NULL, NULL, '4', 'Leo', 'Duc', 'thadint2019@gmail.com', '$2y$10$Pmc/OoNDy7a04NvH4vMEseYljyOXBt9fLtxTVHZMOCHKD.e6TWPsm', NULL, NULL, NULL, '12345678910', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-24 07:56:19', NULL, NULL, NULL, '0', NULL, '1', '2019-12-24 08:04:09', '2019-12-24 07:56:08', '2020-01-28 06:45:59', '2020-01-28 06:45:59'),
(42, '3', NULL, NULL, '4', 'Chole', 'Hung', 'chloe.hughes19092019@gmail.com', '$2y$10$/tUaUaib2HS.WgTVJGj0UuCN9pj1ibsPhKQL55GnK6CR3wPQ347TC', 'YqKRCz5E55f1u2j1580362275.jpg', NULL, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-28 06:44:18', NULL, NULL, NULL, '0', NULL, '1', '2020-01-30 13:41:15', '2020-01-28 06:42:58', '2020-01-30 13:41:15', NULL),
(43, '4', NULL, NULL, '4', 'Thadient', 'Doe', 'thadint2019@gmail.com', '$2y$10$sRXjhtPqCjtVshbYGaEyTuWGC3VYIOAtaoBLw8j5oP1/wEIbrG5au', 'kv5X1d6HBf2xE0j1580196920.jpg', NULL, NULL, '1234567895025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-28 06:46:20', NULL, NULL, NULL, '0', NULL, '1', '2020-02-04 06:20:37', '2020-01-28 06:46:07', '2020-02-04 06:20:37', NULL),
(44, '4', '100594251132308953461', NULL, '2', 'Lucas Stirk', '', '14stirk.l@kingshouseschool.org', NULL, 'https://lh4.googleusercontent.com/-x-d3cMe4C7o/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rd6j4R0j_Blqu3YvRvpEq2p8w3H_Q/photo.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2020-02-10 11:56:04', '2020-02-10 11:56:04', '2020-02-10 11:56:04', NULL),
(45, '4', '112691893260773405475', NULL, '2', 'Jack Griffith', '', '14griffith.j@kingshouseschool.org', NULL, 'https://lh3.googleusercontent.com/-8Bsp3lIOoF4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfPlR9csJMiDL4_KOWsVTT4wIAxRQ/photo.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2020-02-10 12:00:20', '2020-02-10 12:00:20', '2020-02-10 12:00:20', NULL),
(46, '4', NULL, NULL, '4', 'Test', 'Maryam', 'maryamsaif879@gmail.com', '$2y$10$yDxxE5ZyXEaKur/5VBtcNuyGFrKCHkATWMYpOcolC6l5eokGfqv8q', NULL, NULL, NULL, '07733258089', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rJR782Asf8bJ6y1O23zZ', NULL, NULL, '0', NULL, '0', NULL, '2020-03-05 13:56:22', '2020-03-05 13:56:22', NULL),
(47, '4', NULL, NULL, '4', 'Test', 'Test', 'albert6@yopmail.com', '$2y$10$BRoZd/zbwUee.lqlKGu3mu42Ue4isN7JP3V5tfuZ26s.v.KP6ylwy', NULL, NULL, NULL, '09874563210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6T04X1t184322qpI5dng', NULL, NULL, '0', NULL, '0', NULL, '2020-03-20 05:12:11', '2020-03-20 05:12:11', NULL),
(48, '3', NULL, NULL, '4', 'Test', 'Business', 'albert+1@yopmail.com', '$2y$10$AM7xXR7qO7QilnSneEJYgej04UCYrt7qMcjZGavvNXYAEplKrOZ0C', NULL, NULL, NULL, '1234567897', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0w4iAN5h7GPiZ8lNNtNf', NULL, NULL, '0', NULL, '0', NULL, '2020-04-25 09:57:28', '2020-04-25 09:57:28', NULL),
(49, '3', NULL, NULL, '4', 'Test', 'Businesss', 'albert101@yopmail.com', '$2y$10$zxSJL01vum4Yc/Pr69EPWefcwCKgrK4e5pwLmcodbgeL11267dwwi', NULL, NULL, NULL, '1234567897', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-25 10:00:18', NULL, NULL, NULL, '0', NULL, '1', '2020-04-25 10:00:18', '2020-04-25 09:59:11', '2020-04-25 10:00:18', NULL),
(50, '3', NULL, NULL, '4', 'Test', 'Asdad', 'albert1020@yopmail.com', '$2y$10$WBndq6ufHw5wg3f6K2GFr.HSTYapcDJIFjrQMNRgmLj6UffWy9vT6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5sg37Va8ChWMkO9D2shb', NULL, NULL, '0', NULL, '0', NULL, '2020-04-25 10:02:55', '2020-04-25 10:02:55', NULL),
(51, '3', NULL, NULL, '4', 'FName Test', 'LName Test', 'hdbt@yopmail.com', '$2y$10$CqL6Cs/.JzwuUFKJcXtL0u2llnk/vJrqmtdpvN0WkShvn8wibbxNS', NULL, NULL, '1970-01-01', '12345678910', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-02 18:32:40', NULL, NULL, NULL, '0', NULL, '1', '2020-12-23 12:38:29', '2020-05-02 18:31:56', '2020-12-23 12:38:29', NULL),
(52, '4', NULL, NULL, '4', 'FName Test', 'LName Test', 'hdcust@yopmail.com', '$2y$10$k.7vv//C/EaYZX66qwxgb.riLHpZ3gbnxe84RFXESpQS7TygsM9cO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-16 19:48:46', NULL, NULL, NULL, '0', NULL, '1', '2020-08-22 15:39:17', '2020-05-16 19:48:10', '2020-08-22 15:39:17', NULL),
(53, '2', NULL, NULL, '4', 'Halal', 'Staff', 'halalstaff@mailinator.com', '$2y$10$m0G2qRyNU./1zouNxWla/OpPptmoua8gAihn53YZwwMy5UUI8ycbS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '2020-08-19 11:17:04', '2020-08-19 11:17:04', NULL),
(54, '2', NULL, NULL, '4', 'HalalDeal', 'Staff', 'halaldealstaff@mailinator.com', '$2y$10$PeXRlanE2ddZXtHTyj3TpugtK/JsHMtHd4DlHkv.wRTsbgAlIAWZ6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', '2020-08-19 11:46:38', '2020-08-19 11:25:36', '2020-08-19 11:46:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'Business Admin'),
(3, 'Business Manager'),
(4, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_details`
--

CREATE TABLE `voucher_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(10) DEFAULT NULL,
  `advert_ID` varchar(20) DEFAULT NULL,
  `voucher_ID` varchar(30) NOT NULL,
  `bus_ID` varchar(10) DEFAULT NULL,
  `status` enum('0','1','3') NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `redeem` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=>Yes, 2=>No',
  `purchasing_user` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voucher_details`
--

INSERT INTO `voucher_details` (`id`, `order_id`, `advert_ID`, `voucher_ID`, `bus_ID`, `status`, `redeem`, `purchasing_user`, `created_at`, `updated_at`) VALUES
(1, 1, 'A66F', '546476uNfJeB', '20MsZ2rI', '1', '2', 36, '2020-04-13 14:00:48', '2020-04-13 14:00:48'),
(2, 1, 'A66F', '4P4qUXyX5C56', '20MsZ2rI', '1', '2', 36, '2020-04-13 14:00:48', '2020-04-13 14:00:48'),
(3, 2, '94ED', 'zY33xe3N4sNx', '348bshkp', '1', '2', 52, '2020-07-05 23:56:40', '2020-07-05 23:56:40'),
(4, 3, 'EB44', '10wUyRG2hENI', '20MsZ2rI', '1', '2', 52, '2020-08-18 15:36:54', '2020-08-18 15:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` bigint(20) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `amount` double(15,2) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `account_holder_name` varchar(50) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(10) DEFAULT NULL,
  `micr_code` varchar(10) DEFAULT NULL,
  `branch_name` varchar(30) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL COMMENT '0=>Requested, 1=>Paid, 3=>Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `amount`, `bank_name`, `account_holder_name`, `account_number`, `ifsc_code`, `micr_code`, `branch_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 42, 50.00, 'Tpp bank', 'John Doe', '1234568977555', '125874565', '455421', 'tpp  branch', '1', '2020-01-28 12:55:28', '2020-01-28 12:56:13'),
(2, 42, 20.00, 'gfdsgdfg', 'gfdgdfgdfg', '544545645645454', '5465465654', '545454544', 'rlkjgfdkgjdkfjg', '0', '2020-01-30 11:46:37', '2020-01-30 11:46:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`advert_ID`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`bus_ID`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_ID`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_types`
--
ALTER TABLE `product_sub_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_details`
--
ALTER TABLE `voucher_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_sub_types`
--
ALTER TABLE `product_sub_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voucher_details`
--
ALTER TABLE `voucher_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
