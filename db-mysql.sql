-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2015 at 01:56 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ff_renan`
--
CREATE DATABASE IF NOT EXISTS `ff_renan` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ff_renan`;

-- --------------------------------------------------------

--
-- Table structure for table `bandas`
--

CREATE TABLE IF NOT EXISTS `bandas` (
  `id` tinyint(2) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá um Identificador para cada banda, que irá facilitar a busca de dados da mesma.',
  `datas_id` tinyint(2) unsigned zerofill NOT NULL COMMENT 'Conterá o ID das datas, para que possa se ter conhecimento de qual  banda tocara em qual dia.',
  `nome` varchar(21) NOT NULL COMMENT 'Conterá o nome da banda.',
  `descricao` text NOT NULL COMMENT 'Conterá uma breve descrição da banda.',
  `url_imagem` text NOT NULL COMMENT 'Conterá o URL da imagem da banda ou de seu logo(imagem desejada).',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_bandas_datas1` (`datas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `canceladas`
--

CREATE TABLE IF NOT EXISTS `canceladas` (
  `id` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá o identificador do canselamento da solicitação de ingressos.',
  `motivo` char(1) NOT NULL COMMENT 'Conterá um breve motivo do por que foi canselada a solicitação em questao.',
  `permissao_usuario` tinyint(1) NOT NULL COMMENT 'Será utilizado para reconhecer quem canselou a reserva, o ADM ou o próprio cliente (0,1), para melhor identificação.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá o Identificador do Cliente, facilitando a busca de dados.',
  `usuarios_id` int(6) unsigned zerofill NOT NULL COMMENT 'Chave estrangeira que conterá o identificador de cada usuário. Para melhor organização.',
  `nome` varchar(30) NOT NULL COMMENT 'Será o nome completo do usuário, utilizado para reconhecimento do mesmo.',
  `nascimento` date NOT NULL COMMENT 'Conterá a data de nascimento do usuario, para verificar sua idade.',
  `tipo_doc` char(1) NOT NULL COMMENT 'Conterá a escolha de um tipo de documento, realizado pelo usuário, e este afetara indiretamente o num_doc.( Documento escolido foi o RG, consequentemente os dados do num_doc são do RG )',
  `email` varchar(78) NOT NULL COMMENT 'Conterá um dos meios, e-mail do cliente, de contato Admin com Cliente caso seja nescessário.',
  `telefone` bigint(14) unsigned NOT NULL COMMENT 'Conterá um dos meios, telefone do cliente, de contato Admin co Cliente caso seja nescessário.',
  `num_doc` varchar(12) NOT NULL COMMENT 'Este compo irá receber o número do documento selecionado pelo usuario que irá auxiliar na confirmação de sua identificação.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_clientes_usuarios` (`usuarios_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `usuarios_id`, `nome`, `nascimento`, `tipo_doc`, `email`, `telefone`, `num_doc`) VALUES
(000004, 000014, 'Cliente Solicitado', '2014-12-04', '2', 'ClienteSolicitado@clin.com', 4734201412, '20141204');

-- --------------------------------------------------------

--
-- Table structure for table `datas`
--

CREATE TABLE IF NOT EXISTS `datas` (
  `id` tinyint(2) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá o Identificador da data, facilitanto a identificação da mesma.',
  `dia` date NOT NULL COMMENT 'Conterá a data em que o festival irá ocorrer.',
  `descricao` text NOT NULL COMMENT 'Conterá uma breve descrição do que ocorrerá na data e os horarios de inicio e termino do festival.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iddatas_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `ingressosdisponiveis`
--

CREATE TABLE IF NOT EXISTS `ingressosdisponiveis` (
  `id` tinyint(2) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá o Identificador da quantidade total dos ingressos disponivel por dia.',
  `datas_id` tinyint(2) unsigned zerofill NOT NULL COMMENT 'Conterá o Identificador da data, facilitanto a identificação de qual dia cada ingresso estará disponivel.',
  `valor_vip` decimal(5,2) unsigned NOT NULL COMMENT 'Conterá o valor dos ingressos vips disponives para a data selecionada.',
  `valor_normal` decimal(5,2) unsigned NOT NULL COMMENT 'Conterá o valor dos ingressos normais disponives para a data desejada.',
  `qtde_normal` int(5) unsigned NOT NULL COMMENT 'Conterá a quantidade total dos ingressos normais disponives para a data desejada.',
  `qtde_vip` int(5) unsigned NOT NULL COMMENT 'Conterá a quantidade total dos ingressos vips disponives para a data selecionada.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_ingressosdisponiveis_datas1` (`datas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `patrocinadores`
--

CREATE TABLE IF NOT EXISTS `patrocinadores` (
  `id` tinyint(2) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá o Identificador do Patrocinio, para facilitar a busca de dados.',
  `nome` varchar(10) NOT NULL COMMENT 'Conterá o nome do patrocinio.',
  `url_logo` text NOT NULL COMMENT 'Conterá a imagem da logo do patrocinio em questão.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `codigo` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Será o codigo identificador da reserva solicitada.',
  `clientes_id` int(6) unsigned zerofill NOT NULL COMMENT 'A chave estrangeira conterá o Identificador do Cliente, facilitando a busca e o armazenamento de dados. Para que possa reconhecer quem fez a reserva.',
  `ingressosdisponiveis_id` tinyint(2) unsigned zerofill NOT NULL COMMENT 'O campo estrangeiro conterá o Identificador da quantidade total dos ingressos disponivel por dia. Para melhor organização da tabela. Para saber se a reserva é ''valida''.',
  `qtde_vip` tinyint(1) unsigned NOT NULL COMMENT 'Será a quantidade desejada de ingressos VIPs solicitados em cada reserva.',
  `qtde_normal` tinyint(1) unsigned NOT NULL COMMENT 'Conterá a quantidade desejada de ingressos normais solicitados naquela reserva.',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `idreservas_UNIQUE` (`codigo`),
  KEY `fk_reservas_clientes1` (`clientes_id`),
  KEY `fk_reservas_ingressosdisponiveis1` (`ingressosdisponiveis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Conterá um identificador criado para cada usuário. Para melhor organização.',
  `login` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Conterá um conjunto de caracteres definido pelo usuário, no qual ele consiga entrar em sua conta.',
  `senha` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Conterá um conjunto de caracteres escolido pelo usuário, ''secreto'' e este irá permitir, junto com o nome, se ele pode logar(se a conta existe).',
  `permissao` tinyint(1) unsigned NOT NULL COMMENT 'Conterá uma maneira de identificar, distinguir, um usuário cliente de um usuário administrador.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `permissao`) VALUES
(000014, 'cliente', 'cc03e747a6afbbcbf8be7668acfebee5', 1),
(000031, 'admin', 'cc03e747a6afbbcbf8be7668acfebee5', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ingressosdisponiveis`
--
ALTER TABLE `ingressosdisponiveis`
  ADD CONSTRAINT `fk_ingressosdisponiveis_datas1` FOREIGN KEY (`datas_id`) REFERENCES `datas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_ingressosdisponiveis1` FOREIGN KEY (`ingressosdisponiveis_id`) REFERENCES `ingressosdisponiveis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
