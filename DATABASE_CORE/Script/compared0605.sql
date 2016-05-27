-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: compared
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.10.1

create database compared;
use compared;

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
-- Table structure for table `Articles`
--

DROP TABLE IF EXISTS `Articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Articles` (
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `titleA` varchar(150) NOT NULL,
  `shortDescA` varchar(200) DEFAULT NULL,
  `contentA` text NOT NULL,
  `dateA` date NOT NULL,
  `idU` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`idA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Articles`
--

LOCK TABLES `Articles` WRITE;
/*!40000 ALTER TABLE `Articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `Articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORY`
--

DROP TABLE IF EXISTS `CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORY` (
  `idCategory` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORY`
--

LOCK TABLES `CATEGORY` WRITE;
/*!40000 ALTER TABLE `CATEGORY` DISABLE KEYS */;
/*!40000 ALTER TABLE `CATEGORY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMPARED`
--

DROP TABLE IF EXISTS `COMPARED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMPARED` (
  `idCOMPARED` int(11) NOT NULL AUTO_INCREMENT,
  `idS1` int(11) NOT NULL,
  `idS2` int(11) NOT NULL,
  PRIMARY KEY (`idCOMPARED`),
  KEY `FK_sm1` (`idS1`),
  KEY `FK_sm2` (`idS2`),
  CONSTRAINT `FK_sm1` FOREIGN KEY (`idS1`) REFERENCES `Smartphone` (`idS`),
  CONSTRAINT `FK_sm2` FOREIGN KEY (`idS2`) REFERENCES `Smartphone` (`idS`)
) ENGINE=InnoDB AUTO_INCREMENT=1655 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMPARED`
--

LOCK TABLES `COMPARED` WRITE;
/*!40000 ALTER TABLE `COMPARED` DISABLE KEYS */;
INSERT INTO `COMPARED` VALUES (2,2,1),(3,1,1),(4,1,2),(5,1,2),(6,2,1),(7,1,2),(8,2,1),(9,1,2),(10,1,2),(11,1,2),(12,1,2),(13,1,2),(14,1,2),(15,1,2),(16,1,2),(17,2,1),(18,2,1),(19,1,2),(20,2,1),(21,1,2),(22,1,2),(23,1,2),(24,1,2),(25,1,1),(26,1,2),(27,1,2),(28,1,2),(29,1,2),(30,1,2),(31,1,2),(32,1,2),(33,1,2),(34,1,2),(35,1,2),(36,1,2),(37,1,2),(38,1,2),(39,1,2),(40,1,2),(41,1,2),(42,1,2),(43,1,2),(44,1,2),(45,1,2),(46,1,2),(47,1,2),(48,1,2),(49,1,2),(50,1,2),(51,1,2),(52,1,2),(53,1,2),(54,1,2),(55,1,2),(56,1,2),(57,1,2),(58,1,2),(59,1,2),(60,1,2),(61,1,2),(62,1,2),(63,1,2),(64,1,2),(65,1,2),(66,1,2),(67,1,2),(68,1,2),(69,1,2),(70,1,2),(71,1,2),(72,1,2),(73,1,2),(74,1,2),(75,1,2),(76,1,2),(77,1,2),(78,1,2),(79,1,2),(80,1,2),(81,1,2),(82,1,2),(83,1,2),(84,1,2),(85,1,2),(86,1,2),(87,1,2),(88,1,2),(89,1,2),(90,1,2),(91,1,2),(92,1,2),(93,1,2),(94,1,2),(95,1,2),(96,1,2),(97,1,2),(98,1,2),(99,1,2),(100,1,2),(101,1,2),(102,1,2),(103,1,2),(104,1,2),(105,1,2),(106,1,2),(107,1,2),(108,1,2),(109,1,2),(110,1,2),(111,1,2),(112,1,2),(113,1,2),(114,1,2),(115,1,2),(116,1,2),(117,1,2),(118,1,2),(119,1,2),(120,1,2),(121,1,2),(122,1,2),(123,1,2),(124,1,2),(125,1,2),(126,1,2),(127,2,1),(131,2,1),(132,2,1),(133,2,1),(134,2,1),(135,2,1),(136,3,1),(137,3,1),(138,3,1),(139,3,4),(140,3,4),(141,4,3),(142,2,3),(143,2,3),(144,1,2),(145,3,4),(146,2,3),(147,1,2),(148,3,2),(149,3,2),(150,3,2),(151,3,2),(152,3,2),(153,3,2),(154,3,2),(155,3,2),(156,3,2),(157,3,2),(158,3,2),(159,3,2),(160,3,2),(161,3,2),(162,3,2),(163,3,2),(164,3,2),(165,3,2),(166,3,2),(167,3,2),(168,3,2),(169,3,2),(170,3,2),(171,3,2),(172,3,2),(173,3,2),(174,3,2),(175,3,2),(176,3,2),(177,3,2),(178,3,2),(179,3,2),(180,3,2),(181,3,2),(182,3,2),(183,2,3),(184,2,3),(185,3,2),(192,3,2),(193,3,2),(194,3,2),(195,3,2),(196,3,2),(197,3,2),(198,3,2),(199,3,2),(200,3,2),(201,3,2),(202,3,2),(203,1,2),(204,1,2),(205,1,2),(206,1,2),(207,3,2),(208,3,2),(209,3,2),(210,3,2),(211,3,2),(212,3,2),(213,3,2),(214,3,2),(215,3,2),(216,3,2),(217,3,2),(218,3,2),(219,3,2),(220,3,2),(221,3,2),(222,3,2),(223,3,2),(224,3,2),(225,3,2),(226,3,2),(227,3,2),(228,3,2),(229,3,2),(230,3,2),(231,3,2),(232,3,2),(233,3,2),(234,3,2),(235,3,2),(236,3,2),(237,3,2),(238,3,2),(239,3,4),(240,3,4),(241,3,4),(242,3,4),(243,3,4),(244,1,2),(245,1,2),(246,1,2),(247,1,2),(248,1,2),(249,1,2),(250,1,2),(251,1,2),(252,1,2),(253,1,2),(254,1,2),(255,1,2),(256,1,2),(257,1,2),(258,1,2),(259,1,2),(260,1,2),(261,1,2),(262,1,2),(263,1,2),(264,1,2),(265,1,2),(266,1,2),(267,1,2),(268,1,2),(269,1,2),(270,1,2),(271,1,2),(272,1,2),(273,1,2),(274,1,2),(275,1,2),(276,1,2),(277,1,2),(278,1,2),(279,1,2),(280,1,2),(281,1,2),(282,1,2),(283,1,2),(284,1,2),(285,1,2),(286,1,2),(287,1,2),(288,1,2),(289,1,2),(290,1,2),(291,1,2),(292,1,2),(293,1,2),(294,1,2),(295,1,2),(296,1,2),(297,1,2),(298,1,2),(299,1,2),(300,1,2),(301,1,2),(302,1,2),(303,1,2),(304,1,2),(305,1,2),(306,1,2),(307,1,2),(308,1,2),(309,1,2),(310,1,2),(311,1,2),(312,1,2),(313,1,2),(314,1,2),(315,1,2),(316,1,2),(317,1,2),(318,1,2),(319,1,2),(320,1,2),(321,1,2),(322,1,2),(323,1,2),(324,1,2),(325,1,2),(326,1,2),(327,1,2),(328,1,2),(329,1,2),(330,1,2),(331,1,2),(332,1,2),(333,1,2),(334,1,2),(335,1,2),(336,1,2),(337,1,2),(338,1,2),(339,1,2),(340,1,2),(341,1,2),(342,1,2),(343,1,2),(344,1,2),(345,1,2),(346,1,2),(347,1,2),(348,1,2),(349,1,2),(350,1,2),(351,1,2),(352,1,2),(353,1,2),(354,1,2),(355,1,2),(356,1,2),(357,1,2),(358,1,2),(359,1,2),(360,1,2),(361,1,2),(362,1,2),(363,1,2),(364,1,2),(365,1,2),(366,1,2),(367,1,2),(368,1,2),(369,1,2),(370,1,2),(371,1,2),(372,1,2),(373,1,2),(374,1,2),(375,1,2),(376,1,2),(377,1,2),(378,1,2),(379,1,2),(380,1,2),(381,1,2),(382,1,2),(383,1,2),(384,1,2),(385,1,2),(386,1,2),(387,1,2),(388,1,2),(389,1,2),(390,1,2),(391,1,2),(392,1,2),(393,1,2),(394,1,2),(395,1,2),(396,1,2),(397,1,2),(398,1,2),(399,1,2),(400,1,2),(401,1,2),(402,1,2),(403,1,2),(404,1,2),(405,1,2),(406,1,2),(407,1,2),(408,1,2),(409,1,2),(410,1,2),(411,1,2),(412,1,2),(413,1,2),(414,1,2),(415,1,2),(416,1,2),(417,1,1),(418,1,3),(419,1,4),(420,1,4),(421,1,3),(422,1,3),(423,1,3),(424,1,3),(425,1,3),(426,1,3),(427,1,3),(428,1,3),(429,1,3),(430,1,3),(431,1,3),(432,1,3),(433,1,3),(434,1,3),(435,1,3),(436,1,3),(437,1,3),(438,1,3),(439,1,3),(440,1,3),(441,1,3),(442,1,3),(443,1,3),(444,1,3),(445,1,3),(446,1,3),(447,1,3),(448,1,3),(449,1,3),(450,1,3),(451,1,3),(452,1,3),(453,1,3),(454,1,3),(455,1,3),(456,1,3),(457,1,3),(458,1,3),(459,1,3),(460,1,3),(461,1,3),(462,1,3),(463,1,3),(464,1,3),(465,1,3),(466,1,3),(467,1,3),(468,1,3),(469,1,3),(470,1,3),(471,1,3),(472,1,3),(473,1,3),(474,1,3),(475,1,3),(476,1,3),(477,1,3),(478,1,3),(479,1,3),(480,1,3),(481,1,3),(482,1,3),(483,1,3),(484,1,3),(485,1,3),(486,1,3),(487,1,3),(488,1,3),(489,1,3),(490,1,3),(491,1,3),(492,1,3),(493,1,3),(494,1,3),(495,1,3),(496,1,3),(497,1,3),(498,1,3),(499,1,3),(500,1,3),(501,1,3),(502,1,3),(503,1,3),(504,1,3),(505,1,3),(506,1,3),(507,1,3),(508,1,3),(509,1,3),(510,1,3),(511,1,3),(512,1,3),(513,1,3),(514,1,3),(515,1,2),(516,1,2),(517,1,2),(518,1,2),(519,1,2),(520,1,2),(521,1,2),(522,1,2),(523,1,2),(524,1,2),(525,1,2),(526,1,2),(527,1,3),(528,1,2),(529,1,3),(530,1,2),(531,1,3),(532,1,3),(533,1,2),(534,1,2),(535,1,2),(536,1,2),(537,1,2),(538,1,2),(539,1,2),(540,1,2),(541,1,2),(542,1,2),(543,1,2),(544,1,2),(545,1,2),(546,1,2),(547,1,2),(548,1,2),(549,1,2),(550,1,2),(551,1,2),(552,1,2),(553,1,2),(554,1,2),(555,1,2),(556,1,2),(557,1,2),(558,1,2),(559,1,2),(560,1,2),(561,1,2),(562,1,2),(563,1,2),(564,1,2),(565,1,2),(566,1,2),(567,1,2),(568,1,2),(569,1,2),(570,1,2),(571,1,2),(572,1,2),(573,1,2),(574,1,2),(575,1,2),(576,1,2),(577,1,2),(578,1,2),(579,1,2),(580,1,2),(581,1,2),(582,1,2),(583,1,4),(584,1,4),(585,1,4),(586,1,4),(587,1,4),(588,1,4),(589,1,4),(590,1,4),(591,1,4),(592,1,4),(593,1,4),(594,1,4),(595,1,4),(596,1,4),(597,1,4),(598,1,4),(599,1,4),(600,1,4),(601,1,4),(602,1,4),(603,1,4),(604,1,4),(605,1,4),(606,1,4),(607,1,4),(608,1,4),(609,1,4),(610,1,4),(611,1,4),(612,1,4),(613,1,4),(614,1,4),(615,1,4),(616,1,4),(617,1,4),(618,1,4),(619,1,4),(620,1,4),(621,1,4),(622,1,4),(623,1,4),(624,1,4),(625,1,4),(626,1,4),(627,1,4),(628,1,4),(629,1,4),(630,1,4),(631,1,4),(632,1,4),(633,1,4),(634,1,4),(635,1,4),(636,1,4),(637,1,4),(638,1,4),(639,1,4),(640,1,4),(641,1,4),(642,1,4),(643,1,4),(644,1,4),(645,1,4),(646,1,4),(647,1,4),(648,1,4),(649,1,4),(650,1,4),(651,1,4),(652,1,4),(653,1,4),(654,1,4),(655,1,4),(656,1,4),(657,1,4),(658,1,4),(659,1,4),(660,1,4),(661,1,4),(662,1,4),(663,1,4),(664,1,4),(665,1,4),(666,1,4),(667,1,4),(668,1,4),(669,1,4),(670,1,4),(671,1,4),(672,1,4),(673,1,4),(674,1,4),(675,1,4),(676,1,4),(677,1,4),(678,1,4),(679,1,4),(680,1,4),(681,1,4),(682,1,4),(683,1,4),(684,1,4),(685,1,4),(686,1,4),(687,1,4),(688,1,4),(689,1,4),(690,1,4),(691,1,4),(692,1,4),(693,1,4),(694,1,4),(695,1,4),(696,1,4),(697,1,4),(698,1,3),(699,1,2),(700,1,1),(701,1,2),(702,1,2),(703,1,2),(704,1,2),(705,1,2),(706,1,2),(707,1,2),(708,1,2),(709,1,2),(710,1,2),(711,1,2),(712,1,2),(713,1,2),(714,1,2),(715,1,2),(716,1,2),(717,1,2),(718,1,2),(719,1,2),(720,1,2),(721,1,2),(722,1,2),(723,1,2),(724,1,2),(725,1,2),(726,1,2),(727,1,2),(728,1,2),(729,1,2),(730,1,2),(731,1,2),(732,1,2),(733,1,2),(734,1,2),(735,1,2),(736,1,3),(737,1,4),(738,1,4),(739,1,4),(740,1,4),(741,1,4),(742,1,4),(743,1,3),(744,1,2),(745,1,2),(746,1,2),(747,1,2),(748,1,2),(749,1,2),(750,1,2),(751,1,3),(752,1,3),(753,1,3),(754,1,3),(755,1,3),(756,1,3),(757,1,3),(758,1,3),(759,1,3),(760,1,3),(761,1,3),(762,1,3),(763,1,3),(764,1,3),(765,1,3),(766,1,2),(767,1,2),(768,1,2),(769,1,2),(770,1,2),(771,1,2),(772,1,2),(773,1,2),(774,1,2),(775,1,2),(776,1,4),(777,1,2),(778,1,3),(779,1,2),(780,1,2),(781,1,2),(782,1,2),(783,1,2),(784,1,2),(785,1,2),(786,1,2),(787,1,2),(788,1,2),(789,1,2),(790,1,2),(791,1,2),(792,1,2),(793,1,2),(794,1,2),(795,1,2),(796,1,2),(797,1,2),(798,1,2),(799,1,2),(800,1,2),(801,1,2),(802,1,2),(803,1,2),(804,1,2),(805,1,2),(806,1,2),(807,1,2),(808,1,2),(809,1,2),(810,1,2),(811,1,2),(812,1,2),(813,1,2),(814,1,2),(815,1,2),(816,1,3),(817,1,3),(818,1,3),(819,1,3),(820,1,3),(821,1,3),(822,1,3),(823,1,3),(824,1,3),(825,1,3),(826,1,3),(827,1,3),(828,1,3),(829,1,3),(830,1,3),(831,1,3),(832,1,3),(833,1,3),(834,1,3),(835,1,3),(836,1,3),(837,1,3),(838,1,3),(839,1,3),(840,1,3),(841,1,3),(842,1,3),(843,1,3),(844,1,3),(845,1,3),(846,1,3),(847,1,3),(848,1,3),(849,1,3),(850,1,3),(851,1,3),(852,1,3),(853,1,3),(854,1,3),(855,1,3),(856,1,3),(857,1,3),(858,1,3),(859,1,3),(860,1,3),(861,1,3),(862,1,3),(863,1,3),(864,1,3),(865,1,3),(866,1,3),(867,1,1),(868,1,1),(869,1,1),(870,1,3),(871,1,3),(872,1,3),(873,1,3),(874,1,3),(875,1,3),(876,1,3),(877,1,3),(878,1,2),(879,1,2),(880,1,2),(881,1,3),(882,1,3),(883,1,3),(884,1,3),(885,1,3),(886,1,3),(887,1,3),(888,1,3),(889,1,3),(890,1,3),(891,1,3),(892,1,3),(893,1,3),(894,1,3),(895,1,3),(896,1,3),(897,1,3),(898,1,3),(899,1,3),(901,2,4),(903,1,3),(904,1,2),(905,1,1),(908,1,1),(912,1,1),(915,1,3),(917,1,3),(918,1,3),(919,1,3),(920,1,3),(921,1,3),(922,1,3),(923,1,3),(924,1,3),(930,1,3),(946,4,4),(947,4,4),(948,2,2),(949,2,2),(950,1,3),(951,2,3),(952,4,3),(953,3,2),(954,1,2),(955,2,3),(956,2,3),(957,2,3),(958,3,2),(959,3,4),(961,4,2),(962,4,2),(963,3,4),(964,3,4),(965,2,1),(966,4,1),(967,4,3),(968,2,3),(969,4,3),(970,4,3),(971,3,4),(972,3,4),(973,3,4),(974,3,4),(975,1,4),(976,2,3),(977,1,2),(978,1,2),(979,1,2),(980,1,2),(981,1,2),(982,1,2),(983,1,2),(984,1,2),(985,1,2),(986,2,3),(987,2,3),(988,1,2),(989,1,2),(990,1,2),(991,1,2),(992,1,2),(993,1,2),(994,3,4),(995,3,4),(996,3,4),(997,3,4),(998,1,2),(999,1,2),(1000,3,4),(1001,3,4),(1002,1,2),(1003,2,3),(1004,1,2),(1005,1,2),(1006,1,2),(1007,1,2),(1008,1,2),(1009,1,2),(1010,1,2),(1011,1,2),(1012,1,2),(1013,1,2),(1014,1,2),(1015,1,2),(1016,1,2),(1017,1,2),(1018,1,2),(1019,1,2),(1020,1,2),(1021,1,2),(1022,1,2),(1023,1,2),(1024,1,2),(1025,1,2),(1026,1,2),(1027,1,2),(1028,1,2),(1029,1,2),(1030,1,2),(1031,1,2),(1032,1,2),(1033,1,2),(1034,1,2),(1035,1,2),(1036,1,2),(1037,1,2),(1038,1,2),(1039,1,2),(1040,1,2),(1041,1,2),(1042,1,2),(1043,1,2),(1044,1,2),(1045,1,2),(1046,1,2),(1047,1,2),(1048,1,2),(1049,1,2),(1050,1,2),(1051,1,2),(1052,1,2),(1053,1,2),(1054,1,2),(1055,1,2),(1056,1,2),(1057,1,2),(1058,1,2),(1059,1,2),(1060,1,2),(1061,1,2),(1062,1,2),(1063,1,2),(1064,1,2),(1065,1,2),(1066,1,2),(1067,1,2),(1068,1,2),(1069,1,2),(1070,1,2),(1071,1,2),(1072,1,2),(1073,1,2),(1074,3,4),(1075,1,2),(1076,1,2),(1077,1,2),(1078,1,2),(1079,1,2),(1080,1,2),(1081,2,3),(1082,2,3),(1083,2,3),(1084,2,3),(1085,2,3),(1086,2,3),(1087,2,3),(1088,2,3),(1089,2,3),(1090,2,3),(1091,2,3),(1092,2,3),(1093,2,3),(1094,2,3),(1095,2,3),(1096,2,3),(1097,2,3),(1098,2,3),(1099,2,3),(1100,2,3),(1101,2,3),(1102,2,3),(1103,2,3),(1104,2,3),(1105,2,3),(1106,2,3),(1107,2,3),(1108,2,3),(1109,2,3),(1110,1,2),(1111,1,2),(1112,1,2),(1113,1,2),(1114,1,2),(1115,1,2),(1116,1,2),(1117,1,2),(1118,1,2),(1119,1,2),(1120,1,3),(1121,1,3),(1122,1,2),(1123,1,3),(1124,1,3),(1125,1,3),(1126,1,3),(1127,1,3),(1128,1,3),(1129,1,3),(1130,2,3),(1131,1,4),(1132,1,2),(1133,2,3),(1134,3,4),(1135,3,4),(1136,2,3),(1137,2,3),(1138,2,3),(1139,2,3),(1140,2,3),(1141,2,3),(1142,2,3),(1143,2,3),(1144,2,3),(1145,2,3),(1146,2,3),(1147,2,3),(1148,2,3),(1149,2,3),(1150,2,3),(1151,2,3),(1152,1,4),(1153,1,4),(1154,1,4),(1155,1,4),(1156,1,4),(1157,1,4),(1158,1,4),(1159,1,4),(1160,1,4),(1161,1,4),(1162,1,4),(1163,1,4),(1164,1,4),(1165,1,4),(1166,1,4),(1167,1,4),(1168,1,4),(1169,1,4),(1170,1,4),(1171,1,4),(1172,1,4),(1173,2,3),(1174,1,2),(1175,1,2),(1176,1,2),(1177,1,2),(1178,1,2),(1179,1,2),(1180,1,2),(1181,1,2),(1182,1,2),(1183,2,3),(1184,2,3),(1185,3,2),(1186,2,3),(1187,2,3),(1188,2,3),(1189,2,3),(1190,2,3),(1191,2,3),(1192,2,3),(1193,2,3),(1194,2,3),(1195,2,3),(1196,2,3),(1197,2,3),(1198,2,3),(1199,2,3),(1200,2,3),(1201,2,3),(1202,2,3),(1203,2,3),(1204,2,3),(1205,2,3),(1206,2,3),(1207,2,3),(1208,2,3),(1209,2,3),(1210,2,3),(1211,2,3),(1212,2,3),(1213,2,3),(1214,2,3),(1215,2,3),(1216,2,3),(1217,2,3),(1218,2,3),(1219,2,3),(1220,2,3),(1221,2,3),(1222,2,3),(1223,2,3),(1224,2,3),(1225,2,3),(1226,2,3),(1227,2,3),(1228,2,3),(1229,2,3),(1230,2,3),(1231,2,3),(1232,2,3),(1233,1,3),(1234,1,3),(1235,1,3),(1236,1,3),(1237,1,3),(1238,1,3),(1239,1,3),(1240,1,3),(1241,1,3),(1242,1,3),(1243,1,3),(1244,1,3),(1245,1,3),(1246,1,3),(1247,1,3),(1248,1,3),(1249,1,3),(1250,1,3),(1251,1,3),(1252,1,3),(1253,1,3),(1254,1,3),(1255,1,3),(1256,1,3),(1257,1,3),(1258,1,3),(1259,1,3),(1260,1,3),(1261,1,3),(1262,1,3),(1263,1,3),(1264,1,3),(1265,1,3),(1266,1,3),(1267,1,3),(1268,1,3),(1269,1,3),(1270,1,3),(1271,1,3),(1272,1,3),(1273,1,3),(1274,1,3),(1275,1,3),(1276,1,3),(1277,1,3),(1278,1,3),(1279,1,3),(1280,1,3),(1281,1,3),(1282,1,3),(1283,1,3),(1284,1,3),(1285,1,3),(1286,1,3),(1287,1,3),(1288,1,3),(1289,1,3),(1290,1,3),(1291,1,3),(1292,1,3),(1293,1,3),(1294,1,3),(1295,1,3),(1296,1,3),(1297,1,3),(1298,1,3),(1299,1,3),(1300,1,3),(1301,1,3),(1302,1,3),(1303,2,4),(1304,2,4),(1305,2,4),(1306,2,4),(1307,1,2),(1308,3,4),(1309,3,4),(1310,3,4),(1311,3,4),(1312,3,4),(1313,3,4),(1314,3,4),(1315,3,4),(1316,3,4),(1317,3,4),(1318,3,4),(1319,3,4),(1320,3,4),(1321,3,4),(1322,3,4),(1323,3,4),(1324,3,4),(1325,3,4),(1326,3,4),(1327,3,4),(1328,3,4),(1329,3,4),(1330,3,4),(1331,3,4),(1332,3,4),(1333,3,4),(1334,3,4),(1335,3,4),(1336,3,4),(1337,3,4),(1338,3,4),(1339,3,4),(1340,3,4),(1341,3,4),(1342,3,4),(1343,3,4),(1344,3,4),(1345,3,4),(1346,3,4),(1347,3,4),(1348,3,4),(1349,3,4),(1350,3,4),(1351,3,4),(1352,3,4),(1353,3,4),(1354,3,4),(1355,3,4),(1356,3,4),(1357,3,4),(1358,3,4),(1359,3,4),(1360,3,4),(1361,3,4),(1362,3,4),(1363,3,4),(1364,3,4),(1365,3,4),(1366,3,4),(1367,3,4),(1368,3,4),(1369,3,4),(1370,3,4),(1371,3,4),(1372,3,4),(1373,3,4),(1374,3,4),(1375,1,2),(1376,1,1),(1377,1,1),(1378,1,1),(1379,1,1),(1380,1,1),(1381,1,1),(1382,1,1),(1383,1,1),(1384,4,3),(1385,4,3),(1386,4,3),(1387,4,3),(1388,4,3),(1389,4,3),(1390,4,3),(1391,4,3),(1392,4,3),(1393,4,3),(1394,4,3),(1395,4,3),(1396,4,3),(1397,4,3),(1398,4,3),(1399,4,3),(1400,4,3),(1401,4,3),(1402,4,3),(1403,4,3),(1404,4,3),(1405,4,3),(1406,4,3),(1407,4,3),(1408,4,3),(1409,4,3),(1410,4,3),(1411,4,3),(1412,4,3),(1413,4,3),(1414,4,3),(1415,4,3),(1416,4,3),(1417,4,3),(1418,4,3),(1419,4,3),(1420,4,3),(1421,4,3),(1422,4,3),(1423,4,3),(1424,4,3),(1425,4,3),(1426,4,3),(1427,4,3),(1428,4,3),(1429,4,3),(1430,4,3),(1431,4,3),(1432,4,3),(1433,4,3),(1434,4,3),(1435,4,3),(1436,4,3),(1437,4,3),(1438,4,3),(1439,4,3),(1440,4,3),(1441,4,3),(1442,4,3),(1443,4,3),(1444,4,3),(1445,4,3),(1446,4,3),(1447,4,3),(1448,4,3),(1449,4,3),(1450,4,3),(1451,4,3),(1452,4,3),(1453,4,3),(1454,4,3),(1455,4,3),(1456,4,3),(1457,4,3),(1458,4,3),(1459,4,3),(1460,4,3),(1461,4,3),(1462,4,3),(1463,4,3),(1464,4,3),(1465,4,3),(1466,4,3),(1467,4,3),(1468,4,3),(1469,4,3),(1470,4,3),(1471,4,3),(1472,4,3),(1473,4,3),(1474,4,3),(1475,4,3),(1476,4,3),(1477,4,3),(1478,4,3),(1479,4,3),(1480,4,3),(1481,4,3),(1482,4,3),(1483,4,3),(1484,4,3),(1485,4,3),(1486,4,3),(1487,1,2),(1488,3,4),(1489,3,4),(1490,3,4),(1491,3,4),(1492,3,4),(1493,3,4),(1494,3,4),(1495,3,4),(1496,3,4),(1497,3,4),(1498,3,4),(1499,3,4),(1500,3,4),(1501,3,4),(1502,3,4),(1503,3,4),(1504,3,4),(1505,3,4),(1506,3,4),(1507,3,4),(1508,1,4),(1509,1,4),(1510,1,4),(1511,1,4),(1512,1,4),(1513,1,4),(1514,1,4),(1515,1,4),(1516,1,4),(1517,1,4),(1518,1,2),(1519,1,4),(1520,1,4),(1521,1,4),(1522,1,4),(1523,1,4),(1524,1,4),(1525,1,4),(1526,1,4),(1527,1,4),(1528,1,4),(1529,1,4),(1530,1,4),(1531,1,4),(1532,1,4),(1533,1,4),(1534,1,4),(1535,1,4),(1536,1,4),(1537,1,4),(1538,1,4),(1539,1,4),(1540,1,4),(1541,1,4),(1542,1,4),(1543,1,4),(1544,1,4),(1545,3,2),(1546,2,3),(1547,2,3),(1548,2,3),(1549,2,3),(1550,2,3),(1551,2,3),(1552,2,3),(1553,2,3),(1554,1,2),(1555,1,2),(1556,1,2),(1557,1,2),(1558,1,2),(1559,1,2),(1560,1,2),(1561,1,2),(1562,3,2),(1563,3,2),(1564,1,4),(1565,1,4),(1566,1,4),(1567,1,4),(1568,1,4),(1569,1,4),(1570,1,4),(1571,1,4),(1572,1,4),(1573,1,4),(1574,1,4),(1575,1,4),(1576,1,4),(1577,1,4),(1578,1,4),(1579,1,4),(1580,1,4),(1581,1,4),(1582,1,4),(1583,1,4),(1584,1,4),(1585,1,4),(1586,1,4),(1587,1,4),(1588,1,4),(1589,4,1),(1590,4,1),(1591,4,1),(1592,4,1),(1593,4,1),(1594,4,1),(1595,4,1),(1596,4,1),(1597,4,1),(1598,4,1),(1599,4,1),(1600,4,1),(1601,4,1),(1602,4,1),(1603,4,1),(1604,4,1),(1605,4,1),(1606,4,1),(1607,4,1),(1608,4,1),(1609,4,2),(1610,1,2),(1611,1,2),(1612,1,2),(1613,1,2),(1614,1,2),(1615,1,2),(1616,1,2),(1617,1,2),(1618,1,2),(1619,1,2),(1620,1,2),(1621,1,2),(1622,3,4),(1623,3,4),(1624,3,4),(1625,3,4),(1626,3,4),(1627,3,4),(1628,3,4),(1629,3,4),(1630,3,4),(1631,3,4),(1632,3,4),(1633,3,4),(1634,3,4),(1635,3,4),(1636,3,4),(1637,3,4),(1638,1,2),(1639,2,3),(1640,2,3),(1641,2,3),(1642,2,3),(1643,2,3),(1644,2,3),(1645,2,3),(1646,1,3),(1647,2,3),(1648,1,2),(1649,1,2),(1650,1,2),(1651,1,2),(1652,1,2),(1653,1,4),(1654,1,2);
/*!40000 ALTER TABLE `COMPARED` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `C_COMMENT`
--

DROP TABLE IF EXISTS `C_COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `C_COMMENT` (
  `idCComment` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(200) NOT NULL,
  `creationDate` datetime NOT NULL,
  `status` char(2) NOT NULL,
  `idCOMPARED` int(11) NOT NULL,
  `idParentCC` int(11) NOT NULL,
  PRIMARY KEY (`idCComment`),
  KEY `fk_idCompared_CC` (`idCOMPARED`),
  KEY `fk_idComment_CC` (`idParentCC`),
  CONSTRAINT `C_COMMENT_ibfk_1` FOREIGN KEY (`idCOMPARED`) REFERENCES `COMPARED` (`idCOMPARED`),
  CONSTRAINT `C_COMMENT_ibfk_2` FOREIGN KEY (`idParentCC`) REFERENCES `C_COMMENT` (`idCComment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `C_COMMENT`
--

LOCK TABLES `C_COMMENT` WRITE;
/*!40000 ALTER TABLE `C_COMMENT` DISABLE KEYS */;
/*!40000 ALTER TABLE `C_COMMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `C_SCORE`
--

DROP TABLE IF EXISTS `C_SCORE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `C_SCORE` (
  `idCScore` int(11) NOT NULL AUTO_INCREMENT,
  `scoreValue` decimal(4,2) NOT NULL,
  `creationDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCOMPARED` int(11) NOT NULL,
  PRIMARY KEY (`idCScore`),
  KEY `fk_idCompared_CS` (`idCOMPARED`),
  CONSTRAINT `C_SCORE_ibfk_1` FOREIGN KEY (`idCOMPARED`) REFERENCES `COMPARED` (`idCOMPARED`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `C_SCORE`
--

LOCK TABLES `C_SCORE` WRITE;
/*!40000 ALTER TABLE `C_SCORE` DISABLE KEYS */;
/*!40000 ALTER TABLE `C_SCORE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Constructor`
--

DROP TABLE IF EXISTS `Constructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Constructor` (
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Constructor`
--

LOCK TABLES `Constructor` WRITE;
/*!40000 ALTER TABLE `Constructor` DISABLE KEYS */;
INSERT INTO `Constructor` VALUES ('Apple','Fonde en 1995 , la marque Apple  est un leader dans le monde du smartphone lorem ipsum ygugogig oihihoihoih hiohihihi ugoihpihoih hpihoihpihp hphiohoihioh fyfifuguguig iguuiguiguiguig'),('HTC','NULL'),('Meizu','NULL'),('Microsoft','NULL'),('Motorola','NULL'),('Samsung','Samsung Electronics est une filiale &agrave; 100 % du Groupe Samsung. Elle est class&eacute;e leader mondial de l\'industrie du high-tech .<br> Aujourd\'hui , elle est l\'un des plus grands fabricants de t&eacute;l&eacute;phones mobiles et smartphones, notamment gr&acirc;ce &agrave; la popularit&eacute; de ses mod&egrave;les Samsung Galaxy.<br> L\'entreprise a cr&eacute;&eacute; Bada et cod&eacute;veloppe Tizen, deux syst&egrave;mes d\'exploitation pour les smartphones. <br> Samsung dispose de 197 bureaux dans 72 pays.'),('Sony','Fonde en 1995 , la marque Sony est un leader dans le monde du smartphone lorem ipsum ygugogig oihihoihoih hiohihihi ugoihpihoih hpihoihpihp hphiohoihioh fyfifuguguig iguuiguiguiguig'),('Xiaomi','NULL');
/*!40000 ALTER TABLE `Constructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GPU`
--

DROP TABLE IF EXISTS `GPU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GPU` (
  `idG` int(11) NOT NULL AUTO_INCREMENT,
  `nameG` varchar(200) NOT NULL,
  `constructorG` varchar(200) NOT NULL,
  `versionG` int(11) NOT NULL,
  `frequency` float NOT NULL,
  `gflops` decimal(4,1) DEFAULT NULL,
  `print` int(11) DEFAULT NULL,
  `directXV` decimal(4,1) DEFAULT NULL,
  PRIMARY KEY (`idG`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GPU`
--

LOCK TABLES `GPU` WRITE;
/*!40000 ALTER TABLE `GPU` DISABLE KEYS */;
INSERT INTO `GPU` VALUES (1,'Adreno','Qualcomm',330,578,166.5,28,11.1),(2,'Adreno','Qualcomm',420,600,172.8,28,11.2),(3,'PowerVR GX','Apple',6450,1400,NULL,NULL,NULL);
/*!40000 ALTER TABLE `GPU` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HelpMessage`
--

DROP TABLE IF EXISTS `HelpMessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HelpMessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `content` text NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HelpMessage`
--

LOCK TABLES `HelpMessage` WRITE;
/*!40000 ALTER TABLE `HelpMessage` DISABLE KEYS */;
/*!40000 ALTER TABLE `HelpMessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notice`
--

DROP TABLE IF EXISTS `Notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notice` (
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `nomInter` varchar(50) NOT NULL,
  `content` varchar(200) NOT NULL,
  PRIMARY KEY (`idA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notice`
--

LOCK TABLES `Notice` WRITE;
/*!40000 ALTER TABLE `Notice` DISABLE KEYS */;
INSERT INTO `Notice` VALUES (1,'lander','Super comparateur !'),(2,'marc','Je vous recommande COMPARED!'),(3,'anonyme','J\'adore faire des comparaisons'),(4,'anonyme','Que dire de COMPARED ! C\'est génial');
/*!40000 ALTER TABLE `Notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OS`
--

DROP TABLE IF EXISTS `OS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OS` (
  `idOS` int(11) NOT NULL AUTO_INCREMENT,
  `nameOS` varchar(50) NOT NULL,
  `versionOS` varchar(20) NOT NULL,
  `constructorOS` varchar(50) NOT NULL,
  `releaseDateOS` date NOT NULL,
  PRIMARY KEY (`idOS`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OS`
--

LOCK TABLES `OS` WRITE;
/*!40000 ALTER TABLE `OS` DISABLE KEYS */;
INSERT INTO `OS` VALUES (1,'Android Lollipop','5.0','Google','2014-10-15'),(2,'iOS ','8','Apple','2014-09-17'),(3,'Android Jelly Bean','4.2','Google','2012-11-13'),(4,'Android Jelly Bean','4.1','Google','2012-07-09'),(5,'Android Jelly Bean','4.3','Google','2013-07-24'),(6,'Android KitKat','4.4','Google','2013-10-31'),(7,'Android Ice Cream Sandwich','4.0','Google','2011-12-16'),(8,'Android Honeycomb','3','Google','2010-12-26'),(9,'Android Gingerbread','2.3','Google','2010-12-06'),(10,'iOS ','7','Apple','2013-09-18'),(11,'iOS','6','Apple','2012-09-19'),(12,'iOS ','5','Apple','2011-06-06'),(13,'iOS','4','Apple','2010-06-21');
/*!40000 ALTER TABLE `OS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PIN`
--

DROP TABLE IF EXISTS `PIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PIN` (
  `idU` int(11) NOT NULL,
  `PIN` char(6) NOT NULL,
  PRIMARY KEY (`idU`,`PIN`),
  UNIQUE KEY `idU` (`idU`),
  UNIQUE KEY `PIN` (`PIN`),
  CONSTRAINT `PIN_ibfk_1` FOREIGN KEY (`idU`) REFERENCES `User` (`idU`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PIN`
--

LOCK TABLES `PIN` WRITE;
/*!40000 ALTER TABLE `PIN` DISABLE KEYS */;
INSERT INTO `PIN` VALUES (1,'0906');
/*!40000 ALTER TABLE `PIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `POST`
--

DROP TABLE IF EXISTS `POST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST` (
  `idPost` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `shortDesc` varchar(200) DEFAULT NULL,
  `longDesc` text,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `coverPhoto` varchar(100) NOT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `postStatus` varchar(20) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPost`),
  KEY `fk_idUser` (`idUser`),
  CONSTRAINT `POST_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `User` (`idU`),
  CONSTRAINT `POST_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `User` (`idU`),
  CONSTRAINT `POST_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `User` (`idU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `POST`
--

LOCK TABLES `POST` WRITE;
/*!40000 ALTER TABLE `POST` DISABLE KEYS */;
/*!40000 ALTER TABLE `POST` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `P_COMMENT`
--

DROP TABLE IF EXISTS `P_COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `P_COMMENT` (
  `idPComment` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(200) NOT NULL,
  `creationDate` datetime NOT NULL,
  `status` char(2) NOT NULL,
  `idPost` int(6) NOT NULL,
  `idParentPC` int(11) NOT NULL,
  PRIMARY KEY (`idPComment`),
  KEY `fk_idPost_PC` (`idPost`),
  KEY `fk_idComment_PC` (`idParentPC`),
  CONSTRAINT `P_COMMENT_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `POST` (`idPost`),
  CONSTRAINT `P_COMMENT_ibfk_2` FOREIGN KEY (`idParentPC`) REFERENCES `P_COMMENT` (`idPComment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `P_COMMENT`
--

LOCK TABLES `P_COMMENT` WRITE;
/*!40000 ALTER TABLE `P_COMMENT` DISABLE KEYS */;
/*!40000 ALTER TABLE `P_COMMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `P_SCORE`
--

DROP TABLE IF EXISTS `P_SCORE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `P_SCORE` (
  `idScore` int(11) NOT NULL AUTO_INCREMENT,
  `scoreValue` decimal(4,2) NOT NULL,
  `creationDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idPost` int(6) NOT NULL,
  PRIMARY KEY (`idScore`),
  KEY `fk_idPost_PS` (`idPost`),
  CONSTRAINT `P_SCORE_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `POST` (`idPost`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `P_SCORE`
--

LOCK TABLES `P_SCORE` WRITE;
/*!40000 ALTER TABLE `P_SCORE` DISABLE KEYS */;
/*!40000 ALTER TABLE `P_SCORE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Processor`
--

DROP TABLE IF EXISTS `Processor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Processor` (
  `idProc` int(11) NOT NULL AUTO_INCREMENT,
  `nameProc` varchar(50) NOT NULL,
  `constructorProc` varchar(50) NOT NULL,
  `nbCoreProc` int(11) NOT NULL,
  `archProc` varchar(11) NOT NULL,
  `versionProc` varchar(25) NOT NULL,
  `frequencyProc` float NOT NULL,
  PRIMARY KEY (`idProc`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Processor`
--

LOCK TABLES `Processor` WRITE;
/*!40000 ALTER TABLE `Processor` DISABLE KEYS */;
INSERT INTO `Processor` VALUES (1,'Snapdragon','Qualcomm',4,'ARM 32','801',2.5),(2,'Snapdragon','Qualcomm',4,'ARM 32','805',2.7),(3,'A','Samsung Electronics',2,'ARM 64','7',1.4),(4,'A','Samsung Electronics',2,'ARM 32','6',1.3),(5,'Snapdragon','Qualcomm',4,'ARM 32','800',2.26),(6,'A','Samsung',2,'ARM 64','8',1.4);
/*!40000 ALTER TABLE `Processor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `S_COMMENT`
--

DROP TABLE IF EXISTS `S_COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `S_COMMENT` (
  `idSComment` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(200) NOT NULL,
  `creationDate` datetime NOT NULL,
  `status` char(2) NOT NULL,
  `idS` int(11) NOT NULL,
  `idParentSC` int(11) NOT NULL,
  PRIMARY KEY (`idSComment`),
  KEY `fk_idS_SC` (`idS`),
  KEY `fk_idComment_SC` (`idParentSC`),
  CONSTRAINT `S_COMMENT_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `Smartphone` (`idS`),
  CONSTRAINT `S_COMMENT_ibfk_2` FOREIGN KEY (`idParentSC`) REFERENCES `S_COMMENT` (`idSComment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `S_COMMENT`
--

LOCK TABLES `S_COMMENT` WRITE;
/*!40000 ALTER TABLE `S_COMMENT` DISABLE KEYS */;
/*!40000 ALTER TABLE `S_COMMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `S_SCORE`
--

DROP TABLE IF EXISTS `S_SCORE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `S_SCORE` (
  `idSScore` int(11) NOT NULL AUTO_INCREMENT,
  `scoreValue` decimal(4,2) NOT NULL,
  `creationDateTime` varchar(150) NOT NULL,
  `idS` int(11) NOT NULL,
  PRIMARY KEY (`idSScore`),
  KEY `fk_idS_SS` (`idS`),
  CONSTRAINT `S_SCORE_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `Smartphone` (`idS`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `S_SCORE`
--

LOCK TABLES `S_SCORE` WRITE;
/*!40000 ALTER TABLE `S_SCORE` DISABLE KEYS */;
INSERT INTO `S_SCORE` VALUES (5,4.00,'d',3),(6,5.00,'d',3),(10,5.00,'2015-10-20 20:31:27',3),(11,5.00,'2015-10-20 20:31:27',3),(12,5.00,'2015-10-20 20:33:29',4),(13,5.00,'2015-10-20 20:33:29',4),(14,5.00,'2015-10-20 20:33:29',4),(15,5.00,'2015-10-20 20:33:29',4),(16,5.00,'2015-10-20 20:33:29',4),(17,5.00,'2015-10-20 20:36:39',4),(18,5.00,'2015-10-20 20:37:12',4),(20,5.00,'2015-10-20 20:38:21',4),(21,5.00,'2015-10-20 20:38:21',4),(22,5.00,'2015-10-20 20:38:21',4),(23,5.00,'2015-10-20 20:38:21',4),(24,5.00,'2015-10-20 20:38:21',4),(25,5.00,'2015-10-20 20:38:21',4),(26,5.00,'2015-10-20 20:38:21',4),(27,5.00,'2015-10-20 20:39:55',4),(28,5.00,'2015-10-20 20:39:55',4),(29,5.00,'2015-10-20 20:39:55',4),(30,5.00,'2015-10-20 20:39:55',4),(31,5.00,'2015-10-20 20:39:55',4),(32,5.00,'2015-10-20 20:39:55',4),(33,5.00,'2015-10-20 20:39:55',4),(34,5.00,'2015-10-20 20:42:32',4),(35,5.00,'2015-10-20 20:42:32',4),(36,5.00,'2015-10-20 20:42:32',4),(37,5.00,'2015-10-20 20:42:32',4),(38,5.00,'2015-10-20 20:42:33',4),(39,5.00,'2015-10-20 20:42:33',4),(40,5.00,'2015-10-20 20:42:33',4),(41,5.00,'2015-10-20 21:32:19',4),(42,5.00,'2015-10-20 21:32:19',4),(43,5.00,'2015-10-20 21:32:19',4),(44,5.00,'2015-10-20 21:32:19',4),(45,5.00,'2015-10-20 21:32:19',4),(46,5.00,'2015-10-20 21:32:19',4),(47,5.00,'2015-10-20 21:32:19',4),(48,5.00,'2015-10-20 21:36:45',4),(49,5.00,'2015-10-20 21:36:45',4),(50,5.00,'2015-10-20 21:36:45',4),(51,5.00,'2015-10-20 21:36:45',4),(52,5.00,'2015-10-20 21:36:45',4),(53,5.00,'2015-10-20 21:36:45',4),(54,5.00,'2015-10-20 21:36:45',4),(55,5.00,'2015-10-20 21:37:16',4),(56,5.00,'2015-10-20 21:37:16',4),(57,5.00,'2015-10-20 21:37:16',4),(58,5.00,'2015-10-20 21:37:16',4),(59,5.00,'2015-10-20 21:37:16',4),(60,5.00,'2015-10-20 21:37:16',4),(61,5.00,'2015-10-20 21:37:16',4),(62,5.00,'2015-10-20 21:37:36',4),(63,5.00,'2015-10-20 21:37:36',4),(64,5.00,'2015-10-20 21:37:36',4),(65,5.00,'2015-10-20 21:37:36',4),(66,5.00,'2015-10-20 21:37:36',4),(67,5.00,'2015-10-20 21:37:36',4),(68,5.00,'2015-10-20 21:37:36',4),(69,5.00,'2015-10-20 21:37:59',4),(71,5.00,'2015-12-18 01:43:30',3),(72,5.00,'2015-12-18 01:43:37',3),(73,5.00,'2015-10-20 21:37:36',3),(74,5.00,'2015-10-20 21:37:36',3),(75,5.00,'2015-10-20 21:37:36',3),(76,5.00,'2015-10-20 21:37:36',3),(77,5.00,'2015-10-20 21:37:36',3),(78,5.00,'2015-10-20 21:37:36',3),(79,5.00,'2015-10-20 21:37:36',3),(80,5.00,'2015-10-20 21:37:36',3),(81,5.00,'2015-10-20 21:37:36',3),(82,5.00,'2015-10-20 21:37:36',3),(83,5.00,'2015-10-20 21:37:36',3),(84,5.00,'2016-02-17 16:00:10',1);
/*!40000 ALTER TABLE `S_SCORE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Screen`
--

DROP TABLE IF EXISTS `Screen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Screen` (
  `idScr` int(11) NOT NULL AUTO_INCREMENT,
  `typeScr` varchar(50) NOT NULL,
  `resolutionScr` varchar(50) NOT NULL,
  `densityScr` int(11) NOT NULL,
  `sizeScr` float NOT NULL,
  `capacityScr` varchar(50) NOT NULL,
  PRIMARY KEY (`idScr`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Screen`
--

LOCK TABLES `Screen` WRITE;
/*!40000 ALTER TABLE `Screen` DISABLE KEYS */;
INSERT INTO `Screen` VALUES (1,'SUPER AMOLED','1920x1080',386,5.7,'FULLHD'),(2,'SUPER AMOLED','2560x1440',511,5.7,'QHD '),(3,'IPS','1920x1080',424,5.2,'FULLHD'),(4,'IPS','1334x750',326,4.7,'HD+');
/*!40000 ALTER TABLE `Screen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Smartphone`
--

DROP TABLE IF EXISTS `Smartphone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Smartphone` (
  `idS` int(11) NOT NULL AUTO_INCREMENT,
  `codeNameS` varchar(50) NOT NULL,
  `fullNameS` varchar(50) NOT NULL,
  `constructorS` varchar(50) NOT NULL,
  `ramS` float NOT NULL,
  `weightS` float NOT NULL,
  `thinknessS` float NOT NULL,
  `heightS` float NOT NULL,
  `widthS` float NOT NULL,
  `releaseDateS` date NOT NULL,
  `priceS` float DEFAULT NULL,
  `photoFrontS` float NOT NULL,
  `photoBackS` float NOT NULL,
  `internalStorageS` varchar(50) NOT NULL,
  `externalStorageS` varchar(100) DEFAULT NULL,
  `batteryCapacityS` int(11) NOT NULL,
  `cNetworkS` varchar(50) DEFAULT NULL,
  `videoFrontS` varchar(50) DEFAULT NULL,
  `videoBackS` varchar(50) DEFAULT NULL,
  `pictureS` varchar(100) NOT NULL,
  `idScr` int(11) NOT NULL,
  `idOS` int(11) NOT NULL,
  `idProc` int(11) NOT NULL,
  `idG` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `resolutionVideoFront` varchar(100) NOT NULL,
  `resolutionVideoBack` varchar(100) NOT NULL,
  PRIMARY KEY (`idS`),
  KEY `FK_Smartphone_idScr` (`idScr`),
  KEY `FK_Smartphone_idOS` (`idOS`),
  KEY `FK_Smartphone_idProc` (`idProc`),
  KEY `FK_idG` (`idG`),
  KEY `fk_constructor` (`constructorS`),
  CONSTRAINT `FK_Smartphone_idOS` FOREIGN KEY (`idOS`) REFERENCES `OS` (`idOS`),
  CONSTRAINT `FK_Smartphone_idProc` FOREIGN KEY (`idProc`) REFERENCES `Processor` (`idProc`),
  CONSTRAINT `FK_Smartphone_idScr` FOREIGN KEY (`idScr`) REFERENCES `Screen` (`idScr`),
  CONSTRAINT `Smartphone_ibfk_1` FOREIGN KEY (`idG`) REFERENCES `GPU` (`idG`),
  CONSTRAINT `Smartphone_ibfk_2` FOREIGN KEY (`constructorS`) REFERENCES `Constructor` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Smartphone`
--

LOCK TABLES `Smartphone` WRITE;
/*!40000 ALTER TABLE `Smartphone` DISABLE KEYS */;
INSERT INTO `Smartphone` VALUES (1,'SM-N916L','Galaxy Note 4 32 Go','Samsung',3,176,8.5,78.6,153.5,'2014-10-17',0,3.7,16,'32','128',3220,'4G+','FULLHD','4K','samsunggalaxynote4',2,6,2,2,'2015-02-03','1920x1080','3840x2160 '),(2,'SM-N9005','Galaxy Note 3 64 Go','Samsung',3,168,8.3,79.2,151.2,'2013-09-12',NULL,2,13,'64','64',3200,'4G','FULLHD','4K','samsunggalaxynote3',1,5,5,1,'2015-02-03','1920x1080','3840x2160'),(3,'D6603','XPERIA Z3 32Go','SONY',3,152,7.3,72,146,'2014-09-17',NULL,2.2,20.7,'32','128',3100,'4G','4K','FULLHD','sonyxperiaz3',3,5,1,2,'2015-06-17','3840x2160','1920x1080'),(4,'N61','iPhone 6 16Go','Apple',1,129,6.9,67,138.1,'2015-04-17',709,1.2,8,'16','NULL',1810,'4G','HD','FULLHD','appleiphone6',4,2,6,3,'2015-06-17','1280x720','1920x1080');
/*!40000 ALTER TABLE `Smartphone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TagArticles`
--

DROP TABLE IF EXISTS `TagArticles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TagArticles` (
  `idA` int(11) NOT NULL,
  `idT` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`idT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TagArticles`
--

LOCK TABLES `TagArticles` WRITE;
/*!40000 ALTER TABLE `TagArticles` DISABLE KEYS */;
/*!40000 ALTER TABLE `TagArticles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoU` varchar(50) NOT NULL,
  `passwordU` varchar(50) NOT NULL,
  `firstNameU` varchar(100) NOT NULL,
  `lastNameU` varchar(100) NOT NULL,
  `emailU` varchar(50) NOT NULL,
  `pictureU` varchar(100) DEFAULT NULL,
  `idUT` int(11) NOT NULL,
  PRIMARY KEY (`idU`),
  UNIQUE KEY `pseudoU` (`pseudoU`,`passwordU`),
  KEY `FK_User_idUT` (`idUT`),
  CONSTRAINT `FK_User_idUT` FOREIGN KEY (`idUT`) REFERENCES `UserType` (`idUT`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'dany','azerty','RAFINA','Dany','danyrafina@gmail.com',NULL,1),(2,'marc','azerty','LACHARD','Marc','mlachard@gmail.com',NULL,2);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserSmartphone`
--

DROP TABLE IF EXISTS `UserSmartphone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserSmartphone` (
  `idU` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  PRIMARY KEY (`idS`),
  UNIQUE KEY `PRIMARY2` (`idU`),
  CONSTRAINT `UserSmartphone_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `Smartphone` (`idS`),
  CONSTRAINT `UserSmartphone_ibfk_2` FOREIGN KEY (`idU`) REFERENCES `User` (`idU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserSmartphone`
--

LOCK TABLES `UserSmartphone` WRITE;
/*!40000 ALTER TABLE `UserSmartphone` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserSmartphone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserType`
--

DROP TABLE IF EXISTS `UserType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserType` (
  `idUT` int(11) NOT NULL AUTO_INCREMENT,
  `nameUT` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUT`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserType`
--

LOCK TABLES `UserType` WRITE;
/*!40000 ALTER TABLE `UserType` DISABLE KEYS */;
INSERT INTO `UserType` VALUES (1,'Developer'),(2,'SimpleUser'),(3,'Redactor'),(4,'Administrator'),(5,'Moderator');
/*!40000 ALTER TABLE `UserType` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-26 13:44:37
