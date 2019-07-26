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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'User',NULL,'User',1,2),(2,NULL,'Document',NULL,'Document',3,4),(3,NULL,'Student201',NULL,'Student201',5,6),(4,NULL,'Attendance',NULL,'Attendance',7,8),(5,NULL,'User',NULL,'User',9,10),(6,NULL,'RfidStudattendance',NULL,'RfidStudattendance',11,12),(7,NULL,'SchoolYear',NULL,'SchoolYear',13,14),(8,NULL,'Section',NULL,'Section',15,16),(9,NULL,'RfidStudent',NULL,'RfidStudent',17,18);

/*Table structure for table `aros` */

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL COMMENT 'user id',
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'User',NULL,'Super',1,4),(2,NULL,'User',NULL,'Admin',5,8),(3,NULL,'User',NULL,'User',9,18),(4,1,'User',1,'User::1',2,3),(5,2,'User',2,'User::2',6,7),(6,3,'User',3,'User::3',10,11),(7,3,'User',4,'User::4',12,13),(8,NULL,'User',NULL,'Employee',19,22),(9,NULL,'User',NULL,'Registrar',23,26),(10,9,'User',5,'User::5',24,25),(11,NULL,'User',NULL,'Director',27,30),(12,NULL,'User',NULL,'HR',31,34),(13,NULL,'User',NULL,'Guidance',35,38),(14,NULL,'User',NULL,'Student',39,42),(15,11,'User',6,'User::6',28,29),(16,12,'User',7,'User::7',32,33),(17,13,'User',8,'User::8',36,37),(18,8,'User',9,'User::9',20,21),(19,14,'User',10,'User::10',40,41),(20,NULL,'User',NULL,'Visitor',43,44),(21,3,'User',11,'User::11',14,15),(22,3,'User',12,'User::12',16,17);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`,`_acl`) values (1,1,1,'1','1','1','1','1'),(2,1,2,'1','1','1','1','1'),(3,2,1,'1','1','1','1','-1'),(4,2,2,'1','1','1','1','-1'),(5,1,3,'1','1','1','1','1'),(6,9,6,'1','1','1','1','-1'),(7,1,6,'1','1','1','1','1'),(8,11,6,'1','1','1','1','-1'),(9,12,4,'1','1','1','1','-1'),(10,11,4,'1','1','1','1','-1'),(11,13,6,'1','1','1','1','-1'),(12,14,6,'-1','1','-1','-1','-1'),(13,8,4,'-1','1','-1','-1','-1'),(14,1,4,'1','1','1','1','1'),(15,8,6,'-1','1','-1','-1','-1'),(16,8,8,'-1','1','-1','-1','-1'),(17,1,8,'1','1','1','1','1'),(18,11,8,'1','1','1','1','-1'),(19,13,8,'1','1','1','1','-1'),(20,1,9,'1','1','1','1','1'),(21,11,9,'1','1','1','1','-1'),(22,13,9,'1','1','1','1','-1'),(23,8,9,'-1','-1','-1','-1','-1'),(24,14,9,'-1','1','-1','-1','-1');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `attendance_copies` */

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `attendances` */

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

insert  into `documents`(`id`,`user_id`,`name`,`dir`,`created`,`modified`) values (2,1,'fa6cb66fd8ae13eb6e8c5d986002d4b5.jpg','ı∆€ΩÑwÑAãö™üêô-cdœ*⁄Æí2±bÊ[Ó7ˇ\0˙§Ë€I-àds{◊ß„d∆=Næª`◊â∆¥”òé§ıÊ˙Z„¥ÿ±ùO|','2014-11-21 06:05:37','2017-01-12 18:37:18');

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

