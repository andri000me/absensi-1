-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.16-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk absen
CREATE DATABASE IF NOT EXISTS `absen` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `absen`;

-- membuang struktur untuk view absen.bangun
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `bangun` (
	`me` SMALLINT(6) NOT NULL,
	`tepat` BIGINT(21) NULL,
	`telat` BIGINT(21) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk table absen.data_c
CREATE TABLE IF NOT EXISTS `data_c` (
  `id_c` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_k` smallint(6) NOT NULL,
  `cuti_berapakali` int(6) NOT NULL,
  `jatah_cuti` int(6) DEFAULT NULL,
  `last_sync` date DEFAULT NULL,
  PRIMARY KEY (`id_c`),
  KEY `data_c_id_k` (`id_k`),
  CONSTRAINT `data_c_id_k` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_c: ~15 rows (lebih kurang)
DELETE FROM `data_c`;
/*!40000 ALTER TABLE `data_c` DISABLE KEYS */;
INSERT INTO `data_c` (`id_c`, `id_k`, `cuti_berapakali`, `jatah_cuti`, `last_sync`) VALUES
	(10, 9, 1, 3, '2017-08-11'),
	(14, 10, 0, 7, '2017-08-11'),
	(17, 13, 2, 3, '2017-08-11'),
	(18, 14, 1, 3, '2017-08-11'),
	(20, 17, 4, 5, '2017-08-11'),
	(21, 18, 1, 4, '2017-08-11'),
	(22, 20, 0, 9, '2017-08-11'),
	(34, 42, 0, 0, '0000-00-00'),
	(35, 43, 0, 0, '0000-00-00'),
	(36, 44, 0, 0, '0000-00-00'),
	(37, 45, 0, 0, '0000-00-00'),
	(38, 46, 0, 0, '0000-00-00'),
	(40, 48, 0, 0, '0000-00-00'),
	(41, 49, 0, 0, '0000-00-00'),
	(42, 50, 0, 0, '0000-00-00');
/*!40000 ALTER TABLE `data_c` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_i
CREATE TABLE IF NOT EXISTS `data_i` (
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_i: ~19 rows (lebih kurang)
DELETE FROM `data_i`;
/*!40000 ALTER TABLE `data_i` DISABLE KEYS */;
INSERT INTO `data_i` (`id_i`, `id_k`, `perihal`, `start`, `end`, `tanggal`, `denda`) VALUES
	(20, 10, 'pulang duluan 14:30 - 16.00', '15:00:00', '16:00:00', '2017-07-06', 3000),
	(29, 10, 'ijin sakit', '08:00:00', '10:00:00', '2017-07-07', 6000),
	(30, 20, 'ijin sakit', '12:30:00', '16:00:00', '2017-07-10', 12000),
	(31, 10, 'ijin sakit', '08:00:00', '16:00:00', '2017-07-12', 24000),
	(33, 14, 'tambal ban 11.10 - 11.50', '11:10:00', '11:50:00', '2017-07-12', 3000),
	(34, 13, 'ijin unknown', '13:30:00', '14:30:00', '2017-07-13', 3000),
	(47, 48, 'ijin menemui orang tua', '12:13:00', '16:00:00', '2017-07-17', 0),
	(49, 43, 'ijin guru. masuk jam 11', '08:00:00', '11:00:00', '2017-07-24', 9000),
	(50, 43, 'ijin guru masuk jam 10.30', '07:30:00', '10:30:00', '2017-07-25', 9000),
	(51, 18, 'ijin puluang dulu 14.30- 16.00', '15:00:00', '16:00:00', '2017-07-27', 3000),
	(53, 14, 'ijin mules', '07:40:00', '08:10:00', '2017-07-28', 3000),
	(54, 43, 'ijin guru', '07:30:00', '10:30:00', '2017-07-31', 9000),
	(55, 43, 'ijin guru', '07:30:00', '10:30:00', '2017-08-01', 9000),
	(56, 9, 'ijin hajatan', '07:30:00', '09:30:00', '2017-08-07', 6000),
	(57, 17, 'telat ijin ke bank', '09:30:00', '12:30:00', '2017-08-07', 9000),
	(58, 43, 'ijin guru', '07:30:00', '10:20:00', '2017-08-07', 9000),
	(59, 43, 'ijin guru', '07:30:00', '11:30:00', '2017-08-04', 12000),
	(60, 43, 'ijin guru', '07:30:00', '10:30:00', '2017-08-07', 9000),
	(72, 20, 'ijin sakit 8.30 - 16.00', '08:30:00', '16:00:00', '2017-07-12', 24000);
/*!40000 ALTER TABLE `data_i` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_j
CREATE TABLE IF NOT EXISTS `data_j` (
  `id_j` tinyint(4) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_j`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_j: ~9 rows (lebih kurang)
DELETE FROM `data_j`;
/*!40000 ALTER TABLE `data_j` DISABLE KEYS */;
INSERT INTO `data_j` (`id_j`, `jabatan`) VALUES
	(2, 'CEO (Direktur)'),
	(3, 'CTO (Kepala Teknis)'),
	(5, 'CFO (Keuangan)'),
	(6, 'CSR (Social Media)'),
	(7, 'COO (Operasional)'),
	(9, 'karyawan'),
	(10, 'CMO (Marketing)'),
	(11, 'Entertaiment'),
	(12, 'Magang');
/*!40000 ALTER TABLE `data_j` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_k
CREATE TABLE IF NOT EXISTS `data_k` (
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

-- Membuang data untuk tabel absen.data_k: ~15 rows (lebih kurang)
DELETE FROM `data_k`;
/*!40000 ALTER TABLE `data_k` DISABLE KEYS */;
INSERT INTO `data_k` (`id_k`, `nama_k`, `alamat_k`, `email_k`, `noHp_k`, `jabatan_k`, `foto_k`, `date_added`, `bisa_cuti`) VALUES
	(9, 'Imaniar H', 'jalan manggar', 'emailmbakiva@gmail.com', '081333662055', 5, 'assets/img/pp_(3).jpg', '2016-07-12', 1),
	(10, 'Ibnu Shodiqin Suhaemy', 'alamat mas ibnu', 'emailmasibnu@gmail.com', '089680752154', 3, 'assets/img/masibnu1.jpg', '2016-06-14', 1),
	(13, 'Dimas Virdana', 'alamat mas dimas', 'emailmasdimas@gmail.com', '089539946836 / 089646683967', 7, 'assets/img/masdimas1.jpg', '2016-06-14', 1),
	(14, 'Muhammad Luqman Hakim', 'alamat mas lukman', 'emailmaslukman@gmail.com', '085941020493', 10, 'assets/img/original1.png', '2016-06-14', 1),
	(17, 'Faiz Al-qurni', 'alamat', 'emailmaszen@gmail.com', '11111111111111111111', 2, 'assets/img/avatar51.jpg', '2016-06-14', 1),
	(18, 'Akhmad Maulidi', 'polres', 'polis@lkja.asd', '081939292602', 9, 'assets/img/15534864_324278627970858_5811524440105680896_n1.jpg', '2016-06-14', 1),
	(20, 'Muhammad Handharbeni', 'kjlkjlhjlvb', 'emailsatu@gmail.com', '081556617741', 9, 'assets/img/286895-580da1a49f5271.jpg', '2016-06-14', 1),
	(42, 'Mindha Ningrum', 'magang', 'magang@gas.asa', '082332443770', 12, 'assets/img/pp1.jpg', '2017-07-15', 0),
	(43, 'Andy Zain', 'singosari bos', 'asdad@sdasd.asd', '085749605965', 6, 'assets/img/13597550_1640886266237820_2091425563_a1.jpg', '2017-07-17', 0),
	(44, 'Hidayatul Vicria', 'dayat', 'dayat@gmail.com', '085649561774', 12, 'assets/img/pp_(1).jpg', '2017-07-20', 0),
	(45, 'Kiki Eka Rinaldi', 'asd', 'kiki@ads.ada', '082233397423', 12, 'assets/img/pp_(7).jpg', '2017-07-20', 0),
	(46, 'Reynaldo Alfa', 'reynaldo', 'reynaldo@asadas.aa', '081333420153', 12, 'assets/img/pp_(2).jpg', '2017-07-20', 0),
	(48, 'Puri Indah Rosita', 'puri', 'puri@aad.asd', '+6285704742842', 12, 'assets/img/pp_(6).jpg', '2017-07-20', 0),
	(49, 'Tovia Oktavia', 'tovia', 'tovia@afs.aas', '+6282164236036', 12, 'assets/img/pp_(4).jpg', '2017-07-20', 0),
	(50, 'Yoi', 'laksdjl', 'yogi@gmail.com', '0840981234987', 12, 'assets/img/pp_(1)1.jpg', '2017-08-03', 0);
/*!40000 ALTER TABLE `data_k` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_l
CREATE TABLE IF NOT EXISTS `data_l` (
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

-- Membuang data untuk tabel absen.data_l: ~15 rows (lebih kurang)
DELETE FROM `data_l`;
/*!40000 ALTER TABLE `data_l` DISABLE KEYS */;
INSERT INTO `data_l` (`id_L`, `id_k`, `username_k`, `password_k`, `hak_akses`) VALUES
	(9, 9, 'usernamembakivareva', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(10, 10, 'usernamemasibnu', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(13, 13, 'dimas', 'b93b0bbe8f536b92d86685d93d51469a', '2'),
	(14, 14, 'maslukman', 'b93b0bbe8f536b92d86685d93d51469a', '2'),
	(16, 17, 'faiz', '9d4d4ab0dfdb72a54b895d78b90b09c7', '1'),
	(17, 18, 'jihad', 'b93b0bbe8f536b92d86685d93d51469a', '2'),
	(19, 20, 'usernamemasida', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(41, 42, 'mindha', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(42, 43, 'maszen', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(43, 44, 'dayat', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(44, 45, 'kiki', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(45, 46, 'reynaldo', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(47, 48, 'puri', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(48, 49, 'tovia', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(49, 50, 'yogi', '938e14c074c45c62eb15cc05a6f36d79', '3');
/*!40000 ALTER TABLE `data_l` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_libur
CREATE TABLE IF NOT EXISTS `data_libur` (
  `id_libur` smallint(6) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_libur`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_libur: ~0 rows (lebih kurang)
DELETE FROM `data_libur`;
/*!40000 ALTER TABLE `data_libur` DISABLE KEYS */;
INSERT INTO `data_libur` (`id_libur`, `detail`, `tanggal`) VALUES
	(8, 'sisa hari raya', '2017-07-03');
/*!40000 ALTER TABLE `data_libur` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_m
CREATE TABLE IF NOT EXISTS `data_m` (
  `id_m` smallint(255) NOT NULL AUTO_INCREMENT,
  `misc` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_m: ~8 rows (lebih kurang)
DELETE FROM `data_m`;
/*!40000 ALTER TABLE `data_m` DISABLE KEYS */;
INSERT INTO `data_m` (`id_m`, `misc`, `detail`) VALUES
	(1, '07:30:00', 'jam masuk'),
	(4, '16:00:00', 'jam akhir kerja'),
	(5, '3000', 'denda per jam untuk ijin 1 hari'),
	(6, '3000', 'denda per jam untuk ijin per jam saat jam kerja'),
	(7, '5000', 'denda keterlambatan per 15 menit'),
	(8, '5000', 'denda alpha per 15 menit'),
	(9, '7', 'custom jam kerja mas dim');
/*!40000 ALTER TABLE `data_m` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_ra
CREATE TABLE IF NOT EXISTS `data_ra` (
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
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_ra: ~245 rows (lebih kurang)
DELETE FROM `data_ra`;
/*!40000 ALTER TABLE `data_ra` DISABLE KEYS */;
INSERT INTO `data_ra` (`id_a`, `id_k`, `id_s`, `detail`, `tanggal`, `jam`, `acc`, `denda`, `late_minute`) VALUES
	(162, 18, 6, 'otw malang', '2017-07-04', '09:45:00', '1', 21000, NULL),
	(163, 43, 1, 'tepat waktu', '2017-07-04', '07:25:00', '1', 0, 0),
	(164, 13, 1, 'tepat waktu', '2017-07-04', '07:23:00', '1', 0, 0),
	(165, 17, 1, 'tepat waktu', '2017-07-04', '07:18:00', '1', 0, 0),
	(166, 10, 1, 'telat', '2017-07-04', '07:40:00', '1', 5000, 10),
	(167, 9, 1, 'telat', '2017-07-04', '09:00:00', '1', 30000, 90),
	(168, 20, 1, 'telat', '2017-07-04', '08:40:00', '1', 25000, 70),
	(169, 14, 1, 'telat', '2017-07-04', '09:05:00', '1', 35000, 95),
	(170, 9, 1, 'telat', '2017-07-05', '07:45:00', '1', 5000, 15),
	(171, 10, 1, 'telat', '2017-07-05', '07:35:00', '1', 5000, 5),
	(172, 13, 1, 'tepat waktu', '2017-07-05', '07:30:00', '1', 0, 0),
	(173, 14, 1, 'telat', '2017-07-05', '08:35:00', '1', 25000, 65),
	(174, 17, 1, 'telat', '2017-07-05', '08:00:00', '1', 10000, 30),
	(175, 18, 1, 'tepat waktu', '2017-07-05', '07:30:00', '1', 0, 0),
	(176, 20, 1, 'tepat waktu', '2017-07-05', '07:20:00', '1', 0, 0),
	(177, 43, 1, 'telat', '2017-07-05', '07:39:00', '1', 5000, 9),
	(178, 18, 1, 'telat', '2017-07-06', '07:35:00', '1', 5000, 5),
	(179, 20, 1, 'telat', '2017-07-06', '09:10:00', '1', 35000, 100),
	(180, 14, 1, 'telat', '2017-07-06', '09:05:00', '1', 35000, 95),
	(181, 9, 1, 'telat', '2017-07-06', '07:45:00', '1', 5000, 15),
	(182, 10, 1, 'tepat waktu', '2017-07-06', '07:25:00', '1', 0, 0),
	(183, 13, 1, 'tepat waktu', '2017-07-06', '07:30:00', '1', 0, 0),
	(184, 17, 1, 'tepat waktu', '2017-07-06', '07:20:00', '1', 0, 0),
	(185, 43, 6, 'rapat guru', '2017-07-06', '07:00:00', '1', 21000, 0),
	(186, 9, 1, 'telat', '2017-07-07', '07:50:00', '1', 10000, 20),
	(187, 10, 1, 'telat', '2017-07-07', '08:00:00', '1', 10000, 30),
	(188, 13, 1, 'tepat waktu', '2017-07-07', '07:25:00', '1', 0, 0),
	(189, 14, 1, 'telat', '2017-07-07', '09:05:00', '1', 35000, 95),
	(190, 17, 1, 'telat', '2017-07-07', '07:40:00', '1', 5000, 10),
	(191, 18, 1, 'telat', '2017-07-07', '07:40:00', '1', 5000, 10),
	(192, 20, 1, 'telat', '2017-07-07', '09:10:00', '1', 35000, 100),
	(193, 43, 1, 'telat', '2017-07-07', '07:50:00', '1', 10000, 20),
	(195, 9, 1, 'telat', '2017-07-10', '07:45:00', '1', 5000, 15),
	(200, 10, 1, 'telat', '2017-07-10', '07:45:00', '1', 5000, 15),
	(201, 13, 1, 'tepat waktu', '2017-07-10', '07:20:00', '1', 0, 0),
	(202, 14, 1, 'telat', '2017-07-10', '08:50:00', '1', 30000, 80),
	(203, 17, 1, 'telat', '2017-07-10', '08:40:00', '1', 25000, 70),
	(204, 18, 1, 'telat', '2017-07-10', '07:55:00', '1', 10000, 25),
	(205, 20, 1, 'telat', '2017-07-10', '09:15:00', '1', 35000, 105),
	(207, 43, 1, 'tepat waktu', '2017-07-10', '07:20:00', '1', 0, 0),
	(208, 9, 1, 'telat', '2017-07-11', '07:34:00', '1', 5000, 4),
	(209, 10, 1, 'tepat waktu', '2017-07-11', '07:30:00', '1', 0, 0),
	(210, 13, 3, 'mbuh opo (ridok) ', '2017-07-11', '15:35:31', '1', 0, 0),
	(211, 14, 1, 'telat', '2017-07-11', '09:00:00', '1', 30000, 90),
	(212, 17, 1, 'telat', '2017-07-11', '08:20:00', '1', 20000, 50),
	(213, 18, 1, 'tepat waktu', '2017-07-11', '07:25:00', '1', 0, 0),
	(214, 20, 1, 'telat', '2017-07-11', '09:00:00', '1', 30000, 90),
	(215, 43, 6, 'ijin remote', '2017-07-11', '15:35:31', '1', 21000, 0),
	(216, 9, 1, 'telat', '2017-07-12', '07:36:00', '1', 5000, 6),
	(217, 10, 1, 'telat', '2017-07-12', '08:00:00', '1', 10000, 30),
	(218, 13, 1, 'tepat waktu', '2017-07-12', '07:25:00', '1', 0, 0),
	(219, 14, 1, 'telat', '2017-07-12', '07:50:00', '1', 10000, 20),
	(220, 17, 1, 'tepat waktu', '2017-07-12', '07:28:00', '1', 0, 0),
	(221, 18, 1, 'telat', '2017-07-12', '07:35:00', '1', 5000, 5),
	(222, 20, 1, 'telat', '2017-07-12', '08:30:00', '1', 20000, 60),
	(223, 43, 1, 'telat', '2017-07-12', '07:48:00', '1', 10000, 18),
	(224, 9, 4, 'asd', '2017-07-13', '08:40:00', '1', 25000, 70),
	(225, 10, 1, 'telat', '2017-07-13', '07:50:00', '1', 10000, 20),
	(226, 13, 1, 'tepat waktu', '2017-07-13', '07:30:00', '1', 0, 0),
	(227, 14, 1, 'telat', '2017-07-13', '09:08:00', '1', 35000, 98),
	(228, 17, 1, 'tepat waktu', '2017-07-13', '07:20:00', '1', 0, 0),
	(229, 18, 1, 'telat', '2017-07-13', '08:15:00', '1', 15000, 45),
	(230, 20, 1, 'telat', '2017-07-13', '09:05:00', '1', 35000, 95),
	(231, 43, 1, 'telat', '2017-07-13', '07:53:00', '1', 10000, 23),
	(252, 9, 1, 'telat', '2017-07-14', '08:05:00', '1', 15000, 35),
	(253, 10, 1, 'telat', '2017-07-14', '07:50:00', '1', 10000, 20),
	(254, 13, 1, 'tepat waktu', '2017-07-14', '07:20:00', '1', 0, 0),
	(255, 14, 1, 'telat', '2017-07-14', '08:50:00', '1', 30000, 80),
	(256, 17, 1, 'tepat waktu', '2017-07-14', '07:25:00', '1', 0, 0),
	(257, 18, 1, 'tepat waktu', '2017-07-14', '07:30:00', '1', 0, 0),
	(258, 20, 1, 'telat', '2017-07-14', '08:55:00', '1', 30000, 85),
	(259, 43, 1, 'tepat waktu', '2017-07-14', '07:10:00', '1', 0, 0),
	(264, 9, 1, 'telat', '2017-07-17', '08:10:00', '1', 15000, 40),
	(266, 13, 1, 'tepat waktu', '2017-07-17', '07:25:00', '1', 0, 0),
	(267, 14, 1, 'telat', '2017-07-17', '08:00:00', '1', 10000, 30),
	(268, 17, 3, 'cuti unknown', '2017-07-17', '12:39:52', '1', 0, 0),
	(269, 18, 6, 'sakit unknown apa', '2017-07-17', '07:30:00', '1', 21000, 0),
	(270, 20, 6, 'sakit unknown', '2017-07-17', '07:30:00', '1', 21000, 0),
	(271, 43, 1, 'telat', '2017-07-17', '07:45:00', '1', 5000, 15),
	(272, 9, 1, 'telat', '2017-07-18', '08:30:00', '1', 20000, 60),
	(273, 10, 1, 'tepat waktu', '2017-07-18', '06:30:00', '1', 0, 0),
	(274, 13, 1, 'tepat waktu', '2017-07-18', '07:10:00', '1', 0, 0),
	(275, 14, 1, 'telat', '2017-07-18', '08:20:00', '1', 20000, 50),
	(276, 17, 1, 'tepat waktu', '2017-07-18', '06:45:00', '1', 0, 0),
	(277, 18, 1, 'tepat waktu', '2017-07-18', '07:30:00', '1', 0, 0),
	(278, 20, 1, 'telat', '2017-07-18', '09:16:00', '1', 40000, 106),
	(279, 43, 1, 'tepat waktu', '2017-07-18', '07:25:00', '1', 0, 0),
	(280, 9, 1, 'telat', '2017-07-19', '08:00:00', '1', 10000, 30),
	(281, 10, 1, 'tepat waktu', '2017-07-19', '07:00:00', '1', 0, 0),
	(282, 13, 1, 'tepat waktu', '2017-07-19', '07:20:00', '1', 0, 0),
	(283, 14, 1, 'telat', '2017-07-19', '07:40:00', '1', 5000, 10),
	(284, 17, 1, 'telat', '2017-07-19', '09:00:00', '1', 30000, 90),
	(285, 18, 1, 'telat', '2017-07-19', '07:35:00', '1', 5000, 5),
	(286, 20, 1, 'telat', '2017-07-19', '09:15:00', '1', 35000, 105),
	(287, 43, 1, 'tepat waktu', '2017-07-19', '07:30:00', '1', 0, 0),
	(288, 9, 1, 'telat', '2017-07-20', '07:50:00', '1', 10000, 20),
	(289, 10, 1, 'tepat waktu', '2017-07-20', '07:15:00', '1', 0, 0),
	(290, 13, 1, 'telat', '2017-07-20', '07:40:00', '1', 5000, 10),
	(291, 14, 1, 'telat', '2017-07-20', '07:50:00', '1', 10000, 20),
	(292, 17, 1, 'tepat waktu', '2017-07-20', '07:20:00', '1', 0, 0),
	(293, 18, 1, 'telat', '2017-07-20', '07:45:00', '1', 5000, 15),
	(294, 20, 1, 'telat', '2017-07-20', '08:20:00', '1', 20000, 50),
	(295, 43, 1, 'tepat waktu', '2017-07-20', '07:30:00', '1', 0, 0),
	(296, 10, 1, 'tepat waktu', '2017-07-24', '06:50:00', '1', 0, 0),
	(297, 13, 1, 'tepat waktu', '2017-07-24', '07:20:00', '1', 0, 0),
	(298, 18, 1, 'tepat waktu', '2017-07-24', '07:25:00', '1', 0, 0),
	(299, 9, 1, 'telat', '2017-07-21', '07:40:00', '1', 5000, 10),
	(304, 18, 1, 'tepat waktu', '2017-07-21', '07:30:00', '1', 0, 0),
	(307, 43, 6, 'ijin guru', '2017-07-21', '07:50:56', '1', 21000, 0),
	(308, 13, 1, 'tepat waktu', '2017-07-21', '07:20:00', '1', 0, 0),
	(310, 17, 1, 'tepat waktu', '2017-07-21', '07:25:00', '1', 0, 0),
	(311, 10, 1, 'tepat waktu', '2017-07-21', '06:45:00', '1', 0, 0),
	(312, 14, 1, 'telat', '2017-07-21', '07:40:00', '1', 5000, 10),
	(314, 20, 1, 'telat', '2017-07-21', '08:40:00', '1', 25000, 70),
	(316, 17, 3, 'unknown', '2017-07-24', '06:30:00', '1', 0, 0),
	(317, 9, 1, 'telat', '2017-07-24', '07:45:00', '1', 5000, 15),
	(318, 20, 1, 'telat', '2017-07-24', '09:00:00', '1', 30000, 90),
	(319, 14, 1, 'tepat waktu', '2017-07-24', '07:30:00', '1', 0, 0),
	(327, 42, 1, 'tepat waktu', '2017-07-17', '07:30:00', '1', 0, 0),
	(328, 45, 4, 'sakit unknown', '2017-07-17', '01:50:03', '1', 0, 0),
	(329, 44, 1, 'telat', '2017-07-17', '07:40:00', '1', 0, 10),
	(330, 46, 1, 'telat', '2017-07-17', '07:50:00', '1', 0, 20),
	(331, 48, 1, 'tepat waktu', '2017-07-18', '07:20:00', '1', 0, 0),
	(332, 49, 1, 'tepat waktu', '2017-07-18', '07:20:00', '1', 0, 0),
	(334, 42, 1, 'tepat waktu', '2017-07-18', '07:20:00', '1', 0, 0),
	(335, 45, 1, 'tepat waktu', '2017-07-18', '07:30:00', '1', 0, 0),
	(336, 44, 1, 'telat', '2017-07-18', '07:35:00', '1', 0, 5),
	(337, 46, 1, 'tepat waktu', '2017-07-18', '07:15:00', '1', 0, 0),
	(338, 48, 1, 'tepat waktu', '2017-07-19', '07:27:00', '1', 0, 0),
	(339, 49, 1, 'tepat waktu', '2017-07-19', '07:27:00', '1', 0, 0),
	(341, 42, 1, 'tepat waktu', '2017-07-19', '07:15:00', '1', 0, 0),
	(342, 45, 1, 'tepat waktu', '2017-07-19', '07:27:00', '1', 0, 0),
	(343, 44, 1, 'tepat waktu', '2017-07-19', '07:27:00', '1', 0, 0),
	(344, 48, 1, 'telat', '2017-07-20', '07:43:00', '1', 0, 13),
	(345, 49, 1, 'telat', '2017-07-20', '07:43:00', '1', 0, 13),
	(346, 42, 1, 'telat', '2017-07-20', '07:45:00', '1', 0, 15),
	(347, 45, 1, 'telat', '2017-07-20', '07:43:00', '1', 0, 13),
	(348, 44, 1, 'telat', '2017-07-20', '07:43:00', '1', 0, 13),
	(349, 48, 1, 'telat', '2017-07-17', '07:40:00', '1', 0, 10),
	(354, 49, 1, 'telat', '2017-07-17', '07:40:00', '1', 0, 10),
	(363, 10, 1, 'tepat waktu', '2017-07-17', '06:45:00', '1', 0, 0),
	(367, 46, 1, 'telat', '2017-07-19', '07:40:00', '1', 0, 10),
	(369, 48, 1, 'tepat waktu', '2017-07-21', '07:30:00', '1', 0, 0),
	(370, 49, 1, 'tepat waktu', '2017-07-21', '07:30:00', '1', 0, 0),
	(372, 42, 1, 'telat', '2017-07-21', '07:35:00', '1', 0, 5),
	(373, 45, 1, 'tepat waktu', '2017-07-21', '07:25:00', '1', 0, 0),
	(374, 44, 1, 'tepat waktu', '2017-07-21', '07:25:00', '1', 0, 0),
	(375, 46, 1, 'telat', '2017-07-21', '07:50:00', '1', 0, 20),
	(376, 48, 1, 'telat', '2017-07-24', '08:10:00', '1', 0, 40),
	(377, 49, 1, 'telat', '2017-07-24', '08:10:00', '1', 0, 40),
	(379, 42, 1, 'tepat waktu', '2017-07-24', '07:20:00', '1', 0, 0),
	(380, 45, 1, 'telat', '2017-07-24', '08:10:00', '1', 0, 40),
	(381, 44, 1, 'telat', '2017-07-24', '08:08:00', '1', 0, 38),
	(382, 46, 1, 'telat', '2017-07-24', '07:50:00', '1', 0, 20),
	(383, 48, 1, 'telat', '2017-07-25', '08:08:00', '1', 0, 38),
	(384, 49, 1, 'telat', '2017-07-25', '08:08:00', '1', 0, 38),
	(386, 42, 1, 'tepat waktu', '2017-07-25', '07:05:00', '1', 0, 0),
	(387, 45, 1, 'tepat waktu', '2017-07-25', '07:08:00', '1', 0, 0),
	(388, 44, 1, 'tepat waktu', '2017-07-25', '07:08:00', '1', 0, 0),
	(389, 46, 1, 'tepat waktu', '2017-07-25', '07:15:00', '1', 0, 0),
	(390, 48, 1, 'telat', '2017-07-26', '07:58:00', '1', 0, 28),
	(391, 48, 1, 'telat', '2017-07-27', '07:57:00', '1', 0, 27),
	(392, 48, 1, 'tepat waktu', '2017-07-28', '07:23:00', '1', 0, 0),
	(393, 49, 1, 'telat', '2017-07-26', '07:58:00', '1', 0, 28),
	(394, 49, 1, 'telat', '2017-07-27', '07:57:00', '1', 0, 27),
	(395, 49, 1, 'tepat waktu', '2017-07-28', '07:23:00', '1', 0, 0),
	(396, 45, 1, 'telat', '2017-07-26', '07:58:00', '1', 0, 28),
	(397, 44, 1, 'telat', '2017-07-26', '07:58:00', '1', 0, 28),
	(398, 45, 1, 'telat', '2017-07-27', '07:57:00', '1', 0, 27),
	(399, 44, 1, 'telat', '2017-07-27', '07:57:00', '1', 0, 27),
	(400, 45, 1, 'tepat waktu', '2017-07-28', '07:23:00', '1', 0, 0),
	(401, 44, 1, 'tepat waktu', '2017-07-28', '07:23:00', '1', 0, 0),
	(402, 18, 1, 'tepat waktu', '2017-07-25', '07:30:00', '1', 0, 0),
	(403, 43, 1, 'other', '2017-07-24', '11:00:00', '1', 0, 0),
	(404, 43, 1, 'other', '2017-07-25', '10:30:00', '1', 0, 0),
	(405, 13, 1, 'tepat waktu', '2017-07-25', '07:15:00', '1', 0, 0),
	(406, 17, 3, 'cuti unknown', '2017-07-25', '07:30:00', '1', NULL, NULL),
	(407, 17, 3, 'cuti keluar kota', '2017-07-26', '07:30:00', '1', 0, 0),
	(408, 17, 6, 'ijin keluar kota', '2017-07-27', '07:30:00', '1', 21000, 0),
	(410, 17, 6, 'ijin keluar kota', '2017-07-28', '07:30:00', '1', 21000, 0),
	(411, 10, 1, 'tepat waktu', '2017-07-25', '06:33:00', '1', 0, 0),
	(412, 20, 1, 'telat', '2017-07-25', '08:30:00', '1', 20000, 60),
	(413, 14, 1, 'telat', '2017-07-25', '08:00:00', '1', 10000, 30),
	(414, 18, 1, 'tepat waktu', '2017-07-26', '07:30:00', '1', 0, 0),
	(415, 43, 1, 'tepat waktu', '2017-07-26', '07:30:00', '1', 0, 0),
	(416, 13, 1, 'tepat waktu', '2017-07-26', '07:15:00', '1', 0, 0),
	(417, 10, 1, 'tepat waktu', '2017-07-26', '06:42:00', '1', 0, 0),
	(418, 9, 1, 'telat', '2017-07-26', '08:00:00', '1', 10000, 30),
	(419, 20, 1, 'telat', '2017-07-26', '08:15:00', '1', 15000, 45),
	(420, 14, 1, 'telat', '2017-07-26', '08:00:00', '1', 10000, 30),
	(421, 18, 1, 'telat', '2017-07-27', '07:40:00', '1', 5000, 10),
	(422, 43, 1, 'tepat waktu', '2017-07-27', '07:30:00', '1', 0, 0),
	(423, 13, 1, 'tepat waktu', '2017-07-27', '07:20:00', '1', 0, 0),
	(424, 10, 1, 'tepat waktu', '2017-07-27', '07:25:00', '1', 0, 0),
	(425, 9, 1, 'telat', '2017-07-27', '07:45:00', '1', 5000, 15),
	(426, 20, 1, 'telat', '2017-07-27', '08:30:00', '1', 20000, 60),
	(427, 14, 1, 'tepat waktu', '2017-07-27', '07:30:00', '1', 0, 0),
	(428, 9, 1, 'telat', '2017-07-25', '08:00:00', '1', 10000, 30),
	(429, 18, 3, 'cuti unknown', '2017-07-28', '07:30:00', '1', NULL, NULL),
	(431, 13, 1, 'telat', '2017-07-28', '08:05:00', '1', 15000, 35),
	(432, 10, 1, 'tepat waktu', '2017-07-28', '06:30:00', '1', 0, 0),
	(433, 9, 1, 'telat', '2017-07-28', '08:10:00', '1', 15000, 40),
	(434, 20, 1, 'telat', '2017-07-28', '08:40:00', '1', 25000, 70),
	(435, 14, 1, 'telat', '2017-07-28', '07:40:00', '1', 5000, 10),
	(436, 43, 1, 'other', '2017-07-28', '13:00:00', '1', 0, 0),
	(437, 17, 1, 'tepat waktu', '2017-07-31', '06:50:00', '1', 0, 0),
	(438, 43, 1, 'other', '2017-07-31', '10:30:00', '1', 0, 0),
	(439, 13, 3, 'mengantar bapak', '2017-07-31', '07:30:00', '1', NULL, NULL),
	(440, 9, 1, 'telat', '2017-07-31', '07:45:00', '1', 5000, 15),
	(441, 14, 1, 'telat', '2017-07-31', '07:55:00', '1', 10000, 25),
	(442, 20, 1, 'telat', '2017-07-31', '09:15:00', '1', 35000, 105),
	(443, 10, 1, 'tepat waktu', '2017-07-31', '06:53:00', '1', 0, 0),
	(444, 18, 1, 'tepat waktu', '2017-07-31', '07:25:00', '1', 0, 0),
	(446, 10, 1, 'tepat waktu', '2017-08-01', '06:35:00', '1', 0, 0),
	(447, 13, 1, 'tepat waktu', '2017-08-01', '07:10:00', '1', 0, 0),
	(448, 9, 1, 'telat', '2017-08-01', '08:00:00', '1', 10000, 30),
	(449, 14, 1, 'telat', '2017-08-01', '08:05:00', '1', 15000, 35),
	(450, 20, 1, 'telat', '2017-08-01', '09:20:00', '1', 40000, 110),
	(451, 17, 1, 'telat', '2017-08-01', '09:30:00', '1', 40000, 120),
	(452, 43, 1, 'other', '2017-08-01', '10:20:00', '1', 0, 0),
	(461, 42, 1, 'telat', '2017-07-06', '07:32:00', '1', 0, 2),
	(462, 42, 1, 'tepat waktu', '2017-07-07', '07:30:00', '1', 0, 0),
	(463, 18, 1, 'telat', '2017-08-01', '08:10:00', '1', 15000, 40),
	(465, 18, 1, 'tepat waktu', '2017-08-02', '07:05:00', '1', 0, 0),
	(466, 43, 1, 'tepat waktu', '2017-08-02', '07:25:00', '1', 0, 0),
	(467, 13, 1, 'tepat waktu', '2017-08-02', '07:20:00', '1', 0, 0),
	(468, 17, 1, 'telat', '2017-08-02', '09:30:00', '1', 40000, 120),
	(469, 10, 1, 'tepat waktu', '2017-08-02', '06:35:00', '1', 0, 0),
	(470, 9, 1, 'tepat waktu', '2017-08-02', '07:30:00', '1', 0, 0),
	(471, 20, 1, 'telat', '2017-08-02', '08:15:00', '1', 15000, 45),
	(472, 18, 1, 'tepat waktu', '2017-08-03', '07:25:00', '1', 0, 0),
	(473, 43, 1, 'telat', '2017-08-03', '07:34:00', '1', 5000, 4),
	(474, 13, 1, 'telat', '2017-08-03', '07:31:00', '1', 5000, 1),
	(475, 17, 1, 'tepat waktu', '2017-08-03', '07:10:00', '1', 0, 0),
	(476, 10, 1, 'tepat waktu', '2017-08-03', '07:00:00', '1', 0, 0),
	(477, 9, 1, 'telat', '2017-08-03', '07:38:00', '1', 5000, 8),
	(478, 20, 1, 'telat', '2017-08-03', '09:00:00', '1', 30000, 90),
	(479, 14, 1, 'telat', '2017-08-03', '07:38:00', '1', 5000, 8),
	(480, 18, 1, 'tepat waktu', '2017-08-04', '07:22:00', '1', 0, 0),
	(481, 43, 1, 'other', '2017-08-04', '11:30:00', '1', 0, 0),
	(482, 13, 3, 'unknown', '2017-08-04', '11:30:00', '1', NULL, NULL),
	(483, 17, 1, 'tepat waktu', '2017-08-04', '06:50:00', '1', 0, 0),
	(484, 10, 1, 'telat', '2017-08-04', '08:05:00', '1', 15000, 35),
	(485, 9, 1, 'tepat waktu', '2017-08-04', '07:20:00', '1', 0, 0),
	(486, 20, 1, 'telat', '2017-08-04', '09:30:00', '1', 40000, 120),
	(487, 14, 1, 'tepat waktu', '2017-08-04', '07:20:00', '1', 0, 0),
	(488, 18, 1, 'telat', '2017-08-07', '08:00:00', '1', 10000, 30),
	(489, 43, 1, 'other', '2017-08-07', '10:30:00', '1', 0, 0),
	(490, 13, 1, 'tepat waktu', '2017-08-07', '07:20:00', '1', 0, 0),
	(491, 17, 1, 'telat', '2017-08-07', '09:50:00', '1', 50000, 140),
	(492, 10, 1, 'tepat waktu', '2017-08-07', '06:45:00', '1', 0, 0),
	(493, 9, 1, 'other', '2017-08-07', '07:30:00', '1', 0, 0),
	(494, 20, 1, 'telat', '2017-08-07', '09:15:00', '1', 35000, 105),
	(495, 14, 1, 'telat', '2017-08-07', '09:00:00', '1', 30000, 90),
	(496, 18, 1, 'telat', '2017-08-08', '08:00:00', '1', 10000, 30),
	(497, 43, 6, 'ijin remote', '2017-08-08', '08:00:00', '1', 21000, 0),
	(498, 13, 1, 'tepat waktu', '2017-08-08', '07:25:00', '1', 0, 0),
	(499, 17, 1, 'telat', '2017-08-08', '09:00:00', '1', 30000, 90),
	(500, 10, 1, 'tepat waktu', '2017-08-08', '06:50:00', '1', 0, 0),
	(501, 9, 3, ' ', '2017-08-08', '06:50:00', '1', NULL, NULL),
	(502, 20, 1, 'telat', '2017-08-08', '08:15:00', '1', 15000, 45),
	(503, 14, 3, ' ', '2017-08-08', '08:15:00', '1', NULL, NULL),
	(505, 9, 1, 'telat', '2017-08-09', '08:00:00', '1', 10000, 30);
/*!40000 ALTER TABLE `data_ra` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_s
CREATE TABLE IF NOT EXISTS `data_s` (
  `id_s` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_s` varchar(255) DEFAULT NULL,
  `info_s` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_s`),
  UNIQUE KEY `keterangan_s` (`keterangan_s`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_s: ~6 rows (lebih kurang)
DELETE FROM `data_s`;
/*!40000 ALTER TABLE `data_s` DISABLE KEYS */;
INSERT INTO `data_s` (`id_s`, `keterangan_s`, `info_s`) VALUES
	(1, 'hadir', 'Status telat atau tepat waktu ditentukan oleh server'),
	(2, 'hadir other', 'Jika bisa hadir pada hari itu, namun ijin terlebih dahulu. Keterangannya adalah hadir, namun detailnya bukan telat atau tepat waktu'),
	(3, 'cuti', 'Mengambil jatah cuti yang ada.'),
	(4, 'sakit', 'Gws ya'),
	(5, 'alpha', 'Berlaku denda Rp. 5.000.00 setiap 15 menit di kali jam kerja.yg berlaku'),
	(6, 'ijin 1 hari', 'Berlaku denda Rp. 5.000.00 di kali jam kerja yang berlaku');
/*!40000 ALTER TABLE `data_s` ENABLE KEYS */;

-- membuang struktur untuk view absen.query
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `query` (
	`id_k` SMALLINT(6) NOT NULL,
	`detail` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view absen.subquery
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `subquery` (
	`id_k` SMALLINT(6) NOT NULL,
	`jumlah` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- membuang struktur untuk trigger absen.data_j_before_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `data_j_before_delete` AFTER DELETE ON `data_j` FOR EACH ROW BEGIN
/*if (data_j.id_j != 9) then*/
UPDATE data_k SET data_k.jabatan_k = 9 WHERE data_k.jabatan_k = old.id_j;
/*end if;*/
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger absen.data_libur_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `data_libur_after_insert` AFTER INSERT ON `data_libur` FOR EACH ROW BEGIN
DELETE FROM data_ra WHERE data_ra.tanggal = new.tanggal;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger absen.data_ra_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `data_ra_after_delete` AFTER DELETE ON `data_ra` FOR EACH ROW BEGIN
if old.id_s = 3 then 
update data_c set data_c.cuti_berapakali = data_c.cuti_berapakali - 1 where data_c.id_k = old.id_k;
elseif old.id_s = 1 then
delete from data_i where data_i.id_k = old.id_k and data_i.tanggal = old.tanggal;
end if;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger absen.data_ra_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `data_ra_after_update` AFTER UPDATE ON `data_ra` FOR EACH ROW BEGIN
	if old.id_s = 3 and new.id_s != 3 then 
	update data_c set data_c.cuti_berapakali = (data_c.cuti_berapakali - 1) where data_c.id_k=new.id_k;
	elseif old.id_s != 3 and new.id_s = 3 then
	update data_c set data_c.cuti_berapakali = (data_c.cuti_berapakali + 1) where data_c.id_k= new.id_k;
	elseif old.id_s = 1 and new.id_s != 1 then
	delete from data_i where data_i.id_k = new.id_k and data_i.tanggal = new.tanggal;
	end if;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger absen.updatetime
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `updatetime` BEFORE INSERT ON `data_ra` FOR EACH ROW BEGIN
	/*IF NEW.jam = '00:00:00' THEN*/
		/*SET NEW.jam = CURRENT_TIMESTAMP();
	/*END IF;*/
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger absen.update_berapakali_cuti
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_berapakali_cuti` AFTER INSERT ON `data_ra` FOR EACH ROW begin
if new.id_s = '3' then 
update data_c set data_c.cuti_berapakali = data_c.cuti_berapakali + 1 where data_c.id_k = new.id_k;
end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk view absen.bangun
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `bangun`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `bangun` AS SELECT DISTINCT
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

-- membuang struktur untuk view absen.query
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `query`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `query` AS SELECT
data_ra.id_k,
data_ra.detail
FROM
data_ra
WHERE
data_ra.id_s = 1 ; ;

-- membuang struktur untuk view absen.subquery
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `subquery`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `subquery` AS SELECT data_ra.id_k,count(data_ra.id_k) AS jumlah 
                        from data_ra 
                        INNER JOIN data_k ON data_ra.id_k = data_k.id_k 
                        WHERE data_ra.detail = 'tepat waktu' AND data_k.jabatan_k != 12 AND MONTH (data_ra.tanggal) = '07' AND YEAR (data_ra.tanggal) ='2017'
                        GROUP BY id_k ; ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
