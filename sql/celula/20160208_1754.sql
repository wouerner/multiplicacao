ALTER TABLE `multiplicacao`.`Celula` 
ADD COLUMN `colider` INT NULL COMMENT '' AFTER `multiplicacao`,
ADD INDEX `fk_Celula_1_idx` (`colider` ASC)  COMMENT '';
ALTER TABLE `multiplicacao`.`Celula` 
ADD CONSTRAINT `fk_Celula_1`
  FOREIGN KEY (`colider`)
  REFERENCES `multiplicacao`.`Discipulo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;