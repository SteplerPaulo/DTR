/*
SQLyog Ultimate v9.10 
MySQL - 5.6.17 : Database - dtr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dtr` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dtr`;

/*Table structure for table `acos` */

DROP TABLE IF EXISTS `acos`;

CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'User',NULL,'User',1,2),(2,NULL,'Document',NULL,'Document',3,4),(3,NULL,'Student201',NULL,'Student201',5,6),(4,NULL,'Attendance',NULL,'Attendance',7,8);

/*Table structure for table `aros` */

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'User',NULL,'Super',1,4),(2,NULL,'User',NULL,'Admin',5,8),(3,NULL,'User',NULL,'User',9,14),(4,1,'User',1,'User::1',2,3),(5,2,'User',2,'User::2',6,7),(6,3,'User',3,'User::3',10,11),(7,3,'User',4,'User::4',12,13);

/*Table structure for table `aros_acos` */

DROP TABLE IF EXISTS `aros_acos`;

CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  `_acl` char(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`,`_acl`) values (1,1,1,'1','1','1','1','1'),(2,1,2,'1','1','1','1','1'),(3,2,1,'1','1','1','1','-1'),(4,2,2,'1','1','1','1','-1'),(5,1,3,'1','1','1','1','1');

/*Table structure for table `attendance_copies` */

DROP TABLE IF EXISTS `attendance_copies`;

CREATE TABLE `attendance_copies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_number` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `timein` time DEFAULT NULL,
  `timeout` time DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `remarks` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `attendance_copies` */

insert  into `attendance_copies`(`id`,`employee_number`,`date`,`timein`,`timeout`,`created`,`rfid`,`remarks`) values (1,'A-1981-0014','2016-06-24','09:54:57',NULL,'2016-06-24 09:54:57','123456789',1),(13,'A-1981-0014','2016-06-24',NULL,'09:55:05','2016-06-24 09:55:05','123456789',1),(14,'A-1981-0014','2016-06-24','09:55:30','09:55:34','2016-06-24 09:55:30','123456789',1);

/*Table structure for table `attendances` */

DROP TABLE IF EXISTS `attendances`;

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_number` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `timein` time DEFAULT NULL,
  `timeout` time DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `remarks` int(1) DEFAULT NULL COMMENT '1=DATA FOUND, 0=DATA NOT FOUND',
  `created` datetime DEFAULT NULL COMMENT 'current_datetime',
  `status` varchar(10) DEFAULT 'Raw',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `attendances` */

insert  into `attendances`(`id`,`employee_number`,`date`,`timein`,`timeout`,`rfid`,`remarks`,`created`,`status`) values (1,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 05:59:02','Saved'),(2,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 05:59:09','Saved'),(3,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 05:59:12','Saved'),(4,'A-0809-001','2016-06-23','12:59:00','12:59:00',NULL,2,'2016-06-23 05:59:31','Saved'),(5,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:00:04','Saved'),(6,'12663','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:03:39','Saved'),(7,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:10:44','Saved'),(8,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:10:44','Saved'),(9,'A-0809-001','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:23:33','Saved'),(10,'12663','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:39:34','Saved'),(11,'12663','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:39:57','Saved'),(12,'12663','2016-06-23',NULL,NULL,NULL,NULL,'2016-06-23 06:45:14','Saved'),(13,'A-1981-0014','2016-06-24','09:54:57','09:55:05','123456789',1,'2016-06-24 09:54:57','Raw'),(14,'A-1981-0014','2016-06-24','22:59:00','23:59:00','123456789',1,'2016-06-24 09:55:30','Raw');

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dir` tinyblob NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `documents` */

insert  into `documents`(`id`,`user_id`,`name`,`dir`,`created`,`modified`) values (2,1,'048da9a5df0b2a733a879179f68c4fd1.','Ú∆€ΩÑwÑÇô˚∆¬û\'?+>ü/◊¸ë`Èa‡	∏2¨Æ•∫⁄I+‹e	}(”¶‚?≈nÎÁj“”ë∞—ò⁄©¯ÊØYÊ±Ÿ±ùO|','2014-11-21 06:05:37','2015-09-27 23:52:32');

/*Table structure for table `oauth_consumer_registry` */

DROP TABLE IF EXISTS `oauth_consumer_registry`;

CREATE TABLE `oauth_consumer_registry` (
  `ocr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ocr_usa_id_ref` int(11) DEFAULT NULL,
  `ocr_consumer_key` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ocr_consumer_secret` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ocr_signature_methods` varchar(255) NOT NULL DEFAULT 'HMAC-SHA1,PLAINTEXT',
  `ocr_server_uri` varchar(255) NOT NULL,
  `ocr_server_uri_host` varchar(128) NOT NULL,
  `ocr_server_uri_path` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ocr_request_token_uri` varchar(255) NOT NULL,
  `ocr_authorize_uri` varchar(255) NOT NULL,
  `ocr_access_token_uri` varchar(255) NOT NULL,
  `ocr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ocr_id`),
  UNIQUE KEY `ocr_consumer_key` (`ocr_consumer_key`,`ocr_usa_id_ref`,`ocr_server_uri`),
  KEY `ocr_server_uri` (`ocr_server_uri`),
  KEY `ocr_server_uri_host` (`ocr_server_uri_host`,`ocr_server_uri_path`),
  KEY `ocr_usa_id_ref` (`ocr_usa_id_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `oauth_consumer_registry` */

insert  into `oauth_consumer_registry`(`ocr_id`,`ocr_usa_id_ref`,`ocr_consumer_key`,`ocr_consumer_secret`,`ocr_signature_methods`,`ocr_server_uri`,`ocr_server_uri_host`,`ocr_server_uri_path`,`ocr_request_token_uri`,`ocr_authorize_uri`,`ocr_access_token_uri`,`ocr_timestamp`) values (7,9,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-09 23:43:18'),(8,1,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 01:11:27'),(9,4,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 01:16:20'),(10,2,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 01:20:27'),(11,11,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 15:33:25'),(12,12,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 15:51:32'),(13,13,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 17:10:46'),(14,14,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 17:11:41'),(15,15,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 22:46:34'),(16,16,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 22:49:30'),(17,17,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-12 23:54:12'),(18,18,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-16 16:43:10'),(19,20,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-16 16:54:01'),(20,1,'375e5cefe433d32d839e928d879393f80514925a1','fff410a5058b57a5ab6df9c100235c66','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-03-21 17:05:39'),(21,4,'375e5cefe433d32d839e928d879393f80514925a1','fff410a5058b57a5ab6df9c100235c66','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-03-21 17:14:55'),(22,1,'4a7be0429f2fadf424100ce029856a3e05146b9b3','53b598a6413f31cb853611fdca0ccb09','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-03 16:36:08'),(23,1,'509d69833068fe9047eecd94bc972c830515c106a','cb1df409daffbae8db8406a8433228e4','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-05 01:56:36'),(24,1,'45ed2a5f238f5d1973ce469bd3d596ed0515c28cd','5727a0dda6ab12716596b9a1455d8b42','HMAC-SHA1,PLAINTEXT','http://localhost:85/profile','localhost','/profile','http://localhost:85/profile/oauth/request_token','http://localhost:85/profile/oauth/authorize','http://localhost:85/profile/oauth/access_token','2013-04-05 03:30:50'),(25,1,'e101395944110fcf8fa6389daa2a5c4a0515ce30b','98033fd7bfe474d8ee657aa2bb949446','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-06 22:05:06'),(26,1,'53f1d68c5ca864d965a161d10359360505146af5c','9b19342142a1deb1513449d5589e4708','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-19 23:00:07'),(27,1,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 03:31:11'),(28,2,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 03:37:12'),(29,3,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 08:18:32'),(30,4,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 08:31:14'),(31,5,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-07-10 00:45:56'),(32,4,'c7f6754f090c3490d118e82bfde6ccfb051db7b34','1b65fa9cdb690606f7ae927142623358','HMAC-SHA1,PLAINTEXT','http://192.168.1.34/profile','192.168.1.34','/profile','http://192.168.1.34/profile/oauth/request_token','http://192.168.1.34/profile/oauth/authorize','http://192.168.1.34/profile/oauth/access_token','2013-07-10 01:54:09'),(33,1,'c7f6754f090c3490d118e82bfde6ccfb051db7b34','1b65fa9cdb690606f7ae927142623358','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-07-10 01:54:21'),(34,1,'04829b00ee2b0b0e422458f8541c21fa051db7cfa','1c98c45ea9505daf0431c1d9de08f791','HMAC-SHA1,PLAINTEXT','http://192.168.1.34/profile','192.168.1.34','/profile','http://192.168.1.34/profile/oauth/request_token','http://192.168.1.34/profile/oauth/authorize','http://192.168.1.34/profile/oauth/access_token','2013-07-10 02:01:50'),(35,1,'bf566ad0be02a427b3526d5de3fce852051db7ed3','53528546b41d87dfa285c5ff407d9ada','HMAC-SHA1,PLAINTEXT','http://192.168.1.200/profile','192.168.1.200','/profile','http://192.168.1.200/profile/oauth/request_token','http://192.168.1.200/profile/oauth/authorize','http://192.168.1.200/profile/oauth/access_token','2013-07-10 02:10:26'),(36,4,'bf566ad0be02a427b3526d5de3fce852051db7ed3','53528546b41d87dfa285c5ff407d9ada','HMAC-SHA1,PLAINTEXT','http://192.168.1.200/profile','192.168.1.200','/profile','http://192.168.1.200/profile/oauth/request_token','http://192.168.1.200/profile/oauth/authorize','http://192.168.1.200/profile/oauth/access_token','2013-07-10 02:18:38'),(37,5,'bf566ad0be02a427b3526d5de3fce852051db7ed3','53528546b41d87dfa285c5ff407d9ada','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-07-10 02:44:38'),(38,3,'f411af578a871e4e16cf3ef0cfc259570523fd3ec','2cc8e6922ecd4a770142afaa53c03a75','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-09-24 04:40:27'),(39,3,'944ee18e4367d4659ae2ffc0762a5db50523fd564','bee8a1e77d264114fc1de0d94ba367f2','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-09-24 04:48:01'),(40,3,'6d974a09858a1fdabffbd122e4d529fe052414ce2','8311774301e9efa8dc266b572d2cfa02','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-09-26 00:26:44'),(41,1,'6d974a09858a1fdabffbd122e4d529fe052414ce2','8311774301e9efa8dc266b572d2cfa02','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2014-01-07 01:18:21');

/*Table structure for table `oauth_consumer_token` */

DROP TABLE IF EXISTS `oauth_consumer_token`;

CREATE TABLE `oauth_consumer_token` (
  `oct_id` int(11) NOT NULL AUTO_INCREMENT,
  `oct_ocr_id_ref` int(11) NOT NULL,
  `oct_usa_id_ref` int(11) NOT NULL,
  `oct_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `oct_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `oct_token_secret` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `oct_token_type` enum('request','authorized','access') DEFAULT NULL,
  `oct_token_ttl` datetime NOT NULL DEFAULT '9999-12-31 00:00:00',
  `oct_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`oct_id`),
  UNIQUE KEY `oct_ocr_id_ref` (`oct_ocr_id_ref`,`oct_token`),
  UNIQUE KEY `oct_usa_id_ref` (`oct_usa_id_ref`,`oct_ocr_id_ref`,`oct_token_type`,`oct_name`),
  KEY `oct_token_ttl` (`oct_token_ttl`),
  CONSTRAINT `oauth_consumer_token_ibfk_1` FOREIGN KEY (`oct_ocr_id_ref`) REFERENCES `oauth_consumer_registry` (`ocr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `oauth_consumer_token` */

/*Table structure for table `oauth_log` */

DROP TABLE IF EXISTS `oauth_log`;

CREATE TABLE `oauth_log` (
  `olg_id` int(11) NOT NULL AUTO_INCREMENT,
  `olg_osr_consumer_key` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `olg_ost_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `olg_ocr_consumer_key` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `olg_oct_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `olg_usa_id_ref` int(11) DEFAULT NULL,
  `olg_received` text NOT NULL,
  `olg_sent` text NOT NULL,
  `olg_base_string` text NOT NULL,
  `olg_notes` text NOT NULL,
  `olg_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `olg_remote_ip` bigint(20) NOT NULL,
  PRIMARY KEY (`olg_id`),
  KEY `olg_osr_consumer_key` (`olg_osr_consumer_key`,`olg_id`),
  KEY `olg_ost_token` (`olg_ost_token`,`olg_id`),
  KEY `olg_ocr_consumer_key` (`olg_ocr_consumer_key`,`olg_id`),
  KEY `olg_oct_token` (`olg_oct_token`,`olg_id`),
  KEY `olg_usa_id_ref` (`olg_usa_id_ref`,`olg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `oauth_log` */

/*Table structure for table `rest_logs` */

DROP TABLE IF EXISTS `rest_logs`;

CREATE TABLE `rest_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `requested` datetime NOT NULL,
  `apikey` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `httpcode` smallint(3) unsigned NOT NULL,
  `error` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ratelimited` tinyint(1) unsigned NOT NULL,
  `data_in` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_out` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `responded` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rest_logs` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `last_name` varchar(75) DEFAULT '',
  `first_name` varchar(75) DEFAULT '',
  `middle_name` varchar(75) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`last_name`,`first_name`,`middle_name`,`created`,`modified`) values (1,'superuser','2761c61f0438dde56271ca3b8ffb222a1974706a','User','Super',' ','2014-11-21 05:37:24','2015-09-27 23:52:32'),(2,'adminuser','2761c61f0438dde56271ca3b8ffb222a1974706a','User','Admin',' ','2014-11-21 06:03:03','2014-11-21 06:03:03'),(3,'useruser','2761c61f0438dde56271ca3b8ffb222a1974706a','User','User',' ','2014-11-21 06:03:35','2014-11-21 06:03:35'),(4,'relly','e730e4bef730b3b7fbc082f4136c2edf109eb857','Cruz','Relly','N.','2015-09-29 04:36:12','2015-09-29 04:36:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
