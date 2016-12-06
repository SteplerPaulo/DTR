/*
SQLyog Ultimate v9.10 
MySQL - 5.6.17 : Database - gatekeeper_hta_2016
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gatekeeper_hta_2016` /*!40100 DEFAULT CHARACTER SET latin1 */;



/*Table structure for table `fetcher_documents` */

DROP TABLE IF EXISTS `fetcher_documents`;

CREATE TABLE `fetcher_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fetcher_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dir` tinyblob NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fetcher_documents` */

insert  into `fetcher_documents`(`id`,`fetcher_id`,`name`,`dir`,`created`,`modified`) values (1,1,'d6736e22617cb8661040138436c51d2a.png','�����w��ˡ��� k}f�s���3�7�	�3�\\����ZI/�mRw/ס�2�=L��k��ƸӘޥ���\n�䌱�O|','2016-07-14 07:03:00','2016-07-14 07:03:00'),(2,2,'652f6694e63636ae17c92b9509f37948.png','�����w��ˡ��� k}f�s���3�7�	�3�\\����ZI$�bw~���0�?��eяǳՐڥ���R�ر�O|','2016-07-14 07:57:36','2016-07-14 07:57:36'),(3,3,'b621e36671674064f5b5e2823cb68d55.png','�����w��ˡ��� k}f�s���3�7�	�3�\\����ZI(�f|(���c�jI��g��ĵѐ�����FY�߱�O|','2016-07-14 07:58:20','2016-07-14 07:58:20'),(4,4,'30b51c56cdeb03a367b9663503a48474.png','�����w��ˡ��� k}f�s���3�7�	�3�\\����ZI{�l%/���d�8��g���������Z�ٱ�O|','2016-07-14 07:59:04','2016-07-14 07:59:04');

/*Table structure for table `fetcher_rfid_students` */

DROP TABLE IF EXISTS `fetcher_rfid_students`;

CREATE TABLE `fetcher_rfid_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fetcher_id` int(11) DEFAULT NULL,
  `rfid_student_id` int(11) DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fetcher_rfid_students` */

/*Table structure for table `fetchers` */

DROP TABLE IF EXISTS `fetchers`;

CREATE TABLE `fetchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fetchers` */

insert  into `fetchers`(`id`,`last_name`,`first_name`,`middle_name`,`created`,`modified`) values (1,'Biscocho','Paulo','Tasico','2016-07-14','2016-07-14'),(2,'Llanes','Kenneth',' ','2016-07-14','2016-07-14'),(3,'Salazar','Ehlmon Jeff ','Besarez  ','2016-07-14','2016-07-14'),(4,'Kendall','Jenner',' ','2016-07-14','2016-07-14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
