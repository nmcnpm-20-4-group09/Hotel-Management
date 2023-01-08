-- For MySQLQueryStringGenerator at BLL v1

-- Lấy chi tiết hoá đơn theo (số phiếu thuê, số hoá đơn)
-- Cách dùng: call v1_sp_chiTietHoaDon(...)
DROP PROCEDURE IF EXISTS v1_sp_chiTietHoaDon;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chiTietHoaDon (SoHoaDon int) 
BEGIN    
	SELECT *
	FROM chitiet_hoadon ct
    WHERE ct.SoHoaDon = SoHoaDon;
END//
DELIMITER ;

-- Lấy danh sách khách hàng
DROP PROCEDURE IF EXISTS v1_sp_danhSachKhachHang;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhSachKhachHang ()   
BEGIN
    SELECT *
    FROM KhachHang;
END//
DELIMITER ;

-- Lấy danh sách loại khách
DROP PROCEDURE IF EXISTS v1_sp_danhSachLoaiKhach;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhSachLoaiKhach ()   
BEGIN
    SELECT *
    FROM LoaiKhach;
END//
DELIMITER ;

-- Lấy danh mục phòng
DROP PROCEDURE IF EXISTS v1_sp_danhMucPhong;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhMucPhong ()   
BEGIN
    SELECT *
    FROM LoaiPhong;
END//
DELIMITER ;

-- Lấy danh sách phòng
DROP PROCEDURE IF EXISTS v1_sp_danhSachPhong;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhSachPhong ()   
BEGIN
    SELECT *
    FROM Phong;
END//
DELIMITER ;

-- Thay đổi tỉ lệ phụ thu
DROP PROCEDURE IF EXISTS v1_sp_doiTiLePhuThu;
DELIMITER //
CREATE 
PROCEDURE v1_sp_doiTiLePhuThu (MaPhuThu VARCHAR(5), TiLeMoi DOUBLE)
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
DROP PROCEDURE IF EXISTS v1_sp_danhSachHoaDon;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhSachHoaDon ()   
BEGIN
    SELECT *
    FROM HoaDon;
END//
DELIMITER ;

-- Lấy chi tiết phiếu thuê theo (số phiếu thuê)
DROP PROCEDURE IF EXISTS v1_sp_chiTietPhieuThue;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chiTietPhieuThue (SoPhieuThue int) 
BEGIN    
	SELECT *
	FROM chitiet_phieuthue ct
    WHERE ct.SoPhieuThue = SoPhieuThue;
END//
DELIMITER ;

-- Lấy danh sách phiếu thuê
DROP PROCEDURE IF EXISTS v1_sp_danhSachPhieuThue;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhSachPhieuThue ()   
BEGIN
    SELECT *
    FROM phieu_thuephong;
END//
DELIMITER ;

-- Cần có ràng buộc để đảm bảo phòng thêm vào không vượt quá số lượng cho phép
-- Thêm một phòng mới
DROP PROCEDURE IF EXISTS v1_sp_themPhong;
DELIMITER //
CREATE 
PROCEDURE v1_sp_themPhong (MaPhong VARCHAR(5), MaLoai VARCHAR(5), TinhTrang INT)
BEGIN
    INSERT INTO phong (MaPhong, MaLoai, TinhTrang)
    VALUES (MaPhong, MaLoai, TinhTrang);
END//
DELIMITER ;

-- Xóa phòng
DROP PROCEDURE IF EXISTS v1_sp_xoaPhong;
DELIMITER //
CREATE 
PROCEDURE v1_sp_xoaPhong (MaPhong VARCHAR(5)) 
BEGIN    
	DELETE p
    FROM phong p
    WHERE p.MaPhong = MaPhong;
END//
DELIMITER ;

-- Cần phải cập nhật ở các nơi có tham chiếu khóa ngoại
-- Chỉnh sửa phòng
DROP PROCEDURE IF EXISTS v1_sp_chinhSuaPhong;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chinhSuaPhong (MaPhong VARCHAR(5), MaPhongMoi VARCHAR(5), MaLoai VARCHAR(5), TinhTrang INT)
BEGIN    
	UPDATE phong p
    SET p.MaPhong = MaPhongMoi, p.MaLoai = MaLoai, p.TinhTrang = TinhTrang
    WHERE p.MaPhong = MaPhong;
END//
DELIMITER ;

