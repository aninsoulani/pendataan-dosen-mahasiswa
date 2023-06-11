-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 08:29 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendataan_informatika`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(10) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_dosen` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` int(5) NOT NULL,
  `keterangan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nip`, `nama_dosen`, `password`, `status`, `keterangan`) VALUES
(1, '197412102008011007', 'Teguh Cahyono, S.T., M.Kom.', 'pakteguh', 1, 1),
(27, '196711101993031025', 'Drs. Eddy Maryanto, M.Cs', 'pakeddy', 2, 1),
(28, '19930630 201903 2028', 'Aini Hanifa, S.T.,M.T', 'buaini', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dosen_mahasiswa`
--

CREATE TABLE `dosen_mahasiswa` (
  `id` int(10) NOT NULL,
  `nip_nim` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen_mahasiswa`
--

INSERT INTO `dosen_mahasiswa` (`id`, `nip_nim`, `nama`, `password`, `status`) VALUES
(1, '197412102008011007', 'Teguh Cahyono, S.T., M.Kom.', 'pakteguh', 1),
(29, 'H1D020200', 'John Kennedy', 'mahasiswa200', 3),
(30, 'H1D020201', 'Jemre Khan', 'mahasiswa201', 3),
(31, 'H1D020203', 'Melati', 'mahasiswa203', 3),
(32, '196711101993031025', 'Drs. Eddy Maryanto, M.Cs', 'pakeddy', 2),
(33, 'H1D021201', 'Gerard', 'mahasiswa201', 3),
(34, '19930630 201903 2028', 'Aini Hanifa, S.T.,M.T', 'buaini', 2),
(35, 'H1D020202', 'Galih', 'mahasiswa202', 3),
(36, 'H1D020202', 'Galih', 'mahasiswa202', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(30) NOT NULL,
  `angkatan` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `keterangan` int(5) NOT NULL,
  `nip_dospem` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `password`, `nama_mahasiswa`, `angkatan`, `status`, `keterangan`, `nip_dospem`) VALUES
(18, 'H1D020200', 'mahasiswa200', 'John Kennedy', 2020, 3, 1, '197412102008011007'),
(19, 'H1D020201', 'mahasiswa201', 'Jemre Khan', 2020, 3, 1, '196711101993031025'),
(20, 'H1D020203', 'mahasiswa203', 'Melati', 2020, 3, 1, '197412102008011007'),
(21, 'H1D021201', 'mahasiswa201', 'Gerard', 2021, 3, 2, '196711101993031025'),
(23, 'H1D020202', 'mahasiswa202', 'Galih', 2020, 3, 1, '196711101993031025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_mahasiswa`
--
ALTER TABLE `dosen_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `dosen_mahasiswa`
--
ALTER TABLE `dosen_mahasiswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
