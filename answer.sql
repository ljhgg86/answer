/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 10.1.9-MariaDB : Database - answer
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `answer`;

/*Table structure for table `answerrecord` */

CREATE TABLE `answerrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `au_id` int(11) DEFAULT NULL COMMENT 'app用户uid',
  `poll_id` int(11) DEFAULT NULL COMMENT '关联polls',
  `votes_id` int(11) DEFAULT NULL COMMENT '关联votes表',
  `option_id` int(11) DEFAULT NULL COMMENT '关联options表',
  `answertime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `telphone` char(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户手机号码',
  `answeruser_id` int(11) DEFAULT NULL COMMENT '关联answeruser表',
  `updated_at` timestamp NULL DEFAULT NULL,
  `delflag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `answerrecord` */

insert  into `answerrecord`(`id`,`au_id`,`poll_id`,`votes_id`,`option_id`,`answertime`,`created_at`,`telphone`,`answeruser_id`,`updated_at`,`delflag`) values (1,494952,1,1,2,'2018-05-25 10:47:42','2018-05-25 10:47:42','13715966381',1,'2018-05-25 10:47:42',0),(2,494952,1,2,6,'2018-05-25 10:48:09','2018-05-25 10:48:09','13715966381',1,'2018-05-25 10:48:09',0),(3,494952,2,3,8,'2018-09-11 12:41:27','2018-09-11 12:41:45','13715966381',1,'2018-09-11 12:41:49',0),(4,11,1,1,2,'2019-03-20 15:27:09','2019-03-20 15:27:12','12345678963',2,'2019-03-20 15:27:59',0),(5,11,1,2,4,'2019-03-20 15:27:15','2019-03-20 15:27:17','12345678963',2,'2019-03-20 15:28:01',0),(6,22,1,1,2,'2019-03-20 15:27:20','2019-03-20 15:27:22','12369874563',3,'2019-03-20 15:28:03',0),(7,22,1,2,6,'2019-03-20 15:27:24','2019-03-20 15:27:27','12369874563',3,'2019-03-20 15:28:05',0),(8,33,1,1,1,'2019-03-20 15:27:29','2019-03-20 15:27:31','78945612312',4,'2019-03-20 15:28:07',0),(9,33,1,2,6,'2019-03-20 15:27:45','2019-03-20 15:27:48','78945612312',4,'2019-03-20 15:28:09',0),(10,11,2,3,8,'2019-04-03 11:08:37','2019-04-03 11:08:43','12345678963',2,'2019-04-03 11:08:46',0),(11,11,2,4,10,'2019-04-03 11:09:12','2019-04-03 11:09:14','12345678963',2,'2019-04-03 11:09:27',0),(12,22,2,3,7,'2019-04-03 11:10:29','2019-04-03 11:10:31','12369874563',3,'2019-04-03 11:11:36',0),(13,33,2,4,10,'2019-04-03 11:12:19','2019-04-03 11:12:22','78945612312',4,'2019-04-03 11:12:40',0);

/*Table structure for table `answeruser` */

CREATE TABLE `answeruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'telphone',
  `delflag` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `answeruser` */

insert  into `answeruser`(`id`,`name`,`delflag`) values (1,'13715966381',0),(2,'12345678963',0),(3,'12369874536',0),(4,'78945612312',0);

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',2),(4,'2016_06_01_000002_create_oauth_access_tokens_table',2),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',2),(6,'2016_06_01_000004_create_oauth_clients_table',2),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',2);

/*Table structure for table `oauth_access_tokens` */

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

/*Table structure for table `oauth_auth_codes` */

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

insert  into `oauth_clients`(`id`,`user_id`,`name`,`secret`,`redirect`,`personal_access_client`,`password_client`,`revoked`,`created_at`,`updated_at`) values (1,NULL,'Laravel Personal Access Client','ve77R7MYoF41EHm9slgqTWkAfQbhxnq1ivRYNQJV','http://localhost',1,0,0,'2018-05-07 03:04:04','2018-05-07 03:04:04'),(2,NULL,'Laravel Password Grant Client','zpixRqI5zM0YO9ExhiAv59hJ31ogroCiE2Bk6M2F','http://localhost',0,1,0,'2018-05-07 03:04:04','2018-05-07 03:04:04');

