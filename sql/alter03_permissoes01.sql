SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `multiplicacao`.`permissions` CHANGE COLUMN `ID` `ID` BIGINT(20) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `multiplicacao`.`roles` CHANGE COLUMN `ID` `ID` BIGINT(20) NOT NULL AUTO_INCREMENT  ;

CREATE  TABLE IF NOT EXISTS `multiplicacao`.`roles_perm` (
  `ID` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `permID` BIGINT(20) NULL DEFAULT NULL ,
  `rolesID` BIGINT(20) NULL DEFAULT NULL ,
  `value` TINYINT(4) NULL DEFAULT NULL ,
  `addDate` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`ID`) ,
  INDEX `fk_roles_has_permissions_permissions1` (`permID` ASC) ,
  CONSTRAINT `fk_roles_has_permissions_roles1`
    FOREIGN KEY (`rolesID` )
    REFERENCES `multiplicacao`.`roles` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permissions_permissions1`
    FOREIGN KEY (`permID` )
    REFERENCES `multiplicacao`.`permissions` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

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
