-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2026 at 03:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_2026_ratum`
--

-- --------------------------------------------------------

--
-- Table structure for table `input-aspirasi`
--

CREATE TABLE `input-aspirasi` (
  `id_pelaporan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input-aspirasi`
--

INSERT INTO `input-aspirasi` (`id_pelaporan`, `id_kategori`, `iduser`, `lokasi`, `keterangan`, `status`, `feedback`) VALUES
(15, 1, 2, 'depan ruang guru', 'potnya jatuh dari lantai 2', 'selesai', 'sudah saya perbaiki dan saya taruh di tempat yang lebih aman ya, terimakasih telah melapor maaf menggangu kenyamanan anda'),
(16, 2, 2, '12 rpl 1', '2 kursi patah', 'proses', 'akan kami ganti pada senin pagi ya, terimakasih sudah melapor\r\n'),
(17, 5, 5, 'lapangan baseball', 'tongkat baseball patah 2, pagar jaring rusak karna todo terlalu keras memukul bola ^^', 'selesai', 'Sudah kami ganti dengan yang baru yang mulai dari tongkat baseball ataupun pagar pembatas, tolong untuk lebih ber hati-hati lagi ya'),
(18, 3, 4, 'lab rpl', 'atap bocor', 'menunggu', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Sarana lingkungan '),
(2, 'Sarana Kelas'),
(3, 'Sarana Lab '),
(4, 'Prasarana'),
(5, 'Sarana Ekstrakulikuler'),
(6, 'Sarana Olahraga'),
(7, 'Sarana Transportasi'),
(8, 'Sarana Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','siswa') NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`, `nis`, `kelas`) VALUES
(1, 'admin', 'admin1', 'admin123', 'admin', '', ''),
(2, 'Ratu Maura', '160808', '123456', 'siswa', '', 'XII-RPL'),
(4, 'Shaumi Awalliya', '90108', '123456', 'siswa', '', 'XI-RPL'),
(5, 'Gojo Satoru', '71289', '123456', 'siswa', '', 'X-RPL'),
(6, 'Itadori Yuji', '200303', '123456', 'siswa', '', 'X-TKJ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input-aspirasi`
--
ALTER TABLE `input-aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `input-aspirasi`
--
ALTER TABLE `input-aspirasi`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `input-aspirasi`
--
ALTER TABLE `input-aspirasi`
  ADD CONSTRAINT `input-aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `input-aspirasi_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