/*Table structure for table `oauth_personal_access_clients` */

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

insert  into `oauth_personal_access_clients`(`id`,`client_id`,`created_at`,`updated_at`) values (1,1,'2018-05-07 03:04:04','2018-05-07 03:04:04');

/*Table structure for table `oauth_refresh_tokens` */

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `options` */

CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) DEFAULT NULL,
  `info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rightflag` tinyint(1) NOT NULL DEFAULT '0',
  `delflag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `options` */

insert  into `options`(`id`,`vote_id`,`info`,`rightflag`,`delflag`,`created_at`,`updated_at`) values (1,1,'中国胜',1,0,NULL,NULL),(2,1,'两队平',0,0,NULL,NULL),(3,1,'中国负',0,0,NULL,NULL),(4,2,'德国胜',0,1,NULL,'2019-04-12 08:29:17'),(5,2,'德国平',0,1,NULL,'2019-04-12 08:29:17'),(6,2,'德国负',1,1,NULL,'2019-04-12 08:29:17'),(7,3,'aa',0,0,NULL,NULL),(8,3,'aaa',1,0,NULL,NULL),(9,4,'bb',0,0,NULL,NULL),(10,4,'bbb',1,0,NULL,NULL),(11,2,'德国胜',0,1,NULL,'2019-04-12 08:29:17'),(12,2,'德国平',1,1,NULL,'2019-04-12 08:29:17'),(13,2,'德国负',0,1,NULL,'2019-04-12 08:29:17'),(14,2,'德国胜',0,1,NULL,'2019-04-12 08:29:17'),(15,2,'德国平',0,1,NULL,'2019-04-12 08:29:17'),(16,2,'德国负',1,1,NULL,'2019-04-12 08:29:17'),(17,2,'德国胜',0,0,NULL,NULL),(18,2,'德国平',1,0,NULL,NULL),(19,2,'德国负',0,0,NULL,NULL);

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `polls` */

CREATE TABLE `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `description` text COLLATE utf8_unicode_ci COMMENT '描述',
  `delflag` tinyint(1) NOT NULL DEFAULT '0',
  `videosrc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '视频源地址',
  `videoposter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '视频封面图',
  `starttime` datetime DEFAULT NULL COMMENT '活动开始时间',
  `endtime` datetime DEFAULT NULL COMMENT '活动结束时间',
  `rewardflag` tinyint(1) DEFAULT '0' COMMENT '抽奖标志',
  `rewarded` tinyint(1) DEFAULT '0' COMMENT '已抽奖标志',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `polls` */

insert  into `polls`(`id`,`title`,`description`,`delflag`,`videosrc`,`videoposter`,`starttime`,`endtime`,`rewardflag`,`rewarded`,`created_at`,`updated_at`) values (1,'test1','算得上是',0,'https://green.strtv.cn/uploads/20180518/bwg2018.mp4','http://127.0.0.1:8000/images/iAJyk2xLUUp9I1Ef.jpg','2018-05-23 15:11:50','2019-01-28 16:58:51',1,1,NULL,'2019-04-03 02:43:21'),(2,'222','发发发发发发发发发发发发发',0,'222','222','2018-09-11 12:42:21','2018-09-11 12:42:16',1,1,NULL,'2019-04-03 08:06:31');

/*Table structure for table `reward` */

CREATE TABLE `reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) DEFAULT NULL COMMENT '关联poll表',
  `answeruser_id` int(11) DEFAULT NULL COMMENT '关联answeruser表',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delflag` int(1) DEFAULT '0',
  `rightcounts` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `reward` */

