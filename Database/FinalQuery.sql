-- Lấy chi tiết hoá đơn theo (số phiếu thuê, số hoá đơn)
-- Cách dùng: call sp_chiTietHoaDon(...)
DROP PROCEDURE IF EXISTS sp_chiTietHoaDon;
DELIMITER //
CREATE 
PROCEDURE sp_chiTietHoaDon (SoPhieuThue int, SoHoaDon int) 
BEGIN    
	SELECT *
	FROM chitiet_hoadon ct
    WHERE ct.SoPhieuThue = SoPhieuThue
    AND ct.SoHoaDon = SoHoaDon;
END//
DELIMITER ;

-- Lấy danh sách khách hàng
DROP PROCEDURE IF EXISTS sp_danhSachKhachHang;
DELIMITER //
CREATE 
PROCEDURE sp_danhSachKhachHang ()   
BEGIN
    SELECT *
    FROM KhachHang;
END//
DELIMITER ;

-- Lấy danh mục phòng
DROP PROCEDURE IF EXISTS sp_danhMucPhong;
DELIMITER //
CREATE 
PROCEDURE sp_danhMucPhong ()   
BEGIN
    SELECT *
    FROM LoaiPhong;
END//
DELIMITER ;

-- Lấy danh sách phòng
DROP PROCEDURE IF EXISTS sp_danhSachPhong;
DELIMITER //
CREATE 
PROCEDURE sp_danhSachPhong ()   
BEGIN
    SELECT *
    FROM Phong;
END//
DELIMITER ;

-- Thay đổi tỉ lệ phụ thu
DROP PROCEDURE IF EXISTS sp_doiTiLePhuThu;
DELIMITER //
CREATE 
PROCEDURE sp_doiTiLePhuThu (MaPhuThu VARCHAR(5), TiLeMoi DOUBLE)
BEGIN
    UPDATE PhuThu as pt
    SET pt.TiLe = TiLeMoi
    WHERE pt.MaPhuThu = MaPhuThu;

    SELECT *
    FROM PhuThu as pt
    WHERE pt.MaPhuThu = MaPhuThu;
END//
DELIMITER ;

-- Lấy danh sách hoá đơn
DROP PROCEDURE IF EXISTS sp_danhSachHoaDon;
DELIMITER //
CREATE 
PROCEDURE sp_danhSachHoaDon ()   
BEGIN
    SELECT *
    FROM HoaDon;
END//
DELIMITER ;
