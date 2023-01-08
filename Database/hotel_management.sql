-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 10:33 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_management`
--

-- DELIMITER $$
--
-- Procedures
--
-- CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_changeRate` (`mapt` VARCHAR(5), `tile` DOUBLE)   BEGIN
--     UPDATE phuthu AS pt
--     SET pt.TiLe = tile
--     WHERE pt.MaPhuThu = mapt ;
-- END$$

-- CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Customer` ()   BEGIN
--     SELECT kh.ID_KhachHang, kh.HoTen, kh.LoaiKhach,kh.CMND,kh.SoDienThoai,pt.MaPhong as 'MaPhong'
--     FROM khachhang as kh, phieu_thuephong as pt, chitiet_phieuthue as ctpt
--     WHERE kh.ID_KhachHang=ctpt.ID_KhachHang and ctpt.SoPhieuThue=pt.SoPhieuThue;
-- END$$

-- DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_hoadon`
--

CREATE TABLE `chitiet_hoadon` (
  `SoPhieuThue` int(11) NOT NULL,
  `SoHoaDon` int(11) NOT NULL,
  `SoNgayThueThuc` int(11) NOT NULL,
  `TienThuePhong` double NOT NULL,
  `MaPhuThu` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitiet_hoadon`
--

INSERT INTO `chitiet_hoadon` (`SoPhieuThue`, `SoHoaDon`, `SoNgayThueThuc`, `TienThuePhong`, `MaPhuThu`) VALUES
(1, 1, 2, 0, 'PT01'),
(2, 2, 3, 0, NULL),
(3, 3, 4, 0, NULL),
(4, 4, 1, 0, NULL),
(5, 5, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_phieuthue`
--

CREATE TABLE `chitiet_phieuthue` (
  `ID_KhachHang` varchar(12) NOT NULL,
  `SoPhieuThue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitiet_phieuthue`
--

INSERT INTO `chitiet_phieuthue` (`ID_KhachHang`, `SoPhieuThue`) VALUES
('KH01', 1),
('KH02', 2),
('KH03', 2),
('KH04', 3),
('KH05', 3),
('KH06', 4),
('KH07', 4),
('KH08', 5),
('KH09', 5),
('KH10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `SoHoaDon` int(11) NOT NULL,
  `NgayThanhToan` date NOT NULL,
  `TriGia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`SoHoaDon`, `NgayThanhToan`, `TriGia`) VALUES
(1, '2022-07-09', NULL),
(2, '2022-08-31', NULL),
(3, '2022-09-01', NULL),
(4, '2022-09-11', NULL),
(5, '2022-09-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `ID_KhachHang` varchar(12) NOT NULL,
  `LoaiKhach` char(2) DEFAULT NULL,
  `HoTen` varchar(100) NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` varchar(100) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `CMND` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`ID_KhachHang`, `LoaiKhach`, `HoTen`, `NgaySinh`, `DiaChi`, `SoDienThoai`, `CMND`) VALUES
('KH01', 'ND', 'Tran Van Lam', '1998-12-17', 'Ho Chi Minh', '033784206', '27605812'),
('KH02', 'ND', 'Le Duong Bao Lam', '1988-08-07', 'Long An', '09872540', '276058472'),
('KH03', 'ND', 'Pham Thi Quynh', '1992-07-05', 'Long An', '033587216', '276069852'),
('KH04', 'NN', 'Leonardo Wilhelm DiCaprio', '1965-08-01', 'France', '033587210', '276201485'),
('KH05', 'NN', 'John Christopher Depp', '1959-08-23', 'United States', '098751025', '276048520'),
('KH06', 'ND', 'Ho Quang Hieu', '1988-07-18', 'Ben Tre', '035214875', '281254782'),
('KH07', 'ND', 'Nguyen Bao Anh', '1990-01-06', 'Hanu Giang', '038420198', '276084205'),
('KH08', 'ND', 'Huynh Tran Thanh', '1987-04-06', 'Long An', '065487206', '276048516'),
('KH09', 'ND', 'Hari Won', '1985-09-18', 'Korea', '0358520661', '276018534'),
('KH10', 'ND', 'Nguyen Vo Truong Giang', '1985-06-06', 'Quang Nam', '098257326', '276041206');

-- --------------------------------------------------------

--
-- Table structure for table `loaikhach`
--

CREATE TABLE `loaikhach` (
  `MaLoaiKhach` char(2) NOT NULL,
  `TenLoaiKhach` varchar(30) NOT NULL,
  `HeSo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaikhach`
--

INSERT INTO `loaikhach` (`MaLoaiKhach`, `TenLoaiKhach`, `HeSo`) VALUES
('ND', 'Noi Dia', 1),
('NN', 'Nuoc Ngoai', 1.5);

-- --------------------------------------------------------

--
-- Table structure for table `loaiphong`
--

CREATE TABLE `loaiphong` (
  `MaLoai` char(1) NOT NULL,
  `SoLuongPhong` int(11) NOT NULL,
  `DonGia` double NOT NULL,
  `SoLuongPhongTrong` int(11) NOT NULL,
  `LuongKhachToiDa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaiphong`
--

INSERT INTO `loaiphong` (`MaLoai`, `SoLuongPhong`, `DonGia`, `SoLuongPhongTrong`, `LuongKhachToiDa`) VALUES
('A', 5, 150000, 5, 3),
('B', 5, 170000, 0, 3),
('C', 5, 200000, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `phieu_thuephong`
--

CREATE TABLE `phieu_thuephong` (
  `SoPhieuThue` int(12) NOT NULL,
  `ID_KhachHang` varchar(12) DEFAULT NULL,
  `NgayBatDauThue` date NOT NULL,
  `SoNgayThue` int(11) NOT NULL,
  `MaPhong` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieu_thuephong`
--

INSERT INTO `phieu_thuephong` (`SoPhieuThue`, `ID_KhachHang`, `NgayBatDauThue`, `SoNgayThue`, `MaPhong`) VALUES
(1, 'KH01', '2022-07-07', 2, 'P01'),
(2, 'KH02', '2022-08-28', 3, 'P11'),
(3, 'KH04', '2022-08-28', 4, 'P07'),
(4, 'KH06', '2022-09-10', 1, 'P13'),
(5, 'KH08', '2022-09-15', 1, 'P08');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `MaPhong` varchar(5) NOT NULL,
  `MaLoai` char(1) DEFAULT NULL,
  `TinhTrang` int(11) NOT NULL,
  `GhiChu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`MaPhong`, `MaLoai`, `TinhTrang`, `GhiChu`) VALUES
('P01', 'A', 0, 'Tot'),
('P02', 'A', 0, 'Tot'),
('P03', 'A', 0, 'Tot'),
('P04', 'A', 0, 'Tot'),
('P05', 'A', 0, 'Tot'),
('P06', 'B', 0, 'Tot'),
('P07', 'B', 0, 'Tot'),
('P08', 'B', 0, 'Tot'),
('P09', 'B', 0, 'Tot'),
('P10', 'B', 0, 'Tot'),
('P11', 'C', 0, 'Tot'),
('P12', 'C', 0, 'Tot'),
('P13', 'C', 0, 'Tot'),
('P14', 'C', 0, 'Tot'),
('P15', 'C', 0, 'Tot');

-- --------------------------------------------------------

--
-- Table structure for table `phuthu`
--

CREATE TABLE `phuthu` (
  `MaPhuThu` varchar(5) NOT NULL,
  `TenPhuThu` varchar(50) NOT NULL,
  `TiLe` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phuthu`
--

INSERT INTO `phuthu` (`MaPhuThu`, `TenPhuThu`, `TiLe`) VALUES
('PT01', 'Phong co 3 nguoi', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiet_hoadon`
--
ALTER TABLE `chitiet_hoadon`
  ADD PRIMARY KEY (`SoPhieuThue`,`SoHoaDon`),
  ADD KEY `FK_ChiTiet_HoaDon_HoaDon` (`SoHoaDon`),
  ADD KEY `FK_ChiTiet_HoaDon_PhuThu` (`MaPhuThu`);

--
-- Indexes for table `chitiet_phieuthue`
--
ALTER TABLE `chitiet_phieuthue`
  ADD PRIMARY KEY (`ID_KhachHang`,`SoPhieuThue`),
  ADD KEY `FK_ChiTiet_PhieuThue_Phieu_Thue_Phong` (`SoPhieuThue`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`SoHoaDon`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ID_KhachHang`),
  ADD KEY `FK_KhachHang_LoaiKhach` (`LoaiKhach`);

--
-- Indexes for table `loaikhach`
--
ALTER TABLE `loaikhach`
  ADD PRIMARY KEY (`MaLoaiKhach`);

--
-- Indexes for table `loaiphong`
--
ALTER TABLE `loaiphong`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `phieu_thuephong`
--
ALTER TABLE `phieu_thuephong`
  ADD PRIMARY KEY (`SoPhieuThue`),
  ADD KEY `FK_PhieuThuePhong_KhachHang` (`ID_KhachHang`),
  ADD KEY `FK_PhieuThuePhong_Phong` (`MaPhong`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`MaPhong`),
  ADD KEY `FK_Phong_LoaiPhong` (`MaLoai`);

--
-- Indexes for table `phuthu`
--
ALTER TABLE `phuthu`
  ADD PRIMARY KEY (`MaPhuThu`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiet_hoadon`
--
ALTER TABLE `chitiet_hoadon`
  ADD CONSTRAINT `FK_ChiTiet_HoaDon_HoaDon` FOREIGN KEY (`SoHoaDon`) REFERENCES `hoadon` (`SoHoaDon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTiet_HoaDon_PhuThu` FOREIGN KEY (`MaPhuThu`) REFERENCES `phuthu` (`MaPhuThu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chitiet_phieuthue`
--
ALTER TABLE `chitiet_phieuthue`
  ADD CONSTRAINT `FK_ChiTietPhieuThue_KhachHang` FOREIGN KEY (`ID_KhachHang`) REFERENCES `khachhang` (`ID_KhachHang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTietPhieuThue_PhieuThuePhong` FOREIGN KEY (`SoPhieuThue`) REFERENCES `phieu_thuephong` (`SoPhieuThue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ChiTiet_PhieuThue_Phieu_Thue_Phong` FOREIGN KEY (`SoPhieuThue`) REFERENCES `phieu_thuephong` (`SoPhieuThue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `FK_KhachHang_LoaiKhach` FOREIGN KEY (`LoaiKhach`) REFERENCES `loaikhach` (`MaLoaiKhach`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `phieu_thuephong`
--
ALTER TABLE `phieu_thuephong`
  ADD CONSTRAINT `FK_PhieuThuePhong_KhachHang` FOREIGN KEY (`ID_KhachHang`) REFERENCES `khachhang` (`ID_KhachHang`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_PhieuThuePhong_Phong` FOREIGN KEY (`MaPhong`) REFERENCES `phong` (`MaPhong`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `FK_Phong_LoaiPhong` FOREIGN KEY (`MaLoai`) REFERENCES `loaiphong` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