insert  into `oauth_consumer_registry`(`ocr_id`,`ocr_usa_id_ref`,`ocr_consumer_key`,`ocr_consumer_secret`,`ocr_signature_methods`,`ocr_server_uri`,`ocr_server_uri_host`,`ocr_server_uri_path`,`ocr_request_token_uri`,`ocr_authorize_uri`,`ocr_access_token_uri`,`ocr_timestamp`) values (7,9,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 15:43:18'),(8,1,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 17:11:27'),(9,4,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 17:16:20'),(10,2,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-10 17:20:27'),(11,11,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 06:33:25'),(12,12,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 06:51:32'),(13,13,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 08:10:46'),(14,14,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 08:11:41'),(15,15,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 13:46:34'),(16,16,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 13:49:30'),(17,17,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-13 14:54:12'),(18,18,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-17 07:43:10'),(19,20,'502afcf0499d10cf20b6ce27f2898ed2051382a74','0f2bb8a48ad27cc56baf130d04a08e32','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-03-17 07:54:01'),(20,1,'375e5cefe433d32d839e928d879393f80514925a1','fff410a5058b57a5ab6df9c100235c66','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-03-22 08:05:39'),(21,4,'375e5cefe433d32d839e928d879393f80514925a1','fff410a5058b57a5ab6df9c100235c66','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-03-22 08:14:55'),(22,1,'4a7be0429f2fadf424100ce029856a3e05146b9b3','53b598a6413f31cb853611fdca0ccb09','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-04 07:36:08'),(23,1,'509d69833068fe9047eecd94bc972c830515c106a','cb1df409daffbae8db8406a8433228e4','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-05 16:56:36'),(24,1,'45ed2a5f238f5d1973ce469bd3d596ed0515c28cd','5727a0dda6ab12716596b9a1455d8b42','HMAC-SHA1,PLAINTEXT','http://localhost:85/profile','localhost','/profile','http://localhost:85/profile/oauth/request_token','http://localhost:85/profile/oauth/authorize','http://localhost:85/profile/oauth/access_token','2013-04-05 18:30:50'),(25,1,'e101395944110fcf8fa6389daa2a5c4a0515ce30b','98033fd7bfe474d8ee657aa2bb949446','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-07 13:05:06'),(26,1,'53f1d68c5ca864d965a161d10359360505146af5c','9b19342142a1deb1513449d5589e4708','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-04-20 14:00:07'),(27,1,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 18:31:11'),(28,2,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 18:37:12'),(29,3,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 23:18:32'),(30,4,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-05-16 23:31:14'),(31,5,'8239c837e5b047384e4436f0d3d591520519309e0','6fad78514a8911602be61508d315b62f','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-07-10 15:45:56'),(32,4,'c7f6754f090c3490d118e82bfde6ccfb051db7b34','1b65fa9cdb690606f7ae927142623358','HMAC-SHA1,PLAINTEXT','http://192.168.1.34/profile','192.168.1.34','/profile','http://192.168.1.34/profile/oauth/request_token','http://192.168.1.34/profile/oauth/authorize','http://192.168.1.34/profile/oauth/access_token','2013-07-10 16:54:09'),(33,1,'c7f6754f090c3490d118e82bfde6ccfb051db7b34','1b65fa9cdb690606f7ae927142623358','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-07-10 16:54:21'),(34,1,'04829b00ee2b0b0e422458f8541c21fa051db7cfa','1c98c45ea9505daf0431c1d9de08f791','HMAC-SHA1,PLAINTEXT','http://192.168.1.34/profile','192.168.1.34','/profile','http://192.168.1.34/profile/oauth/request_token','http://192.168.1.34/profile/oauth/authorize','http://192.168.1.34/profile/oauth/access_token','2013-07-10 17:01:50'),(35,1,'bf566ad0be02a427b3526d5de3fce852051db7ed3','53528546b41d87dfa285c5ff407d9ada','HMAC-SHA1,PLAINTEXT','http://192.168.1.200/profile','192.168.1.200','/profile','http://192.168.1.200/profile/oauth/request_token','http://192.168.1.200/profile/oauth/authorize','http://192.168.1.200/profile/oauth/access_token','2013-07-10 17:10:26'),(36,4,'bf566ad0be02a427b3526d5de3fce852051db7ed3','53528546b41d87dfa285c5ff407d9ada','HMAC-SHA1,PLAINTEXT','http://192.168.1.200/profile','192.168.1.200','/profile','http://192.168.1.200/profile/oauth/request_token','http://192.168.1.200/profile/oauth/authorize','http://192.168.1.200/profile/oauth/access_token','2013-07-10 17:18:38'),(37,5,'bf566ad0be02a427b3526d5de3fce852051db7ed3','53528546b41d87dfa285c5ff407d9ada','HMAC-SHA1,PLAINTEXT','http://localhost/profile','localhost','/profile','http://localhost/profile/oauth/request_token','http://localhost/profile/oauth/authorize','http://localhost/profile/oauth/access_token','2013-07-10 17:44:38'),(38,3,'f411af578a871e4e16cf3ef0cfc259570523fd3ec','2cc8e6922ecd4a770142afaa53c03a75','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-09-24 19:40:27'),(39,3,'944ee18e4367d4659ae2ffc0762a5db50523fd564','bee8a1e77d264114fc1de0d94ba367f2','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-09-24 19:48:01'),(40,3,'6d974a09858a1fdabffbd122e4d529fe052414ce2','8311774301e9efa8dc266b572d2cfa02','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2013-09-26 15:26:44'),(41,1,'6d974a09858a1fdabffbd122e4d529fe052414ce2','8311774301e9efa8dc266b572d2cfa02','HMAC-SHA1,PLAINTEXT','http://wugserver:85/profile','wugserver','/profile','http://wugserver:85/profile/oauth/request_token','http://wugserver:85/profile/oauth/authorize','http://wugserver:85/profile/oauth/access_token','2014-01-07 17:18:21');

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

