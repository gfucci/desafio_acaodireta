-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: rhcontrol
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dateBank`
--

DROP TABLE IF EXISTS `dateBank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dateBank` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entry` varchar(100) DEFAULT NULL,
  `output` varchar(100) DEFAULT NULL,
  `calendar` varchar(100) DEFAULT NULL,
  `employees_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_id` (`employees_id`),
  CONSTRAINT `dateBank_ibfk_1` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dateBank`
--

LOCK TABLES `dateBank` WRITE;
/*!40000 ALTER TABLE `dateBank` DISABLE KEYS */;
INSERT INTO `dateBank` VALUES (4,'14:34:10','16:16:11','05/10/2022',10),(5,'16:42:40',NULL,'05/10/2022',7),(6,'16:52:39',NULL,'05/10/2022',7),(7,'17:01:00',NULL,'05/10/2022',5),(8,'17:59:34','17:59:40','05/10/2022',10),(9,'19:40:20','20:06:33','05/10/2022',11),(10,'19:52:20','19:52:36','05/10/2022',11),(11,'20:08:31','20:22:27','06/10/2022',11),(12,'23:46:47','23:46:52','05/10/2022',11),(13,'15:57:45','15:57:50','06/10/2022',13);
/*!40000 ALTER TABLE `dateBank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `users_id` int NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (9,'Fernando','Pedro','55dad27a2dfc1cc1de9e0e74af30313fa4dffae17a0ff750a04fd37c851e8714b7fb929b57d225c82edbe79b7feb87e06ed706dead42138533e4c889.jpg',7,'DEV'),(10,'Maria','Teresina','aa62048a01ef088a8abce1db8755a1b3ef4da863d916fdc1aaa5e6fad893bfcfe587ff214a46e92177fa952f06a5df62ee420f9b79fd13b2476748b9.jpg',7,'Faxineira'),(12,'Gabriel','Fucci','88505d4eef931027ccd088e9ae11d82ac2bacdf3a6fad7b08a7cad31f0866fc1b477088976cb6d9c656c07d8fba23b497d8a492c0df6caddaab54d0d.jpg',7,'Faxineiro'),(13,'Gabriel','Fucci',NULL,7,'Lenhador');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'teste','testando','email@email.com','$2y$10$IuXQ5ech.0/IDpcMG522LOM4b4A9cURW6IhtwX2D5GoIzi4b5fMf2','',NULL),(2,'gabriel','teste','teste@teste.com','$2y$10$f04VETS6DzGRtWNze4acDuezzy2qMEej07cvcgYESov04X7nrI.pq','',NULL),(3,'nome','sobrenome','teste2@testando.com','$2y$10$gXzR3UiAjIlWIevIRmQB4uD8IISHnnR5p2Git7Tzc6ja0YD8y0KDq','',NULL),(4,'gabriel','teste','teste5@teste.com','$2y$10$wpYB0OSE088Wz8t763q9d.7mK64Xk.kN51CDh7ozxfb.TXLv4zCBy','7adea9eefc5c082621ce388f2cadc8aa14e7e02da09d3cb47b3d6fd966c5a23d00f9818077fa9f70783e705df21c8319a61e',NULL),(5,'gabriel','testando','email3@teste.com','$2y$10$MZkU4nEfEi9BFaS/yG68uu941IJv/KKmv7Hwn6yit7okrd3VSFvui','3f1f2d61d8414ad1f71bdb539a9141245c7744145b763561b815e813da6907c2d83c541ead269a107cba21c5f5c2033b5f32',NULL),(6,'gabriel','teste','emailteste@teste.com','$2y$10$.SSHT.2RGUORQoHs9M/sguqgjgkxaf7rVAqOFaS.G43mn6eb4ujCO','f4a957c28ec8c0178049c6e19562dec38258c32d419c9e57e14302100a26e4e3d35f1641bf0653898907adc4ce573c1f1f8a',NULL),(7,'Gabriel','Fucci','teste@create.com','$2y$10$MagmNqKNHK9cUd7kXq/oy.mfj8k9KSNHwnl7UFMfDEDesTX4TW5HW','4a840f79b91b0dfac8fff81450d94f082d73e12f3f7aed300e7b2e828f4eab2b5173467240ba2b2bc719c63d22704fc51e8e',NULL),(8,'Gabriel','Fucci','animal@email.com','$2y$10$9lzgX.Igkzwr/sBy5syxGeRTg2nVBFMKrNQQHMPJKAnbRxWMfQPDe','16155f984145d2cc3a1bd6d5e561eb7ba4f7416cb6a1e933f27886477f0c3e49afa98a8dc4d2f695b3d20bced99bd76dd155',NULL),(9,'gabriel','Fucci','gabriel@email.com','$2y$10$Pn6PdBKZchn/wB5kmJkaXOWJSZjqxRfkiuRyNrZTyhWSxM.Z7i59y','ed287293c5791f5a97f1026440d1cb417d26145bf4f4551cf5e6c95167dc86fcac09268c08dfdf287b1f5295e8bc143c54ca',NULL);
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

-- Dump completed on 2022-10-06 17:14:18
