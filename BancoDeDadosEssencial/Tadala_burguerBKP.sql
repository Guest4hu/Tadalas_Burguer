-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tadala_burgueres
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
-- Table structure for table `dom_cargo`
--

DROP TABLE IF EXISTS `dom_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_cargo`
--

LOCK TABLES `dom_cargo` WRITE;
/*!40000 ALTER TABLE `dom_cargo` DISABLE KEYS */;
INSERT INTO `dom_cargo` VALUES (1,'Atendente'),(2,'Cozinheiro'),(3,'Gerente'),(4,'Entregador');
/*!40000 ALTER TABLE `dom_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_status_funcionario`
--

DROP TABLE IF EXISTS `dom_status_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_status_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_status_funcionario`
--

LOCK TABLES `dom_status_funcionario` WRITE;
/*!40000 ALTER TABLE `dom_status_funcionario` DISABLE KEYS */;
INSERT INTO `dom_status_funcionario` VALUES (1,'Ativo'),(2,'Inativo'),(3,'F?rias'),(4,'Demitido');
/*!40000 ALTER TABLE `dom_status_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_status_pagamento`
--

DROP TABLE IF EXISTS `dom_status_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_status_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_status_pagamento`
--

LOCK TABLES `dom_status_pagamento` WRITE;
/*!40000 ALTER TABLE `dom_status_pagamento` DISABLE KEYS */;
INSERT INTO `dom_status_pagamento` VALUES (1,'Pendente'),(2,'Pago'),(3,'Cancelado');
/*!40000 ALTER TABLE `dom_status_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_status_pedido`
--

DROP TABLE IF EXISTS `dom_status_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_status_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_status_pedido`
--

LOCK TABLES `dom_status_pedido` WRITE;
/*!40000 ALTER TABLE `dom_status_pedido` DISABLE KEYS */;
INSERT INTO `dom_status_pedido` VALUES (1,'Novo'),(2,'Em preparo'),(3,'Saiu para entrega'),(4,'Conclu?do'),(5,'Cancelado');
/*!40000 ALTER TABLE `dom_status_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dom_tipo_usuario`
--

DROP TABLE IF EXISTS `dom_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dom_tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dom_tipo_usuario`
--

LOCK TABLES `dom_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `dom_tipo_usuario` DISABLE KEYS */;
INSERT INTO `dom_tipo_usuario` VALUES (1,'Cliente'),(2,'Funcion?rio'),(3,'Administrador');
/*!40000 ALTER TABLE `dom_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_agendamento`
--

DROP TABLE IF EXISTS `tbl_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_agendamento` (
  `agendamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `mesa_id` int(11) DEFAULT NULL,
  `data_hora_inicio` datetime NOT NULL,
  `data_hora_fim` datetime NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`agendamento_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_agendamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_agendamento`
--

LOCK TABLES `tbl_agendamento` WRITE;
/*!40000 ALTER TABLE `tbl_agendamento` DISABLE KEYS */;
INSERT INTO `tbl_agendamento` VALUES (1,1,5,'2025-09-01 19:00:00','2025-09-01 21:00:00','2025-08-28 11:46:34',NULL,NULL);
/*!40000 ALTER TABLE `tbl_agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categorias`
--

DROP TABLE IF EXISTS `tbl_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categorias` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categorias`
--

LOCK TABLES `tbl_categorias` WRITE;
/*!40000 ALTER TABLE `tbl_categorias` DISABLE KEYS */;
INSERT INTO `tbl_categorias` VALUES (1,'Burgers'),(2,'Bebidas'),(3,'Sobremesas');
/*!40000 ALTER TABLE `tbl_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_endereco` (
  `endereco_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`endereco_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_endereco_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
INSERT INTO `tbl_endereco` VALUES (1,1,'Rua das Flores','123','Centro','S?o Paulo','SP','01000-000');
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionarios`
--

DROP TABLE IF EXISTS `tbl_funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_funcionarios` (
  `funcionario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `status_funcionario_id` int(11) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`funcionario_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `status_funcionario_id` (`status_funcionario_id`),
  CONSTRAINT `tbl_funcionarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`),
  CONSTRAINT `tbl_funcionarios_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `dom_cargo` (`id`),
  CONSTRAINT `tbl_funcionarios_ibfk_3` FOREIGN KEY (`status_funcionario_id`) REFERENCES `dom_status_funcionario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionarios`
--

LOCK TABLES `tbl_funcionarios` WRITE;
/*!40000 ALTER TABLE `tbl_funcionarios` DISABLE KEYS */;
INSERT INTO `tbl_funcionarios` VALUES (1,2,1,1,2000.00);
/*!40000 ALTER TABLE `tbl_funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itens_pedidos`
--

DROP TABLE IF EXISTS `tbl_itens_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_itens_pedidos` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `tbl_itens_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `tbl_pedidos` (`pedido_id`),
  CONSTRAINT `tbl_itens_pedidos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `tbl_produtos` (`produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itens_pedidos`
--

LOCK TABLES `tbl_itens_pedidos` WRITE;
/*!40000 ALTER TABLE `tbl_itens_pedidos` DISABLE KEYS */;
INSERT INTO `tbl_itens_pedidos` VALUES (1,1,1,2,25.90),(2,1,3,2,6.50);
/*!40000 ALTER TABLE `tbl_itens_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagamento`
--

DROP TABLE IF EXISTS `tbl_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pagamento` (
  `pagamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `status_pagamento_id` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pagamento_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `status_pagamento_id` (`status_pagamento_id`),
  CONSTRAINT `tbl_pagamento_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `tbl_pedidos` (`pedido_id`),
  CONSTRAINT `tbl_pagamento_ibfk_2` FOREIGN KEY (`status_pagamento_id`) REFERENCES `dom_status_pagamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagamento`
--

LOCK TABLES `tbl_pagamento` WRITE;
/*!40000 ALTER TABLE `tbl_pagamento` DISABLE KEYS */;
INSERT INTO `tbl_pagamento` VALUES (1,1,'Cart?o de Cr?dito',2,64.80);
/*!40000 ALTER TABLE `tbl_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedidos`
--

DROP TABLE IF EXISTS `tbl_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pedidos` (
  `pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `status_pedido_id` int(11) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `status_pedido_id` (`status_pedido_id`),
  CONSTRAINT `tbl_pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuario` (`usuario_id`),
  CONSTRAINT `tbl_pedidos_ibfk_2` FOREIGN KEY (`status_pedido_id`) REFERENCES `dom_status_pedido` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedidos`
--

LOCK TABLES `tbl_pedidos` WRITE;
/*!40000 ALTER TABLE `tbl_pedidos` DISABLE KEYS */;
INSERT INTO `tbl_pedidos` VALUES (1,1,1,'2025-08-28 11:46:34',NULL);
/*!40000 ALTER TABLE `tbl_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produtos`
--

DROP TABLE IF EXISTS `tbl_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_produtos` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) DEFAULT 0,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`produto_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `tbl_produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produtos`
--

LOCK TABLES `tbl_produtos` WRITE;
/*!40000 ALTER TABLE `tbl_produtos` DISABLE KEYS */;
INSERT INTO `tbl_produtos` VALUES (1,'Cheeseburger','Hamb?rguer cl?ssico com queijo',25.90,50,1),(2,'X-Bacon','Hamb?rguer com bacon crocante',29.90,30,1),(3,'Refrigerante Lata','Coca-Cola, Pepsi ou Guaran?',6.50,100,2),(4,'Milkshake Chocolate','Milkshake cremoso sabor chocolate',15.00,20,2),(5,'Brownie','Brownie de chocolate com calda',12.00,15,3);
/*!40000 ALTER TABLE `tbl_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL,
  `excluido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`),
  KEY `tipo_usuario_id` (`tipo_usuario_id`),
  CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `dom_tipo_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'Jo?o da Silva','joao.silva@email.com','123456','11999999999',1,'2025-08-28 11:46:34',NULL,NULL),(2,'Maria Souza','maria.souza@email.com','123456','11988888888',2,'2025-08-28 11:46:34',NULL,NULL),(3,'Admin Master','admin@email.com','admin123','11977777777',3,'2025-08-28 11:46:34',NULL,NULL);
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

-- Dump completed on 2025-08-28 11:47:19
