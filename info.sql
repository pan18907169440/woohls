/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : info

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-09-01 09:01:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL COMMENT '父级菜单',
  `name` varchar(255) NOT NULL COMMENT '权限名称',
  `display_name` varchar(20) DEFAULT NULL COMMENT '权限显示名称',
  `icon` varchar(100) DEFAULT NULL COMMENT '图标class',
  `description` varchar(100) DEFAULT NULL COMMENT '权限描述',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否为菜单显示：2：关闭，1：显示',
  `sort` int(11) DEFAULT '0' COMMENT '显示排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 COMMENT='后台权限，权限菜单详细数据记录列表';

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES ('4', '0', '/admin/admin', '后台管理', 'fa-desktop', '', '1', '1', '2016-07-05 03:05:00', '2016-07-25 07:44:21');
INSERT INTO `admin_permissions` VALUES ('5', '4', '/admin/admin/index', '管理员列表', null, null, '1', '1', '2016-07-18 10:47:57', '2016-07-18 10:47:57');
INSERT INTO `admin_permissions` VALUES ('6', '4', '/admin/admin/role', '权限组列表', null, null, '1', '2', '2016-07-18 10:49:36', '2016-07-18 10:49:36');
INSERT INTO `admin_permissions` VALUES ('7', '4', '/admin/admin/permission', '菜单列表', null, null, '1', '3', '2016-07-18 10:50:10', '2016-07-18 10:50:10');
INSERT INTO `admin_permissions` VALUES ('12', '5', '/admin/admin/addAdmin', '添加管理员', null, null, '1', '1', '2016-07-19 01:39:48', '2016-07-19 01:39:48');
INSERT INTO `admin_permissions` VALUES ('13', '5', '/admin/admin/editAdmin', '编辑管理员', null, null, '1', '2', '2016-07-19 01:40:41', '2016-07-19 01:40:56');
INSERT INTO `admin_permissions` VALUES ('14', '5', '/admin/admin/editAdminPwd', '修改管理员密码', null, null, '1', '4', '2016-07-19 01:41:32', '2016-07-19 01:43:13');
INSERT INTO `admin_permissions` VALUES ('15', '5', '/admin/admin/adminStatus', '修改管理员状态', null, null, '1', '5', '2016-07-19 01:42:12', '2016-07-19 01:43:25');
INSERT INTO `admin_permissions` VALUES ('16', '5', '/admin/admin/deleteAdmin', '删除管理员', null, null, '1', '3', '2016-07-19 01:43:01', '2016-07-19 01:43:01');
INSERT INTO `admin_permissions` VALUES ('17', '6', '/admin/role/addRole', '添加权限组', null, null, '1', '1', '2016-07-19 01:44:29', '2016-07-19 01:44:29');
INSERT INTO `admin_permissions` VALUES ('18', '6', '/admin/role/editRole', '编辑权限组', null, null, '1', '2', '2016-07-19 01:44:57', '2016-07-19 01:44:57');
INSERT INTO `admin_permissions` VALUES ('19', '6', '/admin/role/deleteRole', '删除权限组', null, null, '1', '3', '2016-07-19 01:46:56', '2016-07-19 01:46:56');
INSERT INTO `admin_permissions` VALUES ('20', '6', '/admin/role/roleStatus', '修改权限组状态', null, null, '1', '4', '2016-07-19 01:47:40', '2016-07-19 01:47:40');
INSERT INTO `admin_permissions` VALUES ('21', '6', '/admin/role/toPermission', '权限组授权', null, null, '1', '5', '2016-07-19 01:48:19', '2016-07-19 01:48:19');
INSERT INTO `admin_permissions` VALUES ('22', '7', '/admin/permission/addPermission', '添加菜单', null, null, '1', '1', '2016-07-19 01:49:20', '2016-07-19 01:49:30');
INSERT INTO `admin_permissions` VALUES ('23', '7', '/admin/permission/editPermission', '编辑菜单', null, null, '1', '2', '2016-07-19 01:49:57', '2016-07-19 01:49:57');
INSERT INTO `admin_permissions` VALUES ('24', '7', '/admin/permission/permissionStatus', '修改菜单状态', null, null, '1', '3', '2016-07-19 01:50:29', '2016-07-19 01:50:29');
INSERT INTO `admin_permissions` VALUES ('25', '7', '/admin/permission/deletePermission', '删除菜单', null, null, '1', '4', '2016-07-19 01:51:19', '2016-07-19 01:51:19');
INSERT INTO `admin_permissions` VALUES ('54', '0', '/admin/message', '信息管理', 'fa-envelope', null, '1', '5', '2016-07-25 06:48:10', '2016-08-05 09:41:22');
INSERT INTO `admin_permissions` VALUES ('55', '54', '/admin/message/message', '信息列表', '', null, '1', '1', '2016-07-25 06:49:55', '2016-07-25 06:50:09');
INSERT INTO `admin_permissions` VALUES ('56', '55', '/admin/message/addMessage', '信息添加', '', '', '1', '1', '2016-07-25 02:40:00', '2016-07-25 02:40:00');
INSERT INTO `admin_permissions` VALUES ('57', '55', '/admin/message/editMessage', '信息编辑', '', '', '1', '2', '2016-07-25 02:40:40', '2016-07-25 02:40:40');
INSERT INTO `admin_permissions` VALUES ('58', '55', '/admin/message/messageStatus', '修改信息状态', '', '', '1', '3', '2016-07-25 02:41:32', '2016-07-25 02:41:32');
INSERT INTO `admin_permissions` VALUES ('59', '55', '/admin/message/deleteMessage', '删除信息', '', '', '1', '4', '2016-07-25 02:42:22', '2016-07-25 02:42:47');
INSERT INTO `admin_permissions` VALUES ('60', '54', '/admin/message/messageCategory', '信息分类', '', '', '1', '2', '2016-07-25 06:49:55', '2016-07-25 06:50:09');
INSERT INTO `admin_permissions` VALUES ('61', '60', '/admin/message/addMessageCategory', '分类添加', '', '', '1', '1', '2016-07-25 02:40:00', '2016-07-25 02:40:00');
INSERT INTO `admin_permissions` VALUES ('62', '60', '/admin/message/editMessageCategory', '分类编辑', '', '', '1', '2', '2016-07-25 02:40:40', '2016-07-25 02:40:40');
INSERT INTO `admin_permissions` VALUES ('63', '60', '/admin/message/messageCategoryStatus', '修改分类状态', '', '', '1', '3', '2016-07-25 02:41:32', '2016-07-25 02:41:32');
INSERT INTO `admin_permissions` VALUES ('64', '60', '/admin/message/deleteMessageCategory', '删除分类', '', '', '1', '4', '2016-07-25 02:42:22', '2016-07-25 02:42:47');
INSERT INTO `admin_permissions` VALUES ('69', '55', '/admin/message/ToUser', '邮件推送', '', null, '1', '5', '2016-07-26 01:45:56', '2016-07-26 01:45:56');
INSERT INTO `admin_permissions` VALUES ('70', '54', '/admin/message/messageSendHistory', '发送邮件记录', '', null, '1', '3', '2016-07-26 03:55:56', '2016-08-24 16:06:45');
INSERT INTO `admin_permissions` VALUES ('71', '70', '/admin/message/deleteMessageSendHistory', '删除记录', '', null, '1', '1', '2016-07-26 05:50:00', '2016-07-26 05:50:00');
INSERT INTO `admin_permissions` VALUES ('125', '70', '/admin/message/messageInfo', '查看信息详情', '', null, '1', '2', '2016-08-24 16:03:07', '2016-08-24 16:03:37');
INSERT INTO `admin_permissions` VALUES ('126', '54', '/admin/message/messageRole', '信息发送记录', '', null, '1', '4', '2016-08-24 16:29:30', '2016-08-24 16:29:30');
INSERT INTO `admin_permissions` VALUES ('127', '126', '/admin/message/deleteMessageRole', '删除记录', '', null, '1', '1', '2016-08-24 16:30:09', '2016-08-24 16:30:09');
INSERT INTO `admin_permissions` VALUES ('128', '54', '/admin/message/messageRoleHistory', '历史信息列表', '', null, '1', '5', '2016-08-24 17:29:30', '2016-08-24 17:29:30');
INSERT INTO `admin_permissions` VALUES ('129', '128', '/admin/message/deleteMessageRoleHistory', '删除记录', '', null, '1', '1', '2016-08-24 17:30:05', '2016-08-24 17:30:05');
INSERT INTO `admin_permissions` VALUES ('130', '128', '/admin/message/messageRoleHistoryRead', '查看历史信息', '', null, '1', '1', '2016-08-24 17:40:11', '2016-08-24 17:40:11');

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级菜单',
  `name` varchar(255) NOT NULL COMMENT '角色名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '权限组状态:2：关闭,1：开启',
  `display_name` varchar(45) DEFAULT NULL COMMENT '角色显示名称',
  `deccription` varchar(100) DEFAULT NULL COMMENT '角色描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='后台权限，权限组详细信息列表';

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES ('1', '0', '技术研发部', '1', '1', '1级超级管理员', '技术研发部', '2016-07-05 03:05:44', '2016-08-24 10:09:55');
INSERT INTO `admin_roles` VALUES ('3', '0', '策划部', '2', '1', '1级超级管理员', '策划部', '2016-07-05 03:05:44', '2016-08-24 10:11:22');
INSERT INTO `admin_roles` VALUES ('5', '1', '潘子龙', '2', '1', '1级超级管理员', '潘子龙', '2016-07-05 03:05:44', '2016-08-24 10:10:15');
INSERT INTO `admin_roles` VALUES ('6', '1', '钟兆喜', '3', '1', '1级超级管理员', '钟兆喜', '2016-07-05 03:05:44', '2016-08-24 10:11:38');
INSERT INTO `admin_roles` VALUES ('7', '1', '熊有志', '3', '1', null, '熊有志', '2016-08-26 11:15:29', '2016-08-26 11:15:29');
INSERT INTO `admin_roles` VALUES ('8', '1', '李伟', '4', '1', null, '李伟', '2016-08-26 12:00:52', '2016-08-26 12:00:52');
INSERT INTO `admin_roles` VALUES ('9', '3', '汤利华', '2', '1', null, '汤利华', '2016-08-26 16:38:58', '2016-08-26 16:38:58');

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(20) NOT NULL COMMENT '管理员用户名',
  `password` varchar(32) NOT NULL COMMENT '管理员密码',
  `status` tinyint(1) DEFAULT '1' COMMENT '管理员状态（2:禁用 1:启用）',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='后台管理员，用户数据表：用户账户和密码';

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', '潘子龙', 'c00e3199528f8bf0a5bef533975c64be', '1', '2016-07-05 03:07:09', '2016-08-26 10:10:51');
INSERT INTO `admin_users` VALUES ('2', '钟兆喜', '2f7766d14daf7736bdfb60e1c89987ae', '1', '2016-08-26 11:33:58', '2016-08-26 11:33:58');
INSERT INTO `admin_users` VALUES ('3', '熊有志', '2f7766d14daf7736bdfb60e1c89987ae', '1', '2016-08-26 11:54:20', '2016-08-26 11:54:20');
INSERT INTO `admin_users` VALUES ('4', '李伟', '038b6f6d328b9e20949b823bda24ce22', '1', '2016-08-26 12:01:16', '2016-08-26 12:01:16');

