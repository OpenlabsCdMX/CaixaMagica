-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema caixa_magica
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `caixa_magica` ;

-- -----------------------------------------------------
-- Schema caixa_magica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `caixa_magica` DEFAULT CHARACTER SET utf8 ;
USE `caixa_magica` ;

-- -----------------------------------------------------
-- Table `caixa_magica`.`Caixa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Caixa` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Caixa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `fecha_ini` DATE NULL DEFAULT NULL,
  `fecha_fin` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`Asunto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Asunto` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Asunto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `texto` LONGTEXT NOT NULL,
  `Caixa_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Asunto_Caixa1`
    FOREIGN KEY (`Caixa_id`)
    REFERENCES `caixa_magica`.`Caixa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Asunto_Caixa1_idx` ON `caixa_magica`.`Asunto` (`Caixa_id` ASC);


-- -----------------------------------------------------
-- Table `caixa_magica`.`OpcionAbierta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`OpcionAbierta` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`OpcionAbierta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `texto` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`OpcionMultiple`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`OpcionMultiple` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`OpcionMultiple` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `texto` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`OpcionPila`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`OpcionPila` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`OpcionPila` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `texto` VARCHAR(255) NOT NULL,
  `votos` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`Comentario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Comentario` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `texto` LONGTEXT NOT NULL,
  `votos` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`Asunto_has_opciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Asunto_has_opciones` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Asunto_has_opciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Asunto_id` INT NOT NULL,
  `OpcionAbierta_id` INT NULL,
  `OpcionMultiple_id` INT NULL,
  `OpcionPila_id` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Asunto_has_OpcionAbierta_Asunto`
    FOREIGN KEY (`Asunto_id`)
    REFERENCES `caixa_magica`.`Asunto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asunto_has_OpcionAbierta_OpcionAbierta1`
    FOREIGN KEY (`OpcionAbierta_id`)
    REFERENCES `caixa_magica`.`OpcionAbierta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asunto_has_OpcionPila`
    FOREIGN KEY (`OpcionPila_id`)
    REFERENCES `caixa_magica`.`OpcionPila` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asunto_has_OpcionMultiple`
    FOREIGN KEY (`OpcionMultiple_id`)
    REFERENCES `caixa_magica`.`OpcionMultiple` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Asunto_has_OpcionAbierta_OpcionAbierta1_idx` ON `caixa_magica`.`Asunto_has_opciones` (`OpcionAbierta_id` ASC);

CREATE INDEX `fk_Asunto_has_OpcionAbierta_Asunto_idx` ON `caixa_magica`.`Asunto_has_opciones` (`Asunto_id` ASC);

CREATE INDEX `fk_Asunto_has_OpcionPila_idx` ON `caixa_magica`.`Asunto_has_opciones` (`OpcionPila_id` ASC);

CREATE INDEX `fk_Asunto_has_OpcionMultiple_idx` ON `caixa_magica`.`Asunto_has_opciones` (`OpcionMultiple_id` ASC);


