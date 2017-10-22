CREATE DATABASE  IF NOT EXISTS `dbtcc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbtcc`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dbtcc
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `cdCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nmCategoria` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'LÓGICA'),(2,'ORGANIZAÇÃO E METODOS');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipe` (
  `cd_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `nm_equipe` varchar(45) NOT NULL,
  `pontos` int(11) NOT NULL,
  `token_partida` varchar(45) NOT NULL,
  `token_equipe` varchar(45) NOT NULL,
  `cd_lider` int(11) NOT NULL,
  PRIMARY KEY (`cd_equipe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipe`
--

LOCK TABLES `equipe` WRITE;
/*!40000 ALTER TABLE `equipe` DISABLE KEYS */;
INSERT INTO `equipe` VALUES (1,'equipe3',500,'2838023A','F7177163',4),(2,'equipe1',500,'2838023A','C20AD4D7',1),(3,'equipe2',500,'2838023A','182BE0C5',3);
/*!40000 ALTER TABLE `equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `cdGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nm_grupo` varchar(45) NOT NULL,
  `criado_por` int(11) NOT NULL,
  PRIMARY KEY (`cdGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (1,'1 ANO',5),(2,'2 ANO',5),(3,'3 ANO',5),(4,'4 ANO',5);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jogador`
--

DROP TABLE IF EXISTS `jogador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jogador` (
  `cd_usuario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `token_equipe` varchar(8) NOT NULL,
  KEY `cd_usuario_idx` (`cd_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jogador`
--

LOCK TABLES `jogador` WRITE;
/*!40000 ALTER TABLE `jogador` DISABLE KEYS */;
INSERT INTO `jogador` VALUES (6,'TESTE1','C20AD4D7'),(7,'TESTE2','C20AD4D7'),(8,'TESTE3','C20AD4D7'),(9,'TESTE4','182BE0C5'),(10,'TESTE5','182BE0C5'),(11,'TESTE6','182BE0C5'),(12,'TESTE7','F7177163'),(13,'TESTE8','F7177163'),(14,'TESTE9','F7177163'),(1,'GABRIEL FRANÇA','C20AD4D7'),(3,'KAUA','182BE0C5'),(4,'FELIPE','F7177163'),(14,'TESTE9','F7177163');
/*!40000 ALTER TABLE `jogador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida`
--

DROP TABLE IF EXISTS `partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida` (
  `cd_partida` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(8) NOT NULL,
  `cd_adm` int(11) NOT NULL,
  `qt_lideres` int(11) NOT NULL,
  `cd_grupo_perguntas` int(11) NOT NULL,
  `andamento` int(11) NOT NULL,
  PRIMARY KEY (`cd_partida`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
INSERT INTO `partida` VALUES (1,'2838023A',5,3,1,1);
/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pergunta` (
  `cdPergunta` int(11) NOT NULL AUTO_INCREMENT,
  `dsPergunta` varchar(600) DEFAULT NULL,
  `cdCategoria` int(11) NOT NULL,
  `dsResposta1` varchar(500) DEFAULT NULL,
  `dsResposta2` varchar(500) DEFAULT NULL,
  `dsResposta3` varchar(500) DEFAULT NULL,
  `dsResposta4` varchar(500) DEFAULT NULL,
  `correta` int(11) DEFAULT NULL,
  `add_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`cdPergunta`,`cdCategoria`),
  KEY `fk_Pergunta_Categorias1_idx` (`cdCategoria`),
  CONSTRAINT `fk_Pergunta_Categorias1` FOREIGN KEY (`cdCategoria`) REFERENCES `categorias` (`cdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pergunta`
--

LOCK TABLES `pergunta` WRITE;
/*!40000 ALTER TABLE `pergunta` DISABLE KEYS */;
INSERT INTO `pergunta` VALUES (1,'Três meninos estão andando de bicicleta. A bicicleta de um deles é azul, a do outro é preta, a do outro é branca. Eles vestem bermudas destas mesmas três cores, mas somente Artur está com bermuda de mesma cor que sua bicicleta. Nem\na bermuda nem a bicicledsPerguntaperguntata de Júlio são brancas. Marcos está com bermuda azul.\nDesse modo',1,'a bicicleta de Júlio é azul e a de Artur é preta.','a bicicleta de Marcos é branca e sua bermuda é preta.','a bermuda de Júlio é preta e a bicicleta de Artur é branca.','a bermuda de Artur é preta e a bicicleta de Marcos é branca.',3,5),(2,'Qual das seguintes palavras não se enquadra no grupo?',1,'Faca','Livro','Lápis','Bonito',4,5),(3,'Num jogo entre o Flamengo e o Corinthians, realizado no Estádio do Maracanã, 62.984 expectadores torciam pelo Flamengo e 49.296 torciam pelo Corinthians. Sabendo-se ainda que 26.830 pessoas torciam pelos dois times, pergunta-se quantos torcedores assistiram o jogo?',1,'112.280','89.814','76.126','85.450',4,5),(4,'A um condenado a morte, antes de ser executado, foi-lhe proposto o seguinte:\nQuatro lâmpadas apagadas coloridas (azul, verde, vermelha e amarela) lhe seriam apresentadas em uma caixa que nada se sabe sobre ela. Uma, mais que uma, todas ou nenhuma se acenderiam. Se ele adivinhasse a cor de uma lâmpada que acendesse, ele seria poupado da morte. O condenado ainda foi informado que as lâmpadas azul, verde e amarela só se acenderiam se a vermelha também se acendesse. Se você fosse o condenado, que cor de lâmpada você escolheria por achar mais provável acender?',1,'Azul ou vermelha.','Faria um sorteio aleatório das cores.','Vermelha.','Amarela ou verde.',3,5),(5,'Sabe-se que:\nDora tem 4 filhos e não é dentista;\nBeth é pedagoga;\nA mulher que tem 2 filhos é nutricionista;\nSandra não tem 3 filhos;\nLia é dentista ou tem 3 filhos.\nConsiderando-se que as 4 mulheres te quantidade de filhos e profissões diferentes, podemos afirmar que:',1,'Lia tem 3 filhos','Beth não tem 2 nem 4 filhos','Dora é dentista','Sandra não é nutricionista.',2,5),(6,'Ao final de uma corrida com 5 atletas, sabe-se que Antonio chegou depois de Carlos. Ricardo e Jurandir chegaram ao mesmo tempo. Dirceu chegou antes de Carlos.O corredor que ganhou, chegou sozinho.Quem ganhou a corrida?',1,'Antonio','Ricardo','Jurandir','Dirceu.',4,5),(7,'Suponha que todos os guardas são atletas e todos os atletas são esbeltos. Pode-se concluir que:',1,'José não é esbelto, José não é atleta','Paulo é esbelto, Paulo é atleta','Edson é atleta, Edson é guarda','Carlos não é guarda, Carlos não é esbelto.',1,5),(8,'De acordo com as proposições abaixo, qual das alternativas é a verdadeira?',1,'Vera não viajou e Carla não foi ao casa­mento.','Camile e Carla não foram ao casamento.','Carla não foi ao casamento e Vanderléia não viajou.','Vera e Vanderléia não viajaram.',4,5),(9,'As estatísticas indicam que os condutores do sexo masculino sofrem mais acidentes de automóvel que as condutoras. Podemos concluir que:',1,'Como sempre, os homens, típicos machistas, enganam-se na avaliação da perícia das condutoras;','Não há dados suficientes para retirar conclusões.','Os homens conduzem melhor, mas fazem-no com mais freqüência;','A maioria dos caminhoneiros são homens',2,5),(10,'Qual das seguintes palavras não se enquadra no grupo?',1,'Faca','Cão','Lápis','Garfo',1,5);
/*!40000 ALTER TABLE `pergunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perguntagrupo`
--

DROP TABLE IF EXISTS `perguntagrupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perguntagrupo` (
  `cd_perguntagrupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) DEFAULT NULL,
  `cd_grupo` int(11) DEFAULT NULL,
  `cd_pergunta` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_perguntagrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perguntagrupo`
--

LOCK TABLES `perguntagrupo` WRITE;
/*!40000 ALTER TABLE `perguntagrupo` DISABLE KEYS */;
INSERT INTO `perguntagrupo` VALUES (4,1,2,2),(5,2,2,3),(6,3,2,5),(28,4,2,9),(29,5,2,10),(30,6,2,8),(31,7,2,1),(32,8,2,7),(33,9,2,6),(34,10,2,4);
/*!40000 ALTER TABLE `perguntagrupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perguntamateria`
--

DROP TABLE IF EXISTS `perguntamateria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perguntamateria` (
  `cd_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `questao1` varchar(200) DEFAULT NULL,
  `questao2` varchar(200) DEFAULT NULL,
  `questao3` varchar(200) DEFAULT NULL,
  `somaresultado` int(11) DEFAULT NULL,
  `cd_categoria` int(11) DEFAULT NULL,
  `add_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`cd_pergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perguntamateria`
--

LOCK TABLES `perguntamateria` WRITE;
/*!40000 ALTER TABLE `perguntamateria` DISABLE KEYS */;
INSERT INTO `perguntamateria` VALUES (1,'Uma vez definida a Missão da Empresa ela será mantida até o fechamento da empresa. Já a Visão pode ser alterada','A Missão expressa onde e como a empresa espera obter lucros através da prestação de serviços','Na análise SWOT o crescimento Vertical caracteriza-se pelo aumento do número de empregados de um departamento',2,2,5),(2,'O analista de O&M deve focar o aumento da produção independentemente da limitação humana, pois o homem sempre é mais resistente do que pensa ser','Em uma empresa decadente a Visão deve retratar a situação de forma pessimista para mostrar a realidade','Organização é a atividade voltada para a utilização de recursos disponíveis para obter a eficácia do conjunto',4,2,5),(3,'Quando a empresa muda sua Visão deve alterar seus Princípios e Valores','Core Business é o negócio principal da empresa','Metas são valores quantificados para o cumprimento de desafios',6,2,5),(4,'A Organização e Métodos se preocupa não só com o “Por Que ?” mas também com o “Para Que ?”','A Visão deve ser definida pelo nível Operacional e conhecida por todos os níveis da empresa','Tanto a Missão quanto os Objetivos da empresa devem ser definidos pela alta administração',5,2,5),(5,'Efetuar o cálculo de lotação de pessoal é uma das funções do analista de O&M','Novos concorrentes podem se caracterizar uma Ameaça na análise SWOT','Na análise SWOT a situação de Vulnerabilidade é quando existe uma ameaça à vista, mas a empresa possui pontos fortes que podem amenizá-la',7,2,5),(6,'A estratégia da diferenciação visa diferenciar produtos ou serviços criando algo que seja considerado único','A análise de fatores políticos e econômicos pode identificar Oportunidades e Ameaças','Como objetivos estratégicos a empresa deve neutralizar ou eliminar as fraquezas que se apresentam no ambiente externo e captar as ameaças que possui',3,2,5),(7,'Escassez de matéria prima no mercado é uma fraqueza na análise SWOT','O Poder de Negociação dos Fornecedores é uma das 3 Estratégias Competitivas Genéricas de Porter','Como objetivos estratégicos a empresa deve neutralizar ou eliminar as fraquezas que se apresentam no ambiente externo e captar as ameaças que seus concorrentes possuem',0,2,5),(8,'Como objetivos estratégicos a empresa deve corrigir, eliminar ou esconder suas fraquezas e defender suas forças','A estratégia da diferenciação pode ocasionar grande diferença de custos entre a empresa diferenciada e os concorrentes','A situação financeira da empresa pode ser uma oportunidade ou uma ameaça dependendo se for boa ou ruim',3,2,5),(9,'A Rivalidade entre os concorrentes atuais é uma das 3 Estratégias Competitivas Genéricas de Porter','A ineficiência do pessoal de uma empresa concorrente pode ser considerada uma Oportunidade, dentro da análise SWOT',' Na Análise  SWOT  a situação de  RESTRIÇÃO  numa empresa caracteriza-se quando a empresa não tem estrutura para aproveitar uma oportunidade de crescimento',6,2,5),(10,' Na análise SWOT ser uma empresa desconhecida no mercado local pode ser considerado como Ameaça',' A imitação por parte da concorrência pode reduzir a diferenciação percebida, conforme a indústria amadurece','Dentro das situações encontradas numa análise SWOT podemos encontrar Alavanca, Problema, Segurança e Vulnerabilidade',2,2,5);
/*!40000 ALTER TABLE `perguntamateria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessao`
--

DROP TABLE IF EXISTS `sessao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessao` (
  `cd_sessao` int(11) NOT NULL AUTO_INCREMENT,
  `cd_usuario` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cd_sessao`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessao`
--

LOCK TABLES `sessao` WRITE;
/*!40000 ALTER TABLE `sessao` DISABLE KEYS */;
INSERT INTO `sessao` VALUES (1,5,1),(2,1,1),(3,3,1),(4,4,1),(5,6,1),(6,7,1),(7,8,1),(8,9,1),(9,10,1),(10,11,1),(11,12,1),(12,13,1),(13,14,1),(14,1,1),(15,5,1);
/*!40000 ALTER TABLE `sessao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `cd_tipoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tipoUsuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cd_tipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'PROFESSOR'),(2,'ALUNO');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nmUsuario` varchar(45) DEFAULT NULL,
  `password` int(6) DEFAULT NULL,
  `nmLogin` varchar(10) DEFAULT NULL,
  `cd_tipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`cdUsuario`,`cd_tipoUsuario`),
  KEY `fk_Usuario_Tipo_Usuario_idx` (`cd_tipoUsuario`),
  CONSTRAINT `fk_Usuario_Tipo_Usuario` FOREIGN KEY (`cd_tipoUsuario`) REFERENCES `tipo_usuario` (`cd_tipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'GABRIEL FRANÇA',123456,'gabriel',2),(2,'ROBSON',111111,'robson',2),(3,'KAUA',222222,'kaua',2),(4,'FELIPE',333333,'felipe',2),(5,'PROFESSOR',111111,'professor',1),(6,'TESTE1',111111,'teste1',2),(7,'TESTE2',111111,'teste2',2),(8,'TESTE3',111111,'teste3',2),(9,'TESTE4',111111,'teste4',2),(10,'TESTE5',111111,'teste5',2),(11,'TESTE6',111111,'teste6',2),(12,'TESTE7',111111,'teste7',2),(13,'TESTE8',111111,'teste8',2),(14,'TESTE9',111111,'teste9',2),(15,'TESTE9',111111,'teste10',2),(16,'TESTE9',111111,'teste11',2),(17,'TESTE9',111111,'teste12',2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-24 19:23:39
