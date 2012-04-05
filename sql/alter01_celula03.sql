SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `multiplicacao`.`Celula` DROP FOREIGN KEY `fk_Celula_Discipulo1` ;

ALTER TABLE `multiplicacao`.`Discipulo` DROP COLUMN `celula` , ADD COLUMN `celula` INT(11) NULL DEFAULT NULL  AFTER `lider` , 
  ADD CONSTRAINT `fk_Discipulo_Celula1`
  FOREIGN KEY (`celula` )
  REFERENCES `multiplicacao`.`Celula` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_Discipulo_Celula1` (`celula` ASC) ;

ALTER TABLE `multiplicacao`.`Celula` DROP COLUMN `lider` , ADD COLUMN `Discipulo_id` INT(11) NOT NULL  AFTER `endereco` , 
  ADD CONSTRAINT `fk_Celula_Discipulo2`
  FOREIGN KEY (`Discipulo_id` )
  REFERENCES `multiplicacao`.`Discipulo` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_Celula_Discipulo2` (`Discipulo_id` ASC) 
, DROP INDEX `fk_Celula_Discipulo1` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
