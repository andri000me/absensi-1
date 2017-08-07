/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : absen

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-07 18:45:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_c
-- ----------------------------
DROP TABLE IF EXISTS `data_c`;
CREATE TABLE `data_c` (
  `id_c` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `cuti_berapakali` int(6) NOT NULL,
  `jatah_cuti` int(6) DEFAULT NULL,
  `last_sync` date DEFAULT NULL,
  PRIMARY KEY (`id_c`),
  KEY `data_c_id_k` (`id_k`),
  CONSTRAINT `data_c_id_k` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_c
-- ----------------------------
INSERT INTO `data_c` VALUES ('10', '9', '0', '3', '2017-08-07');
INSERT INTO `data_c` VALUES ('14', '10', '0', '7', '2017-08-07');
INSERT INTO `data_c` VALUES ('17', '13', '1', '3', '2017-08-07');
INSERT INTO `data_c` VALUES ('18', '14', '0', '3', '2017-08-07');
INSERT INTO `data_c` VALUES ('20', '17', '4', '5', '2017-08-07');
INSERT INTO `data_c` VALUES ('21', '18', '1', '4', '2017-08-07');
INSERT INTO `data_c` VALUES ('22', '20', '0', '9', '2017-08-07');
INSERT INTO `data_c` VALUES ('34', '42', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('35', '43', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('36', '44', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('37', '45', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('38', '46', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('40', '48', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('41', '49', '0', '0', '0000-00-00');
INSERT INTO `data_c` VALUES ('42', '50', '0', '0', '0000-00-00');

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
  `denda` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_i`),
  KEY `fk_id_K` (`id_k`),
  CONSTRAINT `fk_id_K` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_i
-- ----------------------------
INSERT INTO `data_i` VALUES ('20', '10', 'pulang duluan 14:30 - 16.00', '15:00:00', '16:00:00', '2017-07-06', '3000');
INSERT INTO `data_i` VALUES ('29', '10', 'ijin sakit', '08:00:00', '10:00:00', '2017-07-07', '6000');
INSERT INTO `data_i` VALUES ('30', '20', 'ijin sakit', '12:30:00', '16:00:00', '2017-07-10', '12000');
INSERT INTO `data_i` VALUES ('31', '10', 'ijin sakit', '08:00:00', '16:00:00', '2017-07-12', '24000');
INSERT INTO `data_i` VALUES ('32', '20', 'ijin sakit', '10:00:00', '16:00:00', '2017-07-12', '18000');
INSERT INTO `data_i` VALUES ('33', '14', 'tambal ban 11.10 - 11.50', '11:10:00', '11:50:00', '2017-07-12', '3000');
INSERT INTO `data_i` VALUES ('34', '13', 'ijin unknown', '13:30:00', '14:30:00', '2017-07-13', '3000');
INSERT INTO `data_i` VALUES ('47', '48', 'ijin menemui orang tua', '12:13:00', '16:00:00', '2017-07-17', '0');
INSERT INTO `data_i` VALUES ('49', '43', 'ijin guru. masuk jam 11', '08:00:00', '11:00:00', '2017-07-24', '9000');
INSERT INTO `data_i` VALUES ('50', '43', 'ijin guru masuk jam 10.30', '07:30:00', '10:30:00', '2017-07-25', '9000');
INSERT INTO `data_i` VALUES ('51', '18', 'ijin puluang dulu 14.30- 16.00', '15:00:00', '16:00:00', '2017-07-27', '3000');
INSERT INTO `data_i` VALUES ('53', '14', 'ijin mules', '07:40:00', '08:10:00', '2017-07-28', '3000');
INSERT INTO `data_i` VALUES ('54', '43', 'ijin guru', '07:30:00', '10:30:00', '2017-07-31', '9000');
INSERT INTO `data_i` VALUES ('55', '43', 'ijin guru', '07:30:00', '10:30:00', '2017-08-01', '9000');

-- ----------------------------
-- Table structure for data_j
-- ----------------------------
DROP TABLE IF EXISTS `data_j`;
CREATE TABLE `data_j` (
  `id_j` tinyint(4) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_j`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_j
-- ----------------------------
INSERT INTO `data_j` VALUES ('2', 'CEO (Direktur)');
INSERT INTO `data_j` VALUES ('3', 'CTO (Kepala Teknis)');
INSERT INTO `data_j` VALUES ('5', 'CFO (Keuangan)');
INSERT INTO `data_j` VALUES ('6', 'CSR (Social Media)');
INSERT INTO `data_j` VALUES ('7', 'COO (Operasional)');
INSERT INTO `data_j` VALUES ('9', 'karyawan');
INSERT INTO `data_j` VALUES ('10', 'CMO (Marketing)');
INSERT INTO `data_j` VALUES ('11', 'Entertaiment');
INSERT INTO `data_j` VALUES ('12', 'Magang');

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
  `date_added` date NOT NULL,
  `bisa_cuti` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_k`),
  UNIQUE KEY `email_K` (`email_k`),
  KEY `FK_data_k_data_j` (`jabatan_k`),
  CONSTRAINT `id_j` FOREIGN KEY (`jabatan_k`) REFERENCES `data_j` (`id_j`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_k
-- ----------------------------
INSERT INTO `data_k` VALUES ('9', 'Imaniar H', 'jalan manggar', 'emailmbakiva@gmail.com', '081333662055', '5', 'assets/img/pp_(3).jpg', '2016-07-12', '1');
INSERT INTO `data_k` VALUES ('10', 'Ibnu Shodiqin Suhaemy', 'alamat mas ibnu', 'emailmasibnu@gmail.com', '089680752154', '3', 'assets/img/masibnu1.jpg', '2016-06-14', '1');
INSERT INTO `data_k` VALUES ('13', 'Dimas Virdana', 'alamat mas dimas', 'emailmasdimas@gmail.com', '089539946836 / 089646683967', '7', 'assets/img/masdimas1.jpg', '2016-06-14', '1');
INSERT INTO `data_k` VALUES ('14', 'Muhammad Luqman Hakim', 'alamat mas lukman', 'emailmaslukman@gmail.com', '085941020493', '10', 'assets/img/original1.png', '2016-06-14', '1');
INSERT INTO `data_k` VALUES ('17', 'Faiz Al-qurni', 'alamat', 'emailmaszen@gmail.com', '11111111111111111111', '2', 'assets/img/avatar51.jpg', '2016-06-14', '1');
INSERT INTO `data_k` VALUES ('18', 'Akhmad Maulidi', 'polres', 'polis@lkja.asd', '081939292602', '9', 'assets/img/15534864_324278627970858_5811524440105680896_n1.jpg', '2016-06-14', '1');
INSERT INTO `data_k` VALUES ('20', 'Muhammad Handharbeni', 'kjlkjlhjlvb', 'emailsatu@gmail.com', '081556617741', '9', 'assets/img/286895-580da1a49f5271.jpg', '2016-06-14', '1');
INSERT INTO `data_k` VALUES ('42', 'Mindha Ningrum', 'magang', 'magang@gas.asa', '082332443770', '12', 'assets/img/pp1.jpg', '2017-07-15', '0');
INSERT INTO `data_k` VALUES ('43', 'Andy Zain', 'singosari bos', 'asdad@sdasd.asd', '085749605965', '6', 'assets/img/13597550_1640886266237820_2091425563_a1.jpg', '2017-07-17', '0');
INSERT INTO `data_k` VALUES ('44', 'Hidayatul Vicria', 'dayat', 'dayat@gmail.com', '085649561774', '12', 'assets/img/pp_(1).jpg', '2017-07-20', '0');
INSERT INTO `data_k` VALUES ('45', 'Kiki Eka Rinaldi', 'asd', 'kiki@ads.ada', '082233397423', '12', 'assets/img/pp_(7).jpg', '2017-07-20', '0');
INSERT INTO `data_k` VALUES ('46', 'Reynaldo Alfa', 'reynaldo', 'reynaldo@asadas.aa', '081333420153', '12', 'assets/img/pp_(2).jpg', '2017-07-20', '0');
INSERT INTO `data_k` VALUES ('48', 'Puri Indah Rosita', 'puri', 'puri@aad.asd', '+6285704742842', '12', 'assets/img/pp_(6).jpg', '2017-07-20', '0');
INSERT INTO `data_k` VALUES ('49', 'Tovia Oktavia', 'tovia', 'tovia@afs.aas', '+6282164236036', '12', 'assets/img/pp_(4).jpg', '2017-07-20', '0');
INSERT INTO `data_k` VALUES ('50', 'Yoi', 'laksdjl', 'yogi@gmail.com', '0840981234987', '12', 'assets/img/pp_(1)1.jpg', '2017-08-03', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_l
-- ----------------------------
INSERT INTO `data_l` VALUES ('9', '9', 'usernamembakivareva', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('10', '10', 'usernamemasibnu', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('13', '13', 'dimas', 'b93b0bbe8f536b92d86685d93d51469a', '2');
INSERT INTO `data_l` VALUES ('14', '14', 'maslukman', 'b93b0bbe8f536b92d86685d93d51469a', '2');
INSERT INTO `data_l` VALUES ('16', '17', 'faiz', '9d4d4ab0dfdb72a54b895d78b90b09c7', '1');
INSERT INTO `data_l` VALUES ('17', '18', 'jihad', 'b93b0bbe8f536b92d86685d93d51469a', '2');
INSERT INTO `data_l` VALUES ('19', '20', 'usernamemasida', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('41', '42', 'mindha', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('42', '43', 'maszen', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('43', '44', 'dayat', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('44', '45', 'kiki', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('45', '46', 'reynaldo', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('47', '48', 'puri', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('48', '49', 'tovia', 'b93b0bbe8f536b92d86685d93d51469a', '3');
INSERT INTO `data_l` VALUES ('49', '50', 'yogi', '938e14c074c45c62eb15cc05a6f36d79', '3');

-- ----------------------------
-- Table structure for data_libur
-- ----------------------------
DROP TABLE IF EXISTS `data_libur`;
CREATE TABLE `data_libur` (
  `id_libur` smallint(6) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_libur`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_libur
-- ----------------------------
INSERT INTO `data_libur` VALUES ('8', 'sisa hari raya', '2017-07-03');

-- ----------------------------
-- Table structure for data_m
-- ----------------------------
DROP TABLE IF EXISTS `data_m`;
CREATE TABLE `data_m` (
  `id_m` smallint(255) NOT NULL AUTO_INCREMENT,
  `misc` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_m
-- ----------------------------
INSERT INTO `data_m` VALUES ('1', '07:30:00', 'jam masuk');
INSERT INTO `data_m` VALUES ('4', '16:00:00', 'jam akhir kerja');
INSERT INTO `data_m` VALUES ('5', '3000', 'denda per jam untuk ijin 1 hari');
INSERT INTO `data_m` VALUES ('6', '3000', 'denda per jam untuk ijin per jam saat jam kerja');
INSERT INTO `data_m` VALUES ('7', '5000', 'denda keterlambatan per 15 menit');
INSERT INTO `data_m` VALUES ('8', '5000', 'denda alpha per 15 menit');
INSERT INTO `data_m` VALUES ('9', '7', 'custom jam kerja mas dim');

-- ----------------------------
-- Table structure for data_ra
-- ----------------------------
DROP TABLE IF EXISTS `data_ra`;
CREATE TABLE `data_ra` (
  `id_a` smallint(255) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `id_s` smallint(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time NOT NULL,
  `acc` varchar(50) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `late_minute` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_a`),
  KEY `K_A_id_karyawan` (`id_k`),
  KEY `K_A_id_status` (`id_s`),
  CONSTRAINT `K_A_id_karyawan` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `K_A_id_status` FOREIGN KEY (`id_s`) REFERENCES `data_s` (`id_s`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=469 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_ra
-- ----------------------------
INSERT INTO `data_ra` VALUES ('162', '18', '6', 'otw malang', '2017-07-04', '09:45:00', '1', '21000', null);
INSERT INTO `data_ra` VALUES ('163', '43', '1', 'tepat waktu', '2017-07-04', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('164', '13', '1', 'tepat waktu', '2017-07-04', '07:23:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('165', '17', '1', 'tepat waktu', '2017-07-04', '07:18:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('166', '10', '1', 'telat', '2017-07-04', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('167', '9', '1', 'telat', '2017-07-04', '09:00:00', '1', '30000', '90');
INSERT INTO `data_ra` VALUES ('168', '20', '1', 'telat', '2017-07-04', '08:40:00', '1', '25000', '70');
INSERT INTO `data_ra` VALUES ('169', '14', '1', 'telat', '2017-07-04', '09:05:00', '1', '35000', '95');
INSERT INTO `data_ra` VALUES ('170', '9', '1', 'telat', '2017-07-05', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('171', '10', '1', 'telat', '2017-07-05', '07:35:00', '1', '5000', '5');
INSERT INTO `data_ra` VALUES ('172', '13', '1', 'tepat waktu', '2017-07-05', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('173', '14', '1', 'telat', '2017-07-05', '08:35:00', '1', '25000', '65');
INSERT INTO `data_ra` VALUES ('174', '17', '1', 'telat', '2017-07-05', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('175', '18', '1', 'tepat waktu', '2017-07-05', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('176', '20', '1', 'tepat waktu', '2017-07-05', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('177', '43', '1', 'telat', '2017-07-05', '07:39:00', '1', '5000', '9');
INSERT INTO `data_ra` VALUES ('178', '18', '1', 'telat', '2017-07-06', '07:35:00', '1', '5000', '5');
INSERT INTO `data_ra` VALUES ('179', '20', '1', 'telat', '2017-07-06', '09:10:00', '1', '35000', '100');
INSERT INTO `data_ra` VALUES ('180', '14', '1', 'telat', '2017-07-06', '09:05:00', '1', '35000', '95');
INSERT INTO `data_ra` VALUES ('181', '9', '1', 'telat', '2017-07-06', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('182', '10', '1', 'tepat waktu', '2017-07-06', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('183', '13', '1', 'tepat waktu', '2017-07-06', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('184', '17', '1', 'tepat waktu', '2017-07-06', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('185', '43', '6', 'rapat guru', '2017-07-06', '07:00:00', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('186', '9', '1', 'telat', '2017-07-07', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('187', '10', '1', 'telat', '2017-07-07', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('188', '13', '1', 'tepat waktu', '2017-07-07', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('189', '14', '1', 'telat', '2017-07-07', '09:05:00', '1', '35000', '95');
INSERT INTO `data_ra` VALUES ('190', '17', '1', 'telat', '2017-07-07', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('191', '18', '1', 'telat', '2017-07-07', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('192', '20', '1', 'telat', '2017-07-07', '09:10:00', '1', '35000', '100');
INSERT INTO `data_ra` VALUES ('193', '43', '1', 'telat', '2017-07-07', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('195', '9', '1', 'telat', '2017-07-10', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('200', '10', '1', 'telat', '2017-07-10', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('201', '13', '1', 'tepat waktu', '2017-07-10', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('202', '14', '1', 'telat', '2017-07-10', '08:50:00', '1', '30000', '80');
INSERT INTO `data_ra` VALUES ('203', '17', '1', 'telat', '2017-07-10', '08:40:00', '1', '25000', '70');
INSERT INTO `data_ra` VALUES ('204', '18', '1', 'telat', '2017-07-10', '07:55:00', '1', '10000', '25');
INSERT INTO `data_ra` VALUES ('205', '20', '1', 'telat', '2017-07-10', '09:15:00', '1', '35000', '105');
INSERT INTO `data_ra` VALUES ('207', '43', '1', 'tepat waktu', '2017-07-10', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('208', '9', '1', 'telat', '2017-07-11', '07:34:00', '1', '5000', '4');
INSERT INTO `data_ra` VALUES ('209', '10', '1', 'tepat waktu', '2017-07-11', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('210', '13', '3', 'mbuh opo (ridok) ', '2017-07-11', '15:35:31', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('211', '14', '1', 'telat', '2017-07-11', '09:00:00', '1', '30000', '90');
INSERT INTO `data_ra` VALUES ('212', '17', '1', 'telat', '2017-07-11', '08:20:00', '1', '20000', '50');
INSERT INTO `data_ra` VALUES ('213', '18', '1', 'tepat waktu', '2017-07-11', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('214', '20', '1', 'telat', '2017-07-11', '09:00:00', '1', '30000', '90');
INSERT INTO `data_ra` VALUES ('215', '43', '6', 'ijin remote', '2017-07-11', '15:35:31', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('216', '9', '1', 'telat', '2017-07-12', '07:36:00', '1', '5000', '6');
INSERT INTO `data_ra` VALUES ('217', '10', '4', 'sakit unknown', '2017-07-12', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('218', '13', '1', 'tepat waktu', '2017-07-12', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('219', '14', '1', 'telat', '2017-07-12', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('220', '17', '1', 'tepat waktu', '2017-07-12', '07:28:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('221', '18', '1', 'telat', '2017-07-12', '07:35:00', '1', '5000', '5');
INSERT INTO `data_ra` VALUES ('222', '20', '4', 'sakit kepala', '2017-07-12', '08:30:00', '1', '20000', '60');
INSERT INTO `data_ra` VALUES ('223', '43', '1', 'telat', '2017-07-12', '07:48:00', '1', '10000', '18');
INSERT INTO `data_ra` VALUES ('224', '9', '4', 'asd', '2017-07-13', '08:40:00', '1', '25000', '70');
INSERT INTO `data_ra` VALUES ('225', '10', '1', 'telat', '2017-07-13', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('226', '13', '1', 'tepat waktu', '2017-07-13', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('227', '14', '1', 'telat', '2017-07-13', '09:08:00', '1', '35000', '98');
INSERT INTO `data_ra` VALUES ('228', '17', '1', 'tepat waktu', '2017-07-13', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('229', '18', '1', 'telat', '2017-07-13', '08:15:00', '1', '15000', '45');
INSERT INTO `data_ra` VALUES ('230', '20', '1', 'telat', '2017-07-13', '09:05:00', '1', '35000', '95');
INSERT INTO `data_ra` VALUES ('231', '43', '1', 'telat', '2017-07-13', '07:53:00', '1', '10000', '23');
INSERT INTO `data_ra` VALUES ('252', '9', '1', 'telat', '2017-07-14', '08:05:00', '1', '15000', '35');
INSERT INTO `data_ra` VALUES ('253', '10', '1', 'telat', '2017-07-14', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('254', '13', '1', 'tepat waktu', '2017-07-14', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('255', '14', '1', 'telat', '2017-07-14', '08:50:00', '1', '30000', '80');
INSERT INTO `data_ra` VALUES ('256', '17', '1', 'tepat waktu', '2017-07-14', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('257', '18', '1', 'tepat waktu', '2017-07-14', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('258', '20', '1', 'telat', '2017-07-14', '08:55:00', '1', '30000', '85');
INSERT INTO `data_ra` VALUES ('259', '43', '1', 'tepat waktu', '2017-07-14', '07:10:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('264', '9', '1', 'telat', '2017-07-17', '08:10:00', '1', '15000', '40');
INSERT INTO `data_ra` VALUES ('266', '13', '1', 'tepat waktu', '2017-07-17', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('267', '14', '1', 'telat', '2017-07-17', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('268', '17', '3', 'cuti unknown', '2017-07-17', '12:39:52', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('269', '18', '6', 'sakit unknown apa', '2017-07-17', '07:30:00', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('270', '20', '6', 'sakit unknown', '2017-07-17', '07:30:00', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('271', '43', '1', 'telat', '2017-07-17', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('272', '9', '1', 'telat', '2017-07-18', '08:30:00', '1', '20000', '60');
INSERT INTO `data_ra` VALUES ('273', '10', '1', 'tepat waktu', '2017-07-18', '06:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('274', '13', '1', 'tepat waktu', '2017-07-18', '07:10:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('275', '14', '1', 'telat', '2017-07-18', '08:20:00', '1', '20000', '50');
INSERT INTO `data_ra` VALUES ('276', '17', '1', 'tepat waktu', '2017-07-18', '06:45:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('277', '18', '1', 'tepat waktu', '2017-07-18', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('278', '20', '1', 'telat', '2017-07-18', '09:16:00', '1', '40000', '106');
INSERT INTO `data_ra` VALUES ('279', '43', '1', 'tepat waktu', '2017-07-18', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('280', '9', '1', 'telat', '2017-07-19', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('281', '10', '1', 'tepat waktu', '2017-07-19', '07:00:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('282', '13', '1', 'tepat waktu', '2017-07-19', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('283', '14', '1', 'telat', '2017-07-19', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('284', '17', '1', 'telat', '2017-07-19', '09:00:00', '1', '30000', '90');
INSERT INTO `data_ra` VALUES ('285', '18', '1', 'telat', '2017-07-19', '07:35:00', '1', '5000', '5');
INSERT INTO `data_ra` VALUES ('286', '20', '1', 'telat', '2017-07-19', '09:15:00', '1', '35000', '105');
INSERT INTO `data_ra` VALUES ('287', '43', '1', 'tepat waktu', '2017-07-19', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('288', '9', '1', 'telat', '2017-07-20', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('289', '10', '1', 'tepat waktu', '2017-07-20', '07:15:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('290', '13', '1', 'telat', '2017-07-20', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('291', '14', '1', 'telat', '2017-07-20', '07:50:00', '1', '10000', '20');
INSERT INTO `data_ra` VALUES ('292', '17', '1', 'tepat waktu', '2017-07-20', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('293', '18', '1', 'telat', '2017-07-20', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('294', '20', '1', 'telat', '2017-07-20', '08:20:00', '1', '20000', '50');
INSERT INTO `data_ra` VALUES ('295', '43', '1', 'tepat waktu', '2017-07-20', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('296', '10', '1', 'tepat waktu', '2017-07-24', '06:50:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('297', '13', '1', 'tepat waktu', '2017-07-24', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('298', '18', '1', 'tepat waktu', '2017-07-24', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('299', '9', '1', 'telat', '2017-07-21', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('304', '18', '1', 'tepat waktu', '2017-07-21', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('307', '43', '6', 'ijin guru', '2017-07-21', '07:50:56', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('308', '13', '1', 'tepat waktu', '2017-07-21', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('310', '17', '1', 'tepat waktu', '2017-07-21', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('311', '10', '1', 'tepat waktu', '2017-07-21', '06:45:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('312', '14', '1', 'telat', '2017-07-21', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('314', '20', '1', 'telat', '2017-07-21', '08:40:00', '1', '25000', '70');
INSERT INTO `data_ra` VALUES ('316', '17', '3', 'unknown', '2017-07-24', '06:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('317', '9', '1', 'telat', '2017-07-24', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('318', '20', '1', 'telat', '2017-07-24', '09:00:00', '1', '30000', '90');
INSERT INTO `data_ra` VALUES ('319', '14', '1', 'tepat waktu', '2017-07-24', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('327', '42', '1', 'tepat waktu', '2017-07-17', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('328', '45', '4', 'sakit unknown', '2017-07-17', '01:50:03', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('329', '44', '1', 'telat', '2017-07-17', '07:40:00', '1', '0', '10');
INSERT INTO `data_ra` VALUES ('330', '46', '1', 'telat', '2017-07-17', '07:50:00', '1', '0', '20');
INSERT INTO `data_ra` VALUES ('331', '48', '1', 'tepat waktu', '2017-07-18', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('332', '49', '1', 'tepat waktu', '2017-07-18', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('334', '42', '1', 'tepat waktu', '2017-07-18', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('335', '45', '1', 'tepat waktu', '2017-07-18', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('336', '44', '1', 'telat', '2017-07-18', '07:35:00', '1', '0', '5');
INSERT INTO `data_ra` VALUES ('337', '46', '1', 'tepat waktu', '2017-07-18', '07:15:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('338', '48', '1', 'tepat waktu', '2017-07-19', '07:27:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('339', '49', '1', 'tepat waktu', '2017-07-19', '07:27:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('341', '42', '1', 'tepat waktu', '2017-07-19', '07:15:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('342', '45', '1', 'tepat waktu', '2017-07-19', '07:27:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('343', '44', '1', 'tepat waktu', '2017-07-19', '07:27:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('344', '48', '1', 'telat', '2017-07-20', '07:43:00', '1', '0', '13');
INSERT INTO `data_ra` VALUES ('345', '49', '1', 'telat', '2017-07-20', '07:43:00', '1', '0', '13');
INSERT INTO `data_ra` VALUES ('346', '42', '1', 'telat', '2017-07-20', '07:45:00', '1', '0', '15');
INSERT INTO `data_ra` VALUES ('347', '45', '1', 'telat', '2017-07-20', '07:43:00', '1', '0', '13');
INSERT INTO `data_ra` VALUES ('348', '44', '1', 'telat', '2017-07-20', '07:43:00', '1', '0', '13');
INSERT INTO `data_ra` VALUES ('349', '48', '1', 'telat', '2017-07-17', '07:40:00', '1', '0', '10');
INSERT INTO `data_ra` VALUES ('354', '49', '1', 'telat', '2017-07-17', '07:40:00', '1', '0', '10');
INSERT INTO `data_ra` VALUES ('363', '10', '1', 'tepat waktu', '2017-07-17', '06:45:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('367', '46', '1', 'telat', '2017-07-19', '07:40:00', '1', '0', '10');
INSERT INTO `data_ra` VALUES ('369', '48', '1', 'tepat waktu', '2017-07-21', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('370', '49', '1', 'tepat waktu', '2017-07-21', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('372', '42', '1', 'telat', '2017-07-21', '07:35:00', '1', '0', '5');
INSERT INTO `data_ra` VALUES ('373', '45', '1', 'tepat waktu', '2017-07-21', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('374', '44', '1', 'tepat waktu', '2017-07-21', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('375', '46', '1', 'telat', '2017-07-21', '07:50:00', '1', '0', '20');
INSERT INTO `data_ra` VALUES ('376', '48', '1', 'telat', '2017-07-24', '08:10:00', '1', '0', '40');
INSERT INTO `data_ra` VALUES ('377', '49', '1', 'telat', '2017-07-24', '08:10:00', '1', '0', '40');
INSERT INTO `data_ra` VALUES ('379', '42', '1', 'tepat waktu', '2017-07-24', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('380', '45', '1', 'telat', '2017-07-24', '08:10:00', '1', '0', '40');
INSERT INTO `data_ra` VALUES ('381', '44', '1', 'telat', '2017-07-24', '08:08:00', '1', '0', '38');
INSERT INTO `data_ra` VALUES ('382', '46', '1', 'telat', '2017-07-24', '07:50:00', '1', '0', '20');
INSERT INTO `data_ra` VALUES ('383', '48', '1', 'telat', '2017-07-25', '08:08:00', '1', '0', '38');
INSERT INTO `data_ra` VALUES ('384', '49', '1', 'telat', '2017-07-25', '08:08:00', '1', '0', '38');
INSERT INTO `data_ra` VALUES ('386', '42', '1', 'tepat waktu', '2017-07-25', '07:05:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('387', '45', '1', 'tepat waktu', '2017-07-25', '07:08:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('388', '44', '1', 'tepat waktu', '2017-07-25', '07:08:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('389', '46', '1', 'tepat waktu', '2017-07-25', '07:15:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('390', '48', '1', 'telat', '2017-07-26', '07:58:00', '1', '0', '28');
INSERT INTO `data_ra` VALUES ('391', '48', '1', 'telat', '2017-07-27', '07:57:00', '1', '0', '27');
INSERT INTO `data_ra` VALUES ('392', '48', '1', 'tepat waktu', '2017-07-28', '07:23:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('393', '49', '1', 'telat', '2017-07-26', '07:58:00', '1', '0', '28');
INSERT INTO `data_ra` VALUES ('394', '49', '1', 'telat', '2017-07-27', '07:57:00', '1', '0', '27');
INSERT INTO `data_ra` VALUES ('395', '49', '1', 'tepat waktu', '2017-07-28', '07:23:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('396', '45', '1', 'telat', '2017-07-26', '07:58:00', '1', '0', '28');
INSERT INTO `data_ra` VALUES ('397', '44', '1', 'telat', '2017-07-26', '07:58:00', '1', '0', '28');
INSERT INTO `data_ra` VALUES ('398', '45', '1', 'telat', '2017-07-27', '07:57:00', '1', '0', '27');
INSERT INTO `data_ra` VALUES ('399', '44', '1', 'telat', '2017-07-27', '07:57:00', '1', '0', '27');
INSERT INTO `data_ra` VALUES ('400', '45', '1', 'tepat waktu', '2017-07-28', '07:23:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('401', '44', '1', 'tepat waktu', '2017-07-28', '07:23:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('402', '18', '1', 'tepat waktu', '2017-07-25', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('403', '43', '1', 'other', '2017-07-24', '11:00:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('404', '43', '1', 'other', '2017-07-25', '10:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('405', '13', '1', 'tepat waktu', '2017-07-25', '07:15:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('406', '17', '3', 'cuti unknown', '2017-07-25', '07:30:00', '1', null, null);
INSERT INTO `data_ra` VALUES ('407', '17', '3', 'cuti keluar kota', '2017-07-26', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('408', '17', '6', 'ijin keluar kota', '2017-07-27', '07:30:00', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('410', '17', '6', 'ijin keluar kota', '2017-07-28', '07:30:00', '1', '21000', '0');
INSERT INTO `data_ra` VALUES ('411', '10', '1', 'tepat waktu', '2017-07-25', '06:33:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('412', '20', '1', 'telat', '2017-07-25', '08:30:00', '1', '20000', '60');
INSERT INTO `data_ra` VALUES ('413', '14', '1', 'telat', '2017-07-25', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('414', '18', '1', 'tepat waktu', '2017-07-26', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('415', '43', '1', 'tepat waktu', '2017-07-26', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('416', '13', '1', 'tepat waktu', '2017-07-26', '07:15:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('417', '10', '1', 'tepat waktu', '2017-07-26', '06:42:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('418', '9', '1', 'telat', '2017-07-26', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('419', '20', '1', 'telat', '2017-07-26', '08:15:00', '1', '15000', '45');
INSERT INTO `data_ra` VALUES ('420', '14', '1', 'telat', '2017-07-26', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('421', '18', '1', 'telat', '2017-07-27', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('422', '43', '1', 'tepat waktu', '2017-07-27', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('423', '13', '1', 'tepat waktu', '2017-07-27', '07:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('424', '10', '1', 'tepat waktu', '2017-07-27', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('425', '9', '1', 'telat', '2017-07-27', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('426', '20', '1', 'telat', '2017-07-27', '08:30:00', '1', '20000', '60');
INSERT INTO `data_ra` VALUES ('427', '14', '1', 'tepat waktu', '2017-07-27', '07:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('428', '9', '1', 'telat', '2017-07-25', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('429', '18', '3', 'cuti unknown', '2017-07-28', '07:30:00', '1', null, null);
INSERT INTO `data_ra` VALUES ('431', '13', '1', 'telat', '2017-07-28', '08:05:00', '1', '15000', '35');
INSERT INTO `data_ra` VALUES ('432', '10', '1', 'tepat waktu', '2017-07-28', '06:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('433', '9', '1', 'telat', '2017-07-28', '08:10:00', '1', '15000', '40');
INSERT INTO `data_ra` VALUES ('434', '20', '1', 'telat', '2017-07-28', '08:40:00', '1', '25000', '70');
INSERT INTO `data_ra` VALUES ('435', '14', '1', 'telat', '2017-07-28', '07:40:00', '1', '5000', '10');
INSERT INTO `data_ra` VALUES ('436', '43', '1', 'other', '2017-07-28', '13:00:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('437', '17', '1', 'tepat waktu', '2017-07-31', '06:50:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('438', '43', '1', 'other', '2017-07-31', '10:30:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('439', '13', '3', 'mengantar bapak', '2017-07-31', '07:30:00', '1', null, null);
INSERT INTO `data_ra` VALUES ('440', '9', '1', 'telat', '2017-07-31', '07:45:00', '1', '5000', '15');
INSERT INTO `data_ra` VALUES ('441', '14', '1', 'telat', '2017-07-31', '07:55:00', '1', '10000', '25');
INSERT INTO `data_ra` VALUES ('442', '20', '1', 'telat', '2017-07-31', '09:15:00', '1', '35000', '105');
INSERT INTO `data_ra` VALUES ('443', '10', '1', 'tepat waktu', '2017-07-31', '06:53:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('444', '18', '1', 'tepat waktu', '2017-07-31', '07:25:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('446', '10', '1', 'tepat waktu', '2017-08-01', '06:35:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('447', '13', '1', 'tepat waktu', '2017-08-01', '07:09:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('448', '9', '1', 'telat', '2017-08-01', '08:00:00', '1', '10000', '30');
INSERT INTO `data_ra` VALUES ('449', '14', '1', 'telat', '2017-08-01', '08:05:00', '1', '15000', '35');
INSERT INTO `data_ra` VALUES ('450', '20', '1', 'telat', '2017-08-01', '09:20:00', '1', '40000', '110');
INSERT INTO `data_ra` VALUES ('451', '17', '1', 'telat', '2017-08-01', '09:30:00', '1', '40000', '120');
INSERT INTO `data_ra` VALUES ('452', '43', '1', 'other', '2017-08-01', '10:20:00', '1', '0', '0');
INSERT INTO `data_ra` VALUES ('461', '42', '1', 'telat', '2017-07-06', '07:32:00', '1', '0', '2');
INSERT INTO `data_ra` VALUES ('462', '42', '1', 'tepat waktu', '2017-07-07', '07:30:00', '1', '0', '0');

-- ----------------------------
-- Table structure for data_s
-- ----------------------------
DROP TABLE IF EXISTS `data_s`;
CREATE TABLE `data_s` (
  `id_s` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_s` varchar(255) DEFAULT NULL,
  `info_s` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_s`),
  UNIQUE KEY `keterangan_s` (`keterangan_s`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_s
-- ----------------------------
INSERT INTO `data_s` VALUES ('1', 'hadir', 'Status telat atau tepat waktu ditentukan oleh server');
INSERT INTO `data_s` VALUES ('2', 'hadir other', 'Jika bisa hadir pada hari itu, namun ijin terlebih dahulu. Keterangannya adalah hadir, namun detailnya bukan telat atau tepat waktu');
INSERT INTO `data_s` VALUES ('3', 'cuti', 'Mengambil jatah cuti yang ada.');
INSERT INTO `data_s` VALUES ('4', 'sakit', 'Gws ya');
INSERT INTO `data_s` VALUES ('5', 'alpha', 'Berlaku denda Rp. 5.000.00 setiap 15 menit di kali jam kerja.yg berlaku');
INSERT INTO `data_s` VALUES ('6', 'ijin 1 hari', 'Berlaku denda Rp. 5.000.00 di kali jam kerja yang berlaku');

-- ----------------------------
-- View structure for bangun
-- ----------------------------
DROP VIEW IF EXISTS `bangun`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `bangun` AS SELECT DISTINCT
	data_ra.id_k AS me,
	(
		SELECT
			count(data_ra.id_k) AS jumlah
		FROM
			data_ra
		INNER JOIN data_k ON data_ra.id_k = data_k.id_k
		WHERE
			data_ra.detail = 'tepat waktu' 
		AND data_k.jabatan_k = '12' 
		AND MONTH (data_ra.tanggal) = '07'
		AND YEAR (data_ra.tanggal) = '2017'
		AND data_ra.id_k = me
		GROUP BY
			data_ra.id_k
	) AS tepat,
	(
		SELECT
			count(data_ra.id_k) AS jumlah
		FROM
			data_ra
		INNER JOIN data_k ON data_ra.id_k = data_k.id_k
		WHERE
			data_ra.detail = 'telat' AND data_k.jabatan_k = '12'
		AND MONTH (data_ra.tanggal) = '07'
		AND YEAR (data_ra.tanggal) = '2017'
		AND data_ra.id_k = me
		GROUP BY
			data_ra.id_k
	) AS telat
FROM
	data_ra
INNER JOIN data_k ON data_ra.id_k = data_k.id_k
WHERE
	data_k.jabatan_k = 12 ; ;

-- ----------------------------
-- View structure for query
-- ----------------------------
DROP VIEW IF EXISTS `query`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `query` AS SELECT
data_ra.id_k,
data_ra.detail
FROM
data_ra
WHERE
data_ra.id_s = 1 ; ;

-- ----------------------------
-- View structure for subquery
-- ----------------------------
DROP VIEW IF EXISTS `subquery`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `subquery` AS SELECT data_ra.id_k,count(data_ra.id_k) AS jumlah 
                        from data_ra 
                        INNER JOIN data_k ON data_ra.id_k = data_k.id_k 
                        WHERE data_ra.detail = 'tepat waktu' AND data_k.jabatan_k != 12 AND MONTH (data_ra.tanggal) = '07' AND YEAR (data_ra.tanggal) ='2017'
                        GROUP BY id_k ; ;
DROP TRIGGER IF EXISTS `data_j_before_delete`;
DELIMITER ;;
CREATE TRIGGER `data_j_before_delete` AFTER DELETE ON `data_j` FOR EACH ROW BEGIN
/*if (data_j.id_j != 9) then*/
UPDATE data_k SET data_k.jabatan_k = 9 WHERE data_k.jabatan_k = old.id_j;
/*end if;*/
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `data_libur_after_insert`;
DELIMITER ;;
CREATE TRIGGER `data_libur_after_insert` AFTER INSERT ON `data_libur` FOR EACH ROW BEGIN
DELETE FROM data_ra WHERE data_ra.tanggal = new.tanggal;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `updatetime`;
DELIMITER ;;
CREATE TRIGGER `updatetime` BEFORE INSERT ON `data_ra` FOR EACH ROW BEGIN
	/*IF NEW.jam = '00:00:00' THEN*/
		/*SET NEW.jam = CURRENT_TIMESTAMP();
	/*END IF;*/
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `update_berapakali_cuti`;
DELIMITER ;;
CREATE TRIGGER `update_berapakali_cuti` AFTER INSERT ON `data_ra` FOR EACH ROW begin
if new.id_s = '3' then 
update data_c set data_c.cuti_berapakali = data_c.cuti_berapakali + 1 where data_c.id_k = new.id_k;
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
