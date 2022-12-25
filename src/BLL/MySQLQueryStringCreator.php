<?php

namespace BLL;

class MySQLQueryStringCreator
{
    public static function chiTietHoaDon($SoPhieuThue, $SoHoaDon)
    {
        $queryString = "call sp_chiTietHoaDon(" . $SoPhieuThue . ", " . $SoHoaDon . ");";
        return $queryString;
    }

    public static function danhSachPhong()
    {
        $queryString = "call sp_danhSachPhong();";
        return $queryString;
    }

    public static function danhMucPhong()
    {
        $queryString = "call sp_danhMucPhong();";
        return $queryString;
    }

    public static function danhSachKhachHang()
    {
        $queryString = "call sp_danhSachKhachHang();";
        return $queryString;
    }

    public static function doiTiLePhuThu($MaPhuThu, $TiLeMoi)
    {
        $queryString = "call sp_doiTiLePhuThu ('" . $MaPhuThu . "', " . $TiLeMoi . ")";
        return $queryString;
    }

    public static function danhSachHoaDon()
    {
        $queryString = "call sp_danhSachHoaDon();";
        return $queryString;
    }
}

?>