-- Thêm một hóa đơn mới
DROP PROCEDURE IF EXISTS v1_sp_themHoaDon;
DELIMITER //
CREATE 
PROCEDURE v1_sp_themHoaDon (SoHoaDon int(11), NgayThanhToan date, TriGia double)
BEGIN
    INSERT INTO hoadon (SoHoaDon, NgayThanhToan, TriGia)
    VALUES (SoHoaDon, NgayThanhToan, TriGia);

    SELECT *
    FROM hoadon hd
    WHERE hd.SoHoaDon = SoHoaDon
    and hd.NgayThanhToan = NgayThanhToan
    and hd.TriGia = TriGia; 
END//
DELIMITER ;

-- Xóa hóa đơn
DROP PROCEDURE IF EXISTS v1_sp_xoaHoaDon;
DELIMITER //
CREATE 
PROCEDURE v1_sp_xoaHoaDon (SoHoaDon INT(11)) 
BEGIN    
	DELETE hd
    FROM hoadon hd
    WHERE hd.SoHoaDon = SoHoaDon;
END//
DELIMITER ;

-- Cần phải cập nhật ở các nơi có tham chiếu khóa ngoại
-- Chỉnh sửa hóa đơn
DROP PROCEDURE IF EXISTS v1_sp_chinhHoaDon;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chinhHoaDon (SoHoaDon int(11), NgayThanhToan date, TriGia double)
BEGIN    
	UPDATE hoadon hd
    SET hd.SoHoaDon = SoHoaDon, hd.NgayThanhToan = NgayThanhToan, hd.TriGia = TriGia
    WHERE hd.SoHoaDon = SoHoaDon;
END//
DELIMITER ;


-- Thêm một chi tiết hóa đơn mới
DROP PROCEDURE IF EXISTS v1_sp_themChiTiet_HD;
DELIMITER //
CREATE 
PROCEDURE v1_sp_themChiTiet_HD (SoPhieuThue int(11), SoHoaDon int(11), SoNgayThueThuc int(11), TienThuePhong double, MaPhuThu varchar(5))
BEGIN
    INSERT INTO phong (SoPhieuThue, SoHoaDon, SoNgayThueThuc, TienThuePhong, MaPhuThu)
    VALUES (SoPhieuThue, SoHoaDon, SoNgayThueThuc, TienThuePhong, MaPhuThu);
END//
DELIMITER ;

-- Xóa chi tiết hóa đơn
DROP PROCEDURE IF EXISTS v1_sp_xoaChiTiet_HD;
DELIMITER //
CREATE 
PROCEDURE v1_sp_xoaChiTiet_HD (SoHoaDon int(11)) 
BEGIN    
	DELETE cthd
    FROM chitiet_hoadon cthd
    WHERE cthd.SoHoaDon = SoHoaDon;
END//
DELIMITER ;

-- Cần phải cập nhật ở các nơi có tham chiếu khóa ngoại
-- Chỉnh sửa chi tiết hóa đơn
DROP PROCEDURE IF EXISTS v1_sp_chinhSuaChiTiet_HD;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chinhSuaChiTiet_HD (SoPhieuThue int(11), SoHoaDon int(11), SoNgayThueThuc int(11), TienThuePhong double, MaPhuThu varchar(5))
BEGIN    
	UPDATE chitiet_hoadon cthd
    SET cthd.SoPhieuThue = SoPhieuThue, cthd.SoHoaDon = SoHoaDon, cthd.SoNgayThueThuc = SoNgayThueThuc, cthd.TienThuePhong = TienThuePhong, cthd.MaPhuThu = MaPhuThu
    WHERE cthd.SoHoaDon = SoHoaDon;
END//
DELIMITER ;

-- Thêm một khách hàng
DROP PROCEDURE IF EXISTS v1_sp_themKhachHang;
DELIMITER //
CREATE 
PROCEDURE v1_sp_themKhachHang (ID_KhachHang varchar(12), LoaiKhach char(2), HoTen varchar(100), NgaySinh date, DiaChi varchar(100), SoDienThoai varchar(11), CMND varchar(12))
BEGIN
    INSERT INTO khachhang (ID_KhachHang, LoaiKhach, HoTen, NgaySinh, DiaChi, SoDienThoai, CMND)
    VALUES (ID_KhachHang, LoaiKhach, HoTen, NgaySinh, DiaChi, SoDienThoai, CMND);
