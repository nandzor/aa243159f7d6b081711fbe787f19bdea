/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80022
Source Host           : localhost:3306
Source Database       : send_email_api

Target Server Type    : MYSQL
Target Server Version : 80022
File Encoding         : 65001

Date: 2020-11-07 21:18:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for send_email
-- ----------------------------
DROP TABLE IF EXISTS `send_email`;
CREATE TABLE `send_email` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `subject_` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `to_` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of send_email
-- ----------------------------
INSERT INTO `send_email` VALUES ('1', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 19:29:42');
INSERT INTO `send_email` VALUES ('2', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 19:53:28');
INSERT INTO `send_email` VALUES ('3', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 19:56:29');
INSERT INTO `send_email` VALUES ('4', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 19:56:41');
INSERT INTO `send_email` VALUES ('5', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 20:13:35');
INSERT INTO `send_email` VALUES ('6', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 20:16:33');
INSERT INTO `send_email` VALUES ('7', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 20:17:09');
INSERT INTO `send_email` VALUES ('8', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 20:30:22');
INSERT INTO `send_email` VALUES ('9', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 20:32:18');
INSERT INTO `send_email` VALUES ('10', 'admin@admin.com', 'ini adalah subject', 'nandz.id@gmail.com', 'ini adalah content', '2020-11-07 21:00:58');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
