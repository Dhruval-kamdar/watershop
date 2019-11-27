-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2019 at 09:05 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watershop_app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `AdminId` int(11) NOT NULL,
  `AdminName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminPassword` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminRole` varchar(500) DEFAULT NULL,
  `RoleId` int(11) DEFAULT '1',
  `AdminPrivilege` varchar(10000) NOT NULL,
  `CookieId` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`AdminId`, `AdminName`, `AdminEmail`, `AdminPassword`, `AdminRole`, `RoleId`, `AdminPrivilege`, `CookieId`, `isActive`, `isDeleted`, `created`, `modified`) VALUES
(1, 'Admin', 'info@watershop.com', 'ZGVtb0AxMjM', 'super_admin', 1, '', 280, 1, 0, '2018-12-28 00:00:00', '0000-00-00 00:00:00'),
(2, 'Inventory.manager', 'Inventory.manager@gmail.com', 'dGVzdA', 'inventory_management', 4, '', 0, 1, 0, '2018-12-28 00:34:38', '2018-12-31 18:52:25'),
(3, 'Account.manager', 'account.manager@gmail.com', 'V0FoQDEyMw', 'account_management', 3, '', 0, 1, 0, '2018-12-28 14:17:29', '2018-12-31 19:09:22'),
(4, 'abdulhadi', 'abdulhadi.16q@outlook.com', 'dGVzdA', 'order_management', 2, '', 0, 1, 0, '2018-12-31 18:42:52', '0000-00-00 00:00:00'),
(5, 'nasser', 'na.15@gmail.com', 'dGVzdA', 'account_management', 3, '', 0, 1, 0, '2018-12-31 18:45:32', '0000-00-00 00:00:00'),
(6, 'yahya', 'yalosaimi@gmail.com', 'dGVzdA', 'inventory_management', 4, '', 0, 1, 0, '2018-12-31 18:46:10', '0000-00-00 00:00:00'),
(7, 'essa', 'essa@jamamail.com', 'dGVzdA', 'account_management', 3, '', 0, 1, 0, '2018-12-31 18:55:02', '0000-00-00 00:00:00'),
(8, 'wahaj', 'wahajsul@gmail.com', 'V0FoQDEwOTA', 'super_admin', 1, '', 36172582, 1, 0, '2018-12-31 19:15:30', '2018-12-31 22:48:39'),
(9, 'amalmo', 'amal@dmail.com', 'MTIzNDU2Nzg', 'account_management', 3, '', 0, 1, 0, '2019-01-13 11:08:48', '0000-00-00 00:00:00'),
(10, 'samah', 'samah@gmail.com', 'MTIzNDU2Nzg', 'order_management', 2, '', 0, 1, 0, '2019-01-13 11:25:21', '0000-00-00 00:00:00'),
(11, 'latifa', 'bintomar22@gmail.com', 'MTIzNDU2Nzg', 'super_admin', 1, '', 0, 1, 0, '2019-01-20 13:25:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_roles`
--

CREATE TABLE `tbl_admin_roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(256) CHARACTER SET utf8 NOT NULL,
  `roleNameAr` varchar(256) CHARACTER SET utf8 NOT NULL,
  `roleKey` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_roles`
--

