-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 10 月 15 日 21:34
-- 服务器版本: 5.1.33
-- PHP 版本: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `fanrong`
--

-- --------------------------------------------------------

--
-- 表的结构 `fr_product_image`
--

CREATE TABLE IF NOT EXISTS `fr_product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(140) NOT NULL,
  `height` smallint(6) DEFAULT NULL,
  `width` smallint(6) DEFAULT NULL,
  `pid` int(11) NOT NULL COMMENT '产品id',
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid_2` (`pid`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `fr_product_image`
--

INSERT INTO `fr_product_image` (`id`, `uri`, `height`, `width`, `pid`, `order`) VALUES
(1, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, 0),
(2, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 1, 0),
(6, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(7, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(8, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(9, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(10, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL);

--
-- 限制导出的表
--

--
-- 限制表 `fr_product_image`
--
ALTER TABLE `fr_product_image`
  ADD CONSTRAINT `fr_product_image_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `fr_product` (`id`);
