SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `multiplicacao`.`Discipulo` CHANGE COLUMN `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `multiplicacao`.`roles_perm` 
DROP INDEX `fk_roles_has_permissions_roles1` ;

CREATE  TABLE IF NOT EXISTS `multiplicacao`.`user_perm` (
  `ID` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `userID` BIGINT(20) NULL DEFAULT NULL ,
  `permID` BIGINT(20) NULL DEFAULT NULL ,
  `value` TINYINT(4) NULL DEFAULT NULL ,
  `addDate` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`ID`) ,
  INDEX `fk_Discipulo_has_permissions_permissions1` (`permID` ASC) ,
  CONSTRAINT `fk_Discipulo_has_permissions_Discipulo1`
    FOREIGN KEY (`userID` )
    REFERENCES `multiplicacao`.`Discipulo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Discipulo_has_permissions_permissions1`
    FOREIGN KEY (`permID` )
    REFERENCES `multiplicacao`.`permissions` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `multiplicacao`.`user_roles` (
  `userID` BIGINT(20) NULL DEFAULT NULL ,
  `roleID` BIGINT(20) NULL DEFAULT NULL ,
  `addDate` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`userID`, `roleID`) ,
  INDEX `fk_Discipulo_has_roles_roles1` (`roleID` ASC) ,
  CONSTRAINT `fk_Discipulo_has_roles_Discipulo1`
    FOREIGN KEY (`userID` )
    REFERENCES `multiplicacao`.`Discipulo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Discipulo_has_roles_roles1`
    FOREIGN KEY (`roleID` )
    REFERENCES `multiplicacao`.`roles` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

DROP TABLE IF EXISTS `multiplicacao`.`Oferta` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
