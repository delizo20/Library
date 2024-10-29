/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`library` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `library`;

/*Table structure for table `authors` */

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `authorid` int(9) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`authorid`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `authors` */

insert  into `authors`(`authorid`,`name`) values 
(1,'rhuby2'),
(2,'J.K. Rowling');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `bookid` int(9) NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL,
  `authorid` int(9) NOT NULL,
  PRIMARY KEY (`bookid`),
  KEY `authorid` (`authorid`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `authors` (`authorid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `books` */

insert  into `books`(`bookid`,`title`,`authorid`) values 
(1,'yak',99),
(2,'Book Title 2',2),
(3,'Book Title 3',3),
(4,'Book Title 4',4),
(5,'hakdog',65),
(6,'Book Title 6',6),
(7,'Book Title 7',7),
(8,'Book Title 8',8),
(9,'Book Title 9',9),
(10,'Book Title 10',10),
(11,'Book Title 11',11),
(12,'Book Title 12',12),
(13,'Book Title 13',13),
(14,'Book Title 14',14),
(15,'Book Title 15',15),
(16,'Book Title 16',16),
(17,'Book Title 17',17),
(18,'Book Title 18',18),
(19,'Book Title 19',19),
(20,'Book Title 20',20),
(21,'Book Title 21',21),
(22,'Book Title 22',22),
(23,'Book Title 23',23),
(24,'Book Title 24',24),
(25,'Book Title 25',25),
(26,'Book Title 26',26),
(27,'Book Title 27',27),
(28,'Book Title 28',28),
(29,'Book Title 29',29),
(30,'Book Title 30',30),
(31,'Book Title 31',31),
(32,'Book Title 32',32),
(33,'Book Title 33',33),
(34,'Book Title 34',34),
(35,'Book Title 35',35),
(36,'Book Title 36',36),
(37,'Book Title 37',37),
(38,'Book Title 38',38),
(39,'Book Title 39',39),
(40,'Book Title 40',40),
(41,'Book Title 41',41),
(42,'Book Title 42',42),
(43,'Book Title 43',43),
(44,'Book Title 44',44),
(45,'Book Title 45',45),
(46,'Book Title 46',46),
(47,'Book Title 47',47),
(48,'Book Title 48',48),
(49,'Book Title 49',49),
(50,'Book Title 50',50),
(51,'Book Title 51',51),
(52,'Book Title 52',52),
(53,'Book Title 53',53),
(54,'Book Title 54',54),
(55,'Book Title 55',55),
(56,'Book Title 56',56),
(57,'Book Title 57',57),
(58,'Book Title 58',58),
(59,'Book Title 59',59),
(60,'Book Title 60',60),
(61,'Book Title 61',61),
(62,'Book Title 62',62),
(63,'Book Title 63',63),
(64,'Book Title 64',64),
(65,'Book Title 65',65),
(66,'Book Title 66',66),
(67,'Book Title 67',67),
(68,'Book Title 68',68),
(69,'Book Title 69',69),
(70,'Book Title 70',70),
(71,'Book Title 71',71),
(72,'Book Title 72',72),
(73,'Book Title 73',73),
(74,'Book Title 74',74),
(75,'Book Title 75',75),
(76,'Book Title 76',76),
(77,'Book Title 77',77),
(78,'Book Title 78',78),
(79,'Book Title 79',79),
(80,'Book Title 80',80),
(81,'Book Title 81',81),
(82,'Book Title 82',82),
(83,'Book Title 83',83),
(84,'Book Title 84',84),
(85,'Book Title 85',85),
(86,'Book Title 86',86),
(87,'Book Title 87',87),
(88,'Book Title 88',88),
(89,'Book Title 89',89),
(90,'Book Title 90',90),
(91,'Book Title 91',91),
(92,'Book Title 92',92),
(93,'Book Title 93',93),
(94,'Book Title 94',94),
(95,'Book Title 95',95),
(96,'Book Title 96',96),
(97,'Book Title 97',97),
(98,'Book Title 98',98),
(99,'Book Title 99',99),
(121,'The Great Gatsby',1),
(145,'the bookworm',2);

/*Table structure for table `books_authors` */

DROP TABLE IF EXISTS `books_authors`;

CREATE TABLE `books_authors` (
  `collectionid` int(9) NOT NULL AUTO_INCREMENT,
  `bookid` int(9) NOT NULL,
  `authorid` int(9) NOT NULL,
  PRIMARY KEY (`collectionid`),
  KEY `authorid` (`authorid`),
  KEY `bookid` (`bookid`),
  CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `authors` (`authorid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`bookid`) REFERENCES `books` (`bookid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `books_authors` */

insert  into `books_authors`(`collectionid`,`bookid`,`authorid`) values 
(1,1,1),
(2,2,2),
(3,3,3),
(4,4,4),
(5,5,5),
(6,6,6),
(7,7,7),
(8,8,8),
(9,9,9),
(10,10,10),
(11,11,11),
(12,12,12),
(13,13,13),
(14,14,14),
(15,15,15),
(16,16,16),
(17,17,17),
(18,18,18),
(19,19,19),
(20,20,20),
(21,21,21),
(22,22,22),
(23,23,23),
(24,24,24),
(25,25,25),
(26,26,26),
(27,27,27),
(28,28,28),
(29,29,29),
(30,30,30),
(31,31,31),
(32,32,32),
(33,33,33),
(34,34,34),
(35,35,35),
(36,36,36),
(37,37,37),
(38,38,38),
(39,39,39),
(40,40,40),
(41,41,41),
(42,42,42),
(43,43,43),
(44,44,44),
(45,45,45),
(46,46,46),
(47,47,47),
(48,48,48),
(49,49,49),
(50,50,50),
(51,51,51),
(52,52,52),
(53,53,53),
(54,54,54),
(55,55,55),
(56,56,56),
(57,57,57),
(58,58,58),
(59,59,59),
(60,60,60),
(61,61,61),
(62,62,62),
(63,63,63),
(64,64,64),
(65,65,65),
(66,66,66),
(67,67,67),
(68,68,68),
(69,69,69),
(70,70,70),
(71,71,71),
(72,72,72),
(73,73,73),
(74,74,74),
(75,75,75),
(76,76,76),
(77,77,77),
(78,78,78),
(79,79,79),
(80,80,80),
(81,81,81),
(82,82,82),
(83,83,83),
(84,84,84),
(85,85,85),
(86,86,86),
(87,87,87),
(88,88,88),
(89,89,89),
(90,90,90),
(91,91,91),
(92,92,92),
(93,93,93),
(94,94,94),
(95,95,95),
(96,96,96),
(97,97,97),
(98,98,98),
(99,99,99),
(102,1,99);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userid` int(9) NOT NULL AUTO_INCREMENT,
  `username` char(255) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`userid`,`username`,`password`) values 
(101,'user101','5c773b22ea79d367b38810e7e9ad108646ed62e231868cefb0b1280ea88ac4f0'),
(102,'user101','5c773b22ea79d367b38810e7e9ad108646ed62e231868cefb0b1280ea88ac4f0'),
(103,'denver45','192129cc9afd618524bed6531e6d0a2b94e0eba1cdb50179a03a109a23d14351'),
(104,'denver455','0d9cc342576988d361306c124d636519273d3c1128e1524e08a4fd2fc532cad2'),
(105,'denver455','$2y$10$ncXOS8MBiYUA9/ArSqXj.u7x8TIfFqVBTi2NPxjpPvRyLPycPjtpG'),
(106,'denver4555','$2y$10$QxlW6tkZkChlc9oRWQ55UeIiCQfw9UXPol4NXqW1MMfoGbq8ddNTK'),
(107,'denver4555','$2y$10$PxDWetrXWzD49YUw4MyyrOHjN06W9YaPtCa7v4JzKXAMiP8wNqB8.'),
(108,'denver455566','$2y$10$x00gqzQJyRyIKAawFm0OsO7.XQ/nJPGPmOnckzapxp6ThzLr39fe6'),
(109,'denve','$2y$10$URicF7hEMhzL.uorpHVWLe1zxQFJtGLCcv45l1ru.sgwkyYpR1hDy'),
(110,'denve','$2y$10$JKkdMxr1ZA.ZVB4Ze1CYfu49f2WfbAVEbttQ2Ry7G8solqBRV65w.'),
(111,'denve','$2y$10$oj2x/PbdqIIuUEsxryZnxu.EA/WZJG3UFI7o6O5EMeDGexseLlr4i'),
(112,'denve','$2y$10$WRVAeJz/nsi3fGqGrFXyke8AJSGjbFLTxjIz3594CrJdwNhnuim9O'),
(113,'denve','$2y$10$vQ3hZZAn7P2iuoN1Az4S9.ZpAcV8segtYl6FmHIkIF9VjcrLdPTDa'),
(114,'rhubs','$2y$10$eQsMMn4KmHfuxBemZWjCLuEZou5DZ0MvE5wkmiOJzSa6yyMHG2Tm2'),
(115,'denden1','$2y$10$e5LlFEofGAVV2CsAajvzl.mgtgT32HrdDqgBi21k24QJNsi4x14Su'),
(116,'denden14','$2y$10$5rndSl7AlifH07n8d5tE6.bu1C8Z.WjoVbT8sHNzhiLTVHGgGaVgy'),
(117,'rhubyann','$2y$10$PckbmfFeK/K8r.uKx0IOren/moJA0U32eTUgSaa5rU4mUviYSilYW');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
