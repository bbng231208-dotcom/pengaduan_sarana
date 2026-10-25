-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2026 at 02:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_sarana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `telp`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator Sarpras', '081234567890'),
(2, 'petugas', '570c396b3fc856eceb8aa7357f32af1a', 'Petugas Sarpras', '089876543210');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(11) NOT NULL,
  `tgl_pengaduan` datetime DEFAULT current_timestamp(),
  `nis` varchar(10) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Proses','Selesai') DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `tgl_pengaduan`, `nis`, `id_kategori`, `lokasi`, `ket`, `foto`, `status`) VALUES
(1, '2026-09-26 08:00:00', '10101', 1, 'Gedung A Lantai 2', 'AC di kelas tidak mau dingin dan bocor airnya.', 'ac_bocor.jpg', 'Proses'),
(2, '2026-09-26 09:30:00', '10102', 2, 'Lab Komputer 1', 'Komputer nomor 15 tidak bisa menyala (mati total).', 'pc_mati.jpg', 'Menunggu'),
(3, '2026-09-26 10:15:00', '10103', 4, 'Toilet Gedung B', 'Kran air di lantai 2 patah dan mengalir terus.', 'kran_patah.jpg', 'Selesai'),
(4, '2026-09-26 11:12:08', '10101', 3, 'ruangan olahraga', 'bola basket pada rusak semua', '', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `id_aspirasi` int(11) NOT NULL,
  `tgl_feedback` datetime DEFAULT current_timestamp(),
  `feedback` text NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_aspirasi`, `tgl_feedback`, `feedback`, `id_admin`) VALUES
(1, 1, '2026-09-26 08:30:00', 'Laporan diterima, teknisi akan segera mengecek AC ke kelas.', 2),
(2, 3, '2026-09-26 11:00:00', 'Kran air sudah diperbaiki dan diganti dengan yang baru oleh tukang sekolah.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `id_histori` int(11) NOT NULL,
  `id_aspirasi` int(11) NOT NULL,
  `tgl_histori` datetime DEFAULT current_timestamp(),
  `status_perubahan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`id_histori`, `id_aspirasi`, `tgl_histori`, `status_perubahan`, `keterangan`) VALUES
(1, 1, '2026-09-26 08:00:00', 'Menunggu', 'Laporan berhasil dibuat oleh siswa.'),
(2, 1, '2026-09-26 08:30:00', 'Proses', 'Petugas meneruskan laporan ke bagian teknisi sarpras.'),
(3, 2, '2026-09-26 09:30:00', 'Menunggu', 'Laporan berhasil dibuat oleh siswa.'),
(4, 3, '2026-09-26 10:15:00', 'Menunggu', 'Laporan berhasil dibuat oleh siswa.'),
(5, 3, '2026-09-26 11:00:00', 'Selesai', 'Perbaikan sarana prasarana telah selesai dilakukan.'),
(6, 4, '2026-09-26 11:12:08', 'Menunggu', 'Laporan berhasil dibuat oleh siswa.');

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
(1, 'Ruang Kelas'),
(2, 'Laboratorium Komputer'),
(3, 'Fasilitas Olahraga'),
(4, 'Sanitasi / Toilet'),
(5, 'Kantin'),
(6, 'Ruang Guru');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `kelas`, `alamat`, `telp`, `password`) VALUES
('10101', 'Ahmad Dani', 'XI RPL 1', 'Jl. Merdeka No. 10', '08111222333', 'e10adc3949ba59abbe56e057f20f883e'),
('10102', 'Dewi Lestari', 'XI TKJ 2', 'Jl. Melati No. 5', '08223334445', 'e10adc3949ba59abbe56e057f20f883e'),
('10103', 'Rizky Pratama', 'XII MM', 'Jl. Sudirman No. 12', '08334445556', 'e10adc3949ba59abbe56e057f20f883e'),
('10104', 'babang', '11 rpl 2', NULL, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_aspirasi` (`id_aspirasi`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_histori`),
  ADD KEY `id_aspirasi` (`id_aspirasi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_aspirasi`) REFERENCES `aspirasi` (`id_aspirasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `histori`
--
ALTER TABLE `histori`
  ADD CONSTRAINT `histori_ibfk_1` FOREIGN KEY (`id_aspirasi`) REFERENCES `aspirasi` (`id_aspirasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
