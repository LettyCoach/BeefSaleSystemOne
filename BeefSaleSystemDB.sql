/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.27-MariaDB : Database - laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`LA04203877-sdgs` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `LA04203877-sdgs`;

/*Table structure for table `chirps` */

DROP TABLE IF EXISTS `chirps`;

CREATE TABLE `chirps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chirps_user_id_foreign` (`user_id`),
  CONSTRAINT `chirps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `chirps` */

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies` */

insert  into `companies`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'company01','111','111','2023-04-19 23:19:00','2023-04-20 23:19:07'),
(2,'company02','222','222','2023-04-04 23:19:04','2023-04-19 23:19:11');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `markets` */

DROP TABLE IF EXISTS `markets`;

CREATE TABLE `markets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `markets` */

insert  into `markets`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(3,'市場名2','市場位置2','ert','2023-03-20 00:00:00','2023-03-23 17:27:55'),
(4,'市場名3','市場位置3','メモ3','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(5,'市場名4','市場位置4','メモ4','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(6,'市場名5','市場位置5','メモ5','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(7,'市場名6','市場位置6','メモ6','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(8,'市場名7','市場位置7','メモ7','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(9,'市場名8','市場位置8','メモ8','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(10,'市場名9','市場位置9','メモ9','2023-03-20 00:00:00','2023-03-20 00:00:00');

/*Table structure for table `meats` */

DROP TABLE IF EXISTS `meats`;

CREATE TABLE `meats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ox_id` bigint(20) unsigned DEFAULT NULL,
  `part_id` bigint(20) unsigned DEFAULT NULL,
  `weight` decimal(11,2) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meats_ox_id_foreign` (`ox_id`),
  KEY `meats_part_id_foreign` (`part_id`),
  CONSTRAINT `meats_ox_id_foreign` FOREIGN KEY (`ox_id`) REFERENCES `oxen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `meats_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `meats` */

insert  into `meats`(`id`,`ox_id`,`part_id`,`weight`,`price`,`created_at`,`updated_at`) values 
(80,39,1,22.00,22.00,'2023-04-15 23:42:38','2023-04-16 02:20:42'),
(81,39,2,22.00,22.00,'2023-04-16 01:33:13','2023-04-16 02:20:46'),
(82,39,3,22.00,22.00,'2023-04-16 01:33:20','2023-04-16 02:20:50'),
(88,47,1,22.00,22.00,'2023-04-16 02:21:06','2023-04-16 02:21:06'),
(89,47,3,22.00,22.00,'2023-04-16 02:21:13','2023-04-16 02:21:13'),
(90,47,14,22.00,22.00,'2023-04-16 02:21:17','2023-04-16 02:21:17'),
(91,39,14,100.00,1000.00,'2023-04-16 02:39:56','2023-04-16 02:39:56'),
(92,39,15,100.00,1000.00,'2023-04-16 02:40:02','2023-04-16 02:40:02'),
(93,48,1,2.00,2.00,'2023-04-17 13:25:26','2023-04-17 13:25:26'),
(94,48,3,2.00,2.00,'2023-04-17 13:25:29','2023-04-17 13:25:29');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_03_04_073049_create_chirps_table',1),
(6,'2023_03_05_173744_create_markets_table',1),
(7,'2023_03_07_141253_create_transport_companies_table',1),
(8,'2023_03_07_144855_create_pastorals_table',1),
(9,'2023_03_07_152926_create_slaughter_houses_table',1),
(10,'2023_03_07_160750_create_parts_table',1),
(11,'2023_03_08_023540_create_oxen_table',1),
(12,'2023_03_08_055755_create_meats_table',1),
(13,'2023_03_16_155019_create_roles_table',1),
(14,'2023_03_16_230757_create_role_users_table',1),
(15,'2023_04_24_205938_create_companies_table',2);

/*Table structure for table `oxen` */

DROP TABLE IF EXISTS `oxen`;

