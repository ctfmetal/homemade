-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: homemade
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.12-MariaDB-1~trusty

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `priv` varchar(45) NOT NULL DEFAULT '0',
  `owner` varchar(45) NOT NULL,
  `structure` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (116,'Energy','2','0','admin','/1/Energy');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `idfile` int(11) NOT NULL AUTO_INCREMENT,
  `file_id_category` varchar(45) NOT NULL,
  `file_id_folder` varchar(45) DEFAULT NULL,
  `file_name` varchar(45) NOT NULL,
  `file_type` varchar(45) NOT NULL,
  `file_priv` varchar(45) NOT NULL,
  `file_id_owner` varchar(45) NOT NULL,
  `file_path` varchar(45) DEFAULT NULL,
  `file_upload_user` varchar(45) NOT NULL,
  `file_data_upload` varchar(45) NOT NULL,
  PRIMARY KEY (`idfile`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (142,'116','113','18fe1227a664777336ad73dffffcd5a6.jpg','2','0','admin','files/1/Energy/Bolletta ','admin','11/04/2016'),(143,'116','113','aec92372e84a22810fda0f2cd88164be.jpg','2','0','admin','files//1/Energy/Bolletta ','admin','11/04/2016'),(144,'116','113','f5724e0b8970d1a50f9a5702dd137657.jpg','2','0','admin','files//1/Energy/Bolletta ','admin','11/04/2016'),(145,'116','113','55e379d93885e722e8664ff4a2737aa9.jpg','2','0','admin','files//1/Energy/Bolletta ','admin','11/04/2016');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folder`
--

DROP TABLE IF EXISTS `folder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id_category` varchar(45) NOT NULL,
  `folder_name` varchar(45) NOT NULL,
  `folder_view` varchar(45) DEFAULT NULL,
  `folder_name_category` varchar(45) DEFAULT NULL,
  `folder_type` varchar(45) NOT NULL,
  `folder_priv` varchar(45) NOT NULL,
  `folder_path` varchar(45) DEFAULT NULL,
  `folder_owner` varchar(45) NOT NULL,
  `folder_upload_user` varchar(45) NOT NULL,
  `folder_importo` varchar(45) DEFAULT NULL,
  `folder_scadenza` varchar(45) DEFAULT NULL,
  `folder_data_upload` varchar(45) NOT NULL,
  `folder_pagata` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folder`
--

LOCK TABLES `folder` WRITE;
/*!40000 ALTER TABLE `folder` DISABLE KEYS */;
INSERT INTO `folder` VALUES (113,'116','Bolletta ','Enel 04/2016','Energy','2','0','/1/Energy','admin','admin','83,79','24/04/2016','11/04/2016','');
/*!40000 ALTER TABLE `folder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `profile` varchar(45) NOT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','0'),(5,'user','21232f297a57a5a743894a0e4a801fc3','1'),(7,'Admin2','21232f297a57a5a743894a0e4a801fc3','0'),(8,'user2','21232f297a57a5a743894a0e4a801fc3','1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-14 21:51:35