-- ----------------------------
-- Table structure for admin_users_info
-- ----------------------------
DROP TABLE IF EXISTS `admin_users_info`;
CREATE TABLE `admin_users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id，与用户表id同步',
  `nickname` varchar(255) DEFAULT NULL COMMENT '用户姓名',
  `phone` varchar(255) DEFAULT NULL COMMENT '用户电话',
  `email` varchar(255) DEFAULT NULL COMMENT '用户邮箱',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '用户注册时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '用户更新信息时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_phone` (`phone`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='后台管理员，用户详细信息表';

-- ----------------------------
-- Records of admin_users_info
-- ----------------------------
INSERT INTO `admin_users_info` VALUES ('1', '潘子龙', '187179758', '1428259520@qq.com', '2016-08-08 15:05:05', '2016-08-24 11:40:00');
INSERT INTO `admin_users_info` VALUES ('2', '钟兆喜', null, '296095756@qq.com', '2016-08-26 11:33:58', '2016-08-26 11:33:58');
INSERT INTO `admin_users_info` VALUES ('3', '熊有志', null, '14282595225@qq.com', '2016-08-26 11:54:20', '2016-08-26 13:45:25');
INSERT INTO `admin_users_info` VALUES ('4', '李伟', null, '142825962@qq.com', '2016-08-26 12:01:16', '2016-08-26 12:01:16');

-- ----------------------------
-- Table structure for admin_users_login
-- ----------------------------
DROP TABLE IF EXISTS `admin_users_login`;
CREATE TABLE `admin_users_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP地址',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='后台管理员，记录管理员每次的登录记录';

-- ----------------------------
-- Records of admin_users_login
-- ----------------------------
INSERT INTO `admin_users_login` VALUES ('1', '1', '127.0.0.1', '2016-08-26 11:57:21', '2016-08-26 11:57:21', '2016-08-26 11:57:21');
INSERT INTO `admin_users_login` VALUES ('2', '1', '127.0.0.1', '2016-08-26 12:00:26', '2016-08-26 12:00:26', '2016-08-26 12:00:26');
INSERT INTO `admin_users_login` VALUES ('3', '4', '127.0.0.1', '2016-08-26 12:03:06', '2016-08-26 12:03:06', '2016-08-26 12:03:06');
INSERT INTO `admin_users_login` VALUES ('4', '1', '127.0.0.1', '2016-08-29 09:18:15', '2016-08-29 09:18:15', '2016-08-29 09:18:15');
INSERT INTO `admin_users_login` VALUES ('5', '1', '127.0.0.1', '2016-08-30 09:00:04', '2016-08-30 09:00:04', '2016-08-30 09:00:04');
INSERT INTO `admin_users_login` VALUES ('6', '1', '127.0.0.1', '2016-08-30 14:14:32', '2016-08-30 14:14:32', '2016-08-30 14:14:32');
INSERT INTO `admin_users_login` VALUES ('7', '1', '127.0.0.1', '2016-08-30 16:10:15', '2016-08-30 16:10:15', '2016-08-30 16:10:15');
INSERT INTO `admin_users_login` VALUES ('8', '1', '127.0.0.1', '2016-08-30 16:12:18', '2016-08-30 16:12:18', '2016-08-30 16:12:18');
INSERT INTO `admin_users_login` VALUES ('9', '1', '127.0.0.1', '2016-08-30 16:14:46', '2016-08-30 16:14:46', '2016-08-30 16:14:46');
INSERT INTO `admin_users_login` VALUES ('10', '1', '127.0.0.1', '2016-08-30 16:15:44', '2016-08-30 16:15:44', '2016-08-30 16:15:44');
INSERT INTO `admin_users_login` VALUES ('11', '1', '127.0.0.1', '2016-08-30 16:23:19', '2016-08-30 16:23:19', '2016-08-30 16:23:19');
INSERT INTO `admin_users_login` VALUES ('12', '1', '127.0.0.1', '2016-08-30 16:25:15', '2016-08-30 16:25:15', '2016-08-30 16:25:15');
INSERT INTO `admin_users_login` VALUES ('13', '1', '127.0.0.1', '2016-08-30 16:30:06', '2016-08-30 16:30:06', '2016-08-30 16:30:06');
INSERT INTO `admin_users_login` VALUES ('14', '1', '127.0.0.1', '2016-08-30 16:32:08', '2016-08-30 16:32:08', '2016-08-30 16:32:08');
INSERT INTO `admin_users_login` VALUES ('15', '1', '127.0.0.1', '2016-08-30 16:36:54', '2016-08-30 16:36:54', '2016-08-30 16:36:54');
INSERT INTO `admin_users_login` VALUES ('16', '1', '127.0.0.1', '2016-08-30 18:38:27', '2016-08-30 18:38:27', '2016-08-30 18:38:27');
INSERT INTO `admin_users_login` VALUES ('17', '1', '127.0.0.1', '2016-08-30 18:39:47', '2016-08-30 18:39:47', '2016-08-30 18:39:47');
INSERT INTO `admin_users_login` VALUES ('18', '1', '127.0.0.1', '2016-08-30 18:41:58', '2016-08-30 18:41:58', '2016-08-30 18:41:58');
INSERT INTO `admin_users_login` VALUES ('19', '1', '127.0.0.1', '2016-08-30 18:46:00', '2016-08-30 18:46:00', '2016-08-30 18:46:00');
INSERT INTO `admin_users_login` VALUES ('20', '1', '127.0.0.1', '2016-08-30 18:47:16', '2016-08-30 18:47:16', '2016-08-30 18:47:16');
INSERT INTO `admin_users_login` VALUES ('21', '1', '127.0.0.1', '2016-08-30 18:48:02', '2016-08-30 18:48:02', '2016-08-30 18:48:02');
INSERT INTO `admin_users_login` VALUES ('22', '1', '127.0.0.1', '2016-08-30 18:49:29', '2016-08-30 18:49:29', '2016-08-30 18:49:29');
INSERT INTO `admin_users_login` VALUES ('23', '1', '127.0.0.1', '2016-08-30 18:49:29', '2016-08-30 18:49:29', '2016-08-30 18:49:29');
INSERT INTO `admin_users_login` VALUES ('24', '1', '127.0.0.1', '2016-08-30 18:50:02', '2016-08-30 18:50:02', '2016-08-30 18:50:02');
INSERT INTO `admin_users_login` VALUES ('25', '1', '127.0.0.1', '2016-08-30 18:52:26', '2016-08-30 18:52:26', '2016-08-30 18:52:26');
INSERT INTO `admin_users_login` VALUES ('26', '1', '127.0.0.1', '2016-08-30 18:56:24', '2016-08-30 18:56:24', '2016-08-30 18:56:24');
INSERT INTO `admin_users_login` VALUES ('27', '1', '127.0.0.1', '2016-08-31 08:56:53', '2016-08-31 08:56:53', '2016-08-31 08:56:53');
INSERT INTO `admin_users_login` VALUES ('28', '1', '127.0.0.1', '2016-08-31 09:28:17', '2016-08-31 09:28:17', '2016-08-31 09:28:17');
INSERT INTO `admin_users_login` VALUES ('29', '1', '127.0.0.1', '2016-08-31 09:37:35', '2016-08-31 09:37:35', '2016-08-31 09:37:35');
INSERT INTO `admin_users_login` VALUES ('30', '1', '127.0.0.1', '2016-08-31 09:40:36', '2016-08-31 09:40:36', '2016-08-31 09:40:36');
INSERT INTO `admin_users_login` VALUES ('31', '1', '127.0.0.1', '2016-08-31 09:43:47', '2016-08-31 09:43:47', '2016-08-31 09:43:47');
INSERT INTO `admin_users_login` VALUES ('32', '1', '127.0.0.1', '2016-08-31 09:44:46', '2016-08-31 09:44:46', '2016-08-31 09:44:46');
INSERT INTO `admin_users_login` VALUES ('33', '1', '127.0.0.1', '2016-08-31 09:46:21', '2016-08-31 09:46:21', '2016-08-31 09:46:21');
INSERT INTO `admin_users_login` VALUES ('34', '1', '127.0.0.1', '2016-08-31 10:14:34', '2016-08-31 10:14:34', '2016-08-31 10:14:34');
INSERT INTO `admin_users_login` VALUES ('35', '1', '127.0.0.1', '2016-08-31 10:15:56', '2016-08-31 10:15:56', '2016-08-31 10:15:56');
INSERT INTO `admin_users_login` VALUES ('36', '1', '127.0.0.1', '2016-08-31 10:17:37', '2016-08-31 10:17:37', '2016-08-31 10:17:37');
INSERT INTO `admin_users_login` VALUES ('37', '1', '127.0.0.1', '2016-08-31 10:22:01', '2016-08-31 10:22:01', '2016-08-31 10:22:01');
INSERT INTO `admin_users_login` VALUES ('38', '1', '127.0.0.1', '2016-08-31 10:25:41', '2016-08-31 10:25:41', '2016-08-31 10:25:41');
INSERT INTO `admin_users_login` VALUES ('39', '1', '127.0.0.1', '2016-08-31 10:27:54', '2016-08-31 10:27:54', '2016-08-31 10:27:54');
INSERT INTO `admin_users_login` VALUES ('40', '1', '127.0.0.1', '2016-08-31 10:34:02', '2016-08-31 10:34:02', '2016-08-31 10:34:02');
INSERT INTO `admin_users_login` VALUES ('41', '1', '127.0.0.1', '2016-08-31 10:34:47', '2016-08-31 10:34:47', '2016-08-31 10:34:47');
INSERT INTO `admin_users_login` VALUES ('42', '1', '127.0.0.1', '2016-08-31 10:40:43', '2016-08-31 10:40:43', '2016-08-31 10:40:43');
INSERT INTO `admin_users_login` VALUES ('43', '1', '127.0.0.1', '2016-08-31 10:48:54', '2016-08-31 10:48:54', '2016-08-31 10:48:54');
INSERT INTO `admin_users_login` VALUES ('44', '1', '127.0.0.1', '2016-08-31 10:52:20', '2016-08-31 10:52:20', '2016-08-31 10:52:20');
INSERT INTO `admin_users_login` VALUES ('45', '1', '127.0.0.1', '2016-08-31 10:53:15', '2016-08-31 10:53:15', '2016-08-31 10:53:15');
INSERT INTO `admin_users_login` VALUES ('46', '1', '127.0.0.1', '2016-08-31 10:57:43', '2016-08-31 10:57:43', '2016-08-31 10:57:43');
INSERT INTO `admin_users_login` VALUES ('47', '1', '127.0.0.1', '2016-08-31 10:59:35', '2016-08-31 10:59:35', '2016-08-31 10:59:35');
INSERT INTO `admin_users_login` VALUES ('48', '1', '127.0.0.1', '2016-08-31 11:04:36', '2016-08-31 11:04:36', '2016-08-31 11:04:36');
INSERT INTO `admin_users_login` VALUES ('49', '1', '127.0.0.1', '2016-08-31 11:09:52', '2016-08-31 11:09:52', '2016-08-31 11:09:52');
INSERT INTO `admin_users_login` VALUES ('50', '1', '127.0.0.1', '2016-08-31 11:10:53', '2016-08-31 11:10:53', '2016-08-31 11:10:53');
INSERT INTO `admin_users_login` VALUES ('51', '1', '127.0.0.1', '2016-09-01 09:00:48', '2016-09-01 09:00:48', '2016-09-01 09:00:48');

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `admin_user_id` int(11) NOT NULL COMMENT '后台用户id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`role_id`,`admin_user_id`),
  KEY `admin_user_role_admin_user_id_foreign` (`admin_user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台权限，用户组和权限组关系表';

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES ('1', '1');
INSERT INTO `admin_user_role` VALUES ('1', '5');
INSERT INTO `admin_user_role` VALUES ('2', '1');
INSERT INTO `admin_user_role` VALUES ('2', '6');
INSERT INTO `admin_user_role` VALUES ('3', '1');
INSERT INTO `admin_user_role` VALUES ('3', '7');
INSERT INTO `admin_user_role` VALUES ('4', '1');
INSERT INTO `admin_user_role` VALUES ('4', '8');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `cate_id` int(11) DEFAULT NULL COMMENT '稿件分类',
  `title` varchar(255) DEFAULT NULL COMMENT '稿件标题',
  `body` text COMMENT '稿件内容',
  `file_id` varchar(255) DEFAULT NULL COMMENT '附件id 字符串',
  `file_url` varchar(255) DEFAULT NULL COMMENT '上传附件地址',
  `status` tinyint(4) DEFAULT '1' COMMENT '稿件状态:2：关闭，1：开启',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台信息，信息记录列表';

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '1', '1', 'windows', '<p><a target=\"_blank\" href=\"http://baike.baidu.com/view/182749.htm\">Microsoft Windows</a>,是美国<a target=\"_blank\" href=\"http://baike.baidu.com/view/39784.htm\">微软公司</a>研发的一套操作系统，它问世于1985年，起初仅仅是<a target=\"_blank\" href=\"http://baike.baidu.com/view/2422.htm\">Microsoft</a>-<a target=\"_blank\" href=\"http://baike.baidu.com/subview/365/7971327.htm\" data-lemmaid=\"32025\">DOS</a>模拟环境，后续的系统版本由于微软不断的更新升级，不但易用，也慢慢的成为家家户户人们最喜爱的操作系统。</p><p><a target=\"_blank\" href=\"http://baike.baidu.com/view/4821.htm\">Windows</a>采用了图形化模式<a target=\"_blank\" href=\"http://baike.baidu.com/view/25309.htm\">GUI</a>，比起从前的DOS需要键入指令使用的方式更为人性化。随着电脑硬件和软件的不断升级，微软的Windows也在不断升级，从架构的16位、<a target=\"_blank\" href=\"http://baike.baidu.com/subview/125389/10889278.htm\" data-lemmaid=\"5812218\">32位</a>再到<a target=\"_blank\" href=\"http://baike.baidu.com/view/125381.htm\">64位</a>， 系统版本从最初的<a target=\"_blank\" href=\"http://baike.baidu.com/view/41450.htm\">Windows 1.0</a> 到大家熟知的<a target=\"_blank\" href=\"http://baike.baidu.com/view/41207.htm\">Windows 95</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/41265.htm\">Windows 98</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/41307.htm\">Windows ME</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/153378.htm\">Windows 2000</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/201021.htm\">Windows 2003</a><a target=\"_blank\" href=\"http://baike.baidu.com/view/77306.htm\">、</a><a target=\"_blank\" href=\"http://baike.baidu.com/view/6399.htm\">Windows XP</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/7764.htm\">Windows Vista</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/761518.htm\">Windows 7</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/1108918.htm\">Windows 8</a>、<a target=\"_blank\" href=\"http://baike.baidu.com/view/10393127.htm\">Windows 8.1</a>、Windows 10 和 <a target=\"_blank\" href=\"http://baike.baidu.com/view/2815927.htm\">Windows Server</a>服务器企业级操作系统，不断持续更新，微软一直在致力于Windows操作系统的开发和完善。</p><p><br/></p>', 'JS+CSS3实现可拖动立方体特效.rar,（成功）【PHP服务器搭建教程】虚拟机下ubuntu搭建php环境及svn安装.docx', 'http://www.qhinfo.com/uploads/file/lNoCsAJFkS.rar,http://www.qhinfo.com/uploads/file/gtAeI6lmno.docx', '1', '2016-08-26 11:36:01', '2016-08-31 11:10:23');
INSERT INTO `message` VALUES ('2', '1', '1', '萨达', '<p>阿达<br/></p>', '5,4', 'http://www.qhinfo.com/uploads/file/3sUcmGWEJU.zip,http://www.qhinfo.com/uploads/file/PQoPJRsNFp.rar', '1', '2016-08-30 11:39:51', '2016-08-31 09:55:22');
INSERT INTO `message` VALUES ('3', '1', '1', 'dassa', '<p>dasdsd<br/></p>', 'laravel-v5.2.15.zip,（成功）【PHP服务器搭建教程】虚拟机下ubuntu搭建php环境及svn安装.docx', 'http://www.qhinfo.com/uploads/file/BVz7WOfDmv.zip,http://www.qhinfo.com/uploads/file/wcFyC4SbmI.docx', '1', '2016-08-30 16:37:42', '2016-08-31 11:11:22');
INSERT INTO `message` VALUES ('5', '1', '1', '是飞洒的萨达', '<p>萨达<br/></p>', '', '', '1', '2016-08-30 18:26:45', '2016-08-30 18:26:45');
INSERT INTO `message` VALUES ('6', '1', '1', '大神', '<p>萨达<br/></p>', '', '', '1', '2016-08-30 18:28:49', '2016-08-30 18:28:49');

