/*
Navicat MySQL Data Transfer

Source Server         : 阿里云
Source Server Version : 50548
Source Host           : 120.24.235.116:3306
Source Database       : produce

Target Server Type    : MYSQL
Target Server Version : 50548
File Encoding         : 65001

Date: 2017-09-13 14:43:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for access_token
-- ----------------------------
DROP TABLE IF EXISTS `access_token`;
CREATE TABLE `access_token` (
  `accessToken` varchar(255) NOT NULL,
  `open_id` varchar(64) DEFAULT NULL COMMENT 'openid',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `expire_time` int(10) DEFAULT NULL COMMENT '过期时间',
  `uid` varchar(255) DEFAULT NULL COMMENT 'uid',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of access_token
-- ----------------------------
INSERT INTO `access_token` VALUES ('S58jRp_1NaOyn-VBN0u8rVLADcAKcUiFS0mXkWxTVaE-Nl9D6L8JeRB7cAfm0Ik9PPplQ9Flfs8hmWwP4csHTQ', 'oRv1n1rzmudnkE3ZV58PW6sBMd_U', '1503366647', '1505958647', 'F8DD7D7B-CE1F-A23C-E4D9-AAE80DCA7FCC', '146');
INSERT INTO `access_token` VALUES ('pmiAz1JjoBqcmYEtHB3ag4tymtfj8eYlgSTOYhMnlzEgxEtWZhqRNLJIChzlBSqrW57_n_BgI0pEtREnDro3KQ', 'oRv1n1rBaIo3NA1VtRYoHUO0n-Mo', '1503367581', '1505959581', '721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '147');
INSERT INTO `access_token` VALUES ('vDZcpW6bSDtTvJn1t9NIU1ztm9MR2kQ-IA6EJoM9YUadPc9nlX2X3632q5jBhMrCXAhqq5jF-8hC92VTCOwLxg', 'oRv1n1s_HyGLyWdiI1m3X5_qlTis', '1503413435', '1506005435', '019B60B8-F76A-E7C0-22D7-B524E036352F', '151');
INSERT INTO `access_token` VALUES ('0WEbPuvbCghYx_3BVrpG3exHEC_Q0GD84lxEcABIaOeEVp4EnVK5VfacgskSSFZ51K4lJi1-TiBCFF-XdnaHxA', 'oRv1n1lJexIX1NzoDWZSWtFkD2ds', '1503584595', '1506176595', '74F37955-3462-CB47-957D-142F501F0BEB', '157');
INSERT INTO `access_token` VALUES ('fj77VAEKoeBEygbRySSN2as7uT95jYJLIg27rHLtik1XPRsW8PrthN-0ocodzszlm4wzIJQ0TcxIw4QoLR22PA', 'oRv1n1gAakl7MJZuvcPyYGcwmeKM', '1503584651', '1506176651', 'B4ED3C01-D53D-8543-EB02-84B2BF71701E', '158');
INSERT INTO `access_token` VALUES ('ZjvVF62x12F6_cN8GVA6YFgWmt_0mMQUQbVrLIDgk7tO-of_TPTGYP74wOtA2i56FYu5G4VWx_dVqGfdcAQvfA', 'oRv1n1v2Hhab_BdqBu7aY0EVgmao', '1503584689', '1506176689', 'C4D33E91-196C-2EB2-F16A-F1F54834083A', '159');
INSERT INTO `access_token` VALUES ('xoNwYQhuim4TLpOwY8gcGvYMOmuyS3sgjGYa8qRUcGvWQSYyit8-rNnprlGoLQ3HhEDSvJTZAZ9PFumMhlbfkQ', 'oRv1n1jNDLOEfqnLJeC44CNxNmww', '1503642390', '1506234390', '89A5806D-368A-721F-534F-CFDA86ED84EC', '160');

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
INSERT INTO `banner` VALUES ('1', 'test', '/static/uploads/banner/1.png', '1');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL COMMENT '买家id',
  `good_id` int(10) DEFAULT NULL COMMENT '商品id',
  `num` varchar(10) DEFAULT '1' COMMENT '购买数量(目前为1)',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '购买时间',
  `refuse_time` timestamp NULL DEFAULT NULL COMMENT '拒绝时间',
  `confirm_time` timestamp NULL DEFAULT NULL COMMENT '确认时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '订单状态(1-未确认，2-拒绝，3-已确认,4-已完成(预留))',
  `shop_id` int(10) DEFAULT NULL COMMENT '商家id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('1', '0', '30', '2', '2017-08-17 10:02:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('2', '0', '30', '2', '2017-08-17 10:02:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('3', 'EB565340-E3D1-2BCA-43A8-8D1F389F15F4', '30', '2', '2017-08-17 10:02:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('4', 'EB565340-E3D1-2BCA-43A8-8D1F389F15F4', '30', '2', '2017-08-17 10:02:23', null, null, '1', null);
INSERT INTO `cart` VALUES ('5', '481AA012-07A0-D6B0-0E36-C6E02DDDB20A', '38', '1', '2017-08-17 14:29:16', null, null, '1', null);
INSERT INTO `cart` VALUES ('6', '481AA012-07A0-D6B0-0E36-C6E02DDDB20A', '38', '1', '2017-08-17 15:22:34', null, null, '1', null);
INSERT INTO `cart` VALUES ('7', 'A1B4F0ED-A281-213F-9647-E310DEE2066D', '39', '0', '2017-08-17 16:14:29', null, null, '1', null);
INSERT INTO `cart` VALUES ('8', 'A1B4F0ED-A281-213F-9647-E310DEE2066D', '39', '0', '2017-08-17 16:14:30', null, null, '1', null);
INSERT INTO `cart` VALUES ('9', 'A1B4F0ED-A281-213F-9647-E310DEE2066D', '39', '1', '2017-08-17 16:14:31', null, null, '1', null);
INSERT INTO `cart` VALUES ('10', 'EB565340-E3D1-2BCA-43A8-8D1F389F15F4', '30', '5', '2017-08-17 16:47:33', null, null, '1', null);
INSERT INTO `cart` VALUES ('11', 'EB565340-E3D1-2BCA-43A8-8D1F389F15F4', '6', '5', '2017-08-17 16:47:38', null, null, '1', null);
INSERT INTO `cart` VALUES ('12', 'CC5EB156-AB49-A1B7-DB25-8BF338FCC435', '38', '1', '2017-08-17 17:31:50', null, null, '1', null);
INSERT INTO `cart` VALUES ('13', '520AF9FA-2BB7-84CF-D938-20778EA022BF', '38', '1', '2017-08-17 17:34:31', null, null, '1', null);
INSERT INTO `cart` VALUES ('14', '344F89B4-3B17-DBA0-2829-826C99B514B0', '38', '1', '2017-08-17 17:35:59', null, null, '1', null);
INSERT INTO `cart` VALUES ('15', '344F89B4-3B17-DBA0-2829-826C99B514B0', '38', '1', '2017-08-17 22:42:07', null, null, '1', null);
INSERT INTO `cart` VALUES ('16', 'B2D754DB-0AA9-98D3-DC53-AF1D8AB82A7F', '38', '3', '2017-08-18 09:40:04', null, null, '1', null);
INSERT INTO `cart` VALUES ('17', '472785A0-4AD5-C206-C57C-6D5D8FEC3316', '38', '1', '2017-08-18 17:11:36', null, null, '1', null);
INSERT INTO `cart` VALUES ('18', 'E7500CA7-9DD3-BCDA-618C-3F358D94DEA7', '38', '1', '2017-08-18 17:16:22', null, null, '1', null);
INSERT INTO `cart` VALUES ('19', 'B5549C98-2874-ADCC-152B-1F3EF6C5ACDE', '6', '3', '2017-08-18 17:32:34', null, null, '1', null);
INSERT INTO `cart` VALUES ('20', 'B5549C98-2874-ADCC-152B-1F3EF6C5ACDE', '10', '6', '2017-08-18 17:32:47', null, null, '1', null);
INSERT INTO `cart` VALUES ('21', 'B5549C98-2874-ADCC-152B-1F3EF6C5ACDE', '8', '6', '2017-08-18 17:32:58', null, null, '1', null);
INSERT INTO `cart` VALUES ('22', '9BDCA7E3-A7B0-4618-80E8-86EFCDAB7BB5', '8', '88', '2017-08-18 17:35:52', null, null, '1', null);
INSERT INTO `cart` VALUES ('23', '3968833A-85B8-9907-3A2C-BDFEB52E4272', '38', '1', '2017-08-18 17:38:26', null, null, '1', null);
INSERT INTO `cart` VALUES ('24', 'BA4C5470-32DB-391D-7478-98C3DA24A5EC', '10', '4', '2017-08-18 17:42:36', null, null, '1', null);
INSERT INTO `cart` VALUES ('25', '3968833A-85B8-9907-3A2C-BDFEB52E4272', '38', '1', '2017-08-18 17:48:18', null, null, '1', null);
INSERT INTO `cart` VALUES ('26', '3968833A-85B8-9907-3A2C-BDFEB52E4272', '38', '1', '2017-08-18 17:57:39', null, null, '1', null);
INSERT INTO `cart` VALUES ('27', '3968833A-85B8-9907-3A2C-BDFEB52E4272', '38', '1', '2017-08-18 17:58:18', null, null, '1', null);
INSERT INTO `cart` VALUES ('28', '3968833A-85B8-9907-3A2C-BDFEB52E4272', '38', '1', '2017-08-18 19:39:13', null, null, '1', null);
INSERT INTO `cart` VALUES ('29', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:09', null, null, '1', null);
INSERT INTO `cart` VALUES ('30', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('31', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('32', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:11', null, null, '1', null);
INSERT INTO `cart` VALUES ('33', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:11', null, null, '1', null);
INSERT INTO `cart` VALUES ('34', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:11', null, null, '1', null);
INSERT INTO `cart` VALUES ('35', 'B710E38D-27D1-2CCE-0F56-6B4720ECFE22', '38', '1', '2017-08-18 20:26:11', null, null, '1', null);
INSERT INTO `cart` VALUES ('36', '27F7396C-C93F-9A92-09C9-B26863BC300A', '6', '3', '2017-08-19 00:27:43', null, null, '1', null);
INSERT INTO `cart` VALUES ('37', '27F7396C-C93F-9A92-09C9-B26863BC300A', '6', '44', '2017-08-19 00:28:15', null, null, '1', null);
INSERT INTO `cart` VALUES ('38', '08A6C3FA-BA32-DDC4-6F6C-8ED9F864BE4C', '69', '1', '2017-08-19 12:23:03', null, null, '1', null);
INSERT INTO `cart` VALUES ('39', '393C5A99-A39A-3E48-1040-9029F0EFA4A1', '60', '1', '2017-08-19 12:23:33', null, null, '1', null);
INSERT INTO `cart` VALUES ('40', '2F237703-C8AB-FD9C-6464-A2026D799FDF', '60', '2', '2017-08-19 12:32:40', null, null, '1', null);
INSERT INTO `cart` VALUES ('41', '76369605-72E2-D0B1-4BA8-62E90ECC2407', '56', '1', '2017-08-19 12:36:56', null, null, '1', null);
INSERT INTO `cart` VALUES ('42', '76369605-72E2-D0B1-4BA8-62E90ECC2407', '56', '1', '2017-08-19 12:36:56', null, null, '1', null);
INSERT INTO `cart` VALUES ('43', 'B0B0F57F-0BF3-F51C-EACD-EEE9A3CA815A', '56', '1', '2017-08-19 12:38:30', null, null, '1', null);
INSERT INTO `cart` VALUES ('44', 'B0B0F57F-0BF3-F51C-EACD-EEE9A3CA815A', '56', '1', '2017-08-19 12:38:31', null, null, '1', null);
INSERT INTO `cart` VALUES ('45', 'C9523738-2850-D6A1-BB22-2443D23339DD', '56', '1', '2017-08-19 12:41:02', null, null, '1', null);
INSERT INTO `cart` VALUES ('46', 'BCE4BDEF-F1B5-5654-1C40-89D8D2ED87B1', '56', '1', '2017-08-19 12:43:11', null, null, '1', null);
INSERT INTO `cart` VALUES ('47', 'F5277286-71C5-29CA-AA04-149D00CCA767', '72', '1', '2017-08-19 16:40:21', null, null, '1', null);
INSERT INTO `cart` VALUES ('48', 'F5277286-71C5-29CA-AA04-149D00CCA767', '72', '3', '2017-08-19 17:48:24', null, null, '1', null);
INSERT INTO `cart` VALUES ('49', 'A3BD4511-831C-BD04-B6F2-1A86FE7A96E8', '59', '6', '2017-08-19 20:04:07', null, null, '1', null);
INSERT INTO `cart` VALUES ('50', 'A3BD4511-831C-BD04-B6F2-1A86FE7A96E8', '87', '10', '2017-08-19 20:08:51', null, null, '1', null);
INSERT INTO `cart` VALUES ('51', 'A3BD4511-831C-BD04-B6F2-1A86FE7A96E8', '91', '4', '2017-08-20 13:21:07', null, null, '1', null);
INSERT INTO `cart` VALUES ('52', 'AF2B0161-3EDA-EDDD-DFEF-C1EC843BC547', '89', '2', '2017-08-21 11:14:19', null, null, '1', null);
INSERT INTO `cart` VALUES ('53', 'A4A710AC-2B06-60EE-1E1B-C5C63CFA5045', '112', '3', '2017-08-21 17:27:37', null, null, '1', null);
INSERT INTO `cart` VALUES ('54', 'A3BD4511-831C-BD04-B6F2-1A86FE7A96E8', '115', '2', '2017-08-21 18:51:06', null, null, '1', null);
INSERT INTO `cart` VALUES ('55', 'A4A710AC-2B06-60EE-1E1B-C5C63CFA5045', '112', '1', '2017-08-21 19:03:49', null, null, '1', null);
INSERT INTO `cart` VALUES ('56', 'A4A710AC-2B06-60EE-1E1B-C5C63CFA5045', '90', '100', '2017-08-21 19:04:22', null, null, '1', null);
INSERT INTO `cart` VALUES ('57', 'A4A710AC-2B06-60EE-1E1B-C5C63CFA5045', '66', '188', '2017-08-21 19:05:00', null, null, '1', null);
INSERT INTO `cart` VALUES ('58', 'A4A710AC-2B06-60EE-1E1B-C5C63CFA5045', '105', '188', '2017-08-21 19:08:43', null, null, '1', null);
INSERT INTO `cart` VALUES ('59', 'BAEB3CE2-C31B-350C-6392-90724558885A', '113', '1', '2017-08-21 21:42:16', null, null, '1', null);
INSERT INTO `cart` VALUES ('60', 'BAEB3CE2-C31B-350C-6392-90724558885A', '89', '1', '2017-08-22 09:03:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('61', '78EF24CA-1363-05A5-268A-FC5D13BCED22', '118', '5', '2017-08-22 10:06:11', '2017-08-23 15:57:45', null, '3', null);
INSERT INTO `cart` VALUES ('62', '721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '117', '4', '2017-08-22 10:08:10', null, null, '1', null);
INSERT INTO `cart` VALUES ('63', '721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '118', '7', '2017-08-22 10:08:15', '2017-08-23 15:57:51', null, '2', null);
INSERT INTO `cart` VALUES ('64', 'AE9B5F54-15B1-A836-68BE-337BD4FA3872', '118', '3', '2017-08-22 14:09:14', '2017-08-23 17:05:45', null, '3', null);
INSERT INTO `cart` VALUES ('65', 'F5277286-71C5-29CA-AA04-149D00CCA767', '89', '2', '2017-08-22 15:44:46', null, null, '1', null);
INSERT INTO `cart` VALUES ('66', 'F5277286-71C5-29CA-AA04-149D00CCA767', '37', '2', '2017-08-22 15:45:14', null, null, '1', null);
INSERT INTO `cart` VALUES ('67', 'F5277286-71C5-29CA-AA04-149D00CCA767', '90', '2', '2017-08-22 15:47:00', null, null, '1', null);
INSERT INTO `cart` VALUES ('68', '5945866D-A550-0952-3AC1-E60E19AB71BF', '89', '1', '2017-08-22 15:52:34', null, null, '1', null);
INSERT INTO `cart` VALUES ('69', 'AE9B5F54-15B1-A836-68BE-337BD4FA3872', '117', '1111', '2017-08-22 16:20:41', null, null, '1', null);
INSERT INTO `cart` VALUES ('70', '721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '117', '5.7', '2017-08-22 16:22:59', null, null, '1', null);
INSERT INTO `cart` VALUES ('71', 'AE9B5F54-15B1-A836-68BE-337BD4FA3872', '117', '66666666', '2017-08-22 16:25:21', null, null, '1', null);
INSERT INTO `cart` VALUES ('72', 'AE9B5F54-15B1-A836-68BE-337BD4FA3872', '118', '6666666', '2017-08-22 16:25:32', null, null, '1', null);
INSERT INTO `cart` VALUES ('73', 'AE9B5F54-15B1-A836-68BE-337BD4FA3872', '118', '456468', '2017-08-22 16:26:10', null, '2017-08-23 17:13:49', '3', null);
INSERT INTO `cart` VALUES ('74', '5945866D-A550-0952-3AC1-E60E19AB71BF', '115', '60', '2017-08-22 16:26:55', null, null, '1', null);
INSERT INTO `cart` VALUES ('75', '5945866D-A550-0952-3AC1-E60E19AB71BF', '117', '3', '2017-08-22 17:06:02', null, null, '1', null);
INSERT INTO `cart` VALUES ('76', 'AE9B5F54-15B1-A836-68BE-337BD4FA3872', '37', '28', null, null, null, '1', null);
INSERT INTO `cart` VALUES ('77', '721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '119', '9', null, null, null, '1', null);
INSERT INTO `cart` VALUES ('78', '721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '119', '4.7', null, null, null, '1', null);
INSERT INTO `cart` VALUES ('79', 'E680802F-E52D-0243-58B3-63BA4A87FB33', '119', '4', null, null, null, '1', null);
INSERT INTO `cart` VALUES ('80', 'E680802F-E52D-0243-58B3-63BA4A87FB33', '118', '4', null, '2017-08-23 17:09:47', null, '2', null);
INSERT INTO `cart` VALUES ('81', 'E680802F-E52D-0243-58B3-63BA4A87FB33', '116', '5', '2017-08-23 16:20:51', null, null, '1', '144');
INSERT INTO `cart` VALUES ('82', 'C36E021B-4169-BEB6-FA8E-EB2AB63CB48F', '120', '222', '2017-08-23 17:20:30', null, '2017-08-23 17:25:49', '3', '147');
INSERT INTO `cart` VALUES ('83', 'C36E021B-4169-BEB6-FA8E-EB2AB63CB48F', '118', '5', '2017-08-23 17:20:46', null, '2017-08-24 09:43:58', '3', '147');
INSERT INTO `cart` VALUES ('84', '447671D4-9981-CF9F-ADF9-8C9549A51653', '120', '1', '2017-08-23 17:32:55', null, null, '1', '147');
INSERT INTO `cart` VALUES ('85', '447671D4-9981-CF9F-ADF9-8C9549A51653', '119', '1', '2017-08-23 17:32:59', null, null, '1', '152');
INSERT INTO `cart` VALUES ('86', '447671D4-9981-CF9F-ADF9-8C9549A51653', '118', '1', '2017-08-23 17:33:02', null, null, '1', '147');
INSERT INTO `cart` VALUES ('87', '447671D4-9981-CF9F-ADF9-8C9549A51653', '117', '1', '2017-08-23 17:33:05', null, null, '1', '146');
INSERT INTO `cart` VALUES ('88', '447671D4-9981-CF9F-ADF9-8C9549A51653', '115', '1', '2017-08-23 17:33:10', null, null, '1', '140');
INSERT INTO `cart` VALUES ('89', '447671D4-9981-CF9F-ADF9-8C9549A51653', '114', '1', '2017-08-23 17:33:14', null, null, '1', '138');
INSERT INTO `cart` VALUES ('90', '447671D4-9981-CF9F-ADF9-8C9549A51653', '106', '1', '2017-08-23 17:33:22', null, null, '1', '139');
INSERT INTO `cart` VALUES ('91', '447671D4-9981-CF9F-ADF9-8C9549A51653', '105', '1', '2017-08-23 17:33:25', null, null, '1', '139');
INSERT INTO `cart` VALUES ('92', '447671D4-9981-CF9F-ADF9-8C9549A51653', '103', '1', '2017-08-23 17:33:29', null, null, '1', null);
INSERT INTO `cart` VALUES ('93', '447671D4-9981-CF9F-ADF9-8C9549A51653', '101', '1', '2017-08-23 17:33:33', null, null, '1', null);
INSERT INTO `cart` VALUES ('94', '447671D4-9981-CF9F-ADF9-8C9549A51653', '119', '1', '2017-08-23 17:33:44', null, null, '1', '152');
INSERT INTO `cart` VALUES ('95', '447671D4-9981-CF9F-ADF9-8C9549A51653', '120', '1', '2017-08-23 17:33:47', null, null, '1', '147');
INSERT INTO `cart` VALUES ('96', '447671D4-9981-CF9F-ADF9-8C9549A51653', '116', '1', '2017-08-23 17:33:51', null, null, '1', '144');
INSERT INTO `cart` VALUES ('97', 'B4ED3C01-D53D-8543-EB02-84B2BF71701E', '119', '1', '2017-08-24 22:26:21', null, '2017-08-24 22:33:32', '3', '152');
INSERT INTO `cart` VALUES ('98', '74F37955-3462-CB47-957D-142F501F0BEB', '119', '1', '2017-08-24 22:26:28', '2017-08-24 22:38:05', null, '2', '152');
INSERT INTO `cart` VALUES ('99', 'B4ED3C01-D53D-8543-EB02-84B2BF71701E', '119', '2', '2017-08-24 22:26:30', null, null, '1', '152');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of good_type
-- ----------------------------
INSERT INTO `good_type` VALUES ('1', '肉类', '1', '/static/uploads/type/1.png');
INSERT INTO `good_type` VALUES ('2', '海鲜类', '2', '/static/uploads/type/2.png');
INSERT INTO `good_type` VALUES ('4', '蛋类', '3', '/static/uploads/type/3.png');
INSERT INTO `good_type` VALUES ('5', '家禽', '4', '/static/uploads/type/4.png');
INSERT INTO `good_type` VALUES ('6', '水果', '5', '/static/uploads/type/5.png');
INSERT INTO `good_type` VALUES ('7', '米', '1', '/static/uploads/type/5.png');
INSERT INTO `good_type` VALUES ('8', '面', '1', '/static/uploads/type/5.png');
INSERT INTO `good_type` VALUES ('9', '油', '1', '/static/uploads/type/5.png');
INSERT INTO `good_type` VALUES ('10', '蔬菜', '1', '/static/uploads/type/5.png');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `type_id` int(10) DEFAULT NULL COMMENT '商品类别id(对应good_type中id)',
  `shop_id` int(10) DEFAULT NULL COMMENT '商家id(暂时对应user_id)',
  `img` text COMMENT '图片地址',
  `price` varchar(10) DEFAULT NULL COMMENT '价钱',
  `unit` varchar(255) DEFAULT NULL COMMENT '单位',
  `sale_price` varchar(10) DEFAULT NULL COMMENT '促销价',
  `stock` int(10) DEFAULT NULL COMMENT '库存',
  `desc` text COMMENT '商品描述',
  `sort` int(10) DEFAULT '1' COMMENT '排序',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示(1-是,0-否)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('6', '默认名', '10', '73', '', '8', null, '5', '8', '默认描述', '1', '1');
INSERT INTO `goods` VALUES ('8', '五花肉', '1', '73', '/static/uploads/goods/2.png', '10.5', null, '5', '6', '五花肉', '1', '1');
INSERT INTO `goods` VALUES ('9', '前腿肉', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '前腿肉', '1', '1');
INSERT INTO `goods` VALUES ('10', '精肉', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '90', '精肉', '1', '1');
INSERT INTO `goods` VALUES ('11', '精瘦肉', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '精瘦肉', '1', '1');
INSERT INTO `goods` VALUES ('12', '小肉', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '小肉', '1', '1');
INSERT INTO `goods` VALUES ('13', '大肉', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '大肉', '1', '1');
INSERT INTO `goods` VALUES ('14', '亚瑟', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '亚瑟', '1', '1');
INSERT INTO `goods` VALUES ('15', '关羽', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '关羽', '1', '1');
INSERT INTO `goods` VALUES ('16', '张飞', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '张飞', '1', '1');
INSERT INTO `goods` VALUES ('17', '猴子', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '猴子', '1', '1');
INSERT INTO `goods` VALUES ('18', '夏侯', '1', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '夏侯', '1', '1');
INSERT INTO `goods` VALUES ('31', '鳗鱼', '2', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '鳗鱼', '1', '1');
INSERT INTO `goods` VALUES ('32', '金枪鱼', '2', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '金枪鱼', '1', '1');
INSERT INTO `goods` VALUES ('33', '小黄鱼', '2', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '小黄鱼', '1', '1');
INSERT INTO `goods` VALUES ('34', '石斑鱼', '2', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '石斑鱼', '1', '1');
INSERT INTO `goods` VALUES ('35', '淫荡鱼', '2', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '100', '淫荡鱼', '1', '1');
INSERT INTO `goods` VALUES ('37', '西瓜', '6', '73', '/static/uploads/goods/1.png', '10.5', null, '5', '70', '西瓜', '1', '1');
INSERT INTO `goods` VALUES ('38', '大鸟', '5', '73', '/static/uploads/goods/1.png,/static/uploads/type/5.png', '10.5', null, '5', '77', '大鸟', '1', '1');
INSERT INTO `goods` VALUES ('45', null, null, '73', '[\"blob:http://localhost:3000/b27f7f25-31f4-4fee-83ce-f2af0a8a811a\",\"blob:http://localhost:3000/dffa3221-4bb4-4bd8-ad24-29097888def8\"]', null, null, null, null, null, '1', '1');
INSERT INTO `goods` VALUES ('46', '1', '2', '100', '/static/uploads/goods/15030857110.jpeg,/static/uploads/goods/15030857111.jpeg,', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('47', '1', '2', '100', '/static/uploads/goods/15030858070.jpeg,/static/uploads/goods/15030858071.jpeg,', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('48', '1', '2', '100', '/static/uploads/goods/15030858400.jpeg,/static/uploads/goods/15030858401.jpeg,', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('49', 'nnn', '2', null, '/static/uploads/goods/15031033750.jpeg,/static/uploads/goods/15031033751.jpeg,', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('50', 'nnn', '2', null, '', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('51', 'nnn', '2', null, '', '222', null, null, '88', 'iiiiiiii', '1', '1');
INSERT INTO `goods` VALUES ('52', 'xxx', '10', '104', '', '100', null, null, '22', '22', '1', '1');
INSERT INTO `goods` VALUES ('53', 'name1', '0', '104', '', '8', null, null, '8', '擦擦擦擦擦', '1', '1');
INSERT INTO `goods` VALUES ('54', 'q', '2', '104', '/static/uploads/goods/15031127080.jpeg,/static/uploads/goods/15031127081.jpeg,', '2', null, null, '2', '2', '1', '1');
INSERT INTO `goods` VALUES ('55', 'qq1', '5', '105', '/static/uploads/goods/15031133530.jpeg,/static/uploads/goods/15031133531.jpeg,/static/uploads/goods/15031133532.jpeg,', '111', null, null, '111', 'qqqqqq', '1', '1');
INSERT INTO `goods` VALUES ('56', 'q111', '5', '105', '/static/uploads/goods/15031140210.jpeg,/static/uploads/goods/15031140211.jpeg,', '1222', null, null, '6', '1www', '1', '1');
INSERT INTO `goods` VALUES ('57', '', '0', '97', '', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('58', '', '0', '97', '', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('59', '骚猪', '1', '97', '/static/uploads/goods/15031137900.jpeg,', '666', null, null, '9993', 'p d d', '1', '1');
INSERT INTO `goods` VALUES ('60', '1eeeee', '5', '105', '/static/uploads/goods/15031147040.jpeg,/static/uploads/goods/15031147041.jpeg,/static/uploads/goods/15031147042.jpeg,', '122', null, null, '8', 'eee', '1', '1');
INSERT INTO `goods` VALUES ('61', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('62', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('63', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('64', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('65', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('66', '商品1', '7', '106', '', '12.6', null, null, '812', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('67', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('68', '商品1', '7', '106', '', '12.6', null, null, '1000', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('69', '商品1', '7', '106', '', '12.6', null, null, '999', '商品描述', '1', '1');
INSERT INTO `goods` VALUES ('71', '商品', '2', '110', '/static/uploads/goods/15031170930.jpeg,', '112', null, null, '141', '2221', '1', '1');
INSERT INTO `goods` VALUES ('72', '商品', '2', '110', '/static/uploads/goods/15031170950.jpeg,', '112', null, null, '137', '2221', '1', '1');
INSERT INTO `goods` VALUES ('73', '测试chri s', '5', '135', '/static/uploads/goods/15031444540.jpeg,/static/uploads/goods/15031444541.jpeg,/static/uploads/goods/15031444542.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('74', '测试chri s', '5', '135', '/static/uploads/goods/15031444570.jpeg,/static/uploads/goods/15031444571.jpeg,/static/uploads/goods/15031444572.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('75', '测试chri s', '5', '135', '/static/uploads/goods/15031444570.jpeg,/static/uploads/goods/15031444571.jpeg,/static/uploads/goods/15031444572.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('76', '测试chri s', '5', '135', '/static/uploads/goods/15031444600.jpeg,/static/uploads/goods/15031444601.jpeg,/static/uploads/goods/15031444602.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('77', '测试chri s', '5', '135', '/static/uploads/goods/15031444600.jpeg,/static/uploads/goods/15031444601.jpeg,/static/uploads/goods/15031444602.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('78', '测试chri s', '5', '135', '/static/uploads/goods/15031444610.jpeg,/static/uploads/goods/15031444611.jpeg,/static/uploads/goods/15031444612.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('79', '测试chri s', '5', '135', '/static/uploads/goods/15031444620.jpeg,/static/uploads/goods/15031444621.jpeg,/static/uploads/goods/15031444622.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('80', '测试chri s', '5', '135', '/static/uploads/goods/15031444620.jpeg,/static/uploads/goods/15031444621.jpeg,/static/uploads/goods/15031444622.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('81', '测试chri s', '5', '135', '/static/uploads/goods/15031444620.jpeg,/static/uploads/goods/15031444621.jpeg,/static/uploads/goods/15031444622.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('82', '测试chri s', '5', '135', '/static/uploads/goods/15031444630.jpeg,/static/uploads/goods/15031444631.jpeg,/static/uploads/goods/15031444632.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('83', '测试chri s', '5', '135', '/static/uploads/goods/15031444630.jpeg,/static/uploads/goods/15031444631.jpeg,/static/uploads/goods/15031444632.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('84', '测试chri s', '5', '135', '/static/uploads/goods/15031444650.jpeg,/static/uploads/goods/15031444651.jpeg,/static/uploads/goods/15031444652.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('85', '测试chri s', '5', '135', '/static/uploads/goods/15031444660.jpeg,/static/uploads/goods/15031444661.jpeg,/static/uploads/goods/15031444662.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('86', '测试chri s', '5', '135', '/static/uploads/goods/15031444690.jpeg,/static/uploads/goods/15031444691.jpeg,/static/uploads/goods/15031444692.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('87', '测试chri s', '5', '135', '/static/uploads/goods/15031444790.jpeg,/static/uploads/goods/15031444791.jpeg,/static/uploads/goods/15031444792.jpeg,', '6666', null, null, '99989', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('88', '测试chri s', '5', '135', '/static/uploads/goods/15031445110.jpeg,/static/uploads/goods/15031445111.jpeg,/static/uploads/goods/15031445112.jpeg,', '6666', null, null, '99999', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('89', '测试chri s', '5', '135', '/static/uploads/goods/15031445940.jpeg,/static/uploads/goods/15031445941.jpeg,/static/uploads/goods/15031445942.jpeg,', '6666', null, null, '99993', 'chris', '1', '1');
INSERT INTO `goods` VALUES ('90', '骚猪2', '4', '135', '/static/uploads/goods/15031446010.jpeg,', '66666', null, null, '9897', 'pdd2', '1', '1');
INSERT INTO `goods` VALUES ('91', '骚猪2', '4', '135', '/static/uploads/goods/15031446150.jpeg,', '66666', null, null, '9995', 'pdd2', '1', '1');
INSERT INTO `goods` VALUES ('92', '', '0', null, '', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('93', '', '0', null, '', '', null, null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('95', '大大大', '2', '139', '/static/uploads/goods/15032859200.jpeg,/static/uploads/goods/15032859201.jpeg,/static/uploads/goods/15032859202.jpeg,', '888', '吨', null, '999', '大大大的商品', '1', '1');
INSERT INTO `goods` VALUES ('96', '大大大111111', '0', '139', '/static/uploads/goods/15032881540.jpeg,/static/uploads/goods/15032881541.jpeg,/static/uploads/goods/15032881542.jpeg,', '888', '吨', null, '999', '大大大的商品', '1', '1');
INSERT INTO `goods` VALUES ('97', '', '0', null, '/static/uploads/goods/15032861640.jpeg,', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('98', '', '0', null, '/static/uploads/goods/15032862830.jpeg,', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('99', '', '0', null, '/static/uploads/goods/15032863610.jpeg,', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('100', '', '0', null, '/static/uploads/goods/15032864980.jpeg,', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('101', '', '0', null, '/static/uploads/goods/15032865490.jpeg,', '', '', null, '-1', '', '1', '1');
INSERT INTO `goods` VALUES ('102', '', '0', null, '/static/uploads/goods/15032866790.jpeg,', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('103', '', '0', null, '/static/uploads/goods/15032867680.jpeg,', '', '', null, '-1', '', '1', '1');
INSERT INTO `goods` VALUES ('104', '', '0', null, '/static/uploads/goods/15032874180.jpeg,', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('105', '大鸟', '2', '139', '/static/uploads/goods/15032881420.jpeg,/static/uploads/goods/15032881421.jpeg,/static/uploads/goods/15032881422.jpeg,', '111', '吨', null, '-66', '啊啊啊啊', '1', '1');
INSERT INTO `goods` VALUES ('106', '请问让他让他', '0', '139', '/static/uploads/goods/15032883090.jpeg,', '11111222', '吨', null, '122', '松岛枫', '1', '1');
INSERT INTO `goods` VALUES ('107', '咋咋咋', '1', '139', '/static/uploads/goods/15032937910.jpeg,/static/uploads/goods/15032937911.jpeg,/static/uploads/goods/15032937912.jpeg,/static/uploads/goods/15032937913.jpeg,/static/uploads/goods/15032937914.jpeg,/static/uploads/goods/15032937915.jpeg,/static/uploads/goods', '121', '吨', null, '999', '的疯疯癫癫', '1', '1');
INSERT INTO `goods` VALUES ('109', '111', '0', '140', '', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('110', '11111', '0', '140', '', '', '', null, '0', '', '1', '1');
INSERT INTO `goods` VALUES ('111', 'wo ', '0', '138', '', '111', '11', null, '10', '11', '1', '1');
INSERT INTO `goods` VALUES ('112', '111', '2', '138', '', '1111', '111', null, '7', '111', '1', '1');
INSERT INTO `goods` VALUES ('113', '111', '2', '138', '', '111', '1', null, '0', '1', '1', '1');
INSERT INTO `goods` VALUES ('114', '11', '0', '138', '', '111', '111', null, '110', '111', '1', '1');
INSERT INTO `goods` VALUES ('115', '123', '0', '140', '', '123', '吨', null, '60', '点点滴滴', '1', '1');
INSERT INTO `goods` VALUES ('116', '狼', '1', '144', '/static/uploads/goods/15033387910.jpeg,/static/uploads/goods/15033387911.jpeg,', '66666', '吨', null, '99993', '狼人杀', '1', '1');
INSERT INTO `goods` VALUES ('117', '大', '0', '146', '/static/uploads/goods/15033669110.jpeg,/static/uploads/goods/15033669111.jpeg,/static/uploads/goods/15033669112.jpeg,', '888', '顿', null, '-66666792', '大鸟的商品', '1', '1');
INSERT INTO `goods` VALUES ('118', '前腿肉', '1', '147', '/static/uploads/goods/15033670570.jpeg,/static/uploads/goods/15033670571.jpeg,/static/uploads/goods/15033670572.jpeg,', '17.5', '吨', null, '-7123059', '前腿肉', '1', '1');
INSERT INTO `goods` VALUES ('119', '大米', '7', '152', '/static/uploads/goods/15034135790.jpeg,', '4500元', '吨', null, '29976', '吉林新米，口感优质', '1', '1');
INSERT INTO `goods` VALUES ('122', '测试', '0', '147', '/static/uploads/goods/15035393020.jpeg,', '18.5', '吨', null, '412', '你的小甜', '1', '1');
INSERT INTO `goods` VALUES ('124', '测试图片数量', '0', '147', '/static/uploads/goods/15035404250.jpeg,/static/uploads/goods/15035404251.jpeg,/static/uploads/goods/15035404252.jpeg,/static/uploads/goods/15035404253.jpeg,/static/uploads/goods/15035404254.jpeg,/static/uploads/goods/15035404255.jpeg,/static/uploads/goods/15035404256.jpeg,/static/uploads/goods/15035404257.jpeg,/static/uploads/goods/15035404258.jpeg,/static/uploads/goods/15035404259.jpeg,/static/uploads/goods/150354042510.jpeg,/static/uploads/goods/150354042511.jpeg,', '123', '吨', null, '111', '111', '1', '1');
INSERT INTO `goods` VALUES ('125', '松岛枫', '10', '157', '/static/uploads/goods/15035433560.jpeg,/static/uploads/goods/15035433561.jpeg,/static/uploads/goods/15035433562.jpeg,/static/uploads/goods/15035433563.jpeg,/static/uploads/goods/15035433564.jpeg,/static/uploads/goods/15035433565.jpeg,/static/uploads/goods/15035433566.jpeg,/static/uploads/goods/15035433567.jpeg,', '2323', '吨', null, '2222', '啊实打实的', '1', '1');

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for phones
-- ----------------------------
DROP TABLE IF EXISTS `phones`;
CREATE TABLE `phones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL COMMENT '允许的手机号',
  `type` tinyint(2) DEFAULT '2' COMMENT '卖家/买家(1-买家，2-卖家)',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `mark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phones
-- ----------------------------
INSERT INTO `phones` VALUES ('1', '13145927887', '2', null, null, null);
INSERT INTO `phones` VALUES ('2', '18565616993', '2', null, null, null);
INSERT INTO `phones` VALUES ('3', '17722442029', '2', null, null, null);
INSERT INTO `phones` VALUES ('5', '13145927887', '1', null, null, null);
INSERT INTO `phones` VALUES ('6', '18565616993', '1', null, null, null);
INSERT INTO `phones` VALUES ('7', '17722442029', '1', null, null, null);
INSERT INTO `phones` VALUES ('8', '18600912586', '1', null, null, null);
INSERT INTO `phones` VALUES ('9', '18600912586', '2', null, null, null);
INSERT INTO `phones` VALUES ('10', '13077369787', '1', '张盟 ', 'meng.zhang@xliancai.com', null);
INSERT INTO `phones` VALUES ('11', '13077369783', '1', '刘长江', 'changjiang.liu@xliancai.com', null);
INSERT INTO `phones` VALUES ('12', '15011193776', '1', '唐成良', 'chengliang. tang@xliancai. com', '区域总监');

-- ----------------------------
-- Table structure for sms_msg
-- ----------------------------
DROP TABLE IF EXISTS `sms_msg`;
CREATE TABLE `sms_msg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `expire_time` int(10) DEFAULT NULL COMMENT '过期时间',
  `text` varchar(255) DEFAULT NULL COMMENT '发送内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='手机验证码';

-- ----------------------------
-- Records of sms_msg
-- ----------------------------
INSERT INTO `sms_msg` VALUES ('1', '18676715370', '1503117021', '1503117621', '1177');
INSERT INTO `sms_msg` VALUES ('2', '18565616993', '1503117453', '1503118053', '1372');
INSERT INTO `sms_msg` VALUES ('3', '18600912586', '1503132060', '1503132660', '3613');
INSERT INTO `sms_msg` VALUES ('4', '18565616993', '1503136666', '1503137266', '3110');
INSERT INTO `sms_msg` VALUES ('5', '18565616993', '1503137445', '1503138045', '4177');
INSERT INTO `sms_msg` VALUES ('6', '13145927887', '1503137532', '1503138132', '4276');
INSERT INTO `sms_msg` VALUES ('7', '13145927887', '1503138300', '1503138900', '1541');
INSERT INTO `sms_msg` VALUES ('8', '18565616993', '1503138336', '1503138936', '8592');
INSERT INTO `sms_msg` VALUES ('9', '18565616993', '1503138985', '1503139585', '2178');
INSERT INTO `sms_msg` VALUES ('10', '17722442029', '1503144207', '1503144807', '5702');
INSERT INTO `sms_msg` VALUES ('11', '13145927887', '1503144722', '1503145322', '8944');
INSERT INTO `sms_msg` VALUES ('12', '13145927887', '1503199832', '1503200432', '3465');
INSERT INTO `sms_msg` VALUES ('13', '18565616993', '1503206830', '1503207430', '1088');
INSERT INTO `sms_msg` VALUES ('14', '13145927887', '1503218484', '1503219084', '4388');
INSERT INTO `sms_msg` VALUES ('15', '13145927887', '1503284250', '1503284850', '1497');
INSERT INTO `sms_msg` VALUES ('16', '13145927887', '1503299629', '1503300229', '1425');
INSERT INTO `sms_msg` VALUES ('17', '13145927887', '1503307494', '1503308094', '4807');
INSERT INTO `sms_msg` VALUES ('18', '18565616993', '1503322911', '1503323511', '1005');
INSERT INTO `sms_msg` VALUES ('19', '17722442029', '1503338706', '1503339306', '1774');
INSERT INTO `sms_msg` VALUES ('20', '18565616993', '1503366654', '1503367254', '2522');
INSERT INTO `sms_msg` VALUES ('21', '13145927887', '1503366671', '1503367271', '8138');
INSERT INTO `sms_msg` VALUES ('22', '17722442029', '1503367543', '1503368143', '3313');
INSERT INTO `sms_msg` VALUES ('23', '13145927887', '1503382033', '1503382633', '5315');
INSERT INTO `sms_msg` VALUES ('24', '18600912586', '1503388324', '1503388924', '4163');
INSERT INTO `sms_msg` VALUES ('25', '18600912586', '1503413441', '1503414041', '2282');
INSERT INTO `sms_msg` VALUES ('26', '13145927887', '1503476069', '1503476669', '5924');
INSERT INTO `sms_msg` VALUES ('27', '13145927887', '1503479254', '1503479854', '7909');
INSERT INTO `sms_msg` VALUES ('28', '13145927887', '1503480751', '1503481351', '6849');
INSERT INTO `sms_msg` VALUES ('29', '13145927887', '1503482094', '1503482694', '3569');
INSERT INTO `sms_msg` VALUES ('30', '13077369787', '1503584701', '1503585301', '4879');
INSERT INTO `sms_msg` VALUES ('31', '13077369783', '1503584721', '1503585321', '8438');
INSERT INTO `sms_msg` VALUES ('32', '13145927887', '1503642483', '1503643083', '5712');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` varchar(255) NOT NULL COMMENT 'uid',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `open_id` varchar(255) DEFAULT NULL COMMENT '微信的openid',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `nick_name` varchar(255) DEFAULT NULL COMMENT '微信昵称',
  `type` tinyint(1) DEFAULT NULL COMMENT '类型(1-买家，2-商户)',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商家id,插入时自动生成',
  `head_img_url` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `company_logo` varchar(255) DEFAULT NULL COMMENT '公司logo',
  `is_active` tinyint(1) DEFAULT '0' COMMENT '是否有效(1-是，0-否)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_id` (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('F8DD7D7B-CE1F-A23C-E4D9-AAE80DCA7FCC', '', 'oRv1n1rzmudnkE3ZV58PW6sBMd_U', null, '明天', '2', '18565616993', '147', 'http://wx.qlogo.cn/mmopen/9pHIguqXESn8v78UQibl6z9petJ8JKHVULcnkrrHK4ndXg8VhAAOK0REDialGX8u3dZjsGcd95xlL0PxVmyTemiaUIazBxCYaga/0', '瑞军科技公司', null, '0');
INSERT INTO `user` VALUES ('721CB973-EB2C-5CBF-A311-C8F645CC5EFF', '', 'oRv1n1rBaIo3NA1VtRYoHUO0n-Mo', null, 'Chris', '1', '17722442029', '148', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEI1mjRFcxuslZvNnFYWvWJTaTd0MJQhPgRIIALAGrZR9qoQbevib9N67T83wOzSJw64CSvSnrropibA/0', '平安人寿', null, '0');
INSERT INTO `user` VALUES ('019B60B8-F76A-E7C0-22D7-B524E036352F', '', 'oRv1n1s_HyGLyWdiI1m3X5_qlTis', null, '俊吟', '2', '18600912586', '152', 'http://wx.qlogo.cn/mmopen/9pHIguqXESnmVD3Noyar2IjkQkDuibljkcccpnnNjmV5NaicbibNa0f1NFT9X4KsD7ibuGTPvhicPH7g2At6pNicB7cr1CUNkic7ibnJ/0', '湖南河图商贸有限公司', null, '0');
INSERT INTO `user` VALUES ('74F37955-3462-CB47-957D-142F501F0BEB', '', 'oRv1n1lJexIX1NzoDWZSWtFkD2ds', null, '坐拥云起处，心容大江流', '1', '13077369783', '158', 'http://wx.qlogo.cn/mmopen/OxcusbgV77QTARpd8SLJmy1qJI3sJlrkrOc1zrmMsnefTnGmgbZISBy1p54blxBWBOeRWEJmM38jjkc8XJZMllpvavUgL8RO/0', '长沙分行', null, '0');
INSERT INTO `user` VALUES ('B4ED3C01-D53D-8543-EB02-84B2BF71701E', '', 'oRv1n1gAakl7MJZuvcPyYGcwmeKM', null, '晚安', '1', '13077369787', '159', 'http://wx.qlogo.cn/mmopen/LE2RsZU23IYAUfkXS4ic89L0uMfT4mu7qz9QtajF0vamHExbfXsmkUiafmErFeKmzqFmuCC66dEzqlrsIiaMcDwxnoaC4k3TsCr/0', '传世鼎言', null, '0');
INSERT INTO `user` VALUES ('C4D33E91-196C-2EB2-F16A-F1F54834083A', '', 'oRv1n1v2Hhab_BdqBu7aY0EVgmao', null, '在路上', '1', '', '160', 'http://wx.qlogo.cn/mmopen/9pHIguqXESnmVD3Noyar2Pia4ewehBctka0MzPFiaicBjh4ohPibPGcJME3m4hic3zibj2AIszb0LJtsFMfx7QGTlOveFzUamvkju3/0', null, null, '0');
INSERT INTO `user` VALUES ('89A5806D-368A-721F-534F-CFDA86ED84EC', '', 'oRv1n1jNDLOEfqnLJeC44CNxNmww', null, '我是大鸟', '1', '13145927887', '161', 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM6KBQB6YiaKd80FVgR4lxZq900Pe4pdia1olCpCGeru5ibcamok6Syv8KUdW0c80eibACJ1zkTOYYqOmw/0', '大鸟的公司', null, '0');
