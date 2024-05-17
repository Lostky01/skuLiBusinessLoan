-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 03:52 AM
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
  `nama` varchar(255) NOT NULL,
  `jumlah` int(99) NOT NULL,
  `jumlah_default` int(99) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id`, `nama`, `jumlah`, `jumlah_default`, `created_at`, `updated_at`) VALUES
(2, 'Proyektor Infocus', 5, 5, '2024-04-23 03:28:50', '2024-05-14 23:57:22'),
(3, 'Monitor PC', 5, 6, '2024-04-24 01:49:16', '2024-05-14 17:41:56'),
(5, 'Proyektor', 5, 5, '2024-05-05 22:54:36', '2024-05-14 23:57:22'),
(6, 'Kabel VGA', 5, 5, '2024-05-05 22:55:55', '2024-05-14 23:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_pinjam`
--

CREATE TABLE `data_pinjam` (
  `id` int(99) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `kelas` varchar(255) NOT NULL,
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

INSERT INTO `data_pinjam` (`id`, `tanggal`, `kelas`, `nama_barang`, `pelajaran`, `nama_guru`, `status`, `created_at`, `updated_at`) VALUES
(5, '2024-04-30 01:57:13', 'XI RPL 3', 'Proyektor', 'PBO', 'Pak Rivan', 'Sudah Dikembalikan', '2024-04-29 18:57:13', '2024-05-05 22:27:41'),
(12, '2024-05-15 00:18:19', 'XI RPL 3', '3', 'WEB', 'Pak Rivan', 'Belum Dikembalikan', '2024-05-14 17:18:19', '2024-05-14 17:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(99) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin123', '2024-04-23 03:29:32', '2024-04-23 03:29:32'),
(2, 'rifky', 'rifky12345', '2024-05-10 02:32:05', '2024-05-10 02:32:05'),
(3, 'Falah', 'palah021206', '2024-05-10 03:12:46', '2024-05-10 03:12:46');

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
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_pinjam`
--
ALTER TABLE `data_pinjam`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
