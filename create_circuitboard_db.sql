SET NAMES utf8mb4;
SET TIME_ZONE='+00:00';

--CREATES DATABASE
CREATE DATABASE IF NOT EXISTS `coursework_db` COLLATE 'utf8_unicode_ci';

--GRANTING USER PRIVILEGES
GRANT SELECT, INSERT, UPDATE ON coursework_db.* TO 'coursework_user'@'localhost' IDENTIFIED BY 'letmein';

--Table for board status
--Drop table if it exists already and create the database
DROP TABLE IF EXISTS `board_status`;
CREATE TABLE `board_status` (
  `board_id` int(4) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `date` varchar(22) NOT NULL,
  `switch1` enum('Off', 'On') NOT NULL,
  `switch2` enum('Off', 'On') NOT NULL,
  `switch3` enum('Off', 'On') NOT NULL,
  `switch4` enum('Off', 'On') NOT NULL,
  `fan` enum('Forward', 'Reverse') NOT NULL,
  `temperature` FLOAT(10,2) NOT NULL,
  `keypad` int(1) NOT NULL,
  PRIMARY KEY(`board_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;


