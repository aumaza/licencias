-- MySQL dump 10.19  Distrib 10.3.32-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: licor
-- ------------------------------------------------------
-- Server version	10.3.32-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `agentes`
--

DROP TABLE IF EXISTS `agentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dni` varchar(8) NOT NULL,
  `email` varchar(90) NOT NULL,
  `antiguedad` int(11) NOT NULL,
  `situacion_revista` enum('Planta Permanente','Ley Marco','Contrato 1109') NOT NULL,
  `avatar` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentes`
--

LOCK TABLES `agentes` WRITE;
/*!40000 ALTER TABLE `agentes` DISABLE KEYS */;
INSERT INTO `agentes` VALUES (1,'Augusto Maza','24283493','aumaza@mecon.gov.ar',20,'Planta Permanente',NULL),(7,'Patricia Gomez','20607499','pgomez@mecon.gov.ar',25,'Planta Permanente',NULL),(8,'Sonia Boiarov','13980435','sboiarov@mecon.gov.ar',10,'Ley Marco',NULL),(9,'Máximo Camogli','25020184','mcamog@mecon.gov.ar',20,'Planta Permanente',NULL),(10,'Maria de los Angeles Cuquejo','18044659','mcuque@mecon.gov.ar',20,'Planta Permanente',NULL),(11,'Gustavo Flores','21561204','gflore@mecon.gov.ar',20,'Planta Permanente',NULL),(12,'Gabriela Keiemburg','24363970','gkeien@mecon.gov.ar',20,'Planta Permanente',NULL),(13,'Marina Pelloni','26374447','mpello@mecon.gov.ar',20,'Planta Permanente',NULL),(14,'Paula Varela','17587668','pvarel@mecon.gov.ar',20,'Planta Permanente',NULL),(15,'Jorge Arguello','11400614','jargue@mecon.gov.ar',20,'Ley Marco',NULL),(16,'Maria de la Paz Cerutti','28750595','mdlpaz@mecon.gov.ar',15,'Ley Marco',NULL),(17,'Alejandro Glavic','32028214','aglavic@mecon.gov.ar',20,'Contrato 1109',NULL),(18,'Alejandra Marcelli','16395823','amarce@mecon.gov.ar',25,'Planta Permanente',NULL),(19,'Jimena Martinez Mirau','30449663','jimmar@mecon.gov.ar',15,'Ley Marco',NULL),(20,'Czorniak Andrea','23847753','anczor@mecon.gov.ar',20,'Planta Permanente',NULL),(21,'Ezequiel Greco','37184411','egreco@mecon.gov.ar',10,'Ley Marco',NULL),(22,'Oscar Rodolfo Masello','11017543','romasello@mecon.gov.ar',20,'Ley Marco',NULL),(23,'Jorge Caruso','08011571','jcarus@mecon.gov.ar',30,'Planta Permanente',NULL),(24,'Carlos Traverso','13406907','ctrave@mecon.gov.ar',25,'Planta Permanente',NULL),(25,'Alejandro Ronald Krebs','31270497','akrebs@mecon.gov.ar',20,'Planta Permanente',NULL);
/*!40000 ALTER TABLE `agentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `licencias`
--

DROP TABLE IF EXISTS `licencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `licencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agente` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dni` varchar(8) NOT NULL,
  `periodo` varchar(4) NOT NULL,
  `f_desde` date NOT NULL,
  `f_hasta` date NOT NULL,
  `cant_dias` int(11) NOT NULL,
  `fraccion` enum('Primera','Segunda','Tercera') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `licencias`
--

