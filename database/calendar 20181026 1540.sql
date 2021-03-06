﻿--
-- Script was generated by Devart dbForge Studio for MySQL, Version 8.0.40.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 10/26/2018 3:40:51 PM
-- Server version: 5.6.34-log
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE calendar;

--
-- Drop table `events`
--
DROP TABLE IF EXISTS events;

--
-- Set default database
--
USE calendar;

--
-- Create table `events`
--
CREATE TABLE events (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  description text NOT NULL,
  color varchar(7) NOT NULL DEFAULT '#3a87ad',
  start datetime NOT NULL,
  end datetime DEFAULT NULL,
  allDay varchar(50) NOT NULL DEFAULT 'true',
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 6,
AVG_ROW_LENGTH = 4096,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

-- 
-- Dumping data for table events
--
INSERT INTO events VALUES
(1, 'event pertama', 'ini event pertama', '#3a87ad', '2018-10-01 00:00:00', '2018-10-04 00:00:00', 'true'),
(2, 'event dua', 'ini event kedua', '#3a87ad', '2018-10-25 00:00:00', '2018-10-27 00:00:00', 'true'),
(3, 'dasda', 'dasda', '#3a87ad', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'true'),
(5, 'tengah malam', 'midnight sale', '#731b1b', '2018-10-04 00:00:00', '2018-10-04 00:00:00', 'true');

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;