CREATE TABLE `oxen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `registerNumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `sex` int(11) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `market_id` bigint(20) unsigned DEFAULT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `purchaseDate` date DEFAULT NULL,
  `purchasePrice` bigint(20) DEFAULT NULL,
  `purchaseTransport_Company_id` bigint(20) unsigned DEFAULT NULL,
  `loadDate` date DEFAULT NULL,
  `unloadDate` date DEFAULT NULL,
  `pastoral_id` bigint(20) unsigned DEFAULT NULL,
  `accessDate` date DEFAULT NULL,
  `exportDate` date DEFAULT NULL,
  `appendInfo` text DEFAULT NULL,
  `slaughterTransport_Company_id` bigint(20) unsigned DEFAULT NULL,
  `slaughterHouse_id` bigint(20) unsigned DEFAULT NULL,
  `acceptedDateSlaughterHouse` date DEFAULT NULL,
  `slaughterFinishedDate` date DEFAULT NULL,
  `acceptedWeight` decimal(11,2) DEFAULT NULL,
  `acceptedLevel` varchar(255) DEFAULT NULL,
  `finishedState` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `oxen_registernumber_unique` (`registerNumber`),
  KEY `oxen_market_id_foreign` (`market_id`),
  KEY `oxen_pastoral_id_foreign` (`pastoral_id`),
  KEY `oxen_purchasetransport_company_id_foreign` (`purchaseTransport_Company_id`),
  KEY `oxen_slaughterhouse_id_foreign` (`slaughterHouse_id`),
  KEY `oxen_slaughtertransport_company_id_foreign` (`slaughterTransport_Company_id`),
  KEY `oxen_user_id_foreign` (`user_id`),
  KEY `oxen_company_id_foreign` (`company_id`),
  CONSTRAINT `oxen_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oxen_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oxen_pastoral_id_foreign` FOREIGN KEY (`pastoral_id`) REFERENCES `pastorals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oxen_purchasetransport_company_id_foreign` FOREIGN KEY (`purchaseTransport_Company_id`) REFERENCES `transport_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oxen_slaughterhouse_id_foreign` FOREIGN KEY (`slaughterHouse_id`) REFERENCES `slaughter_houses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oxen_slaughtertransport_company_id_foreign` FOREIGN KEY (`slaughterTransport_Company_id`) REFERENCES `transport_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oxen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oxen` */

