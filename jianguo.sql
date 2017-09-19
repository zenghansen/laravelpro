# Host: 192.168.82.27  (Version: 5.6.29-log)
# Date: 2017-09-19 16:14:55
# Generator: MySQL-Front 5.3  (Build 4.214)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "jg_customer"
#

DROP TABLE IF EXISTS `jg_customer`;
CREATE TABLE `jg_customer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(15) NOT NULL DEFAULT '',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `addr` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDel` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(5000) NOT NULL DEFAULT '',
  `adminId` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "jg_customer"
#


#
# Structure for table "jg_user"
#

DROP TABLE IF EXISTS `jg_user`;
CREATE TABLE `jg_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `roleId` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1:超级管理员，2普通',
  `email` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDel` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `realName` varchar(255) NOT NULL DEFAULT '',
  `remember_token` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "jg_user"
#


#
# Structure for table "jg_user_mods"
#

DROP TABLE IF EXISTS `jg_user_mods`;
CREATE TABLE `jg_user_mods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) unsigned NOT NULL DEFAULT '0',
  `mid` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "jg_user_mods"
#

