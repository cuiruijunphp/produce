/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : produce

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-08-03 00:08:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'banner描述',
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('1', 'test', '/static/uploads/1.png', '1');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL COMMENT '买家id',
  `good_id` int(10) DEFAULT NULL COMMENT '商品id',
  `num` int(10) DEFAULT '1' COMMENT '购买数量(目前为1)',
  `is_del` tinyint(1) DEFAULT NULL COMMENT '是否删除(1-是，0-否)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `type_id` int(10) DEFAULT NULL COMMENT '商品类别id(对应good_type中id)',
  `shop_id` int(10) DEFAULT NULL COMMENT '商家id(暂时对应user_id)',
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `price` varchar(10) DEFAULT NULL COMMENT '价钱',
  `sale_price` varchar(10) DEFAULT NULL COMMENT '促销价',
  `stock` int(10) DEFAULT NULL COMMENT '库存',
  `desc` text COMMENT '商品描述',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示(1-是,0-否)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '南瓜', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '该产品很牛逼', '1', '1');
INSERT INTO `goods` VALUES ('2', '瘦肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '瘦肉', '1', '1');
INSERT INTO `goods` VALUES ('3', '肥肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '肥肉', '1', '1');
INSERT INTO `goods` VALUES ('4', '肥肉肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '肥肉肉', '1', '1');
INSERT INTO `goods` VALUES ('5', '大鸟肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '大鸟肉', '1', '1');
INSERT INTO `goods` VALUES ('6', '鸟肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '鸟肉', '1', '1');
INSERT INTO `goods` VALUES ('7', '肉鸟', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '肉鸟', '1', '1');
INSERT INTO `goods` VALUES ('8', '五花肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '五花肉', '1', '1');
INSERT INTO `goods` VALUES ('9', '前腿肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '前腿肉', '1', '1');
INSERT INTO `goods` VALUES ('10', '精肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '精肉', '1', '1');
INSERT INTO `goods` VALUES ('11', '精瘦肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '精瘦肉', '1', '1');
INSERT INTO `goods` VALUES ('12', '小肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '小肉', '1', '1');
INSERT INTO `goods` VALUES ('13', '大肉', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '大肉', '1', '1');
INSERT INTO `goods` VALUES ('14', '亚瑟', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '亚瑟', '1', '1');
INSERT INTO `goods` VALUES ('15', '关羽', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '关羽', '1', '1');
INSERT INTO `goods` VALUES ('16', '张飞', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '张飞', '1', '1');
INSERT INTO `goods` VALUES ('17', '猴子', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '猴子', '1', '1');
INSERT INTO `goods` VALUES ('18', '夏侯', '1', '1', '/static/uploads/1.png', '10.5', '5', '100', '夏侯', '1', '1');
INSERT INTO `goods` VALUES ('19', '带鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '带鱼', '2', '1');
INSERT INTO `goods` VALUES ('20', '鲫鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '鲫鱼', '2', '1');
INSERT INTO `goods` VALUES ('21', '鲶鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '鲶鱼', '2', '1');
INSERT INTO `goods` VALUES ('22', '鲢鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '鲢鱼', '2', '1');
INSERT INTO `goods` VALUES ('23', '草鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '草鱼', '2', '1');
INSERT INTO `goods` VALUES ('24', '大头鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '大头鱼', '1', '1');
INSERT INTO `goods` VALUES ('25', '美人鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '美人鱼', '2', '1');
INSERT INTO `goods` VALUES ('26', '食人鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '食人鱼', '2', '1');
INSERT INTO `goods` VALUES ('27', '泥鳅', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '泥鳅', '2', '1');
INSERT INTO `goods` VALUES ('28', '黄骨鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '黄骨鱼', '2', '1');
INSERT INTO `goods` VALUES ('29', '三文鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '三文鱼', '2', '1');
INSERT INTO `goods` VALUES ('30', '鲈鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '鲈鱼', '2', '1');
INSERT INTO `goods` VALUES ('31', '鳗鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '鳗鱼', '1', '1');
INSERT INTO `goods` VALUES ('32', '金枪鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '金枪鱼', '1', '1');
INSERT INTO `goods` VALUES ('33', '小黄鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '小黄鱼', '1', '1');
INSERT INTO `goods` VALUES ('34', '石斑鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '石斑鱼', '1', '1');
INSERT INTO `goods` VALUES ('35', '淫荡鱼', '2', '1', '/static/uploads/1.png', '10.5', '5', '100', '淫荡鱼', '1', '1');
INSERT INTO `goods` VALUES ('36', '鸟蛋', '4', '1', '/static/uploads/1.png', '10.5', '5', '100', '鸟蛋', '1', '1');
INSERT INTO `goods` VALUES ('37', '西瓜', '6', '1', '/static/uploads/1.png', '10.5', '5', '100', '西瓜', '1', '1');
INSERT INTO `goods` VALUES ('38', '大鸟', '5', '1', '/static/uploads/1.png', '10.5', '5', '100', '大鸟', '1', '1');

-- ----------------------------
-- Table structure for good_type
-- ----------------------------
DROP TABLE IF EXISTS `good_type`;
CREATE TABLE `good_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '商品类型名称',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of good_type
-- ----------------------------
INSERT INTO `good_type` VALUES ('1', '肉类', '1', '/static/uploads/type/1.png');
INSERT INTO `good_type` VALUES ('2', '海鲜类', '2', '/static/uploads/type/2.png');
INSERT INTO `good_type` VALUES ('4', '蛋类', '3', '/static/uploads/type/3.png');
INSERT INTO `good_type` VALUES ('5', '禽兽类', '4', '/static/uploads/type/4.png');
INSERT INTO `good_type` VALUES ('6', '水果', '5', '/static/uploads/type/5.png');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL COMMENT 'uid',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `openid` varchar(255) DEFAULT NULL COMMENT '微信的openid',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `nick_name` varchar(255) DEFAULT NULL COMMENT '微信昵称',
  `type` tinyint(1) DEFAULT NULL COMMENT '类型(1-商户，2-买家)',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
