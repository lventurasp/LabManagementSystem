-- MySQL Script generated by MySQL Workbench
-- lun 13 feb 2023 15:57:29
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `Email` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(45) NULL,
  `Laboratory` VARCHAR(45) NULL,
  `Name` VARCHAR(45) NULL,
  `Surname` VARCHAR(45) NULL,
  `Lastlogin` DATETIME NULL,
  PRIMARY KEY (`Email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Privilege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Privilege` (
  `Priviledge` VARCHAR(45) NOT NULL,
  `Priviledge_type` ENUM("read and write reagents", "read reagents", "build placements") NULL,
  `Laboratory` VARCHAR(45) NULL,
  PRIMARY KEY (`Priviledge`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Placement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Placement` (
  `idPlacement` VARCHAR(45) NOT NULL,
  `Type` ENUM("Fridge", "Freezer", "Shelf") NULL,
  `Number` INT NULL,
  PRIMARY KEY (`idPlacement`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Reagents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Reagents` (
  `idReagents` VARCHAR(45) NOT NULL,
  `Name` VARCHAR(45) NULL,
  `Label` VARCHAR(45) NULL,
  `Reference` VARCHAR(45) NULL,
  `Stock` INT NULL,
  `Shelf` INT NULL,
  `Box` INT NULL,
  `Link` VARCHAR(45) NULL,
  `User_Email` VARCHAR(45) NOT NULL,
  `Placement_idPlacement` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idReagents`, `User_Email`, `Placement_idPlacement`),
  INDEX `fk_Reagents_User1_idx` (`User_Email` ASC) VISIBLE,
  INDEX `fk_Reagents_Placement1_idx` (`Placement_idPlacement` ASC) VISIBLE,
  CONSTRAINT `fk_Reagents_User1`
    FOREIGN KEY (`User_Email`)
    REFERENCES `mydb`.`User` (`Email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reagents_Placement1`
    FOREIGN KEY (`Placement_idPlacement`)
    REFERENCES `mydb`.`Placement` (`idPlacement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Partition_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Partition_type` (
  `idPartition_type` VARCHAR(45) NOT NULL,
  `Shelves` INT NULL,
  `Box` INT NULL,
  PRIMARY KEY (`idPartition_type`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Placement_has_Partition_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Placement_has_Partition_type` (
  `Placement_idPlacement` VARCHAR(45) NOT NULL,
  `Partition_type_idPartition_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Placement_idPlacement`, `Partition_type_idPartition_type`),
  INDEX `fk_Placement_has_Partition type_Partition type1_idx` (`Partition_type_idPartition_type` ASC) VISIBLE,
  INDEX `fk_Placement_has_Partition type_Placement1_idx` (`Placement_idPlacement` ASC) VISIBLE,
  CONSTRAINT `fk_Placement_has_Partition type_Placement1`
    FOREIGN KEY (`Placement_idPlacement`)
    REFERENCES `mydb`.`Placement` (`idPlacement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Placement_has_Partition type_Partition type1`
    FOREIGN KEY (`Partition_type_idPartition_type`)
    REFERENCES `mydb`.`Partition_type` (`idPartition_type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`User_has_Priviledge`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`User_has_Priviledge` (
  `User_Email` VARCHAR(45) NOT NULL,
  `Priviledge_Priviledge` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`User_Email`, `Priviledge_Priviledge`),
  INDEX `fk_User_has_Priviledge_Priviledge1_idx` (`Priviledge_Priviledge` ASC) VISIBLE,
  INDEX `fk_User_has_Priviledge_User1_idx` (`User_Email` ASC) VISIBLE,
  CONSTRAINT `fk_User_has_Priviledge_User1`
    FOREIGN KEY (`User_Email`)
    REFERENCES `mydb`.`User` (`Email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Priviledge_Priviledge1`
    FOREIGN KEY (`Priviledge_Priviledge`)
    REFERENCES `mydb`.`Privilege` (`Priviledge`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
