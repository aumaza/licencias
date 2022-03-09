-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: licor
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-0+deb11u1

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
  `periodo` varchar(4) DEFAULT NULL,
  `f_desde` date NOT NULL,
  `f_hasta` date NOT NULL,
  `tipo_licencia` varchar(100) NOT NULL,
  `total_lor` int(11) DEFAULT NULL,
  `dias_tomados_lor` int(11) DEFAULT NULL,
  `dias_restantes_lor` int(11) DEFAULT NULL,
  `total_aca` int(11) DEFAULT NULL,
  `dias_tomados_aca` int(11) DEFAULT NULL,
  `dias_restantes_aca` int(11) DEFAULT NULL,
  `total_estudio` int(11) DEFAULT NULL,
  `dias_tomados_estudio` int(11) DEFAULT NULL,
  `dias_restantes_estudio` int(11) DEFAULT NULL,
  `total_maternidad` int(11) DEFAULT NULL,
  `total_enfermedad` int(11) DEFAULT NULL,
  `dias_tomados_enfermedad` int(11) DEFAULT NULL,
  `dias_restantes_enfermedad` int(11) DEFAULT NULL,
  `total_enfermedad_familiar` int(11) DEFAULT NULL,
  `dias_tomados_enfermedad_familiar` int(11) DEFAULT NULL,
  `dias_restantes_enfermedad_familiar` int(11) DEFAULT NULL,
  `dias_tomados_otros` int(11) DEFAULT NULL,
  `cant_horas` int(11) DEFAULT NULL,
  `cant_anios` varchar(1) DEFAULT NULL,
  `fraccion` enum('Primera','Segunda','Tercera') DEFAULT NULL,
  `comprobantes` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `licencias`
--