-- ----------------------------
-- Table structure for message_annex
-- ----------------------------
DROP TABLE IF EXISTS `message_annex`;
CREATE TABLE `message_annex` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `file_name` varchar(255) DEFAULT NULL COMMENT '文件名称',
  `file_url` varchar(255) DEFAULT NULL COMMENT '文件地址',
  `file_size` varchar(50) DEFAULT NULL COMMENT '文件大小',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message_annex
-- ----------------------------
INSERT INTO `message_annex` VALUES ('1', '1', 'JS+CSS3实现可拖动立方体特效.rar', 'http://www.qhinfo.com/uploads/file/oACLdNEY7f.rar', '55.48 KB', '2016-08-31 09:54:39', '2016-08-31 09:54:39');
INSERT INTO `message_annex` VALUES ('2', '1', '（成功）【PHP服务器搭建教程】虚拟机下ubuntu搭建php环境及svn安装.docx', 'http://www.qhinfo.com/uploads/file/TZGmJtYThd.docx', '23.23 KB', '2016-08-31 09:54:42', '2016-08-31 09:54:42');
INSERT INTO `message_annex` VALUES ('3', '1', 'laravel-v5.2.15.zip', 'http://www.qhinfo.com/uploads/file/3sUcmGWEJU.zip', '7.46 MB', '2016-08-31 09:55:15', '2016-08-31 09:55:15');
INSERT INTO `message_annex` VALUES ('4', '1', 'JS+CSS3实现可拖动立方体特效.rar', 'http://www.qhinfo.com/uploads/file/PQoPJRsNFp.rar', '55.48 KB', '2016-08-31 09:55:20', '2016-08-31 09:55:20');
INSERT INTO `message_annex` VALUES ('5', '1', 'JS+CSS3实现可拖动立方体特效.rar', 'http://www.qhinfo.com/uploads/file/bmYpDQpsHg.rar', '55.48 KB', '2016-08-31 09:55:39', '2016-08-31 09:55:39');
INSERT INTO `message_annex` VALUES ('6', '1', '（成功）【PHP服务器搭建教程】虚拟机下ubuntu搭建php环境及svn安装.docx', 'http://www.qhinfo.com/uploads/file/MJZ3lACYSA.docx', '23.23 KB', '2016-08-31 09:55:42', '2016-08-31 09:55:42');
INSERT INTO `message_annex` VALUES ('7', '1', 'JS+CSS3实现可拖动立方体特效.rar', 'http://www.qhinfo.com/uploads/file/lNoCsAJFkS.rar', '55.48 KB', '2016-08-31 11:10:08', '2016-08-31 11:10:08');
INSERT INTO `message_annex` VALUES ('8', '1', '（成功）【PHP服务器搭建教程】虚拟机下ubuntu搭建php环境及svn安装.docx', 'http://www.qhinfo.com/uploads/file/gtAeI6lmno.docx', '23.23 KB', '2016-08-31 11:10:13', '2016-08-31 11:10:13');
INSERT INTO `message_annex` VALUES ('9', '1', 'laravel-v5.2.15.zip', 'http://www.qhinfo.com/uploads/file/BVz7WOfDmv.zip', '7.46 MB', '2016-08-31 11:11:16', '2016-08-31 11:11:16');
INSERT INTO `message_annex` VALUES ('10', '1', '（成功）【PHP服务器搭建教程】虚拟机下ubuntu搭建php环境及svn安装.docx', 'http://www.qhinfo.com/uploads/file/wcFyC4SbmI.docx', '23.23 KB', '2016-08-31 11:11:20', '2016-08-31 11:11:20');

