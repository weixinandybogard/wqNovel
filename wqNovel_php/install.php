<?php


$tablename = tablename('ims_we7_wxapp_addmoneyrecord');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_addmoneyrecord`;
CREATE TABLE `ims_we7_wxapp_addmoneyrecord` (
  `auto_id` int(11) NOT NULL auto_increment,
  `add_money` float(100,0) default NULL,
  `add_money_time` datetime default NULL,
  `open_id` varchar(100) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		


EOT;

pdo_query($sql);



$tablename = tablename('ims_we7_wxapp_bookkind');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_bookkind`;
CREATE TABLE `ims_we7_wxapp_bookkind` (
  `auto_id` int(11) NOT NULL auto_increment,
  `book_kind` varchar(50) default '',
  `line` int(11) default NULL,
  `order_line` int(11) default NULL,
  `checked` int(11) default NULL,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;


EOT;

pdo_query($sql);





$sql = <<<EOT

INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('1', '现代言情', '1', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('2', '连载中', '2', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('3', '完结', '2', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('4', '古代爱情', '1', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('5', '全部', '1', '1', '1');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('6', '全部', '2', '1', '1');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('7', '古代搞笑', '1', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('8', '现代搞笑', '1', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('9', '艾晴晴', '1', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('10', '全部', '3', '1', '1');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('11', '付费小说', '3', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('12', '免费小说', '3', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('13', '全部', '4', '1', '1');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('14', '人气', '4', '0', '0');
INSERT INTO `ims_we7_wxapp_bookkind` VALUES ('15', '销量', '4', '0', '0');
		
EOT;

pdo_query($sql);




$tablename = tablename('ims_we7_wxapp_books');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_books`;
CREATE TABLE `ims_we7_wxapp_books` (
  `auto_id` int(11) NOT NULL auto_increment,
  `title` varchar(50) default '',
  `src` varchar(100) default '',
  `introduce_auto_id` int(11) default NULL,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);


$tablename = tablename('ims_we7_wxapp_buyrecord');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_buyrecord`;
CREATE TABLE `ims_we7_wxapp_buyrecord` (
  `auto_id` int(11) NOT NULL auto_increment,
  `buy_bi` varchar(50) default '',
  `buy_use_for` varchar(100) default '',
  `buy_time` datetime default NULL,
  `open_id` varchar(100) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


EOT;

pdo_query($sql);




$tablename = tablename('ims_we7_wxapp_catalog');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_catalog`;
CREATE TABLE `ims_we7_wxapp_catalog` (
  `auto_id` int(11) NOT NULL auto_increment,
  `introduce_auto_id` int(11) default NULL,
  `catalog` varchar(100) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
		


EOT;

pdo_query($sql);





$tablename = tablename('ims_we7_wxapp_contactus');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_contactus`;
CREATE TABLE `ims_we7_wxapp_contactus` (
  `auto_id` int(11) NOT NULL auto_increment,
  `work_time` varchar(200) default '',
  `EM` varchar(50) default '',
  `QQ` varchar(50) default '',
  `weixin` varchar(50) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		
insert Into ims_we7_wxapp_contactus (work_time,EM,QQ,weixin) values ('','','','');
		


EOT;

pdo_query($sql);




$tablename = tablename('ims_we7_wxapp_finishbook');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_finishbook`;
CREATE TABLE `ims_we7_wxapp_finishbook` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `title` varchar(100) default '',
  `introduce_auto_id` int(11) default NULL,
  `sex` varchar(50) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);





$tablename = tablename('ims_we7_wxapp_guesslike');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_guesslike`;
CREATE TABLE `ims_we7_wxapp_guesslike` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default NULL,
  `title` varchar(100) default NULL,
  `introduce_auto_id` int(11) default NULL,
  `user` varchar(50) default NULL,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);





$tablename = tablename('ims_we7_wxapp_hot');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_hot`;
CREATE TABLE `ims_we7_wxapp_hot` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `title` varchar(100) default '',
  `introduce_auto_id` int(11) default NULL,
  `sex` varchar(50) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);






$tablename = tablename('ims_we7_wxapp_instroduce');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_instroduce`;
CREATE TABLE `ims_we7_wxapp_instroduce` (
  `auto_id` int(11) NOT NULL auto_increment,
  `title` varchar(50) default '',
  `des1` varchar(50) default '',
  `des2` varchar(500) default '',
  `src` varchar(100) default '',
  `come_time` datetime default NULL,
  `line_one_auto_id` int(11) default 1,
  `line_two_auto_id` int(11) default 1,
  `line_three_auto_id` int(11) default 1,
  `line_four_auto_id` int(11) default 1,
  `is_member_read` int(11) default '0' COMMENT '是否会员只读',
  `need_bi` int(11) default '0' COMMENT '需要的书币数量',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);








$tablename = tablename('ims_we7_wxapp_limittimefree');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_limittimefree`;
CREATE TABLE `ims_we7_wxapp_limittimefree` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `title` varchar(100) default '',
  `introduce_auto_id` int(11) default NULL,
  `sex` varchar(50) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);







$tablename = tablename('ims_we7_wxapp_lunbo');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_lunbo`;
CREATE TABLE `ims_we7_wxapp_lunbo` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `title` varchar(100) default NULL,
  `des` varchar(500) default '',
  `introduce_auto_id` int(11) default NULL,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);






$tablename = tablename('ims_we7_wxapp_memberinfo');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_memberinfo`;
CREATE TABLE `ims_we7_wxapp_memberinfo` (
  `open_id` varchar(100) NOT NULL default '',
  `bi` int(11) default '0',
  PRIMARY KEY  (`open_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		
INSERT INTO ims_we7_wxapp_memberinfo (open_id,bi) values ('',0);

EOT;

pdo_query($sql);





$tablename = tablename('ims_we7_wxapp_memberkind');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_memberkind`;
CREATE TABLE `ims_we7_wxapp_memberkind` (
  `auto_id` int(11) NOT NULL auto_increment,
  `member_kind` varchar(100) default '',
  `member_day` varchar(100) default '',
  `money` float default NULL,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
		
EOT;

pdo_query($sql);




// $tablename = tablename('ims_we7_wxapp_memberkind');
$sql = <<<EOT

INSERT INTO `ims_we7_wxapp_memberkind` VALUES ('1', '体验会员', '开通会员3天', '50');
INSERT INTO `ims_we7_wxapp_memberkind` VALUES ('2', '银白会员 ', '开通1天 ', '100');
INSERT INTO `ims_we7_wxapp_memberkind` VALUES ('3', '青铜会员 ', '开通3天 ', '600');

EOT;

pdo_query($sql);







$tablename = tablename('ims_we7_wxapp_membermemo');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_membermemo`;
CREATE TABLE `ims_we7_wxapp_membermemo` (
  `auto_id` int(11) NOT NULL auto_increment,
  `member_memo` varchar(500) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO `ims_we7_wxapp_membermemo` VALUES ('1', '说明:');
EOT;

pdo_query($sql);






$tablename = tablename('ims_we7_wxapp_newbook');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_newbook`;
CREATE TABLE `ims_we7_wxapp_newbook` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `title` varchar(100) default '',
  `introduce_auto_id` int(11) default NULL,
  `sex` varchar(50) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
		

EOT;

pdo_query($sql);




$tablename = tablename('ims_we7_wxapp_noveldetail');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_noveldetail`;
CREATE TABLE `ims_we7_wxapp_noveldetail` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `book_name` varchar(100) default '',
  `author` varchar(100) default '',
  `status` varchar(50) default '',
  `des` varchar(500) default '',
  `read_count` int(11) default 0,
  `introduce_auto_id` int(11) default NULL,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
		

EOT;

pdo_query($sql);







$tablename = tablename('ims_we7_wxapp_readnovel');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_readnovel`;
CREATE TABLE `ims_we7_wxapp_readnovel` (
  `auto_id` int(11) NOT NULL auto_increment,
  `catalog_auto_id` int(11) default NULL,
  `content` mediumtext,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);






$tablename = tablename('ims_we7_wxapp_recentreadrecord');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_recentreadrecord`;
CREATE TABLE `ims_we7_wxapp_recentreadrecord` (
  `auto_id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default '',
  `des` varchar(100) default '',
  `catalog_auto_id` int(11) default NULL,
  `open_id` varchar(100) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		
		

EOT;

pdo_query($sql);




$tablename = tablename('ims_we7_wxapp_rechargekind');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_rechargekind`;
CREATE TABLE `ims_we7_wxapp_rechargekind` (
  `auto_id` int(11) NOT NULL auto_increment,
  `money` float default 0,
  `bi` int(11) default 0,
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `ims_we7_wxapp_rechargekind` VALUES ('1', '5', '500');
INSERT INTO `ims_we7_wxapp_rechargekind` VALUES ('2', '10', '1000');
INSERT INTO `ims_we7_wxapp_rechargekind` VALUES ('3', '30', '3000');
EOT;

pdo_query($sql);







$tablename = tablename('ims_we7_wxapp_rechargememo');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_rechargememo`;
CREATE TABLE `ims_we7_wxapp_rechargememo` (
  `auto_id` int(11) NOT NULL auto_increment,
  `memo` varchar(500) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `ims_we7_wxapp_rechargememo` VALUES ('1', '说明:');

EOT;

pdo_query($sql);




$tablename = tablename('ims_we7_wxapp_tuijian');
$sql = <<<EOT

DROP TABLE IF EXISTS `ims_we7_wxapp_tuijian`;
CREATE TABLE `ims_we7_wxapp_tuijian` (
  `auto_id` int(11) NOT NULL auto_increment,
  `src` varchar(100) default '',
  `title` varchar(50) default '',
  `introduce_auto_id` int(11) default NULL,
  `sex` varchar(50) default '',
  PRIMARY KEY  (`auto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

EOT;

pdo_query($sql);




