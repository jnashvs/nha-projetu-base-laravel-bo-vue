# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.29)
# Base de Dados: bodatabase
# Tempo de Geração: 2021-09-24 13:59:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'admin','admin@admin.com','$2y$10$hewiJN3QDZ90zNCkrmjvg.Xh3Fm9pMjhhwlVlF4SFsOIq0hwJXCLG',NULL,'2021-07-02 11:02:02','2021-07-02 11:02:02');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela candidatos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `candidatos`;

CREATE TABLE `candidatos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(350) DEFAULT NULL,
  `cargo` varchar(350) DEFAULT NULL,
  `imagem` varchar(350) DEFAULT NULL,
  `imagem_hover` varchar(350) DEFAULT NULL,
  `imagem_detalhes` varchar(250) DEFAULT NULL,
  `descricao` longtext CHARACTER SET utf8,
  `ordem` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump da tabela failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump da tabela file_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `file_types`;

CREATE TABLE `file_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `directory` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extensions` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `max_file_size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `directory` (`directory`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `file_types` WRITE;
/*!40000 ALTER TABLE `file_types` DISABLE KEYS */;

INSERT INTO `file_types` (`id`, `directory`, `title`, `extensions`, `max_file_size`, `created_at`, `updated_at`)
VALUES
	(8,'slingshot','slingshot','[{\"name\":\"image\\/*\",\"code\":\"img\"},{\"name\":\"application\\/csv\",\"code\":\"csv\"}]',7,'2021-09-20 16:15:01','2021-09-21 12:31:27'),
	(14,'teste','teste','[{\"name\":\"application/pdf\",\"code\":\"pdf\"}]',33,'2021-09-23 15:39:57','2021-09-24 09:24:28');

/*!40000 ALTER TABLE `file_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `file_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_path_index` (`path`),
  KEY `files_file_type_id_index` (`file_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;

INSERT INTO `files` (`id`, `path`, `width`, `height`, `size`, `file_type_id`, `created_at`, `updated_at`)
VALUES
	(1,'/files/teste/1swf5orclLr7lEUr-residencia.pdf',NULL,NULL,0,14,'2021-09-23 15:41:06','2021-09-23 15:41:06'),
	(7,'/files/slingshot/98Cb-Captura de ecraÌƒ 2021-09-21, aÌ€s 17.11.42.png',NULL,NULL,0,8,'2021-09-23 17:34:16','2021-09-23 17:34:16'),
	(8,'/files/slingshot/KW4X-Captura de ecraÌƒ 2021-09-21, aÌ€s 17.11.42.png',NULL,NULL,0,8,'2021-09-23 17:34:31','2021-09-23 17:34:31'),
	(9,'/files/pdf/3dZA-residencia JORGE.pdf',NULL,NULL,0,15,'2021-09-24 08:41:01','2021-09-24 08:41:01');

/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump da tabela password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump da tabela users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(2,'user','user@user.com',NULL,'$2y$10$i08fJ.tjcviGf1u/ADF7TuXu3vCTiFAHeh4FON8fbJ7XzE6h0MrzS',NULL,'2021-07-02 11:39:31','2021-07-02 11:39:31'),
	(3,'Jorge Silva','jorge.silva@slingshot.pt',NULL,'$2y$10$uwZxTe/9wvLbSl19P8ZMeO7vfJInHlAnCxtnKFpa4NSeSh9dF1yeS',NULL,'2021-07-02 15:43:48','2021-07-02 15:43:48'),
	(7,'Eaton Mullen','caqovywov@mailinator.com',NULL,'$2y$10$I8TttmtMMuQ84huYWhhDIedcD.mtPvH2c8jWzGd.rLvjata7OLooy',NULL,'2021-09-24 11:36:59','2021-09-24 11:36:59');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela wishes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishes`;

CREATE TABLE `wishes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(350) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `freguesia` varchar(350) DEFAULT NULL,
  `email` varchar(350) DEFAULT NULL,
  `msg` text,
  `tipo` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
