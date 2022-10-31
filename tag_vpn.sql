-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tag_vpn
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` int DEFAULT '1' COMMENT '1=active & 0=deactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (1,'moynul','19moynul@gmail.com','$2y$10$cbRNyL9yUslfWlSkTflQkOQhgc7uz/zTawmDXYkVQ6u96IeZMGTGO',1,'2022-10-24 02:57:17','2022-10-25 20:43:21');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_password_resets`
--

DROP TABLE IF EXISTS `tbl_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int NOT NULL DEFAULT '1' COMMENT '1=admin 2=user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_password_resets`
--

LOCK TABLES `tbl_password_resets` WRITE;
/*!40000 ALTER TABLE `tbl_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_premium_subscription`
--

DROP TABLE IF EXISTS `tbl_premium_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_premium_subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subtitle` varchar(300) NOT NULL,
  `validity` varchar(100) NOT NULL,
  `free_days` varchar(100) NOT NULL,
  `status` int DEFAULT '1' COMMENT '1=active & 0=deactive',
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_premium_subscription`
--

LOCK TABLES `tbl_premium_subscription` WRITE;
/*!40000 ALTER TABLE `tbl_premium_subscription` DISABLE KEYS */;
INSERT INTO `tbl_premium_subscription` VALUES (1,'Anual','anual subscription','1 month','1 day',1,100,'2022-10-23 21:44:41','2022-10-24 03:48:06','2022-10-23 21:45:13'),(4,'Anual 2','anual subscription','1 month','1 day',1,200,'2022-10-23 21:47:36','2022-10-23 21:47:36',NULL);
/*!40000 ALTER TABLE `tbl_premium_subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_premium_subscription_to_user`
--

DROP TABLE IF EXISTS `tbl_premium_subscription_to_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_premium_subscription_to_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subscription_id` int NOT NULL,
  `activated_at` varchar(100) NOT NULL,
  `deactivated_at` varchar(100) NOT NULL,
  `free_days` varchar(100) NOT NULL,
  `status` int DEFAULT '1' COMMENT '1=active & 0=deactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_premium_subscription_to_user`
--

LOCK TABLES `tbl_premium_subscription_to_user` WRITE;
/*!40000 ALTER TABLE `tbl_premium_subscription_to_user` DISABLE KEYS */;
INSERT INTO `tbl_premium_subscription_to_user` VALUES (1,1,1,'2022-10-24 02:02:18','2022-11-24 02:02:18','1 day',2,'2022-10-23 20:02:18','2022-10-23 22:42:37'),(2,1,4,'2022-10-26 05:10:10','2022-11-26 05:10:10','1 day',2,'2022-10-25 23:10:10','2022-10-25 23:10:42');
/*!40000 ALTER TABLE `tbl_premium_subscription_to_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_server`
--

DROP TABLE IF EXISTS `tbl_server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_server` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `port` varchar(45) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_server`
--

LOCK TABLES `tbl_server` WRITE;
/*!40000 ALTER TABLE `tbl_server` DISABLE KEYS */;
INSERT INTO `tbl_server` VALUES (1,'Bangladesh','192.168.0.1','100',NULL),(2,'Pakistan','192.168.0.1','200',NULL),(3,'India','192.168.0.1','300',NULL);
/*!40000 ALTER TABLE `tbl_server` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT 'normal' COMMENT 'normal,facebook,google',
  `auth_id` varchar(100) DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1=active & 0=deactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'moynul','19moynul@gmail.com','$2y$10$PBCiw0RW/vOYITDbuW./u.X1o9r7Fv4iZEPIgE6yuuuf54hLg2jli','normal',NULL,1,'2022-10-23 01:35:58','2022-10-25 20:20:24'),(2,'moynul','19moynuls@gmail.com','$2y$10$ZEXYOiK7JHL8NqooGXZer.9Zf92ecZHxzjsuI4TBxsQKuhcgBH.8S','normal',NULL,1,'2022-10-23 02:21:38',NULL),(3,'moynul','19smoynul@gmail.com','$2y$10$6687N61/3QUfLTM3zudHLuCaDGb9dQapB6kmbuDvC0KlnCo4otA0O','normal',NULL,1,'2022-10-23 04:51:56',NULL);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_to_device`
--

DROP TABLE IF EXISTS `tbl_user_to_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_to_device` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `device_name` varchar(150) DEFAULT NULL,
  `uid` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_to_device`
--

LOCK TABLES `tbl_user_to_device` WRITE;
/*!40000 ALTER TABLE `tbl_user_to_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_to_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_transaction_history`
--

DROP TABLE IF EXISTS `tbl_user_transaction_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_transaction_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subscription_id` int NOT NULL,
  `payment_method` int NOT NULL,
  `transaction_id` varchar(150) NOT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_transaction_history`
--

LOCK TABLES `tbl_user_transaction_history` WRITE;
/*!40000 ALTER TABLE `tbl_user_transaction_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_transaction_history` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-31  8:04:14
