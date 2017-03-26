CREATE DATABASE `scalemanager_eventlog`;
USE `scalemanager_eventlog`;
CREATE TABLE `history` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp` INT UNSIGNED NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `instance` VARCHAR(255) NOT NULL,
  `value` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `Query` (`timestamp` ASC, `type` ASC, `instance` ASC)
);
