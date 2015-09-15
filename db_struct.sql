-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `sddddd`;
CREATE DATABASE `sddddd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sddddd`;

DROP TABLE IF EXISTS `Nations_activity`;
CREATE TABLE `Nations_activity` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `NatID` int(10) NOT NULL,
  `Year` int(4) NOT NULL,
  `Month` int(2) NOT NULL,
  `Day` int(20) NOT NULL DEFAULT '1',
  `Date` int(20) NOT NULL,
  `Post_count` int(10) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`),
  KEY `Date` (`Date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Nations_activity_forums`;
CREATE TABLE `Nations_activity_forums` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(10) NOT NULL,
  `ForumID` int(10) NOT NULL,
  `Year` int(4) NOT NULL,
  `Month` int(2) NOT NULL,
  `Day` int(20) NOT NULL DEFAULT '1',
  `Post_count` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_culture`;
CREATE TABLE `Nations_culture` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `NatID` int(10) NOT NULL,
  `Date_uploaded` int(15) NOT NULL,
  `Comment` text NOT NULL,
  `File_name` tinytext NOT NULL,
  `File_type` tinytext NOT NULL,
  `File_size` int(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Nations_data`;
CREATE TABLE `Nations_data` (
  `NatID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Full_name` mediumtext CHARACTER SET latin1 NOT NULL,
  `Status` tinytext CHARACTER SET latin1 NOT NULL,
  `FAOF` int(50) NOT NULL,
  `Language` tinytext CHARACTER SET latin1 NOT NULL,
  `PPD` decimal(10,3) NOT NULL,
  `Act_IDOld` int(20) NOT NULL,
  `Act_IDNew` int(20) NOT NULL,
  `Flag_main` int(20) NOT NULL,
  `Flag_thumb` int(20) NOT NULL,
  `Deleted` set('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_descriptions`;
CREATE TABLE `Nations_descriptions` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `Desc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `IP` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Date` int(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_flags`;
CREATE TABLE `Nations_flags` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `File_name` tinytext NOT NULL,
  `Type` tinytext NOT NULL,
  `Area` tinytext NOT NULL,
  `Description` longtext NOT NULL,
  `Length_X` int(20) NOT NULL,
  `Length_Y` int(20) NOT NULL,
  `ThumbID` int(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Nations_forums`;
CREATE TABLE `Nations_forums` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `NatID` int(10) NOT NULL,
  `Forum` text NOT NULL,
  `Forum_Count` tinytext NOT NULL,
  `Forum_status` tinytext NOT NULL,
  `Type` tinytext NOT NULL,
  `Type_Count` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Nations_langs`;
CREATE TABLE `Nations_langs` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Code` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Entries` int(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_lang_ip`;
CREATE TABLE `Nations_lang_ip` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `IP` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Language` int(20) NOT NULL,
  `Manual` set('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `Last_Change` int(20) NOT NULL,
  `Last_Visit` int(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_lang_request`;
CREATE TABLE `Nations_lang_request` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Code` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Num` int(20) NOT NULL,
  `Date` int(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_lang_request_text`;
CREATE TABLE `Nations_lang_request_text` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Language` int(20) NOT NULL,
  `Text` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Date` int(20) NOT NULL,
  `Fixed` set('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_lang_text`;
CREATE TABLE `Nations_lang_text` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Text_Title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Language` int(20) NOT NULL,
  `Text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Used` int(20) NOT NULL,
  `Translator` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_modifications`;
CREATE TABLE `Nations_modifications` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `Type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Timestamp` int(20) NOT NULL,
  `Name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `IP` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Suggestion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Fixed` set('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_pronounce`;
CREATE TABLE `Nations_pronounce` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `Name` set('S','L') COLLATE utf8_unicode_ci NOT NULL,
  `IPA` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Sound_file` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_tags_data`;
CREATE TABLE `Nations_tags_data` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_tags_tagged`;
CREATE TABLE `Nations_tags_tagged` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `Tag_ID` int(20) NOT NULL,
  `Current` set('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `Date_Added` int(20) NOT NULL,
  `Date_Removed` int(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_updates`;
CREATE TABLE `Nations_updates` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `Date` int(20) NOT NULL,
  `Title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Link` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_websites`;
CREATE TABLE `Nations_websites` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `Address` mediumtext NOT NULL,
  `Status` tinytext NOT NULL,
  `Type` tinytext NOT NULL,
  `Flash_required` tinytext NOT NULL,
  `Language` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NatID` (`NatID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Nations_wikiarticles`;
CREATE TABLE `Nations_wikiarticles` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `NatID` int(20) NOT NULL,
  `WikiID` int(20) NOT NULL,
  `Link` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `Nations_wikis`;
CREATE TABLE `Nations_wikis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Link` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `First_Bit` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `Last_Bit` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2015-09-15 13:52:25
