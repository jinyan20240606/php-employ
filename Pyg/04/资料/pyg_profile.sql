/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : pyg

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-15 23:12:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pyg_profile
-- ----------------------------
DROP TABLE IF EXISTS `pyg_profile`;
CREATE TABLE `pyg_profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `idnum` varchar(30) DEFAULT NULL COMMENT '身份证号',
  `card` varchar(255) DEFAULT NULL COMMENT '银行卡号',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pyg_profile
-- ----------------------------
INSERT INTO `pyg_profile` VALUES ('1', '1', '232332198008083321', '421656421254789', '1520408547', '1520408547', null);
INSERT INTO `pyg_profile` VALUES ('2', '2', '435332198108083312', '521656421254777', '1520408547', '1520408547', null);
INSERT INTO `pyg_profile` VALUES ('3', '3', '655332198108083357', '681656421254787', '1520408547', '1520408547', null);
INSERT INTO `pyg_profile` VALUES ('4', '4', '987067198208083734', '843123421257829', '1520408547', '1520408547', null);
INSERT INTO `pyg_profile` VALUES ('5', '5', '657067198408083256', '753623421259523', '1520408547', '1520408547', null);
INSERT INTO `pyg_profile` VALUES ('6', '6', '746067198608089463', '534623421259125', '1520408547', '1520408547', null);
INSERT INTO `pyg_profile` VALUES ('7', '7', '745367198708089414', '514623426449165', '1520408547', '1520408547', null);
