# Host: localhost  (Version: 5.7.26)
# Date: 2019-12-03 20:29:53
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

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
  PRIMARY KEY (`type`,`month`,`statement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "branch"
#

/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES ('湖南',6,'电站类型1',11,15,5,10,10,50,0.2,5,4,4.5,3.5,6,5,4,6,0.666667,6,5,5.5,4.5,5,0.833333,6,1,'a',0),('湖南',6,'电站类型2',12,16,6,11,10,50,0.2,5,4,4.5,3.5,6,5,4,6,0.666667,6,5,5.5,4.5,5,0.833333,6,1,'b',0),('湖南',6,'电站类型3',13,17,7,12,10,50,0.2,5,4,4.5,3.5,6,5,4,6,0.666667,6,5,5.5,4.5,5,0.833333,6,1,'c',0),('湖南',6,'电站类型4',14,138,8,133,10,50,0.2,5,4,4.5,3.5,6,5,4,6,0.666667,6,5,5.5,4.5,5,0.833333,6,1,'d',0);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=ascii ROW_FORMAT=DYNAMIC;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin1','1',1),(2,'test1','1',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