-- -----------------------------------------------------
-- Table `caixa_magica`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`TipoDato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`TipoDato` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`TipoDato` (
  `id` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `caixa_magica`.`Atributo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Atributo` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Atributo` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `tipo` INT NOT NULL,
  `limite` INT NULL DEFAULT 0,
  `obligatorio` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Atributo_TipoDato1`
    FOREIGN KEY (`tipo`)
    REFERENCES `caixa_magica`.`TipoDato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Atributo_TipoDato1_idx` ON `caixa_magica`.`Atributo` (`tipo` ASC);


-- -----------------------------------------------------
-- Table `caixa_magica`.`Usuario_has_Atributo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Usuario_has_Atributo` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Usuario_has_Atributo` (
  `Usuario_id` INT NOT NULL,
  `Atributo_id` INT NOT NULL,
  PRIMARY KEY (`Usuario_id`, `Atributo_id`),
  CONSTRAINT `fk_Usuario_has_Atributo_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `caixa_magica`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Atributo_Atributo1`
    FOREIGN KEY (`Atributo_id`)
    REFERENCES `caixa_magica`.`Atributo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_has_Atributo_Atributo1_idx` ON `caixa_magica`.`Usuario_has_Atributo` (`Atributo_id` ASC);

CREATE INDEX `fk_Usuario_has_Atributo_Usuario1_idx` ON `caixa_magica`.`Usuario_has_Atributo` (`Usuario_id` ASC);


-- -----------------------------------------------------
-- Table `caixa_magica`.`OpcionAbierta_has_Comentario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`OpcionAbierta_has_Comentario` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`OpcionAbierta_has_Comentario` (
  `OpcionAbierta_id` INT NOT NULL,
  `Comentario_id` INT NOT NULL,
  PRIMARY KEY (`OpcionAbierta_id`, `Comentario_id`),
  CONSTRAINT `fk_OpcionAbierta_has_Comentario_OpcionAbierta1`
    FOREIGN KEY (`OpcionAbierta_id`)
    REFERENCES `caixa_magica`.`OpcionAbierta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OpcionAbierta_has_Comentario_Comentario1`
    FOREIGN KEY (`Comentario_id`)
    REFERENCES `caixa_magica`.`Comentario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_OpcionAbierta_has_Comentario_Comentario1_idx` ON `caixa_magica`.`OpcionAbierta_has_Comentario` (`Comentario_id` ASC);

CREATE INDEX `fk_OpcionAbierta_has_Comentario_OpcionAbierta1_idx` ON `caixa_magica`.`OpcionAbierta_has_Comentario` (`OpcionAbierta_id` ASC);


-- -----------------------------------------------------
-- Table `caixa_magica`.`Respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `caixa_magica`.`Respuestas` ;

CREATE TABLE IF NOT EXISTS `caixa_magica`.`Respuestas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Usuario_id` INT NOT NULL,
  `OpcionPila_id` INT NULL,
  `OpcionAbierta_id` INT NULL,
  `OpcionMultiple_id` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Usuario_has_OpcionPila_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `caixa_magica`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_OpcionPila_OpcionPila1`
    FOREIGN KEY (`OpcionPila_id`)
    REFERENCES `caixa_magica`.`OpcionPila` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Respuestas_opcionMultiple`
    FOREIGN KEY (`OpcionMultiple_id`)
    REFERENCES `caixa_magica`.`OpcionMultiple` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Respuestas_OpcionAbierta`
    FOREIGN KEY (`OpcionAbierta_id`)
    REFERENCES `caixa_magica`.`OpcionAbierta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_has_OpcionPila_OpcionPila1_idx` ON `caixa_magica`.`Respuestas` (`OpcionPila_id` ASC);

CREATE INDEX `fk_Usuario_has_OpcionPila_Usuario1_idx` ON `caixa_magica`.`Respuestas` (`Usuario_id` ASC);

CREATE INDEX `fk_Respuestas_opcionMultiple_idx` ON `caixa_magica`.`Respuestas` (`OpcionMultiple_id` ASC);

CREATE INDEX `fk_Respuestas_OpcionAbierta_idx` ON `caixa_magica`.`Respuestas` (`OpcionAbierta_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `caixa_magica`.`Caixa`
-- -----------------------------------------------------
START TRANSACTION;
USE `caixa_magica`;
INSERT INTO `caixa_magica`.`Caixa` (`id`, `nombre`, `fecha_ini`, `fecha_fin`) VALUES (1, 'Te invitamos a compartir tu punto de vista', 'null', 'null');

COMMIT;


---- -----------------------------------------------------
---- Data for table `caixa_magica`.`Asunto`
---- -----------------------------------------------------
--START TRANSACTION;
--USE `caixa_magica`;
--INSERT INTO `caixa_magica`.`Asunto` (`id`, `texto`, `Caixa_id`) VALUES (1, '¿Qué te llevas de ciudades que aprenden?', 1);
--INSERT INTO `caixa_magica`.`Asunto` (`id`, `texto`, `Caixa_id`) VALUES (2, '¿Qué harías diferente en un próximo laboratorio ciudadano?', 1);
--INSERT INTO `caixa_magica`.`Asunto` (`id`, `texto`, `Caixa_id`) VALUES (3, '¿Cómo mejorarías la experiencia de uso de Caixa Mágica?', 1);
--INSERT INTO `caixa_magica`.`Asunto` (`id`, `texto`, `Caixa_id`) VALUES (4, '¿Estás enamorado de alguien de ciudades que aprenden?', 1);--

--COMMIT;--
--

---- -----------------------------------------------------
---- Data for table `caixa_magica`.`OpcionAbierta`
---- -----------------------------------------------------
--START TRANSACTION;
--USE `caixa_magica`;
--INSERT INTO `caixa_magica`.`OpcionAbierta` (`id`, `texto`) VALUES (1, 'Me llevo...');
--INSERT INTO `caixa_magica`.`OpcionAbierta` (`id`, `texto`) VALUES (2, 'Yo haría...');
--INSERT INTO `caixa_magica`.`OpcionAbierta` (`id`, `texto`) VALUES (3, 'La mejoraría...');--

--COMMIT;--
--

---- -----------------------------------------------------
---- Data for table `caixa_magica`.`OpcionMultiple`
---- -----------------------------------------------------
--START TRANSACTION;
--USE `caixa_magica`;
--INSERT INTO `caixa_magica`.`OpcionMultiple` (`id`, `texto`) VALUES (1, 'Si');
--INSERT INTO `caixa_magica`.`OpcionMultiple` (`id`, `texto`) VALUES (2, 'No');
--INSERT INTO `caixa_magica`.`OpcionMultiple` (`id`, `texto`) VALUES (3, 'Tal vez');--

--COMMIT;--
--

---- -----------------------------------------------------
---- Data for table `caixa_magica`.`OpcionPila`
---- -----------------------------------------------------
--START TRANSACTION;
--USE `caixa_magica`;
--INSERT INTO `caixa_magica`.`OpcionPila` (`id`, `texto`, `votos`) VALUES (1, 'Monetariamente', 0);
--INSERT INTO `caixa_magica`.`OpcionPila` (`id`, `texto`, `votos`) VALUES (2, 'No se pueden reparar', 0);
--INSERT INTO `caixa_magica`.`OpcionPila` (`id`, `texto`, `votos`) VALUES (3, 'Las FARC deben ir a la carcel', 0);--

--COMMIT;


---- -----------------------------------------------------
---- Data for table `caixa_magica`.`Asunto_has_opciones`
---- -----------------------------------------------------
--START TRANSACTION;
--USE `caixa_magica`;
--INSERT INTO `caixa_magica`.`Asunto_has_opciones` (`id`, `Asunto_id`, `OpcionAbierta_id`, `OpcionMultiple_id`, `OpcionPila_id`) VALUES (1, 1, 1, NULL, NULL);
--INSERT INTO `caixa_magica`.`Asunto_has_opciones` (`id`, `Asunto_id`, `OpcionAbierta_id`, `OpcionMultiple_id`, `OpcionPila_id`) VALUES (2, 2, 2, NULL, NULL);
--INSERT INTO `caixa_magica`.`Asunto_has_opciones` (`id`, `Asunto_id`, `OpcionAbierta_id`, `OpcionMultiple_id`, `OpcionPila_id`) VALUES (3, 3, 3, NULL, NULL);
--INSERT INTO `caixa_magica`.`Asunto_has_opciones` (`id`, `Asunto_id`, `OpcionAbierta_id`, `OpcionMultiple_id`, `OpcionPila_id`) VALUES (4, 4, NULL, 1, NULL);
--INSERT INTO `caixa_magica`.`Asunto_has_opciones` (`id`, `Asunto_id`, `OpcionAbierta_id`, `OpcionMultiple_id`, `OpcionPila_id`) VALUES (5, 4, NULL, 2, NULL);
--INSERT INTO `caixa_magica`.`Asunto_has_opciones` (`id`, `Asunto_id`, `OpcionAbierta_id`, `OpcionMultiple_id`, `OpcionPila_id`) VALUES (6, 4, NULL, 3, NULL);--

--COMMIT;


-- -----------------------------------------------------
-- Data for table `caixa_magica`.`TipoDato`
-- -----------------------------------------------------
START TRANSACTION;
USE `caixa_magica`;
INSERT INTO `caixa_magica`.`TipoDato` (`id`, `tipo`) VALUES (1, 'INT');
INSERT INTO `caixa_magica`.`TipoDato` (`id`, `tipo`) VALUES (2, 'VARCHAR');
INSERT INTO `caixa_magica`.`TipoDato` (`id`, `tipo`) VALUES (3, 'DATE');

COMMIT;
