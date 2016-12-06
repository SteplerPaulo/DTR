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

insert  into `system_defaults`(`id`,`school_name`,`school_logo`,`school_address`) values (1,'JUAN SUMULONG MEMORIAL JUNIOR COLLEGE ','school_logo.png','Test');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
