-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2022 at 06:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HotelManagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `ChiTiet_HoaDon`
--

CREATE TABLE `ChiTiet_HoaDon` (
  `SoPhieuThue` int(11) NOT NULL,
  `SoHoaDon` int(11) NOT NULL,
  `SoNgayThueThuc` int(11) NOT NULL,
  `TienThuePhong` double NOT NULL,
  `MaPhuThu` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ChiTiet_PhieuThue`
--

CREATE TABLE `ChiTiet_PhieuThue` (
  `ID_KhachHang` varchar(12) NOT NULL,
  `SoPhieuThue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `HoaDon`
--

CREATE TABLE `HoaDon` (
  `SoHoaDon` int(11) NOT NULL,
  `NgayThanhToan` date NOT NULL,
  `TriGia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `KhachHang`
--

CREATE TABLE `KhachHang` (
  `ID_KhachHang` varchar(12) NOT NULL,
  `LoaiKhach` char(2) DEFAULT NULL,
  `HoTen` varchar(100) NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` varchar(100) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `CMND` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `LoaiKhach`
--

CREATE TABLE `LoaiKhach` (
  `MaLoaiKhach` char(2) NOT NULL,
  `TenLoaiKhach` varchar(30) NOT NULL,
  `HeSo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LoaiKhach`
--

INSERT INTO `LoaiKhach` (`MaLoaiKhach`, `TenLoaiKhach`, `HeSo`) VALUES
('12', '88', 0.98);

-- --------------------------------------------------------

--
-- Table structure for table `LoaiPhong`
--

CREATE TABLE `LoaiPhong` (
  `MaLoai` char(1) NOT NULL,
  `SoLuongPhong` int(11) NOT NULL,
  `DonGia` double NOT NULL,
  `SoLuongPhongTrong` int(11) NOT NULL,
  `LuongKhachToiDa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Phieu_ThuePhong`
--

CREATE TABLE `Phieu_ThuePhong` (
  `SoPhieuThue` int(12) NOT NULL,
  `ID_KhachHang` varchar(12) DEFAULT NULL,
  `NgayBatDauThue` date NOT NULL,
  `SoNgayThue` int(11) NOT NULL,
  `MaPhong` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Phong`
--

CREATE TABLE `Phong` (
  `MaPhong` varchar(5) NOT NULL,
  `MaLoai` char(1) DEFAULT NULL,
  `TinhTrang` int(11) NOT NULL,
  `GhiChu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `PhuThu`
--

CREATE TABLE `PhuThu` (
  `MaPhuThu` varchar(5) NOT NULL,
  `TenPhuThu` varchar(50) NOT NULL,
  `TiLe` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ChiTiet_HoaDon`
--
ALTER TABLE `ChiTiet_HoaDon`
  ADD PRIMARY KEY (`SoPhieuThue`,`SoHoaDon`),
  ADD KEY `FK_ChiTiet_HoaDon_HoaDon` (`SoHoaDon`),
  ADD KEY `FK_ChiTiet_HoaDon_PhuThu` (`MaPhuThu`);

--
-- Indexes for table `ChiTiet_PhieuThue`
--
ALTER TABLE `ChiTiet_PhieuThue`
  ADD PRIMARY KEY (`ID_KhachHang`,`SoPhieuThue`),
  ADD KEY `FK_ChiTiet_PhieuThue_Phieu_Thue_Phong` (`SoPhieuThue`);

--
-- Indexes for table `HoaDon`
--
ALTER TABLE `HoaDon`
  ADD PRIMARY KEY (`SoHoaDon`);

--
-- Indexes for table `KhachHang`
--
ALTER TABLE `KhachHang`
  ADD PRIMARY KEY (`ID_KhachHang`),
  ADD KEY `FK_KhachHang_LoaiKhach` (`LoaiKhach`);

--
-- Indexes for table `LoaiKhach`
--
ALTER TABLE `LoaiKhach`
  ADD PRIMARY KEY (`MaLoaiKhach`);

--
-- Indexes for table `LoaiPhong`
--
ALTER TABLE `LoaiPhong`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `Phieu_ThuePhong`
--
ALTER TABLE `Phieu_ThuePhong`
  ADD PRIMARY KEY (`SoPhieuThue`),
  ADD KEY `FK_PhieuThuePhong_KhachHang` (`ID_KhachHang`),
  ADD KEY `FK_PhieuThuePhong_Phong` (`MaPhong`);

--
-- Indexes for table `Phong`
--
ALTER TABLE `Phong`
  ADD PRIMARY KEY (`MaPhong`),
  ADD KEY `FK_Phong_LoaiPhong` (`MaLoai`);

--
-- Indexes for table `PhuThu`
--
ALTER TABLE `PhuThu`
  ADD PRIMARY KEY (`MaPhuThu`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ChiTiet_HoaDon`
--
ALTER TABLE `ChiTiet_HoaDon`
  ADD CONSTRAINT `FK_ChiTiet_HoaDon_HoaDon` FOREIGN KEY (`SoHoaDon`) REFERENCES `HoaDon` (`SoHoaDon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTiet_HoaDon_Phieu_ThuePhong` FOREIGN KEY (`SoPhieuThue`) REFERENCES `Phieu_ThuePhong` (`SoPhieuThue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTiet_HoaDon_PhuThu` FOREIGN KEY (`MaPhuThu`) REFERENCES `PhuThu` (`MaPhuThu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ChiTiet_PhieuThue`
--
ALTER TABLE `ChiTiet_PhieuThue`
  ADD CONSTRAINT `FK_ChiTietPhieuThue_KhachHang` FOREIGN KEY (`ID_KhachHang`) REFERENCES `KhachHang` (`ID_KhachHang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTietPhieuThue_PhieuThuePhong` FOREIGN KEY (`SoPhieuThue`) REFERENCES `Phieu_ThuePhong` (`SoPhieuThue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTiet_PhieuThue_Phieu_Thue_Phong` FOREIGN KEY (`SoPhieuThue`) REFERENCES `Phieu_ThuePhong` (`SoPhieuThue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `KhachHang`
--
ALTER TABLE `KhachHang`
  ADD CONSTRAINT `FK_KhachHang_LoaiKhach` FOREIGN KEY (`LoaiKhach`) REFERENCES `LoaiKhach` (`MaLoaiKhach`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `Phieu_ThuePhong`
--
ALTER TABLE `Phieu_ThuePhong`
  ADD CONSTRAINT `FK_PhieuThuePhong_KhachHang` FOREIGN KEY (`ID_KhachHang`) REFERENCES `KhachHang` (`ID_KhachHang`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_PhieuThuePhong_Phong` FOREIGN KEY (`MaPhong`) REFERENCES `Phong` (`MaPhong`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `Phong`
--
ALTER TABLE `Phong`
  ADD CONSTRAINT `FK_Phong_LoaiPhong` FOREIGN KEY (`MaLoai`) REFERENCES `LoaiPhong` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
