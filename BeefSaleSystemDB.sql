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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `laravel`;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `markets` */

insert  into `markets`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'MarketA','123','123','2023-03-11 05:29:54','2023-03-11 05:29:54'),
(2,'marketB','23','23','2023-03-11 05:30:06','2023-03-11 05:30:06'),
(3,'MarketC','123','123','2023-03-11 05:30:19','2023-03-11 05:30:19');

/*Table structure for table `meats` */

DROP TABLE IF EXISTS `meats`;

CREATE TABLE `meats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ox_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  `weight` decimal(11,2) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meats_ox_id_foreign` (`ox_id`),
  KEY `meats_part_id_foreign` (`part_id`),
  CONSTRAINT `meats_ox_id_foreign` FOREIGN KEY (`ox_id`) REFERENCES `oxen` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `meats_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `meats` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12,'2023_03_08_055755_create_meats_table',1);

/*Table structure for table `oxen` */

DROP TABLE IF EXISTS `oxen`;

CREATE TABLE `oxen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `registerNumber` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `sex` int(11) NOT NULL,
  `market_id` bigint(20) unsigned DEFAULT NULL,
  `purchaseDate` date DEFAULT NULL,
  `purchasePrice` decimal(11,2) DEFAULT NULL,
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
  `acceptedWeight` decimal(11,2) DEFAULT NULL,
  `acceptedLevel` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `oxen_registernumber_unique` (`registerNumber`),
  KEY `oxen_market_id_foreign` (`market_id`),
  KEY `oxen_purchasetransport_company_id_foreign` (`purchaseTransport_Company_id`),
  KEY `oxen_pastoral_id_foreign` (`pastoral_id`),
  KEY `oxen_slaughtertransport_company_id_foreign` (`slaughterTransport_Company_id`),
  KEY `oxen_slaughterhouse_id_foreign` (`slaughterHouse_id`),
  CONSTRAINT `oxen_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `oxen_pastoral_id_foreign` FOREIGN KEY (`pastoral_id`) REFERENCES `pastorals` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `oxen_purchasetransport_company_id_foreign` FOREIGN KEY (`purchaseTransport_Company_id`) REFERENCES `transport_companies` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `oxen_slaughterhouse_id_foreign` FOREIGN KEY (`slaughterHouse_id`) REFERENCES `slaughter_houses` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `oxen_slaughtertransport_company_id_foreign` FOREIGN KEY (`slaughterTransport_Company_id`) REFERENCES `transport_companies` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oxen` */

insert  into `oxen`(`id`,`registerNumber`,`name`,`birthday`,`sex`,`market_id`,`purchaseDate`,`purchasePrice`,`purchaseTransport_Company_id`,`loadDate`,`unloadDate`,`pastoral_id`,`accessDate`,`exportDate`,`appendInfo`,`slaughterTransport_Company_id`,`slaughterHouse_id`,`acceptedDateSlaughterHouse`,`acceptedWeight`,`acceptedLevel`,`created_at`,`updated_at`) values 
(1,'1111','Oxen01','2004-03-05',0,1,'2023-03-11',12.00,1,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-03-11 05:35:47','2023-03-11 05:35:47'),
(2,'23','23','2023-03-16',1,1,'2023-03-11',23.00,1,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-03-11 05:54:36','2023-03-11 05:54:36');

/*Table structure for table `parts` */

DROP TABLE IF EXISTS `parts`;

CREATE TABLE `parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `parts` */

insert  into `parts`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'PartA','2023-03-11 05:34:18','2023-03-11 05:34:18'),
(2,'PartB','2023-03-11 05:34:29','2023-03-11 05:34:29'),
(3,'PartC','2023-03-11 05:34:37','2023-03-11 05:34:37');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pastorals` */

insert  into `pastorals`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'PastoralA','sd','sd','2023-03-11 05:31:34','2023-03-11 05:31:34'),
(2,'PastoralB','sd','sd','2023-03-11 05:31:44','2023-03-11 05:31:44'),
(3,'PastoralC','23','23','2023-03-11 05:31:59','2023-03-11 05:31:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `slaughter_houses` */

insert  into `slaughter_houses`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(3,'SlaughterHouseA','qw','qw','2023-03-11 05:33:22','2023-03-11 05:33:22'),
(4,'SlaughterHouseB','23','23','2023-03-11 05:33:36','2023-03-11 05:33:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transport_companies` */

insert  into `transport_companies`(`id`,`name`,`position`,`note`,`created_at`,`updated_at`) values 
(1,'TransportCompanyA','123','123','2023-03-11 05:30:36','2023-03-11 05:30:36'),
(2,'TransportCompanyB','23','23','2023-03-11 05:30:48','2023-03-11 05:30:48'),
(3,'TransportCompanyC','sd','sd','2023-03-11 05:31:06','2023-03-11 05:31:06');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'moriyamayukio','moriyamayukio85@gmail.com',NULL,'$2y$10$btrwqaG7xdVdM1cVZcO/AuXJykuoWyW8YqqGI1QpyGBJEfTybP.BG',NULL,'2023-03-11 04:55:09','2023-03-11 04:55:09');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
