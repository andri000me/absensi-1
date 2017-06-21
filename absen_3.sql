/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : absen

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-09 18:30:07
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_c
-- ----------------------------
INSERT INTO `data_c` VALUES ('10', '9', '2');
INSERT INTO `data_c` VALUES ('14', '10', '0');
INSERT INTO `data_c` VALUES ('15', '11', '0');
INSERT INTO `data_c` VALUES ('16', '12', '0');

-- ----------------------------
-- Table structure for data_i
-- ----------------------------
DROP TABLE IF EXISTS `data_i`;
CREATE TABLE `data_i` (
  `id_i` smallint(255) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_i`),
  KEY `fk_id_K` (`id_k`),
  CONSTRAINT `fk_id_K` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_K`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_i
-- ----------------------------
INSERT INTO `data_i` VALUES ('1', '9', 'shoping', '02:10:00', '11:55:00', '2017-06-23');
INSERT INTO `data_i` VALUES ('3', '12', 'asdas', '09:45:00', '09:55:00', '2017-06-09');

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
INSERT INTO `data_j` VALUES ('1', 'Designer');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_k
-- ----------------------------
INSERT INTO `data_k` VALUES ('9', 'mbak iva', 'alamat mbak iva', 'emailmbakiva@gmail.com', '000000000000', '8', 'assets/img/805c294ac4e109f1eb969af7296852ec.jpg');
INSERT INTO `data_k` VALUES ('10', 'mas ibnu', 'alamat mas ibnu', 'emailmasibnu@gmail.com', '11111111111111111111', '2', 'assets/img/pwkd_p1.jpg');
INSERT INTO `data_k` VALUES ('11', 'mas beni', 'alamat mas beni', 'emailmasbeni@gmail.com', '11111111111111111111', '4', 'assets/img/3.jpg');
INSERT INTO `data_k` VALUES ('12', 'Faiz Al-Qurni', 'Jl. Simpang Kepuh No.12', 'faiz@illiyin.co', '085815263157', '1', 'assets/img/Foto.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_l
-- ----------------------------
INSERT INTO `data_l` VALUES ('9', '9', 'usernamembakiva', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('10', '10', 'usernamemasibnu', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('11', '11', 'usernamemasbeni', 'e39850198755cbdc1fefb4e888682bad');
INSERT INTO `data_l` VALUES ('12', '12', 'faizalqurni', 'e13c6b0a41d79b4e700927051b9f261e');

-- ----------------------------
-- Table structure for data_m
-- ----------------------------
DROP TABLE IF EXISTS `data_m`;
CREATE TABLE `data_m` (
  `id_m` smallint(255) NOT NULL AUTO_INCREMENT,
  `misc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_m
-- ----------------------------
INSERT INTO `data_m` VALUES ('1', '07:00:00');
INSERT INTO `data_m` VALUES ('2', '2018');
INSERT INTO `data_m` VALUES ('3', '07:00:00');
INSERT INTO `data_m` VALUES ('4', '15:00:00');

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
  `jam` time NOT NULL,
  PRIMARY KEY (`id_A`),
  KEY `K_A_id_karyawan` (`id_karyawan`),
  KEY `K_A_id_status` (`id_status`),
  CONSTRAINT `K_A_id_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `data_k` (`id_K`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `K_A_id_status` FOREIGN KEY (`id_status`) REFERENCES `data_s` (`id_S`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_ra
-- ----------------------------
INSERT INTO `data_ra` VALUES ('27', '11', '5', '', '2017-06-08', '20:04:50');
INSERT INTO `data_ra` VALUES ('31', '12', '5', 'telat', '2017-06-09', '10:20:06');
INSERT INTO `data_ra` VALUES ('32', '12', '1', 'telat', '2017-06-09', '10:21:10');

-- ----------------------------
-- Table structure for data_s
-- ----------------------------
DROP TABLE IF EXISTS `data_s`;
CREATE TABLE `data_s` (
  `id_S` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_S` varchar(255) NOT NULL,
  PRIMARY KEY (`id_S`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_s
-- ----------------------------
INSERT INTO `data_s` VALUES ('1', 'hadir');
INSERT INTO `data_s` VALUES ('3', 'cuti');
INSERT INTO `data_s` VALUES ('5', 'sakit');
INSERT INTO `data_s` VALUES ('6', 'alpha');
DROP TRIGGER IF EXISTS `reset_cuti_berapakali`;
DELIMITER ;;
CREATE TRIGGER `reset_cuti_berapakali` AFTER UPDATE ON `data_m` FOR EACH ROW begin
if new.id_m = 2 then
update data_c 
set cuti_berapakali =  0 ;
end if;
end
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `updatetime`;
DELIMITER ;;
CREATE TRIGGER `updatetime` BEFORE INSERT ON `data_ra` FOR EACH ROW BEGIN
	/*IF NEW.jam = '00:00:00' THEN*/
		SET NEW.jam = CURRENT_TIMESTAMP();
	/*END IF;*/
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `update_berapakali_cuti`;
DELIMITER ;;
CREATE TRIGGER `update_berapakali_cuti` AFTER INSERT ON `data_ra` FOR EACH ROW begin
if new.id_status = '3' then

update data_c
set data_c.cuti_berapakali = data_c.cuti_berapakali + 1
where data_c.id_k = new.id_karyawan;
end if;
end
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `data_ra_after_update`;
DELIMITER ;;
CREATE TRIGGER `data_ra_after_update` AFTER UPDATE ON `data_ra` FOR EACH ROW BEGIN
	if old.id_status = 3 and new.id_status != 3 then 
	update data_c set data_c.cuti_berapakali = (data_c.cuti_berapakali - 1) where data_c.id_k=new.id_karyawan;
	elseif new.id_status = 3 then
	update data_c set data_c.cuti_berapakali = (data_c.cuti_berapakali + 1) where data_c.id_k= new.id_karyawan;
	end if;
END
;;
DELIMITER ;
