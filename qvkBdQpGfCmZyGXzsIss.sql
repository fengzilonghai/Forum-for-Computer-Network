-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2013 年 12 月 26 日 11:09

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `qvkBdQpGfCmZyGXzsIss`
--

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `tid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `f_topic` varchar(15) NOT NULL,
  `s_topic` varchar(15) NOT NULL,
  `author_name` varchar(10) NOT NULL,
  `post_time` varchar(10) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_content` varchar(1000) NOT NULL,
  `reply_count` int(10) NOT NULL DEFAULT '0',
  `last_reply_un` varchar(15) DEFAULT NULL,
  `last_reply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `replys`
--

CREATE TABLE IF NOT EXISTS `replys` (
  `reply_id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `tid` mediumint(10) NOT NULL,
  `reply_to` mediumint(15) NOT NULL,
  `reply_username` varchar(15) NOT NULL,
  `reply_content` varchar(1000) NOT NULL,
  `reply_time` varchar(15) NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `f_topic` varchar(15) NOT NULL,
  `s_topic` varchar(15) NOT NULL,
  `s_topic_zh` varchar(40) NOT NULL,
  PRIMARY KEY (`s_topic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `topics`
--

INSERT INTO `topics` (`f_topic`, `s_topic`, `s_topic_zh`) VALUES
('link', 'ppp', 'PPP协议'),
('link', 'csmacd', 'CSMA/CD协议'),
('network', 'ip', 'IP协议'),
('application', 'ftp', 'FTP协议'),
('network', 'rip', 'RIP协议'),
('network', 'ospf', 'OSPF协议'),
('transport', 'tcp', 'TCP协议'),
('transport', 'udp', 'UDP协议'),
('application', 'http', 'HTTP协议'),
('application', 'smtp', 'SMTP协议');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(40) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'avatar_sample.jpg',
  `regtime` int(10) NOT NULL,
  `token` varchar(40) NOT NULL,
  `email_verified` int(1) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