-- ----------------------------
-- Table structure for message_category
-- ----------------------------
DROP TABLE IF EXISTS `message_category`;
CREATE TABLE `message_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `pid` int(11) DEFAULT NULL COMMENT '父级id',
  `name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `status` varchar(255) DEFAULT '1' COMMENT '分类状态:2：关闭,1：开启',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台信息，信息分类表';

-- ----------------------------
-- Records of message_category
-- ----------------------------
INSERT INTO `message_category` VALUES ('1', '1', '0', '公司制度', '1', '1', '2016-08-26 11:34:46', '2016-08-26 11:34:46');
INSERT INTO `message_category` VALUES ('2', '1', '1', '技术部制度', '1', '1', '2016-08-26 11:35:10', '2016-08-26 11:35:10');

-- ----------------------------
-- Table structure for message_role
-- ----------------------------
DROP TABLE IF EXISTS `message_role`;
CREATE TABLE `message_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_role_id` int(11) DEFAULT NULL COMMENT '允许查看信息的用户id',
  `message_id` int(11) DEFAULT NULL COMMENT '信息id',
  `status` tinyint(4) DEFAULT '1' COMMENT '指定用户信息发送的状态:2：未发送,1：已发送',
  `step` tinyint(4) DEFAULT '2' COMMENT '指定用户查看改信息的状态:2：未查看,1：已查看',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台信息，允许用户查看信息的记录表';

