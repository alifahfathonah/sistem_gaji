-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2020 at 11:47 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-24+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ybssb`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alfa') NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bonus_kinerja`
--

CREATE TABLE `bonus_kinerja` (
  `id` int(11) NOT NULL,
  `id_karyawan` text NOT NULL,
  `nilai_kpi` text NOT NULL,
  `jumlah_bonus` text NOT NULL,
  `total_gaji` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bonus_lebaran`
--

CREATE TABLE `bonus_lebaran` (
  `id` int(11) NOT NULL,
  `id_karyawan` text NOT NULL,
  `total_gaji_bonus` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gaji_bulanan`
--

CREATE TABLE `gaji_bulanan` (
  `id` int(11) NOT NULL,
  `id_karyawan` text NOT NULL,
  `uang_transport` text NOT NULL,
  `tunjangan_kinerja` text NOT NULL,
  `tunjangan_jabatan` text NOT NULL,
  `uang_extra_kurikuler` text NOT NULL,
  `uang_lembur` text NOT NULL,
  `bonus_lain` text NOT NULL,
  `total_gaji` text NOT NULL,
  `total_potongan` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gaji_tambahan`
--

CREATE TABLE `gaji_tambahan` (
  `id` int(11) NOT NULL,
  `jenis_kegiatan` text NOT NULL,
  `jumlah_gaji` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji_tambahan`
--

INSERT INTO `gaji_tambahan` (`id`, `jenis_kegiatan`, `jumlah_gaji`) VALUES
(1, 'Lembur', '555'),
(2, 'Eskul', '6666');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `jumlah_gaji_pokok` text NOT NULL,
  `t_jalan_jalan` text NOT NULL,
  `t_kesehatan` text NOT NULL,
  `t_pelatihan` text NOT NULL,
  `t_cuti_tahunan` text NOT NULL,
  `t_study_banding` text NOT NULL,
  `t_umroh` text NOT NULL,
  `total_gaji` text NOT NULL,
  `id_tingkat_jabatan` text NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru_terbaik`
--

CREATE TABLE `guru_terbaik` (
  `id` int(11) NOT NULL,
  `id_karyawan` text NOT NULL,
  `upload_portofolio` text NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah_bonus` text NOT NULL,
  `total_gaji` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` text NOT NULL,
  `id_tingkat_jabatan` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `id_tingkat_jabatan`, `create_date`) VALUES
(6, 'Kepala Sekolah', '8', '2020-12-11'),
(7, 'Guru SD', '6', '2020-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `role` enum('1','2','3','4','5','6') NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_jabatan` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `pendidikan_terakhir` varchar(100) NOT NULL,
  `tahun_masuk` varchar(100) NOT NULL,
  `status` enum('Aktif','Keluar','Pindah') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_golongan` text NOT NULL,
  `gaji_pokok` text NOT NULL,
  `total_gaji` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kenaikan_gaji`
--

CREATE TABLE `kenaikan_gaji` (
  `id` int(11) NOT NULL,
  `id_karyawan` text NOT NULL,
  `persentase` text NOT NULL,
  `jumlah_kenaikan` text NOT NULL,
  `total_gaji` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tingkat_jabatan`
--

CREATE TABLE `tingkat_jabatan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tingkat_jabatan`
--

INSERT INTO `tingkat_jabatan` (`id`, `nama`, `create_date`) VALUES
(3, 'Keuangan', '2020-11-22'),
(4, 'Administrasi', '2020-11-22'),
(5, 'Keamanan dan Kebersihan', '2020-11-22'),
(6, 'Guru', '2020-11-22'),
(8, 'Manajemen', '2020-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_gaji_tambahan`
--

CREATE TABLE `transaksi_gaji_tambahan` (
  `id` int(11) NOT NULL,
  `id_gaji_tambahan` text NOT NULL,
  `id_gaji_bulanan` text NOT NULL,
  `jumlah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','manajer','unit','ka_gudang','office') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `block_status` int(3) NOT NULL,
  `online_status` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `time_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_offline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_unit` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `username`, `password`, `email`, `phone_number`, `address`, `gender`, `locale`, `picture`, `link`, `role`, `created`, `modified`, `block_status`, `online_status`, `time_online`, `time_offline`, `id_unit`) VALUES
(42, '', '', 'First', 'Administrator', 'admin_penggajian', '0192023a7bbd73250516f069df18b500', '', '081562442811', 'Jalan Dr. Setia Budhi No. 57, Rintis, Lima Puluh, Kota Pekanbaru, Riau (28141)', NULL, NULL, NULL, '', 'administrator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'online', '2020-12-11 04:47:39', '2020-12-11 04:47:39', ''),
(49, '', '', 'Admin', 'Office', 'office123', '34abc02a6df39facbf57b09fc68bb256', '', '081199223344', 'Jalan Dr. Setia Budhi No. 57, Rintis, Lima Puluh, Kota Pekanbaru, Riau (28141)', NULL, NULL, NULL, '', 'office', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'online', '2020-08-02 03:51:33', '2020-08-02 03:51:33', 'U-001');

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `id_users` int(255) NOT NULL,
  `role` enum('1','2','3','4','5','6') NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `poto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`id_users`, `role`, `name`, `email`, `password`, `jabatan`, `poto`) VALUES
(16, '1', 'Supervisor', 'supervisor@gmail.com', 'supervisor', 'Supervisor', 'LogoAsr.png'),
(22, '2', 'Asmarini', 'asmarini@gmail.com', '12345678', 'Karyawan Tata Usaha', 'IMG-20191008-WA0009.jpg'),
(23, '3', 'Junita,SE', 'junita@gmail.com', 'junita', 'Bendahara', 'download.png'),
(24, '4', 'Nadyatul Rahmah, S.Si', 'nadiatul@gmail.com', 'kepsek', 'Kepala Sekolah SDIT Insan Teladan', 'Hijab.jpg'),
(25, '5', 'Dirpend', 'dirpend@gmail.com', 'dirpend', 'Direktur Pendidikan', 'admin.jpg'),
(26, '6', 'Yayasan', 'yayasan@gmail.com', 'yayasan', 'Yayasan', 'e.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `bonus_kinerja`
--
ALTER TABLE `bonus_kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus_lebaran`
--
ALTER TABLE `bonus_lebaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji_bulanan`
--
ALTER TABLE `gaji_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji_tambahan`
--
ALTER TABLE `gaji_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru_terbaik`
--
ALTER TABLE `guru_terbaik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kenaikan_gaji`
--
ALTER TABLE `kenaikan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingkat_jabatan`
--
ALTER TABLE `tingkat_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_gaji_tambahan`
--
ALTER TABLE `transaksi_gaji_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonus_kinerja`
--
ALTER TABLE `bonus_kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bonus_lebaran`
--
ALTER TABLE `bonus_lebaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gaji_bulanan`
--
ALTER TABLE `gaji_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gaji_tambahan`
--
ALTER TABLE `gaji_tambahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `guru_terbaik`
--
ALTER TABLE `guru_terbaik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kenaikan_gaji`
--
ALTER TABLE `kenaikan_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tingkat_jabatan`
--
ALTER TABLE `tingkat_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi_gaji_tambahan`
--
ALTER TABLE `transaksi_gaji_tambahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id_users` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
