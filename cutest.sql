-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 03:13 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `daftar_ujian`
--

CREATE TABLE `daftar_ujian` (
  `id_ujian` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `NIP` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`NIP`, `nama`, `email`, `password`, `role`) VALUES
(123123, 'Susanto', 'susanto@gmail.com', '$2y$10$LWpXmnqkxKqsMDCBlouwbOplGhgGR9ZOIqsL49B0lvJdkuXbzresa', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_jurusan`
--

CREATE TABLE `kelas_jurusan` (
  `id_kelas_jurusan` int(11) NOT NULL,
  `kelas_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_jurusan`
--

INSERT INTO `kelas_jurusan` (`id_kelas_jurusan`, `kelas_jurusan`) VALUES
(1, 'x rpl'),
(2, 'xi rpl'),
(3, 'xii rpl'),
(4, 'x pplg'),
(5, 'xi pplg'),
(6, 'xii pplg'),
(7, 'x mm'),
(8, 'xi mm'),
(9, 'xii mm'),
(10, 'x dkv'),
(11, 'xi dkv'),
(12, 'xii dkv'),
(13, 'x tbsm'),
(14, 'xi tbsm'),
(15, 'xii tbsm'),
(16, 'x tkro'),
(17, 'xi tkro'),
(18, 'xii tkro'),
(19, 'x aph'),
(20, 'xi aph'),
(21, 'xii aph'),
(22, 'x akl'),
(23, 'xi akl'),
(24, 'xii akl');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'murid'),
(2, 'guru'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE `temp_users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password_debug` varchar(35) NOT NULL,
  `code_otp` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_users`
--

INSERT INTO `temp_users` (`id_user`, `email`, `password_debug`, `code_otp`, `status`) VALUES
(3, 'lah.ontaks@gmail.com', 'raffie', '879905', 'not verifi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `kelas_jurusan` int(11) NOT NULL,
  `role` int(11) DEFAULT NULL,
  `password_debug` text DEFAULT NULL,
  `code_otp` int(11) DEFAULT NULL,
  `cookie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `kelas_jurusan`, `role`, `password_debug`, `code_otp`, `cookie`) VALUES
(1, 'Raffi Ramadhan', 'klsterbuka@gmail.com', '$2y$10$K8eN1/ICVu.l2HIJOD0M6eMUbpEsssY.hTfqdHnAcHw9EiZr.A.yu', 2, 1, 'raffie', NULL, NULL),
(3, 'admin', 'admin@admin', '$2y$10$zYFiyzP6i6dilWsHuGP8VOevWGN06d7PeennO5m70nERR8K2XB8Ta', 3, 3, 'admin12345', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_otp`
--

CREATE TABLE `verifikasi_otp` (
  `kode_otp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `kelas_jurusan`
--
ALTER TABLE `kelas_jurusan`
  ADD PRIMARY KEY (`id_kelas_jurusan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `role` (`role`),
  ADD KEY `kelas_jurusan` (`kelas_jurusan`);

--
-- Indexes for table `verifikasi_otp`
--
ALTER TABLE `verifikasi_otp`
  ADD PRIMARY KEY (`kode_otp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_ujian`
--
ALTER TABLE `daftar_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_users`
--
ALTER TABLE `temp_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`kelas_jurusan`) REFERENCES `kelas_jurusan` (`id_kelas_jurusan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
