-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2017 at 05:02 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kependudukanDesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `hakAkses` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `alamat`, `telp`, `hakAkses`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'alamat', '08712797134', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ID` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keranjang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ID`, `item`, `jumlah`, `keranjang`) VALUES
(0, 8, 2, 1),
(0, 2, 3, 1),
(0, 4, 1, 2),
(0, 6, 2, 2),
(0, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `ID` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('lagiBelanja','sudahDibayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`ID`, `member`, `total`, `tanggal`, `status`) VALUES
(1, 1, 0, '2017-05-27 03:02:38', 'lagiBelanja'),
(2, 0, 0, '2017-05-29 04:27:19', 'lagiBelanja');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `KontenID` int(11) NOT NULL,
  `KontenNama` varchar(255) NOT NULL,
  `KontenDiskripsi` text NOT NULL,
  `KontenGambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`KontenID`, `KontenNama`, `KontenDiskripsi`, `KontenGambar`) VALUES
(1, 'Tentang', 'Kami adalah dagang rujak terbaik di gang kami. karena kami satu2nya dagang rujak disitu.', 'Konten_Tentang.jpg'),
(2, 'Kontak', 'Hubungi kami, jika ada pegawai kami yang nganggur dan motornya isi bensin dan rumah kamu deket, mungkin kami mau nganter.', 'Konten_Kontak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `MemberNama` varchar(255) NOT NULL,
  `MemberAlamat` varchar(255) NOT NULL,
  `MemberNoTelp` varchar(20) NOT NULL,
  `MemberPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `MemberNama`, `MemberAlamat`, `MemberNoTelp`, `MemberPassword`) VALUES
(1, 'nyoman', 'denpasar barat', '08993124246', '24d545382bf132265c7bcb71acddbae0');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MenuID` tinyint(4) NOT NULL,
  `MenuNama` varchar(255) NOT NULL,
  `MenuHarga` mediumint(9) NOT NULL,
  `MenuDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MenuUser` tinyint(4) NOT NULL,
  `MenuGambar` varchar(255) NOT NULL,
  `MenuDiskripsi` text,
  `MenuKategori` enum('makanan','minuman','','') NOT NULL,
  `MenuUnggulan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`MenuID`, `MenuNama`, `MenuHarga`, `MenuDate`, `MenuUser`, `MenuGambar`, `MenuDiskripsi`, `MenuKategori`, `MenuUnggulan`) VALUES
(1, 'Rujak Buleleng', 10000, '2017-05-27 02:21:28', 0, 'Rujak_Buleleng.jpg', 'Rujak gula pedas banget dari buleleng', 'makanan', 1),
(2, 'Tipat Cantok', 12000, '2017-05-27 02:19:50', 0, 'Tipat_Cantok.jpg', 'Tipat pakai bumbu kacang', 'makanan', 0),
(3, 'Tipat Plecing', 12000, '2017-05-27 02:01:04', 0, 'Tipat_Plecing.jpg', 'Tipat pakai bumbu plecing', 'makanan', 0),
(4, 'Es Bir', 7000, '2017-05-27 02:26:16', 0, 'Es_Bir.jpg', 'Es kelapa isi jeruk nipis jadi keliatan kaya bir', 'minuman', 0),
(5, 'Es Cendol', 7000, '2017-05-27 02:25:10', 0, 'Es_Cendol.jpg', 'Cendol isi es batu', 'minuman', 0),
(6, 'Es Dawet', 7000, '2017-05-27 02:23:53', 0, 'Es_Dawet.jpg', 'Dawet isi es', 'minuman', 1),
(7, 'Es Kopi', 5000, '2017-05-27 02:22:46', 0, 'Es_Kopi.jpg', 'kopi bali isi es', 'minuman', 1),
(8, 'Tipat Kuah', 11000, '2017-05-27 02:16:31', 0, 'Tipat_Kuah.jpg', 'tipat misi kuah', 'makanan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`KontenID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `KontenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `MenuID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
