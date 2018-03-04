-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: dbpc1520172
-- ------------------------------------------------------
-- Server version	5.6.10-log

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
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (8,'Delícias ao Leite'),(9,'Delícias Boa Forma'),(10,'Delícias de Inverno'),(11,'Delícias do Verão');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cidade` (
  `idCidade` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCidade` varchar(255) NOT NULL,
  `idEstado` int(11) NOT NULL,
  PRIMARY KEY (`idCidade`),
  KEY `fk_cid_estad_idx` (`idEstado`),
  CONSTRAINT `fk_cid_estad` FOREIGN KEY (`idEstado`) REFERENCES `tbl_estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contato`
--

DROP TABLE IF EXISTS `tbl_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contato` (
  `idContato` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(15) NOT NULL,
  PRIMARY KEY (`idContato`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contato`
--

LOCK TABLES `tbl_contato` WRITE;
/*!40000 ALTER TABLE `tbl_contato` DISABLE KEYS */;
INSERT INTO `tbl_contato` VALUES (1,'011 1234-5678');
/*!40000 ALTER TABLE `tbl_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_endereco` (
  `idEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL,
  `cep` varchar(14) NOT NULL,
  `idCidade` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idTipoEndereco` int(11) NOT NULL,
  PRIMARY KEY (`idEndereco`),
  KEY `fk_end_cid_idx` (`idCidade`),
  KEY `fk_end_estad_idx` (`idEstado`),
  KEY `fk_tip_idx` (`idTipoEndereco`),
  CONSTRAINT `fk_end_cid` FOREIGN KEY (`idCidade`) REFERENCES `tbl_cidade` (`idCidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_end_estad` FOREIGN KEY (`idEstado`) REFERENCES `tbl_estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tip` FOREIGN KEY (`idTipoEndereco`) REFERENCES `tbl_tipo_endereco` (`idTipoEndereco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEstado` varchar(255) NOT NULL,
  `sigla` char(2) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fconosco`
--

DROP TABLE IF EXISTS `tbl_fconosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fconosco` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(110) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homePage` varchar(100) DEFAULT NULL,
  `linkFacebook` varchar(100) DEFAULT NULL,
  `infoProdutos` varchar(100) DEFAULT NULL,
  `sexo` varchar(10) NOT NULL,
  `profissao` varchar(45) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fconosco`
--

LOCK TABLES `tbl_fconosco` WRITE;
/*!40000 ALTER TABLE `tbl_fconosco` DISABLE KEYS */;
INSERT INTO `tbl_fconosco` VALUES (4,'João Victor','011 1234-5678','011 1234-5678','joao@uol.com','teste','teste','teste','Masculino','teste','teste');
/*!40000 ALTER TABLE `tbl_fconosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_importancia`
--

DROP TABLE IF EXISTS `tbl_importancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_importancia` (
  `idImportancia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idImportancia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_importancia`
--

LOCK TABLES `tbl_importancia` WRITE;
/*!40000 ALTER TABLE `tbl_importancia` DISABLE KEYS */;
INSERT INTO `tbl_importancia` VALUES (1,',kryk','rykuryk467ik','arquivos/5779a2c5efecaa6c45833f93794286e1.jpg',NULL),(2,'h24t','5h24ht24h','arquivos/b16e21785bcdd2394b3e2a77de0f8eaa.jpg',NULL),(3,'6y89p´ç970´p','yoçy','arquivos/b0f57554d99bfcabf2e092162b7efb48.jpg',NULL);
/*!40000 ALTER TABLE `tbl_importancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_moda_verao`
--

DROP TABLE IF EXISTS `tbl_moda_verao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_moda_verao` (
  `idModaVerao` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `ingrediente` varchar(255) NOT NULL,
  `modoPreparo` text NOT NULL,
  `beneficio` text NOT NULL,
  PRIMARY KEY (`idModaVerao`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_moda_verao`
--

LOCK TABLES `tbl_moda_verao` WRITE;
/*!40000 ALTER TABLE `tbl_moda_verao` DISABLE KEYS */;
INSERT INTO `tbl_moda_verao` VALUES (32,'arquivos/4a86bbb9b0811e4e1b2fa6d4d538375f.png','Suco de Beterraba','fethqeth','wrgeqhg','eafgqet'),(33,'arquivos/b0f57554d99bfcabf2e092162b7efb48.jpg','Suco de Kiwii','geqhet','trgqertrgrg','rteyq');
/*!40000 ALTER TABLE `tbl_moda_verao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivel`
--

DROP TABLE IF EXISTS `tbl_nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nivel` (
  `idNivel` int(11) NOT NULL AUTO_INCREMENT,
  `nomeNivel` varchar(100) NOT NULL,
  `admConteudo` tinyint(1) NOT NULL,
  `admFaleConosco` tinyint(1) NOT NULL,
  `admProduto` tinyint(1) NOT NULL,
  `admUsuario` tinyint(1) NOT NULL,
  PRIMARY KEY (`idNivel`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivel`
--

LOCK TABLES `tbl_nivel` WRITE;
/*!40000 ALTER TABLE `tbl_nivel` DISABLE KEYS */;
INSERT INTO `tbl_nivel` VALUES (2,'Administrador',1,1,1,1),(3,'Cataloguista',0,0,1,0),(4,'Operador Básico',1,1,0,1);
/*!40000 ALTER TABLE `tbl_nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(100) NOT NULL,
  `nomeProduto` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `idSubcategoria` int(11) NOT NULL,
  `clickProduto` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProduto`),
  KEY `fk_subcat_idx` (`idSubcategoria`),
  CONSTRAINT `fk_subcat` FOREIGN KEY (`idSubcategoria`) REFERENCES `tbl_subcategoria` (`idSubcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (60,'arquivos/23a6a6f019e446235d9251e7bf1939c4.png','Suco de Limão','Limonada Suíça',10.00,17,10),(61,'arquivos/dfcab91bfa562f46aa2830fbf9b5c11c.png','Suco de Amora e Laranja','Novo produto',10.00,18,1),(62,'arquivos/3447d82699ba346be7e1957cb1dfb57b.png','Suco de Frutas Vermelhas','Amora, Morango e Laranja',10.00,18,6),(63,'arquivos/1b3c33aa9fb6f6c9962f1264cfeaf244.png','Suco de Morango','Ótimo para o verão',10.00,18,9),(64,'arquivos/cf75ceb29197f57b19dcb8b4757368e8.png','Suco de Laranja','Laranjas de qualidade',10.00,19,5),(65,'arquivos/4b96d5c1ff312eea069ddc760794963d.png','Suco de Abacaxi','Abacaxi com Hortelã',10.00,20,2),(66,'arquivos/ad85912179ea5ebd4855be4d0e51c74a.png','Suco de Mirtilo e Banana','wqrgqethqet',10.00,12,4),(67,'arquivos/8f7cafbdaeb563435083ce7145b5d361.png','Suco de Morango e Banana','Morango, Banana e Leite ninho',10.00,13,6),(69,'arquivos/9e2501934d067d71bb1c5850722a73d1.png','Suco de Maracujá','rsrsrsrsrs',10.00,14,3),(71,'arquivos/b7603f4e4506e628ea2ff403b1129fd9.png','Suco de Mamão','thq4ethqethqegqeghqgrfertgq3',10.00,15,4),(72,'arquivos/1a868182fce986fe0701a2d5c593acbf.png','Suco de Cenoura','cenorex',10.00,2,4),(73,'arquivos/3a2d5d0c39d62fa9d61e53e7415e3c85.jpg','Suco de Tomate','Tomate Italiano',10.00,3,2),(74,'arquivos/1617c3ea98beb222d99397a8cc971362.png','Suco de Couve com Limão','Detox',10.00,4,19),(75,'arquivos/b16e21785bcdd2394b3e2a77de0f8eaa.png','Suco de Manga','mangaaaaa',10.00,5,0),(76,'arquivos/c15a13fc600e5aaedf48f6253d6f7354.jpg','Shake de Abacate','Milk Shake sem glúten',10.00,6,1),(77,'arquivos/427af70e53d885f4e63596ba6a3368fd.png','Vitamina de Mamão e Laranja','Vitaminex',10.00,11,3);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subcategoria` (
  `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(255) NOT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubcategoria`),
  KEY `fk_cat_idx` (`idCategoria`),
  CONSTRAINT `fk_cat` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategoria`
--

LOCK TABLES `tbl_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` VALUES (2,'Repor Energias',9),(3,'Padrão Academia',9),(4,'Sucos Detox',9),(5,'Sucos Light',9),(6,'Shakes',8),(9,'Escolha até 5 frutas',8),(10,'Especial 3 frutas',8),(11,'Vitaminas',8),(12,'Leite Condensado',10),(13,'Leite Ninho',10),(14,'Inverno Saboroso',10),(15,'Típicas da Estação',10),(17,'Cítricas',11),(18,'Frutas Vermelhas',11),(19,'Calor Intenso',11),(20,'Refrescantes',11),(37,'Frutas Verdes',11);
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_endereco`
--

DROP TABLE IF EXISTS `tbl_tipo_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_endereco` (
  `idTipoEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idTipoEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_endereco`
--

LOCK TABLES `tbl_tipo_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tipo_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `idNivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_user_level_idx` (`idNivel`),
  CONSTRAINT `fk_user_level` FOREIGN KEY (`idNivel`) REFERENCES `tbl_nivel` (`idNivel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (20,'João Victor','admin','123',2),(26,'Marcel Teixeira','marcel','123',3);
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

-- Dump completed on 2017-12-13 10:44:02
