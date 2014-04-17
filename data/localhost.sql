-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2014 at 12:41 PM
-- Server version: 5.5.33
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_album`
--

DROP TABLE IF EXISTS `tbl_album`;
CREATE TABLE `tbl_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `shareable` smallint(1) NOT NULL DEFAULT '0',
  `create_dt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` smallint(1) NOT NULL,
  `date_create` date NOT NULL,
  `date_update` date NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `description`, `status`, `date_create`, `date_update`, `parent`) VALUES
(3, 'test', 'dang test', 1, '2014-03-20', '2014-03-20', 0),
(4, 'kaka', 'ok nhe', 2, '2014-03-20', '2014-03-20', 2),
(5, 'test lan 2', 'ok ko ta', 1, '2014-03-20', '2014-03-20', 3),
(6, 'Cha', 'dang test ma', 2, '2014-03-24', '2014-03-24', NULL),
(7, 'ok con thang cha', 'dc roi do ', 1, '2014-03-24', '2014-03-24', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lookup`
--

DROP TABLE IF EXISTS `tbl_lookup`;
CREATE TABLE `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Draft', 1, 'PostStatus', 1),
(2, 'Published', 2, 'PostStatus', 2),
(3, 'Archived', 3, 'PostStatus', 3),
(4, 'Pending Approval', 1, 'CommentStatus', 1),
(5, 'Approved', 2, 'CommentStatus', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` smallint(1) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `total_goods` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

DROP TABLE IF EXISTS `tbl_package`;
CREATE TABLE `tbl_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `name`, `created_date`, `modified_date`, `status`) VALUES
(1, 'Hop', '2014-04-01 11:25:24', '2014-04-01 14:37:33', 1),
(2, 'cay', '2014-04-01 11:25:43', '2014-04-01 14:37:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo`
--

DROP TABLE IF EXISTS `tbl_photo`;
CREATE TABLE `tbl_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `alt_text` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `sort_order` int(4) NOT NULL,
  `created_dt` date NOT NULL,
  `lastupdate_dt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

DROP TABLE IF EXISTS `tbl_post`;
CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price_sale` float NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `status` smallint(2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `created_dt` date NOT NULL,
  `package_id` int(11) NOT NULL,
  `initials` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_name`, `img`, `price_sale`, `barcode`, `status`, `category_id`, `description`, `created_dt`, `package_id`, `initials`, `owner_id`) VALUES
(1, 'aaa', '', 1, 'a1', 1, 4, '<p>111</p>', '2014-04-01', 0, 10, 0),
(2, 'bbb', '', 12, 'wd34', 1, 5, '<p>aa&nbsp; rr ee</p>', '2014-04-01', 0, 10, 0),
(3, 'bbbb', '', 3, 'eee', 0, 0, '<p>eee</p>', '2014-04-01', 2, 10, 0),
(4, 'dddd', '', 1, 'ssw', 1, 7, '<p>rwe</p>', '2014-04-01', 1, 10, 0),
(5, 'product 1', '', 124, 'ddw44', 1, 4, '<p>test lai chac ok roi</p>', '2014-04-01', 1, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` smallint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`, `created_date`, `modified_date`, `status`) VALUES
(1, 'admin', '2014-04-01 15:34:07', '0000-00-00 00:00:00', 1),
(2, 'sale', '2014-04-01 15:34:26', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

DROP TABLE IF EXISTS `tbl_tag`;
CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`, `frequency`) VALUES
(1, 'yii', 1),
(2, 'blog', 1),
(3, 'test', 1),
(4, 'kaka', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `status` smallint(1) NOT NULL,
  `last_login_time` date NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `tbl_user_role` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `url`, `lastname`, `firstname`, `profile`, `status`, `last_login_time`, `created_date`, `modified_date`, `role_id`, `salt`) VALUES
(2, 'admin', '65c3fb5e2e6de65ba8b8163652614848', 'loc@mail.com', '', 'duy', 'loc', '', 1, '0000-00-00', '2014-04-02 13:33:00', '0000-00-00 00:00:00', 1, '533baf1be84653.83903763');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_photo` (`id`);

--
-- Constraints for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  ADD CONSTRAINT `tbl_photo_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_album` (`id`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_role` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
