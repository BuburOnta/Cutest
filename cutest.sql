-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2022 at 09:19 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cutest`
--
CREATE DATABASE IF NOT EXISTS `cutest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cutest`;

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` varchar(40) DEFAULT NULL,
  `tanggal_exp` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `akses_absensi`
--

DROP TABLE IF EXISTS `akses_absensi`;
CREATE TABLE `akses_absensi` (
  `id_akses` int(11) NOT NULL,
  `id_absensi` int(11) DEFAULT NULL,
  `id_murid` int(11) DEFAULT NULL,
  `waktu_absen` varchar(30) DEFAULT NULL,
  `keterangan` varchar(10) DEFAULT NULL,
  `alasan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `akses_ujian`
--

DROP TABLE IF EXISTS `akses_ujian`;
CREATE TABLE `akses_ujian` (
  `id_akses` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `kelas_jurusan` int(11) DEFAULT NULL COMMENT '1-3 = rpl,\r\n4-6 = pplg,\r\n7-9 = mm,\r\n10-12 = dkv,\r\n13-15 = tbsm,\r\n16-18 = tkro,\r\n19-21 = aph,\r\n22-24 = akl'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_ujian`
--

DROP TABLE IF EXISTS `daftar_ujian`;
CREATE TABLE `daftar_ujian` (
  `id_ujian` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `judul` varchar(50) NOT NULL,
  `tipe_ujian` varchar(10) DEFAULT NULL,
  `file` varchar(50) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `NIP` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`NIP`, `nama`, `jk`, `email`, `password`, `role`) VALUES
(123123, 'Sri Wahyuni', 'perempuan', 'sri@gmail.com', '$2y$10$AQcZ1hB8IpciAOv2KEaETOsJWY627B9ffLBlJz9iOxCo/wjS2PKUa', '2'),
(221133, 'Ahmad Bahlul', 'laki-laki', 'ahmad@gmail.com', '$2y$10$HuT0o1xKt4RHYIIDAJioH.53ZCl8lztlj2Kn.eeWTDPq3Tdi2.vw6', '2'),
(321321, 'Sutanto', 'laki-laki', 'sutanto@gmail.com', '$2y$10$4hNoUv2Bv2gFEpredLl4DOXpxYcS44NTXlN5f9mNhxDqc.pv8RgG2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id_jurusan` varchar(10) NOT NULL,
  `jurusan` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
('akl', 'Akutansi Keuangan Lembaga'),
('aph', 'Akomodasi Perhotelan'),
('dkv', 'Desain Komunikasi Visual'),
('mm', 'MultiMedia'),
('pplg', 'Pemrograman Perangkat Lunak Gim'),
('rpl', 'Rekayasa Perangkat Lunak'),
('tbsm', 'Teknik Bisnis Sepeda Motor'),
('tkro', 'Teknik Kendaraan Ringan Otomotif');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_jurusan`
--

DROP TABLE IF EXISTS `kelas_jurusan`;
CREATE TABLE `kelas_jurusan` (
  `id` int(11) NOT NULL,
  `kelas` int(10) DEFAULT NULL,
  `jurusan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_jurusan`
--

INSERT INTO `kelas_jurusan` (`id`, `kelas`, `jurusan`) VALUES
(1, 1, 'rpl'),
(2, 2, 'rpl'),
(3, 3, 'rpl'),
(4, 1, 'pplg'),
(5, 2, 'pplg'),
(6, 3, 'pplg'),
(7, 1, 'mm'),
(8, 2, 'mm'),
(9, 3, 'mm'),
(10, 1, 'dkv'),
(11, 2, 'dkv'),
(12, 3, 'dkv'),
(13, 1, 'tbsm'),
(14, 2, 'tbsm'),
(15, 3, 'tbsm'),
(16, 1, 'tkro'),
(17, 2, 'tkro'),
(18, 3, 'tkro'),
(19, 1, 'aph'),
(20, 2, 'aph'),
(21, 3, 'aph'),
(22, 1, 'akl'),
(23, 2, 'akl'),
(24, 3, 'akl');

-- --------------------------------------------------------

--
-- Table structure for table `murid_ujian`
--

DROP TABLE IF EXISTS `murid_ujian`;
CREATE TABLE `murid_ujian` (
  `id` int(11) NOT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `kelas` int(11) DEFAULT NULL,
  `jurusan` varchar(10) DEFAULT NULL,
  `id_murid` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL DEFAULT 'belum submit',
  `waktu_mulai` varchar(25) DEFAULT NULL,
  `waktu_selesai` varchar(25) DEFAULT NULL,
  `nilai` int(10) DEFAULT NULL,
  `predikat` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Murid yang sudah mengerjakan ujian';

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_role` varchar(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
('3', 'admin'),
('2', 'guru'),
('1', 'murid'),
('4', 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian`
--

DROP TABLE IF EXISTS `soal_ujian`;
CREATE TABLE `soal_ujian` (
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `nomor_soal` varchar(5) DEFAULT NULL,
  `jawaban` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

DROP TABLE IF EXISTS `temp_users`;
CREATE TABLE `temp_users` (
  `email` varchar(35) NOT NULL,
  `code_otp` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(11) DEFAULT NULL,
  `kelas` int(11) DEFAULT NULL,
  `jurusan` varchar(11) DEFAULT NULL,
  `code_otp` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`, `kelas`, `jurusan`, `code_otp`) VALUES
(1, 'admin', 'admin@admin', '$2y$10$NJnxvG0pA65.Vrwviqo3o.fv6NNkLwQpJyXlCBLu7GudZCPESAEmC', '3', NULL, NULL, NULL),
(4, 'Raffi Ramadhan Tajudin', 'klsterbuka@gmail.com', '$2y$10$F0jvggW2d5XSUvyehWvEBunc7yL3.M.NcMO26i1PdGNnVIjActyi.', '1', 2, 'rpl', NULL),
(5, 'Rama', 'rama@gmail.com', '$2y$10$BWunKYsZLms3G.LuigIjxOr2kN0X1SWNzPAHw5yxLyq.nq/r5VVEe', '1', 2, 'pplg', NULL),
(6, 'seno', 'seno@gmail.com', '$2y$10$Ae8IogOA00nRgV2s78wAYOuga.6s9wzcrSbT2hpldKYtV9E7Z1Knq', '1', 2, 'mm', NULL),
(7, 'magfiroh', 'magfiroh@gmail.com', '$2y$10$ldMBtFkXEwH7eDCTDoifCeP3htSnZ92PWIH/tXpISyZUBPHluzg9K', '1', 2, 'dkv', '390138'),
(8, 'akilah', 'akilah@gmail.com', '$2y$10$fyzvCnlxVTNvZLt86a4e1.UJdjeTDsYw3JeD23lIZaxHtxKFuHKOu', '1', 2, 'aph', NULL),
(9, 'royan', 'royan@gmail.com', '$2y$10$.aZcj/7yI3egmpU79vTs6e.9jCRohFbxJMKzp7c8YuLRODNm8FrjW', '1', 2, 'tbsm', NULL),
(10, 'a2', 'a2@gmail.com', '$2y$10$GBkFwyH.CHbPfMCxxzSdeeo0RMKFEFN3lnPsmAdqkhbKmwAVak17a', '1', 2, 'akl', NULL),
(11, 'b2', 'b2@gmail.com', '$2y$10$8rLBEHxfnInUcX2vDefvyOBRgkjWlcFLsedWtdDGu97EMd5tkwM7y', '1', 2, 'tkro', NULL),
(12, 'a1', 'a1@gmail.com', '$2y$10$CPaAevMtykcu5Ofs6O.DZ.TN89chtrbUheY8PzcrnCQhHs/XbtfDi', '1', 1, 'rpl', NULL),
(13, 'b1', 'b1@gmail.com', '$2y$10$gapkch7WCCnKZA.e.68rkOp9k83Qe57GJW4V2G/8DNs9On.mFlmBK', '1', 1, 'pplg', NULL),
(14, 'c1', 'c1@gmail.com', '$2y$10$Ba7dMHrdfnU00.YzfNBOteh1oSB4H31n7rWo37.wgsH0R1CbgZDpa', '1', 1, 'mm', NULL),
(15, 'd1', 'd1@gmail.com', '$2y$10$wiAuk7lDxlh.Uzx0r7Z7DOZxx1s6ChaOgTLjlQ4rWHelJQIXbAHMq', '1', 1, 'dkv', NULL),
(16, 'e1', 'e1@gmail.com', '$2y$10$fxxiXMpHYoIIyJX5puA30.qWZcctkzf32oF3lYfDdEn35Vrh6Xv42', '1', 1, 'aph', NULL),
(17, 'f1', 'f1@gmail.com', '$2y$10$taMKe4wBBOTleeaxAHqVJeTaWCb/YVG1/wzn2g7PoxarJVe8RAIIq', '1', 1, 'akl', NULL),
(19, 'g1', 'g1@gmail.com', '$2y$10$Ca0P9pwCD8Spu7Fss3ecwOYSWx4DbJsqmm9GCico4YQR2DWpwRb2a', '1', 1, 'tbsm', NULL),
(20, 'h1', 'h1@gmail.coh', '$2y$10$HcCGU2E..GTOhx023nRgZObPAVPCf71oofcxHdfTsJDAH8CuP7g6q', '1', 1, 'tkro', NULL),
(22, 'a3', 'a3@gmail.com', '$2y$10$Q2GxHcRTH4UJIQRWjBzqde5u8h.pS2694os.yeD8ilpcB1nipJmOC', '1', 3, 'rpl', NULL),
(23, 'b3', 'b3@gmail.com', '$2y$10$FxoT0RbnawRLxASJNF9ynuJSDFL946NDckew3asxW8xF6ksiymy9G', '1', 3, 'pplg', NULL),
(25, 'c3', 'c3@gmail.com', '$2y$10$fnjVLrQvmBLTWJLy/mO/HuGj3w57wT98VpsqxNOhYzN95ujP22/sG', '1', 3, 'mm', NULL),
(26, 'd3', 'd3@gmail.com', '$2y$10$1XtLEZixHdsYUQl3YWwfCu6xgCvaColq4/nWFNTzxmF9I6RUCNTny', '1', 3, 'dkv', NULL),
(27, 'e3', 'e3@gmail.com', '$2y$10$OEs1qguGSjG9RU1scfB2Ce5vkx8AUErGR8h9MA7Lk7DgtBZbbAHkW', '1', 3, 'aph', NULL),
(28, 'f3', 'f3@gmail.com', '$2y$10$1bPN6io6W0UBTcXFo106TOTNzIBM/ZIcJboLAItBHT8M5avMLWE/O', '1', 3, 'akl', NULL),
(29, 'g3', 'g3@gmail.com', '$2y$10$BYMcC15.VQtkVMjkt5BVZORfAweiYQdnQa6tAKmSGbC8C4uBA2n/2', '1', 3, 'tbsm', NULL),
(30, 'a3', 'h3@gmail.com', '$2y$10$TAt1XBqHORbvU8/xnPaWLOFsEy3T6w3Ke/XMPqgHIBNMlA9kr5L46', '1', 3, 'tkro', NULL),
(31, 'Anto', 'anto@gmail.com', '$2y$10$jnaBamm4TZkmj4OPp7z/sepx2B0YrHy0fE8QYbcOboHFrtYT3nm96', '1', 2, 'rpl', NULL),
(32, 'Operator', 'operator@operator', '$2y$10$vH7bTXHaL6BXe8QGUJqeveI35PuRWfiFJZKzfM5M/cpATB9xfpyaq', '4', NULL, NULL, NULL),
(33, 'maghfiroh', 'maghfiroh575@gmail.com', '$2y$10$oG4FtXO7r.DlL3t1tugx1O.HpaJdeewJp6HlGwc0FS6OBbDGBNRmO', '1', 2, 'rpl', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `akses_absensi`
--
ALTER TABLE `akses_absensi`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `akses_ujian`
--
ALTER TABLE `akses_ujian`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `kelas` (`kelas_jurusan`);

--
-- Indexes for table `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan` (`jurusan`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `murid_ujian`
--
ALTER TABLE `murid_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_murid` (`id_murid`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `jurusan` (`jurusan`),
  ADD KEY `role` (`role`),
  ADD KEY `users_ibfk_1` (`kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `akses_absensi`
--
ALTER TABLE `akses_absensi`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `akses_ujian`
--
ALTER TABLE `akses_ujian`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `murid_ujian`
--
ALTER TABLE `murid_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses_ujian`
--
ALTER TABLE `akses_ujian`
  ADD CONSTRAINT `akses_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `daftar_ujian` (`id_ujian`),
  ADD CONSTRAINT `akses_ujian_ibfk_2` FOREIGN KEY (`kelas_jurusan`) REFERENCES `kelas_jurusan` (`id`);

--
-- Constraints for table `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  ADD CONSTRAINT `daftar_ujian_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`NIP`);

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  ADD CONSTRAINT `kelas_jurusan_ibfk_1` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `kelas_jurusan_ibfk_2` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `murid_ujian`
--
ALTER TABLE `murid_ujian`
  ADD CONSTRAINT `murid_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `daftar_ujian` (`id_ujian`),
  ADD CONSTRAINT `murid_ujian_ibfk_2` FOREIGN KEY (`id_murid`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `murid_ujian_ibfk_4` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `murid_ujian_ibfk_5` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD CONSTRAINT `soal_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `daftar_ujian` (`id_ujian`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
