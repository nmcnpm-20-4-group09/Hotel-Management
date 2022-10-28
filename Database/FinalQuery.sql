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