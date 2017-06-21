/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : absen

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-03 16:33:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_j
-- ----------------------------
DROP TABLE IF EXISTS `data_j`;
CREATE TABLE `data_j` (
  `id_J` tinyint(6) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_J`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for data_s
-- ----------------------------
DROP TABLE IF EXISTS `data_s`;
CREATE TABLE `data_s` (
  `id_S` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_S` varchar(255) NOT NULL,
  PRIMARY KEY (`id_S`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
