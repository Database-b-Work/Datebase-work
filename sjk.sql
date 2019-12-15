# Host: localhost  (Version: 5.7.26)
# Date: 2019-12-15 12:58:15
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
INSERT INTO `baobiao` VALUES (13,6,'湖南1公司','0','E:\\phpstudy_pro\\WWW\\uploads\\20191211103542.xlsx','2019-12-15 12:00:39'),(14,3,'湖南1公司','0','','2019-12-05 15:13:42'),(15,1,'湖南1公司','0','','2019-12-15 11:48:21'),(16,2,'湖南1公司','0','','2019-12-15 11:48:22'),(17,5,'湖南1公司','0','','2019-12-15 11:48:31'),(18,7,'湖南1公司','0','','2019-12-15 11:48:33'),(19,8,'湖南1公司','0','','2019-12-15 11:48:34'),(20,9,'湖南1公司','0','','2019-12-15 11:48:35'),(21,10,'湖南1公司','0','','2019-12-15 11:48:37'),(22,11,'湖南1公司','0','','2019-12-15 11:48:45'),(23,12,'湖南1公司','0','','2019-12-15 11:48:47'),(24,4,'湖南1公司','0','','2019-12-06 14:52:03'),(11,2,'湖南2公司','0','','2019-12-15 11:50:20'),(12,1,'湖南2公司','0','','2019-12-15 11:50:19'),(13,3,'湖南2公司','0','','2019-12-05 15:13:42'),(14,4,'湖南2公司','0','','2019-12-15 11:50:21'),(15,5,'湖南2公司','0','','2019-12-15 11:50:21'),(16,6,'湖南2公司','0','','2019-12-15 11:50:22'),(17,7,'湖南2公司','0','','2019-12-15 11:50:23'),(18,8,'湖南2公司','0','','2019-12-15 11:50:24'),(19,9,'湖南2公司','0','','2019-12-15 11:50:25'),(20,10,'湖南2公司','0','','2019-12-15 11:50:27'),(21,11,'湖南2公司','0','','2019-12-15 11:50:28'),(22,12,'湖南2公司','0','','2019-12-15 11:50:28'),(12,2,'湖南3公司','0','','2019-12-15 11:50:57'),(13,1,'湖南3公司','0','','2019-12-15 11:50:57'),(14,3,'湖南3公司','0','','2019-12-05 15:13:42'),(15,4,'湖南3公司','0','','2019-12-15 11:50:59'),(16,5,'湖南3公司','0','','2019-12-15 11:51:00'),(17,6,'湖南3公司','0','','2019-12-15 11:51:00'),(18,7,'湖南3公司','0','','2019-12-15 11:51:01'),(19,8,'湖南3公司','0','','2019-12-15 11:51:02'),(20,9,'湖南3公司','0','','2019-12-15 11:51:04'),(21,10,'湖南3公司','0','','2019-12-15 11:51:06'),(22,11,'湖南3公司','0','','2019-12-15 11:51:07'),(23,12,'湖南3公司','0','','2019-12-15 11:51:09'),(1,2,'黑龙江1公司','5','E:\\phpstudy_pro\\WWW\\uploads\\20191215121839.xlsx','2019-12-15 11:51:50'),(3,3,'黑龙江1公司','5','E:\\phpstudy_pro\\WWW\\uploads\\20191215121839.xlsx','2019-12-15 11:52:18'),(4,4,'黑龙江1公司','0','','2019-12-15 11:52:18'),(5,5,'黑龙江1公司','5','E:\\phpstudy_pro\\WWW\\uploads\\20191215121839.xlsx','2019-12-15 11:52:18'),(6,6,'黑龙江1公司','0','','2019-12-15 11:51:57'),(7,7,'黑龙江1公司','5','E:\\phpstudy_pro\\WWW\\uploads\\20191215121839.xlsx','2019-12-15 11:52:19'),(8,8,'黑龙江1公司','0','','2019-12-15 11:52:20'),(9,1,'黑龙江1公司','0','','2019-12-11 17:14:00'),(10,9,'黑龙江1公司','0','','2019-12-15 11:52:20'),(11,10,'黑龙江1公司','0','','2019-12-11 17:14:00'),(12,11,'黑龙江1公司','0','','2019-12-11 17:14:00'),(2,1,'黑龙江2公司','0','','2019-12-06 23:22:45'),(5,2,'黑龙江2公司','2','E:\\phpstudy_pro\\WWW\\uploads\\20191215122021.xlsx','2019-12-15 00:20:21'),(3,3,'黑龙江3公司','0','','2019-12-15 11:51:55'),(6,1,'黑龙江3公司','0','','2019-12-15 11:52:05');
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
INSERT INTO `branch` VALUES ('黑龙江2公司',2,'电站类型1',16,15,5,10,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'a',0),('黑龙江1公司',6,'电站类型1',16,15,5,10,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'a',0),('黑龙江2公司',2,'电站类型2',17,16,6,11,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'b',0),('黑龙江1公司',6,'电站类型2',17,16,6,11,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'b',0),('黑龙江2公司',2,'电站类型3',18,17,7,12,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'c',0),('黑龙江1公司',6,'电站类型3',18,17,7,12,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'c',0),('黑龙江2公司',2,'电站类型4',19,138,8,133,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'d',0),('黑龙江1公司',6,'电站类型4',19,138,8,133,45,10,4.5,5,4,5.85,4.68,11,5,55,10,5.5,6,5,7,5.57,5,0.454545,6,0.545455,'d',0);
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "institute"
#

