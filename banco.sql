-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.5.46-0ubuntu0.14.04.2 - (Ubuntu)
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para banco
CREATE DATABASE IF NOT EXISTS `banco` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `banco`;


-- Copiando estrutura para tabela banco.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` enum('M','F') COLLATE utf8_unicode_ci NOT NULL,
  `cpf` char(14) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `telefone2` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco_cep` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `endereco_numero` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco_complemento` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela banco.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__servico` (`id_servico`),
  KEY `FK__cliente` (`id_cliente`),
  CONSTRAINT `FK__cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `FK__servico` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela banco.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela banco.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Inserindo usuário para testes.
INSERT INTO `usuario` (nome, senha) VALUES ('tester', md5('1234'));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