-- ----------------------------
-- Records of message_role
-- ----------------------------
INSERT INTO `message_role` VALUES ('1', '1', '1', '1', '1', '2016-08-29 15:01:31', '2016-08-29 15:01:37');
INSERT INTO `message_role` VALUES ('2', '2', '1', '1', '2', '2016-08-29 15:01:31', '2016-08-29 15:01:31');
INSERT INTO `message_role` VALUES ('3', '1', '3', '1', '1', '2016-08-31 09:24:06', '2016-08-31 11:18:57');
INSERT INTO `message_role` VALUES ('4', '2', '3', '1', '2', '2016-08-31 09:24:06', '2016-08-31 09:24:06');
INSERT INTO `message_role` VALUES ('5', '1', '6', '1', '1', '2016-08-31 11:15:20', '2016-08-31 11:18:56');
INSERT INTO `message_role` VALUES ('6', '2', '6', '1', '2', '2016-08-31 11:15:20', '2016-08-31 11:15:20');

-- ----------------------------
-- Table structure for message_send_history
-- ----------------------------
DROP TABLE IF EXISTS `message_send_history`;
CREATE TABLE `message_send_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `email_id` int(11) DEFAULT NULL COMMENT '稿件id',
  `user_email` varchar(255) DEFAULT NULL COMMENT '用户id',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台信息，邮件发送记录表';

-- ----------------------------
-- Records of message_send_history
-- ----------------------------

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL COMMENT '权限id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台权限，记录权限菜单和权限组的关联记录表';

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('4', '1');
INSERT INTO `permission_role` VALUES ('4', '5');
INSERT INTO `permission_role` VALUES ('4', '6');
INSERT INTO `permission_role` VALUES ('5', '5');
INSERT INTO `permission_role` VALUES ('5', '6');
INSERT INTO `permission_role` VALUES ('6', '5');
INSERT INTO `permission_role` VALUES ('6', '6');
INSERT INTO `permission_role` VALUES ('7', '5');
INSERT INTO `permission_role` VALUES ('7', '6');
INSERT INTO `permission_role` VALUES ('12', '5');
INSERT INTO `permission_role` VALUES ('12', '6');
INSERT INTO `permission_role` VALUES ('13', '5');
INSERT INTO `permission_role` VALUES ('13', '6');
INSERT INTO `permission_role` VALUES ('14', '5');
INSERT INTO `permission_role` VALUES ('14', '6');
INSERT INTO `permission_role` VALUES ('15', '5');
INSERT INTO `permission_role` VALUES ('15', '6');
INSERT INTO `permission_role` VALUES ('16', '5');
INSERT INTO `permission_role` VALUES ('16', '6');
INSERT INTO `permission_role` VALUES ('17', '5');
INSERT INTO `permission_role` VALUES ('17', '6');
INSERT INTO `permission_role` VALUES ('18', '5');
INSERT INTO `permission_role` VALUES ('18', '6');
INSERT INTO `permission_role` VALUES ('19', '5');
INSERT INTO `permission_role` VALUES ('19', '6');
INSERT INTO `permission_role` VALUES ('20', '5');
INSERT INTO `permission_role` VALUES ('20', '6');
INSERT INTO `permission_role` VALUES ('21', '5');
INSERT INTO `permission_role` VALUES ('21', '6');
INSERT INTO `permission_role` VALUES ('22', '5');
INSERT INTO `permission_role` VALUES ('22', '6');
INSERT INTO `permission_role` VALUES ('23', '5');
INSERT INTO `permission_role` VALUES ('23', '6');
INSERT INTO `permission_role` VALUES ('24', '5');
INSERT INTO `permission_role` VALUES ('24', '6');
INSERT INTO `permission_role` VALUES ('25', '5');
INSERT INTO `permission_role` VALUES ('25', '6');
INSERT INTO `permission_role` VALUES ('54', '5');
INSERT INTO `permission_role` VALUES ('54', '6');
INSERT INTO `permission_role` VALUES ('55', '5');
INSERT INTO `permission_role` VALUES ('55', '6');
INSERT INTO `permission_role` VALUES ('56', '5');
INSERT INTO `permission_role` VALUES ('56', '6');
INSERT INTO `permission_role` VALUES ('57', '5');
INSERT INTO `permission_role` VALUES ('57', '6');
INSERT INTO `permission_role` VALUES ('58', '5');
INSERT INTO `permission_role` VALUES ('58', '6');
INSERT INTO `permission_role` VALUES ('59', '5');
INSERT INTO `permission_role` VALUES ('59', '6');
INSERT INTO `permission_role` VALUES ('60', '5');
INSERT INTO `permission_role` VALUES ('60', '6');
INSERT INTO `permission_role` VALUES ('61', '5');
INSERT INTO `permission_role` VALUES ('61', '6');
INSERT INTO `permission_role` VALUES ('62', '5');
INSERT INTO `permission_role` VALUES ('62', '6');
INSERT INTO `permission_role` VALUES ('63', '5');
INSERT INTO `permission_role` VALUES ('63', '6');
INSERT INTO `permission_role` VALUES ('64', '5');
INSERT INTO `permission_role` VALUES ('64', '6');
INSERT INTO `permission_role` VALUES ('69', '5');
INSERT INTO `permission_role` VALUES ('69', '6');
INSERT INTO `permission_role` VALUES ('70', '5');
INSERT INTO `permission_role` VALUES ('70', '6');
INSERT INTO `permission_role` VALUES ('71', '5');
INSERT INTO `permission_role` VALUES ('71', '6');
INSERT INTO `permission_role` VALUES ('125', '5');
INSERT INTO `permission_role` VALUES ('125', '6');
INSERT INTO `permission_role` VALUES ('126', '5');
INSERT INTO `permission_role` VALUES ('126', '6');
INSERT INTO `permission_role` VALUES ('127', '5');
INSERT INTO `permission_role` VALUES ('127', '6');
INSERT INTO `permission_role` VALUES ('128', '5');
INSERT INTO `permission_role` VALUES ('128', '6');
INSERT INTO `permission_role` VALUES ('129', '5');
INSERT INTO `permission_role` VALUES ('129', '6');
INSERT INTO `permission_role` VALUES ('130', '5');
INSERT INTO `permission_role` VALUES ('130', '6');
