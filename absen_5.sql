/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : absen

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-21 13:29:40
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_c
-- ----------------------------
INSERT INTO `data_c` VALUES ('10', '9', '0');
INSERT INTO `data_c` VALUES ('14', '10', '0');
INSERT INTO `data_c` VALUES ('17', '13', '0');
INSERT INTO `data_c` VALUES ('18', '14', '0');
INSERT INTO `data_c` VALUES ('20', '17', '0');

-- ----------------------------
-- Table structure for data_i
-- ----------------------------
DROP TABLE IF EXISTS `data_i`;
CREATE TABLE `data_i` (
  `id_i` smallint(255) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_i`),
  KEY `fk_id_K` (`id_k`),
  CONSTRAINT `fk_id_K` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_i
-- ----------------------------
INSERT INTO `data_i` VALUES ('8', '10', 'Nang Panjen', '10:19:16', '13:19:26', '2017-06-16');

-- ----------------------------
-- Table structure for data_j
-- ----------------------------
DROP TABLE IF EXISTS `data_j`;
CREATE TABLE `data_j` (
  `id_j` tinyint(4) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_j`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_j
-- ----------------------------
INSERT INTO `data_j` VALUES ('2', 'jabatan mas ibnu rev bakri');
INSERT INTO `data_j` VALUES ('3', 'jabatan mas lukman');
INSERT INTO `data_j` VALUES ('4', 'jabatan mas beny');
INSERT INTO `data_j` VALUES ('5', 'jabatan mas maulidi');
INSERT INTO `data_j` VALUES ('6', 'jabatan mas zen');
INSERT INTO `data_j` VALUES ('7', 'jabatan mas dimas');
INSERT INTO `data_j` VALUES ('8', 'jabatan mbak iva rev');

-- ----------------------------
-- Table structure for data_k
-- ----------------------------
DROP TABLE IF EXISTS `data_k`;
CREATE TABLE `data_k` (
  `id_k` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_k` varchar(255) NOT NULL,
  `alamat_k` varchar(255) NOT NULL,
  `email_k` varchar(255) NOT NULL,
  `noHp_k` varchar(255) NOT NULL,
  `jabatan_k` tinyint(6) NOT NULL,
  `foto_k` varchar(255) NOT NULL,
  PRIMARY KEY (`id_k`),
  UNIQUE KEY `email_K` (`email_k`),
  KEY `FK_data_k_data_j` (`jabatan_k`),
  CONSTRAINT `FK_data_k_data_j` FOREIGN KEY (`jabatan_k`) REFERENCES `data_j` (`id_j`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_k
-- ----------------------------
INSERT INTO `data_k` VALUES ('9', 'mbak iva rev', 'alamat mbak iva rev', 'emailmbakiva@gmail.com', '0000000000001', '8', 'assets/img/dcm_p1.jpg');
INSERT INTO `data_k` VALUES ('10', 'mas ibnu rev', 'alamat mas ibnu', 'emailmasibnu@gmail.com', '11111111111111111111', '2', 'assets/img/77_photography_techniques-outlined_CAR1.jpg');
INSERT INTO `data_k` VALUES ('13', 'mas dimas', 'alamat mas dimas', 'emailmasdimas@gmail.com', '11111111111111111111', '7', 'assets/img/download.jpg');
INSERT INTO `data_k` VALUES ('14', 'mas lukman rev', 'alamat mas lukman', 'emailmaslukman@gmail.com', '11111111111111111111', '3', 'assets/img/10_rules_photo_composition.jpg');
INSERT INTO `data_k` VALUES ('17', 'mas zen', 'alamat mas zen', 'emailmaszen@gmail.com', '11111111111111111111', '6', 'assets/img/Canon_photography_tips_techniques.jpg');

-- ----------------------------
-- Table structure for data_l
-- ----------------------------
DROP TABLE IF EXISTS `data_l`;
CREATE TABLE `data_l` (
  `id_L` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `username_k` varchar(255) NOT NULL,
  `password_k` varchar(255) NOT NULL,
  `hak_akses` varchar(255) NOT NULL,
  PRIMARY KEY (`id_L`),
  UNIQUE KEY `username_karyawan` (`username_k`),
  KEY `K_L_id_karyawan` (`id_k`),
  CONSTRAINT `id_k_id_k` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_l
-- ----------------------------
INSERT INTO `data_l` VALUES ('9', '9', 'usernamembakivarev', 'f022b8970604d7f4472189cb21df2c20', '3');
INSERT INTO `data_l` VALUES ('10', '10', 'usernamemasibnu', 'f022b8970604d7f4472189cb21df2c20', '3');
INSERT INTO `data_l` VALUES ('13', '13', 'usernamemasdimas', 'f022b8970604d7f4472189cb21df2c20', '2');
INSERT INTO `data_l` VALUES ('14', '14', 'usernamemaslukman', 'a21b311ff665ea8372cfc63b5ad726f5', '2');
INSERT INTO `data_l` VALUES ('16', '17', 'usernamemaszen', 'f022b8970604d7f4472189cb21df2c20', '1');

-- ----------------------------
-- Table structure for data_libur
-- ----------------------------
DROP TABLE IF EXISTS `data_libur`;
CREATE TABLE `data_libur` (
  `id_libur` smallint(6) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_libur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_libur
-- ----------------------------
INSERT INTO `data_libur` VALUES ('2', 'libur nasional', '2017-06-18');
INSERT INTO `data_libur` VALUES ('3', 'liburan dulu', '2017-05-21');
INSERT INTO `data_libur` VALUES ('4', 'libur apa', '2017-06-10');

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
INSERT INTO `data_m` VALUES ('1', '07:00:01');
INSERT INTO `data_m` VALUES ('2', '2017');
INSERT INTO `data_m` VALUES ('4', '15:00:01');

-- ----------------------------
-- Table structure for data_ra
-- ----------------------------
DROP TABLE IF EXISTS `data_ra`;
CREATE TABLE `data_ra` (
  `id_a` smallint(255) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `id_s` smallint(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `acc` varchar(50) NOT NULL,
  PRIMARY KEY (`id_a`),
  KEY `K_A_id_karyawan` (`id_k`),
  KEY `K_A_id_status` (`id_s`),
  CONSTRAINT `K_A_id_karyawan` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `K_A_id_status` FOREIGN KEY (`id_s`) REFERENCES `data_s` (`id_s`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_ra
-- ----------------------------
INSERT INTO `data_ra` VALUES ('5', '13', '1', 'telat', '2017-06-15', '18:42:30', '1');
INSERT INTO `data_ra` VALUES ('6', '14', '1', 'telat', '2017-06-15', '18:42:38', '1');
INSERT INTO `data_ra` VALUES ('7', '17', '1', 'telat', '2017-06-15', '18:42:46', '1');
INSERT INTO `data_ra` VALUES ('13', '9', '1', 'telat', '2017-01-16', '13:08:10', '1');
INSERT INTO `data_ra` VALUES ('15', '10', '1', 'telat', '2017-06-16', '10:18:23', '1');
INSERT INTO `data_ra` VALUES ('16', '13', '1', 'telat', '2017-06-09', '13:26:43', '0');
INSERT INTO `data_ra` VALUES ('17', '17', '1', 'telat', '2017-06-09', '13:28:01', '0');
INSERT INTO `data_ra` VALUES ('18', '9', '1', 'tepat waktu', '2017-06-09', '01:24:24', '1');
INSERT INTO `data_ra` VALUES ('19', '10', '1', 'tepat waktu', '2017-06-09', '01:24:34', '0');
INSERT INTO `data_ra` VALUES ('20', '9', '1', 'tepat waktu', '2017-05-18', '01:31:22', '1');
INSERT INTO `data_ra` VALUES ('21', '10', '1', 'tepat waktu', '2017-06-19', '01:31:31', '0');
INSERT INTO `data_ra` VALUES ('23', '9', '1', 'telat', '2017-05-19', '09:16:07', '1');
INSERT INTO `data_ra` VALUES ('25', '9', '1', 'tepat waktu', '2017-06-20', '06:55:06', '1');
INSERT INTO `data_ra` VALUES ('26', '10', '1', 'tepat waktu', '2017-06-20', '06:57:39', '1');
INSERT INTO `data_ra` VALUES ('28', '13', '1', 'tepat waktu', '2017-06-20', '06:57:55', '1');
INSERT INTO `data_ra` VALUES ('29', '14', '1', 'tepat waktu', '2017-06-20', '06:58:06', '1');
INSERT INTO `data_ra` VALUES ('30', '17', '1', 'telat', '2017-06-20', '16:28:35', '1');
INSERT INTO `data_ra` VALUES ('31', '9', '1', 'tepat waktu', '2017-06-21', '02:22:16', '1');

-- ----------------------------
-- Table structure for data_s
-- ----------------------------
DROP TABLE IF EXISTS `data_s`;
CREATE TABLE `data_s` (
  `id_s` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_s` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_s`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_s
-- ----------------------------
INSERT INTO `data_s` VALUES ('1', 'hadir');
INSERT INTO `data_s` VALUES ('3', 'cuti');
INSERT INTO `data_s` VALUES ('4', 'sakit');
INSERT INTO `data_s` VALUES ('5', 'alpha');
INSERT INTO `data_s` VALUES ('6', 'ijin 1 hari');
INSERT INTO `data_s` VALUES ('7', 'libur');
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
if new.id_s = '3' then update data_c set data_c.cuti_berapakali = data_c.cuti_berapakali + 1 where data_c.id_k = new.id_k;
end if;
end
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `data_ra_after_update`;
DELIMITER ;;
CREATE TRIGGER `data_ra_after_update` AFTER UPDATE ON `data_ra` FOR EACH ROW BEGIN
	if old.id_s = 3 and new.id_s != 3 then 
	update data_c set data_c.cuti_berapakali = (data_c.cuti_berapakali - 1) where data_c.id_k=new.id_k;
	elseif old.id_s != 3 and new.id_s = 3 then
	update data_c set data_c.cuti_berapakali = (data_c.cuti_berapakali + 1) where data_c.id_k= new.id_k;
	elseif old.id_s = 1 and new.id_s != 1 then
	delete from data_i where data_i.id_k = new.id_k and data_i.tanggal = new.tanggal;
	end if;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `data_ra_after_delete`;
DELIMITER ;;
CREATE TRIGGER `data_ra_after_delete` AFTER DELETE ON `data_ra` FOR EACH ROW BEGIN
if old.id_s = 3 then 
update data_c set data_c.cuti_berapakali = data_c.cuti_berapakali - 1 where data_c.id_k = old.id_k;
elseif old.id_s = 1 then
delete from data_i where data_i.id_k = old.id_k and data_i.tanggal = old.tanggal;
end if;
END
;;
DELIMITER ;
