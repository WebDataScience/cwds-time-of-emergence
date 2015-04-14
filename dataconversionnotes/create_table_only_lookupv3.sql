-- MySQL dump 10.13  Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost    Database: cig_toe
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `lookupv3`
--

DROP TABLE IF EXISTS `lookupv3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lookupv3` (
  `THEME` varchar(50) DEFAULT NULL,
  `AVERAGEEXTREME` varchar(20) DEFAULT NULL,
  `IMPACT` varchar(50) DEFAULT NULL,
  `TIMESCALE` varchar(50) DEFAULT NULL,
  `VARIABLEID` varchar(10) DEFAULT NULL,
  `VARIABLEDEF` varchar(250) DEFAULT NULL,
  `VARIABLEDEFINTERNAL` varchar(250) DEFAULT NULL,
  `VARIABLENAME` varchar(250) DEFAULT NULL,
  `VARIABLESHORTNAME` varchar(50) DEFAULT NULL,
  KEY `VARIABLEID` (`VARIABLEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

