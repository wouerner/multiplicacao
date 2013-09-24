-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2013 at 08:31 PM
-- Server version: 5.5.32-MariaDB
-- PHP Version: 5.4.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `multiplicacao`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admissao`
--

CREATE TABLE IF NOT EXISTS `Admissao` (
  `discipuloId` int(11) NOT NULL,
  `tipoAdmissao` int(11) NOT NULL,
  PRIMARY KEY (`discipuloId`,`tipoAdmissao`),
  UNIQUE KEY `discipuloId_UNIQUE` (`discipuloId`),
  KEY `fk_Discipulo_has_TipoAdmissao_TipoAdmissao1` (`tipoAdmissao`),
  KEY `fk_Admissao_Discipulo1` (`discipuloId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Avisos`
--

CREATE TABLE IF NOT EXISTS `Avisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emissor` int(11) NOT NULL,
  `tipoAvisoId` int(11) NOT NULL,
  `dataAviso` datetime NOT NULL,
  `identificacao` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emissor` (`emissor`),
  KEY `tipoAvisoId` (`tipoAvisoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=308 ;

-- --------------------------------------------------------

--
-- Table structure for table `Batismos`
--

CREATE TABLE IF NOT EXISTS `Batismos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipuloId` int(11) NOT NULL,
  `criadoEm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diploma` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `discipuloId` (`discipuloId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `Celula`
--

CREATE TABLE IF NOT EXISTS `Celula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `horarioFuncionamento` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `lider` int(11) DEFAULT NULL,
  `ativa` tinyint(1) NOT NULL DEFAULT '1',
  `tipoRedeId` int(11) DEFAULT NULL,
  `dataCriacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Celula_Discipulo2` (`lider`),
  KEY `tipoRedeId` (`tipoRedeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

-- --------------------------------------------------------

--
-- Table structure for table `Discipulo`
--

CREATE TABLE IF NOT EXISTS `Discipulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `sexo` char(1) DEFAULT 'm' COMMENT 'm -> Masculino\nf -> Feminino ',
  `estadoCivilId` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL COMMENT '	',
  `nivel` varchar(45) DEFAULT NULL,
  `lider` int(11) DEFAULT NULL,
  `celula` int(11) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `alcunha` varchar(30) NOT NULL,
  `observacao` text NOT NULL,
  `arquivo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_Discipulo_Discipulo` (`lider`),
  KEY `fk_Discipulo_Celula1` (`celula`),
  KEY `fk_Discipulo_EstadoCivil1` (`estadoCivilId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=539 ;

-- --------------------------------------------------------

--
-- Table structure for table `DiscipuloTemEvento`
--

CREATE TABLE IF NOT EXISTS `DiscipuloTemEvento` (
  `discipuloId` int(11) NOT NULL,
  `eventoId` int(11) NOT NULL,
  PRIMARY KEY (`discipuloId`,`eventoId`),
  KEY `fk_Discipulo_has_Evento_Evento1` (`eventoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EncontroComDeus`
--

CREATE TABLE IF NOT EXISTS `EncontroComDeus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8 NOT NULL,
  `dataEncontroComDeus` datetime NOT NULL,
  `endereco` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `Equipe`
--

CREATE TABLE IF NOT EXISTS `Equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `encontroComDeusId` int(11) NOT NULL,
  `tipoEquipeId` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `encontroComDeusId` (`encontroComDeusId`,`tipoEquipeId`),
  KEY `tipoEquipeId` (`tipoEquipeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `EquipeDiscipulos`
--

CREATE TABLE IF NOT EXISTS `EquipeDiscipulos` (
  `equipeId` int(11) NOT NULL,
  `discipuloId` int(11) NOT NULL,
  PRIMARY KEY (`equipeId`,`discipuloId`),
  KEY `discipuloId` (`discipuloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EstadoCivil`
--

CREATE TABLE IF NOT EXISTS `EstadoCivil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `Foto`
--

CREATE TABLE IF NOT EXISTS `Foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(80) CHARACTER SET utf8 NOT NULL,
  `discipuloId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `discipuloId_2` (`discipuloId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `Funcao`
--

CREATE TABLE IF NOT EXISTS `Funcao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `FuncaoRede`
--

CREATE TABLE IF NOT EXISTS `FuncaoRede` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `IntervaloMetas`
--

CREATE TABLE IF NOT EXISTS `IntervaloMetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dataInicio` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dataFim` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dataInicio` (`dataInicio`,`dataFim`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Metas`
--

CREATE TABLE IF NOT EXISTS `Metas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `discipuloId` int(11) NOT NULL,
  `intervaloMetasId` int(11) NOT NULL,
  `tipoRedeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discipuloId` (`discipuloId`,`intervaloMetasId`),
  KEY `intervaloMetasId` (`intervaloMetasId`),
  KEY `discipuloId_2` (`discipuloId`),
  KEY `tipoRedeId` (`tipoRedeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `Ministerio`
--

CREATE TABLE IF NOT EXISTS `Ministerio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `MinisterioTemDiscipulo`
--

CREATE TABLE IF NOT EXISTS `MinisterioTemDiscipulo` (
  `ministerioId` int(11) NOT NULL,
  `discipuloId` int(11) NOT NULL,
  `funcaoId` int(11) NOT NULL,
  PRIMARY KEY (`ministerioId`,`discipuloId`),
  KEY `fk_Ministerio_has_Discipulo_Discipulo1` (`discipuloId`),
  KEY `fk_MinisterioTemDiscipulo_Funcao1` (`funcaoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Oferta`
--

CREATE TABLE IF NOT EXISTS `Oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipuloId` int(11) NOT NULL,
  `tipoOfertaId` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Oferta_Discipulo1` (`discipuloId`),
  KEY `fk_Oferta_TipoOferta1` (`tipoOfertaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipacaoCelula`
--

CREATE TABLE IF NOT EXISTS `ParticipacaoCelula` (
  `relatorioCelulaId` int(11) NOT NULL,
  `discipuloId` int(11) NOT NULL,
  PRIMARY KEY (`relatorioCelulaId`,`discipuloId`),
  KEY `relatorioCelulaId` (`relatorioCelulaId`),
  KEY `discipuloId` (`discipuloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantesEncontro`
--

CREATE TABLE IF NOT EXISTS `ParticipantesEncontro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipuloId` int(11) NOT NULL,
  `encontroComDeusId` int(11) NOT NULL,
  `encontro` tinyint(1) NOT NULL DEFAULT '0',
  `preEncontro` tinyint(1) NOT NULL DEFAULT '0',
  `posEncontro` tinyint(1) NOT NULL DEFAULT '0',
  `desistiu` tinyint(1) NOT NULL DEFAULT '0',
  `igrejaLocal` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `discipuloId` (`discipuloId`),
  KEY `encontroComDeusId` (`encontroComDeusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantesMetas`
--

CREATE TABLE IF NOT EXISTS `ParticipantesMetas` (
  `metasId` int(11) NOT NULL,
  `discipuloId` int(11) NOT NULL,
  `dataInicio` datetime NOT NULL,
  PRIMARY KEY (`metasId`,`discipuloId`),
  KEY `discipuloId` (`discipuloId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `permKey` varchar(45) DEFAULT NULL,
  `permName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `PreEquipe`
--

CREATE TABLE IF NOT EXISTS `PreEquipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipuloId` int(11) NOT NULL,
  `encontroComDeusId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discipuloId` (`discipuloId`,`encontroComDeusId`),
  KEY `encontroComDeusId` (`encontroComDeusId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Redes`
--

CREATE TABLE IF NOT EXISTS `Redes` (
  `discipuloId` int(11) NOT NULL,
  `tipoRedeId` int(11) NOT NULL,
  `funcaoRedeId` int(11) NOT NULL,
  PRIMARY KEY (`discipuloId`,`tipoRedeId`),
  UNIQUE KEY `discipuloId` (`discipuloId`),
  KEY `fk_TipoRede_has_Discipulo_Discipulo1` (`discipuloId`),
  KEY `fk_Redes_FuncaoRede1` (`funcaoRedeId`),
  KEY `fk_TipoRede_has_Discipulo_TipoRede1` (`tipoRedeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RelatorioCelula`
--

CREATE TABLE IF NOT EXISTS `RelatorioCelula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataEnvio` datetime NOT NULL,
  `texto` text COLLATE latin1_general_ci NOT NULL,
  `titulo` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `lider` int(11) NOT NULL,
  `celulaId` int(11) NOT NULL,
  `temaRelatorioCelulaId` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `lider` (`lider`),
  KEY `celulaId` (`celulaId`),
  KEY `temaRelatorioCelulaId` (`temaRelatorioCelulaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=528 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `role_perms`
--

CREATE TABLE IF NOT EXISTS `role_perms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `permID` int(11) DEFAULT NULL,
  `roleID` int(11) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL,
  `addDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_permissions_has_roles_roles1` (`roleID`),
  KEY `fk_permissions_has_roles_permissions1` (`permID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `StatusCelular`
--

CREATE TABLE IF NOT EXISTS `StatusCelular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipuloId` int(11) NOT NULL,
  `tipoStatusCelular` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_StatusCelular_TipoStatusCelular1` (`tipoStatusCelular`),
  KEY `fk_StatusCelular_Discipulo1` (`discipuloId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1331 ;

-- --------------------------------------------------------

--
-- Table structure for table `TemaRelatorioCelula`
--

CREATE TABLE IF NOT EXISTS `TemaRelatorioCelula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `dataInicio` datetime NOT NULL,
  `dataFim` datetime NOT NULL,
  `ativo` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoAdmissao`
--

CREATE TABLE IF NOT EXISTS `TipoAdmissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoAviso`
--

CREATE TABLE IF NOT EXISTS `TipoAviso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `controlador` varchar(45) NOT NULL,
  `acao` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mensagem` varchar(45) NOT NULL,
  `link` varchar(45) NOT NULL,
  `icone` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoEquipe`
--

CREATE TABLE IF NOT EXISTS `TipoEquipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoOferta`
--

CREATE TABLE IF NOT EXISTS `TipoOferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoRede`
--

CREATE TABLE IF NOT EXISTS `TipoRede` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoStatusCelular`
--

CREATE TABLE IF NOT EXISTS `TipoStatusCelular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` text NOT NULL,
  `ordem` int(11) NOT NULL,
  `cor` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_perms`
--

CREATE TABLE IF NOT EXISTS `user_perms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `permID` int(11) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL,
  `addDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_Discipulo_has_permissions_permissions1` (`permID`),
  KEY `fk_Discipulo_has_permissions_Discipulo1` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `addDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`,`roleID`),
  KEY `fk_Discipulo_has_roles_roles1` (`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admissao`
--
ALTER TABLE `Admissao`
  ADD CONSTRAINT `fk_Admissao_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Discipulo_has_TipoAdmissao_TipoAdmissao1` FOREIGN KEY (`tipoAdmissao`) REFERENCES `TipoAdmissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Avisos`
--
ALTER TABLE `Avisos`
  ADD CONSTRAINT `Avisos_ibfk_1` FOREIGN KEY (`emissor`) REFERENCES `Discipulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Avisos_ibfk_2` FOREIGN KEY (`tipoAvisoId`) REFERENCES `TipoAviso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Batismos`
--
ALTER TABLE `Batismos`
  ADD CONSTRAINT `Batismos_ibfk_1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`);

--
-- Constraints for table `Celula`
--
ALTER TABLE `Celula`
  ADD CONSTRAINT `Celula_ibfk_1` FOREIGN KEY (`tipoRedeId`) REFERENCES `TipoRede` (`id`),
  ADD CONSTRAINT `fk_Celula_Discipulo2` FOREIGN KEY (`lider`) REFERENCES `Discipulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Discipulo`
--
ALTER TABLE `Discipulo`
  ADD CONSTRAINT `fk_Discipulo_Celula1` FOREIGN KEY (`celula`) REFERENCES `Celula` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Discipulo_Discipulo` FOREIGN KEY (`lider`) REFERENCES `Discipulo` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Discipulo_EstadoCivil1` FOREIGN KEY (`estadoCivilId`) REFERENCES `EstadoCivil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `DiscipuloTemEvento`
--
ALTER TABLE `DiscipuloTemEvento`
  ADD CONSTRAINT `fk_Discipulo_has_Evento_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Discipulo_has_Evento_Evento1` FOREIGN KEY (`eventoId`) REFERENCES `Evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Equipe`
--
ALTER TABLE `Equipe`
  ADD CONSTRAINT `Equipe_ibfk_1` FOREIGN KEY (`encontroComDeusId`) REFERENCES `EncontroComDeus` (`id`),
  ADD CONSTRAINT `Equipe_ibfk_2` FOREIGN KEY (`tipoEquipeId`) REFERENCES `TipoEquipe` (`id`);

--
-- Constraints for table `EquipeDiscipulos`
--
ALTER TABLE `EquipeDiscipulos`
  ADD CONSTRAINT `EquipeDiscipulos_ibfk_1` FOREIGN KEY (`equipeId`) REFERENCES `Equipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `EquipeDiscipulos_ibfk_2` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`);

--
-- Constraints for table `Foto`
--
ALTER TABLE `Foto`
  ADD CONSTRAINT `Foto_ibfk_1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Metas`
--
ALTER TABLE `Metas`
  ADD CONSTRAINT `Metas_ibfk_1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Metas_ibfk_2` FOREIGN KEY (`intervaloMetasId`) REFERENCES `IntervaloMetas` (`id`),
  ADD CONSTRAINT `Metas_ibfk_3` FOREIGN KEY (`tipoRedeId`) REFERENCES `TipoRede` (`id`);

--
-- Constraints for table `MinisterioTemDiscipulo`
--
ALTER TABLE `MinisterioTemDiscipulo`
  ADD CONSTRAINT `fk_MinisterioTemDiscipulo_Funcao1` FOREIGN KEY (`funcaoId`) REFERENCES `Funcao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Ministerio_has_Discipulo_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Ministerio_has_Discipulo_Ministerio1` FOREIGN KEY (`ministerioId`) REFERENCES `Ministerio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Oferta`
--
ALTER TABLE `Oferta`
  ADD CONSTRAINT `fk_Oferta_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Oferta_TipoOferta1` FOREIGN KEY (`tipoOfertaId`) REFERENCES `TipoOferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ParticipacaoCelula`
--
ALTER TABLE `ParticipacaoCelula`
  ADD CONSTRAINT `ParticipacaoCelula_ibfk_2` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ParticipacaoCelula_ibfk_3` FOREIGN KEY (`relatorioCelulaId`) REFERENCES `RelatorioCelula` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ParticipantesEncontro`
--
ALTER TABLE `ParticipantesEncontro`
  ADD CONSTRAINT `ParticipantesEncontro_ibfk_1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`),
  ADD CONSTRAINT `ParticipantesEncontro_ibfk_2` FOREIGN KEY (`encontroComDeusId`) REFERENCES `EncontroComDeus` (`id`);

--
-- Constraints for table `ParticipantesMetas`
--
ALTER TABLE `ParticipantesMetas`
  ADD CONSTRAINT `ParticipantesMetas_ibfk_2` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`),
  ADD CONSTRAINT `ParticipantesMetas_ibfk_3` FOREIGN KEY (`metasId`) REFERENCES `Metas` (`id`);

--
-- Constraints for table `PreEquipe`
--
ALTER TABLE `PreEquipe`
  ADD CONSTRAINT `PreEquipe_ibfk_1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`),
  ADD CONSTRAINT `PreEquipe_ibfk_2` FOREIGN KEY (`encontroComDeusId`) REFERENCES `EncontroComDeus` (`id`);

--
-- Constraints for table `Redes`
--
ALTER TABLE `Redes`
  ADD CONSTRAINT `fk_Redes_FuncaoRede1` FOREIGN KEY (`funcaoRedeId`) REFERENCES `FuncaoRede` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TipoRede_has_Discipulo_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TipoRede_has_Discipulo_TipoRede1` FOREIGN KEY (`tipoRedeId`) REFERENCES `TipoRede` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `RelatorioCelula`
--
ALTER TABLE `RelatorioCelula`
  ADD CONSTRAINT `RelatorioCelula_ibfk_1` FOREIGN KEY (`lider`) REFERENCES `Discipulo` (`id`),
  ADD CONSTRAINT `RelatorioCelula_ibfk_3` FOREIGN KEY (`temaRelatorioCelulaId`) REFERENCES `TemaRelatorioCelula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `RelatorioCelula_ibfk_4` FOREIGN KEY (`celulaId`) REFERENCES `Celula` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_perms`
--
ALTER TABLE `role_perms`
  ADD CONSTRAINT `fk_permissions_has_roles_permissions1` FOREIGN KEY (`permID`) REFERENCES `permissions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissions_has_roles_roles1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `StatusCelular`
--
ALTER TABLE `StatusCelular`
  ADD CONSTRAINT `fk_StatusCelular_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_StatusCelular_TipoStatusCelular1` FOREIGN KEY (`tipoStatusCelular`) REFERENCES `TipoStatusCelular` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_perms`
--
ALTER TABLE `user_perms`
  ADD CONSTRAINT `fk_Discipulo_has_permissions_Discipulo1` FOREIGN KEY (`userID`) REFERENCES `Discipulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Discipulo_has_permissions_permissions1` FOREIGN KEY (`permID`) REFERENCES `permissions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `fk_Discipulo_has_roles_Discipulo1` FOREIGN KEY (`userID`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Discipulo_has_roles_roles1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
