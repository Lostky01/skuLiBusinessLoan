-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 07:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id` int(99) NOT NULL,
  `kode_barang` int(99) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah` int(99) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id`, `kode_barang`, `nama`, `jumlah`, `created_at`, `updated_at`) VALUES
(10, 1001, 'Proyektor', 1, '2024-05-30 18:12:24', '2024-05-30 18:12:24'),
(11, 1002, 'Kabel VGA', 1, '2024-05-30 18:12:32', '2024-05-30 18:12:32'),
(12, 1003, 'Kabel VGA 1', 1, '2024-05-30 18:18:06', '2024-05-30 18:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `data_pinjam`
--

CREATE TABLE `data_pinjam` (
  `id` int(99) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `kelas` varchar(255) NOT NULL,
  `kode_barang` int(99) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `pelajaran` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pinjam`
--

INSERT INTO `data_pinjam` (`id`, `tanggal`, `kelas`, `kode_barang`, `nama_barang`, `pelajaran`, `nama_guru`, `status`, `created_at`, `updated_at`) VALUES
(18, '2024-05-31 02:30:08', 'XI RPL 3', 1001, '10', 'PBO', 'Pak Rivan', 'Belum Dikembalikan', '2024-05-30 19:30:08', '2024-05-30 19:30:08'),
(19, '2024-05-31 02:35:33', 'XI RPL INDUSTRI', 1002, '11', 'WEB', 'Pak Dedi', 'Sudah Dikembalikan', '2024-05-30 19:35:33', '2024-05-30 22:31:53'),
(20, '2024-05-31 05:32:57', 'XI RPL 1', 1002, '11', 'PBO', 'Pak Ramdani', 'Sudah Dikembalikan', '2024-05-30 22:32:57', '2024-05-30 22:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(99) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(99) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(5, 'Rifky admin', 'rifky12345', '1', '2024-05-16 18:34:28', '2024-05-16 18:34:28'),
(6, 'Rifky user', 'rifky12345', '2', '2024-05-16 23:39:08', '2024-05-16 23:39:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pinjam`
--
ALTER TABLE `data_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_pinjam`
--
ALTER TABLE `data_pinjam`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
