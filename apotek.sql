-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2021 at 02:51 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `berobat`
--

CREATE TABLE `berobat` (
  `no_transaksi` varchar(10) NOT NULL,
  `pasien_id` varchar(10) NOT NULL,
  `tanggal_berobat` date NOT NULL,
  `dokter_id` varchar(10) NOT NULL,
  `keluhan` varchar(150) NOT NULL,
  `biaya_adm` varchar(50) NOT NULL,
  `updated_at` varchar(225) NOT NULL,
  `created_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berobat`
--

INSERT INTO `berobat` (`no_transaksi`, `pasien_id`, `tanggal_berobat`, `dokter_id`, `keluhan`, `biaya_adm`, `updated_at`, `created_at`) VALUES
('TR001', '003', '2021-07-13', '001', 'mshds', '12131', '2021-08-19 01:21:39', '2021-08-19 01:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `dokter_id` varchar(10) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `poli_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`dokter_id`, `nama_dokter`, `poli_id`) VALUES
('001', 'Enggit Prasetyo', '002'),
('002', 'wawan', '003'),
('003', 'ASEP', '004');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `pasien_id` varchar(10) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `usia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`pasien_id`, `nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `usia`) VALUES
('001', 'Huda', '2021-08-20', 'WANITA', 'jl.suka', 12),
('002', 'Samsung', '2021-08-13', 'pria', 'jl.dia', 21),
('003', 'Asep Ridwan', '2010-10-19', 'Pria', 'jl. Subang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `poli_id` varchar(10) NOT NULL,
  `nama_poli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`poli_id`, `nama_poli`) VALUES
('001', 'Kaki'),
('002', 'gigi'),
('003', 'Badan'),
('004', 'Mata');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vt`
-- (See below for the actual view)
--
CREATE TABLE `vt` (
`no_transaksi` varchar(10)
,`pasien_id` varchar(10)
,`nama_pasien` varchar(50)
,`usia` int(5)
,`jenis_kelamin` varchar(20)
,`keluhan` varchar(150)
,`nama_poli` varchar(100)
,`nama_dokter` varchar(50)
,`biaya_adm` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vtrans`
-- (See below for the actual view)
--
CREATE TABLE `vtrans` (
`no_transaksi` varchar(10)
,`pasien_id` varchar(10)
,`nama_pasien` varchar(50)
,`usia` int(5)
,`jenis_kelamin` varchar(20)
,`keluhan` varchar(150)
,`tanggal_berobat` date
,`nama_poli` varchar(100)
,`nama_dokter` varchar(50)
,`biaya_adm` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `vt`
--
DROP TABLE IF EXISTS `vt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vt`  AS SELECT `berobat`.`no_transaksi` AS `no_transaksi`, `pasien`.`pasien_id` AS `pasien_id`, `pasien`.`nama_pasien` AS `nama_pasien`, year(curdate()) - year(`pasien`.`tanggal_lahir`) AS `usia`, `pasien`.`jenis_kelamin` AS `jenis_kelamin`, `berobat`.`keluhan` AS `keluhan`, `poli`.`nama_poli` AS `nama_poli`, `dokter`.`nama_dokter` AS `nama_dokter`, `berobat`.`biaya_adm` AS `biaya_adm` FROM (((`pasien` join `dokter`) join `berobat`) join `poli`) WHERE `pasien`.`pasien_id` = `berobat`.`pasien_id` AND `berobat`.`dokter_id` = `dokter`.`dokter_id` AND `dokter`.`poli_id` = `poli`.`poli_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vtrans`
--
DROP TABLE IF EXISTS `vtrans`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtrans`  AS SELECT `berobat`.`no_transaksi` AS `no_transaksi`, `pasien`.`pasien_id` AS `pasien_id`, `pasien`.`nama_pasien` AS `nama_pasien`, year(curdate()) - year(`pasien`.`tanggal_lahir`) AS `usia`, `pasien`.`jenis_kelamin` AS `jenis_kelamin`, `berobat`.`keluhan` AS `keluhan`, `berobat`.`tanggal_berobat` AS `tanggal_berobat`, `poli`.`nama_poli` AS `nama_poli`, `dokter`.`nama_dokter` AS `nama_dokter`, `berobat`.`biaya_adm` AS `biaya_adm` FROM (((`pasien` join `dokter`) join `berobat`) join `poli`) WHERE `pasien`.`pasien_id` = `berobat`.`pasien_id` AND `berobat`.`dokter_id` = `dokter`.`dokter_id` AND `dokter`.`poli_id` = `poli`.`poli_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berobat`
--
ALTER TABLE `berobat`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `dokter_id` (`dokter_id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`dokter_id`),
  ADD KEY `poli_id` (`poli_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasien_id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`poli_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berobat`
--
ALTER TABLE `berobat`
  ADD CONSTRAINT `berobat_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`),
  ADD CONSTRAINT `berobat_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`pasien_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
