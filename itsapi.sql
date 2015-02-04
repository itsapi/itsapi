-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

DROP DATABASE IF EXISTS `itsapi`;
CREATE DATABASE `itsapi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `itsapi`;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `cid` int(4) NOT NULL AUTO_INCREMENT,
  `pid` int(4) NOT NULL,
  `uid` int(4) NOT NULL,
  `date` int(32) NOT NULL,
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `fid` int(4) NOT NULL AUTO_INCREMENT,
  `uid1` int(4) NOT NULL,
  `uid2` int(4) NOT NULL,
  `acc1` tinyint(1) NOT NULL DEFAULT '0',
  `acc2` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `iid` int(4) NOT NULL AUTO_INCREMENT,
  `uid` int(4) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT 'Untitled',
  `date` int(32) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `lid` int(4) NOT NULL AUTO_INCREMENT,
  `uid` int(4) NOT NULL,
  `id` int(4) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `mid` int(4) NOT NULL AUTO_INCREMENT,
  `message` varchar(400) NOT NULL,
  `date` int(32) NOT NULL,
  `uidFrom` int(4) NOT NULL,
  `uidTo` int(4) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `nid` int(4) NOT NULL AUTO_INCREMENT,
  `uid` int(4) NOT NULL,
  `date` int(32) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `pid` int(4) NOT NULL AUTO_INCREMENT,
  `uid` int(4) NOT NULL,
  `date` int(32) NOT NULL,
  `content` varchar(2000) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `town` text,
  `county` text,
  `country` text,
  `postCode` varchar(10) DEFAULT NULL,
  `iid` int(4) DEFAULT NULL,
  `verify` varchar(30) DEFAULT NULL,
  `privacy` int(1) NOT NULL DEFAULT '1',
  `emailNotifications` tinyint(1) NOT NULL DEFAULT '1',
  `lastActivity` int(11) NOT NULL,
  `passReset` varchar(30) DEFAULT NULL,
  `changeEmail` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-02-04 14:43:28
