ALTER TABLE `multiplicacao`.`Igreja` 
ADD COLUMN `sede` TINYINT(1) NULL COMMENT 'Coluna para verificar se a igreja é sede, 0 = não ou 1 = sim.' AFTER `nome`;

ALTER TABLE `multiplicacao`.`Igreja` 
CHANGE COLUMN `sede` `sede` TINYINT(1) NULL DEFAULT 0 COMMENT 'Coluna para verificar se a igreja é sede, 0 = não ou 1 = sim.' ;
