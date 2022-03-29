-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2022 pada 12.09
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.24

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses_ujian`
--

CREATE TABLE `akses_ujian` (
  `id_akses` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `kelas_jurusan` int(11) DEFAULT NULL COMMENT '1-3 = rpl,\r\n4-6 = pplg,\r\n7-9 = mm,\r\n10-12 = dkv,\r\n13-15 = tbsm,\r\n16-18 = tkro,\r\n19-21 = aph,\r\n22-24 = akl'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses_ujian`
--

INSERT INTO `akses_ujian` (`id_akses`, `id_ujian`, `kelas_jurusan`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 2, 2),
(11, 2, 5),
(12, 2, 8),
(13, 3, 2),
(14, 4, 8),
(15, 5, 1),
(16, 5, 4),
(17, 5, 7),
(18, 6, 3),
(19, 6, 6),
(20, 6, 9),
(21, 7, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_ujian`
--

CREATE TABLE `daftar_ujian` (
  `id_ujian` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_ujian`
--

INSERT INTO `daftar_ujian` (`id_ujian`, `judul`, `file`, `token`) VALUES
(1, 'Matematika', '', ''),
(2, 'Kelas 2 all', '', ''),
(3, 'kelas 2 rpl', '', ''),
(4, 'kelas 2 mm', '', ''),
(5, 'kelas 1 semua', '', ''),
(6, 'kelas 3 all', '', ''),
(7, 'kelas 3 mm', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `NIP` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`NIP`, `nama`, `email`, `password`, `role`) VALUES
(123123, 'Sri Wahyuni', 'sri@gmail.com', '$2y$10$AQcZ1hB8IpciAOv2KEaETOsJWY627B9ffLBlJz9iOxCo/wjS2PKUa', '2'),
(221133, 'Ahmad Bahlul', 'ahmad@gmail.com', '$2y$10$HuT0o1xKt4RHYIIDAJioH.53ZCl8lztlj2Kn.eeWTDPq3Tdi2.vw6', '2'),
(321321, 'Sutanto', 'sutanto@gmail.com', '$2y$10$4hNoUv2Bv2gFEpredLl4DOXpxYcS44NTXlN5f9mNhxDqc.pv8RgG2', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` varchar(10) NOT NULL,
  `jurusan` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
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
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_jurusan`
--

CREATE TABLE `kelas_jurusan` (
  `id` int(11) NOT NULL,
  `kelas` int(10) DEFAULT NULL,
  `jurusan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas_jurusan`
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
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `id_kelas_jurusan` int(11) NOT NULL,
  `mapel_nama` varchar(100) NOT NULL,
  `mapel_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` varchar(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
('3', 'admin'),
('2', 'guru'),
('1', 'murid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_users`
--

CREATE TABLE `temp_users` (
  `email` varchar(35) NOT NULL,
  `code_otp` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes`
--

CREATE TABLE `tes` (
  `id` int(11) NOT NULL,
  `jeson` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tes`
--

INSERT INTO `tes` (`id`, `jeson`) VALUES
(1, '[\"RPL\",\"MM\"]'),
(2, '[\"RPL\",\"MM\"]'),
(3, '[\"RPL\",\"MM\"]'),
(4, '[\"RPL\",\"MM\"]'),
(5, '[\"RPL\",\"MM\"]'),
(6, '[\"RPL\",\"MM\"]'),
(7, '[\"RPL\",\"MM\"]'),
(8, '[\"RPL\",\"MM\"]'),
(9, '[\"RPL\",\"MM\"]'),
(10, '[\"RPL\",\"MM\"]'),
(11, '[\"RPL\",\"MM\"]'),
(12, 'Array');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`, `kelas`, `jurusan`, `code_otp`) VALUES
(1, 'admin', 'admin@admin', '$2y$10$NJnxvG0pA65.Vrwviqo3o.fv6NNkLwQpJyXlCBLu7GudZCPESAEmC', '3', NULL, NULL, NULL),
(4, 'Raffi', 'klsterbuka@gmail.com', '$2y$10$4QV3uLy1OAgDt8tQEt/PMOuS.qe9kA3AlC5YAXU2GR8MBasyQAD4m', '1', 2, 'rpl', NULL),
(5, 'Rama', 'rama@gmail.com', '$2y$10$BWunKYsZLms3G.LuigIjxOr2kN0X1SWNzPAHw5yxLyq.nq/r5VVEe', '1', 2, 'pplg', NULL),
(6, 'seno', 'seno@gmail.com', '$2y$10$Ae8IogOA00nRgV2s78wAYOuga.6s9wzcrSbT2hpldKYtV9E7Z1Knq', '1', 2, 'mm', NULL),
(7, 'magfiroh', 'magfiroh@gmail.com', '$2y$10$ldMBtFkXEwH7eDCTDoifCeP3htSnZ92PWIH/tXpISyZUBPHluzg9K', '1', 2, 'dkv', NULL),
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
(30, 'a3', 'h3@gmail.com', '$2y$10$TAt1XBqHORbvU8/xnPaWLOFsEy3T6w3Ke/XMPqgHIBNMlA9kr5L46', '1', 3, 'tkro', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_otp`
--

CREATE TABLE `verifikasi_otp` (
  `kode_otp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `verifikasi_otp`
--

INSERT INTO `verifikasi_otp` (`kode_otp`) VALUES
('123123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses_ujian`
--
ALTER TABLE `akses_ujian`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `kelas` (`kelas_jurusan`);

--
-- Indeks untuk tabel `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan` (`jurusan`),
  ADD KEY `kelas` (`kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `jurusan` (`jurusan`),
  ADD KEY `role` (`role`),
  ADD KEY `users_ibfk_1` (`kelas`);

--
-- Indeks untuk tabel `verifikasi_otp`
--
ALTER TABLE `verifikasi_otp`
  ADD PRIMARY KEY (`kode_otp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses_ujian`
--
ALTER TABLE `akses_ujian`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tes`
--
ALTER TABLE `tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akses_ujian`
--
ALTER TABLE `akses_ujian`
  ADD CONSTRAINT `akses_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `daftar_ujian` (`id_ujian`),
  ADD CONSTRAINT `akses_ujian_ibfk_2` FOREIGN KEY (`kelas_jurusan`) REFERENCES `kelas_jurusan` (`id`);

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  ADD CONSTRAINT `kelas_jurusan_ibfk_1` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `kelas_jurusan_ibfk_2` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
