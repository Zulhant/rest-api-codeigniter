/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.28-MariaDB : Database - nst_mo_info
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nst_mo_info` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `nst_mo_info`;

/*Table structure for table `mo_info_apartment` */

DROP TABLE IF EXISTS `mo_info_apartment`;

CREATE TABLE `mo_info_apartment` (
  `apartment_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_management_id` int(10) unsigned DEFAULT NULL,
  `apartment_developer_id` int(10) unsigned NOT NULL,
  `apartment_name` varchar(45) DEFAULT NULL,
  `apartment_desc` text,
  `apartment_address` text,
  `apartment_district_id` int(10) unsigned DEFAULT NULL,
  `apartment_postal_code` varchar(6) DEFAULT NULL,
  `apartment_latitude` double DEFAULT NULL,
  `apartment_longitude` double DEFAULT NULL,
  `apartment_street_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`apartment_id`),
  KEY `apartment_district_id` (`apartment_district_id`),
  KEY `mo_info_apartment_ibfk_1` (`apartment_management_id`),
  KEY `mo_info_apartment_ibfk_2` (`apartment_developer_id`),
  CONSTRAINT `mo_info_apartment_ibfk_1` FOREIGN KEY (`apartment_management_id`) REFERENCES `mo_info_management` (`management_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_ibfk_2` FOREIGN KEY (`apartment_developer_id`) REFERENCES `mo_info_developer` (`developer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_ibfk_3` FOREIGN KEY (`apartment_district_id`) REFERENCES `mo_info_district` (`district_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment` */

insert  into `mo_info_apartment`(`apartment_id`,`apartment_management_id`,`apartment_developer_id`,`apartment_name`,`apartment_desc`,`apartment_address`,`apartment_district_id`,`apartment_postal_code`,`apartment_latitude`,`apartment_longitude`,`apartment_street_name`) values 
(1,0,1,'Meikarta','Meikarta apartment','Jakarta Selatan',3,'53504',45634,353535,'Jl. Sesuatu'),
(20,0,2,'Udayana','Jalan Mangga Dua ','Jalan Mangga 2',3,'74374',456656,3446346,'Jalan Suasana'),
(21,0,1,'Hamid','Jalan Udayana	','Jln Ambon data',3,'24444',24444,453436,'Jalan Mangga Dua');

/*Table structure for table `mo_info_apartment_certificate` */

DROP TABLE IF EXISTS `mo_info_apartment_certificate`;

CREATE TABLE `mo_info_apartment_certificate` (
  `apartment_certificate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_certificate_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`apartment_certificate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_certificate` */

insert  into `mo_info_apartment_certificate`(`apartment_certificate_id`,`apartment_certificate_name`) values 
(1,'SHM'),
(2,'MSA');

/*Table structure for table `mo_info_apartment_facility_type` */

DROP TABLE IF EXISTS `mo_info_apartment_facility_type`;

CREATE TABLE `mo_info_apartment_facility_type` (
  `apartment_facility_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_facility_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`apartment_facility_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_facility_type` */

insert  into `mo_info_apartment_facility_type`(`apartment_facility_type_id`,`apartment_facility_type_name`) values 
(1,'Kolam Renang'),
(2,'Parking Area'),
(3,'Playground');

/*Table structure for table `mo_info_apartment_picture` */

DROP TABLE IF EXISTS `mo_info_apartment_picture`;

CREATE TABLE `mo_info_apartment_picture` (
  `apartment_picture_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_picture_apartment_id` int(10) unsigned DEFAULT NULL,
  `apartment_picture_value` text,
  `apartment_picture_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`apartment_picture_id`),
  KEY `apartment_picture_apartment_id` (`apartment_picture_apartment_id`),
  CONSTRAINT `mo_info_apartment_picture_ibfk_1` FOREIGN KEY (`apartment_picture_apartment_id`) REFERENCES `mo_info_apartment` (`apartment_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_picture` */

insert  into `mo_info_apartment_picture`(`apartment_picture_id`,`apartment_picture_apartment_id`,`apartment_picture_value`,`apartment_picture_datetime`) values 
(1,1,'img1','2018-01-08 10:56:02'),
(2,20,'2','2018-01-15 14:25:56'),
(3,21,'22','2018-01-15 14:26:07');

/*Table structure for table `mo_info_apartment_tower` */

DROP TABLE IF EXISTS `mo_info_apartment_tower`;

CREATE TABLE `mo_info_apartment_tower` (
  `apartment_tower_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_tower_apartment_id` int(10) unsigned NOT NULL,
  `apartment_tower_name` varchar(45) DEFAULT NULL,
  `apartment_tower_latitude` double DEFAULT NULL,
  `apartment_tower_longitude` double DEFAULT NULL,
  `apartment_tower_total_room` int(5) unsigned DEFAULT NULL,
  `apartment_tower_total_floor` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`apartment_tower_id`,`apartment_tower_apartment_id`),
  KEY `mo_info_apartment_tower_ibfk_1` (`apartment_tower_apartment_id`),
  CONSTRAINT `mo_info_apartment_tower_ibfk_1` FOREIGN KEY (`apartment_tower_apartment_id`) REFERENCES `mo_info_apartment` (`apartment_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_tower` */

insert  into `mo_info_apartment_tower`(`apartment_tower_id`,`apartment_tower_apartment_id`,`apartment_tower_name`,`apartment_tower_latitude`,`apartment_tower_longitude`,`apartment_tower_total_room`,`apartment_tower_total_floor`) values 
(1,1,'Tower A',0,0,200,30),
(2,1,'Tower B',0,0,150,25),
(3,1,'Tower C',0,0,150,25);

/*Table structure for table `mo_info_apartment_tower_facility` */

DROP TABLE IF EXISTS `mo_info_apartment_tower_facility`;

CREATE TABLE `mo_info_apartment_tower_facility` (
  `apartment_tower_facility_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_tower_facility_apartment_tower_id` int(10) unsigned NOT NULL,
  `apartment_tower_facility_apartment_facility_type_id` int(10) unsigned DEFAULT NULL,
  `apartment_tower_facility_desc` text,
  PRIMARY KEY (`apartment_tower_facility_id`,`apartment_tower_facility_apartment_tower_id`),
  KEY `apartment_tower_facility_apartment_tower_id` (`apartment_tower_facility_apartment_tower_id`),
  KEY `apartment_tower_facility_apartment_facility_type_id` (`apartment_tower_facility_apartment_facility_type_id`),
  CONSTRAINT `mo_info_apartment_tower_facility_ibfk_1` FOREIGN KEY (`apartment_tower_facility_apartment_tower_id`) REFERENCES `mo_info_apartment_tower` (`apartment_tower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_tower_facility_ibfk_2` FOREIGN KEY (`apartment_tower_facility_apartment_facility_type_id`) REFERENCES `mo_info_apartment_facility_type` (`apartment_facility_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_tower_facility` */

insert  into `mo_info_apartment_tower_facility`(`apartment_tower_facility_id`,`apartment_tower_facility_apartment_tower_id`,`apartment_tower_facility_apartment_facility_type_id`,`apartment_tower_facility_desc`) values 
(1,1,1,'Free kolam renang'),
(2,1,2,'Tempat parkirnya guys'),
(3,2,1,'Ada kolam renangnya lo'),
(4,2,2,'Ada jga tempatkarinya lo'),
(5,3,1,'Ini jga free kolam renang ternyta'),
(6,3,3,'Ada playgroundnya jga guys'),
(7,3,2,'Wah manteb nih ada tmpat parkir gratis jga');

/*Table structure for table `mo_info_apartment_tower_picture` */

DROP TABLE IF EXISTS `mo_info_apartment_tower_picture`;

CREATE TABLE `mo_info_apartment_tower_picture` (
  `apartment_tower_picture_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_tower_picture_apartment_tower_id` int(10) unsigned NOT NULL,
  `apartment_tower_picture_value` text,
  PRIMARY KEY (`apartment_tower_picture_id`,`apartment_tower_picture_apartment_tower_id`),
  KEY `apartment_tower_picture_apartment_tower_id` (`apartment_tower_picture_apartment_tower_id`),
  CONSTRAINT `mo_info_apartment_tower_picture_ibfk_1` FOREIGN KEY (`apartment_tower_picture_apartment_tower_id`) REFERENCES `mo_info_apartment_tower` (`apartment_tower_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_tower_picture` */

insert  into `mo_info_apartment_tower_picture`(`apartment_tower_picture_id`,`apartment_tower_picture_apartment_tower_id`,`apartment_tower_picture_value`) values 
(1,1,'img1.jpg'),
(2,2,'img2.jpg'),
(3,3,'img3.jpg'),
(4,1,'img6.jpg');

/*Table structure for table `mo_info_apartment_transportation` */

DROP TABLE IF EXISTS `mo_info_apartment_transportation`;

CREATE TABLE `mo_info_apartment_transportation` (
  `apartment_transportation_id` int(45) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_transportation_name` varchar(45) DEFAULT NULL,
  `apartment_transportation_type` enum('Bus Station','Train Station','Bus Stop','Airport') DEFAULT NULL,
  PRIMARY KEY (`apartment_transportation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_transportation` */

insert  into `mo_info_apartment_transportation`(`apartment_transportation_id`,`apartment_transportation_name`,`apartment_transportation_type`) values 
(1,'Busway','Bus Station'),
(2,'Damri','Bus Station'),
(3,'Damari 2','Train Station');

/*Table structure for table `mo_info_apartment_transportation_access` */

DROP TABLE IF EXISTS `mo_info_apartment_transportation_access`;

CREATE TABLE `mo_info_apartment_transportation_access` (
  `apartment_transportation_access_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_transportation_access_apartment_id` int(20) unsigned NOT NULL,
  `apartment_transportation_access_apartment_transportation_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`apartment_transportation_access_id`,`apartment_transportation_access_apartment_id`),
  KEY `apartment_transportation_access_apartment_id` (`apartment_transportation_access_apartment_id`),
  KEY `apartment_transportation_access_apartment_transportation_id` (`apartment_transportation_access_apartment_transportation_id`),
  CONSTRAINT `mo_info_apartment_transportation_access_ibfk_1` FOREIGN KEY (`apartment_transportation_access_apartment_id`) REFERENCES `mo_info_apartment` (`apartment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_transportation_access_ibfk_2` FOREIGN KEY (`apartment_transportation_access_apartment_transportation_id`) REFERENCES `mo_info_apartment_transportation` (`apartment_transportation_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_transportation_access` */

insert  into `mo_info_apartment_transportation_access`(`apartment_transportation_access_id`,`apartment_transportation_access_apartment_id`,`apartment_transportation_access_apartment_transportation_id`) values 
(1,1,1),
(2,20,2),
(3,21,3);

/*Table structure for table `mo_info_apartment_unit` */

DROP TABLE IF EXISTS `mo_info_apartment_unit`;

CREATE TABLE `mo_info_apartment_unit` (
  `apartment_unit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_apartment_tower_id` int(20) unsigned NOT NULL,
  `apartment_unit_apartment_unit_type_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_certificate_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_payment_method_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_name` varchar(45) DEFAULT NULL,
  `apartment_unit_desc` text,
  `apartment_unit_datetime` datetime DEFAULT NULL,
  `apartment_unit_date` date DEFAULT NULL,
  `apartment_unit_price` int(25) unsigned DEFAULT NULL,
  `apartment_unit_is_sold` tinyint(1) DEFAULT '0',
  `apartment_unit_floor` int(5) unsigned DEFAULT NULL,
  `apartment_unit_electric_power_capacity` int(10) unsigned DEFAULT NULL,
  `apartment_unit_room_number` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`apartment_unit_id`,`apartment_unit_apartment_tower_id`),
  KEY `apartment_unit_apartment_unit_type_id` (`apartment_unit_apartment_unit_type_id`),
  KEY `apartment_unit_certificate_id` (`apartment_unit_certificate_id`),
  KEY `apartment_unit_payment_method_id` (`apartment_unit_payment_method_id`),
  KEY `mo_info_apartment_unit_ibfk_1` (`apartment_unit_apartment_tower_id`),
  CONSTRAINT `mo_info_apartment_unit_ibfk_1` FOREIGN KEY (`apartment_unit_apartment_tower_id`) REFERENCES `mo_info_apartment_tower` (`apartment_tower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_ibfk_2` FOREIGN KEY (`apartment_unit_apartment_unit_type_id`) REFERENCES `mo_info_apartment_unit_type` (`apartment_unit_type_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_ibfk_3` FOREIGN KEY (`apartment_unit_certificate_id`) REFERENCES `mo_info_apartment_certificate` (`apartment_certificate_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_ibfk_4` FOREIGN KEY (`apartment_unit_payment_method_id`) REFERENCES `mo_info_payment_method` (`payment_method_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit` */

insert  into `mo_info_apartment_unit`(`apartment_unit_id`,`apartment_unit_apartment_tower_id`,`apartment_unit_apartment_unit_type_id`,`apartment_unit_certificate_id`,`apartment_unit_payment_method_id`,`apartment_unit_name`,`apartment_unit_desc`,`apartment_unit_datetime`,`apartment_unit_date`,`apartment_unit_price`,`apartment_unit_is_sold`,`apartment_unit_floor`,`apartment_unit_electric_power_capacity`,`apartment_unit_room_number`) values 
(1,1,1,2,1,'Metta','Apartment yang memiliki beragam pilihan menarik','2018-01-23 14:25:28','2018-01-08',1230000,0,231,233,123),
(2,1,2,1,1,'Matta2','Apertment yang memilii lantai luas','2018-01-08 14:27:00','2018-01-08',12300000,0,123,21,124),
(3,2,1,2,1,'Crocodile','Luas dan Pemandangan Erotis','2018-01-10 13:31:31',NULL,1239393,0,454,43,345),
(4,3,1,1,NULL,'paylist','Apartmen Mewah dikawasan  asia tenggara','2018-01-10 00:00:00',NULL,1200000,0,123,124,23);

/*Table structure for table `mo_info_apartment_unit_facility` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_facility`;

CREATE TABLE `mo_info_apartment_unit_facility` (
  `apartment_unit_facility_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_facility_apartment_unit_id` int(10) unsigned NOT NULL,
  `apartment_unit_facility_apartment_facility_type_id` int(10) unsigned NOT NULL,
  `apartment_unit_facility_desc` text,
  PRIMARY KEY (`apartment_unit_facility_id`,`apartment_unit_facility_apartment_unit_id`),
  KEY `apartment_unit_facility_apartment_unit_id` (`apartment_unit_facility_apartment_unit_id`),
  KEY `mo_info_apartment_unit_facility_ibfk_2` (`apartment_unit_facility_apartment_facility_type_id`),
  CONSTRAINT `mo_info_apartment_unit_facility_ibfk_1` FOREIGN KEY (`apartment_unit_facility_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_facility_ibfk_2` FOREIGN KEY (`apartment_unit_facility_apartment_facility_type_id`) REFERENCES `mo_info_apartment_facility_type` (`apartment_facility_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_facility` */

insert  into `mo_info_apartment_unit_facility`(`apartment_unit_facility_id`,`apartment_unit_facility_apartment_unit_id`,`apartment_unit_facility_apartment_facility_type_id`,`apartment_unit_facility_desc`) values 
(1,1,2,'pasilitas yang murdah dan meriah'),
(2,1,1,'Pasitas yang mewah dan bla bla'),
(3,2,2,'Pasitas yang mewah dan bla bla bla'),
(4,2,1,'Pasitas yang mewah dan bla bla enak'),
(5,3,1,'mantap'),
(11,4,1,'Mewah dengan Aroma Kopi yang bahagia');

/*Table structure for table `mo_info_apartment_unit_facility_type` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_facility_type`;

CREATE TABLE `mo_info_apartment_unit_facility_type` (
  `apartment_unit_facility_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_facility_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`apartment_unit_facility_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_facility_type` */

insert  into `mo_info_apartment_unit_facility_type`(`apartment_unit_facility_type_id`,`apartment_unit_facility_type_name`) values 
(1,'Kolam Renang'),
(2,'ATM Bang');

/*Table structure for table `mo_info_apartment_unit_payment_option` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_payment_option`;

CREATE TABLE `mo_info_apartment_unit_payment_option` (
  `apartment_unit_payment_option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_payment_option_apartment_unit_id` int(10) unsigned NOT NULL,
  `apartment_unit_payment_option_payment_method_id` int(10) unsigned NOT NULL,
  `apartment_unit_payment_option_bank_id` int(10) unsigned NOT NULL,
  `apartment_unit_payment_option_account_number` varchar(100) DEFAULT NULL,
  `apartment_unit_payment_option_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`apartment_unit_payment_option_id`,`apartment_unit_payment_option_apartment_unit_id`,`apartment_unit_payment_option_payment_method_id`,`apartment_unit_payment_option_bank_id`),
  KEY `apartment_unit_payment_option_apartment_unit_id` (`apartment_unit_payment_option_apartment_unit_id`),
  KEY `apartment_unit_payment_option_payment_method_id` (`apartment_unit_payment_option_payment_method_id`),
  KEY `apartment_unit_payment_option_bank_id` (`apartment_unit_payment_option_bank_id`),
  CONSTRAINT `mo_info_apartment_unit_payment_option_ibfk_1` FOREIGN KEY (`apartment_unit_payment_option_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_payment_option_ibfk_2` FOREIGN KEY (`apartment_unit_payment_option_payment_method_id`) REFERENCES `mo_info_payment_method` (`payment_method_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_payment_option_ibfk_3` FOREIGN KEY (`apartment_unit_payment_option_bank_id`) REFERENCES `mo_info_bank` (`bank_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_payment_option` */

insert  into `mo_info_apartment_unit_payment_option`(`apartment_unit_payment_option_id`,`apartment_unit_payment_option_apartment_unit_id`,`apartment_unit_payment_option_payment_method_id`,`apartment_unit_payment_option_bank_id`,`apartment_unit_payment_option_account_number`,`apartment_unit_payment_option_datetime`) values 
(1,1,1,1,'4355656456644646','2018-02-09 14:46:46'),
(3,2,1,2,'5634654545666333','2018-01-08 14:47:08'),
(4,3,1,2,'654456566645335','2018-01-10 13:35:04'),
(7,4,1,2,'5321111111','0000-00-00 00:00:00');

/*Table structure for table `mo_info_apartment_unit_picture` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_picture`;

CREATE TABLE `mo_info_apartment_unit_picture` (
  `apartment_unit_picture_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_picture_apartment_unit_id` int(20) unsigned DEFAULT NULL,
  `apartment_unit_picture_value` text,
  `apartment_unit_picture_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`apartment_unit_picture_id`),
  KEY `mo_info_apartment_unit_picture_ibfk_1` (`apartment_unit_picture_apartment_unit_id`),
  CONSTRAINT `mo_info_apartment_unit_picture_ibfk_1` FOREIGN KEY (`apartment_unit_picture_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_picture` */

insert  into `mo_info_apartment_unit_picture`(`apartment_unit_picture_id`,`apartment_unit_picture_apartment_unit_id`,`apartment_unit_picture_value`,`apartment_unit_picture_datetime`) values 
(1,1,'p1.jpg','2018-01-08 14:49:20'),
(2,1,'p2.jpg','2018-01-08 14:49:33'),
(3,1,'P3.jpg','2018-01-08 14:49:44'),
(4,2,'p4.jpg','2018-01-08 14:50:00'),
(5,2,'p5.jpg','2018-01-08 14:50:10'),
(6,3,'unit3.jpg','2018-01-10 13:35:29'),
(7,3,'unit3.jpg','2018-01-10 13:49:40'),
(8,3,'gg',NULL),
(9,4,'aque21.jpg','0000-00-00 00:00:00');

/*Table structure for table `mo_info_apartment_unit_promo` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_promo`;

CREATE TABLE `mo_info_apartment_unit_promo` (
  `apartment_unit_promo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_promo_apartment_unit_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_promo_promo_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_promo_datetime` datetime DEFAULT NULL,
  `apartment_unit_promo_price` int(40) unsigned DEFAULT NULL,
  PRIMARY KEY (`apartment_unit_promo_id`),
  KEY `mo_info_apartment_unit_promo_ibfk_1` (`apartment_unit_promo_apartment_unit_id`),
  KEY `mo_info_apartment_unit_promo_ibfk_2` (`apartment_unit_promo_promo_id`),
  CONSTRAINT `mo_info_apartment_unit_promo_ibfk_1` FOREIGN KEY (`apartment_unit_promo_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_promo_ibfk_2` FOREIGN KEY (`apartment_unit_promo_promo_id`) REFERENCES `mo_info_promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_promo` */

/*Table structure for table `mo_info_apartment_unit_transaction` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_transaction`;

CREATE TABLE `mo_info_apartment_unit_transaction` (
  `apartment_unit_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_transaction_customer_id` int(10) unsigned NOT NULL,
  `apartment_unit_transaction_marketing_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_transaction_apartment_unit_id` int(10) unsigned DEFAULT NULL,
  `apartment_unit_transaction_datetime` datetime DEFAULT NULL,
  `apartment_unit_transaction_price` int(45) unsigned DEFAULT NULL,
  `apartment_unit_transaction_status` enum('Paid','Cancel','Expired','Pending') DEFAULT 'Pending',
  `apartment_unit_transaction_expired_datetime` date DEFAULT NULL,
  `apartment_unit_transaction_info` text,
  PRIMARY KEY (`apartment_unit_transaction_id`,`apartment_unit_transaction_customer_id`),
  KEY `apartmen_buy_agent_marketing_id` (`apartment_unit_transaction_marketing_id`),
  KEY `apartmen_buy_apartment_unit_id` (`apartment_unit_transaction_apartment_unit_id`),
  KEY `mo_info_apartment_unit_transaction_ibfk_1` (`apartment_unit_transaction_customer_id`),
  CONSTRAINT `mo_info_apartment_unit_transaction_ibfk_1` FOREIGN KEY (`apartment_unit_transaction_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_transaction_ibfk_2` FOREIGN KEY (`apartment_unit_transaction_marketing_id`) REFERENCES `mo_info_marketing` (`marketing_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_apartment_unit_transaction_ibfk_3` FOREIGN KEY (`apartment_unit_transaction_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_transaction` */

insert  into `mo_info_apartment_unit_transaction`(`apartment_unit_transaction_id`,`apartment_unit_transaction_customer_id`,`apartment_unit_transaction_marketing_id`,`apartment_unit_transaction_apartment_unit_id`,`apartment_unit_transaction_datetime`,`apartment_unit_transaction_price`,`apartment_unit_transaction_status`,`apartment_unit_transaction_expired_datetime`,`apartment_unit_transaction_info`) values 
(1,1,1,1,'2018-01-15 16:30:35',123000,'Pending','2018-01-15','gggggg'),
(2,2,2,2,'2018-01-15 16:31:32',4556456,'Pending',NULL,'grtret'),
(3,4,1,2,'2018-01-15 16:32:22',64646645,'Pending',NULL,'46456');

/*Table structure for table `mo_info_apartment_unit_type` */

DROP TABLE IF EXISTS `mo_info_apartment_unit_type`;

CREATE TABLE `mo_info_apartment_unit_type` (
  `apartment_unit_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_unit_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`apartment_unit_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_apartment_unit_type` */

insert  into `mo_info_apartment_unit_type`(`apartment_unit_type_id`,`apartment_unit_type_name`) values 
(1,'Type A'),
(2,'Type B');

/*Table structure for table `mo_info_bank` */

DROP TABLE IF EXISTS `mo_info_bank`;

CREATE TABLE `mo_info_bank` (
  `bank_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_picture` text,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_bank` */

insert  into `mo_info_bank`(`bank_id`,`bank_name`,`bank_picture`) values 
(1,'BRI','bri.jpg'),
(2,'Mandiri','Mandiri.jpg'),
(3,'BNI','bni.jpg'),
(4,'BCA','bca.jpg');

/*Table structure for table `mo_info_chat` */

DROP TABLE IF EXISTS `mo_info_chat`;

CREATE TABLE `mo_info_chat` (
  `chat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_customer_id` int(10) unsigned DEFAULT NULL,
  `chat_marketing_id` int(10) unsigned DEFAULT NULL,
  `chat_datetime` datetime DEFAULT NULL,
  `chat_ip_address` varchar(7) DEFAULT NULL,
  `chat_message` text,
  `chat_date` date DEFAULT NULL,
  `chat_is_marketing_online` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `mo_info_chat_ibfk_2` (`chat_marketing_id`),
  KEY `chat_customer_id` (`chat_customer_id`),
  CONSTRAINT `mo_info_chat_ibfk_2` FOREIGN KEY (`chat_marketing_id`) REFERENCES `mo_info_marketing` (`marketing_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `mo_info_chat_ibfk_3` FOREIGN KEY (`chat_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_chat` */

/*Table structure for table `mo_info_city` */

DROP TABLE IF EXISTS `mo_info_city`;

CREATE TABLE `mo_info_city` (
  `city_id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(20) DEFAULT NULL,
  `city_province_id` int(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`city_id`),
  KEY `mo_info_city_ibfk_1` (`city_province_id`),
  CONSTRAINT `mo_info_city_ibfk_1` FOREIGN KEY (`city_province_id`) REFERENCES `mo_info_province` (`province_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_city` */

insert  into `mo_info_city`(`city_id`,`city_name`,`city_province_id`) values 
(4,'Jakarta Barat',2),
(9,'Jakarta Timur',2),
(10,'Jakarta Selatan',NULL),
(11,'Jakarta Utara',NULL);

/*Table structure for table `mo_info_contact_type` */

DROP TABLE IF EXISTS `mo_info_contact_type`;

CREATE TABLE `mo_info_contact_type` (
  `contact_type_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`contact_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_contact_type` */

insert  into `mo_info_contact_type`(`contact_type_id`,`contact_type_name`) values 
(1,'Facebook'),
(2,'Twitter'),
(3,'Ghitub');

/*Table structure for table `mo_info_country` */

DROP TABLE IF EXISTS `mo_info_country`;

CREATE TABLE `mo_info_country` (
  `country_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_country` */

insert  into `mo_info_country`(`country_id`,`country_name`) values 
(1,'Indonesia');

/*Table structure for table `mo_info_customer` */

DROP TABLE IF EXISTS `mo_info_customer`;

CREATE TABLE `mo_info_customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_user_account_id` int(10) unsigned NOT NULL,
  `customer_address` text,
  `customer_job` varchar(45) DEFAULT NULL,
  `customer_email` varchar(45) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_latitude` double DEFAULT '0',
  `customer_longitude` double DEFAULT '0',
  `customer_street_name` varchar(45) DEFAULT NULL,
  `customer_district_id` int(10) unsigned DEFAULT NULL,
  `customer_postal_code` varchar(7) DEFAULT NULL,
  `customer_first_name` varchar(45) DEFAULT NULL,
  `customer_last_name` varchar(45) DEFAULT NULL,
  `customer_date_of_birth` date DEFAULT NULL,
  `customer_gender` enum('Male','Female') DEFAULT 'Male',
  PRIMARY KEY (`customer_id`,`customer_user_account_id`),
  KEY `customer_user_account_id` (`customer_user_account_id`),
  KEY `customer_district_id` (`customer_district_id`),
  CONSTRAINT `mo_info_customer_ibfk_1` FOREIGN KEY (`customer_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_customer_ibfk_3` FOREIGN KEY (`customer_district_id`) REFERENCES `mo_info_district` (`district_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_customer` */

insert  into `mo_info_customer`(`customer_id`,`customer_user_account_id`,`customer_address`,`customer_job`,`customer_email`,`customer_phone`,`customer_latitude`,`customer_longitude`,`customer_street_name`,`customer_district_id`,`customer_postal_code`,`customer_first_name`,`customer_last_name`,`customer_date_of_birth`,`customer_gender`) values 
(1,3,'Jalan Mangga 2 Nomor 23 RT 4 211','Programer nst','ameng@gmail.com','085238675915',320,3838383,'Jalan Mangga dua',3,'737373+','Edo ','Muhammad','0000-00-00','Male'),
(2,2,'Jalan Mangga 2 Nomor 23 RT 4 211','Programer nst','ameng@gmail.com','085238675915',320,3838383,'Jalan Mangga dua',3,'737373+','Hari Irawan','Irawan','0000-00-00','Male'),
(4,4,'Jalan Mangga 2','Programer Nts','zulah@yahoo.com','373738738383',231,283838,'Jalan Mangga Satu',3,'3838383','zulhan','arif',NULL,'Male');

/*Table structure for table `mo_info_customer_lat_long` */

DROP TABLE IF EXISTS `mo_info_customer_lat_long`;

CREATE TABLE `mo_info_customer_lat_long` (
  `customer_lat_long_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_lat_long_customer_id` int(10) unsigned NOT NULL,
  `customer_lat_long_latitude` double DEFAULT '0',
  `customer_lat_long_logitude` double DEFAULT '0',
  `customer_lat_long_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_lat_long_id`,`customer_lat_long_customer_id`),
  KEY `mo_info_customer_lat_long_ibfk_1` (`customer_lat_long_customer_id`),
  CONSTRAINT `mo_info_customer_lat_long_ibfk_1` FOREIGN KEY (`customer_lat_long_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_customer_lat_long` */

insert  into `mo_info_customer_lat_long`(`customer_lat_long_id`,`customer_lat_long_customer_id`,`customer_lat_long_latitude`,`customer_lat_long_logitude`,`customer_lat_long_datetime`) values 
(1,1,78437864,534366435,'2018-01-08 12:55:11'),
(1,2,4543534,3456436,'2018-01-08 12:55:46');

/*Table structure for table `mo_info_customer_referal` */

DROP TABLE IF EXISTS `mo_info_customer_referal`;

CREATE TABLE `mo_info_customer_referal` (
  `customer_referal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_referal_marketing_id` int(10) unsigned NOT NULL,
  `customer_referal_date` date DEFAULT NULL,
  `customer_referal_datetime` datetime DEFAULT NULL,
  `customer_referal_customer_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`customer_referal_id`,`customer_referal_marketing_id`),
  KEY `mo_info_customer_referal_ibfk_3` (`customer_referal_customer_id`),
  KEY `mo_info_customer_referal_ibfk_4` (`customer_referal_marketing_id`),
  CONSTRAINT `mo_info_customer_referal_ibfk_3` FOREIGN KEY (`customer_referal_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_customer_referal_ibfk_4` FOREIGN KEY (`customer_referal_marketing_id`) REFERENCES `mo_info_marketing` (`marketing_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_customer_referal` */

insert  into `mo_info_customer_referal`(`customer_referal_id`,`customer_referal_marketing_id`,`customer_referal_date`,`customer_referal_datetime`,`customer_referal_customer_id`) values 
(1,1,'2018-01-15','2018-01-15 15:41:32',1),
(2,2,'2018-01-15','2018-01-15 15:41:44',2);

/*Table structure for table `mo_info_customer_social_media` */

DROP TABLE IF EXISTS `mo_info_customer_social_media`;

CREATE TABLE `mo_info_customer_social_media` (
  `customer_social_media_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_social_media_customer_id` int(10) unsigned NOT NULL,
  `customer_social_media_social_type_id` int(10) unsigned DEFAULT NULL,
  `customer_social_media_link` text,
  PRIMARY KEY (`customer_social_media_id`,`customer_social_media_customer_id`),
  KEY `mo_info_customer_social_media_ibfk_1` (`customer_social_media_customer_id`),
  KEY `mo_info_customer_social_media_ibfk_2` (`customer_social_media_social_type_id`),
  CONSTRAINT `mo_info_customer_social_media_ibfk_1` FOREIGN KEY (`customer_social_media_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_customer_social_media_ibfk_2` FOREIGN KEY (`customer_social_media_social_type_id`) REFERENCES `mo_info_social_media_type` (`social_media_type`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_customer_social_media` */

insert  into `mo_info_customer_social_media`(`customer_social_media_id`,`customer_social_media_customer_id`,`customer_social_media_social_type_id`,`customer_social_media_link`) values 
(1,1,1,'http:fb.com'),
(12,2,NULL,NULL),
(13,1,1,'http:fb.com'),
(14,2,1,'http:fb.com'),
(15,2,1,'http:fb.com'),
(19,2,2,'http://twittter.com/arif');

/*Table structure for table `mo_info_developer` */

DROP TABLE IF EXISTS `mo_info_developer`;

CREATE TABLE `mo_info_developer` (
  `developer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `developer_name` varchar(45) DEFAULT NULL,
  `developer_desc` text,
  `developer_picture` text,
  `developer_address` text,
  `developer_district_id` int(10) unsigned DEFAULT NULL,
  `developer_street_name` varchar(45) DEFAULT NULL,
  `developer_postal_code` varchar(7) DEFAULT NULL,
  `developer_developer_specialize_id` int(45) unsigned DEFAULT NULL,
  PRIMARY KEY (`developer_id`),
  KEY `developer_district_id` (`developer_district_id`),
  KEY `developer_developer_specialize_id` (`developer_developer_specialize_id`),
  CONSTRAINT `mo_info_developer_ibfk_1` FOREIGN KEY (`developer_district_id`) REFERENCES `mo_info_district` (`district_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_developer_ibfk_2` FOREIGN KEY (`developer_developer_specialize_id`) REFERENCES `mo_info_developer_specialize` (`developer_specialize_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_developer` */

insert  into `mo_info_developer`(`developer_id`,`developer_name`,`developer_desc`,`developer_picture`,`developer_address`,`developer_district_id`,`developer_street_name`,`developer_postal_code`,`developer_developer_specialize_id`) values 
(1,'Developer A','Developer description','dev1.jpg','Jl. Mangga 2',3,'Jl. Mangga 2','52534',1),
(2,'PT Nusa Karya Mandiri','perusahaan global dan berjkarya','dev.jpg','Jalan Mangga Raya',3,'Jaln Mangga 2','83839',1);

/*Table structure for table `mo_info_developer_contact` */

DROP TABLE IF EXISTS `mo_info_developer_contact`;

CREATE TABLE `mo_info_developer_contact` (
  `developer_contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `developer_contact_developer_id` int(10) unsigned NOT NULL,
  `developer_contact_contact_type_id` int(10) DEFAULT NULL,
  `developer_contact_contact_value` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`developer_contact_id`,`developer_contact_developer_id`),
  KEY `mo_info_developer_contact_ibfk_1` (`developer_contact_developer_id`),
  CONSTRAINT `mo_info_developer_contact_ibfk_1` FOREIGN KEY (`developer_contact_developer_id`) REFERENCES `mo_info_developer` (`developer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_developer_contact` */

insert  into `mo_info_developer_contact`(`developer_contact_id`,`developer_contact_developer_id`,`developer_contact_contact_type_id`,`developer_contact_contact_value`) values 
(1,2,1,'http ://fb.com');

/*Table structure for table `mo_info_developer_specialize` */

DROP TABLE IF EXISTS `mo_info_developer_specialize`;

CREATE TABLE `mo_info_developer_specialize` (
  `developer_specialize_id` int(45) unsigned NOT NULL AUTO_INCREMENT,
  `developer_specialize_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`developer_specialize_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_developer_specialize` */

insert  into `mo_info_developer_specialize`(`developer_specialize_id`,`developer_specialize_name`) values 
(1,'Apartment');

/*Table structure for table `mo_info_district` */

DROP TABLE IF EXISTS `mo_info_district`;

CREATE TABLE `mo_info_district` (
  `district_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dsitrict_city_id` int(20) unsigned DEFAULT NULL,
  `district_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`district_id`),
  KEY `mo_info_district_ibfk_1` (`dsitrict_city_id`),
  CONSTRAINT `mo_info_district_ibfk_1` FOREIGN KEY (`dsitrict_city_id`) REFERENCES `mo_info_city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_district` */

insert  into `mo_info_district`(`district_id`,`dsitrict_city_id`,`district_name`) values 
(3,4,'Kebon Jeruk'),
(4,4,'Kedaung Kali Angke'),
(5,4,'Kapuk'),
(6,4,'Cengkareng Barat'),
(7,4,'Cengkareng Timur'),
(8,4,'	Tomang');

/*Table structure for table `mo_info_group` */

DROP TABLE IF EXISTS `mo_info_group`;

CREATE TABLE `mo_info_group` (
  `group_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_group` */

insert  into `mo_info_group`(`group_id`,`group_name`) values 
(1,'Administrator'),
(2,'Customers'),
(3,'Admin'),
(4,'User'),
(5,'Agen'),
(6,'Marketing');

/*Table structure for table `mo_info_group_menu` */

DROP TABLE IF EXISTS `mo_info_group_menu`;

CREATE TABLE `mo_info_group_menu` (
  `group_menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_menu_group_id` tinyint(3) unsigned DEFAULT NULL,
  `group_menu_menu_id` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`group_menu_id`),
  KEY `group_right_group_id` (`group_menu_group_id`),
  KEY `group_right_submenu_id` (`group_menu_menu_id`),
  CONSTRAINT `group_right_group_id` FOREIGN KEY (`group_menu_group_id`) REFERENCES `mo_info_group` (`group_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `group_right_submenu_id` FOREIGN KEY (`group_menu_menu_id`) REFERENCES `mo_info_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_group_menu` */

/*Table structure for table `mo_info_log_apartment_unit` */

DROP TABLE IF EXISTS `mo_info_log_apartment_unit`;

CREATE TABLE `mo_info_log_apartment_unit` (
  `log_apartment_unit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_apartment_unit_apartment_unit_id` int(10) unsigned DEFAULT NULL,
  `log_apartment_unit_ip_address` varchar(10) DEFAULT NULL,
  `log_apartment_unit_device` varchar(15) DEFAULT NULL,
  `log_apartment_unit_datetime` datetime DEFAULT NULL,
  `log_apartment_unit_customer_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`log_apartment_unit_id`),
  KEY `log_apartment_unit_customer_id` (`log_apartment_unit_customer_id`),
  KEY `mo_info_log_apartment_unit_ibfk_1` (`log_apartment_unit_apartment_unit_id`),
  CONSTRAINT `mo_info_log_apartment_unit_ibfk_1` FOREIGN KEY (`log_apartment_unit_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `mo_info_log_apartment_unit_ibfk_3` FOREIGN KEY (`log_apartment_unit_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_log_apartment_unit` */

/*Table structure for table `mo_info_log_apartment_unit_promo` */

DROP TABLE IF EXISTS `mo_info_log_apartment_unit_promo`;

CREATE TABLE `mo_info_log_apartment_unit_promo` (
  `log_apartment_unit_promo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_apartment_unit_promo_user_account_id` int(10) unsigned DEFAULT NULL,
  `log_apartment_unit_promo_apartment_unit_id` int(10) unsigned DEFAULT NULL,
  `log_apartment_unit_promo_promo_id` int(10) unsigned DEFAULT NULL,
  `log_apartment_unit_promo_datetime` datetime DEFAULT NULL,
  `log_apartment_unit_promo_price` int(45) unsigned DEFAULT NULL,
  `log_apartment_unit_promo_event` text,
  PRIMARY KEY (`log_apartment_unit_promo_id`),
  KEY `apartment_unit_promo_log_apartment_unit_id` (`log_apartment_unit_promo_apartment_unit_id`),
  KEY `apartment_unit_promo_log_promo_id` (`log_apartment_unit_promo_promo_id`),
  KEY `apartment_unit_user_account_id` (`log_apartment_unit_promo_user_account_id`),
  CONSTRAINT `mo_info_log_apartment_unit_promo_ibfk_1` FOREIGN KEY (`log_apartment_unit_promo_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_log_apartment_unit_promo_ibfk_2` FOREIGN KEY (`log_apartment_unit_promo_promo_id`) REFERENCES `mo_info_promo` (`promo_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_log_apartment_unit_promo_ibfk_3` FOREIGN KEY (`log_apartment_unit_promo_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_log_apartment_unit_promo` */

/*Table structure for table `mo_info_log_customer_referal` */

DROP TABLE IF EXISTS `mo_info_log_customer_referal`;

CREATE TABLE `mo_info_log_customer_referal` (
  `log_customer_referal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_customer_referal_marketing_id` int(10) unsigned DEFAULT NULL,
  `log_customer_referal_customer_id` int(10) unsigned DEFAULT NULL,
  `log_customer_referal_date` date DEFAULT NULL,
  `log_customer_referal_datetime` datetime DEFAULT NULL,
  `log_customer_referal_event` text,
  PRIMARY KEY (`log_customer_referal_id`),
  KEY `mo_info_log_customer_referal_ibfk_1` (`log_customer_referal_customer_id`),
  KEY `mo_info_log_customer_referal_ibfk_2` (`log_customer_referal_marketing_id`),
  CONSTRAINT `mo_info_log_customer_referal_ibfk_1` FOREIGN KEY (`log_customer_referal_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_log_customer_referal_ibfk_2` FOREIGN KEY (`log_customer_referal_marketing_id`) REFERENCES `mo_info_marketing` (`marketing_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_log_customer_referal` */

/*Table structure for table `mo_info_log_developer` */

DROP TABLE IF EXISTS `mo_info_log_developer`;

CREATE TABLE `mo_info_log_developer` (
  `log_developer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_developer_developer_id` int(10) unsigned NOT NULL,
  `log_developer_ip_address` varchar(7) DEFAULT NULL,
  `log_developer_device` varchar(45) DEFAULT NULL,
  `log_developer_datetime` datetime DEFAULT NULL,
  `log_developer_date` date DEFAULT NULL,
  `log_developer_event` text,
  `log_developer_user_account_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`log_developer_id`,`log_developer_developer_id`),
  KEY `developer_log_developer_id` (`log_developer_developer_id`),
  KEY `developer_log_user_account_id` (`log_developer_user_account_id`),
  CONSTRAINT `mo_info_log_developer_ibfk_1` FOREIGN KEY (`log_developer_developer_id`) REFERENCES `mo_info_developer` (`developer_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_log_developer_ibfk_2` FOREIGN KEY (`log_developer_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_log_developer` */

/*Table structure for table `mo_info_log_management` */

DROP TABLE IF EXISTS `mo_info_log_management`;

CREATE TABLE `mo_info_log_management` (
  `log_management_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_management_management_id` int(10) unsigned NOT NULL,
  `log_management_ip_address` varchar(7) DEFAULT NULL,
  `log_management_device` varchar(20) DEFAULT NULL,
  `log_management_datetime` datetime DEFAULT NULL,
  `log_management_event` text,
  PRIMARY KEY (`log_management_id`,`log_management_management_id`),
  KEY `management_log_management_id` (`log_management_management_id`),
  CONSTRAINT `mo_info_log_management_ibfk_1` FOREIGN KEY (`log_management_management_id`) REFERENCES `mo_info_management` (`management_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_log_management` */

/*Table structure for table `mo_info_log_user_account` */

DROP TABLE IF EXISTS `mo_info_log_user_account`;

CREATE TABLE `mo_info_log_user_account` (
  `log_user_account_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `log_user_account_user_account_id` int(10) unsigned DEFAULT NULL,
  `log_user_account_ip_address` varchar(15) DEFAULT NULL,
  `log_user_account_device` varchar(45) DEFAULT NULL,
  `log_user_account_datetime` datetime DEFAULT NULL,
  `log_user_account_event` text,
  PRIMARY KEY (`log_user_account_id`),
  KEY `user_account_log_user_account_id` (`log_user_account_user_account_id`),
  CONSTRAINT `mo_info_log_user_account_ibfk_1` FOREIGN KEY (`log_user_account_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_log_user_account` */

/*Table structure for table `mo_info_management` */

DROP TABLE IF EXISTS `mo_info_management`;

CREATE TABLE `mo_info_management` (
  `management_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `management_name` varchar(45) DEFAULT NULL,
  `management_desc` text,
  `management_picture` text,
  `management_address` text,
  `management_latitude` double DEFAULT NULL,
  `management_longitude` double DEFAULT NULL,
  `management_postal_code` varchar(7) DEFAULT NULL,
  `management_district_id` int(10) unsigned DEFAULT NULL,
  `management_street_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`management_id`),
  KEY `management_district_id` (`management_district_id`),
  CONSTRAINT `mo_info_management_ibfk_1` FOREIGN KEY (`management_district_id`) REFERENCES `mo_info_district` (`district_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_management` */

insert  into `mo_info_management`(`management_id`,`management_name`,`management_desc`,`management_picture`,`management_address`,`management_latitude`,`management_longitude`,`management_postal_code`,`management_district_id`,`management_street_name`) values 
(0,'Management A','Management terbaik dengan team solid','management.jpg','Jalan mangga 2',373,33344,'33322',3,'Jalan Mangga 2 Nomor 32'),
(2,'Managemen B','Managemen Ok Oce	','Managemen.jpg','Jalan Mangga 1',545553,55345435,'45366',7,'bLOG A'),
(3,'Managemen C','Managemen C D E','MANAGEMEN.JPG','Jalan Mangga 1',564363,464666,'45645',3,'Bolg c');

/*Table structure for table `mo_info_management_contact` */

DROP TABLE IF EXISTS `mo_info_management_contact`;

CREATE TABLE `mo_info_management_contact` (
  `management_contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `management_contact_management_id` int(10) unsigned NOT NULL,
  `management_contact_contact_type_id` int(10) unsigned DEFAULT NULL,
  `management_contact_value` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`management_contact_id`,`management_contact_management_id`),
  KEY `sys_management_contact_ibfk_1` (`management_contact_management_id`),
  KEY `management_contact_contact_type` (`management_contact_contact_type_id`),
  CONSTRAINT `mo_info_management_contact_ibfk_1` FOREIGN KEY (`management_contact_management_id`) REFERENCES `mo_info_management` (`management_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `mo_info_management_contact_ibfk_3` FOREIGN KEY (`management_contact_contact_type_id`) REFERENCES `mo_info_contact_type` (`contact_type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_management_contact` */

/*Table structure for table `mo_info_marketing` */

DROP TABLE IF EXISTS `mo_info_marketing`;

CREATE TABLE `mo_info_marketing` (
  `marketing_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_user_account_id` int(10) unsigned DEFAULT NULL,
  `marketing_agency_id` int(10) unsigned DEFAULT NULL,
  `marketing_name` varchar(20) DEFAULT NULL,
  `marketing_is_active` tinyint(1) unsigned DEFAULT NULL,
  `marketing_datetime` datetime DEFAULT NULL,
  `marketing_gender` tinyint(1) unsigned DEFAULT NULL,
  `marketing_date_of_birth` date DEFAULT NULL,
  `marketing_religion` varchar(45) DEFAULT NULL,
  `marketing_rating` int(10) DEFAULT NULL,
  PRIMARY KEY (`marketing_id`),
  KEY `agent_marketing_user_account_id` (`marketing_user_account_id`),
  KEY `agent_marketing_agent_id` (`marketing_agency_id`),
  CONSTRAINT `mo_info_marketing_ibfk_1` FOREIGN KEY (`marketing_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `mo_info_marketing_ibfk_2` FOREIGN KEY (`marketing_agency_id`) REFERENCES `mo_info_marketing_agency` (`marketing_agency_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_marketing` */

insert  into `mo_info_marketing`(`marketing_id`,`marketing_user_account_id`,`marketing_agency_id`,`marketing_name`,`marketing_is_active`,`marketing_datetime`,`marketing_gender`,`marketing_date_of_birth`,`marketing_religion`,`marketing_rating`) values 
(1,2,1,'Dua janggo',1,'2018-01-15 14:22:36',0,'2018-01-15','Islam',NULL),
(2,2,2,'cod janggo',1,'2018-01-15 14:23:09',0,'2018-01-15','Islam',NULL),
(3,1,2,'COD',1,'2018-01-15 18:01:42',1,'2018-01-15','Islam',12);

/*Table structure for table `mo_info_marketing_agency` */

DROP TABLE IF EXISTS `mo_info_marketing_agency`;

CREATE TABLE `mo_info_marketing_agency` (
  `marketing_agency_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_agency_name` varchar(45) DEFAULT NULL,
  `marketing_agency_desc` text,
  `marketing_agency_picture` text,
  PRIMARY KEY (`marketing_agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_marketing_agency` */

insert  into `mo_info_marketing_agency`(`marketing_agency_id`,`marketing_agency_name`,`marketing_agency_desc`,`marketing_agency_picture`) values 
(1,'Hari Irawan','xx','xxx'),
(2,'Hamdan','zzzz','aaa');

/*Table structure for table `mo_info_marketing_contact` */

DROP TABLE IF EXISTS `mo_info_marketing_contact`;

CREATE TABLE `mo_info_marketing_contact` (
  `agent_contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agent_contact_agency_id` int(10) unsigned NOT NULL,
  `agent_contact_contact_type_id` int(10) unsigned DEFAULT NULL,
  `agent_contact_value` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`agent_contact_id`,`agent_contact_agency_id`),
  KEY `agent_contact_agent_id` (`agent_contact_agency_id`),
  KEY `agent_contact_contact_type_id` (`agent_contact_contact_type_id`),
  CONSTRAINT `mo_info_marketing_contact_ibfk_1` FOREIGN KEY (`agent_contact_agency_id`) REFERENCES `mo_info_marketing_agency` (`marketing_agency_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mo_info_marketing_contact_ibfk_2` FOREIGN KEY (`agent_contact_contact_type_id`) REFERENCES `mo_info_contact_type` (`contact_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_marketing_contact` */

insert  into `mo_info_marketing_contact`(`agent_contact_id`,`agent_contact_agency_id`,`agent_contact_contact_type_id`,`agent_contact_value`) values 
(1,1,1,'http:twitter.com'),
(3,1,2,'http:fb.com'),
(4,1,3,'http:gogle.com'),
(5,2,1,'http:fb.com/hamdan'),
(6,2,2,'http:fb.com/hamdankasim');

/*Table structure for table `mo_info_marketing_lat_long` */

DROP TABLE IF EXISTS `mo_info_marketing_lat_long`;

CREATE TABLE `mo_info_marketing_lat_long` (
  `marketing_lat_long_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_lat_long_marketing_id` int(10) unsigned DEFAULT NULL,
  `marketing_lat_long_latitude` double DEFAULT NULL,
  `marketing_lat_long_longitude` double DEFAULT NULL,
  `marketing_lat_long_datetime` datetime DEFAULT NULL,
  `marketing_lat_long_is_online` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`marketing_lat_long_id`),
  KEY `agent_marketing_lat_long_agent_marketing_id` (`marketing_lat_long_marketing_id`),
  CONSTRAINT `mo_info_marketing_lat_long_ibfk_1` FOREIGN KEY (`marketing_lat_long_marketing_id`) REFERENCES `mo_info_marketing` (`marketing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_marketing_lat_long` */

insert  into `mo_info_marketing_lat_long`(`marketing_lat_long_id`,`marketing_lat_long_marketing_id`,`marketing_lat_long_latitude`,`marketing_lat_long_longitude`,`marketing_lat_long_datetime`,`marketing_lat_long_is_online`) values 
(1,1,5345345534,35345,'2018-01-15 14:23:53',1),
(2,2,34534545,435355,'2018-01-15 14:24:08',1),
(3,NULL,NULL,NULL,NULL,0);

/*Table structure for table `mo_info_marketing_social_media` */

DROP TABLE IF EXISTS `mo_info_marketing_social_media`;

CREATE TABLE `mo_info_marketing_social_media` (
  `marketing_social_media_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_social_media_marketing_id` int(10) unsigned NOT NULL,
  `marketing_social_media_social_media_type_id` int(10) unsigned DEFAULT NULL,
  `marketing_social_media_link` text,
  PRIMARY KEY (`marketing_social_media_id`,`marketing_social_media_marketing_id`),
  KEY `marketing_social_media_marketing_id` (`marketing_social_media_marketing_id`),
  KEY `marketing_social_media_social_media_type_id` (`marketing_social_media_social_media_type_id`),
  CONSTRAINT `mo_info_marketing_social_media_ibfk_1` FOREIGN KEY (`marketing_social_media_marketing_id`) REFERENCES `mo_info_marketing` (`marketing_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `mo_info_marketing_social_media_ibfk_2` FOREIGN KEY (`marketing_social_media_social_media_type_id`) REFERENCES `mo_info_social_media_type` (`social_media_type`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_marketing_social_media` */

insert  into `mo_info_marketing_social_media`(`marketing_social_media_id`,`marketing_social_media_marketing_id`,`marketing_social_media_social_media_type_id`,`marketing_social_media_link`) values 
(1,1,1,'http://google.com'),
(2,2,2,'http://google.com');

/*Table structure for table `mo_info_menu` */

DROP TABLE IF EXISTS `mo_info_menu`;

CREATE TABLE `mo_info_menu` (
  `menu_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int(5) unsigned DEFAULT '0',
  `menu_name` varchar(15) DEFAULT NULL,
  `menu_is_active` tinyint(1) DEFAULT NULL,
  `menu_order` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_menu` */

insert  into `mo_info_menu`(`menu_id`,`menu_parent_id`,`menu_name`,`menu_is_active`,`menu_order`) values 
(1,0,'Home',1,0),
(2,0,'Contact',1,1),
(3,0,'Profil',1,1),
(5,1,'Aparment',1,1),
(6,NULL,NULL,NULL,NULL),
(7,NULL,NULL,NULL,NULL),
(8,NULL,NULL,NULL,NULL);

/*Table structure for table `mo_info_payment_method` */

DROP TABLE IF EXISTS `mo_info_payment_method`;

CREATE TABLE `mo_info_payment_method` (
  `payment_method_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(45) DEFAULT NULL,
  `payment_method_datetime` datetime DEFAULT NULL,
  `payment_method_is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_payment_method` */

insert  into `mo_info_payment_method`(`payment_method_id`,`payment_method_name`,`payment_method_datetime`,`payment_method_is_active`) values 
(1,'Cash','2018-01-08 14:23:09',1),
(2,'Transfers','2018-01-10 15:56:56',1);

/*Table structure for table `mo_info_promo` */

DROP TABLE IF EXISTS `mo_info_promo`;

CREATE TABLE `mo_info_promo` (
  `promo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promo_management_id` int(10) unsigned DEFAULT NULL,
  `promo_user_account_id` int(10) unsigned DEFAULT NULL,
  `promo_apartment_unit_id` int(10) unsigned DEFAULT NULL,
  `promo_name` varchar(45) DEFAULT NULL,
  `promo_start_date` date DEFAULT NULL,
  `promo_end_date` date DEFAULT NULL,
  `promo_datetime` datetime DEFAULT NULL,
  `promo_precentage` double DEFAULT NULL,
  PRIMARY KEY (`promo_id`),
  KEY `mo_info_promo_ibfk_1` (`promo_user_account_id`),
  KEY `promo_management_id` (`promo_management_id`),
  KEY `mo_info_promo_ibfk_3` (`promo_apartment_unit_id`),
  CONSTRAINT `mo_info_promo_ibfk_1` FOREIGN KEY (`promo_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_promo_ibfk_2` FOREIGN KEY (`promo_management_id`) REFERENCES `mo_info_management` (`management_id`) ON UPDATE CASCADE,
  CONSTRAINT `mo_info_promo_ibfk_3` FOREIGN KEY (`promo_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_promo` */

insert  into `mo_info_promo`(`promo_id`,`promo_management_id`,`promo_user_account_id`,`promo_apartment_unit_id`,`promo_name`,`promo_start_date`,`promo_end_date`,`promo_datetime`,`promo_precentage`) values 
(1,0,3,4,'Ahir Tahun','2018-01-10','2018-01-11','2018-01-10 15:58:53',20),
(2,0,2,1,'Hari Raya','2018-01-11','2018-01-11','2018-01-20 15:59:28',10);

/*Table structure for table `mo_info_province` */

DROP TABLE IF EXISTS `mo_info_province`;

CREATE TABLE `mo_info_province` (
  `province_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_province` */

insert  into `mo_info_province`(`province_id`,`province_name`) values 
(2,'DKI Jakarta'),
(3,'Nusa Tenggara Barat'),
(4,'Nusa Tengara Timur'),
(5,'Jawa Tengah'),
(6,'Jawa Timur'),
(7,'Jawa Barat');

/*Table structure for table `mo_info_sallary_range` */

DROP TABLE IF EXISTS `mo_info_sallary_range`;

CREATE TABLE `mo_info_sallary_range` (
  `sallary_range_id` int(10) unsigned NOT NULL,
  `sallary_range_customer_id` int(10) unsigned DEFAULT NULL,
  `sallary_range_min` int(20) unsigned DEFAULT NULL,
  `sallary_range_max` int(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`sallary_range_id`),
  KEY `sallary_range_customer_id` (`sallary_range_customer_id`),
  CONSTRAINT `mo_info_sallary_range_ibfk_1` FOREIGN KEY (`sallary_range_customer_id`) REFERENCES `mo_info_customer` (`customer_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_sallary_range` */

/*Table structure for table `mo_info_search_history` */

DROP TABLE IF EXISTS `mo_info_search_history`;

CREATE TABLE `mo_info_search_history` (
  `search_history_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `search_history_user_account_id` int(10) unsigned DEFAULT NULL,
  `search_history_value` text,
  `search_history_ip_address` varchar(7) DEFAULT NULL,
  `search_history_device` varchar(45) DEFAULT NULL,
  `search_history_datetime` datetime DEFAULT NULL,
  `search_history_date` date DEFAULT NULL,
  PRIMARY KEY (`search_history_id`),
  KEY `search_history_user_account_id` (`search_history_user_account_id`),
  CONSTRAINT `mo_info_search_history_ibfk_1` FOREIGN KEY (`search_history_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_search_history` */

/*Table structure for table `mo_info_social_media_type` */

DROP TABLE IF EXISTS `mo_info_social_media_type`;

CREATE TABLE `mo_info_social_media_type` (
  `social_media_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `social_media_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`social_media_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_social_media_type` */

insert  into `mo_info_social_media_type`(`social_media_type`,`social_media_name`) values 
(1,'Facebook'),
(2,'Twitter'),
(3,'Google++');

/*Table structure for table `mo_info_transaction_unit` */

DROP TABLE IF EXISTS `mo_info_transaction_unit`;

CREATE TABLE `mo_info_transaction_unit` (
  `transaction_unit_id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_unit_apartment_unit_id` int(10) unsigned NOT NULL,
  `date_transaction` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_unit_id`),
  KEY `transaction_apartment1` (`transaction_unit_apartment_unit_id`),
  CONSTRAINT `transaction_apartment1` FOREIGN KEY (`transaction_unit_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_transaction_unit` */

/*Table structure for table `mo_info_user_account` */

DROP TABLE IF EXISTS `mo_info_user_account`;

CREATE TABLE `mo_info_user_account` (
  `user_account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_account_username` varchar(45) DEFAULT NULL,
  `user_account_password` varchar(400) DEFAULT NULL,
  `user_account_group_id` tinyint(3) unsigned DEFAULT NULL,
  `user_account_picture` text,
  `user_account_is_active` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`user_account_id`),
  KEY `user_account_group_id` (`user_account_group_id`),
  CONSTRAINT `user_account_group_id` FOREIGN KEY (`user_account_group_id`) REFERENCES `mo_info_group` (`group_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_user_account` */

insert  into `mo_info_user_account`(`user_account_id`,`user_account_username`,`user_account_password`,`user_account_group_id`,`user_account_picture`,`user_account_is_active`) values 
(1,'ado','W+Bqxqq3jBsfRs0xDnHsRk8c5kk8BHmG8x/NFEBsDCauZCkuAL986N1HtdS5lFNg9u+pBhW2MlOxOkA7TRy0wA==',1,NULL,1),
(2,'hari','fnxZ6ZmO0fPM/lqLtxYULjpbwqfZVfIXH+earb9kxUTCjevhqEJhZthHmnl9wuZEE8Lw+ecxHcojJOKUDo9BcQ==',3,NULL,1),
(3,'Ameng','Ameng',2,NULL,1),
(4,'zulhan','Zulhan',4,NULL,1),
(5,'Hakim','Hakim12',4,NULL,1);

/*Table structure for table `mo_info_user_account_favourite` */

DROP TABLE IF EXISTS `mo_info_user_account_favourite`;

CREATE TABLE `mo_info_user_account_favourite` (
  `user_account_favourite_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_account_favourite_user_account_id` int(10) unsigned NOT NULL,
  `user_account_favourite_apartment_unit_id` int(10) unsigned DEFAULT NULL,
  `user_account_favourite_datetime` datetime DEFAULT NULL,
  `user_account_favourite_date` date DEFAULT NULL,
  PRIMARY KEY (`user_account_favourite_id`,`user_account_favourite_user_account_id`),
  KEY `user_account_favourite_user_account_id` (`user_account_favourite_user_account_id`),
  KEY `mo_info_user_account_favourite_ibfk_2` (`user_account_favourite_apartment_unit_id`),
  CONSTRAINT `mo_info_user_account_favourite_ibfk_2` FOREIGN KEY (`user_account_favourite_apartment_unit_id`) REFERENCES `mo_info_apartment_unit` (`apartment_unit_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `mo_info_user_account_favourite_ibfk_3` FOREIGN KEY (`user_account_favourite_user_account_id`) REFERENCES `mo_info_user_account` (`user_account_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mo_info_user_account_favourite` */

insert  into `mo_info_user_account_favourite`(`user_account_favourite_id`,`user_account_favourite_user_account_id`,`user_account_favourite_apartment_unit_id`,`user_account_favourite_datetime`,`user_account_favourite_date`) values 
(1,1,NULL,'2017-12-18 19:11:59','2017-12-18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
