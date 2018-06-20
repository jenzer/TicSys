# create database
CREATE DATABASE IF NOT EXISTS ticsys;

# switch to new database
use ticsys;

# add table for faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text,
  `state` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Add user
GRANT ALL ON ticsys.* TO sysuser@localhost IDENTIFIED BY "dU3BdUej";