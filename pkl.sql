-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 14, 2019 at 07:42 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL,
  `nama_jenis_barang` varchar(30) NOT NULL,
  `izin_jenis_barang` enum('pending','accepted','declined') NOT NULL,
  `date_jenis_barang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis_barang`, `nama_jenis_barang`, `izin_jenis_barang`, `date_jenis_barang`) VALUES
(129, 'Senjata', 'accepted', '2019-08-13 17:58:44'),
(130, 'Makanan', 'accepted', '2019-08-13 18:45:00'),
(131, 'Lain-lain', 'accepted', '2019-08-13 19:04:30'),
(132, 'Album musik', 'accepted', '2019-08-13 19:04:35'),
(133, 'Kendaraan', 'accepted', '2019-08-13 23:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `login_session`
--

CREATE TABLE `login_session` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','subag','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_session`
--

INSERT INTO `login_session` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '72545f3f86fad045a26ed54abd2bbb9f', 'admin'),
(2, 'subag', '143ad2695caf8f2368b5d9ef03d37ee8', 'subag'),
(5, 'ahmadalexander', '534b44a19bf18d20b71ecc4eb77c572f', 'user'),
(6, 'Huda', '0075a4e7a2e71083262da135ecdbdd14', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `status_submisi`
--

CREATE TABLE `status_submisi` (
  `id_status_submisi` int(11) NOT NULL,
  `nama_status_submisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_submisi`
--

INSERT INTO `status_submisi` (`id_status_submisi`, `nama_status_submisi`) VALUES
(1, 'Pending'),
(2, 'Permintaan ditolak'),
(3, 'Permintaan diterima');

-- --------------------------------------------------------

--
-- Table structure for table `status_terima`
--

CREATE TABLE `status_terima` (
  `id_status_terima` int(11) NOT NULL,
  `nama_status_terima` varchar(30) NOT NULL,
  `id_status_submisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_terima`
--

INSERT INTO `status_terima` (`id_status_terima`, `nama_status_terima`, `id_status_submisi`) VALUES
(4, 'Belum diterima pengaju', 3),
(6, 'Belum ACC', 1),
(7, 'Pengajuan ditolak', 2),
(8, 'Diterima pengaju', 3);

-- --------------------------------------------------------

--
-- Table structure for table `submisi_barang`
--

CREATE TABLE `submisi_barang` (
  `id` int(11) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah_barang` bigint(20) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `id_status_submisi` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `id_status_terima` int(11) NOT NULL,
  `date_barang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submisi_barang`
--

INSERT INTO `submisi_barang` (`id`, `id_jenis_barang`, `nama_barang`, `jumlah_barang`, `satuan`, `id_status_submisi`, `username`, `id_status_terima`, `date_barang`) VALUES
(41, 132, 'Revolver', 1, 'Unit', 3, 'ahmadalexander', 8, '2019-08-13 19:06:47'),
(42, 132, 'A Night At The Opera oleh Queen', 1, 'Unit', 3, 'ahmadalexander', 8, '2019-08-13 19:06:50'),
(43, 132, 'Abbey Road oleh The Beatles', 1, 'Unit', 2, 'admin', 7, '2019-08-13 23:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `level` enum('admin','subag','user') NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `level`, `menu_id`) VALUES
(1, 'admin', 1),
(2, 'subag', 2),
(3, 'user', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'subag'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(14, 1, 'Dashboard', 'admin/index', 'fas fa-tachometer-alt', 1),
(15, 1, 'Daftar Barang', 'admin/daftarBarang', 'fas fa-fw fa-boxes', 1),
(18, 3, 'Dashboard', 'user/index', 'fas fa-tachometer-alt', 1),
(19, 3, 'Daftar Barang', 'user/daftarBarang', 'fas fa-fw fa-boxes', 1),
(21, 2, 'Dashboard', 'subag/index', 'fas fa-tachometer-alt', 1),
(22, 2, 'Daftar Barang', 'subag/daftarBarang', 'fas fa-fw fa-boxes', 1),
(25, 1, 'Daftar Kategori', 'admin/permintaanJenis', 'far fa-fw fa-list-alt', 1),
(27, 1, 'User Management', 'admin/userManagement', 'fas fa-fw fa-user-cog', 1),
(31, 2, 'Daftar Kategori', 'subag/daftarKategori', 'fas fa-fw fa-puzzle-piece', 1),
(32, 2, 'Log Out', 'Auth/logout', 'fas fa-fw fa-sign-out-alt', 1),
(35, 3, 'Pengajuan Saya', 'user/pengajuan', 'far fa-fw fa-list-alt', 1),
(36, 3, 'Log Out', 'Auth/logout', 'fas fa-fw fa-sign-out-alt', 1),
(37, 1, 'Pengajuan Saya', 'admin/pengajuan', 'far fa-fw fa-list-alt', 1),
(38, 1, 'Log Out', 'Auth/logout', 'fas fa-fw fa-sign-out-alt', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `login_session`
--
ALTER TABLE `login_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_submisi`
--
ALTER TABLE `status_submisi`
  ADD PRIMARY KEY (`id_status_submisi`);

--
-- Indexes for table `status_terima`
--
ALTER TABLE `status_terima`
  ADD PRIMARY KEY (`id_status_terima`);

--
-- Indexes for table `submisi_barang`
--
ALTER TABLE `submisi_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `login_session`
--
ALTER TABLE `login_session`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_submisi`
--
ALTER TABLE `status_submisi`
  MODIFY `id_status_submisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_terima`
--
ALTER TABLE `status_terima`
  MODIFY `id_status_terima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submisi_barang`
--
ALTER TABLE `submisi_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;