/*Table structure for table `system_defaults` */

DROP TABLE IF EXISTS `system_defaults`;

CREATE TABLE `system_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(225) DEFAULT NULL,
  `school_logo` varchar(100) DEFAULT NULL,
  `school_address` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `system_defaults` */

insert  into `system_defaults`(`id`,`school_name`,`school_logo`,`school_address`) values (1,'Holy Trinity Academy','school_logo.png','Balic-balic Sampaloc Manila');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `last_name` varchar(75) DEFAULT '',
  `first_name` varchar(75) DEFAULT '',
  `middle_name` varchar(75) DEFAULT '',
  `id_number` varchar(20) DEFAULT NULL COMMENT 'Employee or Student Number',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`last_name`,`first_name`,`middle_name`,`id_number`,`created`,`modified`) values (1,'superuser','2761c61f0438dde56271ca3b8ffb222a1974706a','User','Super',' ',NULL,'2014-11-21 05:37:24','2017-01-12 18:37:18'),(2,'adminuser','2761c61f0438dde56271ca3b8ffb222a1974706a','User','Admin',' ',NULL,'2014-11-21 06:03:03','2014-11-21 06:03:03'),(3,'useruser','2761c61f0438dde56271ca3b8ffb222a1974706a','User','User',' ',NULL,'2014-11-21 06:03:35','2014-11-21 06:03:35'),(4,'relly','e730e4bef730b3b7fbc082f4136c2edf109eb857','Cruz','Relly','N.',NULL,'2015-09-29 04:36:12','2015-09-29 04:36:12'),(5,'Registrar Personnel','2761c61f0438dde56271ca3b8ffb222a1974706a','Reg','1',' ',NULL,'2017-01-12 18:03:01','2017-01-13 13:39:33'),(6,'Director 1','2761c61f0438dde56271ca3b8ffb222a1974706a','Director','1',' ',NULL,'2017-01-13 12:20:36','2017-01-13 12:20:36'),(7,'HR 1','2761c61f0438dde56271ca3b8ffb222a1974706a','HR','1',' ',NULL,'2017-01-13 12:24:42','2017-01-13 12:24:42'),(8,'Guidance 1','2761c61f0438dde56271ca3b8ffb222a1974706a','Guidance','1',' ',NULL,'2017-01-13 12:25:11','2017-01-13 12:25:11'),(9,'Employee 1','2761c61f0438dde56271ca3b8ffb222a1974706a','ALAMO','MARINA','G','95-0015 NA','2017-01-13 12:26:47','2017-01-16 17:27:07'),(10,'Student 1','2761c61f0438dde56271ca3b8ffb222a1974706a','AGONCILLO','JEAN ISAAC','A','2015-01396','2017-01-13 12:27:56','2017-01-16 13:16:10'),(11,'luzsudario','1edd9737eb6897db0a5d2451326aa020ec8d00d7','Sudario','Luzviminda','Costelo','S1-N15-1108','2017-08-25 13:53:55','2017-08-25 13:53:55'),(12,'babyjanealcantara','ab575528cda06477b54488ff60b6ca00267e172d','Alcantara','Baby Jane','Castillo','2009-002','2018-11-15 07:22:53','2018-11-15 07:22:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