LOCK TABLES `licencias` WRITE;
/*!40000 ALTER TABLE `licencias` DISABLE KEYS */;
INSERT INTO `licencias` VALUES (1,'Augusto Maza','24283493','2020','2022-02-07','2022-02-25','Licencia Anual Ordinaria',35,19,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','Primera',NULL),(9,'Augusto Maza','24283493',NULL,'2022-01-24','2022-01-26','Nacimientos',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'',NULL,NULL),(10,'Augusto Maza','24283493',NULL,'2022-01-17','2022-01-21','Fallecimiento',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,'',NULL,NULL),(11,'Augusto Maza','24283493',NULL,'2022-04-04','2022-04-05','Razones Particulares (Ausente con Aviso)',NULL,NULL,NULL,6,2,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(12,'Augusto Maza','24283493',NULL,'2022-03-14','2022-03-16','Razones Especiales (Fuerza Mayor)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'',NULL,'tarjeta_embarque_ma_maza.pdf'),(14,'Augusto Maza','24283493',NULL,'2022-01-17','2022-01-17','Donación de Sangre',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'',NULL,'tarifa_social_0745590.pdf'),(15,'Augusto Maza','24283493',NULL,'2022-06-06','2022-06-10','Mesas Examinadoras',NULL,NULL,NULL,NULL,NULL,NULL,12,5,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(16,'Augusto Maza','24283493',NULL,'2022-08-15','2022-08-19','Mesas Examinadoras',NULL,NULL,NULL,NULL,NULL,NULL,12,5,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(17,'Augusto Maza','24283493',NULL,'2022-11-28','2022-11-29','Mesas Examinadoras',NULL,NULL,NULL,NULL,NULL,NULL,12,2,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(18,'Augusto Maza','24283493',NULL,'2022-03-14','2022-12-12','Horarios para estudiantes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'',NULL,NULL),(19,'Gabriela Keiemburg','24363970',NULL,'2022-02-07','2022-10-03','Reducción horaria para agentes madres de lactantes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,239,1,'',NULL,NULL),(20,'Augusto Maza','24283493',NULL,'2022-04-04','2022-04-15','Asistencia a congresos',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,'',NULL,NULL),(21,'Augusto Maza','24283493',NULL,'2022-02-08','2022-02-11','Afecciones de corto tratamiento',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,45,4,41,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(23,'Augusto Maza','24283493',NULL,'2022-01-25','2022-01-25','Afecciones de corto tratamiento',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,45,1,40,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL),(24,'Augusto Maza','24283493',NULL,'2022-02-01','2023-01-31','Afecciones largo tratamiento',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL),(25,'Augusto Maza','24283493',NULL,'2023-02-01','2024-01-31','Afecciones largo tratamiento',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL),(26,'Augusto Maza','24283493',NULL,'2024-02-01','2026-01-30','Afecciones largo tratamiento',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4',NULL,NULL),(27,'Augusto Maza','24283493',NULL,'2022-04-01','2023-03-31','Accidente de trabajo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL),(28,'Augusto Maza','24283493',NULL,'2022-06-01','2023-05-31','Incapacidad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL);
/*!40000 ALTER TABLE `licencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_licencia`
--

DROP TABLE IF EXISTS `tipo_licencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_licencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clase_licencia` enum('Licencia Ordinaria','Licencias Especiales','Licencias Extraordinarias con goce de haberes','Licencias Extraordinarias sin goce de haberes','Inasistencias','Franquicias') NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `art_licencia` varchar(50) NOT NULL,
  `tipo_revista` enum('Planta Permanente','No Permanente','Ambas') NOT NULL,
  `tiempo` varchar(30) NOT NULL,
  `goce_haberes` enum('Si','No') NOT NULL,
  `obligatoria` enum('Si','No') NOT NULL,
  `particularidad` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_licencia`
--

LOCK TABLES `tipo_licencia` WRITE;
/*!40000 ALTER TABLE `tipo_licencia` DISABLE KEYS */;
INSERT INTO `tipo_licencia` VALUES (1,'Licencia Ordinaria','Licencia Anual Ordinaria','Articulo 9','Ambas','Según Antiguedad','Si','Si','Ninguna'),(2,'Licencias Especiales','Afecciones de corto tratamiento','Articulo 10a','Ambas','45 días','Si','Si','Con goce de haberes'),(3,'Licencias Especiales','Enfermedad en horas de labor','Articulo 10b','Ambas','Sin Especificar','Si','Si','Menos de media Jornada\r\ntrabajada, computa como Art. 10a, mas de media Jornada salida sin reposición.'),(4,'Licencias Especiales','Afecciones largo tratamiento','Articulo 10c','Ambas','1 - 4 Años','Si','Si','Disminuye el monto\r\ndel haber conforme se extiende en el tiempo'),(5,'Licencias Especiales','Accidente de trabajo','Articulo 10d','Ambas','1 - 4 Años','Si','Si','Disminuye el monto\r\ndel haber conforme se extiende en el tiempo.'),(6,'Licencias Especiales','Incapacidad','Articulo 10e','Planta Permanente','1 Año','Si','Si','Estado irreversible,\r\npara capacidad laborativa. Minimo 4 horas diarias'),(7,'Licencias Especiales','Anticipo de haber por pasividad','Articulo 10f','Planta Permanente','12 Meses','Si','Si','Incapacidad,\r\njubilación por invalidez, (95%) del haber jubilatorio'),(8,'Licencias Especiales','Maternidad','Articulo 10g','Ambas','100 Días','Si','Si','30 Días anteriores al\r\nparto y 70 después del parto, se adicionan 10 días por parto múltiple'),(9,'Licencias Especiales','Maternidad (Nac. sin vida)','Articulo 135 CCTG','Ambas','101 Días','Si','Si','31 Días anteriores al\r\nparto y 70 después del parto, se suman 10 días por parto múltiple'),(10,'Licencias Especiales','Maternidad Excedencia','Articulo 138 CCTG','Ambas','3 - 6 Meses','No','No','Opciones: a) No hacer uso - b) Rescindir el 25% de haber por cada año - c) Sin percibir haber por un período de 3 a 6 meses'),(11,'Licencias Especiales','Tenencia para adopción','Articulo 10h','Ambas','60 Días','Si','Si','Tenencia de niños\r\nhasta (7) años de edad'),(12,'Licencias Especiales','Atención hijos menores','Articulo 10i','Ambas','30 días','Si','Si','En caso de fallecer\r\nla madre o madrastra'),(13,'Licencias Especiales','Atención Grupo Familiar','Articulo 10j','Ambas','20 o 90 Días','Si','Si','20 días con goce de\r\nhaberes y se podrá extender hasta 90 días más sin goce'),(14,'Licencias Especiales','Declaración jurada Grupo Familiar','Articulo 10k','Planta Permanente','Sin Especificar','No','Si','Deber de presentar\r\nDDJJ sobre su grupo filiar a cargo'),(15,'Licencias Especiales','Incompatibilidad','Articulo 10l','Planta Permanente','Sin Especificar','No','Si','No se podrá desempeñar en funciones públicas o privadas mientras goce de las licencias'),(16,'Licencias Extraordinarias con goce de haberes','Para Rendir Examenes','Articulo 13a','Ambas','28 o 12 Días','Si','Si','Dias laborales, por plazos de 6 días\r\ncorridos para Terciario o Posgrado, 3 días corridos Secundario'),(17,'Licencias Extraordinarias con goce de haberes','Para Realizar estudios o Investigaciones','Articulo 13b','Planta Permanente','2 Años','Si','Si','Antiguedad de 1 año,\r\ndebe permanecer en el cargo por el doble del plazo acordado para la\r\ninvestigación'),(18,'Licencias Extraordinarias con goce de haberes','Estudios en Escuela Defensa Nacional','Articulo 13c','Planta Permanente','Indeterminado','Si','Si','Se computa de acuerdo\r\nal curso superior que dicte la Escuela de Defensa Nacional. Debe permanecer el doble de tiempo'),(19,'Licencias Extraordinarias con goce de haberes','Matrimonio del agente o hijos','Articulo 13d','Ambas','10 - 2 Días Laborales','Si','Si','A partir del Civil o Religioso a opción del interesado'),(20,'Licencias Extraordinarias con goce de haberes','Actividades Deportivas no rentadas','Articulo 13e','Ambas','Sin Especificar','Si','No','Cuando se trate de\r\nintervenir en juntas, integrar delegaciones o participar en selecciones previas.'),(21,'Licencias Extraordinarias sin goce de haberes','Ejercicio Transitorio de otros cargos','Articulo 13a2','Planta Permanente','Indeterminado','No','Si','Lo que dure el cargo de funciones\r\nsuperiores, nivel Nacional, Provincial, Municipal.'),(22,'Licencias Extraordinarias sin goce de haberes','Razones Particulares','Articulo 13b2','Planta Permanente','6 meses','No','No','Máximo de 6 meses\r\ncada 10 años'),(23,'Licencias Extraordinarias sin goce de haberes','Razones de Estudio','Articulo 13c2','Planta Permanente','1-2 Años','No','No','Por un período máximo\r\nde 1 año, prorrogable otro igual, cada 10 años'),(24,'Licencias Extraordinarias sin goce de haberes','Acompañar Cónyuge','Articulo 13d2','Planta Permanente','+ 60 Días','No','Si','Cuando el cóyuge\r\nfuere designado en misión oficial a más de 100 kms.'),(25,'Licencias Extraordinarias sin goce de haberes','Cargos, horas Cátedra','Articulo 13e2','Planta Permanente','Indeterminado','No','Si','Cargos de mayor jerárquía, en el orden nacional, por el término que dure el puesto de mayor remuneración.'),(26,'Inasistencias','Nacimientos','Articulo 14a','Ambas','3 días','Si','Si','Al agente varón, por nacimiento de hijo, tres (3) días laborables.'),(27,'Inasistencias','Fallecimiento','Articulo 14b','Ambas','3 - 5 días','Si','Si','Por fallecimiento de un familiar, ocurrido en el país o en el extranjero, con arreglo a la siguiente escala: 1) Del cónyuge o parientes consanguíneos en primer grado:  cinco (5) días laborables.\r\n2) De parientes consanguíneos de segundo grado y afines de primero y segundo grado: tres (3) días laborables.\r\nLos términos previstos en este inciso comenzarán a contarse a  partir del día de producido el fallecimiento, del de la toma de conocimiento del mismo, o del de las exequias, a opción del agente'),(28,'Inasistencias','Razones Especiales (Fuerza Mayor)','Articulo 14c','Ambas','Indeterminado','Si','Si','Inasistencias motivadas por fenómenos meteorológicos y casos de fuerza mayor, debidamente\r\ncomprobados.\r\n'),(29,'Inasistencias','Donación de Sangre','Articulo 14d','Ambas','1 día','Si','Si','El día de la donación, siempre que se presente la certificación médica correspondiente.\r\n'),(30,'Inasistencias','Revisación previa para el servicio militar obligatorio','Articulo 14e','Ambas','1 dia','Si','Si','Para la revisación médica previa a la incorporación a las Fuerzas armadas o de Seguridad para cumplir con el servicio militar obligatorio, o por otras razones relacionadas con el mismo fin. Las justificaciones estarán condicionadas a la previa presentación de las citaciones emanadas del respectivo organismo militar.'),(31,'Inasistencias','Razones Particulares (Ausente con Aviso)','Articulo 14f','Ambas','2 - 6 días','Si','Si','Por razones particulares, mediando preaviso de por lo menos dos (2) días hábiles, se justificarán automáticamente hasta seis (6) días laborables por año calendario y no más de dos (2) por mes.\r\nDe no mediar preaviso o éste se formulare fuera de término, la autoridad competente, en base a las\r\nrazones invocadas podrá:\r\n1-Justificar las inasistencias con goce de haberes.\r\n2-Justificarlas sin goce de haberes.\r\n3-No justificarlas.\r\nLas inasistencias justificadas sin goce de haberes se encuadrarán hasta su agotamiento, en las\r\nprescripciones del inciso h) del presente artículo, mientras que las que no se justifiquen darán lugar a las sanciones previstas por las disposiciones legales en vigor'),(32,'Inasistencias','Mesas Examinadoras','Articulo 14g','Ambas','12 dias','Si','Si','Cuando el agente deba integrar mesas examinadoras en establecimientos educacionales oficiales o incorporados, o en universidades privadas reconocidas por el Gobierno Nacional, y con tal motivo se creara conflicto de horarios, se le justificarán hasta doce (12) días laborables en el año calendario.'),(33,'Inasistencias','Otras Inasistencias (Ausente con aviso sin goce de haberes)','Articulo 14h','Ambas','2 - 6 días','No','Si','Las inasistencias que no encuadren en ninguno de los incisos anteriores pero que obedezcan a razones atendibles, se podrán justificar sin goce de sueldo hasta un máximo de seis (6) días por año calendario y no más de dos (2) por mes.'),(34,'Franquicias','Horarios para estudiantes','Articulo 15a','Ambas','2 horas','Si','Si','Cuando el agente acredite su condición de estudiante en establecimientos de enseñanza oficial o incorporados, o en universidades reconocidas por el Gobierno Nacional y documente la necesidad de asistir a los mismos en horas de oficina, podrá solicitar un horario especial o permisos sujetos a la correspondiente reposición horaria, los que serán otorgados siempre que no se afecte el normal desenvolvimiento de los servicios. En el supuesto de que por la naturaleza de los servicios no resulte posible acceder a lo solicitado, el agente podrá optar por una reducción de dos (2) horas en su jornada de labor, debiendo efectuarse en ese caso sobre su remuneración regular, total y permanente, una deducción del veinte por ciento (20 %) durante el término en que cumpla ese horario de excepción.'),(35,'Franquicias','Reducción horaria para agentes madres de lactantes','Articulo 15b','Ambas','Ver Particularidades','Si','Si','Las agentes madres de lactantes tendrán derecho a una reducción horaria con arreglo a las siguientes opciones: 1) Disponer de 2 descansos de media 1/2 hora cada uno para atención de su hijo en el transcurso de la jornada de trabajo. 2) Disminuir en 1 hora diaria su jornada de trabajo, ya sea iniciando su labor una hora después del horario de entrada o finalizándola una hora antes. 3) Disponer de 1 hora en el transcurso de la jornada de trabajo. Esta franquicia se acordará por espacio de 240 días corridos contados a partir de la fecha de nacimiento del niño. Dicho plazo podrá ampliarse en casos especiales y previo examen médico del niño, que justifique la excepción, hasta 365 días corridos. En caso de nacimiento múltiple se le concederá a la agente dicha prórroga sin examen previo de los niños. La franquicia a que se alude y su prórroga, sólo alcanzará a las agentes cuya jornada de trabajo sea superior a 4 horas diarias.'),(36,'Franquicias','Asistencia a congresos','Articulo 15c','Ambas','Sin Especificar','Si','Si','Las inasistencias en que incurra el personal con motivo de haber sido autorizado a concurrir a conferencias, congresos o simposios que se celebren en el país con auspicio oficial, o declarados de interés nacional, serán justificadas con goce de haberes.');
/*!40000 ALTER TABLE `tipo_licencia` ENABLE KEYS */;
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

-- Dump completed on 2022-03-08 19:28:28
