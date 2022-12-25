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