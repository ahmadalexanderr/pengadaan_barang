- phpMyAdmin SQL
Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8889
-- Generation Time: Jan 10, 2022 at 09:48 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET time_zone
= "+00:00";

--
-- Database: `pengadaan-barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang`
(
  `id_jenis_barang` int
(11) NOT NULL,
  `nama_jenis_barang` varchar
(30) NOT NULL,
  `izin_jenis_barang` enum
('pending','accepted') NOT NULL,
  `date_jenis_barang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB
DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`
id_jenis_barang`,
`nama_jenis_barang
`, `izin_jenis_barang`, `date_jenis_barang`) VALUES
(176, 'Perkakas', 'accepted', '2019-12-10 00:29:04'),
(179, 'Kendaraan', 'accepted', '2019-12-16 19:46:41'),
(180, 'Elektronik', 'accepted', '2019-12-16 19:46:46'),
(181, 'Ponsel', 'accepted', '2019-12-16 19:50:02'),
(182, 'Piringan Hitam', 'accepted', '2019-12-16 19:51:10'),
(183, 'Kaset', 'accepted', '2019-12-16 19:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `login_session`
--

CREATE TABLE `login_session`
(
  `id` bigint
(20) NOT NULL,
  `email` varchar
(128) NOT NULL,
  `username` varchar
(50) NOT NULL,
  `password` varchar
(255) NOT NULL,
  `level` enum
('admin','subag','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_session`
--

INSERT INTO `login_session` (`
id`,
`email
`, `username`, `password`, `level`) VALUES
(1, 'mehmedalexanderr@gmail.com', 'admin', '534b44a19bf18d20b71ecc4eb77c572f', 'admin'),
(2, '', 'subag', '534b44a19bf18d20b71ecc4eb77c572f', 'subag'),
(3, '', 'user', '534b44a19bf18d20b71ecc4eb77c572f', 'user'),
(4, '', 'alexander', 'e9177dddf05f121d22fa31e1255179e6', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `status_submisi`
--

CREATE TABLE `status_submisi`
(
  `id_status_submisi` int
(11) NOT NULL,
  `nama_status_submisi` varchar
(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_submisi`
--

INSERT INTO `status_submisi` (`
id_status_submisi`,
`nama_status_submisi
`) VALUES
(1, 'Pending'),
(2, 'Permintaan ditolak'),
(3, 'Permintaan diterima');

-- --------------------------------------------------------

--
-- Table structure for table `status_terima`
--

CREATE TABLE `status_terima`
(
  `id_status_terima` int
(11) NOT NULL,
  `nama_status_terima` varchar
(30) NOT NULL,
  `id_status_submisi` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_terima`
--

INSERT INTO `status_terima` (`
id_status_terima`,
`nama_status_terima
`, `id_status_submisi`) VALUES
(4, 'Belum diterima pengaju', 3),
(6, 'Belum ACC', 1),
(7, 'Pengajuan ditolak', 2),
(8, 'Diterima pengaju', 3);

-- --------------------------------------------------------

--
-- Table structure for table `submisi_barang`
--

CREATE TABLE `submisi_barang`
(
  `id` int
(11) NOT NULL,
  `id_jenis_barang` int
(11) NOT NULL,
  `nama_barang` varchar
(50) NOT NULL,
  `jumlah_barang` bigint
(20) NOT NULL,
  `satuan` varchar
(30) NOT NULL,
  `id_status_submisi` int
(11) NOT NULL,
  `username` varchar
(50) NOT NULL,
  `id_status_terima` int
(11) NOT NULL,
  `date_barang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
  `alasan
` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submisi_barang`
--

INSERT INTO `submisi_barang` (`
id`,
`id_jenis_barang
`, `nama_barang`, `jumlah_barang`, `satuan`, `id_status_submisi`, `username`, `id_status_terima`, `date_barang`, `alasan`) VALUES
(1, 176, 'Palu', 1, 'Unit', 3, 'rogertaylor', 8, '2019-12-16 03:51:53', 'ok boss'),
(4, 180, 'iMac', 30, 'Unit', 3, 'admin', 8, '2019-12-16 20:16:00', 'siap'),
(5, 182, 'Sheer Heart Attack by Queen', 1, 'Unit', 3, 'rogertaylor', 8, '2021-09-03 11:45:49', 'ok diterima boss'),
(6, 181, 'iPhone 12 Pro Max', 1, 'buah', 3, 'rogertaylor', 8, '2021-09-03 11:48:17', 'siap'),
(7, 179, 'Motor', 2, 'buah', 2, 'rogertaylor', 7, '2021-09-03 11:49:21', 'mahal boss'),
(8, 182, 'abddc', 2, 'buah', 3, 'rogertaylor', 4, '2021-10-18 03:18:05', 'Ok'),
(11, 176, 'Kursi', 1, 'Lusin', 3, 'admin', 8, '2021-12-09 16:29:58', 'Siap, bos'),
(12, 180, 'TV', 1, 'unit', 3, 'user', 0, '2021-12-30 03:11:36', ''),
(13, 176, 'Obeng', 2, 'lusin', 3, 'user', 8, '2021-12-30 05:45:50', 'Ok'),
(14, 181, 'iPhone 8', 1, 'buah', 2, 'user', 7, '2021-12-30 06:23:42', 'sorry, to expensive!'),
(15, 176, 'Kertas', 80, 'lembar', 3, 'user', 8, '2021-12-30 06:25:37', 'Siap');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu`
(
  `id` int
(11) NOT NULL,
  `level` enum
('admin','subag','user') NOT NULL,
  `menu_id` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`
id`,
`level
`, `menu_id`) VALUES
(1, 'admin', 1),
(2, 'subag', 2),
(3, 'user', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu`
(
  `id` int
(11) NOT NULL,
  `menu` varchar
(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`
id`,
`menu
`) VALUES
(1, 'admin'),
(2, 'subag'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu`
(
  `id` int
(11) NOT NULL,
  `menu_id` int
(11) NOT NULL,
  `title` varchar
(128) NOT NULL,
  `url` varchar
(128) NOT NULL,
  `icon` varchar
(128) NOT NULL,
  `is_active` int
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`
id`,
`menu_id
`, `title`, `url`, `icon`, `is_active`) VALUES
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
ADD PRIMARY KEY
(`id_jenis_barang`);

--
-- Indexes for table `login_session`
--
ALTER TABLE `login_session`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `status_submisi`
--
ALTER TABLE `status_submisi`
ADD PRIMARY KEY
(`id_status_submisi`);

--
-- Indexes for table `status_terima`
--
ALTER TABLE `status_terima`
ADD PRIMARY KEY
(`id_status_terima`);

--
-- Indexes for table `submisi_barang`
--
ALTER TABLE `submisi_barang`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
ADD PRIMARY KEY
(`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenis_barang` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `login_session`
--
ALTER TABLE `login_session`
  MODIFY `id` bigint
(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_submisi`
--
ALTER TABLE `status_submisi`
  MODIFY `id_status_submisi` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_terima`
--
ALTER TABLE `status_terima`
  MODIFY `id_status_terima` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submisi_barang`
--
ALTER TABLE `submisi_barang`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;