/*!40000 ALTER TABLE `institute` DISABLE KEYS */;
INSERT INTO `institute` VALUES (1,0,'总公司'),(2,1,'黑龙江总公司'),(4,1,'青海总公司'),(5,2,'黑龙江第一分公司'),(6,2,'黑龙江第二分公司'),(7,2,'黑龙江第三分公司'),(8,19,'湖南第一分公司'),(9,19,'湖南第二分公司'),(10,19,'湖南第三分公司'),(11,4,'青海第一分公司'),(12,4,'青海第二分公司'),(13,4,'青海第三分公司'),(19,1,'湖南总公司');
/*!40000 ALTER TABLE `institute` ENABLE KEYS */;

#
# Structure for table "role"
#

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Data for table "role"
#

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'总管理员'),(3,'分公司上报员'),(11,'分公司稽核员'),(13,'分公司管理员');
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
) ENGINE=MyISAM AUTO_INCREMENT=176012 DEFAULT CHARSET=utf8;

#
# Data for table "role_rule"
#

/*!40000 ALTER TABLE `role_rule` DISABLE KEYS */;
INSERT INTO `role_rule` VALUES (8,'3','3'),(9,'3','4'),(175985,'11','2'),(175986,'11','1'),(175987,'11','4'),(176002,'1','3'),(176003,'1','2'),(176004,'1','1'),(176005,'1','4'),(176012,'13','1');
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
INSERT INTO `user` VALUES (1,'admin','$2y$10$aSTesW7pTao5p/D76K6s0O.yBdPmSFb1qVb.QVJ.6vynNS2xzT/pC',1,'总公司'),(5,'hn11','$2y$10$hYBubSmnxtBY9xLUJa2zXenLeuNSwPWkIe8LCajU7a9Mo7U.5xkWW',0,'湖南1公司'),(11,'hn12','$2y$10$cAwt01sU/bC6OSgyl6K9QOFIVtG/V8YUG0exCx7Gw1uCBJ638A.gO',0,'湖南1公司'),(15,'hn13','$2y$10$pOVCXRTo690Ehpo6.Jkts.chYPjDAve/G9QrIHgpiXAJKzqCog8w.',0,'湖南1公司');
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

#
# Data for table "user_role"
#

/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,1,1),(7,13,5),(8,13,8),(9,13,2),(10,11,3),(11,11,6),(12,11,9),(13,3,4),(14,3,7),(15,3,10),(17,3,15),(18,11,11);
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
INSERT INTO `zhibiao` VALUES ('黑龙江1公司',6,'电站类型1',0.95,0.52,5.00),('黑龙江1公司',6,'电站类型2',0.91,0.50,5.00),('黑龙江1公司',6,'电站类型3',0.87,0.48,5.00),('黑龙江1公司',6,'电站类型4',0.14,0.08,5.00);
/*!40000 ALTER TABLE `zhibiao` ENABLE KEYS */;
