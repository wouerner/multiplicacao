CREATE TABLE `Admissao` (
  `discipuloId` int(11) NOT NULL,
  `tipoAdmissao` int(11) NOT NULL,
  PRIMARY KEY (`discipuloId`,`tipoAdmissao`),
  UNIQUE KEY `discipuloId_UNIQUE` (`discipuloId`),
  KEY `fk_Discipulo_has_TipoAdmissao_TipoAdmissao1` (`tipoAdmissao`),
  KEY `fk_Admissao_Discipulo1` (`discipuloId`),
  CONSTRAINT `fk_Admissao_Discipulo1` FOREIGN KEY (`discipuloId`) REFERENCES `Discipulo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Discipulo_has_TipoAdmissao_TipoAdmissao1` FOREIGN KEY (`tipoAdmissao`) REFERENCES `TipoAdmissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8