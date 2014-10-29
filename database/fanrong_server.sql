-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 10 月 29 日 17:04
-- 服务器版本: 5.1.33
-- PHP 版本: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `fanrong`
--

-- --------------------------------------------------------

--
-- 表的结构 `fr_admin`
--

CREATE TABLE IF NOT EXISTS `fr_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` char(40) NOT NULL,
  `nick_name` char(20) NOT NULL,
  `psd` char(32) NOT NULL,
  `level` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `fr_admin`
--

INSERT INTO `fr_admin` (`id`, `user_name`, `nick_name`, `psd`, `level`) VALUES
(1, '123', '', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- 表的结构 `fr_banner_image`
--

CREATE TABLE IF NOT EXISTS `fr_banner_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(50) NOT NULL,
  `cre_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL DEFAULT '1',
  `link` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `fr_banner_image`
--


-- --------------------------------------------------------

--
-- 表的结构 `fr_circle`
--

CREATE TABLE IF NOT EXISTS `fr_circle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(400) NOT NULL,
  `thumb_image` varchar(140) NOT NULL,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  `cre_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` smallint(6) NOT NULL DEFAULT '1' COMMENT '类型，1：已发表，2：精华，0：未发表，-1：已删除',
  `hit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 导出表中的数据 `fr_circle`
--

INSERT INTO `fr_circle` (`id`, `uid`, `title`, `content`, `thumb_image`, `width`, `height`, `cre_date`, `type`, `hit`) VALUES
(1, 123, '十款轻熟女美甲图片 甜美清新不夸张', '这款美甲用不规则的图案表现出个性，大胆的撞色却不会有违和感，而且带着一丝俏皮可爱。如果你也是这张个性的女生，可不要错过这款美甲。', '', 0, 0, '0000-00-00 00:00:00', 1, 0),
(19, 1, '0', '0', '/assets/res/circle_images20141015222814149.png', 0, 0, '2014-10-15 22:28:14', 1, 0),
(32, 1, '0', '鍦堝瓙娴嬭瘯鍐呭', '', 0, 0, '2014-10-20 21:00:22', 1, 0),
(33, 1, '0', '鍦堝瓙娴嬭瘯鍐呭', '', 0, 0, '2014-10-20 21:06:01', 1, 0),
(34, 4, '0', '鍦堝瓙娴嬭瘯鍐呭', '', 0, 0, '2014-10-20 21:13:35', 1, 0),
(35, 4, '0', '鍦堝瓙娴嬭瘯鍐呭', '', 0, 0, '2014-10-20 21:14:47', 1, 0),
(36, 4, 'title', '鍦堝瓙娴嬭瘯鍐呭', '', 0, 0, '2014-10-20 21:15:31', 1, 0),
(37, 4, 'title', '鍦堝瓙娴嬭瘯鍐呭', '/assets/res/circle_images/20141020211622464.jpg', 0, 0, '2014-10-20 21:16:22', 1, 0),
(38, 4, 'title', '鍦堝瓙娴嬭瘯鍐呭', '/assets/res/circle_images/20141020213701441.jpg', 0, 0, '2014-10-20 21:37:02', 1, 0),
(41, 4, 'title', '鍦堝瓙娴嬭瘯鍐呭', '/assets/res/circle_images/201410/20141029130723472.png', 520, 280, '2014-10-29 13:07:23', 1, 0),
(42, 4, 'title', '鍦堝瓙娴嬭瘯鍐呭', '/assets/res/circle_images/201410/20141029131142465.png', 520, 280, '2014-10-29 13:11:42', 1, 0),
(43, 4, 'title', '鍦堝瓙娴嬭瘯鍐呭', '/assets/res/circle_images/201410/20141029131236496.png', 520, 280, '2014-10-29 13:12:36', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fr_circle_comment`
--

CREATE TABLE IF NOT EXISTS `fr_circle_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comments` varchar(50) NOT NULL,
  `cre_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 导出表中的数据 `fr_circle_comment`
--

INSERT INTO `fr_circle_comment` (`id`, `cid`, `uid`, `comments`, `cre_date`) VALUES
(1, 1, 10, '这个不错啊！！', '0000-00-00 00:00:00'),
(2, 1, 10, '这个不错啊！！', '2014-10-10 10:50:15'),
(4, 1, 9, 'GOOD！！', '2014-10-10 10:50:15'),
(6, 1, 4, '测试', '2014-10-18 20:59:20'),
(7, 1, 4, '测试', '2014-10-18 21:00:27'),
(8, 1, 4, '测试', '2014-10-18 21:01:25'),
(9, 1, 4, '测试21', '2014-10-18 21:01:49'),
(10, 1, 4, '测试', '2014-10-18 21:52:34'),
(11, 1, 4, '测试呵呵', '2014-10-19 19:36:00');

-- --------------------------------------------------------

--
-- 表的结构 `fr_circle_image`
--

CREATE TABLE IF NOT EXISTS `fr_circle_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(140) NOT NULL,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  `cid` int(11) NOT NULL,
  `order` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `c_id` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 导出表中的数据 `fr_circle_image`
--

INSERT INTO `fr_circle_image` (`id`, `uri`, `width`, `height`, `cid`, `order`) VALUES
(18, '/assets/res/circle_images/20141020211622464.jpg', 0, 0, 37, 1),
(19, '/assets/res/circle_images/20141020213701441.jpg', 0, 0, 38, 1),
(20, '/assets/res/circle_images/201410/20141029131236496.png', 520, 280, 43, 1),
(21, '/assets/res/circle_images/201410/2014102913520782.png', 520, 280, 43, 2),
(22, '/assets/res/circle_images/201410/20141029135220435.png', 520, 280, 43, 2),
(23, '/assets/res/circle_images/201410/20141029140206479.png', 520, 280, 43, 2);

-- --------------------------------------------------------

--
-- 表的结构 `fr_exp_pancat_file_information`
--

-- --------------------------------------------------------

--
-- 表的结构 `fr_label`
--

CREATE TABLE IF NOT EXISTS `fr_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `fr_label`
--

INSERT INTO `fr_label` (`id`, `name`) VALUES
(2, '光疗系列'),
(5, '彩绘系列'),
(3, '水晶系列'),
(1, '甲油系列'),
(6, '美甲专用笔'),
(4, '饰品系列');

-- --------------------------------------------------------

--
-- 表的结构 `fr_product`
--

CREATE TABLE IF NOT EXISTS `fr_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `thumb_image` varchar(140) NOT NULL,
  `image_width` smallint(6) NOT NULL,
  `image_height` smallint(6) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '美甲师 ID',
  `original_price` float NOT NULL,
  `price` float NOT NULL,
  `describe` varchar(100) DEFAULT NULL,
  `type` smallint(6) NOT NULL DEFAULT '1' COMMENT '类型{1：普通，10:主页广告}',
  `state` smallint(6) NOT NULL DEFAULT '1',
  `cre_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `m_id` (`mid`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `fr_product`
--

INSERT INTO `fr_product` (`id`, `name`, `thumb_image`, `image_width`, `image_height`, `mid`, `original_price`, `price`, `describe`, `type`, `state`, `cre_date`, `hit`) VALUES
(1, '都市甜心SweetC', '', 0, 0, 9, 0, 0, '都市甜心SweetCity 美甲产品 环保指甲油 美甲套装 魅影精致OL', 1, 1, '2014-10-01 13:37:30', 0),
(2, 'candymoyo', '', 0, 0, 9, 0, 0, 'candymoyo 膜玉糖果色丝绒指甲油毛绒甲天鹅绒毛甲美甲产品彩妆工具13色', 1, 1, '2014-10-01 13:37:30', 0),
(3, '都市甜心SweetC', '', 0, 0, 9, 0, 0, '都市甜心SweetCity 美甲产品 环保焕彩指甲油 14ml 白羊红MDS19', 1, 1, '2014-10-01 13:37:30', 0),
(4, '都市甜心SweetC', '', 0, 0, 10, 0, 0, '都市甜心SweetCity 美甲产品 环保焕彩指甲油 14ml 白羊红MDS19', 1, 1, '2014-10-01 13:37:30', 0),
(5, '都市甜心SweetC', '', 0, 0, 10, 0, 0, '都市甜心SweetCity 美甲产品 环保焕彩指甲油 14ml 白羊红MDS19', 1, 1, '2014-10-01 13:37:30', 0),
(6, 'ad1', '/assets/res/product_images/ad_1.png', 0, 0, 9, 0, 0, 'ad1', 10, 1, '2014-10-20 22:13:02', 0),
(7, 'ad2', '/assets/res/product_images/ad_2.png', 0, 0, 10, 0, 0, 'ad2', 10, 1, '2014-10-20 22:13:02', 0),
(8, 'ad3', '/assets/res/product_images/ad_3.png', 0, 0, 9, 0, 0, 'ad3', 10, 1, '2014-10-20 22:13:39', 0),
(9, 'ad4', '/assets/res/product_images/ad_4.png', 0, 0, 10, 0, 0, 'ad4', 10, 1, '2014-10-20 22:13:39', 0),
(10, '', '/assets/res/product_images/201410/20141029145623985.png', 520, 280, 9, 0, 0, '0', 2, 1, '2014-10-29 14:56:23', 0),
(11, 'NAME', '/assets/res/product_images/201410/20141029145744988.jpg', 1240, 1683, 9, 0, 0, 'describe', 2, 1, '2014-10-29 14:57:44', 0),
(12, '0', '/assets/res/product_images/201410/20141029151249932.png', 520, 280, 9, 0, 0, '0', 2, 1, '2014-10-29 15:12:49', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `fr_product_image`
--

INSERT INTO `fr_product_image` (`id`, `uri`, `height`, `width`, `pid`, `order`) VALUES
(1, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', 10, 10, 3, 0),
(2, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', 10, 10, 1, 0),
(6, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(7, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(8, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(9, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(10, 'http://pic.nipic.com/2007-12-28/20071228114234633_2.jpg', 10, 10, 3, NULL),
(11, '/assets/res/product_images/201410/20141029151659962.png', 363, 394, 11, 2),
(12, '/assets/res/product_images/201410/20141029154603929.png', 363, 394, 11, 2);

-- --------------------------------------------------------

--
-- 表的结构 `fr_product_label`
--

CREATE TABLE IF NOT EXISTS `fr_product_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `lid` (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `fr_product_label`
--

INSERT INTO `fr_product_label` (`id`, `pid`, `lid`) VALUES
(1, 1, 6),
(2, 1, 3),
(3, 1, 2),
(4, 2, 1),
(5, 3, 5),
(6, 4, 6);

-- --------------------------------------------------------

--
-- 表的结构 `fr_session`
--

CREATE TABLE IF NOT EXISTS `fr_session` (
  `sessionid` char(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `last_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sessionid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `fr_session`
--

INSERT INTO `fr_session` (`sessionid`, `uid`, `last_date`) VALUES
('4c9f1vku7ek35rog3pd37osph2', 4, '2014-10-18 17:56:13'),
('e0g90g5c9nl4fbh8btub8dlc40', 4, '2014-10-18 20:55:23'),
('e0g90g5c9nl4fbh8btub8dlc40', 7, '2014-10-15 12:48:06'),
('e0g90g5c9nl4fbh8btub8dlc40', 14, '2014-10-18 19:40:47'),
('u7k5e6pe620250o1hbshq19723', 4, '2014-10-19 12:43:38'),
('e0g90g5c9nl4fbh8btub8dlc40', 9, '2014-10-29 14:32:00');

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
  `age` smallint(6) DEFAULT '0',
  `email` varchar(25) NOT NULL,
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `avatar_uri` varchar(140) DEFAULT NULL COMMENT '头像地址',
  `avatar_width` smallint(6) NOT NULL,
  `avatar_height` smallint(6) NOT NULL,
  `register_date` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `last_login` timestamp NULL DEFAULT NULL COMMENT '上次登录时间',
  `last_ip` char(15) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型：1（普通用户），2（美甲师）',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1（正常），0（冻结），-1（删除）',
  `level` smallint(6) NOT NULL DEFAULT '1' COMMENT '等级：1（普通用户）...',
  `remark` varchar(40) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `fr_user`
--

INSERT INTO `fr_user` (`id`, `user_name`, `nick_name`, `password`, `gender`, `age`, `email`, `address`, `avatar_uri`, `avatar_width`, `avatar_height`, `register_date`, `last_login`, `last_ip`, `type`, `status`, `level`, `remark`) VALUES
(2, 'root', 'root', '202cb962ac59075b964b07152d234b70', 1, 0, 'test', NULL, '/assets/res/images/avatar.jpg', 0, 0, '2014-09-29 12:14:25', '2014-09-29 12:14:25', NULL, 1, 1, 1, NULL),
(3, '18011900850', '123', '202cb962ac59075b964b07152d234b70', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '2014-09-29 12:14:31', '2014-09-29 12:14:31', NULL, 1, 1, 1, NULL),
(4, '123', 'nickname_hehe', '123', 1, 0, '123@qq.dom', '234', '/assets/res/user_avatar/201410/20141029143558440.png', 520, 280, '2014-09-29 12:14:36', '2014-09-29 12:14:36', NULL, 1, 1, 1, '76'),
(5, '1231', '', '123', 1, 0, '', NULL, '/assets/res/images/a', 0, 0, '2014-09-29 12:11:52', '2014-09-29 10:49:34', NULL, 1, 1, 1, NULL),
(6, '12321', '', '123', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '2014-09-29 12:14:42', '2014-09-29 12:14:42', NULL, 1, 1, 1, NULL),
(7, '111', '', '111', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(8, '999', '', '999', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(9, '1234', '1234', '1234', 1, 0, '', NULL, NULL, 0, 0, '2014-10-01 13:33:24', '2014-10-01 13:33:24', NULL, 2, 1, 1, NULL),
(10, '4321', '4321', '4321', 1, 0, '', NULL, NULL, 0, 0, '2014-10-01 13:34:08', '2014-10-01 13:34:08', NULL, 2, 1, 1, NULL),
(11, '555', '', '555', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(12, '888', '', '888', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(13, '567', '', '567', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(14, '000', '', '000', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(15, '3211', '', '123321', 1, 0, '', NULL, '/assets/res/images/avatar.jpg', 0, 0, '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL);

--
-- 限制导出的表
--

--
-- 限制表 `fr_circle_comment`
--
ALTER TABLE `fr_circle_comment`
  ADD CONSTRAINT `fr_circle_comment_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `fr_circle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fr_circle_comment_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `fr_user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `fr_circle_image`
--
ALTER TABLE `fr_circle_image`
  ADD CONSTRAINT `fr_circle_image_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `fr_circle` (`id`);

--
-- 限制表 `fr_product_image`
--
ALTER TABLE `fr_product_image`
  ADD CONSTRAINT `fr_product_image_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `fr_product` (`id`);

--
-- 限制表 `fr_product_label`
--
ALTER TABLE `fr_product_label`
  ADD CONSTRAINT `fr_product_label_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `fr_product` (`id`),
  ADD CONSTRAINT `fr_product_label_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `fr_label` (`id`);
