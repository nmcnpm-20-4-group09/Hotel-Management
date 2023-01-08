-- For MySQLQueryStringGenerator at BLL v2

-- Lấy danh sách phòng
DROP PROCEDURE IF EXISTS v2_sp_danhSachPhong;
DELIMITER //
CREATE 
PROCEDURE v2_sp_danhSachPhong ()   
BEGIN
    SELECT p.MaPhong, p.MaLoai, lp.DonGia, p.TinhTrang
    FROM `phong` p
    INNER JOIN `loaiphong` lp
    ON p.MaLoai = lp.MaLoai;
END//
DELIMITER ;

-- Lấy danh sách hóa đơn
DROP PROCEDURE IF EXISTS v2_sp_danhSachHoaDon;
DELIMITER //
CREATE 
PROCEDURE v2_sp_danhSachHoaDon ()   
BEGIN
    SELECT hd.SoHoaDon, pt.ID_KhachHang, hd.NgayThanhToan, hd.TriGia
    FROM `hoadon` hd
    INNER JOIN `chitiet_hoadon` cthd
    ON hd.SoHoaDon = cthd.SoHoaDon
    INNER JOIN `phieu_thuephong` pt
    ON pt.SoPhieuThue = cthd.SoPhieuThue;
END//
DELIMITER ;

-- Lấy danh sách chi tiết hóa đơn
DROP PROCEDURE IF EXISTS v2_sp_chiTietPhieuThue;
DELIMITER //
CREATE 
PROCEDURE v2_sp_chiTietPhieuThue (SoPhieuThue int(11))   
BEGIN
    SELECT * 
    FROM chitiet_phieuthue ct
    INNER JOIN khachhang kh
    ON ct.ID_KhachHang = kh.ID_KhachHang
    WHERE ct.SoPhieuThue = SoPhieuThue;
END//
DELIMITER ;
