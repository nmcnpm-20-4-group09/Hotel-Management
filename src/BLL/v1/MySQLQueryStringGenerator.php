<?php

namespace BLLv1;

class MySQLQueryStringGenerator
{
    public static function chiTietHoaDon($SoHoaDon)
    {
        $queryString = "call v1_sp_chiTietHoaDon(" . $SoHoaDon . ");";
        return $queryString;
    }

    public static function danhSachPhong()
    {
        $queryString = "call v1_sp_danhSachPhong();";
        return $queryString;
    }

    public static function danhMucPhong()
    {
        $queryString = "call v1_sp_danhMucPhong();";
        return $queryString;
    }

    public static function danhSachKhachHang()
    {
        $queryString = "call v1_sp_danhSachKhachHang();";
        return $queryString;
    }

    public static function danhSachLoaiKhach()
    {
        $queryString = "call v1_sp_danhSachLoaiKhach();";
        return $queryString;
    }

    public static function doiTiLePhuThu($MaPhuThu, $TiLeMoi)
    {
        $queryString = "call v1_sp_doiTiLePhuThu ('" . $MaPhuThu . "', " . $TiLeMoi . ")";
        return $queryString;
    }

    public static function danhSachHoaDon()
    {
        $queryString = "call v1_sp_danhSachHoaDon();";
        return $queryString;
    }

    public static function chiTietPhieuThue($SoPhieuThue)
    {
        $queryString = "call v1_sp_chiTietPhieuThue(" . $SoPhieuThue . ");";
        return $queryString;
    }

    public static function danhSachPhieuThue()
    {
        $queryString = "call v1_sp_danhSachPhieuThue();";
        return $queryString;
    }

    public static function themPhong($MaPhong, $MaLoai, $TinhTrang)
    {
        $queryString = "call v1_sp_themPhong('$MaPhong', '$MaLoai', $TinhTrang);";
        return $queryString;
    }

    public static function xoaPhong($MaPhong)
    {
        $queryString = "call v1_sp_xoaPhong('$MaPhong');";
        return $queryString;
    }

    public static function chinhSuaPhong($MaPhong, $MaPhongMoi, $MaLoai, $TinhTrang)
    {
        $queryString = "call v1_sp_chinhSuaPhong('$MaPhong', '$MaPhongMoi', '$MaLoai', $TinhTrang);";
        return $queryString;
    }

    public static function themHoaDon($SoHoaDon, $NgayThanhToan, $TriGia)
    {
        $queryString = "call v1_sp_themHoaDon (" . $SoHoaDon . ", \"" . $NgayThanhToan . "\", " . $TriGia . ")";
        return $queryString;
    }

    public static function danhSachPhuThu()
    {
        $queryString = "call v1_sp_danhSachPhuThu();";
        return $queryString;
    }

    public static function capNhatPhieuThue(
        $SoPhieuThue,
        $ID_KhachHang,
        $NgayBatDauThue,
        $SoNgayThue,
        $MaPhong    
    ) {
        $queryString = "call v1_sp_capNhatPhieuThue (" 
            . $SoPhieuThue 
            . ", \"" 
            . $ID_KhachHang 
            . "\", \"" 
            . $NgayBatDauThue 
            . "\", "
            . $SoNgayThue 
            . ", \""
            . $MaPhong 
            . "\")";
        return $queryString;
    }

    public static function capNhatLoaiKhach($MaLoaiKhach, $TenLoaiKhach, $HeSo)
    {
        $queryString = "call v1_sp_chinhsuaLoaiKhach (\"" . $MaLoaiKhach . "\", \"" . $TenLoaiKhach . "\", " . $HeSo . ")";
        return $queryString;
    }
}
