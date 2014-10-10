-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 10 月 10 日 18:33
-- 服务器版本: 5.1.33
-- PHP 版本: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `fanrong`
--

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
-- 表的结构 `fr_circle_image`
--

CREATE TABLE IF NOT EXISTS `fr_circle_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(140) NOT NULL,
  `cid` int(11) NOT NULL,
  `order` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `c_id` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `fr_circle_image`
--

INSERT INTO `fr_circle_image` (`id`, `uri`, `cid`, `order`) VALUES
(3, 'http://pic4.nipic.com/20090904/3268217_092431078457_2.jpg', 2, 0),
(4, 'http://www.mf08s.com/y/c/UploadFiles_c/20140510/2014051012264300.jpg', 2, 1),
(5, 'http://www.mf08s.com/y/c/UploadFiles_c/20140513/2014051312260091.jpg', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fr_circle`
--

CREATE TABLE IF NOT EXISTS `fr_circle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(400) NOT NULL,
  `cre_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` smallint(6) NOT NULL DEFAULT '1' COMMENT '类型，1：已发表，2：精华，0：未发表，-1：已删除',
  `hit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `fr_circle`
--

INSERT INTO `fr_circle` (`id`, `uid`, `title`, `content`, `cre_date`, `type`, `hit`) VALUES
(1, 123, '十款轻熟女美甲图片 甜美清新不夸张', '这款美甲用不规则的图案表现出个性，大胆的撞色却不会有违和感，而且带着一丝俏皮可爱。如果你也是这张个性的女生，可不要错过这款美甲。', '0000-00-00 00:00:00', 1, 0),
(2, 123, '魅惑众生 十指缠绕绽放女人魅力', '灯光下，高脚杯的酒红，轻捻兰花指，指尖上的红色与红酒的融合，蔓延在每个角落；红色，代表魅惑、性感、喜庆，无论你是萝莉，女王、还是文艺范和森女范，今天中国美业mf08s.com小编和姑凉们一起魅惑众生，绽放我们女人的魅力吧···', '0000-00-00 00:00:00', 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `fr_circle_comment`
--

INSERT INTO `fr_circle_comment` (`id`, `cid`, `uid`, `comments`, `cre_date`) VALUES
(1, 1, 10, '这个不错啊！！', '0000-00-00 00:00:00'),
(2, 1, 10, '这个不错啊！！', '2014-10-10 10:50:15'),
(3, 2, 9, '这个不错啊！！', '2014-10-10 10:50:15'),
(4, 1, 9, 'GOOD！！', '2014-10-10 10:50:15'),
(5, 2, 6, 'On, my god！！', '2014-10-10 10:50:15');

-- --------------------------------------------------------

--
-- 表的结构 `fr_exp_pancat_file_information`
--

CREATE TABLE IF NOT EXISTS `fr_exp_pancat_file_information` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(20) NOT NULL,
  `file_download_addr` varchar(64) NOT NULL,
  `file_size_kb` int(11) NOT NULL,
  `file_upload_time` datetime NOT NULL,
  `file_twodim_image_addr` varchar(64) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `file_upload_author` varchar(20) NOT NULL DEFAULT 'unknown',
  `file_download_count` int(11) NOT NULL DEFAULT '0',
  `file_enabled_update` tinyint(1) NOT NULL DEFAULT '0',
  `file_enabled_delete` tinyint(1) NOT NULL DEFAULT '0',
  `file_share_authority` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`),
  KEY `FileNameIndex` (`file_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 导出表中的数据 `fr_exp_pancat_file_information`
--

INSERT INTO `fr_exp_pancat_file_information` (`file_id`, `file_name`, `file_download_addr`, `file_size_kb`, `file_upload_time`, `file_twodim_image_addr`, `file_type`, `file_upload_author`, `file_download_count`, `file_enabled_update`, `file_enabled_delete`, `file_share_authority`) VALUES
(12, 'motingzhanji.apk', 'F:/wamp/www//nail_care_svr/download/apk/motingzhanji.apk', 7221, '2014-09-24 19:31:06', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(13, 'motingzhanji12.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji12.apk', 7221, '2014-09-24 19:40:49', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(14, 'motingzhanji14.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji14.apk', 7221, '2014-09-24 20:15:21', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(15, 'motingzhanji15.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji15.apk', 7221, '2014-09-24 20:26:10', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(16, 'motingzhanji16.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji16.apk', 7221, '2014-09-24 20:26:59', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(17, '百度旅游-广州攻略.pdf', 'F:/wamp/www/nail_care_svr/download/apk/百度旅游-广州攻略.pdf', 3273, '2014-09-24 20:27:09', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(18, '新建 Microsoft Word 文档', 'F:/wamp/www/nail_care_svr/download/apk/新建 Microsoft Word 文档.doc', 81, '2014-09-24 20:27:22', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(19, 'A workflow based cli', 'F:/wamp/www/nail_care_svr/download/apk/A workflow based clinical', 629, '2014-09-24 20:29:51', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(20, 'motingzhanji18.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji18.apk', 7221, '2014-09-24 20:30:04', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(21, 'dianyun.eps', 'F:/wamp/www/nail_care_svr/download/apk/dianyun.eps', 12805, '2014-09-24 20:30:34', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(22, 'motingzhanji19.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji19.apk', 7221, '2014-09-24 20:34:47', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(23, 'motingzhanji192.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji192.apk', 7221, '2014-09-24 20:45:16', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(24, 'motingzhanji190.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji190.apk', 7221, '2014-09-24 20:46:26', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(25, 'motingzhanji1900.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji1900.apk', 7221, '2014-09-24 20:55:23', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0),
(26, 'motingzhanji1100.apk', 'F:/wamp/www/nail_care_svr/download/apk/motingzhanji1100.apk', 7221, '2014-09-24 21:00:04', 'http://localhost/nail_care_svr/index.php/pancat/upload/twodim', 'apk', 'unknown', 0, 0, 0, 0);

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
  `mid` int(11) NOT NULL COMMENT '美甲师 ID',
  `describe` varchar(100) DEFAULT NULL,
  `cre_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `m_id` (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `fr_product`
--

INSERT INTO `fr_product` (`id`, `name`, `mid`, `describe`, `cre_date`, `hit`) VALUES
(1, '都市甜心SweetC', 9, '都市甜心SweetCity 美甲产品 环保指甲油 美甲套装 魅影精致OL', '2014-10-01 13:37:30', 0),
(2, 'candymoyo', 9, 'candymoyo 膜玉糖果色丝绒指甲油毛绒甲天鹅绒毛甲美甲产品彩妆工具13色', '2014-10-01 13:37:30', 0),
(3, '都市甜心SweetC', 9, '都市甜心SweetCity 美甲产品 环保焕彩指甲油 14ml 白羊红MDS19', '2014-10-01 13:37:30', 0),
(4, '都市甜心SweetC', 10, '都市甜心SweetCity 美甲产品 环保焕彩指甲油 14ml 白羊红MDS19', '2014-10-01 13:37:30', 0),
(5, '都市甜心SweetC', 10, '都市甜心SweetCity 美甲产品 环保焕彩指甲油 14ml 白羊红MDS19', '2014-10-01 13:37:30', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `fr_product_label`
--


-- --------------------------------------------------------

--
-- 表的结构 `fr_session`
--

CREATE TABLE IF NOT EXISTS `fr_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cre_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sessionid` char(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sessionid` (`sessionid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `fr_session`
--


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
  `register_date` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `last_login` timestamp NULL DEFAULT NULL COMMENT '上次登录时间',
  `last_ip` char(15) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型：1（普通用户），2（美甲师）',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1（正常），0（冻结），-1（删除）',
  `level` smallint(6) NOT NULL DEFAULT '1' COMMENT '等级：1（普通用户）...',
  `remark` varchar(40) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=14 ;

--
-- 导出表中的数据 `fr_user`
--

INSERT INTO `fr_user` (`id`, `user_name`, `nick_name`, `password`, `gender`, `age`, `email`, `address`, `avatar_uri`, `register_date`, `last_login`, `last_ip`, `type`, `status`, `level`, `remark`) VALUES
(2, 'root', 'root', '202cb962ac59075b964b07152d234b70', 1, 0, 'test', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '2014-09-29 12:14:25', '2014-09-29 12:14:25', NULL, 1, 1, 1, NULL),
(3, '18011900850', '123', '202cb962ac59075b964b07152d234b70', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '2014-09-29 12:14:31', '2014-09-29 12:14:31', NULL, 1, 1, 1, NULL),
(4, '123', '23', '123', 1, 0, '123@qq.dom', '234', 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '2014-09-29 12:14:36', '2014-09-29 12:14:36', NULL, 1, 1, 1, '76'),
(5, '1231', '', '123', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/a', '2014-09-29 12:11:52', '2014-09-29 10:49:34', NULL, 1, 1, 1, NULL),
(6, '12321', '', '123', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '2014-09-29 12:14:42', '2014-09-29 12:14:42', NULL, 1, 1, 1, NULL),
(7, '111', '', '111', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(8, '999', '', '999', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(9, '1234', '1234', '1234', 1, 0, '', NULL, NULL, '2014-10-01 13:33:24', '2014-10-01 13:33:24', NULL, 2, 1, 1, NULL),
(10, '4321', '4321', '4321', 1, 0, '', NULL, NULL, '2014-10-01 13:34:08', '2014-10-01 13:34:08', NULL, 2, 1, 1, NULL),
(11, '555', '', '555', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(12, '888', '', '888', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL),
(13, '567', '', '567', 1, 0, '', NULL, 'http://localhost/nail_care_svr/assets/res/images/avatar.jpg', '0000-00-00 00:00:00', NULL, NULL, 1, 1, 1, NULL);

--
-- 限制导出的表
--

--
-- 限制表 `fr_circle_image`
--
ALTER TABLE `fr_circle_image`
  ADD CONSTRAINT `fr_circle_image_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `fr_circle` (`id`);

--
-- 限制表 `fr_circle_comment`
--
ALTER TABLE `fr_circle_comment`
  ADD CONSTRAINT `fr_circle_comment_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `fr_circle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fr_circle_comment_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `fr_user` (`id`) ON DELETE CASCADE;

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
