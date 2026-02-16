-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2026 at 05:52 AM
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
  `tanggal_pelaporan` datetime NOT NULL DEFAULT current_timestamp(),
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input-aspirasi`
--

INSERT INTO `input-aspirasi` (`id_pelaporan`, `id_kategori`, `iduser`, `tanggal_pelaporan`, `lokasi`, `keterangan`, `status`, `feedback`) VALUES
(24, 5, 2, '2026-02-14 15:58:17', 'lapangan basket ', 'ring copot', 'proses', 'okee, besok kami ganti ya\r\n'),
(25, 2, 6, '2026-02-14 16:06:16', '10 tkj 1', 'proyektor mati', 'menunggu', ''),
(26, 6, 6, '2026-02-14 19:34:36', 'lapangan dekat pintu utama', 'gawang bolanya bolong jaringnya', 'menunggu', ''),
(27, 8, 7, '2026-02-14 22:17:26', 'UKS ', 'dipan kasur uks sudah rusak', 'proses', 'Baik nanti akan kami ganti ya'),
(28, 6, 7, '2026-02-15 14:41:04', 'lapangan voli ', 'net putus', 'selesai', 'sudah kami ganti ya'),
(29, 5, 7, '2026-02-15 19:35:36', 'ruang seni', 'biola patah', 'proses', 'nanti kami ganti ya'),
(30, 12, 10, '2026-02-15 19:48:15', 'TU', 'mesin printer rusak', 'menunggu', '');

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
(8, 'Sarana Kesehatan'),
(10, 'Kantin'),
(12, 'Sarana Humas');

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
(2, 'Ratu Maura', '160808', 'ratu160808', 'siswa', '', 'XII-RPL'),
(4, 'Shaumi Awalliya', '90108', 'shaumi90108', 'siswa', '', 'XI-RPL'),
(5, 'Gojo Satoru', '71289', '123456', 'siswa', '', 'X-RPL'),
(6, 'Itadori Yuji', '200303', 'yujiganteng', 'siswa', '', 'X-TKJ'),
(7, 'Getto Suguru', '030390', '123456', 'siswa', '', 'XI-TKJ'),
(9, 'Todo Aoi', '230920', '123456', 'siswa', '', 'XII-TKJ'),
(10, 'Nanami Kento', '30790', '123456', 'siswa', '', 'XII-RPL');

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
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
