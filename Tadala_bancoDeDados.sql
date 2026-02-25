-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: 69.6.213.160    Database: hg6c6727_time5_ti29
-- ------------------------------------------------------
-- Server version	8.0.45-36

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
-- Table structure for table `dom_cargo`
--

DROP TABLE IF EXISTS `dom_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_cargo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cargo_descricao` varchar(50) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_cargo`
--

LOCK TABLES `dom_cargo` WRITE;
/*!40000 ALTER TABLE `dom_cargo` DISABLE KEYS */;
INSERT INTO `dom_cargo` VALUES (1,'Atendente','2025-10-09 10:45:22','2025-10-31 12:02:17','2025-10-31 04:10:01'),(2,'Cozinha','2025-10-09 10:45:22','2026-02-12 09:47:46',NULL),(3,'Gerente','2025-10-09 10:45:22',NULL,NULL),(4,'motoboiola','2025-10-09 10:45:22','2026-02-20 09:36:51','2026-02-20 01:02:16'),(5,'motoboy\r\n','2025-10-31 18:26:23',NULL,NULL),(6,'Zelador','2026-02-12 09:33:10','2026-02-12 09:58:28','2026-02-12 01:02:14'),(7,'TESTE','2026-02-12 11:49:20','2026-02-12 11:50:04','2026-02-12 03:02:50'),(8,'Auxiliar de Cozinha','2026-02-20 08:50:24',NULL,NULL),(9,'entregador','2026-02-20 09:37:03',NULL,NULL);
/*!40000 ALTER TABLE `dom_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_metodo_pagamento`
--

DROP TABLE IF EXISTS `dom_metodo_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_metodo_pagamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao_metodo` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sincronizar` char(1) COLLATE utf8mb3_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_metodo_pagamento`
--

LOCK TABLES `dom_metodo_pagamento` WRITE;
/*!40000 ALTER TABLE `dom_metodo_pagamento` DISABLE KEYS */;
INSERT INTO `dom_metodo_pagamento` VALUES (1,'PIX','0'),(2,'Cartão de Credito','0'),(3,'Cartão de Debito','0'),(4,'Beneficios','0'),(5,'Dinheiro','0');
/*!40000 ALTER TABLE `dom_metodo_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_status_funcionario`
--

DROP TABLE IF EXISTS `dom_status_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_status_funcionario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_status_funcionario`
--

LOCK TABLES `dom_status_funcionario` WRITE;
/*!40000 ALTER TABLE `dom_status_funcionario` DISABLE KEYS */;
INSERT INTO `dom_status_funcionario` VALUES (1,'Ativo','2025-09-25 09:53:56',NULL,NULL),(2,'Inativo','2025-09-25 09:53:56',NULL,NULL),(3,'Ferias','2025-09-25 09:53:56',NULL,NULL),(4,'Demitido','2025-09-25 09:53:56',NULL,NULL);
/*!40000 ALTER TABLE `dom_status_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_status_pagamento`
--

DROP TABLE IF EXISTS `dom_status_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_status_pagamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_status_pagamento`
--

LOCK TABLES `dom_status_pagamento` WRITE;
/*!40000 ALTER TABLE `dom_status_pagamento` DISABLE KEYS */;
INSERT INTO `dom_status_pagamento` VALUES (1,'Pendente','2025-10-09 10:45:54','2026-02-09 11:14:18',NULL,'1'),(2,'Pago','2025-10-09 10:45:54','2026-02-09 11:14:18',NULL,'1'),(3,'Cancelado','2025-10-09 10:45:54','2026-02-09 11:14:18',NULL,'1');
/*!40000 ALTER TABLE `dom_status_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_status_pedido`
--

DROP TABLE IF EXISTS `dom_status_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_status_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_status_pedido`
--

LOCK TABLES `dom_status_pedido` WRITE;
/*!40000 ALTER TABLE `dom_status_pedido` DISABLE KEYS */;
INSERT INTO `dom_status_pedido` VALUES (1,'Novo','2025-10-09 10:46:03','2026-02-09 11:15:18',NULL,'1'),(2,'Em preparo','2025-10-09 10:46:03','2026-02-09 11:15:18',NULL,'1'),(3,'Saiu para entrega','2025-10-09 10:46:03','2026-02-09 11:15:18',NULL,'1'),(4,'Concluido','2025-10-09 10:46:03','2026-02-09 11:15:18',NULL,'1'),(5,'Cancelado','2025-10-09 10:46:03','2026-02-09 11:15:18',NULL,'1');
/*!40000 ALTER TABLE `dom_status_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_tipo_pedido`
--

DROP TABLE IF EXISTS `dom_tipo_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_tipo_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao_tipo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) COLLATE utf8mb3_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_tipo_pedido`
--

LOCK TABLES `dom_tipo_pedido` WRITE;
/*!40000 ALTER TABLE `dom_tipo_pedido` DISABLE KEYS */;
INSERT INTO `dom_tipo_pedido` VALUES (1,'Comer no Local',NULL,NULL,NULL,'1'),(2,'Retirar no Local',NULL,NULL,NULL,'1'),(3,'Delivery',NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `dom_tipo_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_tipo_usuario`
--

DROP TABLE IF EXISTS `dom_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_tipo_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_tipo_usuario`
--

LOCK TABLES `dom_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `dom_tipo_usuario` DISABLE KEYS */;
INSERT INTO `dom_tipo_usuario` VALUES (1,'Admin','2025-10-09 10:46:25','2026-02-13 10:57:55','2025-10-22 11:41:19','0'),(2,'Funcionário','2025-10-09 10:46:25','2026-02-12 10:00:52',NULL,'1'),(3,'Cliente','2025-10-09 10:46:25','2026-02-13 10:57:55',NULL,'1');
/*!40000 ALTER TABLE `dom_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_agendamento`
--

DROP TABLE IF EXISTS `tbl_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_agendamento` (
  `agendamento_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `mesa_id` int DEFAULT NULL,
  `data_hora_inicio` datetime NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `status` varchar(45) NOT NULL DEFAULT '"A CAMINHO"',
  PRIMARY KEY (`agendamento_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_agendamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_agendamento`
--

LOCK TABLES `tbl_agendamento` WRITE;
/*!40000 ALTER TABLE `tbl_agendamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categoria` (
  `id_categoria` int NOT NULL,
  `nome` varchar(80) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'Harbúrgueres','Sanduiches variados','2026-01-28 08:51:28','2026-02-12 11:26:58',NULL,'1'),(2,'Sobremesas','Sobremesas doces e diversificadas','2026-01-28 08:40:47',NULL,NULL,'1'),(3,'Bebidas','Refrigerantes, Sucos, Agua, ETC','2026-01-28 08:42:08',NULL,NULL,'1'),(4,'Porções','Porções de alimetos','2026-01-28 08:43:16',NULL,NULL,'1'),(5,'Combos',NULL,'2026-02-15 23:31:25',NULL,NULL,'0');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_endereco` (
  `endereco_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`endereco_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_endereco_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
INSERT INTO `tbl_endereco` VALUES (60,149,'Rua Salvador Balbino de Matos','34','Vila Itaim','São Paulo','SP','08110750','2026-02-24 08:51:39',NULL,NULL,'0'),(61,150,'Rua Conceição do Almeida','10','Parque Paulistano','São Paulo','SP','08081370','2026-02-24 08:52:03',NULL,NULL,'0'),(62,152,'Rua Salvador Balbino de atos','45','Vila Itaim','','','08110-750','2026-02-24 09:14:27',NULL,NULL,'0');
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionarios`
--

DROP TABLE IF EXISTS `tbl_funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_funcionarios` (
  `funcionario_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `cargo_id` int NOT NULL,
  `status_funcionario_id` int NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`funcionario_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `status_funcionario_id` (`status_funcionario_id`),
  CONSTRAINT `tbl_funcionarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`),
  CONSTRAINT `tbl_funcionarios_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `dom_cargo` (`id`),
  CONSTRAINT `tbl_funcionarios_ibfk_3` FOREIGN KEY (`status_funcionario_id`) REFERENCES `dom_status_funcionario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionarios`
--

LOCK TABLES `tbl_funcionarios` WRITE;
/*!40000 ALTER TABLE `tbl_funcionarios` DISABLE KEYS */;
INSERT INTO `tbl_funcionarios` VALUES (49,149,3,1,1920.10,'2026-02-24 08:51:59','2026-02-24 08:52:11','2026-02-24 08:52:11'),(50,156,2,1,48921.12,'2026-02-24 09:30:47',NULL,NULL),(51,159,3,1,2500.00,'2026-02-24 09:42:56',NULL,NULL),(52,163,2,1,8222.21,'2026-02-24 09:49:19',NULL,NULL);
/*!40000 ALTER TABLE `tbl_funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gastos`
--

DROP TABLE IF EXISTS `tbl_gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_gastos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `data_gasto` date NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gastos`
--

LOCK TABLES `tbl_gastos` WRITE;
/*!40000 ALTER TABLE `tbl_gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itens_pedidos`
--

DROP TABLE IF EXISTS `tbl_itens_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_itens_pedidos` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NOT NULL,
  `produto_id` int NOT NULL,
  `quantidade` int NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`item_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `produto_id` (`produto_id`),
  KEY `tbl_itens_pedidos_ibfk_3_idx` (`valor_unitario`),
  CONSTRAINT `tbl_itens_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `tbl_pedidos` (`pedido_id`),
  CONSTRAINT `tbl_itens_pedidos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `tbl_produtos` (`produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=524 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itens_pedidos`
--

LOCK TABLES `tbl_itens_pedidos` WRITE;
/*!40000 ALTER TABLE `tbl_itens_pedidos` DISABLE KEYS */;
INSERT INTO `tbl_itens_pedidos` VALUES (470,144,1,1,29.00,'2026-02-24 08:57:37',NULL,NULL,'0'),(471,144,2,1,31.90,'2026-02-24 08:57:37',NULL,NULL,'0'),(472,144,3,1,34.90,'2026-02-24 08:57:37',NULL,NULL,'0'),(473,144,4,1,14.90,'2026-02-24 08:57:37',NULL,NULL,'0'),(474,145,130,1,110.25,'2026-02-24 09:07:01',NULL,NULL,'0'),(475,145,10,1,18.90,'2026-02-24 09:08:24',NULL,NULL,'0'),(476,146,12,1,27.90,'2026-02-24 09:14:26',NULL,NULL,'0'),(477,147,2,1,31.90,'2026-02-24 09:17:16',NULL,NULL,'0'),(478,147,129,1,2.00,'2026-02-24 09:17:16',NULL,NULL,'0'),(479,147,10,1,18.90,'2026-02-24 09:17:16',NULL,NULL,'0'),(480,147,130,1,110.25,'2026-02-24 09:17:16',NULL,NULL,'0'),(481,148,2,1,31.90,'2026-02-24 09:21:45',NULL,NULL,'0'),(482,148,9,1,9.50,'2026-02-24 09:21:45',NULL,NULL,'0'),(483,148,10,1,18.90,'2026-02-24 09:21:45',NULL,NULL,'0'),(484,148,15,1,6.90,'2026-02-24 09:21:45',NULL,NULL,'0'),(485,148,1,1,29.00,'2026-02-24 09:24:26',NULL,NULL,'0'),(486,149,131,1,1.00,'2026-02-24 09:27:28',NULL,NULL,'0'),(487,150,3,1,34.90,'2026-02-24 09:29:55',NULL,NULL,'0'),(488,150,129,1,2.00,'2026-02-24 09:29:55',NULL,NULL,'0'),(489,150,1,1,29.00,'2026-02-24 09:29:55',NULL,NULL,'0'),(490,150,5,1,17.90,'2026-02-24 09:29:55',NULL,NULL,'0'),(491,150,16,1,17.90,'2026-02-24 09:29:55',NULL,NULL,'0'),(492,150,128,1,3.99,'2026-02-24 09:29:55',NULL,NULL,'0'),(493,150,8,1,7.90,'2026-02-24 09:29:55',NULL,NULL,'0'),(494,150,9,1,9.50,'2026-02-24 09:29:55',NULL,NULL,'0'),(495,150,17,1,4.90,'2026-02-24 09:29:55',NULL,NULL,'0'),(496,151,132,6,20.00,'2026-02-24 09:39:13',NULL,NULL,'0'),(497,151,17,6,4.90,'2026-02-24 09:39:13',NULL,NULL,'0'),(498,152,7,1,19.90,'2026-02-24 09:40:14',NULL,NULL,'0'),(499,152,132,2,20.00,'2026-02-24 09:40:14',NULL,NULL,'0'),(500,152,129,1,2.00,'2026-02-24 09:40:14',NULL,NULL,'0'),(501,153,3,2,34.90,'2026-02-24 09:43:08','2026-02-24 09:44:52',NULL,'0'),(502,153,8,1,7.90,'2026-02-24 09:43:08',NULL,NULL,'0'),(503,154,1,1,29.00,'2026-02-24 09:45:25',NULL,NULL,'0'),(504,154,132,2,20.00,'2026-02-24 09:45:25',NULL,NULL,'0'),(505,154,130,1,110.25,'2026-02-24 09:45:25',NULL,NULL,'0'),(506,155,3,2,34.90,'2026-02-24 09:48:12','2026-02-24 09:52:54','2026-02-24 01:02:23','0'),(507,155,7,1,19.90,'2026-02-24 09:48:12',NULL,NULL,'0'),(508,155,5,1,17.90,'2026-02-24 09:48:12',NULL,NULL,'0'),(509,155,8,1,7.90,'2026-02-24 09:48:12','2026-02-24 09:52:30',NULL,'0'),(510,155,9,1,9.50,'2026-02-24 09:48:12',NULL,NULL,'0'),(511,155,16,1,17.90,'2026-02-24 09:48:12',NULL,NULL,'0'),(512,155,4,1,14.90,'2026-02-24 09:52:43',NULL,NULL,'0'),(513,156,1,1,29.00,'2026-02-24 10:08:16',NULL,NULL,'0'),(514,156,2,1,31.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(515,156,3,4,34.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(516,156,4,1,14.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(517,156,5,1,17.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(518,156,6,1,7.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(519,156,7,9,19.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(520,156,8,1,7.90,'2026-02-24 10:08:16',NULL,NULL,'0'),(521,157,1,2,29.00,'2026-02-24 10:26:27',NULL,NULL,'0'),(522,157,2,2,31.90,'2026-02-24 10:26:27',NULL,NULL,'0'),(523,157,3,1,34.90,'2026-02-24 10:26:27',NULL,NULL,'0');
/*!40000 ALTER TABLE `tbl_itens_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagamento`
--

DROP TABLE IF EXISTS `tbl_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pagamento` (
  `pagamento_id` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NOT NULL,
  `metodo` int NOT NULL,
  `status_pagamento_id` int NOT NULL DEFAULT '1',
  `valor_total` decimal(10,2) NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`pagamento_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `status_pagamento_id` (`status_pagamento_id`),
  KEY `tbl_pagamento_ibfk_3_idx` (`metodo`),
  CONSTRAINT `tbl_pagamento_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `tbl_pedidos` (`pedido_id`),
  CONSTRAINT `tbl_pagamento_ibfk_2` FOREIGN KEY (`status_pagamento_id`) REFERENCES `dom_status_pagamento` (`id`),
  CONSTRAINT `tbl_pagamento_ibfk_3` FOREIGN KEY (`metodo`) REFERENCES `dom_metodo_pagamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagamento`
--

LOCK TABLES `tbl_pagamento` WRITE;
/*!40000 ALTER TABLE `tbl_pagamento` DISABLE KEYS */;
INSERT INTO `tbl_pagamento` VALUES (79,146,2,1,27.90,'2026-02-24 09:14:27',NULL,NULL,'0'),(80,149,2,1,1.00,'2026-02-24 09:27:28','2026-02-24 09:28:50',NULL,'0'),(81,151,1,1,149.40,'2026-02-24 09:39:13',NULL,NULL,'0'),(82,154,5,1,179.25,'2026-02-24 09:45:25',NULL,NULL,'0');
/*!40000 ALTER TABLE `tbl_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedidos`
--

DROP TABLE IF EXISTS `tbl_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pedidos` (
  `pedido_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `status_pedido_id` int NOT NULL DEFAULT '1',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `tipo_pedido` int NOT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `status_pedido_id` (`status_pedido_id`),
  KEY `tbl_pedidos_ibfk_3_idx` (`tipo_pedido`),
  CONSTRAINT `tbl_pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`),
  CONSTRAINT `tbl_pedidos_ibfk_2` FOREIGN KEY (`status_pedido_id`) REFERENCES `dom_status_pedido` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedidos`
--

LOCK TABLES `tbl_pedidos` WRITE;
/*!40000 ALTER TABLE `tbl_pedidos` DISABLE KEYS */;
INSERT INTO `tbl_pedidos` VALUES (144,148,3,'2026-02-24 08:57:37','2026-02-24 09:09:45',NULL,1),(145,151,5,'2026-02-24 09:07:01','2026-02-24 09:09:36',NULL,1),(146,152,3,'2026-02-24 09:14:26','2026-02-24 09:36:58',NULL,3),(147,153,2,'2026-02-24 09:17:16','2026-02-24 21:29:29',NULL,1),(148,153,3,'2026-02-24 09:21:45','2026-02-24 09:25:31',NULL,1),(149,154,1,'2026-02-24 09:27:28',NULL,NULL,1),(150,155,1,'2026-02-24 09:29:55',NULL,NULL,1),(151,157,1,'2026-02-24 09:39:13',NULL,NULL,1),(152,159,2,'2026-02-24 09:40:14','2026-02-24 09:41:05',NULL,1),(153,160,4,'2026-02-24 09:43:08','2026-02-24 09:46:04',NULL,1),(154,161,1,'2026-02-24 09:45:25',NULL,NULL,1),(155,162,4,'2026-02-24 09:48:12','2026-02-24 09:54:09','2026-02-24 01:02:58',1),(156,164,1,'2026-02-24 10:08:16',NULL,NULL,1),(157,165,1,'2026-02-24 10:26:27',NULL,NULL,1);
/*!40000 ALTER TABLE `tbl_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produtos`
--

DROP TABLE IF EXISTS `tbl_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_produtos` (
  `produto_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int DEFAULT '0',
  `categoria_id` int NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `excluido_em` datetime DEFAULT NULL,
  `foto_produto` varchar(200) DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`produto_id`),
  KEY `fk_tbl_categoria_idx` (`categoria_id`),
  CONSTRAINT `fk_tbl_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produtos`
--

LOCK TABLES `tbl_produtos` WRITE;
/*!40000 ALTER TABLE `tbl_produtos` DISABLE KEYS */;
INSERT INTO `tbl_produtos` VALUES (1,'Dallas Burger','Pão brioche, carne 120g, cheddar e bacon',29.00,99,1,'2025-10-29 08:52:35','2026-02-24 09:45:25',NULL,'produto_6990903f0d87c0.89866445.jpg','0'),(2,'Texano Picante','Jalapeños, pepper jack e molho especial',31.90,77,1,'2025-10-29 08:52:35','2026-02-22 21:22:47',NULL,'produto_69909064052140.39582250.jpg','1'),(3,'BBQ Supreme','Duplo smash, cebola caramelizada e BBQ',34.90,90,1,'2025-10-29 08:52:35','2026-02-13 09:04:31',NULL,'img-3.avif','1'),(4,'Costelitos','Porção generosa com sal da casa e molho artesanal',14.90,69,4,'2025-10-29 08:52:35','2026-02-22 21:22:48',NULL,'img-4.avif','1'),(5,'Shake Chocolate','Feito com sorvete cremoso e calda',17.90,56,2,'2025-10-29 08:52:35','2026-02-20 21:10:20',NULL,'img-5.avif','1'),(6,'Refrigerante','Lata gelo — vários sabores',7.90,119,3,'2025-10-29 08:52:35','2026-02-19 10:36:52',NULL,'produto_6985e41ee01883.53813221.avif','1'),(7,'Batata Frita Grande','Serve 2 pessoas',19.90,85,4,'2025-10-29 08:52:35','2026-02-22 21:22:48',NULL,'produto_6983380eb32c18.98536730.jpg','1'),(8,'Coca-Cola Lata','350ml gelada',7.90,197,3,'2025-10-29 08:52:35','2026-02-19 11:49:52',NULL,'produto_698338cd5d5e38.14432798.jpg','1'),(9,'Suco Natural','Laranja ou Limão',9.50,80,3,'2025-10-29 08:52:35','2026-02-09 11:20:18',NULL,'produto_69833910884260.68484643.jpg','1'),(10,'Milkshake Chocolate','500ml',18.90,50,2,'2025-10-29 08:52:35','2026-02-09 11:20:18',NULL,'produto_698355c7e268d5.35209722.jpg','1'),(11,'Veggie Burger','Feito com grão-de-bico',28.90,39,1,'2025-10-29 08:52:35','2026-02-19 11:49:51',NULL,'produto_698487ba71f8d5.41215650.jpg','1'),(12,'X-Frango','Peito de frango empanado',27.90,68,1,'2025-10-29 08:52:35','2026-02-24 09:14:26',NULL,'produto_69848319693292.92506750.jpg','1'),(13,'Hot Dog Tradicional','Pão, salsicha e molho',15.90,49,1,'2025-10-29 08:52:35','2026-02-19 11:49:51',NULL,'produto_6984834a0d8ce4.28013318.jpg','1'),(14,'Onion Rings','Anéis de cebola empanados',16.90,56,4,'2025-10-29 08:52:35','2026-02-19 11:49:52',NULL,'produto_6984832785ac55.26543687.jpg','1'),(15,'Café Expresso','200ml',6.90,96,3,'2025-10-29 08:52:35','2026-02-22 21:22:48',NULL,'produto_6984874ac2a953.66618947.jpg','1'),(16,'Brownie com Sorvete','Doce com bola de sorvete',17.90,29,2,'2025-10-29 08:52:35','2026-02-22 21:22:48',NULL,'produto_698355a06eec17.38989333.jpg','1'),(17,'Água Mineral','Sem gás',4.90,143,3,'2025-10-29 08:52:35','2026-02-24 09:39:13',NULL,'produto_6984835d5f2f01.52385494.jpg','1'),(18,'Combo Kids','Mini lanche e refri',22.90,39,2,'2025-10-29 08:52:35','2026-02-22 21:22:48',NULL,'produto_698486b56b4a58.66210611.jpg','1'),(19,'X-Duplo','Dois hambúrgueres e queijo duplo',33.90,57,1,'2025-10-29 08:52:35','2026-02-20 21:10:20',NULL,'produto_69848825b6a816.22193294.jpg','1'),(20,'Batata com Cheddar e Bacon','Porção generosa',22.90,40,4,'2025-10-29 08:52:35','2026-02-09 11:20:18',NULL,'produto_69848335c1acd4.09320743.jpg','1'),(127,'hamburguer tres molhos','haburguer de edição ltda',29.90,50,2,'2025-10-31 10:41:19','2026-02-09 11:20:18',NULL,'produto_698488140006a3.79878745.jpg','1'),(128,'caiao','boneca',3.99,2,2,'2025-10-31 11:08:01','2026-02-24 09:20:47',NULL,'produto_6983553c3dd569.69624874.webp','1'),(129,'lucas','spida',2.00,1,1,'2026-02-04 11:58:44','2026-02-24 09:20:47',NULL,'produto_69835eca1bab73.42006612.webp','1'),(130,'COMBO VITAO','3 Hamburguer Artesanal, 3 Batata Grande e 2 Refrigerante de 2 Litro',110.25,9,5,'2026-02-12 09:55:34','2026-02-24 09:45:25',NULL,'produto_698dcdf5659b88.23576470.jpg','0'),(131,'Luccas','gay',1.00,0,2,'2026-02-24 09:18:51','2026-02-24 09:27:28',NULL,'produto_699d9788124e16.57220983.jpg','0'),(132,'tadala de 1kg','tadalinha',20.00,22,5,'2026-02-24 09:32:28','2026-02-24 09:45:25',NULL,'produto_699d9a79bdc099.16809651.webp','0');
/*!40000 ALTER TABLE `tbl_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocoes`
--

DROP TABLE IF EXISTS `tbl_promocoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_promocoes` (
  `id_promocao` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('PERCENTUAL','VALOR') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) unsigned NOT NULL,
  `data_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_fim` timestamp NULL DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id_promocao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocoes`
--

LOCK TABLES `tbl_promocoes` WRITE;
/*!40000 ALTER TABLE `tbl_promocoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_promocoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuario` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tipo_usuario_id` int NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  `sincronizar` char(1) DEFAULT '0',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `telefone_UNIQUE` (`telefone`),
  KEY `tipo_usuario_id` (`tipo_usuario_id`),
  CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `dom_tipo_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (148,'Admin','admin@abc.com','$2y$10$LLaJt8YkfJ3SzEmdFFuTU.fshIsJdZSzopYcMFWPQDDv6zkvs/XgG','11999999999',1,'2026-02-24 08:50:20',NULL,NULL,'0'),(149,'Gustavo','gustavo@gmail.com','$2y$10$2.jdWrWAsc6elK6zotMYzOxOngzT0vFJKcU/Rm9EDOruxb1XmTNaC','119874897654',3,'2026-02-24 08:51:38','2026-02-24 08:52:11',NULL,'0'),(150,'vitin@gmail.com','vitin@gmail.com','$2y$10$Sfsa5S3jp7.FOl6PltQwYe9ByJKU.7KZsh.T1dCkISRt2sm7HtHJm','11917896030',3,'2026-02-24 08:52:03',NULL,'2026-02-24 08:52:27','0'),(151,'Ricardosoaresdeoliveiraricardo@gmail.com','ricardosoaresdeoliveiraricardo@gmail.com','$2y$10$5VTITYCWKET6UUmkIc9mQe80xnwo3EsaSqRHHcBMUnc2etsz2Pkuu','11000000000',2,'2026-02-24 09:06:40','2026-02-24 09:10:44',NULL,'0'),(152,'opa',NULL,'$2y$10$x8hxNJaAe1mDfuSFbCSs0eJ97f5xAYgr7mWM0tokAk4AnLC7TcyWW','11111111111',3,'2026-02-24 09:14:26',NULL,NULL,'0'),(153,'Yuri','yuri@senac.com','$2y$10$mpz0qmEMTWYsoHYUOg1kceldwKB7pmn9aiuyeje3StQ/WahV5iubq','1195179965',3,'2026-02-24 09:16:08',NULL,NULL,'0'),(154,'rafaela',NULL,'$2y$10$pKUiWuozEsOl8W4G9IdtQOx/NkYFNByJFX8MWYDHrWUCpiVQeFknm','11955969358',3,'2026-02-24 09:27:28',NULL,NULL,'0'),(155,'Carlos schevchencko','carlosschevchencko@gmail.com','$2y$10$QJzJMvUGuItBMk9vVBBjsutHNadP6czAk9lJiPgdsYoS1jLOEYLLW','11989542121',2,'2026-02-24 09:29:19','2026-02-24 09:35:27',NULL,'0'),(156,'Vitao trabalhador','vitaoTrabalhador@gmail.com','$2y$10$bU5UcaQrSrKWqazdSOwHY.C/OGEOo2qLpnxgHA8LPgYSvrCUj9w7G',NULL,2,'2026-02-24 09:30:47','2026-02-24 09:30:47',NULL,'0'),(157,'Carlos Schevchencko',NULL,'$2y$10$mQeR9CQtsaqTNGkKG9BmmO44XOzrKRPO2o4RkqlZWmmz0gCHGnmGi','11989542132',3,'2026-02-24 09:39:13',NULL,NULL,'0'),(158,'Jotalho','jjj@gmail.com','$2y$10$3eJazOSAhK9DjaExLd/7vOvoV.zVEjlEa4fB1x6G8EJLw3mecYLdm','11235474645',3,'2026-02-24 09:39:50',NULL,NULL,'0'),(159,'Kennedy ramos','kekevida@gmail.com','$2y$10$NjWPgjl.sifkkcNj/zYLA.xi1iSoGbIy3Db/8rEz8QVXTdUkZ7/bK','1198475345',2,'2026-02-24 09:39:53','2026-02-24 09:42:56',NULL,'0'),(160,'Tiago','collinpool2012@gmail.com','$2y$10$6FVVxW8dYLY.bzYY3ugGMedO0icXK6m7TJ3yyOuXANZAdTEZC2M3O','11989542122',3,'2026-02-24 09:42:49',NULL,NULL,'0'),(161,'daniela',NULL,'$2y$10$Yz1VhDYNDivCVLscvgqWD.hHfuNKQKmtmadeH6wKX3m21SB/F5d0q','1198864543',3,'2026-02-24 09:45:25',NULL,NULL,'0'),(162,'Daniel walker','danielwalker@gmail.com','$2y$10$IDfF.3NErk0sVZ9NbukIpusoYG3qBhYiSWJUbdfcUI2l/.OIz/Hi.','11957770890',3,'2026-02-24 09:47:41',NULL,NULL,'0'),(163,'funcionarioteste','funcionarioteste@gmail.com','$2y$10$scrtpJVU3szxtW8fpA5fH.GK55Ycic5dD3nD.fgm9rmH/QGmdx0B2',NULL,2,'2026-02-24 09:49:19','2026-02-24 09:49:19',NULL,'0'),(164,'Lavigne','lavigne222@gmail.com','$2y$10$lkPZxuB0X69tdKBhfBXIseQUgxVD4PmymosIq7iSaq4LhRhOb.Rp2','11964553434',3,'2026-02-24 10:07:33',NULL,NULL,'0'),(165,'Nicolas tavares ','nimbinhos@gmail.com','$2y$10$3BuFWpOmitm/UPzWu2SxUOH/GgBqHzFo/ny5iEX2svuK1lBCEJQ2a','11988012353',3,'2026-02-24 10:17:46',NULL,NULL,'0');
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-25 14:38:53
