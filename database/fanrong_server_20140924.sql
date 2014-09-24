-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014-09-24 07:06:29
-- 服务器版本: 5.5.38-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `fanrong`
--

-- --------------------------------------------------------

--
-- 表的结构 `fr_manicurist`
--

CREATE TABLE IF NOT EXISTS `fr_manicurist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` char(15) NOT NULL COMMENT '登录用户名',
  `nick_name` char(15) NOT NULL COMMENT '昵称',
  `password` char(32) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别：1（女），2（男）。默认：1',
  `mobile_phone` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `register_date` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态：1（正常），0（冻结）',
  `remark` varchar(40) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='美甲师（商家）' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fr_user`
--

CREATE TABLE IF NOT EXISTS `fr_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` char(15) NOT NULL,
  `nick_name` varchar(15) NOT NULL COMMENT '昵称',
  `password` char(32) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别：1（男），2（女）。默认：1',
  `email` varchar(25) NOT NULL,
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `avatar_uri` varchar(50) DEFAULT NULL COMMENT '头像地址',
  `register_date` datetime DEFAULT NULL COMMENT '注册时间',
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次登录时间',
  `last_ip` char(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1（正常），0（冻结），-1（删除）',
  `level` smallint(6) NOT NULL DEFAULT '1' COMMENT '等级：1（普通用户）...',
  `remark` varchar(40) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fr_user`
--

INSERT INTO `fr_user` (`id`, `user_name`, `nick_name`, `password`, `gender`, `email`, `address`, `avatar_uri`, `register_date`, `last_login`, `last_ip`, `status`, `level`, `remark`) VALUES
(2, 'root', 'root', '202cb962ac59075b964b07152d234b70', 1, 'test', NULL, NULL, '2014-09-24 14:00:00', '2014-09-24 05:50:21', NULL, 1, 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
