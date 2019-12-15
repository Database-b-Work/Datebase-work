# Host: localhost  (Version: 5.7.26)
# Date: 2019-12-15 19:38:15
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "baobiao"
#

DROP TABLE IF EXISTS `baobiao`;
CREATE TABLE `baobiao` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `month` tinyint(4) DEFAULT NULL,
  `province` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '' COMMENT '0 未导入，1已退回，2草稿，3已稽核，4已计算，5已上报，6完成',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `last_modify_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`province`,`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "baobiao"
#

/*!40000 ALTER TABLE `baobiao` DISABLE KEYS */;
INSERT INTO `baobiao` VALUES (13,6,'湖南1公司','0','E:\\phpstudy_pro\\WWW\\uploads\\20191211103542.xlsx','2019-12-15 19:33:58'),(14,3,'湖南1公司','0','','2019-12-05 15:13:42'),(15,1,'湖南1公司','0','','2019-12-15 11:48:21'),(16,2,'湖南1公司','2','E:\\phpstudy_pro\\WWW\\uploads\\20191215034440.xlsx','2019-12-15 15:44:40'),(17,5,'湖南1公司','0','','2019-12-15 11:48:31'),(18,7,'湖南1公司','0','','2019-12-15 11:48:33'),(19,8,'湖南1公司','0','','2019-12-15 11:48:34'),(20,9,'湖南1公司','0','','2019-12-15 11:48:35'),(21,10,'湖南1公司','0','','2019-12-15 11:48:37'),(22,11,'湖南1公司','0','','2019-12-15 11:48:45'),(23,12,'湖南1公司','0','','2019-12-15 11:48:47'),(24,4,'湖南1公司','0','','2019-12-06 14:52:03'),(11,2,'湖南2公司','0','','2019-12-15 11:50:20'),(12,1,'湖南2公司','0','','2019-12-15 11:50:19'),(13,3,'湖南2公司','0','','2019-12-05 15:13:42'),(14,4,'湖南2公司','0','','2019-12-15 11:50:21'),(15,5,'湖南2公司','0','','2019-12-15 11:50:21'),(16,6,'湖南2公司','0','','2019-12-15 11:50:22'),(17,7,'湖南2公司','0','','2019-12-15 11:50:23'),(18,8,'湖南2公司','0','','2019-12-15 11:50:24'),(19,9,'湖南2公司','0','','2019-12-15 11:50:25'),(20,10,'湖南2公司','0','','2019-12-15 11:50:27'),(21,11,'湖南2公司','0','','2019-12-15 11:50:28'),(22,12,'湖南2公司','0','','2019-12-15 11:50:28'),(12,2,'湖南3公司','0','','2019-12-15 11:50:57'),(13,1,'湖南3公司','0','','2019-12-15 11:50:57'),(14,3,'湖南3公司','0','','2019-12-05 15:13:42'),(15,4,'湖南3公司','0','','2019-12-15 11:50:59'),(16,5,'湖南3公司','0','','2019-12-15 11:51:00'),(17,6,'湖南3公司','0','','2019-12-15 11:51:00'),(18,7,'湖南3公司','0','','2019-12-15 11:51:01'),(19,8,'湖南3公司','0','','2019-12-15 11:51:02'),(20,9,'湖南3公司','0','','2019-12-15 11:51:04'),(21,10,'湖南3公司','0','','2019-12-15 11:51:06'),(22,11,'湖南3公司','0','','2019-12-15 11:51:07'),(23,12,'湖南3公司','0','','2019-12-15 11:51:09');
/*!40000 ALTER TABLE `baobiao` ENABLE KEYS */;

#
# Structure for table "branch"
#

DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch` (
  `statement` varchar(100) NOT NULL,
  `month` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL DEFAULT '',
  `station_num` int(11) DEFAULT NULL,
  `meter_num` int(11) DEFAULT NULL,
  `straight_station_num` int(11) DEFAULT NULL,
  `straight_meter_num` int(11) DEFAULT NULL,
  `straight_fee` int(11) DEFAULT NULL,
  `straight_count` float DEFAULT NULL,
  `straight_average_fee_non` float DEFAULT NULL,
  `straight_top_fee_non` float DEFAULT NULL,
  `straight_low_fee_non` float DEFAULT NULL,
  `straight_top_fee` float DEFAULT NULL,
  `straight_low_fee` float DEFAULT NULL,
  `trans_station_num` int(11) DEFAULT NULL,
  `trans_meter_num` int(11) DEFAULT NULL,
  `trans_fee` int(11) DEFAULT NULL,
  `trans_count` float DEFAULT NULL,
  `trans_average_fee_non` float DEFAULT NULL,
  `trans_top_fee_non` float DEFAULT NULL,
  `trans_low_fee_non` float DEFAULT NULL,
  `trans_top_fee` float DEFAULT NULL,
  `trans_low_fee` float DEFAULT NULL,
  `trans_self_station_num` int(11) DEFAULT NULL,
  `trans_fee_self_proportion` float DEFAULT NULL,
  `trans_replace_station_num` int(11) DEFAULT NULL,
  `trans_replace_proportion` float DEFAULT NULL,
  `index_explain` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`type`,`month`,`statement`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "branch"
#

/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES ('湖南1公司',2,'电站类型1',16,15,5,10,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'a',0),('湖南1公司',2,'电站类型2',17,16,6,11,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'b',0),('湖南1公司',2,'电站类型3',18,17,7,12,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'c',0),('湖南1公司',2,'电站类型4',19,138,8,133,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'d',0);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;

#
# Structure for table "institute"
#

DROP TABLE IF EXISTS `institute`;
CREATE TABLE `institute` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

#
# Data for table "institute"
#

/*!40000 ALTER TABLE `institute` DISABLE KEYS */;
INSERT INTO `institute` VALUES (8,19,'湖南第一分公司'),(9,19,'湖南第二分公司'),(10,19,'湖南第三分公司'),(19,0,'湖南总公司'),(20,8,'湖南第一分公司上报部门'),(21,8,'湖南第一分公司稽核部门'),(23,9,'湖南第二分公司总管理'),(24,9,'湖南第二分公司稽核部门'),(25,9,'湖南第二分公司上报部门'),(26,10,'湖南第三分公司上报部门'),(27,10,'湖南第三分公司稽核部门'),(28,10,'湖南第三分公司总管理'),(29,8,'湖南第一分公司总管理');
/*!40000 ALTER TABLE `institute` ENABLE KEYS */;

#
# Structure for table "role"
#

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Data for table "role"
#

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (3,'分公司上报员'),(11,'分公司稽核员'),(13,'分公司管理员'),(14,'总管理员');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

#
# Structure for table "role_rule"
#

DROP TABLE IF EXISTS `role_rule`;
CREATE TABLE `role_rule` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` varchar(255) DEFAULT NULL,
  `ruleid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=176017 DEFAULT CHARSET=utf8;

#
# Data for table "role_rule"
#

/*!40000 ALTER TABLE `role_rule` DISABLE KEYS */;
INSERT INTO `role_rule` VALUES (8,'3','3'),(9,'3','4'),(175985,'11','2'),(175986,'11','1'),(175987,'11','4'),(176012,'13','1'),(176013,'14','3'),(176014,'14','2'),(176015,'14','1'),(176016,'14','4');
/*!40000 ALTER TABLE `role_rule` ENABLE KEYS */;

#
# Structure for table "rule"
#

DROP TABLE IF EXISTS `rule`;
CREATE TABLE `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "rule"
#

/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,'上报总公司'),(2,'稽核权限'),(3,'上传权限'),(4,'查看权限');
/*!40000 ALTER TABLE `rule` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  `province` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=ascii ROW_FORMAT=DYNAMIC;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$2y$10$aSTesW7pTao5p/D76K6s0O.yBdPmSFb1qVb.QVJ.6vynNS2xzT/pC',1,'总公司'),(2,'hn11','$2y$10$hYBubSmnxtBY9xLUJa2zXenLeuNSwPWkIe8LCajU7a9Mo7U.5xkWW',0,'湖南1公司'),(3,'hn12','$2y$10$Coq5acRa6G5BgvRRT5DEPeviaYvppHXRCQBnPjBNxZKZrr3YdJndS',0,'湖南1公司'),(4,'hn13','$2y$10$99Vy20cFlzzjIYAS38T0ZuicXHCA60Fmxk7.bWmF4mZ1L3oRghc/e',0,'湖南1公司'),(5,'hn23','$2y$10$vP.r1OgxadANqNJ4NhN4QO9qgY.XH5qcsic1MJIujLBnT1mlIWqtK',0,'湖南2公司'),(6,'hn22','$2y$10$p5vyY24v/wKLOGZQQTHYFujoXjiwzG/YLcJVHTa9bKKVhqcDI3UOe',0,'湖南2公司'),(7,'hn21','$2y$10$rPFSmA/Nj4Q2Iq0bAlUjZO9hoioRe.HkpeWuwFYLZpML.3dMzKXrK',0,'湖南2公司'),(8,'hn31','$2y$10$ZOUFXQg.VR3nz4wUZc.BZ.fdCoK18Agmcv9oaAWnAegbxRrrhIA5S',0,'湖南3公司'),(9,'hn32','$2y$10$13XmFlTCiPzROWOgNFg1J.kmUifaNO1uz15Jg96VIiVOX617qrzIW',0,'湖南3公司'),(10,'hn33','$2y$10$Z0lpj8Uug3Ytw6LdJF3U9.6uX9yb0ZSKhKJDYGSym5QC4mKCTbAf6',0,'湖南3公司');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

#
# Structure for table "user_role"
#

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "user_role"
#

/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (7,13,5),(8,13,8),(9,13,2),(10,11,3),(11,11,6),(12,11,9),(13,3,4),(14,3,7),(15,3,10),(17,3,15),(18,11,11),(19,14,1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

#
# Structure for table "zhibiao"
#

DROP TABLE IF EXISTS `zhibiao`;
CREATE TABLE `zhibiao` (
  `province` varchar(50) NOT NULL,
  `month` tinyint(2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `average` float(10,2) DEFAULT NULL,
  `proportion` float(10,2) DEFAULT NULL,
  `cost` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`province`,`month`,`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "zhibiao"
#

/*!40000 ALTER TABLE `zhibiao` DISABLE KEYS */;
/*!40000 ALTER TABLE `zhibiao` ENABLE KEYS */;
