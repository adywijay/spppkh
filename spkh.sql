-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2022 at 08:30 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses`
--

CREATE TABLE `tbl_akses` (
  `id_akses` int(3) NOT NULL,
  `nama_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_akses`
--

INSERT INTO `tbl_akses` (`id_akses`, `nama_akses`) VALUES
(1, 'Surveyer'),
(2, 'Operator'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_akun` int(3) NOT NULL,
  `id_akses` int(3) NOT NULL,
  `username` varchar(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `id_akses`, `username`, `token`, `password`, `nama`, `jabatan`, `no_telp`, `foto`, `status`, `tgl_buat`) VALUES
(3, 3, 'Webmin', '1552339PM', 'd41d8cd98f00b204e9800998ecf8427e', 'Root', '``', '2147483647', 'gagal_upload1.jpg', '1', '2020-02-17 21:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_latih`
--

CREATE TABLE `tbl_data_latih` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jml_art` varchar(5) NOT NULL,
  `jml_keluarga` varchar(5) NOT NULL,
  `sta_bangunan` varchar(8) NOT NULL,
  `sta_lahan` varchar(8) NOT NULL,
  `jns_lantai` varchar(8) NOT NULL,
  `jns_dinding` varchar(8) NOT NULL,
  `knds_dinding` varchar(5) NOT NULL,
  `jns_atap` varchar(8) NOT NULL,
  `knds_atap` varchar(5) NOT NULL,
  `smb_air_minum` varchar(8) NOT NULL,
  `cmdp_air_minum` varchar(8) NOT NULL,
  `smb_penerangan` varchar(8) NOT NULL,
  `dy_listrik` varchar(5) NOT NULL,
  `bb_masak` varchar(8) NOT NULL,
  `fasbab` varchar(8) NOT NULL,
  `jns_kloset` varchar(8) NOT NULL,
  `tp_akhir` varchar(8) NOT NULL,
  `sta_art_usaha` varchar(5) NOT NULL,
  `sta_kks` varchar(5) NOT NULL,
  `sta_kip` varchar(5) NOT NULL,
  `sta_kis` varchar(5) NOT NULL,
  `sta_bpjsm` varchar(5) NOT NULL,
  `sta_jamsotek` varchar(5) NOT NULL,
  `sta_asuransi_lain` varchar(5) NOT NULL,
  `sta_rasta` varchar(5) NOT NULL,
  `sta_kur` varchar(5) NOT NULL,
  `sta_keberadaan_art` varchar(5) NOT NULL,
  `keputusan_asli` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_uji`
--

CREATE TABLE `tbl_data_uji` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `jml_art` varchar(5) DEFAULT NULL,
  `jml_keluarga` varchar(5) DEFAULT NULL,
  `sta_bangunan` varchar(8) DEFAULT NULL,
  `sta_lahan` varchar(8) DEFAULT NULL,
  `jns_lantai` varchar(8) DEFAULT NULL,
  `jns_dinding` varchar(8) DEFAULT NULL,
  `knds_dinding` varchar(5) DEFAULT NULL,
  `jns_atap` varchar(8) DEFAULT NULL,
  `knds_atap` varchar(5) DEFAULT NULL,
  `smb_air_minum` varchar(8) DEFAULT NULL,
  `cmdp_air_minum` varchar(8) DEFAULT NULL,
  `smb_penerangan` varchar(8) DEFAULT NULL,
  `dy_listrik` varchar(5) DEFAULT NULL,
  `bb_masak` varchar(8) DEFAULT NULL,
  `fasbab` varchar(8) DEFAULT NULL,
  `jns_kloset` varchar(8) DEFAULT NULL,
  `tp_akhir` varchar(8) DEFAULT NULL,
  `sta_art_usaha` varchar(5) DEFAULT NULL,
  `sta_kks` varchar(5) DEFAULT NULL,
  `sta_kip` varchar(5) DEFAULT NULL,
  `sta_kis` varchar(5) DEFAULT NULL,
  `sta_bpjsm` varchar(5) DEFAULT NULL,
  `sta_jamsotek` varchar(5) DEFAULT NULL,
  `sta_asuransi_lain` varchar(5) DEFAULT NULL,
  `sta_rasta` varchar(5) DEFAULT NULL,
  `sta_kur` varchar(5) DEFAULT NULL,
  `sta_keberadaan_art` varchar(5) DEFAULT NULL,
  `keputusan_asli` varchar(5) DEFAULT NULL,
  `keputusan_hasil` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gain`
--

CREATE TABLE `tbl_gain` (
  `id` int(11) NOT NULL,
  `node_id` int(11) DEFAULT NULL,
  `atribut` varchar(100) DEFAULT NULL,
  `gain` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil_prediksi`
--

CREATE TABLE `tbl_hasil_prediksi` (
  `id` int(11) NOT NULL,
  `id_master` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `desa` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `jml_art` varchar(5) NOT NULL,
  `jml_keluarga` varchar(5) NOT NULL,
  `sta_bangunan` varchar(8) NOT NULL,
  `sta_lahan` varchar(8) NOT NULL,
  `jns_lantai` varchar(8) NOT NULL,
  `jns_dinding` varchar(8) NOT NULL,
  `knds_dinding` varchar(5) NOT NULL,
  `jns_atap` varchar(8) NOT NULL,
  `knds_atap` varchar(5) NOT NULL,
  `smb_air_minum` varchar(8) NOT NULL,
  `cmdp_air_minum` varchar(8) NOT NULL,
  `smb_penerangan` varchar(8) NOT NULL,
  `dy_listrik` varchar(8) NOT NULL,
  `bb_masak` varchar(8) NOT NULL,
  `fasbab` varchar(8) NOT NULL,
  `jns_kloset` varchar(8) NOT NULL,
  `tp_akhir` varchar(8) NOT NULL,
  `sta_art_usaha` varchar(5) NOT NULL,
  `sta_kks` varchar(5) NOT NULL,
  `sta_kip` varchar(5) NOT NULL,
  `sta_kis` varchar(5) NOT NULL,
  `sta_bpjsm` varchar(5) NOT NULL,
  `sta_jamsotek` varchar(5) NOT NULL,
  `sta_asuransi_lain` varchar(5) NOT NULL,
  `sta_rasta` varchar(5) NOT NULL,
  `sta_kur` varchar(5) NOT NULL,
  `sta_keberadaan_art` varchar(5) NOT NULL,
  `id_rule` int(11) DEFAULT NULL,
  `keputusan_hasil` varchar(5) DEFAULT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keputusan`
--

CREATE TABLE `tbl_keputusan` (
  `id` int(11) NOT NULL,
  `parent` text DEFAULT NULL,
  `akar` text DEFAULT NULL,
  `keputusan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master`
--

CREATE TABLE `tbl_master` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL DEFAULT 'Slogohimo',
  `kabupaten` varchar(50) NOT NULL DEFAULT 'Wonogiri',
  `propinsi` varchar(50) NOT NULL DEFAULT 'Jawa Tengah',
  `desa` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `jml_art` varchar(5) NOT NULL,
  `art_temp` varchar(5) DEFAULT NULL,
  `jml_keluarga` varchar(5) NOT NULL,
  `keluarga_temp` varchar(5) DEFAULT NULL,
  `sta_lahan` varchar(8) NOT NULL,
  `sta_bangunan` varchar(8) NOT NULL,
  `ls_lantai` varchar(10) NOT NULL,
  `jns_lantai` varchar(8) NOT NULL,
  `jns_dinding` varchar(8) NOT NULL,
  `knds_dinding` varchar(5) NOT NULL,
  `jns_atap` varchar(8) NOT NULL,
  `knds_atap` varchar(5) NOT NULL,
  `jml_kamar` varchar(3) NOT NULL,
  `smb_air_minum` varchar(8) NOT NULL,
  `cmdp_air_minum` varchar(8) NOT NULL,
  `smb_penerangan` varchar(8) NOT NULL,
  `dy_listrik` varchar(5) NOT NULL,
  `bb_masak` varchar(8) NOT NULL,
  `fasbab` varchar(8) NOT NULL,
  `jns_kloset` varchar(8) NOT NULL,
  `tp_akhir` varchar(8) NOT NULL,
  `ada_kulkas` varchar(5) NOT NULL,
  `ada_ac` varchar(5) NOT NULL,
  `ada_pemanas` varchar(5) NOT NULL,
  `ada_telepon` varchar(5) NOT NULL,
  `ada_tgas` varchar(5) NOT NULL,
  `ada_tv` varchar(5) NOT NULL,
  `ada_emas` varchar(5) NOT NULL,
  `ada_komputer` varchar(5) NOT NULL,
  `ada_sepeda` varchar(5) NOT NULL,
  `ada_motor` varchar(5) NOT NULL,
  `ada_mobil` varchar(5) NOT NULL,
  `ada_ast_tbergerak` varchar(5) NOT NULL,
  `luas_ast_tbergerak` varchar(10) NOT NULL,
  `ada_rumah_lain` varchar(5) NOT NULL,
  `jml_sapi` varchar(3) NOT NULL,
  `jml_kambing` varchar(3) NOT NULL,
  `sta_art_usaha` varchar(5) NOT NULL,
  `sta_kks` varchar(5) NOT NULL,
  `sta_kip` varchar(5) NOT NULL,
  `sta_kis` varchar(5) NOT NULL,
  `sta_bpjsm` varchar(5) NOT NULL,
  `sta_jamsotek` varchar(5) NOT NULL,
  `sta_asuransi_lain` varchar(5) NOT NULL,
  `sta_rasta` varchar(5) NOT NULL,
  `sta_kur` varchar(5) NOT NULL,
  `sta_keberadaan_art` varchar(5) NOT NULL,
  `ls_lahan` varchar(10) NOT NULL,
  `percentile` varchar(10) NOT NULL,
  `id_akun` int(3) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tbl_master`
--
DELIMITER $$
CREATE TRIGGER `auto_delete` BEFORE DELETE ON `tbl_master` FOR EACH ROW DELETE FROM tbl_hasil_prediksi WHERE id_master = old.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `auto_insert` AFTER INSERT ON `tbl_master` FOR EACH ROW INSERT INTO tbl_hasil_prediksi
VALUES
(
null,new.id, new.nik, new.nama, new.desa, new.alamat, new.art_temp, new.keluarga_temp, new.sta_lahan, new.sta_bangunan, new.jns_lantai, new.jns_dinding, new.knds_dinding, new.jns_atap, new.knds_atap, new.smb_air_minum, new.cmdp_air_minum, new.smb_penerangan, new.dy_listrik, new.bb_masak, new.fasbab, new.jns_kloset, new.tp_akhir, new.sta_art_usaha, new.sta_kks, new.sta_kip,new.sta_kis, new.sta_bpjsm, new.sta_jamsotek, new.sta_asuransi_lain, new.sta_rasta, new.sta_kur, new.sta_keberadaan_art, null, null, now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rasio_gain`
--

CREATE TABLE `tbl_rasio_gain` (
  `id` int(11) NOT NULL,
  `opsi` varchar(10) DEFAULT NULL,
  `cabang1` varchar(50) DEFAULT NULL,
  `cabang2` varchar(50) DEFAULT NULL,
  `rasio_gain` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akses`
--
ALTER TABLE `tbl_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_akses` (`id_akses`);

--
-- Indexes for table `tbl_data_latih`
--
ALTER TABLE `tbl_data_latih`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_data_uji`
--
ALTER TABLE `tbl_data_uji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gain`
--
ALTER TABLE `tbl_gain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hasil_prediksi`
--
ALTER TABLE `tbl_hasil_prediksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_keputusan`
--
ALTER TABLE `tbl_keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_master`
--
ALTER TABLE `tbl_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tbl_rasio_gain`
--
ALTER TABLE `tbl_rasio_gain`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akses`
--
ALTER TABLE `tbl_akses`
  MODIFY `id_akses` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_data_latih`
--
ALTER TABLE `tbl_data_latih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_data_uji`
--
ALTER TABLE `tbl_data_uji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_gain`
--
ALTER TABLE `tbl_gain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hasil_prediksi`
--
ALTER TABLE `tbl_hasil_prediksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_keputusan`
--
ALTER TABLE `tbl_keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master`
--
ALTER TABLE `tbl_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rasio_gain`
--
ALTER TABLE `tbl_rasio_gain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
