-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2020 at 08:24 PM
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

--
-- Dumping data for table `bonus_kinerja`
--

INSERT INTO `bonus_kinerja` (`id`, `id_karyawan`, `nilai_kpi`, `jumlah_bonus`, `total_gaji`, `create_date`) VALUES
(1, '6', '13', '650000', '6820000', '2020-11-28'),
(2, '8', '80', '960000', '2160023', '2020-11-29'),
(3, '8', '30', '360000', '1560023', '2020-12-06');

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

--
-- Dumping data for table `bonus_lebaran`
--

INSERT INTO `bonus_lebaran` (`id`, `id_karyawan`, `total_gaji_bonus`, `create_date`) VALUES
(1, '6', '11170000', '2020-11-29'),
(2, '8', '2400023', '2020-11-29'),
(3, '6', '11170000', '2020-12-06');

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

--
-- Dumping data for table `gaji_bulanan`
--

INSERT INTO `gaji_bulanan` (`id`, `id_karyawan`, `uang_transport`, `tunjangan_kinerja`, `tunjangan_jabatan`, `uang_extra_kurikuler`, `uang_lembur`, `bonus_lain`, `total_gaji`, `total_potongan`, `create_date`) VALUES
(2, '8', '0', '0', '0', '0', '0', '0', '1200023', '0', '2020-12-09');

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

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id`, `level`, `jumlah_gaji_pokok`, `t_jalan_jalan`, `t_kesehatan`, `t_pelatihan`, `t_cuti_tahunan`, `t_study_banding`, `t_umroh`, `total_gaji`, `id_tingkat_jabatan`, `id_jabatan`, `create_date`) VALUES
(4, 2, '5000000', '10000', '20000', '30000', '10000', '100000', '1000000', '6170000', '6', 4, '2020-11-27'),
(5, 3, '1200000', '23', '0', '0', '0', '0', '0', '1200023', '5', 4, '2020-11-29');

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

--
-- Dumping data for table `guru_terbaik`
--

INSERT INTO `guru_terbaik` (`id`, `id_karyawan`, `upload_portofolio`, `keterangan`, `jumlah_bonus`, `total_gaji`, `create_date`) VALUES
(9, '8', 'Selection_001.png', 'sdasdsad', '60', '1200083', '2020-11-30');

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
(4, 'Guru SD', '6', '2020-11-27');

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

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `role`, `nama_karyawan`, `tgl_lahir`, `jk`, `email`, `no_hp`, `alamat`, `id_jabatan`, `jurusan`, `universitas`, `pendidikan_terakhir`, `tahun_masuk`, `status`, `gambar`, `id_golongan`, `gaji_pokok`, `total_gaji`, `create_date`) VALUES
(6, '1', 'Fitra Arrafiq', '2020-11-27', 'Laki-laki', 'fitraarrafiq@gmail.com', '082390091029', 'medan, pekanbaru riau', '4', 'Sistem Informasi', 'Politeknik Caltex Riau', 'D4', '2016', 'Aktif', 'gada', '4', '', '', '2020-11-27'),
(8, '3', 'Agus Salimss', '2020-11-30', 'PR', 'asdasd@sdgsdg', '123434', 'asdad', '4', 'asdasd', 'asdasd', 'asdasd', '1231231', 'Aktif', 'gada', '5', '', '', '2020-11-29');

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
(1, 'Manajemen', '2020-11-22'),
(3, 'Keuangan', '2020-11-22'),
(4, 'Administrasi', '2020-11-22'),
(5, 'Keamanan dan Kebersihan', '2020-11-22'),
(6, 'Guru', '2020-11-22');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bonus_lebaran`
--
ALTER TABLE `bonus_lebaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gaji_bulanan`
--
ALTER TABLE `gaji_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gaji_tambahan`
--
ALTER TABLE `gaji_tambahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guru_terbaik`
--
ALTER TABLE `guru_terbaik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kenaikan_gaji`
--
ALTER TABLE `kenaikan_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tingkat_jabatan`
--
ALTER TABLE `tingkat_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
