/*
SQLyog Community v12.2.5 (32 bit)
MySQL - 5.7.13-0ubuntu0.16.04.2 : Database - ausi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ausi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ausi`;

/*Table structure for table `expressions` */

DROP TABLE IF EXISTS `expressions`;

CREATE TABLE `expressions` (
  `type_exp` varchar(50) DEFAULT NULL,
  `class_exp` varchar(50) DEFAULT NULL,
  `expression` varchar(500) DEFAULT NULL,
  `return_exp` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `general` */

DROP TABLE IF EXISTS `general`;

CREATE TABLE `general` (
  `token` varchar(30) DEFAULT NULL,
  `last_state` varchar(50) DEFAULT NULL,
  `last_state_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `params` */

DROP TABLE IF EXISTS `params`;

CREATE TABLE `params` (
  `token` varchar(50) DEFAULT NULL,
  `param_id` varchar(500) DEFAULT NULL,
  `param_value` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
