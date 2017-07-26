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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_c: ~15 rows (lebih kurang)
DELETE FROM `data_c`;
/*!40000 ALTER TABLE `data_c` DISABLE KEYS */;
INSERT INTO `data_c` (`id_c`, `id_k`, `cuti_berapakali`, `jatah_cuti`, `last_sync`) VALUES
	(10, 9, 0, 2, '2017-07-25'),
	(14, 10, 0, 6, '2017-07-25'),
	(17, 13, 1, 2, '2017-07-25'),
	(18, 14, 0, 2, '2017-07-25'),
	(20, 17, 2, 4, '2017-07-25'),
	(21, 18, 0, 3, '2017-07-25'),
	(22, 20, 0, 8, '2017-07-25'),
	(34, 42, 0, 0, '0000-00-00'),
	(35, 43, 0, 0, '2017-07-25'),
	(36, 44, 0, 0, '0000-00-00'),
	(37, 45, 0, 0, '0000-00-00'),
	(38, 46, 0, 0, '0000-00-00'),
	(39, 47, 0, 0, '0000-00-00'),
	(40, 48, 0, 0, '0000-00-00'),
	(41, 49, 0, 0, '0000-00-00');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_i: ~8 rows (lebih kurang)
DELETE FROM `data_i`;
/*!40000 ALTER TABLE `data_i` DISABLE KEYS */;
INSERT INTO `data_i` (`id_i`, `id_k`, `perihal`, `start`, `end`, `tanggal`, `denda`) VALUES
	(20, 10, 'pulang duluan 14:30 - 16.00', '15:00:00', '16:00:00', '2017-07-06', 3000),
	(29, 10, 'ijin sakit', '08:00:00', '10:00:00', '2017-07-07', 6000),
	(30, 20, 'ijin sakit', '12:30:00', '16:00:00', '2017-07-10', 12000),
	(31, 10, 'ijin sakit', '09:00:00', '16:00:00', '2017-07-12', 21000),
	(32, 20, 'ijin sakit', '10:00:00', '16:00:00', '2017-07-12', 18000),
	(33, 14, 'tambal ban 11.10 - 11.50', '11:10:00', '11:50:00', '2017-07-12', 3000),
	(34, 13, 'ijin unknown', '13:30:00', '14:30:00', '2017-07-13', 3000),
	(35, 9, 'asd', '14:05:49', '15:48:42', '2017-07-24', 6000);
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
  KEY `FK_data_k_data_j` (`jabatan_k`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

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
	(43, 'Andy Zain', '24142', 'asdad@sdasd.asd', '085749605965', 6, 'assets/img/13597550_1640886266237820_2091425563_a1.jpg', '2017-07-17', 1),
	(44, 'Hidayatul Vicria', 'dayat', 'dayat@gmail.com', '085649561774', 12, 'assets/img/pp_(1).jpg', '2017-07-20', 0),
	(45, 'Kiki Eka Rinaldi', 'asd', 'kiki@ads.ada', '082233397423', 12, 'assets/img/pp_(7).jpg', '2017-07-20', 0),
	(46, 'Reynaldo Alfa', 'reynaldo', 'reynaldo@asadas.aa', '081333420153', 12, 'assets/img/pp_(2).jpg', '2017-07-20', 0),
	(47, 'Yogi Adam', 'adam', 'adamA@assad.asd', '+62 823-3044-4835', 12, 'assets/img/pp_(5).jpg', '2017-07-20', 0),
	(48, 'Puri Indah Rosita', 'puri', 'puri@aad.asd', '+6285704742842', 12, 'assets/img/pp_(6).jpg', '2017-07-20', 0),
	(49, 'Tovia Oktavia', 'tovia', 'tovia@afs.aas', '+6282164236036', 12, 'assets/img/pp_(4).jpg', '2017-07-20', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_l: ~15 rows (lebih kurang)
DELETE FROM `data_l`;
/*!40000 ALTER TABLE `data_l` DISABLE KEYS */;
INSERT INTO `data_l` (`id_L`, `id_k`, `username_k`, `password_k`, `hak_akses`) VALUES
	(9, 9, 'usernamembakivareva', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(10, 10, 'usernamemasibnu', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(13, 13, 'dimas', 'b93b0bbe8f536b92d86685d93d51469a', '2'),
	(14, 14, 'usernamemaslukman', 'b93b0bbe8f536b92d86685d93d51469a', '2'),
	(16, 17, 'faiz', '9d4d4ab0dfdb72a54b895d78b90b09c7', '1'),
	(17, 18, 'jihad', 'b93b0bbe8f536b92d86685d93d51469a', '2'),
	(19, 20, 'usernamemasida', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(41, 42, 'qwe', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(42, 43, 'masaa', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(43, 44, 'dayat', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(44, 45, 'kiki', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(45, 46, 'reynaldo', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(46, 47, 'adam', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(47, 48, 'puri', 'b93b0bbe8f536b92d86685d93d51469a', '3'),
	(48, 49, 'tovia', 'b93b0bbe8f536b92d86685d93d51469a', '3');
/*!40000 ALTER TABLE `data_l` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_libur
CREATE TABLE IF NOT EXISTS `data_libur` (
  `id_libur` smallint(6) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_libur`),
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_libur: ~5 rows (lebih kurang)
DELETE FROM `data_libur`;
/*!40000 ALTER TABLE `data_libur` DISABLE KEYS */;
INSERT INTO `data_libur` (`id_libur`, `detail`, `tanggal`) VALUES
	(2, 'libur nasional indonesia', '2017-06-18'),
	(3, 'liburan dulu', '2017-05-21'),
	(4, 'libur apa', '2017-06-10'),
	(5, 'test', '2017-07-08'),
	(6, 'terrrr', '2017-08-17');
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
	(1, '07:31:00', 'jam masuk'),
	(2, '2017', 'tahun sekarang'),
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
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `acc` varchar(50) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `late_minute` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_a`),
  KEY `K_A_id_karyawan` (`id_k`),
  KEY `K_A_id_status` (`id_s`),
  CONSTRAINT `K_A_id_karyawan` FOREIGN KEY (`id_k`) REFERENCES `data_k` (`id_k`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `K_A_id_status` FOREIGN KEY (`id_s`) REFERENCES `data_s` (`id_s`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_ra: ~146 rows (lebih kurang)
DELETE FROM `data_ra`;
/*!40000 ALTER TABLE `data_ra` DISABLE KEYS */;
INSERT INTO `data_ra` (`id_a`, `id_k`, `id_s`, `detail`, `tanggal`, `jam`, `acc`, `denda`, `late_minute`) VALUES
	(5, 13, 1, 'telat', '2017-06-15', '18:42:30', '1', 225000, NULL),
	(6, 14, 1, 'telat', '2017-06-15', '18:42:38', '1', NULL, NULL),
	(13, 9, 1, 'telat', '2017-01-16', '13:08:10', '1', NULL, NULL),
	(15, 10, 1, 'telat', '2017-06-16', '10:18:23', '1', NULL, NULL),
	(16, 13, 1, 'telat', '2017-06-09', '13:26:43', '1', NULL, NULL),
	(17, 17, 1, 'telat', '2017-06-09', '13:28:01', '1', NULL, NULL),
	(18, 9, 1, 'tepat waktu', '2017-06-09', '01:24:24', '1', NULL, NULL),
	(19, 10, 1, 'tepat waktu', '2017-06-09', '01:24:34', '1', NULL, NULL),
	(20, 9, 1, 'tepat waktu', '2017-05-18', '01:31:22', '1', NULL, NULL),
	(21, 10, 1, 'tepat waktu', '2017-06-19', '01:31:31', '1', NULL, NULL),
	(23, 9, 1, 'telat', '2017-05-19', '09:16:07', '1', NULL, NULL),
	(25, 9, 1, 'tepat waktu', '2017-06-20', '06:55:06', '1', NULL, NULL),
	(26, 10, 1, 'tepat waktu', '2017-06-20', '06:57:39', '1', NULL, NULL),
	(28, 13, 1, 'tepat waktu', '2017-06-20', '06:57:55', '1', NULL, NULL),
	(30, 17, 1, 'telat', '2017-06-20', '16:28:35', '1', NULL, NULL),
	(31, 9, 4, 'kepala', '2017-06-21', '02:22:16', '1', 0, NULL),
	(32, 10, 6, 'anlkdauspodas', '2017-06-21', '18:48:42', '1', NULL, NULL),
	(34, 10, 6, 'nang panjen maneh', '2017-06-22', '13:13:06', '1', 127, NULL),
	(35, 10, 6, 'nang manse', '2017-06-18', '14:19:28', '1', 127, NULL),
	(37, 9, 1, 'telat', '2017-06-30', '19:40:11', '1', 250000, NULL),
	(38, 10, 1, 'telat', '2017-06-30', '19:40:19', '1', 250000, NULL),
	(39, 13, 3, 'pppppppppppppppppppp', '2017-06-30', '19:40:30', '1', 0, NULL),
	(49, 9, 1, 'telat', '2017-08-04', '09:59:59', '1', 60000, NULL),
	(111, 9, 3, 'opipoippoi', '2017-11-15', '10:32:22', '1', 0, NULL),
	(113, 17, 6, 'AD', '2017-11-16', '18:59:30', '1', 25500, NULL),
	(114, 9, 1, 'telat', '2017-11-17', '08:01:11', '1', 10000, NULL),
	(162, 18, 6, '', '2017-07-04', '09:45:00', '1', 21000, NULL),
	(163, 43, 1, 'tepat waktu', '2017-07-04', '07:25:00', '1', 0, 0),
	(164, 13, 1, 'tepat waktu', '2017-07-04', '07:23:00', '1', 0, 0),
	(165, 17, 1, 'tepat waktu', '2017-07-04', '07:18:00', '1', 0, 0),
	(166, 10, 1, 'telat', '2017-07-04', '07:40:00', '1', 5000, 9),
	(167, 9, 1, 'telat', '2017-07-04', '09:00:00', '1', 30000, 89),
	(168, 20, 1, 'telat', '2017-07-04', '08:40:00', '1', 25000, 69),
	(169, 14, 1, 'telat', '2017-07-04', '09:05:00', '1', 35000, 94),
	(170, 9, 1, 'telat', '2017-07-05', '07:45:00', '1', 5000, 14),
	(171, 10, 1, 'telat', '2017-07-05', '07:35:00', '1', 5000, 5),
	(172, 13, 1, 'tepat waktu', '2017-07-05', '07:30:00', '1', 0, 0),
	(173, 14, 1, 'telat', '2017-07-05', '08:35:00', '1', 25000, 65),
	(174, 17, 1, 'telat', '2017-07-05', '08:00:00', '1', 10000, 29),
	(175, 18, 1, 'tepat waktu', '2017-07-05', '07:30:00', '1', 0, 0),
	(176, 20, 1, 'tepat waktu', '2017-07-05', '07:20:00', '1', 0, 0),
	(177, 43, 1, 'telat', '2017-07-05', '07:39:00', '1', 5000, 9),
	(178, 18, 1, 'telat', '2017-07-06', '07:35:00', '1', 5000, 4),
	(179, 20, 1, 'telat', '2017-07-06', '09:10:00', '1', 35000, 99),
	(180, 14, 1, 'telat', '2017-07-06', '09:05:00', '1', 35000, 94),
	(181, 9, 1, 'telat', '2017-07-06', '07:45:00', '1', 5000, 14),
	(182, 10, 1, 'tepat waktu', '2017-07-06', '07:25:00', '1', 0, 0),
	(183, 13, 1, 'tepat waktu', '2017-07-06', '07:30:00', '1', 0, 0),
	(184, 17, 1, 'tepat waktu', '2017-07-06', '07:20:00', '1', 0, 0),
	(185, 43, 6, 'rapat guru', '2017-07-06', '07:00:00', '1', 21000, 390),
	(186, 9, 1, 'telat', '2017-07-07', '07:50:00', '1', 10000, 19),
	(187, 10, 1, 'telat', '2017-07-07', '08:00:00', '1', 10000, 29),
	(188, 13, 1, 'tepat waktu', '2017-07-07', '07:25:00', '1', 0, 0),
	(189, 14, 1, 'telat', '2017-07-07', '09:05:00', '1', 35000, 94),
	(190, 17, 1, 'telat', '2017-07-07', '07:40:00', '1', 5000, 9),
	(191, 18, 1, 'telat', '2017-07-07', '07:40:00', '1', 5000, 9),
	(192, 20, 1, 'telat', '2017-07-07', '09:10:00', '1', 35000, 99),
	(193, 43, 1, 'telat', '2017-07-07', '07:50:00', '1', 10000, 19),
	(195, 9, 1, 'telat', '2017-07-10', '07:45:00', '1', 5000, 14),
	(200, 10, 1, 'telat', '2017-07-10', '07:45:00', '1', 5000, 14),
	(201, 13, 1, 'tepat waktu', '2017-07-10', '07:20:00', '1', 0, 0),
	(202, 14, 1, 'telat', '2017-07-10', '08:50:00', '1', 30000, 79),
	(203, 17, 1, 'telat', '2017-07-10', '08:40:00', '1', 25000, 69),
	(204, 18, 1, 'telat', '2017-07-10', '07:55:00', '1', 10000, 24),
	(205, 20, 1, 'telat', '2017-07-10', '09:15:00', '1', 35000, 104),
	(207, 43, 1, 'tepat waktu', '2017-07-10', '07:20:00', '1', 0, 0),
	(208, 9, 1, 'telat', '2017-07-11', '07:34:00', '1', 5000, 3),
	(209, 10, 1, 'tepat waktu', '2017-07-11', '07:30:00', '1', 0, 0),
	(210, 13, 3, 'mbuh opo (ridok) ', '2017-07-11', '15:35:31', '1', 0, 0),
	(211, 14, 1, 'telat', '2017-07-11', '09:00:00', '1', 30000, 89),
	(212, 17, 1, 'telat', '2017-07-11', '08:20:00', '1', 20000, 49),
	(213, 18, 1, 'tepat waktu', '2017-07-11', '07:25:00', '1', 0, 0),
	(214, 20, 1, 'telat', '2017-07-11', '09:00:00', '1', 30000, 89),
	(215, 43, 6, 'ijin remote', '2017-07-11', '15:35:31', '1', 21000, 0),
	(216, 9, 1, 'telat', '2017-07-12', '07:36:00', '1', 5000, 5),
	(217, 10, 4, 'sakit unknown', '2017-07-12', '08:00:00', '1', 10000, 29),
	(218, 13, 1, 'tepat waktu', '2017-07-12', '07:25:00', '1', 0, 0),
	(219, 14, 1, 'telat', '2017-07-12', '07:50:00', '1', 10000, 19),
	(220, 17, 1, 'tepat waktu', '2017-07-12', '07:28:00', '1', 0, 0),
	(221, 18, 1, 'telat', '2017-07-12', '07:35:00', '1', 5000, 4),
	(222, 20, 4, 'kepala', '2017-07-12', '08:30:00', '1', 20000, 59),
	(223, 43, 1, 'telat', '2017-07-12', '07:48:00', '1', 10000, 17),
	(224, 9, 4, 'telat', '2017-07-13', '08:40:00', '1', 25000, 69),
	(225, 10, 1, 'telat', '2017-07-13', '07:50:00', '1', 10000, 19),
	(226, 13, 1, 'tepat waktu', '2017-07-13', '07:30:00', '1', 0, 0),
	(227, 14, 1, 'telat', '2017-07-13', '09:08:00', '1', 35000, 97),
	(228, 17, 1, 'tepat waktu', '2017-07-13', '07:20:00', '1', 0, 0),
	(229, 18, 1, 'telat', '2017-07-13', '08:15:00', '1', 15000, 44),
	(230, 20, 1, 'telat', '2017-07-13', '09:05:00', '1', 35000, 94),
	(231, 43, 1, 'telat', '2017-07-13', '07:53:00', '1', 10000, 22),
	(252, 9, 1, 'telat', '2017-07-14', '08:05:00', '1', 15000, 34),
	(253, 10, 1, 'telat', '2017-07-14', '07:50:00', '1', 10000, 19),
	(254, 13, 1, 'tepat waktu', '2017-07-14', '07:20:00', '1', 0, 0),
	(255, 14, 1, 'telat', '2017-07-14', '08:50:00', '1', 30000, 79),
	(256, 17, 1, 'tepat waktu', '2017-07-14', '07:25:00', '1', 0, 0),
	(257, 18, 1, 'tepat waktu', '2017-07-14', '07:30:00', '1', 0, 0),
	(258, 20, 1, 'telat', '2017-07-14', '08:55:00', '1', 30000, 84),
	(259, 43, 1, 'tepat waktu', '2017-07-14', '07:10:00', '1', 0, 0),
	(264, 9, 1, 'telat', '2017-07-17', '08:10:00', '1', 15000, 39),
	(265, 10, 1, 'tepat waktu', '2017-07-17', '06:45:00', '1', 0, 0),
	(266, 13, 1, 'tepat waktu', '2017-07-17', '07:25:00', '1', 0, 0),
	(267, 14, 1, 'telat', '2017-07-17', '08:00:00', '1', 10000, 29),
	(268, 17, 3, 'cuti unknown', '2017-07-17', '12:39:52', '1', 0, 0),
	(269, 18, 6, 'sakit unknown apa', '2017-07-17', '07:30:00', '1', 21000, 0),
	(270, 20, 6, 'sakit unknown', '2017-07-17', '07:30:00', '1', 21000, 0),
	(271, 43, 1, 'telat', '2017-07-17', '07:45:00', '1', 5000, 14),
	(272, 9, 1, 'telat', '2017-07-18', '08:30:00', '1', 20000, 59),
	(273, 10, 1, 'tepat waktu', '2017-07-18', '06:30:00', '1', 0, 0),
	(274, 13, 1, 'tepat waktu', '2017-07-18', '07:10:00', '1', 0, 0),
	(275, 14, 1, 'telat', '2017-07-18', '08:20:00', '1', 20000, 49),
	(276, 17, 1, 'tepat waktu', '2017-07-18', '06:45:00', '1', 0, 0),
	(277, 18, 1, 'tepat waktu', '2017-07-18', '07:30:00', '1', 0, 0),
	(278, 20, 1, 'telat', '2017-07-18', '09:10:00', '1', 35000, 99),
	(279, 43, 1, 'tepat waktu', '2017-07-18', '07:25:00', '1', 0, 0),
	(280, 9, 1, 'telat', '2017-07-19', '08:00:00', '1', 10000, 29),
	(281, 10, 1, 'tepat waktu', '2017-07-19', '07:00:00', '1', 0, 0),
	(282, 13, 1, 'tepat waktu', '2017-07-19', '07:20:00', '1', 0, 0),
	(283, 14, 1, 'telat', '2017-07-19', '07:40:00', '1', 5000, 9),
	(284, 17, 1, 'telat', '2017-07-19', '09:00:00', '1', 30000, 89),
	(285, 18, 1, 'telat', '2017-07-19', '07:35:00', '1', 5000, 4),
	(286, 20, 1, 'telat', '2017-07-19', '09:15:00', '1', 35000, 104),
	(287, 43, 1, 'tepat waktu', '2017-07-19', '07:30:00', '1', 0, 0),
	(288, 9, 1, 'telat', '2017-07-20', '07:50:00', '1', 10000, 19),
	(289, 10, 1, 'tepat waktu', '2017-07-20', '07:15:00', '1', 0, 0),
	(290, 13, 1, 'telat', '2017-07-20', '07:40:00', '1', 5000, 9),
	(291, 14, 1, 'telat', '2017-07-20', '07:50:00', '1', 10000, 19),
	(292, 17, 1, 'tepat waktu', '2017-07-20', '07:20:00', '1', 0, 0),
	(293, 18, 1, 'telat', '2017-07-20', '07:45:00', '1', 5000, 14),
	(294, 20, 1, 'telat', '2017-07-20', '13:13:29', '1', NULL, NULL),
	(295, 43, 1, 'tepat waktu', '2017-07-20', '07:30:00', '1', 0, 0),
	(296, 10, 1, 'tepat waktu', '2017-07-24', '06:30:00', '1', 0, 0),
	(297, 13, 1, 'tepat waktu', '2017-07-24', '07:20:00', '1', 0, 0),
	(298, 18, 1, 'tepat waktu', '2017-07-24', '07:25:00', '1', 0, 0),
	(299, 9, 1, 'telat', '2017-07-21', '07:40:00', '1', 5000, 9),
	(304, 18, 1, 'tepat waktu', '2017-07-21', '07:30:00', '', 0, 0),
	(307, 43, 6, 'ijin guru', '2017-07-21', '07:50:56', '1', 21000, NULL),
	(308, 13, 1, 'tepat waktu', '2017-07-21', '07:20:00', '1', 0, 0),
	(310, 17, 1, 'tepat waktu', '2017-07-21', '07:25:00', '1', 0, 0),
	(311, 10, 1, 'tepat waktu', '2017-07-21', '06:45:00', '1', 0, 0),
	(312, 14, 1, 'telat', '2017-07-21', '07:45:00', '', 5000, 14),
	(314, 20, 1, 'telat', '2017-07-21', '08:40:00', '', 25000, 69),
	(315, 43, 1, 'tepat waktu', '2017-07-24', '07:30:00', '1', 0, 0),
	(316, 17, 3, 'unknown', '2017-07-24', '06:30:00', '1', 0, 0),
	(317, 9, 1, 'telat', '2017-07-24', '07:45:00', '1', 5000, 14),
	(318, 20, 1, 'telat', '2017-07-24', '09:00:00', '1', 30000, 89),
	(319, 14, 1, 'tepat waktu', '2017-07-24', '07:30:00', '1', 0, 0);
/*!40000 ALTER TABLE `data_ra` ENABLE KEYS */;

-- membuang struktur untuk table absen.data_s
CREATE TABLE IF NOT EXISTS `data_s` (
  `id_s` smallint(6) NOT NULL AUTO_INCREMENT,
  `keterangan_s` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_s`),
  UNIQUE KEY `keterangan_s` (`keterangan_s`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel absen.data_s: ~5 rows (lebih kurang)
DELETE FROM `data_s`;
/*!40000 ALTER TABLE `data_s` DISABLE KEYS */;
INSERT INTO `data_s` (`id_s`, `keterangan_s`) VALUES
	(5, 'alpha'),
	(3, 'cuti'),
	(1, 'hadir'),
	(6, 'ijin 1 hari'),
	(4, 'sakit');
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

-- membuang struktur untuk trigger absen.reset_cuti_berapakali
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `reset_cuti_berapakali` AFTER UPDATE ON `data_m` FOR EACH ROW begin
if new.id_m = 2 then
update data_c 
set cuti_berapakali =  0 ;
end if;
end//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger absen.updatetime
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `updatetime` BEFORE INSERT ON `data_ra` FOR EACH ROW BEGIN
	/*IF NEW.jam = '00:00:00' THEN*/
		SET NEW.jam = CURRENT_TIMESTAMP();
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
	data_k.jabatan_k = 12 ;

-- membuang struktur untuk view absen.query
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `query`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `query` AS SELECT
data_ra.id_k,
data_ra.detail
FROM
data_ra
WHERE
data_ra.id_s = 1 ;

-- membuang struktur untuk view absen.subquery
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `subquery`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `subquery` AS SELECT data_ra.id_k,count(data_ra.id_k) AS jumlah 
                        from data_ra 
                        INNER JOIN data_k ON data_ra.id_k = data_k.id_k 
                        WHERE data_ra.detail = 'tepat waktu' AND data_k.jabatan_k != 12 AND MONTH (data_ra.tanggal) = '07' AND YEAR (data_ra.tanggal) ='2017'
                        GROUP BY id_k ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
