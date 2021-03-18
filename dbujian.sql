-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 10:21 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `nomor_soal` int(11) NOT NULL,
  `soal` text NOT NULL,
  `opsi_a` varchar(125) NOT NULL,
  `opsi_b` varchar(125) NOT NULL,
  `opsi_c` varchar(125) NOT NULL,
  `opsi_d` varchar(125) NOT NULL,
  `jawaban` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_soal`
--

INSERT INTO `bank_soal` (`id`, `id_ujian`, `nomor_soal`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `jawaban`) VALUES
(1, 1, 1, 'Apa nama team divisi Mobile Legend RRQ?', 'Hoshi', 'NTmu', 'UG', 'Legends', 'Hoshi'),
(2, 1, 2, 'Sudah berapa kali RRQ menjuarai MPL ID?', 'Satu', 'Dua', 'Tiga', 'Sembilan', 'Tiga'),
(6, 4, 1, 'Siapa saya?', 'Bayu', 'Ryan', 'Danny', 'Hugo', 'Bayu'),
(7, 4, 2, 'Berapa umur Bayu?', '11', '20', '25', '13', '20');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `total_pertanyaan` int(11) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `waktu_ujian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_nilai` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_siswa`, `id_ujian`, `total_pertanyaan`, `jawaban_benar`, `jawaban_salah`, `waktu_ujian`, `total_nilai`) VALUES
(1, 2, 1, 2, 1, 1, '2020-11-30 17:00:00', '50'),
(2, 3, 2, 2, 2, 0, '2020-12-01 17:00:00', '100'),
(3, 2, 4, 2, 2, 0, '2020-12-02 17:00:00', '100');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(8) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jeniskelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_user`, `nis`, `kelas`, `jeniskelamin`, `telepon`) VALUES
(79, 80, '123456', 'XII TKJ 2', 'Laki-Laki', '087887907596'),
(81, 82, '111111', 'XII TSM 1', 'Laki-Laki', '0872343442');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `mapel` varchar(125) NOT NULL,
  `waktu` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id`, `id_user`, `mapel`, `waktu`, `tanggal`) VALUES
(1, 1, 'eSports', 60, '2020-12-03 08:16:00'),
(4, 1, 'eSports', 60, '2020-12-03 08:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` enum('guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Saya Guru', 'guru', '77e69c137812518e359196bb2f5e9bb9', 'guru'),
(80, 'Bayu Sri Pratama', 'bayutama', 'a430e06de5ce438d499c2e4063d60fd6', 'siswa'),
(82, 'Versailes', 'ver', '0812f14f43315611dd0ef462515c9d00', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
