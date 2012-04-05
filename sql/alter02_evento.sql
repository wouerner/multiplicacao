SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `multiplicacao`.`Discipulo` DROP FOREIGN KEY `fk_Discipulo_Discipulo` ;

ALTER TABLE `multiplicacao`.`Discipulo` 
  ADD CONSTRAINT `fk_Discipulo_Discipulo`
  FOREIGN KEY (`lider` )
  REFERENCES `multiplicacao`.`Discipulo` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

CREATE  TABLE IF NOT EXISTS `multiplicacao`.`Evento` (
  `id` INT(11) NOT NULL ,
  `nome` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `multiplicacao`.`DiscipuloTemEvento` (
  `discipuloId` INT(11) NOT NULL ,
  `eventoId` INT(11) NOT NULL ,
  PRIMARY KEY (`discipuloId`, `eventoId`) ,
  INDEX `fk_Discipulo_has_Evento_Evento1` (`eventoId` ASC) ,
  CONSTRAINT `fk_Discipulo_has_Evento_Discipulo1`
    FOREIGN KEY (`discipuloId` )
    REFERENCES `multiplicacao`.`Discipulo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Discipulo_has_Evento_Evento1`
    FOREIGN KEY (`eventoId` )
    REFERENCES `multiplicacao`.`Evento` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
