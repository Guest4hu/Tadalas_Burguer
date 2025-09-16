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
-- Temporary view structure for view `vw_concentracao_pedidos`
--

DROP TABLE IF EXISTS `vw_concentracao_pedidos`;
/*!50001 DROP VIEW IF EXISTS `vw_concentracao_pedidos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_concentracao_pedidos` AS SELECT 
 1 AS `id_pedido`,
 1 AS `data_pedido`,
 1 AS `cidade`,
 1 AS `bairro`,
 1 AS `lat`,
 1 AS `lng`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_vendas`
--

DROP TABLE IF EXISTS `vw_vendas`;
/*!50001 DROP VIEW IF EXISTS `vw_vendas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_vendas` AS SELECT 
 1 AS `id_pedido`,
 1 AS `data_pedido`,
 1 AS `valor_pago`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_pontos_saldo`
--

DROP TABLE IF EXISTS `vw_pontos_saldo`;
/*!50001 DROP VIEW IF EXISTS `vw_pontos_saldo`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_pontos_saldo` AS SELECT 
 1 AS `id_usuario`,
 1 AS `saldo`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_concentracao_pedidos`
--

/*!50001 DROP VIEW IF EXISTS `vw_concentracao_pedidos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_concentracao_pedidos` AS select `p`.`id_pedido` AS `id_pedido`,`p`.`created_at` AS `data_pedido`,`e`.`cidade` AS `cidade`,`e`.`bairro` AS `bairro`,`e`.`lat` AS `lat`,`e`.`lng` AS `lng` from (`tbl_pedidos` `p` join `tbl_endereco` `e` on(`e`.`entidade_tipo` = 'USUARIO' and `e`.`id_entidade` = `p`.`id_usuario`)) where `e`.`is_padrao` = 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vendas`
--

/*!50001 DROP VIEW IF EXISTS `vw_vendas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vendas` AS select `p`.`id_pedido` AS `id_pedido`,`p`.`created_at` AS `data_pedido`,sum(`t`.`valor`) AS `valor_pago` from (((`tbl_pagamento` `pg` join `tbl_pagamento_transacao` `t` on(`t`.`id_pagamento` = `pg`.`id_pagamento`)) join `tbl_pedidos` `p` on(`p`.`id_pedido` = `pg`.`id_pedido`)) join `dom_status_pagamento` `sp` on(`sp`.`id` = `t`.`status_id`)) where `sp`.`nome` in ('APROVADO','PAGO') group by `p`.`id_pedido`,`p`.`created_at` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_pontos_saldo`
--

/*!50001 DROP VIEW IF EXISTS `vw_pontos_saldo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_pontos_saldo` AS select `tbl_pontos_movimento`.`id_usuario` AS `id_usuario`,coalesce(sum(case when `tbl_pontos_movimento`.`tipo` = 'GANHO' then `tbl_pontos_movimento`.`pontos` when `tbl_pontos_movimento`.`tipo` = 'RESGATE' then -`tbl_pontos_movimento`.`pontos` when `tbl_pontos_movimento`.`tipo` = 'ESTORNO' then `tbl_pontos_movimento`.`pontos` else 0 end),0) AS `saldo` from `tbl_pontos_movimento` where `tbl_pontos_movimento`.`expira_em` is null or `tbl_pontos_movimento`.`expira_em` >= curdate() group by `tbl_pontos_movimento`.`id_usuario` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-28 10:48:00
