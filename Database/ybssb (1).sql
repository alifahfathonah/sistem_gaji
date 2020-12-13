-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2020 at 11:00 PM
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
(2, '9', '10', '2323000', '25553000', '2020-12-13');

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
(1, '9', '46000000', '2020-12-13');

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
(1, '10', '200000', '0', '0', '0', '0', '0', '23200000', '0', '2020-12-13');

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
(12, 2, '23000000', '0', '0', '0', '0', '0', '0', '23000000', '6', 8, '2020-12-12');

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
(3, '9', 'taman_okura1.png', 'none', '500000', '23730000', '2020-12-13'),
(4, '10', 'setelah_login.png', 'none', '70', '23000070', '2020-12-13'),
(5, '9', 'Selection_005.png', 'none', '220', '23230220', '2020-12-13');

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
(8, 'Guru Kelas', '6', '2020-12-12');

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
(8, '2', 'sad', '2020-12-19', 'LK', 'adasd', 'adasd', 'asdasd', '8', 'adasd', 'asdasd', 'asdasd', 'asdasd', '', 'asdasd', '12', '23000000', '23000000', '2020-12-12'),
(9, '2', 'Riska Pradana', '2020-12-13', 'PR', 'riska@gmail.com', '082399224444', 'Medan', '8', 'Pekanbaru', 'PCR', 'S2', '2008', 'Aktif', 'Not yet', '12', '23230000', '23230000', '2020-12-13'),
(10, '2', 'agus boker', '2020-12-13', 'PR', 'agus@gmail.com', '0823990091122', 'Medan', '8', 'Pekanbaru', 'PCR', 'S2', '2009', 'Aktif', 'none', '12', '23000000', '23000000', '2020-12-13');

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

--
-- Dumping data for table `kenaikan_gaji`
--

INSERT INTO `kenaikan_gaji` (`id`, `id_karyawan`, `persentase`, `jumlah_kenaikan`, `total_gaji`) VALUES
(1, '9', '1', '230000', '23230000');

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
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','yayasan','pegawai') COLLATE utf8_unicode_ci DEFAULT NULL,
  `block_status` int(3) NOT NULL,
  `online_status` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `time_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_offline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `role`, `block_status`, `online_status`, `time_online`, `time_offline`) VALUES
(42, 'sad', 'Arrafiq', 'admin_penggajian', '0192023a7bbd73250516f069df18b500', '', 'administrator', 0, 'offline', '2020-12-13 15:57:06', '2020-12-13 15:57:06'),
(50, 'agus boker', '', 'agus123', '01c3c766ce47082b1b130daedd347ffd', '', 'pegawai', 0, 'offline', '2020-12-13 15:54:42', '2020-12-13 15:54:42'),
(51, 'Riska Pradana', '', 'riska123', 'a61fec1781fc3e2be92403ee1c65342a', '', 'yayasan', 0, 'offline', '2020-12-13 14:41:58', '2020-12-13 14:41:58');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bonus_lebaran`
--
ALTER TABLE `bonus_lebaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gaji_bulanan`
--
ALTER TABLE `gaji_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kenaikan_gaji`
--
ALTER TABLE `kenaikan_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id_users` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
