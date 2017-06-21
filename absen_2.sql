/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : absen

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-08 13:27:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_c
-- ----------------------------
DROP TABLE IF EXISTS `data_c`;
CREATE TABLE `data_c` (
  `id_c` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `cuti_berapakali` smallint(6) NOT NULL,
  PRIMARY KEY (`id_c`),
  KEY `data_c_id_k` (`id_k`),
  CONSTRAINT `data_c_id_k` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_K`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_c
-- ----------------------------

-- ----------------------------
-- Table structure for data_i
-- ----------------------------
DROP TABLE IF EXISTS `data_i`;
CREATE TABLE `data_i` (
  `id_i` smallint(255) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `start` time(6) NOT NULL,
  `end` time(6) NOT NULL,
  PRIMARY KEY (`id_i`),
  KEY `fk_id_K` (`id_k`),
  CONSTRAINT `fk_id_K` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_K`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_i
-- ----------------------------
INSERT INTO `data_i` VALUES ('1', '1', 'tuku sate', '09:10:00.000000', '10:00:00.000000');
INSERT INTO `data_i` VALUES ('2', '3', 'tuku piring', '12:00:00.000000', '13:00:00.000000');

-- ----------------------------
-- Table structure for data_j
-- ----------------------------
DROP TABLE IF EXISTS `data_j`;
CREATE TABLE `data_j` (
  `id_J` tinyint(6) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_J`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_j
-- ----------------------------
INSERT INTO `data_j` VALUES ('1', 'jabatan mas faiz rev');
INSERT INTO `data_j` VALUES ('2', 'jabatan mas ibnu');
INSERT INTO `data_j` VALUES ('3', 'jabatan mas lukman');
INSERT INTO `data_j` VALUES ('4', 'jabatan mas beny');
INSERT INTO `data_j` VALUES ('5', 'jabatan mas maulidi');
INSERT INTO `data_j` VALUES ('6', 'jabatan mas zen');
INSERT INTO `data_j` VALUES ('7', 'jabatan mas dimas');
INSERT INTO `data_j` VALUES ('8', 'jabatan mbak iva');
INSERT INTO `data_j` VALUES ('9', 'jabatan percobaan');
INSERT INTO `data_j` VALUES ('10', 'jabatan njajak');

-- ----------------------------
-- Table structure for data_k
-- ----------------------------
DROP TABLE IF EXISTS `data_k`;
CREATE TABLE `data_k` (
  `id_K` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_K` varchar(255) NOT NULL,
  `alamat_K` varchar(255) NOT NULL,
  `email_K` varchar(255) NOT NULL,
  `noHp_K` varchar(255) NOT NULL,
  `jabatan_K` tinyint(6) NOT NULL,
  `foto_K` varchar(255) NOT NULL,
  PRIMARY KEY (`id_K`),
  UNIQUE KEY `email_K` (`email_K`),
  KEY `K_J_id_jabatan` (`jabatan_K`),
  CONSTRAINT `K_J_id_jabatan` FOREIGN KEY (`jabatan_K`) REFERENCES `data_j` (`id_J`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_k
-- ----------------------------
INSERT INTO `data_k` VALUES ('1', 'mas faiz', 'alamat mas faiz', 'emailmasfaiz@gmail.com', '000000000000', '1', 'assets/img/1a0e908dc40196acc20e41c2cb95f793.jpg');
INSERT INTO `data_k` VALUES ('3', 'mas ibnu', 'alamat mas ibnu', 'emailmasibnu@gmail.com', '000000000000', '2', 'assets/img/9fbbc208f792101837a4ec367e2caf8c.png');
INSERT INTO `data_k` VALUES ('4', 'mas lukman', 'alamat mas lukman', 'emailmaslukman@gmail.com', '000000000000', '3', 'assets/img/44c69b60ae1f60c2f36acca6d63655e5.jpg');
INSERT INTO `data_k` VALUES ('5', 'mas beni', 'alamat mas beni', 'emailmasbeni@gmail.com', '000000000000', '4', 'assets/img/9160d0d02dc7696563236a92716feea3.png');
INSERT INTO `data_k` VALUES ('6', 'mas maulidi', 'alamat mas maulidi', 'emailmasmaulidi@gmail.com', '000000000000', '5', 'assets/img/204861-1389626817.jpg');
INSERT INTO `data_k` VALUES ('7', 'mas zen', 'alamat mas zen', 'emailmaszen@gmail.com', '000000000000', '6', 'assets/img/816711b809f3137f2cb0cba2dd09919a.jpg');
INSERT INTO `data_k` VALUES ('8', 'mas dimas', 'alamat mas dimas', 'emailmasdimas@gmail.com', '000000000000', '7', 'assets/img/a06044411b63476c618c796135e8b11d.jpg');
INSERT INTO `data_k` VALUES ('9', 'mbak iva', 'alamat mbak iva', 'emailmbakiva@gmail.com', '000000000000', '8', 'assets/img/805c294ac4e109f1eb969af7296852ec.jpg');

-- ----------------------------
-- Table structure for data_l
-- ----------------------------
DROP TABLE IF EXISTS `data_l`;
CREATE TABLE `data_l` (
  `id_L` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_karyawan` smallint(6) NOT NULL,
  `username_karyawan` varchar(255) NOT NULL,
  `password_karyawan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_L`),
  UNIQUE KEY `username_karyawan` (`username_karyawan`),
  KEY `K_L_id_karyawan` (`id_karyawan`),
  CONSTRAINT `K_L_id_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `data_k` (`id_K`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_l
-- ----------------------------
INSERT INTO `data_l` VALUES ('1', '1', 'illiyindotco', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('3', '3', 'usernamemasibnu', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('4', '4', 'usernamemaslukman', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('5', '5', 'usernamemasbeni', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('6', '6', 'usernamemasmaulidi', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('7', '7', 'usernamemaszen', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('8', '8', 'usernamemasdimas', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('9', '9', 'usernamembakiva', 'e39850198755cbdc1fefb4e888682bad');

-- ----------------------------
-- Table structure for data_m
-- ----------------------------
DROP TABLE IF EXISTS `data_m`;
CREATE TABLE `data_m` (
  `id_m` smallint(255) NOT NULL AUTO_INCREMENT,
  `misc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_m
-- ----------------------------
INSERT INTO `data_m` VALUES ('1', '07:00:03');
INSERT INTO `data_m` VALUES ('2', '2017');

-- ----------------------------
-- Table structure for data_ra
-- ----------------------------
DROP TABLE IF EXISTS `data_ra`;
CREATE TABLE `data_ra` (
  `id_A` smallint(255) NOT NULL AUTO_INCREMENT,
  `id_karyawan` smallint(6) NOT NULL,
  `id_status` smallint(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time(6) NOT NULL,
  PRIMARY KEY (`id_A`),
  KEY `K_A_id_karyawan` (`id_karyawan`),
  KEY `K_A_id_status` (`id_status`),
  CONSTRAINT `K_A_id_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `data_k` (`id_K`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `K_A_id_status` FOREIGN KEY (`id_status`) REFERENCES `data_s` (`id_S`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_ra
-- ----------------------------
INSERT INTO `data_ra` VALUES ('2', '3', '1', 'telat', '2017-06-06', '19:48:46.000000');
INSERT INTO `data_ra` VALUES ('4', '8', '1', 'telat', '2017-06-07', '07:28:11.000000');
INSERT INTO `data_ra` VALUES ('5', '4', '1', 'telat', '2017-06-07', '07:37:17.000000');
INSERT INTO `data_ra` VALUES ('7', '1', '2', 'tepat waktu', '2017-06-07', '09:29:25.000000');
INSERT INTO `data_ra` VALUES ('8', '1', '2', 'tepat waktu', '2017-06-08', '05:13:35.000000');
INSERT INTO `data_ra` VALUES ('10', '4', '2', 'tepat waktu', '2017-06-08', '05:22:04.000000');
INSERT INTO `data_ra` VALUES ('11', '5', '2', 'tepat waktu', '2017-06-08', '05:53:04.000000');
INSERT INTO `data_ra` VALUES ('12', '1', '3', 'tepat waktu', '2017-06-06', '09:29:25.000000');
INSERT INTO `data_ra` VALUES ('13', '1', '4', 'tepat waktu', '2017-06-05', '05:13:35.000000');
INSERT INTO `data_ra` VALUES ('14', '1', '5', 'tepat waktu', '2017-06-04', '09:29:25.000000');
INSERT INTO `data_ra` VALUES ('15', '1', '3', 'tepat waktu', '2017-06-03', '05:13:35.000000');
INSERT INTO `data_ra` VALUES ('16', '1', '2', 'tepat waktu', '2017-05-07', '09:29:25.000000');
INSERT INTO `data_ra` VALUES ('17', '1', '2', 'tepat waktu', '2017-05-07', '05:13:35.000000');

-- ----------------------------
-- Table structure for data_s
-- ----------------------------
DROP TABLE IF EXISTS `data_s`;
CREATE TABLE `data_s` (
  `id_S` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_S` varchar(255) NOT NULL,
  PRIMARY KEY (`id_S`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_s
-- ----------------------------
INSERT INTO `data_s` VALUES ('1', 'hadir');
INSERT INTO `data_s` VALUES ('2', 'menginap');
INSERT INTO `data_s` VALUES ('3', 'cuti');
INSERT INTO `data_s` VALUES ('4', 'izin');
INSERT INTO `data_s` VALUES ('5', 'sakit');
INSERT INTO `data_s` VALUES ('6', 'alpha');
INSERT INTO `data_s` VALUES ('7', 'Kaajallahva');
