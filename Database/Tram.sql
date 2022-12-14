use quanlykhachsan;
-- Lấy dữ liệu hóa đơn
SELECT hd.sohoadon, hd.id_khachhang, kh.HoTen, hd.ngaythanhtoan  
FROM hoadon hd JOIN khachhang kh ON hd.ID_KhachHang=kh.ID_KhachHang;
 
-- Lấy dữ liệu chi tiết hóa đơn: do function trong mysql không thể trả về kiểu table nên tạo view, sau này nghĩ ra cách khác sẽ cải tiến
DROP FUNCTION IF EXISTS ct_hd;
DELIMITER //
CREATE FUNCTION ct_hd()    
RETURNS int
DETERMINISTIC NO SQL
BEGIN
    RETURN @sohoadon;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS CTHD;
DELIMITER //
CREATE 
PROCEDURE CTHD (sohd int) 
BEGIN
    set @sohoadon := sohd;
    
    DROP VIEW IF EXISTS ct_hd;
    CREATE VIEW ct_hd AS
	SELECT pt.maphong, ct.songaythuethuc, lp.dongia, ct.tienthuephong
	FROM chitiet_hoadon ct
		JOIN phieu_thuephong pt ON ct.sophieuthue=pt.sophieuthue 
		JOIN phong p ON pt.maphong=p.maphong 
		JOIN loaiphong lp ON lp.maloai=p.maloai
    WHERE ct.sohoadon = ct_hd();
END//
DELIMITER ;

call CTHD(01);

SELECT * FROM ct_hd

-- Lấy dữ liệu danh sách phòng
SELECT p.maphong, p.maloai, lp.dongia, p.tinhtrang FROM phong p JOIN loaiphong lp ON p.maloai=lp.maloai;
