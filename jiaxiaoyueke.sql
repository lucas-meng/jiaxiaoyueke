/*
 Navicat MySQL Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50729
 Source Host           : localhost:3306
 Source Schema         : jiaxiaoyueke

 Target Server Type    : MySQL
 Target Server Version : 50729
 File Encoding         : 65001

 Date: 14/03/2020 12:25:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for date
-- ----------------------------
DROP TABLE IF EXISTS `date`;
CREATE TABLE `date`  (
  `date_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_date` date NULL DEFAULT NULL,
  `course_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `people` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`date_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of date
-- ----------------------------
INSERT INTO `date` VALUES (1, '2020-03-14', '1', 3);
INSERT INTO `date` VALUES (2, '2020-03-14', '2', 3);
INSERT INTO `date` VALUES (3, '2020-03-14', '3', 3);
INSERT INTO `date` VALUES (4, '2020-03-14', '4', 3);
INSERT INTO `date` VALUES (5, '2020-03-14', '5', 0);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_pwd` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_time` datetime(0) NULL DEFAULT NULL,
  `date_date` date NULL DEFAULT NULL,
  `course_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES (2, 'é¹å®‡', '0', NULL, '2020-03-14', '1');

SET FOREIGN_KEY_CHECKS = 1;
