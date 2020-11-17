-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 09:22 PM
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
  `nama_golongan` text NOT NULL,
  `jumlah_gaji_pokok` text NOT NULL,
  `t_jalan_jalan` text NOT NULL,
  `t_kesehatan` text NOT NULL,
  `t_pelatihan` text NOT NULL,
  `t_cuti_tahunan` text NOT NULL,
  `t_study_banding` text NOT NULL,
  `t_umroh` text NOT NULL,
  `total_gaji` text NOT NULL,
  `id_jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id`, `level`, `nama_golongan`, `jumlah_gaji_pokok`, `t_jalan_jalan`, `t_kesehatan`, `t_pelatihan`, `t_cuti_tahunan`, `t_study_banding`, `t_umroh`, `total_gaji`, `id_jabatan`) VALUES
(1, 2, 'Kepala Sekolah', '5000000', '', '', '', '', '', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` text NOT NULL,
  `tingkat_jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `tingkat_jabatan`) VALUES
(1, 'Ketua Yayasan', 'manajemen tkt 1');

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
  `password` varchar(255) NOT NULL,
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
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `role`, `nama_karyawan`, `tgl_lahir`, `jk`, `email`, `password`, `no_hp`, `alamat`, `id_jabatan`, `jurusan`, `universitas`, `pendidikan_terakhir`, `tahun_masuk`, `status`, `gambar`, `id_golongan`, `create_date`) VALUES
(4, '2', 'asdasd', '2020-11-18', 'dsfdsf', 'sdfsdsdf', 'sdfdsf', '234324', 'sdfsdf', '1', 'sdfsdf', 'sdfsdf', '3233', '33232', '', 'sfdfsdf', '1', '2020-11-17');

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
  `id_users` int(255) NOT NULL,
  `role` enum('1','2','3','4','5','6') NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `poto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `role`, `name`, `email`, `password`, `jabatan`, `poto`) VALUES
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
-- Indexes for table `transaksi_gaji_tambahan`
--
ALTER TABLE `transaksi_gaji_tambahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT for table `gaji_bulanan`
--
ALTER TABLE `gaji_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji_tambahan`
--
ALTER TABLE `gaji_tambahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_gaji_tambahan`
--
ALTER TABLE `transaksi_gaji_tambahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