END//
DELIMITER ;

-- Xóa khách hàng
DROP PROCEDURE IF EXISTS v1_sp_xoaKhachHang;
DELIMITER //
CREATE 
PROCEDURE v1_sp_xoaKhachHang (ID_KhachHang varchar(12)) 
BEGIN    
	DELETE kh
    FROM khachhang kh
    WHERE kh.ID_KhachHang = ID_KhachHang;
END//
DELIMITER ;

-- Cần phải cập nhật ở các nơi có tham chiếu khóa ngoại
-- Chỉnh sửa khách hàng
DROP PROCEDURE IF EXISTS v1_sp_chinhsuaKhachHang;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chinhsuaKhachHang (ID_KhachHang varchar(12), LoaiKhach char(2), HoTen varchar(100), NgaySinh date, DiaChi varchar(100), SoDienThoai varchar(11), CMND varchar(12))
BEGIN
    UPDATE khachhang kh
    SET kh.ID_KhachHang = ID_KhachHang, kh.LoaiKhach = LoaiKhach, kh.HoTen = HoTen, kh.NgaySinh = NgaySinh, kh.DiaChi = DiaChi, kh.SoDienThoai = SoDienThoai, kh.CMND = CMND
    WHERE kh.ID_KhachHang = ID_KhachHang;
END//
DELIMITER ;

-- Thêm một loại khách
DROP PROCEDURE IF EXISTS v1_sp_themLoaiKhach;
DELIMITER //
CREATE 
PROCEDURE v1_sp_themLoaiKhach (MaLoaiKhach char(2), TenLoaiKhach varchar(30), HeSo double)
BEGIN
    INSERT INTO loaikhach (MaLoaiKhach, TenLoaiKhach, HeSo)
    VALUES (MaLoaiKhach, TenLoaiKhach, HeSo);
END//
DELIMITER ;

-- Xóa loại khách
DROP PROCEDURE IF EXISTS v1_sp_xoaLoaiKhach;
DELIMITER //
CREATE 
PROCEDURE v1_sp_xoaLoaiKhach (MaLoaiKhach char(2)) 
BEGIN    
	DELETE lk
    FROM loaikhach lk
    WHERE lk.MaLoaiKhach = MaLoaiKhach;
END//
DELIMITER ;

-- Cần phải cập nhật ở các nơi có tham chiếu khóa ngoại
-- Chỉnh sửa loại khách
DROP PROCEDURE IF EXISTS v1_sp_chinhsuaLoaiKhach;
DELIMITER //
CREATE 
PROCEDURE v1_sp_chinhsuaLoaiKhach (MaLoaiKhach char(2), TenLoaiKhach varchar(30), HeSo double)
BEGIN    
	UPDATE loaikhach lk
    SET lk.MaLoaiKhach = MaLoaiKhach, lk.TenLoaiKhach = TenLoaiKhach, lk.HeSo = HeSo
    WHERE lk.MaLoaiKhach = MaLoaiKhach;
END//
DELIMITER ;

-- Lấy danh sách phụ thu
DROP PROCEDURE IF EXISTS v1_sp_danhSachPhuThu;
DELIMITER //
CREATE 
PROCEDURE v1_sp_danhSachPhuThu ()
BEGIN    
	SELECT *
    FROM phuthu;
END//
DELIMITER ;

-- Cập nhật phiếu thuê
DROP PROCEDURE IF EXISTS v1_sp_capNhatPhieuThue;
DELIMITER //
CREATE 
PROCEDURE v1_sp_capNhatPhieuThue (SoPhieuThue int(12), ID_KhachHang VARCHAR(12), NgayBatDauThue date, SoNgayThue int, MaPhong VARCHAR(5))
BEGIN    
	UPDATE phieu_thuephong pt
    SET pt.ID_KhachHang = ID_KhachHang, pt.NgayBatDauThue = NgayBatDauThue, pt.SoNgayThue = SoNgayThue, pt.MaPhong = MaPhong
    WHERE pt.SoPhieuThue = SoPhieuThue;

    SELECT * 
    FROM phieu_thuephong pt
    WHERE pt.ID_KhachHang = ID_KhachHang
    and pt.NgayBatDauThue = NgayBatDauThue
    and pt.SoNgayThue = SoNgayThue
    and pt.MaPhong = MaPhong;
END//
DELIMITER ;