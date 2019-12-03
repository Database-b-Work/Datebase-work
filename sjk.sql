/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : sjk

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 04/12/2019 00:13:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for branch
-- ----------------------------
DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch`  (
  `statement` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `month` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `station_num` int(11) NULL DEFAULT NULL,
  `meter_num` int(11) NULL DEFAULT NULL,
  `straight_station_num` int(11) NULL DEFAULT NULL,
  `straight_meter_num` int(11) NULL DEFAULT NULL,
  `straight_fee` int(11) NULL DEFAULT NULL,
  `straight_count` float NULL DEFAULT NULL,
  `straight_average_fee_non` float NULL DEFAULT NULL,
  `straight_top_fee_non` float NULL DEFAULT NULL,
  `straight_low_fee_non` float NULL DEFAULT NULL,
  `straight_top_fee` float NULL DEFAULT NULL,
  `straight_low_fee` float NULL DEFAULT NULL,
  `trans_station_num` int(11) NULL DEFAULT NULL,
  `trans_meter_num` int(11) NULL DEFAULT NULL,
  `trans_fee` int(11) NULL DEFAULT NULL,
  `trans_count` float NULL DEFAULT NULL,
  `trans_average_fee_non` float NULL DEFAULT NULL,
  `trans_top_fee_non` float NULL DEFAULT NULL,
  `trans_low_fee_non` float NULL DEFAULT NULL,
  `trans_top_fee` float NULL DEFAULT NULL,
  `trans_low_fee` float NULL DEFAULT NULL,
  `trans_self_station_num` int(11) NULL DEFAULT NULL,
  `trans_fee_self_proportion` float NULL DEFAULT NULL,
  `trans_replace_station_num` int(11) NULL DEFAULT NULL,
  `trans_replace_proportion` float NULL DEFAULT NULL,
  `index_explain` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`type`, `month`, `statement`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of branch
-- ----------------------------
INSERT INTO `branch` VALUES ('湖南', 6, '电站类型1', 11, 15, 5, 10, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'a', 0);
INSERT INTO `branch` VALUES ('湖南', 6, '电站类型2', 12, 16, 6, 11, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'b', 0);
INSERT INTO `branch` VALUES ('湖南', 6, '电站类型3', 13, 17, 7, 12, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'c', 0);
INSERT INTO `branch` VALUES ('湖南', 6, '电站类型4', 14, 138, 8, 133, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'd', 0);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(8) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `passwd` varchar(255) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = ascii COLLATE = ascii_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '1', 1, '总公司');
INSERT INTO `user` VALUES (2, 'hlj1', '1', 0, '黑龙江1公司');
INSERT INTO `user` VALUES (3, 'hlj2', '1', 0, '黑龙江2公司');
INSERT INTO `user` VALUES (4, 'hlj3', '1', 0, '黑龙江3公司');
INSERT INTO `user` VALUES (5, 'hn1', '1', 0, '湖南1公司');
INSERT INTO `user` VALUES (6, 'hn2', '1', 0, '湖南2公司');
INSERT INTO `user` VALUES (7, 'hn3', '1', 0, '湖南3公司');
INSERT INTO `user` VALUES (8, 'qh1', '1', 0, '青海1公司');
INSERT INTO `user` VALUES (9, 'qh2', '1', 0, '青海2公司');
INSERT INTO `user` VALUES (10, 'qh3', '1', 0, '青海3公司');

SET FOREIGN_KEY_CHECKS = 1;
