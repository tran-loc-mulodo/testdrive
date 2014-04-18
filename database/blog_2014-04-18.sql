# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.33)
# Database: blog
# Generation Time: 2014-04-18 10:33:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_album
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_album`;

CREATE TABLE `tbl_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `shareable` smallint(1) NOT NULL DEFAULT '0',
  `create_dt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tbl_category
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;

INSERT INTO `tbl_category` (`id`, `title`, `description`, `status`, `date_create`, `date_update`, `parent`)
VALUES
	(3,'test','dang test',1,'2014-03-20','2014-03-20',0),
	(4,'kaka','ok nhe',2,'2014-03-20','2014-03-20',2),
	(5,'test lan 2','ok ko ta',1,'2014-03-20','2014-03-20',3),
	(6,'Cha','dang test ma',2,'2014-03-24','2014-03-24',NULL),
	(7,'ok con thang cha','dc roi do ',1,'2014-03-24','2014-03-24',6);

/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_comment
# ------------------------------------------------------------

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
  KEY `FK_comment_post` (`post_id`),
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_photo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table tbl_lookup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_lookup`;

CREATE TABLE `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tbl_lookup` WRITE;
/*!40000 ALTER TABLE `tbl_lookup` DISABLE KEYS */;

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`)
VALUES
	(1,'Draft',1,'PostStatus',1),
	(2,'Published',2,'PostStatus',2),
	(3,'Archived',3,'PostStatus',3),
	(4,'Pending Approval',1,'CommentStatus',1),
	(5,'Approved',2,'CommentStatus',2);

/*!40000 ALTER TABLE `tbl_lookup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_order
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_order` WRITE;
/*!40000 ALTER TABLE `tbl_order` DISABLE KEYS */;

INSERT INTO `tbl_order` (`id`, `owner_id`, `created_date`, `modified_date`, `status`, `total_price`, `total_goods`, `discount`)
VALUES
	(1,2,'2014-04-03 14:34:39','0000-00-00 00:00:00',1,34,24,0);

/*!40000 ALTER TABLE `tbl_order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_order_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_order_detail`;

CREATE TABLE `tbl_order_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `price` float DEFAULT NULL,
  `quality` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tbl_package
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_package`;

CREATE TABLE `tbl_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_package` WRITE;
/*!40000 ALTER TABLE `tbl_package` DISABLE KEYS */;

INSERT INTO `tbl_package` (`id`, `name`, `created_date`, `modified_date`, `status`)
VALUES
	(1,'Hop','2014-04-01 11:25:24','2014-04-01 14:37:33',1),
	(2,'cay','2014-04-01 11:25:43','2014-04-01 14:37:48',1);

/*!40000 ALTER TABLE `tbl_package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_photo
# ------------------------------------------------------------

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
  PRIMARY KEY (`id`),
  CONSTRAINT `tbl_photo_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_album` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tbl_post
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table tbl_product
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;

INSERT INTO `tbl_product` (`id`, `product_name`, `img`, `price_sale`, `barcode`, `status`, `category_id`, `description`, `created_dt`, `package_id`, `initials`, `owner_id`)
VALUES
	(1,'product 5','2014-03-29 09.48.49.jpg',1,'a1',1,4,'<p>111</p>','2014-04-01',1,10,0),
	(2,'product 4','2014-03-29 09.37.23.jpg',12,'wd34',1,5,'<p>aa&nbsp; rr ee</p>','2014-04-01',2,10,0),
	(3,'product 3','2012-02-11 00.22.36.jpg',3,'eee',1,0,'<p>eee</p>','2014-04-01',2,10,0),
	(4,'product 2','Screen Shot 2013-08-22 at 10.39.25 PM.png',1,'ssw',1,7,'<p>rwe</p>','2014-04-01',1,10,0),
	(5,'product 1','2014-03-29 09.47.42.jpg',124,'ddw44',1,4,'<p>test lai chac ok roi</p>','2014-04-01',1,11,0);

/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_role`;

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` smallint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_role` WRITE;
/*!40000 ALTER TABLE `tbl_role` DISABLE KEYS */;

INSERT INTO `tbl_role` (`id`, `name`, `created_date`, `modified_date`, `status`)
VALUES
	(1,'admin','2014-04-01 15:34:07','0000-00-00 00:00:00',1),
	(2,'sale','2014-04-01 15:34:26','0000-00-00 00:00:00',1);

/*!40000 ALTER TABLE `tbl_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_tag`;

CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tbl_tag` WRITE;
/*!40000 ALTER TABLE `tbl_tag` DISABLE KEYS */;

INSERT INTO `tbl_tag` (`id`, `name`, `frequency`)
VALUES
	(1,'yii',1),
	(2,'blog',1),
	(3,'test',1),
	(4,'kaka',1);

/*!40000 ALTER TABLE `tbl_tag` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user
# ------------------------------------------------------------

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
  KEY `tbl_user_role` (`role_id`),
  CONSTRAINT `tbl_user_role` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `url`, `lastname`, `firstname`, `profile`, `status`, `last_login_time`, `created_date`, `modified_date`, `role_id`, `salt`)
VALUES
	(2,'admin','65c3fb5e2e6de65ba8b8163652614848','loc@mail.com','','duy','loc','',1,'0000-00-00','2014-04-02 13:33:00','0000-00-00 00:00:00',1,'533baf1be84653.83903763');

/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