INSERT INTO `tbl_admin_roles` (`roleId`, `roleName`, `roleNameAr`, `roleKey`, `isActive`, `isDeleted`, `created`, `modified`) VALUES
(1, 'Super Admin', 'Super Admin', 'super_admin', 1, 0, '2018-12-28 02:24:31', '0000-00-00 00:00:00'),
(2, 'Order Management', 'Order Management', 'order_management', 1, 0, '2018-12-28 14:43:32', '0000-00-00 00:00:00'),
(3, 'Account Management', 'Account Management', 'account_management', 1, 0, '2018-12-28 14:43:11', '0000-00-00 00:00:00'),
(4, 'Inventory Management', 'Inventory Management', 'inventory_management', 1, 0, '2018-12-28 14:43:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `cityId` int(11) NOT NULL,
  `cityCode` varchar(20) NOT NULL,
  `cityName` varchar(200) CHARACTER SET utf8 NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(200) NOT NULL,
  `modifiedTimestamp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`cityId`, `cityCode`, `cityName`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, '111', 'Ø§Ù„Ø¯Ù…Ø§Ù…', 1, 0, '1536320345', ''),
(2, '222', 'Ø§Ù„Ø±ÙŠØ§Ø¶', 1, 1, '1548059638', ''),
(3, '333', 'Ø§Ù„Ø®Ø±Ø¬', 1, 0, '1536320421', ''),
(4, '0', 'Ø§Ù„Ù‚Ù†ÙØ°Ø©', 1, 0, '1547365642', ''),
(5, '55', 'Ø¬Ø¯Ø©', 1, 0, '1548059667', ''),
(6, '01', 'Ø§Ù„Ø®Ø¨Ø±', 1, 0, '1548059689', ''),
(7, '10', 'Ø§Ù„Ø£Ø­Ø³Ø§Ø¡', 1, 0, '1548059716', ''),
(8, '9', 'Ø§Ù„Ù‚Ø·ÙŠÙ', 1, 0, '1548059740', ''),
(9, '1', 'Ø§Ù„Ø¬Ø¨ÙŠÙ„', 1, 0, '1548059760', ''),
(10, '2', 'Ù…ÙƒØ©', 1, 0, '1548059783', ''),
(11, '3', 'Ø¬ÙŠØ²Ø§Ù†', 1, 0, '1548059804', ''),
(12, '6', 'Ø§Ù„Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ù…Ù†ÙˆØ±Ø©', 1, 0, '1548059834', ''),
(13, '5', 'Ø§Ù„Ø·Ø§ÙŠÙ', 1, 0, '1548059855', ''),
(14, '7', 'Ø­ÙØ± Ø§Ù„Ø¨Ø§Ø·Ù†', 1, 0, '1548059893', ''),
(15, '7', 'Ø³ÙƒØ§ÙƒØ§', 1, 0, '1548059983', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE `tbl_companies` (
  `companyId` int(11) NOT NULL,
  `companyName` varchar(200) CHARACTER SET utf8 NOT NULL,
  `companyAddress` varchar(255) NOT NULL,
  `companyEmail` varchar(200) NOT NULL,
  `companyPhone` varchar(20) NOT NULL,
  `companyWebsite` varchar(255) NOT NULL,
  `contactPerson` varchar(255) NOT NULL,
  `extraNotes` varchar(5000) NOT NULL,
  `cityId` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_companies`
--

INSERT INTO `tbl_companies` (`companyId`, `companyName`, `companyAddress`, `companyEmail`, `companyPhone`, `companyWebsite`, `contactPerson`, `extraNotes`, `cityId`, `isActive`, `isDeleted`, `created`, `modified`) VALUES
(1, 'CMP1', '', '', '', '', '', '', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'CMP2', '', '', '', '', '', '', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'CMP3', '', '', '', '', 'test', '', 0, 1, 1, '0000-00-00 00:00:00', '2018-08-30 09:12:54'),
(4, 'sky', 'alkharj', 'sky@gmqai.com', '0551032525', '', 'amal@dnail.com', '', 3, 1, 1, '2019-01-13 10:33:30', '0000-00-00 00:00:00'),
(5, 'SKY', 'Ø§Ù„Ø®Ø±Ø¬', 'amal@daniatqataf.com', '958592000', '', 'Amal', '', 3, 1, 0, '2019-01-29 10:37:03', '0000-00-00 00:00:00'),
(6, 'QTAF', 'Ø§Ù„Ø®Ø±Ø¬', 'amal@daniatqataf.com', '0115510399', '', 'Amal', '', 3, 1, 0, '2019-01-29 10:43:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_companies`
--

CREATE TABLE `tbl_contact_companies` (
  `id` bigint(20) NOT NULL,
  `type` enum('contactUs','contactCompany') NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_companies`
--

INSERT INTO `tbl_contact_companies` (`id`, `type`, `name`, `phone`, `email`, `message`, `photo`, `video`, `isActive`, `isDeleted`, `created`, `modified`) VALUES
(1, 'contactCompany', 'ghj', '0530816725', 'wahajsul@gmail.com', 'Gggg', '', '', 1, 0, '2019-01-18 19:56:14', NULL),
(2, 'contactUs', 'wahaj', '0530816725', 'wahajsul@gmail.com', 'Xoxo', '', '', 1, 0, '2019-01-18 19:58:10', NULL),
(3, 'contactUs', 'wahaj', '0530816725', 'wahajsul@gmail.com', 'Xoxo', '', '', 1, 0, '2019-01-19 15:32:46', NULL),
(4, 'contactUs', 'tester', '0595959599', 'mr.h@windowslive.com', 'hello this is a test', '', '', 1, 0, '2019-01-20 05:28:48', NULL),
(5, 'contactUs', 'amal', '0551032525', 'amlaj@gmail.com', 'aaaamsha', '1547979321_photo.png', '', 1, 0, '2019-01-20 13:15:21', NULL),
(6, 'contactUs', 'wahaj', '0530816725', 'wahajsul@gmail.com', 'Xoxo', '', '', 1, 0, '2019-01-20 21:44:30', NULL),
(7, 'contactUs', 'amal', '0551032525', 'amalmq19@gmaikz.com', 'hhh', '', '', 1, 0, '2019-01-23 13:32:37', NULL),
(8, 'contactCompany', 'Ø¹Ù…Ø±', '0563355699', 'bintomar20@gmail.com', 'tttt', '', '', 1, 0, '2019-03-13 14:24:39', NULL),
(9, 'contactUs', 'u', '0563355699', 'bintomar20@gmail.com', 'yyyyy', '1552476496_photo.jpg', '', 1, 0, '2019-03-13 14:28:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL,
  `field_title` varchar(500) CHARACTER SET utf8 NOT NULL,
  `field_key` varchar(100) CHARACTER SET utf8 NOT NULL,
  `field_value` longtext CHARACTER SET utf8 NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `field_title`, `field_key`, `field_value`, `is_active`, `is_deleted`, `created`, `modified`) VALUES
(1, 'Ø§Ù„Ø´Ø±ÙˆØ· ÙˆØ§Ù„Ø£Ø­ÙƒØ§Ù…', 'terms', '<p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(0, 0, 0); -webkit-text-stroke-width: initial; -webkit-text-stroke-color: rgb(0, 0, 0); min-height: 14px;\\\"><span style=\\\"font-kerning: none\\\"></span><br></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ø¨Ø§Ø³ØªØ®Ø¯Ø§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠÙˆØ§ÙÙ‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø³ØªØ®Ø¯Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø§Ù„ØªØ²Ø§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø§Ù„Ø´Ø±ÙˆØ·</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆØ§Ù„Ø£Ø­ÙƒØ§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ÙˆØ§Ø±Ø¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØµÙØ­Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¬Ø²Ø¡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø®Ø±ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù…Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø´Ø±ÙˆØ·</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆØ§Ù„Ø£Ø­ÙƒØ§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ®Ø¶Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù„ØªØºÙŠÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªØ¹Ø¯ÙŠÙ„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆÙ‚Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø¯ÙˆÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø³Ø§Ø¨Ù‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¥Ù†Ø°Ø§Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\">. </span><span style=\\\"font-kerning: none\\\">ÙˆÙŠØ®Ø¶Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\">Â Â </span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ø§Ø³ØªØ®Ø¯Ø§Ù…</span><span style=\\\"-webkit-text-stroke-width: initial; font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ù‡Ø°Ø§</span><span style=\\\"-webkit-text-stroke-width: initial; font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ø§Ù„ØªØ·Ø¨ÙŠÙ‚</span><span style=\\\"-webkit-text-stroke-width: initial; font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ù„Ø£Ù†Ø¸Ù…Ø©</span><span style=\\\"-webkit-text-stroke-width: initial; font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ø§Ù„Ù…Ù…Ù„ÙƒØ©</span><span style=\\\"-webkit-text-stroke-width: initial; font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©</span><span style=\\\"-webkit-text-stroke-width: initial; font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"-webkit-text-stroke-width: initial; -webkit-font-kerning: none;\\\">Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù¡</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ø­Ù‚ÙˆÙ‚</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ù„Ù…Ù„ÙƒÙŠØ©</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ù„ÙÙƒØ±ÙŠØ©</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ù†Ø­Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ØµØ­Ø§Ø¨</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¬Ù…ÙŠØ¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø­Ù‚ÙˆÙ‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ù„ÙƒÙŠØ§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ÙÙƒØ±ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ÙˆØ§Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ù†Ø´ÙˆØ±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„ÙŠÙ‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø£Ø¹Ù…Ø§Ù„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­Ù…ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø­Ù‚ÙˆÙ‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø¹Ø§Ù‡Ø¯Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªØ£Ù„ÙŠÙ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù†Ø´Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø­ÙˆÙ„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø¹Ø§Ù„Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ø¬Ù…ÙŠØ¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø­Ù‚ÙˆÙ‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­ÙÙˆØ¸Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ù„Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠØ¬ÙˆØ²</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø³Ø®ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø¹Ø§Ø¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†ØªØ§Ø¬ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø¹Ø§Ø¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø´Ø±ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ­Ù…ÙŠÙ„ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø´Ø±ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø«ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø±Ø³Ø§Ù„ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¬Ø¹Ù„Ù‡Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ØªØ§Ø­Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù„Ø¬Ù…ÙŠØ¹ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø³ØªØ®Ø¯Ø§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­ØªÙˆÙ‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø·Ø±ÙŠÙ‚Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ø¯Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø³ØªØ®Ø¯Ø§Ù…Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø´Ø®ØµÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØºÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ¬Ø§Ø±ÙŠ</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù¢</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ù„Ø§Ø¹ØªÙ…Ø§Ø¯</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø¹Ù„Ù‰</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ù„Ù…Ø¹Ù„ÙˆÙ…Ø§Øª</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ù„Ù…Ù†Ø´ÙˆØ±Ø©</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ù„Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠØ¬Ø¨</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø¹ØªØ¨Ø§Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ¹Ù„ÙŠÙ‚Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†Ø´ÙˆØ±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£Ù†Ù‡Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†ØµÙŠØ­Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠÙ…ÙƒÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø§Ø¹ØªÙ…Ø§Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„ÙŠÙ‡Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ù„Ø°Ù„Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙ†Ø­Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ù†ÙƒØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø³Ø¤ÙˆÙ„ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ£ØªÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø§Ø¹ØªÙ…Ø§Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªØ¹Ù„ÙŠÙ‚Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ù†Ø´ÙˆØ±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‚Ø¨Ù„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø²Ø§Ø¦Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‚Ø¨Ù„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø´Ø®Øµ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠØ¹Ù„Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ù…Ø­ØªÙˆØ§Ù‡Ø§</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù£</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ùˆ</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø®Ø¯Ù…ØªÙ†Ø§</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>ØªØªØºÙŠØ±</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø¨Ø§Ø³ØªÙ…Ø±Ø§Ø±</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ù†Ø­Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ù‡Ø¯Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ­Ø¯ÙŠØ«</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø§Ø³ØªÙ…Ø±Ø§Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠÙ…ÙƒÙ†Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØºÙŠÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­ØªÙˆØ§Ù‡Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆÙ‚Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø­Ø§Ø¬Ø©ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠÙ…ÙƒÙ†Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§ÙŠÙ‚Ø§Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø¯Ø®ÙˆÙ„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§ØºÙ„Ø§Ù‚Ù‡Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù…Ø¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØºÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­Ø¯Ø¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ù…Ù…ÙƒÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠØ§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø­ØªÙˆÙŠØ§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ÙˆØ¬ÙˆØ¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆÙ‚Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙƒÙˆÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‚Ø¯ÙŠÙ…Ø©ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø­Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„ÙŠØ³</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„ÙŠÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªØ²Ø§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„ØªØ­Ø¯ÙŠØ«</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø­ØªÙˆÙŠØ§Øª</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù¤</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ù…Ø³Ø¤ÙˆÙ„ÙŠØªÙ†Ø§</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ø§Ù†Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§ØªØ®Ø°Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¬Ù…ÙŠØ¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø§Ø­ØªÙŠØ§Ø·Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªØ¬Ù‡ÙŠØ²</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø°Ù„ÙƒØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†ÙƒÙˆÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø³Ø¤ÙˆÙ„ÙŠÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ø®Ø·Ø§Ø¡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§ØºÙØ§Ù„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ØªØ¹Ù„Ù‚Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø§Ù„Ù…Ø­ØªÙˆÙ‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø´Ø§ÙƒÙ„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙ‚Ù†ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù…ÙƒÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙˆØ§Ø¬Ù‡Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø³ØªØ®Ø¯Ø§Ù…Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ø§Ø°Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙ…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø¹Ù„Ø§Ù…Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ø®Ø·Ø§Ø¡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø³ÙˆÙ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø­Ø§ÙˆÙ„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØµØ­ÙŠØ­Ù‡Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£Ù‚Ø±Ø¨</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆÙ‚Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠÙ…ÙƒÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø­Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø°ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠØ³Ù…Ø­</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù‚Ø§Ù†ÙˆÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\">.</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù¥</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ø¨ÙŠØ§Ù†Ø§Øª</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø¹Ù†Ùƒ</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ùˆ</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø¹Ù†</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø²ÙŠØ§Ø±Ø§ØªÙƒ</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ù„ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ùˆ</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ø³ØªØ®Ø¯Ø§Ù…</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø®Ø¯Ù…ØªÙ†Ø§</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ù†Ø­Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø¬Ù…Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨ÙŠØ§Ù†Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø¹ÙŠÙ†Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙƒÙ†ØªÙŠØ¬Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù…Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">Â </span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù¦</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ø±ÙØ¹</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ù…Ø­ØªÙˆÙ‰</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ù„Ù‰</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ùˆ</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ø®Ø¯Ù…ØªÙ†Ø§</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­ØªÙˆÙ‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙ‚ÙˆÙ…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø±ÙØ¹Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø¹Ù„ÙˆÙ…Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø¬Ù…Ø¹Ù‡Ø§ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø³ÙŠØ¹ØªØ¨Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØºÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø³Ø±ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØºÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù…ØªÙ„Ø§ÙƒÙŠØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ¯Ø±Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙˆØ§ÙÙ‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø¯ÙŠÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø­Ù‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù…ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø³Ø®ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ÙƒØ´Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø­ØªÙˆØ§ÙŠØ§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø¹Ù„ÙˆÙ…Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ø·Ø±Ø§Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø«Ø§Ù„Ø«Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØºØ±Ø¶</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ØªØ¹Ù„Ù‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø¹Ù…Ù„Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ø§Ø°Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙƒØ§Ù†Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø­ØªÙˆÙŠØ§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­Ù…ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø­Ù‚ÙˆÙ‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ù„ÙƒÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ÙÙƒØ±ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙØ¥Ù†Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ¹Ø·ÙŠÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø±Ø®ØµØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¯Ø§Ø¦Ù…Ø©ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¯ÙˆÙ„ÙŠØ©ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø¯ÙˆÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹ÙˆØ§Ø¦Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù…ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ¹Ø¯ÙŠÙ„ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªÙˆØ²ÙŠØ¹ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨ÙŠØ¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙƒØ´Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…Ø­ØªÙˆØ§ÙŠØ§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ø·Ø±Ø§Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø«Ø§Ù„Ø«Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØºØ±Ø¶</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ØªØ¹Ù„Ù‚</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø¹Ù…Ù„Ù†Ø§</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù§</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ø±ÙˆØ§Ø¨Ø·</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>Ù…Ù†</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b> </b></span><span style=\\\"font-kerning: none\\\"><b>ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ø¹Ù†Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø­ØªÙˆØ§Ø¡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØ·Ø¨ÙŠÙ‚Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø±ÙˆØ§Ø¨Ø·</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ÙˆØ§Ù‚Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ØµØ§Ø¯Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ø®Ø±Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ÙˆÙØ±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‚Ø¨Ù„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ø·Ø±Ø§Ù</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø«Ø§Ù„Ø«Ø©ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙ‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø±ÙˆØ§Ø¨Ø·</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…ÙˆÙØ±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù…Ø¹Ù„ÙˆÙ…Ø§ØªÙƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù†Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙ‚Ø·</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ù†Ø­Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„ÙŠØ³</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø¯ÙŠÙ†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø³ÙŠØ·Ø±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø­ØªÙˆØ§ÙŠØ§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ÙˆØ§Ù‚Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ØµØ§Ø¯Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ù‚Ø¨Ù„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø³Ø¤ÙˆÙ„ÙŠØ©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†Ù‡Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø³Ø§Ø±Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ùˆ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¶Ø±Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‚Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙŠÙ†Ø´Ø£</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø³ØªØ®Ø¯Ø§Ù…Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù‡Ù…</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù¨</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>ØªØºÙŠØ±Ø§Øª</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">ÙŠÙ…ÙƒÙ†Ù†Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø±Ø§Ø¬Ø¹Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø£Ø­ÙƒØ§Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙˆÙ‚Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨ØªØºÙŠÙŠØ±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØµÙØ­Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\">. </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ØªÙˆÙ‚Ø¹</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†Ùƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø£Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØªÙÙ‚Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù‡Ø°Ù‡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØµÙØ­Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø­ÙŠÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù„Ø¢Ø®Ø±</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ù†ÙƒÙˆÙ†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù…</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¨Ø£ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ØªØºÙŠØ±Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù†Ø¬Ø±ÙŠÙ‡Ø§</span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\"><b>Ù©</b></span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"><b>) </b></span><span style=\\\"font-kerning: none\\\"><b>Ø§Ø³ØªÙØ³Ø§Ø±Ø§ØªÙƒ</b></span></p><p style=\\\"margin-bottom: 0px; text-align: right; font-stretch: normal; font-size: 12px; line-height: normal; font-family: \\\" geeza=\\\"\\\" pro\\\";=\\\"\\\" color:=\\\"\\\" rgb(0,=\\\"\\\" 0,=\\\"\\\" 0);=\\\"\\\" -webkit-text-stroke-width:=\\\"\\\" initial;=\\\"\\\" -webkit-text-stroke-color:=\\\"\\\" 0);\\\"=\\\"\\\"><span style=\\\"font-kerning: none\\\">Ø§Ø°Ø§</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">ÙƒØ§Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ù„Ø¯ÙŠÙƒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§ÙŠ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ø³ØªÙØ³Ø§Ø±Ø§Øª</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù†</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ÙˆØ§Ø¯</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ù…ÙˆØ¬ÙˆØ¯Ø©</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø¹Ù„Ù‰</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø®Ø¯Ù…ØªÙ†Ø§ØŒ</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„Ø±Ø¬Ø§Ø¡</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: \\\" helvetica=\\\"\\\" neue\\\";=\\\"\\\" -webkit-font-kerning:=\\\"\\\" none;\\\"=\\\"\\\"> </span><span style=\\\"font-kerning: none\\\">Ø§Ù„ØªÙˆØ§ØµÙ„</span><span style=\\\"font-stretch: normal; line-height: normal; font-family: Helvetica; -webkit-font-kerning: none;\\\"> </span><span style=\\\"font-kerning: none\\\">Ù…Ø¹Ù†Ø§</span></p>', 1, 0, '2018-08-03 00:00:00', '2019-04-24 21:01:13');
INSERT INTO `tbl_content` (`id`, `field_title`, `field_key`, `field_value`, `is_active`, `is_deleted`, `created`, `modified`) VALUES
(2, 'About Us', 'about', '<p>\r\n(21083228000102 - SA6610000021083228000102)\r\n<br>\r\n الحسابات البنكي البنك الهلي\r\n</p>', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupons`
--

CREATE TABLE `tbl_coupons` (
  `couponId` bigint(20) NOT NULL,
  `couponCode` varchar(200) NOT NULL,
  `couponDescr` varchar(200) NOT NULL,
  `startTime` datetime NOT NULL,
  `expiryTime` datetime NOT NULL,
  `discountType` enum('flat','percent') NOT NULL,
  `discountValue` int(11) NOT NULL,
  `minOrderAmt` int(11) NOT NULL,
  `isMultiUse` tinyint(4) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coupons`
--

INSERT INTO `tbl_coupons` (`couponId`, `couponCode`, `couponDescr`, `startTime`, `expiryTime`, `discountType`, `discountValue`, `minOrderAmt`, `isMultiUse`, `isActive`, `isDeleted`, `created`, `modified`) VALUES
(2, 'TEST', 'test', '2018-08-28 05:00:00', '2018-09-05 03:00:00', 'percent', 5, 1, 1, 0, 0, '2018-08-28 13:44:53', '2018-11-22 11:14:32'),
(3, 'ejsjsnkjsjk', 'Ø®ØµÙ… Ù¡Ù Ùª Ù„Ø£ÙˆÙ„ Ù¥ Ù…Ø³ØªÙÙŠØ¯ÙŠÙ†', '2018-11-21 19:45:00', '2018-11-22 19:45:00', 'flat', 5, 10, 0, 0, 0, '2018-11-21 19:38:42', '2018-11-22 11:14:26'),
(4, 'BLKFRDI', 'Ø®ØµÙ… Ø®Ø§Øµ', '2018-11-22 14:15:00', '2018-11-23 14:15:00', 'percent', 10, 100, 1, 1, 0, '2018-11-22 14:09:53', '2019-01-23 08:41:54'),
(5, 'Wahaj', '', '2018-12-13 02:30:00', '2018-12-15 02:30:00', 'flat', 5, 10, 1, 1, 0, '2018-12-13 14:32:28', '2018-12-13 21:34:42'),
(6, 'Wah123', '', '2018-12-13 14:45:00', '2018-12-15 14:45:00', 'percent', 5, 1, 1, 1, 0, '2018-12-13 14:44:33', '0000-00-00 00:00:00'),
(7, 'abc1234', '', '2018-12-15 03:45:00', '2019-01-17 04:15:00', 'percent', 5, 10, 1, 1, 0, '2018-12-15 15:43:24', '2019-01-13 17:17:06'),
(8, 'Ab445', '', '2019-01-14 10:45:00', '2019-01-15 10:45:00', 'percent', 5, 15, 1, 1, 0, '2019-01-13 10:40:16', '0000-00-00 00:00:00'),
(9, 'DEV1', '', '2019-01-14 02:00:00', '2019-01-23 02:00:00', 'percent', 10, 15, 1, 1, 0, '2019-01-13 11:31:15', '2019-01-21 13:55:19'),
(10, 'Abb223', 'Discount', '2019-01-13 09:36:00', '2019-01-14 09:45:00', 'percent', 15, 1, 1, 1, 0, '2019-01-13 21:36:43', '2019-01-14 04:39:11'),
(11, 'WA109', '', '2019-01-17 07:43:00', '2019-01-18 07:45:00', 'percent', 15, 1, 1, 1, 0, '2019-01-17 07:43:36', '0000-00-00 00:00:00'),
(12, 'Wa1000', '', '2019-01-20 10:35:00', '2019-01-22 00:45:00', 'percent', 5, 1, 1, 1, 0, '2019-01-20 22:36:36', '2019-01-22 05:29:10'),
(13, 'amal', 'ÙŠÙˆÙ… ÙˆØ·Ù†ÙŠ', '2019-01-23 11:45:00', '2019-01-26 11:45:00', 'percent', 10, 5, 1, 1, 0, '2019-01-23 11:46:38', '0000-00-00 00:00:00'),
(14, 'Q123', 'ÙƒÙˆØ¨ÙˆÙ† Ø®ÙŠØ±ÙŠ', '2019-02-10 13:00:00', '2019-02-11 13:30:00', 'percent', 10, 10, 1, 1, 0, '2019-02-10 13:17:36', '0000-00-00 00:00:00'),
(15, 'WA124', '', '2019-02-13 14:00:00', '2019-02-13 16:00:00', 'percent', 5, 30, 1, 1, 0, '2019-02-13 14:58:24', '0000-00-00 00:00:00'),
(16, 'qwe1', '', '2019-03-13 01:40:00', '2019-03-13 01:45:00', 'percent', 5, 10, 1, 1, 0, '2019-03-13 13:43:53', '2019-03-13 20:56:52'),
(17, 'amal2', '', '2019-03-13 13:50:00', '2019-03-14 14:00:00', 'percent', 5, 10, 1, 1, 0, '2019-03-13 13:58:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupons_history`
--

CREATE TABLE `tbl_coupons_history` (
  `id` bigint(20) NOT NULL,
  `couponId` bigint(20) NOT NULL,
  `couponCode` varchar(200) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `custId` bigint(20) NOT NULL,
  `orderId` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coupons_history`
--

INSERT INTO `tbl_coupons_history` (`id`, `couponId`, `couponCode`, `discount`, `custId`, `orderId`, `created`, `modified`) VALUES
(1, 12, 'wa1000', '10.60', 33370087, '14', '2019-01-20 22:43:58', '0000-00-00 00:00:00'),
(2, 12, 'Wa1000', '3.30', 22240082, '15', '2019-01-21 00:17:50', '0000-00-00 00:00:00'),
(3, 13, 'amal', '20.00', 33310072, '24', '2019-01-23 11:47:08', '0000-00-00 00:00:00'),
(4, 13, 'amal', '14.00', 33310072, '26', '2019-01-23 13:31:55', '0000-00-00 00:00:00'),
(5, 14, 'Q123', '16.70', 33310072, '5', '2019-02-10 13:19:30', '0000-00-00 00:00:00'),
(6, 14, 'Q123', '4.20', 33310072, '6', '2019-02-10 13:20:52', '0000-00-00 00:00:00'),
(7, 15, 'wa124', '2.65', 22240082, '7', '2019-02-13 15:03:49', '0000-00-00 00:00:00'),
(8, 17, 'amal2', '8.10', 33310072, '13', '2019-03-13 13:58:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `autoId` bigint(20) NOT NULL,
  `custId` bigint(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `tempPhone` varchar(20) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `cityId` int(11) NOT NULL,
  `districtId` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `houseNo` varchar(10) NOT NULL COMMENT 'optional',
  `address` varchar(500) NOT NULL COMMENT 'district+city+street+building+houseNo',
  `latitude` varchar(20) NOT NULL COMMENT 'Share location via GPS',
  `longitude` varchar(20) NOT NULL COMMENT 'Share location via GPS',
  `profilePic` varchar(500) NOT NULL,
  `remainBalance` decimal(10,2) NOT NULL,
  `purchasePoints` decimal(10,2) NOT NULL,
  `enableNotification` int(1) NOT NULL DEFAULT '1',
  `deviceType` varchar(250) NOT NULL,
  `deviceToken` varchar(5000) NOT NULL,
  `passResetToken` varchar(300) NOT NULL,
  `timezone` varchar(50) NOT NULL,
  `badge` int(11) NOT NULL,
  `emailVerificationCode` varchar(255) NOT NULL,
  `smsVerificationCode` varchar(255) NOT NULL,
  `emailVerified` tinyint(1) NOT NULL,
  `smsVerified` tinyint(1) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`autoId`, `custId`, `username`, `password`, `email`, `phone`, `tempPhone`, `fullName`, `cityId`, `districtId`, `street`, `building`, `houseNo`, `address`, `latitude`, `longitude`, `profilePic`, `remainBalance`, `purchasePoints`, `enableNotification`, `deviceType`, `deviceToken`, `passResetToken`, `timezone`, `badge`, `emailVerificationCode`, `smsVerificationCode`, `emailVerified`, `smsVerified`, `isActive`, `isDeleted`, `created`, `modified`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, 1001, 'demo', 'ZGVtb0AxMjM=', 'info@watershop.com', '+48 576-24', '', 'Demo user', 3, 119, 'St.', 'Yellow1', '18181', ' 18181 Yellow1 St., Ø§Ù„Ù†Ø³ÙŠÙ… Ø§Ù„Ø´Ø±Ù‚ÙŠ, Ø§Ù„Ø®Ø±Ø¬', '', '', '1536582942_profilepic.jpg', '0.00', '48.12', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-08-28 00:00:00', '2019-01-18 03:19:52', '1535436444', '1538307853'),
(2, 1002, 'tes19', 'MTIzNDU2Nzg=', 'rws@tes.com', '0559422292', '', 'test test', 2, 90, 'test', '', '', ' test, Ø§Ù„Ø­Ø±Ø§Ù…, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-02 09:58:38', '2019-01-09 14:04:11', '1535871518', '1545252021'),
(3, 1003, 'test', 'MQ==', 'test@test.com', '0530303030393', '', 'test test', 2, 36, '', '', '', 'test', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-02 09:59:29', '2019-01-09 14:05:51', '1535871569', ''),
(4, 1004, 'amal', 'QWxhc21pYW1hbDEy', 'amalmq19@gmail.com', '551032525', '', 'amal m', 2, 36, '', '', '', 'alkharj', '', '', '', '0.00', '4.99', 1, 'iphone', '5fd2d4fa4e29f84ecc4d7b55e5aad820b240f8b51f95a4d180e76a64b1fa785e', '', '', 0, '', '1234', 0, 0, 0, 1, '2018-09-05 00:29:39', '2019-01-09 14:05:51', '1536096579', ''),
(5, 17005, 'sagar', 'MTIzNDU2Nzg=', 'sagarm@sevenstarinfotech.com', '8128380042', '', 'sagar modi', 1, 103, 'ghatlodia', 'vishwascity', 'M306', ' M306 vishwascity ghatlodia, Ø¹ØªÙŠÙ‚Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '1.26', 1, 'android', 'cfXrFU_qjQk:APA91bHx91EbQOH-7mQzGn6mywE8hKEIkeKoGCLRjJDJx1L0RKpIm4kT1aWYfizrPO2DSLiFba6xOt_ehj0TbAY6MgZS9lU3ZVgDqTFI9gduR6RRaUI34h_edmSCDN0c01bQWf7Ouy_J', '', '', 0, '', '1234', 0, 1, 1, 1, '2018-09-09 20:12:56', '2019-01-09 14:05:51', '1536513176', ''),
(6, 17006, 'jaypatel', 'MTIzNDU2', 'jayp@gmail.com', '9874563210', '', 'jayp', 1, 101, 'street12', 'arayn12', '1234', ' 1234 arayn12 street12, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-10 10:07:00', '2019-01-09 14:05:51', '1536563220', ''),
(7, 14007, 'test1', 'MTIzNDU2Nzg=', '1test@test.com', '055555555', '', 'test', 2, 55, 'h', 'h', 'j', ' j h h, Ø§Ù„Ù…Ø¹Ø°Ø±, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '1536783635_profilepic.png', '0.00', '2.36', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-11 02:21:54', '2019-01-09 14:05:51', '1536621714', ''),
(8, 14008, 'y', 'eXl5eXl5eXk=', 'yggh@fff.com', '444444444', '', 'y ', 2, 57, 'ju', 'yyy', 'jj', ' jj yyy ju, Ø§Ù„Ø´Ø±Ù‚ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '1.05', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-11 09:24:16', '2019-01-09 14:04:28', '1536647056', ''),
(9, 18009, 'Khalid', 'MTIzNDU2Nzg=', 'kas11.94u@gmail.com', '0544489007', '', 'Khalid', 2, 96, 'Buraydah', 'Ø¨', 'z', ' Ø¨ Buraydah, Ø¬Ø±ÙŠØ±, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '1537247671_profilepic.png', '0.00', '45.81', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-14 22:59:49', '2019-01-09 14:05:51', '1536955189', ''),
(10, 170010, 'sagarm', 'U0AxMjM0NTY3OA==', 'sagarmodi61@gmail.con', '8128380041', '', 'sagarmodi ', 1, 102, 'kali gali', 'andheri', '', ' andheri kali gali, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '7.04', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-24 19:41:07', '2019-01-09 14:05:51', '1537807267', ''),
(11, 170011, '90', 'QWxhc21pQDk=', 'ammak@gmail.com', '0555363676', '', 'amal ', 1, 101, 'Ø§Ù„Ø¨Ø­ØªØ±ÙŠ', 'Ù©Ù ', 'Ù¨Ù ', ' Ù¨Ù  Ù©Ù  Ø§Ù„Ø¨Ø­ØªØ±ÙŠ, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-26 11:43:18', '2019-01-09 14:05:51', '1537951398', ''),
(12, 110012, 'amal0', 'MTIzNDU2', 'amal@daniatqataf.com', '0551032525', '', 'Amal', 3, 3, 'Ø§Ù„Ø¨Ø­ØªØ±ÙŠ', 'Ù©Ù ', 'Ù©Ù ', ' Ù©Ù  Ù©Ù  Ø§Ù„Ø¨Ø­ØªØ±ÙŠ, Ø§Ù„ØµØ­Ø§ÙØ©, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '20.00', '12.40', 1, 'iphone', '5fd2d4fa4e29f84ecc4d7b55e5aad820b240f8b51f95a4d180e76a64b1fa785e', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-09-26 11:44:22', '2019-02-07 11:18:32', '1537951462', ''),
(13, 170013, 'amal8', 'QW1hbDkwMEA=', 'amal@fdj.com', 'Ù¥Ù£Ù¤Ù£Ù¤Ù¥Ù¤Ù¨', '', 'amal ', 1, 107, 'alal', '8Â£b', 'qqoi', ' qqoi 8Â£b alal, Ø§Ù„Ù…Ù„Ø², Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-26 12:52:19', '2019-01-09 14:05:51', '1537955539', ''),
(14, 160014, 'abdulhadi', 'MTIzNDU2Nzg=', 'abdulhadi.16q@outlook.com', '0559422292', '', 'abdulhadi ', 2, 84, 'aloyayna', '31', '11', ' 11 31 aloyayna, Ø§Ù„Ø¹Ø±ÙŠØ¬Ø§Ø¡ Ø§Ù„ÙˆØ³Ø·Ù‰, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '1.05', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-29 12:17:12', '2019-01-09 14:05:51', '1538212632', ''),
(15, 170015, 'amal12', 'QWxhc21pMTIzQDk=', 'amalkxj@gmai.com', 'Ù¥Ù¥Ù¡Ù¥Ù§Ù¥Ù§Ù¨Ù ', '', 'amal ', 1, 102, 'lkk', 'aa', '24', ' 24 aa lkk, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-09-30 16:45:30', '2019-01-09 14:05:51', '1538315130', ''),
(16, 170016, 'sagarmodi', 'U2FnYXJAMTIz', 'sagarmodi61@gmail.com', '8128380042', '', 'sagar', 1, 103, 'ahm', 'ahm', '24', ' 24 ahm ahm, Ø¹ØªÙŠÙ‚Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '1538777346_profilepic.png', '0.00', '1.89', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-10-02 20:29:26', '2019-01-09 14:05:51', '1538501366', ''),
(17, 117, 'amal81', 'YW1hbDEyMw==', 'amal9@gmail.com', '68828999', '', 'amal .', 0, 0, '', '', '', '', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-10-07 12:10:48', '2019-01-09 14:05:51', '1538903448', ''),
(18, 140018, 'Aokigahara', 'MTIzNDU2Nzg=', 'Aokigahara.77@gmail.com', '0544489007', '', 'Aokigahara ', 2, 64, 'u', 'u', 'i', ' i u u, Ø§Ù„Ø±ÙÙŠØ¹Ø©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-10-14 14:44:22', '2019-01-09 14:05:51', '1539517462', ''),
(19, 140019, 'Aoki', 'MTIzNDU2Nzg=', 'sales@yes.sa', '0544489007', '', 'Aoki', 2, 79, 'King Fahad', '1', 'c', ' c 1 King Fahad, ØµÙŠØ§Ø­, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '1539776012_profilepic.png', '0.00', '0.47', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '2018-10-17 14:04:40', '2019-01-09 14:05:51', '1539774280', ''),
(20, 22240020, 'Khalid7', 'ZHJpbmt3YXRlcg==', 'info@yes.sa', '0544489007', '', 'Khalid ', 2, 56, 'jusj', 'jsk', 'znn', ' znn jsk jusj, Ø§Ù„Ù‡Ø¯Ø§, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', '984e44dab32ee37c2293de3923a32d7d8939971611389e05c3e4e17595550bd3', '', '', 0, '', '', 0, 0, 1, 1, '2018-10-25 08:17:00', '2019-01-09 14:05:51', '1540444620', ''),
(21, 33310021, 'alasmi', 'MTIzNDU2Nzg=', 'amalmmp@gmail.com', '0551032525', '', 'alma ', 3, 2, 'albuhtri', '9', '0', ' 0 9 albuhtri, Ø§Ù„Ù†Ø±Ø¬Ø³, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, 'iphone', '53da9a4d0279970efccac446b85c64850a4dd5912adfe8440848cd943ca620f8', '', '', 0, '', '', 0, 0, 1, 1, '2018-11-18 09:04:56', '2019-01-09 14:05:51', '1542521096', ''),
(22, 22240022, 'mm12', 'MTIzNDUxMjM0NQ==', 'wahajsul@gmail.com', '0530816725', '', 'mm ', 2, 58, '3', '9', '9', ' 9 9 3, Ø¸Ù‡Ø±Ø© Ù„Ø¨Ù†, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', '26cb8f2e9bc14065952979da245818d1224888b33881d8ecedaa9b5a752a73ac', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-11-21 21:32:54', '2019-01-09 14:05:51', '1542825174', ''),
(23, 11170023, 'wah1111', 'MTIzNDEyMzQ=', 'wsultan@gmail.com', '0530816725', '', 'wahh ', 1, 108, '9', '9', 'g', ' g 9 9, Ø§Ù„ØµÙØ§, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'iphone', 'ea33a11b28be7a100f9011ea7bbc3f2acebce87e6a286808495c5256d166278e', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-11-22 11:42:44', '2019-01-09 14:05:51', '1542876164', ''),
(24, 11170024, 'testnov', 'MTIzNDU2Nzg=', 'test@test.comj', '0559422292', '', 'test ', 1, 102, 'non', 'non', 'non', ' non non non, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'iphone', 'bcad014504501c759da9d9296dc23b1fd7bb8c827ddb03579f3df10f9efec0d9', '', '', 0, '', '', 0, 0, 1, 1, '2018-11-22 22:16:06', '2019-01-09 14:05:51', '1542914166', ''),
(25, 22270025, 'wed11', 'V2Vkd2VkLTEyMw==', 'wedo014@hotmail.com', 'Ù Ù¥Ù£Ù¥Ù¦Ù§Ù¢Ù¤Ù§Ù§', '', 'wed ', 2, 100, 'Ø§Ù„Ø§Ù…Ø§Ù… Ø³Ø¹ÙˆØ¯', 'Ù¥Ù§Ù¤Ù¤', 'Ù¤Ù¦Ù¦Ù§', ' Ù¤Ù¦Ù¦Ù§ Ù¥Ù§Ù¤Ù¤ Ø§Ù„Ø§Ù…Ø§Ù… Ø³Ø¹ÙˆØ¯, Ø¬Ø¨Ø±Ø©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', 'c9f0f895fb98ab9159f51fd0297e236d', '', 0, '', '', 0, 0, 1, 1, '2018-11-23 12:01:31', '2019-01-09 14:05:51', '1542963691', ''),
(26, 11170026, 'sagar123', 'ZGVtb0AxMjM0', 'sagarmodi@mailinator.com', '8128380042', '', 'sagar', 1, 103, 'ptn', 'b', '25', ' b ptn, Ø¹ØªÙŠÙ‚Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'iphone', 'cf09b522ea2d7704d0814710fd95ec9fb02900f15b0c96441d60255cd3b6fb84', '', '', 0, '', '', 0, 0, 1, 1, '2018-12-03 20:12:25', '2019-01-09 14:05:51', '1543857145', ''),
(27, 11170027, 'test208', 'MTIzNDU2Nzg=', 'ceo@yes.sa', '0554922229', '', 'test208 ', 1, 101, 'gghh', 'nb', '1554', ' 1554 nb gghh, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '2.57', 1, 'iphone', 'ff9fcc210f9a5928b114cea0447e08bf767153f4c0b61d8fa1d01f9e1a5f23c6', '', '', 0, '', '', 0, 0, 1, 1, '2018-12-04 07:26:49', '2019-01-09 14:05:51', '1543897609', ''),
(28, 33340028, 'TAM', 'MTIzNDUxMjM0NQ==', 'wwww@gmail.com', '1234567890', '', 'TAM', 3, 47, '9', '', '', ' 9, Ø§Ù„Ø®Ø²Ø§Ù…Ù‰, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 0, 1, 1, '0000-00-00 00:00:00', '2019-01-09 14:05:51', '1543948677', ''),
(29, 22260029, 'wed117', 'V2Vkd2VkLTEyMw==', 'hdhbk@hotmail.com', 'Ù Ù¥Ù£Ù¥Ù¦Ù§Ù¢Ù¤Ù§Ù§', '', 'Wedo ', 2, 88, 'Ø§Ù„Ø§Ù…Ø§Ù…', '655', 'Ù¥Ù¤Ù¥', ' Ù¥Ù¤Ù¥ 655 Ø§Ù„Ø§Ù…Ø§Ù…, Ø´Ø¨Ø±Ø§, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', 'ce6cec8bf6ce0b656977b8ec558444f4e8c40ec42984d018d2b4af9502c15d80', '', '', 0, '', '', 0, 0, 1, 1, '2018-12-05 10:04:50', '2019-01-09 14:05:51', '1543993490', ''),
(30, 11180030, 'demouser', 'ZGVtb0AxMjM0', 'demo@gmail.com', '8128380042', '', 'demo', 1, 119, 'hb', '23', '', ' 23 hb, Ø§Ù„Ù†Ø³ÙŠÙ… Ø§Ù„Ø´Ø±Ù‚ÙŠ, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '1546089883_profilepic.jpg', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 1, 1, 1, '2018-12-06 11:49:51', '2019-01-09 14:05:51', '1544086191', ''),
(37, 22240037, 'wee', 'MTIzNDEyMzQ=', 'awatershop@gmail.com', '0530816725', '0530816725', 'wee ', 2, 56, '123', '123', '', ' 123 123, Ø§Ù„Ù‡Ø¯Ø§, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-10 10:34:12', '2019-01-09 14:05:51', '1544427252', ''),
(38, 33310038, 'nawaf0', 'TmF3YWZhbGFzbWk=', 'amaq@gmail.com', '0551032525', '0551032525', 'nawaf ', 3, 12, 'al', '8', '1', ' 1 8 al, Ø§Ù„ÙˆØ§Ø¯ÙŠ, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, 'iphone', 'a4b99a17dd7c2d6eed8aa8d2814deada3ec1fddc050b5a3fdfaf303e5fea424f', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-12 13:27:23', '2019-01-09 14:05:51', '1544610443', ''),
(39, 11170039, 'Nouf8', 'Tm91ZmFsYXNtaQ==', 'amalmq190@gmail.com', '0551032525', '', 'nawaf ', 1, 102, 'ad', 'o', '9', ' 9 o ad, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '7.24', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-12 13:29:07', '2019-01-09 14:05:51', '1544610547', ''),
(40, 33310040, 'shaggyme', 'ZGVtb0AxMjM0', 'sagarmodi4447@mailinator.com', '9624062219', '9624062219', 'shaggy ', 3, 10, 'ahmedabad', '35', '', ' 35 ahmedabad, Ø­Ø·ÙŠÙ†, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, 'iphone', 'cbd0a399296ebfa9fa121b0848fa41212513d7ca80ee729217e1ddbe31965832', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-12 16:37:02', '2019-01-09 14:05:51', '1544621822', ''),
(41, 22240041, 'smodi123', 'ZGVtb0AxMjM0', 'sagarm1234@mailinator.com', '8128380042', '8128380042', 'sagarmodi ', 2, 52, 'ahm', '56', '', ' 56 ahm, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', 'cbd0a399296ebfa9fa121b0848fa41212513d7ca80ee729217e1ddbe31965832', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-12 20:21:09', '2019-01-09 14:05:51', '1544635269', ''),
(42, 22240042, 'jack123', 'ZGVtb0AxMjM0', 'jack01@mailinagor.com', '8128380042', '8128380042', 'jack ', 2, 52, 'ahd', '56', '', ' 56 ahd, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', 'cbd0a399296ebfa9fa121b0848fa41212513d7ca80ee729217e1ddbe31965832', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-12 20:23:52', '2019-01-09 14:05:51', '1544635432', ''),
(43, 22240043, 'jack1', 'ZGVtb0AxMjM0', 'jack01@mailinator.com', '9427515177', '9427515177', 'jack ', 2, 52, 'ahm', '56', '', ' 56 ahm, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', 'cbd0a399296ebfa9fa121b0848fa41212513d7ca80ee729217e1ddbe31965832', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-12 20:44:51', '2019-01-09 14:05:51', '1544636691', ''),
(44, 22240044, 'jack445', 'ZGVtb0AxMjM0', 'jack@gmail.com', '72727272727', '', 'jack ', 2, 53, 'uiss', 'hsja', '', ' hsja uiss, Ø§Ù… Ø§Ù„Ø­Ù…Ø§Ù… Ø§Ù„ØºØ±Ø¨ÙŠ, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', 'cbd0a399296ebfa9fa121b0848fa41212513d7ca80ee729217e1ddbe31965832', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-12 20:52:47', '2019-01-09 14:05:51', '1544637167', ''),
(45, 22240045, 'jck123', 'ZGVtb0AxMjM0', 'jack1234@gmail.com', '8128380041', '', 'jack ', 2, 52, 'tyua', 'zhzhhz', '', ' zhzhhz tyua, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-12 21:01:13', '2019-01-09 14:05:51', '1544637673', ''),
(46, 22240046, 'jacky123', 'ZGVtb0AxMjM0', 'demo123@gmail.com', '1234567890', '1234567890', 'jacky ', 2, 52, 'titam', 'nh', '', ' nh titam, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'iphone', 'cbd0a399296ebfa9fa121b0848fa41212513d7ca80ee729217e1ddbe31965832', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-12 21:05:46', '2019-01-09 14:05:51', '1544637946', ''),
(47, 22240047, 'sam123', 'ZGVtb0AxMjM0', 'sam@gmail.com', '72727272772', '', 'sam ', 2, 52, 'haamm', 'er', '', ' er haamm, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-12 21:17:30', '2019-01-09 14:05:51', '1544638650', ''),
(48, 22240048, 'johnw123', 'ZGVtb0AxMjM0', 'johnw@gmail.com', '7272727272', '', 'john week ', 2, 54, 'header', 'b', '', ' b header, Ø§Ù… Ø§Ù„Ø­Ù…Ø§Ù… Ø§Ù„Ø´Ø±Ù‚ÙŠ, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-12 21:31:48', '2019-01-09 14:05:51', '1544639508', ''),
(49, 33310049, 'sagarmodi123', 'ZGVtb0AxMjM0', 'sagarmodi007@gmail.com', '8128380045', '', 'sagar ', 3, 3, 'header', 'b', '', ' b header, Ø§Ù„ØµØ­Ø§ÙØ©, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-12 21:38:34', '2019-01-09 14:05:51', '1544639914', ''),
(50, 11170050, 'wah', 'MTIzNDUxMjM0NQ==', 'gaaaaga@gmail.com', '0530816725', '', 'wah ', 1, 102, '1234', '99', '', ' 99 1234, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '26.08', 1, 'iphone', '', '', '', 0, '', '1234', 0, 1, 1, 1, '2018-12-13 00:07:33', '2019-01-09 14:05:51', '1544648853', ''),
(51, 22240051, 'amal83', 'QW1hbDE0Nw==', 'am22al@gmail.com', '0551032525', '', 'amal', 2, 60, 'al', 'a', '2', ' 2 a al, Ù…Ù†ÙÙˆØ­Ø©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '0000-00-00 00:00:00', '2019-01-09 14:05:51', '1544700369', ''),
(52, 11170052, 'tt1234', 'MTIzNDEyMzQ=', 'gooogee@gmail.com', '0530816728', '0530816728', 'ttttttt ', 1, 106, 'gj', '88', '', ' 88 gj, Ø§Ù„ÙÙˆØ·Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'iphone', '2defbb5f506a8a4738b9c484b0bb5a7d35b5b8f9d2324969cff0280603a40405', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-16 21:09:51', '2019-01-09 14:05:51', '1544983791', ''),
(53, 11170053, '', 'MTIzNDU2Nzhh', 'jayp1@gmail.com', '9537661592', '9537661592', 'jay', 1, 101, 'test', 'test', 'test', ' test test test, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'iphone', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-28 18:46:19', '2019-01-09 14:05:51', '1546011979', ''),
(54, 11170054, '', 'MTIzNDU2Nzhh', 'jayr@gmail.com', '9537661591', '9537661591', 'jayr', 1, 101, 'test', 'test', 'test', ' test test test, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'fTNzFzNRq0g:APA91bEwBhPczaUO6fUOhpA8ASMQDT_X7xNVKLzFRcpomW10ECkKUp8x_hcOqVF3FlHxpgvUeAatizsPleC598hnx50mn8NYM0zEzAOEfg4tOeL6DQC-ZREIRbABgNTd6-r2jLEZ46Ln', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-28 18:52:51', '2019-01-09 14:05:51', '1546012372', ''),
(55, 11170055, '', 'MTIzNDU2Nzhh', 'jayj@gmail.com', '9537661593', '9537661593', 'jayj', 1, 101, 'test', 'test', 'test', ' test test test, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-28 19:06:35', '2019-01-09 14:05:51', '1546013195', ''),
(56, 11170056, '', 'MTIzNDU2Nzhh', 'jayg@gmail.com', '9537661593', '9537661593', 'jayg', 1, 101, 'tttt', 'tttt', 'ttttt', ' ttttt tttt tttt, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-28 19:21:51', '2019-01-09 14:05:51', '1546014111', ''),
(57, 11170057, '', 'MTIzNDU2Nzhh', 'infoe1w@watershop.com', '+48 576-242-947', '', 'jignq', 1, 101, 'fffff', 'fff', 'fff', ' fff fff fffff, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '1.52', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-28 19:26:47', '2019-01-09 14:05:51', '1546014407', ''),
(58, 11170058, '', 'MTIzNDU2Nzhx', 'jayq@gmail.com', '+19537661592', '', 'jayq', 1, 101, 'tttt', 'ttt', 'tttt', ' tttt ttt tttt, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-31 19:45:04', '2019-01-09 14:05:51', '1546274704', ''),
(59, 11170059, '', 'MTIzNDU2Nzhx', 'jayw@gmail.com', '19537661592', '19537661592', 'jayw', 1, 101, 'gg', 'gg', 'ff', ' ff gg gg, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2018-12-31 19:48:33', '2019-01-09 14:05:51', '1546274913', ''),
(60, 11170060, '', 'MTIzNDU2Nzhh', 'jaye@gmail.com', '+1918160381332', '', 'jaye', 1, 101, 'ttt', 'tt', 'tt', ' tt tt ttt, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2018-12-31 19:54:31', '2019-01-09 14:05:51', '1546275271', ''),
(61, 22240061, 'wah132', 'MTIzNDU2Nzg=', 'geeegii@gmail.com', '0582369741', '0582369741', 'wah ', 2, 52, 'gh', '11', '13', ' 13 11 gh, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '26cb8f2e9bc14065952979da245818d1224888b33881d8ecedaa9b5a752a73ac', '', '', 0, '', '1234', 0, 0, 1, 1, '2019-01-08 18:12:22', '2019-01-09 14:05:51', '1546960342', ''),
(62, 33380062, '', 'MTIzNDU2Nzhh', 'taf.omar.3@gmail.com', '0563355699', '0563355699', 'amal', 3, 111, 'Ø§Ù„Ù…Ù„Ùƒ Ø¹Ø¨Ø¯Ø§Ù„Ù„Ù‡', 'Ù¡Ù¢Ù£', 'Ù¡Ù¢', ' Ù¡Ù¢ Ù¡Ù¢Ù£ Ø§Ù„Ù…Ù„Ùƒ Ø¹Ø¨Ø¯Ø§Ù„Ù„Ù‡, Ø§Ù„Ù†ÙˆØ±, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2019-01-09 13:04:04', '2019-01-09 14:05:51', '1547028244', ''),
(63, 33310063, 'samah', 'QWxhc21pLzA5', 'amalmq193@gmail.com', '0543455386', '0543455386', 'samah ', 3, 2, 'albuhtri', '70', '1', ' 1 70 albuhtri, Ø§Ù„Ù†Ø±Ø¬Ø³, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, '', '5fd2d4fa4e29f84ecc4d7b55e5aad820b240f8b51f95a4d180e76a64b1fa785e', '', '', 0, '', '1234', 0, 0, 1, 1, '2019-01-09 13:07:30', '2019-01-09 14:05:51', '1547028450', ''),
(64, 11170064, '', 'MTIzNDU2Nzhh', 'bintomar20@gmail.com', '0508087653', '0508087653', 'latifa', 1, 101, '123', '1345', '35', ' 35 1345 123, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2019-01-09 13:29:21', '2019-01-09 14:05:51', '1547029761', ''),
(65, 11170065, '', 'dGVzdDEyM0A', 'anas.kadival@gmail.com', '0512345678', '', 'Anas', 1, 101, 'st.', 'Al-Asbab Park', '505', ' st. 505 Al-Asbab Park, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'iphone', 'fYZuLDhScJM:APA91bFZKCKYDcpAPjVTHt5mSkVIZJ8gWefedBvoydPYrrqIrnHgTcogaL2Hr20PkkyuCs6jMzJG2QBjaYEuQR8ZoiNN2lXCtgB8TKb28TqAbcWyDRcVwdzRwjT6NoR7xgx6RNGfwjzX', '', '', 0, '', '6981', 0, 1, 1, 0, '2019-01-09 19:20:19', '2019-01-18 03:35:52', '1547050819', ''),
(66, 11170066, '', 'MTIzNDU2Nzhx', 'jayaa@gmail.com', '9632587410', '9632587410', 'abb', 1, 106, 'ttt', 'yd6', 'uffu', ' uffu yd6 ttt, Ø§Ù„ÙÙˆØ·Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'ckBpqAtNBDM:APA91bFvm0CydXBqRf0Zg5Lf9hUBmQXI82_DtmgaVAKw1bcObzx0YnXdc2WTS5oY7MRqgccwuya1TPZpadbre7mlo2sjICdIgzjGBVL85HMv1CBTnb2CbZyxLUHDmI6B5ovDTdKPCq6e', '', '', 0, '', '1234', 0, 0, 1, 0, '2019-01-09 19:23:25', '2019-01-18 03:27:47', '1547051005', ''),
(67, 11170067, '', 'MTIzNDU2Nzhh', 'anas@gmail.com', '5522555222', '', 'Anas', 1, 161, 'test', 'test', 'teat', 'NH 48, Vadodara, Gujarat, 391740, India', '22.35554992689039', '73.16826252273579', '', '0.00', '240.49', 1, 'iphone', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-10 05:32:25', '2019-04-27 21:07:55', '1547087545', ''),
(68, 22270068, '', 'MTIzNDU2Nzhh', 'jaytt@gmail.com', '9632582222', '9632582222', 'ffffddd', 2, 108, 'tvvr', 'and hrh', 'evegr', ' evegr and hrh tvvr, Ø§Ù„ØµÙØ§, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'android', 'cHaBkuPV0uM:APA91bGxve6fCZM3s8nYrMFF1g_YksUE1wFdzf8K6Rba3pT0S-0GUbyqd8kyDOHMveKxjmLCtRPvk1YfGpvaG4UQ-Pk0TUPO4yJUVTTRm8jyNEwPVsa4FK9qub5ojxoIoaFhoikxeYEg', '', '', 0, '', '1234', 0, 0, 1, 0, '2019-01-10 07:13:38', '2019-01-10 04:13:39', '1547093619', ''),
(69, 11170069, '', 'MTIzNDU2Nzhh', 'jayyy@gmail.com', '9632563258', '', 'qaz', 1, 101, 'fffggggghhhh', 'f', 'g', ' g f fffggggghhhh, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-10 07:17:26', '2019-01-10 04:20:25', '1547093846', ''),
(70, 22270070, '', 'MTIzNDU2Nzhh', 'zzz@gmail.com', '1245780741', '', 'zzz', 2, 102, 'asdf', 'sdff', 'ffgg', ' ffgg sdff asdf, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'android', 'cHaBkuPV0uM:APA91bGxve6fCZM3s8nYrMFF1g_YksUE1wFdzf8K6Rba3pT0S-0GUbyqd8kyDOHMveKxjmLCtRPvk1YfGpvaG4UQ-Pk0TUPO4yJUVTTRm8jyNEwPVsa4FK9qub5ojxoIoaFhoikxeYEg', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-10 07:30:49', '2019-01-10 04:31:39', '1547094649', ''),
(71, 11170071, 'wahaj', 'MTIzNDUxMjM0NQ==', 'wahajsul@gmail.com', '0530816725', '', 'wahaj ', 1, 102, '19', '99', '19', ' 19 99 19, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-10 14:32:36', '2019-01-10 11:59:03', '1547119956', ''),
(72, 33310072, 'amal', 'MTIzNDU2Nzg=', 'amalmq19@gmail.com', '0551032525', '', 'amal', 1, 103, 'Ø§Ù„Ø¨Ø­ØªØ±ÙŠ', 'Ù¢', 'Ù¡', 'Ù¡ Ù¢ Ø§Ù„Ø¨Ø­ØªØ±ÙŠ, Ø¹ØªÙŠÙ‚Ø©, Ø§Ù„Ø¯Ù…Ø§Ù…', '24.158798619612405', '47.23116752137608', '', '0.00', '326.64', 1, 'iphone', '1463c514e4cac8db6248ee4c1e93431ffcf0899d1f2d6c478d66405c778afb21', 'e4da3b7fbbce2345d7772b0674a318d5', '', 0, '', '', 0, 1, 1, 0, '2019-01-10 14:34:46', '2019-04-28 17:09:53', '1547120086', ''),
(73, 11170073, '', 'VGFmb21hcjM=', 'taf.omar.3@gmail.com', '0563355699', '0563355699', 'latifa', 1, 101, '123', '123', '12', ' 12 123 123, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1234', 0, 0, 1, 1, '2019-01-10 14:37:39', '2019-02-10 10:02:18', '1547120259', ''),
(74, 22240074, 'wahaj', 'MTIzNDEyMzQ=', 'wahajsul@mail.com', '0530816725', '', 'wahaj ', 2, 52, '123', '11', '19', ' 19 11 123, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, '', '26cb8f2e9bc14065952979da245818d1224888b33881d8ecedaa9b5a752a73ac', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-10 15:00:09', '2019-01-13 18:29:42', '1547121609', ''),
(75, 11170075, '', 'MTIzNDU2Nzhx', 'test@gmail.com', '0523564851', '', 'test', 1, 101, 'fgsgs', 'dhh', 'xnnd', ' xnnd dhh fgsgs, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '6.62', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-10 19:20:35', '2019-01-16 19:05:47', '1547137235', ''),
(76, 33310076, 'samah', 'MTIzMTIzMTI=', 'bintomar22@gmail.com', '0532093637', '', 'samah ', 3, 2, '123', '12', '1', ' 1 12 123, Ø§Ù„Ù†Ø±Ø¬Ø³, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '1182.98', 1, 'iphone', '5fd2d4fa4e29f84ecc4d7b55e5aad820b240f8b51f95a4d180e76a64b1fa785e', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-13 10:53:33', '2019-02-10 10:05:42', '1547366013', ''),
(77, 22240077, 'wahaj', 'MTIzNDU2Nzg=', 'wahajsul@gmail.com', '0530816725', '', 'wahaj ', 2, 55, '1098', '19', '9', ' 9 19 1098, Ø§Ù„Ù…Ø¹Ø°Ø±, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '326.82', 1, '', '', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-13 21:31:18', '2019-01-14 11:47:23', '1547404278', ''),
(78, 11170078, '', 'MTIzNDU2Nzhh', 'test1@gamil.com', '0532694851', '0532694851', 'test1', 1, 101, 'test', 'test', 'test', ' test test test, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'fYZuLDhScJM:APA91bFZKCKYDcpAPjVTHt5mSkVIZJ8gWefedBvoydPYrrqIrnHgTcogaL2Hr20PkkyuCs6jMzJG2QBjaYEuQR8ZoiNN2lXCtgB8TKb28TqAbcWyDRcVwdzRwjT6NoR7xgx6RNGfwjzX', '', '', 0, '', '8124', 0, 0, 1, 0, '2019-01-14 14:12:05', '2019-01-14 11:12:06', '1547464325', ''),
(79, 22240079, 'wahaj', 'MTIzNDU2Nzg=', 'info@watershop.com', '0530816725', '', 'wahaj', 2, 52, '19', '99', '66', ' 66 99 19, Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '108.94', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-14 14:52:06', '2019-01-16 20:11:00', '1547466726', ''),
(80, 22270080, '', 'MTIzNDU2Nzhh', 'jay1234@gmail.com', '9874563210', '', 'jay1234', 2, 102, 'test', 'test', 'test', ' test test test, Ø§Ù„ÙŠÙ…Ø§Ù…Ø©, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-15 15:15:49', '2019-01-15 17:18:19', '1547554549', ''),
(81, 11170081, '', 'MTIzNDU2Nzhh', 'jaypp@gmail.com', '9461372751', '9461372751', 'jaypp@gmail.com', 1, 101, 'hH', 'haya', 'hH', ' hH haya hH, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'eNBCqhwMdww:APA91bHlKyVQsKkYCn8tFsa3p3xV6vpbWbOTqKD0IO0tpDkDoH3BDA2wseqZ6uXYt6r9dZREUT4basD47A0jmzPFtbPtUMHAuoD3gQk66wX1ZVNfFwppEOIcBwlT-Ll62F1qBh0IgDWa', '', '', 0, '', '4570', 0, 0, 1, 0, '2019-01-15 19:21:19', '2019-01-17 08:13:10', '1547569279', ''),
(82, 22240082, 'wahaj', 'MTIzNDU2Nzg=', 'wahajsul@gmail.com', '0530816725', '', 'wahaj', 2, 52, '99', '90', '', 'Dawood Al Fazaz Street, Aziziah, Ash Sharqiyah, 34714, Saudi Arabia', '26.216378655515808', '50.20464649962487', '', '0.00', '68.86', 1, 'iphone', 'd06ebfb3224a26d48ecb12c44f4447c628d4b9e7cdba9e73dd8e73e319e9ee96', '8f14e45fceea167a5a36dedd4bea2543', '', 0, '', '', 0, 1, 1, 0, '2019-01-17 07:37:04', '2019-04-28 19:05:18', '1547699824', ''),
(83, 11170083, '', 'MTIzNDU2Nzg=', 'jay123@gmail.com', '9658321457', '', 'jay123', 1, 101, 'bB', 'bzh', 'bzb', ' bzb bzh bB, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '66.43', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-17 11:24:07', '2019-01-22 17:32:23', '1547713447', ''),
(84, 33310084, 'wahaj', 'MTIzNDU2Nzg=', 'ghghfh@gmail.com', '0559422292', '0559422292', 'wahaj ', 3, 4, '99', '99', '1', ' 1 99 99, Ø§Ù„Ù…Ù„Ù‚Ø§, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, 'android', 'e9YwlmuTI5g:APA91bFQ2KyX53Ms56yzbtHqyNPin34OQh8-NjiuVjtM-QW9axz5fjsO4cd6Sj8g6W70U6R3mLdYyL9Q9o_CyQEjXGL3fBTy7JVIB2ZRaeTyjxc49wfqU-n5y0dF69N9J0SnQwNYc8ue', '', '', 0, '', '6626', 0, 0, 1, 1, '2019-01-17 19:50:30', '2019-01-20 02:15:11', '1547743830', ''),
(85, 11170085, '', 'MTIzNDUxMjNh', 'dhhd@gmail.com', '0564944949', '0564944949', 'testvxh', 1, 101, 'nxnd', 'dndn', 'xnx', ' xnx dndn nxnd, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'diMqa4LerNQ:APA91bHRp98cf8lyShSPDU_ofVM-coM8ZV5nW7GEyykChw9JfZukZsnRpVaD4ADsBM9K7xvMfX3ckVVAeTg7e1SmLasWN5MVg7oKkgakGHyaz6fcqTZW3LiBwNihjUpVT8xxdmAx08L1', '', '', 0, '', '9087', 0, 0, 1, 0, '2019-01-17 23:31:16', '2019-01-17 20:35:05', '1547757076', ''),
(86, 22270086, '', 'MTIzNDU2Nzg=', 'mr.h@windowslive.com', '055555959', '055555959', 'tester', 2, 109, 't', 'hha', '', ' hha t, Ø§Ù„ÙØ§Ø±ÙˆÙ‚, Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶', '', '', '', '0.00', '0.00', 1, 'android', 'e9YwlmuTI5g:APA91bFQ2KyX53Ms56yzbtHqyNPin34OQh8-NjiuVjtM-QW9axz5fjsO4cd6Sj8g6W70U6R3mLdYyL9Q9o_CyQEjXGL3fBTy7JVIB2ZRaeTyjxc49wfqU-n5y0dF69N9J0SnQwNYc8ue', '8f14e45fceea167a5a36dedd4bea2543', '', 0, '', '9219', 0, 0, 1, 1, '2019-01-18 22:24:37', '2019-01-20 02:15:31', '1547839477', ''),
(87, 33370087, '', 'MTExMTExMTE=', 'mr.h@windowslive.com', '0559422292', '', 'abd', 3, 101, 'yeu', 'heh', '', ' heh yeu, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '41.15', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-20 05:23:40', '2019-02-10 10:14:25', '1547951020', ''),
(88, 11170088, '', 'MTIzNDU2Nzg=', 'dinabinjabi@gmail.com', '0566489225', '', 'dina', 1, 101, 'Ø§Ø¨Ø­Ø±', '4677', '', ' 4677 Ø§Ø¨Ø­Ø±, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-20 21:58:10', '2019-01-21 19:36:45', '1548010690', ''),
(89, 11170089, '', 'dGVzdDEyMzQ=', 'test123@gmail.com', '0523458769', '0523458769', 'test', 1, 101, 'tesy', 'test', 'test', ' test test tesy, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'c1jkBQjN01U:APA91bEYoazD3jooFKAYdYl2espjUMaROixZmbc1lRj2IT2Jq6TOn7nHG9kE_Mzyv778EhE0mi2F9atqSHWnvx6ec_eNP_TItQCEQGN3QpAOJYKx5OlsfUA00y7kwlY9CFLdux_CCcmD', '', '', 0, '', '4392', 0, 0, 1, 0, '2019-01-21 06:38:17', '2019-01-21 03:38:18', '1548041897', ''),
(90, 11170090, '', 'MTIzNDU2Nzg=', 'dsammb7@gmail.com', '0505690733', '', 'dina', 1, 101, 'Ø§Ø¨Ø­Ø±', 'Ù¢Ù£Ù¤Ù¥', '', ' Ù¢Ù£Ù¤Ù¥ Ø§Ø¨Ø­Ø±, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-21 22:31:48', '2019-01-21 19:37:58', '1548099108', ''),
(91, 11170091, '', 'MTIzNDU2Nzg=', 'dinabinjabi@gmail.com', '0566489225', '', 'dinq', 1, 101, 'obhur', '4778', '', ' 4778 obhur, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '2.10', 1, 'android', 'fMqDG-p5ppM:APA91bEkZ736RJrB-v0tR5C5BKf4C6p1__F5pz-ZLumSPxSYlDDEz2AfBnv38Lq9PEFNtP6vf8y82aPdFkfF8hLqRMUwGShM64J98i_-Vx27x8-GRkTboqkUsf7J6gN4jKSgRlAODr9d', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-21 22:39:01', '2019-01-23 09:01:09', '1548099541', ''),
(92, 11170092, '', 'MTIzNDU2Nzhh', 'jayss@gmail.com', '9632563266', '9632563266', 'jayss', 1, 101, 'hvu', 'vhc', 'cgc', ' cgc vhc hvu, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '0.00', 1, 'android', 'cpHc920XigU:APA91bEBq8gI1bA6vKlVu956aCsVahF6l0YWil3mB6OPSI78aGc5MO6LW0ST7aPPKHdvygabtNK3rg0_gU0lGlu0pAM_SVxinIVjrmHQ9Pgfx4pSucTL3X1ceB38t7OOFhWIlUnF-AKl', '', '', 0, '', '8003', 0, 0, 1, 0, '2019-01-22 20:20:07', '2019-01-22 17:20:08', '1548177607', ''),
(93, 11170093, '', 'MTIzNDU2Nzhh', 'jayoo@gmail.com', '6666666666', '', 'jayyy', 1, 101, 'hhu', 'gyy', 'yyy', ' yyy gyy hhu, ØºØ¨ÙŠØ±Ø§Ø¡, Ø§Ù„Ø¯Ù…Ø§Ù…', '', '', '', '0.00', '10.71', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-22 20:23:29', '2019-01-22 17:28:03', '1548177809', ''),
(94, 94, '', 'MTIzNDU2Nzhh', 'jayg@gmail.com', '9632147809', '', 'jayg', 0, 0, '', '', '', 'An der Oberrothe 1, 99986 Niederdorla, Ø£Ù„Ù…Ø§Ù†ÙŠØ§', '51.165689', '10.4515248', '', '0.00', '0.00', 1, 'android', '', '', '', 0, '', '', 0, 1, 1, 0, '2019-01-26 20:41:06', '2019-01-26 18:26:56', '1548524466', ''),
(95, 95, '', 'MTIzNDU2Nzhh', 'jayx@gmail.com', '3215469785', '', 'jayx', 0, 0, '', '', '', 'Unnamed Road, New Ranip, Ahmedabad, Gujarat 382470ØŒ Ø§Ù„Ù‡Ù†Ø¯', '23.0967692', '72.55674929999999', '', '0.00', '0.00', 1, 'android', 'ceJHOutQImo:APA91bGX0Kf89L6-ltU8016oeJHrzmovPHWXR7qm4rpxHFolZMCC94djMR_R72JQf3FCOsSkJCk985s8Bs4EoqLkIW8tz577WffsqpyAGJFn2UumZvH5UzQPXrLPBqWkvbFYi5bEfK9r', '', '', 0, '', '', 0, 1, 1, 1, '2019-01-26 21:34:44', '2019-02-01 17:36:08', '1548527684', ''),
(96, 96, '', 'MTIzNDU2Nzg=', 'info@abc.com', '0545698745', '0545698745', 'test', 0, 0, '', '', '', '4378 Ø§Ù„Ø±ÙŠØ§Ø¶ØŒ Ø§Ù„Ø¬Ø¨ÙŠÙ„ Ø§Ù„Ø¨Ù„Ø¯ØŒ Ø§Ù„Ø¬Ø¨ÙŠÙ„ 35514Â 8001ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '27.0080091', '49.6563339', '', '0.00', '0.00', 1, 'android', 'fVh-dHolZdk:APA91bFl_eeFkBf_eLA2iV0AIz9p1-9Dva_wgjBmy9IZzEioXmGv9lXzUnEkRovGQ2Y3oEiZ7VbyY5rleFEtVIDK11BAHanasxTsHMLreM0HYKMOYnBxMuM8-WVzd1c1Yu12PwRFAP_5', '', '', 0, '', '4562', 0, 0, 1, 0, '2019-01-26 23:24:19', '2019-01-26 20:24:20', '1548534259', ''),
(97, 97, '', 'MTIzNDU2Nzho', 'pathanparvez754@gmail.com', '5522333666', '5522333666', 'parvez', 0, 0, '', '', '', 'FF 113, Earth land mark,, Sun Pharma Rd, Pramukh Swami nagar, Tandalja, Vadodara, Gujarat 390012ØŒ Ø§Ù„Ù‡Ù†Ø¯', '22.2809199', '73.1531092', '', '0.00', '0.00', 1, 'android', 'c0X0ejAmb-Y:APA91bH_oTQE4i6bbH_VJjXry7pL7pwOsHEesmTJ2riirbU7g3zQD9EQNLsM5uZhdW6LE5s5-jPjyJlYWzchuHcBKWRa4y7JdPD17eyqNlXrzIX43zYKpxLVVXcOA6DibQYzaySbPlnf', '', '', 0, '', '3904', 0, 0, 1, 0, '2019-01-31 22:48:14', '2019-01-31 19:48:15', '1548964094', ''),
(98, 98, 'pathan12345', 'MTIzNDU2Nzg5MA==', 'testk@gmail.com', '5557778889', '5557778889', 'parvez ', 0, 0, '', '', '', '', '22.283559759366042', '73.16485222005569', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '1462', 0, 0, 1, 0, '2019-01-31 23:44:46', '2019-01-31 20:44:46', '1548967486', ''),
(99, 99, 'parvezkhan65', 'MTIzNDU2MTIzNDU=', 'testkhan@gmail.com', '7776666655', '7776666655', 'pkhan ', 0, 0, '', '', '', 'Vadodara, ÙƒØ¬Ø±Ø§Øª, 390012, Ø§Ù„Ù‡Ù†Ø¯', '22.283881945122957', '73.16414191364898', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '8768', 0, 0, 1, 0, '2019-01-31 23:47:00', '2019-01-31 20:47:02', '1548967620', ''),
(100, 100, '', 'MTIzNDU2Nzg5', 'pathan@gmail.com', '9993212325', '9993212325', 'parvezpathan', 0, 0, '', '', '', 'Vadodara, Gujarat, 391740, India', '22.355611114783542', '73.16831122159321', '', '0.00', '0.00', 1, '', '371e1d377c16b6f5a0c6b5edc2e7e3a9d362f53a7cb50b24f57db45f5494a9b4', '', '', 0, '', '1676', 0, 0, 1, 1, '2019-02-01 13:36:26', '2019-02-01 17:35:49', '1549017386', ''),
(101, 101, '', 'UmF5eWFuLjg2', 'rv@g.com', '0973762413', '0973762413', 'Rayyan', 0, 0, '', '', '', 'Stockton St, 1, Ø³Ø§Ù† ÙØ±Ø§Ù†Ø³ÙŠØ³ÙƒÙˆ, CA, 94108, Ø§Ù„ÙˆÙ„Ø§ÙŠØ§Øª Ø§Ù„Ù…ØªØ­Ø¯Ø©', '37.785834', '-122.406417', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '5066', 0, 0, 1, 1, '2019-02-01 17:37:48', '2019-02-01 17:35:56', '1549031868', ''),
(102, 102, '', 'UmF5eWFuLjg2', 'rv@gl.com', '9737624134', '9737624134', 'Rayyan', 0, 0, '', '', '', 'Waverly Pl, 100â€“198, San Francisco, CA, 94108, United States', '37.7949162197593', '-122.40692907858735', '', '0.00', '0.00', 1, '', '', '', '', 0, '', '9013', 0, 0, 1, 1, '2019-02-01 18:22:58', '2019-02-01 17:35:42', '1549034578', ''),
(103, 103, '', 'MTIzNDU2Nzg=', 'jignesh@gmail.com', '9632580741', '', 'jignesh', 0, 0, '', '', '', '390 W El Camino Real, Sunnyvale, CA 94087ØŒ Ø§Ù„ÙˆÙ„Ø§ÙŠØ§Øª Ø§Ù„Ù…ØªØ­Ø¯Ø©', '37.3686609', '-122.0366205', '', '0.00', '4.73', 1, 'android', 'fFGWuNXkVfY:APA91bHFftKzL2G3v7sLRzkoemj7adzEXKZ6Sj6tqciEZjTmBmfH2XZe9tP5irqMwlmo6nwrESYyzeDQvZc8MGFmMAf8IN5Uj_-hEjS_LTqTF8OgBka3IGWb0R0-k9mXaXCzt3pU4iZj', '', '', 0, '', '', 0, 1, 1, 0, '2019-02-05 20:14:01', '2019-03-13 17:14:45', '1549386841', ''),
(104, 104, '', 'MTIzNDU2Nzg=', 'gooooggaa@gmail.com', '0535672477', '0535672477', 'wahaj', 0, 0, '', '', '', '21C Street, Aziziah, Ash Sharqiyah, 34718, Saudi Arabia', '26.213230027073894', '50.18743686802398', '', '0.00', '0.00', 1, '', '132094e8a15ddd6700a65f53e076b01008b036a08d20857dbf7cd022f8e6b98c', '', '', 0, '', '5927', 0, 0, 1, 0, '2019-02-07 14:13:15', '2019-02-07 11:14:49', '1549537995', ''),
(105, 105, '', 'MTIzNDU2Nzg=', 'nouta@gmail.com', '0505150967', '0505150967', 'noura', 0, 0, '', '', '', 'Al Kharj, Riyadh, 16256, Saudi Arabia', '24.15851019333711', '47.232674767713945', '', '0.00', '0.00', 1, '', '02d384f3bf26dd81e1a1301a80d868566194d80a0ee006b7400c95fa9368046c', '', '', 0, '', '3826', 0, 0, 1, 0, '2019-02-07 15:00:12', '2019-02-07 12:00:13', '1549540812', ''),
(106, 106, '', 'MTIzNDU2Nzg=', 'la@gmail.com', '0563355699', '0563355699', 'la', 0, 0, '', '', '', '5135, Al Dulum, Riyadh, 16252, Saudi Arabia', '24.18930494141885', '47.191630577874704', '', '0.00', '0.00', 1, '', '02d384f3bf26dd81e1a1301a80d868566194d80a0ee006b7400c95fa9368046c', '', '', 0, '', '6378', 0, 0, 1, 1, '2019-02-10 13:02:25', '2019-02-10 10:05:24', '1549792945', ''),
(107, 107, '', 'MTEzMzIyNTU0NA==', 'bintomar20@gmail.com', '0563355699', '0563355699', 'amal', 0, 0, '', '', '', '5135, Al Dulum, Riyadh, 16252, Saudi Arabia', '24.189797784478273', '47.1914951180855', '', '0.00', '0.00', 1, '', '02d384f3bf26dd81e1a1301a80d868566194d80a0ee006b7400c95fa9368046c', '', '', 0, '', '4114', 0, 0, 1, 1, '2019-02-10 13:05:44', '2019-03-19 07:52:49', '1549793144', ''),
(108, 11108, '', 'MTIxMjEyMTI=', 'hnhn@gh.com', '0595463453', '0595463453', 'Ø¹Ø¨Ø¯Ø§Ù„Ù„Ø·ÙŠÙ', 6, 166, 'Ù¦Ù¦', 'Ø¹', 'Ø¹', ' Ø¹ Ø¹ Ù¦Ù¦, Ø§Ù„Ù†Ù‡Ø¶Ø©, Ø§Ù„Ø®Ø¨Ø±', '', '', '', '0.00', '0.00', 1, 'android', 'dIO_KcPJo-Y:APA91bEIrpW0HOvnnY5bD8LhsAobG0iXJfGVP9SNm-OpPd91T_syle4h6uVNLtdWPs-uvWGrrb4_H6pA6YJc6dUYYiiR5xw9AfvW8r7XapKps_s2sb9eo6ACBM5qK1fYGplU6Mmxg_3Q', '', '', 0, '', '1351', 0, 0, 1, 0, '2019-02-10 13:15:35', '2019-02-10 10:16:40', '1549793735', ''),
(109, 3331109, '', 'MTIxMjEyMTI=', 'hshs@nd.com', '0590511113', '0590511113', 'salem', 3, 162, 'n', 'e', '', ' e n, Ø§Ù„Ø´Ù„Ø§Ù„, Ø§Ù„Ø®Ø±Ø¬', '', '', '', '0.00', '0.00', 1, 'android', 'dIO_KcPJo-Y:APA91bEIrpW0HOvnnY5bD8LhsAobG0iXJfGVP9SNm-OpPd91T_syle4h6uVNLtdWPs-uvWGrrb4_H6pA6YJc6dUYYiiR5xw9AfvW8r7XapKps_s2sb9eo6ACBM5qK1fYGplU6Mmxg_3Q', '', '', 0, '', '9912', 0, 0, 1, 0, '2019-02-17 23:23:34', '2019-02-17 20:23:36', '1550435014', ''),
(110, 110, '', 'MTIzNDU2Nzg=', 'samah_mawared@yahoo.com', '0532093637', '0532093637', 'Ø³Ù…Ø§Ø­', 0, 0, '', '', '', '3454ØŒ Ø§Ù„Ù‡ÙŠØ§Ø«Ù… 16257Â 6069ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '24.164588', '47.229497099999996', '', '0.00', '0.00', 1, 'android', 'ef4zCHoJS_E:APA91bEIIBMqqORdDLRcrB5_NhljNa9pOmo_p84CyNPDmJb5b8rGhk6gFImPixVaxSW2QVVIVBx7ctQvehUEeEDL71_KGXbb3jzOSXVZeaWpbEd5wHkvB0C8HerYfy_3xLlsKB9tqRoW', '', '', 0, '', '2089', 0, 0, 1, 1, '2019-03-12 14:38:43', '2019-03-13 09:32:28', '1552390723', ''),
(111, 111, '', 'UzU0NDk2NjFz', 'saloula1990@gmail.com', '0532093637', '0532093637', 'Ø³Ù…Ø§Ø­', 0, 0, '', '', '', '8130ØŒ Ø§Ù„Ù‡ÙŠØ§Ø«Ù… 16252Â 3220ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '24.189470099999998', '47.1914319', '', '0.00', '0.00', 1, 'android', 'ef4zCHoJS_E:APA91bEIIBMqqORdDLRcrB5_NhljNa9pOmo_p84CyNPDmJb5b8rGhk6gFImPixVaxSW2QVVIVBx7ctQvehUEeEDL71_KGXbb3jzOSXVZeaWpbEd5wHkvB0C8HerYfy_3xLlsKB9tqRoW', '', '', 0, '', '2213', 0, 0, 1, 1, '2019-03-13 12:32:40', '2019-03-13 09:32:48', '1552469560', ''),
(112, 112, '', 'MTIzNDU2Nzg=', 'taf.omar.3@gmail.com', '0551089631', '0551089631', 'Ù„Ø·ÙŠÙÙ‡', 0, 0, '', '', '', '17597ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '23.8308918', '43.155338900000004', '', '0.00', '0.00', 1, 'android', 'fh2CmR5cpiU:APA91bFB1vgdk9PFyAJ30sKqOXh9O3QVXIDL3pBnKsG-dB_xLOXGrS3tCaqhjP9ZSxAmNRhv87eAORuFbIIXI7BwVCcyNyqloFtAINvzdJDzkNme_qIDpXjKQfPLpAwQOsavoZSkhsVb', '', '', 0, '', '8909', 0, 0, 1, 1, '2019-03-19 09:50:09', '2019-03-19 07:52:35', '1552978209', ''),
(113, 113, '', 'MTIyMzMzNDQ0NA==', 'Latifa.omar.1992@gmail.com', '0563355699', '0563355699', 'Ù„Ø·ÙŠÙÙ‡', 0, 0, '', '', '', '8130ØŒ Ø§Ù„Ù‡ÙŠØ§Ø«Ù… 16252Â 3220ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '24.189470099999998', '47.1914319', '', '0.00', '0.00', 1, 'android', 'fh2CmR5cpiU:APA91bFB1vgdk9PFyAJ30sKqOXh9O3QVXIDL3pBnKsG-dB_xLOXGrS3tCaqhjP9ZSxAmNRhv87eAORuFbIIXI7BwVCcyNyqloFtAINvzdJDzkNme_qIDpXjKQfPLpAwQOsavoZSkhsVb', '', '', 0, '', '9264', 0, 0, 1, 0, '2019-03-19 11:10:52', '2019-03-19 08:10:53', '1552983052', ''),
(114, 114, '', 'YWFhYWFhYWFh', 'abooody-f-h@hotmail.com', '0531225225', '0531225225', 'Ø¹Ø¨Ø¯Ø§Ù„Ù„Ù‡', 0, 0, '', '', '', '8027ØŒ Ø­ÙŠ Ø§Ù„Ø±ÙŠØ§Ù†ØŒ Ø¬Ø¯Ø© 23741Â 2771ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '21.7090916', '39.2073628', '', '0.00', '0.00', 1, 'android', 'eKZIW773YLY:APA91bHFsioKOVS456nqcsTeL9_OpKPDL8HTr3jZorcAMpuTajqRcFHctJJEHxtW01JzJUEOqjd7sfwPiivCnyehXp-xT29vG_TaPZxv05WJsRZrCcnKTghN8XrEMzPRxojPX3cU9oGj', '', '', 0, '', '1532', 0, 0, 1, 0, '2019-03-28 16:03:06', '2019-03-29 04:36:22', '1553778186', ''),
(115, 115, '', 'YWFhYWFhYWFh', 'aboooxy-f-h-2017@hotmail.com', '0557942315', '0557942315', 'Ø¹Ø¨Ø¯Ø§Ù„Ù„Ù‡', 0, 0, '', '', '', '8027ØŒ Ø­ÙŠ Ø§Ù„Ø±ÙŠØ§Ù†ØŒ Ø¬Ø¯Ø© 23741Â 2771ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '21.7090916', '39.2073628', '', '0.00', '0.00', 1, 'android', 'eKZIW773YLY:APA91bHFsioKOVS456nqcsTeL9_OpKPDL8HTr3jZorcAMpuTajqRcFHctJJEHxtW01JzJUEOqjd7sfwPiivCnyehXp-xT29vG_TaPZxv05WJsRZrCcnKTghN8XrEMzPRxojPX3cU9oGj', '', '', 0, '', '2817', 0, 0, 1, 0, '2019-03-28 17:50:57', '2019-03-28 14:52:10', '1553784657', ''),
(116, 116, '', 'QWExMjMxMjM=', 'k_s_a.1990@hotmail.com', '0543199088', '0543199088', 'ABDULRAHMAN', 0, 0, '', '', '', '7185ØŒ Ø¨Ø·Ø­Ø§Ø¡ Ù‚Ø±ÙŠØ´ØŒ Ù…ÙƒØ© 24361Â 3977ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '21.3484673', '39.84111970000001', '', '0.00', '0.00', 1, 'android', 'dxfBCcYDnX8:APA91bHblDB3jS6A67L8bQlJPxmtClesPah_gZW4w5wQg0iGikf-PsBt8-TnSOVqJonGtLdJSOhz4_ZALmG-noxutJUac18a6BfR6AGm5Fph_WCX-Y0mv4YPa_RqnyhwH3K5qW6475S5', '', '', 0, '', '7616', 0, 0, 1, 0, '2019-04-12 02:23:14', '2019-04-11 23:25:55', '1555024994', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_times`
--

CREATE TABLE `tbl_delivery_times` (
  `timeId` int(11) NOT NULL,
  `startTime` varchar(20) NOT NULL,
  `endTime` varchar(20) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(200) NOT NULL,
  `modifiedTimestamp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_delivery_times`
--

INSERT INTO `tbl_delivery_times` (`timeId`, `startTime`, `endTime`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, '9am', '10pm', 1, 0, '', ''),
(2, '10am', '11am', 1, 0, '', ''),
(3, '11am', '12pm', 1, 0, '', ''),
(4, '12pm', '1pm', 1, 0, '', ''),
(5, '3pm', '4pm', 1, 0, '', ''),
(6, '4pm', '5pm', 1, 0, '', ''),
(7, '5pm', '6pm', 1, 0, '', ''),
(8, '6pm', '7pm', 1, 0, '', ''),
(9, '7pm', '8pm', 1, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_districts`
--

CREATE TABLE `tbl_districts` (
  `districtId` int(11) NOT NULL,
  `districtCode` varchar(20) NOT NULL,
  `districtName` varchar(200) CHARACTER SET utf8 NOT NULL,
  `deliveryFee` varchar(20) NOT NULL DEFAULT '0.00',
  `cityId` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(200) NOT NULL,
  `modifiedTimestamp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_districts`
--

INSERT INTO `tbl_districts` (`districtId`, `districtCode`, `districtName`, `deliveryFee`, `cityId`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, '100', 'Ø§Ù„Ù‚ÙŠØ±ÙˆØ§Ù†', '9', 3, 1, 1, '1455538067', ''),
(2, '100', 'Ø§Ù„Ù†Ø±Ø¬Ø³', '9', 3, 1, 1, '1455082329', ''),
(3, '100', 'Ø§Ù„ØµØ­Ø§ÙØ©', '9', 3, 1, 1, '1455082363', ''),
(4, '100', 'Ø§Ù„Ù…Ù„Ù‚Ø§', '9', 3, 1, 1, '1455082372', ''),
(5, '100', 'Ø¬Ø§Ù…Ø¹Ø© Ø§Ù„Ø§Ù…Ø§Ù…', '9', 3, 1, 1, '1455082386', ''),
(6, '100', 'Ø§Ù„Ù†Ø¯Ù‰', '9', 3, 1, 1, '1455082395', ''),
(7, '100', 'Ø§Ù„ÙŠØ§Ø³Ù…ÙŠÙ†', '9', 3, 1, 1, '1455082404', ''),
(8, '100', 'Ø§Ù„Ø±Ø¨ÙŠØ¹', '9', 3, 1, 1, '1455082414', ''),
(9, '100', 'Ø§Ù„Ø¹Ù‚ÙŠÙ‚', '9', 3, 1, 1, '1455082422', ''),
(10, '100', 'Ø­Ø·ÙŠÙ†', '9', 3, 1, 1, '1455082435', ''),
(11, '100', 'Ø§Ù„ÙÙ„Ø§Ø­', '9', 3, 1, 1, '1455082445', ''),
(12, '100', 'Ø§Ù„ÙˆØ§Ø¯ÙŠ', '9', 3, 1, 1, '1455082453', ''),
(13, '100', 'Ø§Ù„Ù†ÙÙ„', '9', 3, 1, 1, '1455082463', ''),
(14, '100', 'Ø§Ù„ØºØ¯ÙŠØ±', '9', 3, 1, 1, '1455082471', ''),
(15, '100', 'Ø§Ù„Ø¯Ø±Ø¹ÙŠØ©', '9', 3, 1, 1, '1455082481', ''),
(16, '100', 'Ø§Ù„Ø¯Ø±Ø¹ÙŠØ© Ø§Ù„Ø¬Ø¯ÙŠØ¯Ø©', '9', 3, 1, 1, '1455082491', ''),
(17, '200', 'Ø§Ù„Ø§Ø²Ø¯Ù‡Ø§Ø±', '9', 3, 1, 1, '1455082500', ''),
(18, '200', 'Ø§Ù„ØªØ¹Ø§ÙˆÙ†', '9', 3, 1, 1, '1455082515', ''),
(19, '200', 'Ø§Ù„Ù…ØµÙŠÙ', '9', 3, 1, 1, '1455082525', ''),
(20, '200', 'Ø§Ù„Ù…Ø±ÙˆØ¬', '9', 3, 1, 1, '1455082533', ''),
(21, '200', 'Ø§Ù„Ù†Ø®ÙŠÙ„', '9', 3, 1, 1, '1457700046', ''),
(22, '200', 'Ø§Ù„Ù…ØºØ±Ø²Ø§Øª', '9', 3, 1, 1, '1455082552', ''),
(23, '200', 'Ø§Ù„Ù†Ø²Ù‡Ù‡', '9', 3, 1, 1, '1455082560', ''),
(24, '200', 'Ø§Ù„Ù…Ø±Ø³Ù„Ø§Øª', '9', 3, 1, 1, '1455082568', ''),
(25, '200', 'Ø§Ù„Ù…Ù„Ùƒ ÙÙ‡Ø¯', '9', 3, 1, 1, '1455082582', ''),
(26, '200', 'Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ©', '9', 3, 1, 1, '1455082591', ''),
(27, '200', 'Ø¬Ø§Ù…Ø¹Ø© Ø§Ù„Ù…Ù„Ùƒ Ø³Ø¹ÙˆØ¯', '9', 3, 1, 1, '1455082601', ''),
(28, '200', 'ØµÙ„Ø§Ø­ Ø§Ù„Ø¯ÙŠÙ†', '9', 3, 1, 1, '1455082613', ''),
(29, '200', 'Ø§Ù„ÙˆØ§Ø­Ø©', '9', 3, 1, 1, '1455082622', ''),
(30, '200', 'Ø§Ù„ÙˆØ±ÙˆØ¯', '9', 3, 1, 1, '1455082632', ''),
(31, '200', 'Ø§Ù„Ù…Ù„Ùƒ Ø¹Ø¨Ø¯Ø§Ù„Ù„Ù‡', '9', 3, 1, 1, '1455082640', ''),
(32, '200', 'Ø§Ù„Ù…Ù„Ùƒ Ø¹Ø¨Ø¯Ø§Ù„Ø¹Ø²ÙŠØ²', '9', 3, 1, 1, '1455082652', ''),
(33, '200', 'Ø§Ù„Ø³Ù„ÙŠÙ…Ø§Ù†ÙŠØ©', '9', 3, 1, 1, '1455082661', ''),
(34, '200', 'Ø§Ù„Ø¹Ù„ÙŠØ§', '9', 3, 1, 1, '1455082669', ''),
(35, '200', 'Ø§Ù„Ù…Ø¤ØªÙ…Ø±Ø§Øª', '9', 3, 1, 1, '1455082678', ''),
(36, '500', 'Ù‚Ø±Ø·Ø¨Ø©', '9', 3, 1, 1, '1457701544', ''),
(37, '500', 'ØºØ±Ù†Ø§Ø·Ø©', '9', 3, 1, 1, '1457701568', ''),
(39, '500', 'Ø§Ù„Ø­Ù…Ø±Ø§Ø¡', '9', 3, 1, 1, '1457702360', ''),
(40, '500', 'Ø§Ù„Ù‚Ø¯Ø³', '9', 3, 1, 1, '1457701621', ''),
(41, '500', 'Ø§Ù„Ø±ÙˆØ¶Ù‡', '9', 3, 1, 1, '1457701821', ''),
(42, '300', 'Ø­ÙŠ Ø§Ù„Ù…Ù„Ùƒ ÙÙŠØµÙ„ ', '9', 3, 1, 1, '1455082733', ''),
(43, '500', 'Ø§Ù„ÙŠØ±Ù…ÙˆÙƒ', '9', 3, 1, 1, '1457701783', ''),
(44, '300', 'Ø§Ù„Ù…ÙˆÙ†Ø³ÙŠÙ‡', '9', 3, 1, 1, '1455082751', ''),
(45, '300', 'Ø§Ù„Ù†Ù‡Ø¶Ù‡', '9', 3, 1, 1, '1455082761', ''),
(46, '300', 'Ø§Ù„Ø®Ø§Ù„Ø¯ÙŠØ©', '9', 3, 1, 1, '1457700006', ''),
(47, '400', 'Ø§Ù„Ø®Ø²Ø§Ù…Ù‰', '9', 3, 1, 1, '1455082792', ''),
(48, '400', 'Ø¹Ø±Ù‚Ø©', '9', 3, 1, 1, '1455082800', ''),
(49, '400', 'Ø§Ù„Ø³ÙØ§Ø±Ø§Øª', '9', 3, 1, 1, '1455082808', ''),
(50, '400', 'Ø§Ù„Ø±Ø§Ø¦Ø¯', '9', 3, 1, 1, '1455082818', ''),
(51, '400', 'Ø§Ù„Ù…Ø¹Ø°Ø± Ø§Ù„Ø´Ù…Ø§Ù„ÙŠ ', '9', 2, 1, 1, '1455082833', ''),
(52, '400', 'Ø§Ù„Ø±Ø­Ù…Ø§Ù†ÙŠØ©', '9', 2, 1, 1, '1455082841', ''),
(53, '400', 'Ø§Ù… Ø§Ù„Ø­Ù…Ø§Ù… Ø§Ù„ØºØ±Ø¨ÙŠ', '9', 2, 1, 1, '1455082853', ''),
(54, '400', 'Ø§Ù… Ø§Ù„Ø­Ù…Ø§Ù… Ø§Ù„Ø´Ø±Ù‚ÙŠ', '9', 2, 1, 1, '1455082864', ''),
(55, '400', 'Ø§Ù„Ù…Ø¹Ø°Ø±', '9', 2, 1, 1, '1455082872', ''),
(56, '400', 'Ø§Ù„Ù‡Ø¯Ø§', '9', 2, 1, 1, '1455082880', ''),
(57, '400', 'Ø§Ù„Ø´Ø±Ù‚ÙŠØ©', '9', 2, 1, 1, '1455082888', ''),
(58, '400', 'Ø¸Ù‡Ø±Ø© Ù„Ø¨Ù†', '9', 2, 1, 1, '1455082897', ''),
(59, '400', 'Ù‡Ø¬Ø±Ø© Ù„Ø¨Ù†', '9', 2, 1, 1, '1455082907', ''),
(60, '400', 'Ù…Ù†ÙÙˆØ­Ø©', '9', 2, 1, 1, '1455082915', ''),
(61, '400', 'Ø§Ù„ÙŠÙ…Ø§Ù…Ø©', '9', 2, 1, 1, '1455082923', ''),
(62, '400', 'Ø³Ù„Ø·Ø§Ù†Ø©', '9', 2, 1, 1, '1455082930', ''),
(63, '400', 'Ø§Ù„Ø¨Ø¯ÙŠØ¹Ø©', '9', 2, 1, 1, '1455082939', ''),
(64, '400', 'Ø§Ù„Ø±ÙÙŠØ¹Ø©', '9', 2, 1, 1, '1455082948', ''),
(65, '400', 'Ø§Ù„Ù†Ø§ØµØ±ÙŠØ©', '9', 2, 1, 1, '1455082956', ''),
(66, '400', 'Ø§Ù„Ø´Ù…ÙŠØ³ÙŠ', '9', 2, 1, 1, '1455082964', ''),
(67, '400', 'Ù…Ù†ÙÙˆØ­Ø© Ø§Ù„Ø¬Ø¯ÙŠØ¯Ø©', '9', 2, 1, 1, '1455082973', ''),
(68, '400', 'Ø§Ù„ÙˆØ²Ø§Ø±Ø§Øª', '9', 2, 1, 1, '1455082981', ''),
(69, '400', 'Ø§Ù„Ø¯ÙˆØ­Ø©', '9', 2, 1, 1, '1455082988', ''),
(70, '400', 'Ø§Ù„Ø¹ÙˆØ¯', '9', 2, 1, 1, '1455082996', ''),
(71, '400', 'Ø§Ù„Ø¬Ø±Ø§Ø¯ÙŠØ©', '9', 2, 1, 1, '1455083004', ''),
(72, '400', 'Ø§Ù„Ø¨Ø·ÙŠØ­Ø§', '9', 2, 1, 1, '1455083013', ''),
(73, '400', 'Ø§Ù„Ø¶Ø¨Ø§Ø·', '9', 2, 1, 1, '1455083022', ''),
(74, '400', 'Ø§Ù„Ù…Ø±Ø¨Ø¹', '9', 2, 1, 1, '1455083031', ''),
(75, '400', 'Ø§Ù„Ù†Ù…ÙˆØ°Ø¬ÙŠØ©', '9', 2, 1, 1, '1455083040', ''),
(76, '400', 'Ø§Ù„Ø¯ÙŠØ±Ø©', '9', 2, 1, 1, '1455083049', ''),
(77, '400', 'Ø¹Ù„ÙŠØ´Ø©', '9', 2, 1, 1, '1457699984', ''),
(78, '400', 'Ø§Ù„ÙˆØ´Ø§Ù…', '9', 2, 1, 1, '1455083069', ''),
(79, '400', 'ØµÙŠØ§Ø­', '9', 2, 1, 1, '1455083078', ''),
(80, '400', 'Ø§Ù… Ø³Ù„ÙŠÙ…', '9', 2, 1, 1, '1455083087', ''),
(81, '400', 'Ø§Ù„ÙØ§Ø®Ø±ÙŠØ©', '9', 2, 1, 1, '1455083097', ''),
(82, '600', 'Ø¸Ù‡Ø±Ø© Ø§Ù„Ø¨Ø¯ÙŠØ¹Ø© ', '9', 2, 1, 1, '1455083108', ''),
(83, '600', 'Ø§Ù„Ø¹Ø±ÙŠØ¬Ø§Ø¡', '9', 2, 1, 1, '1455083117', ''),
(84, '600', 'Ø§Ù„Ø¹Ø±ÙŠØ¬Ø§Ø¡ Ø§Ù„ÙˆØ³Ø·Ù‰', '9', 2, 1, 1, '1455083128', ''),
(85, '600', 'Ø§Ù„Ø¹Ø±ÙŠØ¬Ø§Ø¡ Ø§Ù„ØºØ±Ø¨ÙŠØ©', '9', 2, 1, 1, '1455083138', ''),
(86, '600', 'Ø§Ù„Ø³ÙˆÙŠØ¯ÙŠ', '9', 2, 1, 1, '1455083145', ''),
(87, '600', 'Ø§Ù„Ø³ÙˆÙŠØ¯ÙŠ Ø§Ù„ØºØ±Ø¨ÙŠ', '9', 2, 1, 1, '1455083156', ''),
(88, '600', 'Ø´Ø¨Ø±Ø§', '9', 2, 1, 1, '1455083165', ''),
(89, '600', 'Ù†Ù…Ø§Ø±', '9', 2, 1, 1, '1455083175', ''),
(90, '600', 'Ø§Ù„Ø­Ø±Ø§Ù…', '9', 2, 1, 1, '1455083183', ''),
(91, '600', 'Ø¸Ù‡Ø±Ø© Ù†Ù…Ø§Ø±', '9', 2, 1, 1, '1455083192', ''),
(92, '600', 'Ø·ÙˆÙŠÙ‚', '9', 2, 1, 1, '1455083199', ''),
(93, '600', 'Ø§Ù„Ø­Ø²Ù…', '9', 2, 1, 1, '1505122796', ''),
(94, '600', 'Ø¯ÙŠØ±Ø§Ø¨', '9', 2, 1, 1, '1455083215', ''),
(95, '700', 'Ø§Ù„Ø±Ø¨ÙˆØ© ', '9', 2, 1, 1, '1455083224', ''),
(96, '700', 'Ø¬Ø±ÙŠØ±', '9', 2, 1, 1, '1455083234', ''),
(97, '700', 'Ø§Ù„Ù…Ø±Ù‚Ø¨', '9', 2, 1, 1, '1455083243', ''),
(98, '700', 'Ø§Ù„Ø¹Ù…Ù„', '9', 2, 1, 1, '1455083251', ''),
(99, '700', 'Ø«Ù„ÙŠÙ…', '9', 2, 1, 1, '1455083259', ''),
(100, '700', 'Ø¬Ø¨Ø±Ø©', '9', 2, 1, 1, '1455083269', ''),
(101, '700', 'ØºØ¨ÙŠØ±Ø§Ø¡', '9', 1, 1, 1, '1455298488', ''),
(102, '700', 'Ø§Ù„ÙŠÙ…Ø§Ù…Ø©', '9', 1, 1, 1, '1455083289', ''),
(103, '700', 'Ø¹ØªÙŠÙ‚Ø©', '9', 1, 1, 1, '1455083296', ''),
(106, '700', 'Ø§Ù„ÙÙˆØ·Ø©', '9', 1, 1, 1, '1455083323', ''),
(107, '700', 'Ø§Ù„Ù…Ù„Ø²', '9', 1, 1, 1, '1455083332', ''),
(108, '700', 'Ø§Ù„ØµÙØ§', '9', 1, 1, 1, '1455083339', ''),
(109, '700', 'Ø§Ù„ÙØ§Ø±ÙˆÙ‚', '9', 1, 1, 1, '1455083349', ''),
(110, '800', 'Ø§Ù„Ø³Ù„ÙŠ', '9', 1, 1, 1, '1455083359', ''),
(111, '800', 'Ø§Ù„Ù†ÙˆØ±', '9', 1, 1, 1, '1455083368', ''),
(112, '800', 'Ø§Ù„Ø¬Ø²ÙŠØ±Ø©', '9', 1, 1, 1, '1455083376', ''),
(113, '800', 'Ø§Ù„ÙÙŠØ­Ø§Ø¡', '9', 1, 1, 1, '1455083388', ''),
(114, '800', 'Ø§Ù„Ø³Ø¹Ø§Ø¯Ø©', '9', 1, 1, 1, '1455083397', ''),
(115, '800', 'Ø®Ø´Ù… Ø§Ù„Ø¹Ø§Ù† ', '9', 1, 1, 1, '1455083407', ''),
(116, '800', 'Ø§Ù„Ø±ÙˆØ§Ø¨ÙŠ', '9', 1, 1, 1, '1455083415', ''),
(117, '800', 'Ø§Ù„Ø³Ù„Ø§Ù…', '9', 1, 1, 1, '1455083422', ''),
(118, '800', 'Ø§Ù„Ù†Ø³ÙŠÙ… Ø§Ù„ØºØ±Ø¨ÙŠ', '9', 1, 1, 1, '1455083450', ''),
(119, '800', 'Ø§Ù„Ù†Ø³ÙŠÙ… Ø§Ù„Ø´Ø±Ù‚ÙŠ', '9', 1, 1, 1, '1455083460', ''),
(122, '800', 'Ø§Ù„Ø±ÙŠØ§Ù†', '9', 1, 1, 1, '1457699964', ''),
(123, '800', 'Ø§Ù„Ù†Ø¸ÙŠÙ…', '9', 1, 1, 1, '1455083491', ''),
(124, '800', 'Ø§Ù„Ø±Ù…Ø§ÙŠØ©', '9', 1, 1, 1, '1455083501', ''),
(125, '900', 'Ø§Ù„Ù…ØµØ§Ù†Ø¹', '9', 1, 1, 1, '1455083515', ''),
(126, '900', 'Ø§Ù„Ø´ÙØ§', '9', 1, 1, 1, '1455083524', ''),
(127, '900', 'Ø§Ù„Ù…Ø±ÙˆÙ‡', '9', 1, 1, 1, '1455083532', ''),
(128, '900', 'Ø¨Ø¯Ø±', '9', 1, 1, 1, '1455083542', ''),
(129, '900', 'Ø¹ÙƒØ§Ø¸', '9', 1, 1, 1, '1455083549', ''),
(130, '900', 'Ø§Ø­Ø¯', '9', 1, 1, 1, '1455083560', ''),
(131, '900', 'Ø§Ù„Ø¹Ø±ÙŠØ¶', '9', 1, 1, 1, '1455083568', ''),
(132, '900', 'Ø§Ù„Ø­Ø§ÙŠØ±', '9', 1, 1, 1, '1455083577', ''),
(133, '110', 'Ø·ÙŠØ¨Ø©', '9', 1, 1, 1, '1455083588', ''),
(134, '110', 'Ø§Ù„Ù…ØµÙØ§Ø©', '9', 1, 1, 1, '1455083596', ''),
(135, '110', 'Ø§Ù„Ø¯Ø§Ø± Ø§Ù„Ø¨ÙŠØ¶Ø§Ø¡', '9', 1, 1, 1, '1455083603', ''),
(136, '110', 'Ø§Ù„Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„ØµÙ†Ø§Ø¹ÙŠØ© Ø§Ù„Ø¬Ø¯ÙŠØ¯Ø© ', '9', 1, 1, 1, '1455083611', ''),
(137, '110', 'Ø§Ù„Ø§Ø³ÙƒØ§Ù†', '9', 1, 1, 1, '1455083621', ''),
(138, '110', 'Ø­ÙŠ Ø§Ù„Ø¯ÙØ§Ø¹', '9', 1, 1, 1, '1455083630', ''),
(139, '110', 'Ø§Ù„Ù…Ù†Ø§Ø®', '9', 1, 1, 1, '1455083638', ''),
(140, '110', 'Ø§Ù„Ø¹Ø²ÙŠØ²ÙŠØ©', '9', 1, 1, 1, '1455083647', ''),
(141, '110', 'Ø§Ù„Ù…Ù†ØµÙˆØ±Ø©', '9', 1, 1, 1, '1455083655', ''),
(142, '110', 'Ø§Ù„ÙÙŠØµÙ„ÙŠØ©', '9', 1, 1, 1, '1455083662', ''),
(143, '110', 'Ù‡ÙŠØª', '9', 1, 1, 1, '1455083671', ''),
(149, '500', 'Ø¨Ù†Ø¨Ø§Ù†', '9', 1, 1, 1, '1457701963', ''),
(150, '500', 'Ø§Ù„Ø±Ù…Ø§Ù„', '9', 1, 1, 1, '1457702121', ''),
(151, '500', 'Ø§Ù„Ù…Ù„Ùƒ ÙÙŠØµÙ„', '9', 1, 1, 1, '1457702587', ''),
(152, '500', 'Ø§Ù„Ø®Ù„ÙŠØ¬', '9', 1, 1, 1, '1457702606', ''),
(153, '500', 'Ø§Ø´Ø¨ÙŠÙ„ÙŠØ©', '9', 1, 1, 1, '1457702638', ''),
(154, '100', 'Ø§Ù„Ø¹Ø§Ø±Ø¶', '9', 1, 1, 1, '1457702958', ''),
(155, '100', 'Ø§Ù„Ø§Ù…Ø§Ù†Ø©', '9', 1, 1, 1, '1457703592', ''),
(157, '900', 'Ø§Ù„ÙÙˆØ§Ø²', '9', 1, 1, 1, '1463519700', ''),
(158, '400', 'Ø§Ù„Ø´Ø±ÙÙŠØ©', '9', 1, 1, 1, '1463519728', ''),
(159, '001', 'Ø§Ù„Ù‡ÙŠØ§Ø«Ù…', '0.00', 3, 1, 1, '1544612866', ''),
(160, '60', 'Ø§Ù„Ø¨Ø±Ø¬ Ø§Ù„Ø®Ø±Ø¬', '0.00', 3, 1, 1, '1547365724', ''),
(161, '1', 'Ø§Ù„Ø´Ø§Ø·Ø¦', '0.00', 1, 1, 0, '1548234899', ''),
(162, '1', 'Ø§Ù„Ø´Ù„Ø§Ù„', '0.00', 1, 1, 0, '1548234921', ''),
(163, '1', 'Ø·ÙŠØ¨Ø©', '0.00', 1, 1, 0, '1548234967', ''),
(164, '1', 'Ø§Ù„Ø­Ù…Ø±Ø§Ø¡', '0.00', 1, 1, 0, '1548235042', ''),
(165, '1', 'Ø§Ù„Ø³ÙŠÙ', '0.00', 1, 1, 0, '1548235070', ''),
(166, '1', 'Ø§Ù„Ù†Ù‡Ø¶Ø©', '0.00', 1, 1, 0, '1548235277', ''),
(167, '1', 'Ø§Ù„Ø¯ÙŠØ±Ø©', '0.00', 1, 1, 0, '1548235303', ''),
(168, '1', 'Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ©', '0.00', 1, 1, 0, '1548235333', ''),
(169, '1', 'Ø§Ù„Ø¹Ø²ÙŠØ²ÙŠØ©', '0.00', 1, 1, 0, '1548235363', ''),
(170, '1', 'Ø§Ù„Ø¬Ø§Ù…Ø¹ÙŠÙ†', '0.00', 1, 1, 0, '1548235386', ''),
(171, '1', 'Ø§Ù„Ù†Ø§ØµØ±ÙŠØ©', '0.00', 1, 1, 0, '1548235419', ''),
(172, '1', 'Ø§Ù„Ø¨Ø³Ø§ØªÙŠÙ†', '0.00', 1, 1, 0, '1548235444', ''),
(173, '1', 'Ø§Ù„Ø±ÙˆØ§Ø¨ÙŠ', '0.00', 6, 1, 0, '1548237370', ''),
(174, '1', 'Ø¶Ø§Ø­ÙŠØ© Ø§Ù„Ù…Ù„Ùƒ ÙÙ‡Ø¯', '0.00', 1, 1, 0, '1548235507', ''),
(175, '1', 'Ø§Ù„Ø£ØªØµØ§Ù„Ø§Øª', '0.00', 1, 1, 0, '1548235529', ''),
(176, '1', 'Ø§Ù„Ø²Ù‡ÙˆØ±', '0.00', 1, 1, 0, '1548235567', ''),
(177, '1', 'Ø§Ù„Ù†Ø±Ø¬Ø³', '0.00', 1, 1, 0, '1548235589', ''),
(178, '1', 'Ø§Ù„Ø±Ø­Ø§Ø¨', '0.00', 1, 1, 0, '1548235621', ''),
(179, '1', 'Ø§Ù„Ø¹Ø¯Ø§Ù…Ø©', '0.00', 1, 1, 0, '1548235674', ''),
(180, '1', 'Ø§Ù„Ø´ÙØ§Ø¡', '0.00', 1, 1, 0, '1548235701', ''),
(181, '1', 'Ø§Ù„Ù†ÙˆØ±', '0.00', 1, 1, 0, '1548236178', ''),
(182, '1', 'Ø§Ù„ÙÙŠØµÙ„ÙŠØ©', '0.00', 1, 1, 0, '1548236213', ''),
(183, '1', 'Ø§Ù„Ù‚Ø¯Ø³', '0.00', 1, 1, 0, '1548236369', ''),
(184, '1', 'Ø§Ù„Ø«Ù‚Ø¨Ø©', '0.00', 1, 1, 0, '1548236647', ''),
(185, '9', 'ØªØ§Ø±ÙˆØª', '0.00', 8, 1, 0, '1548236779', ''),
(186, '9', 'Ø§Ù„Ø£ÙˆØ¬Ø§Ù…', '0.00', 8, 1, 0, '1548236843', ''),
(187, '1', 'Ø¹Ù†Ùƒ', '0.00', 8, 1, 0, '1548236866', ''),
(188, '1', 'Ø³ÙŠÙ‡Ø§Øª', '0.00', 8, 1, 0, '1548236898', ''),
(189, '9', 'ØµÙÙˆÙ‰', '0.00', 8, 1, 0, '1548236928', ''),
(190, '82', 'Ø§Ù„Ø«Ù‚Ø¨Ø© Ø§Ù„Ø®Ø¨Ø±', '0.00', 6, 1, 0, '1548237147', ''),
(191, '8', 'Ø§Ù„Ø®Ø¨Ø± Ø§Ù„Ø´Ù…Ø§Ù„ÙŠØ©', '0.00', 6, 1, 0, '1548237190', ''),
(192, '7', 'Ø§Ù„Ø±Ø§ÙƒØ©', '0.00', 6, 1, 0, '1548237281', ''),
(193, '7', 'Ø§Ù„ÙŠØ±Ù…ÙˆÙƒ', '0.00', 6, 1, 0, '1548237487', ''),
(194, '7', 'Ø§Ù„Ø¹Ù‚Ø±Ø¨ÙŠØ©', '0.00', 6, 1, 0, '1548237635', ''),
(195, '7', 'Ø§Ù„Ø®Ø¨Ø± Ø§Ù„Ø¬Ù†ÙˆØ¨ÙŠØ©', '0.00', 6, 1, 0, '1548237797', ''),
(196, '7', 'Ø§Ù„Ù‡Ø¯Ø§', '0.00', 6, 1, 0, '1548237847', ''),
(197, '7', 'Ø§Ù„Ø¨Ù†Ø¯Ø±ÙŠØ©', '0.00', 6, 1, 0, '1548237907', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers`
--

CREATE TABLE `tbl_drivers` (
  `driverId` bigint(20) NOT NULL,
  `driverName` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `CookieId` varchar(100) NOT NULL,
  `deviceType` varchar(250) NOT NULL,
  `deviceToken` varchar(5000) NOT NULL,
  `passResetToken` varchar(300) NOT NULL,
  `timezone` varchar(50) NOT NULL,
  `badge` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_drivers`
--

INSERT INTO `tbl_drivers` (`driverId`, `driverName`, `username`, `password`, `email`, `phone`, `CookieId`, `deviceType`, `deviceToken`, `passResetToken`, `timezone`, `badge`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, 'Seven Start', 'sevenstar_driver', 'c2V2ZW5AMTIz', 'anask@sevenstarinfotech.com', '9537714362', '', '', '', '', '', 0, 1, 0, '1458308167', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers_log`
--

CREATE TABLE `tbl_drivers_log` (
  `id` bigint(20) NOT NULL,
  `driverId` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorites`
--

CREATE TABLE `tbl_favorites` (
  `favoriteId` bigint(20) NOT NULL,
  `prdId` bigint(20) NOT NULL,
  `custId` bigint(20) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notId` bigint(20) NOT NULL,
  `notText` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `notTypeId` int(11) NOT NULL,
  `createdTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`notId`, `notText`, `notTypeId`, `createdTimestamp`) VALUES
(1, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 111700671', 15, '1547809020'),
(2, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007211', 15, '1547978904'),
(3, 'ØªÙ… ØªØ³Ù„ÙŠÙ… Ø·Ù„Ø¨Ùƒ 3331007211', 15, '1547979126'),
(4, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007216', 15, '1548059358'),
(5, 'ØªÙ… ØªØ³Ù„ÙŠÙ… Ø·Ù„Ø¨Ùƒ 3331007216', 15, '1548059431'),
(6, ' Ù†Ø¹ØªØ°Ø± Ø£Ù‚Ù„ ÙƒÙ…ÙŠØ© Ù„Ù„Ø·Ù„Ø¨ 10 ÙƒØ±Ø§ØªÙŠÙ† :Ø³Ø¨Ø¨ .3331007223 ØªÙ… Ø¥Ù„ØºØ§Ø¡ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù…', 15, '1548230189'),
(7, ' Ù†Ø¹ØªØ°Ø± Ø£Ù‚Ù„ ÙƒÙ…ÙŠØ© Ù„Ù„Ø·Ù„Ø¨ 10 ÙƒØ±Ø§ØªÙŠÙ† :Ø³Ø¨Ø¨ .3331007223 ØªÙ… Ø¥Ù„ØºØ§Ø¡ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù…', 15, '1548230197'),
(8, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007222', 15, '1548230571'),
(9, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007224', 15, '1548233294'),
(10, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 333100723', 15, '1549793698'),
(11, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007212', 15, '1552474105'),
(12, 'ØªÙ… ØªØ³Ù„ÙŠÙ… Ø·Ù„Ø¨Ùƒ 3331007212', 15, '1552474165'),
(13, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007214', 15, '1552474868'),
(14, 'ØªÙ… ØªØ£ÙƒÙŠØ¯ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù… 3331007213', 15, '1552474879'),
(15, 'ØªÙ… ØªØ³Ù„ÙŠÙ… Ø·Ù„Ø¨Ùƒ 3331007213', 15, '1552474922'),
(16, 'ØµØ±Ù Ø§Ù„Ù†Ø¸Ø±  :Ø³Ø¨Ø¨ .3331007216 ØªÙ… Ø¥Ù„ØºØ§Ø¡ Ø·Ù„Ø¨Ùƒ Ø±Ù‚Ù…', 15, '1552475058');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_history`
--

CREATE TABLE `tbl_notification_history` (
  `id` bigint(20) NOT NULL,
  `custId` bigint(20) NOT NULL,
  `notId` bigint(20) NOT NULL,
  `sendTime` varchar(50) DEFAULT NULL,
  `readTime` varchar(50) NOT NULL,
  `createdTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification_history`
--

INSERT INTO `tbl_notification_history` (`id`, `custId`, `notId`, `sendTime`, `readTime`, `createdTimestamp`) VALUES
(1, 33310072, 10, '1549793698', '1552476518', '1549793698'),
(2, 33310072, 11, '1552474105', '1552476518', '1552474105'),
(3, 33310072, 12, '1552474165', '1552476518', '1552474165'),
(4, 33310072, 13, '1552474868', '1552476518', '1552474868'),
(5, 33310072, 14, '1552474879', '1552476518', '1552474879'),
(6, 33310072, 15, '1552474922', '1552476518', '1552474922'),
(7, 33310072, 16, '1552475058', '1552476518', '1552475058');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_types`
--

CREATE TABLE `tbl_notification_types` (
  `notTypeId` int(11) NOT NULL,
  `notTypeTitle` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `notTypeApp` varchar(300) NOT NULL,
  `notTypeIcon` varchar(300) NOT NULL,
  `isVisible` int(11) NOT NULL DEFAULT '1',
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification_types`
--

INSERT INTO `tbl_notification_types` (`notTypeId`, `notTypeTitle`, `notTypeApp`, `notTypeIcon`, `isVisible`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(15, 'Order', 'Order', 'delivery-ICON14853420751493457586.png', 0, 1, 0, '1493465544', ''),
(23, 'delay', '%10 off next dewlivery', 'GxZiH1536648119.png', 1, 1, 0, '1536648119', '1537952134'),
(24, 'Ø®ØµÙ…', 'Ø¹Ø±Ø¶ Ø§Ù„ÙŠÙˆÙ… Ø§Ù„ÙˆØ·Ù†ÙŠ', 'Ø´Ø¹Ø§Ø±-Ù‚Ø·Ø§Ù.bmp', 1, 1, 0, '1537952054', ''),
(25, 'TEST', 'TEST', '', 1, 1, 1, '1539773862', ''),
(26, 'Ø®ØµÙ… Ø§Ù„Ø¹ÙŠØ¯', 'Ø§Ø§', '51544699096.jpg', 1, 1, 0, '1544699102', ''),
(27, 'free delivery', 'discount', '', 1, 1, 1, '1544984174', ''),
(28, 'amal', 'Ø¹Ù†Ø¯ Ø´Ø±Ø§Ø¦Ùƒ 3 ÙƒØ±Ø§ØªÙŠÙ† Ø§Ø­ØµÙ„ Ø¹Ù„Ù‰ ÙƒØ±ØªÙˆÙ† Ù…Ø¬Ø§Ù†Ø§Ù‹', '', 1, 1, 0, '1547364084', ''),
(29, 'free', 'Ø®ØµÙ… ÙŠÙˆÙ… Ø§Ù„ÙˆØ·Ù†ÙŠ', '', 1, 1, 0, '1547365543', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operators`
--

CREATE TABLE `tbl_operators` (
  `operatorId` bigint(20) NOT NULL,
  `operatorName` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `CookieId` varchar(100) NOT NULL,
  `deviceType` varchar(250) NOT NULL,
  `deviceToken` varchar(5000) NOT NULL,
  `passResetToken` varchar(300) NOT NULL,
  `timezone` varchar(50) NOT NULL,
  `badge` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_operators`
--

INSERT INTO `tbl_operators` (`operatorId`, `operatorName`, `username`, `password`, `email`, `phone`, `CookieId`, `deviceType`, `deviceToken`, `passResetToken`, `timezone`, `badge`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, 'areeb', 'areebh', 'YXJlZWI=', 'areeb@com.com', '05554040', '7167b5cc5191c271fdeb714889fa8eb4', '', '', '', '', 0, 1, 0, '1458315660', '1458334116'),
(2, 'hajar', 'hajara', 'aGFqYXI=', 'mrs.alsuhaimi@gmail.com', '00966590782196', '', '', '', '', '', 0, 1, 0, '1458334255', '1477826120');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `orderId` int(11) NOT NULL,
  `invoiceNo` varchar(20) DEFAULT NULL,
  `custId` varchar(20) NOT NULL,
  `orderType` enum('regular','charity') NOT NULL DEFAULT 'regular',
  `charityName` varchar(255) NOT NULL,
  `recipientName` varchar(255) NOT NULL,
  `charityPhone` varchar(20) NOT NULL,
  `charityStreet` varchar(255) NOT NULL,
  `charityCity` varchar(100) NOT NULL,
  `charityNeighbor` varchar(255) NOT NULL,
  `productDetails` longtext CHARACTER SET utf8,
  `shippingDetails` varchar(2000) NOT NULL COMMENT 'unused',
  `pickupTime` varchar(100) NOT NULL COMMENT 'unused',
  `orderNotes` varchar(5000) NOT NULL COMMENT 'optional',
  `paymentType` varchar(100) DEFAULT 'COD',
  `deliveryStatus` int(1) NOT NULL,
  `paymentStatus` int(1) NOT NULL COMMENT 'unused',
  `subTotal` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `couponCode` varchar(20) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `deliveryFee` decimal(10,2) NOT NULL COMMENT 'unused',
  `grandTotal` decimal(10,2) DEFAULT NULL,
  `remainBalance` decimal(10,2) NOT NULL,
  `purchasePoints` decimal(10,2) NOT NULL,
  `driverId` int(11) NOT NULL COMMENT 'unused',
  `deliverySequence` int(11) NOT NULL COMMENT 'order sequence for delivery',
  `orderStatus` varchar(50) NOT NULL COMMENT 'reference from tbl_order_status',
  `orderTime` varchar(50) NOT NULL COMMENT 'unused',
  `cancelReason` varchar(1000) NOT NULL COMMENT 'Cancelled by Moderator',
  `custNotes` varchar(5000) NOT NULL COMMENT 'unused',
  `custRate` decimal(10,2) NOT NULL COMMENT 'unused',
  `orderTimestamp` varchar(20) NOT NULL,
  `deliveryTimestamp` varchar(20) NOT NULL,
  `paymentTimestamp` varchar(20) NOT NULL COMMENT 'unused',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`orderId`, `invoiceNo`, `custId`, `orderType`, `charityName`, `recipientName`, `charityPhone`, `charityStreet`, `charityCity`, `charityNeighbor`, `productDetails`, `shippingDetails`, `pickupTime`, `orderNotes`, `paymentType`, `deliveryStatus`, `paymentStatus`, `subTotal`, `vat`, `couponCode`, `discount`, `deliveryFee`, `grandTotal`, `remainBalance`, `purchasePoints`, `driverId`, `deliverySequence`, `orderStatus`, `orderTime`, `cancelReason`, `custNotes`, `custRate`, `orderTimestamp`, `deliveryTimestamp`, `paymentTimestamp`, `created`) VALUES
(1, '333100721', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"3\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":36,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"2-2001549281384.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"2\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":30,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"2-2001549281384.jpg\"},{\"prdId\":\"10\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14.00\",\"prdTotalPrice\":14,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 600 \\u0645\\u0644\",\"prdImage\":\"2-2001549281384.jpg\"},{\"prdId\":null,\"prdQty\":null,\"qtyUnit\":null,\"prdUnitPrice\":\"0.00\",\"prdTotalPrice\":0,\"prdName\":\"\",\"prdImage\":null},{\"prdId\":\"17\",\"prdQty\":\"3\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9.00\",\"prdTotalPrice\":27,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 250 \\u0645\\u0644\",\"prdImage\":\"2-2001549281384.jpg\"}]', '', '', '', 'COD', 0, 0, '107.00', '5.35', '', '0.00', '0.00', '112.35', '0.00', '11.24', 0, 0, '1', '', '', '', '0.00', '1549373131', '05/02/2019 6pm-7pm', '', '2019-02-05 23:25:31'),
(2, '333100722', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"2\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":24,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"2-2001549281384.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"2\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":30,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"2-2001549281384.jpg\"},{\"prdId\":null,\"prdQty\":null,\"qtyUnit\":null,\"prdUnitPrice\":\"0.00\",\"prdTotalPrice\":0,\"prdName\":\"\",\"prdImage\":null},{\"prdId\":\"10\",\"prdQty\":\"2\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14.00\",\"prdTotalPrice\":28,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 600 \\u0645\\u0644\",\"prdImage\":\"2-2001549281384.jpg\"},{\"prdId\":\"17\",\"prdQty\":\"2\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9.00\",\"prdTotalPrice\":18,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 250 \\u0645\\u0644\",\"prdImage\":\"2-2001549281384.jpg\"}]', '', '', '', 'COD', 0, 0, '100.00', '5.00', '', '0.00', '0.00', '105.00', '0.00', '10.50', 0, 0, '1', '', '', '', '0.00', '1549373949', '05/02/2019 7pm-8pm', '', '2019-02-05 23:39:09'),
(3, '333100723', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"2\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"6.00\",\"prdTotalPrice\":12,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"13\",\"prdQty\":\"3\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"20.00\",\"prdTotalPrice\":60,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 250 \\u0645\\u0644\",\"prdImage\":\"1549443455_.jpg\"}]', '', '', '', 'COD', 0, 0, '72.00', '3.60', '', '0.00', '0.00', '75.60', '0.00', '7.56', 0, 0, '2', '', '', '', '0.00', '1549540403', '07/02/2019 5pm-6pm', '', '2019-02-07 21:53:23'),
(4, '333100724', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"4\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"6.00\",\"prdTotalPrice\":24,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"3\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":45,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"},{\"prdId\":\"13\",\"prdQty\":\"3\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"20.00\",\"prdTotalPrice\":60,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 250 \\u0645\\u0644\",\"prdImage\":\"1549443455_.jpg\"}]', '', '', '', 'COD', 0, 0, '129.00', '6.45', '', '0.00', '0.00', '135.45', '0.00', '13.55', 0, 0, '1', '', '', '', '0.00', '1549792731', '10/02/2019 6pm-7pm', '', '2019-02-10 19:58:51'),
(5, '333100725', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"2\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"6.00\",\"prdTotalPrice\":12,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"17\",\"prdQty\":\"5\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"19.00\",\"prdTotalPrice\":95,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 250 \\u0645\\u0644\",\"prdImage\":\"1549445107_.jpg\"},{\"prdId\":\"16\",\"prdQty\":\"3\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":45,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 200 \\u0645\\u0644\",\"prdImage\":\"1549445052_.jpg\"},{\"prdId\":\"15\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":15,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549444883_.jpg\"}]', '', '', '', 'COD', 0, 0, '167.00', '8.35', 'Q123', '16.70', '0.00', '158.65', '0.00', '15.87', 0, 0, '1', '', '', '', '0.00', '1549793970', '10/02/2019 4pm-5pm', '', '2019-02-10 20:19:30'),
(6, '333100726', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"2\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"6.00\",\"prdTotalPrice\":12,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"2\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":30,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 0, 0, '42.00', '2.10', 'Q123', '4.20', '0.00', '39.90', '0.00', '3.99', 0, 0, '1', '', '', '', '0.00', '1549794052', '10/02/2019 4pm-5pm', '', '2019-02-10 20:20:52'),
(7, '222400827', '22240082', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"1\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":12,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"11\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"6.00\",\"prdTotalPrice\":6,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"1\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":15,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"},{\"prdId\":\"13\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"20.00\",\"prdTotalPrice\":20,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 250 \\u0645\\u0644\",\"prdImage\":\"1549443455_.jpg\"}]', '', '', '', 'COD', 0, 0, '53.00', '2.65', 'wa124', '2.65', '0.00', '53.00', '0.00', '5.30', 0, 0, '1', '', '', '', '0.00', '1550059429', '13/02/2019 7pm-8pm', '', '2019-02-13 22:03:49'),
(8, '222400828', '22240082', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"6.00\",\"prdTotalPrice\":6,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"1\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":15,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"},{\"prdId\":\"13\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"20.00\",\"prdTotalPrice\":20,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 250 \\u0645\\u0644\",\"prdImage\":\"1549443455_.jpg\"},{\"prdId\":\"14\",\"prdQty\":\"1\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"22.00\",\"prdTotalPrice\":22,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 330 \\u0645\\u0644\",\"prdImage\":\"1549443509_.jpg\"}]', '', '', '', 'COD', 0, 0, '63.00', '3.15', '', '0.00', '0.00', '66.15', '0.00', '6.62', 0, 0, '1', '', '', '', '0.00', '1550059495', '13/02/2019 7pm-8pm', '', '2019-02-13 22:04:55'),
(9, '333100729', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"15\",\"prdQty\":\"2\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":30,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549444883_.jpg\"}]', '', '', '', 'COD', 0, 0, '30.00', '1.50', '', '0.00', '0.00', '31.50', '0.00', '3.15', 0, 0, '1', '', '', '', '0.00', '1550141049', '14/02/2019 10am-11am', '', '2019-02-14 20:44:09'),
(10, '1117006710', '11170067', 'regular', '', '', '', '', '', '', '[{\"prdId\":11,\"prdQty\":1,\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":12,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":10,\"prdQty\":1,\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14.00\",\"prdTotalPrice\":14,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 600 \\u0645\\u0644\",\"prdImage\":\"1549444494_.jpg\"},{\"prdId\":15,\"prdQty\":5,\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":75,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549444883_.jpg\"}]', '', '', '', 'COD', 0, 0, '101.00', '5.05', '', '0.00', '0.00', '106.05', '0.00', '10.61', 0, 0, '1', '', '', '', '0.00', '1551280426', '27/02/2019 3pm-4pm', '', '2019-02-28 01:13:46'),
(11, '10311', '103', 'regular', '', '', '', '', '', '', '[{\"prdId\":14,\"prdQty\":1,\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"10.00\",\"prdTotalPrice\":10,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 330 \\u0645\\u0644\",\"prdImage\":\"1549443509_.jpg\"},{\"prdId\":18,\"prdQty\":1,\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"14.00\",\"prdTotalPrice\":14,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 330 \\u0645\\u0644\",\"prdImage\":\"1549445167_.jpg\"},{\"prdId\":19,\"prdQty\":1,\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14.00\",\"prdTotalPrice\":14,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 600 \\u0645\\u0644\",\"prdImage\":\"1549445199_.jpg\"},{\"prdId\":15,\"prdQty\":1,\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"7.00\",\"prdTotalPrice\":7,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0633\\u0643\\u0627\\u064a 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549444883_.jpg\"}]', '', '', '', 'COD', 0, 0, '45.00', '2.25', '', '0.00', '0.00', '47.25', '0.00', '4.73', 0, 0, '1', '', '', '', '0.00', '1552244374', '12/03/2019 3pm-4pm', '', '2019-03-11 04:59:34'),
(12, '3331007212', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":11,\"prdQty\":2,\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":24,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":12,\"prdQty\":1,\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":15,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 1, 0, '39.00', '1.95', '', '0.00', '0.00', '40.95', '0.00', '4.10', 0, 0, '6', '', '', '', '0.00', '1552474010', '14/03/2019 6pm-7pm', '', '2019-03-13 20:46:50'),
(13, '3331007213', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":11,\"prdQty\":6,\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":72,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":12,\"prdQty\":6,\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":90,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 1, 0, '162.00', '8.10', 'amal2', '8.10', '0.00', '162.00', '0.00', '16.20', 0, 0, '6', '', '', '', '0.00', '1552474726', '13/03/2019 5pm-6pm', '', '2019-03-13 20:58:46'),
(14, '3331007214', '33310072', 'charity', 'Ù…Ø³Ø¬Ø¯', 'Ø³Ø¹Ø¯', '0563355699', 'Ø¹Ø¨Ø¯Ø§Ù„Ù„Ù‡', 'Ø§Ù„Ø®Ø±Ø¬', 'Ø§Ù„ÙˆØ±ÙˆØ¯', '[{\"prdId\":11,\"prdQty\":2,\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":24,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":12,\"prdQty\":5,\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":75,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 0, 0, '99.00', '4.95', '', '0.00', '0.00', '103.95', '0.00', '10.40', 0, 0, '2', '', '', '', '0.00', '1552474828', '14/03/2019 4pm-5pm', '', '2019-03-13 21:00:28'),
(15, '3331007215', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":11,\"prdQty\":6,\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":72,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":12,\"prdQty\":3,\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":45,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 0, 0, '117.00', '5.85', '', '0.00', '0.00', '122.85', '0.00', '12.29', 0, 0, '1', '', '', '', '0.00', '1552474975', '13/03/2019 3pm-4pm', '', '2019-03-13 21:02:55'),
(16, '3331007216', '33310072', 'regular', '', '', '', '', '', '', '[{\"prdId\":11,\"prdQty\":3,\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":36,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":12,\"prdQty\":2,\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":30,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 0, 0, '66.00', '3.30', '', '0.00', '0.00', '69.30', '0.00', '6.93', 0, 0, '7', '', 'ØµØ±Ù Ø§Ù„Ù†Ø¸Ø± ', '', '0.00', '1552475011', '14/03/2019 12pm-1pm', '', '2019-03-13 21:03:31'),
(17, '1117006717', '11170067', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"2\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":24,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"1\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":15,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"},{\"prdId\":\"13\",\"prdQty\":\"2\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9.00\",\"prdTotalPrice\":18,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 250 \\u0645\\u0644\",\"prdImage\":\"1549443455_.jpg\"}]', '', '', '', 'COD', 0, 0, '57.00', '2.85', '', '0.00', '0.00', '59.85', '0.00', '5.99', 0, 0, '1', '', '', '', '0.00', '1555434953', '17/04/2019 10am-11am', '', '2019-04-17 03:15:53'),
(18, '1117006718', '11170067', 'regular', '', '', '', '', '', '', '[{\"prdId\":\"11\",\"prdQty\":\"4\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12.00\",\"prdTotalPrice\":48,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 1.5 \\u0644\\u062a\\u0631\",\"prdImage\":\"1549443371_.jpg\"},{\"prdId\":\"12\",\"prdQty\":\"5\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15.00\",\"prdTotalPrice\":75,\"prdName\":\"\\u0645\\u064a\\u0627\\u0647 \\u0642\\u0637\\u0627\\u0641 200 \\u0645\\u0644\",\"prdImage\":\"1549443422_.jpg\"}]', '', '', '', 'COD', 0, 0, '123.00', '6.15', '', '0.00', '0.00', '129.15', '0.00', '12.92', 0, 0, '1', '', '', '', '0.00', '1555547234', '20/04/2019 10am-11am', '', '2019-04-18 10:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `id` int(11) NOT NULL,
  `orderStatusId` int(11) NOT NULL,
  `orderStatus` varchar(50) CHARACTER SET utf8 NOT NULL,
  `orderStatusEn` varchar(50) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdDatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`id`, `orderStatusId`, `orderStatus`, `orderStatusEn`, `isActive`, `createdDatetime`) VALUES
(1, 1, 'Ø·Ù„Ø¨Ùƒ Ù‚ÙŠØ¯ Ø§Ù„Ø§Ù†ØªØ¸Ø§Ø±', 'PENDING', 1, '2019-01-10 02:53:45'),
(2, 2, 'Ù…Ù‚Ø¨ÙˆÙ„', 'ACCEPTED', 1, '2019-01-10 02:54:30'),
(3, 3, 'Ø£Ø¹Ø¯Øª', 'PREPARED', 1, '2019-01-06 22:11:15'),
(4, 4, 'ÙÙŠ Ø§Ù„Ø·Ø±ÙŠÙ‚', 'ON THE WAY', 1, '2019-01-10 02:55:29'),
(5, 5, 'Ø¹Ù†Ø¯ Â Ø§Ù„Ø¨Ø§Ø¨', 'BY THE DOOR', 1, '2019-01-10 02:57:18'),
(6, 6, 'Ù…ÙƒØªÙ…Ù„', 'COMPLETED', 1, '2019-01-10 02:58:11'),
(7, 7, 'Ø£Ù„ØºÙŠØª Ù…Ù† Ù‚Ø¨Ù„ Ø§Ù„Ù…Ø´Ø±Ù', 'CANCELLED BY MODERATOR', 1, '2019-01-06 22:12:49'),
(8, 8, 'Ø£Ù„ØºÙ‡Ø§ Ø§Ù„Ø¹Ù…ÙŠÙ„', 'CANCELLED BY CUSTOMER', 1, '2019-01-06 22:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `prdId` bigint(20) NOT NULL,
  `prdName` varchar(250) DEFAULT NULL,
  `prdDescr` varchar(1000) DEFAULT NULL,
  `prdImage` varchar(300) NOT NULL,
  `prdTypeId` int(11) NOT NULL,
  `qtyUnits` varchar(10000) NOT NULL,
  `companyId` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prdId`, `prdName`, `prdDescr`, `prdImage`, `prdTypeId`, `qtyUnits`, `companyId`, `isActive`, `isDeleted`, `created`, `modified`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 200 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 200 Ã— 48 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549193389', '1549193481'),
(2, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 200 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 200 Ù…Ù„ Ã— 48 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549194117', ''),
(3, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 250 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 250 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549194319', ''),
(4, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 250 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 250 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549194437', ''),
(5, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 330 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 330 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549194550', ''),
(6, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 330 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 330 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549194726', ''),
(7, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 600 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 600 Ù…Ù„ Ã— 30 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549194984', ''),
(8, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 1.5 Ù„ØªØ±', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 1.5 Ù„ØªØ± Ã— 12 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12\"}]', 6, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549195277', ''),
(9, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 1.5 Ù„ØªØ±', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 1.5 Ù„ØªØ± Ã— 12 Ø¹Ø¨ÙˆØ©', '2-2001549281384.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12\"}]', 5, 1, 1, '0000-00-00 00:00:00', '2019-02-05 13:18:48', '1549195384', ''),
(10, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 600 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 600 Ù…Ù„ Ã— 30', '1549444494_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"6\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 0, '0000-00-00 00:00:00', '2019-02-06 09:14:54', '1549268448', '1549444494'),
(11, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 1.5 Ù„ØªØ±', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 1.5 Ù„ØªØ± Ã— 12 Ø¹Ø¨ÙˆØ©', '1549443371_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"12\"}]', 6, 1, 0, '0000-00-00 00:00:00', '2019-02-14 06:46:01', '1549280746', '1550126761'),
(12, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 200 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 200 Ã— 48 Ø¹Ø¨ÙˆØ©', '1549443422_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 0, '0000-00-00 00:00:00', '2019-02-14 06:48:07', '1549280855', '1550126887'),
(13, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 250 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 250 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '1549443455_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 0, '0000-00-00 00:00:00', '2019-02-14 06:48:20', '1549280953', '1550126900'),
(14, 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 330 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ù‚Ø·Ø§Ù 330 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '1549443509_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"22\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"10\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 0, '0000-00-00 00:00:00', '2019-02-06 08:58:29', '1549281102', '1549443509'),
(15, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 1.5 Ù„ØªØ±', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 1.5 Ù„ØªØ± Ã— 12 Ø¹Ø¨ÙˆØ©', '1549444883_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"15\"}]', 5, 1, 0, '0000-00-00 00:00:00', '2019-03-13 10:55:21', '1549281301', '1552474521'),
(16, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 200 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 200 Ù…Ù„ Ã— 48 Ø¹Ø¨ÙˆØ©', '1549445052_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"15\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 0, '0000-00-00 00:00:00', '2019-03-13 10:54:27', '1549281384', '1552474467'),
(17, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 250 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 250 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '1549445107_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"9\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 0, '0000-00-00 00:00:00', '2019-03-13 10:53:18', '1549281486', '1552474398'),
(18, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 330 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 330 Ù…Ù„ Ã— 40 Ø¹Ø¨ÙˆØ©', '1549445167_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 0, '0000-00-00 00:00:00', '2019-03-13 10:52:40', '1549281617', '1552474360'),
(19, 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 600 Ù…Ù„', 'Ù…ÙŠØ§Ù‡ Ø³ÙƒØ§ÙŠ 600 Ù…Ù„ Ã— 30 Ø¹Ø¨ÙˆØ©', '1549445199_.jpg', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 5, 1, 0, '0000-00-00 00:00:00', '2019-03-13 10:52:09', '1549281707', '1552474329'),
(20, 'test', 'test', '', 1, '[{\"qtyUnitId\":\"20\",\"qtyUnit\":\"200 \\u0645\\u0644\",\"prdUnitPrice\":\"10\"},{\"qtyUnitId\":\"19\",\"qtyUnit\":\"330 \\u0645\\u0644\",\"prdUnitPrice\":\"14\"},{\"qtyUnitId\":\"18\",\"qtyUnit\":\"600 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"21\",\"qtyUnit\":\"250 \\u0645\\u0644\",\"prdUnitPrice\":\"\"},{\"qtyUnitId\":\"22\",\"qtyUnit\":\"1.5 \\u0644\\u062a\\u0631\",\"prdUnitPrice\":\"\"}]', 6, 1, 1, '0000-00-00 00:00:00', '2019-02-06 08:27:18', '1549426928', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_types`
--

CREATE TABLE `tbl_product_types` (
  `prdTypeId` int(11) NOT NULL,
  `prdType` varchar(200) NOT NULL,
  `dispalyPrdType` varchar(50) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_types`
--

INSERT INTO `tbl_product_types` (`prdTypeId`, `prdType`, `dispalyPrdType`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, 'Ù…ÙŠØ§Ù‡ Ø´Ø±Ø¨', '', 1, 0, '', ''),
(2, '', '', 1, 0, '', ''),
(3, '', '', 1, 0, '', ''),
(4, '', '', 1, 0, '', ''),
(5, '', '', 1, 0, '', ''),
(6, '', '', 1, 0, '', ''),
(7, '', '', 1, 0, '', ''),
(8, '', '', 1, 0, '', ''),
(9, '', '', 1, 0, '', ''),
(10, '', '', 1, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qty_units`
--

CREATE TABLE `tbl_qty_units` (
  `qtyUnitId` int(11) NOT NULL,
  `qtyUnit` varchar(200) NOT NULL,
  `order` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(250) NOT NULL,
  `modifiedTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qty_units`
--

INSERT INTO `tbl_qty_units` (`qtyUnitId`, `qtyUnit`, `order`, `isActive`, `isDeleted`, `createdTimestamp`, `modifiedTimestamp`) VALUES
(1, '1 ml', 1, 1, 1, '1540222794', '1542887134'),
(2, '0.75 L', 2, 0, 1, '1540222794', ''),
(3, '0.50 L', 3, 1, 1, '1540222794', ''),
(4, '0.25 L', 4, 1, 1, '1540222794', ''),
(13, '1 Kg', 5, 1, 1, '1540222794', ''),
(14, '0.75 Kg', 6, 1, 1, '1540222794', ''),
(15, '0.50 Kg', 7, 1, 1, '1540222794', ''),
(16, '0.25 Kg', 8, 1, 1, '1540222794', ''),
(17, '250', 10, 1, 1, '1547364283', ''),
(18, '600 Ù…Ù„', 3, 1, 0, '1547364305', '1548746358'),
(19, '330 Ù…Ù„', 2, 1, 0, '1547365100', '1548746381'),
(20, '200 Ù…Ù„', 1, 1, 0, '1548746130', '1548746398'),
(21, '250 Ù…Ù„', 4, 1, 0, '1548746223', '1548746416'),
(22, '1.5 Ù„ØªØ±', 5, 1, 0, '1548746273', '1548746435');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rate_services`
--

CREATE TABLE `tbl_rate_services` (
  `rateId` bigint(20) NOT NULL,
  `custId` bigint(20) NOT NULL,
  `orderId` varchar(10) NOT NULL,
  `que1Rating` decimal(5,1) NOT NULL,
  `que2Rating` decimal(5,1) NOT NULL,
  `que3Rating` decimal(5,1) NOT NULL,
  `que4Rating` decimal(5,1) NOT NULL,
  `que5Rating` decimal(5,1) NOT NULL,
  `comment` varchar(5000) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rate_services`
--

INSERT INTO `tbl_rate_services` (`rateId`, `custId`, `orderId`, `que1Rating`, `que2Rating`, `que3Rating`, `que4Rating`, `que5Rating`, `comment`, `created`, `modified`) VALUES
(1, 33310072, '12', '5.0', '5.0', '5.0', '5.0', '5.0', 'nice', '2019-03-13 20:50:28', '0000-00-00 00:00:00'),
(2, 33310072, '13', '5.0', '5.0', '5.0', '5.0', '5.0', 'nice', '2019-03-13 21:02:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating_questions`
--

CREATE TABLE `tbl_rating_questions` (
  `queId` int(11) NOT NULL,
  `que` varchar(1000) NOT NULL,
  `keyVal` enum('que1','que2','que3','que4','que5') DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rating_questions`
--

INSERT INTO `tbl_rating_questions` (`queId`, `que`, `keyVal`, `created`, `modified`) VALUES
(1, 'question1 text', 'que1', '0000-00-00 00:00:00', '2018-08-31 13:32:01'),
(2, 'question2 text', 'que2', '0000-00-00 00:00:00', '2018-09-21 20:40:22'),
(3, 'question3 text', 'que3', '0000-00-00 00:00:00', '2018-08-31 13:32:21'),
(4, 'question4 text', 'que4', '0000-00-00 00:00:00', '2018-08-31 13:32:29'),
(5, 'question5 text', 'que5', '0000-00-00 00:00:00', '2018-08-31 13:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `value` varchar(10) DEFAULT NULL,
  `description` varchar(200) NOT NULL COMMENT 'like : flat/percent'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `title`, `type`, `status`, `value`, `description`) VALUES
(1, 'نقطة واحدة لكل ريال', 'points_per_sr', 1, '10', ''),
(2, 'رسوم التوصيل', 'delivery_fee_per_sr', 1, '0', ''),
(3, 'Subscribers Discount', 'subscribers_discount', 0, '3', 'flat'),
(4, 'Discount', 'unsubscribers_discount', 0, '0', 'percentage'),
(5, '% ضريبة', 'vat_percentage', 1, '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriptions`
--

CREATE TABLE `tbl_subscriptions` (
  `id` int(11) NOT NULL,
  `subId` varchar(50) NOT NULL,
  `custId` varchar(20) NOT NULL,
  `subTypeId` int(11) NOT NULL,
  `productDetails` longtext CHARACTER SET utf8,
  `deliverySession` varchar(50) NOT NULL COMMENT 'Night/Morning/Afternoon',
  `deliveryTime` varchar(20) NOT NULL,
  `deliveryDay` varchar(20) NOT NULL,
  `nextDelivery` varchar(20) NOT NULL COMMENT 'Next delivery date',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0-pending,1-approved,2-rejected',
  `cancelReason` varchar(200) NOT NULL,
  `createdTimestamp` varchar(20) NOT NULL,
  `modifiedTimestamp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription_history`
--

CREATE TABLE `tbl_subscription_history` (
  `id` int(11) NOT NULL,
  `subId` varchar(50) NOT NULL,
  `custId` varchar(20) NOT NULL,
  `deliveryDate` varchar(20) NOT NULL,
  `orderId` int(11) NOT NULL DEFAULT '0' COMMENT 'orderId from tbl_orders after order',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0-pending,1-approved,2-rejected',
  `createdTimestamp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription_types`
--

CREATE TABLE `tbl_subscription_types` (
  `subTypeId` int(11) NOT NULL,
  `subType` varchar(200) NOT NULL,
  `nextDays` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `createdTimestamp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `tbl_admin_roles`
--
ALTER TABLE `tbl_admin_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  ADD PRIMARY KEY (`companyId`);

--
-- Indexes for table `tbl_contact_companies`
--
ALTER TABLE `tbl_contact_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  ADD PRIMARY KEY (`couponId`);

--
-- Indexes for table `tbl_coupons_history`
--
ALTER TABLE `tbl_coupons_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`autoId`);

--
-- Indexes for table `tbl_delivery_times`
--
ALTER TABLE `tbl_delivery_times`
  ADD PRIMARY KEY (`timeId`);

--
-- Indexes for table `tbl_districts`
--
ALTER TABLE `tbl_districts`
  ADD PRIMARY KEY (`districtId`);

--
-- Indexes for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  ADD PRIMARY KEY (`driverId`);

--
-- Indexes for table `tbl_favorites`
--
ALTER TABLE `tbl_favorites`
  ADD PRIMARY KEY (`favoriteId`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notId`);

--
-- Indexes for table `tbl_notification_history`
--
ALTER TABLE `tbl_notification_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification_types`
--
ALTER TABLE `tbl_notification_types`
  ADD PRIMARY KEY (`notTypeId`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`prdId`);

--
-- Indexes for table `tbl_product_types`
--
ALTER TABLE `tbl_product_types`
  ADD PRIMARY KEY (`prdTypeId`);

--
-- Indexes for table `tbl_qty_units`
--
ALTER TABLE `tbl_qty_units`
  ADD PRIMARY KEY (`qtyUnitId`);

--
-- Indexes for table `tbl_rate_services`
--
ALTER TABLE `tbl_rate_services`
  ADD PRIMARY KEY (`rateId`);

--
-- Indexes for table `tbl_rating_questions`
--
ALTER TABLE `tbl_rating_questions`
  ADD PRIMARY KEY (`queId`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscription_types`
--
ALTER TABLE `tbl_subscription_types`
  ADD PRIMARY KEY (`subTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `AdminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_admin_roles`
--
ALTER TABLE `tbl_admin_roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `cityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  MODIFY `companyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_contact_companies`
--
ALTER TABLE `tbl_contact_companies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  MODIFY `couponId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_coupons_history`
--
ALTER TABLE `tbl_coupons_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `autoId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_delivery_times`
--
ALTER TABLE `tbl_delivery_times`
  MODIFY `timeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_districts`
--
ALTER TABLE `tbl_districts`
  MODIFY `districtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  MODIFY `driverId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_favorites`
--
ALTER TABLE `tbl_favorites`
  MODIFY `favoriteId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_notification_history`
--
ALTER TABLE `tbl_notification_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_notification_types`
--
ALTER TABLE `tbl_notification_types`
  MODIFY `notTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `prdId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_product_types`
--
ALTER TABLE `tbl_product_types`
  MODIFY `prdTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_qty_units`
--
ALTER TABLE `tbl_qty_units`
  MODIFY `qtyUnitId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_rate_services`
--
ALTER TABLE `tbl_rate_services`
  MODIFY `rateId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rating_questions`
--
ALTER TABLE `tbl_rating_questions`
  MODIFY `queId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_subscription_types`
--
ALTER TABLE `tbl_subscription_types`
  MODIFY `subTypeId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