LOCK TABLES `licencias` WRITE;
/*!40000 ALTER TABLE `licencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `licencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(73) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(90) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','root','$2y$10$fBH3T9NzZd7tUqhs88vtDeFrjiICYAr.4XevKv1pGb6KH/vhlCjPm','root@gmail.com',1),(2,'Augusto Maza','aumaza_mecon','$2y$10$KcFXKISSefcKZUcsIRsENOBDW4JI3F9tx2Cy1s5ADPcLJ//rw2ECa','aumaza@mecon.gov.ar',1),(8,'Patricia Gomez','pgomez_mecon','$2y$10$zR386ME5pfQzjJ9Pgf5yL.7AW5Xqlai3QmSQwFNKCDnZeN6/azz6m','pgomez@mecon.gov.ar',1),(9,'Sonia Boiarov','sboiarov_mecon','$2y$10$oPpi6b9Jv6xW8.pqqeziC.VPKNLC/4r/wxJyCP3LbJq2mbOW5uaSC','sboiarov@mecon.gov.ar',1),(10,'Máximo Camogli','mcamog_mecon','$2y$10$dQ3kUxHIaLEBsPEWj2QIzOnbnc7tl73BlUVrq4peywTQYGrV6lhfO','mcamog@mecon.gov.ar',1),(11,'Maria de los Angeles Cuquejo','mcuque_mecon','$2y$10$5PLHnamdQumr8LJyJCJ4uuDrAQzManMtM9OfWrpAV.Gl3NoaOuhdS','mcuque@mecon.gov.ar',1),(12,'Gustavo Flores','gflore_mecon','$2y$10$hsbLDseyS7y00.6Ytshhqeg68luIkZ.evSl0tbzQyQhnYOYTxY1Pq','gflore@mecon.gov.ar',1),(13,'Gabriela Keiemburg','gkeien_mecon','$2y$10$ame/AJcRS72Bk90mM5xodOHGNpSKPO0QSr6L5jSvR10o5V2IAD1/S','gkeien@mecon.gov.ar',1),(14,'Marina Pelloni','mpello_mecon','$2y$10$VW6f9pYk4hdCVoYyfgaZxuw9kDGODsnO6mZSy6FUdF4v4KtgrOIYi','mpello@mecon.gov.ar',1),(15,'Paula Varela','pvarel_mecon','$2y$10$jBgqo1z82h.PtkZcN71/NuwDJGIK6bP3X8scdOVRHUJkQgj7wErbm','pvarel@mecon.gov.ar',1),(16,'Jorge Arguello','jargue_mecon','$2y$10$SHRuocdc/ERdew5hO7eRx.jonT2NkPtCBfGg9OuIeDSvvwJORDR4u','jargue@mecon.gov.ar',1),(17,'Maria de la Paz Cerutti','mdlpaz_mecon','$2y$10$HQ6EctjHib4uGRtsP7IUdOWGhAfOBEZ4gxVw/0sFxzV0vaOVACgM2','mdlpaz@mecon.gov.ar',1),(18,'Alejandro Glavic','aglavic_mecon','$2y$10$e..ulxzbw0mQwbeDN0p2f.f4DPZqTvcREPZDSsPnwr5Ec5zoua1Fm','aglavic@mecon.gov.ar',1),(19,'Alejandra Marcelli','amarce_mecon','$2y$10$FWMxwtWWMIabR8srOu0Zn.RK7kbuMuHDviX2u0dRkxWNOqz.LooTi','amarce@mecon.gov.ar',1),(20,'Jimena Martinez Mirau','jimmar_mecon','$2y$10$tYXHSeSIcXS2gq.vEt5gfun6t/q9jVc8rTtTlu75hEJJm/RzYMKHW','jimmar@mecon.gov.ar',1),(21,'Czorniak Andrea','anczor_mecon','$2y$10$8j2AK4M6yIyX.vLfwHJOTOifsC9WXiolBV0RGOQ69yDlmMb.zKWCm','anczor@mecon.gov.ar',1),(22,'Ezequiel Greco','egreco_mecon','$2y$10$IIeLWj5WZ3WGg9klaardcuDyHtvrnO56lmbAwf4PNKRaCajsWtyzO','egreco@mecon.gov.ar',1),(23,'Oscar Rodolfo Masello','romasello_mecon','$2y$10$ZbLksACTDZxhZOkLVZnjVuuFmo./4/GC..iJQJVdta3M9uXc6rlmq','romasello@mecon.gov.ar',1),(24,'Jorge Caruso','jcarus_mecon','$2y$10$GFgjqB3PuUHkiUvz.sHuGugKLGwIt.HB3SIDrkj6WqqgGw4aXZdL.','jcarus@mecon.gov.ar',1),(25,'Carlos Traverso','ctrave_mecon','$2y$10$5.XZ2mcFaxOaVaB6SAZh9uR6292J7izl.gxtVcr8PilVVo121miiy','ctrave@mecon.gov.ar',1),(26,'Alejandro Ronald Krebs','akrebs_mecon','$2y$10$eprcCKSVfcY.7SVh6gEvHulvz3iURz4La.L/O./zwOsKOAmUOhluS','akrebs@mecon.gov.ar',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-17 15:58:19
