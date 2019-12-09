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

 Date: 09/12/2019 12:56:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for baobiao
-- ----------------------------
DROP TABLE IF EXISTS `baobiao`;
CREATE TABLE `baobiao`  (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `month` tinyint(4) NOT NULL,
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '0 未导入，1已退回，2草稿，3已稽核，4已计算，5已上报，6完成',
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_modify_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`province`, `id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of baobiao
-- ----------------------------
INSERT INTO `baobiao` VALUES (1, 1, '黑龙江1公司', '0', '', '2019-12-06 10:14:18');
INSERT INTO `baobiao` VALUES (2, 1, '黑龙江2公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (3, 1, '黑龙江3公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (4, 2, '黑龙江1公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (5, 2, '黑龙江2公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (6, 2, '黑龙江3公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (7, 3, '湖南1公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (8, 3, '湖南2公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (9, 3, '湖南3公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (10, 4, '湖南1公司', '0', '', '2019-12-06 14:52:03');
INSERT INTO `baobiao` VALUES (11, 4, '湖南2公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (12, 4, '湖南3公司', '0', '', '2019-12-05 15:13:42');
INSERT INTO `baobiao` VALUES (13, 6, '湖南1公司', '2', 'D:\\phpStudy\\PHPTutorial\\WWW\\uploads\\20191208110415.xlsx', '2019-12-08 11:04:15');

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
  PRIMARY KEY (`type`, `month`, `statement`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of branch
-- ----------------------------
INSERT INTO `branch` VALUES ('湖南1公司', 6, '电站类型4', 14, 138, 8, 133, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'd');
INSERT INTO `branch` VALUES ('湖南1公司', 6, '电站类型3', 13, 17, 7, 12, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'c');
INSERT INTO `branch` VALUES ('湖南1公司', 6, '电站类型2', 12, 16, 6, 11, 10, 50, 0.2, 5, 4, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 6, 5, 5.5, 4.5, 5, 0.833333, 6, 1, 'b');
INSERT INTO `branch` VALUES ('湖南1公司', 6, '电站类型1', 11, 15, 5, 10, 10, 5, 2, 0.3, 0.1, 4.5, 3.5, 6, 5, 4, 6, 0.666667, 0.8, 0.5, 5.5, 4.5, 5, 0.833333, 6, 1, 'a');

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
INSERT INTO `user` VALUES (1, 'admin', '$2y$10$aSTesW7pTao5p/D76K6s0O.yBdPmSFb1qVb.QVJ.6vynNS2xzT/pC', 1, '总公司');
INSERT INTO `user` VALUES (3, 'hlj2', '$2y$10$BTDxsasx9VQO.R//5fwtfuDdNUfZAobdRbuXMluNNdNz1pfLPz1o.', 0, '黑龙江2公司');
INSERT INTO `user` VALUES (4, 'hlj3', '$2y$10$YG.RBUaullvndFU3ZXBVLOf0KpVA7hhygeguppEKJed/LE94m3F2y', 0, '黑龙江3公司');
INSERT INTO `user` VALUES (5, 'hn1', '$2y$10$hYBubSmnxtBY9xLUJa2zXenLeuNSwPWkIe8LCajU7a9Mo7U.5xkWW', 0, '湖南1公司');
INSERT INTO `user` VALUES (6, 'hn2', '$2y$10$sRzcbdmDfmBO68rFn33OmehCgqCUYyaJ/OhQongiZ5T4ulxHnDUr2', 0, '湖南2公司');
INSERT INTO `user` VALUES (7, 'hn3', '$2y$10$H8hg4pXrcWzmbGCKLBosJuyo8sUdqdL.D1QVUlLMXoMPKsKJvml2y', 0, '湖南3公司');
INSERT INTO `user` VALUES (8, 'qh1', '$2y$10$ljCfGk/x0qVQN7q6yRCUsuYDtpXpm4qFH3GixjA8bewoCfwSABqci', 0, '青海1公司');
INSERT INTO `user` VALUES (9, 'qh2', '$2y$10$giX9vl/qC8AqasqKJ.CAw.qk3p5x63GkktO/bK87itb4tn/Gn6tdm', 0, '青海2公司');
INSERT INTO `user` VALUES (10, 'qh3', '$2y$10$U6HPPMREE.vGUBjs.zXJy..FjpYKOZieIcFK4BgBzeodf8mMY4UJK', 0, '青海3公司');
INSERT INTO `user` VALUES (2, 'hlj1', '$2y$10$3zQjsL3a4kgHakbPcuVgWeE9iZuPDfycm2q3H5UyAXLskTWS8hez2', 0, '黑龙江1公司');

-- ----------------------------
-- Table structure for zhibiao
-- ----------------------------
DROP TABLE IF EXISTS `zhibiao`;
CREATE TABLE `zhibiao`  (
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `month` tinyint(255) NOT NULL,
  `average` float(10, 2) NULL DEFAULT NULL,
  `proportion` float(10, 2) NULL DEFAULT NULL,
  `cost` float(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`province`, `month`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
