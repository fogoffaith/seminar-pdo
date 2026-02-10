-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: seminar
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `peserta`
--

DROP TABLE IF EXISTS `peserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainingid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggaldaftar` timestamp NOT NULL DEFAULT current_timestamp(),
  `statushadir` enum('pending','hadir','alpa') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniquepeserta` (`trainingid`,`userid`),
  KEY `userid` (`userid`),
  CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`trainingid`) REFERENCES `training` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peserta`
--

LOCK TABLES `peserta` WRITE;
/*!40000 ALTER TABLE `peserta` DISABLE KEYS */;
INSERT INTO `peserta` VALUES (8,5,4,'2026-02-06 07:26:19','hadir'),(9,5,3,'2026-02-06 07:26:28','hadir'),(10,6,5,'2026-02-10 03:23:47','pending'),(11,6,3,'2026-02-10 03:24:10','pending'),(12,6,4,'2026-02-10 03:24:47','pending');
/*!40000 ALTER TABLE `peserta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` time DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `status` enum('open','full','done') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training`
--

LOCK TABLES `training` WRITE;
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
INSERT INTO `training` VALUES (5,'Flying Cat','asdasdasdasd','2026-02-21','14:26:00','eh anu disitu','open','2026-02-06 07:26:09'),(6,'seminar cara menggunakan linux','fundamental\r\ncommand comamand','2026-02-13','10:21:00','Kurma media','open','2026-02-10 03:22:06');
/*!40000 ALTER TABLE `training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','karyawan') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@seminar.com','$2y$10$e4fkPEkNqrwTQsHd0r6xBOOiPLj6VWIECgWjj5IG3N4KrTp2ztPhW','2026-02-05 04:57:50','admin'),(3,'tes','tes@tes.tes','$2y$10$UbMsUoia8EnDKQlAEi3p9.RxM4Pkd/3dlC0s08cLo3zIMurKySiQS','2026-02-06 03:52:44','karyawan'),(4,'uhiha','uhi@uhi.uhi','$2y$10$OCgSM1E6L4Qt4qctywyxHexQN0OxmevwQ3bZR4b6GFX3ewQdjDRYC','2026-02-06 06:49:20','karyawan'),(5,'faqih','faqih@faqih.com','$2y$10$XKXOmBe.AYf0B.HnJarIWe5bKhg6SQGWgB7zePwAMOsRubqfrh0LO','2026-02-10 03:23:31','karyawan'),(8,'ayamgakkuyang','adjias@sdad.asda','$2y$10$gjbHPIZWee0DhjAbuBptyOkJevQq4fgwy6ObALLZsOfRKEn9dwSuu','2026-02-10 04:45:42','karyawan'),(9,'ayamkuyang','ayamkuyang@kuyang.com','$2y$10$TUbAYg8GELTdNivERg72VOlKACOVUCVu5vWmaBDbNnMtYL5RbTbIO','2026-02-10 09:10:49','karyawan');
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

-- Dump completed on 2026-02-10 16:39:22
