/*
SQLyog Ultimate v8.55 
MySQL - 5.6.21-log : Database - voucherpool
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`voucherpool` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `voucherpool`;

/*Table structure for table `offer` */

CREATE TABLE `offer` (
  `id_offer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `discount` decimal(3,0) NOT NULL,
  PRIMARY KEY (`id_offer`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `offer` */

insert  into `offer`(`id_offer`,`name`,`discount`) values (1,'Black Friday 35% OFF','35'),(2,'Birthday Discount 25%','25'),(3,'Happy Valantines Day 20% OFF','20');

/*Table structure for table `recipient` */

CREATE TABLE `recipient` (
  `id_recipient` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(65) NOT NULL,
  PRIMARY KEY (`id_recipient`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `recipient` */

insert  into `recipient`(`id_recipient`,`name`,`email`) values (1,'John Smith','john@gmail.com'),(2,'Mike Jackson','mike@hotmail.com'),(3,'Julie Roberts','julie@me.com'),(5,'Rodrigo Santa Maria','rodrigo@digitallymade.com.br'),(6,'Paul Karpackie','paul@gmail.com'),(7,'manik','manik782@gmail.com');

/*Table structure for table `voucher` */

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL AUTO_INCREMENT,
  `id_recipient` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `date_expiration` date NOT NULL,
  `date_usage` date DEFAULT NULL,
  `code` varchar(8) NOT NULL,
  PRIMARY KEY (`id_voucher`),
  KEY `fk_voucher_recipient_idx` (`id_recipient`),
  KEY `fk_voucher_offer1_idx` (`id_offer`),
  CONSTRAINT `fk_voucher_offer1` FOREIGN KEY (`id_offer`) REFERENCES `offer` (`id_offer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_voucher_recipient` FOREIGN KEY (`id_recipient`) REFERENCES `recipient` (`id_recipient`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `voucher` */

insert  into `voucher`(`id_voucher`,`id_recipient`,`id_offer`,`date_expiration`,`date_usage`,`code`) values (1,1,1,'2017-11-13','2017-11-12','I5RD8B6P'),(2,2,1,'2017-11-13','2017-11-11','8GXACIZ2'),(3,3,1,'2017-11-13','2017-11-11','N2PFX3O9'),(4,5,1,'2017-11-13','2017-11-09','5ZFB3804'),(5,1,3,'2018-06-12','2017-11-10','QU96DRY1'),(6,2,3,'2018-06-12','2017-11-12','JAQ8GNOZ'),(8,5,3,'2016-06-12',NULL,'KXQY8BHO'),(9,1,2,'2018-06-06','2017-11-12','15WJGYQ3'),(10,2,2,'2018-06-06','2017-11-12','MN8J6TDK'),(11,3,2,'2018-06-06',NULL,'TODISGBP'),(12,5,2,'2018-06-06',NULL,'OMG0NSXK'),(13,1,1,'2020-10-10',NULL,'L14J56FT'),(14,2,1,'2020-10-10',NULL,'30L81WPA'),(15,3,1,'2020-10-10',NULL,'LMY7TUQA'),(16,5,1,'2020-10-10',NULL,'DCSH6YQ9'),(17,6,1,'2020-10-10',NULL,'1SO450G9'),(18,7,1,'2018-08-13',NULL,'sdfsdfdf'),(19,1,1,'2018-08-19',NULL,'51N24CXL'),(20,2,1,'2018-08-19',NULL,'B2Q0MK8G'),(21,3,1,'2018-08-19',NULL,'U4C5IWGZ'),(22,5,1,'2018-08-19',NULL,'O0HW3EVY'),(23,6,1,'2018-08-19',NULL,'CN8DJ79U'),(24,7,1,'2018-08-19',NULL,'0QD3OHK9');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
