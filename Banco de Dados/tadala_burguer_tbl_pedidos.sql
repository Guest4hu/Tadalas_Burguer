-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tadala_burguer
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `tbl_pedidos`
--

DROP TABLE IF EXISTS `tbl_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pedidos` (
  `id_pedido` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned DEFAULT NULL,
  `id_mesa` bigint(20) unsigned DEFAULT NULL,
  `id_comanda` bigint(20) unsigned DEFAULT NULL,
  `canal_venda` varchar(20) NOT NULL,
  `status_id` tinyint(3) unsigned NOT NULL,
  `subtotal` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `desconto` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `taxa_servico` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `valor_total` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_ped_mesa` (`id_mesa`),
  KEY `fk_ped_com` (`id_comanda`),
  KEY `idx_ped_status_data` (`status_id`,`created_at`),
  KEY `idx_ped_user` (`id_usuario`),
  KEY `idx_ped_data` (`created_at`),
  CONSTRAINT `fk_ped_com` FOREIGN KEY (`id_comanda`) REFERENCES `tbl_comanda` (`id_comanda`),
  CONSTRAINT `fk_ped_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesas` (`id_mesa`),
  CONSTRAINT `fk_ped_status` FOREIGN KEY (`status_id`) REFERENCES `dom_status_pedido` (`id`),
  CONSTRAINT `fk_ped_user` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedidos`
--

LOCK TABLES `tbl_pedidos` WRITE;
/*!40000 ALTER TABLE `tbl_pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-28 10:47:55