insert  into `oxen`(`id`,`registerNumber`,`name`,`birthday`,`sex`,`user_id`,`market_id`,`company_id`,`purchaseDate`,`purchasePrice`,`purchaseTransport_Company_id`,`loadDate`,`unloadDate`,`pastoral_id`,`accessDate`,`exportDate`,`appendInfo`,`slaughterTransport_Company_id`,`slaughterHouse_id`,`acceptedDateSlaughterHouse`,`slaughterFinishedDate`,`acceptedWeight`,`acceptedLevel`,`finishedState`,`created_at`,`updated_at`) values 
(39,'02','02','2023-04-13',1,3,3,1,'2023-04-13',3456,1,'2023-04-13','2023-04-13',1,NULL,'2023-04-13',NULL,1,1,'2023-04-04','2023-04-03',123.00,'D2',0,'2023-04-13 15:59:03','2023-04-13 16:01:07'),
(47,'123','123','2023-04-13',1,1,3,1,'2023-04-13',123,1,'2023-04-28','2023-04-13',1,NULL,'2023-04-16','rwer',1,1,'2023-04-04','2023-04-05',456.00,'A1',0,'2023-04-13 16:39:50','2023-04-16 01:42:38'),
(48,'234','234','2023-04-17',1,2,3,1,'2023-04-17',23424,1,'2023-04-17','2023-04-17',1,NULL,'2023-04-17','234',1,1,'2023-03-27','2023-04-04',234.00,'B1',0,'2023-04-17 13:24:27','2023-04-17 13:26:02'),
(49,'123123','123','2023-04-24',1,1,3,2,'2023-04-24',123,1,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-04-24 21:43:08','2023-04-24 21:43:08');

/*Table structure for table `parts` */

DROP TABLE IF EXISTS `parts`;

CREATE TABLE `parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `parts` */

insert  into `parts`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'部品名0','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(2,'部品名1','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(3,'部品名2','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(14,'123','2023-04-12 15:08:50','2023-04-12 15:08:50'),
(15,'234234','2023-04-12 17:14:45','2023-04-12 17:14:45');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

insert  into `password_reset_tokens`(`email`,`token`,`created_at`) values 
('moriyamayukio85@gmail.com','$2y$10$wmfjbuoTGi.2uua.pphrsO/U3dB9/PF/Q/ymb0tx9xnnzDvyX5eMC','2023-03-29 16:42:01');

/*Table structure for table `pastorals` */

DROP TABLE IF EXISTS `pastorals`;

CREATE TABLE `pastorals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pastorals` */

insert  into `pastorals`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'牧場名0','牧場位置0','メモ0','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(2,'牧場名1','牧場位置1','メモ1','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(3,'牧場名2','牧場位置2','メモ2','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(4,'牧場名3','牧場位置3','メモ3','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(5,'牧場名4','牧場位置4','メモ4','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(6,'牧場名5','牧場位置5','メモ5','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(7,'牧場名6','牧場位置6','メモ6','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(8,'牧場名7','牧場位置7','メモ7','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(9,'牧場名8','牧場位置8','メモ8','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(10,'牧場名9','牧場位置9','メモ9','2023-03-20 00:00:00','2023-03-20 00:00:00');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `role_users` */

DROP TABLE IF EXISTS `role_users`;

CREATE TABLE `role_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_users_user_id_foreign` (`user_id`),
  KEY `role_users_role_id_foreign` (`role_id`),
  CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_users` */

insert  into `role_users`(`id`,`user_id`,`role_id`,`created_at`,`updated_at`) values 
(1,1,1,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(11,12,3,'2023-03-21 15:05:31','2023-03-21 15:05:31'),
(12,12,4,'2023-03-21 15:05:31','2023-03-21 15:05:31'),
(13,12,5,'2023-03-21 15:05:31','2023-03-21 15:05:31'),
(20,2,2,'2023-04-13 16:56:47','2023-04-13 16:56:47'),
(21,2,3,'2023-04-13 16:56:47','2023-04-13 16:56:47'),
(22,2,4,'2023-04-13 16:56:47','2023-04-13 16:56:47'),
(23,2,5,'2023-04-13 16:56:47','2023-04-13 16:56:47'),
(24,2,6,'2023-04-13 16:56:47','2023-04-13 16:56:47'),
(25,2,7,'2023-04-13 16:56:48','2023-04-13 16:56:48'),
(26,3,2,'2023-04-13 16:56:53','2023-04-13 16:56:53'),
(27,3,3,'2023-04-13 16:56:53','2023-04-13 16:56:53'),
(28,3,4,'2023-04-13 16:56:53','2023-04-13 16:56:53'),
(29,3,5,'2023-04-13 16:56:53','2023-04-13 16:56:53'),
(30,3,6,'2023-04-13 16:56:54','2023-04-13 16:56:54'),
(31,3,7,'2023-04-13 16:56:54','2023-04-13 16:56:54'),
(32,4,2,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(33,4,2,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(34,4,3,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(35,4,3,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(36,4,4,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(37,4,4,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(38,4,5,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(39,4,5,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(40,4,6,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(41,4,6,'2023-04-13 16:57:02','2023-04-13 16:57:02'),
(42,4,7,'2023-04-13 16:57:03','2023-04-13 16:57:03'),
(43,4,7,'2023-04-13 16:57:03','2023-04-13 16:57:03'),
(44,5,2,'2023-04-17 11:26:25','2023-04-17 11:26:25'),
(45,5,3,'2023-04-17 11:26:25','2023-04-17 11:26:25'),
(46,5,4,'2023-04-17 11:26:26','2023-04-17 11:26:26'),
(47,5,5,'2023-04-17 11:26:26','2023-04-17 11:26:26'),
(48,5,6,'2023-04-17 11:26:26','2023-04-17 11:26:26'),
(49,5,7,'2023-04-17 11:26:26','2023-04-17 11:26:26');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `showName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`showName`,`created_at`,`updated_at`) values 
(1,'admin','','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(2,'purchase','購入管理','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(3,'transport','輸送管理','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(4,'fatten','肥育管理','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(5,'ship','出荷管理','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(6,'slaughter','屠殺管理','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(7,'meat','精肉管理','2023-03-20 00:00:00','2023-03-20 00:00:00');

/*Table structure for table `slaughter_houses` */

DROP TABLE IF EXISTS `slaughter_houses`;

CREATE TABLE `slaughter_houses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `slaughter_houses` */

insert  into `slaughter_houses`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'屠殺場名0','屠殺場位置0','メモ0','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(2,'屠殺場名1','屠殺場位置1','メモ1','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(3,'屠殺場名2','屠殺場位置2','メモ2','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(4,'屠殺場名3','屠殺場位置3','メモ3','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(5,'屠殺場名4','屠殺場位置4','メモ4','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(6,'屠殺場名5','屠殺場位置5','メモ5','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(7,'屠殺場名6','屠殺場位置6','メモ6','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(8,'屠殺場名7','屠殺場位置7','メモ7','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(9,'屠殺場名8','屠殺場位置8','メモ8','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(10,'屠殺場名9','屠殺場位置9','メモ9','2023-03-20 00:00:00','2023-03-20 00:00:00');

/*Table structure for table `transport_companies` */

DROP TABLE IF EXISTS `transport_companies`;

CREATE TABLE `transport_companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transport_companies` */

insert  into `transport_companies`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'運送会社名0','運送会社位置0','メモ0','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(2,'運送会社名1','運送会社位置1','メモ1','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(3,'運送会社名2','運送会社位置2','メモ2','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(4,'運送会社名3','運送会社位置3','メモ3','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(5,'運送会社名4','運送会社位置4','メモ4','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(6,'運送会社名5','運送会社位置5','メモ5','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(7,'運送会社名6','運送会社位置6','メモ6','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(8,'運送会社名7','運送会社位置7','メモ7','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(9,'運送会社名8','運送会社位置8','メモ8','2023-03-20 00:00:00','2023-03-20 00:00:00'),
(10,'運送会社名9','運送会社位置9','メモ9','2023-03-20 00:00:00','2023-03-20 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_company_id_foreign` (`company_id`),
  CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`company_id`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','example@gmail.com',NULL,'$2y$10$DPbyH/E177TJR8/oqiJIUu1ruW.WKZ0xJlbFDhIZZ.CRWK1p9SNGq',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(2,'一般利用者0','m7tGSvrCyf@gmail.com','2023-03-20 00:00:00','$2y$10$aN8Z4oKmHEz8mOZXOtDmEejOQMWvj40x3C.xBS24LiwZj9K2S3G4S',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(3,'一般利用者1','xcZs9lWzUj@gmail.com','2023-03-20 00:00:00','$2y$10$5L2D7LtDq3bGCClh/r2e2uOnBkFFyWCrcREg/nR0W27kHqjfOCy7u',2,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(4,'一般利用者2','j9ThJyUKy1@gmail.com','2023-03-20 00:00:00','$2y$10$B.kGdIHsbTzVFZI0qmuZ8.aBuvFs59tTFXZCS5DYfnr5IYQM7Y5uK',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(5,'一般利用者3','avTojWCsGL@gmail.com','2023-03-20 00:00:00','$2y$10$dvsT73u7mTYI4uW.WSG.hOasR6rR.FLcb8rp22VCZnRTlvhi6xA0i',2,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(6,'一般利用者4','Gay7jD0bOp@gmail.com','2023-03-20 00:00:00','$2y$10$iwsYJWef5KjyE9Fmq4FnLOIpyP2/dexHa93i4O3ihu1YukpYfvfEy',2,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(7,'一般利用者5','ypVeTao7Or@gmail.com','2023-03-20 00:00:00','$2y$10$q8rGKhsXSO8XqyZXQyUJ8eMGzk05gL4NhQWS2In6VFcuTrx632Fqq',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(8,'一般利用者6','OjR5NvqKOl@gmail.com','2023-03-20 00:00:00','$2y$10$6kg9yDKae5PrQ9930tXF4.oFu1MqdZB9lDJv24GOIukB1UnN5Mo5O',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(9,'一般利用者7','NNkFkUjpeZ@gmail.com','2023-03-20 00:00:00','$2y$10$BBXbMxZSc2o3Xm8fohpmF.Wldt62LI74haQRzlYKV7Vg9mLz8apSK',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(10,'一般利用者8','daZ4dQEriH@gmail.com','2023-03-20 00:00:00','$2y$10$6lVctTFEiwBmfgesO/uv3.es3UOC/6m6ModNpvsw.mZz/VDX4Kpb6',1,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(11,'一般利用者9','5tErLb5RsN@gmail.com','2023-03-20 00:00:00','$2y$10$kgV9yg1FbaZa6fkiGE7STODu0nxIPCc290MFFSsyl81LMUnYleS0W',2,NULL,'2023-03-20 00:00:00','2023-03-20 00:00:00'),
(12,'moriyama','moriyamayukio85@gmail.com',NULL,'$2y$10$Dr3LRRvBvpFXjX04T388zOgCoOJrOkTYzUgTq6TIcrYjo7Oj1Iz42',2,NULL,'2023-03-21 14:56:33','2023-03-21 14:56:33'),
(18,'111','admin@raynguyen.net',NULL,'$2y$10$ei3HZNmtfICWNSDQs7vZu.D7jy.TSPOoeWNi9OtfteUZiBPUZJccu',2,NULL,'2023-04-24 21:35:59','2023-04-24 21:35:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