insert  into `reward`(`id`,`poll_id`,`answeruser_id`,`created_at`,`updated_at`,`delflag`,`rightcounts`) values (1,1,4,'2019-03-21 10:12:44','0000-00-00 00:00:00',0,2),(2,1,3,'2019-03-21 10:12:44','0000-00-00 00:00:00',0,1),(3,1,4,'2019-03-21 11:26:10','0000-00-00 00:00:00',0,2),(4,1,3,'2019-03-21 11:26:10','0000-00-00 00:00:00',0,1),(5,1,4,'2019-03-21 11:26:23','0000-00-00 00:00:00',0,2),(6,1,3,'2019-03-21 11:26:23','0000-00-00 00:00:00',0,1),(7,2,2,'2019-04-03 11:13:15','0000-00-00 00:00:00',0,2),(8,2,1,'2019-04-03 11:13:15','0000-00-00 00:00:00',0,1),(9,2,4,'2019-04-03 11:13:15','0000-00-00 00:00:00',0,1),(10,2,3,'2019-04-03 11:13:15','0000-00-00 00:00:00',0,0),(11,2,2,'2019-04-03 15:13:17','0000-00-00 00:00:00',0,2),(12,2,1,'2019-04-03 15:13:17','0000-00-00 00:00:00',0,1),(13,2,4,'2019-04-03 15:13:17','0000-00-00 00:00:00',0,1),(14,2,3,'2019-04-03 15:13:17','0000-00-00 00:00:00',0,0),(15,2,2,'2019-04-03 15:14:23','0000-00-00 00:00:00',0,2),(16,2,4,'2019-04-03 15:14:23','0000-00-00 00:00:00',0,1),(17,2,1,'2019-04-03 15:14:23','0000-00-00 00:00:00',0,1),(18,2,3,'2019-04-03 15:14:23','0000-00-00 00:00:00',0,0),(19,2,2,'2019-04-03 15:16:52','0000-00-00 00:00:00',0,2),(20,2,1,'2019-04-03 15:16:52','0000-00-00 00:00:00',0,1),(21,2,4,'2019-04-03 15:16:52','0000-00-00 00:00:00',0,1),(22,2,3,'2019-04-03 15:16:52','0000-00-00 00:00:00',0,0),(23,2,2,'2019-04-03 15:37:19','0000-00-00 00:00:00',0,2),(24,2,4,'2019-04-03 15:37:19','0000-00-00 00:00:00',0,1),(25,2,1,'2019-04-03 15:37:19','0000-00-00 00:00:00',0,1),(26,2,3,'2019-04-03 15:37:19','0000-00-00 00:00:00',0,0),(27,2,2,'2019-04-03 15:38:09','0000-00-00 00:00:00',0,2),(28,2,1,'2019-04-03 15:38:09','0000-00-00 00:00:00',0,1),(29,2,2,'2019-04-03 15:50:11','0000-00-00 00:00:00',0,2),(30,2,4,'2019-04-03 15:50:11','0000-00-00 00:00:00',0,1),(31,2,2,'2019-04-03 16:01:04','0000-00-00 00:00:00',0,2),(32,2,1,'2019-04-03 16:01:04','0000-00-00 00:00:00',0,1),(33,2,2,'2019-04-03 16:02:50','0000-00-00 00:00:00',0,2),(34,2,4,'2019-04-03 16:02:50','0000-00-00 00:00:00',0,1),(35,2,2,'2019-04-03 16:06:31','0000-00-00 00:00:00',0,2),(36,2,4,'2019-04-03 16:06:31','0000-00-00 00:00:00',0,1);

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','admin@olive.cn','$2y$10$tKeTroCeLepVIDP0/f0dzeAPRtLgoslejpH/1.eqrC/pdsTfN7xmW','EkL30A8LNKnDWW01FENf6GR4y39Lvijx7W8BjI4llxKAzUw4jS6EOKHaaAvp','2018-05-03 04:45:35','2018-05-03 04:45:35');

/*Table structure for table `votes` */

CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `poll_id` int(11) DEFAULT NULL,
  `start_at` int(11) DEFAULT NULL,
  `staytime` int(11) DEFAULT '6',
  `delflag` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `votes` */

insert  into `votes`(`id`,`title`,`description`,`poll_id`,`start_at`,`staytime`,`delflag`,`created_at`,`updated_at`) values (1,'中国VS巴西强强强强强强强强',' dfsdgsgseg',1,3,20,0,NULL,NULL),(2,'ff','ddd',1,6,20,0,NULL,'2019-04-12 08:08:33'),(3,'aaa',NULL,2,10,6,0,NULL,NULL),(4,'bbb',NULL,2,10,6,0,NULL,NULL),(5,'cc',NULL,NULL,25,6,0,'2019-04-09 02:44:05','2019-04-09 02:44:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
