/*
SQLyog - Free MySQL GUI v5.0
Host - 5.6.12-log : Database - bs_prot
*********************************************************************
Server version : 5.6.12-log
*/


create database if not exists `bs_prot`;

USE `bs_prot`;

DROP TABLE IF EXISTS `dev_level`;

CREATE TABLE `dev_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of level',
  `name` varchar(100) DEFAULT NULL COMMENT 'name level',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `dev_level` */

insert into `dev_level` values 

(1,'admin'),

(2,'root');
/*Table structure for table `dev_admin` */

DROP TABLE IF EXISTS `dev_admin`;

CREATE TABLE `dev_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id for user',
  `name` varchar(100) DEFAULT NULL COMMENT 'name',
  `username` varchar(100) DEFAULT NULL COMMENT 'username',
  `password` varchar(100) NOT NULL DEFAULT 'md5(''admin'')' COMMENT 'encripted password, default admin',
  `level` int(11) DEFAULT NULL COMMENT 'level of admin',
  `description` text COMMENT 'deskription of admin',
  `datetime_isert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date and time insert',
  PRIMARY KEY (`id`),
  UNIQUE KEY `level` (`level`),
  CONSTRAINT `dev_admin_ibfk_1` FOREIGN KEY (`level`) REFERENCES `dev_level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `dev_admin` */

insert into `dev_admin` values 
(1,'admin','admin','21232f297a57a5a743894a0e4a801fc3',1,'root\r\n','2016-01-28 21:58:50');

/*Table structure for table `dev_file` */

DROP TABLE IF EXISTS `dev_file`;

CREATE TABLE `dev_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) DEFAULT NULL,
  `file_path` text,
  `file_description` text,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dev_file` */

/*Table structure for table `dev_image` */

DROP TABLE IF EXISTS `dev_image`;

CREATE TABLE `dev_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) DEFAULT NULL,
  `image_path` text,
  `image_description` text,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dev_image` */

/*Table structure for table `dev_inventory` */

DROP TABLE IF EXISTS `dev_inventory`;

CREATE TABLE `dev_inventory` (
  `kode_inventory` varchar(10) NOT NULL,
  `nama_inventory` varchar(30) NOT NULL,
  `kondisi` varchar(20) NOT NULL,
  `tanggal_diterima` date NOT NULL,
  PRIMARY KEY (`kode_inventory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dev_inventory` */

insert into `dev_inventory` values 
('213','Papan','Baik ','2012-01-01');

/*Table structure for table `dev_level` */



/*Table structure for table `dev_user` */

DROP TABLE IF EXISTS `dev_user`;

CREATE TABLE `dev_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `user_name` varchar(100) DEFAULT NULL COMMENT 'full name of user',
  `user_username` varchar(100) DEFAULT NULL COMMENT 'name of user',
  `user_address` text,
  `user_email` varchar(100) DEFAULT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `user_description` text,
  `user_pass` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dev_user` */
