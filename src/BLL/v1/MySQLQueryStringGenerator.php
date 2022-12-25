<?php

namespace BLLv1;

class MySQLQueryStringGenerator
{
    public static function chiTietHoaDon($SoPhieuThue, $SoHoaDon)
    {
        $queryString = "call v1_sp_chiTietHoaDon(" . $SoPhieuThue . ", " . $SoHoaDon . ");";
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
}

?>