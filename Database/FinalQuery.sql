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
DROP PROCEDURE IF EXISTS sp_chiTietHoaDon;
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